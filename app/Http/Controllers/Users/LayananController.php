<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Faq;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display layanan data on landing page
     */
    public function layanan()
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
        
        return view('landing_page', compact('layanans', 'faqs', 'testimonis'));
    }
}
