<?php

use Illuminate\Support\Facades\Route; // INI WAJIB ADA
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\AuthController; // Jika kamu punya controller untuk autentikasi

// Halaman utama (opsional)
Route::get('/', function () {
    return view('welcome');
});

// Route Jurnal kamu
Route::get('/jurnal/create', [JurnalController::class, 'create'])->name('jurnal.create');
Route::post('/jurnal/store', [JurnalController::class, 'store'])->name('jurnal.store');
Route::get('/', function () {
    return redirect()->route('login');
});

// Memanggil method showLogin yang mengarah ke auth.login
Route::get('/login', [JurnalController::class, 'showLogin'])->name('login');
Route::post('/login', [JurnalController::class, 'login']);
Route::post('/logout', [JurnalController::class, 'logout'])->name('logout');

// Proteksi halaman dashboard admin
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [JurnalController::class, 'dashboardAdmin'])->name('dashboard');
    Route::get('/admin-profile-dummy', function () {
        return 'Halaman Profile'; })->name('profile.edit');
    Route::get('/api/kelas/{kelas_id}/siswa', [JurnalController::class, 'getSiswaByKelas']);

    Route::get('/jurnal/{id}/edit', [JurnalController::class, 'edit'])->name('jurnal.edit');
    Route::delete('/jurnal/{id}', [JurnalController::class, 'destroy'])->name('jurnal.destroy');
    Route::put('/jurnal/{id}', [JurnalController::class, 'update'])->name('jurnal.update');
});