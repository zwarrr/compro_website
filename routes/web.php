<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return view('landing_page');
})->name('beranda');

Route::get('/fitur', function () {
    return view('landing_page');
})->name('fitur');

Route::get('/client', function () {
    return view('landing_page');
})->name('client');

Route::get('/faq', function () {
    return view('landing_page');
})->name('faq');

Route::get('/profil-perusahaan', function () {
    return view('sections.profil_perusahaan');
})->name('profil-perusahaan');

Route::get('/team', function () {
    return view('sections.team');
})->name('team');

Route::get('/galeri', function () {
    return view('sections.galeri');
})->name('galeri');

Route::get('/welcome', function () {
    return view('welcome');
});

// Auth routes (login/logout)
Route::view('login', 'auth.login')->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Admin routes (protected)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/chart-data', [App\Http\Controllers\Admin\DashboardController::class, 'getChartData'])->name('dashboard.chart-data');
    
    // CRUD routes with resource controllers
    Route::resource('kategori', App\Http\Controllers\Admin\KategoriController::class);
    Route::resource('layanan', App\Http\Controllers\Admin\LayananController::class);
    Route::resource('galeri', App\Http\Controllers\Admin\GaleriController::class);
    Route::resource('karyawan', App\Http\Controllers\Admin\KaryawanController::class);
    Route::resource('testimoni', App\Http\Controllers\Admin\TestimoniController::class);
    Route::resource('client', App\Http\Controllers\Admin\ClientController::class);
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    
    // Pesan/Kontak routes
    Route::resource('pesan', App\Http\Controllers\Admin\KontakController::class);
    Route::post('pesan/{id}/mark-read', [App\Http\Controllers\Admin\KontakController::class, 'markAsRead'])->name('pesan.mark-read');
    Route::post('pesan/{id}/mark-unread', [App\Http\Controllers\Admin\KontakController::class, 'markAsUnread'])->name('pesan.mark-unread');
    
    // FAQ routes
    Route::resource('faq', App\Http\Controllers\Admin\FaqController::class);
    
    // Sosial Media routes
    Route::resource('sosial', App\Http\Controllers\Admin\SosialMediaController::class);
    
    // Konfigurasi (single profile) - gunakan resource minimal: index, store, update, show (optional)
    Route::resource('konfigurasi', App\Http\Controllers\Admin\ProfilePerusahaanController::class)
        ->only(['index','store','update','show'])
        ->parameters(['konfigurasi' => 'konfigurasi']);
});
