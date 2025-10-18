<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Menampilkan data FAQ yang dipublikasikan
     */
    public function faq()
    {
        $faqs = Faq::where('status', 'publik')->orderBy('created_at', 'asc')->get();
        
        return view('sections.faq', compact('faqs'));
    }
}
