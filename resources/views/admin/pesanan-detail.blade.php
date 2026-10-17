<x-admin-layout title="Detail Pesanan #{{ $pesanan->Pesanan_id }}">
    <div class="flex flex-col gap-6">
        <div class="flex flex-col gap-1">
            <h1 class="text-xl md:text-2xl font-bold text-neutral-900 font-['Inter']">Detail Pesanan #{{ $pesanan->Pesanan_id }}</h1>
            <p class="text-stone-600 text-sm font-['Inter']">Lihat detail reservasi klien.</p>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-sm border border-stone-200 overflow-hidden">
            <div class="p-6 border-b border-stone-200 flex items-center justify-between">
                <div>
                    <span class="text-xs font-medium text-stone-500 uppercase tracking-wide">ID Pesanan: #{{ $pesanan->Pesanan_id }}</span>
                    <h2 class="text-lg font-bold text-neutral-900 mt-1">Detail Pesanan</h2>
                </div>
                @php
                    $badgeClass = match($pesanan->Status) {
                        'request'  => 'bg-amber-100 text-amber-800 border border-amber-200',
                        'approved' => 'bg-emerald-100 text-emerald-800 border border-emerald-200',
                        'rejected' => 'bg-rose-100 text-rose-800 border border-rose-200',
                        default    => 'bg-stone-100 text-stone-600 border border-stone-200',
                    };
                @endphp
                <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide border {{ $badgeClass }}">
                    {{ ucfirst($pesanan->Status) }}
                </span>
            </div>

            <div class="p-6 sm:p-8 space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <span class="text-xs font-medium text-stone-500 uppercase">Nama Pemesan</span>
                        <p class="mt-1 text-base font-semibold text-neutral-900">{{ $pesanan->Nama_pemesan }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-medium text-stone-500 uppercase">Email</span>
                        <p class="mt-1 text-base font-semibold text-neutral-900">{{ $pesanan->Email_pemesan }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-medium text-stone-500 uppercase">No. WhatsApp</span>
                        <p class="mt-1 text-base font-semibold text-neutral-900">{{ $pesanan->No_WA ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-medium text-stone-500 uppercase">Tanggal Acara</span>
                        <p class="mt-1 text-base font-semibold text-neutral-900">{{ $pesanan->Tanggal_acara->format('d F Y') }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-stone-500 uppercase">Catatan</span>
                        <p class="mt-1 text-base font-semibold text-neutral-900">{{ $pesanan->Catatan ?? '-' }}</p>
                    </div>
                </div>

                <div class="pt-6 border-t border-stone-100">
                    <span class="text-xs font-medium text-stone-500 uppercase">Paket Dipilih</span>
                    <p class="mt-1 text-base font-semibold text-neutral-900">{{ $pesanan->paket->Nama_paket ?? '-' }}</p>
                    <p class="mt-1 text-sm text-stone-500">{{ $pesanan->paket->Dekripsi_pkt ?? '' }}</p>
                </div>

                <div class="pt-6 border-t border-stone-100">
                    <span class="text-xs font-medium text-stone-500 uppercase">Total Biaya</span>
                    <p class="mt-1 text-3xl font-bold text-rose-600">
                        Rp{{ number_format($pesanan->paket->Harga ?? 0, 0, ',', '.') }}
                    </p>
                </div>

                <div class="pt-6 border-t border-stone-100 bg-stone-50 -mx-6 -mb-6 sm:-mx-8 sm:-mb-8 p-6 sm:p-8">
                    <h3 class="text-sm font-semibold text-neutral-900">Kontak Admin WO:</h3>
                    <p class="mt-1 text-sm text-stone-600">{{ $pesanan->admin->Dekripsi_adm ?? 'WO JeWePe' }}</p>
                    <div class="mt-3 flex flex-wrap gap-4 text-xs text-stone-500">
                        <span>Telp: {{ $pesanan->admin->Telepon_adm ?? '-' }}</span>
                        <span>Email: {{ $pesanan->admin->Email_adm ?? '-' }}</span>
                        <span>Alamat: {{ $pesanan->admin->Alamat_adm ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-between items-center">
            <a href="{{ route('admin.pesanan.index') }}" class="text-sm font-medium text-stone-600 hover:text-neutral-900 underline">&larr; Kembali ke Daftar Pesanan</a>
        </div>
    </div>
</x-admin-layout>
