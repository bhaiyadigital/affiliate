<?php $__env->startSection('content'); ?>
    <div class="p-4 mx-auto w-full md:p-6" x-data="{
        selected: [],
        allChecked: false,
        confirmModal: { open: false, formId: null, message: '' },
        toggleAll() {
            const checkboxes = document.querySelectorAll('.row-check');
            this.allChecked = !this.allChecked;
            this.selected = this.allChecked ? Array.from(checkboxes).map(el => el.value) : [];
        },
        updateCheckAll() {
            const total = document.querySelectorAll('.row-check').length;
            this.allChecked = this.selected.length === total && total > 0;
        },
        askConfirm(formId, message) {
            this.confirmModal = { open: true, formId, message };
        },
        doConfirm() {
            document.getElementById(this.confirmModal.formId).submit();
            this.confirmModal.open = false;
        }
    }">
        <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-6">
            <a href="<?php echo e(Route::has('dashboard') ? route('dashboard') : '#'); ?>" class="hover:text-gray-700">Dashboard</a>
            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" />
            </svg>
            <span
                class="text-gray-700 dark:text-gray-300 font-medium capitalize"><?php echo e(str_replace(['-', '_'], ' ', $module)); ?></span>
        </nav>

        
        <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white capitalize">
                    <?php echo e(str_replace(['-', '_'], ' ', $module)); ?> List</h1>
                <p class="text-sm text-gray-500">Manage all <?php echo e($module); ?> entries</p>
            </div>

            <div class="flex items-center gap-3">
                <form method="GET" action="<?php echo e(route('contents.index', $module)); ?>" class="flex items-center gap-2">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search..."
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white">

                    <select name="status" onchange="this.form.submit()"
                        class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white">
                        <option value="">All Status</option>
                        <option value="1" <?php echo e(request('status') === '1' ? 'selected' : ''); ?>>Active</option>
                        <option value="0" <?php echo e(request('status') === '0' ? 'selected' : ''); ?>>Inactive</option>
                        <option value="2" <?php echo e(request('status') === '2' ? 'selected' : ''); ?>>Scheduled</option>
                        <option value="3" <?php echo e(request('status') === '3' ? 'selected' : ''); ?>>Trash</option>
                    </select>

                    <button type="submit"
                        class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-200">Filter</button>

                    <?php if(request('search') || request('status')): ?>
                        <a href="<?php echo e(route('contents.index', $module)); ?>"
                            class="text-xs text-gray-400 hover:text-gray-600 underline">Reset</a>
                    <?php endif; ?>
                </form>

                
                <?php if(auth()->user()->hasPermission($module . '.create')): ?>
                    <a href="<?php echo e(route('contents.create', $module)); ?>"
                        class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 shadow-md">
                        <i class="fas fa-plus"></i> New Entry
                    </a>
                <?php endif; ?>
            </div>
        </div>

        
        <div x-show="selected.length > 0" x-cloak
            class="mb-4 flex items-center justify-between rounded-xl border border-blue-100 bg-blue-50 p-4 dark:bg-blue-900/20">
            <div class="flex items-center gap-2 text-blue-700 font-semibold">
                <i class="fas fa-check-circle"></i>
                <span x-text="selected.length + ' selected'"></span>
            </div>
            <form id="bulk-form" action="<?php echo e(route('contents.bulk', $module)); ?>" method="POST" class="flex items-center gap-3">
                <?php echo csrf_field(); ?>
                <template x-for="id in selected"><input type="hidden" name="ids[]" :value="id"></template>
                <select name="action" x-model="bulkAction" class="rounded-lg border-gray-300 py-1.5 px-3 text-sm focus:ring-blue-500">
                    <option value="activate">Mark Active</option>
                    <option value="deactivate">Mark Inactive</option>
                    <!-- <option value="trash">Move to Trash</option> -->
                    <option value="delete">Permanent Delete</option>
                </select>
                <button type="button"
                    @click="askConfirm('bulk-form', 'Apply this action to ' + selected.length + ' selected item(s)?')"
                    class="bg-blue-600 text-white px-4 py-1.5 rounded-lg text-sm font-bold">Apply</button>
            </form>
        </div>

        
        <div
            class="rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-white/[0.03] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <tr>
                            <th class="px-5 py-4 w-10"><input type="checkbox" @click="toggleAll()" :checked="allChecked">
                            </th>
                            <th class="px-2 py-4 w-10 text-center text-gray-400"><i class="fas fa-arrows-alt-v"></i></th>

                            
                            <?php $__currentLoopData = $config; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($data['show_in_table']) && $field !== 'module_name'): ?>
                                    <th class="px-5 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        <?php echo e($field === 'parent_id' || $field === 'destination_id' ? 'Parent' : $data['label']); ?></th>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <th class="px-5 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800" id="sortable-rows">
                        <?php $__empty_1 = true; $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr data-id="<?php echo e($item->id); ?>" class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-5 py-4">
                                    <input type="checkbox" value="<?php echo e($item->id); ?>" x-model="selected"
                                        @change="updateCheckAll()" class="row-check">
                                </td>
                                <td class="px-2 py-4 text-center cursor-grab drag-handle text-gray-300">
                                    <i class="fas fa-grip-vertical"></i>
                                </td>

                                <?php $__currentLoopData = $config; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($data['show_in_table']) && $field !== 'module_name'): ?>
                                        <td class="px-5 py-4">
                                            
                                            <?php if(($data['type'] ?? '') == 'image'): ?>
                                                <?php if($item->imageUrl): ?>
                                                    <div
                                                        class="h-10 w-14 rounded border border-gray-100 overflow-hidden bg-gray-50 shadow-sm">
                                                        <img src="<?php echo e($item->imageUrl); ?>" class="w-full h-full object-cover"
                                                            alt="thumb">
                                                    </div>
                                                <?php else: ?>
                                                    <span class="text-gray-300 text-[10px] italic">No Image</span>
                                                <?php endif; ?>

                                                
                                           <?php elseif(($data['type'] ?? '') == 'image_multiple'): ?>
                                                <?php $gallery = $item->galleryUrls; ?>
                                                <?php if(count($gallery) > 0): ?>
                                                    <div class="flex items-center -space-x-4">
                                                        <?php $__currentLoopData = array_slice($gallery, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <img class="h-8 w-8 rounded-full border-2 border-white object-cover shadow-sm"
                                                                src="<?php echo e($url); ?>">
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(count($gallery) > 3): ?>
                                                            <span
                                                                class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-gray-100 text-[10px] font-bold text-gray-600">+<?php echo e(count($gallery) - 3); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <span class="text-gray-300 text-[10px] italic">No Gallery</span>
                                                <?php endif; ?>

                                                
                                            <?php elseif(($data['type'] ?? '') == 'video'): ?>
                                                <?php if($item->videoUrl): ?>
                                                    <div class="flex items-center gap-1 text-blue-600">
                                                        <i class="fas fa-video text-xs"></i>
                                                        <span class="text-[10px] font-bold">Watch</span>
                                                    </div>
                                                <?php else: ?>
                                                    <span class="text-gray-300 text-[10px] italic">No Video</span>
                                                <?php endif; ?>
                                            <?php elseif($field === 'parent_id'): ?>
                                                <span class="text-sm font-medium text-gray-800 dark:text-white/90">
                                                    <?php echo e($item->parent->title ?? '—'); ?>

                                                </span>
                                            <?php elseif($field === 'destination_id'): ?>
                                                <span class="text-sm font-medium text-gray-800 dark:text-white/90">
                                                    <?php echo e($item->destination->title ?? '—'); ?>

                                                </span>
                                            <?php elseif($field == 'status'): ?>
                                                <button type="button"
                                                    class="status-toggle-btn px-3 py-1 rounded-full text-[10px] font-bold uppercase <?php echo e($item->status == 1 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'); ?>"
                                                    data-id="<?php echo e($item->id); ?>" data-module="<?php echo e($module); ?>">
                                                    <?php echo e($item->status_label); ?>

                                                </button>
                                            <?php elseif($field == 'name'): ?>
                                                <?php if($module === 'coupons'): ?>
                                                    <span
                                                        class="text-sm font-medium text-gray-800 px-2 py-1 rounded"><?php echo e($item->$field); ?>

                                                        times/user</span>
                                                <?php else: ?>
                                                    <div class="flex items-center gap-3">
                                                        <i class="<?php echo e($item->$field); ?> text-blue-600 text-lg"></i>
                                                    </div>
                                                <?php endif; ?>
                                            <?php elseif($field == 'used_count'): ?>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="text-sm font-black text-blue-600"><?php echo e($item->used_count); ?></span>
                                                    <span class="text-[9px] text-gray-400 uppercase">Redeemed</span>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-sm font-medium text-gray-800 dark:text-white/90">
                                                    <?php echo e(Str::limit(strip_tags($item->$field), 40)); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        
                                        <a href="<?php echo e(route('contents.edit', [$module, $item->id])); ?>"
                                            class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all"
                                            title="Edit">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>

                                        
                                        <?php
                                            $isTrashed = $item->status == 3;
                                            $deleteRoute = $isTrashed
                                                ? route('contents.destroy', [$module, $item->id])
                                                : route('contents.trash', [$module, $item->id]);
                                            $deleteFormId = 'delete-form-' . $item->id;
                                        ?>

                                        <?php if($isTrashed): ?>
                                            
                                            <form action="<?php echo e(route('contents.restore', [$module, $item->id])); ?>"
                                                method="POST" class="inline">
                                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                <button type="submit"
                                                    class="p-2 text-gray-400 hover:text-green-600 hover:bg-green-50 rounded-lg"
                                                    title="Restore">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <form id="<?php echo e($deleteFormId); ?>" action="<?php echo e($deleteRoute); ?>" method="POST" class="hidden">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field($isTrashed ? 'DELETE' : 'PATCH'); ?>
                                        </form>
                                        <button type="button"
                                            @click="askConfirm('<?php echo e($deleteFormId); ?>', <?php echo e($isTrashed ? "'Permanently delete this item? This cannot be undone.'" : "'Move this item to trash?'"); ?>)"
                                            class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg"
                                            title="<?php echo e($isTrashed ? 'Permanent Delete' : 'Move to Trash'); ?>">
                                            <i class="fas <?php echo e($isTrashed ? 'fa-minus-circle' : 'fa-trash-alt'); ?>"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="20" class="px-5 py-12 text-center text-gray-400 italic">No records found
                                    for <?php echo e($module); ?>.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4 border-t bg-gray-50/30"><?php echo e($records->links()); ?></div>
        </div>

        
        <div x-show="confirmModal.open" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
            <div @click.outside="confirmModal.open = false"
                class="bg-white rounded-xl shadow-lg w-full max-w-sm p-6 dark:bg-gray-800">
                <h3 class="text-base font-bold text-gray-800 dark:text-white mb-2">Confirm Action</h3>
                <p class="text-sm text-gray-500 mb-6" x-text="confirmModal.message"></p>
                <div class="flex justify-end gap-3">
                    <button @click="confirmModal.open = false"
                        class="px-4 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100">Cancel</button>
                    <button @click="doConfirm()"
                        class="px-4 py-2 text-sm font-bold rounded-lg bg-red-600 text-white hover:bg-red-700">Confirm</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        $(document).ready(function() {
            // AJAX Status Toggle
            $('.status-toggle-btn').on('click', function() {
                const btn = $(this);
                $.ajax({
                    url: `/admin/contents/${btn.data('module')}/${btn.data('id')}/toggle-status`,
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(r) {
                        btn.text(r.status_label).toggleClass(
                            'bg-green-100 text-green-700 bg-gray-100 text-gray-600');
                    }
                });
            });

            // Drag to Reorder
            const sortableEl = document.getElementById('sortable-rows');
            if (sortableEl) {
                new Sortable(sortableEl, {
                    handle: '.drag-handle',
                    animation: 150,
                    onEnd: function() {
                        let order = [];
                        $('#sortable-rows tr').each(function() {
                            order.push($(this).data('id'));
                        });
                        $.post("<?php echo e(route('contents.reorder', $module)); ?>", {
                            _token: '<?php echo e(csrf_token()); ?>',
                            order: order
                        });
                    }
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\affiliate\resources\views/contents/index.blade.php ENDPATH**/ ?>