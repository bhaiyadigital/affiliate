<div class="max-w-xl mx-auto bg-white p-8">

    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-[#003B7A] uppercase text-center"
            x-text="editingCoupon && editingCoupon.id ? 'Edit Coupon' : 'Create New Coupon'">
        </h2>
        <p class="text-gray-400 text-xs mt-1">Configure discount codes to enhance your referral marketing.</p>
    </div>

    <form
        :action="editingCoupon && editingCoupon.id ? '/coupons/update/' + editingCoupon.id : '<?php echo e(route('coupons.store')); ?>'"
        method="POST" class="space-y-4">
        <?php echo csrf_field(); ?>
        <?php if($errors->any()): ?>
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm animate-hero-text">
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
            <label class="text-sm font-bold text-gray-500 uppercase mb-1.5 block">Coupon Title</label>
            <input type="text" name="title" x-model="editingCoupon.title" @input="if(!editingCoupon.id) {
            editingCoupon.slug = editingCoupon.title.toUpperCase().trim().replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-')
        }" required placeholder="e.g.  Sale"
                class="w-full border border-gray-300 px-4 py-2.5 text-base rounded-lg focus:border-[#003B7A] outline-none">
        </div>

        
        <div>
            <label class="text-sm font-bold text-gray-500 uppercase mb-1.5 block">Coupon Code</label>
            <input type="text" name="slug" x-model="editingCoupon.slug"
                @input="editingCoupon.slug = $event.target.value.toUpperCase().replace(/\s+/g, '-')" required
                placeholder="e.g. SALE30"
                class="w-full border border-gray-300 px-4 py-2.5 text-base rounded-lg outline-none  font-bold uppercase">
        </div>

        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-bold text-gray-500 uppercase mb-1.5 block">Start Date</label>
                <input type="datetime-local" name="start_date" x-model="editingCoupon.start_date" required
                    class="w-full border border-gray-300 px-4 py-2.5 text-base rounded-lg">
            </div>
            <div>
                <label class="text-sm font-bold text-gray-500 uppercase mb-1.5 block">End Date</label>
                <input type="datetime-local" name="end_date" x-model="editingCoupon.end_date" required
                    class="w-full border border-gray-300 px-4 py-2.5 text-base rounded-lg">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-bold text-gray-500 uppercase mb-1.5 block">Limit Per User</label>
                <input type="number" name="name" x-model="editingCoupon.name" required
                    class="w-full border border-gray-300 px-4 py-2.5 text-base rounded-lg focus:border-[#003B7A] outline-none">
            </div>
            <div>
                <label class="text-sm font-bold text-gray-500 uppercase mb-1.5 block">Total Limit</label>
                <input type="number" name="views" x-model="editingCoupon.views" required
                    class="w-full border border-gray-300 px-4 py-2.5 text-base rounded-lg focus:border-[#003B7A] outline-none">
            </div>
        </div>

        <div class="pt-4 flex flex-col gap-3">
            <button type="submit"
                class="w-full bg-[#003B7A] text-white py-3.5 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-blue-900 transition-all">
                <span x-text="editingCoupon && editingCoupon.id ? 'Update Changes' : 'Generate and Save'"></span>
            </button>
            <button type="button"
                @click="couponView = 'list'; editingCoupon = { id: null, title: '', slug: '', start_date: '', end_date: '', name: 1, views: 100 }"
                class="text-gray-500 text-sm font-bold uppercase hover:text-red-500">
                Cancel / Back to List
            </button>
        </div>
    </form>
</div>
<?php /**PATH C:\laragon\www\affiliate\resources\views/frontend/coupon/form.blade.php ENDPATH**/ ?>