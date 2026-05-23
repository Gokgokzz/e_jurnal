<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\Auth\RegisteredUserController;

// --- Autentikasi ---
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [JurnalController::class, 'showLogin'])->name('login');
Route::post('/login', [JurnalController::class, 'login']);
Route::post('/logout', [JurnalController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('login');
});

// --- Group Route yang Memerlukan Login (Auth) ---
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [JurnalController::class, 'dashboardAdmin'])->name('dashboard');

    // Profil (Perhatikan: Hanya ada satu rute untuk profile.edit)
    Route::get('/profile', [JurnalController::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit', [JurnalController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [JurnalController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile/destroy', [JurnalController::class, 'destroyProfile'])->name('profile.destroy');

    // Jurnal & API
    Route::get('/api/kelas/{kelas_id}/siswa', [JurnalController::class, 'getSiswaByKelas']);
    Route::get('/jurnal/create', [JurnalController::class, 'create'])->name('jurnal.create');
    Route::post('/jurnal/store', [JurnalController::class, 'store'])->name('jurnal.store');
    Route::get('/jurnal/{id}/edit', [JurnalController::class, 'edit'])->name('jurnal.edit');
    Route::delete('/jurnal/{id}', [JurnalController::class, 'destroy'])->name('jurnal.destroy');
    Route::put('/jurnal/{id}', [JurnalController::class, 'update'])->name('jurnal.update');

    // Rekapitulasi
    Route::get('/rekapitulasi', [JurnalController::class, 'rekapitulasi'])->name('rekapitulasi');
});