<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JurnalController extends Controller
{
    public function show($id)
    {
        $jurnal = Jurnal::with(['mapel', 'kelas', 'absensis.siswa'])->findOrFail($id);
        return response()->json($jurnal);
    }
    public function editProfile()
    {
        $user = Auth::user();
        return view('admin.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = Auth::user();
        $user->update($request->only('name', 'email'));

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function destroyProfile(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login

        // 1. Logout dulu agar sesi terputus
        Auth::logout();

        // 2. Hapus user (Data jurnal akan ikut terhapus otomatis oleh database 
        //    karena kita sudah pasang cascade di migrasi)
        $user->delete();

        // 3. Bersihkan sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun telah berhasil dihapus.');
    }

    public function showProfile()
    {
        $user = Auth::user();
        // Pastikan ini merujuk ke folder 'admin' dan file 'profile'
        return view('admin.profile', compact('user'));
    }

    public function rekapitulasi()
    {
        // Eager loading: mengambil jurnal, serta relasi kelas, mapel, dan absensis beserta siswanya
        $jurnals = \App\Models\Jurnal::with(['kelas', 'mapel', 'absensis.siswa'])
            ->latest()
            ->get();

        $totalSesi = \App\Models\Jurnal::count();
        $kehadiran = 94.8;

        return view('admin.rekapitulasi', compact('jurnals', 'totalSesi', 'kehadiran'));
    }

    // Di dalam class Jurnal
    public function mapel()
    {
        // Sesuaikan 'mapel_id' dengan nama foreign key di tabel jurnal Anda
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    // 2. Memproses Data Form Login
    public function login(Request $request)
    {
        // 1. Validasi input menggunakan email
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Auth::attempt mencari di kolom 'email' (standar Laravel)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Gunakan intended agar jika user tadinya mau buka halaman lain, 
            // setelah login langsung diarahkan ke sana
            return redirect()->intended('dashboard');
        }

        // 3. Jika gagal, kembalikan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // 3. Menampilkan Halaman Dashboard Utama
    public function dashboardAdmin()
    {
        // Hitung data informasi card box secara dinamis
        $totalJurnalHariIni = DB::table('jurnals')->whereDate('tanggal', today())->count();
        $totalSiswa = DB::table('siswas')->count();
        $guruAktif = DB::table('users')->count();
        $totalKelas = DB::table('kelas')->count();

        // Tarik data entri jurnal mengajar terbaru
        $jurnalTerbaru = DB::table('jurnals')
            ->select(
                'jurnals.id',
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
            ->limit(10)
            ->get();

        // Menampilkan file view di folder resources/views/admin/dashboard.blade.php
        return view('admin.dashboard', compact('jurnalTerbaru', 'totalJurnalHariIni', 'totalKelas', 'guruAktif', 'totalSiswa'));
    }

    // 4. Proses Keluar Aplikasi (Logout)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function destroy($id)
    {
        $jurnal = \App\Models\Jurnal::findOrFail($id);
        $jurnal->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    // 7. API Pendukung Ambil Data Siswa (AJAX)
    public function getSiswaByKelas($kelas_id)
    {
        $siswas = \App\Models\Siswa::where('kelas_id', $kelas_id)
            ->orderBy('no_absen', 'asc')
            ->get();

        return response()->json($siswas);
    }

    // 8. Menampilkan Halaman Form Tambah Jurnal Baru
    public function create()
    {
        $data_kelas = Kelas::all();
        $data_mapel = Mapel::all();
        $data_siswa = Siswa::all();

        return view('jurnal.create', compact('data_kelas', 'data_mapel', 'data_siswa'));
    }

    // 9. Menyimpan Data Jurnal dan Absensi ke Database
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'jam_pelajaran' => 'required',
            'materi' => 'nullable',
        ]);

        DB::transaction(function () use ($request) {
            $jurnal = Jurnal::create([
                'tanggal' => $request->tanggal,
                'user_id' => Auth::id(),
                'mapel_id' => $request->mapel_id,
                'kelas_id' => $request->kelas_id,
                'jam_pelajaran' => $request->jam_pelajaran,
                'pertemuan_ke' => $request->pertemuan_ke ?? 1,
                'materi' => $request->materi,
            ]);

            if ($request->has('absensi')) {
                foreach ($request->absensi as $siswa_id => $status) {
                    if ($status !== 'Hadir') {
                        $status_final = ($status === 'Alfa') ? 'Alpa' : $status;

                        Absensi::create([
                            'jurnal_id' => $jurnal->id,
                            'siswa_id' => $siswa_id,
                            'status' => $status_final,
                        ]);
                    }
                }
            }
        });

        return redirect()->route('jurnal.create')->with('success', 'Jurnal Berhasil Disimpan!');
    }
}