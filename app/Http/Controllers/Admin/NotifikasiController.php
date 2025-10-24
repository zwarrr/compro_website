<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    /**
     * Ambil notifikasi terbaru dari semua tabel utama.
     */
    public function getAllNotifications()
    {
        // Daftar model yang ingin dicek
        $models = [
            'Client' => \App\Models\Client::class,
            'Faq' => \App\Models\Faq::class,
            'Karyawan' => \App\Models\Karyawan::class,
            'Kategori' => \App\Models\Kategori::class,
            'Galeri' => \App\Models\Galeri::class,
            'Layanan' => \App\Models\Layanan::class,
            'ProfilePerusahaan' => \App\Models\ProfilePerusahaan::class,
            'Loker' => \App\Models\Loker::class,
            'Kontak' => \App\Models\Kontak::class,
            'Lamaran' => \App\Models\Lamaran::class,
            'User' => \App\Models\User::class,
            'SocialMedia' => \App\Models\SocialMedia::class,
            'Testimoni' => \App\Models\Testimoni::class,
        ];

        $notifications = [];
        foreach ($models as $label => $model) {
            // Ambil 1 data terbaru dari setiap tabel
            $latest = $model::orderBy('created_at', 'desc')->first();
            if ($latest) {
                $notifications[] = [
                    'type' => $label,
                    'title' => $label . ' terbaru',
                    'desc' => method_exists($latest, 'getNotificationDesc') ? $latest->getNotificationDesc() : ($latest->name ?? $latest->title ?? $latest->id),
                    'time' => $latest->created_at,
                    'id' => $latest->id,
                ];
            }
        }
        // Gabungkan semua notifikasi, urutkan berdasarkan waktu terbaru
        usort($notifications, function($a, $b) {
            return strtotime($b['time']) <=> strtotime($a['time']);
        });
        // Ambil hanya 5 notifikasi terbaru
        $notifications = array_slice($notifications, 0, 5);
        // Format waktu agar tetap diffForHumans
        foreach ($notifications as &$notif) {
            $notif['time'] = \Carbon\Carbon::parse($notif['time'])->diffForHumans();
        }
        return response()->json($notifications);
    }
}
