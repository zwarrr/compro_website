<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Kategori, Layanan, Galeri, Karyawan, Testimoni, Client, Kontak, Faq, SocialMedia};
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $query = $request->input('query', '');
            
            Log::info('Search query:', ['query' => $query]);
            
            if (strlen($query) < 2) {
                return response()->json([]);
            }

            $results = [];

            // Search Pages/Menu
            $pages = [
            ['title' => 'Dashboard', 'description' => 'Halaman utama admin', 'url' => '/admin/dashboard', 'icon' => 'dashboard', 'type' => 'page'],
            ['title' => 'User Management', 'description' => 'Kelola pengguna sistem', 'url' => '/admin/user', 'icon' => 'user', 'type' => 'page'],
            ['title' => 'Kategori', 'description' => 'Kelola kategori layanan', 'url' => '/admin/kategori', 'icon' => 'kategori', 'type' => 'page'],
            ['title' => 'Layanan', 'description' => 'Kelola layanan perusahaan', 'url' => '/admin/layanan', 'icon' => 'layanan', 'type' => 'page'],
            ['title' => 'Galeri', 'description' => 'Kelola galeri foto', 'url' => '/admin/galeri', 'icon' => 'galeri', 'type' => 'page'],
            ['title' => 'Karyawan', 'description' => 'Kelola data karyawan', 'url' => '/admin/karyawan', 'icon' => 'karyawan', 'type' => 'page'],
            ['title' => 'Client', 'description' => 'Kelola data client', 'url' => '/admin/client', 'icon' => 'client', 'type' => 'page'],
            ['title' => 'Testimoni', 'description' => 'Kelola testimoni', 'url' => '/admin/testimoni', 'icon' => 'testimoni', 'type' => 'page'],
            ['title' => 'FAQ', 'description' => 'Kelola pertanyaan umum', 'url' => '/admin/faq', 'icon' => 'faq', 'type' => 'page'],
            ['title' => 'Pesan', 'description' => 'Kelola pesan masuk', 'url' => '/admin/pesan', 'icon' => 'pesan', 'type' => 'page'],
            ['title' => 'Sosial Media', 'description' => 'Kelola sosial media', 'url' => '/admin/sosial', 'icon' => 'sosial', 'type' => 'page'],
            ['title' => 'Konfigurasi', 'description' => 'Pengaturan sistem', 'url' => '/admin/konfigurasi', 'icon' => 'konfigurasi', 'type' => 'page'],
            ];

            foreach ($pages as $page) {
                if (stripos($page['title'], $query) !== false || stripos($page['description'], $query) !== false) {
                    $results[] = $page;
                }
            }

            // Search Users
            $users = User::where('nama', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->limit(5)
                ->get();
            
            foreach ($users as $user) {
                $results[] = [
                    'title' => $user->nama,
                    'description' => $user->email,
                    'url' => '/admin/user/' . $user->id . '/edit',
                    'icon' => 'user',
                    'type' => 'user'
                ];
            }

            // Search Kategori
            $kategoris = Kategori::where('nama_kategori', 'like', "%{$query}%")
                ->limit(5)
                ->get();
            
            foreach ($kategoris as $kategori) {
                $results[] = [
                    'title' => $kategori->nama_kategori,
                    'description' => 'Kategori',
                    'url' => '/admin/kategori/' . $kategori->id_kategori . '/edit',
                    'icon' => 'kategori',
                    'type' => 'kategori'
                ];
            }

            // Search Layanan
            $layanans = Layanan::where('judul', 'like', "%{$query}%")
                ->orWhere('deskripsi', 'like', "%{$query}%")
                ->orWhere('slog', 'like', "%{$query}%")
                ->limit(5)
                ->get();
            
            foreach ($layanans as $layanan) {
                $results[] = [
                    'title' => $layanan->judul,
                    'description' => 'Layanan - ' . substr(strip_tags($layanan->deskripsi), 0, 50) . '...',
                    'url' => '/admin/layanan/' . $layanan->id_layanan . '/edit',
                    'icon' => 'layanan',
                    'type' => 'layanan'
                ];
            }

            // Search Karyawan
            $karyawans = Karyawan::where('nama', 'like', "%{$query}%")
                ->orWhere('deskripsi', 'like', "%{$query}%")
                ->limit(5)
                ->get();
            
            foreach ($karyawans as $karyawan) {
                $results[] = [
                    'title' => $karyawan->nama,
                    'description' => 'Karyawan - ' . substr(strip_tags($karyawan->deskripsi ?? ''), 0, 50),
                    'url' => '/admin/karyawan/' . $karyawan->id_karyawan . '/edit',
                    'icon' => 'karyawan',
                    'type' => 'karyawan'
                ];
            }

            // Search Client
            $clients = Client::where('nama_client', 'like', "%{$query}%")
                ->limit(5)
                ->get();
            
            foreach ($clients as $client) {
                $results[] = [
                    'title' => $client->nama_client,
                    'description' => 'Client',
                    'url' => '/admin/client/' . $client->id_client . '/edit',
                    'icon' => 'client',
                    'type' => 'client'
                ];
            }

            // Search Testimoni
            $testimonis = Testimoni::where('nama_testimoni', 'like', "%{$query}%")
                ->orWhere('pesan', 'like', "%{$query}%")
                ->orWhere('jabatan', 'like', "%{$query}%")
                ->limit(5)
                ->get();
            
            foreach ($testimonis as $testimoni) {
                $results[] = [
                    'title' => $testimoni->nama_testimoni,
                    'description' => 'Testimoni - ' . substr($testimoni->pesan, 0, 50) . '...',
                    'url' => '/admin/testimoni/' . $testimoni->id_testimoni . '/edit',
                    'icon' => 'testimoni',
                    'type' => 'testimoni'
                ];
            }

            // Search FAQ
            $faqs = Faq::where('pertanyaan', 'like', "%{$query}%")
                ->orWhere('jawaban', 'like', "%{$query}%")
                ->limit(5)
                ->get();
            
            foreach ($faqs as $faq) {
                $results[] = [
                    'title' => $faq->pertanyaan,
                    'description' => 'FAQ - ' . substr($faq->jawaban, 0, 50) . '...',
                    'url' => '/admin/faq/' . $faq->id . '/edit',
                    'icon' => 'faq',
                    'type' => 'faq'
                ];
            }

            // Search Pesan/Kontak
            $kontaks = Kontak::where('nama', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->orWhere('pesan', 'like', "%{$query}%")
                ->limit(5)
                ->get();
            
            foreach ($kontaks as $kontak) {
                $results[] = [
                    'title' => $kontak->nama,
                    'description' => 'Pesan dari ' . $kontak->email,
                    'url' => '/admin/pesan/' . $kontak->id_kontak,
                    'icon' => 'pesan',
                    'type' => 'pesan'
                ];
            }

            // Limit total results
            $results = array_slice($results, 0, 20);

            Log::info('Search results count:', ['count' => count($results)]);

            return response()->json($results);
            
        } catch (\Exception $e) {
            Log::error('Search error:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Terjadi kesalahan saat pencarian'], 500);
        }
    }
}
