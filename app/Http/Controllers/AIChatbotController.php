<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userMessage = $request->input('message');
        $apiKey = env('GROQ_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'Groq API key missing in .env file.'
            ], 500);
        }

        // System Prompt: Chatbot ko aapke institute/project ke baare me context sikhane ke liye
        $systemPrompt = "You are a helpful and polite Student Support AI Assistant for our Student Management & Training Institute. "
            . "Our portal offers courses in Frontend Development, Backend Development, and Fullstack Web Development. "
            . "Key Features of the System: Student Registration, Payment Status tracking (Paid/Pending), Course Selection, Live Search with highlight, Print Student Records, and Student CRUD management. "
            . "Answer queries clearly, concisely, and helpfully regarding courses, enrollment, payment status, and general tech/programming guidance. Keep responses short and friendly.";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(15)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $userMessage],
                ],
                'temperature' => 0.7,
                'max_tokens' => 300,
            ]);

            if ($response->successful()) {
                $botReply = $response->json('choices.0.message.content');
                return response()->json([
                    'success' => true,
                    'reply' => $botReply
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Groq API response error: ' . $response->status()
            ], 500);

        } catch (\Exception $e) {
            Log::error('AI Chatbot Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Unable to connect to AI server. Please try again.'
            ], 500);
        }
    }
}