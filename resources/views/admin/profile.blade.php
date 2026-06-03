<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-skensa.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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

    <div class="bg-white/40 backdrop-blur-xl rounded-[40px] shadow-2xl w-full max-w-[950px] border border-white/60 p-6 md:p-10">
        
        <div class="mb-8 ml-2">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-1 tracking-tight">Profil Saya</h1>
            <p class="text-gray-500 text-xs font-semibold">Informasi mendetail akun pengguna Anda</p>
        </div>

        <div class="bg-white rounded-[32px] border border-gray-100/80 p-6 md:p-8 shadow-sm flex flex-col md:flex-row gap-8 items-center md:items-start">
            
            <div class="flex flex-col items-center min-w-[160px]">
                <div class="w-28 h-28 bg-[#2D3E75] text-white rounded-full flex items-center justify-center text-3xl font-extrabold shadow-md mb-4 select-none">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <h2 class="font-bold text-lg text-gray-800 text-center leading-tight mb-1.5">{{ Auth::user()->name }}</h2>
                <span class="px-3 py-1 bg-blue-50 text-[#2D3E75] rounded-full text-[10px] font-extrabold uppercase tracking-wider">
                    Administrator
                </span>
            </div>

            <div class="flex-1 w-full grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <div class="bg-slate-50/70 p-4 rounded-2xl border border-slate-100/50">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Nama Lengkap</p>
                    <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                </div>

                <div class="bg-slate-50/70 p-4 rounded-2xl border border-slate-100/50">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">NIP (Nomor Induk Pegawai)</p>
                    <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->nip ?? '-' }}</p>
                </div>

                <div class="bg-slate-50/70 p-4 rounded-2xl border border-slate-100/50">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Email Aktif</p>
                    <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->email }}</p>
                </div>

                <div class="bg-slate-50/70 p-4 rounded-2xl border border-slate-100/50">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Terdaftar Sejak</p>
                    <p class="text-sm font-semibold text-gray-700">
                        {{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : 'Data belum tersedia' }}
                    </p>
                </div>

            </div>
        </div>

        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4 px-2">
            <a href="{{ route('dashboard') }}" class="text-xs font-bold text-gray-500 hover:text-[#2D3E75] transition-all flex items-center gap-2 order-2 sm:order-1">
                <i class="fa-solid fa-arrow-left text-sm"></i> Kembali ke Dashboard
            </a>

            <a href="{{ route('profile.edit') }}" 
               class="w-full sm:w-auto px-6 py-3.5 bg-[#2D3E75] hover:bg-[#2D3E55] text-white text-xs font-bold rounded-xl shadow-md text-center transition-all active:scale-[0.98] order-1 sm:order-2">
                <i class="fa-regular fa-pen-to-square mr-1.5"></i> Edit Data Profil
            </a>
        </div>
    </div>

</body>
</html>