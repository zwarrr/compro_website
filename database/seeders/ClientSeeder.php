<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'kode_client' => 'CLI-001',
                'kategori_id' => 16, // Government
                'nama_client' => 'Kementerian Komunikasi dan Informatika',
                'logo' => null,
                'website' => 'https://www.kominfo.go.id',
                'deskripsi' => 'Pengembangan sistem informasi publik dan portal berita pemerintah',
                'status' => 'publik'
            ],
            [
                'kode_client' => 'CLI-002',
                'kategori_id' => 17, // Corporate
                'nama_client' => 'PT Bank Central Asia Tbk',
                'logo' => null,
                'website' => 'https://www.bca.co.id',
                'deskripsi' => 'Pengembangan aplikasi mobile banking dan sistem internal',
                'status' => 'publik'
            ],
            [
                'kode_client' => 'CLI-003',
                'kategori_id' => 18, // Startup
                'nama_client' => 'Gojek Indonesia',
                'logo' => null,
                'website' => 'https://www.gojek.com',
                'deskripsi' => 'Konsultasi teknologi dan pengembangan fitur baru',
                'status' => 'publik'
            ],
            [
                'kode_client' => 'CLI-004',
                'kategori_id' => 19, // E-Commerce
                'nama_client' => 'Tokopedia',
                'logo' => null,
                'website' => 'https://www.tokopedia.com',
                'deskripsi' => 'Optimasi performa website dan pengembangan dashboard seller',
                'status' => 'publik'
            ],
            [
                'kode_client' => 'CLI-005',
                'kategori_id' => 20, // Education
                'nama_client' => 'Universitas Indonesia',
                'logo' => null,
                'website' => 'https://www.ui.ac.id',
                'deskripsi' => 'Pengembangan sistem e-learning dan portal akademik',
                'status' => 'publik'
            ],
            [
                'kode_client' => 'CLI-006',
                'kategori_id' => 17, // Corporate
                'nama_client' => 'PT Telkom Indonesia Tbk',
                'logo' => null,
                'website' => 'https://www.telkom.co.id',
                'deskripsi' => 'Pengembangan website corporate dan sistem CRM',
                'status' => 'publik'
            ],
            [
                'kode_client' => 'CLI-007',
                'kategori_id' => 16, // Government
                'nama_client' => 'Pemerintah Provinsi DKI Jakarta',
                'logo' => null,
                'website' => 'https://jakarta.go.id',
                'deskripsi' => 'Pengembangan smart city dashboard dan aplikasi pelayanan publik',
                'status' => 'publik'
            ],
            [
                'kode_client' => 'CLI-008',
                'kategori_id' => 19, // E-Commerce
                'nama_client' => 'Shopee Indonesia',
                'logo' => null,
                'website' => 'https://www.shopee.co.id',
                'deskripsi' => 'Pengembangan fitur marketing automation dan analitik',
                'status' => 'publik'
            ],
            [
                'kode_client' => 'CLI-009',
                'kategori_id' => 18, // Startup
                'nama_client' => 'Ruangguru',
                'logo' => null,
                'website' => 'https://www.ruangguru.com',
                'deskripsi' => 'Pengembangan platform pembelajaran online dan video streaming',
                'status' => 'publik'
            ],
            [
                'kode_client' => 'CLI-010',
                'kategori_id' => 17, // Corporate
                'nama_client' => 'PT Unilever Indonesia Tbk',
                'logo' => null,
                'website' => 'https://www.unilever.co.id',
                'deskripsi' => 'Pengembangan website product showcase dan campaign digital',
                'status' => 'publik'
            ],
            [
                'kode_client' => 'CLI-011',
                'kategori_id' => 20, // Education
                'nama_client' => 'Institut Teknologi Bandung',
                'logo' => null,
                'website' => 'https://www.itb.ac.id',
                'deskripsi' => 'Pengembangan sistem manajemen penelitian dan repository digital',
                'status' => 'publik'
            ],
            [
                'kode_client' => 'CLI-012',
                'kategori_id' => 18, // Startup
                'nama_client' => 'Traveloka',
                'logo' => null,
                'website' => 'https://www.traveloka.com',
                'deskripsi' => 'Pengembangan sistem booking dan payment gateway integration',
                'status' => 'publik'
            ],
            [
                'kode_client' => 'CLI-013',
                'kategori_id' => 17, // Corporate
                'nama_client' => 'PT Astra International Tbk',
                'logo' => null,
                'website' => 'https://www.astra.co.id',
                'deskripsi' => 'Pengembangan corporate website dan investor relations portal',
                'status' => 'publik'
            ],
            [
                'kode_client' => 'CLI-014',
                'kategori_id' => 19, // E-Commerce
                'nama_client' => 'Bukalapak',
                'logo' => null,
                'website' => 'https://www.bukalapak.com',
                'deskripsi' => 'Pengembangan merchant dashboard dan logistics integration',
                'status' => 'publik'
            ],
            [
                'kode_client' => 'CLI-015',
                'kategori_id' => 16, // Government
                'nama_client' => 'Badan Pusat Statistik',
                'logo' => null,
                'website' => 'https://www.bps.go.id',
                'deskripsi' => 'Pengembangan portal data statistik dan visualization dashboard',
                'status' => 'publik'
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
