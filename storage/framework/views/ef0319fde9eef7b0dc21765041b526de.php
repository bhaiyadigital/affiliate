<?php $__env->startSection('content'); ?>

<?php
    use App\Models\Lead;

    /*
    |--------------------------------------------------------------------------
    | Lead Dashboard Statistics
    |--------------------------------------------------------------------------
    */

    $totalLeads = Lead::count();

    // Status counts
    $pendingLeads = Lead::where('status', 1)->count();
    $contactedLeads = Lead::where('status', 2)->count();
    $visitLeads = Lead::where('status', 3)->count();
    $bookedLeads = Lead::where('status', 4)->count();
    $completedLeads = Lead::where('status', 5)->count();

    // Source counts
    $manualLeads = Lead::where('type', 'manual')->count();
    $referralLeads = Lead::where('type', 'refer_link')->count();


    
    /*
    |--------------------------------------------------------------------------
    | Chart Data
    |--------------------------------------------------------------------------
    */

    $statusChartLabels = [
        'Pending',
        'Contacted',
        'Visit',
        'Booked',
        'Completed',
    ];

    $statusChartData = [
        $pendingLeads,
        $contactedLeads,
        $visitLeads,
        $bookedLeads,
        $completedLeads,
    ];

    $sourceChartLabels = [
        'Manual Entry',
        'Referral Link',
    ];

    $sourceChartData = [
        $manualLeads,
        $referralLeads,
    ];

    /*
    |--------------------------------------------------------------------------
    | Lead Status Colors
    |--------------------------------------------------------------------------
    */

    $statusColors = [
        1 => [
            'bg' => 'bg-gray-50',
            'icon' => 'bg-gray-100 dark:bg-gray-800',
            'text' => 'text-gray-500',
            'badge' => 'bg-gray-100 text-gray-600',
        ],
        2 => [
            'bg' => 'bg-blue-50',
            'icon' => 'bg-blue-100 dark:bg-blue-900/20',
            'text' => 'text-blue-500',
            'badge' => 'bg-blue-100 text-blue-700',
        ],
        3 => [
            'bg' => 'bg-orange-50',
            'icon' => 'bg-orange-100 dark:bg-orange-900/20',
            'text' => 'text-orange-500',
            'badge' => 'bg-orange-100 text-orange-700',
        ],
        4 => [
            'bg' => 'bg-purple-50',
            'icon' => 'bg-purple-100 dark:bg-purple-900/20',
            'text' => 'text-purple-500',
            'badge' => 'bg-purple-100 text-purple-700',
        ],
        5 => [
            'bg' => 'bg-green-50',
            'icon' => 'bg-green-100 dark:bg-green-900/20',
            'text' => 'text-green-500',
            'badge' => 'bg-green-100 text-green-700',
        ],
    ];
?>


<div class="space-y-6 mx-auto md:p-6 py-4">

    
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between mt-4">

        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white/90">
                Dashboard
            </h1>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Overview of your leads, users and projects
            </p>
        </div>

        <a href="<?php echo e(route('admin.leads.index')); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-gray-800 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-gray-700">

            <svg width="16" height="16" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <line x1="19" y1="8" x2="19" y2="14"/>
                <line x1="22" y1="11" x2="16" y2="11"/>
            </svg>

            Manage Leads
        </a>
    </div>


    
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">

        
        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm
                    dark:border-gray-800 dark:bg-white/[0.03]">

            <div class="flex items-center justify-between">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl
                            bg-indigo-50 dark:bg-indigo-900/20">

                    <svg class="text-indigo-500" width="22" height="22"
                        viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round">

                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>

                <span class="text-xs font-medium text-indigo-500">
                    Leads
                </span>
            </div>

            <div class="mt-5">
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    Total Leads
                </span>

                <h4 class="mt-1 text-2xl font-bold text-gray-800 dark:text-white/90">
                    <?php echo e(number_format($totalLeads)); ?>

                </h4>
            </div>
        </div>


        
        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm
                    dark:border-gray-800 dark:bg-white/[0.03]">

            <div class="flex items-center justify-between">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">

                    <svg class="text-gray-500" width="22" height="22"
                        viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round">

                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 7v5l3 2"/>
                    </svg>
                </div>

                <span class="text-xs font-semibold text-gray-500">
                    Pending
                </span>
            </div>

            <div class="mt-5">
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    Pending Leads
                </span>

                <h4 class="mt-1 text-2xl font-bold text-gray-800 dark:text-white/90">
                    <?php echo e(number_format($pendingLeads)); ?>

                </h4>
            </div>
        </div>


        
        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm
                    dark:border-gray-800 dark:bg-white/[0.03]">

            <div class="flex items-center justify-between">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 dark:bg-blue-900/20">

                    <svg class="text-blue-500" width="22" height="22"
                        viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round">

                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2
                                 19.79 19.79 0 0 1-8.63-3.07
                                 19.5 19.5 0 0 1-6-6
                                 19.79 19.79 0 0 1-3.07-8.67
                                 A2 2 0 0 1 4.11 2h3
                                 a2 2 0 0 1 2 1.72
                                 12.84 12.84 0 0 0 .7 2.81
                                 2 2 0 0 1-.45 2.11L8.09 9.91
                                 a16 16 0 0 0 6 6l1.27-1.27
                                 a2 2 0 0 1 2.11-.45
                                 12.84 12.84 0 0 0 2.81.7
                                 A2 2 0 0 1 22 16.92z"/>
                    </svg>
                </div>

                <span class="text-xs font-semibold text-blue-500">
                    Contacted
                </span>
            </div>

            <div class="mt-5">
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    Contacted Leads
                </span>

                <h4 class="mt-1 text-2xl font-bold text-gray-800 dark:text-white/90">
                    <?php echo e(number_format($contactedLeads)); ?>

                </h4>
            </div>
        </div>


        
        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm
                    dark:border-gray-800 dark:bg-white/[0.03]">

            <div class="flex items-center justify-between">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 dark:bg-orange-900/20">

                    <svg class="text-orange-500" width="22" height="22"
                        viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round">

                        <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>

                <span class="text-xs font-semibold text-orange-500">
                    Visit
                </span>
            </div>

            <div class="mt-5">
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    Visit Leads
                </span>

                <h4 class="mt-1 text-2xl font-bold text-gray-800 dark:text-white/90">
                    <?php echo e(number_format($visitLeads)); ?>

                </h4>
            </div>
        </div>


        
        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm
                    dark:border-gray-800 dark:bg-white/[0.03]">

            <div class="flex items-center justify-between">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-50 dark:bg-purple-900/20">

                    <svg class="text-purple-500" width="22" height="22"
                        viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round">

                        <rect x="3" y="4" width="18" height="17" rx="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                        <path d="M8 15l2 2 5-5"/>
                    </svg>
                </div>

                <span class="text-xs font-semibold text-purple-500">
                    Booked
                </span>
            </div>

            <div class="mt-5">
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    Booked Leads
                </span>

                <h4 class="mt-1 text-2xl font-bold text-gray-800 dark:text-white/90">
                    <?php echo e(number_format($bookedLeads)); ?>

                </h4>
            </div>
        </div>


        
        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm
                    dark:border-gray-800 dark:bg-white/[0.03]">

            <div class="flex items-center justify-between">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50 dark:bg-green-900/20">

                    <svg class="text-green-500" width="22" height="22"
                        viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round">

                        <circle cx="12" cy="12" r="9"/>
                        <path d="M8 12l2.5 2.5L16 9"/>
                    </svg>
                </div>

                <span class="text-xs font-semibold text-green-500">
                    Completed
                </span>
            </div>

            <div class="mt-5">
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    Completed Leads
                </span>

                <h4 class="mt-1 text-2xl font-bold text-gray-800 dark:text-white/90">
                    <?php echo e(number_format($completedLeads)); ?>

                </h4>
            </div>
        </div>

    </div>


    
    <div class="grid grid-cols-3 gap-6 xl:grid-cols-3">

        
        <div class="rounded-xl border border-gray-100 bg-white
                    dark:border-gray-800 dark:bg-white/[0.03]">

            <div class="flex items-center justify-between border-b border-gray-100
                        px-6 py-4 dark:border-gray-800">

                <div>
                    <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">
                        Lead Status
                    </h3>

                    <p class="mt-0.5 text-xs text-gray-400">
                        Distribution by current status
                    </p>
                </div>

                <span class="rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-600">
                    <?php echo e(number_format($totalLeads)); ?> Total
                </span>
            </div>

            <div class="relative p-6">
                <div class="mx-auto h-[280px] max-w-[320px]">
                    <canvas id="leadStatusChart"></canvas>
                </div>
            </div>
        </div>


        
        <div class="rounded-xl border border-gray-100 bg-white
                    dark:border-gray-800 dark:bg-white/[0.03]">

            <div class="flex items-center justify-between border-b border-gray-100
                        px-6 py-4 dark:border-gray-800">

                <div>
                    <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">
                        Lead Sources
                    </h3>

                    <p class="mt-0.5 text-xs text-gray-400">
                        Manual vs referral leads
                    </p>
                </div>

                <span class="rounded-full bg-purple-50 px-2.5 py-1 text-xs font-semibold text-purple-600">
                    <?php echo e(number_format($manualLeads + $referralLeads)); ?> Leads
                </span>
            </div>

            <div class="relative p-6">
                <div class="mx-auto h-[280px] max-w-[320px]">
                    <canvas id="leadSourceChart"></canvas>
                </div>
            </div>
        </div>


        
        <div class="rounded-xl border border-gray-100 bg-white
                    dark:border-gray-800 dark:bg-white/[0.03]">

            <div class="border-b border-gray-100 px-6 py-4 dark:border-gray-800">

                <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Lead Overview
                </h3>

                <p class="mt-0.5 text-xs text-gray-400">
                    Current lead pipeline
                </p>
            </div>

            <div class="p-6 space-y-5">

                
                <div>
                    <div class="mb-2 flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-300">
                            Pending
                        </span>

                        <span class="text-sm font-bold text-gray-800 dark:text-white">
                            <?php echo e($pendingLeads); ?>

                        </span>
                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                        <div
                            class="h-full rounded-full bg-gray-400 transition-all"
                            style="width: <?php echo e($totalLeads > 0 ? ($pendingLeads / $totalLeads) * 100 : 0); ?>%">
                        </div>
                    </div>
                </div>


                
                <div>
                    <div class="mb-2 flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-300">
                            Contacted
                        </span>

                        <span class="text-sm font-bold text-gray-800 dark:text-white">
                            <?php echo e($contactedLeads); ?>

                        </span>
                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                        <div
                            class="h-full rounded-full bg-blue-500 transition-all"
                            style="width: <?php echo e($totalLeads > 0 ? ($contactedLeads / $totalLeads) * 100 : 0); ?>%">
                        </div>
                    </div>
                </div>


                
                <div>
                    <div class="mb-2 flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-300">
                            Visit
                        </span>

                        <span class="text-sm font-bold text-gray-800 dark:text-white">
                            <?php echo e($visitLeads); ?>

                        </span>
                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                        <div
                            class="h-full rounded-full bg-orange-500 transition-all"
                            style="width: <?php echo e($totalLeads > 0 ? ($visitLeads / $totalLeads) * 100 : 0); ?>%">
                        </div>
                    </div>
                </div>


                
                <div>
                    <div class="mb-2 flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-300">
                            Booked
                        </span>

                        <span class="text-sm font-bold text-gray-800 dark:text-white">
                            <?php echo e($bookedLeads); ?>

                        </span>
                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                        <div
                            class="h-full rounded-full bg-purple-500 transition-all"
                            style="width: <?php echo e($totalLeads > 0 ? ($bookedLeads / $totalLeads) * 100 : 0); ?>%">
                        </div>
                    </div>
                </div>


                
                <div>
                    <div class="mb-2 flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-300">
                            Completed
                        </span>

                        <span class="text-sm font-bold text-gray-800 dark:text-white">
                            <?php echo e($completedLeads); ?>

                        </span>
                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                        <div
                            class="h-full rounded-full bg-green-500 transition-all"
                            style="width: <?php echo e($totalLeads > 0 ? ($completedLeads / $totalLeads) * 100 : 0); ?>%">
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


    
    <div class="rounded-xl border border-gray-100 bg-white
                dark:border-gray-800 dark:bg-white/[0.03]">

        <div class="flex flex-col gap-2 border-b border-gray-100 px-6 py-4
                    sm:flex-row sm:items-center sm:justify-between dark:border-gray-800">

            <div>
                <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">
                    Lead Pipeline
                </h3>

                <p class="mt-0.5 text-xs text-gray-400">
                    Number of leads in each stage
                </p>
            </div>

            <a href="<?php echo e(route('admin.leads.index')); ?>"
                class="text-xs font-medium text-blue-500 hover:underline">
                View all leads →
            </a>
        </div>

        <div class="p-6">
            <div class="h-[320px]">
                <canvas id="leadPipelineChart"></canvas>
            </div>
        </div>
    </div>


    
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

        
        <div class="rounded-xl border border-gray-100 bg-white p-5
                    dark:border-gray-800 dark:bg-white/[0.03] md:p-6">

            <div class="flex items-center justify-center w-12 h-12 bg-green-50
                        rounded-xl dark:bg-green-900/20">

                <svg class="text-green-500" width="24" height="24"
                    viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" stroke-linejoin="round">

                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>

            <div class="flex items-end justify-between mt-5">

                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        Users
                    </span>

                    <h4 class="mt-2 font-bold text-gray-800 text-2xl dark:text-white/90">
                        <?php echo e($stats['users']); ?>

                    </h4>
                </div>

                <a href="<?php echo e(route('users.index')); ?>"
                    class="text-xs text-green-500 hover:underline">
                    View all
                </a>
            </div>
        </div>


        
        <div class="rounded-xl border border-gray-100 bg-white p-5
                    dark:border-gray-800 dark:bg-white/[0.03] md:p-6">

            <div class="flex items-center justify-center w-12 h-12 bg-amber-50
                        rounded-xl dark:bg-amber-900/20">

                <svg class="text-amber-500" width="24" height="24"
                    viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" stroke-linejoin="round">

                    <path d="M3 7h18M3 12h18M3 17h18"/>
                    <path d="M8 3l-5 4 5 4"/>
                </svg>
            </div>

            <div class="flex items-end justify-between mt-5">

                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        Projects
                    </span>

                    <h4 class="mt-2 font-bold text-gray-800 text-2xl dark:text-white/90">
                        <?php echo e($stats['projects']); ?>

                    </h4>
                </div>

                <a href="<?php echo e(route('contents.index', ['module' => 'project'])); ?>"
                    class="text-xs text-amber-500 hover:underline">
                    View all
                </a>
            </div>
        </div>

    </div>


    
    <div class="rounded-xl border border-gray-100 bg-white
                dark:border-gray-800 dark:bg-white/[0.03]">

        <div class="flex items-center justify-between px-6 py-4
                    border-b border-gray-200 dark:border-gray-700">

            <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">
                Recent Activity
            </h3>

            <?php if(auth()->check() && auth()->user()->hasPermission('activity_logs.view')): ?>
                <a href="<?php echo e(route('activity-logs.index')); ?>"
                    class="text-xs text-blue-500 hover:underline">
                    View all
                </a>
            <?php endif; ?>
        </div>

        <div class="divide-y divide-gray-100 dark:divide-gray-800">

            <?php $__empty_1 = true; $__currentLoopData = $recentLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <div class="flex items-center gap-4 px-6 py-3.5
                            hover:bg-gray-50/50 dark:hover:bg-white/[0.02]
                            transition-colors">

                    
                    <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0
                        <?php echo e(match($log->action) {
                            'created' => 'bg-green-100 dark:bg-green-900/30',
                            'updated' => 'bg-blue-100 dark:bg-blue-900/30',
                            'deleted' => 'bg-red-100 dark:bg-red-900/30',
                            default   => 'bg-gray-100 dark:bg-gray-800',
                        }); ?>">

                        <svg class="<?php echo e(match($log->action) {
                            'created' => 'text-green-500',
                            'updated' => 'text-blue-500',
                            'deleted' => 'text-red-500',
                            default   => 'text-gray-400',
                        }); ?>"
                            width="14" height="14"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">

                            <?php if($log->action === 'created'): ?>

                                <path d="M12 5v14M5 12h14"/>

                            <?php elseif($log->action === 'updated'): ?>

                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>

                            <?php else: ?>

                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                                <path d="M10 11v6M14 11v6"/>

                            <?php endif; ?>
                        </svg>
                    </div>


                    
                    <?php if($log->user): ?>

                        <img src="<?php echo e($log->user->avatar_url); ?>"
                            alt="<?php echo e($log->user->name); ?>"
                            class="w-7 h-7 rounded-full object-cover shrink-0">

                    <?php endif; ?>


                    
                    <div class="flex-1 min-w-0">

                        <p class="text-sm text-gray-700 dark:text-gray-300 truncate">
                            <?php echo e($log->description); ?>

                        </p>

                        <p class="text-xs text-gray-400 mt-0.5">

                            <?php if($log->user): ?>
                                <?php echo e($log->user->name); ?> ·
                            <?php endif; ?>

                            <?php echo e($log->created_at->diffForHumans()); ?>


                        </p>
                    </div>


                    
                    <span class="inline-flex items-center rounded-md bg-gray-100
                                 px-2 py-0.5 text-xs font-medium text-gray-600
                                 dark:bg-gray-700 dark:text-gray-300 shrink-0">

                        <?php echo e($log->model_type); ?>


                    </span>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <div class="px-6 py-10 text-center">
                    <p class="text-sm text-gray-400">
                        No activity recorded yet.
                    </p>
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | Lead Status Doughnut
    |--------------------------------------------------------------------------
    */

    const statusCanvas = document.getElementById('leadStatusChart');

    if (statusCanvas) {

        new Chart(statusCanvas, {
            type: 'doughnut',

            data: {
                labels: <?php echo json_encode($statusChartLabels, 15, 512) ?>,

                datasets: [{
                    data: <?php echo json_encode($statusChartData, 15, 512) ?>,

                    backgroundColor: [
                        '#9ca3af',
                        '#3b82f6',
                        '#f97316',
                        '#a855f7',
                        '#22c55e'
                    ],

                    borderWidth: 0,

                    hoverOffset: 6
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                cutout: '68%',

                plugins: {

                    legend: {
                        position: 'bottom',

                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 18,
                            font: {
                                size: 11
                            }
                        }
                    },

                    tooltip: {
                        callbacks: {
                            label: function(context) {

                                const value = context.raw;
                                const total = context.dataset.data.reduce(
                                    (a, b) => a + b,
                                    0
                                );

                                const percentage = total > 0
                                    ? ((value / total) * 100).toFixed(1)
                                    : 0;

                                return ` ${value} Leads (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Lead Source Doughnut
    |--------------------------------------------------------------------------
    */

    const sourceCanvas = document.getElementById('leadSourceChart');

    if (sourceCanvas) {

        new Chart(sourceCanvas, {
            type: 'doughnut',

            data: {
                labels: <?php echo json_encode($sourceChartLabels, 15, 512) ?>,

                datasets: [{
                    data: <?php echo json_encode($sourceChartData, 15, 512) ?>,

                    backgroundColor: [
                        '#64748b',
                        '#a855f7'
                    ],

                    borderWidth: 0,

                    hoverOffset: 6
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                cutout: '68%',

                plugins: {

                    legend: {
                        position: 'bottom',

                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 18,
                            font: {
                                size: 11
                            }
                        }
                    },

                    tooltip: {
                        callbacks: {
                            label: function(context) {

                                const value = context.raw;

                                const total = context.dataset.data.reduce(
                                    (a, b) => a + b,
                                    0
                                );

                                const percentage = total > 0
                                    ? ((value / total) * 100).toFixed(1)
                                    : 0;

                                return ` ${value} Leads (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Lead Pipeline Bar Chart
    |--------------------------------------------------------------------------
    */

    const pipelineCanvas = document.getElementById('leadPipelineChart');

    if (pipelineCanvas) {

        new Chart(pipelineCanvas, {

            type: 'bar',

            data: {

                labels: <?php echo json_encode($statusChartLabels, 15, 512) ?>,

                datasets: [{
                    label: 'Leads',

                    data: <?php echo json_encode($statusChartData, 15, 512) ?>,

                    backgroundColor: [
                        '#9ca3af',
                        '#3b82f6',
                        '#f97316',
                        '#a855f7',
                        '#22c55e'
                    ],

                    borderRadius: 8,

                    borderSkipped: false,

                    barThickness: 42,

                    maxBarThickness: 50
                }]
            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                interaction: {
                    intersect: false,
                    mode: 'index'
                },

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {
                            precision: 0,
                            color: '#9ca3af'
                        },

                        grid: {
                            color: 'rgba(156, 163, 175, 0.12)'
                        },

                        border: {
                            display: false
                        }
                    },

                    x: {

                        ticks: {
                            color: '#9ca3af'
                        },

                        grid: {
                            display: false
                        },

                        border: {
                            display: false
                        }
                    }
                },

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {

                        backgroundColor: '#111827',

                        padding: 12,

                        displayColors: true,

                        callbacks: {

                            label: function(context) {
                                return ` ${context.raw} Leads`;
                            }
                        }
                    }
                }
            }
        });
    }

});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\affiliate-project\resources\views/dashboard/dashboard.blade.php ENDPATH**/ ?>