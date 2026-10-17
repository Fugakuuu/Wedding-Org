<x-public-layout title="WO JeWePe - Wedding Organizer">
    {{-- HERO --}}
    <section class="bg-stone-50 py-24">
        <div class="max-w-[1280px] mx-auto px-16">
            <div class="text-center max-w-3xl mx-auto">
                <span class="inline-block px-4 py-1.5 rounded-full bg-neutral-100 text-neutral-700 text-sm font-medium mb-6">Wedding Organizer Terpercaya</span>
                <h1 class="text-4xl font-bold text-neutral-900 leading-tight font-['Playfair_Display']">
                    Pernikahan Impian Anda,<br>
                    <span class="text-neutral-600">Terorganisasi dengan Sempurna</span>
                </h1>
                <p class="mt-6 text-lg text-zinc-600 leading-relaxed">
                    Kami membantu mewujudkan pernikahan impian Anda dengan layanan profesional,
                    dekorasi elegan, dan tim berpengalaman. Dari perencanaan hingga hari bahagia.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('katalog') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-neutral-900 text-white font-semibold rounded-sm hover:bg-neutral-800 transition shadow-sm">
                        Lihat Paket Kami
                    </a>
                    <a href="#tentang" class="inline-flex items-center justify-center px-8 py-3.5 bg-white text-neutral-700 font-medium rounded-sm border border-neutral-300 hover:bg-gray-50 transition">
                        Tentang Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- PAKET UNGGULAN --}}
    <section class="py-20 bg-white">
        <div class="max-w-[1280px] mx-auto px-16">
            <div class="text-center mb-14">
                <h2 class="text-3xl font-bold text-neutral-900 font-['Playfair_Display']">Paket Unggulan</h2>
                <p class="mt-3 text-zinc-600">Pilih paket sesuai kebutuhan dan budget pernikahan Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($paket as $p)
                <div class="flex-1 p-5 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-neutral-300 inline-flex flex-col justify-between items-start">
                    <div class="self-stretch pb-6 flex flex-col justify-start items-start gap-1">
                        <div class="self-stretch flex flex-col justify-start items-start">
                            <div class="text-neutral-500 text-xs font-semibold font-['Inter'] uppercase tracking-wide">PAKET {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        <h3 class="self-stretch justify-center text-neutral-900 text-xl font-bold font-['Playfair_Display'] leading-7">{{ $p->Nama_paket }}</h3>
                        <div class="self-stretch pt-1 pb-3 border-b border-gray-100 flex flex-col justify-start items-start">
                            <div class="text-center text-neutral-900 text-2xl font-bold font-['Inter'] leading-8">Rp {{ number_format($p->Harga, 0, ',', '.') }}</div>
                        </div>
                        <div class="self-stretch pt-3 flex flex-col justify-start items-start gap-2">
                            <div class="text-gray-700 text-xs font-semibold font-['Inter'] uppercase tracking-tight">FASILITAS UTAMA:</div>
                            <div class="flex flex-col justify-start items-start gap-2">
                                @foreach(['Fasilitas 1', 'Fasilitas 2', 'Fasilitas 3', 'Fasilitas 4'] as $i => $fac)
                                <div class="inline-flex justify-start items-start gap-2">
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

    {{-- TENTANG --}}
    <section id="tentang" class="py-20 bg-stone-50">
        <div class="max-w-[1280px] mx-auto px-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-neutral-900 font-['Playfair_Display']">Kenapa Pilih WO JeWePe?</h2>
                    <p class="mt-4 text-zinc-600 leading-relaxed">
                        Dengan pengalaman bertahun-tahun, kami berkomitmen memberikan layanan terbaik
                        untuk hari bahagia Anda.
                    </p>
                    <div class="mt-8 space-y-6">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-sm bg-neutral-100 flex items-center justify-center shrink-0">
                                <span class="text-neutral-900 font-bold">✓</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-neutral-900">Tim Profesional</h3>
                                <p class="text-sm text-zinc-600">Wedding planner berpengalaman dan tersertifikasi</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-sm bg-neutral-100 flex items-center justify-center shrink-0">
                                <span class="text-neutral-900 font-bold">✓</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-neutral-900">Paket Lengkap</h3>
                                <p class="text-sm text-zinc-600">Dari dekorasi, catering, hingga dokumentasi</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-sm bg-neutral-100 flex items-center justify-center shrink-0">
                                <span class="text-neutral-900 font-bold">✓</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-neutral-900">Harga Transparan</h3>
                                <p class="text-sm text-zinc-600">Tidak ada biaya tersembunyi</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-stone-200 rounded-sm h-80 flex items-center justify-center">
                    <span class="text-6xl">💍</span>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-16 bg-neutral-900">
        <div class="max-w-4xl mx-auto px-16 text-center">
            <h2 class="text-3xl font-bold text-white font-['Playfair_Display']">Siap Wujudkan Pernikahan Impian?</h2>
            <p class="mt-3 text-neutral-400">Hubungi kami atau pilih paket sekarang</p>
            <a href="{{ route('katalog') }}" class="mt-8 inline-flex px-8 py-3.5 bg-white text-neutral-900 font-semibold rounded-sm hover:bg-gray-100 transition">
                Lihat Katalog Paket
            </a>
        </div>
    </section>
</x-public-layout>
