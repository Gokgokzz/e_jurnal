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

</head>

<body class="bg-[#F4F7FF] text-gray-800">

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

                    <a href="{{ route('rekapitulasi') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-800 font-semibold rounded-xl text-sm transition-all">
                        <i class="fa-solid fa-chart-simple text-lg"></i>
                        Rekapitulasi
                    </a>

                    <a href="{{ route('pengaturan') }}"
                        class="flex items-center gap-3 px-4 py-3 bg-blue-50/70 text-[#6376EB] font-bold rounded-xl text-sm transition-all">
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
                    <h1 class="text-xs font-extrabold text-gray-400 uppercase tracking-widest">Pengaturan</h1>
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

                            @if (session('success'))
                                <div
                                    class="bg-green-100 text-green-700 p-4 rounded-2xl mb-5 text-sm border border-green-200">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-5 text-sm border border-red-200">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-5 text-sm border border-red-200">
                                    <ul class="list-disc pl-5">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 mb-2 ml-1 uppercase tracking-wider">
                                        Kata Sandi Saat Ini
                                    </label>
                                    <div class="relative">
                                        <input type="password" name="current_password" id="current_password"
                                            placeholder="Masukkan kata sandi saat ini"
                                            class="w-full px-5 py-3.5 bg-[#F8FAFF] border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-200 focus:bg-white transition-all text-sm">

                                        <button type="button" onclick="togglePassword('current_password', 'icon-curr')"
                                            class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                            <i id="icon-curr" class="far fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 mb-2 ml-1 uppercase tracking-wider">
                                            Kata Sandi Baru
                                        </label>
                                        <div class="relative">
                                            <input type="password" name="new_password" id="new_password"
                                                placeholder="Masukan password baru"
                                                class="w-full px-5 py-3.5 bg-[#F8FAFF] border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-200 focus:bg-white transition-all text-sm">
                                            <button type="button" onclick="togglePassword('new_password', 'icon-new')"
                                                class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                                <i id="icon-new" class="far fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 mb-2 ml-1 uppercase tracking-wider">
                                            Konfirmasi Password
                                        </label>
                                        <div class="relative">
                                            <input type="password" name="new_password_confirmation" id="new_conf"
                                                placeholder="Ulangi password"
                                                class="w-full px-5 py-3.5 bg-[#F8FAFF] border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-200 focus:bg-white transition-all text-sm">
                                            <button type="button" onclick="togglePassword('new_conf', 'icon-conf')"
                                                class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                                <i id="icon-conf" class="far fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button type="submit"
                                        class="w-full py-4 bg-[#5680F9] hover:bg-blue-700 text-white font-bold rounded-2xl shadow-lg shadow-blue-900/10 hover:shadow-xl transition-all flex items-center justify-center gap-2 text-sm">
                                        <i class="fas fa-check-circle text-xs"></i>
                                        Perbarui Kata Sandi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div
                        class="bg-[#5680F9] rounded-[24px] p-6 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-md">
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
                        <a href="https://wa.me/6289634912424" target="_blank"
                            class="px-6 py-2.5 bg-white text-[#0F296B] font-bold text-xs rounded-xl hover:bg-gray-50 transition-all whitespace-nowrap shadow-sm">
                            Hubungi Tim
                        </a>
                    </div>

                </div>
            </main>
    </div>

    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            // Cek apakah type-nya "password"
            if (input.type === "password") {
                input.type = "text"; // Ubah jadi teks agar terlihat
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash'); // Ganti ikon jadi mata dicoret
            } else {
                input.type = "password"; // Ubah kembali jadi password agar tersembunyi
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye'); // Ganti ikon jadi mata normal
            }
        }
    </script>

</body>

</html>