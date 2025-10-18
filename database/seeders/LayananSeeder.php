<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanans = [
            [
                'kode_layanan' => 'LAY-001',
                'kategori_id' => 1, // Web Development
                'judul' => 'Custom Website Development',
                'slog' => 'Build Your Dream Website',
                'link' => 'custom-website-development',
                'deskripsi' => 'Layanan pengembangan website custom sesuai kebutuhan bisnis Anda dengan teknologi terkini seperti Laravel, React, dan Vue.js',
                'gambar' => null,
                'status' => 'publik'
            ],
            [
                'kode_layanan' => 'LAY-002',
                'kategori_id' => 1, // Web Development
                'judul' => 'E-Commerce Development',
                'slog' => 'Grow Your Online Store',
                'link' => 'ecommerce-development',
                'deskripsi' => 'Pengembangan toko online lengkap dengan payment gateway, shipping integration, inventory management, dan analytics',
                'gambar' => null,
                'status' => 'publik'
            ],
            [
                'kode_layanan' => 'LAY-003',
                'kategori_id' => 1, // Web Development
                'judul' => 'CMS Development',
                'slog' => 'Manage Content Easily',
                'link' => 'cms-development',
                'deskripsi' => 'Pengembangan Content Management System yang user-friendly untuk memudahkan pengelolaan konten website',
                'gambar' => null,
                'status' => 'publik'
            ],
            [
                'kode_layanan' => 'LAY-004',
                'kategori_id' => 2, // Mobile Development
                'judul' => 'iOS App Development',
                'slog' => 'Native iOS Experience',
                'link' => 'ios-app-development',
                'deskripsi' => 'Pengembangan aplikasi iOS native dengan Swift yang optimal untuk iPhone dan iPad',
                'gambar' => null,
                'status' => 'publik'
            ],
            [
                'kode_layanan' => 'LAY-005',
                'kategori_id' => 2, // Mobile Development
                'judul' => 'Android App Development',
                'slog' => 'Power of Android',
                'link' => 'android-app-development',
                'deskripsi' => 'Pengembangan aplikasi Android native dengan Kotlin untuk performa maksimal di berbagai device',
                'gambar' => null,
                'status' => 'publik'
            ],
            [
                'kode_layanan' => 'LAY-006',
                'kategori_id' => 2, // Mobile Development
                'judul' => 'Cross-Platform App Development',
                'slog' => 'One Code, Multiple Platforms',
                'link' => 'cross-platform-app',
                'deskripsi' => 'Pengembangan aplikasi mobile dengan Flutter atau React Native untuk iOS dan Android sekaligus',
                'gambar' => null,
                'status' => 'publik'
            ],
            [
                'kode_layanan' => 'LAY-007',
                'kategori_id' => 3, // UI/UX Design
                'judul' => 'UI/UX Design Services',
                'slog' => 'Design That Converts',
                'link' => 'uiux-design',
                'deskripsi' => 'Layanan design interface yang menarik dan user experience yang optimal berdasarkan research dan best practices',
                'gambar' => null,
                'status' => 'publik'
            ],
            [
                'kode_layanan' => 'LAY-008',
                'kategori_id' => 3, // UI/UX Design
                'judul' => 'Branding & Identity Design',
                'slog' => 'Build Your Brand',
                'link' => 'branding-design',
                'deskripsi' => 'Pembuatan brand identity lengkap termasuk logo, color scheme, typography, dan brand guidelines',
                'gambar' => null,
                'status' => 'publik'
            ],
            [
                'kode_layanan' => 'LAY-009',
                'kategori_id' => 3, // UI/UX Design
                'judul' => 'Prototype & Wireframing',
                'slog' => 'Visualize Before Build',
                'link' => 'prototype-wireframing',
                'deskripsi' => 'Pembuatan prototype interaktif dan wireframe untuk validasi konsep sebelum development',
                'gambar' => null,
                'status' => 'publik'
            ],
            [
                'kode_layanan' => 'LAY-010',
                'kategori_id' => 4, // Digital Marketing
                'judul' => 'SEO Optimization',
                'slog' => 'Rank Higher on Google',
                'link' => 'seo-optimization',
                'deskripsi' => 'Optimasi website untuk search engine dengan teknik SEO on-page dan off-page yang proven',
                'gambar' => null,
                'status' => 'publik'
            ],
            [
                'kode_layanan' => 'LAY-011',
                'kategori_id' => 4, // Digital Marketing
                'judul' => 'Social Media Marketing',
                'slog' => 'Engage Your Audience',
                'link' => 'social-media-marketing',
                'deskripsi' => 'Pengelolaan social media dan campaign marketing di berbagai platform untuk meningkatkan brand awareness',
                'gambar' => null,
                'status' => 'publik'
            ],
            [
                'kode_layanan' => 'LAY-012',
                'kategori_id' => 4, // Digital Marketing
                'judul' => 'Content Marketing',
                'slog' => 'Content is King',
                'link' => 'content-marketing',
                'deskripsi' => 'Pembuatan konten marketing yang engaging dan SEO-friendly untuk website, blog, dan social media',
                'gambar' => null,
                'status' => 'publik'
            ],
            [
                'kode_layanan' => 'LAY-013',
                'kategori_id' => 5, // Cloud Services
                'judul' => 'Cloud Migration',
                'slog' => 'Move to Cloud Seamlessly',
                'link' => 'cloud-migration',
                'deskripsi' => 'Layanan migrasi aplikasi dan data ke cloud platform seperti AWS, Google Cloud, atau Azure',
                'gambar' => null,
                'status' => 'publik'
            ],
            [
                'kode_layanan' => 'LAY-014',
                'kategori_id' => 5, // Cloud Services
                'judul' => 'DevOps Services',
                'slog' => 'Automate Your Workflow',
                'link' => 'devops-services',
                'deskripsi' => 'Implementasi CI/CD pipeline, containerization, dan automation untuk development workflow yang efisien',
                'gambar' => null,
                'status' => 'publik'
            ],
            [
                'kode_layanan' => 'LAY-015',
                'kategori_id' => 5, // Cloud Services
                'judul' => 'Cloud Infrastructure Management',
                'slog' => 'Manage Cloud with Ease',
                'link' => 'cloud-infrastructure',
                'deskripsi' => 'Pengelolaan infrastruktur cloud termasuk monitoring, scaling, security, dan cost optimization',
                'gambar' => null,
                'status' => 'publik'
            ],
        ];

        foreach ($layanans as $layanan) {
            Layanan::create($layanan);
        }
    }
}
