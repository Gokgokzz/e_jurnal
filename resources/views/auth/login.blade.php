<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Jurnal SMK Negeri 1 Denpasar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-custom-gradient {
            background: linear-gradient(180deg, #A7BFF1 0%, #F5F8FF 100%);
        }
    </style>
</head>
<body class="bg-custom-gradient min-h-screen flex items-center justify-center p-6">

    <!-- Main Card -->
    <div class="bg-white/70 backdrop-blur-md rounded-[50px] shadow-xl w-full max-w-[1000px] flex overflow-hidden border border-white">
        
        <!-- Form Section -->
        <div class="w-full lg:w-1/2 p-12 flex flex-col relative">
            
            <!-- Logo SMKN 1 Denpasar di pojok -->
            <div class="flex items-center gap-2 mb-16">
                <img src="{{ asset('images/logo-skensa.png') }}" class="w-7 h-7" alt="Logo">
                <span class="text-[10px] font-bold text-gray-700 uppercase tracking-wider">SMK Negeri 1 Denpasar</span>
            </div>

            <!-- Header -->
            <div class="text-center mb-10">
                <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Selamat Datang!</h1>
                <p class="text-gray-500 text-xs font-medium">Silahkan masukkan akun untuk masuk ke E-Jurnal.</p>
            </div>

            <!-- Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-5 px-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-2 ml-1">Username</label>
                    <input type="text" name="username" placeholder="Masukkan username" required
                        class="w-full px-5 py-3.5 bg-[#F9FBFF] border border-gray-100 rounded-xl outline-none focus:ring-2 focus:ring-blue-300 transition-all text-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-2 ml-1">Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required
                        class="w-full px-5 py-3.5 bg-[#F9FBFF] border border-gray-100 rounded-xl outline-none focus:ring-2 focus:ring-blue-300 transition-all text-sm text-gray-400">
                </div>

                <div class="pt-4">
                    <button type="submit" 
                        class="w-full py-4 bg-[#7A95E8] hover:bg-[#6376EB] text-white font-bold rounded-xl shadow-md transition-all active:scale-95">
                        Masuk
                    </button>
                </div>
            </form>
        </div>

        <!-- Visual Section (Tanpa Karakter) -->
        <div class="hidden lg:block w-1/2 p-4">
            <div class="w-full h-full bg-[#7A95E8] rounded-[40px] relative overflow-hidden flex items-center justify-center">
                
                <!-- Aksen kotak transparan seperti di gambar -->
                <div class="absolute top-8 left-8 w-12 h-12 bg-white/20 rounded-xl"></div>
                <div class="absolute bottom-8 right-8 w-10 h-10 bg-white/10 rounded-lg"></div>
                
                <!-- Watermark Logo -->
                <img src="{{ asset('images/siswa-siswi.jpeg') }}" 
                     class="w-40 opacity-10 brightness-0 invert" alt="siswa-siswi">
            </div>
        </div>

    </div>

</body>
</html>