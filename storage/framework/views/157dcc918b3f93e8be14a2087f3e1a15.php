<?php $__env->startSection('meta'); ?>
    <?php echo $__env->make('components.meta-info.add-meta.project-meta', ['setup' => $setup], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
                        <?php if(request('cat')): ?>
                            <?php echo e($categories->where('id', request('cat'))->first()->title ?? ''); ?> Projects
                        <?php elseif(request('dest')): ?>
                            <?php $targetDest = $destinations->where('id', request('dest'))->first(); ?>
                            Projects in <?php echo e($targetDest->title ?? 'Destination'); ?>

                        <?php else: ?>
                            All Projects
                        <?php endif; ?>
                    </h2>

                    <?php if(request('cat') || request('dest')): ?>
                        <a href="<?php echo e(route('affiliated.project')); ?>"
                            class="text-[#2c4294] font-bold hover:underline flex items-center gap-2 transition-all">
                            <i class="fa-solid fa-arrow-left text-sm"></i> Back to all projects
                        </a>
                    <?php endif; ?>
                </div>

                <div id="filter-section"
                    class="<?php echo e(request('cat') || request('dest') ? 'hidden' : 'flex'); ?> overflow-x-auto pb-4">
                    <div class="flex gap-8 md:gap-12 whitespace-nowrap">
                        <a href="<?php echo e(route('affiliated.project')); ?>" aria-label="project route"
                            class="pb-3 font-bold text-sm md:text-base border-b-2 <?php echo e(!request('cat') ? 'border-[#2c4294] text-gray-900' : 'border-transparent text-gray-700'); ?>">
                            All
                        </a>

                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('affiliated.project', ['cat' => $cat->id])); ?>"
                                aria-label="project route for category"
                                class="pb-3 font-bold text-sm md:text-base border-b-2 <?php echo e(request('cat') == $cat->id ? 'border-[#2c4294] text-gray-900' : 'border-transparent text-gray-700 hover:text-gray-900'); ?>">
                                <?php echo e($cat->title); ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
                <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('affiliated.project.details', $project->slug)); ?>" aria-label="View project details"
                        class="bg-white block rounded-4xl overflow-hidden shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 group transition-all duration-300 hover:shadow-xl">
                        <!-- Image Area -->
                        <div class="relative aspect-[16/11] overflow-hidden bg-gray-100">
                            <?php
                                $displayImage = $project->imageUrl ?? ($project->galleryUrls[0] ?? '');
                            ?>

                            <img src="<?php echo e($displayImage); ?>"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                alt="<?php echo e($project->title); ?>" onerror="this.onerror=null;this.src='<?php echo e(''); ?>';" />
                        </div>

                        <!-- Content Area -->
                        <div class="p-8">
                            <span
                                class="inline-block bg-gray-50 text-gray-600 px-3 py-1 rounded text-xs md:text-base border border-gray-200 mb-4">
                                <?php echo e($project->parent->title ?? 'General'); ?>

                            </span>

                            <h3 class="text-lg md:text-xl font-semibold text-gray-900 mb-5 leading-tight truncate">
                                <?php echo e($project->title ?? ''); ?>

                            </h3>

                            <div class="space-y-3">
                                <div class="flex items-center gap-3 text-gray-700 text-sm md:text-base">
                                    <i class="fa-solid fa-location-dot text-[#2c4294]"></i>
                                    <span><?php echo e($project->location ?? ''); ?></span>
                                </div>
                                <div class="flex items-center gap-1 text-gray-700 text-sm md:text-base">
                                    <i class="fa-solid fa-vector-square text-[#2c4294]"></i>
                                    <?php echo $project->name ?? 'ft'; ?>

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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="col-span-full text-center text-gray-600 py-10">No projects found.</p>
                <?php endif; ?>
            </div>

            <div class="mt-16 flex justify-center">
                <?php echo e($projects->appends(request()->query())->links('frontend.partials.custom_pagination')); ?>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\affiliate\resources\views/frontend/landing/projectList.blade.php ENDPATH**/ ?>