<x-admin-layout title="Kelola Pesanan & Laporan - WO JeWePe">
    <div class="flex flex-col gap-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-1">
            <h1 class="text-xl md:text-2xl font-bold text-neutral-900 font-['Inter']">Kelola Pesanan & Laporan</h1>
            <p class="text-stone-600 text-sm font-['Inter']">Daftar pesanan klien masuk dan cetak rekapitulasi data pesanan.</p>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="p-4 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- STATS BOXES --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            {{-- Total --}}
            <div class="p-4 bg-white rounded-sm border border-stone-200 flex flex-col gap-2">
                <div class="text-stone-500 text-xs font-semibold font-['Inter'] uppercase tracking-wide">Total Pesanan</div>
                <div class="text-neutral-900 text-3xl font-bold font-['Inter']">{{ $stats['total'] }}</div>
                <div class="text-stone-500 text-xs font-['Inter']">Semua reservasi masuk</div>
            </div>
            {{-- Request --}}
            <div class="p-4 bg-white rounded-sm border border-stone-200 flex flex-col gap-2">
                <div class="text-amber-700 text-xs font-semibold font-['Inter'] uppercase tracking-wide">Status Request</div>
                <div class="flex items-end gap-2">
                    <div class="text-amber-700 text-3xl font-bold font-['Inter']">{{ $stats['request'] }}</div>
                    <span class="px-2 py-0.5 bg-amber-100 rounded-sm text-amber-900 text-xs font-medium font-['Inter'] mb-1">Perlu Disetujui</span>
                </div>
                <div class="text-stone-500 text-xs font-['Inter']">Menunggu konfirmasi admin</div>
            </div>
            {{-- Approved --}}
            <div class="p-4 bg-white rounded-sm border border-stone-200 flex flex-col gap-2">
                <div class="text-emerald-700 text-xs font-semibold font-['Inter'] uppercase tracking-wide">Status Approved</div>
                <div class="text-emerald-700 text-3xl font-bold font-['Inter']">{{ $stats['approved'] }}</div>
                <div class="text-stone-500 text-xs font-['Inter']">Pesanan telah disetujui</div>
            </div>
        </div>

        {{-- FILTER & SEARCH --}}
        <form method="GET" action="{{ route('admin.pesanan.index') }}"
              class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari ID / Nama Pemesan..."
                   class="flex-1 min-w-0 px-3 py-2 bg-white rounded-sm border border-stone-300 text-sm font-['Inter'] focus:outline-none focus:border-neutral-600">
            <select name="status"
                    class="sm:w-40 px-3 py-2 bg-white rounded-sm border border-stone-300 text-sm font-['Inter'] focus:outline-none focus:border-neutral-600">
                <option value="">Semua Status</option>
                <option value="request" {{ request('status') === 'request' ? 'selected' : '' }}>Request</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            <button type="submit"
                    class="px-4 py-2 bg-neutral-900 hover:bg-neutral-800 transition text-white text-sm font-medium font-['Inter'] rounded-sm">
                Filter
            </button>
        </form>

        {{-- TABLE PESANAN (scrollable on mobile) --}}
        <div class="bg-white rounded-sm border border-stone-200 overflow-hidden">
            <div class="p-4 bg-stone-50 border-b border-stone-200 flex items-center justify-between">
                <span class="text-neutral-900 text-sm font-semibold font-['Inter']">Daftar Transaksi Pesanan</span>
                @if($pesanan->total() > 0)
                    <span class="text-stone-500 text-xs font-['Inter']">{{ $pesanan->total() }} pesanan</span>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm font-['Inter'] min-w-[640px]">
                    <thead class="bg-stone-50 border-b border-stone-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-stone-600 uppercase tracking-wide w-28">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-stone-600 uppercase tracking-wide">Nama Pemesan</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-stone-600 uppercase tracking-wide hidden md:table-cell">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-stone-600 uppercase tracking-wide hidden lg:table-cell">Paket</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-stone-600 uppercase tracking-wide hidden md:table-cell">Tgl Acara</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-stone-600 uppercase tracking-wide">Status</th>
                            <th class="px-4 py-3 text-right text-xs font-bold text-stone-600 uppercase tracking-wide">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse($pesanan as $p)
                            <tr class="hover:bg-stone-50 transition">
                                <td class="px-4 py-3 text-xs font-medium font-mono text-neutral-700">
                                    ORD-{{ str_pad($p->Pesanan_id, 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-neutral-900 text-sm">{{ $p->Nama_pemesan }}</div>
                                    <div class="text-xs text-stone-500 md:hidden">{{ $p->Email_pemesan }}</div>
                                </td>
                                <td class="px-4 py-3 text-xs text-stone-600 hidden md:table-cell">{{ $p->Email_pemesan }}</td>
                                <td class="px-4 py-3 text-xs text-stone-700 hidden lg:table-cell">{{ $p->paket->Nama_paket ?? '-' }}</td>
                                <td class="px-4 py-3 text-xs text-stone-600 hidden md:table-cell">
                                    {{ $p->Tanggal_acara ? \Carbon\Carbon::parse($p->Tanggal_acara)->format('d M Y') : '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $badgeClass = match($p->Status) {
                                            'request'  => 'bg-amber-100 text-amber-800 border border-amber-200',
                                            'approved' => 'bg-emerald-100 text-emerald-800 border border-emerald-200',
                                            'rejected' => 'bg-rose-100 text-rose-800 border border-rose-200',
                                            default    => 'bg-stone-100 text-stone-600 border border-stone-200',
                                        };
                                    @endphp
                                    <span class="px-2 py-0.5 rounded-sm text-xs font-semibold font-['Inter'] {{ $badgeClass }}">
                                        {{ ucfirst($p->Status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end items-center gap-2 flex-wrap">
                                        <a href="{{ route('admin.pesanan.show', $p) }}"
                                           class="text-stone-600 text-xs font-medium hover:text-neutral-900 underline underline-offset-2 transition">
                                            Detail
                                        </a>
                                        @if($p->Status === 'request')
                                            <form method="POST" action="{{ route('admin.pesanan.status', $p) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="Status" value="approved">
                                                <button type="submit"
                                                        class="px-3 py-1 bg-neutral-900 hover:bg-neutral-700 transition rounded-sm text-white text-xs font-medium font-['Inter']">
                                                    Setujui
                                                </button>
                                            </form>
                                        @elseif($p->Status === 'approved')
                                            <span class="text-xs text-emerald-700 font-medium">✓ Disetujui</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-stone-400 text-sm font-['Inter']">
                                    Belum ada pesanan masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($pesanan->hasPages())
                <div class="px-4 py-3 border-t border-stone-200">
                    {{ $pesanan->links() }}
                </div>
            @endif
        </div>

        {{-- LAPORAN SECTION --}}
        <div class="p-5 bg-white rounded-sm border border-stone-200 flex flex-col gap-4">
            <h2 class="text-sm font-bold text-neutral-900 font-['Inter'] uppercase tracking-wide">Laporan Pesanan</h2>
            <div class="flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-end">
                <div class="flex flex-wrap gap-3">
                    <div class="flex flex-col gap-1">
                        <label class="text-stone-600 text-xs font-medium font-['Inter']">Pilih Bulan</label>
                        <select name="bulan"
                                class="px-3 py-2 bg-white rounded-sm border border-stone-300 text-xs font-['Inter'] focus:outline-none focus:border-neutral-600">
                            @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $bulan)
                                <option value="{{ $i+1 }}" {{ request('bulan') == ($i+1) ? 'selected' : '' }}>{{ $bulan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-stone-600 text-xs font-medium font-['Inter']">Pilih Tahun</label>
                        <select name="tahun"
                                class="px-3 py-2 bg-white rounded-sm border border-stone-300 text-xs font-['Inter'] focus:outline-none focus:border-neutral-600">
                            @foreach([2024, 2025, 2026, 2027] as $y)
                                <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <button class="px-4 py-2 rounded-sm border border-stone-300 flex items-center gap-1.5 text-xs font-semibold font-['Inter'] text-stone-700 hover:bg-stone-50 transition">
                        <svg class="w-3.5 h-3.5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                        </svg>
                        Cetak Laporan PDF
                    </button>
                    <button class="px-4 py-2 bg-neutral-900 hover:bg-neutral-800 transition rounded-sm flex items-center gap-1.5 text-xs font-semibold font-['Inter'] text-white">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Unduh Excel
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>