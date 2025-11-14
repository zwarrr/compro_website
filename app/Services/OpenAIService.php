<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Pengetahuan;

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
    public function chat(string $message, array $conversationHistory = []): string
    {
        try {
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
            return $this->cleanMarkdown($aiResponse);

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
}
