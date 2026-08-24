<?php $__env->startSection('meta'); ?>
    <?php echo $__env->make('components.meta-info.add-meta.index-meta', ['setup' => $setup], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
                <?php
                    $siteSetting = \App\Models\SiteSetting::first();

                ?>
                <div class="pt-0 lg:pt-4">
                    <h1 class="text-2xl lg:text-4xl text-white font-bold leading-tight">
                        Welcome <?php echo e($user->name ?? ''); ?> !
                    </h1>
                    <p class="text-xs lg:text-sm text-white/75 font-bold uppercase tracking-[2px] mt-1">
                        <?php echo e($siteSetting->slogan); ?>

                    </p>
                </div>
            </div>

            <!-- SEARCH BAR — overlapping bottom -->
            <div class="absolute bottom-0 left-0 right-0 px-4 lg:px-6 mb-4 lg:mb-6">
                <form action="<?php echo e(route('home.filter')); ?>" method="GET"
                    class="container mx-auto bg-white border border-gray-200 flex flex-col lg:flex-row items-stretch lg:items-center shadow-lg">

                    <!-- Search Input: border-b (mobile) lg:border-r (desktop) -->
                    <div class="flex-1 flex items-center px-4 border-b lg:border-b-0 lg:border-r border-gray-200">
                        <i class="fas fa-search text-[#3293e3] mr-3"></i>
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search..."
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
                                <?php $__currentLoopData = $concerns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $concern): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($concern->id); ?>"
                                        <?php echo e(request('concern') == $concern->id ? 'selected' : ''); ?>>
                                        <?php echo e($concern->title); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- 2. Project -->
                        <div class="px-5">
                            <label for="project-select" class="sr-only">Filter by Project</label>
                            <select name="project" aria-label="Filter by projetc"
                                class="outline-none text-sm font-medium text-gray-600 bg-transparent cursor-pointer py-4 min-w-[90px]">
                                <option value="">Project</option>
                                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($project->id); ?>"
                                        <?php echo e(request('project') == $project->id ? 'selected' : ''); ?>>
                                        <?php echo e($project->title); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- 3. Asset Type -->
                        <div class="px-5">
                            <label for="type-select" class="sr-only">Filter by Asset Type</label>
                            <select name="type" aria-label="Filter by type"
                                class="outline-none text-sm font-medium text-gray-600 bg-transparent cursor-pointer py-4 min-w-[100px]">
                                <option value="">Asset Type</option>
                                <?php $__currentLoopData = $assetTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($type->id); ?>"
                                        <?php echo e(request('type') == $type->id ? 'selected' : ''); ?>>
                                        <?php echo e($type->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2 lg:gap-4 px-4 py-2 lg:py-3 bg-gray-50 lg:bg-transparent">
                        <button type="submit"
                            class="flex-1 bg-[#0071c5] text-white px-4 lg:px-8 py-2 lg:py-2.5 text-xs lg:text-sm font-bold">
                            Search
                        </button>
                        <a href="<?php echo e(route('home.index')); ?>"
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
            <a href="<?php echo e(route('home.filter', ['section' => 'assets', 'sort' => 'latest'])); ?>">
                <h2 class="text-xl lg:text-3xl text-[#0071c5] underline">
                    Latest Marketing Assets
                </h2>
            </a>

            <a href="<?php echo e(route('home.filter', ['section' => 'assets', 'sort' => 'latest'])); ?>" aria-label="View all assets"
                class="bg-[#00aeef] text-white w-7 h-7 flex items-center justify-center shrink-0">
                <i class="fas fa-arrow-right text-xs"></i>
            </a>

            <a href="<?php echo e(route('home.filter', ['section' => 'assets', 'sort' => 'latest'])); ?>"
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
                    <?php $__currentLoopData = $latestAssets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal895cdfb360c88ca78237e9e20ebefe47 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal895cdfb360c88ca78237e9e20ebefe47 = $attributes; } ?>
<?php $component = App\View\Components\Frontend\AssetCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.asset-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Frontend\AssetCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['asset' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($asset),'swiper' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal895cdfb360c88ca78237e9e20ebefe47)): ?>
<?php $attributes = $__attributesOriginal895cdfb360c88ca78237e9e20ebefe47; ?>
<?php unset($__attributesOriginal895cdfb360c88ca78237e9e20ebefe47); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal895cdfb360c88ca78237e9e20ebefe47)): ?>
<?php $component = $__componentOriginal895cdfb360c88ca78237e9e20ebefe47; ?>
<?php unset($__componentOriginal895cdfb360c88ca78237e9e20ebefe47); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <a href="<?php echo e(route('affiliated.project')); ?>">
                <h2 class="text-xl lg:text-3xl text-[#0071c5] underline">
                    Our Housing Projects
                </h2>
            </a>

            <a href="<?php echo e(route('affiliated.project')); ?>" aria-label="View all projects"
                class="bg-[#00aeef] text-white w-7 h-7 flex items-center justify-center shrink-0">
                <i class="fas fa-arrow-right text-xs"></i>
            </a>

            <a href="<?php echo e(route('affiliated.project')); ?>"
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
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide">
                            <a href="<?php echo e(route('affiliated.project.details', $project->slug)); ?>"
                                class="bg-white block rounded-2xl overflow-hidden shadow-sm border border-gray-100 group transition-all duration-300 hover:shadow-md">

                                <!-- Image Area -->
                                <div class="relative aspect-[16/11] overflow-hidden bg-gray-200">
                                    <?php
                                        $displayImage =
                                            $project->imageUrl ??
                                            ($project->galleryUrls[0] ?? asset('assets/images/placeholder.jpg'));
                                    ?>
                                    <img src="<?php echo e($displayImage); ?>"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                        alt="<?php echo e($project->title); ?>"
                                        onerror="this.onerror=null;this.src='<?php echo e(asset('assets/images/placeholder.jpg')); ?>';" />

                                    <?php if($project->destination): ?>
                                        <div
                                            class="absolute top-3 left-3 bg-[#003b7a]/80 text-white text-[9px] font-bold px-2 py-0.5 rounded-full backdrop-blur-sm">
                                            <i class="fas fa-location-dot mr-1"></i> <?php echo e($project->destination->title); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Content Area -->
                                <div class="p-6">
                                    <span
                                        class="inline-block bg-blue-50 text-[#0071c5] px-2 py-0.5 rounded text-[9px] font-bold uppercase border border-blue-100 mb-3">
                                        <?php echo e($project->parent->title ?? 'Real Estate'); ?>

                                    </span>

                                    <h3
                                        class="text-base font-bold text-gray-900 mb-3 leading-tight group-hover:text-[#0071c5] transition-colors truncate">
                                        <?php echo e($project->title); ?>

                                    </h3>

                                    <div class="flex items-center gap-2 text-gray-500 text-xs mb-4">
                                        <i class="fa-solid fa-location-dot text-[#00aeef]"></i>
                                        <span class="truncate"><?php echo e($project->location ?? 'Location'); ?></span>
                                    </div>

                                    <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                                        <span class="text-[#0071c5] font-bold text-xs">View Details</span>
                                        <i
                                            class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('scripts'); ?>
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
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\affiliate\resources\views/frontend/index.blade.php ENDPATH**/ ?>