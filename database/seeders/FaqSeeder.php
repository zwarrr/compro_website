<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'kode_faq' => 'FAQ-001',
                'pertanyaan' => 'Apa layanan utama yang ditawarkan perusahaan?',
                'jawaban' => 'Kami menawarkan berbagai layanan termasuk web development, mobile development, UI/UX design, digital marketing, dan cloud services untuk membantu bisnis Anda berkembang di era digital.',
                'status' => 'publik'
            ],
            [
                'kode_faq' => 'FAQ-002',
                'pertanyaan' => 'Berapa lama waktu yang dibutuhkan untuk menyelesaikan proyek website?',
                'jawaban' => 'Waktu penyelesaian proyek website bervariasi tergantung kompleksitas, biasanya berkisar antara 2-8 minggu. Kami akan memberikan timeline detail setelah diskusi requirement.',
                'status' => 'publik'
            ],
            [
                'kode_faq' => 'FAQ-003',
                'pertanyaan' => 'Apakah ada garansi untuk layanan yang diberikan?',
                'jawaban' => 'Ya, kami memberikan garansi maintenance selama 3 bulan setelah project selesai untuk memastikan semuanya berjalan dengan baik.',
                'status' => 'publik'
            ],
            [
                'kode_faq' => 'FAQ-004',
                'pertanyaan' => 'Bagaimana cara menghubungi tim support?',
                'jawaban' => 'Anda dapat menghubungi tim support kami melalui email, telepon, atau WhatsApp yang tertera di halaman kontak. Tim kami siap membantu Anda pada hari kerja jam 08.00-17.00 WIB.',
                'status' => 'publik'
            ],
            [
                'kode_faq' => 'FAQ-005',
                'pertanyaan' => 'Apakah menerima klien dari luar kota?',
                'jawaban' => 'Ya, kami melayani klien dari seluruh Indonesia. Semua komunikasi dan koordinasi dapat dilakukan secara online melalui meeting virtual.',
                'status' => 'publik'
            ],
            [
                'kode_faq' => 'FAQ-006',
                'pertanyaan' => 'Metode pembayaran apa yang diterima?',
                'jawaban' => 'Kami menerima pembayaran melalui transfer bank, e-wallet, dan virtual account. Sistem pembayaran bertahap juga tersedia untuk proyek besar.',
                'status' => 'publik'
            ],
            [
                'kode_faq' => 'FAQ-007',
                'pertanyaan' => 'Apakah menyediakan layanan maintenance website?',
                'jawaban' => 'Ya, kami menyediakan paket maintenance bulanan atau tahunan yang mencakup update konten, security updates, dan technical support.',
                'status' => 'publik'
            ],
            [
                'kode_faq' => 'FAQ-008',
                'pertanyaan' => 'Bagaimana proses pengerjaan proyek dilakukan?',
                'jawaban' => 'Proses dimulai dari konsultasi, planning, design, development, testing, hingga deployment. Anda akan mendapat update progress secara berkala.',
                'status' => 'publik'
            ],
            [
                'kode_faq' => 'FAQ-009',
                'pertanyaan' => 'Apakah bisa request fitur custom sesuai kebutuhan?',
                'jawaban' => 'Tentu saja! Kami mengembangkan solusi custom yang disesuaikan dengan kebutuhan spesifik bisnis Anda.',
                'status' => 'publik'
            ],
            [
                'kode_faq' => 'FAQ-010',
                'pertanyaan' => 'Apakah website yang dibuat mobile-friendly?',
                'jawaban' => 'Ya, semua website yang kami buat menggunakan responsive design sehingga tampil optimal di semua perangkat (desktop, tablet, dan mobile).',
                'status' => 'publik'
            ],
            [
                'kode_faq' => 'FAQ-011',
                'pertanyaan' => 'Apakah ada paket bundling untuk beberapa layanan?',
                'jawaban' => 'Ya, kami menawarkan paket bundling dengan harga spesial untuk kombinasi beberapa layanan seperti web development + digital marketing.',
                'status' => 'publik'
            ],
            [
                'kode_faq' => 'FAQ-012',
                'pertanyaan' => 'Berapa estimasi biaya untuk membuat website company profile?',
                'jawaban' => 'Biaya bervariasi mulai dari 5 juta hingga 50 juta tergantung fitur dan kompleksitas. Silakan hubungi kami untuk mendapatkan quotation detail.',
                'status' => 'publik'
            ],
            [
                'kode_faq' => 'FAQ-013',
                'pertanyaan' => 'Apakah menyediakan training untuk penggunaan website?',
                'jawaban' => 'Ya, kami menyediakan training dan dokumentasi lengkap agar tim Anda dapat mengelola website dengan mudah.',
                'status' => 'publik'
            ],
            [
                'kode_faq' => 'FAQ-014',
                'pertanyaan' => 'Apakah website dilengkapi dengan SEO optimization?',
                'jawaban' => 'Ya, semua website yang kami buat sudah dioptimasi untuk SEO basic. Untuk SEO advanced, tersedia sebagai layanan tambahan.',
                'status' => 'publik'
            ],
            [
                'kode_faq' => 'FAQ-015',
                'pertanyaan' => 'Bagaimana jika ada bug setelah website live?',
                'jawaban' => 'Selama masa garansi, kami akan memperbaiki bug tanpa biaya tambahan. Setelah masa garansi, perbaikan dapat dilakukan dengan biaya maintenance.',
                'status' => 'publik'
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
