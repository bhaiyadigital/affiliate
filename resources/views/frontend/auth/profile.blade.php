@extends('frontend.layouts.front')

@section('content')
    <section class="container mx-auto px-4 lg:px-8 py-12" x-data="{
                                                                                    activeTab: '{{
         session('active_tab') ?? (
        request('active_tab') ?? (
            $errors->hasAny(['current_password', 'new_password', 'avatar']) ? 'profile' : (
                $errors->hasAny(['title', 'slug', 'start_date', 'end_date', 'name', 'views']) ? 'coupons' : (
                    $errors->hasAny(['email', 'password']) ? 'team' : (
                        $errors->hasAny(['name', 'phone', 'email', 'budget']) ? 'leads' : 'dashboard'
                    )
                )
            )
        ))
                                                                                    }}',

                                                                                    leadView: '{{ session('lead_view') ?? ($errors->hasAny(['name', 'phone', 'email', 'budget']) ? 'form' : 'list') }}',
                                                                                    teamView: '{{ $errors->hasAny(['email', 'password']) ? 'form' : (session('team_view') ?? 'list') }}',
                                                                                    couponView: '{{
        $errors->hasAny(['title', 'slug', 'start_date', 'end_date', 'name', 'views']) ? 'form' :
        (session('coupon_view') ?? 'list')
                                                                                    }}',

                                                                                    editingMember: {
                                                                                        id: '{{ old('id') }}',
                                                                                        name: '{{ old('member_name') }}',
                                                                                        phone: '{{ old('member_phone') }}',
                                                                                        email: '{{ old('email') }}'
                                                                                    },

                                                                                    editingCoupon: {
                                                                                        id: '{{ old('id') }}',
                                                                                        title: '{{ old('title') }}',
                                                                                        slug: '{{ old('slug') }}',
                                                                                        start_date: '{{ old('start_date') }}',
                                                                                        end_date: '{{ old('end_date') }}',
                                                                                        name: '{{ old('usage_limit', 1) }}',
                                                                                        views: '{{ old('total_limit', 100) }}'
                                                                                    },

                                                                                    editingLead: {
                                                                                        id: '{{ old('id') }}',
                                                                                        name: '{{ old('name') }}',
                                                                                        email: '{{ old('email') }}',
                                                                                        phone: '{{ old('phone') }}',
                                                                                        interested_location: '{{ old('interested_location') }}',
                                                                                        budget: '{{ old('budget') }}',
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

                        <a href="{{ route('portal.redirect') }}" target="_blank"
                            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-all border-b border-gray-50">
                            <i class="fa-brands fa-artstation w-5"></i>
                            <span class="text-base font-medium">Marketing Assets</span>
                        </a>
 
                    </nav>
                </div>
            </div>

            <!-- ── RIGHT CONTENT ── -->
            <div class="lg:col-span-9  min-h-[500px]">

                <div x-show="activeTab === 'dashboard'" x-transition class="space-y-6 bg-[#F8FAFC] -m-4 p-4 md:-m-8 md:p-8">
                    @php
                        $statsLeads = isset($allLeads) ? $allLeads : $leads;
                        $total = $statsLeads->count();
                        $manual = $statsLeads->where('type', 'manual')->count();
                        $link = $statsLeads->where('type', 'refer_link')->count();
                        $coupon = $statsLeads->whereNotNull('coupon_code')->count();
                        $teamLeadsCount = $statsLeads->where('user_id', '!=', auth()->id())->count();
                        $conv = $statsLeads->where('status', \App\Models\Lead::STATUS_COMPLETED)->count();
                        $rate = $total > 0 ? round(($conv / $total) * 100, 1) : 0;
                        $totalCommission = $conv * 15000;

                        // ট্রেন্ড চার্ট ডাটা
                        $chartMonths = [];
                        $chartValues = [];
                        for ($i = 5; $i >= 0; $i--) {
                            $date = now()->subMonths($i);
                            $chartMonths[] = $date->format('M');
                            $chartValues[] = $statsLeads->filter(fn($l) => $l->created_at->format('Y-m') == $date->format('Y-m'))->count();
                        }

                        $sNew = $statsLeads->where('status', \App\Models\Lead::STATUS_PENDING)->count();
                        $sContacted = $statsLeads->where('status', \App\Models\Lead::STATUS_CONTACTED)->count();
                        $sQualified = $statsLeads->where('status', \App\Models\Lead::STATUS_VISIT)->count();
                        $sConverted = $statsLeads->where('status', \App\Models\Lead::STATUS_COMPLETED)->count();

                    @endphp


                    <!-- ── HEADER ── -->
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <h2 class="text-xl font-bold text-gray-800">Affiliate Dashboard</h2>
                        <div class="flex items-center gap-3">
                            {{-- <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-600"></i>
                                <input type="text" placeholder="Search..."
                                    class="pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#008060] w-64 shadow-sm">
                            </div> --}}
                            <div class="relative inline-block text-left" x-data="{ open: false, showCustom: false }"
                                @mouseleave="open = false; showCustom = false">

                                <!-- Button -->
                                <button @mouseenter="open = true"
                                    class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-500 shadow-sm transition-all hover:bg-gray-50">
                                    <i class="far fa-calendar text-gray-600 text-sm"></i>
                                    <span class="tracking-tight">
                                        @if(request('date_range') == 'custom' && request('from') && request('to'))
                                            {{-- এটি ১৮ Aug ২০২৬ ফরম্যাটে দেখাবে --}}
                                            {{ \Carbon\Carbon::parse(request('from'))->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse(request('to'))->format('d M Y') }}
                                        @elseif(request('date_range') == 'today')
                                            Today ({{ now()->format('d M Y') }})
                                        @elseif(request('date_range') == '7_days')
                                            Last 7 Days
                                        @elseif(request('date_range') == '30_days')
                                            Last 30 Days
                                        @elseif(request('date_range') == 'this_month')
                                            This Month ({{ now()->format('M Y') }})
                                        @else
                                            Date Range
                                        @endif
                                    </span>
                                    <i class="fas fa-chevron-down text-[10px] ml-1 transition-transform"
                                        :class="open ? 'rotate-180' : ''"></i>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="open" x-transition
                                    class="absolute right-0 mt-1 w-56 origin-top-right bg-white border border-gray-100 rounded-2xl shadow-2xl z-50 overflow-hidden"
                                    style="display: none;">

                                    <!-- Preset Links -->
                                    <div class="py-1" x-show="!showCustom">
                                        <a href="{{ request()->fullUrlWithQuery(['date_range' => 'today']) }}"
                                            class="block px-4 py-2.5 text-xs font-bold text-gray-600 hover:bg-gray-50 border-b border-gray-50">Today</a>
                                        <a href="{{ request()->fullUrlWithQuery(['date_range' => '7_days']) }}"
                                            class="block px-4 py-2.5 text-xs font-bold text-gray-600 hover:bg-gray-50 border-b border-gray-50">7
                                            Days</a>
                                        <a href="{{ request()->fullUrlWithQuery(['date_range' => '30_days']) }}"
                                            class="block px-4 py-2.5 text-xs font-bold text-gray-600 hover:bg-gray-50 border-b border-gray-50">30
                                            Days</a>
                                        <a href="{{ request()->fullUrlWithQuery(['date_range' => 'this_month']) }}"
                                            class="block px-4 py-2.5 text-xs font-bold text-gray-600 hover:bg-gray-50 border-b border-gray-50">This
                                            Month</a>
                                        <button @click="showCustom = true"
                                            class="w-full text-left px-4 py-2.5 text-xs font-bold text-[#008060] hover:bg-gray-50 italic">Custom
                                            Range...</button>
                                    </div>

                                    <!-- Custom Date Input Form -->
                                    <div class="p-4 bg-gray-50" x-show="showCustom">
                                        <form action="{{ route('profile.index') }}" method="GET" class="space-y-3">
                                            <input type="hidden" name="active_tab" value="dashboard">
                                            <input type="hidden" name="date_range" value="custom">

                                            <div>
                                                <label class="text-[9px] uppercase font-bold text-gray-600 mb-1 block">From
                                                    Date</label>
                                                <input type="date" name="from" value="{{ request('from') }}"
                                                    class="w-full text-xs border-gray-200 rounded-lg p-2 outline-none focus:ring-1 focus:ring-[#008060]"
                                                    required>
                                            </div>
                                            <div>
                                                <label class="text-[9px] uppercase font-bold text-gray-600 mb-1 block">To
                                                    Date</label>
                                                <input type="date" name="to" value="{{ request('to') }}"
                                                    class="w-full text-xs border-gray-200 rounded-lg p-2 outline-none focus:ring-1 focus:ring-[#008060]"
                                                    required>
                                            </div>

                                            <div class="flex gap-2">
                                                <button type="button" @click="showCustom = false"
                                                    class="flex-1 bg-white border border-gray-200 text-gray-500 py-2 rounded-lg text-[10px] font-bold">Back</button>
                                                <button type="submit"
                                                    class="flex-1 bg-[#008060] text-white py-2 rounded-lg text-[10px] font-bold shadow-md shadow-emerald-100">Apply</button>
                                            </div>
                                        </form>
                                        @if(request('date_range'))
                                            <div class="border-t border-gray-100 mt-1">
                                                <a href="{{ route('profile.index', ['active_tab' => 'dashboard']) }}"
                                                    class="block px-4 py-2 text-[10px] text-red-500 font-black uppercase hover:bg-red-50 transition-colors">
                                                    <i class="fas fa-times-circle mr-1"></i> Clear Filter
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ── STATS CARDS (8 CARDS) ── -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- কার্ড মেকার ফাংশন স্টাইল -->
                        @php
                            $cards = [
                                ['label' => 'Total Leads', 'value' => number_format($total), 'icon' => 'fas fa-users', 'color' => 'bg-emerald-50 text-emerald-600'],
                                ['label' => 'Direct Leads', 'value' => number_format($manual), 'icon' => 'fas fa-hand-pointer', 'color' => 'bg-indigo-50 text-indigo-600'],
                                ['label' => 'Refer Link Leads', 'value' => number_format($link), 'icon' => 'fas fa-link', 'color' => 'bg-rose-50 text-rose-600'],
                                ['label' => 'Refer Code Leads', 'value' => number_format($coupon), 'icon' => 'fas fa-hashtag', 'color' => 'bg-amber-50 text-amber-600'],
                                ['label' => 'Team Leads', 'value' => number_format($teamLeadsCount), 'icon' => 'fas fa-users-cog', 'color' => 'bg-purple-50 text-purple-600'],
                                ['label' => 'Converted Leads', 'value' => number_format($conv), 'icon' => 'fas fa-check-circle', 'color' => 'bg-green-50 text-green-600'],
                                ['label' => 'Conversion Rate', 'value' => $rate . '%', 'icon' => 'fas fa-chart-pie', 'color' => 'bg-orange-50 text-orange-600'],
                            ];
                        @endphp

                        @foreach($cards as $card)
                            <div
                                class="p-6 bg-white rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                                <div class="space-y-2">
                                    <p class="text-xs font-bold text-gray-600 uppercase tracking-wider">{{ $card['label'] }}</p>
                                    <h3 class="text-3xl lg:text-5xl font-bold text-gray-800">{{ $card['value'] }}</h3>

                                </div>
                                <div
                                    class="w-12 h-12 {{ $card['color'] }} rounded-full flex items-center justify-center shadow-sm">
                                    <i class="{{ $card['icon'] }} text-lg"></i>
                                </div>
                            </div>
                        @endforeach

                        <!-- Card 8: Total Commission (Exact Image Color Match) -->
                        <div
                            class="p-6 bg-[#F6FBF9] rounded-xl border border-white shadow-sm flex justify-between items-start transition-all hover:shadow-md">
                            <div class="space-y-2">
                                <!-- হেডিং: হালকা ধূসর -->
                                <p class="text-[11px] font-bold text-gray-600 uppercase tracking-widest">Total Commission
                                </p>

                                <!-- অ্যামাউন্ট: ডিপ গ্রিন (#006D44) -->
                                <h3 class="text-4xl font-black text-[#006D44]">৳{{ number_format($conv * 15000) }}</h3>


                            </div>

                            <!-- আইকন: ডিপ গ্রিন গোল ব্যাকগ্রাউন্ড এবং সাদা আইকন -->
                            <div
                                class="w-14 h-14 bg-[#006D44] text-white rounded-full flex items-center justify-center shadow-lg shadow-[#006d442b]">
                                <i class="fas fa-wallet text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- ── CHARTS ROW ── -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                            <div class="flex items-center justify-between mb-8">
                                <h3 class="font-bold text-gray-800">Lead Trend</h3>
                                <i class="fas fa-ellipsis-v text-gray-300 cursor-pointer"></i>
                            </div>
                            <div class="h-72"><canvas id="leadTrendChart"></canvas></div>
                        </div>

                        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col">
                            <h3 class="font-bold text-gray-800 mb-8">Lead Status</h3>
                            <div class="relative flex-1 flex items-center justify-center">
                                <canvas id="leadStatusChart"></canvas>
                                <div class="absolute flex flex-col items-center pointer-events-none">
                                    <span
                                        class="text-4xl font-black text-gray-800">{{ $total > 0 ? round(($sNew / $total) * 100) : 0 }}%</span>
                                    <span class="text-sm font-bold text-gray-600 uppercase tracking-wider">New Leads</span>
                                </div>
                            </div>
                            <div class="mt-8 grid grid-cols-2 gap-x-4 gap-y-3">
                                <div class="flex items-center gap-2 text-sm font-bold text-gray-500 uppercase">
                                    <div class="w-2.5 h-2.5 bg-[#008060] rounded-full"></div> New
                                    ({{ $total > 0 ? round(($sNew / $total) * 100) : 0 }}%)
                                </div>
                                <div class="flex items-center gap-2 text-sm font-bold text-gray-500 uppercase">
                                    <div class="w-2.5 h-2.5 bg-[#10b981] rounded-full"></div> Contacted
                                    ({{ $total > 0 ? round(($sContacted / $total) * 100) : 0 }}%)
                                </div>
                                <div class="flex items-center gap-2 text-sm font-bold text-gray-500 uppercase">
                                    <div class="w-2.5 h-2.5 bg-[#4f46e5] rounded-full"></div> Qualified
                                    ({{ $total > 0 ? round(($sQualified / $total) * 100) : 0 }}%)
                                </div>
                                <div class="flex items-center gap-2 text-sm font-bold text-gray-500 uppercase">
                                    <div class="w-2.5 h-2.5 bg-[#e5e7eb] rounded-full"></div> Converted
                                    ({{ $total > 0 ? round(($sConverted / $total) * 100) : 0 }}%)
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ── PERFORMANCE ROW ── -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Project Performance -->
                        <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm">
                            <h3 class="text-lg font-bold text-gray-800 mb-8">Project Performance</h3>
                            <div class="space-y-4">
                                @foreach($statsLeads->groupBy('interested_location')->take(3) as $location => $pLeads)
                                    <div
                                        class="flex items-center justify-between p-5 bg-white border border-gray-100 rounded-xl">
                                        <span class="font-bold text-gray-700">{{ $location ?: 'General' }}</span>
                                        <span class="font-bold text-[#008060] text-xl">{{ $pLeads->count() }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Team Performance -->
                        <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm">
                            <h3 class="text-lg font-bold text-gray-800 mb-8">Team Performance</h3>
                            <div class="space-y-4">
                                @forelse(auth()->user()->teamMembers->take(2) as $index => $member)
                                    @php
                                        $mLeads = $statsLeads->where('user_id', $member->id);
                                        $mConv = $mLeads->where('status', \App\Models\Lead::STATUS_COMPLETED)->count();
                                    @endphp
                                    <div class="flex items-center gap-4 p-5 border border-gray-100 rounded-xl bg-white">
                                        <div
                                            class="w-12 h-12 rounded-full {{ $index == 0 ? 'bg-[#008060]' : 'bg-indigo-100' }} flex items-center justify-center font-bold text-xl {{ $index == 0 ? 'text-white' : 'text-indigo-600' }}">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-bold text-gray-800 leading-tight">{{ $member->name }}</h4>
                                            <p class="text-xs text-gray-600 font-bold uppercase">
                                                {{ $index == 0 ? 'Top Member' : 'Active Member' }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xl font-bold text-gray-800">{{ $mConv }} <span
                                                    class="text-gray-300 text-sm">/ {{ $mLeads->count() ?: 1 }}</span></p>
                                            <p class="text-[10px] text-gray-600 font-bold uppercase">Conv. / Leads</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-600 text-center py-10 italic">No team active.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- ── RECENT LEADS (All Device Responsive) ── -->
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mt-6">
                        <!-- Header -->
                        <div
                            class="p-5 md:p-8 border-b border-gray-50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <h3 class="text-lg font-bold text-gray-800">Recent Leads</h3>
                            <button @click="activeTab = 'leads'"
                                class="text-sm font-bold text-[#008060] hover:underline flex items-center gap-1">
                                View All <i class="fas fa-arrow-right text-xs"></i>
                            </button>
                        </div>

                        <!-- Desktop View (Visible on Tablet and Desktop) -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="w-full text-left">
                                <thead
                                    class="bg-gray-50 text-[11px] uppercase font-black text-gray-400 tracking-wider border-b border-gray-100">
                                    <tr>
                                        <th class="px-8 py-5">Name</th>
                                        <th class="px-8 py-5">Project</th>
                                        <th class="px-8 py-5">Source</th>
                                        <th class="px-8 py-5">Team</th>
                                        <th class="px-8 py-5 text-center">Status</th>
                                        <th class="px-8 py-5">Date</th>
                                        <th class="px-8 py-5 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @forelse($leads->take(5) as $lead)
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="px-8 py-5 font-bold text-gray-700 text-sm">{{ $lead->name }}</td>
                                            <td class="px-8 py-5 text-gray-500 text-sm">
                                                {{ $lead->interested_location ?: 'N/A' }}</td>
                                            <td class="px-8 py-5 text-gray-400 text-[11px] font-bold uppercase">
                                                {{ $lead->type }}</td>
                                            <td class="px-8 py-5">
                                                <span
                                                    class="text-sm font-semibold {{ $lead->user_id == auth()->id() ? 'text-[#008060]' : 'text-indigo-600' }}">
                                                    {{ $lead->user_id == auth()->id() ? 'Direct' : $lead->user->name }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-5 text-center">
                                                @php
                                                    $statusStyle = match ($lead->status) {
                                                        \App\Models\Lead::STATUS_PENDING => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                        \App\Models\Lead::STATUS_COMPLETED => 'bg-amber-50 text-amber-700 border-amber-100',
                                                        default => 'bg-indigo-50 text-indigo-600 border-indigo-100',
                                                    };
                                                @endphp
                                                <span
                                                    class="{{ $statusStyle }} px-3 py-1 rounded-full text-[10px] font-bold border uppercase tracking-tighter">
                                                    {{ $lead->status_label }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-5 text-gray-400 text-sm">
                                                {{ $lead->created_at->format('M d, Y') }}</td>
                                            <td class="px-8 py-5 text-right">
                                                <i class="fas fa-chevron-right text-gray-200"></i>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-8 py-10 text-center text-gray-400 italic">No recent leads
                                                found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile View (Visible on Mobile only) -->
                        <div class="md:hidden divide-y divide-gray-100">
                            @forelse($leads->take(5) as $lead)
                                <div class="p-4 space-y-3">
                                    <div class="flex justify-between items-start">
                                        <div class="flex flex-col">
                                            <span
                                                class="font-bold text-gray-800 text-base leading-tight">{{ $lead->name }}</span>
                                            <span
                                                class="text-[10px] text-gray-400 font-medium uppercase tracking-wider mt-1">{{ $lead->created_at->format('M d, Y') }}</span>
                                        </div>
                                        @php
                                            $statusStyle = match ($lead->status) {
                                                \App\Models\Lead::STATUS_PENDING => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                \App\Models\Lead::STATUS_COMPLETED => 'bg-amber-50 text-amber-700 border-amber-100',
                                                default => 'bg-indigo-50 text-indigo-600 border-indigo-100',
                                            };
                                        @endphp
                                        <span
                                            class="{{ $statusStyle }} px-2.5 py-0.5 rounded-full text-[9px] font-bold border uppercase">
                                            {{ $lead->status_label }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 pt-2 border-t border-gray-50">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-[9px] text-gray-400 font-black uppercase tracking-tighter">Project</span>
                                            <span
                                                class="text-xs font-bold text-gray-600 truncate">{{ $lead->interested_location ?: 'N/A' }}</span>
                                        </div>
                                        <div class="flex flex-col text-right">
                                            <span class="text-[9px] text-gray-400 font-black uppercase tracking-tighter">Team
                                                Info</span>
                                            <span
                                                class="text-xs font-bold {{ $lead->user_id == auth()->id() ? 'text-[#008060]' : 'text-indigo-600' }}">
                                                {{ $lead->user_id == auth()->id() ? 'Direct' : $lead->user->name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center text-gray-400 italic">No recent leads found.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div x-show="activeTab === 'profile'" class="" x-transition>
                    <h2 class="text-xl font-bold text-gray-800 mb-6 uppercase border-b pb-2">Profile Settings</h2>

                    @if (session('success'))
                        <div
                            style="background: rgba(143, 224, 166, 0.2); border: 1px solid #10b981; color: #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; font-weight: 600;">
                            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div
                            style="background: rgba(255, 132, 132, 0.15); border: 1px solid #ff8484; color: #ff8484; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                        class="max-w-xl">
                        @csrf
                        @method('PUT')

                        <div class="mb-8 flex items-center gap-6">
                            <div class="relative group">
                                <img id="avatarPreview"
                                    src="{{ Auth::user()->avatar_url ?? asset('./images/user/images.png') }}"
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
                                <input type="text" name="name" value="{{ Auth::user()->name }}"
                                    class="w-full border border-gray-300 px-4 py-2 text-base outline-none focus:border-[#003B7A]">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-500 uppercase mb-2">Phone</label>
                                <input type="text" name="phone" value="{{ Auth::user()->phone }}"
                                    class="w-full border border-gray-300 px-4 py-2 text-base outline-none focus:border-[#003B7A]">
                            </div>
                        </div>

                        <hr class="my-8 border-gray-100">

                        <h4 class="text-sm font-bold text-[#003B7A] uppercase mb-4 tracking-widest">Change Password</h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Current Password</label>
                                <input type="password" name="current_password"
                                    class="w-full border border-gray-300 px-4 py-2 text-base outline-none focus:border-[#003B7A]">
                                @error('current_password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">New Password</label>
                                    <input type="password" name="new_password"
                                        class="w-full border border-gray-300 px-4 py-2 text-base outline-none focus:border-[#003B7A]">
                                    @error('new_password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Confirm New
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
                            class="bg-blue-100 text-blue-800 text-sm font-black px-2 py-1 rounded">{{ $downloadLogs->count() }}
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
                                @forelse($downloadLogs as $log)
                                    @php
                                        $item =
                                            $log->model === 'asset'
                                            ? \App\Models\Asset::find($log->model_id)
                                            : \App\Models\Campaign::find($log->model_id);
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition-colors text-base">
                                        <td class="px-6 py-4">
                                            @if ($item)
                                                <a href="{{ route($log->model . '.details', $item->slug) }}"
                                                    class="text-base font-semibold text-[#003B7A] hover:underline">
                                                    {{ $item->title }}
                                                </a>
                                            @else
                                                <span class="text-gray-500 italic">Resource deleted (ID:
                                                    {{ $log->model_id }})</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="text-sm font-bold uppercase px-2 py-0.5 rounded {{ $log->model === 'asset' ? 'bg-blue-100 text-blue-800' : 'bg-teal-100 text-teal-800' }}">
                                                {{ $log->model }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm text-gray-600">
                                            {{ $log->updated_at->format('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center text-gray-500 italic">No history
                                            found.</td>
                                    </tr>
                                @endforelse
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
                        @if (session('success'))
                            <div
                                class="mb-4 bg-green-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
                                <span><i class="fas fa-check-circle mr-2"></i> {{ session('success') }}</span>
                                <button @click="show = false"><i class="fas fa-times"></i></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div
                                class="mb-4 bg-red-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
                                <span><i class="fas fa-times-circle mr-2"></i> {{ session('error') }}</span>
                                <button @click="show = false"><i class="fas fa-times"></i></button>
                            </div>
                        @endif
                    </div>

                    {{-- লিস্ট ইনক্লুড --}}
                    <div x-show="leadView === 'list'" x-transition>
                        @include('frontend.lead.list')
                    </div>


                    {{-- ফর্ম ইনক্লুড --}}
                    <div x-show="leadView === 'form'" x-transition style="display: none;">
                        @include('frontend.lead.form')
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
                        @if (session('success'))
                            <div
                                class="mb-4 bg-green-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
                                <span><i class="fas fa-check-circle mr-2"></i> {{ session('success') }}</span>
                                <button @click="show = false"><i class="fas fa-times"></i></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div
                                class="mb-4 bg-red-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
                                <span><i class="fas fa-times-circle mr-2"></i> {{ session('error') }}</span>
                                <button @click="show = false"><i class="fas fa-times"></i></button>
                            </div>
                        @endif
                    </div>

                    {{-- ১. টিম লিস্ট ইনক্লুড --}}
                    <div x-show="teamView === 'list'" x-transition>
                        @include('frontend.team.list')
                    </div>

                    {{-- ২. টিম মেম্বার তৈরির ফর্ম ইনক্লুড --}}
                    <div x-show="teamView === 'form'" x-transition style="display: none;">
                        @include('frontend.team.form')
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
                        @if (session('success'))
                            <div
                                class="mb-4 bg-green-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
                                <span><i class="fas fa-check-circle mr-2"></i> {{ session('success') }}</span>
                                <button @click="show = false"><i class="fas fa-times"></i></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div
                                class="mb-4 bg-red-600 text-white p-4 rounded shadow-lg text-base flex justify-between items-center">
                                <span><i class="fas fa-times-circle mr-2"></i> {{ session('error') }}</span>
                                <button @click="show = false"><i class="fas fa-times"></i></button>
                            </div>
                        @endif
                    </div>

                    <div x-show="couponView === 'list'">
                        @include('frontend.coupon.list')
                    </div>
                    <div x-show="couponView === 'form'" style="display: none;">
                        @include('frontend.coupon.form')
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
                            class="text-gray-600 hover:text-red-500 text-2xl leading-none">&times;</button>
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

                        <a href="{{ route('portal.redirect') }}" target="_blank"
                            class="flex items-center gap-3 px-6 py-4 border-b border-gray-50 text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fa-brands fa-artstation w-5 text-center"></i>
                            <span class="text-sm font-medium">Marketing Assets</span>
                        </a>

                        <a href="{{ route('home.index') }}"
                            class="flex items-center gap-3 px-6 py-4 border-b border-gray-50 text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fa-brands fa-affiliatetheme w-5 text-center"></i>
                            <span class="text-sm font-medium">Home</span>
                        </a>
                    </nav>
                </div>
            </div>
    </section>
@endsection
@push('scripts')
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. LEAD TREND (Area Chart)
            const trendCtx = document.getElementById('leadTrendChart').getContext('2d');
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: @js($chartMonths),
                    datasets: [{
                        data: @js($chartValues),
                        borderColor: '#008060',
                        backgroundColor: (context) => {
                            const bg = context.chart.ctx.createLinearGradient(0, 0, 0, 400);
                            bg.addColorStop(0, 'rgba(0, 128, 96, 0.15)');
                            bg.addColorStop(1, 'rgba(0, 128, 96, 0)');
                            return bg;
                        },
                        fill: true,
                        tension: 0.4, // ইমেজের মতো ঢেউ খেলানোর জন্য
                        pointRadius: 0,
                        borderWidth: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { display: false },
                        x: { grid: { display: false }, border: { display: false }, ticks: { color: '#94a3b8', font: { size: 11 } } }
                    }
                }
            });

            // 2. LEAD STATUS (Donut Chart)
            const statusCtx = document.getElementById('leadStatusChart').getContext('2d');
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['New', 'Contacted', 'Qualified', 'Converted'],
                    datasets: [{
                        data: [@js($sNew), @js($sContacted), @js($sQualified), @js($sConverted)],
                        backgroundColor: ['#008060', '#10b981', '#4f46e5', '#e5e7eb'],
                        borderWidth: 0,
                        cutout: '82%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } }
                }
            });
        });
    </script>
@endpush
