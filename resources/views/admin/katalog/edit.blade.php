<x-admin-layout title="Edit Paket - WO JeWePe">
    <section class="bg-white rounded-2xl border border-gray-200 p-6 mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <span class="text-xs font-semibold text-rose-600 uppercase tracking-widest">Admin Control Panel</span>
                <h1 class="text-2xl font-bold text-gray-900 mt-1">Edit Paket</h1>
                <p class="text-sm text-gray-500">ID: {{ $paket->Paket_id }}</p>
            </div>
            <a href="{{ route('admin.katalog.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition border border-gray-300">
                Kembali
            </a>
        </div>
    </section>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.katalog.update', $paket) }}" class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="Nama_paket" class="block text-sm font-medium text-gray-700 mb-1">Nama Paket <span class="text-rose-600">*</span></label>
            <input type="text" name="Nama_paket" id="Nama_paket" value="{{ old('Nama_paket', $paket->Nama_paket) }}"
                   placeholder="Contoh: Silver Intimate, Gold Elegant, Platinum Traditional"
                   class="w-full rounded-lg border-gray-300 text-sm focus:border-rose-500 focus:ring-rose-500 @error('Nama_paket') border-rose-500 @enderror">
            @error('Nama_paket')
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="Harga" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp) <span class="text-rose-600">*</span></label>
            <input type="number" name="Harga" id="Harga" value="{{ old('Harga', $paket->Harga) }}"
                   placeholder="25000000"
                   class="w-full rounded-lg border-gray-300 text-sm focus:border-rose-500 focus:ring-rose-500 @error('Harga') border-rose-500 @enderror">
            @error('Harga')
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="Kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-rose-600">*</span></label>
            <select name="Kategori" id="Kategori"
                    class="w-full rounded-lg border-gray-300 text-sm focus:border-rose-500 focus:ring-rose-500 @error('Kategori') border-rose-500 @enderror">
                <option value="Modern" {{ (old('Kategori', $paket->Kategori ?? 'Modern')) === 'Modern' ? 'selected' : '' }}>Modern</option>
                <option value="Tradisional" {{ (old('Kategori', $paket->Kategori ?? 'Modern')) === 'Tradisional' ? 'selected' : '' }}>Tradisional</option>
                <option value="Intimate" {{ (old('Kategori', $paket->Kategori ?? 'Modern')) === 'Intimate' ? 'selected' : '' }}>Intimate</option>
                <option value="Grand" {{ (old('Kategori', $paket->Kategori ?? 'Modern')) === 'Grand' ? 'selected' : '' }}>Grand</option>
            </select>
            @error('Kategori')
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="Dekripsi_pkt" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Paket <span class="text-rose-600">*</span></label>
            <textarea name="Dekripsi_pkt" id="Dekripsi_pkt" rows="6"
                      placeholder="Deskripsi lengkap paket: apa saja yang termasuk, detail layanan, dll."
                      class="w-full rounded-lg border-gray-300 text-sm focus:border-rose-500 focus:ring-rose-500 @error('Dekripsi_pkt') border-rose-500 @enderror">{{ old('Dekripsi_pkt', $paket->Dekripsi_pkt) }}</textarea>
            @error('Dekripsi_pkt')
                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.katalog.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition border border-gray-300">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium rounded-lg transition border border-rose-600">
                Perbarui Paket
            </button>
        </div>
    </form>
</x-admin-layout>