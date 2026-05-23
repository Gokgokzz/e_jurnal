<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi</title>
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
                        <i class="fa-solid fa-chart-pie w-5 text-center"></i> Dashboard
                    </a>
                    <a href="{{ route('jurnal.create') }}"
                        class="flex items-center gap-4 px-4 py-3 text-slate-400 hover:text-blue-600 rounded-xl font-medium text-sm transition">
                        <i class="fa-solid fa-pen-to-square w-5 text-center"></i> Input Jurnal
                    </a>
                    <a href="#"
                        class="flex items-center gap-4 px-4 py-3 bg-blue-50 text-blue-600 rounded-xl font-semibold text-sm transition">
                        <i class="fa-solid fa-chart-simple w-5 text-center"></i> Rekapitulasi
                    </a>
                </nav>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-4 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-semibold text-sm transition text-left">
                    <i class="fa-solid fa-right-from-bracket w-5 text-center"></i> Logout
                </button>
            </form>
        </aside>

        <main class="flex-1 ml-64 p-8">
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
                            @foreach($jurnals as $jurnal)
                                {{-- Baris Utama (Diklik untuk trigger) --}}
                                <tr onclick="toggleDetail({{ $jurnal->id }})"
                                    class="cursor-pointer hover:bg-slate-50 transition border-b border-gray-100">
                                    <td class="py-4 font-medium text-slate-900">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                                                <i class="fa-solid fa-book"></i>
                                            </div>
                                            {{ $jurnal->mapel?->nama_mapel ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="py-4 text-slate-600">{{ $jurnal->kelas?->nama_kelas ?? '-' }}</td>
                                    <td class="py-4 text-slate-600 italic">{{ Str::limit($jurnal->materi, 30) }}</td>
                                    <td class="py-4">
                                        <span
                                            class="{{ !empty($jurnal->materi) ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-500' }} px-3 py-1 rounded-full text-[10px] font-bold uppercase">
                                            {{ !empty($jurnal->materi) ? 'Terisi' : 'Belum Terisi' }}
                                        </span>
                                    </td>
                                </tr>

                                {{-- Baris Detail (Awalnya Hidden) --}}
                                <tr id="detail-{{ $jurnal->id }}" class="hidden bg-slate-50">
                                    <td colspan="4" class="p-6">
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                            <div>
                                                <p class="text-[10px] font-bold text-slate-400 uppercase">Tanggal</p>
                                                <p class="text-sm">
                                                    {{ $jurnal->created_at ? $jurnal->created_at->format('d/m/Y') : '-' }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-[10px] font-bold text-slate-400 uppercase">Kelas</p>
                                                <p class="text-sm">{{ $jurnal->kelas?->nama_kelas ?? '-' }}</p>
                                            </div>
                                            <div>
                                                <p class="text-[10px] font-bold text-slate-400 uppercase">Materi</p>
                                                <p class="text-sm">{{ $jurnal->materi ?? '-' }}</p>
                                            </div>
                                        </div>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase mb-2">Daftar Kehadiran</p>
                                        <ul class="list-disc list-inside text-sm text-slate-600">
                                            @forelse($jurnal->absensis ?? [] as $absen)
                                                <li>
                                                    {{-- Menggunakan nama_siswa sesuai struktur database Anda --}}
                                                    {{ $absen->siswa->nama_siswa ?? 'Siswa (ID: ' . $absen->siswa_id . ')' }}
                                                    - <span class="font-semibold text-red-500">{{ $absen->status }}</span>
                                                </li>
                                            @empty
                                                <li class="italic text-gray-400">Semua siswa hadir</li>
                                            @endforelse
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <div id="modalDetail"
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-[30px] p-8 max-w-lg w-full mx-4 shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-slate-900">Detail Jurnal</h2>
                <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600"><i
                        class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <div class="space-y-4 text-sm">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Tanggal</p>
                        <p id="modalTanggal" class="font-medium text-slate-700"></p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Kelas</p>
                        <p id="modalKelas" class="font-medium text-slate-700"></p>
                    </div>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase">Materi</p>
                    <p id="modalMateri" class="text-slate-700 italic"></p>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase mb-2">Daftar Siswa Tidak Hadir</p>
                    <ul id="modalAbsensi"
                        class="bg-slate-50 p-4 rounded-xl text-slate-600 list-disc list-inside space-y-1 max-h-40 overflow-y-auto">
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDetail(id) {
            const detailRow = document.getElementById('detail-' + id);
            if (detailRow) {
                // Jika mengandung 'hidden', hapus. Jika tidak, tambahkan.
                detailRow.classList.toggle('hidden');
            } else {
                console.log('ID detail-' + id + ' tidak ditemukan');
            }
        }
    </script>

</html>