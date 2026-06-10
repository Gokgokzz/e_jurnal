<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurnal;
use App\Models\User; // Tambahkan baris ini

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Pengecekan akses
        if (auth()->user()->role !== 'kepsek') {
            return redirect('/dashboard');
        }

        // 2. Ambil data jurnal terbaru
        $jurnalTerbaru = Jurnal::latest()->limit(5)->get();

        // 3. LOGIKA: Ambil guru yang belum mengisi jurnal hari ini
        
        // Ambil semua user yang role-nya 'guru'
        $semuaGuru = User::where('role', 'guru')->get();
        
        // Ambil daftar ID user (guru) yang sudah mengisi jurnal hari ini
        $idGuruSudahMengisi = Jurnal::whereDate('created_at', today())
                                    ->pluck('user_id')
                                    ->toArray();
        
        // Filter: Ambil guru yang ID-nya TIDAK ADA di daftar sudah mengisi
        $guruBelumMengisi = $semuaGuru->whereNotIn('id', $idGuruSudahMengisi);

        // 4. Kirim data ke view
        return view('kepsek.dashboard', compact('jurnalTerbaru', 'guruBelumMengisi'));
    }
}