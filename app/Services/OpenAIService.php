<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Pengetahuan;
use App\Models\ChatbotLog;
use Illuminate\Http\Request;

class OpenAIService
{
    private $http;
    private $apiKey;
    private $model;
    private $temperature;
    private $maxTokens;
    private $systemPrompt;
    private $timeout;
    private $baseUrl;

    public function __construct()
    {
        // Initialize HTTP client with SSL bypass for development (Windows)
        $this->http = Http::withOptions(['verify' => false]);
        
        // Load config with type casting
        $this->apiKey = config('openai.api_key');
        $this->model = config('openai.model', 'gpt-4-turbo');
        $this->temperature = (float) config('openai.temperature', 0.9);
        $this->maxTokens = (int) config('openai.max_tokens', 600);
        $this->systemPrompt = config('openai.system_prompt');
        $this->timeout = (int) config('openai.timeout', 30);
        $this->baseUrl = config('openai.base_url', 'https://api.openai.com/v1');
    }

    /**
     * Get knowledge base from database (Pengetahuan)
     */
    private function getKnowledgeBase(): string
    {
        $pengetahuans = Pengetahuan::all();
        
        if ($pengetahuans->isEmpty()) {
            return "Tidak ada knowledge base tersedia.";
        }

        $knowledgeText = "KNOWLEDGE BASE PERUSAHAAN:\n\n";
        
        foreach ($pengetahuans as $item) {
            $knowledgeText .= "Kategori: {$item->kategori_pertanyaan}\n";
            if ($item->sub_kategori) {
                $knowledgeText .= "Sub Kategori: {$item->sub_kategori}\n";
            }
            $knowledgeText .= "Jawaban: {$item->jawaban}\n\n";
            $knowledgeText .= "---\n\n";
        }

        return $knowledgeText;
    }

    /**
     * Send chat request to OpenAI with knowledge base
     */
    public function chat(string $message, array $conversationHistory = [], Request $request = null): string
    {
        try {
            // Parse user agent if request provided
            $metadata = null;
            if ($request) {
                $metadata = $this->parseUserAgent($request);
            }

            // Build messages array
            $messages = $this->buildMessages($message, $conversationHistory);

            // Make API request
            $response = $this->http
                ->timeout($this->timeout)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->post("{$this->baseUrl}/chat/completions", [
                    'model' => $this->model,
                    'messages' => $messages,
                    'temperature' => $this->temperature,
                    'max_tokens' => $this->maxTokens,
                ]);

            if (!$response->successful()) {
                throw new \Exception('OpenAI API error: ' . $response->body());
            }

            $result = $response->json();
            $aiResponse = $result['choices'][0]['message']['content'] ?? 'Maaf, tidak ada respons.';

            // Clean markdown formatting
            $cleanResponse = $this->cleanMarkdown($aiResponse);

            // Save to chatbot log if request provided
            if ($request && $metadata) {
                $this->saveChatbotLog($message, $cleanResponse, $metadata);
            }

            return $cleanResponse;

        } catch (\Exception $e) {
            Log::error('OpenAI Service Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Build messages array for OpenAI
     */
    private function buildMessages(string $message, array $conversationHistory): array
    {
        // Get current datetime in WIB (Asia/Jakarta)
        $now = now()->timezone('Asia/Jakarta');
        $dayName = $now->locale('id')->translatedFormat('l');
        $dateFormatted = $now->format('d F Y');
        $timeFormatted = $now->format('H:i:s');

        // Get knowledge base
        $knowledgeBase = $this->getKnowledgeBase();

        // Enhanced system prompt with knowledge base
        $enhancedSystemPrompt = $this->systemPrompt . "\n\n";
        $enhancedSystemPrompt .= $knowledgeBase . "\n\n";
        $enhancedSystemPrompt .= "INFORMASI WAKTU REAL-TIME:\n";
        $enhancedSystemPrompt .= "Sekarang adalah {$dayName}, {$dateFormatted}, {$timeFormatted} (Asia/Jakarta - WIB)\n\n";
        $enhancedSystemPrompt .= "INSTRUKSI:\n";
        $enhancedSystemPrompt .= "- Gunakan informasi dari KNOWLEDGE BASE untuk menjawab pertanyaan.\n";
        $enhancedSystemPrompt .= "- Jika pertanyaan ada di knowledge base, jawab berdasarkan data tersebut.\n";
        $enhancedSystemPrompt .= "- Jika tidak ada di knowledge base, jawab dengan pengetahuan umum.\n";
        $enhancedSystemPrompt .= "- Selalu jawab dengan ramah dan profesional.\n";

        $messages = [
            ['role' => 'system', 'content' => $enhancedSystemPrompt]
        ];

        // Add conversation history (last 10 messages only)
        $recentHistory = array_slice($conversationHistory, -10);
        foreach ($recentHistory as $msg) {
            if (isset($msg['role']) && isset($msg['content'])) {
                $messages[] = [
                    'role' => $msg['role'],
                    'content' => $msg['content']
                ];
            }
        }

        // Add current user message
        $messages[] = ['role' => 'user', 'content' => $message];

        return $messages;
    }

    /**
     * Clean markdown formatting from AI response
     */
    private function cleanMarkdown(string $text): string
    {
        // Remove bold (**text**)
        $text = preg_replace('/\*\*(.*?)\*\*/', '$1', $text);
        
        // Remove italic (*text*)
        $text = preg_replace('/\*(.*?)\*/', '$1', $text);
        
        // Remove headers (# ## ###)
        $text = preg_replace('/^#{1,6}\s+/m', '', $text);
        
        // Remove list bullets (- * +)
        $text = preg_replace('/^[\-\*\+]\s+/m', '', $text);
        
        // Remove code blocks (```code```)
        $text = preg_replace('/```[\s\S]*?```/', '', $text);
        
        // Remove inline code (`code`)
        $text = preg_replace('/`(.*?)`/', '$1', $text);
        
        return trim($text);
    }

    /**
     * Test OpenAI connection
     */
    public function testConnection(): array
    {
        try {
            $response = $this->http
                ->timeout(10)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ])
                ->get("{$this->baseUrl}/models");

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'OpenAI connection successful',
                    'model' => $this->model
                ];
            }

            return [
                'success' => false,
                'error' => 'Failed to connect to OpenAI'
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Parse user agent to detect device, browser, and OS
     */
    private function parseUserAgent(Request $request): array
    {
        $userAgent = $request->header('User-Agent', '');
        
        // Detect device type
        $device = 'Desktop';
        if (preg_match('/mobile|android|iphone|ipod|blackberry|windows phone/i', $userAgent)) {
            $device = 'Mobile';
        } elseif (preg_match('/tablet|ipad/i', $userAgent)) {
            $device = 'Tablet';
        }

        // Detect browser
        $browser = 'Unknown';
        if (preg_match('/edg(?:e|ios|a)?\/([\d\.]+)/i', $userAgent, $matches)) {
            $browser = 'Edge ' . $matches[1];
        } elseif (preg_match('/chrome\/([\d\.]+)/i', $userAgent, $matches)) {
            $browser = 'Chrome ' . $matches[1];
        } elseif (preg_match('/firefox\/([\d\.]+)/i', $userAgent, $matches)) {
            $browser = 'Firefox ' . $matches[1];
        } elseif (preg_match('/safari\/([\d\.]+)/i', $userAgent, $matches)) {
            if (!preg_match('/chrome|chromium|crios/i', $userAgent)) {
                $browser = 'Safari ' . $matches[1];
            }
        } elseif (preg_match('/msie\s([\d\.]+)|trident.*rv:([\d\.]+)/i', $userAgent, $matches)) {
            $browser = 'IE ' . ($matches[1] ?? $matches[2]);
        } elseif (preg_match('/opera|opr\/([\d\.]+)/i', $userAgent, $matches)) {
            $browser = 'Opera ' . ($matches[1] ?? 'Unknown');
        }

        // Detect OS
        $os = 'Unknown';
        if (preg_match('/windows nt ([\d\.]+)/i', $userAgent, $matches)) {
            $version = $matches[1];
            $windowsVersions = [
                '10.0' => '10/11',
                '6.3' => '8.1',
                '6.2' => '8',
                '6.1' => '7',
            ];
            $os = 'Windows ' . ($windowsVersions[$version] ?? $version);
        } elseif (preg_match('/mac os x ([\d_\.]+)/i', $userAgent, $matches)) {
            $os = 'macOS ' . str_replace('_', '.', $matches[1]);
        } elseif (preg_match('/linux/i', $userAgent)) {
            $os = 'Linux';
        } elseif (preg_match('/android ([\d\.]+)/i', $userAgent, $matches)) {
            $os = 'Android ' . $matches[1];
        } elseif (preg_match('/ios ([\d_\.]+)|iphone os ([\d_\.]+)/i', $userAgent, $matches)) {
            $os = 'iOS ' . str_replace('_', '.', $matches[1] ?? $matches[2]);
        }

        return [
            'user_agent' => $userAgent,
            'device' => $device,
            'browser' => $browser,
            'os_platform' => $os,
        ];
    }

    /**
     * Save chatbot conversation to log
     */
    private function saveChatbotLog(string $question, string $answer, array $metadata): void
    {
        try {
            // Check if answer matches knowledge base
            $matchedKnowledge = null;
            $knowledgeStatus = 'not_found';
            $questionLower = strtolower($question);

            $pengetahuans = Pengetahuan::all();
            $bestMatch = null;
            $highestScore = 0;

            foreach ($pengetahuans as $item) {
                $score = 0;
                $matchedField = '';
                
                // Check kategori_pertanyaan - word by word
                $kategoriLower = strtolower($item->kategori_pertanyaan);
                $kategoriWords = preg_split('/\s+/', $kategoriLower);
                $matchedKategoriWords = 0;
                foreach ($kategoriWords as $word) {
                    if (strlen($word) > 2 && strpos($questionLower, $word) !== false) {
                        $matchedKategoriWords++;
                    }
                }
                if (count($kategoriWords) > 0) {
                    $kategoriScore = ($matchedKategoriWords / count($kategoriWords)) * 100;
                    if ($kategoriScore > $score) {
                        $score = $kategoriScore;
                        $matchedField = 'kategori: ' . $item->kategori_pertanyaan;
                    }
                }
                
                // Check sub_kategori - word by word
                if ($item->sub_kategori) {
                    $subLower = strtolower($item->sub_kategori);
                    $subWords = preg_split('/\s+/', $subLower);
                    $matchedSubWords = 0;
                    foreach ($subWords as $word) {
                        if (strlen($word) > 2 && strpos($questionLower, $word) !== false) {
                            $matchedSubWords++;
                        }
                    }
                    if (count($subWords) > 0) {
                        $subScore = ($matchedSubWords / count($subWords)) * 100;
                        if ($subScore > $score) {
                            $score = $subScore;
                            $matchedField = 'sub kategori: ' . $item->sub_kategori;
                        }
                    }
                }
                
                // Check jawaban - partial text matching
                $jawabanLower = strtolower($item->jawaban);
                $jawabanWords = preg_split('/\s+/', $jawabanLower);
                $matchedJawabanWords = 0;
                foreach ($jawabanWords as $word) {
                    if (strlen($word) > 3 && strpos($questionLower, $word) !== false) {
                        $matchedJawabanWords++;
                    }
                }
                if (count($jawabanWords) > 0) {
                    $jawabanScore = ($matchedJawabanWords / count($jawabanWords)) * 100;
                    if ($jawabanScore > $score) {
                        $score = $jawabanScore;
                        $matchedField = 'jawaban: ' . substr($item->jawaban, 0, 50) . '...';
                    }
                }
                
                // Keep track of best match
                if ($score > $highestScore && $score > 20) {
                    $highestScore = $score;
                    $bestMatch = $item;
                    $matchedKnowledge = 'Cocok dengan ' . $matchedField;
                }
            }

            // Set status based on match
            if ($bestMatch) {
                $knowledgeStatus = 'found';
            } else {
                $knowledgeStatus = 'not_found';
                $matchedKnowledge = null;
            }

            ChatbotLog::create([
                'question' => $question,
                'answer' => $answer,
                'matched_knowledge' => $matchedKnowledge,
                'user_agent' => $metadata['user_agent'],
                'device' => $metadata['device'],
                'browser' => $metadata['browser'],
                'os_platform' => $metadata['os_platform'],
                'knowledge_status' => $knowledgeStatus,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to save chatbot log: ' . $e->getMessage());
        }
    }
}
