<x-public-layout title="Login - WO JeWePe">
    <div class="min-h-[calc(100vh-7rem)] bg-stone-50 flex items-center justify-center py-16 px-4">
        <div class="w-full max-w-[400px] flex flex-col gap-6">

            {{-- JUDUL --}}
            <div class="text-center flex flex-col gap-1.5">
                <h1 class="text-neutral-900 text-xl font-semibold font-['Inter'] leading-7">Masuk ke Akun Anda</h1>
                <p class="text-stone-600 text-sm font-normal font-['Inter'] leading-5">Masuk untuk melanjutkan</p>
            </div>

            {{-- CARD FORM --}}
            <div class="w-full p-6 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-neutral-300 flex flex-col gap-5 shadow-[0px_1px_2px_0px_rgba(0,0,0,0.05)]">

                @if($errors->any())
                    <div class="p-3 rounded-sm bg-rose-50 border border-rose-200 text-rose-700 text-sm font-normal font-['Inter']">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if(session('status'))
                    <div class="p-3 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-normal font-['Inter']">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                    @csrf

                    {{-- Email / Username --}}
                    <div class="flex flex-col gap-1.5">
                        <label for="email" class="text-neutral-700 text-xs font-medium font-['Inter'] leading-4">Email / Username</label>
                        <div class="self-stretch px-3.5 py-2.5 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-neutral-300 flex items-center overflow-hidden focus-within:outline-neutral-900 transition">
                            <input id="email" type="text" name="email" value="{{ old('email') }}" required autofocus
                                   class="flex-1 bg-transparent border-none outline-none text-sm font-normal font-['Inter'] text-neutral-900 placeholder:text-neutral-400 w-full focus:ring-0"
                                   placeholder="nama@email.com atau username">
                        </div>
                        @error('email')
                            <p class="text-xs text-red-600 font-['Inter']">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="flex flex-col gap-1.5">
                        <div class="flex justify-between items-center">
                            <label for="password" class="text-neutral-700 text-xs font-medium font-['Inter'] leading-4">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs text-stone-500 hover:text-neutral-900 font-['Inter'] transition">Lupa password?</a>
                            @endif
                        </div>
                        <div class="self-stretch px-3.5 py-2.5 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-neutral-300 flex items-center overflow-hidden focus-within:outline-neutral-900 transition">
                            <input id="password" type="password" name="password" required
                                   class="flex-1 bg-transparent border-none outline-none text-sm font-normal font-['Inter'] text-neutral-900 placeholder:text-neutral-400 w-full focus:ring-0"
                                   placeholder="••••••••">
                        </div>
                        @error('password')
                            <p class="text-xs text-red-600 font-['Inter']">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded-sm border-neutral-300 text-neutral-900 focus:ring-neutral-900 w-4 h-4">
                        <span class="text-sm text-neutral-600 font-normal font-['Inter']">Ingat saya</span>
                    </label>

                    {{-- Submit --}}
                    <button type="submit"
                            class="self-stretch px-4 py-2.5 bg-neutral-900 hover:bg-neutral-800 transition rounded-sm text-white text-sm font-semibold font-['Inter'] leading-5 text-center shadow-sm">
                        Masuk
                    </button>
                </form>
            </div>

            {{-- Daftar & Kembali --}}
            <div class="text-center flex flex-col gap-2">
                <p class="text-sm text-neutral-600 font-normal font-['Inter']">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-neutral-900 hover:underline">Daftar sekarang</a>
                </p>
                <a href="{{ route('home') }}" class="text-xs text-stone-500 hover:text-neutral-900 font-['Inter'] transition">← Kembali ke Beranda</a>
            </div>

        </div>
    </div>
</x-public-layout>