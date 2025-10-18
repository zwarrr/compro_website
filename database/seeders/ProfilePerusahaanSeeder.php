<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProfilePerusahaan;

class ProfilePerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfilePerusahaan::create([
            'kode_profile' => 'PROF-001',
            'nama_perusahaan' => 'PT Compro Digital Indonesia',
            'slogan' => 'Your Trusted Digital Partner',
            'deskripsi' => 'PT Compro Digital Indonesia adalah perusahaan teknologi yang berfokus pada pengembangan solusi digital untuk berbagai industri. Dengan tim profesional yang berpengalaman lebih dari 10 tahun, kami berkomitmen memberikan layanan terbaik dalam web development, mobile development, UI/UX design, digital marketing, dan cloud services.',
            'visi' => 'Menjadi perusahaan teknologi terdepan di Indonesia yang memberikan solusi digital inovatif dan berkualitas tinggi untuk membantu bisnis bertransformasi di era digital.',
            'misi' => "1. Mengembangkan solusi teknologi yang inovatif dan user-friendly\n2. Memberikan pelayanan terbaik kepada klien dengan fokus pada kepuasan pelanggan\n3. Terus berinovasi dan mengadopsi teknologi terbaru\n4. Membangun tim profesional yang kompeten dan passionate\n5. Berkontribusi pada kemajuan industri teknologi di Indonesia",
            'alamat' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220',
            'telepon' => '021-12345678',
            'email' => 'info@comprodigital.co.id',
        ]);
    }
}
