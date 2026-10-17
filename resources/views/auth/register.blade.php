<x-public-layout title="Daftar Akun - JeWePe">
    <div class="min-h-[calc(100vh-7rem)] bg-stone-50 flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-[440px] flex flex-col gap-6">

            {{-- JUDUL --}}
            <div class="text-center flex flex-col gap-1.5">
                <h1 class="text-neutral-900 text-xl font-semibold font-['Inter'] leading-7">Daftar Akun Baru</h1>
                <p class="text-stone-600 text-sm font-normal font-['Inter'] leading-5">Pilih role dan lengkapi data Anda untuk memulai</p>
            </div>

            {{-- CARD FORM --}}
            <div class="w-full p-6 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-neutral-300 flex flex-col gap-5 shadow-[0px_1px_2px_0px_rgba(0,0,0,0.05)]">

                @if($errors->any())
                    <div class="p-3 rounded-sm bg-rose-50 border border-rose-200 text-rose-700 text-sm font-normal font-['Inter']">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="flex flex-col gap-1.5">
                        <label for="name" class="text-neutral-700 text-xs font-medium font-['Inter'] leading-4">Nama Lengkap</label>
                        <div class="self-stretch px-3.5 py-2.5 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-neutral-300 flex items-center overflow-hidden focus-within:outline-neutral-900 transition">
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                   class="flex-1 bg-transparent border-none outline-none text-sm font-normal font-['Inter'] text-neutral-900 placeholder:text-neutral-400 w-full focus:ring-0"
                                   placeholder="Contoh: Maya Anggraini">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="flex flex-col gap-1.5">
                        <label for="email" class="text-neutral-700 text-xs font-medium font-['Inter'] leading-4">Alamat Email</label>
                        <div class="self-stretch px-3.5 py-2.5 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-neutral-300 flex items-center overflow-hidden focus-within:outline-neutral-900 transition">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                   class="flex-1 bg-transparent border-none outline-none text-sm font-normal font-['Inter'] text-neutral-900 placeholder:text-neutral-400 w-full focus:ring-0"
                                   placeholder="nama@email.com">
                        </div>
                    </div>

                    {{-- PILIHAN ROLE --}}
                    <div class="flex flex-col gap-2">
                        <label class="text-neutral-700 text-xs font-medium font-['Inter'] leading-4">Pilih Role Akun</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative flex flex-col p-3 border rounded-sm cursor-pointer transition has-[:checked]:border-neutral-900 has-[:checked]:bg-stone-50 border-neutral-300">
                                <div class="flex items-center gap-2">
                                    <input type="radio" name="role" value="user" {{ old('role', 'user') === 'user' ? 'checked' : '' }}
                                           class="text-neutral-900 focus:ring-neutral-900 border-neutral-300 w-4 h-4">
                                    <span class="text-sm font-semibold text-neutral-900 font-['Inter']">User</span>
                                </div>
                                <span class="text-xs text-stone-500 font-['Inter'] mt-1">Pengguna / Pemesan</span>
                            </label>

                            <label class="relative flex flex-col p-3 border rounded-sm cursor-pointer transition has-[:checked]:border-neutral-900 has-[:checked]:bg-stone-50 border-neutral-300">
                                <div class="flex items-center gap-2">
                                    <input type="radio" name="role" value="admin" {{ old('role') === 'admin' ? 'checked' : '' }}
                                           class="text-neutral-900 focus:ring-neutral-900 border-neutral-300 w-4 h-4">
                                    <span class="text-sm font-semibold text-neutral-900 font-['Inter']">Admin</span>
                                </div>
                                <span class="text-xs text-stone-500 font-['Inter'] mt-1">Pengelola / Dashboard</span>
                            </label>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="flex flex-col gap-1.5">
                        <label for="password" class="text-neutral-700 text-xs font-medium font-['Inter'] leading-4">Password</label>
                        <div class="self-stretch px-3.5 py-2.5 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-neutral-300 flex items-center overflow-hidden focus-within:outline-neutral-900 transition">
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                   class="flex-1 bg-transparent border-none outline-none text-sm font-normal font-['Inter'] text-neutral-900 placeholder:text-neutral-400 w-full focus:ring-0"
                                   placeholder="Minimal 8 karakter">
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="flex flex-col gap-1.5">
                        <label for="password_confirmation" class="text-neutral-700 text-xs font-medium font-['Inter'] leading-4">Konfirmasi Password</label>
                        <div class="self-stretch px-3.5 py-2.5 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-neutral-300 flex items-center overflow-hidden focus-within:outline-neutral-900 transition">
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                   class="flex-1 bg-transparent border-none outline-none text-sm font-normal font-['Inter'] text-neutral-900 placeholder:text-neutral-400 w-full focus:ring-0"
                                   placeholder="Ulangi password">
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="self-stretch px-4 py-2.5 mt-2 bg-neutral-900 hover:bg-neutral-800 transition rounded-sm text-white text-sm font-semibold font-['Inter'] leading-5 text-center shadow-sm">
                        Daftar Akun
                    </button>
                </form>
            </div>

            {{-- Sudah Punya Akun --}}
            <div class="text-center flex flex-col gap-2">
                <p class="text-sm text-neutral-600 font-normal font-['Inter']">
                    Sudah memiliki akun?
                    <a href="{{ route('login') }}" class="font-semibold text-neutral-900 hover:underline">Masuk di sini</a>
                </p>
                <a href="{{ route('home') }}" class="text-xs text-stone-500 hover:text-neutral-900 font-['Inter'] transition">← Kembali ke Beranda</a>
            </div>

        </div>
    </div>
</x-public-layout>