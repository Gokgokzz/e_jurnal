<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen py-10">

<div class="max-w-2xl mx-auto bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Profil</h2>

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition" required>
        </div>

        <button type="submit" class="w-full bg-[#6376EB] hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-blue-200">
            Simpan Perubahan
        </button>
    </form>

    <div class="my-8 border-t border-gray-100"></div>

    <div class="bg-red-50 p-6 rounded-2xl border border-red-100">
        <h3 class="text-lg font-bold text-red-600 mb-2">Zona Berbahaya</h3>
        <p class="text-sm text-red-500 mb-4">Jika akun dihapus, semua data Anda akan hilang secara permanen.</p>
        
        <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Apakah Anda YAKIN ingin menghapus akun ini? Tindakan ini tidak bisa dibatalkan!');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded-xl transition">
                Hapus Akun Permanen
            </button>
        </form>
    </div>
</div>

</body>
</html>