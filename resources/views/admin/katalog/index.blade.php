<x-admin-layout title="Kelola Katalog Paket - WO JeWePe">

    {{-- SECTION HEADER --}}
    <div class="flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center pb-6 border-b border-stone-200 mb-6">
        <div>
            <h1 class="text-xl md:text-2xl font-bold text-neutral-900 font-['Playfair_Display']">Kelola Katalog Paket</h1>
            <p class="text-stone-600 text-sm font-['Inter'] mt-0.5">Daftar paket pernikahan yang tampil pada website.</p>
        </div>
        <a href="{{ route('admin.katalog.create') }}"
           class="shrink-0 px-4 py-2 bg-neutral-900 hover:bg-neutral-800 transition rounded-sm inline-flex items-center gap-2 text-white text-sm font-medium font-['Inter']">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Paket
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium font-['Inter']">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 rounded-sm bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium font-['Inter']">
            {{ session('error') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="bg-white rounded-sm border border-stone-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm font-['Inter'] min-w-[500px]">
                <thead class="bg-stone-50 border-b border-stone-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-stone-600 uppercase tracking-wide w-10">No</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-stone-600 uppercase tracking-wide">Nama Paket</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-stone-600 uppercase tracking-wide hidden sm:table-cell">Kategori</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-stone-600 uppercase tracking-wide">Harga</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-stone-600 uppercase tracking-wide hidden md:table-cell">Status</th>
                        <th class="px-4 py-3 text-right text-xs font-bold text-stone-600 uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($paket as $pkt)
                        <tr class="hover:bg-stone-50 transition">
                            <td class="px-4 py-3.5 text-stone-500 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3.5">
                                <div class="font-medium text-neutral-900">{{ $pkt->Nama_paket }}</div>
                                <div class="text-xs text-stone-500 sm:hidden">{{ $pkt->Kategori ?? 'Modern' }}</div>
                            </td>
                            <td class="px-4 py-3.5 text-stone-600 hidden sm:table-cell">{{ $pkt->Kategori ?? 'Modern' }}</td>
                            <td class="px-4 py-3.5 font-medium text-neutral-900">Rp {{ number_format($pkt->Harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-3.5 hidden md:table-cell">
                                <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 rounded-sm text-xs font-medium">Aktif</span>
                            </td>
                            <td class="px-4 py-3.5 text-right">
                                <div class="flex justify-end items-center gap-3">
                                    <a href="{{ route('admin.katalog.edit', $pkt) }}"
                                       class="text-neutral-900 text-xs font-medium hover:opacity-60 transition">Edit</a>
                                    <span class="text-stone-300 text-xs">|</span>
                                    <form method="POST" action="{{ route('admin.katalog.destroy', $pkt) }}" class="inline"
                                          onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 text-xs font-medium hover:opacity-60 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-stone-400 text-sm font-['Inter']">
                                Belum ada paket.
                                <a href="{{ route('admin.katalog.create') }}" class="text-neutral-900 hover:underline font-medium">Tambahkan paket pertama</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($paket->hasPages())
            <div class="p-4 border-t border-stone-200">
                {{ $paket->links() }}
            </div>
        @endif
    </div>

</x-admin-layout>