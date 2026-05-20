<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">
            {{ isset($jurnal) ? 'Edit Jurnal' : 'Input Jurnal Baru' }}
        </h1>
        
        <form action="{{ isset($jurnal) ? route('jurnal.update', $jurnal->id) : route('jurnal.store') }}" 
              method="POST" 
              class="bg-white p-6 rounded-lg shadow">
            @csrf
            @if(isset($jurnal))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label>Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $jurnal->tanggal ?? '') }}" class="w-full border p-2">
            </div>

            <div class="mb-4">
                <label>Materi Pembelajaran</label>
                <textarea name="materi" class="w-full border p-2">{{ old('materi', $jurnal->materi ?? '') }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ isset($jurnal) ? 'Update Jurnal' : 'Simpan Jurnal' }}
            </button>
        </form>
    </div>
</x-app-layout>