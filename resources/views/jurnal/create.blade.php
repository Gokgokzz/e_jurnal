<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Jurnal</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-skensa.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-[#F4F7FE] text-slate-800 font-sans antialiased">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 hidden md:flex">
            <div>
                <div class="flex items-center gap-3 mb-10 px-2">
                    <img src="{{ asset('images/logo-skensa.png') }}" class="w-8 h-8" alt="Logo">
                    <div>
                        <h1 class="font-bold text-base text-slate-900 leading-tight">E-Jurnal</h1>
                        <p class="text-xs text-slate-400 font-medium uppercase">SMKN 1 Denpasar</p>
                    </div>
                </div>
                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-800 font-semibold rounded-xl text-sm transition-all">
                        <i class="fa-solid fa-house text-lg"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('jurnal.create') }}"
                        class="flex items-center gap-3 px-4 py-3 bg-[#2D3E75] text-white font-bold rounded-xl text-sm transition-all">
                        <span class="w-5 text-center"><i class="fa-solid fa-pen-to-square text-base"></i></span> Input
                        Jurnal
                    </a>
                    <a href="{{ route('rekapitulasi') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-800 font-semibold rounded-xl text-sm transition-all">
                        <i class="fa-solid fa-chart-simple text-lg"></i>
                        Rekapitulasi
                    </a>
                    <a href="{{ route('pengaturan') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-800 font-semibold rounded-xl text-sm transition-all">
                        <i class="fas fa-cog text-[#2D3E75]"></i>
                        Pengaturan
                    </a>
                </nav>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-4 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-semibold text-sm transition text-left">
                    <span class="w-5 text-center"><i class="fa-solid fa-right-from-bracket text-base"></i></span> Logout
                </button>
            </form>
        </aside>

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 md:p-10">
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-xs font-extrabold text-gray-400 uppercase tracking-widest">Input Jurnal</h1>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('profile') }}"
                            class="flex items-center gap-3 hover:opacity-80 transition-opacity">
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name ?? 'Admin SMK' }}</p>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Administrator</p>
                            </div>
                            <div
                                class="w-10 h-10 bg-[#2D3E75] text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </a>
                    </div>
                </div>
            </header>

            <header class="flex justify-between items-center mb-8">
                <div>
                    
                    <h2 class="text-2xl font-bold text-slate-900">Form Input Jurnal Harian</h2>
                </div>
            </header>

            @if(session('success'))
                <div
                    class="bg-emerald-50 border border-emerald-200 text-emerald-600 px-6 py-4 rounded-2xl mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-lg"></i>
                    <span class="font-semibold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('jurnal.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">

                        <div class="bg-white p-8 rounded-[30px] shadow-sm border border-slate-50">
                            <div class="flex items-center gap-3 mb-6">
                                <div
                                    class="w-8 h-8 bg-[#2D3E75] text-white rounded-lg flex items-center justify-center text-xs">
                                    <i class="fa-solid fa-info-circle"></i>
                                </div>
                                <h4 class="font-bold text-slate-800">Informasi Jurnal</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal
                                        Mengajar</label>
                                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}"
                                        class="w-full bg-[#F4F7FE] border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 transition">
                                </div>
                                <div>
                                    <label
                                        class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Pilih
                                        Kelas</label>
                                    <select name="kelas_id"
                                        class="w-full bg-[#F4F7FE] border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 transition">
                                        @foreach($data_kelas as $kelas)
                                            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Mata
                                        Pelajaran</label>
                                    <select name="mapel_id"
                                        class="w-full bg-[#F4F7FE] border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 transition">
                                        @foreach($data_mapel as $mapel)
                                            <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Jam
                                        Pelajaran</label>
                                    <input type="text" name="jam_pelajaran" placeholder="Contoh: 1 - 4" required
                                        class="w-full bg-[#F4F7FE] border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 transition">
                                </div>
                            </div>

                            <div class="mt-6">
                                <label
                                    class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Materi
                                    Pembelajaran (Ringkasan)</label>
                                <textarea name="materi" rows="4" placeholder="Tuliskan pokok bahasan hari ini..."
                                    class="w-full bg-[#F4F7FE] border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 transition"></textarea>
                            </div>
                        </div>

                        <div class="bg-white p-8 rounded-[30px] shadow-sm border border-slate-50">
                            <div class="flex justify-between items-center mb-6">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 bg-[#2D3E75] text-white rounded-lg flex items-center justify-center text-xs">
                                        <i class="fa-solid fa-circle"></i>
                                    </div>
                                    <h4 class="font-bold text-slate-800">Presensi Siswa</h4>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm border-collapse">
                                    <thead>
                                        <tr
                                            class="text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-50">
                                            <th class="pb-4 pl-2 w-12">No</th>
                                            <th class="pb-4">Nama Siswa</th>
                                            <th class="pb-4 text-center">Hadir</th>
                                            <th class="pb-4 text-center">Sakit</th>
                                            <th class="pb-4 text-center">Izin</th>
                                            <th class="pb-4 text-center">Alpa</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabel-siswa" class="divide-y divide-slate-50">
                                        <tr>
                                            <td colspan="6" class="py-6 text-center text-xs text-slate-400 font-medium">
                                                Silakan pilih kelas terlebih dahulu.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-8 rounded-[30px] shadow-sm border border-slate-50 sticky top-8">
                            <h4 class="font-bold text-slate-800 mb-2 text-sm">Konfirmasi Jurnal</h4>
                            <p class="text-[11px] text-slate-400 font-medium leading-relaxed mb-6">Pastikan data materi
                                dan absensi siswa sudah sesuai sebelum menekan tombol simpan.</p>

                            <div class="space-y-3">
                                <button type="submit"
                                    class="w-full bg-[#2D3E75] hover:bg-[#2D3E55] text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-100 transition flex items-center justify-center gap-3 text-sm">
                                    <i class="fa-solid fa-cloud-arrow-up"></i> Simpan Jurnal
                                </button>
                                <a href="{{ route('dashboard') }}"
                                    class="w-full bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-4 rounded-2xl transition flex items-center justify-center text-sm">
                                    Batalkan
                                </a>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectKelas = document.querySelector('select[name="kelas_id"]');
            const tabelSiswa = document.getElementById('tabel-siswa');

            function muatDataSiswa(kelasId) {
                if (!kelasId) {
                    tabelSiswa.innerHTML = '<tr><td colspan="6" class="py-6 text-center text-xs text-slate-400 font-medium">Silakan pilih kelas terlebih dahulu.</td></tr>';
                    return;
                }

                // Animasi loading saat fetch data
                tabelSiswa.innerHTML = '<tr><td colspan="6" class="py-6 text-center text-xs text-blue-500 font-medium"><i class="fa-solid fa-spinner fa-spin mr-2"></i>Memuat data siswa...</td></tr>';

                // Panggil API
                fetch(`/api/kelas/${kelasId}/siswa`)
                    .then(response => response.json())
                    .then(data => {
                        tabelSiswa.innerHTML = '';

                        if (data.length === 0) {
                            tabelSiswa.innerHTML = '<tr><td colspan="6" class="py-6 text-center text-xs text-slate-400 font-medium">Tidak ada data siswa di kelas ini.</td></tr>';
                            return;
                        }

                        // Render HTML baris demi baris menggunakan 'no_absen' asli dari DB (tanpa NIS)
                        data.forEach(siswa => {
                            const row = `
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="py-4 pl-2 font-semibold text-slate-400 text-xs">${siswa.no_absen}</td>
                                <td class="py-4">
                                    <div class="font-bold text-slate-700 text-xs">${siswa.nama_siswa}</div>
                                </td>
                                <td class="py-4 text-center">
                                    <input type="radio" name="absensi[${siswa.id}]" value="Hadir" checked class="w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500">
                                </td>
                                <td class="py-4 text-center">
                                    <input type="radio" name="absensi[${siswa.id}]" value="Sakit" class="w-4 h-4 text-amber-500 border-slate-300 focus:ring-amber-500">
                                </td>
                                <td class="py-4 text-center">
                                    <input type="radio" name="absensi[${siswa.id}]" value="Izin" class="w-4 h-4 text-purple-500 border-slate-300 focus:ring-purple-500">
                                </td>
                                <td class="py-4 text-center">
                                    <input type="radio" name="absensi[${siswa.id}]" value="Alpa" class="w-4 h-4 text-red-500 border-slate-300 focus:ring-red-500">
                                </td>
                            </tr>
                        `;
                            tabelSiswa.insertAdjacentHTML('beforeend', row);
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        tabelSiswa.innerHTML = '<tr><td colspan="6" class="py-6 text-center text-xs text-red-500 font-medium">Gagal memuat data siswa. Coba segarkan halaman.</td></tr>';
                    });
            }

            // 1. Jalankan fungsi saat halaman pertama kali dibuka
            if (selectKelas.value) {
                muatDataSiswa(selectKelas.value);
            }

            // 2. Jalankan fungsi setiap kali guru mengubah pilihan kelas
            selectKelas.addEventListener('change', function () {
                muatDataSiswa(this.value);
            });
        });
    </script>
</body>

</html>