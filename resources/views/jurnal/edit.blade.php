<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-extrabold text-gray-800 mb-6">
            {{ isset($jurnal) && $jurnal->id ? 'Edit Jurnal' : 'Input Jurnal Baru' }}
        </h1>
        
        <form action="{{ isset($jurnal) && $jurnal->id ? route('jurnal.update', $jurnal->id) : route('jurnal.store') }}" 
              method="POST" 
              class="bg-white p-8 rounded-[32px] border border-gray-100 shadow-sm">
            @csrf 
            @if(isset($jurnal) && $jurnal->id)
                @method('PUT')
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $jurnal->tanggal ?? '') }}" class="w-full p-3 border rounded-xl" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kelas</label>
                    <select name="kelas_id" class="w-full p-3 border rounded-xl">
                        @foreach($data_kelas as $kelas)
                            <option value="{{ $kelas->id }}" {{ (isset($jurnal) && $jurnal->kelas_id == $kelas->id) ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Materi Pembelajaran</label>
                <textarea name="materi" rows="4" class="w-full p-3 border rounded-xl">{{ old('materi', $jurnal->materi ?? '') }}</textarea>
            </div>

            <div class="mt-8 flex gap-4">
                <button type="submit" class="px-6 py-3 bg-[#6376EB] text-white font-bold rounded-xl hover:bg-opacity-90 transition">
                    {{ isset($jurnal) && $jurnal->id ? 'Update Jurnal' : 'Simpan Jurnal' }}
                </button>
                <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>