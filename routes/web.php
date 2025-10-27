<?php

// Struktur Organisasi
use App\Http\Controllers\Users\StrukturController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\KaryawanController;
use App\Http\Controllers\Users\LayananController;
use App\Http\Controllers\Users\FaqController;
use App\Http\Controllers\Users\GaleriController;
use App\Http\Controllers\Users\KontakController;
use App\Http\Controllers\Users\LokerController;

use App\Http\Controllers\Admin\ProfilePerusahaanController;
use App\Http\Controllers\Users\ProfilPerusahaanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [LayananController::class, 'layanan'])->name('beranda');

Route::get('/beranda', [LayananController::class, 'layanan'])->name('beranda.clean');

Route::get('/fitur', [LayananController::class, 'layanan'])->name('fitur');

Route::get('/client', [LayananController::class, 'layanan'])->name('client');

Route::get('/faq', [FaqController::class, 'faq'])->name('faq');

Route::get('/profil-perusahaan', [ProfilPerusahaanController::class, 'index'])->name('profil-perusahaan');

Route::get('/team', [KaryawanController::class, 'team'])->name('team');

Route::get('/galeri', [GaleriController::class, 'galeri'])->name('galeri');

Route::get('/loker', [LokerController::class, 'index'])->name('loker');

// Submit lamaran
Route::post('/loker/lamar', [LokerController::class, 'store'])->name('loker.lamar');

Route::get('/hubungi-kami', [KontakController::class, 'index'])->name('hubungi-kami');
// Route::get('/hubungi-kami', function () {
//     return view('sections.hubungi_kami');
// })->name('hubungi-kami');

// Contact form submission
Route::post('/hubungi-kami', [KontakController::class, 'store'])->name('hubungi-kami.store');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::view('login', 'auth.login')->name('login');
});
// Auth routes (login/logout)
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Admin routes (protected)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/chart-data', [App\Http\Controllers\Admin\DashboardController::class, 'chartData'])->name('dashboard.chart-data');
    
    // Spotlight Search
    Route::get('search', [App\Http\Controllers\Admin\SearchController::class, 'search'])->name('search');
    
    // Notifikasi dinamis
    Route::get('notifikasi/all', [App\Http\Controllers\Admin\NotifikasiController::class, 'getAllNotifications'])->name('notifikasi.all');
    // CRUD routes with resource controllers
    Route::resource('kategori', App\Http\Controllers\Admin\KategoriController::class);
    Route::resource('layanan', App\Http\Controllers\Admin\LayananController::class);
    Route::resource('loker', App\Http\Controllers\Admin\LokerController::class);
    Route::resource('lamaran', App\Http\Controllers\Admin\LamaranController::class);
    Route::post('lamaran/{id}/reply', [App\Http\Controllers\Admin\LamaranController::class, 'reply'])->name('lamaran.reply');
    Route::resource('galeri', App\Http\Controllers\Admin\GaleriController::class);
    Route::get('karyawan/posisi-data', [App\Http\Controllers\Admin\KaryawanController::class, 'posisiData'])->name('karyawan.posisi-data');
    Route::post('karyawan/update-posisi', [App\Http\Controllers\Admin\KaryawanController::class, 'updatePosisi'])->name('karyawan.update-posisi');
    Route::resource('karyawan', App\Http\Controllers\Admin\KaryawanController::class);
    // Tambahan route untuk posisi modal
    Route::resource('testimoni', App\Http\Controllers\Admin\TestimoniController::class);
    Route::resource('client', App\Http\Controllers\Admin\ClientController::class);
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    // Ilustrasi CRUD
    Route::resource('ilustrasi', App\Http\Controllers\Admin\IlustrasiController::class);

    // Page CRUD
    Route::resource('page', App\Http\Controllers\Admin\PageController::class);

    // Features CRUD
    Route::resource('features', App\Http\Controllers\Admin\FeaturesController::class);
    
    // Pesan/Kontak routes
    Route::resource('pesan', App\Http\Controllers\Admin\KontakController::class);
    Route::post('pesan/{id}/mark-read', [App\Http\Controllers\Admin\KontakController::class, 'markAsRead'])->name('pesan.mark-read');
    Route::post('pesan/{id}/mark-unread', [App\Http\Controllers\Admin\KontakController::class, 'markAsUnread'])->name('pesan.mark-unread');
    
    // FAQ routes
    Route::resource('faq', App\Http\Controllers\Admin\FaqController::class);

    // Pengetahuan routes
    Route::resource('pengetahuan', App\Http\Controllers\Admin\PengetahuanController::class);

    // Sosial Media routes
    Route::resource('sosial', App\Http\Controllers\Admin\SosialMediaController::class);

    // Konfigurasi (single profile) - gunakan resource minimal: index, store, update, show (optional)
    Route::resource('konfigurasi', App\Http\Controllers\Admin\ProfilePerusahaanController::class)
        ->only(['index','store','update','show'])
        ->parameters(['konfigurasi' => 'konfigurasi']);
    
    Route::get('pengetahuan/next-kode', [App\Http\Controllers\Admin\PengetahuanController::class, 'nextKode'])->name('admin.pengetahuan.nextKode');

});
