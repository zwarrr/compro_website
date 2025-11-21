<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;
use Illuminate\Support\Facades\Validator;

class ChatbotController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    /**
     * Send message to chatbot
     */
    public function sendMessage(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:1000',
            'conversation_history' => 'array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->first()
            ], 422);
        }

        try {
            $message = $request->input('message');
            $conversationHistory = $request->input('conversation_history', []);

            // Get AI response with request for logging
            $aiResponse = $this->openAIService->chat($message, $conversationHistory, $request);

            return response()->json([
                'success' => true,
                'message' => $aiResponse
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Service temporarily unavailable. Please try again later.'
            ], 500);
        }
    }

    /**
     * Test OpenAI connection
     */
    public function testConnection()
    {
        try {
            $result = $this->openAIService->testConnection();
            
            if ($result['success']) {
                return response()->json($result);
            }

            return response()->json($result, 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
