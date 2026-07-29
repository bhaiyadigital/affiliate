@extends('frontend.layouts.front')
@section('meta')
    @include('components.meta-info.add-meta.index-meta', ['setup' => $setup])
@endsection
@section('content')
    <section
        class="relative w-full bg-gradient-to-br from-[#003b7a] via-[#0090a8] to-[#00c7b1] pt-8 pb-40 md:pb-30 lg:pt-10 lg:pb-28 px-4 lg:px-6">
        <div class="container mx-auto mx-auto flex flex-col md:flex-row justify-between items-start md:items-center">
            <!-- Welcome Info Section -->
            <div
                class="flex flex-col md:flex-row items-center lg:items-start gap-4 lg:gap-8 text-center lg:text-left mb-24 lg:mb-0 w-full">
                <div class="flex flex-col gap-5 shrink-0">
                    <!-- Bhaiya Asset Library Badge -->
                    <div
                        class="relative w-[85px] h-[85px] lg:w-[115px] lg:h-[115px] flex items-center justify-center shrink-0">
                        <div class="absolute top-0 right-0 w-[90%] h-[7.5px] bg-[#3293e3]"></div>
                        <div class="absolute top-0 right-0 w-[7.5px] h-[90%] bg-[#3293e3]"></div>

                        <div class="absolute bottom-0 left-0 w-[90%] h-[7.5px] bg-[#48b5e6]"></div>
                        <div class="absolute bottom-0 left-0 w-[7.5px] h-[90%] bg-[#48b5e6]"></div>
                        <div class="absolute bottom-[-11px] left-[-11px] w-[12px] h-[12px] bg-[#3293e3] z-20"></div>
                        <div class="relative z-10 flex flex-col items-center justify-center">
                            <span class="text-3xl text-white font-bold italic leading-none tracking-tighter">Bhaiya</span>
                            <p class="text-sm text-blue-300 leading-none mt-1 opacity-95">
                                Asset Library
                            </p>
                        </div>
                    </div>

                </div>
                @php
                    $siteSetting = \App\Models\SiteSetting::first();

                @endphp
                <div class="pt-0 lg:pt-4">
                    <h1 class="text-2xl lg:text-4xl text-white font-bold leading-tight">
                        Welcome {{ $user->name ?? '' }} !
                    </h1>
                    <p class="text-xs lg:text-sm text-white/75 font-bold uppercase tracking-[2px] mt-1">
                        {{ $siteSetting->slogan }}
                    </p>
                </div>
            </div>

            <!-- SEARCH BAR — overlapping bottom -->
            <div class="absolute bottom-0 left-0 right-0 px-4 lg:px-6 mb-4 lg:mb-6">
                <form action="{{ route('home.filter') }}" method="GET"
                    class="container mx-auto bg-white border border-gray-200 flex flex-col lg:flex-row items-stretch lg:items-center shadow-lg">

                    <!-- Search Input: border-b (mobile) lg:border-r (desktop) -->
                    <div class="flex-1 flex items-center px-4 border-b lg:border-b-0 lg:border-r border-gray-200">
                        <i class="fas fa-search text-[#3293e3] mr-3"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                            class="w-full py-3 lg:py-4 outline-none text-sm text-gray-600 bg-transparent" />
                    </div>

                    <!-- Dropdowns -->
                    <div
                        class="grid grid-cols-2 md:grid-cols-4 lg:flex items-center divide-x divide-gray-100 lg:divide-gray-200 border-b lg:border-b-0">
                        <div class="px-2 lg:px-5">
                            <label for="concern-select" class="sr-only">Filter by Concern</label>
                            <select name="concern" aria-label="Filter by Concern"
                                class="w-full outline-none text-[12px] lg:text-sm font-medium text-gray-600 bg-transparent py-3 lg:py-4">
                                <option value="">Concern</option>
                                @foreach ($concerns as $concern)
                                    <option value="{{ $concern->id }}"
                                        {{ request('concern') == $concern->id ? 'selected' : '' }}>
                                        {{ $concern->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- 2. Project -->
                        <div class="px-5">
                            <label for="project-select" class="sr-only">Filter by Project</label>
                            <select name="project" aria-label="Filter by projetc"
                                class="outline-none text-sm font-medium text-gray-600 bg-transparent cursor-pointer py-4 min-w-[90px]">
                                <option value="">Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}"
                                        {{ request('project') == $project->id ? 'selected' : '' }}>
                                        {{ $project->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- 3. Asset Type -->
                        <div class="px-5">
                            <label for="type-select" class="sr-only">Filter by Asset Type</label>
                            <select name="type" aria-label="Filter by type"
                                class="outline-none text-sm font-medium text-gray-600 bg-transparent cursor-pointer py-4 min-w-[100px]">
                                <option value="">Asset Type</option>
                                @foreach ($assetTypes as $type)
                                    <option value="{{ $type->id }}"
                                        {{ request('type') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2 lg:gap-4 px-4 py-2 lg:py-3 bg-gray-50 lg:bg-transparent">
                        <button type="submit"
                            class="flex-1 bg-[#0071c5] text-white px-4 lg:px-8 py-2 lg:py-2.5 text-xs lg:text-sm font-bold">
                            Search
                        </button>
                        <a href="{{ route('home.index') }}"
                            class="text-[#0071c5] text-[10px] lg:text-sm font-semibold whitespace-nowrap">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
    </section>

    <!-- ── Latest Marketing Assets Section ── -->
    <section class="container mx-auto px-6 py-12">
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('home.filter', ['section' => 'assets', 'sort' => 'latest']) }}">
                <h2 class="text-xl lg:text-3xl text-[#0071c5] underline">
                    Latest Marketing Assets
                </h2>
            </a>

            <a href="{{ route('home.filter', ['section' => 'assets', 'sort' => 'latest']) }}" aria-label="View all assets"
                class="bg-[#00aeef] text-white w-7 h-7 flex items-center justify-center shrink-0">
                <i class="fas fa-arrow-right text-xs"></i>
            </a>

            <a href="{{ route('home.filter', ['section' => 'assets', 'sort' => 'latest']) }}"
                class="ml-auto inline-flex items-center gap-2 bg-[#0071c5] text-white text-xs lg:text-sm font-bold px-4 py-2 hover:bg-[#005ea3] transition-all">
                View All
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
        <div class="relative group container mx-auto px-6">
            <div class="absolute -left-5 top-1/2 -translate-y-1/2 z-30   lg:flex">
                <div
                    class="swiper-button-prev-custom w-11 h-11 bg-white border border-gray-200 rounded-full shadow-lg flex items-center justify-center text-gray-400 hover:text-[#0071c5] cursor-pointer transition-all">
                    <i class="fa-solid fa-chevron-left text-lg"></i>
                </div>
            </div>
            <div class="swiper mySwiper overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach ($latestAssets as $asset)
                        <x-frontend.asset-card :asset="$asset" :swiper="true" />
                    @endforeach
                </div>
            </div>

            <!-- Swiper Next Button -->
            <div class="absolute -right-5 top-1/2 -translate-y-1/2 z-30   lg:flex">
                <div
                    class="swiper-button-next-custom w-11 h-11 bg-white border border-gray-200 rounded-full shadow-lg flex items-center justify-center text-gray-400 hover:text-[#0071c5] cursor-pointer transition-all">
                    <i class="fa-solid fa-chevron-right text-lg"></i>
                </div>
            </div>
        </div>
    </section>
    <!-- ── Housing Projects Section (Slider Style) ── -->
    <section class="container mx-auto px-6 py-16 border-t border-gray-100">
        <!-- Header: Assets সেকশনের মতো একই স্টাইল -->
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('affiliated.project') }}">
                <h2 class="text-xl lg:text-3xl text-[#0071c5] underline">
                    Our Housing Projects
                </h2>
            </a>

            <a href="{{ route('affiliated.project') }}" aria-label="View all projects"
                class="bg-[#00aeef] text-white w-7 h-7 flex items-center justify-center shrink-0">
                <i class="fas fa-arrow-right text-xs"></i>
            </a>

            <a href="{{ route('affiliated.project') }}"
                class="ml-auto inline-flex items-center gap-2 bg-[#0071c5] text-white text-xs lg:text-sm font-bold px-4 py-2 hover:bg-[#005ea3] transition-all">
                View All
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <!-- Slider Wrapper -->
        <div class="relative group container mx-auto px-6">
            <!-- Navigation: Left -->
            <div class="absolute -left-5 top-1/2 -translate-y-1/2 z-30 lg:flex">
                <div
                    class="projects-prev-btn w-11 h-11 bg-white border border-gray-200 rounded-full shadow-lg flex items-center justify-center text-gray-400 hover:text-[#0071c5] cursor-pointer transition-all">
                    <i class="fa-solid fa-chevron-left text-lg"></i>
                </div>
            </div>

            <div class="swiper projectsSwiper overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach ($projects as $project)
                        <div class="swiper-slide">
                            <a href="{{ route('affiliated.project.details', $project->slug) }}"
                                class="bg-white block rounded-2xl overflow-hidden shadow-sm border border-gray-100 group transition-all duration-300 hover:shadow-md">

                                <!-- Image Area -->
                                <div class="relative aspect-[16/11] overflow-hidden bg-gray-200">
                                    @php
                                        $displayImage =
                                            $project->imageUrl ??
                                            ($project->galleryUrls[0] ?? asset('assets/images/placeholder.jpg'));
                                    @endphp
                                    <img src="{{ $displayImage }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                        alt="{{ $project->title }}"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder.jpg') }}';" />

                                    @if ($project->destination)
                                        <div
                                            class="absolute top-3 left-3 bg-[#003b7a]/80 text-white text-[9px] font-bold px-2 py-0.5 rounded-full backdrop-blur-sm">
                                            <i class="fas fa-location-dot mr-1"></i> {{ $project->destination->title }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Content Area -->
                                <div class="p-6">
                                    <span
                                        class="inline-block bg-blue-50 text-[#0071c5] px-2 py-0.5 rounded text-[9px] font-bold uppercase border border-blue-100 mb-3">
                                        {{ $project->parent->title ?? 'Real Estate' }}
                                    </span>

                                    <h3
                                        class="text-base font-bold text-gray-900 mb-3 leading-tight group-hover:text-[#0071c5] transition-colors truncate">
                                        {{ $project->title }}
                                    </h3>

                                    <div class="flex items-center gap-2 text-gray-500 text-xs mb-4">
                                        <i class="fa-solid fa-location-dot text-[#00aeef]"></i>
                                        <span class="truncate">{{ $project->location ?? 'Location' }}</span>
                                    </div>

                                    <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                                        <span class="text-[#0071c5] font-bold text-xs">View Details</span>
                                        <i
                                            class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation: Right -->
            <div class="absolute -right-5 top-1/2 -translate-y-1/2 z-30 lg:flex">
                <div
                    class="projects-next-btn w-11 h-11 bg-white border border-gray-200 rounded-full shadow-lg flex items-center justify-center text-gray-400 hover:text-[#0071c5] cursor-pointer transition-all">
                    <i class="fa-solid fa-chevron-right text-lg"></i>
                </div>
            </div>
        </div>
    </section>

    @endsection
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Swiper(".projectsSwiper", {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    navigation: {
                        nextEl: ".projects-next-btn",
                        prevEl: ".projects-prev-btn",
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 2
                        },
                        1024: {
                            slidesPerView: 3
                        },
                    },
                });
            });
        </script>
    @endpush
