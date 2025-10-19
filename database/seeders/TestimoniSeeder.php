<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimoni;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonis = [
            [
                'kode_testimoni' => 'TES-001',
                'nama_testimoni' => 'Dr. Bambang Sutrisno',
                'jabatan' => 'CEO PT Maju Bersama',
                'pesan' => 'Pelayanan sangat profesional dan hasil website melebihi ekspektasi. Tim sangat responsif dan memahami kebutuhan bisnis kami.',
                'foto' => null,
                'rating' => 5,
                'status' => 'publik'
            ],
            [
                'kode_testimoni' => 'TES-002',
                'nama_testimoni' => 'Siti Rahmawati',
                'jabatan' => 'Marketing Manager PT Sejahtera',
                'pesan' => 'Kerjasama yang sangat menyenangkan. Website kami sekarang lebih modern dan user-friendly. Terima kasih!',
                'foto' => null,
                'rating' => 5,
                'status' => 'publik'
            ],
            [
                'kode_testimoni' => 'TES-003',
                'nama_testimoni' => 'Agus Prasetyo',
                'jabatan' => 'Owner Toko Online FashionKu',
                'pesan' => 'Platform e-commerce yang dibuat sangat membantu meningkatkan penjualan. Fitur-fiturnya lengkap dan mudah digunakan.',
                'foto' => null,
                'rating' => 5,
                'status' => 'publik'
            ],
            [
                'kode_testimoni' => 'TES-004',
                'nama_testimoni' => 'Linda Wijaya',
                'jabatan' => 'Direktur Yayasan Pendidikan Harapan',
                'pesan' => 'Website sekolah kami jadi lebih informatif dan menarik. Orang tua murid sangat terbantu dengan sistem informasi online.',
                'foto' => null,
                'rating' => 5,
                'status' => 'publik'
            ],
            [
                'kode_testimoni' => 'TES-005',
                'nama_testimoni' => 'Hendra Gunawan',
                'jabatan' => 'Founder Startup TechnoID',
                'pesan' => 'Tim developer sangat kompeten. Mereka berhasil mengimplementasikan fitur kompleks dengan baik dan tepat waktu.',
                'foto' => null,
                'rating' => 5,
                'status' => 'publik'
            ],
            [
                'kode_testimoni' => 'TES-006',
                'nama_testimoni' => 'Dewi Kusuma',
                'jabatan' => 'HR Manager PT Global Solutions',
                'pesan' => 'Sistem HRIS yang dibuat sangat memudahkan pekerjaan HR. Interface-nya intuitif dan fiturnya sesuai kebutuhan.',
                'foto' => null,
                'rating' => 4,
                'status' => 'publik'
            ],
            [
                'kode_testimoni' => 'TES-007',
                'nama_testimoni' => 'Rudi Hartono',
                'jabatan' => 'General Manager Hotel Santika',
                'pesan' => 'Website booking hotel kami sekarang lebih profesional. Pengunjung website meningkat signifikan setelah redesign.',
                'foto' => null,
                'rating' => 5,
                'status' => 'publik'
            ],
            [
                'kode_testimoni' => 'TES-008',
                'nama_testimoni' => 'Maya Sari',
                'jabatan' => 'Pemilik Kafe Kopi Nusantara',
                'pesan' => 'Website dan aplikasi mobile untuk orderan sangat membantu bisnis kami. Pelanggan jadi lebih mudah memesan.',
                'foto' => null,
                'rating' => 5,
                'status' => 'publik'
            ],
            [
                'kode_testimoni' => 'TES-009',
                'nama_testimoni' => 'Andi Firmansyah',
                'jabatan' => 'IT Manager Bank Mandiri Cabang Jakarta',
                'pesan' => 'Maintenance dan support yang diberikan sangat memuaskan. Response time cepat dan solusi yang diberikan efektif.',
                'foto' => null,
                'rating' => 5,
                'status' => 'publik'
            ],
            [
                'kode_testimoni' => 'TES-010',
                'nama_testimoni' => 'Rina Anggraini',
                'jabatan' => 'Owner Butik Fashion Trendy',
                'pesan' => 'Design website sangat cantik dan sesuai dengan brand image kami. Tim designer sangat kreatif!',
                'foto' => null,
                'rating' => 5,
                'status' => 'publik'
            ],
            [
                'kode_testimoni' => 'TES-011',
                'nama_testimoni' => 'Toni Wijaya',
                'jabatan' => 'Direktur PT Logistik Indonesia',
                'pesan' => 'Sistem tracking pengiriman yang dibuat sangat membantu operasional perusahaan. Akurat dan real-time.',
                'foto' => null,
                'rating' => 4,
                'status' => 'publik'
            ],
            [
                'kode_testimoni' => 'TES-012',
                'nama_testimoni' => 'Indah Permatasari',
                'jabatan' => 'Kepala Sekolah SMK Teknologi',
                'pesan' => 'Aplikasi e-learning yang dikembangkan sangat membantu proses belajar mengajar online. User-friendly untuk siswa dan guru.',
                'foto' => null,
                'rating' => 5,
                'status' => 'publik'
            ],
            [
                'kode_testimoni' => 'TES-013',
                'nama_testimoni' => 'Dedi Kurniawan',
                'jabatan' => 'Owner Restoran Padang Sederhana',
                'pesan' => 'Sistem POS yang dibuat sangat memudahkan pencatatan transaksi dan inventory. Laporan keuangan jadi lebih rapi.',
                'foto' => null,
                'rating' => 5,
                'status' => 'publik'
            ],
            [
                'kode_testimoni' => 'TES-014',
                'nama_testimoni' => 'Nurul Hidayah',
                'jabatan' => 'Marketing Director PT Kosmetik Natural',
                'pesan' => 'Digital marketing campaign yang dijalankan sangat efektif. Traffic website dan penjualan meningkat drastis!',
                'foto' => null,
                'rating' => 5,
                'status' => 'publik'
            ],
            [
                'kode_testimoni' => 'TES-015',
                'nama_testimoni' => 'Faisal Rahman',
                'jabatan' => 'CEO PT Property Nusantara',
                'pesan' => 'Website property listing yang dibuat sangat profesional. Fitur pencarian dan filter sangat memudahkan calon pembeli.',
                'foto' => null,
                'rating' => 5,
                'status' => 'publik'
            ],
        ];

        foreach ($testimonis as $testimoni) {
            Testimoni::create($testimoni);
        }
    }
}
