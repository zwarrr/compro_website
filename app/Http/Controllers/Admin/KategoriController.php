<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class KategoriController extends Controller
{
    /**
     * Generate kode kategori otomatis yang unik
     */
    private function generateKode()
    {
        // Cari nomor tertinggi dari semua kode kategori
        $lastKategori = Kategori::orderBy('id_kategori', 'desc')->first();
        
        if (!$lastKategori) {
            return 'KAT-001';
        }
        
        // Ambil semua kode kategori yang ada
        $allKodes = Kategori::pluck('kode_kategori')->toArray();
        
        // Extract semua nomor yang ada
        $numbers = [];
        foreach ($allKodes as $kode) {
            if (preg_match('/KAT-(\d+)/', $kode, $matches)) {
                $numbers[] = intval($matches[1]);
            }
        }
        
        // Cari nomor terbesar dan tambah 1
        $maxNumber = empty($numbers) ? 0 : max($numbers);
        $newNumber = $maxNumber + 1;
        
        // Loop untuk memastikan kode benar-benar unik
        $kode = 'KAT-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        while (Kategori::where('kode_kategori', $kode)->exists()) {
            $newNumber++;
            $kode = 'KAT-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        }
        
        return $kode;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kategori::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_kategori', 'like', "%{$search}%")
                  ->orWhere('kode_kategori', 'like', "%{$search}%")
                  ->orWhere('tipe', 'like', "%{$search}%");
            });
        }

        // Filter by tipe
        if ($request->has('tipe') && $request->tipe != '') {
            $query->where('tipe', $request->tipe);
        }

        // Sorting
        $allowedSorts = ['created_at', 'nama_kategori', 'kode_kategori'];
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }
        if (!in_array(strtolower($direction), ['asc', 'desc'])) {
            $direction = 'desc';
        }
        $query->orderBy($sort, $direction);

        // Pagination
        $kategoris = $query->paginate(10)->appends($request->except('page'));

        return view('vlte3.kategori.index', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Debug log
        Log::info('Kategori store request:', $request->all());
        
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
            'tipe' => 'required|string|max:100',
        ], [
            'nama_kategori.required' => 'Nama kategori harus diisi',
            'tipe.required' => 'Tipe harus diisi',
        ]);

        if ($validator->fails()) {
            Log::warning('Kategori validation failed:', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $kategori = Kategori::create([
                'kode_kategori' => $this->generateKode(),
                'nama_kategori' => $request->nama_kategori,
                'tipe' => $request->tipe,
            ]);

            // Log::info('Kategori created successfully:', $kategori->toArray());

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil ditambahkan!',
                // 'redirect' => route('admin.kategori.index') 

            ]);
        } catch (\Exception $e) {
            Log::error('Kategori creation failed:', ['error' => $e->getMessage()]);
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
            $kategori = Kategori::findOrFail($id);
            
            $kategoriData = [
                'id_kategori' => $kategori->id_kategori,
                'kode_kategori' => $kategori->kode_kategori,
                'nama_kategori' => $kategori->nama_kategori,
                'tipe' => $kategori->tipe,
                'created_at_formatted' => $kategori->created_at ? $kategori->created_at->format('d M Y H:i') : '-',
                'updated_at_formatted' => $kategori->updated_at ? $kategori->updated_at->format('d M Y H:i') : '-',
            ];
            
            return response()->json([
                'success' => true,
                'kategori' => $kategoriData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            return response()->json([
                'success' => true,
                'kategori' => $kategori
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Log::info('Kategori update request for ID ' . $id . ':', $request->all());
        
        $kategori = Kategori::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
            'tipe' => 'required|string|max:100',
        ], [
            'nama_kategori.required' => 'Nama kategori harus diisi',
            'tipe.required' => 'Tipe harus diisi',
        ]);

        if ($validator->fails()) {
            Log::warning('Kategori update validation failed:', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $kategori->update([
                'nama_kategori' => $request->nama_kategori,
                'tipe' => $request->tipe,
            ]);

            Log::info('Kategori updated successfully:', $kategori->toArray());

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil diperbarui!',
            ]);
        } catch (\Exception $e) {
            Log::error('Kategori update failed:', ['error' => $e->getMessage()]);
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
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
