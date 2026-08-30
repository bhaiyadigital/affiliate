<div x-show="showCouponModal" x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto"
     style="display: none;">

    <!-- Background Drop / Overlay -->
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"
         @click="showCouponModal = false"
         x-show="showCouponModal"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <!-- Modal Dialog Content -->
    <div class="relative bg-white w-full max-w-xl rounded-2xl shadow-2xl overflow-hidden my-8 z-10"
         x-show="showCouponModal"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-4">

        <!-- Modal Header -->
        <div class="bg-[#003B7A] px-6 py-4 flex justify-between items-center text-white">
            <div>
                <h3 class="font-bold text-lg" x-text="editingCoupon && editingCoupon.id ? 'Edit Coupon' : 'Create New Coupon'"></h3>
                <p class="text-blue-200 text-xs mt-0.5">Configure discount codes to enhance your referral marketing.</p>
            </div>
            <button type="button" @click="showCouponModal = false" class="text-white hover:text-red-300 p-1 transition-colors text-xl leading-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body / Form -->
        <div class="p-6 md:p-8 max-h-[80vh] overflow-y-auto">
            <form :action="editingCoupon && editingCoupon.id ? '<?php echo e(url('/coupons/update')); ?>/' + editingCoupon.id : '<?php echo e(route('coupons.store')); ?>'"
                  method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <?php if($errors->any()): ?>
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                            <h4 class="text-red-800 font-bold text-xs uppercase tracking-widest">ভুলগুলো ঠিক করুন</h4>
                        </div>
                        <ul class="list-disc list-inside text-red-700 text-xs space-y-1 font-medium">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <input type="hidden" name="id" x-model="editingCoupon.id">

                <template x-if="editingCoupon && editingCoupon.id">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                
                <div>
                    <label class="text-xs font-bold text-gray-600 uppercase mb-1 block">Coupon Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" x-model="editingCoupon.title" @input="if(!editingCoupon.id) {
                        editingCoupon.slug = editingCoupon.title.toUpperCase().trim().replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-')
                    }" required placeholder="e.g. Eid Mega Sale"
                        class="w-full border border-gray-300 px-4 py-2.5 text-sm rounded-xl focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A] outline-none">
                </div>

                
                <div>
                    <label class="text-xs font-bold text-gray-600 uppercase mb-1 block">Coupon Code <span class="text-red-500">*</span></label>
                    <input type="text" name="slug" x-model="editingCoupon.slug"
                        @input="editingCoupon.slug = $event.target.value.toUpperCase().replace(/\s+/g, '-')" required
                        placeholder="e.g. SALE30"
                        class="w-full border border-gray-300 px-4 py-2.5 text-sm rounded-xl outline-none font-bold uppercase focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A]">
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase mb-1 block">Start Date <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="start_date" x-model="editingCoupon.start_date" required
                            class="w-full border border-gray-300 px-4 py-2.5 text-sm rounded-xl focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A] outline-none">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase mb-1 block">End Date <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="end_date" x-model="editingCoupon.end_date" required
                            class="w-full border border-gray-300 px-4 py-2.5 text-sm rounded-xl focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A] outline-none">
                    </div>
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase mb-1 block">Limit Per User <span class="text-red-500">*</span></label>
                        <input type="number" name="name" x-model="editingCoupon.name" required min="1"
                            class="w-full border border-gray-300 px-4 py-2.5 text-sm rounded-xl focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A] outline-none">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase mb-1 block">Total Limit <span class="text-red-500">*</span></label>
                        <input type="number" name="views" x-model="editingCoupon.views" required min="1"
                            class="w-full border border-gray-300 px-4 py-2.5 text-sm rounded-xl focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A] outline-none">
                    </div>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" @click="showCouponModal = false"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-xl font-bold text-sm uppercase transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#003B7A] text-white py-3 rounded-xl font-bold text-sm uppercase tracking-wider hover:bg-blue-900 transition-all shadow-md">
                        <span x-text="editingCoupon && editingCoupon.id ? 'Update Coupon' : 'Save Coupon'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\affiliate-project\resources\views/frontend/coupon/form.blade.php ENDPATH**/ ?>