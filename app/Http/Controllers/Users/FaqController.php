<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Layanan;
use App\Models\Testimoni;
use App\Models\Galeri;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Menampilkan data FAQ yang dipublikasikan
     */
    public function faq()
    {
        $layanans = Layanan::with('kategori')
                           ->where('status', 'publik')
                           ->latest()
                           ->get();
        
        $faqs = Faq::where('status', 'publik')
                   ->orderBy('created_at', 'asc')
                   ->get();
        
        $testimonis = Testimoni::where('status', 'publik')
                               ->orderBy('created_at', 'desc')
                               ->get();
        
        $galeris = Galeri::where('status', 'publik')
                         ->latest()
                         ->get();
        
        return view('landing_page', compact('layanans', 'faqs', 'testimonis', 'galeris'));
    }
}
