@php
$siteSetting = \App\Models\SiteSetting::first();

@endphp

<header class="w-full bg-[#003b7a] text-white sticky top-0 z-50 shadow-md" x-data="{ mobileMenu: false }">
    <div class="container mx-auto px-4 lg:px-6 flex justify-between items-center py-2">
        <!-- ── LOGO ── -->
        <div class="flex items-center gap-3 shrink-0">
            @auth
            <a href="{{ route('profile.index') }}" class="px-2 py-2 flex items-center">
                <img src="{{ $siteSetting->logo_url }}" alt="Bhaiya Asset" class="w-auto lg:h-[40px] h-[30px] block" />
            </a>
            @else
            <a href="{{ route('home.index') }}" class="px-2 py-2 flex items-center">
                <img src="{{ $siteSetting->logo_url }}" alt="Bhaiya Asset" class="w-auto lg:h-[60px] h-[45px] block" />
            </a>
            @endauth
        </div>
        <button @click="mobileMenu = !mobileMenu" class="lg:hidden text-2xl p-2 focus:outline-none"
            aria-label="Toggle navigation menu">
            <i class="fa-solid" :class="mobileMenu ? 'fa-xmark' : 'fa-bars'"></i>
        </button>

  <nav class="hidden lg:flex items-stretch gap-0">
    <a href="{{ route('home.index') }}"
        class="flex flex-col items-center justify-center gap-[5px] px-5 py-2.5 text-white hover:text-white transition-colors border-b-2 {{ request()->routeIs('home.index*') ? 'border-white' : 'border-transparent hover:border-white/40' }} hover:border-white/40">
        <i class="fa-regular fa-house text-lg"></i>
        <span class="text-sm tracking-wide">Home</span>
    </a>
    <a href="{{ route('affiliated.project') }}"
        class="flex flex-col items-center justify-center gap-[5px] px-5 py-2.5 text-white hover:text-white transition-colors border-b-2 {{ request()->routeIs('affiliated.project*') ? 'border-white' : 'border-transparent hover:border-white/40' }} hover:border-white/40">
        <i class="fa-regular fa-building text-lg"></i>
        <span class="text-sm tracking-wide">Project list</span>
    </a>


            @auth
            <a href="{{ route('portal.redirect') }}" target="_blank"
                class="flex flex-col items-center justify-center gap-[5px] px-5 py-2.5 border-b-2 {{ request()->routeIs('home.index') ? 'border-white' : 'border-transparent hover:border-white/40' }}">
                <i class="fa-brands fa-artstation text-lg"></i>
                <span class="text-sm tracking-wide">Marketing Assets</span>
            </a>

            <a href="{{ route('profile.index') }}"
                class="flex flex-col items-center justify-center gap-[5px] px-5 py-2.5 text-white hover:text-white transition-colors border-b-2 {{ request()->routeIs('profile.index') ? 'border-white' : 'border-transparent hover:border-white/40' }} hover:border-white/40">


                <img src="{{ Auth::user()->avatar_url ?? asset('./images/user/images.png') }}" alt="Profile"
                    class="w-6 h-6 rounded-full object-cover border border-white/50">

                <span class="text-sm tracking-wide">{{ Auth::user()->name }}</span>
            </a>

            <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex flex-col items-center justify-center gap-[5px] px-5 py-2.5 text-white hover:text-red-400 transition-colors border-b-2 border-transparent hover:border-white/40">
                <i class="fas fa-power-off text-lg"></i>
                <span class="text-sm tracking-wide">Logout</span>
            </a>


            @endauth

            @if(auth()->user()?->isSuperAdmin())
            <a href="{{ route('dashboard') }}"
                class="flex flex-col items-center justify-center gap-[5px] px-5 py-2.5 text-white hover:text-white {{ request()->routeIs('dashboard') ? 'border-white' : 'border-transparent hover:border-white/40' }} border-b-2 border-transparent hover:border-white/40">
                <i class="fa-solid fa-gauge text-lg"></i>
                <span class="text-sm tracking-wide flex items-center gap-1">Admin Dashboard</span>
            </a>

            @endif
        </nav>

        <div x-show="mobileMenu" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full" class="fixed inset-0 z-50 lg:hidden overflow-hidden"
            style="display: none;">

            <div class="absolute inset-0 bg-black/50" @click="mobileMenu = false"></div>

            <div class="absolute right-0 top-0 h-full w-[280px] bg-[#001e3e] shadow-2xl flex flex-col p-6 space-y-6">

                <div class="flex items-center justify-between mb-8 pb-4 border-b border-white/10">
                    @auth
                    <a href="{{ route('profile.index') }}" class="flex items-center gap-3">
                        <img src="{{ Auth::user()->avatar_url ?? asset('./images/user/images.png') }}"
                            class="w-10 h-10 rounded-full object-cover border border-white/20">
                        <span class="">{{ Auth::user()->name }}</span>
                    </a>
                    @endauth

                    <button @click="mobileMenu = false" class="text-white text-3xl leading-none">&times;</button>
                </div>

                <div class="flex flex-col space-y-4 overflow-y-auto">
                    <a href="{{ route('portal.redirect') }}"
                        class=" border-b border-white/10 pb-2">Marketing Assets</a>

                    <div class="pt-6 space-y-4">

                        <a href="{{ route('bookmark.list') }}" class="flex items-center justify-between">
                            <span><i class="fa-regular fa-bookmark mr-2"></i> Saved Items</span>
                            @if($bookmarkCount > 0) <span
                                class="bg-red-500 px-2 rounded-full text-xs">{{ $bookmarkCount }}</span> @endif
                        </a>

                        <a href="{{ route('tickets.index') }}" class="flex items-center gap-3"><i
                                class="fa-regular fa-circle-question"></i> Support Ticket</a>

                        @auth
                        <button onclick="document.getElementById('logout-form').submit();"
                            class="text-red-400 pt-4 text-left">
                            <i class="fas fa-power-off mr-2"></i> Logout
                        </button>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>