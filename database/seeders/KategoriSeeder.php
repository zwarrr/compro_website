<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            // Kategori Layanan (1-5)
            ['kode_kategori' => 'LAY-001', 'nama_kategori' => 'Web Development', 'tipe' => 'layanan'],
            ['kode_kategori' => 'LAY-002', 'nama_kategori' => 'Mobile Development', 'tipe' => 'layanan'],
            ['kode_kategori' => 'LAY-003', 'nama_kategori' => 'UI/UX Design', 'tipe' => 'layanan'],
            ['kode_kategori' => 'LAY-004', 'nama_kategori' => 'Digital Marketing', 'tipe' => 'layanan'],
            ['kode_kategori' => 'LAY-005', 'nama_kategori' => 'Cloud Services', 'tipe' => 'layanan'],
            
            // Kategori Galeri (6-10)
            ['kode_kategori' => 'GAL-001', 'nama_kategori' => 'Website Projects', 'tipe' => 'galeri'],
            ['kode_kategori' => 'GAL-002', 'nama_kategori' => 'Mobile Apps', 'tipe' => 'galeri'],
            ['kode_kategori' => 'GAL-003', 'nama_kategori' => 'Design Works', 'tipe' => 'galeri'],
            ['kode_kategori' => 'GAL-004', 'nama_kategori' => 'Corporate Events', 'tipe' => 'galeri'],
            ['kode_kategori' => 'GAL-005', 'nama_kategori' => 'Team Activities', 'tipe' => 'galeri'],
            
            // Kategori Karyawan (11-15)
            ['kode_kategori' => 'KAR-001', 'nama_kategori' => 'Manajer', 'tipe' => 'karyawan'],
            ['kode_kategori' => 'KAR-002', 'nama_kategori' => 'Marketing', 'tipe' => 'karyawan'],
            ['kode_kategori' => 'KAR-003', 'nama_kategori' => 'SDM', 'tipe' => 'karyawan'],
            ['kode_kategori' => 'KAR-004', 'nama_kategori' => 'Accounting', 'tipe' => 'karyawan'],
            ['kode_kategori' => 'KAR-005', 'nama_kategori' => 'UMB', 'tipe' => 'karyawan'],
            ['kode_kategori' => 'KAR-006', 'nama_kategori' => 'Support', 'tipe' => 'karyawan'],
            
            // Kategori Client (16-20)
            ['kode_kategori' => 'CLI-001', 'nama_kategori' => 'Government', 'tipe' => 'client'],
            ['kode_kategori' => 'CLI-002', 'nama_kategori' => 'Corporate', 'tipe' => 'client'],
            ['kode_kategori' => 'CLI-003', 'nama_kategori' => 'Startup', 'tipe' => 'client'],
            ['kode_kategori' => 'CLI-004', 'nama_kategori' => 'E-Commerce', 'tipe' => 'client'],
            ['kode_kategori' => 'CLI-005', 'nama_kategori' => 'Education', 'tipe' => 'client'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
