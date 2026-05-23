    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\JurnalController;
    use App\Http\Controllers\Auth\RegisteredUserController; // Import kelas yang benar

    // --- Autentikasi & Registrasi ---
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [JurnalController::class, 'showLogin'])->name('login');
    Route::post('/login', [JurnalController::class, 'login']);
    Route::post('/logout', [JurnalController::class, 'logout'])->name('logout');

    // --- Halaman Jurnal & Dashboard ---
    Route::get('/', function () {
        return redirect()->route('login'); });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [JurnalController::class, 'dashboardAdmin'])->name('dashboard');

        // Route lainnya...
        Route::get('/jurnal/create', [JurnalController::class, 'create'])->name('jurnal.create');
        Route::post('/jurnal/store', [JurnalController::class, 'store'])->name('jurnal.store');
        // Tambahkan sisa route Anda di sini...
    });

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
