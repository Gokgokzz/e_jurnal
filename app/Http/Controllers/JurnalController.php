<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Untuk autentikasi

class JurnalController extends Controller
{

    public function edit($id)
    {
        // 1. Ambil data jurnal yang mau diedit
        $jurnal = \App\Models\Jurnal::findOrFail($id);

        // 2. Ambil data pendukung (kelas, mapel, siswa jika diperlukan)
        $data_kelas = \App\Models\Kelas::all();

        // 3. Langsung arahkan ke view yang sama dengan form input
        // Asumsi file form input Anda namanya 'create.blade.php' atau 'form.blade.php'
        return view('jurnal.create', compact('jurnal', 'data_kelas'));
    }

    public function destroy($id)
    {
        $jurnal = \App\Models\Jurnal::findOrFail($id);
        $jurnal->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function getSiswaByKelas($kelas_id)
    {
        // Ambil data siswa berdasarkan id kelas
        $siswas = \App\Models\Siswa::where('kelas_id', $kelas_id)
            ->orderBy('no_absen', 'asc')
            ->get();

        // WAJIB: Mengembalikan response berupa json murni, BUKAN return view()!
        return response()->json($siswas);
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = DB::table('users')->where('name', $request->username)->first();

        if ($user && $user->password === $request->password) {
            Auth::loginUsingId($user->id);
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function dashboardAdmin()
    {
        // Hitung data informasi card box secara dinamis
        $totalJurnalHariIni = DB::table('jurnals')->whereDate('tanggal', today())->count();
        $totalSiswa = DB::table('siswas')->count();
        $guruAktif = DB::table('users')->count();
        $totalKelas = DB::table('kelas')->count();

        // Tarik entri jurnal mengajar terbaru
        // Cari bagian query yang mirip ini dan tambahkan jurnals.id
        $jurnalTerbaru = DB::table('jurnals')
            ->select(
                'jurnals.id', // TAMBAHKAN INI
                'kelas.nama_kelas',
                'users.name as nama_guru',
                'mapels.nama_mapel as mata_pelajaran',
                'jurnals.jam_pelajaran',
                DB::raw("CASE WHEN jurnals.materi IS NOT NULL AND jurnals.materi != '' THEN 'Terisi' ELSE 'Belum Terisi' END as status")
            )
            ->leftJoin('users', 'jurnals.user_id', '=', 'users.id')
            ->join('kelas', 'jurnals.kelas_id', '=', 'kelas.id')
            ->join('mapels', 'jurnals.mapel_id', '=', 'mapels.id')
            ->orderBy('jurnals.id', 'desc')
            ->limit(4)
            ->get();

        // Pastikan memakai 'admin.dashboard'
        return view('admin.dashboard', compact('jurnalTerbaru', 'totalJurnalHariIni', 'totalKelas', 'guruAktif', 'totalSiswa'));
    }

    // Proses Keluar Aplikasi
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    public function create()
    {
        $data_kelas = Kelas::all();
        $data_mapel = Mapel::all();
        $data_siswa = Siswa::all(); // Nanti bisa difilter per kelas pakai AJAX

        return view('jurnal.create', compact('data_kelas', 'data_mapel', 'data_siswa'));
    }

    // Menyimpan data jurnal dan absensi sekaligus
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'jam_pelajaran' => 'required',
            'materi' => 'nullable',
        ]);

        // 2. Gunakan Transaction agar jika salah satu gagal, semua dibatalkan (aman)
        DB::transaction(function () use ($request) {

            // Simpan data Jurnal utama
            $jurnal = Jurnal::create([
                'tanggal' => $request->tanggal,
                'user_id' => Auth::id(), // ID Guru yang login
                'mapel_id' => $request->mapel_id,
                'kelas_id' => $request->kelas_id,
                'jam_pelajaran' => $request->jam_pelajaran,
                'pertemuan_ke' => $request->pertemuan_ke ?? 1,
                'materi' => $request->materi,
            ]);

            // Simpan data Absensi Siswa (Looping dari input form)
            // Simpan data Absensi Siswa
            if ($request->has('absensi')) {
                foreach ($request->absensi as $siswa_id => $status) {

                    // 1. Cek apakah statusnya BUKAN 'Hadir'
                    // Jika statusnya adalah 'Sakit', 'Izin', atau 'Alpa', maka simpan
                    if ($status !== 'Hadir') {

                        // Translasi untuk memastikan sesuai dengan ENUM database ('Alpa')
                        $status_final = ($status === 'Alfa') ? 'Alpa' : $status;

                        // Simpan ke database
                        Absensi::create([
                            'jurnal_id' => $jurnal->id,
                            'siswa_id' => $siswa_id,
                            'status' => $status_final,
                        ]);
                    }
                    // Jika statusnya 'Hadir', blok if di atas akan dilewati, 
                    // sehingga tidak ada data yang masuk ke database untuk siswa tersebut.
                }
            }
        });

        return redirect()->route('jurnal.create')->with('success', 'Jurnal Berhasil Disimpan!');
    }
}