<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurnalController;

// 1. Alur Awal: Saat web pertama kali dibuka, langsung arahkan ke Register!
Route::get('/', function () {
    return redirect()->route('register');
});

// 2. Halaman Register (Tampilan & Proses Simpan)
Route::get('/register', function () {
    return view('auth.register'); 
})->name('register');

// Arahkan post register ke proses simpan buatanmu (atau ke login jika hanya simulasi link)
Route::post('/register', [JurnalController::class, 'login'])->name('register.store'); 


// 3. Halaman Login (Menggunakan JurnalController bawaan kelompokmu)
Route::get('/login', [JurnalController::class, 'showLogin'])->name('login');
Route::post('/login', [JurnalController::class, 'login']);
Route::post('/logout', [JurnalController::class, 'logout'])->name('logout');


// 4. Route Input Form Jurnal
Route::get('/jurnal/create', [JurnalController::class, 'create'])->name('jurnal.create');
Route::post('/jurnal/store', [JurnalController::class, 'store'])->name('jurnal.store');


// 5. Proteksi Halaman Dashboard Admin
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [JurnalController::class, 'dashboardAdmin'])->name('dashboard');
    Route::get('/admin-profile-dummy', function () {
        return 'Halaman Profile';
    })->name('profile.edit');
    Route::get('/api/kelas/{kelas_id}/siswa', [JurnalController::class, 'getSiswaByKelas']);

    Route::get('/jurnal/{id}/edit', [JurnalController::class, 'edit'])->name('jurnal.edit');
    Route::delete('/jurnal/{id}', [JurnalController::class, 'destroy'])->name('jurnal.destroy');
    Route::put('/jurnal/{id}', [JurnalController::class, 'update'])->name('jurnal.update');
    
    Route::get('/rekapitulasi', [JurnalController::class, 'rekapitulasi'])->name('rekapitulasi');
});