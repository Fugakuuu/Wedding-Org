<x-public-layout title="Katalog Paket - WO JeWePe">
    <section class="bg-stone-50 py-16">
        <div class="max-w-[1280px] mx-auto px-16">
            <div class="flex flex-col justify-start items-start gap-2 mb-8">
                <h1 class="text-4xl font-bold text-neutral-900 font-['Playfair_Display'] leading-10">Katalog Paket Wedding JeWePe</h1>
                <p class="text-zinc-600 text-base font-normal font-['Inter'] leading-6">Pilih paket pernikahan transparan sesuai kebutuhan acara dan anggaran Anda.</p>
            </div>

            {{-- FILTER & PENCARIAN --}}
            <div class="self-stretch pb-6 border-b border-gray-100 inline-flex justify-between items-center">
                <form method="GET" action="{{ route('katalog') }}" class="relative w-80">
                    <input type="hidden" name="kategori" value="{{ request('kategori') ?? '' }}">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama paket..."
                           class="pl-9 pr-3 py-2.5 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-gray-300 inline-flex justify-center items-start overflow-hidden w-full">
                    <svg class="absolute left-[12px] top-[10px] w-3.5 h-3.5 bg-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" stroke-width="2"/>
                        <path stroke-width="2" d="M21 21l-4.35-4.35"/>
                    </svg>
                </form>
                <div class="flex justify-start items-center gap-2 overflow-hidden">
                    <form method="GET" action="{{ route('katalog') }}" class="inline-flex items-center gap-2">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @php
                    $k = request('kategori');
                @endphp
                        @foreach(['Semua', 'Modern', 'Tradisional', 'Intimate'] as $label)
                        <button type="submit" name="kategori" value="{{ $label === 'Semua' ? '' : $label }}"
                            class="px-3 py-1.5 rounded-sm text-xs font-['Inter'] leading-4 whitespace-nowrap
                                {{ ($label === 'Semua' ? ($k === null || $k === '' || $k === 'Semua') : $k === $label)
                                    ? ($label === 'Semua' ? 'bg-neutral-900 text-white' : 'outline outline-1 outline-offset-[-1px] outline-gray-200 text-zinc-600 font-medium')
                                    : 'outline outline-1 outline-offset-[-1px] outline-gray-200 text-zinc-600 font-medium' }}">
                            {{ $label }}
                        </button>
                        @endforeach
                    </form>
                </div>
            </div>

            {{-- GRID KARTU --}}
            <div class="self-stretch inline-flex justify-center items-start gap-6 flex-wrap">
                @foreach($paket as $p)
                <div class="flex-1 min-w-[280px] p-5 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-gray-300 inline-flex flex-col justify-between items-start">
                    <div class="self-stretch pb-6 flex flex-col justify-start items-start gap-1">
                        <div class="self-stretch flex flex-col justify-start items-start">
                            <div class="text-gray-500 text-xs font-semibold font-['Inter'] uppercase leading-4 tracking-wide">PAKET {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        <h3 class="self-stretch justify-center text-neutral-900 text-xl font-bold font-['Playfair_Display'] leading-7">{{ $p->Nama_paket }}</h3>
                        <div class="self-stretch pt-1 pb-3 border-b border-gray-100 flex flex-col justify-start items-start">
                            <div class="text-center text-neutral-900 text-2xl font-bold font-['Inter'] leading-8">Rp {{ number_format($p->Harga, 0, ',', '.') }}</div>
                        </div>
                        <div class="self-stretch pt-3 flex flex-col justify-start items-start gap-2">
                            <div class="text-gray-700 text-xs font-semibold font-['Inter'] uppercase leading-4 tracking-tight">FASILITAS UTAMA:</div>
                            <div class="flex flex-col justify-start items-start gap-2">
                                @foreach(['Fasilitas 1', 'Fasilitas 2', 'Fasilitas 3', 'Fasilitas 4'] as $i => $fac)
                                <div class="item self-stretch inline-flex justify-start items-start gap-2">
                                    <div class="text-gray-400 text-xs font-normal font-['Inter'] leading-4">•</div>
                                    <div class="text-zinc-600 text-xs font-normal font-['Inter'] leading-4">{{ $p->Dekripsi_pkt }}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('booking.create', $p->Paket_id) }}" class="self-stretch px-3 py-2.5 bg-neutral-900 hover:bg-neutral-800 transition rounded-sm flex flex-col justify-center items-center">
                        <div class="text-center text-white text-xs font-medium font-['Inter'] leading-4">Pesan Paket Ini</div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-public-layout>
