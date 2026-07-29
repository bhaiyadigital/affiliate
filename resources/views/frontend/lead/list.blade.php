<form action="{{ route('profile.index') }}" method="GET" class="mb-6 flex flex-wrap gap-4 items-end  p-4">
    <input type="hidden" name="active_tab" value="leads">

    <div class="w-64">
        <label class="text-xs font-semibold text-gray-500 uppercase block mb-1">Team Member</label>
        <select name="member_id" class="w-full border p-2 text-sm outline-none">
            <option value="">All Members</option>
            @foreach($members as $m)
                <option value="{{ $m->id }}" {{ request('member_id') == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="w-48">
        <label class="text-xs font-semibold text-gray-500 uppercase block mb-1">Status</label>
        <select name="status" class="w-full border p-2 text-sm outline-none">
            <option value="">All Status</option>
            @foreach(\App\Models\Lead::statusLabels() as $id => $label)
                <option value="{{ $id }}" {{ request('status') == $id ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="bg-[#003B7A] text-white px-5 py-2 rounded text-sm font-bold">Filter</button>
    <a href="{{ route('profile.index') }}?active_tab=leads" class="bg-gray-200 px-4 py-2 rounded text-sm">Reset</a>
</form>
<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <div class="p-4 bg-blue-50 border border-blue-100 rounded-sm">
        <span class="text-sm font-bold text-blue-600 uppercase">My Leads</span>
        <div class="text-2xl font-bold text-blue-900">{{ $leads->where('user_id', auth()->id())->count() }}</div>
    </div>
    <div class="p-4 bg-purple-50 border border-purple-100 rounded-sm">
        <span class="text-sm font-bold text-purple-600 uppercase">Team Member Leads</span>
        <div class="text-2xl font-bold text-purple-900">{{ $leads->where('referrer_id', auth()->id())->count() }}</div>
    </div>
    <div class="p-4 bg-green-50 border border-green-100 rounded-sm">
        <span class="text-sm font-bold text-green-600 uppercase">Team Size</span>
        <div class="text-2xl font-bold text-green-900">{{ auth()->user()->teamMembers->count() }}</div>
    </div>
</div>

<!-- Leads Table -->
<div class="overflow-hidden border border-gray-100 rounded-sm bg-white ">
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-sm font-bold text-gray-500 uppercase border-b">
            <tr>
                <th class="px-6 py-4">Customer</th>
                <th class="px-6 py-4">Source</th>
                <th class="px-6 py-4">Referred By</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($leads as $lead)
                <tr class="hover:bg-gray-50 transition-colors text-base">
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-800">{{ $lead->name }}</div>
                        <div class="text-sm text-gray-500">{{ $lead->phone }} | {{ $lead->interested_location }}</div>
                    </td>
                    {{-- কলাম ১: আসার মাধ্যম (Source Type) --}}
                    <td class="px-6 py-4">
                        @if($lead->type === 'manual')
                            <span class="text-sm text-gray-500 font-bold flex items-center gap-1.5">
                                <i class="fas fa-hand-pointer text-sm opacity-70"></i> MANUAL
                            </span>
                        @else
                            <span class="text-sm text-indigo-500 font-bold flex items-center gap-1.5">
                                <i class="fas fa-link text-sm opacity-70"></i> LINK
                            </span>
                        @endif
                    </td>

                    {{-- কলাম ২: কে রেফার করেছে (Referrer Info) --}}
                    <td class="px-6 py-4">
                        @if ($lead->user_id == auth()->id())
                            {{-- নিজের লিড হলে --}}
                            <span
                                class="text-sm font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded border border-blue-100 w-fit uppercase">
                                MY PERSONAL
                            </span>
                        @else
                            {{-- টিমের মেম্বারের লিড হলে তার নাম ও ডিটেইলস --}}
                            <div class="flex items-center gap-2">
                                <img src="{{ $lead->user->avatar_url ?? asset('./images/user/images.png') }}"
                                    class="w-6 h-6 rounded-full border border-gray-100 shadow-sm object-cover">
                                <div class="flex flex-col leading-tight">
                                    <span class="text-sm font-bold text-gray-700">{{ $lead->user->name }}</span>
                                    <span class="text-sm text-gray-500">Team Member</span>
                                </div>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @php
                            // স্ট্যাটাস অনুযায়ী কালার নির্ধারণ
                            $statusColor = match ($lead->status) {
                                \App\Models\Lead::STATUS_PENDING => 'bg-gray-100 text-gray-600 border-gray-200',   // নতুন/পেন্ডিং (ধূসর)
                                \App\Models\Lead::STATUS_CONTACTED => 'bg-blue-50 text-blue-700 border-blue-100',    // কথা হয়েছে (নীল)
                                \App\Models\Lead::STATUS_VISIT => 'bg-orange-50 text-orange-700 border-orange-100', // ভিজিট করেছে (কমলা)
                                \App\Models\Lead::STATUS_BOOKED => 'bg-purple-50 text-purple-700 border-purple-100', // বুকিং হয়েছে (বেগুনী)
                                \App\Models\Lead::STATUS_COMPLETED => 'bg-green-50 text-green-700 border-green-100', // সম্পন্ন (সবুজ)
                                default => 'bg-gray-50 text-gray-500 border-gray-100',
                            };
                        @endphp

                        <span
                            class="{{ $statusColor }} px-2 py-1 rounded text-[11px] font-black border uppercase tracking-wider">
                            {{ $lead->status_label }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right">
                        @if ($lead->user_id == auth()->id())
                            <button @click="editingLead = @js($lead); leadView = 'form'" class="text-blue-500 mr-2"><i
                                    class="fas fa-edit"></i></button>
                            <form action="{{ route('lead.destroy', $lead->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500"><i class="fas fa-trash"></i></button>
                            </form>
                        @else
                            <i class="fas fa-lock text-gray-200"></i>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500 italic">No leads found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    @include('partials.pagination', ['items' => $leads])
</div>
