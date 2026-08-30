 
@php
    use App\Helpers\MenuHelper;

    $menuGroups = MenuHelper::getMenuGroups();

    // Get current path
    $currentPath = '/' . request()->path();
    $siteSetting = \App\Models\SiteSetting::first();
@endphp

<aside id="sidebar"
    class="fixed flex flex-col mt-0 top-0 px-5 left-0 bg-white dark:bg-gray-900 dark:border-gray-800 text-gray-900 h-screen transition-all duration-300 ease-in-out z-99999 border-r border-gray-200">

    <!-- Logo Section -->
    <div class="pt-8 pb-7 flex"
        :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen)
            ? 'xl:justify-center'
            : 'justify-start'">

        <a href="{{ route('dashboard') }}">

            {{-- Expanded: full logo --}}
            <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                class="flex items-center gap-2">

                <img src="{{asset('/')}}Bhaiya-referral-program-logo.png"
                    alt="{{ $siteSetting->site_name }}"
                    class="h-[50px]" />

            </span>

            {{-- Collapsed: icon / first letter --}}
            <span x-show="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen">

                 <img src="{{asset('/')}}Bhaiya-referral-program-logo.png"
                    alt="{{ $siteSetting->site_name }}"
                    class="w-12 h-12 object-contain" />

            </span>

        </a>
    </div>

    <!-- Navigation Menu -->
    <div class="flex flex-col overflow-y-auto duration-300">

        <nav class="mb-6">
            <div class="flex flex-col gap-4">

              @foreach ($menuGroups as $groupIndex => $menuGroup)

    <div
        x-data="{ open: true }"
        class="mb-3"
    >

        {{-- Group Header --}}
        <button
            @click="open = !open"
            class="w-full flex items-center justify-between px-2 mb-2 group"
        >
            <span
                x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                class="text-[11px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500"
            >
                {{ $menuGroup['title'] }}
            </span>

            <svg
                x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                class="w-4 h-4 text-gray-400 transition-transform duration-200"
                :class="open ? 'rotate-180' : ''"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7"
                />
            </svg>
        </button>


        {{-- Group Items --}}
        <ul
            x-show="open"
            x-collapse
            class="flex flex-col gap-1"
        >

            @foreach ($menuGroup['items'] as $item)

                @php
                    $itemPath = $item['path'] ?? '';

                    $isItemActive =
                        MenuHelper::isActive($itemPath);
                @endphp

                <li>

                    <a
                        href="{{ $itemPath }}"
                        class="menu-item group
                            {{ $isItemActive
                                ? 'menu-item-active'
                                : 'menu-item-inactive' }}"

                        :class="[
                            (!$store.sidebar.isExpanded &&
                            !$store.sidebar.isHovered &&
                            !$store.sidebar.isMobileOpen)
                                ? 'xl:justify-center'
                                : 'justify-start'
                        ]"
                    >

                        {{-- Icon --}}
                        <span
                            class="menu-item-icon
                                {{ $isItemActive
                                    ? 'menu-item-icon-active'
                                    : 'menu-item-icon-inactive' }}"
                        >
                            {!! MenuHelper::getIconSvg($item['icon']) !!}
                        </span>


                        {{-- Text --}}
                        <span
                            x-show="$store.sidebar.isExpanded ||
                                    $store.sidebar.isHovered ||
                                    $store.sidebar.isMobileOpen"
                            class="menu-item-text"
                        >
                            {{ $item['name'] }}
                        </span>

                    </a>

                </li>

            @endforeach

        </ul>

    </div>

@endforeach

            </div>
        </nav>

        <!-- Sidebar Widget -->
        <div
            x-data
            x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
            x-transition
            class="mt-auto">

            @include('layouts.sidebar-widget')

        </div>

    </div>

</aside>

<!-- Mobile Overlay -->
<div
    x-show="$store.sidebar.isMobileOpen"
    @click="$store.sidebar.setMobileOpen(false)"
    class="fixed z-50 h-screen w-full bg-gray-900/50">
</div>
 
