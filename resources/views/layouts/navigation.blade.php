<nav x-data="{ open: false }" class="border-b border-black bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <a href="{{ route('dashboard') }}" class="text-xl font-semibold tracking-tight text-black">jewepe WO</a>

            <div class="hidden items-center gap-8 sm:flex">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    Beranda
                </x-nav-link>
                <x-nav-link :href="route('katalog')" :active="request()->routeIs('katalog')">
                    Katalog
                </x-nav-link>
                <x-nav-link :href="route('pesanan.track')" :active="request()->routeIs('pesanan.track')">
                    Cek Status Pesanan
                </x-nav-link>
            </div>

            <div class="hidden items-center sm:flex">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center border border-black px-3 py-2 text-sm text-black transition hover:bg-black hover:text-white">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ms-2 h-4 w-4 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <button @click="open = ! open" class="border border-black p-2 text-black sm:hidden" aria-label="Toggle navigation">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak class="border-t border-black sm:hidden">
        <div class="space-y-1 px-4 py-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Beranda</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('katalog')" :active="request()->routeIs('katalog')">Katalog</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pesanan.track')" :active="request()->routeIs('pesanan.track')">Cek Status Pesanan</x-responsive-nav-link>
        </div>
        <div class="border-t border-black px-4 py-3">
            <div class="text-sm font-medium text-black">{{ Auth::user()->name }}</div>
            <div class="text-xs text-gray-600">{{ Auth::user()->email }}</div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
