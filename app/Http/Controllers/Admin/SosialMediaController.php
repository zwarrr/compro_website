<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SosialMediaController extends Controller
{
    /**
     * Generate kode sosial media otomatis
     */
    private function generateKode()
    {
        $lastSosmed = SocialMedia::orderBy('id_sosial', 'desc')->first();
        
        if (!$lastSosmed) {
            return 'SOSMED-001';
        }
        
        $lastNumber = intval(substr($lastSosmed->kode_sosial, 7));
        $newNumber = $lastNumber + 1;
        
        return 'SOSMED-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SocialMedia::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_sosmed', 'like', "%{$search}%")
                  ->orWhere('kode_sosial', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Pagination
        $sosmeds = $query->latest()->paginate(10);

        return view('admin.sosial.index', compact('sosmeds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sosmed' => 'required|string|max:100',
            'username' => 'nullable|string|max:150',
            'url' => 'required|url|max:255',
            'icon' => 'nullable|string|max:100',
            'warna' => 'nullable|string|max:20',
            'status' => 'required|in:publik,draft',
        ], [
            'nama_sosmed.required' => 'Nama sosial media harus diisi',
            'url.required' => 'URL harus diisi',
            'url.url' => 'Format URL tidak valid',
            'status.required' => 'Status harus dipilih',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = [
                'kode_sosial' => $this->generateKode(),
                'nama_sosmed' => $request->nama_sosmed,
                'username' => $request->username,
                'url' => $request->url,
                'icon' => $request->icon,
                'warna' => $request->warna,
                'status' => $request->status,
            ];

            SocialMedia::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Sosial media berhasil ditambahkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $sosmed = SocialMedia::findOrFail($id);
            
            $sosmedData = [
                'id_sosial' => $sosmed->id_sosial,
                'kode_sosial' => $sosmed->kode_sosial,
                'nama_sosmed' => $sosmed->nama_sosmed,
                'username' => $sosmed->username,
                'url' => $sosmed->url,
                'icon' => $sosmed->icon,
                'warna' => $sosmed->warna,
                'status' => $sosmed->status,
                'created_at_formatted' => $sosmed->created_at ? $sosmed->created_at->format('d M Y H:i') : '-',
                'updated_at_formatted' => $sosmed->updated_at ? $sosmed->updated_at->format('d M Y H:i') : '-',
            ];
            
            return response()->json([
                'success' => true,
                'sosmed' => $sosmedData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sosial media tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $sosmed = SocialMedia::findOrFail($id);
            return response()->json([
                'success' => true,
                'sosmed' => $sosmed
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sosial media tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sosmed = SocialMedia::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_sosmed' => 'required|string|max:100',
            'username' => 'nullable|string|max:150',
            'url' => 'required|url|max:255',
            'icon' => 'nullable|string|max:100',
            'warna' => 'nullable|string|max:20',
            'status' => 'required|in:publik,draft',
        ], [
            'nama_sosmed.required' => 'Nama sosial media harus diisi',
            'url.required' => 'URL harus diisi',
            'url.url' => 'Format URL tidak valid',
            'status.required' => 'Status harus dipilih',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = [
                'nama_sosmed' => $request->nama_sosmed,
                'username' => $request->username,
                'url' => $request->url,
                'icon' => $request->icon,
                'warna' => $request->warna,
                'status' => $request->status,
            ];

            $sosmed->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Sosial media berhasil diupdate!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $sosmed = SocialMedia::findOrFail($id);
            $sosmed->delete();

            return response()->json([
                'success' => true,
                'message' => 'Sosial media berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus sosial media: ' . $e->getMessage()
            ], 500);
        }
    }
}
