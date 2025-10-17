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
