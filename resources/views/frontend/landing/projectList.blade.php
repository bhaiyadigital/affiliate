@extends('frontend.layouts.front')
@section('meta')
    @include('components.meta-info.add-meta.project-meta', ['setup' => $setup])
@endsection
@section('content')
    <style>
        .project-card {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
    </style>
    <section class="bg-gray-50 py-10">
        <div class="container mx-auto px-6 md:px-10">
            <div class="mb-16">
                <div class="flex justify-between items-center mb-10">
                    <h2 class="text-3xl md:text-[32px] font-semibold text-[#111111]">
                        @if (request('cat'))
                            {{ $categories->where('id', request('cat'))->first()->title ?? '' }} Projects
                        @elseif(request('dest'))
                            @php $targetDest = $destinations->where('id', request('dest'))->first(); @endphp
                            Projects in {{ $targetDest->title ?? 'Destination' }}
                        @else
                            All Projects
                        @endif
                    </h2>

                    @if (request('cat') || request('dest'))
                        <a href="{{ route('affiliated.project') }}"
                            class="text-[#2c4294] font-bold hover:underline flex items-center gap-2 transition-all">
                            <i class="fa-solid fa-arrow-left text-sm"></i> Back to all projects
                        </a>
                    @endif
                </div>

                <div id="filter-section"
                    class="{{ request('cat') || request('dest') ? 'hidden' : 'flex' }} overflow-x-auto pb-4">
                    <div class="flex gap-8 md:gap-12 whitespace-nowrap">
                        <a href="{{ route('affiliated.project') }}" aria-label="project route"
                            class="pb-3 font-bold text-sm md:text-base border-b-2 {{ !request('cat') ? 'border-[#2c4294] text-gray-900' : 'border-transparent text-gray-700' }}">
                            All
                        </a>

                        @foreach ($categories as $cat)
                            <a href="{{ route('affiliated.project', ['cat' => $cat->id]) }}"
                                aria-label="project route for category"
                                class="pb-3 font-bold text-sm md:text-base border-b-2 {{ request('cat') == $cat->id ? 'border-[#2c4294] text-gray-900' : 'border-transparent text-gray-700 hover:text-gray-900' }}">
                                {{ $cat->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
                @forelse($projects as $project)
                    <a href="{{ route('affiliated.project.details', $project->slug) }}" aria-label="View project details"
                        class="bg-white block rounded-4xl overflow-hidden shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 group transition-all duration-300 hover:shadow-xl">
                        <!-- Image Area -->
                        <div class="relative aspect-[16/11] overflow-hidden bg-gray-100">
                            @php
                                $displayImage = $project->imageUrl ?? ($project->galleryUrls[0] ?? '');
                            @endphp

                            <img src="{{ $displayImage }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                alt="{{ $project->title }}" onerror="this.onerror=null;this.src='{{ '' }}';" />
                        </div>

                        <!-- Content Area -->
                        <div class="p-8">
                            <span
                                class="inline-block bg-gray-50 text-gray-600 px-3 py-1 rounded text-xs md:text-base border border-gray-200 mb-4">
                                {{ $project->parent->title ?? 'General' }}
                            </span>

                            <h3 class="text-lg md:text-xl font-semibold text-gray-900 mb-5 leading-tight truncate">
                                {{ $project->title ?? '' }}
                            </h3>

                            <div class="space-y-3">
                                <div class="flex items-center gap-3 text-gray-700 text-sm md:text-base">
                                    <i class="fa-solid fa-location-dot text-[#2c4294]"></i>
                                    <span>{{ $project->location ?? '' }}</span>
                                </div>
                                <div class="flex items-center gap-1 text-gray-700 text-sm md:text-base">
                                    <i class="fa-solid fa-vector-square text-[#2c4294]"></i>
                                    {!! $project->name ?? 'ft' !!}
                                </div>
                            </div>

                            <div class="flex justify-end pt-2">
                                <div class="inline-flex items-center gap-2 text-[#2c4294] font-bold text-sm md:text-base">
                                    See Details
                                    <i
                                        class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-center text-gray-600 py-10">No projects found.</p>
                @endforelse
            </div>

            <div class="mt-16 flex justify-center">
                {{ $projects->appends(request()->query())->links('frontend.partials.custom_pagination') }}
            </div>
        </div>
    </section>
@endsection
