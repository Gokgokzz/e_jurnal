<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-skensa.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .bg-custom-gradient {
            background: linear-gradient(180deg, #a3acca 0%, #c5d1eb 100%);
        }
    </style>
</head>

<body class="bg-custom-gradient min-h-screen flex items-center justify-center p-4 md:p-8">

    <div
        class="bg-white/40 backdrop-blur-xl rounded-[40px] shadow-2xl w-full max-w-[1050px] flex overflow-hidden border border-white/60 p-5 min-h-[600px]">

        <div class="w-full lg:w-1/2 p-6 md:p-10 flex flex-col justify-between">

            <div class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo-skensa.png') }}" class="w-8 h-8 object-contain" alt="Logo Skensa">
                <span class="text-[11px] font-extrabold text-gray-700 uppercase tracking-wider">SMK Negeri 1
                    Denpasar</span>
            </div>

            <div class="my-auto py-6">
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-extrabold text-gray-900 mb-2 tracking-tight">Selamat Datang!</h1>
                    <p class="text-gray-500 text-xs font-semibold">Silahkan masukkan akun untuk masuk ke E-Jurnal.</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-5 max-w-[380px] mx-auto">
                    @csrf

                    @if (session('success'))
                        <div
                            class="p-4 bg-green-50 border border-green-200 text-green-600 rounded-xl text-xs font-semibold shadow-sm">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div
                            class="p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl text-xs font-semibold shadow-sm">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </span>
                            </div>
                        </div>
                    @endif

                    <div>
                        <label class="block text-xs font-bold text-gray-800 mb-2 ml-1">Username</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan username"
                            required
                            class="w-full px-5 py-3.5 bg-white border border-gray-200/60 rounded-xl outline-none focus:ring-2 focus:ring-blue-300 transition-all text-sm shadow-sm text-gray-700">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-800 mb-2 ml-1">Password</label>
                        <input type="password" name="password" placeholder="Masukkan password" required
                            class="w-full px-5 py-3.5 bg-white border border-gray-200/60 rounded-xl outline-none focus:ring-2 focus:ring-blue-300 transition-all text-sm shadow-sm text-gray-700">
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-3.5 bg-[#2D3E75] hover:bg-[#2D3E55] text-white font-bold rounded-xl shadow-md transition-all active:scale-[0.98]">
                            Masuk
                        </button>
                    </div>

                    <p class="text-center text-xs text-gray-500 mt-6">
                        Belum punya akun? <a href="{{ route('register') }}"
                            class="text-dark-blue-600 font-bold hover:underline">Daftar di sini</a>
                    </p>
                </form>
            </div>

            <div class="hidden lg:block h-4"></div>
        </div>

        <div class="hidden lg:block w-1/2 p-12">
            <div class="w-full h-full relative overflow-hidden rounded-[32px] bg-cover bg-center bg-no-repeat flex items-end justify-center"
                style="background-image: url('{{ asset('images/subtract.png') }}');">

                <img src="{{ asset('images/siswa.png') }}"
                    class="w-[85%] h-[88%] object-contain object-bottom select-none pointer-events-none z-10"
                    alt="Ilustrasi Siswa Skensa">
            </div>
        </div>

    </div>

</body>

</html>