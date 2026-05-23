<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8FAFC; }</style>
</head>
<body class="p-10">

    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl font-extrabold text-gray-800">Profil Saya</h1>
            <p class="text-gray-400 text-sm">Informasi akun pengguna</p>
        </div>

        <div class="bg-white rounded-[32px] border border-gray-100 p-8 shadow-sm flex flex-col md:flex-row gap-8">
            <div class="flex flex-col items-center">
                <div class="w-32 h-32 bg-[#6376EB] text-white rounded-full flex items-center justify-center text-4xl font-bold shadow-lg mb-4">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <h2 class="font-bold text-lg text-gray-800">{{ Auth::user()->name }}</h2>
                <p class="text-xs text-gray-400 uppercase tracking-widest">Administrator</p>
            </div>

            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-slate-50 p-4 rounded-2xl">
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Nama Lengkap</p>
                    <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                </div>
                <div class="bg-slate-50 p-4 rounded-2xl">
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Email</p>
                    <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->email }}</p>
                </div>
                <div class="bg-slate-50 p-4 rounded-2xl">
                    <p class="text-[10px] font-bold text-gray-400 uppercase">NIP</p>
                    <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->nip ?? '-' }}</p>
                </div>
                <div class="bg-slate-50 p-4 rounded-2xl">
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Terdaftar Sejak</p>
                    <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-[#6376EB] transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

</body>
</html>