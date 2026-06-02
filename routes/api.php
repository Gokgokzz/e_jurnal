<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurnalController;

// Rute untuk mengambil data rekapitulasi jurnal
Route::get('/rekapitulasi', [JurnalController::class, 'rekapitulasiApi']);

Route::get('/kelas/{kelas_id}/siswa', [JurnalController::class, 'getSiswaByKelas']);