<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GaleriController extends Controller
{
    /**
     * Generate kode galeri otomatis
     */
    private function generateKode()
    {
        $lastGaleri = Galeri::orderBy('id_galeri', 'desc')->first();
        
        if (!$lastGaleri) {
            return 'GAL-001';
        }
        
        $lastNumber = intval(substr($lastGaleri->kode_galeri, 4));
        $newNumber = $lastNumber + 1;
        
        return 'GAL-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Galeri::with('kategori');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kode_galeri', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by kategori
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Pagination
        $galeris = $query->latest()->paginate(10);
        $kategoris = Kategori::where('tipe', 'galeri')->get();

        return view('admin.galeri.index', compact('galeris', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'kategori_id.required' => 'Kategori harus dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'judul.required' => 'Judul harus diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
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
                'kode_galeri' => $this->generateKode(),
                'kategori_id' => $request->kategori_id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ];

            // Handle file upload
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/galeri'), $filename);
                $data['gambar'] = $filename;
            }

            Galeri::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Galeri berhasil ditambahkan!'
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
            $galeri = Galeri::with('kategori')->findOrFail($id);
            
            $galeriData = [
                'id_galeri' => $galeri->id_galeri,
                'kode_galeri' => $galeri->kode_galeri,
                'kategori_id' => $galeri->kategori_id,
                'kategori_nama' => $galeri->kategori->nama_kategori ?? '-',
                'judul' => $galeri->judul,
                'deskripsi' => $galeri->deskripsi,
                'gambar' => $galeri->gambar,
                'gambar_url' => $galeri->gambar ? asset('images/galeri/' . $galeri->gambar) : null,
                'status' => $galeri->status,
                'created_at_formatted' => $galeri->created_at ? $galeri->created_at->format('d M Y H:i') : '-',
                'updated_at_formatted' => $galeri->updated_at ? $galeri->updated_at->format('d M Y H:i') : '-',
            ];
            
            return response()->json([
                'success' => true,
                'galeri' => $galeriData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Galeri tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $galeri = Galeri::findOrFail($id);
            return response()->json([
                'success' => true,
                'galeri' => $galeri
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Galeri tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'kategori_id.required' => 'Kategori harus dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'judul.required' => 'Judul harus diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
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
                'kategori_id' => $request->kategori_id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ];

            // Handle file upload
            if ($request->hasFile('gambar')) {
                // Delete old image if exists
                if ($galeri->gambar && file_exists(public_path('images/galeri/' . $galeri->gambar))) {
                    unlink(public_path('images/galeri/' . $galeri->gambar));
                }

                $file = $request->file('gambar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/galeri'), $filename);
                $data['gambar'] = $filename;
            }

            $galeri->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Galeri berhasil diperbarui!'
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
            $galeri = Galeri::findOrFail($id);
            
            // Delete image if exists
            if ($galeri->gambar && file_exists(public_path('images/galeri/' . $galeri->gambar))) {
                unlink(public_path('images/galeri/' . $galeri->gambar));
            }
            
            $galeri->delete();

            return response()->json([
                'success' => true,
                'message' => 'Galeri berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
