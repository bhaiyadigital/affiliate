<?php $__env->startSection('content'); ?>
<div class="p-4 mx-auto max-w-screen-xl md:p-6" x-data="{
        commissionModalOpen: <?php echo e($errors->any() ? 'true' : 'false'); ?>,
        commissionLeadId: <?php echo e(old('commission_lead_id') ?: 'null'); ?>,
        commissionLeadName: <?php echo \Illuminate\Support\Js::from(old('commission_lead_name', ''))->toHtml() ?>,
        commissionAmount: <?php echo \Illuminate\Support\Js::from(old('commission_amount', ''))->toHtml() ?>,
        commissionNote: <?php echo \Illuminate\Support\Js::from(old('commission_note', ''))->toHtml() ?>
    }" @open-commission-modal.window="
        commissionModalOpen = true;
        commissionLeadId = $event.detail.id;
        commissionLeadName = $event.detail.name;
        commissionAmount = $event.detail.amount ?? '';
        commissionNote = $event.detail.note ?? '';
    ">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Lead Management</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Track and manage all customer referrals</p>
        </div>

        
        <form method="GET" action="<?php echo e(route('admin.leads.index')); ?>" class="flex flex-wrap items-center gap-3">
            <div class="relative">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search name or phone..."
                    class="h-10 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none dark:bg-gray-900 dark:border-gray-700 dark:text-white" />
            </div>

            <select name="status"
                class="h-10 rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:outline-none dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                <option value="">All Status</option>
                <?php $__currentLoopData = $statusLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($value); ?>" <?php echo e(request('status') == $value ? 'selected' : ''); ?>>
                    <?php echo e(ucfirst($label)); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select name="type"
                class="h-10 rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:outline-none dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                <option value="">All Types</option>
                <option value="manual" <?php echo e(request('type') == 'manual' ? 'selected' : ''); ?>>Manual Entry</option>
                <option value="refer_link" <?php echo e(request('type') == 'refer_link' ? 'selected' : ''); ?>>Referral Link
                </option>
            </select>
            <div x-data="{ range: '<?php echo e(request('date_range')); ?>' }" class="flex flex-wrap items-center gap-2">
                <select name="date_range" x-model="range"
                    class="h-10 rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:outline-none dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                    <option value="">All Time</option>
                    <option value="today">Today</option>
                    <option value="7_days">Last 7 Days</option>
                    <option value="30_days">Last 30 Days</option>
                    <option value="this_month">This Month</option>
                    <option value="custom">Custom Range</option>
                </select>

                
                <div x-show="range == 'custom'" class="flex items-center gap-2" x-cloak>
                    <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>"
                        class="h-10 rounded-lg border border-gray-300 bg-white px-2 py-1 text-xs dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                    <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>"
                        class="h-10 rounded-lg border border-gray-300 bg-white px-2 py-1 text-xs dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                </div>
            </div>

            <button type="submit"
                class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-700 transition-colors">
                Filter
            </button>

            <?php if(request()->has('search') || request()->has('status')): ?>
            <a href="<?php echo e(route('admin.leads.index')); ?>" class="text-sm text-red-500 hover:underline">Clear</a>
            <?php endif; ?>
        </form>
    </div>

    
    <div
        class="rounded-xl border border-gray-100 bg-white dark:border-gray-800 dark:bg-white/[0.03] overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="bg-gray-50/50 dark:bg-white/[0.02] border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Project /
                            Location</th>
                        <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Referral By</th>
                        <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Source Type</th>
                        <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Budget</th>
                        <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Commission</th>
                        <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <?php $__empty_1 = true; $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.02] transition-colors">
                        
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-900 dark:text-white"><?php echo e($lead->name); ?></span>
                                <span class="text-xs text-gray-500 font-mono"><?php echo e($lead->phone); ?></span>
                            </div>
                        </td>

                        
                        <td class="px-5 py-4">
                            <span
                                class="text-sm text-gray-700 dark:text-gray-300"><?php echo e($lead->interested_location ?? 'N/A'); ?></span>
                        </td>

                        
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center text-[10px] font-bold text-blue-600 uppercase">
                                    <?php echo e(substr($lead->user->name ?? 'A', 0, 2)); ?>

                                </div>
                                <span
                                    class="text-xs font-medium text-gray-600 dark:text-gray-400"><?php echo e($lead->user->name ?? 'Admin'); ?></span>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <?php if($lead->type == 'refer_link'): ?>
                            <span
                                class="flex items-center gap-1 text-purple-600 bg-purple-50 px-2 py-1 rounded-sm text-[10px] font-bold border border-purple-100 w-fit">
                                <i class="fas fa-link"></i> REFER LINK
                            </span>
                            <?php else: ?>
                            <span
                                class="flex items-center gap-1 text-gray-600 bg-gray-50 px-2 py-1 rounded-sm text-[10px] font-bold border border-gray-200 w-fit">
                                <i class="fas fa-hand-pointer"></i> MANUAL
                            </span>
                            <?php endif; ?>
                        </td>
                        
                        <td class="px-5 py-4">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                <?php echo e($lead->budget ? '৳' . number_format($lead->budget) : '—'); ?>

                            </span>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex flex-col">
                                <span
                                    class="text-sm text-gray-700 dark:text-gray-300"><?php echo e($lead->created_at->format('d M, Y')); ?></span>
                                <span class="text-[10px] text-gray-400"><?php echo e($lead->created_at->format('h:i A')); ?></span>
                            </div>
                        </td>
                        
                        <td class="px-5 py-4">
                            <?php
                            $colors = [
                            1 => 'bg-gray-100 text-gray-600', // Pending
                            2 => 'bg-blue-100 text-blue-700', // Contacted
                            3 => 'bg-orange-100 text-orange-700', // Visit
                            4 => 'bg-purple-100 text-purple-700', // Booked
                            5 => 'bg-green-100 text-green-700', // Completed
                            ];
                            $colorClass = $colors[$lead->status] ?? 'bg-gray-100 text-gray-600';
                            ?>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase <?php echo e($colorClass); ?>">
                                <?php echo e($lead->status_label); ?>

                            </span>
                        </td>

                        
                        <td class="px-5 py-4">
                            <?php if($lead->status == 5): ?>
                            <?php if($lead->commission_amount): ?>
                            
                            <div class="flex items-center gap-1">
                                <span class="text-sm font-semibold text-green-600 dark:text-green-400">
                                    ৳<?php echo e(number_format($lead->commission_amount, 2)); ?>

                                </span>
                                <button type="button"
                                    @click="$dispatch('open-commission-modal', {
                                                            id: <?php echo e($lead->id); ?>,
                                                            name: '<?php echo e(addslashes($lead->name)); ?>',
                                                            amount: '<?php echo e($lead->commission_amount); ?>',
                                                            note: '<?php echo e(addslashes($lead->commission_note ?? '')); ?>'
                                                        })"
                                    class="inline-flex items-center justify-center w-6 h-6 rounded-md text-gray-400 hover:bg-blue-50 hover:text-blue-600 dark:hover:bg-blue-900/20 transition-colors"
                                    title="Edit Commission">
                                    <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </button>
                            </div>
                            <?php else: ?>
                            
                            <button type="button"
                                @click="$dispatch('open-commission-modal', {
                                                        id: <?php echo e($lead->id); ?>,
                                                        name: '<?php echo e(addslashes($lead->name)); ?>',
                                                        amount: '',
                                                        note: ''
                                                    })"
                                class="inline-flex items-center gap-1 px-2.5 h-8 rounded-lg text-xs font-semibold text-green-700 bg-green-50 border border-green-200 hover:bg-green-100 dark:bg-green-900/20 dark:text-green-400 dark:border-green-800 transition-colors">
                                <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10 2a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 11-2 0v-6H3a1 1 0 110-2h6V3a1 1 0 011-1z" />
                                </svg>
                                Add Commission
                            </button>
                            <?php endif; ?>
                            <?php else: ?>
                            
                            <span class="text-sm font-semibold text-gray-400 dark:text-gray-500">0</span>
                            <?php endif; ?>
                        </td>

                        
                        <td class="px-5 py-4 whitespace-nowrap text-end text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">

                                
                                <a href="<?php echo e(route('admin.leads.edit', $lead->id)); ?>"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-gray-500 hover:bg-blue-50 hover:text-blue-600 dark:hover:bg-blue-900/20 transition-colors">
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>

                                
                                <button type="button" @click="$dispatch('open-delete-modal', {
                                                url: '<?php echo e(route('admin.leads.destroy', $lead->id)); ?>',
                                                title: 'Lead: <?php echo e(addslashes($lead->name)); ?>'
                                            })"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-gray-500 hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-900/20 transition-colors">
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="px-5 py-12 text-center text-sm text-gray-500 dark:text-gray-400">
                            No leads found matching your criteria.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-800">
            <?php echo $__env->make('partials.pagination', ['items' => $leads], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

    
    <div x-show="commissionModalOpen" x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="display: none;">
        
        <div class="absolute inset-0 bg-black/50" @click="commissionModalOpen = false"></div>

        
        <div class="relative bg-white dark:bg-gray-900 rounded-xl shadow-xl w-full max-w-md p-6"
            x-show="commissionModalOpen"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100">

            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white"
                    x-text="commissionAmount ? 'Edit Commission' : 'Add Commission'"></h3>
                <button type="button" @click="commissionModalOpen = false"
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                    </svg>
                </button>
            </div>

            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                Lead: <span class="font-semibold text-gray-700 dark:text-gray-200" x-text="commissionLeadName"></span>
            </p>

            
            <form method="POST" :action="'/admin/leads/' + commissionLeadId + '/commission'">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="commission_lead_id" :value="commissionLeadId">
                <input type="hidden" name="commission_lead_name" :value="commissionLeadName">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Commission Amount (৳)
                    </label>
                    <input type="number" name="commission_amount" step="0.01" min="0" required
                        x-model="commissionAmount"
                        class="w-full h-10 rounded-lg border <?php echo e($errors->has('commission_amount') ? 'border-red-500' : 'border-gray-300'); ?> bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                        placeholder="Enter amount">
                    <?php $__errorArgs = ['commission_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Note (optional)
                    </label>
                    <textarea name="commission_note" rows="2" x-model="commissionNote"
                        class="w-full rounded-lg border <?php echo e($errors->has('commission_note') ? 'border-red-500' : 'border-gray-300'); ?> bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                        placeholder="Any note..."></textarea>
                    <?php $__errorArgs = ['commission_note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="flex justify-end gap-2 mt-5">
                    <button type="button" @click="commissionModalOpen = false"
                        class="px-4 py-2 rounded-lg text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\affiliate-project\resources\views/leads/index.blade.php ENDPATH**/ ?>