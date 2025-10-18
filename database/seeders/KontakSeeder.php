<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kontak;

class KontakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kontaks = [
            [
                'kode_kontak' => 'KON-001',
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@gmail.com',
                'subjek' => 'Inquiry Web Development',
                'pesan' => 'Saya tertarik untuk membuat website company profile untuk perusahaan saya. Mohon info lebih lanjut mengenai harga dan timeline pengerjaan.',
                'status_baca' => 'belum',
                'created_at' => now()->subDays(15),
            ],
            [
                'kode_kontak' => 'KON-002',
                'nama' => 'Siti Nurhaliza',
                'email' => 'siti.nur@yahoo.com',
                'subjek' => 'Mobile App Development',
                'pesan' => 'Perusahaan kami membutuhkan aplikasi mobile untuk e-commerce. Apakah bisa konsultasi lebih detail?',
                'status_baca' => 'sudah',
                'created_at' => now()->subDays(14),
            ],
            [
                'kode_kontak' => 'KON-003',
                'nama' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@hotmail.com',
                'subjek' => 'UI/UX Design Services',
                'pesan' => 'Kami ingin melakukan redesign aplikasi mobile kami. Berapa estimasi waktu dan biayanya?',
                'status_baca' => 'sudah',
                'created_at' => now()->subDays(13),
            ],
            [
                'kode_kontak' => 'KON-004',
                'nama' => 'Dewi Lestari',
                'email' => 'dewi.lestari@gmail.com',
                'subjek' => 'Digital Marketing Package',
                'pesan' => 'Saya tertarik dengan paket digital marketing untuk meningkatkan brand awareness. Mohon info paket yang tersedia.',
                'status_baca' => 'belum',
                'created_at' => now()->subDays(12),
            ],
            [
                'kode_kontak' => 'KON-005',
                'nama' => 'Rudi Hartono',
                'email' => 'rudi.hartono@outlook.com',
                'subjek' => 'Cloud Migration Services',
                'pesan' => 'Kami berencana migrasi server ke cloud. Apakah ada paket maintenance juga?',
                'status_baca' => 'sudah',
                'created_at' => now()->subDays(11),
            ],
            [
                'kode_kontak' => 'KON-006',
                'nama' => 'Maya Kusuma',
                'email' => 'maya.kusuma@gmail.com',
                'subjek' => 'E-Commerce Development',
                'pesan' => 'Saya ingin membuat toko online untuk bisnis fashion saya. Apa saja fitur yang termasuk dalam paket basic?',
                'status_baca' => 'belum',
                'created_at' => now()->subDays(10),
            ],
            [
                'kode_kontak' => 'KON-007',
                'nama' => 'Hendra Gunawan',
                'email' => 'hendra.g@yahoo.co.id',
                'subjek' => 'Website Maintenance',
                'pesan' => 'Website perusahaan kami butuh maintenance rutin. Apakah ada paket bulanan?',
                'status_baca' => 'sudah',
                'created_at' => now()->subDays(9),
            ],
            [
                'kode_kontak' => 'KON-008',
                'nama' => 'Rina Anggraini',
                'email' => 'rina.anggraini@gmail.com',
                'subjek' => 'SEO Optimization',
                'pesan' => 'Website saya traffic-nya rendah. Apakah bisa dibantu untuk optimasi SEO?',
                'status_baca' => 'belum',
                'created_at' => now()->subDays(8),
            ],
            [
                'kode_kontak' => 'KON-009',
                'nama' => 'Toni Setiawan',
                'email' => 'toni.setiawan@hotmail.com',
                'subjek' => 'Corporate Website',
                'pesan' => 'Kami butuh website corporate yang profesional dengan design modern. Berapa lama pengerjaannya?',
                'status_baca' => 'sudah',
                'created_at' => now()->subDays(7),
            ],
            [
                'kode_kontak' => 'KON-010',
                'nama' => 'Indah Permata',
                'email' => 'indah.permata@gmail.com',
                'subjek' => 'Social Media Management',
                'pesan' => 'Apakah tersedia layanan pengelolaan social media? Mohon info harga dan benefit-nya.',
                'status_baca' => 'belum',
                'created_at' => now()->subDays(6),
            ],
            [
                'kode_kontak' => 'KON-011',
                'nama' => 'Dedi Kurniawan',
                'email' => 'dedi.kurniawan@yahoo.com',
                'subjek' => 'Custom Software Development',
                'pesan' => 'Perusahaan kami butuh software custom untuk inventory management. Bisa diskusi?',
                'status_baca' => 'sudah',
                'created_at' => now()->subDays(5),
            ],
            [
                'kode_kontak' => 'KON-012',
                'nama' => 'Nurul Hidayah',
                'email' => 'nurul.hidayah@gmail.com',
                'subjek' => 'Landing Page Design',
                'pesan' => 'Saya butuh landing page untuk campaign product launching. Apakah bisa selesai dalam 2 minggu?',
                'status_baca' => 'belum',
                'created_at' => now()->subDays(4),
            ],
            [
                'kode_kontak' => 'KON-013',
                'nama' => 'Faisal Rahman',
                'email' => 'faisal.rahman@outlook.com',
                'subjek' => 'API Integration',
                'pesan' => 'Kami perlu integrasi API payment gateway dan shipping. Apakah ada pengalaman dengan layanan ini?',
                'status_baca' => 'sudah',
                'created_at' => now()->subDays(3),
            ],
            [
                'kode_kontak' => 'KON-014',
                'nama' => 'Linda Wijaya',
                'email' => 'linda.wijaya@gmail.com',
                'subjek' => 'Branding Package',
                'pesan' => 'Startup saya butuh branding dari nol. Apakah ada paket yang include logo, brand guidelines, dan website?',
                'status_baca' => 'belum',
                'created_at' => now()->subDays(2),
            ],
            [
                'kode_kontak' => 'KON-015',
                'nama' => 'Andi Pratama',
                'email' => 'andi.pratama@yahoo.co.id',
                'subjek' => 'Partnership Opportunity',
                'pesan' => 'Saya tertarik untuk kerjasama partnership dalam project-project web development. Bisa diskusi lebih lanjut?',
                'status_baca' => 'belum',
                'created_at' => now()->subDays(1),
            ],
        ];

        foreach ($kontaks as $kontak) {
            Kontak::create($kontak);
        }
    }
}
