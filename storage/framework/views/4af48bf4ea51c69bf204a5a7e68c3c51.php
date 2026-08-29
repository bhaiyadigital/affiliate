<!-- ── Team Members List (Responsive Wrapper) ── -->
<div class="mt-4">

    <!-- ১. Desktop Table View (Hidden on Mobile) -->
    <div class="hidden md:block overflow-hidden border border-gray-100 rounded-xl bg-white shadow-sm">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase border-b">
                <tr>
                    <th class="px-6 py-4">Member Info</th>
                    <th class="px-6 py-4 text-center">Joined Date</th>
                    <th class="px-6 py-4 text-center">Leads Contributed</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php $__empty_1 = true; $__currentLoopData = auth()->user()->teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <!-- প্রোফাইল ইমেজ যোগ করা হয়েছে লুকে সৌন্দর্যের জন্য -->
                                <img src="<?php echo e($member->avatar_url ?? asset('./images/user/images.png')); ?>" class="w-10 h-10 rounded-full border object-cover">
                                <a href="<?php echo e(route('profile.index', ['active_tab' => 'leads', 'member_id' => $member->id])); ?>" class="flex flex-col group">
                                    <span class="font-bold text-gray-700 text-base group-hover:text-[#003B7A] transition-colors leading-tight"><?php echo e($member->name); ?></span>
                                    <span class="text-xs text-gray-500 font-medium">
                                        <?php echo e($member->email); ?> | <?php echo e($member->phone); ?>

                                    </span>
                                </a>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center text-sm text-gray-500">
                            <?php echo e($member->created_at->format('d M, Y')); ?>

                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-black border border-blue-100">
                                <?php echo e(\App\Models\Lead::where('user_id', $member->id)->count()); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button @click="editingMember = <?php echo \Illuminate\Support\Js::from($member)->toHtml() ?>; teamView = 'form'" class="text-blue-500 hover:text-blue-700 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4" class="px-6 py-20 text-center text-gray-400 italic">No members found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- ২. Mobile Card View (Shown only on small screens) -->
    <div class="md:hidden space-y-4">
        <?php $__empty_1 = true; $__currentLoopData = auth()->user()->teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm">
                <div class="flex items-center gap-4 mb-4">
                    <img src="<?php echo e($member->avatar_url ?? asset('./images/user/images.png')); ?>" class="w-12 h-12 rounded-full border object-cover">
                    <div class="flex flex-col">
                        <span class="font-bold text-gray-800 text-base leading-tight"><?php echo e($member->name); ?></span>
                        <span class="text-xs text-gray-500"><?php echo e($member->phone); ?></span>
                    </div>
                    <!-- অ্যাকশন বাটন এখানে মোবাইলের জন্য -->
                    <button @click="editingMember = <?php echo \Illuminate\Support\Js::from($member)->toHtml() ?>; teamView = 'form'" class="ml-auto text-blue-500 p-2">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-3 border-t border-gray-50">
                    <div>
                        <span class="text-[10px] text-gray-400 font-bold uppercase block tracking-widest">Leads</span>
                        <span class="text-sm font-black text-[#003B7A]">
                            <?php echo e(\App\Models\Lead::where('user_id', $member->id)->count()); ?>

                        </span>
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] text-gray-400 font-bold uppercase block tracking-widest">Joined</span>
                        <span class="text-xs text-gray-600 font-medium">
                            <?php echo e($member->created_at->format('d M, Y')); ?>

                        </span>
                    </div>
                </div>

                <!-- ভিউ লিডস লিঙ্ক -->
                <a href="<?php echo e(route('profile.index', ['active_tab' => 'leads', 'member_id' => $member->id])); ?>"
                   class="mt-4 block text-center bg-gray-50 text-gray-600 py-2 rounded-lg text-xs font-bold uppercase tracking-wider border border-gray-100">
                    View Member Leads
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="p-8 text-center text-gray-400 italic bg-white rounded-xl border">No members found.</div>
        <?php endif; ?>
    </div>
      <!-- Pagination -->
    <div class="mt-6">
        <?php echo $__env->make('partials.pagination', ['items' => $leads], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\affiliate\resources\views/frontend/team/list.blade.php ENDPATH**/ ?>