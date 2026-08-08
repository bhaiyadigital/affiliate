<?php $__env->startSection('content'); ?>
    <section class="container mx-auto px-4 lg:px-8 py-12" x-data="{
                                                                        activeTab: '<?php echo e(session('active_tab') ?? (
            request('active_tab') ?? (
                $errors->hasAny(['title', 'slug', 'start_date', 'end_date', 'name', 'views']) ? 'coupons' : (
                    $errors->hasAny(['email', 'password']) ? 'team' : (
                        $errors->hasAny(['name', 'phone', 'budget']) ? 'leads' : 'dashboard'
                    )
                )
            )
        )); ?>',

                                                                        leadView: '<?php echo e(session('lead_view') ?? ($errors->hasAny(['name', 'phone', 'budget']) ? 'form' : 'list')); ?>',
                                                                        teamView: '<?php echo e($errors->hasAny(['email', 'password']) ? 'form' : (session('team_view') ?? 'list')); ?>',
                                                                        couponView: '<?php echo e($errors->hasAny(['title', 'slug', 'start_date', 'end_date', 'name', 'views']) ? 'form' :
        (session('coupon_view') ?? 'list')); ?>',

                                                                        editingMember: {
                                                                            id: '<?php echo e(old('id')); ?>',
                                                                            name: '<?php echo e(old('member_name')); ?>',
                                                                            phone: '<?php echo e(old('member_phone')); ?>',
                                                                            email: '<?php echo e(old('email')); ?>'
                                                                        },

                                                                        editingCoupon: {
                                                                            id: '<?php echo e(old('id')); ?>',
                                                                            title: '<?php echo e(old('title')); ?>',
                                                                            slug: '<?php echo e(old('slug')); ?>',
                                                                            start_date: '<?php echo e(old('start_date')); ?>',
                                                                            end_date: '<?php echo e(old('end_date')); ?>',
                                                                            name: '<?php echo e(old('usage_limit', 1)); ?>',
                                                                            views: '<?php echo e(old('total_limit', 100)); ?>'
                                                                        },

                                                                        editingLead: {
                                                                            id: '<?php echo e(old('id')); ?>',
                                                                            name: '<?php echo e(old('name')); ?>',
                                                                            email: '<?php echo e(old('email')); ?>',
                                                                            phone: '<?php echo e(old('phone')); ?>',
                                                                            interested_location: '<?php echo e(old('interested_location')); ?>',
                                                                            budget: '<?php echo e(old('budget')); ?>',
                                                                            },
                                                                            accountDrawer: false,
                                                                            viewOnly: false,
                                                                    }">

        <div class="mb-10 flex items-center gap-4">

            <div>
                <h1 class="text-[#003B7A] text-4xl font-light">My Account</h1>
                <p class="text-gray-500 mt-2 text-base">Manage your profile and activity from one place.</p>
            </div>
            <!-- মোবাইলের জন্য বাম পাশের ড্রয়ার আইকন -->
            <button @click="accountDrawer = true" class="lg:hidden text-[#003B7A] p-2   active:bg-gray-50">
                <i class="fa-solid fa-bars-staggered text-xl"></i>
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- ── LEFT SIDEBAR ── -->
            <div class="lg:col-span-3 hidden lg:block">
                <div class="bg-white border border-gray-200 rounded-sm shadow-sm overflow-hidden sticky top-24">
                    <div class="p-4 bg-gray-50 border-b border-gray-100 font-bold text-sm uppercase text-gray-600">
                        Account Settings
                    </div>
                    <nav class="flex flex-col">

                        <!-- Profile Tab Button -->
                        <button @click="activeTab = 'dashboard'"
                            :class="activeTab === 'dashboard' ? 'bg-[#003B7A] text-white' : 'text-gray-700 hover:bg-gray-50'"
                            class="flex items-center gap-3 px-4 py-3 transition-all border-b border-gray-50 text-left">
                            <i class="fa-solid fa-chart-column w-5"></i>
                            <span class="text-base font-medium">Dashboard</span>
                        </button>
                        <!-- Profile Tab Button -->
                        <button @click="activeTab = 'profile'"
                            :class="activeTab === 'profile' ? 'bg-[#003B7A] text-white' : 'text-gray-700 hover:bg-gray-50'"
                            class="flex items-center gap-3 px-4 py-3 transition-all border-b border-gray-50 text-left">
                            <i class="fas fa-user-circle w-5"></i>
                            <span class="text-base font-medium">Personal Info</span>
                        </button>

                        <button @click="activeTab = 'leads'"
                            :class="activeTab === 'leads' ? 'bg-[#003B7A] text-white' : 'text-gray-700 hover:bg-gray-50'"
                            class="flex items-center gap-3 px-4 py-3 transition-all border-b border-gray-50 text-left">
                            <i class="fa-solid fa-users-rectangle w-5"></i>
                            <span class="text-base font-medium">My Leads</span>
                        </button>
                        <button @click="activeTab = 'team'"
                            :class="activeTab === 'team' ? 'bg-[#003B7A] text-white' : 'text-gray-700 hover:bg-gray-50'"
                            class="flex items-center gap-3 px-4 py-3 transition-all border-b border-gray-50 text-left">
                            <i class="fa-solid fa-arrows-down-to-people w-5"></i>
                            <span class="text-base font-medium">Team</span>
                        </button>
                        <!-- My Coupons Tab Button -->
                        <button @click="activeTab = 'coupons'"
                            :class="activeTab === 'coupons' ? 'bg-[#003B7A] text-white' : 'text-gray-700 hover:bg-gray-50'"
                            class="flex items-center gap-3 px-4 py-3 transition-all border-b border-gray-50 text-left">
                            <i class="fa-solid fa-ticket-simple w-5"></i>
                            <span class="text-base font-medium">Available Coupons</span>
                        </button>

                        <a href="<?php echo e(route('portal.redirect')); ?>" target="_blank"
                            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-all border-b border-gray-50">
                            <i class="fa-brands fa-artstation w-5"></i>
                            <span class="text-base font-medium">Marketing Assets</span>
                        </a>

                        </a><a href="<?php echo e(route('landing.index')); ?>"
                            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-all border-b border-gray-50">
                            <i class="fa-brands fa-affiliatetheme w-5"></i>
                            <span class="text-base font-medium">Home</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- ── RIGHT CONTENT ── -->
            <div class="lg:col-span-9  min-h-[500px]">

                <div x-show="activeTab === 'dashboard'" class="" x-transition>
                    <!-- ── HEADER ── -->
                    <div class="mb-4 flex items-center justify-between border-b pb-4">
                        <div>
                            <h2 class="text-xl font-bold text-[#003B7A] uppercase tracking-wider">Performance Analytics</h2>
                            <p class="text-sm text-gray-500 mt-1">Real-time statistics from your lead database.</p>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-bold text-gray-500 uppercase block">Last Updated</span>
                            <span class="text-base font-bold text-[#003B7A]"><?php echo e(now()->format('d M, Y')); ?></span>
                        </div>
                    </div>

                    <!-- ── ১. মেইন ম্যাট্রিক্স (Top Cards) ── -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                        <!-- Total Network Leads (Personal + Team) -->
                        <div class="p-4 bg-white border border-gray-100 shadow-sm rounded-xl border-t-4 border-t-blue-600">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="text-sm font-bold text-gray-500 uppercase">Total Network Leads</span>
                                    <div class="text-3xl font-black text-gray-800 mt-1"><?php echo e($leads->count()); ?></div>
                                </div>
                                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Team Size (সরাসরি User Relation থেকে কাউন্ট) -->
                        <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl border-t-purple-600">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="text-sm font-bold text-gray-500 uppercase">Direct Team Members</span>
                                    <div class="text-3xl font-black text-gray-800 mt-1">
                                        <?php echo e(auth()->user()->teamMembers->count()); ?> 
                                    </div>
                                </div>
                                <div
                                    class="w-10 h-10 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Successful Conversions -->
                        <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl border-t-4 border-t-green-600">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="text-sm font-bold text-gray-500 uppercase">Completed Sales</span>
                                    <div class="text-3xl font-black text-gray-800 mt-1">
                                        <?php echo e($leads->where('status', \App\Models\Lead::STATUS_COMPLETED)->count()); ?>

                                    </div>
                                </div>
                                <div
                                    class="w-10 h-10 bg-green-50 text-green-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-trophy"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ── ২. পাইপলাইন এবং সামারি ── -->
                    <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-sm">
                        <h3 class="text-base font-bold text-gray-700 uppercase mb-4 flex items-center gap-2">
                            <i class="fas fa-filter text-blue-500"></i> Lead Pipeline Distribution
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                            <!-- Left: Progress Bars -->
                            <div class="space-y-6">
                                <?php
                                    $totalLeads = $leads->count() ?: 1;
                                    $statusSettings = [
                                        \App\Models\Lead::STATUS_PENDING => ['color' => 'bg-gray-300', 'label' => 'New / Pending'],
                                        \App\Models\Lead::STATUS_CONTACTED => ['color' => 'bg-blue-400', 'label' => 'Contacted'],
                                        \App\Models\Lead::STATUS_VISIT => ['color' => 'bg-orange-400', 'label' => 'Site Visit'],
                                        \App\Models\Lead::STATUS_BOOKED => ['color' => 'bg-purple-500', 'label' => 'Booked'],
                                        \App\Models\Lead::STATUS_COMPLETED => ['color' => 'bg-green-600', 'label' => 'Final Complete'],
                                    ];
                                ?>

                                <?php $__currentLoopData = $statusSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statusId => $config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $count = $leads->where('status', $statusId)->count();
                                        $percent = ($count / $totalLeads) * 100;
                                    ?>
                                    <div>
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm font-bold text-gray-600"><?php echo e($config['label']); ?></span>
                                            <span class="text-sm font-black text-gray-800"><?php echo e($count); ?>

                                                (<?php echo e(round($percent)); ?>%)</span>
                                        </div>
                                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-full <?php echo e($config['color']); ?> transition-all duration-1000 shadow-sm"
                                                style="width: <?php echo e($percent); ?>%"></div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <!-- Right: Summary Box -->
                            <div class="bg-gray-50 rounded-xl p-8 border border-gray-100 flex flex-col justify-center">
                                <div class="space-y-5">
                                    <div class="flex justify-between items-center">
                                        <span class="text-base text-gray-500 font-medium">Your Personal Submissions</span>
                                        <span
                                            class="text-base font-black text-blue-600"><?php echo e($leads->where('user_id', auth()->id())->count()); ?></span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-base text-gray-500 font-medium">Leads from Your Team</span>
                                        <span
                                            class="text-base font-black text-purple-600"><?php echo e($leads->where('user_id', '!=', auth()->id())->count()); ?></span>
                                    </div>
                                    <div class="pt-4 border-t border-gray-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-base font-bold text-gray-700 uppercase">Overall Impact</span>
                                            <span class="text-2xl font-black text-[#003B7A]"><?php echo e($leads->count()); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ── ৩. টিম পারফরম্যান্স টেবিল (Responsive Version) ── -->
                    <div class="mt-4 bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
                        <!-- Header -->
                        <div class="p-4 md:p-6 border-b border-gray-50 bg-gray-50/50">
                            <h3 class="text-sm md:text-base font-bold text-gray-700 uppercase flex items-center gap-2">
                                <i class="fas fa-users text-purple-500"></i> Team Performance Breakdown
                            </h3>
                        </div>

                        <!-- Desktop Table View (Hidden on Mobile) -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="text-xs uppercase text-gray-500 font-bold border-b border-gray-100 bg-white">
                                        <th class="px-6 py-4">Member Name</th>
                                        <th class="px-6 py-4 text-center">Total Leads</th>
                                        <th class="px-6 py-4 text-center">Completed</th>
                                        <th class="px-6 py-4 text-right">Success Rate</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    <?php $__empty_1 = true; $__currentLoopData = auth()->user()->teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php
                                            $memberLeads = $leads->where('user_id', $member->id);
                                            $total = $memberLeads->count();
                                            $completed = $memberLeads->where('status', \App\Models\Lead::STATUS_COMPLETED)->count();
                                            $successRate = $total > 0 ? round(($completed / $total) * 100) : 0;
                                        ?>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <img src="<?php echo e($member->avatar_url ?? asset('./images/user/images.png')); ?>"
                                                        class="w-10 h-10 rounded-full border shadow-sm object-cover">
                                                    <div class="flex flex-col">
                                                        <span class="text-sm font-bold text-gray-800"><?php echo e($member->name); ?></span>
                                                        <span class="text-xs text-gray-500"><?php echo e($member->phone); ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center font-bold text-gray-700"><?php echo e($total); ?></td>
                                            <td class="px-6 py-4 text-center">
                                                <span
                                                    class="px-2.5 py-0.5 rounded-full bg-green-50 text-green-600 text-xs font-bold border border-green-100"><?php echo e($completed); ?></span>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex flex-col items-end">
                                                    <span class="text-xs font-bold text-gray-700"><?php echo e($successRate); ?>%</span>
                                                    <div class="w-16 h-1.5 bg-gray-100 rounded-full mt-1 overflow-hidden">
                                                        <div class="h-full bg-blue-600" style="width: <?php echo e($successRate); ?>%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">No team member
                                                data available.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View (Hidden on Desktop) -->
                        <div class="md:hidden divide-y divide-gray-100">
                            <?php $__empty_1 = true; $__currentLoopData = auth()->user()->teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $memberLeads = $leads->where('user_id', $member->id);
                                    $total = $memberLeads->count();
                                    $completed = $memberLeads->where('status', \App\Models\Lead::STATUS_COMPLETED)->count();
                                    $successRate = $total > 0 ? round(($completed / $total) * 100) : 0;
                                ?>
                                <div class="p-4 space-y-4">
                                    <!-- Profile Part -->
                                    <div class="flex items-center gap-3">
                                        <img src="<?php echo e($member->avatar_url ?? asset('./images/user/images.png')); ?>"
                                            class="w-12 h-12 rounded-full border shadow-sm object-cover">
                                        <div class="flex flex-col">
                                            <span class="text-base font-bold text-gray-800"><?php echo e($member->name); ?></span>
                                            <span class="text-sm text-gray-500"><?php echo e($member->phone); ?></span>
                                        </div>
                                    </div>

                                    <!-- Stats Part -->
                                    <div class="grid grid-cols-3 gap-2 bg-gray-50 p-3 rounded-xl border border-gray-100">
                                        <div class="text-center">
                                            <span
                                                class="block text-[10px] uppercase font-bold text-gray-400 tracking-tight">Total</span>
                                            <span class="text-base font-black text-gray-700"><?php echo e($total); ?></span>
                                        </div>
                                        <div class="text-center border-x border-gray-200">
                                            <span
                                                class="block text-[10px] uppercase font-bold text-gray-400 tracking-tight">Done</span>
                                            <span class="text-base font-black text-green-600"><?php echo e($completed); ?></span>
                                        </div>
                                        <div class="text-center">
                                            <span
                                                class="block text-[10px] uppercase font-bold text-gray-400 tracking-tight">Success</span>
                                            <span class="text-base font-black text-blue-600"><?php echo e($successRate); ?>%</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="p-8 text-center text-gray-400 italic text-sm">
                                    No team member data available.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div x-show="activeTab === 'profile'" class="" x-transition>
                    <h2 class="text-xl font-bold text-gray-800 mb-6 uppercase border-b pb-2">Profile Settings</h2>

                    <?php if(session('success')): ?>
                        <div
                            style="background: rgba(143, 224, 166, 0.2); border: 1px solid #10b981; color: #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; font-weight: 600;">
                            <i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div
                            style="background: rgba(255, 132, 132, 0.15); border: 1px solid #ff8484; color: #ff8484; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                            <ul class="list-disc list-inside">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data"
                        class="max-w-xl">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-8 flex items-center gap-6">
                            <div class="relative group">
                                <img id="avatarPreview"
                                    src="<?php echo e(Auth::user()->avatar_url ?? asset('./images/user/images.png')); ?>"
                                    class="w-24 h-24 rounded-full object-cover border-4 border-gray-100 shadow-sm">
                                <label for="avatarInput"
                                    class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity">
                                    <i class="fa-solid fa-camera text-white"></i>
                                </label>
                                <input type="file" name="avatar" id="avatarInput" class="hidden"
                                    onchange="previewAvatar(this)">
                            </div>
                            <div>
                                <h4 class="text-base font-bold text-gray-700">Profile Picture</h4>
                                <p class="text-sm text-gray-500">JPG, PNG or GIF. Max 2MB</p>
                            </div>
                        </div>

                        <!-- Name & Phone -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-500 uppercase mb-2">Full Name</label>
                                <input type="text" name="name" value="<?php echo e(Auth::user()->name); ?>"
                                    class="w-full border border-gray-300 px-4 py-2 text-base outline-none focus:border-[#003B7A]">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-500 uppercase mb-2">Phone</label>
                                <input type="text" name="phone" value="<?php echo e(Auth::user()->phone); ?>"
                                    class="w-full border border-gray-300 px-4 py-2 text-base outline-none focus:border-[#003B7A]">
                            </div>
                        </div>

                        <hr class="my-8 border-gray-100">

                        <h4 class="text-sm font-bold text-[#003B7A] uppercase mb-4 tracking-widest">Change Password</h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Current Password</label>
                                <input type="password" name="current_password"
                                    class="w-full border border-gray-300 px-4 py-2 text-base outline-none focus:border-[#003B7A]">
                                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">New Password</label>
                                    <input type="password" name="new_password"
                                        class="w-full border border-gray-300 px-4 py-2 text-base outline-none focus:border-[#003B7A]">
                                    <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Confirm New
                                        Password</label>
                                    <input type="password" name="new_password_confirmation"
                                        class="w-full border border-gray-300 px-4 py-2 text-base outline-none focus:border-[#003B7A]">
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="mt-8 bg-[#003B7A] text-white px-8 py-3 font-bold uppercase text-sm tracking-widest hover:bg-blue-900 transition-all">
                            Update Profile
                        </button>
                    </form>
                </div>

                <!-- Section 2: Download History (Show if activeTab is 'history') -->
                <div x-show="activeTab === 'history'" class="p-0" x-transition style="display: none;">
                    <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <h2 class="text-lg font-bold text-gray-800 uppercase">Download History</h2>
                        <span
                            class="bg-blue-100 text-blue-800 text-sm font-black px-2 py-1 rounded"><?php echo e($downloadLogs->count()); ?>

                            Files</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-sm uppercase text-gray-600 font-bold border-b border-gray-100 bg-gray-50">
                                    <th class="px-6 py-4">Resource</th>
                                    <th class="px-6 py-4">Type</th>
                                    <th class="px-6 py-4 text-right">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <?php $__empty_1 = true; $__currentLoopData = $downloadLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $item =
                                            $log->model === 'asset'
                                            ? \App\Models\Asset::find($log->model_id)
                                            : \App\Models\Campaign::find($log->model_id);
                                    ?>
                                    <tr class="hover:bg-gray-50 transition-colors text-base">
                                        <td class="px-6 py-4">
                                            <?php if($item): ?>
                                                <a href="<?php echo e(route($log->model . '.details', $item->slug)); ?>"
                                                    class="text-base font-semibold text-[#003B7A] hover:underline">
                                                    <?php echo e($item->title); ?>

                                                </a>
                                            <?php else: ?>
                                                <span class="text-gray-500 italic">Resource deleted (ID:
                                                    <?php echo e($log->model_id); ?>)</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="text-sm font-bold uppercase px-2 py-0.5 rounded <?php echo e($log->model === 'asset' ? 'bg-blue-100 text-blue-800' : 'bg-teal-100 text-teal-800'); ?>">
                                                <?php echo e($log->model); ?>

                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm text-gray-600">
                                            <?php echo e($log->updated_at->format('d M Y')); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center text-gray-500 italic">No history
                                            found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Section 3: My Leads -->
                <div x-show="activeTab === 'leads'" x-transition style="display: none;">

                    <div class="flex justify-between items-center mb-4">
                        <h2 x-show="leadView === 'list'"
                            class="text-xl font-bold text-[#003B7A] uppercase tracking-wider pb-4">
                            Lead Management
                        </h2>

                        <button x-show="leadView === 'list'" @click="leadView = 'form'; editingLead = {id:''}"
                            class="bg-[#003B7A] text-white px-5 py-2 rounded-lg text-sm font-bold shadow-md ml-auto">
                            + Add New Lead
                        </button>
                    </div>
                    <div class="mb-6" x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                        x-transition.duration.500ms>
                        <?php if(session('success')): ?>
                            <div
                                class="mb-4 bg-green-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
                                <span><i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?></span>
                                <button @click="show = false"><i class="fas fa-times"></i></button>
                            </div>
                        <?php endif; ?>
                        <?php if(session('error')): ?>
                            <div
                                class="mb-4 bg-red-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
                                <span><i class="fas fa-times-circle mr-2"></i> <?php echo e(session('error')); ?></span>
                                <button @click="show = false"><i class="fas fa-times"></i></button>
                            </div>
                        <?php endif; ?>
                    </div>

                    
                    <div x-show="leadView === 'list'" x-transition>
                        <?php echo $__env->make('frontend.lead.list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>


                    
                    <div x-show="leadView === 'form'" x-transition style="display: none;">
                        <?php echo $__env->make('frontend.lead.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
                <!-- Section: My Team -->
                <div x-show="activeTab === 'team'" x-transition style="display: none;">

                    <!-- ── টিম হেডার এবং টগল বাটন ── -->
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h2 x-show="teamView === 'list'"
                                class="text-xl font-bold text-[#003B7A] uppercase tracking-wider">
                                Team Management
                            </h2>
                        </div>

                        <button x-show="teamView === 'list'"
                            @click="teamView = 'form'; editingMember = {id:null, name:'', phone:'', email:''}"
                            class="bg-[#003B7A] text-white px-5 py-2 rounded-lg text-sm font-bold shadow-md ml-auto">
                            + Add New Member
                        </button>
                    </div>

                    <div class="mb-6" x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                        x-transition.duration.500ms>
                        <?php if(session('success')): ?>
                            <div
                                class="mb-4 bg-green-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
                                <span><i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?></span>
                                <button @click="show = false"><i class="fas fa-times"></i></button>
                            </div>
                        <?php endif; ?>
                        <?php if(session('error')): ?>
                            <div
                                class="mb-4 bg-red-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
                                <span><i class="fas fa-times-circle mr-2"></i> <?php echo e(session('error')); ?></span>
                                <button @click="show = false"><i class="fas fa-times"></i></button>
                            </div>
                        <?php endif; ?>
                    </div>

                    
                    <div x-show="teamView === 'list'" x-transition>
                        <?php echo $__env->make('frontend.team.list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>

                    
                    <div x-show="teamView === 'form'" x-transition style="display: none;">
                        <?php echo $__env->make('frontend.team.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
                <!-- Section: My Coupons -->
                <div x-show="activeTab === 'coupons'" x-transition>
                    <div class="flex justify-between items-center pb-4">
                        <h2 x-show="couponView === 'list'"
                            class="text-xl font-bold text-[#003B7A] uppercase tracking-wider">
                            My Coupons
                        </h2>

                        <button x-show="couponView === 'list'"
                            @click="couponView = 'form'; editingCoupon = { id: null, title: '', slug: '', start_date: '', end_date: '', name: 1, views: 100 }"
                            class="bg-[#003B7A] text-white px-5 py-2 rounded-lg text-sm font-bold shadow-md ml-auto">
                            + Add New Coupon
                        </button>
                    </div>
                    <div class="mb-6" x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                        x-transition.duration.500ms>
                        <?php if(session('success')): ?>
                            <div
                                class="mb-4 bg-green-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
                                <span><i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?></span>
                                <button @click="show = false"><i class="fas fa-times"></i></button>
                            </div>
                        <?php endif; ?>
                        <?php if(session('error')): ?>
                            <div
                                class="mb-4 bg-red-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
                                <span><i class="fas fa-times-circle mr-2"></i> <?php echo e(session('error')); ?></span>
                                <button @click="show = false"><i class="fas fa-times"></i></button>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div x-show="couponView === 'list'">
                        <?php echo $__env->make('frontend.coupon.list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                    <div x-show="couponView === 'form'" style="display: none;">
                        <?php echo $__env->make('frontend.coupon.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>
            <!-- ── ACCOUNT MOBILE LEFT DRAWER ── -->
            <div x-show="accountDrawer" class="fixed inset-0 z-[100] lg:hidden" style="display: none;">
                <!-- Overlay -->
                <div x-show="accountDrawer" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" @click="accountDrawer = false"
                    class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

                <!-- Drawer Content -->
                <div x-show="accountDrawer" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="-translate-x-full"
                    class="absolute left-0 top-0 h-full w-[280px] bg-white shadow-2xl flex flex-col border-r border-gray-100">

                    <div class="p-5 border-b flex justify-between items-center bg-gray-50">
                        <span class="font-bold text-[#003B7A] uppercase text-xs tracking-widest">Account Menu</span>
                        <button @click="accountDrawer = false"
                            class="text-gray-400 hover:text-red-500 text-2xl leading-none">&times;</button>
                    </div>

                    <nav class="flex flex-col overflow-y-auto pt-2">
                        <template x-for="item in [
                                    { id: 'dashboard', label: 'Dashboard', icon: 'fa-chart-column' },
                                    { id: 'profile', label: 'Personal Info', icon: 'fa-user-circle' },
                                    { id: 'leads', label: 'My Leads', icon: 'fa-users-rectangle' },
                                    { id: 'team', label: 'Team', icon: 'fa-arrows-down-to-people' },
                                    { id: 'coupons', label: 'Available Coupons', icon: 'fa-ticket-simple' }
                                ]">
                            <button @click="activeTab = item.id; accountDrawer = false"
                                :class="activeTab === item.id ? 'bg-[#003B7A] text-white' : 'text-gray-700 hover:bg-gray-50'"
                                class="flex items-center gap-3 px-6 py-4 border-b border-gray-50 text-left transition-colors">
                                <i class="fa-solid w-5" :class="item.icon"></i>
                                <span class="text-sm font-medium" x-text="item.label"></span>
                            </button>
                        </template>

                        <a href="<?php echo e(route('portal.redirect')); ?>" target="_blank"
                            class="flex items-center gap-3 px-6 py-4 border-b border-gray-50 text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fa-brands fa-artstation w-5 text-center"></i>
                            <span class="text-sm font-medium">Marketing Assets</span>
                        </a>

                        <a href="<?php echo e(route('landing.index')); ?>"
                            class="flex items-center gap-3 px-6 py-4 border-b border-gray-50 text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fa-brands fa-affiliatetheme w-5 text-center"></i>
                            <span class="text-sm font-medium">Home</span>
                        </a>
                    </nav>
                </div>
            </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\affiliate-project\resources\views/frontend/auth/profile.blade.php ENDPATH**/ ?>