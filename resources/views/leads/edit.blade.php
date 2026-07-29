@extends('layouts.app')

@section('content')
<div class="p-4 mx-auto max-w-screen-md md:p-6">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-6">
        <a href="{{ route('admin.leads.index') }}" class="hover:text-gray-700 dark:hover:text-gray-200 transition-colors">Lead List</a>
        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg>
        <span class="text-gray-700 dark:text-gray-300 font-medium">Edit Lead</span>
    </nav>

    <div class="rounded-xl border border-gray-100 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <h3 class="text-lg font-semibold dark:text-white mb-6">Edit Lead Information</h3>

        <form action="{{ route('admin.leads.update', $lead->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Customer Name --}}
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Customer Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $lead->name) }}" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 dark:border-gray-700 dark:text-white/90 focus:border-blue-500 outline-none" />
                    </div>

                    {{-- Phone Number --}}
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Phone Number <span class="text-red-500">*</span></label>
                        <input type="tel" name="phone" value="{{ old('phone', $lead->phone) }}" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 dark:border-gray-700 dark:text-white/90 focus:border-blue-500 outline-none" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Interested Location / Project --}}
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Interested Project</label>
                        <select name="interested_location" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 focus:border-blue-500 outline-none">
                            <option value="">Select Project</option>
                            @foreach($shared_projects as $project)
                                <option value="{{ $project->title }}" {{ old('interested_location', $lead->interested_location) == $project->title ? 'selected' : '' }}>
                                    {{ $project->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Budget --}}
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Budget (BDT)</label>
                        <input type="number" name="budget" value="{{ old('budget', $lead->budget) }}"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 dark:border-gray-700 dark:text-white/90 focus:border-blue-500 outline-none" />
                    </div>
                </div>

                {{-- Lead Status --}}
                <div>
                    <label class="mb-1.5 block text-sm font-bold uppercase text-gray-500">Lead Pipeline Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="h-11 w-full rounded-lg border border-gray-300 bg-white px-4 text-sm font-bold text-blue-600 dark:border-gray-700 dark:bg-gray-900 outline-none focus:ring-2 focus:ring-blue-500/20">
                        @foreach($statusLabels as $value => $label)
                            <option value="{{ $value }}" {{ old('status', $lead->status) == $value ? 'selected' : '' }}>
                                {{ strtoupper($label) }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-2 text-[11px] text-gray-400 italic">Changing status will update the lead's progress in the sales funnel.</p>
                </div>

                {{-- Buttons --}}
                <div class="flex items-center justify-end gap-3 border-t border-gray-100 dark:border-gray-700 pt-6 mt-4">
                    <a href="{{ route('admin.leads.index') }}" class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-bold text-white hover:bg-blue-700 shadow-md transition-all active:scale-95">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
