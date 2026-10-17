<x-public-layout title="Detail Pesanan #{{ $pesanan->Pesanan_id }}">
    <section class="bg-stone-50 py-12">
        <div class="max-w-[1280px] mx-auto px-16">
            <div class="w-full max-w-[672px]">
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                    <div class="p-6 sm:p-8 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-wide">ID Pesanan: #{{ $pesanan->Pesanan_id }}</span>
                            <h1 class="text-2xl font-bold text-gray-900 mt-1">Detail Pesanan</h1>
                        </div>
                        @php
                            $badge = match($pesanan->Status) {
                                'approved' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                'rejected' => 'bg-rose-100 text-rose-800 border-rose-200',
                                default => 'bg-amber-100 text-amber-800 border-amber-200',
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide border {{ $badge }}">
                            {{ $pesanan->Status }}
                        </span>
                    </div>

                    <div class="p-6 sm:p-8 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <span class="text-xs font-medium text-gray-400 uppercase">Nama Pemesan</span>
                                <p class="mt-1 text-base font-semibold text-gray-900">{{ $pesanan->Nama_pemesan }}</p>
                            </div>
                            <div>
                                <span class="text-xs font-medium text-gray-400 uppercase">Email</span>
                                <p class="mt-1 text-base font-semibold text-gray-900">{{ $pesanan->Email_pemesan }}</p>
                            </div>
                            <div>
                                <span class="text-xs font-medium text-gray-400 uppercase">No. WhatsApp</span>
                                <p class="mt-1 text-base font-semibold text-gray-900">{{ $pesanan->No_WA ?? '-' }}</p>
                            </div>
                            <div>
                                <span class="text-xs font-medium text-gray-400 uppercase">Tanggal Acara</span>
                                <p class="mt-1 text-base font-semibold text-gray-900">{{ $pesanan->Tanggal_acara->format('d F Y') }}</p>
                            </div>
                            <div class="sm:col-span-2">
                                <span class="text-xs font-medium text-gray-400 uppercase">Lokasi Acara & Catatan</span>
                                <p class="mt-1 text-base font-semibold text-gray-900">{{ $pesanan->Catatan ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-100">
                            <span class="text-xs font-medium text-gray-400 uppercase">Paket Dipilih</span>
                            <p class="mt-1 text-base font-semibold text-gray-900">{{ $pesanan->paket->Nama_paket ?? '-' }}</p>
                            <p class="mt-1 text-sm text-gray-500">{{ $pesanan->paket->Dekripsi_pkt ?? '' }}</p>
                        </div>

                        <div class="pt-6 border-t border-gray-100">
                            <span class="text-xs font-medium text-gray-400 uppercase">Total Biaya</span>
                            <p class="mt-1 text-3xl font-bold text-rose-600">
                                Rp{{ number_format($pesanan->paket->Harga ?? 0, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="pt-6 border-t border-gray-100 bg-gray-50 -mx-6 -mb-6 sm:-mx-8 sm:-mb-8 p-6 sm:p-8">
                            <h3 class="text-sm font-semibold text-gray-900">Kontak Admin WO:</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $pesanan->admin->Dekripsi_adm ?? 'WO JeWePe' }}</p>
                            <div class="mt-3 flex flex-wrap gap-4 text-xs text-gray-500">
                                <span>Telp: {{ $pesanan->admin->Telepon_adm ?? '-' }}</span>
                                <span>Email: {{ $pesanan->admin->Email_adm ?? '-' }}</span>
                                <span>Alamat: {{ $pesanan->admin->Alamat_adm ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-between items-center">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">← Kembali ke Beranda</a>
                    <a href="{{ route('katalog') }}" class="text-sm font-medium text-neutral-900 hover:text-neutral-700">Lihat Paket Lainnya</a>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>