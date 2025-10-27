<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class IlustrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Ilustrasi::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kode_ilustrasi', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Sorting
        $allowedSorts = ['created_at', 'judul', 'kode_ilustrasi'];
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }
        if (!in_array(strtolower($direction), ['asc', 'desc'])) {
            $direction = 'desc';
        }
        $query->orderBy($sort, $direction);

        $ilustrasis = $query->paginate(10)->appends($request->except('page'));
        return view('vlte3.ilustrasi.index', compact('ilustrasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vlte3.ilustrasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'status' => 'required|in:public,draft',
        ], [
            'judul.required' => 'Judul harus diisi',
            'image.image' => 'File harus berupa gambar',
            'image.max' => 'Ukuran gambar maksimal 10MB',
            'status.required' => 'Status harus dipilih',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Generate kode_ilustrasi otomatis
            $last = \App\Models\Ilustrasi::orderBy('id_ilustrasi', 'desc')->first();
            $nextNumber = $last ? intval(substr($last->kode_ilustrasi, 3)) + 1 : 1;
            $kode_ilustrasi = 'ILS' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            $data = $request->only(['judul', 'deskripsi', 'status']);
            $data['kode_ilustrasi'] = $kode_ilustrasi;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $slugJudul = Str::slug($request->judul);
                $extension = $file->getClientOriginalExtension();
                $filename = $slugJudul . '.' . $extension;
                $path = $file->storeAs('public/ilustrasi', $filename);
                $data['image'] = str_replace('public/', '', $path);
            }
            $ilustrasi = \App\Models\Ilustrasi::create($data);
            return response()->json([
                'success' => true,
                'message' => 'Ilustrasi berhasil ditambahkan!',
                'kode_ilustrasi' => $ilustrasi->kode_ilustrasi,
                'ilustrasi' => $ilustrasi
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
            $ilustrasi = \App\Models\Ilustrasi::findOrFail($id);
            $ilustrasiData = [
                'id_ilustrasi' => $ilustrasi->id_ilustrasi,
                'kode_ilustrasi' => $ilustrasi->kode_ilustrasi,
                'judul' => $ilustrasi->judul,
                'deskripsi' => $ilustrasi->deskripsi,
                'image' => $ilustrasi->image,
                'image_url' => $ilustrasi->image ? asset('storage/' . $ilustrasi->image) : null,
                'status' => $ilustrasi->status,
                'created_at_formatted' => $ilustrasi->created_at ? $ilustrasi->created_at->format('d M Y H:i') : '-',
                'updated_at_formatted' => $ilustrasi->updated_at ? $ilustrasi->updated_at->format('d M Y H:i') : '-',
            ];
            return response()->json([
                'success' => true,
                'ilustrasi' => $ilustrasiData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ilustrasi tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $ilustrasi = \App\Models\Ilustrasi::findOrFail($id);
            return response()->json([
                'success' => true,
                'ilustrasi' => $ilustrasi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ilustrasi tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ilustrasi = \App\Models\Ilustrasi::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'status' => 'required|in:public,draft',
        ], [
            'judul.required' => 'Judul harus diisi',
            'image.image' => 'File harus berupa gambar',
            'image.max' => 'Ukuran gambar maksimal 10MB',
            'status.required' => 'Status harus dipilih',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->only(['judul', 'deskripsi', 'status']);
            // kode_ilustrasi tidak diubah
            if ($request->hasFile('image')) {
                if ($ilustrasi->image) {
                    $oldImagePath = storage_path('app/public/' . $ilustrasi->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $file = $request->file('image');
                $slugJudul = Str::slug($request->judul);
                $extension = $file->getClientOriginalExtension();
                $filename = $slugJudul . '.' . $extension;
                $path = $file->storeAs('public/ilustrasi', $filename);
                $data['image'] = str_replace('public/', '', $path);
            }
            $ilustrasi->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Ilustrasi berhasil diupdate!'
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
            $ilustrasi = \App\Models\Ilustrasi::findOrFail($id);
            if ($ilustrasi->image) {
                $imagePath = storage_path('app/public/' . $ilustrasi->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $ilustrasi->delete();
            return response()->json([
                'success' => true,
                'message' => 'Ilustrasi berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
