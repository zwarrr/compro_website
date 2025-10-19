<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SocialMedia;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialMedias = [
            [
                'kode_sosial' => 'SM-001',
                'nama_sosmed' => 'Facebook',
                'username' => 'compro.official',
                'url' => 'https://facebook.com/compro.official',
                'icon' => 'fab fa-facebook',
                'warna' => '#1877F2',
                'status' => 'publik'
            ],
            [
                'kode_sosial' => 'SM-002',
                'nama_sosmed' => 'Instagram',
                'username' => '@compro.official',
                'url' => 'https://instagram.com/compro.official',
                'icon' => 'fab fa-instagram',
                'warna' => '#E4405F',
                'status' => 'publik'
            ],
            [
                'kode_sosial' => 'SM-003',
                'nama_sosmed' => 'Twitter',
                'username' => '@comproofficial',
                'url' => 'https://twitter.com/comproofficial',
                'icon' => 'fab fa-twitter',
                'warna' => '#1DA1F2',
                'status' => 'publik'
            ],
            [
                'kode_sosial' => 'SM-004',
                'nama_sosmed' => 'LinkedIn',
                'username' => 'compro-indonesia',
                'url' => 'https://linkedin.com/company/compro-indonesia',
                'icon' => 'fab fa-linkedin',
                'warna' => '#0A66C2',
                'status' => 'publik'
            ],
            [
                'kode_sosial' => 'SM-005',
                'nama_sosmed' => 'YouTube',
                'username' => 'ComproOfficial',
                'url' => 'https://youtube.com/@comproofficial',
                'icon' => 'fab fa-youtube',
                'warna' => '#FF0000',
                'status' => 'publik'
            ],
            [
                'kode_sosial' => 'SM-006',
                'nama_sosmed' => 'TikTok',
                'username' => '@compro.official',
                'url' => 'https://tiktok.com/@compro.official',
                'icon' => 'fab fa-tiktok',
                'warna' => '#000000',
                'status' => 'publik'
            ],
            [
                'kode_sosial' => 'SM-007',
                'nama_sosmed' => 'WhatsApp Business',
                'username' => '+62 812-3456-7890',
                'url' => 'https://wa.me/6281234567890',
                'icon' => 'fab fa-whatsapp',
                'warna' => '#25D366',
                'status' => 'publik'
            ],
            [
                'kode_sosial' => 'SM-008',
                'nama_sosmed' => 'Telegram',
                'username' => '@comproofficial',
                'url' => 'https://t.me/comproofficial',
                'icon' => 'fab fa-telegram',
                'warna' => '#0088CC',
                'status' => 'publik'
            ],
            [
                'kode_sosial' => 'SM-009',
                'nama_sosmed' => 'GitHub',
                'username' => 'compro-indonesia',
                'url' => 'https://github.com/compro-indonesia',
                'icon' => 'fab fa-github',
                'warna' => '#181717',
                'status' => 'publik'
            ],
            [
                'kode_sosial' => 'SM-010',
                'nama_sosmed' => 'Dribbble',
                'username' => 'comprodesign',
                'url' => 'https://dribbble.com/comprodesign',
                'icon' => 'fab fa-dribbble',
                'warna' => '#EA4C89',
                'status' => 'publik'
            ],
            [
                'kode_sosial' => 'SM-011',
                'nama_sosmed' => 'Behance',
                'username' => 'comprodesign',
                'url' => 'https://behance.net/comprodesign',
                'icon' => 'fab fa-behance',
                'warna' => '#1769FF',
                'status' => 'publik'
            ],
            [
                'kode_sosial' => 'SM-012',
                'nama_sosmed' => 'Medium',
                'username' => '@compro',
                'url' => 'https://medium.com/@compro',
                'icon' => 'fab fa-medium',
                'warna' => '#000000',
                'status' => 'publik'
            ],
            [
                'kode_sosial' => 'SM-013',
                'nama_sosmed' => 'Discord',
                'username' => 'Compro Community',
                'url' => 'https://discord.gg/compro',
                'icon' => 'fab fa-discord',
                'warna' => '#5865F2',
                'status' => 'publik'
            ],
            [
                'kode_sosial' => 'SM-014',
                'nama_sosmed' => 'Pinterest',
                'username' => 'comproofficial',
                'url' => 'https://pinterest.com/comproofficial',
                'icon' => 'fab fa-pinterest',
                'warna' => '#E60023',
                'status' => 'publik'
            ],
            [
                'kode_sosial' => 'SM-015',
                'nama_sosmed' => 'Slack',
                'username' => 'Compro Workspace',
                'url' => 'https://compro.slack.com',
                'icon' => 'fab fa-slack',
                'warna' => '#4A154B',
                'status' => 'publik'
            ],
        ];

        foreach ($socialMedias as $socialMedia) {
            SocialMedia::create($socialMedia);
        }
    }
}
