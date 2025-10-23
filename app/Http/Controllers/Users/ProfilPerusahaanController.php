<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilPerusahaanController extends Controller
{
    /**
     * Tampilkan halaman profil perusahaan dengan data dinamis
     */
    public function index()
    {
        // Ambil data profil perusahaan (asumsi hanya satu row, bisa diambil first)
        $profile = \App\Models\ProfilePerusahaan::first();

        // Ambil data galeri untuk slider (bisa filter kategori jika perlu)
        $galeri = \App\Models\Galeri::where('status', 'aktif')->get();

        // Ambil struktur organisasi
        $generalManager = \App\Models\Karyawan::with('kategori')
            ->whereHas('kategori', function($q) { $q->where('nama_kategori', 'Manajer'); })
            ->where('status', 'aktif')->first();

        $marketings = \App\Models\Karyawan::with('kategori')
            ->whereHas('kategori', function($q) { $q->where('nama_kategori', 'Marketing'); })
            ->where('status', 'aktif')->get();

        $sdms = \App\Models\Karyawan::with('kategori')
            ->whereHas('kategori', function($q) { $q->where('nama_kategori', 'SDM'); })
            ->where('status', 'aktif')->get();

        $accountings = \App\Models\Karyawan::with('kategori')
            ->whereHas('kategori', function($q) { $q->where('nama_kategori', 'Accounting'); })
            ->where('status', 'aktif')->get();

        $supports = \App\Models\Karyawan::with('kategori')
            ->whereHas('kategori', function($q) { $q->where('nama_kategori', 'Support'); })
            ->where('status', 'aktif')->get();

        $umbs = \App\Models\Karyawan::with('kategori')
            ->whereHas('kategori', function($q) { $q->where('nama_kategori', 'UMB'); })
            ->where('status', 'aktif')->get();

        // Kirim ke view
        return view('sections.profil_perusahaan', compact(
            'profile', 'galeri', 'generalManager', 'marketings', 'sdms', 'accountings','supports','umbs'
        ));
    }
}
