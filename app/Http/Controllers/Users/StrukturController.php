<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    // General Manager
    public function generalManager()
    {
        $generalManager = \App\Models\Karyawan::with('kategori')
            ->whereHas('kategori', function($q) {
                $q->where('nama_kategori', 'General Manager');
            })
            ->where('status', 'aktif')
            ->orderByRaw('ISNULL(posisi), posisi ASC, id_karyawan ASC')
            ->first();
        return $generalManager;
    }

    // Director
    public function directors()
    {
        $directors = \App\Models\Karyawan::with('kategori')
            ->whereHas('kategori', function($q) {
                $q->where('nama_kategori', 'Director');
            })
            ->where('status', 'aktif')
            ->orderByRaw('ISNULL(posisi), posisi ASC, id_karyawan ASC')
            ->get();
        return $directors;
    }

    // Manager
    public function managers()
    {
        $managers = \App\Models\Karyawan::with('kategori')
            ->whereHas('kategori', function($q) {
                $q->where('nama_kategori', 'Manager');
            })
            ->where('status', 'aktif')
            ->orderByRaw('ISNULL(posisi), posisi ASC, id_karyawan ASC')
            ->get();
        return $managers;
    }

    // Team
    public function teams()
    {
        $teams = \App\Models\Karyawan::with('kategori')
            ->whereHas('kategori', function($q) {
                $q->where('nama_kategori', 'Team');
            })
            ->where('status', 'aktif')
            ->orderByRaw('ISNULL(posisi), posisi ASC, id_karyawan ASC')
            ->get();
        return $teams;
    }

    // Struktur Organisasi View
    public function struktur()
    {
        $generalManager = $this->generalManager();
        $directors = $this->directors();
        $managers = $this->managers();
        $teams = $this->teams();
        return view('sections.profil_perusahaan', compact('generalManager', 'directors', 'managers', 'teams'));
    }
}
