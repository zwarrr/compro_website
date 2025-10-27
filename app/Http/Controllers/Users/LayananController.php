<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Faq;
use App\Models\Features;
use App\Models\Testimoni;
use App\Models\Galeri;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display layanan data on landing page
     */
    public function layanan()
    {
        // Gradient colors for cards
        $gradients = [
            'from-blue-400 to-blue-600',
            'from-purple-400 to-purple-600',
            'from-pink-400 to-pink-600',
            'from-green-400 to-green-600',
            'from-yellow-400 to-yellow-600',
            'from-indigo-400 to-indigo-600',
        ];

        // Color schemes for badges
        $colorSchemes = [
            ['bg' => 'blue', 'text' => 'blue'],
            ['bg' => 'purple', 'text' => 'purple'],
            ['bg' => 'pink', 'text' => 'pink'],
            ['bg' => 'green', 'text' => 'green'],
            ['bg' => 'yellow', 'text' => 'yellow'],
            ['bg' => 'indigo', 'text' => 'indigo'],
        ];

        // Fetch data
        $layanans = Layanan::with('kategori')->where('status', 'publik')->latest()->get();
        $faqs = Faq::where('status', 'publik')->orderBy('created_at', 'asc')->get();
        $testimonis = Testimoni::where('status', 'publik')->orderBy('created_at', 'desc')->get();
        $galeris = Galeri::where('status', 'publik')->latest()->get();
        // Ambil semua loker dengan status aktif
        $fiturs = Features::where('status', 'public')
            ->orderBy('created_at', 'desc')
            ->get();

        // untuk hero sections
        $kode = 'hero'; // ganti sesuai kebutuhan
        $page = \App\Models\Page::where('digunakan_untuk', $kode)->where('status', 'public')->first();

        // untuk features sections
        $kode = 'features'; // ganti sesuai kebutuhan
        $features = \App\Models\Page::where('digunakan_untuk', $kode)->where('status', 'public')->first();

        // untuk client sections
        $kode = 'client'; // ganti sesuai kebutuhan
        $client = \App\Models\Page::where('digunakan_untuk', $kode)->where('status', 'public')->first();

        // untuk faq sections
        $kode = 'faq'; // ganti sesuai kebutuhan
        $faq = \App\Models\Page::where('digunakan_untuk', $kode)->where('status', 'public')->first();

        // untuk testimoni sections
        $kode = 'testimoni'; // ganti sesuai kebutuhan
        $testimoni = \App\Models\Page::where('digunakan_untuk', $kode)->where('status', 'public')->first();

        return view('landing_page', compact('page','features','client','faq','testimoni','layanans', 'faqs', 'testimonis', 'galeris', 'gradients', 'colorSchemes','fiturs'));
    }
}
