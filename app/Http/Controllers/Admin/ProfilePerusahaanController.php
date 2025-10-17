<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilePerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilePerusahaanController extends Controller
{
    // Tampilkan halaman konfigurasi (dan kirim JSON jika AJAX)
    public function index(Request $request)
    {
        $profile = ProfilePerusahaan::query()->first();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'profile' => $profile,
            ]);
        }

        return view('admin.konfigurasi.index', compact('profile'));
    }

    // Simpan profil baru (hanya jika belum ada)
    public function store(Request $request)
    {
        // Cegah duplikasi
        if (ProfilePerusahaan::query()->exists()) {
            return $this->respondValidation(['nama_perusahaan' => ['Profil sudah ada. Gunakan Edit untuk mengubah.']], 422, $request);
        }

        $validated = $request->validate([
            'nama_perusahaan' => ['required', 'string', 'max:255'],
            'slogan'          => ['nullable', 'string', 'max:255'],
            'deskripsi'       => ['required', 'string'],
            'visi'            => ['nullable', 'string'],
            'misi'            => ['nullable', 'string'],
            'alamat'          => ['nullable', 'string', 'max:500'],
            'telepon'         => ['nullable', 'string', 'max:50'],
            'email'           => ['nullable', 'email', 'max:255'],
        ]);

        $validated['kode_profile'] = $this->generateKode();

        $profile = ProfilePerusahaan::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => 'Profil berhasil dibuat', 'profile' => $profile]);
        }

        return redirect()->route('admin.konfigurasi.index')->with('success', 'Profil berhasil dibuat');
    }

    // Tampilkan detail profil (JSON)
    public function show(ProfilePerusahaan $konfigurasi)
    {
        // Route model biding: {konfigurasi}
        return response()->json(['profile' => $konfigurasi]);
    }

    // Update profil existing
    public function update(Request $request, ProfilePerusahaan $konfigurasi)
    {
        $validated = $request->validate([
            'nama_perusahaan' => ['required', 'string', 'max:255'],
            'slogan'          => ['nullable', 'string', 'max:255'],
            'deskripsi'       => ['required', 'string'],
            'visi'            => ['nullable', 'string'],
            'misi'            => ['nullable', 'string'],
            'alamat'          => ['nullable', 'string', 'max:500'],
            'telepon'         => ['nullable', 'string', 'max:50'],
            'email'           => ['nullable', 'email', 'max:255'],
        ]);

        // kode_profile tidak diubah saat update
        unset($validated['kode_profile']);

        $konfigurasi->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => 'Profil berhasil diperbarui', 'profile' => $konfigurasi->fresh()]);
        }

        return redirect()->route('admin.konfigurasi.index')->with('success', 'Profil berhasil diperbarui');
    }

    // Helper generate kode PRF-001, PRF-002, ...
    private function generateKode(): string
    {
        $last = ProfilePerusahaan::query()
            ->orderByDesc('id_perusahaan')
            ->value('kode_profile');

        $num = 0;
        if ($last && preg_match('/PRF-(\d{3})$/', $last, $m)) {
            $num = (int) $m[1];
        }
        $next = $num + 1;
        return 'PRF-' . str_pad((string)$next, 3, '0', STR_PAD_LEFT);
    }

    private function respondValidation(array $errors, int $status, Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $errors], $status);
        }
        return back()->withErrors($errors)->withInput();
    }
}
