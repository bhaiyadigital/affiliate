<?php

namespace App\Http\Controllers;

use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Traits\HandlesImageUpload;

class ContentController extends Controller
{
    use HandlesImageUpload;

    public function index(Request $request, string $module)
    {
        $modules = view()->shared('modules');
        abort_unless(isset($modules[$module]), 404, 'Module not found.');

        $config = $modules[$module];

        $status = $request->input('status');

        $query = Content::module($module)->sorted();

        if ($status == 3) {
            $query->trashed();
        } else {
            $query->notTrashed();
        }

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        // Status 3 ছাড়া অন্য status filter
        if ($status !== null && $status !== '' && $status !== '3') {
            $query->where('status', $status);
        }

        $records = $query->orderBy('updated_at', 'desc')->paginate(20)->withQueryString();

        return view('contents.index', compact('module', 'config', 'records'));
    }
    public function create(string $module)
    {
        $modules = view()->shared('modules');
        abort_unless(isset($modules[$module]), 401);

        $config = $modules[$module];
        return view('contents.create', compact('module', 'config'));
    }

    public function store(Request $request, string $module)
    {
        $modules = view()->shared('modules');
        abort_unless(isset($modules[$module]), 404);

        $config = $modules[$module];

        $rules = $this->buildValidationRules($config, $request);
        $request->validate($rules);

        DB::beginTransaction();

        try {
            $data           = $this->extractFields($request, $config);
            $data['module'] = $module;

            // --- এই অংশটুকু যোগ করুন ---
            // ১. প্রতিটি বডি সেকশনের টাইটেল সেভ করা
            if ($request->has('body_titles')) {
                $data['body_titles'] = $request->input('body_titles');
            }

            // ২. প্রতিটি বডি সেকশনের আলাদা স্ট্যাটাস সেভ করা
            $sectionStatuses = [];
            foreach (['body', 'body_2', 'body_3', 'body_4'] as $f) {
                if ($request->has("extra_status_$f")) {
                    $sectionStatuses[$f] = $request->input("extra_status_$f");
                }
            }
            $data['section_statuses'] = $sectionStatuses;

            $maxSortOrder = \App\Models\Content::where('module', $module)->max('sort_order');
            $data['sort_order'] = $maxSortOrder ? $maxSortOrder + 1 : 1;
            if (isset($config['features'])) {
                $features = [];
                if ($request->has('feature_keys') && $request->has('feature_values')) {
                    foreach ($request->feature_keys as $index => $key) {
                        if (!empty($key)) {
                            $features[$key] = $request->feature_values[$index] ?? '';
                        }
                    }
                }
                $data['features'] = $features;
            }

            if (isset($config['slug']) && empty($data['slug']) && !empty($data['title'])) {
                $data['slug'] = Content::generateSlug($data['title']);
            }

            if ((int) ($data['status'] ?? 0) == Content::STATUS_SCHEDULED) {
                $data['published_at'] = $data['scheduled_at'] ?? now()->addDay();
            } else {
                $data['published_at'] = null;
            }

            $data = array_merge($data, $this->handleUploads($request, $module, $config));

            $content = Content::create($data);

            DB::commit();

            return redirect()
                ->route('contents.index', $module)
                ->with('success', 'Record created successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to create record: ' . $e->getMessage());
        }
    }

    public function edit(string $module, int $id)
    {
        $modules = view()->shared('modules');
        abort_unless(isset($modules[$module]), 404);

        $config  = $modules[$module];
        $content = Content::module($module)->findOrFail($id);

        return view('contents.create', compact('module', 'config', 'content'));
    }

    public function update(Request $request, string $module, int $id)
    {
        $modules = view()->shared('modules');
        abort_unless(isset($modules[$module]), 404);

        $config  = $modules[$module];
        $content = Content::module($module)->findOrFail($id);

        $rules = $this->buildValidationRules($config, $request, $id);
        $request->validate($rules);

        DB::beginTransaction();

        try {
            $data = $this->extractFields($request, $config);
            unset($data['sort_order']);

            // --- এই অংশটুকু যোগ করুন ---
            if ($request->has('body_titles')) {
                $data['body_titles'] = $request->input('body_titles');
            }

            $sectionStatuses = [];
            foreach (['body', 'body_2', 'body_3', 'body_4'] as $f) {
                if ($request->has("extra_status_$f")) {
                    $sectionStatuses[$f] = $request->input("extra_status_$f");
                }
            }
            $data['section_statuses'] = $sectionStatuses;
            // --- যোগ করা শেষ ---
            unset($data['sort_order']);
            if (isset($config['features'])) {
                $features = [];
                if ($request->has('feature_keys') && $request->has('feature_values')) {
                    foreach ($request->feature_keys as $index => $key) {
                        if (!empty($key)) {
                            $features[$key] = $request->feature_values[$index] ?? '';
                        }
                    }
                }
                $data['features'] = $features;
            }
            if (isset($config['slug']) && !empty($data['slug']) && $data['slug'] !== $content->slug) {
                $data['prev_slug'] = $content->slug;
                $data['slug']      = Content::generateSlug($data['slug'], $id);
            }

            if ((int) ($data['status'] ?? 0) == Content::STATUS_SCHEDULED) {
                $data['published_at'] = $data['scheduled_at'] ?? now()->addDay();
            } else {
                $data['published_at'] = null;
            }

            $uploads = $this->handleUploads($request, $module, $config, $content);
            $data    = array_merge($data, $uploads);

            $content->update($data);

            DB::commit();

            return redirect()
                ->route('contents.index', $module)
                ->with('success', 'Record updated successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to update record: ' . $e->getMessage());
        }
    }

    public function toggleStatus(string $module, int $id)
    {
        $content = Content::module($module)->findOrFail($id);
        $content->status = $content->status === Content::STATUS_ACTIVE
            ? Content::STATUS_INACTIVE
            : Content::STATUS_ACTIVE;
        $content->save();

        return response()->json([
            'status'      => $content->status,
            'status_label' => $content->status_label,
        ]);
    }

    public function trash(string $module, int $id)
    {
        $content = Content::module($module)->findOrFail($id);
        $content->update([
            'status'     => Content::STATUS_TRASH,
            'trashed_at' => now(),
        ]);

        return back()->with('success', 'Moved to trash. It will be permanently deleted after 30 days.');
    }

    public function restore(string $module, int $id)
    {
        $content = Content::module($module)->where('status', Content::STATUS_TRASH)->findOrFail($id);
        $content->update([
            'status'     => Content::STATUS_INACTIVE,
            'trashed_at' => null,
        ]);

        return back()->with('success', 'Record restored successfully.');
    }

    public function destroy(string $module, int $id)
    {
        $content = Content::module($module)->findOrFail($id);

        $modules = view()->shared('modules');
        $config  = $modules[$module] ?? [];

        // ডাইনামিক ফাইল ডিলিট
        $this->deleteFiles($content, $config);
        $content->delete();

        return back()->with('success', 'Record permanently deleted.');
    }

    public function bulk(Request $request, string $module)
    {
        $request->validate([
            'ids'    => 'required|array',
            'ids.*'  => 'integer',
            'action' => 'required|in:delete,activate,deactivate,trash',
        ]);

        $records = Content::module($module)->whereIn('id', $request->ids)->get();
        $modules = view()->shared('modules');
        $config  = $modules[$module] ?? [];
        foreach ($records as $record) {
            match ($request->action) {
                'delete' => (function () use ($record, $config) {
                    // Delete associated files
                    $this->deleteFiles($record, $config);

                    // Delete database record
                    $record->delete();
                })(),

                'activate' => $record->update([
                    'status' => Content::STATUS_ACTIVE
                ]),

                'deactivate' => $record->update([
                    'status' => Content::STATUS_INACTIVE
                ]),

                'trash' => $record->update([
                    'status' => Content::STATUS_TRASH,
                    'trashed_at' => now()
                ]),
            };
        }


        return back()->with('success', 'Bulk action applied successfully.');
    }

    public function reorder(Request $request, string $module)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer',
        ]);

        foreach ($request->order as $position => $id) {
            Content::module($module)
                ->where('id', $id)
                ->update(['sort_order' => $position + 1]);
        }

        return response()->json(['success' => true]);
    }

    public function generateSlug(Request $request)
    {
        $request->validate(['title' => 'required|string']);
        $ignoreId = $request->input('ignore_id');
        $slug     = Content::generateSlug($request->title, $ignoreId ? (int) $ignoreId : null);

        return response()->json(['slug' => $slug]);
    }

    public function removeImage(Request $request, string $module, int $id)
    {
        $request->validate([
            'path'  => 'required|string',
            'field' => 'required|string',
        ]);

        $content    = Content::module($module)->findOrFail($id);
        $field      = $request->input('field');
        $imgPaths   = $content->$field ?? [];
        $removePath = $request->input('path');

        if (Storage::disk('public')->exists($removePath)) {
            Storage::disk('public')->delete($removePath);
        }

        $imgPaths = array_values(array_filter($imgPaths, fn($p) => $p !== $removePath));
        $content->update([$field => $imgPaths]);

        return response()->json(['success' => true, $field => $imgPaths]);
    }

    private function buildValidationRules(array $config, Request $request, ?int $ignoreId = null): array
    {
        $rules = [];

        foreach ($config as $field => $options) {
            if ($field === 'module_name' || $field === 'sort_order') continue;


            $required = ($options['required'] ?? false) ? 'required' : 'nullable';
            $type     = $options['type'] ?? 'text';

            if ($type === 'image') {
                $rules[$field] = $ignoreId
                    ? ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp,svg']
                    : [$required, 'file',  'mimes:jpg,jpeg,png,gif,webp,svg'];
            } elseif ($type === 'image_multiple') {
                $rules[$field] = ['nullable', 'array'];
                $rules[$field . '.*'] = ['file',  'mimes:jpg,jpeg,png,gif,webp,svg'];
            } elseif ($type === 'video') {
                $rules[$field] = $ignoreId
                    ? ['nullable', 'file', 'mimetypes:video/mp4,video/avi,video/quicktime']
                    : [$required, 'file', 'mimetypes:video/mp4,video/avi,video/quicktime'];
            } elseif ($type === 'video_multiple') {
                $rules[$field] = ['nullable', 'array'];
                $rules[$field . '.*'] = ['file', 'mimetypes:video/mp4,video/avi,video/quicktime', 'max:102400'];
            } elseif ($field === 'features') {
                $rules['feature_keys']   = ['nullable', 'array'];
                $rules['feature_keys.*'] = ['nullable', 'string'];
                $rules['feature_values']   = ['nullable', 'array'];
                $rules['feature_values.*'] = ['nullable', 'string'];
            } else {
                $rules[$field] = match ($type) {
                    'url'      => [$required, 'url'],
                    'number'   => [$required, 'integer'],
                    'select'   => [$required],
                    'datetime' => [$required, 'date'],
                    'tag'      => [$required, 'string'],
                    default    => [$required, 'string'],
                };
            }

            if ($field === 'slug') {
                $uniqueRule    = 'unique:contents,slug';
                if ($ignoreId) $uniqueRule .= ',' . $ignoreId;
                $rules['slug'][] = $uniqueRule;
            }
        }
        $rules['scheduled_at'] = $request->input('status') == Content::STATUS_SCHEDULED
            ? ['required', 'date']
            : ['nullable', 'date'];
        return $rules;
    }

    private function extractFields(Request $request, array $config): array
    {
        $data         = [];
        $fileTypes    = ['image', 'image_multiple', 'video', 'video_multiple'];
        $skipFields   = ['module_name'];

        foreach ($config as $field => $options) {
            if (in_array($field, $skipFields)) continue;
            if (in_array($options['type'] ?? '', $fileTypes)) continue;

            if ($field === 'features') {
                $raw = $request->input('features');
                $data['features'] = is_array($raw) ? $raw : (json_decode($raw, true) ?? []);
                continue;
            }

            $data[$field] = $request->input($field);
        }

        if ($request->filled('scheduled_at')) {
            $data['scheduled_at'] = \Carbon\Carbon::parse(
                $request->input('scheduled_at')
            )->format('Y-m-d H:i:s');
        }
        return $data;
    }

    // ✅ UserController-এর মতো FileUploadHelper ব্যবহার করে ফাইল হ্যান্ডেলিং
    private function handleUploads(Request $request, string $module, array $config, ?Content $existing = null): array
    {
        $data = [];
        $dir  = "contents/{$module}"; // ডিরেক্টরি স্ট্রাকচার

        foreach ($config as $field => $options) {
            $type = $options['type'] ?? 'text';

            // ১. সিঙ্গেল ইমেজ বা ভিডিও (UserController-এর মতো পুরাতন ফাইল ডিলিট সহ)
            if (in_array($type, ['image', 'video']) && $request->hasFile($field)) {
                if ($existing && $existing->$field) {
                    FileUploadHelper::deleteImage($existing->$field);
                }
                $data[$field] = FileUploadHelper::uploadImage($request->file($field), $dir);
            }

            // ২. যদি ইমেজ রিমুভ করার রিকোয়েস্ট থাকে (manual remove)
            elseif ($request->boolean("remove_{$field}")) {
                if ($existing && $existing->$field) {
                    FileUploadHelper::deleteImage($existing->$field);
                    $data[$field] = null;
                }
            }

            // ৩. মাল্টিপল ইমেজ (Gallery) - অর্ডারিং এবং নতুন ফাইল হ্যান্ডেলিং
            elseif ($type === 'image_multiple') {
                $orderKey = $field . '_order';
                $existingPaths = $existing ? (is_array($existing->$field) ? $existing->$field : []) : [];
                $newUploadedPaths = [];

                // নতুন ফাইল আপলোড
                if ($request->hasFile($field)) {
                    foreach ($request->file($field) as $file) {
                        $newUploadedPaths[] = FileUploadHelper::uploadImage($file, "{$dir}/gallery");
                    }
                }

                // সর্টিং/অর্ডারিং লজিক (যদি ফ্রন্টএন্ড থেকে অর্ডার আসে)
                if ($request->filled($orderKey)) {
                    $order = json_decode($request->input($orderKey), true) ?? [];
                    $finalPaths = [];
                    $newIdx = 0;
                    foreach ($order as $item) {
                        if (str_starts_with($item, 'new_') && isset($newUploadedPaths[$newIdx])) {
                            $finalPaths[] = $newUploadedPaths[$newIdx++];
                        } elseif (in_array($item, $existingPaths)) {
                            $finalPaths[] = $item;
                        }
                    }
                    $data[$field] = $finalPaths;
                } else {
                    $data[$field] = array_merge($existingPaths, $newUploadedPaths);
                }
            }
        }
        return $data;
    }

    // ✅ ডিলিট করার সময় সব ফাইল পরিষ্কার করার মেথড
    private function deleteFiles(Content $content, array $config): void
    {
        foreach ($config as $field => $options) {
            $type = $options['type'] ?? '';

            if (in_array($type, ['image', 'video']) && $content->$field) {
                FileUploadHelper::deleteImage($content->$field);
            } elseif (in_array($type, ['image_multiple', 'video_multiple'])) {
                $files = is_array($content->$field) ? $content->$field : [];
                foreach ($files as $file) {
                    FileUploadHelper::deleteImage($file);
                }
            }
        }
    }
}
