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
                    phone: '<?php echo e(old('phone')); ?>',
                    interested_location: '<?php echo e(old('interested_location')); ?>',
                    budget: '<?php echo e(old('budget')); ?>'
                }
            }">

        <div class="mb-10">
            <h1 class="text-[#003B7A] text-4xl font-light">My Account</h1>
            <p class="text-gray-500 mt-2 text-base">Manage your profile and activity from one place.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- ── LEFT SIDEBAR ── -->
            <div class="lg:col-span-3">
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

                        <!-- History Tab Button -->
                        <button @click="activeTab = 'history'"
                            :class="activeTab === 'history' ? 'bg-[#003B7A] text-white' : 'text-gray-700 hover:bg-gray-50'"
                            class="flex items-center gap-3 px-4 py-3 transition-all border-b border-gray-50 text-left">
                            <i class="fas fa-history w-5"></i>
                            <span class="text-base font-medium">Download History</span>
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

                        <a href="<?php echo e(route('home.index')); ?>"
                            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-all border-b border-gray-50">
                            <i class="fas fa-home w-5"></i>
                            <span class="text-base font-medium">Home Page</span>
                        </a>
                        <a href="<?php echo e(route('home.filter')); ?>"
                            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-all border-b border-gray-50">
                            <i class="fas fa-box w-5"></i>
                            <span class="text-base font-medium">Assets</span>
                        </a>
                        <a href="<?php echo e(route('home.filter')); ?>"
                            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-all border-b border-gray-50">
                            <i class="fas fa-palette w-5"></i>
                            <span class="text-base font-medium">Brand Assets</span>
                        </a><a href="<?php echo e(route('landing.index')); ?>"
                            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-all border-b border-gray-50">
                            <i class="fa-brands fa-affiliatetheme w-5"></i>
                            <span class="text-base font-medium">Home</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- ── RIGHT CONTENT ── -->
            <div class="lg:col-span-9 bg-white border border-gray-200 shadow-sm rounded-sm min-h-[500px]">

                <div x-show="activeTab === 'dashboard'" class="p-8" x-transition>
                    <!-- ── HEADER ── -->
                    <div class="mb-8 flex items-center justify-between border-b pb-4">
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
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                        <!-- Total Network Leads (Personal + Team) -->
                        <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl border-t-4 border-t-blue-600">
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
                        <div
                            class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl border-t-4 border-t-purple-600">
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
                        <h3 class="text-base font-bold text-gray-700 uppercase mb-8 flex items-center gap-2">
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

                    <!-- ── ৩. টিম পারফরম্যান্স টেবিল ── -->
                    <div class="mt-10 bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                            <h3 class="text-base font-bold text-gray-700 uppercase flex items-center gap-2">
                                <i class="fas fa-users text-purple-500"></i> Team Performance Breakdown
                            </h3>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="text-sm uppercase text-gray-500 font-bold border-b border-gray-100 bg-white">
                                        <th class="px-8 py-4">Member Name</th>
                                        <th class="px-8 py-4 text-center">Total Leads</th>
                                        <th class="px-8 py-4 text-center">Completed</th>
                                        <th class="px-8 py-4 text-right">Success Rate</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    <?php $__empty_1 = true; $__currentLoopData = auth()->user()->teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php
                                            // ওই মেম্বারের দেওয়া সব লিড (নিজের + রেফারেল)
                                            $memberLeads = $leads->where('user_id', $member->id);
                                            $total = $memberLeads->count();
                                            $completed = $memberLeads->where('status', \App\Models\Lead::STATUS_COMPLETED)->count();
                                            $successRate = $total > 0 ? round(($completed / $total) * 100) : 0;
                                        ?>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-8 py-5">
                                                <div class="flex items-center gap-3">
                                                    <img src="<?php echo e($member->avatar_url ?? asset('./images/user/images.png')); ?>"
                                                        class="w-8 h-8 rounded-full border shadow-sm">
                                                    <div class="flex flex-col">
                                                        <span class="text-base font-bold text-gray-800"><?php echo e($member->name); ?></span>
                                                        <span
                                                            class="text-sm text-gray-500 "><?php echo e($member->phone); ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5 text-center font-black text-gray-700 text-base"><?php echo e($total); ?></td>
                                            <td class="px-8 py-5 text-center">
                                                <span
                                                    class="px-2 py-0.5 rounded-full bg-green-50 text-green-600 text-sm font-bold border border-green-100"><?php echo e($completed); ?></span>
                                            </td>
                                            <td class="px-8 py-5 text-right">
                                                <div class="flex flex-col items-end">
                                                    <span class="text-sm font-bold text-gray-700"><?php echo e($successRate); ?>%</span>
                                                    <div class="w-20 h-1 bg-gray-100 rounded-full mt-1 overflow-hidden">
                                                        <div class="h-full bg-blue-600" style="width: <?php echo e($successRate); ?>%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="px-8 py-12 text-center text-gray-500 italic">No team member
                                                data available.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Section 1: Personal Info (Show if activeTab is 'profile') -->
                <div x-show="activeTab === 'profile'" class="p-8" x-transition>
                    <h2 class="text-xl font-bold text-gray-800 mb-6 uppercase tracking-wider border-b pb-2">Profile
                        Settings
                    </h2>
                    <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data"
                        class="max-w-xl">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <!-- Avatar Upload -->
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

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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

                        <button type="submit"
                            class="mt-8 bg-[#003B7A] text-white px-8 py-3 font-bold uppercase text-sm tracking-widest hover:bg-[#003b7a] transition-all">
                            Save Changes
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
                                <tr
                                    class="text-sm uppercase text-gray-600 font-bold border-b border-gray-100 bg-gray-50">
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
                <div x-show="activeTab === 'leads'" class="p-8" x-transition style="display: none;">

                    <div class="flex justify-between items-center mb-8 pb-4">
                        <h2 class="text-xl font-bold text-[#003B7A] uppercase tracking-wider"
                            x-text="leadView === 'list' ? 'Lead Management' : 'Submit New Lead'"></h2>

                        <button
                            @click="leadView = (leadView === 'list' ? 'form' : 'list'); if(leadView === 'list') editingLead = {id:''}"
                            class="bg-[#003B7A] text-white px-5 py-2 rounded-lg text-sm font-bold shadow-md">
                            <span x-text="leadView === 'list' ? '+ Add New Lead' : 'Back to List'"></span>
                        </button>
                    </div>

                    <div class="mb-6" x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition.duration.500ms>
                        <?php if(session('success')): ?>
                            <div class="mb-4 bg-green-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
                                <span><i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?></span>
                                <button @click="show = false"><i class="fas fa-times"></i></button>
                            </div>
                        <?php endif; ?>
                        <?php if(session('error')): ?>
                            <div class="mb-4 bg-red-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
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
                <div x-show="activeTab === 'team'" x-transition style="display: none;" class="p-8">

                    <!-- ── টিম হেডার এবং টগল বাটন ── -->
                    <div class="flex justify-between items-center mb-8 border-b pb-4">
                        <div>
                            <h2 class="text-xl font-bold text-[#003B7A] uppercase tracking-wider"
                                x-text="teamView === 'list' ? 'Team Management' : 'Create Team Member'"></h2>
                        </div>

                        <button @click="teamView = (teamView === 'list' ? 'form' : 'list')"
                            class="bg-[#003B7A] text-white px-5 py-2 rounded-lg text-sm font-bold shadow-md hover:bg-blue-900 transition-all">
                            <span x-text="teamView === 'list' ? '+ Add New Member' : 'Back to List'"></span>
                        </button>
                    </div>

                    <div class="mb-6" x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition.duration.500ms>
    <?php if(session('success')): ?>
        <div class="mb-4 bg-green-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
            <span><i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?></span>
            <button @click="show = false"><i class="fas fa-times"></i></button>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="mb-4 bg-red-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
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
                <div x-show="activeTab === 'coupons'" x-transition class="p-8">
                    <div class="flex justify-between items-center mb-8 border-b pb-4">
                        <h2 class="text-xl font-bold text-[#003B7A] uppercase"
                            x-text="editingCoupon.id ? 'Edit Coupon' : (couponView === 'form' ? 'Create Coupon' : 'My Coupons')">
                        </h2>

                        <!-- মেইন ফাইলের বাটনটি এভাবে আপডেট করুন -->
                        <button
                            @click="couponView = 'form'; editingCoupon = { id: null, title: '', slug: '', start_date: '', end_date: '', name: 1, views: 100 }"
                            class="bg-[#003B7A] text-white px-5 py-2 rounded-lg text-sm font-bold shadow-md">
                            <span x-text="couponView === 'list' ? '+ Add New' : 'Back to List'"></span>
                        </button>
                    </div>
                    <div class="mb-6" x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition.duration.500ms>
    <?php if(session('success')): ?>
        <div class="mb-4 bg-green-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
            <span><i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?></span>
            <button @click="show = false"><i class="fas fa-times"></i></button>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="mb-4 bg-red-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
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
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\affiliate-project\resources\views/frontend/auth/profile.blade.php ENDPATH**/ ?>