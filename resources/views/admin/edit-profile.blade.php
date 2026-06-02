<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-skensa.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }
        .bg-custom-gradient {
            background: linear-gradient(180deg, #A8BEF0 0%, #F4F7FF 100%);
        }
    </style>
</head>
<body class="bg-custom-gradient min-h-screen flex items-center justify-center p-4 md:p-8">

    <div class="bg-white/40 backdrop-blur-xl rounded-[40px] shadow-2xl w-full max-w-[650px] border border-white/60 p-6 md:p-10">
        
        <div class="mb-8 ml-2">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-1 tracking-tight">Edit Profil</h1>
            <p class="text-gray-500 text-xs font-semibold">Perbarui informasi data akun pengguna Anda</p>
        </div>

        <div class="bg-white rounded-[32px] border border-gray-100/80 p-6 md:p-8 shadow-sm">
            
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2 ml-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200/80 bg-slate-50/50 text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition" required>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2 ml-1">Email Aktif</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200/80 bg-slate-50/50 text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition" required>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full px-6 py-3.5 bg-[#6376EB] hover:bg-[#5365DB] text-white text-xs font-bold rounded-xl shadow-md text-center transition-all active:scale-[0.98]">
                        <i class="fa-regular fa-floppy-disk mr-1.5"></i> Simpan Perubahan
                    </button>
                </div>
            </form>

            <div class="my-6 border-t border-gray-100"></div>

            <div class="bg-red-50/60 rounded-2xl border border-red-100/80 p-5">
                <h3 class="text-xs font-bold text-red-600 uppercase tracking-wider mb-1">Zona Berbahaya</h3>
                <p class="text-xs text-red-500/90 font-medium mb-4">Jika akun dihapus, semua data Anda akan hilang secara permanen.</p>
                
                <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Apakah Anda YAKIN ingin menghapus akun ini? Tindakan ini tidak bisa dibatalkan!');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-xl transition shadow-sm active:scale-[0.98]">
                        <i class="fa-regular fa-trash-can mr-1.5"></i> Hapus Akun Permanen
                    </button>
                </form>
            </div>
            
        </div>

        <div class="mt-6 ml-2">
            <a href="{{ route('profile.edit') }}" onclick="window.history.back(); return false;" class="text-xs font-bold text-gray-500 hover:text-[#6376EB] transition-all flex items-center gap-2">
                <i class="fa-solid fa-arrow-left text-sm"></i> Kembali ke Profil
            </a>
        </div>
    </div>

</body>
</html>