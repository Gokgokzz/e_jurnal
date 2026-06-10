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

        // 2. Ambil data guru yang belum mengisi (Logika sudah benar)
        $semuaGuru = User::where('role', 'guru')->get();
        $idGuruSudahMengisi = Jurnal::whereDate('created_at', today())
            ->pluck('user_id')
            ->toArray();
        $guruBelumMengisi = $semuaGuru->whereNotIn('id', $idGuruSudahMengisi);

        // 3. AMBIL DATA JURNAL DENGAN RELASI (Eager Loading)
        // Pastikan kedua variabel ini menggunakan with()
        $jurnalTerbaru = Jurnal::with(['kelas', 'mapel', 'user'])
            ->latest()
            ->limit(5)
            ->get();

        $jurnals = Jurnal::with(['kelas', 'mapel', 'user'])
            ->latest()
            ->take(8)
            ->get();

        // 4. Kirim data ke view
        return view('kepsek.dashboard', compact('jurnalTerbaru', 'guruBelumMengisi', 'jurnals'));
    }
}