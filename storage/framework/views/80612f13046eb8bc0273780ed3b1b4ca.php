<div class="overflow-hidden border border-gray-100 rounded-xl bg-white shadow-sm">
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-sm font-bold text-gray-500 uppercase border-b">
            <tr>
                <th class="px-6 py-4">Coupon Code</th>
                <th class="px-6 py-4 text-center">Validity (Start - End)</th>
                <th class="px-6 py-4 text-center">Usage (Used/Total)</th>
                <th class="px-6 py-4 text-center">Limit Per User</th>
                <th class="px-6 py-4 text-right">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            <?php
                // শুধুমাত্র বর্তমান ইউজারের তৈরি করা কুপনগুলো আনা হচ্ছে
                $myCoupons = \App\Models\Content::where('module', 'coupons')
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->get();
            ?>
            <?php $__empty_1 = true; $__currentLoopData = $myCoupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50 transition-colors text-base">
                    
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-sm  text-blue-600 font-bold tracking-widest" id="cpn-<?php echo e($coupon->id); ?>">
                                <?php echo e($coupon->slug); ?>

                            </span>
                            <span class="text-sm text-gray-500 mt-0.5"><?php echo e($coupon->title); ?></span>
                        </div>
                    </td>

                    
                    <td class="px-6 py-4 text-center">
                        <div class="flex flex-col items-center">
                            <span class="text-sm text-gray-700 font-medium">
                                <?php echo e($coupon->start_date ? $coupon->start_date->format('d M y') : 'N/A'); ?>

                                <span class="text-gray-500 mx-1">→</span>
                                <?php echo e($coupon->end_date ? $coupon->end_date->format('d M y') : 'N/A'); ?>

                            </span>
                        </div>
                    </td>

                    
                    <td class="px-6 py-4 text-center">
                        <div class="flex flex-col items-center">
                            <span class="text-base font-medium text-[#003B7A]">
                                <?php echo e($coupon->used_count); ?> / <?php echo e($coupon->views == 0 ? '∞' : $coupon->views); ?>

                            </span>
                            <span class="text-sm text-gray-500 uppercase font-medium">Redeemed</span>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-center">
                        <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded text-sm font-bold border border-blue-100">
                            <?php echo e($coupon->name); ?> times
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            
                            <button type="button" onclick="copyCouponToClipboard('cpn-<?php echo e($coupon->id); ?>', this)"
                                class="text-gray-500 hover:text-blue-600 transition-all" title="Copy Code">
                                <i class="fas fa-copy"></i>
                            </button>

                            <button type="button" @click="couponView = 'form'; editingCoupon = <?php echo \Illuminate\Support\Js::from([
                                'id' => $coupon->id,
                                'title' => $coupon->title,
                                'slug' => $coupon->slug,
                                'start_date' => $coupon->start_date ? $coupon->start_date->format('Y-m-d\TH:i') : '',
                                'end_date' => $coupon->end_date ? $coupon->end_date->format('Y-m-d\TH:i') : '',
                                'name' => $coupon->name,
                                'views' => $coupon->views,
                            ])->toHtml() ?>" class="text-gray-500 hover:text-amber-500 transition-all">
                                <i class="fas fa-edit"></i>
                            </button>

                            
                            <form action="<?php echo e(route('coupons.destroy', $coupon->slug)); ?>" method="POST"
                                onsubmit="return confirm('Delete this coupon?')" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-gray-500 hover:text-red-500">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 italic bg-white">
                        আপনার কোনো কুপন কোড নেই। '+ Add New' বাটনে ক্লিক করে নতুন কুপন তৈরি করুন।
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
    function copyCouponToClipboard(elementId, btn) {
        const codeElement = document.getElementById(elementId);
        if (!codeElement) return;

        const textToCopy = codeElement.innerText.trim();

        navigator.clipboard.writeText(textToCopy).then(() => {
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check text-green-500"></i> COPIED!';
            btn.style.color = '#10b981';

            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.style.color = '#003B7A';
            }, 2000);
        }).catch(err => {
            console.error('Copy failed: ', err);
            alert('কপি করা সম্ভব হয়নি। ম্যানুয়ালি কপি করুন।');
        });
    }
</script>
<?php /**PATH C:\laragon\www\affiliate-project\resources\views/frontend/coupon/list.blade.php ENDPATH**/ ?>