<?php
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
?>

<div class="space-y-6">
    <?php $__currentLoopData = $config; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($field === 'module_name' || in_array($field, $sidebarFields)): ?>
            <?php continue; ?>
        <?php endif; ?>

        <?php
            $type = $options['type'] ?? 'text';
            $label = $options['label'];
            $required = !empty($options['required']) ? 'required' : '';
            $val = old($field, $isEdit ? $content->$field : '');
        ?>

        <div class="mb-4">
            <?php if(in_array($type, ['text', 'slug', 'number', 'url'])): ?>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400"><?php echo e($label); ?>

                    <?php if($required): ?>
                        <span class="text-red-500">*</span>
                    <?php endif; ?>
                </label>
                <input type="<?php echo e($type === 'slug' ? 'text' : $type); ?>" name="<?php echo e($field); ?>" id="<?php echo e($field); ?>"
                    value="<?php echo e($val); ?>"
                    class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-blue-500 outline-none dark:border-gray-700 dark:text-white"
                    <?php echo e($required); ?>>
            <?php elseif(in_array($type, ['date', 'datetime'])): ?>
                <label
                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400"><?php echo e($label); ?></label>
                <input type="<?php echo e($type === 'datetime' ? 'datetime-local' : 'date'); ?>" name="<?php echo e($field); ?>"
                    id="<?php echo e($field); ?>"
                    value="<?php echo e(old($field, $isEdit && $content->$field ? ($content->$field instanceof \Carbon\Carbon ? $content->$field->format($type === 'datetime' ? 'Y-m-d\TH:i' : 'Y-m-d') : $content->$field) : '')); ?>"
                    class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-blue-500 outline-none dark:border-gray-700 dark:text-white">
            <?php elseif($type === 'editor'): ?>
                <div
                    class="mb-8 p-5 border border-gray-200 rounded-2xl bg-white shadow-sm dark:bg-gray-800/40 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row gap-4 mb-4">
                        <div class="flex-1">
                            <label
                                class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-1 block">Title
                                for <?php echo e($label); ?></label>
                            <input type="text" name="body_titles[<?php echo e($field); ?>]"
                                value="<?php echo e(old('body_titles.' . $field, $isEdit ? $content->body_titles[$field] ?? '' : '')); ?>"
                                class="w-full rounded-lg border border-gray-200 bg-gray-50/50 px-3 py-2 text-sm outline-none"
                                placeholder="Enter section heading...">
                        </div>
                        <div class="w-full md:w-40">
                            <label
                                class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Section
                                Status</label>
                            <select name="extra_status_<?php echo e($field); ?>"
                                class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <label class="text-xs font-bold text-gray-600 dark:text-gray-400 block mb-2"><?php echo e($label); ?>

                        Content</label>
                    <textarea class="editor" name="<?php echo e($field); ?>"><?php echo e($val); ?></textarea>
                </div>

                
            <?php elseif($type === 'image'): ?>
                <?php $imageUrl = $isEdit ? $content->image_url : ''; ?>
                <div x-data="{ preview: '<?php echo e($imageUrl); ?>' }">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700"><?php echo e($label); ?></label>
                    <div @click="$refs.<?php echo e($field); ?>Input.click()"
                        class="relative flex flex-col items-center justify-center gap-2 rounded-xl border-2 border-dashed border-gray-300 bg-gray-50/50 p-4 cursor-pointer hover:border-blue-400">
                        <template x-if="preview">
                            <img :src="preview" class="h-48 w-full object-cover rounded-lg shadow-sm">
                        </template>
                        <template x-if="!preview">
                            <div class="text-center py-4">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-300 mb-2"></i>
                                <p class="text-sm text-gray-400">Upload <?php echo e($label); ?></p>
                            </div>
                        </template>
                    </div>
                    <input type="file" x-ref="<?php echo e($field); ?>Input" name="<?php echo e($field); ?>" class="hidden"
                        @change="const file = $event.target.files[0]; if(file){ const reader = new FileReader(); reader.onload = (e) => preview = e.target.result; reader.readAsDataURL(file); }">
                </div>

            <?php elseif($type === 'image_multiple'): ?>
                <?php
                    $existingGallery = $isEdit ? $content->gallery_urls : [];
                ?>
                <div x-data="{
                    galleryImages: <?php echo \Illuminate\Support\Js::from($existingGallery)->toHtml() ?>,
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
                    <label class="mb-2 block text-sm font-bold text-gray-700"><?php echo e($label); ?></label>
                    <div @click="$refs.<?php echo e($field); ?>Input.click()"
                        class="flex flex-col items-center justify-center border-2 border-dashed border-blue-300 bg-blue-50/30 p-4 rounded-xl cursor-pointer">
                        <i class="fas fa-images text-2xl text-blue-400 mb-1"></i>
                        <p class="text-xs text-gray-500">Add multiple images</p>
                        <input type="file" x-ref="<?php echo e($field); ?>Input" name="<?php echo e($field); ?>[]" multiple
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

                
            <?php elseif($type === 'textarea'): ?>
                <label class="mb-1.5 block text-sm font-medium text-gray-700"><?php echo e($label); ?></label>
                <textarea name="<?php echo e($field); ?>" rows="3"
                    class="w-full rounded-lg border border-gray-300 p-3 dark:bg-gray-900"><?php echo e($val); ?></textarea>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php $__env->startSection('form_sidebar'); ?>
    <div class="space-y-4">
        <?php $__currentLoopData = $config; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(in_array($field, $sidebarFields)): ?>
                <?php
                    $type = $options['type'] ?? 'text';
                    $val = old($field, $isEdit ? $content->$field : '');
                ?>

                <div>
                    <label class="mb-1 block text-xs font-bold uppercase text-gray-500"><?php echo e($options['label']); ?></label>

                    <?php if($field === 'status'): ?>
                        <select name="status" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                            <option value="1" <?php echo e($val == 1 ? 'selected' : ''); ?>>Active</option>
                            <option value="0" <?php echo e($val == 0 ? 'selected' : ''); ?>>Inactive</option>
                            <option value="2" <?php echo e($val == 2 ? 'selected' : ''); ?>>Scheduled</option>
                        </select>
                    <?php elseif($type === 'select' || isset($options['options'])): ?>
                        <select name="<?php echo e($field); ?>"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                            <option value="">-- Select --</option>
                            <?php
                                $optName = $options['options'] ?? '';
                                $items = $optName ? $$optName ?? [] : [];
                            ?>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($opt->id); ?>" <?php echo e($val == $opt->id ? 'selected' : ''); ?>>
                                    <?php echo e($opt->title ?? $opt->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    <?php elseif($field === 'meta_description' || $type === 'textarea'): ?>
                        <textarea name="<?php echo e($field); ?>" rows="3" class="w-full rounded border border-gray-300 px-3 py-2 text-xs"><?php echo e($val); ?></textarea>
                    <?php else: ?>
                        <input type="text" name="<?php echo e($field); ?>" value="<?php echo e($val); ?>"
                            class="w-full rounded border border-gray-300 px-3 py-2 text-xs">
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\laragon\www\affiliate-project\resources\views/contents/_form.blade.php ENDPATH**/ ?>