<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    /**
     * Generate kode layanan otomatis
     */
    private function generateKode()
    {
        $lastLayanan = Layanan::orderBy('id_layanan', 'desc')->first();

        if (!$lastLayanan) {
            return 'LAY-001';
        }

        $lastNumber = intval(substr($lastLayanan->kode_layanan, 4));
        $newNumber = $lastNumber + 1;

        return 'LAY-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Layanan::with('kategori');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('kode_layanan', 'like', "%{$search}%")
                    ->orWhere('slog', 'like', "%{$search}%");
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

        // Sorting
        $allowedSorts = ['created_at', 'judul', 'kode_layanan'];
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
        $layanans = $query->paginate(10)->appends($request->except('page'));
        $kategoris = Kategori::where('tipe', 'layanan')->get();

        return view('vlte3.layanan.index', compact('layanans', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|max:255',
            'slog' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'background' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status' => 'required|in:publik,draft',
        ], [
            'kategori_id.required' => 'Kategori harus dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'judul.required' => 'Judul harus diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.max' => 'Ukuran gambar maksimal 10MB',
            'background.image' => 'File background harus berupa gambar',
            'background.max' => 'Ukuran background maksimal 10MB',
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
                'kode_layanan' => $this->generateKode(),
                'kategori_id' => $request->kategori_id,
                'judul' => $request->judul,
                'slog' => $request->slog,
                'link' => $request->link,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ];

            // Handle upload gambar
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $slugJudul = Str::slug($request->judul);
                $extension = $file->getClientOriginalExtension();
                $filename = "{$slugJudul}.{$extension}";
                $path = $file->storeAs('public/layanan', $filename);
                $data['gambar'] = str_replace('public/', '', $path);
            }

            // Handle upload background
            if ($request->hasFile('background')) {
                $fileBg = $request->file('background');
                $slugJudul = Str::slug($request->judul);
                $extensionBg = $fileBg->getClientOriginalExtension();
                $filenameBg = "{$slugJudul}-bg.{$extensionBg}";
                $pathBg = $fileBg->storeAs('public/layanan', $filenameBg);
                $data['background'] = str_replace('public/', '', $pathBg);
            }

            Layanan::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Layanan berhasil ditambahkan!'
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
            $layanan = Layanan::with('kategori')->findOrFail($id);

            $layananData = [
                'id_layanan' => $layanan->id_layanan,
                'kode_layanan' => $layanan->kode_layanan,
                'kategori_id' => $layanan->kategori_id,
                'kategori_nama' => $layanan->kategori->nama_kategori ?? '-',
                'judul' => $layanan->judul,
                'slog' => $layanan->slog,
                'link' => $layanan->link,
                'deskripsi' => $layanan->deskripsi,
                'background' => $layanan->background,
                'background_url' => $layanan->background ? asset('storage/' . $layanan->background) : null,
                'gambar' => $layanan->gambar,
                'gambar_url' => $layanan->gambar ? asset('storage/' . $layanan->gambar) : null,
                'status' => $layanan->status,
                'created_at_formatted' => $layanan->created_at ? $layanan->created_at->format('d M Y H:i') : '-',
                'updated_at_formatted' => $layanan->updated_at ? $layanan->updated_at->format('d M Y H:i') : '-',
            ];

            return response()->json([
                'success' => true,
                'layanan' => $layananData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Layanan tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $layanan = Layanan::findOrFail($id);
            return response()->json([
                'success' => true,
                'layanan' => $layanan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Layanan tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|max:255',
            'slog' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'background' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status' => 'required|in:publik,draft',
        ], [
            'kategori_id.required' => 'Kategori harus dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'judul.required' => 'Judul harus diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.max' => 'Ukuran gambar maksimal 10MB',
            'background.image' => 'File background harus berupa gambar',
            'background.max' => 'Ukuran background maksimal 10MB',
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
                'slog' => $request->slog,
                'link' => $request->link,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ];

            // Handle file upload gambar
            if ($request->hasFile('gambar')) {
                if ($layanan->gambar) {
                    $oldImagePath = storage_path('app/public/' . $layanan->gambar);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $file = $request->file('gambar');
                $slugJudul = Str::slug($request->judul);
                $extension = $file->getClientOriginalExtension();
                $filename = "{$slugJudul}.{$extension}";
                $path = $file->storeAs('public/layanan', $filename);
                $data['gambar'] = str_replace('public/', '', $path);
            }

            // Handle file upload background
            if ($request->hasFile('background')) {
                if ($layanan->background) {
                    $oldBgPath = storage_path('app/public/' . $layanan->background);
                    if (file_exists($oldBgPath)) {
                        unlink($oldBgPath);
                    }
                }
                $fileBg = $request->file('background');
                $slugJudul = Str::slug($request->judul);
                $extensionBg = $fileBg->getClientOriginalExtension();
                $filenameBg = "{$slugJudul}-bg.{$extensionBg}";
                $pathBg = $fileBg->storeAs('public/layanan', $filenameBg);
                $data['background'] = str_replace('public/', '', $pathBg);
            }

            $layanan->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Layanan berhasil diperbarui!'
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
            $layanan = Layanan::findOrFail($id);

            // Delete image if exists
            if ($layanan->gambar) {
                $imagePath = storage_path('app/public/' . $layanan->gambar);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $layanan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Layanan berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
