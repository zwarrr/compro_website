<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    /**
     * Menampilkan data Testimoni yang dipublikasikan
     */
    public function testimoni()
    {
        $testimonis = Testimoni::where('status', 'publik')
                               ->orderBy('created_at', 'desc')
                               ->get();
        
        return view('sections.testimonials', compact('testimonis'));
    }
}
