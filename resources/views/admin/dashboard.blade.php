<x-admin-layout title="Kelola Pesanan - WO JeWePe">
    {{-- JUDUL --}}
    <div class="flex flex-col justify-start items-start gap-1 mb-6">
        <h1 class="text-2xl font-bold text-neutral-900 font-['Inter'] leading-8">Kelola Pesanan & Laporan</h1>
        <p class="text-stone-700 text-sm font-normal font-['Inter'] leading-5">Daftar pesanan klien masuk dan cetak rekapitulasi data pesanan.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-3 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    {{-- RINGKASAN 3 KOTAK --}}
    <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="p-4 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300/70 flex flex-col gap-2">
            <div class="text-stone-700 text-xs font-semibold font-['Inter'] uppercase leading-4 tracking-wide">TOTAL PESANAN</div>
            <div class="text-neutral-900 text-3xl font-bold font-['Inter'] leading-9">{{ $pesanan->total() }}</div>
            <div class="text-stone-700 text-xs font-normal font-['Inter'] leading-4">Semua reservasi masuk</div>
        </div>
        <div class="p-4 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300/70 flex flex-col gap-2">
            <div class="text-amber-800 text-xs font-semibold font-['Inter'] uppercase leading-4 tracking-wide">STATUS REQUEST</div>
            <div class="flex items-end gap-2">
                <div class="text-amber-800 text-3xl font-bold font-['Inter'] leading-9">{{ $countRequest }}</div>
                <div class="mb-1 px-2 py-0.5 bg-amber-100 rounded-sm text-amber-900 text-xs font-medium font-['Inter'] leading-4">Perlu Disetujui</div>
            </div>
            <div class="text-stone-700 text-xs font-normal font-['Inter'] leading-4">Menunggu konfirmasi admin</div>
        </div>
        <div class="p-4 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300/70 flex flex-col gap-2">
            <div class="text-green-800 text-xs font-semibold font-['Inter'] uppercase leading-4 tracking-wide">STATUS APPROVED</div>
            <div class="text-green-800 text-3xl font-bold font-['Inter'] leading-9">{{ $countApproved }}</div>
            <div class="text-stone-700 text-xs font-normal font-['Inter'] leading-4">Pesanan telah disetujui</div>
        </div>
    </div>

    {{-- TABEL PESANAN --}}
    <div class="w-full bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300/70 flex flex-col overflow-hidden mb-6">
        {{-- Table Header Bar --}}
        <div class="w-full p-4 bg-stone-100 border-b border-stone-300/40 flex justify-between items-center">
            <div class="text-neutral-900 text-sm font-semibold font-['Inter'] leading-5">Daftar Transaksi Pesanan</div>
            <form method="GET" action="{{ route('admin.dashboard') }}">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari ID / Nama Pemesan..."
                       class="w-64 px-3 py-1.5 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300/80 text-xs font-normal font-['Inter'] text-gray-700 focus:outline-neutral-500 focus:ring-0 border-0">
            </form>
        </div>

        {{-- Table --}}
        <div class="w-full overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-zinc-100 border-b border-stone-300/50">
                    <tr>
                        <th class="w-32 px-4 py-3 text-stone-700 text-xs font-bold font-['Inter'] uppercase leading-4 tracking-wide">ID</th>
                        <th class="w-28 px-4 py-3 text-stone-700 text-xs font-bold font-['Inter'] uppercase leading-4 tracking-wide">TANGGAL</th>
                        <th class="w-40 px-4 py-3 text-stone-700 text-xs font-bold font-['Inter'] uppercase leading-4 tracking-wide">NAMA PEMESAN</th>
                        <th class="w-48 px-4 py-3 text-stone-700 text-xs font-bold font-['Inter'] uppercase leading-4 tracking-wide">EMAIL</th>
                        <th class="w-40 px-4 py-3 text-stone-700 text-xs font-bold font-['Inter'] uppercase leading-4 tracking-wide">PAKET</th>
                        <th class="w-28 px-4 py-3 text-stone-700 text-xs font-bold font-['Inter'] uppercase leading-4 tracking-wide">STATUS</th>
                        <th class="w-32 px-4 py-3 text-stone-700 text-xs font-bold font-['Inter'] uppercase leading-4 tracking-wide text-right">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanan as $p)
                        <tr class="border-t border-stone-300/40 hover:bg-stone-50 transition">
                            <td class="w-32 px-4 py-4 text-neutral-900 text-xs font-medium font-mono leading-4">
                                ORD-{{ str_pad($p->Pesanan_id, 7, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="w-28 px-4 py-4 text-stone-700 text-xs font-normal font-['Inter'] leading-4">
                                {{ $p->Tanggal_acara ? \Carbon\Carbon::parse($p->Tanggal_acara)->format('d M Y') : '-' }}
                            </td>
                            <td class="w-40 px-4 py-3.5 text-zinc-900 text-sm font-medium font-['Inter'] leading-5">
                                {{ $p->Nama_pemesan }}
                            </td>
                            <td class="w-48 px-4 py-4 text-stone-700 text-xs font-normal font-['Inter'] leading-4">
                                {{ $p->Email_pemesan }}
                            </td>
                            <td class="w-40 px-4 py-4 text-zinc-900 text-xs font-medium font-['Inter'] leading-4">
                                {{ $p->paket->Nama_paket ?? '-' }}
                            </td>
                            <td class="w-28 px-4 py-3.5">
                                @php
                                    $statusClass = match($p->Status) {
                                        'approved' => 'bg-emerald-100 outline-emerald-300 text-emerald-900',
                                        'rejected' => 'bg-red-100 outline-red-300 text-red-900',
                                        default    => 'bg-amber-100 outline-amber-300 text-amber-900',
                                    };
                                    $statusLabel = match($p->Status) {
                                        'approved' => 'Approved',
                                        'rejected' => 'Rejected',
                                        default    => 'Request',
                                    };
                                @endphp
                                <span class="px-2 py-0.5 rounded-sm outline outline-1 outline-offset-[-1px] text-xs font-semibold font-['Inter'] leading-4 {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="w-32 px-4 py-3 text-right">
                                @if($p->Status === 'request')
                                    <form method="POST" action="{{ route('admin.pesanan.status', $p) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="Status" value="approved">
                                        <button type="submit"
                                                class="px-3 py-1 bg-neutral-900 hover:bg-neutral-800 transition rounded-sm shadow-sm inline-flex justify-start items-center gap-1">
                                            <div class="w-2.5 h-2 bg-white rounded-[1px]"></div>
                                            <span class="text-white text-xs font-medium font-['Inter'] leading-4">Setujui</span>
                                        </button>
                                    </form>
                                @elseif($p->Status === 'approved')
                                    <span class="text-stone-700 text-xs font-medium font-['Inter'] leading-4">Disetujui</span>
                                @else
                                    <form method="POST" action="{{ route('admin.pesanan.status', $p) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="Status" value="approved">
                                        <button type="submit"
                                                class="px-3 py-1 bg-neutral-900 hover:bg-neutral-800 transition rounded-sm shadow-sm inline-flex justify-start items-center gap-1">
                                            <span class="text-white text-xs font-medium font-['Inter'] leading-4">Setujui</span>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-stone-400 text-sm font-normal font-['Inter']">
                                Belum ada pesanan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pesanan->hasPages())
            <div class="p-4 border-t border-stone-300/30">
                {{ $pesanan->links() }}
            </div>
        @endif
    </div>

    {{-- LAPORAN RINGKAS --}}
    <div class="w-full p-5 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300/70 flex flex-col gap-4">
        <div class="text-neutral-900 text-sm font-bold font-['Inter'] uppercase leading-5 tracking-wide">LAPORAN PESANAN</div>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
            <div class="flex items-end gap-3">
                <div class="flex flex-col gap-1">
                    <label class="text-stone-700 text-xs font-medium font-['Inter'] leading-4">Pilih Bulan</label>
                    <select name="bulan" class="px-3 py-1.5 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300/80 text-zinc-900 text-xs font-normal font-['Inter'] border-0 focus:ring-0">
                        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $bln)
                            <option value="{{ $i+1 }}" {{ (int)date('n') === $i+1 ? 'selected' : '' }}>{{ $bln }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-stone-700 text-xs font-medium font-['Inter'] leading-4">Pilih Tahun</label>
                    <select name="tahun" class="px-3 py-1.5 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300/80 text-zinc-900 text-xs font-normal font-['Inter'] border-0 focus:ring-0">
                        @for($y = date('Y'); $y >= date('Y')-3; $y--)
                            <option value="{{ $y }}" {{ date('Y') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button class="px-4 py-2 rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300 flex items-center gap-1.5 hover:bg-stone-50 transition">
                    <div class="size-3.5 bg-red-700 rounded-[1px]"></div>
                    <span class="text-zinc-900 text-xs font-semibold font-['Inter'] leading-4">Cetak Laporan PDF</span>
                </button>
                <button class="px-4 py-2 bg-neutral-900 hover:bg-neutral-800 transition rounded-sm shadow-sm flex items-center gap-1.5">
                    <div class="size-2.5 bg-white rounded-[1px]"></div>
                    <span class="text-white text-xs font-semibold font-['Inter'] leading-4">Unduh Excel</span>
                </button>
            </div>
        </div>
    </div>
</x-admin-layout>