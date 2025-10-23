<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display team members page
     */
    public function team()
    {
        // Ambil semua karyawan dengan status aktif, urutkan sesuai posisi
        $karyawans = Karyawan::with('kategori')
            ->where('status', 'aktif')
            ->orderByRaw('ISNULL(posisi), posisi ASC, id_karyawan ASC')
            ->get();
        return view('sections.team', compact('karyawans'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Karyawan::with('kategori');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kode_karyawan', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
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
        $karyawans = $query->latest()->paginate(10);

        return view('users.karyawan.index', compact('karyawans'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $karyawan = Karyawan::with('kategori')->findOrFail($id);
            
            $karyawanData = [
                'id_karyawan' => $karyawan->id_karyawan,
                'kode_karyawan' => $karyawan->kode_karyawan,
                'kategori_id' => $karyawan->kategori_id,
                'kategori_nama' => $karyawan->kategori->nama_kategori ?? '-',
                'nik' => $karyawan->nik,
                'nama' => $karyawan->nama,
                'deskripsi' => $karyawan->deskripsi,
                'foto' => $karyawan->foto,
                'foto_url' => $karyawan->foto ? asset('images/karyawan/' . $karyawan->foto) : null,
                'status' => $karyawan->status,
                'created_at_formatted' => $karyawan->created_at ? $karyawan->created_at->format('d M Y H:i') : '-',
                'updated_at_formatted' => $karyawan->updated_at ? $karyawan->updated_at->format('d M Y H:i') : '-',
            ];
            
            return response()->json([
                'success' => true,
                'karyawan' => $karyawanData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Karyawan tidak ditemukan'
            ], 404);
        }
    }
}
