<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengetahuan;

class PengetahuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengetahuanData = [
            // Kategori: Tentang TMS
            [
                'kode_pengetahuan' => 'KB-001',
                'kategori_pertanyaan' => 'Tentang TMS',
                'sub_kategori' => 'Profil Perusahaan',
                'jawaban' => 'Technology Multi Sistem (TMS) adalah perusahaan teknologi terkemuka yang didirikan pada tahun 2005 dan berpengalaman lebih dari 15 tahun dalam memberikan solusi teknologi terintegrasi untuk bisnis modern.'
            ],
            [
                'kode_pengetahuan' => 'KB-002',
                'kategori_pertanyaan' => 'Tentang TMS',
                'sub_kategori' => 'Spesialisasi',
                'jawaban' => 'Kami spesialis dalam:\n- Konsultasi IT dan perencanaan strategi digital\n- Pengembangan software custom sesuai kebutuhan bisnis\n- Implementasi cloud infrastructure yang aman dan scalable\n- Solusi cybersecurity untuk perlindungan data\n- Layanan transformasi digital menyeluruh\n- Support dan maintenance sistem'
            ],
            [
                'kode_pengetahuan' => 'KB-003',
                'kategori_pertanyaan' => 'Tentang TMS',
                'sub_kategori' => 'Visi Misi',
                'jawaban' => 'Tim profesional kami siap membantu bisnis Anda berkembang dengan teknologi terkini. Kami berkomitmen untuk memberikan solusi terbaik yang dapat disesuaikan dengan kebutuhan spesifik setiap klien kami.'
            ],

            // Kategori: Layanan
            [
                'kode_pengetahuan' => 'KB-004',
                'kategori_pertanyaan' => 'Layanan',
                'sub_kategori' => 'Konsultasi IT & Strategy',
                'jawaban' => 'Kami membantu merancang strategi teknologi yang tepat untuk bisnis Anda. Tim ahli kami akan menganalisis kebutuhan bisnis Anda dan memberikan rekomendasi solusi yang paling optimal.'
            ],
            [
                'kode_pengetahuan' => 'KB-005',
                'kategori_pertanyaan' => 'Layanan',
                'sub_kategori' => 'Pengembangan Software Custom',
                'jawaban' => 'Solusi software yang disesuaikan dengan kebutuhan spesifik perusahaan Anda. Kami mengembangkan aplikasi dengan teknologi terkini yang scalable dan maintainable.'
            ],
            [
                'kode_pengetahuan' => 'KB-006',
                'kategori_pertanyaan' => 'Layanan',
                'sub_kategori' => 'Cloud Infrastructure',
                'jawaban' => 'Infrastruktur cloud yang aman, scalable, dan reliable untuk mendukung pertumbuhan bisnis Anda. Kami menyediakan solusi cloud yang cost-effective dan dapat diakses dari mana saja.'
            ],
            [
                'kode_pengetahuan' => 'KB-007',
                'kategori_pertanyaan' => 'Layanan',
                'sub_kategori' => 'Cybersecurity Solutions',
                'jawaban' => 'Perlindungan keamanan data dan sistem yang komprehensif. Kami melindungi aset digital Anda dari ancaman cyber dengan solusi keamanan berlapis.'
            ],
            [
                'kode_pengetahuan' => 'KB-008',
                'kategori_pertanyaan' => 'Layanan',
                'sub_kategori' => 'Digital Transformation',
                'jawaban' => 'Transformasi digital menyeluruh untuk modernisasi bisnis Anda. Kami membantu Anda mengadopsi teknologi digital untuk meningkatkan efisiensi dan produktivitas.'
            ],
            [
                'kode_pengetahuan' => 'KB-009',
                'kategori_pertanyaan' => 'Layanan',
                'sub_kategori' => 'Support & Maintenance',
                'jawaban' => 'Tim support profesional untuk memastikan sistem Anda selalu berjalan optimal 24/7. Kami menyediakan maintenance rutin dan support teknis yang responsif.'
            ],

            // Kategori: Kontak & Informasi
            [
                'kode_pengetahuan' => 'KB-010',
                'kategori_pertanyaan' => 'Kontak & Informasi',
                'sub_kategori' => 'Hubungi Kami',
                'jawaban' => 'Hubungi kami melalui:\n📞 Telepon: 085223035426\n📧 Email: kocicenter@gmail.com\n📍 Alamat: JL. Ciamis-Banjar Dusun Kidul RT/RW 007/003 Cijeungjing, Ciamis'
            ],
            [
                'kode_pengetahuan' => 'KB-011',
                'kategori_pertanyaan' => 'Kontak & Informasi',
                'sub_kategori' => 'Jam Operasional',
                'jawaban' => 'Jam kerja kami: Senin - Jumat, 09:00 - 17:00 WIB.\n\nAnda bisa menghubungi kami melalui telepon, email, atau WhatsApp untuk pertanyaan atau konsultasi lebih lanjut. Tim kami siap membantu Anda!'
            ],
            [
                'kode_pengetahuan' => 'KB-012',
                'kategori_pertanyaan' => 'Kontak & Informasi',
                'sub_kategori' => 'WhatsApp & Media Sosial',
                'jawaban' => 'Anda dapat menghubungi kami melalui WhatsApp di nomor 085223035426 untuk pertanyaan cepat atau konsultasi. Ikuti juga media sosial kami untuk update terbaru tentang layanan dan produk kami.'
            ],

            // Kategori: Harga & Paket
            [
                'kode_pengetahuan' => 'KB-013',
                'kategori_pertanyaan' => 'Harga & Paket',
                'sub_kategori' => 'Paket Starter',
                'jawaban' => 'Paket Starter dirancang untuk UKM dan startup yang baru memulai transformasi digital. Mencakup:\n- Konsultasi dasar\n- Support teknis\n- Maintenance rutin\n\nIde paket yang tepat untuk bisnis yang baru memulai.'
            ],
            [
                'kode_pengetahuan' => 'KB-014',
                'kategori_pertanyaan' => 'Harga & Paket',
                'sub_kategori' => 'Paket Professional',
                'jawaban' => 'Paket Professional dirancang untuk perusahaan menengah. Mencakup:\n- Pengembangan software custom\n- Cloud setup dan configuration\n- Support 24/7\n- Maintenance berkelanjutan\n\nSolusi lengkap untuk pertumbuhan bisnis Anda.'
            ],
            [
                'kode_pengetahuan' => 'KB-015',
                'kategori_pertanyaan' => 'Harga & Paket',
                'sub_kategori' => 'Paket Enterprise',
                'jawaban' => 'Paket Enterprise dirancang untuk korporasi besar. Mencakus:\n- Solusi cybersecurity komprehensif\n- Cloud infrastructure enterprise-grade\n- Support premium 24/7\n- Tim dedicated untuk kebutuhan spesifik Anda\n\nSolusi komprehensif untuk kebutuhan korporat terbesar.'
            ],
            [
                'kode_pengetahuan' => 'KB-016',
                'kategori_pertanyaan' => 'Harga & Paket',
                'sub_kategori' => 'Konsultasi & Penawaran Khusus',
                'jawaban' => 'Setiap paket dapat dikustomisasi sesuai kebutuhan spesifik Anda. Untuk penawaran khusus dan konsultasi gratis, silakan hubungi tim sales kami:\n📞 085223035426\n📧 kocicenter@gmail.com'
            ],

            // Kategori: FAQ Umum
            [
                'kode_pengetahuan' => 'KB-017',
                'kategori_pertanyaan' => 'FAQ Umum',
                'sub_kategori' => 'Cara Memulai Kerja Sama',
                'jawaban' => 'Untuk memulai kerja sama dengan TMS, silakan:\n1. Hubungi kami melalui telepon atau email\n2. Tim kami akan melakukan konsultasi awal\n3. Kami akan membuat proposal sesuai kebutuhan Anda\n4. Jika setuju, kami akan membuat kontrak dan memulai project\n\nProses yang transparan dan profesional.'
            ],
            [
                'kode_pengetahuan' => 'KB-018',
                'kategori_pertanyaan' => 'FAQ Umum',
                'sub_kategori' => 'Timeline Project',
                'jawaban' => 'Timeline project tergantung pada kompleksitas dan skala project Anda. Setelah konsultasi, kami akan memberikan estimasi timeline yang realistis dan detail. Kami berkomitmen untuk menyelesaikan project tepat waktu sesuai yang disepakati.'
            ],
            [
                'kode_pengetahuan' => 'KB-019',
                'kategori_pertanyaan' => 'FAQ Umum',
                'sub_kategori' => 'Garansi & Support',
                'jawaban' => 'Semua layanan kami dilengkapi dengan garansi dan support. Durasi garansi tergantung pada jenis layanan yang Anda pilih. Kami juga menyediakan support berkelanjutan dan maintenance rutin untuk memastikan sistem Anda tetap optimal.'
            ],
            [
                'kode_pengetahuan' => 'KB-020',
                'kategori_pertanyaan' => 'FAQ Umum',
                'sub_kategori' => 'Metode Pembayaran',
                'jawaban' => 'Kami menerima berbagai metode pembayaran termasuk transfer bank, kartu kredit, dan cicilan. Untuk informasi lebih detail tentang metode pembayaran dan terms pembayaran, silakan hubungi tim finance kami.'
            ],

            // Kategori: Tentang TechAI
            [
                'kode_pengetahuan' => 'KB-021',
                'kategori_pertanyaan' => 'Tentang TechAI',
                'sub_kategori' => 'Kemampuan TechAI',
                'jawaban' => 'TechAI adalah asisten virtual cerdas berbasis AI yang dapat:\n- Memberikan informasi lengkap tentang TMS\n- Menjawab pertanyaan umum tentang layanan\n- Memberikan rekomendasi solusi\n- Memandu ke departemen yang tepat\n- Memberikan FAQ dan troubleshooting\n- Membantu 24/7 dalam bahasa Indonesia'
            ],
            [
                'kode_pengetahuan' => 'KB-022',
                'kategori_pertanyaan' => 'Tentang TechAI',
                'sub_kategori' => 'Cara Menggunakan TechAI',
                'jawaban' => 'Gunakan TechAI dengan:\n1. Pilih kategori pertanyaan yang ingin Anda tanyakan\n2. Pilih sub kategori sesuai detail pertanyaan Anda\n3. Baca jawaban yang diberikan\n4. Jika ingin menanyakan hal lain, gunakan opsi "Riset" untuk kembali ke kategori\n5. Atau lanjutkan bertanya dengan kategori dan sub kategori yang berbeda'
            ],
            [
                'kode_pengetahuan' => 'KB-023',
                'kategori_pertanyaan' => 'Tentang TechAI',
                'sub_kategori' => 'Keuntungan Menggunakan TechAI',
                'jawaban' => 'Keuntungan menggunakan TechAI:\n✓ Tersedia 24/7 untuk menjawab pertanyaan Anda\n✓ Respon cepat dan akurat\n✓ Dalam bahasa Indonesia yang mudah dipahami\n✓ Dapat membantu Anda menemukan solusi terbaik\n✓ Gratis dan mudah digunakan\n✓ Privasi Anda terjaga dengan baik'
            ],
        ];

        foreach ($pengetahuanData as $data) {
            Pengetahuan::create($data);
        }
    }
}
