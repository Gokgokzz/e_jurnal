<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .card-bg {
            background: linear-gradient(135deg, #E2EDFF 0%, #EBF2FF 100%);
        }
    </style>
</head>

<body
    class="min-h-screen bg-gradient-to-br from-[#9BB8F2] via-[#C9DAF8] to-[#F2E1E1] flex items-center justify-center p-4">

    <div class="absolute top-8 left-10 flex items-center gap-3">
        <img src="{{ asset('images/logo-skensa.png') }}" class="w-10 h-10 object-contain" alt="Logo">
        <span class="text-sm font-extrabold text-gray-800 uppercase tracking-wider">SMK Negeri 1 Denpasar</span>
    </div>

    <div class="card-bg rounded-[40px] shadow-2xl w-full max-w-[1100px] min-h-[600px] flex overflow-hidden">

        <div class="hidden lg:flex w-1/2 p-8 items-center justify-center">
            <div class="w-full h-full rounded-[32px] overflow-hidden bg-cover bg-center bg-no-repeat flex items-end justify-center"
                style="background-image: url('{{ asset('images/subtract.png') }}');">

                <img src="{{ asset('images/siswa.png') }}"
                    class="w-[85%] h-[88%] object-contain object-bottom pointer-events-none" alt="Ilustrasi Siswa">
            </div>
        </div>

        <div class="w-full lg:w-1/2 p-10 flex flex-col justify-center">
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-black mb-2">Pendaftaran Guru</h1>
                <p class="text-gray-500 text-sm font-medium">Silahkan lengkapi data diri Anda untuk mendaftar ke
                    E-Jurnal</p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-900 mb-1 ml-1">Username</label>
                    <input type="text" name="name" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-[#6B8AE5]">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-900 mb-1 ml-1">NIP</label>
                        <input type="text" name="nip" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-[#6B8AE5]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-900 mb-1 ml-1">Email Aktif</label>
                        <input type="email" name="email" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-[#6B8AE5]">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-900 mb-1 ml-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-[#6B8AE5]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-900 mb-1 ml-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-[#6B8AE5]">
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-4 bg-[#032082] text-white font-bold rounded-xl hover:bg-[#02155c] transition-all">
                    Daftar Sekarang
                </button>
            </form>

            <p class="text-center text-xs text-gray-500 mt-6">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Masuk
                    di sini</a>
            </p>
        </div>
    </div>
    @if ($errors->any())
        <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>

</html>