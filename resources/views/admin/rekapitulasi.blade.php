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
        <aside class="w-64 bg-white border-r border-slate-100 flex flex-col justify-between p-6 fixed h-full">
            <div>
                <div class="flex items-center gap-3 mb-10 px-2">
                    <img src="{{ asset('images/logo smk1.jpeg') }}" class="w-8 h-8" alt="Logo">
                    <div>
                        <h1 class="font-bold text-base text-slate-900 leading-tight">E-Jurnal</h1>
                        <p class="text-xs text-slate-400 font-medium uppercase">SMKN 1 Denpasar</p>
                    </div>
                </div>
                <nav class="space-y-1.5">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-4 px-4 py-3 text-slate-400 hover:text-blue-600 rounded-xl font-medium text-sm transition">
                        <span class="w-5 text-center"><i class="fa-solid fa-chart-pie text-base"></i></span> Dashboard
                    </a>
                    <a href="{{ route('jurnal.create') }}"
                        class="flex items-center gap-4 px-4 py-3 text-slate-400 hover:text-blue-600 rounded-xl font-medium text-sm transition">
                        <span class="w-5 text-center"><i class="fa-solid fa-pen-to-square text-base"></i></span> Input
                        Jurnal
                    </a>
                    <a href="#"
                        class="flex items-center gap-4 px-4 py-3 bg-blue-50 text-blue-600 rounded-xl font-semibold text-sm transition">
                        <span class="w-5 text-center"><i class="fa-solid fa-chart-simple text-lg"></i></span>
                        Rekapitulasi
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

        <main class="flex-1 ml-64 p-8">
            <header class="mb-8">
                <nav class="flex text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                    <span class="mx-2">/</span>
                    <span class="text-slate-600">Rekapitulasi</span>
                </nav>
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

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse">
                        <thead>
                            <tr class="text-slate-400 uppercase text-[10px] font-bold tracking-wider">
                                <th class="pb-4">Mata Pelajaran</th>
                                <th class="pb-4">Kelas</th>
                                <th class="pb-4">Materi</th>
                                <th class="pb-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($jurnals as $jurnal)
                                <tr>
                                    <td class="py-4 font-medium text-slate-900">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                                                <i class="fa-solid fa-book"></i>
                                            </div>
                                            {{ $jurnal->mapel->nama_mapel ?? 'Mapel Tidak Ditemukan' }}
                                        </div>
                                    </td>
                                    <td class="py-4 text-slate-600">{{ $jurnal->kelas->nama_kelas ?? 'Kelas -' }}</td>
                                    <td class="py-4 text-slate-600 italic">{{ Str::limit($jurnal->materi, 30) }}</td>
                                    <td class="py-4">
                                        @if($jurnal->status == 'Terisi' || $jurnal->status == 'Selesai')
                                            <span
                                                class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase">Terisi</span>
                                        @else
                                            <span
                                                class="bg-red-50 text-red-500 px-3 py-1 rounded-full text-[10px] font-bold uppercase">Belum
                                                Terisi</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-slate-400">Belum ada data jurnal.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>