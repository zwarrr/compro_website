<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotLog;
use Illuminate\Http\Request;

class ChatbotLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ChatbotLog::query();

        // Filter berdasarkan knowledge status
        if ($request->filled('knowledge_status')) {
            $query->where('knowledge_status', $request->knowledge_status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('question', 'like', "%{$search}%");
        }

        $logs = $query->orderBy('created_at', 'asc')->paginate(15);

        return view('vlte3.chatbot-log.index', compact('logs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $log = ChatbotLog::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $log
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Log tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Clear all logs
     */
    public function clearAll()
    {
        try {
            ChatbotLog::truncate();
            
            return response()->json([
                'success' => true,
                'message' => 'Semua log berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus semua log: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $log = ChatbotLog::findOrFail($id);
            $log->delete();

            return response()->json([
                'success' => true,
                'message' => 'Log berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus log: ' . $e->getMessage()
            ], 500);
        }
    }
}
