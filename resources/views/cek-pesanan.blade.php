<x-public-layout title="Cek Status Pesanan - JeWePe">
    <div class="w-full max-w-[1280px] mx-auto min-h-[calc(100vh-140px)] flex justify-center items-center py-10 px-6">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-sm border border-neutral-200">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-neutral-900 font-['Playfair_Display']">Cek Pesanan</h1>
                <p class="text-neutral-500 text-sm mt-2 font-['Inter']">Masukkan ID Pesanan Anda untuk melihat detail dan status pesanan.</p>
            </div>

            <form method="POST" action="{{ route('pesanan.track.submit') }}" class="flex flex-col gap-4">
                @csrf
                
                @if($errors->any())
                    <div class="p-3 rounded-sm bg-rose-50 border border-rose-200 text-rose-700 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="flex flex-col gap-1.5">
                    <label for="pesanan_id" class="text-neutral-900 text-sm font-semibold font-['Inter']">ID Pesanan</label>
                    <input type="text" id="pesanan_id" name="pesanan_id" value="{{ old('pesanan_id') }}" required
                           class="w-full px-3.5 py-2.5 bg-stone-50 rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300 text-sm text-neutral-900 placeholder:text-neutral-400 focus:outline-neutral-900"
                           placeholder="Contoh: 12">
                </div>

                <button type="submit" class="w-full px-4 py-2.5 mt-2 bg-neutral-900 text-white rounded-sm text-sm font-medium hover:bg-neutral-800 transition-colors">
                    Lacak Pesanan
                </button>
                
                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="text-neutral-500 text-xs hover:text-neutral-900 underline underline-offset-2">Kembali ke Beranda</a>
                </div>
            </form>
        </div>
    </div>
</x-public-layout>
