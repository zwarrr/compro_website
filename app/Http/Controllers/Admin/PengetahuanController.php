<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengetahuanController extends Controller
{
    /**
     * Get next kode_pengetahuan for auto-number preview
     */
    public function nextKode()
    {
        $last = \App\Models\Pengetahuan::orderBy('id_pengetahuan', 'desc')->first();
        $nextNumber = $last ? ($last->id_pengetahuan + 1) : 1;
        $kode_pengetahuan = 'KNW-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        return response()->json(['kode_pengetahuan' => $kode_pengetahuan]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Pengetahuan::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_pengetahuan', 'like', "%$search%")
                  ->orWhere('kategori_pertanyaan', 'like', "%$search%")
                  ->orWhere('sub_kategori', 'like', "%$search%")
                  ->orWhere('jawaban', 'like', "%$search%");
            });
        }

        // Filter kategori_pertanyaan
        if ($request->has('kategori_pertanyaan') && $request->kategori_pertanyaan != '') {
            $query->where('kategori_pertanyaan', 'like', "%{$request->kategori_pertanyaan}%");
        }

        // Filter sub_kategori
        if ($request->has('sub_kategori') && $request->sub_kategori != '') {
            $query->where('sub_kategori', 'like', "%{$request->sub_kategori}%");
        }

        // Sorting
        $allowedSorts = ['created_at', 'kode_pengetahuan', 'kategori_pertanyaan'];
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }
        if (!in_array(strtolower($direction), ['asc', 'desc'])) {
            $direction = 'desc';
        }
        $query->orderBy($sort, $direction);

        $pengetahuans = $query->paginate(10)->appends($request->except('page'));

        // Get unique kategori_pertanyaan and sub_kategori for dropdown
        $kategoriPertanyaanList = \App\Models\Pengetahuan::select('kategori_pertanyaan')
            ->distinct()->orderBy('kategori_pertanyaan')->pluck('kategori_pertanyaan');
        $subKategoriList = \App\Models\Pengetahuan::select('sub_kategori')
            ->whereNotNull('sub_kategori')->distinct()->orderBy('sub_kategori')->pluck('sub_kategori');

        return view('vlte3.pengetahuan.index', compact('pengetahuans', 'kategoriPertanyaanList', 'subKategoriList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vlte3.pengetahuan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // kode_pengetahuan will be auto-generated
            'kategori_pertanyaan' => 'required|string|max:100',
            'sub_kategori' => 'nullable|string|max:100',
            'jawaban' => 'required|string',
        ], [
            'kategori_pertanyaan.required' => 'Kategori pertanyaan harus diisi',
            'jawaban.required' => 'Jawaban harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Generate autonumber kode_pengetahuan: PKL-00001, PKL-00002, ...
            $last = \App\Models\Pengetahuan::orderBy('id_pengetahuan', 'desc')->first();
            $nextNumber = $last ? ($last->id_pengetahuan + 1) : 1;
            $kode_pengetahuan = 'PKL-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

            \App\Models\Pengetahuan::create([
                'kode_pengetahuan' => $kode_pengetahuan,
                'kategori_pertanyaan' => $request->kategori_pertanyaan,
                'sub_kategori' => $request->sub_kategori,
                'jawaban' => $request->jawaban,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Pengetahuan berhasil ditambahkan!'
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
            $pengetahuan = \App\Models\Pengetahuan::findOrFail($id);
            return response()->json([
                'success' => true,
                'pengetahuan' => $pengetahuan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pengetahuan tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $pengetahuan = \App\Models\Pengetahuan::findOrFail($id);
            return response()->json([
                'success' => true,
                'pengetahuan' => $pengetahuan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pengetahuan tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pengetahuan = \App\Models\Pengetahuan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kode_pengetahuan' => 'required|string|max:50|unique:pengetahuans,kode_pengetahuan,' . $id . ',id_pengetahuan',
            'kategori_pertanyaan' => 'required|string|max:100',
            'sub_kategori' => 'nullable|string|max:100',
            'jawaban' => 'required|string',
        ], [
            'kode_pengetahuan.required' => 'Kode pengetahuan harus diisi',
            'kode_pengetahuan.unique' => 'Kode pengetahuan sudah ada',
            'kategori_pertanyaan.required' => 'Kategori pertanyaan harus diisi',
            'jawaban.required' => 'Jawaban harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $pengetahuan->update($request->only([
                'kode_pengetahuan',
                'kategori_pertanyaan',
                'sub_kategori',
                'jawaban',
            ]));
            return response()->json([
                'success' => true,
                'message' => 'Pengetahuan berhasil diupdate!'
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
            $pengetahuan = \App\Models\Pengetahuan::findOrFail($id);
            $pengetahuan->delete();
            return response()->json([
                'success' => true,
                'message' => 'Pengetahuan berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
