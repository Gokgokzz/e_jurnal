<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan E-Jurnal - SMKN 1 Denpasar</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F4F7FF] text-gray-800">

    <div class="flex min-h-screen">

        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between fixed h-screen z-10">
            <div>
                <div class="p-6 flex items-center gap-3 border-b border-gray-50">
                    <div
                        class="w-10 h-10 bg-[#2D3E75] rounded-xl flex items-center justify-center text-white shadow-md">
                        <i class="fas fa-graduation-cap text-lg"></i>
                    </div>
                    <div>
                        <h1 class="font-extrabold text-base text-gray-900 tracking-tight">E-Jurnal</h1>
                        <p class="text-[10px] text-gray-400 font-semibold tracking-wider uppercase">SMKN 1 DENPASAR</p>
                    </div>
                </div>

                <nav class="p-4 space-y-1.5 mt-4">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3.5 px-4 py-3 text-gray-500 hover:text-[#6786DC] hover:bg-blue-50/50 rounded-xl font-semibold text-sm transition-all group">
                        <i class="fas fa-th-large text-gray-400 group-hover:text-[#6786DC] transition-colors"></i>
                        Dashboard
                    </a>

                    <a href="{{ route('jurnal.create') }}"
                        class="flex items-center gap-3.5 px-4 py-3 text-gray-500 hover:text-[#6786DC] hover:bg-blue-50/50 rounded-xl font-semibold text-sm transition-all group">
                        <i class="fas fa-edit text-gray-400 group-hover:text-[#6786DC] transition-colors"></i>
                        Input Jurnal
                    </a>

                    <a href="{{ route('rekapitulasi') }}"
                        class="flex items-center gap-3.5 px-4 py-3 text-gray-500 hover:text-[#6786DC] hover:bg-blue-50/50 rounded-xl font-semibold text-sm transition-all group">
                        <i class="fas fa-chart-bar text-gray-400 group-hover:text-[#6786DC] transition-colors"></i>
                        Rekapitulasi
                    </a>

                    <a href="{{ route('pengaturan') }}"
                        class="flex items-center gap-3.5 px-4 py-3 bg-[#E8EFFF] text-[#2D3E75] rounded-xl font-bold text-sm transition-all">
                        <i class="fas fa-cog text-[#2D3E75]"></i>
                        Pengaturan
                    </a>
                </nav>
            </div>

            <div class="p-4 border-t border-gray-50">
                <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">
                    @csrf
                </form>

                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="flex items-center gap-3.5 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-bold text-sm transition-all">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col ml-64">

            <header
                class="h-20 bg-white border-b border-gray-100 flex items-center justify-end px-8 gap-6 sticky top-0 z-50">
                <button
                    class="w-10 h-10 rounded-xl bg-gray-50 hover:bg-gray-100 flex items-center justify-center text-gray-400 hover:text-gray-600 transition-all">
                    <i class="fas fa-sliders-h text-sm"></i>
                </button>

                <div class="h-8 w-px bg-gray-200/60"></div>

                <div class="flex items-center gap-3.5">
                    <div class="text-right">
                        <h4 class="text-sm font-bold text-gray-900 leading-tight">Admin</h4>
                        <p class="text-[10px] font-extrabold text-gray-400 tracking-wider uppercase">ADMINISTRATOR</p>
                    </div>
                    <div
                        class="w-11 h-11 bg-gray-100 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 shadow-sm overflow-hidden">
                        <i class="fas fa-user text-base"></i>
                    </div>
                </div>
            </header>

            <main class="p-8 flex-1">

                <div class="text-center mb-10 mt-4">
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-2 tracking-tight">Pengaturan</h1>
                    <p class="text-gray-400 font-medium text-sm">Personalisasi pengalaman Anda di E-Jurnal</p>
                </div>

                <div class="max-w-2xl mx-auto space-y-6">

                    <div class="bg-white rounded-[32px] shadow-sm border border-gray-100/80 overflow-hidden">
                        <div class="p-8">
                            <div class="flex items-center gap-3 mb-8">
                                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-shield-alt text-[#6786DC]"></i>
                                </div>
                                <h2 class="text-lg font-bold text-gray-900">Keamanan Akun</h2>
                            </div>

                            <form action="#" method="POST" class="space-y-5">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 mb-2 ml-1 uppercase tracking-wider">Kata
                                        Sandi Saat Ini</label>
                                    <div class="relative">
                                        <input type="password" name="current_password" placeholder="••••••••"
                                            class="w-full px-5 py-3.5 bg-[#F8FAFF] border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-200 focus:bg-white transition-all text-sm">
                                        <button type="button"
                                            class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 mb-2 ml-1 uppercase tracking-wider">Kata
                                            Sandi Baru</label>
                                        <input type="password" name="new_password" placeholder="Masukan kata sandi baru"
                                            class="w-full px-5 py-3.5 bg-[#F8FAFF] border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-200 focus:bg-white transition-all text-sm">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 mb-2 ml-1 uppercase tracking-wider">Konfirmasi</label>
                                        <input type="password" name="new_password_confirmation"
                                            placeholder="Ulangi Sandi"
                                            class="w-full px-5 py-3.5 bg-[#F8FAFF] border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-200 focus:bg-white transition-all text-sm">
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button type="submit"
                                        class="w-full py-4 bg-[#1E3A8A] hover:bg-[#1A3175] text-white font-bold rounded-2xl shadow-lg shadow-blue-900/10 hover:shadow-xl transition-all flex items-center justify-center gap-2 text-sm">
                                        <i class="fas fa-check-circle text-xs"></i>
                                        Perbarui Kata Sandi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div
                        class="bg-[#0F296B] rounded-[24px] p-6 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-md">
                        <div class="flex items-center gap-4 text-center sm:text-left flex-col sm:flex-row">
                            <div
                                class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-question-circle text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-bold text-base">Butuh Bantuan?</h3>
                                <p class="text-white/60 text-xs mt-0.5">Hubungi IT Support SMK Negeri 1 Denpasar</p>
                            </div>
                        </div>
                        <a href="https://wa.me/62812345678" target="_blank"
                            class="px-6 py-2.5 bg-white text-[#0F296B] font-bold text-xs rounded-xl hover:bg-gray-50 transition-all whitespace-nowrap shadow-sm">
                            Hubungi Tim
                        </a>
                    </div>

                </div>
            </main>
        </div>

    </div>

</body>

</html>