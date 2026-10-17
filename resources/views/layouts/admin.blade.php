<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin - JeWePe' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=Playfair+Display:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-neutral-900 antialiased bg-stone-50">

    {{-- Mobile overlay --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-20 lg:hidden hidden" onclick="toggleSidebar()"></div>

    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}
        <aside id="sidebar" class="fixed top-0 left-0 z-30 h-full w-60 bg-stone-100 border-r border-stone-300/50
                      flex flex-col justify-between
                      -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <div class="flex flex-col flex-1 min-h-0">
                {{-- Brand --}}
                <div class="h-16 px-6 border-b border-stone-300/40 flex justify-between items-center shrink-0">
                    <div class="text-neutral-900 text-lg font-semibold font-['Playfair_Display']">JeWePe WO</div>
                    {{-- Close button mobile --}}
                    <button onclick="toggleSidebar()" class="lg:hidden p-1 text-stone-500 hover:text-stone-900">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                {{-- Navigation --}}
                <nav class="flex-1 overflow-y-auto p-3 flex flex-col gap-1">
                    <a href="{{ route('admin.pesanan.index') }}"
                        class="px-3 py-2.5 rounded-sm flex items-center gap-3 transition
                              {{ request()->routeIs('admin.pesanan*') ? 'bg-neutral-900 text-white' : 'text-stone-700 hover:bg-stone-200' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span class="text-sm font-['Inter'] font-medium">Kelola Pesanan</span>
                    </a>
                    <a href="{{ route('admin.katalog.index') }}"
                        class="px-3 py-2.5 rounded-sm flex items-center gap-3 transition
                              {{ request()->routeIs('admin.katalog*') ? 'bg-neutral-900 text-white' : 'text-stone-700 hover:bg-stone-200' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span class="text-sm font-['Inter'] font-medium">Kelola Katalog</span>
                    </a>
                    <a href="{{ route('admin.profil') }}"
                        class="px-3 py-2.5 rounded-sm flex items-center gap-3 transition
                              {{ request()->routeIs('admin.profil*') ? 'bg-neutral-900 text-white' : 'text-stone-700 hover:bg-stone-200' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-sm font-['Inter'] font-medium">Kelola Profil</span>
                    </a>
                </nav>
            </div>

            {{-- Logout --}}
            <div class="p-3 border-t border-stone-300/40 shrink-0">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full px-3 py-2.5 rounded-sm flex items-center gap-3 text-red-700 hover:bg-red-50 transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="text-sm font-['Inter'] font-medium">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <div class="flex-1 lg:ml-60 flex flex-col min-h-screen">

            {{-- Top Header --}}
            <header
                class="h-16 px-4 md:px-8 bg-white border-b border-stone-300/40 flex justify-between items-center sticky top-0 z-10">
                <div class="flex items-center gap-3">
                    {{-- Hamburger mobile --}}
                    <button onclick="toggleSidebar()"
                        class="lg:hidden p-2 rounded-sm text-stone-600 hover:bg-stone-100 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <span class="text-stone-700 text-xs font-semibold font-['Inter'] uppercase tracking-wide">ADMIN
                        PANEL</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-neutral-900 rounded-full"></div>
                    <span
                        class="text-neutral-900 text-sm font-medium font-['Inter'] hidden sm:block">{{ Auth::guard('admin')->user()->username }}</span>
                    <span
                        class="px-2 py-0.5 bg-stone-200 rounded-sm text-stone-700 text-xs font-medium font-['Inter']">Admin</span>
                </div>
            </header>

            <main class="flex-1 p-4 md:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>

</html>