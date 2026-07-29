@php
    $isEdit = isset($content);
    $sidebarFields = [
        'status',
        'parent_id',
        'destination_id',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'concern',
    ];
@endphp

<div class="space-y-6">
    @foreach ($config as $field => $options)
        @if ($field === 'module_name' || in_array($field, $sidebarFields))
            @continue
        @endif

        @php
            $type = $options['type'] ?? 'text';
            $label = $options['label'];
            $required = !empty($options['required']) ? 'required' : '';
            $val = old($field, $isEdit ? $content->$field : '');
        @endphp

        <div class="mb-4">
            @if (in_array($type, ['text', 'slug', 'number', 'url']))
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">{{ $label }}
                    @if ($required)
                        <span class="text-red-500">*</span>
                    @endif
                </label>
                <input type="{{ $type === 'slug' ? 'text' : $type }}" name="{{ $field }}" id="{{ $field }}"
                    value="{{ $val }}"
                    class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-blue-500 outline-none dark:border-gray-700 dark:text-white"
                    {{ $required }}>
            @elseif (in_array($type, ['date', 'datetime']))
                <label
                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">{{ $label }}</label>
                <input type="{{ $type === 'datetime' ? 'datetime-local' : 'date' }}" name="{{ $field }}"
                    id="{{ $field }}"
                    value="{{ old($field, $isEdit && $content->$field ? ($content->$field instanceof \Carbon\Carbon ? $content->$field->format($type === 'datetime' ? 'Y-m-d\TH:i' : 'Y-m-d') : $content->$field) : '') }}"
                    class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-blue-500 outline-none dark:border-gray-700 dark:text-white">
            @elseif ($type === 'editor')
                <div
                    class="mb-8 p-5 border border-gray-200 rounded-2xl bg-white shadow-sm dark:bg-gray-800/40 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row gap-4 mb-4">
                        <div class="flex-1">
                            <label
                                class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-1 block">Title
                                for {{ $label }}</label>
                            <input type="text" name="body_titles[{{ $field }}]"
                                value="{{ old('body_titles.' . $field, $isEdit ? $content->body_titles[$field] ?? '' : '') }}"
                                class="w-full rounded-lg border border-gray-200 bg-gray-50/50 px-3 py-2 text-sm outline-none"
                                placeholder="Enter section heading...">
                        </div>
                        <div class="w-full md:w-40">
                            <label
                                class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Section
                                Status</label>
                            <select name="extra_status_{{ $field }}"
                                class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <label class="text-xs font-bold text-gray-600 dark:text-gray-400 block mb-2">{{ $label }}
                        Content</label>
                    <textarea class="editor" name="{{ $field }}">{{ $val }}</textarea>
                </div>

                {{-- ৩. সিঙ্গেল ইমেজ প্রিভিউ (Alpine.js) --}}
            @elseif ($type === 'image')
                @php $imageUrl = $isEdit ? $content->image_url : ''; @endphp
                <div x-data="{ preview: '{{ $imageUrl }}' }">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ $label }}</label>
                    <div @click="$refs.{{ $field }}Input.click()"
                        class="relative flex flex-col items-center justify-center gap-2 rounded-xl border-2 border-dashed border-gray-300 bg-gray-50/50 p-4 cursor-pointer hover:border-blue-400">
                        <template x-if="preview">
                            <img :src="preview" class="h-48 w-full object-cover rounded-lg shadow-sm">
                        </template>
                        <template x-if="!preview">
                            <div class="text-center py-4">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-300 mb-2"></i>
                                <p class="text-sm text-gray-400">Upload {{ $label }}</p>
                            </div>
                        </template>
                    </div>
                    <input type="file" x-ref="{{ $field }}Input" name="{{ $field }}" class="hidden"
                        @change="const file = $event.target.files[0]; if(file){ const reader = new FileReader(); reader.onload = (e) => preview = e.target.result; reader.readAsDataURL(file); }">
                </div>

            @elseif ($type === 'image_multiple')
                @php
                    $existingGallery = $isEdit ? $content->gallery_urls : [];
                @endphp
                <div x-data="{
                    galleryImages: @js($existingGallery),
                    handleGallery(event) {
                        const files = Array.from(event.target.files);
                        files.forEach(file => {
                            const reader = new FileReader();
                            reader.onload = (e) => this.galleryImages.push(e.target.result);
                            reader.readAsDataURL(file);
                        });
                    },
                    removeImage(index) { this.galleryImages.splice(index, 1); }
                }">
                    <label class="mb-2 block text-sm font-bold text-gray-700">{{ $label }}</label>
                    <div @click="$refs.{{ $field }}Input.click()"
                        class="flex flex-col items-center justify-center border-2 border-dashed border-blue-300 bg-blue-50/30 p-4 rounded-xl cursor-pointer">
                        <i class="fas fa-images text-2xl text-blue-400 mb-1"></i>
                        <p class="text-xs text-gray-500">Add multiple images</p>
                        <input type="file" x-ref="{{ $field }}Input" name="{{ $field }}[]" multiple
                            class="hidden" @change="handleGallery">
                    </div>

                    <div class="grid grid-cols-4 sm:grid-cols-6 gap-3 mt-4" x-show="galleryImages.length > 0">
                        <template x-for="(image, index) in galleryImages" :key="index">
                            <div class="relative group h-20 border rounded-lg overflow-hidden">
                                <img :src="image" class="h-full w-full object-cover">
                                <button type="button" @click="removeImage(index)"
                                    class="absolute top-0 right-0 bg-red-600 text-white w-4 h-4 flex items-center justify-center text-[8px] rounded-bl-lg">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- ৫. টেক্সট এরিয়া --}}
            @elseif ($type === 'textarea')
                <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ $label }}</label>
                <textarea name="{{ $field }}" rows="3"
                    class="w-full rounded-lg border border-gray-300 p-3 dark:bg-gray-900">{{ $val }}</textarea>
            @endif
        </div>
    @endforeach
</div>

@section('form_sidebar')
    <div class="space-y-4">
        @foreach ($config as $field => $options)
            @if (in_array($field, $sidebarFields))
                @php
                    $type = $options['type'] ?? 'text';
                    $val = old($field, $isEdit ? $content->$field : '');
                @endphp

                <div>
                    <label class="mb-1 block text-xs font-bold uppercase text-gray-500">{{ $options['label'] }}</label>

                    @if ($field === 'status')
                        <select name="status" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                            <option value="1" {{ $val == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $val == 0 ? 'selected' : '' }}>Inactive</option>
                            <option value="2" {{ $val == 2 ? 'selected' : '' }}>Scheduled</option>
                        </select>
                    @elseif ($type === 'select' || isset($options['options']))
                        <select name="{{ $field }}"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                            <option value="">-- Select --</option>
                            @php
                                $optName = $options['options'] ?? '';
                                $items = $optName ? $$optName ?? [] : [];
                            @endphp
                            @foreach ($items as $opt)
                                <option value="{{ $opt->id }}" {{ $val == $opt->id ? 'selected' : '' }}>
                                    {{ $opt->title ?? $opt->name }}
                                </option>
                            @endforeach
                        </select>
                    @elseif ($field === 'meta_description' || $type === 'textarea')
                        <textarea name="{{ $field }}" rows="3" class="w-full rounded border border-gray-300 px-3 py-2 text-xs">{{ $val }}</textarea>
                    @else
                        <input type="text" name="{{ $field }}" value="{{ $val }}"
                            class="w-full rounded border border-gray-300 px-3 py-2 text-xs">
                    @endif
                </div>
            @endif
        @endforeach
    </div>
@endsection
