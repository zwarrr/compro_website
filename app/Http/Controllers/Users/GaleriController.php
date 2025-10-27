<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Menampilkan data Galeri yang dipublikasikan
     */
    public function galeri()
    {
        $galeris = Galeri::where('status', 'aktif')
            ->latest()
            ->get();

        // untuk galeri sections
        $kode = 'galeri'; // ganti sesuai kebutuhan
        $galeri = \App\Models\Page::where('digunakan_untuk', $kode)->where('status', 'public')->first();

        return view('sections.galeri', compact('galeris','galeri'));
    }
}
