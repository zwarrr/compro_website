<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Galeri;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galeris = [
            [
                'kode_galeri' => 'GAL-001',
                'kategori_id' => 6, // Website Projects
                'judul' => 'E-Commerce Platform for Fashion Retail',
                'deskripsi' => 'Platform e-commerce modern dengan fitur lengkap termasuk payment gateway, shipping integration, dan analytics dashboard',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_galeri' => 'GAL-002',
                'kategori_id' => 6, // Website Projects
                'judul' => 'Corporate Website for Banking Industry',
                'deskripsi' => 'Website corporate banking dengan design premium dan fitur internet banking terintegrasi',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_galeri' => 'GAL-003',
                'kategori_id' => 7, // Mobile Apps
                'judul' => 'Food Delivery Mobile Application',
                'deskripsi' => 'Aplikasi mobile untuk layanan pesan antar makanan dengan real-time tracking dan multiple payment options',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_galeri' => 'GAL-004',
                'kategori_id' => 7, // Mobile Apps
                'judul' => 'Health & Fitness Tracker App',
                'deskripsi' => 'Aplikasi tracking kesehatan dengan fitur monitor aktivitas, kalori, dan konsultasi dokter online',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_galeri' => 'GAL-005',
                'kategori_id' => 8, // Design Works
                'judul' => 'Rebranding for Technology Startup',
                'deskripsi' => 'Complete rebranding package termasuk logo design, brand guidelines, dan marketing materials',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_galeri' => 'GAL-006',
                'kategori_id' => 8, // Design Works
                'judul' => 'UI/UX Design for Educational Platform',
                'deskripsi' => 'Design system dan user interface untuk platform pembelajaran online yang user-friendly',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_galeri' => 'GAL-007',
                'kategori_id' => 6, // Website Projects
                'judul' => 'Hotel Booking System',
                'deskripsi' => 'Sistem reservasi hotel online dengan manajemen kamar, pricing dinamis, dan customer review',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_galeri' => 'GAL-008',
                'kategori_id' => 7, // Mobile Apps
                'judul' => 'E-Learning Mobile Platform',
                'deskripsi' => 'Platform pembelajaran mobile dengan video courses, quiz interaktif, dan sertifikat digital',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_galeri' => 'GAL-009',
                'kategori_id' => 9, // Corporate Events
                'judul' => 'Annual Company Gathering 2024',
                'deskripsi' => 'Dokumentasi acara gathering perusahaan tahunan dengan berbagai kegiatan team building',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_galeri' => 'GAL-010',
                'kategori_id' => 9, // Corporate Events
                'judul' => 'Product Launch Event',
                'deskripsi' => 'Peluncuran produk baru dengan presentasi, demo, dan networking session',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_galeri' => 'GAL-011',
                'kategori_id' => 10, // Team Activities
                'judul' => 'Team Building Outbound',
                'deskripsi' => 'Kegiatan outbound team untuk meningkatkan kerjasama dan komunikasi antar tim',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_galeri' => 'GAL-012',
                'kategori_id' => 10, // Team Activities
                'judul' => 'Tech Workshop & Training',
                'deskripsi' => 'Workshop teknologi terbaru dan training untuk meningkatkan skill tim developer',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_galeri' => 'GAL-013',
                'kategori_id' => 6, // Website Projects
                'judul' => 'Real Estate Listing Portal',
                'deskripsi' => 'Portal properti dengan fitur pencarian advanced, virtual tour, dan mortgage calculator',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_galeri' => 'GAL-014',
                'kategori_id' => 7, // Mobile Apps
                'judul' => 'Transportation & Ride Sharing App',
                'deskripsi' => 'Aplikasi transportasi online dengan fitur ride sharing, real-time GPS, dan digital payment',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_galeri' => 'GAL-015',
                'kategori_id' => 8, // Design Works
                'judul' => 'Marketing Campaign Design',
                'deskripsi' => 'Design material untuk campaign marketing termasuk social media assets, banner, dan promotional video',
                'gambar' => null,
                'status' => 'aktif'
            ],
        ];

        foreach ($galeris as $galeri) {
            Galeri::create($galeri);
        }
    }
}
