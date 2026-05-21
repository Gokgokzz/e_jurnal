<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-skensa.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
        }
    </style>
</head>

<body class="min-h-screen flex">

    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 hidden md:flex">
        <div>
            <div class="flex items-center gap-3 mb-10 px-2">
                <img src="{{ asset('images/logo smk1.jpeg') }}" class="w-8 h-8" alt="Logo">
                <div>
                    <h1 class="font-bold text-base text-slate-900 leading-tight">E-Jurnal</h1>
                    <p class="text-xs text-slate-400 font-medium uppercase">SMKN 1 Denpasar</p>
                </div>
            </div>

            <nav class="space-y-2">
                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-blue-50/70 text-[#6376EB] font-bold rounded-xl text-sm transition-all">
                    <i class="fa-solid fa-house text-lg"></i>
                    Dashboard
                </a>
                <a href="{{ route('jurnal.create') }}" class="flex items-center gap-4 px-4 py-3 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl font-medium text-sm transition">
                    <span class="w-5 text-center"><i class="fa-solid fa-pen-to-square text-base"></i></span> Input Jurnal
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-800 font-semibold rounded-xl text-sm transition-all">
                    <i class="fa-solid fa-chart-simple text-lg"></i>
                    Rekapitulasi
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-800 font-semibold rounded-xl text-sm transition-all">
                    <i class="fa-solid fa-gear text-lg"></i>
                    Pengaturan
                </a>
            </nav>
        </div>

        <div>
            <form action="{{ url('/logout') }}" method="POST" id="logout-form" class="hidden">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 font-bold rounded-xl text-sm transition-all">
                <i class="fa-solid fa-right-from-bracket text-lg"></i>
                Keluar
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 md:p-10">

        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-xs font-extrabold text-gray-400 uppercase tracking-widest">Dashboard</h1>
            </div>

            <div class="flex items-center gap-6">
                <button class="relative text-gray-400 hover:text-gray-600 transition-all">
                    <i class="fa-solid fa-bell text-xl"></i>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name ?? 'Admin SMK' }}</p>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Administrator</p>
                    </div>
                    <div class="w-10 h-10 bg-[#7A95E8] text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">
                        AD
                    </div>
                </div>
            </div>
        </header>

        <section class="bg-gradient-to-r from-[#6376EB] to-[#7A95E8] rounded-[32px] p-8 md:p-12 text-white relative overflow-hidden shadow-lg shadow-blue-500/10 mb-8 flex flex-col md:flex-row md:items-center justify-start gap-6">
            <div class="absolute top-6 right-12 w-20 h-20 bg-white/10 rounded-2xl rotate-12 pointer-events-none"></div>
            <div class="absolute -bottom-6 right-36 w-16 h-16 bg-white/15 rounded-xl -rotate-12 pointer-events-none"></div>

            <div class="relative flex justify-center md:justify-start items-end h-40 md:h-48 w-full md:w-auto flex-shrink-0">
                <img src="{{ asset('images/siswa.png') }}" class="h-full w-auto object-contain object-bottom select-none pointer-events-none z-10" alt="Ilustrasi Siswa">
            </div>

            <div class="max-w-xl relative z-10 flex-1 text-left md:pl-20">
                <h2 class="text-xl md:text-2xl font-semibold mb-3 leading-tight">
                    Selamat Datang kembali, Admin!
                </h2>
                <p class="text-white/80 text-xs md:text-sm font-medium leading-relaxed mb-3 md:whitespace-nowrap">
                    Pantau kehadiran guru dan siswa secara real-time. Hari ini terdapat beberapa agenda penting yang perlu divalidasi.
                </p>
                <div class="flex flex-wrap gap-3">
                    <button class="px-5 py-2.5 bg-white text-[#6376EB] font-semibold rounded-xl text-xs hover:bg-opacity-90 transition-all shadow-sm">
                        Lihat Jadwal
                    </button>
                    <button class="px-5 py-2.5 bg-white/20 border border-white/10 text-white font-semibold rounded-xl text-xs hover:bg-white/30 transition-all">
                        Download Laporan
                    </button>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8 w-full">

            <div class="bg-white p-5 rounded-[24px] border border-gray-100 shadow-sm flex flex-col justify-start h-[150px] md:h-[160px] relative transition-all hover:shadow-md">
                <div class="flex justify-between items-center w-full">
                    <div class="w-11 h-11 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-lg shadow-sm">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <span class="bg-emerald-50 text-emerald-600 px-2.5 py-0.5 rounded-full text-[10px] font-bold">
                        84%
                    </span>
                </div>

                <div class="flex flex-col items-start mt-3.5 space-y-0.5">
                    <p class="text-sm md:text-base text-slate-400 uppercase tracking-wider font-semibold leading-tight">
                        Jurnal Terisi Hari Ini
                    </p>
                    <h3 class="text-2xl md:text-3xl font-black text-slate-800 tracking-tight">
                        {{ $totalJurnalHariIni ?? '1' }}<span class="text-sm font-bold text-slate-300 ml-1">/ 50</span>
                    </h3>
                </div>
            </div>

            <div class="bg-white p-5 rounded-[24px] border border-gray-100 shadow-sm flex flex-col justify-start h-[150px] md:h-[160px] relative transition-all hover:shadow-md">
                <div class="flex justify-between items-center w-full">
                    <div class="w-11 h-11 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-lg shadow-sm">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">
                        Tetap
                    </span>
                </div>

                <div class="flex flex-col items-start mt-3.5 space-y-0.5">
                    <p class="text-sm md:text-base text-slate-400 uppercase tracking-wider font-semibold leading-tight">
                        Total Siswa
                    </p>
                    <h3 class="text-2xl md:text-3xl font-black text-slate-800 tracking-tight">
                        1.200
                    </h3>
                </div>
            </div>

            <div class="bg-white p-5 rounded-[24px] border border-gray-100 shadow-sm flex flex-col justify-start h-[150px] md:h-[160px] relative transition-all hover:shadow-md">
                <div class="flex justify-between items-center w-full">
                    <div class="w-11 h-11 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center text-lg shadow-sm">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <span class="bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-full text-[10px] font-bold">
                        +2
                    </span>
                </div>

                <div class="flex flex-col items-start mt-3.5 space-y-0.5">
                    <p class="text-sm md:text-base text-slate-400 uppercase tracking-wider font-semibold leading-tight">
                        Guru Aktif
                    </p>
                    <h3 class="text-2xl md:text-3xl font-black text-slate-800 tracking-tight">
                        {{ $guruAktif ?? '85' }}
                    </h3>
                </div>
            </div>

            <div class="bg-white p-5 rounded-[24px] border border-gray-100 shadow-sm flex flex-col justify-start h-[150px] md:h-[160px] relative transition-all hover:shadow-md">
                <div class="flex justify-between items-center w-full">
                    <div class="w-11 h-11 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center text-lg shadow-sm">
                        <i class="fa-solid fa-door-open"></i>
                    </div>
                    <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">
                        Tersedia
                    </span>
                </div>

                <div class="flex flex-col items-start mt-3.5 space-y-0.5">
                    <p class="text-sm md:text-base text-slate-400 uppercase tracking-wider font-semibold leading-tight">
                        Kelas
                    </p>
                    <h3 class="text-2xl md:text-3xl font-black text-slate-800 tracking-tight">
                        {{ $totalKelas ?? '36' }}
                    </h3>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 flex-1">

            <div class="lg:col-span-2 bg-white rounded-[32px] border border-gray-100 p-6 md:p-8 flex flex-col shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-extrabold text-gray-800 text-lg">Entri Jurnal Terbaru</h3>
                    <a href="#" class="text-xs font-bold text-[#6376EB] hover:underline flex items-center gap-1">
                        Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="pb-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">KELAS</th>
                                <th class="pb-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">GURU</th>
                                <th class="pb-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">MAPEL</th>
                                <th class="pb-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">STATUS</th>
                                <th class="pb-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">AKSI</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-50">
                            @foreach($jurnalTerbaru as $jurnal)
                                <tr>
                                    <td class="py-4 text-sm text-gray-600">{{ $jurnal->nama_kelas }}</td>
                                    <td class="py-4 text-sm text-gray-600">{{ $jurnal->nama_guru }}</td>
                                    <td class="py-4 text-sm text-gray-600">{{ $jurnal->mata_pelajaran }}</td>
                                    <td class="py-4 text-sm text-gray-600">
                                        @if($jurnal->status == 'Selesai' || $jurnal->status == 'Terisi')
                                            <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase">
                                                {{ $jurnal->status }}
                                            </span>
                                        @else
                                            <span class="bg-red-50 text-red-500 px-3 py-1 rounded-full text-[10px] font-bold uppercase">
                                                {{ $jurnal->status ?? 'Belum Diisi' }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-sm text-gray-600 relative">
                                        <button type="button" onclick="toggleDropdown(this)" class="p-2 hover:bg-gray-100 rounded-full transition">
                                            <i class="fa-solid fa-ellipsis-vertical text-gray-400"></i>
                                        </button>

                                        <div class="dropdown-menu hidden absolute right-0 z-50 mt-2 w-32 bg-white border border-gray-100 rounded-xl shadow-2xl">
                                            <form action="{{ route('jurnal.destroy', $jurnal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-[32px] border border-gray-100 p-6 md:p-8 shadow-sm">
                <h3 class="font-extrabold text-gray-800 text-lg mb-6">Akses Cepat</h3>

                <div class="space-y-4">
                    <a href="#" class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-blue-50/50 transition-all group">
                        <div class="w-12 h-12 bg-blue-100 text-[#6376EB] rounded-xl flex items-center justify-center text-xl group-hover:bg-[#6376EB] group-hover:text-white transition-all">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">Kelola Data Guru</h4>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Tambah & atur akun pendidik</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-pink-50/50 transition-all group">
                        <div class="w-12 h-12 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-pink-600 group-hover:text-white transition-all">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">Sinkronisasi Jadwal</h4>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Import data mata pelajaran</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-emerald-50/50 transition-all group">
                        <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <i class="fa-solid fa-bullhorn"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">Kirim Pengumuman</h4>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Broadcast info ke guru/kelas</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </main>

</body>

<script>
    function toggleDropdown(button) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            if (menu !== button.nextElementSibling) {
                menu.classList.add('hidden');
            }
        });
        button.nextElementSibling.classList.toggle('hidden');
    }

    window.addEventListener('click', function (e) {
        if (!e.target.closest('button[onclick="toggleDropdown(this)"]')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
        }
    });
</script>

</html>