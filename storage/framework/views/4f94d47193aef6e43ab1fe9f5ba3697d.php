<div class="max-w-2xl mx-auto bg-[#f8fafc] p-10 rounded-2xl border border-blue-100 shadow-inner">
     <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-[#003B7A] uppercase"
        x-text="viewOnly ? 'Lead Details' : (editingLead.id ? 'Update Lead Details' : 'Submit New Lead')">
    </h2>
        <p class="text-gray-400 text-xs mt-1">Please provide accurate information about the potential client.</p>
    </div>
    <form :action="editingLead.id ? '<?php echo e(url('leads')); ?>/' + editingLead.id : '<?php echo e(route('lead.store')); ?>'" method="POST">
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
        <template x-if="editingLead.id">
        <input type="hidden" name="_method" value="PUT">
        </template>
        <input type="hidden" name="type" value="manual">

        <div class="space-y-6">
            <div>
                <label class="text-sm font-bold text-gray-500 uppercase mb-1 block">Customer Name</label>
                <input type="text" name="name" :disabled="viewOnly" required x-model="editingLead.name" placeholder="Full Name"
                    class="w-full border border-gray-300 px-4 py-3 text-base rounded-xl focus:border-[#003B7A] outline-none bg-white">
            </div>
            <div>
                <label class="text-sm font-bold text-gray-500 uppercase mb-1 block">Phone Number</label>
                <input type="tel" name="phone" :disabled="viewOnly" x-model="editingLead.phone" placeholder="01XXXXXXXXX"
                    class="w-full border border-gray-300 px-4 py-3 text-base rounded-xl focus:border-[#003B7A] outline-none bg-white">
            </div>
            
            <div>
                <label class="text-sm font-bold text-gray-500 uppercase mb-1 block">Email Address (Optional)</label>
                <input type="email" name="email" :disabled="viewOnly" x-model="editingLead.email" placeholder="customer@example.com"
                    class="w-full border px-4 py-3 text-base rounded-xl outline-none bg-white focus:border-[#003B7A] <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php else: ?> border-gray-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-[10px] font-bold uppercase mt-1"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-bold text-gray-500 uppercase mb-1 block">Project</label>
                    <select name="interested_location" :disabled="viewOnly" x-model="editingLead.interested_location"
                        class="w-full border border-gray-300 px-4 py-3 text-base rounded-xl focus:border-[#003B7A] outline-none bg-white">
                        <option value="">Select Project</option>
                        <?php $__currentLoopData = $shared_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($project->title); ?>"><?php echo e($project->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="text-sm font-bold text-gray-500 uppercase mb-1 block">Budget (Optional)</label>
                    <input type="number" name="budget" :disabled="viewOnly" min="1" x-model="editingLead.budget" placeholder="Budget"
                        class="w-full border border-gray-300 px-4 py-3 text-base rounded-xl focus:border-[#003B7A] outline-none bg-white">
                </div>
            </div>
            <button type="submit" class="w-full bg-[#003B7A] text-white py-4 rounded-2xl font-bold text-base uppercase tracking-widest hover:bg-blue-900 transition-all shadow-lg">
                <span x-text="editingLead.id ? 'Update Changes' : 'Submit Lead Now'"></span>
            </button>
            <div class="text-center">
                <button type="button" @click="leadView = 'list'; editingLead = {id:''}"
                    class="text-gray-600 text-sm font-semibold uppercase hover:text-red-500 transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </form>
</div>
<?php /**PATH C:\laragon\www\affiliate\resources\views/frontend/lead/form.blade.php ENDPATH**/ ?>