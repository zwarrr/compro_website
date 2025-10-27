<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function leftContent()
    {
        // Ambil data page dengan kode_page tertentu (hardcode)
        $kode = 'PAGE008'; // ganti sesuai kebutuhan
        $page = \App\Models\Page::where('kode_page', $kode)->where('status', 'public')->first();
        return view('landing_page', compact('page'));
    }
}
