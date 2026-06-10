<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-skensa.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


</head>

<body class="bg-[#F4F7FF] min-h-screen flex">

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
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 bg-[#2D3E75] text-white font-bold rounded-xl text-sm transition-all">
                    <i class="fa-solid fa-house text-lg"></i>
                    Dashboard
                </a>

                <a href="{{ route('jurnal.create') }}"
                    class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-800 font-semibold rounded-xl text-sm transition-all">
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

        <div>
            <form action="{{ url('/logout') }}" method="POST" id="logout-form" class="hidden">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 font-bold rounded-xl text-sm transition-all">
                <i class="fa-solid fa-right-from-bracket text-lg"></i>
                Logout
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 md:p-10">

        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-xs font-extrabold text-gray-400 uppercase tracking-widest">Dashboard</h1>
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

        <section
            class="bg-[#2D3E75] rounded-[32px] p-8 md:p-12 text-white relative overflow-hidden shadow-lg shadow-blue-500/10 mb-8 flex flex-col md:flex-row md:items-center justify-start gap-6">
            <div class="absolute top-6 right-12 w-20 h-20 bg-white/10 rounded-2xl rotate-12 pointer-events-none"></div>
            <div class="absolute -bottom-6 right-36 w-16 h-16 bg-white/15 rounded-xl -rotate-12 pointer-events-none">
            </div>



            <div class="max-w-xl relative z-10 flex-1 text-left md:pl-20">
                <h2 class="text-xl md:text-2xl font-semibold mb-3 leading-tight">
                    Selamat Datang Kembali, {{ Auth::user()->name }}!
                </h2>
                <p class="text-white/80 text-xs md:text-sm font-medium leading-relaxed mb-3 md:whitespace-nowrap">
                    Pantau kehadiran guru dan siswa secara real-time. Hari ini terdapat beberapa agenda penting yang
                    perlu divalidasi.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('rekapitulasi') }}" <button
                        class="px-5 py-2.5 bg-white text-[#2D3E75] font-semibold rounded-xl text-xs hover:bg-opacity-90 transition-all shadow-sm">
                        Lihat Jadwal
                        </button>
                    </a>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8 w-full">

            <div
                class="bg-white p-5 rounded-[24px] border border-gray-100 shadow-sm flex flex-col justify-start h-[150px] md:h-[160px] relative transition-all hover:shadow-md">
                <div class="flex justify-between items-center w-full">
                    <div
                        class="w-11 h-11 bg-[#2D3E75] text-white rounded-2xl flex items-center justify-center text-lg shadow-sm">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">
                        HARI INI
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

            <div
                class="bg-white p-5 rounded-[24px] border border-gray-100 shadow-sm flex flex-col justify-start h-[150px] md:h-[160px] relative transition-all hover:shadow-md">
                <div class="flex justify-between items-center w-full">
                    <div
                        class="w-11 h-11 bg-[#2D3E75] text-white rounded-2xl flex items-center justify-center text-lg shadow-sm">
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
                        43
                    </h3>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-[24px] border border-gray-100 shadow-sm flex flex-col justify-start h-[150px] md:h-[160px] relative transition-all hover:shadow-md">
                <div class="flex justify-between items-center w-full">
                    <div
                        class="w-11 h-11 bg-[#2D3E75] text-white rounded-2xl flex items-center justify-center text-lg shadow-sm">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">
                        +2
                    </span>
                </div>

                <div class="flex flex-col items-start mt-3.5 space-y-0.5">
                    <p class="text-sm md:text-base text-slate-400 uppercase tracking-wider font-semibold leading-tight">
                        Guru Aktif
                    </p>
                    <h3 class="text-2xl md:text-3xl font-black text-slate-800 tracking-tight">
                        {{ $guruAktif ?? '0' }}
                    </h3>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-[24px] border border-gray-100 shadow-sm flex flex-col justify-start h-[150px] md:h-[160px] relative transition-all hover:shadow-md">
                <div class="flex justify-between items-center w-full">
                    <div
                        class="w-11 h-11 bg-[#2D3E75] text-white rounded-2xl flex items-center justify-center text-lg shadow-sm">
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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">

            <div
                class="md:col-span-2 bg-white rounded-[32px] border border-gray-100 p-6 md:p-8 flex flex-col shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-extrabold text-slate-800 text-lg">Entri Jurnal Terbaru</h3>
                    <a href="{{ route('rekapitulasi') }}"
                        class="text-xs font-bold text-[#2D3E75] hover:text-[#2D3E55] transition-colors flex items-center gap-1">
                        Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="overflow-y-auto max-h-[350px] pr-2">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="pb-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">KELAS
                                </th>
                                <th class="pb-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">GURU
                                </th>
                                <th class="pb-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">MAPEL
                                </th>
                                <th class="pb-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">
                                    STATUS</th>
                                <th class="pb-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">AKSI
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($jurnalTerbaru as $jurnal)
                                <tr>
                                    <td class="py-4 text-sm text-gray-600">{{ $jurnal->nama_kelas }}</td>
                                    <td class="py-4 text-sm text-gray-600">{{ $jurnal->nama_guru }}</td>
                                    <td class="py-4 text-sm text-gray-600">{{ $jurnal->mata_pelajaran }}</td>
                                    <td class="py-4 text-sm text-gray-600">
                                        @if($jurnal->status == 'Selesai' || $jurnal->status == 'Terisi')
                                            <span
                                                class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase">
                                                {{ $jurnal->status }}
                                            </span>
                                        @else
                                            <span
                                                class="bg-red-50 text-red-500 px-3 py-1 rounded-full text-[10px] font-bold uppercase">
                                                {{ $jurnal->status ?? 'Belum Diisi' }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-sm text-gray-600 relative">
                                        <button type="button" onclick="toggleDropdown(this)"
                                            class="p-2 hover:bg-gray-100 rounded-full transition">
                                            <i class="fa-solid fa-ellipsis-vertical text-gray-400"></i>
                                        </button>
                                        <div
                                            class="dropdown-menu hidden absolute right-0 z-50 mt-2 w-32 bg-white border border-gray-100 rounded-xl shadow-2xl">
                                            <form action="{{ route('jurnal.destroy', $jurnal->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">Hapus</button>
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
                <div class="space-y-4">
                    <div class="bg-white rounded-[32px] border border-gray-100 p-6 md:p-8 shadow-sm mt-8">
                        <h3 class="font-extrabold text-gray-800 text-lg mb-6">Guru Belum Mengisi</h3>
                        <div class="space-y-3">
                            @forelse($guruBelumMengisi as $guru)
                                <div class="flex items-center gap-3 p-3 bg-red-50 rounded-xl transition-all">
                                    <div
                                        class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold text-xs">
                                        {{ substr($guru->name, 0, 1) }}
                                    </div>
                                    <p class="text-sm font-semibold text-gray-700">{{ $guru->name }}</p>
                                </div>
                            @empty
                                <div class="flex items-center gap-3 p-4 bg-emerald-50 rounded-xl text-emerald-600">
                                    <i class="fa-solid fa-check-circle"></i>
                                    <p class="text-sm font-bold">Semua guru sudah mengisi!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
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