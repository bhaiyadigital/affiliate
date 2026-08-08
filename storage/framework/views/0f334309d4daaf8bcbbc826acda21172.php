<!-- ── Stats Grid (Responsive) ── -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg shadow-sm">
        <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">My Leads</span>
        <div class="text-2xl font-black text-blue-900 mt-1"><?php echo e($leads->where('user_id', auth()->id())->count()); ?></div>
    </div>
    <div class="p-4 bg-purple-50 border border-purple-100 rounded-lg shadow-sm">
        <span class="text-xs font-bold text-purple-600 uppercase tracking-wider">Team Member Leads</span>
        <div class="text-2xl font-black text-purple-900 mt-1"><?php echo e($leads->where('referrer_id', auth()->id())->count()); ?>

        </div>
    </div>
    <div class="p-4 bg-green-50 border border-green-100 rounded-lg shadow-sm sm:col-span-2 lg:col-span-1">
        <span class="text-xs font-bold text-green-600 uppercase tracking-wider">Team Size</span>
        <div class="text-2xl font-black text-green-900 mt-1"><?php echo e(auth()->user()->teamMembers->count()); ?></div>
    </div>
</div>

<!-- ── Filter Form (Responsive) ── -->
<form action="<?php echo e(route('profile.index')); ?>" method="GET" class="mb-6 flex flex-col md:flex-row gap-4 items-end">
    <input type="hidden" name="active_tab" value="leads">

    <!-- Team Member Select -->
    <div class="w-full md:flex-1">
        <label class="text-[10px] font-bold text-gray-600 uppercase block mb-1 ml-1">Team Member</label>
        <select name="member_id"
            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm outline-none focus:ring-2 focus:ring-[#003B7A] bg-white transition-all">
            <option value="">All Members</option>
            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($m->id); ?>" <?php echo e(request('member_id') == $m->id ? 'selected' : ''); ?>><?php echo e($m->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <!-- Status Select -->
    <div class="w-full md:flex-1">
        <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1 ml-1">Status</label>
        <select name="status"
            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm outline-none focus:ring-2 focus:ring-[#003B7A] bg-white transition-all">
            <option value="">All Status</option>
            <?php $__currentLoopData = \App\Models\Lead::statusLabels(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>" <?php echo e(request('status') == $id ? 'selected' : ''); ?>><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <!-- Buttons -->
    <div class="flex gap-2 w-full md:w-auto">
        <button type="submit"
            class="flex-1 md:flex-none bg-[#003B7A] text-white px-6 py-2.5 rounded-lg text-sm font-bold shadow-md hover:bg-blue-900 transition-colors uppercase tracking-wider">
            Filter
        </button>
        <a href="<?php echo e(route('profile.index')); ?>?active_tab=leads"
            class="flex-1 md:flex-none bg-white border border-gray-300 text-gray-600 px-4 py-2.5 rounded-lg text-sm font-bold text-center hover:bg-gray-100 transition-colors uppercase tracking-wider">
            Reset
        </a>
    </div>
</form>


<!-- Leads Table -->
<div class="overflow-hidden border border-gray-100 rounded-sm bg-white ">
    <table class="w-full text-left">
        <thead class="bg-[#003B7A] text-sm font-bold text-white uppercase border-b">
            <tr>
                <th class="px-6 py-4">Customer</th>
                <th class="px-6 py-4">Source</th>
                <th class="px-6 py-4">Referred By</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            <?php $__empty_1 = true; $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50 transition-colors text-base">
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-800"><?php echo e($lead->name); ?></div>
                        <div class="text-sm text-gray-500"><?php echo e($lead->phone); ?> | <?php echo e($lead->interested_location); ?></div>
                    </td>
                    
                    <td class="px-6 py-4">
                        <?php if($lead->type === 'manual'): ?>
                            <span class="text-sm text-gray-500 font-bold flex items-center gap-1.5">
                                <i class="fas fa-hand-pointer text-sm opacity-70"></i> MANUAL
                            </span>
                        <?php else: ?>
                            <span class="text-sm text-indigo-500 font-bold flex items-center gap-1.5">
                                <i class="fas fa-link text-sm opacity-70"></i> LINK
                            </span>
                        <?php endif; ?>
                    </td>

                    
                    <td class="px-6 py-4">
                        <?php if($lead->user_id == auth()->id()): ?>
                            
                            <span
                                class="text-sm font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded border border-blue-100 w-fit uppercase">
                                MY PERSONAL
                            </span>
                        <?php else: ?>
                            
                            <div class="flex items-center gap-2">
                                <img src="<?php echo e($lead->user->avatar_url ?? asset('./images/user/images.png')); ?>"
                                    class="w-6 h-6 rounded-full border border-gray-100 shadow-sm object-cover">
                                <div class="flex flex-col leading-tight">
                                    <span class="text-sm font-bold text-gray-700"><?php echo e($lead->user->name); ?></span>
                                    <span class="text-sm text-gray-500">Team Member</span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php
                            // স্ট্যাটাস অনুযায়ী কালার নির্ধারণ
                            $statusColor = match ($lead->status) {
                                \App\Models\Lead::STATUS_PENDING => 'bg-gray-100 text-gray-600 border-gray-200',   // নতুন/পেন্ডিং (ধূসর)
                                \App\Models\Lead::STATUS_CONTACTED => 'bg-blue-50 text-blue-700 border-blue-100',    // কথা হয়েছে (নীল)
                                \App\Models\Lead::STATUS_VISIT => 'bg-orange-50 text-orange-700 border-orange-100', // ভিজিট করেছে (কমলা)
                                \App\Models\Lead::STATUS_BOOKED => 'bg-purple-50 text-purple-700 border-purple-100', // বুকিং হয়েছে (বেগুনী)
                                \App\Models\Lead::STATUS_COMPLETED => 'bg-green-50 text-green-700 border-green-100', // সম্পন্ন (সবুজ)
                                default => 'bg-gray-50 text-gray-500 border-gray-100',
                            };
                        ?>

                        <span
                            class="<?php echo e($statusColor); ?> px-2 py-1 rounded text-[11px] font-black border uppercase tracking-wider">
                            <?php echo e($lead->status_label); ?>

                        </span>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <button @click="editingLead = <?php echo \Illuminate\Support\Js::from($lead)->toHtml() ?>; leadView = 'form'; viewOnly = true"
                            class="text-emerald-500 hover:scale-110 transition-transform mr-2">
                            <i class="fas fa-eye"></i>
                        </button>
                        <?php if($lead->user_id == auth()->id()): ?>
                            <button @click="editingLead = <?php echo \Illuminate\Support\Js::from($lead)->toHtml() ?>; leadView = 'form'; viewOnly = false"
                                class="text-blue-500 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="<?php echo e(route('lead.destroy', $lead->id)); ?>" method="POST" class="inline"
                                onsubmit="return confirm('Delete?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-500"><i class="fas fa-trash"></i></button>
                            </form>
                        <?php else: ?>
                            <i class="fas fa-lock text-gray-200"></i>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500 italic">No leads found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="mt-4">
    <?php echo $__env->make('partials.pagination', ['items' => $leads], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php /**PATH C:\laragon\www\affiliate-project\resources\views/frontend/lead/list.blade.php ENDPATH**/ ?>