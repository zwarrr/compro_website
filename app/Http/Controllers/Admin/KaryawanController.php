<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Generate kode karyawan otomatis
     */
    private function generateKode()
    {
        $lastKaryawan = Karyawan::orderBy('id_karyawan', 'desc')->first();

        if (!$lastKaryawan) {
            return 'KAR-001';
        }

        $lastNumber = intval(substr($lastKaryawan->kode_karyawan, 4));
        $newNumber = $lastNumber + 1;

        return 'KAR-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
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
            $query->where(function ($q) use ($search) {
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
        $kategoris = Kategori::where('tipe', 'karyawan')->get();

        return view('admin.karyawan.index', compact('karyawans', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'nik' => 'required|string|max:50',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Maks 10MB
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'kategori_id.required' => 'Kategori harus dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'nik.required' => 'NIK harus diisi',
            'nama.required' => 'Nama harus diisi',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
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
                'kode_karyawan' => $this->generateKode(),
                'kategori_id' => $request->kategori_id,
                'nik' => $request->nik,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ];

            // Upload foto ke storage/app/public/karyawan
            // Handle file upload
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $extension = $file->getClientOriginalExtension();

                // Gunakan nama karyawan sebagai nama file
                $filename = str_replace(' ', '_', strtolower($request->nama)) . '.' . $extension;

                // Simpan ke storage/app/public/karyawan
                $file->storeAs('public/karyawan', $filename);

                $data['foto'] = $filename;
            }


            Karyawan::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Karyawan berhasil ditambahkan!'
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
                'foto_url' => $karyawan->foto ? asset('storage/' . $karyawan->foto) : null,
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $karyawan = Karyawan::findOrFail($id);
            return response()->json([
                'success' => true,
                'karyawan' => $karyawan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Karyawan tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'nik' => 'required|string|max:50',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status' => 'required|in:aktif,nonaktif',
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
                'nik' => $request->nik,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ];

            // Jika ada file foto baru
            // Handle file upload
            if ($request->hasFile('foto')) {
                // Hapus foto lama kalau ada
                if ($karyawan->foto && Storage::exists('public/karyawan/' . $karyawan->foto)) {
                    Storage::delete('public/karyawan/' . $karyawan->foto);
                }

                $file = $request->file('foto');
                $extension = $file->getClientOriginalExtension();

                // Nama file = nama karyawan + ekstensi
                $filename = str_replace(' ', '_', strtolower($request->nama)) . '.' . $extension;

                // Simpan ke storage
                $file->storeAs('public/karyawan', $filename);

                $data['foto'] = $filename;
            }


            $karyawan->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Karyawan berhasil diperbarui!'
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
            $karyawan = Karyawan::findOrFail($id);

            // Hapus foto dari storage jika ada
            if ($karyawan->foto && Storage::exists('public/' . $karyawan->foto)) {
                Storage::delete('public/' . $karyawan->foto);
            }

            $karyawan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Karyawan berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
