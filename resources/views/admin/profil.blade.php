<x-admin-layout title="Kelola Profil - WO JeWePe">
    <div class="max-w-2xl flex flex-col gap-6">

        {{-- JUDUL --}}
        <div class="flex flex-col gap-1">
            <h1 class="text-xl md:text-2xl font-bold text-neutral-900 font-['Playfair_Display']">Kelola Profil</h1>
            <p class="text-stone-600 text-sm font-['Inter']">Perbarui informasi profil wedding organizer untuk website publik.</p>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium font-['Inter']">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-sm bg-red-50 border border-red-200 text-red-800 text-sm font-['Inter']">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST" action="{{ route('admin.profil.update') }}"
              class="p-5 md:p-6 bg-white rounded-sm border border-stone-200 flex flex-col gap-5">
            @csrf
            @method('PUT')

            {{-- Nama / Username --}}
            <div class="flex flex-col gap-1.5">
                <label class="text-neutral-900 text-sm font-medium font-['Inter']">Nama / Username</label>
                <input type="text" name="username"
                       value="{{ old('username', Auth::guard('admin')->user()->username) }}"
                       class="w-full px-3.5 py-2.5 bg-stone-50 rounded-sm border border-stone-300
                              text-neutral-900 text-sm font-['Inter']
                              focus:outline-none focus:border-neutral-600 focus:bg-white transition">
            </div>

            {{-- Deskripsi --}}
            <div class="flex flex-col gap-1.5">
                <label class="text-neutral-900 text-sm font-medium font-['Inter']">Deskripsi Tentang Kamu</label>
                <textarea name="Dekripsi_adm" rows="4"
                          class="w-full px-3.5 py-2.5 bg-stone-50 rounded-sm border border-stone-300
                                 text-neutral-900 text-sm font-['Inter'] resize-y
                                 focus:outline-none focus:border-neutral-600 focus:bg-white transition">{{ old('Dekripsi_adm', Auth::guard('admin')->user()->Dekripsi_adm) }}</textarea>
            </div>

            {{-- Telepon & Email --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col gap-1.5">
                    <label class="text-neutral-900 text-sm font-medium font-['Inter']">Nomor Telepon / WhatsApp</label>
                    <input type="text" name="Telepon_adm"
                           value="{{ old('Telepon_adm', Auth::guard('admin')->user()->Telepon_adm) }}"
                           class="w-full px-3.5 py-2.5 bg-stone-50 rounded-sm border border-stone-300
                                  text-neutral-900 text-sm font-['Inter']
                                  focus:outline-none focus:border-neutral-600 focus:bg-white transition">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-neutral-900 text-sm font-medium font-['Inter']">Email</label>
                    <input type="email" name="Email_adm"
                           value="{{ old('Email_adm', Auth::guard('admin')->user()->Email_adm) }}"
                           class="w-full px-3.5 py-2.5 bg-stone-50 rounded-sm border border-stone-300
                                  text-neutral-900 text-sm font-['Inter']
                                  focus:outline-none focus:border-neutral-600 focus:bg-white transition">
                </div>
            </div>

            {{-- Alamat --}}
            <div class="flex flex-col gap-1.5">
                <label class="text-neutral-900 text-sm font-medium font-['Inter']">Alamat Singkat</label>
                <input type="text" name="Alamat_adm"
                       value="{{ old('Alamat_adm', Auth::guard('admin')->user()->Alamat_adm) }}"
                       class="w-full px-3.5 py-2.5 bg-stone-50 rounded-sm border border-stone-300
                              text-neutral-900 text-sm font-['Inter']
                              focus:outline-none focus:border-neutral-600 focus:bg-white transition">
            </div>

            {{-- Ganti Password --}}
            <div class="pt-2 border-t border-stone-100">
                <p class="text-xs font-semibold text-stone-500 uppercase tracking-wide mb-4 font-['Inter']">Ganti Password (opsional)</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-1.5">
                        <label class="text-neutral-900 text-sm font-medium font-['Inter']">Password Baru</label>
                        <input type="password" name="password" autocomplete="new-password"
                               class="w-full px-3.5 py-2.5 bg-stone-50 rounded-sm border border-stone-300
                                      text-neutral-900 text-sm font-['Inter']
                                      focus:outline-none focus:border-neutral-600 focus:bg-white transition"
                               placeholder="Biarkan kosong jika tidak diubah">
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-neutral-900 text-sm font-medium font-['Inter']">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" autocomplete="new-password"
                               class="w-full px-3.5 py-2.5 bg-stone-50 rounded-sm border border-stone-300
                                      text-neutral-900 text-sm font-['Inter']
                                      focus:outline-none focus:border-neutral-600 focus:bg-white transition"
                               placeholder="Ulangi password baru">
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="pt-4 border-t border-stone-200 flex flex-col-reverse sm:flex-row justify-end gap-3">
                <button type="button" onclick="history.back()"
                        class="px-5 py-2.5 rounded-sm text-stone-600 text-sm font-['Inter'] hover:bg-stone-100 transition border border-stone-200">
                    Batal
                </button>
                <button type="submit"
                        class="px-6 py-2.5 bg-neutral-900 hover:bg-neutral-800 transition rounded-sm text-white text-sm font-medium font-['Inter']">
                    Simpan Profil
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>