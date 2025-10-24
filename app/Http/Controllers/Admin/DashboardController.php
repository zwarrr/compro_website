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

        // Data per Kategori dengan jumlah layanan (5 kategori terbanyak)
        $kategoriData = Kategori::withCount('layanan')
            ->orderBy('layanan_count', 'desc')
            ->take(5)
            ->get();

        // Fallback: jika tidak ada data kategori atau semua count 0
        if ($kategoriData->isEmpty() || $kategoriData->pluck('layanan_count')->sum() == 0) {
            $kategoriData = collect([
                (object)['nama' => 'Web Development', 'layanan_count' => 5],
                (object)['nama' => 'Mobile App', 'layanan_count' => 3],
                (object)['nama' => 'Design', 'layanan_count' => 2],
                (object)['nama' => 'Consulting', 'layanan_count' => 1],
                (object)['nama' => 'SEO', 'layanan_count' => 1],
            ]);
        }

        // Data untuk chart pie - Layanan per Kategori
        $pieChartData = [
            'kategori' => [
                'labels' => $kategoriData->pluck('nama')->map(function($name) {
                    return $name ?: 'Tidak Ada Data';
                })->toArray(),
                'data' => $kategoriData->pluck('layanan_count')->toArray()
            ],
            'layanan' => [
                'labels' => ['Web Development', 'Mobile App', 'Design', 'Consulting', 'SEO'],
                'data' => [22, 29, 22, 15, 12] // Persentase dalam jumlah
            ],
            'client' => [
                'labels' => ['Active', 'Pending', 'Completed'],
                'data' => [37, 37, 26] // Persentase dalam jumlah
            ],
            'testimoni' => $this->getTestimoniRatingData()
        ];

        // Recent Messages (5 terbaru)
        $recentMessages = Kontak::latest()->take(5)->get();

        // Recent Testimonials (3 terbaru)
        $recentTestimonials = Testimoni::latest()->take(3)->get();

        // Company Profile
        $companyProfile = ProfilePerusahaan::first();

        return view('vlte3.dashboard.index', compact(
            'statistics',
            'kategoriData',
            'pieChartData',
            'recentMessages',
            'recentTestimonials',
            'companyProfile'
        ));
    }

    /**
     * Get testimoni rating distribution data
     */
    private function getTestimoniRatingData()
    {
        $ratings = Testimoni::selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->orderBy('rating', 'desc')
            ->get();

        // Jika tidak ada data testimoni, beri data dummy
        if ($ratings->isEmpty()) {
            return [
                'labels' => ['⭐⭐⭐⭐⭐', '⭐⭐⭐⭐', '⭐⭐⭐', '⭐⭐', '⭐'],
                'data' => [10, 8, 5, 2, 1]
            ];
        }

        $labels = [];
        $data = [];

        // Generate data untuk semua rating 1-5
        for ($i = 5; $i >= 1; $i--) {
            $ratingData = $ratings->firstWhere('rating', $i);
            $labels[] = str_repeat('⭐', $i);
            $data[] = $ratingData ? $ratingData->count : 0;
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    public function chartData(Request $request)
    {
        $type = $request->get('type', 'all');
        $period = $request->get('period', 'daily');

        try {
            if ($type === 'all') {
                // Return multiple datasets for all types
                $datasets = [
                    [
                        'label' => 'Layanan',
                        'data' => $this->getDataByPeriod('layanan', $period),
                        'color' => '#3B82F6'
                    ],
                    [
                        'label' => 'Client',
                        'data' => $this->getDataByPeriod('client', $period),
                        'color' => '#10B981'
                    ],
                    [
                        'label' => 'Karyawan',
                        'data' => $this->getDataByPeriod('karyawan', $period),
                        'color' => '#8B5CF6'
                    ],
                    [
                        'label' => 'Testimoni',
                        'data' => $this->getDataByPeriod('testimoni', $period),
                        'color' => '#F59E0B'
                    ]
                ];

                return response()->json([
                    'labels' => $this->getLabels($period),
                    'datasets' => $datasets
                ]);
            } else {
                // Return single dataset for specific type
                return response()->json([
                    'labels' => $this->getLabels($period),
                    'data' => $this->getDataByPeriod($type, $period)
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                'data' => [10, 15, 12, 18, 22, 25]
            ]);
        }
    }

    private function getDataByPeriod($type, $period)
    {
        // Get model class based on type
        $modelClass = $this->getModelClass($type);
        
        if (!$modelClass) {
            return array_fill(0, 7, 0);
        }

        $data = [];
        $count = 7;

        for ($i = $count - 1; $i >= 0; $i--) {
            switch ($period) {
                case 'daily':
                    $data[] = $modelClass::whereDate('created_at', now()->subDays($i))->count();
                    break;
                case 'weekly':
                    $startOfWeek = now()->subWeeks($i)->startOfWeek();
                    $endOfWeek = now()->subWeeks($i)->endOfWeek();
                    $data[] = $modelClass::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
                    break;
                case 'monthly':
                    $data[] = $modelClass::whereMonth('created_at', now()->subMonths($i)->month)
                                       ->whereYear('created_at', now()->subMonths($i)->year)
                                       ->count();
                    break;
            }
        }

        return $data;
    }

    private function getLabels($period)
    {
        $labels = [];
        $count = 7;

        for ($i = $count - 1; $i >= 0; $i--) {
            switch ($period) {
                case 'daily':
                    $labels[] = now()->subDays($i)->format('M d');
                    break;
                case 'weekly':
                    $labels[] = 'Week ' . now()->subWeeks($i)->weekOfYear;
                    break;
                case 'monthly':
                    $labels[] = now()->subMonths($i)->format('M Y');
                    break;
            }
        }

        return $labels;
    }

    private function getModelClass($type)
    {
        switch ($type) {
            case 'layanan':
                return Layanan::class;
            case 'client':
                return Client::class;
            case 'karyawan':
                return Karyawan::class;
            case 'testimoni':
                return Testimoni::class;
            case 'galeri':
                return Galeri::class;
            default:
                return null;
        }
    }
}