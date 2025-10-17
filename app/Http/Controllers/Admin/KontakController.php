<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kontak::query();

        // Filter berdasarkan status baca
        if ($request->filled('status_baca')) {
            $query->where('status_baca', $request->status_baca);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subjek', 'like', "%{$search}%")
                  ->orWhere('kode_kontak', 'like', "%{$search}%");
            });
        }

        $pesan = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Hitung jumlah pesan belum dibaca
        $unreadCount = Kontak::where('status_baca', 'belum')->count();

        return view('admin.pesan.index', compact('pesan', 'unreadCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'nullable|string|max:255',
            'pesan' => 'required|string',
            'status_baca' => 'required|in:belum,sudah',
        ], [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'pesan.required' => 'Pesan harus diisi',
            'status_baca.required' => 'Status baca harus dipilih',
            'status_baca.in' => 'Status baca tidak valid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $kontak = Kontak::create([
                'kode_kontak' => 'KNT-' . strtoupper(Str::random(8)),
                'nama' => $request->nama,
                'email' => $request->email,
                'subjek' => $request->subjek,
                'pesan' => $request->pesan,
                'status_baca' => $request->status_baca,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil ditambahkan',
                'data' => $kontak
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan pesan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $kontak = Kontak::findOrFail($id);
            
            // Tandai sebagai sudah dibaca
            if ($kontak->status_baca === 'belum') {
                $kontak->update(['status_baca' => 'sudah']);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id_kontak' => $kontak->id_kontak,
                    'kode_kontak' => $kontak->kode_kontak,
                    'nama' => $kontak->nama,
                    'email' => $kontak->email,
                    'subjek' => $kontak->subjek ?? '-',
                    'pesan' => $kontak->pesan,
                    'status_baca' => $kontak->status_baca,
                    'created_at' => $kontak->created_at->format('d M Y H:i'),
                    'updated_at' => $kontak->updated_at->format('d M Y H:i'),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pesan tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $kontak = Kontak::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $kontak
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pesan tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'nullable|string|max:255',
            'pesan' => 'required|string',
            'status_baca' => 'required|in:belum,sudah',
        ], [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'pesan.required' => 'Pesan harus diisi',
            'status_baca.required' => 'Status baca harus dipilih',
            'status_baca.in' => 'Status baca tidak valid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $kontak = Kontak::findOrFail($id);

            $kontak->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'subjek' => $request->subjek,
                'pesan' => $request->pesan,
                'status_baca' => $request->status_baca,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil diperbarui',
                'data' => $kontak
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui pesan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kontak = Kontak::findOrFail($id);
            $kontak->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus pesan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark message as read
     */
    public function markAsRead(string $id)
    {
        try {
            $kontak = Kontak::findOrFail($id);
            $kontak->update(['status_baca' => 'sudah']);

            return response()->json([
                'success' => true,
                'message' => 'Pesan ditandai sudah dibaca'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai pesan'
            ], 500);
        }
    }

    /**
     * Mark message as unread
     */
    public function markAsUnread(string $id)
    {
        try {
            $kontak = Kontak::findOrFail($id);
            $kontak->update(['status_baca' => 'belum']);

            return response()->json([
                'success' => true,
                'message' => 'Pesan ditandai belum dibaca'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai pesan'
            ], 500);
        }
    }
}
