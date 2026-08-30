<?php $__env->startSection('content'); ?>
<div class="p-4 mx-auto max-w-screen-md md:p-6">
    
    <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-6">
        <a href="<?php echo e(route('admin.leads.index')); ?>" class="hover:text-gray-700 dark:hover:text-gray-200 transition-colors">Lead List</a>
        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
            <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" />
        </svg>
        <span class="text-gray-700 dark:text-gray-300 font-medium">Edit Lead</span>
    </nav>

    <div class="rounded-xl border border-gray-100 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <h3 class="text-lg font-semibold dark:text-white mb-6">Edit Lead Information</h3>

        <form action="<?php echo e(route('admin.leads.update', $lead->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Customer Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="<?php echo e(old('name', $lead->name)); ?>" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 dark:border-gray-700 dark:text-white/90 focus:border-blue-500 outline-none" />
                    </div>

                    
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Phone Number <span class="text-red-500">*</span></label>
                        <input type="tel" name="phone" value="<?php echo e(old('phone', $lead->phone)); ?>" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 dark:border-gray-700 dark:text-white/90 focus:border-blue-500 outline-none" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Interested Project</label>
                        <select name="interested_location" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 focus:border-blue-500 outline-none">
                            <option value="">Select Project</option>
                            <?php $__currentLoopData = $shared_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($project->title); ?>" <?php echo e(old('interested_location', $lead->interested_location) == $project->title ? 'selected' : ''); ?>>
                                <?php echo e($project->title); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Budget (BDT)</label>
                        <input type="number" name="budget" value="<?php echo e(old('budget', $lead->budget)); ?>"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 dark:border-gray-700 dark:text-white/90 focus:border-blue-500 outline-none" />
                    </div>
                </div>

                
                <div>
                    <label class="mb-1.5 block text-sm font-bold uppercase text-gray-500">Lead Pipeline Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="h-11 w-full rounded-lg border border-gray-300 bg-white px-4 text-sm font-bold text-blue-600 dark:border-gray-700 dark:bg-gray-900 outline-none focus:ring-2 focus:ring-blue-500/20">
                        <?php $__currentLoopData = $statusLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value); ?>" <?php echo e(old('status', $lead->status) == $value ? 'selected' : ''); ?>>
                            <?php echo e(strtoupper($label)); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <p class="mt-2 text-[11px] text-gray-400 italic">Changing status will update the lead's progress in the sales funnel.</p>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-bold uppercase text-gray-500">
                        Remarks
                    </label>

                    <textarea
                        name="remarks"
                        rows="4"
                        placeholder="Enter remarks..."
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-3 text-sm text-gray-800 dark:border-gray-700 dark:text-white/90 focus:border-blue-500 focus:outline-none"><?php echo e(old('remarks', $lead->remarks)); ?></textarea>

                    <p class="mt-2 text-[11px] text-gray-400 italic">
                        Add any additional notes or remarks about this lead.
                    </p>
                </div>

                
                <div class="flex items-center justify-end gap-3 border-t border-gray-100 dark:border-gray-700 pt-6 mt-4">
                    <a href="<?php echo e(route('admin.leads.index')); ?>" class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 transition-colors">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\affiliate\resources\views\leads\edit.blade.php ENDPATH**/ ?>