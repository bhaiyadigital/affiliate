<div class="max-w-2xl mx-auto bg-[#f8fafc] p-10 rounded-2xl border border-blue-100 shadow-inner">
    <form :action="editingLead.id ? '/leads/' + editingLead.id : '<?php echo e(route('lead.store')); ?>'" method="POST">
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
        <input type="hidden" name="id" x-model="editingLead.id">
        <template x-if="editingLead.id"><input type="hidden" name="_method" value="PUT"></template>
        <input type="hidden" name="type" value="manual">

        <div class="space-y-6">
            <div>
                <label class="text-sm font-bold text-gray-500 uppercase mb-1 block">Customer Name</label>
                <input type="text" name="name" required x-model="editingLead.name" placeholder="Full Name"
                    class="w-full border border-gray-300 px-4 py-3 text-base rounded-xl focus:border-[#003B7A] outline-none bg-white">
            </div>
            <div>
                <label class="text-sm font-bold text-gray-500 uppercase mb-1 block">Phone Number</label>
                <input type="tel" name="phone" required x-model="editingLead.phone" placeholder="01XXXXXXXXX"
                    class="w-full border border-gray-300 px-4 py-3 text-base rounded-xl focus:border-[#003B7A] outline-none bg-white">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-bold text-gray-500 uppercase mb-1 block">Project</label>
                    <select name="interested_location" x-model="editingLead.interested_location"
                        class="w-full border border-gray-300 px-4 py-3 text-base rounded-xl focus:border-[#003B7A] outline-none bg-white">
                        <option value="">Select Project</option>
                        <?php $__currentLoopData = $shared_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($project->title); ?>"><?php echo e($project->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="text-sm font-bold text-gray-500 uppercase mb-1 block">Budget (Optional)</label>
                    <input type="number" name="budget" min="1" x-model="editingLead.budget" placeholder="Budget"
                        class="w-full border border-gray-300 px-4 py-3 text-base rounded-xl focus:border-[#003B7A] outline-none bg-white">
                </div>
            </div>
            <button type="submit" class="w-full bg-[#003B7A] text-white py-4 rounded-2xl font-bold text-base uppercase tracking-widest hover:bg-blue-900 transition-all shadow-lg">
                <span x-text="editingLead.id ? 'Update Changes' : 'Submit Lead Now'"></span>
            </button>
            <button type="button" @click="leadView = 'list'; editingLead = {id:''}" class="text-gray-500 text-sm font-bold uppercase hover:text-red-500 mt-2">
                Cancel
            </button>
        </div>
    </form>
</div>
<?php /**PATH C:\laragon\www\affiliate-project\resources\views/frontend/lead/form.blade.php ENDPATH**/ ?>