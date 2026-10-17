<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'WO JeWePe' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=Playfair+Display:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-neutral-900 antialiased bg-white">
    <nav class="bg-white border-b border-neutral-200 sticky top-0 z-50">
        <div class="max-w-[1280px] mx-auto px-16 h-16 flex justify-between items-center">
            <div class="inline-flex flex-col justify-start items-start">
                <div class="text-center text-neutral-900 text-xl font-bold font-['Playfair_Display'] leading-7">JeWePe WO</div>
            </div>
            <div class="flex justify-start items-center gap-6">
<a href="{{ route('home') }}" class="text-neutral-600 text-sm font-normal font-['Inter'] leading-5 hover:text-neutral-900">Beranda</a>
<a href="{{ route('katalog') }}" class="pb-1 border-b-2 border-neutral-900 text-neutral-900 text-sm font-semibold font-['Inter'] leading-5">Katalog</a>
<a href="{{ route('pesanan.track') }}" class="text-zinc-600 text-sm font-medium font-['Inter'] leading-5">Cek Status Pesanan</a>
                @if(Auth::guard('admin')->check() || (Auth::check() && Auth::user()->role === 'admin'))
                    <a href="{{ route('admin.dashboard') }}" class="text-neutral-600 text-sm font-normal font-['Inter'] leading-5 hover:text-neutral-900">Admin Panel</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 text-sm font-medium font-['Inter'] leading-5 hover:opacity-80 bg-transparent border-none cursor-pointer">Keluar</button>
                    </form>
                @elseif(Auth::check())
                    <span class="text-neutral-600 text-sm font-normal font-['Inter'] leading-5">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 text-sm font-medium font-['Inter'] leading-5 hover:opacity-80 bg-transparent border-none cursor-pointer">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-neutral-900 text-sm font-semibold font-['Inter'] leading-5 px-4 py-1.5 border border-neutral-300 rounded-sm hover:bg-stone-50 transition">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="border-t border-neutral-200 py-4">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center text-neutral-400 text-xs font-normal font-['Inter'] leading-4">© 2025 JeWePe Wedding Organizer</div>
        </div>
    </footer>
</body>
</html>