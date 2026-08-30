<div x-show="showTeamModal" x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto"
     style="display: none;">

    <!-- Background Drop / Overlay -->
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"
         @click="showTeamModal = false"
         x-show="showTeamModal"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <!-- Modal Dialog Content -->
    <div class="relative bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden my-8 z-10"
         x-show="showTeamModal"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-4">

        <!-- Modal Header -->
        <div class="bg-[#003B7A] px-6 py-4 flex justify-between items-center text-white">
            <div>
                <h3 class="font-bold text-lg" x-text="editingMember && editingMember.id ? 'Edit Team Member' : 'Add New Team Member'"></h3>
                <p class="text-blue-200 text-xs mt-0.5">Provide member details to manage your network account.</p>
            </div>
            <button type="button" @click="showTeamModal = false" class="text-white hover:text-red-300 p-1 transition-colors text-xl leading-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body / Form -->
        <div class="p-6 md:p-8 max-h-[80vh] overflow-y-auto">
            <form :action="editingMember && editingMember.id ? '<?php echo e(url('/team/update')); ?>/' + editingMember.id : '<?php echo e(route('affiliated.register')); ?>'" method="POST">
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
                <input type="hidden" name="id" x-model="editingMember.id">
                <template x-if="editingMember && editingMember.id">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <input type="hidden" name="is_from_leader" value="1">

                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-gray-600 uppercase mb-1 block tracking-wider">Member Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" required x-model="editingMember.name" placeholder="Member Name"
                                class="w-full border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A] outline-none rounded-xl bg-white">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-600 uppercase mb-1 block tracking-wider">Phone Number <span class="text-red-500">*</span></label>
                            <input type="tel" name="phone" required placeholder="01XXXXXXXXX"
                                x-model="editingMember.phone"
                                @input="editingMember.phone = $event.target.value.replace(/[^\d+]/g, '')"
                                class="w-full border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A] outline-none rounded-xl bg-white">
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase mb-1 block tracking-wider">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" required x-model="editingMember.email" placeholder="member@example.com"
                            class="w-full border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A] outline-none rounded-xl bg-white">
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase mb-1 block tracking-wider">
                            <span x-text="editingMember && editingMember.id ? 'New Password (Leave blank to keep same)' : 'Initial Password'"></span>
                            <span x-show="!editingMember || !editingMember.id" class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password" :required="!editingMember || !editingMember.id" placeholder="Minimum 6 characters"
                            class="w-full border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A] outline-none rounded-xl bg-white">
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="button" @click="showTeamModal = false"
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-xl font-bold text-sm uppercase transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            class="flex-1 bg-[#003B7A] text-white py-3 rounded-xl font-bold text-sm uppercase tracking-wider hover:bg-blue-900 transition-all shadow-md">
                            <span x-text="editingMember && editingMember.id ? 'Update Member' : 'Create Member'"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\affiliate\resources\views\frontend\team\form.blade.php ENDPATH**/ ?>