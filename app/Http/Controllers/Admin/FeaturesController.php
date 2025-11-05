<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Features::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kode_features', 'like', "%{$search}%")
                  ->orWhere('sub_judul', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Sorting
        $allowedSorts = ['created_at', 'judul', 'kode_features', 'sub_judul'];
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }
        if (!in_array(strtolower($direction), ['asc', 'desc'])) {
            $direction = 'desc';
        }
        $query->orderBy($sort, $direction);

        $features = $query->paginate(10)->appends($request->except('page'));
        return view('vlte3.features.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vlte3.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'status' => 'required|in:public,draft',
            'replace_position' => 'required|integer|between:1,6',
        ], [
            'judul.required' => 'Judul harus diisi',
            'sub_judul.max' => 'Sub Judul maksimal 255 karakter',
            'status.required' => 'Status harus dipilih',
            'replace_position.required' => 'Posisi harus dipilih',
            'replace_position.between' => 'Posisi harus antara 1-6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Generate kode_features otomatis
            $last = \App\Models\Features::orderBy('id_features', 'desc')->first();
            $nextNumber = $last ? intval(substr($last->kode_features, 3)) + 1 : 1;
            $kode_features = 'FTR' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            $data = $request->only(['judul', 'sub_judul', 'status', 'replace_position']);
            $data['kode_features'] = $kode_features;

            $features = \App\Models\Features::create($data);
            return response()->json([
                'success' => true,
                'message' => 'Features berhasil ditambahkan!',
                'kode_features' => $features->kode_features,
                'features' => $features
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
            $features = \App\Models\Features::findOrFail($id);
            $featuresData = [
                'id_features' => $features->id_features,
                'kode_features' => $features->kode_features,
                'judul' => $features->judul,
                'sub_judul' => $features->sub_judul,
                'status' => $features->status,
                'replace_position' => $features->replace_position,
                'created_at_formatted' => $features->created_at ? $features->created_at->format('d M Y H:i') : '-',
                'updated_at_formatted' => $features->updated_at ? $features->updated_at->format('d M Y H:i') : '-',
            ];
            return response()->json([
                'success' => true,
                'features' => $featuresData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Features tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $features = \App\Models\Features::findOrFail($id);
            return response()->json([
                'success' => true,
                'features' => $features
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Features tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $features = \App\Models\Features::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'status' => 'required|in:public,draft',
            'replace_position' => 'required|integer|between:1,6',
        ], [
            'judul.required' => 'Judul harus diisi',
            'sub_judul.max' => 'Sub Judul maksimal 255 karakter',
            'status.required' => 'Status harus dipilih',
            'replace_position.required' => 'Posisi harus dipilih',
            'replace_position.between' => 'Posisi harus antara 1-6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->only(['judul', 'sub_judul', 'status', 'replace_position']);
            // kode_features tidak diubah
            $features->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Features berhasil diupdate!'
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
            $features = \App\Models\Features::findOrFail($id);
            $features->delete();
            return response()->json([
                'success' => true,
                'message' => 'Features berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}