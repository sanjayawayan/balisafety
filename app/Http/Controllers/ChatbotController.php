<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    /**
     * Send message to Gemini AI Chatbot with token-saving constraints
     */
    public function chat(Request $request, GeminiService $gemini)
    {
        // Token efficiency: Strict max length 250 chars for input
        $request->validate([
            'message' => 'required|string|max:250',
            'session_id' => 'nullable|string|max:64',
        ]);

        $sessionId = $request->input('session_id') ?: session()->getId();
        if (empty($sessionId)) {
            $sessionId = Str::uuid()->toString();
        }

        $userText = mb_substr(trim($request->input('message')), 0, 250);

        // Retrieve only last 2 messages for ultra-lean context memory
        $history = ChatMessage::where('session_id', $sessionId)
            ->orderBy('id', 'desc')
            ->take(2)
            ->get()
            ->reverse()
            ->map(fn($item) => [
                'role' => $item->role,
                'message' => mb_substr($item->message, 0, 120),
            ])
            ->toArray();

        // Save user message to database
        ChatMessage::create([
            'session_id' => $sessionId,
            'role' => 'user',
            'message' => $userText,
        ]);

        // Call Gemini Service with token-optimized limits
        $aiResult = $gemini->generateResponse($userText, $history);

        // Save AI response to database
        ChatMessage::create([
            'session_id' => $sessionId,
            'role' => 'assistant',
            'message' => $aiResult['message'],
            'meta' => [
                'source' => $aiResult['source'] ?? 'unknown',
                'model' => $aiResult['model'] ?? 'gemini',
                'token_saver' => true,
            ]
        ]);

        return response()->json([
            'success' => true,
            'session_id' => $sessionId,
            'reply' => $aiResult['message'],
            'source' => $aiResult['source'] ?? 'gemini-live',
            'model' => $aiResult['model'] ?? 'gemini-1.5-flash',
            'is_live_gemini' => $gemini->isConfigured(),
            'tokens_optimized' => true,
            'max_input_chars' => 250,
            'max_output_tokens' => 250,
        ]);
    }

    /**
     * Get chat conversation history for the current session
     */
    public function history(Request $request)
    {
        $sessionId = $request->input('session_id') ?: session()->getId();

        $messages = ChatMessage::where('session_id', $sessionId)
            ->orderBy('id', 'asc')
            ->take(30)
            ->get(['role', 'message', 'created_at']);

        return response()->json([
            'success' => true,
            'session_id' => $sessionId,
            'messages' => $messages,
        ]);
    }

    /**
     * Clear conversation history
     */
    public function clear(Request $request)
    {
        $sessionId = $request->input('session_id') ?: session()->getId();

        ChatMessage::where('session_id', $sessionId)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Riwayat percakapan telah dibersihkan.'
        ]);
    }
}
