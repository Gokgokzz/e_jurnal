<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-skensa.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-[#F4F7FE] text-slate-800 font-sans antialiased">

    <div class="flex min-h-screen">
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
                        class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-800 font-semibold rounded-xl text-sm transition-all">
                        <i class="fa-solid fa-house text-lg"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('jurnal.create') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-800 font-semibold rounded-xl text-sm transition-all">
                        <span class="w-5 text-center"><i class="fa-solid fa-pen-to-square text-base"></i></span> Input
                        Jurnal
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-3 bg-blue-50/70 text-[#6376EB] font-bold rounded-xl text-sm transition-all">
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
                    <h1 class="text-xs font-extrabold text-gray-400 uppercase tracking-widest">Rekapitulasi</h1>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('profile') }}"
                            class="flex items-center gap-3 hover:opacity-80 transition-opacity">
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name ?? 'Admin SMK' }}</p>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Administrator
                                </p>
                            </div>
                            <div
                                class="w-10 h-10 bg-[#7A95E8] text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </div>
                        </a>
                    </div>
                </div>
            </header>

            <header class="mb-8">

                <h2 class="text-2xl font-bold text-slate-900">Rekapitulasi Jurnal Mengajar</h2>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-[20px] shadow-sm border border-slate-50">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Total Sesi</p>
                    <h3 class="text-2xl font-bold text-slate-900">{{ $totalSesi }} <span
                            class="text-sm text-slate-400 font-medium">Sesi</span></h3>
                </div>
                <div class="bg-white p-6 rounded-[20px] shadow-sm border border-slate-50">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Kehadiran Siswa</p>
                    <h3 class="text-2xl font-bold text-slate-900">{{ $kehadiran }}%</h3>
                </div>
            </div>

            <div class="bg-white p-8 rounded-[30px] shadow-sm border border-slate-50">
                <h4 class="font-bold text-slate-800 mb-6">Riwayat Jurnal Terakhir</h4>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse($jurnals as $jurnal)
                        <div
                            class="bg-white p-6 rounded-[20px] shadow-sm border border-slate-50 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-4">
                                <span class="bg-blue-100 px-1.5 py-1 shapes-full text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                    {{ $jurnal->kelas->nama_kelas ?? 'Kelas -' }}
                                </span>

                                @if(!empty(trim($jurnal->materi)))
                                    <span
                                        class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase">Terisi</span>
                                @else
                                    <span
                                        class="bg-red-50 text-red-500 px-3 py-1 rounded-full text-[10px] font-bold uppercase">Belum
                                        Terisi</span>
                                @endif
                            </div>

                            <h3 class="font-bold text-slate-800 text-lg mb-2">
                                {{ $jurnal->mapel->nama_mapel ?? 'Mapel Tidak Ditemukan' }}
                            </h3>

                            <div class="text-slate-500 text-xs leading-relaxed line-clamp-3 mb-4">
                                <span class="font-bold text-slate-700">Materi:</span>
                                {{ $jurnal->materi ?? 'Belum ada ringkasan materi.' }}
                            </div>

                            <div class="pt-4 border-t border-slate-50 flex items-center text-slate-400 text-[10px]">
                                <i class="fa-regular fa-clock mr-1"></i>
                                <span>{{ $jurnal->created_at ? $jurnal->created_at->format('d M Y') : 'Baru saja' }}</span>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full py-10 text-center text-slate-400 bg-white rounded-[20px] border border-dashed border-slate-200">
                            <i class="fa-solid fa-inbox text-3xl mb-2 opacity-50"></i>
                            <p>Belum ada data jurnal yang tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</body>

</html>