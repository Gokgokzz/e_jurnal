<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-skensa.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-custom-gradient {
            background: linear-gradient(180deg, #A8BEF0 0%, #F4F7FF 100%);
        }

        .bg-subtract-perfect {
            background-image: url('{{ asset("images/subtract.png") }}');
            background-size: 100% 100%; 
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="bg-custom-gradient min-h-screen flex items-center justify-center p-4 md:p-8">

    <div class="bg-white/40 backdrop-blur-xl rounded-[40px] shadow-2xl w-full max-w-[1050px] flex overflow-hidden border border-white/60 p-5 min-h-[600px] lg:h-[620px]">
        
        <div class="w-full lg:w-1/2 p-6 md:p-8 flex flex-col justify-between h-full overflow-y-auto no-scrollbar">
            
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo-skensa.png') }}" class="w-8 h-8 object-contain" alt="Logo Skensa">
                <span class="text-[11px] font-extrabold text-gray-700 uppercase tracking-wider">SMK Negeri 1 Denpasar</span>
            </div>

            <div class="my-auto py-4">
                <div class="text-center mb-5">
                    <h1 class="text-3xl font-extrabold text-gray-900 mb-1 tracking-tight">Pendaftaran Guru</h1>
                    <p class="text-gray-500 text-xs font-semibold">Silahkan lengkapi data diri Anda untuk mendaftar ke E-Jurnal.</p>
                </div>

                <form action="{{ route('login') }}" method="GET" class="space-y-3.5 max-w-[430px] mx-auto">
                    @csrf
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-800 mb-1.5 ml-1">Username</label>
                        <input type="text" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus
                            class="w-full px-4 py-2.5 bg-white border border-gray-200/60 rounded-xl outline-none focus:ring-2 focus:ring-blue-300 transition-all text-sm shadow-sm text-gray-700">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1.5 ml-1">NIP</label>
                            <input type="text" name="nip" placeholder="Masukkan NIP" required
                                class="w-full px-4 py-2.5 bg-white border border-gray-200/60 rounded-xl outline-none focus:ring-2 focus:ring-blue-300 transition-all text-sm shadow-sm text-gray-700">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1.5 ml-1">Email Aktif</label>
                            <input type="email" name="email" placeholder="contoh@gmail.com" required
                                class="w-full px-4 py-2.5 bg-white border border-gray-200/60 rounded-xl outline-none focus:ring-2 focus:ring-blue-300 transition-all text-sm shadow-sm text-gray-700">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1.5 ml-1">Password</label>
                            <input type="password" name="password" placeholder="Buat kata sandi" required
                                class="w-full px-4 py-2.5 bg-white border border-gray-200/60 rounded-xl outline-none focus:ring-2 focus:ring-blue-300 transition-all text-sm shadow-sm text-gray-700">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-800 mb-1.5 ml-1">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi" required
                                class="w-full px-4 py-2.5 bg-white border border-gray-200/60 rounded-xl outline-none focus:ring-2 focus:ring-blue-300 transition-all text-sm shadow-sm text-gray-700">
                        </div>
                    </div>

                    <div class="pt-1">
                        <button type="submit" 
                            class="w-full py-3 bg-[#6786DC] hover:bg-[#5A79D4] text-white font-bold rounded-xl shadow-md transition-all active:scale-[0.98]">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="text-xs font-semibold text-gray-500">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-[#6786DC] hover:text-[#5A79D4] font-bold transition-all ml-1">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </div>

            <div class="hidden lg:block h-2"></div>
        </div>

        <div class="hidden lg:block w-1/2 p-10 h-full">
            <div class="w-full h-full relative overflow-hidden rounded-[32px] bg-subtract-perfect flex items-end justify-center">
                
                <img src="{{ asset('images/siswa.png') }}" 
                     class="w-[85%] h-[88%] object-contain object-bottom select-none pointer-events-none z-10" 
                     alt="Ilustrasi Siswa Skensa">
                     
            </div>
        </div>

    </div>

</body>
</html>