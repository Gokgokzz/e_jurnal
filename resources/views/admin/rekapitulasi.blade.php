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
                        class="flex items-center gap-3 px-4 py-3 bg-[#2D3E75] text-white font-bold rounded-xl text-sm transition-all">
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
                                class="w-10 h-10 bg-[#2D3E75] text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">
                                {{ substr(Auth::user()->name, 0, 1) }}
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
                        <div onclick="openModal({{ $jurnal->id }})"
                            class="bg-white p-6 rounded-[20px] shadow-sm border border-slate-50 hover:shadow-md transition-shadow cursor-pointer">

                            <div class="flex justify-between items-start mb-4">
                                <span
                                    class="bg-[#2D3E75] px-1.5 py-1 shapes-full text-[10px] font-bold text-white uppercase tracking-wider">
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

                            <div class="flex items-center gap-2 mb-4 text-slate-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-semibold">{{ $jurnal->formatted_jam }}</span>
                            </div>

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
                    @endforelse
                </div>
            </div>
        </main>
    </div>
    <div id="absensiModal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white rounded-[30px] w-full max-w-sm p-8 shadow-xl relative">
            <button onclick="closeModal()" class="absolute top-6 right-6 text-slate-400 hover:text-slate-600">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
            <h3 class="font-bold text-slate-800 text-lg mb-6">Siswa Tidak Hadir</h3>
            <div id="modalContent" class="space-y-3">
                <p class="text-center text-slate-400">Memuat data...</p>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('absensiModal');
        const modalContent = document.getElementById('modalContent');

        function openModal(id) {
            modal.classList.remove('hidden');
            modalContent.innerHTML = '<p class="text-center">Memuat data...</p>';

            // Mengambil data jurnal berdasarkan ID
            fetch(`/jurnal/${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Data yang diterima:", data);
                    // Asumsi data absensi ada di properti 'absensis'
                    const absensi = data.absensis || [];
                    const tidakHadir = absensi.filter(a => a.status !== 'Hadir');

                    if (tidakHadir.length > 0) {
                        let html = '<ul class="space-y-2">';
                        tidakHadir.forEach(item => {
                            // Perbaikan: Gunakan ?. dan || untuk menangani jika siswa tidak ada
                            const namaSiswa = item.siswa?.nama_siswa || 'Nama Tidak Diketahui';
                            
                            html += `
                            <li class="flex justify-between items-center bg-red-50 p-3 rounded-xl">
                                <span class="font-medium text-slate-700 text-sm">${namaSiswa}</span>
                                <span class="text-[10px] font-bold text-red-500 bg-white px-2 py-1 rounded-lg">${item.status}</span>
                            </li>`;
                        });
                        html += '</ul>';
                        modalContent.innerHTML = html;
                    } else {
                        modalContent.innerHTML = '<p class="text-center text-emerald-600 font-bold">Semua siswa hadir!</p>';
                    }
                })
                .catch(() => {
                    modalContent.innerHTML = '<p class="text-center text-red-500">Gagal memuat data.</p>';
                });
        }

        function closeModal() {
            modal.classList.add('hidden');
        }
    </script>
</body>

</html>