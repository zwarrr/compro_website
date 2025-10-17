<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Client;
use App\Models\Karyawan;
use App\Models\Kontak;
use App\Models\Kategori;
use App\Models\Galeri;
use App\Models\Testimoni;
use App\Models\User;
use App\Models\ProfilePerusahaan;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics Data
        $statistics = [
            'layanan' => Layanan::count(),
            'client' => Client::count(),
            'karyawan' => Karyawan::count(),
            'kontak' => Kontak::count(),
            'kategori' => Kategori::count(),
            'galeri' => Galeri::count(),
            'testimoni' => Testimoni::count(),
            'user' => User::count(),
        ];

        // Data per Kategori
        $kategoris = Kategori::withCount(['layanan', 'galeri', 'karyawan'])->get();
        
        // Process kategori data with details
        $kategoriData = $kategoris->map(function ($kategori) {
            $dataCount = 0;
            $tipeLabel = '';
            $tipeColor = '';
            $tipeIcon = '';
            $routeUrl = '';
            
            switch ($kategori->tipe) {
                case 'layanan':
                    $dataCount = $kategori->layanan_count;
                    $tipeLabel = 'Layanan';
                    $tipeColor = 'blue';
                    $tipeIcon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>';
                    $routeUrl = route('admin.layanan.index');
                    break;
                case 'galeri':
                    $dataCount = $kategori->galeri_count;
                    $tipeLabel = 'Galeri';
                    $tipeColor = 'pink';
                    $tipeIcon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>';
                    $routeUrl = route('admin.galeri.index');
                    break;
                case 'karyawan':
                    $dataCount = $kategori->karyawan_count;
                    $tipeLabel = 'Karyawan';
                    $tipeColor = 'purple';
                    $tipeIcon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>';
                    $routeUrl = route('admin.karyawan.index');
                    break;
                case 'client':
                    $dataCount = $kategori->client_count ?? 0;
                    $tipeLabel = 'Klien';
                    $tipeColor = 'red';
                    $tipeIcon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>';
                    $routeUrl = route('admin.client.index');
                    break;
            }
            
            return [
                'kategori' => $kategori,
                'dataCount' => $dataCount,
                'tipeLabel' => $tipeLabel,
                'tipeColor' => $tipeColor,
                'tipeIcon' => $tipeIcon,
                'routeUrl' => $routeUrl,
            ];
        });

        // Data Distribution
        $totalLayanan = Layanan::count();
        $totalClient = Client::count();
        $totalKaryawan = Karyawan::count();
        $totalTestimoni = Testimoni::count();
        $totalGaleri = Galeri::count();
        $grandTotal = $totalLayanan + $totalClient + $totalKaryawan + $totalTestimoni + $totalGaleri;
        
        $dataDistribution = [
            ['label' => 'Layanan', 'count' => $totalLayanan, 'color' => 'bg-blue-500', 'border' => 'border-blue-500'],
            ['label' => 'Client', 'count' => $totalClient, 'color' => 'bg-green-500', 'border' => 'border-green-500'],
            ['label' => 'Karyawan', 'count' => $totalKaryawan, 'color' => 'bg-purple-500', 'border' => 'border-purple-500'],
            ['label' => 'Testimoni', 'count' => $totalTestimoni, 'color' => 'bg-orange-500', 'border' => 'border-orange-500'],
            ['label' => 'Galeri', 'count' => $totalGaleri, 'color' => 'bg-pink-500', 'border' => 'border-pink-500'],
        ];

        // Recent Activities
        $recentMessages = Kontak::latest()->take(3)->get();
        $recentTestimonials = Testimoni::latest()->take(3)->get();

        // Company Profile
        $companyProfile = ProfilePerusahaan::first();

        return view('admin.dashboard.index', compact(
            'statistics',
            'kategoriData',
            'dataDistribution',
            'grandTotal',
            'recentMessages',
            'recentTestimonials',
            'companyProfile'
        ));
    }

    public function getChartData(Request $request)
    {
        $type = $request->get('type', 'all'); // all, layanan, client, karyawan, testimoni, galeri
        $period = $request->get('period', 'daily'); // daily, weekly, monthly

        $labels = [];
        
        // If type is 'all', return multiple datasets
        if ($type === 'all') {
            $datasets = [
                'layanan' => ['label' => 'Layanan', 'color' => '#3B82F6', 'data' => []],
                'client' => ['label' => 'Client', 'color' => '#10B981', 'data' => []],
                'karyawan' => ['label' => 'Karyawan', 'color' => '#8B5CF6', 'data' => []],
                'testimoni' => ['label' => 'Testimoni', 'color' => '#F59E0B', 'data' => []],
                'galeri' => ['label' => 'Galeri', 'color' => '#EC4899', 'data' => []],
            ];

            if ($period === 'daily') {
                // Last 7 days
                for ($i = 6; $i >= 0; $i--) {
                    $date = now()->subDays($i);
                    $labels[] = $date->format('d M');
                    
                    $datasets['layanan']['data'][] = Layanan::whereDate('created_at', $date->toDateString())->count();
                    $datasets['client']['data'][] = Client::whereDate('created_at', $date->toDateString())->count();
                    $datasets['karyawan']['data'][] = Karyawan::whereDate('created_at', $date->toDateString())->count();
                    $datasets['testimoni']['data'][] = Testimoni::whereDate('created_at', $date->toDateString())->count();
                    $datasets['galeri']['data'][] = Galeri::whereDate('created_at', $date->toDateString())->count();
                }
            } elseif ($period === 'weekly') {
                // Last 8 weeks
                for ($i = 7; $i >= 0; $i--) {
                    $startOfWeek = now()->subWeeks($i)->startOfWeek();
                    $endOfWeek = now()->subWeeks($i)->endOfWeek();
                    $labels[] = 'Week ' . $startOfWeek->format('d M');
                    
                    $datasets['layanan']['data'][] = Layanan::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
                    $datasets['client']['data'][] = Client::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
                    $datasets['karyawan']['data'][] = Karyawan::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
                    $datasets['testimoni']['data'][] = Testimoni::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
                    $datasets['galeri']['data'][] = Galeri::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
                }
            } elseif ($period === 'monthly') {
                // Last 6 months
                for ($i = 5; $i >= 0; $i--) {
                    $date = now()->subMonths($i);
                    $labels[] = $date->format('M Y');
                    
                    $datasets['layanan']['data'][] = Layanan::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
                    $datasets['client']['data'][] = Client::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
                    $datasets['karyawan']['data'][] = Karyawan::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
                    $datasets['testimoni']['data'][] = Testimoni::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
                    $datasets['galeri']['data'][] = Galeri::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
                }
            }

            return response()->json([
                'labels' => $labels,
                'datasets' => array_values($datasets),
            ]);
        }

        // Single dataset for specific type
        $data = [];
        $model = match($type) {
            'layanan' => Layanan::class,
            'client' => Client::class,
            'karyawan' => Karyawan::class,
            'testimoni' => Testimoni::class,
            'galeri' => Galeri::class,
            default => Layanan::class,
        };

        if ($period === 'daily') {
            // Last 7 days
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $labels[] = $date->format('d M');
                $count = $model::whereDate('created_at', $date->toDateString())->count();
                $data[] = $count;
            }
        } elseif ($period === 'weekly') {
            // Last 8 weeks
            for ($i = 7; $i >= 0; $i--) {
                $startOfWeek = now()->subWeeks($i)->startOfWeek();
                $endOfWeek = now()->subWeeks($i)->endOfWeek();
                $labels[] = 'Week ' . $startOfWeek->format('d M');
                $count = $model::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
                $data[] = $count;
            }
        } elseif ($period === 'monthly') {
            // Last 6 months
            for ($i = 5; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $labels[] = $date->format('M Y');
                $count = $model::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
                $data[] = $count;
            }
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
