<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Karyawan;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karyawans = [
            [
                'kode_karyawan' => 'KAR-001',
                'kategori_id' => 11, // Management
                'nik' => '1234567890001',
                'nama' => 'Dr. Bambang Setiawan',
                'foto' => null,
                'deskripsi' => 'CEO dengan pengalaman 20+ tahun di industri teknologi. Memimpin perusahaan dengan visi inovasi dan pertumbuhan berkelanjutan.',
                'status' => 'aktif'
            ],
            [
                'kode_karyawan' => 'KAR-002',
                'kategori_id' => 11, // Management
                'nik' => '1234567890002',
                'nama' => 'Siti Nurhaliza',
                'foto' => null,
                'deskripsi' => 'CTO dengan expertise di cloud computing dan software architecture. Bertanggung jawab atas strategi teknologi perusahaan.',
                'status' => 'aktif'
            ],
            [
                'kode_karyawan' => 'KAR-003',
                'kategori_id' => 11, // Management
                'nik' => '1234567890003',
                'nama' => 'Ahmad Fauzi',
                'foto' => null,
                'deskripsi' => 'CFO yang berpengalaman dalam financial planning dan business strategy untuk perusahaan teknologi.',
                'status' => 'aktif'
            ],
            [
                'kode_karyawan' => 'KAR-004',
                'kategori_id' => 12, // Developer
                'nik' => '1234567890004',
                'nama' => 'Andi Pratama',
                'foto' => null,
                'deskripsi' => 'Senior Full Stack Developer dengan keahlian di React, Laravel, dan Node.js. 8 tahun pengalaman development.',
                'status' => 'aktif'
            ],
            [
                'kode_karyawan' => 'KAR-005',
                'kategori_id' => 12, // Developer
                'nik' => '1234567890005',
                'nama' => 'Dewi Lestari',
                'foto' => null,
                'deskripsi' => 'Mobile Developer specialist di Flutter dan React Native. Telah mengembangkan 50+ aplikasi mobile.',
                'status' => 'aktif'
            ],
            [
                'kode_karyawan' => 'KAR-006',
                'kategori_id' => 12, // Developer
                'nik' => '1234567890006',
                'nama' => 'Rudi Hermawan',
                'foto' => null,
                'deskripsi' => 'Backend Developer expert di microservices architecture dan database optimization.',
                'status' => 'aktif'
            ],
            [
                'kode_karyawan' => 'KAR-007',
                'kategori_id' => 12, // Developer
                'nik' => '1234567890007',
                'nama' => 'Linda Wijaya',
                'foto' => null,
                'deskripsi' => 'Frontend Developer dengan passion di UI implementation dan web performance optimization.',
                'status' => 'aktif'
            ],
            [
                'kode_karyawan' => 'KAR-008',
                'kategori_id' => 13, // Designer
                'nik' => '1234567890008',
                'nama' => 'Maya Kusuma',
                'foto' => null,
                'deskripsi' => 'Lead UI/UX Designer dengan 10+ tahun pengalaman. Expert dalam user research dan design thinking.',
                'status' => 'aktif'
            ],
            [
                'kode_karyawan' => 'KAR-009',
                'kategori_id' => 13, // Designer
                'nik' => '1234567890009',
                'nama' => 'Hendra Gunawan',
                'foto' => null,
                'deskripsi' => 'Graphic Designer specialist di branding dan visual communication. Portfolio mencakup 100+ brand.',
                'status' => 'aktif'
            ],
            [
                'kode_karyawan' => 'KAR-010',
                'kategori_id' => 13, // Designer
                'nik' => '1234567890010',
                'nama' => 'Rina Anggraini',
                'foto' => null,
                'deskripsi' => 'Motion Designer yang ahli dalam animation dan video editing untuk digital marketing.',
                'status' => 'aktif'
            ],
            [
                'kode_karyawan' => 'KAR-011',
                'kategori_id' => 14, // Marketing
                'nik' => '1234567890011',
                'nama' => 'Toni Wijaya',
                'foto' => null,
                'deskripsi' => 'Digital Marketing Manager dengan track record meningkatkan conversion rate hingga 300%.',
                'status' => 'aktif'
            ],
            [
                'kode_karyawan' => 'KAR-012',
                'kategori_id' => 14, // Marketing
                'nik' => '1234567890012',
                'nama' => 'Indah Permata',
                'foto' => null,
                'deskripsi' => 'Content Marketing Specialist yang expert dalam SEO dan content strategy.',
                'status' => 'aktif'
            ],
            [
                'kode_karyawan' => 'KAR-013',
                'kategori_id' => 14, // Marketing
                'nik' => '1234567890013',
                'nama' => 'Dedi Kurniawan',
                'foto' => null,
                'deskripsi' => 'Social Media Manager yang mengelola campaign dengan reach jutaan pengguna.',
                'status' => 'aktif'
            ],
            [
                'kode_karyawan' => 'KAR-014',
                'kategori_id' => 15, // Support
                'nik' => '1234567890014',
                'nama' => 'Nurul Hidayah',
                'foto' => null,
                'deskripsi' => 'Customer Support Lead dengan rating kepuasan pelanggan 98%. Menangani 500+ ticket per bulan.',
                'status' => 'aktif'
            ],
            [
                'kode_karyawan' => 'KAR-015',
                'kategori_id' => 15, // Support
                'nik' => '1234567890015',
                'nama' => 'Faisal Rahman',
                'foto' => null,
                'deskripsi' => 'Technical Support Engineer yang expert dalam troubleshooting dan system maintenance.',
                'status' => 'aktif'
            ],
        ];

        foreach ($karyawans as $karyawan) {
            Karyawan::create($karyawan);
        }
    }
}
