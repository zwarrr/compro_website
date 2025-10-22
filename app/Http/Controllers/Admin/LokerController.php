<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class LokerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function generateKode()
    {
        $last = Loker::orderBy('id_loker', 'desc')->first();
        if (!$last) return 'LOKER-001';
        $lastNumber = intval(substr($last->kode_loker, 6));
        $newNumber = $lastNumber + 1;
        return 'LOKER-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function index(Request $request)
    {
        $query = Loker::query();
        if ($request->has('search') && $request->search != '') {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('posisi', 'like', "%{$s}%")
                  ->orWhere('perusahaan', 'like', "%{$s}%")
                  ->orWhere('lokasi', 'like', "%{$s}%")
                  ->orWhere('kode_loker', 'like', "%{$s}%");
            });
        }
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        $allowedSorts = ['created_at', 'posisi', 'kode_loker'];
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        if (!in_array($sort, $allowedSorts)) $sort = 'created_at';
        if (!in_array(strtolower($direction), ['asc', 'desc'])) $direction = 'desc';
    $query->orderBy($sort, $direction);
    // eager load count of lamaran to avoid N+1 queries
    $query->withCount('lamaran');
    $lokers = $query->paginate(10)->appends($request->except('page'));
        return view('vlte3.loker.index', compact('lokers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('vlte3.loker.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'posisi' => 'required|string|max:100',
            'perusahaan' => 'required|string|max:100',
            'lokasi' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'gaji_awal' => 'nullable|integer',
            'gaji_akhir' => 'nullable|integer',
            'pengalaman' => 'nullable|string|max:50',
            'pendidikan' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,tidak aktif',
        ], [
            'posisi.required' => 'Posisi harus diisi',
            'perusahaan.required' => 'Perusahaan harus diisi',
            'lokasi.required' => 'Lokasi harus diisi',
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
                'kode_loker' => $this->generateKode(),
                'posisi' => $request->posisi,
                'perusahaan' => $request->perusahaan,
                'lokasi' => $request->lokasi,
                'deskripsi' => $request->deskripsi,
                'gaji_awal' => $request->gaji_awal,
                'gaji_akhir' => $request->gaji_akhir,
                'pengalaman' => $request->pengalaman,
                'pendidikan' => $request->pendidikan,
                'status' => $request->status,
            ];
            Loker::create($data);
            return response()->json([
                'success' => true,
                'message' => 'Loker berhasil ditambahkan!'
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
            $loker = Loker::findOrFail($id);
            $data = [
                'id_loker' => $loker->id_loker,
                'kode_loker' => $loker->kode_loker,
                'posisi' => $loker->posisi,
                'perusahaan' => $loker->perusahaan,
                'lokasi' => $loker->lokasi,
                'deskripsi' => $loker->deskripsi,
                'gaji_awal' => $loker->gaji_awal,
                'gaji_akhir' => $loker->gaji_akhir,
                'pengalaman' => $loker->pengalaman,
                'pendidikan' => $loker->pendidikan,
                'status' => $loker->status,
                'created_at_formatted' => $loker->created_at ? $loker->created_at->format('d M Y H:i') : '-',
                'updated_at_formatted' => $loker->updated_at ? $loker->updated_at->format('d M Y H:i') : '-',
            ];
            return response()->json([
                'success' => true,
                'loker' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Loker tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $loker = Loker::findOrFail($id);
            return response()->json([
                'success' => true,
                'loker' => $loker
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Loker tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $loker = Loker::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'posisi' => 'required|string|max:100',
            'perusahaan' => 'required|string|max:100',
            'lokasi' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'gaji_awal' => 'nullable|integer',
            'gaji_akhir' => 'nullable|integer',
            'pengalaman' => 'nullable|string|max:50',
            'pendidikan' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,tidak aktif',
        ], [
            'posisi.required' => 'Posisi harus diisi',
            'perusahaan.required' => 'Perusahaan harus diisi',
            'lokasi.required' => 'Lokasi harus diisi',
            'status.required' => 'Status harus dipilih',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            $loker->update($request->only([
                'posisi', 'perusahaan', 'lokasi', 'deskripsi', 'gaji_awal', 'gaji_akhir', 'pengalaman', 'pendidikan', 'status'
            ]));
            return response()->json([
                'success' => true,
                'message' => 'Loker berhasil diupdate!'
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
            $loker = Loker::findOrFail($id);
            $loker->delete();
            return response()->json([
                'success' => true,
                'message' => 'Loker berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
