<?php if($paginator->hasPages()): ?>
    
    <div class="inline-flex items-center bg-white px-8 py-5 rounded-[20px] shadow-[0_10px_30px_rgba(0,0,0,0.05)] border border-gray-50">
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-4">

            
            <?php if($paginator->onFirstPage()): ?>
                <span class="flex items-center gap-2 text-gray-300 cursor-not-allowed font-medium text-base">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i> Back
                </span>
            <?php else: ?>
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="flex items-center gap-2 text-[#2c4294] hover:text-indigo-600 font-medium text-base transition-colors">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i> Back
                </a>
            <?php endif; ?>

            
            <div class="flex items-center gap-2.5 mx-2">
                <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if(is_string($element)): ?>
                        <span class="px-2 text-gray-300 font-bold tracking-widest"><?php echo e($element); ?></span>
                    <?php endif; ?>

                    
                    <?php if(is_array($element)): ?>
                        <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($page == $paginator->currentPage()): ?>
                                
                                <span class="w-10 h-11 flex items-center justify-center bg-[#5c5be5] text-white rounded-[12px] text-base font-bold shadow-md">
                                    <?php echo e($page); ?>

                                </span>
                            <?php else: ?>
                                
                                <a href="<?php echo e($url); ?>" class="w-10 h-11 flex items-center justify-center bg-[#f0f2ff] text-[#2c4294] hover:bg-[#5c5be5] hover:text-white rounded-[12px] text-base font-semibold transition-all duration-300">
                                    <?php echo e($page); ?>

                                </a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <?php if($paginator->hasMorePages()): ?>
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="flex items-center gap-2 text-[#2c4294] hover:text-indigo-600 font-medium text-base transition-colors">
                    Next <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </a>
            <?php else: ?>
                <span class="flex items-center gap-2 text-gray-300 cursor-not-allowed font-medium text-base">
                    Next <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </span>
            <?php endif; ?>
        </nav>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\affiliate\resources\views\frontend\partials\custom_pagination.blade.php ENDPATH**/ ?>