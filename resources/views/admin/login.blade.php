<x-public-layout title="Login Admin - JeWePe">
    <div class="min-h-[calc(100vh-140px)] bg-stone-50 flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-sm p-6 bg-white rounded-md shadow-sm border border-neutral-300 flex flex-col justify-start items-start gap-6">
            <div class="self-stretch flex flex-col justify-start items-center">
                <div class="inline-flex justify-center items-center gap-2.5">
                    <h1 class="text-center text-neutral-900 text-xl font-semibold font-['Inter'] leading-7">Login Admin</h1>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.login') }}" class="self-stretch flex flex-col justify-start items-start gap-4">
                @csrf

                @if($errors->any())
                    <div class="p-3 rounded-sm bg-rose-50 border border-rose-200 text-rose-700 text-xs font-['Inter'] self-stretch">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="self-stretch flex flex-col justify-start items-start gap-1">
                    <label for="username" class="self-stretch text-neutral-700 text-xs font-medium font-['Inter'] leading-4">Username / Email</label>
                    <div class="self-stretch px-3 py-2 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-neutral-300 inline-flex justify-center items-start overflow-hidden focus-within:outline-neutral-900">
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus
                               class="flex-1 bg-transparent border-none outline-none text-sm font-normal font-['Inter'] text-neutral-900 placeholder-neutral-400 w-full"
                               placeholder="Masukkan username atau email">
                    </div>
                </div>

                <div class="self-stretch flex flex-col justify-start items-start gap-1">
                    <label for="password" class="self-stretch text-neutral-700 text-xs font-medium font-['Inter'] leading-4">Password</label>
                    <div class="self-stretch px-3 py-2 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-neutral-300 inline-flex justify-center items-start overflow-hidden focus-within:outline-neutral-900">
                        <input type="password" id="password" name="password" required
                               class="flex-1 bg-transparent border-none outline-none text-sm font-normal font-['Inter'] text-neutral-900 placeholder-neutral-400 w-full"
                               placeholder="Masukkan kata sandi">
                    </div>
                </div>

                <button type="submit" class="self-stretch px-4 py-2 bg-neutral-900 hover:bg-neutral-800 transition text-white rounded-sm text-sm font-medium font-['Inter'] leading-5">
                    Masuk
                </button>
            </form>

            <div class="self-stretch pt-1.5 flex flex-col justify-start items-center">
                <a href="{{ route('home') }}" class="text-center text-neutral-500 text-xs font-normal font-['Inter'] leading-4 hover:text-neutral-900 underline underline-offset-2">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</x-public-layout>