<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TestimoniController extends Controller
{
    /**
     * Generate kode testimoni otomatis
     */
    private function generateKode()
    {
        $lastTestimoni = Testimoni::orderBy('id_testimoni', 'desc')->first();

        if (!$lastTestimoni) {
            return 'TES-001';
        }

        $lastNumber = intval(substr($lastTestimoni->kode_testimoni, 4));
        $newNumber = $lastNumber + 1;

        return 'TES-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Testimoni::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_testimoni', 'like', "%{$search}%")
                    ->orWhere('kode_testimoni', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by rating
        if ($request->has('rating') && $request->rating != '') {
            $query->where('rating', $request->rating);
        }

        // Pagination
        $testimonis = $query->latest()->paginate(10);

        return view('vlte3.testimoni.index', compact('testimonis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_testimoni' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'pesan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|in:publik,draft',
        ], [
            'nama_testimoni.required' => 'Nama harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'pesan.required' => 'Pesan testimoni harus diisi',
            'rating.required' => 'Rating harus dipilih',
            'rating.min' => 'Rating minimal 1',
            'rating.max' => 'Rating maksimal 5',
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'Ukuran foto maksimal 10MB',
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
                'kode_testimoni' => $this->generateKode(),
                'nama_testimoni' => $request->nama_testimoni,
                'jabatan' => $request->jabatan,
                'pesan' => $request->pesan,
                'rating' => $request->rating,
                'status' => $request->status,
            ];

            // Handle upload foto
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $slugNama = Str::slug($request->nama_testimoni);
                $extension = $file->getClientOriginalExtension();
                $filename = "{$slugNama}.{$extension}";

                // Simpan ke storage/app/public/testimoni
                $path = $file->storeAs('public/testimoni', $filename);

                // Simpan path relatif ke database (tanpa 'public/')
                $data['foto'] = str_replace('public/', '', $path);
            }

            Testimoni::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Testimoni berhasil ditambahkan!'
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
            $testimoni = Testimoni::findOrFail($id);

            $testimoniData = [
                'id_testimoni' => $testimoni->id_testimoni,
                'kode_testimoni' => $testimoni->kode_testimoni,
                'nama_testimoni' => $testimoni->nama_testimoni,
                'jabatan' => $testimoni->jabatan,
                'pesan' => $testimoni->pesan,
                'foto' => $testimoni->foto,
                'foto_url' => $testimoni->foto ? asset('storage/' . $testimoni->foto) : null,
                'rating' => $testimoni->rating,
                'status' => $testimoni->status,
                'created_at' => $testimoni->created_at,
                'created_at_formatted' => $testimoni->created_at ? $testimoni->created_at->format('d M Y H:i') : '-',
                'updated_at_formatted' => $testimoni->updated_at ? $testimoni->updated_at->format('d M Y H:i') : '-',
            ];

            return response()->json([
                'success' => true,
                'data' => $testimoniData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Testimoni tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $testimoni = Testimoni::findOrFail($id);
            
            $testimoniData = [
                'id_testimoni' => $testimoni->id_testimoni,
                'kode_testimoni' => $testimoni->kode_testimoni,
                'nama_testimoni' => $testimoni->nama_testimoni,
                'jabatan' => $testimoni->jabatan,
                'pesan' => $testimoni->pesan,
                'foto' => $testimoni->foto,
                'foto_url' => $testimoni->foto ? asset('storage/' . $testimoni->foto) : null,
                'rating' => $testimoni->rating,
                'status' => $testimoni->status,
            ];
            
            return response()->json([
                'success' => true,
                'data' => $testimoniData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Testimoni tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $testimoni = Testimoni::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_testimoni' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'pesan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|in:publik,draft',
        ], [
            'nama_testimoni.required' => 'Nama harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'pesan.required' => 'Pesan testimoni harus diisi',
            'rating.required' => 'Rating harus dipilih',
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'Ukuran foto maksimal 10MB',
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
                'nama_testimoni' => $request->nama_testimoni,
                'jabatan' => $request->jabatan,
                'pesan' => $request->pesan,
                'rating' => $request->rating,
                'status' => $request->status,
            ];

            // Handle file upload
            if ($request->hasFile('foto')) {
                // Delete old foto if exists
                if ($testimoni->foto) {
                    $oldFotoPath = storage_path('app/public/' . $testimoni->foto);
                    if (file_exists($oldFotoPath)) {
                        unlink($oldFotoPath);
                    }
                }

                // Upload foto baru dengan format slug nama + extension
                $file = $request->file('foto');
                $slugNama = Str::slug($request->nama_testimoni);
                $extension = $file->getClientOriginalExtension();
                $filename = "{$slugNama}.{$extension}";

                // Simpan ke storage/app/public/testimoni
                $path = $file->storeAs('public/testimoni', $filename);

                // Simpan path relatif ke database (tanpa 'public/')
                $data['foto'] = str_replace('public/', '', $path);
            }

            $testimoni->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Testimoni berhasil diperbarui!'
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
            $testimoni = Testimoni::findOrFail($id);

            // Delete foto if exists
            if ($testimoni->foto) {
                $fotoPath = storage_path('app/public/' . $testimoni->foto);
                if (file_exists($fotoPath)) {
                    unlink($fotoPath);
                }
            }

            $testimoni->delete();

            return response()->json([
                'success' => true,
                'message' => 'Testimoni berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
