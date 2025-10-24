<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PengetahuanApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Knowledge Base API Routes
Route::prefix('pengetahuan')->name('pengetahuan.')->group(function () {
    Route::get('/categories', [PengetahuanApiController::class, 'getCategories'])->name('categories');
    Route::get('/sub-categories/{kategori}', [PengetahuanApiController::class, 'getSubCategories'])->name('subCategories');
    Route::get('/answer/{kategori}/{subKategori}', [PengetahuanApiController::class, 'getAnswer'])->name('answer');
    Route::get('/search', [PengetahuanApiController::class, 'search'])->name('search');
});
