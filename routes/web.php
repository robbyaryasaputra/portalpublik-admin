<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;   
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriBeritaController;

/*
|--------------------------------------------------------------------------
| Public Routes (Bisa diakses tanpa login)
|--------------------------------------------------------------------------
*/

// Route redirect root ke halaman login
Route::get('/', [AuthController::class, 'index'])->name('login.form');

// Route untuk memproses login
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.process');


// Menggunakan alias 'checkislogin' yang sudah didaftarkan di app.php
Route::middleware(['checkislogin'])->group(function () {

    // Logout (Hanya bisa logout jika sudah login)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::middleware(['checkrole:admin'])->group(function () {
        Route::resource('user', UserController::class);
    });

    // Resource routes untuk CRUD
    Route::resource('warga', WargaController::class);
    Route::resource('profil', ProfilController::class);
    Route::resource('kategori-berita', KategoriBeritaController::class);
    Route::resource('berita', BeritaController::class);
    Route::resource('agenda', AgendaController::class);
    Route::resource('galeri', GaleriController::class);

});