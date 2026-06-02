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
use Illuminate\Support\Facades\Hash;

class JurnalController extends Controller
{
    // ==========================================
    // PENGATURAN & PROFIL
    // ==========================================

    public function showPengaturan()
    {
        return view('admin.pengaturan');
    }

    public function updatePassword(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
            'new_password.min' => 'Kata sandi baru minimal 8 karakter.',
        ]);

        $user = Auth::user();

        // 2. Cek apakah password lama cocok
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini salah.']);
        }

        // 3. Update Password
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Kata sandi berhasil diperbarui!');
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
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
        $user = Auth::user();

        // 1. Logout dulu agar sesi terputus
        Auth::logout();

        // 2. Hapus user
        $user->delete();

        // 3. Bersihkan sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun telah berhasil dihapus.');
    }

    // ==========================================
    // JURNAL & DASHBOARD
    // ==========================================

    public function dashboardAdmin()
    {
        $totalJurnalHariIni = DB::table('jurnals')->whereDate('tanggal', today())->count();
        $totalSiswa = DB::table('siswas')->count();
        $guruAktif = DB::table('users')->count();
        $totalKelas = DB::table('kelas')->count();

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

        return view('admin.dashboard', compact('jurnalTerbaru', 'totalJurnalHariIni', 'totalKelas', 'guruAktif', 'totalSiswa'));
    }

    public function create()
    {
        $data_kelas = Kelas::all();
        $data_mapel = Mapel::all();
        $data_siswa = Siswa::all();

        return view('jurnal.create', compact('data_kelas', 'data_mapel', 'data_siswa'));
    }

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

    public function show($id)
    {
        $jurnal = Jurnal::with(['mapel', 'kelas', 'absensis.siswa'])->findOrFail($id);
        return response()->json($jurnal);
    }

    public function destroy($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        $jurnal->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    // ==========================================
    // REKAPITULASI & LAINNYA
    // ==========================================

    public function rekapitulasi()
    {
        $jurnals = Jurnal::with(['kelas', 'mapel', 'absensis.siswa'])->latest()->get();
        $totalSesi = Jurnal::count();
        $totalSiswa = Siswa::count();
        $totalTidakHadir = Absensi::whereIn('status', ['Sakit', 'Izin', 'Alpa'])->count();
        $persentase = ($totalSiswa > 0) ? (($totalSiswa - $totalTidakHadir) / $totalSiswa) * 100 : 0;

        return view('admin.rekapitulasi', [
            'jurnals' => $jurnals,
            'totalSesi' => $totalSesi,
            'kehadiran' => number_format($persentase, 1)
        ]);
    }

    public function rekapitulasiApi()
    {
        $jurnals = Jurnal::with(['kelas', 'mapel', 'absensis.siswa'])
            ->latest()
            ->get()
            ->map(function ($jurnal) {
                $jurnal->total_sakit = $jurnal->absensis->where('status', 'Sakit')->count();
                $jurnal->total_izin = $jurnal->absensis->where('status', 'Izin')->count();
                $jurnal->total_alpa = $jurnal->absensis->where('status', 'Alpa')->count();

                $total_siswa_di_kelas = Siswa::where('kelas_id', $jurnal->kelas_id)->count();
                $jurnal->total_hadir = $total_siswa_di_kelas - ($jurnal->total_sakit + $jurnal->total_izin + $jurnal->total_alpa);

                return $jurnal;
            });

        return response()->json([
            'status' => 'success',
            'data' => $jurnals
        ]);
    }

    public function getSiswaByKelas($kelas_id)
    {
        $siswas = Siswa::where('kelas_id', $kelas_id)
            ->orderBy('no_absen', 'asc')
            ->get();

        return response()->json($siswas);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    // ==========================================
    // AUTH
    // ==========================================

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'name' => 'Nama atau password yang Anda masukkan salah.',
        ])->onlyInput('name');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
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
    // 1. Menampilkan Halaman Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 2. Memproses Data Form Login
    public function login(Request $request)
    {
        // Validasi input form wajib diisi
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Mengambil data user berdasarkan kolom 'name' di tabel users (sesuai database kamu)
        $user = DB::table('users')->where('name', $request->username)->first();

        // Validasi kecocokan data user dan password teks biasa (plain text)
        if ($user && $user->password === $request->password) {
            // Login otomatis ke sistem Laravel menggunakan ID user
            Auth::loginUsingId($user->id);
            
            // Menyegarkan session keamanan
            $request->session()->regenerate();
            
            // Mengalihkan langsung ke halaman dashboard admin
            return redirect()->route('dashboard');
        }

        // Jika salah, dikembalikan ke form login beserta pesan peringatan
        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
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
            ->limit(4)
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

    // 5. Menampilkan Halaman Rekapitulasi Data Jurnal
    public function rekapitulasi()
    {
        $jurnals = \App\Models\Jurnal::with(['kelas', 'mapel'])->latest()->get();
        $totalSesi = \App\Models\Jurnal::count();
        $kehadiran = 94.8;

        return view('admin.rekapitulasi', compact('jurnals', 'totalSesi', 'kehadiran'));
    }

    // 6. Menghapus Data Jurnal Berdasarkan ID
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