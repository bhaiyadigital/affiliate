<div class="overflow-hidden border border-gray-100 rounded-sm shadow-sm bg-white">
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-sm font-bold text-gray-500 uppercase border-b">
            <tr>
                <th class="px-6 py-4">Member Info</th>
                <th class="px-6 py-4 text-center">Joined Date</th>
                <th class="px-6 py-4 text-center">Leads Contributed</th>
                <th class="px-6 py-4 text-right">Actions</th> {{-- নতুন কলাম --}}
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse(auth()->user()->teamMembers as $member)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <a href="{{ route('profile.index', ['active_tab' => 'leads', 'member_id' => $member->id]) }}"
                            class="flex flex-col group cursor-pointer">

                            <span
                                class="font-bold text-gray-700 text-base group-hover:text-[#003B7A] transition-colors">
                                {{ $member->name }}
                            </span>

                            <span class="text-sm text-gray-500 font-medium">
                                <i class="fas fa-envelope mr-1"></i>{{ $member->email }} |
                                <i class="fas fa-phone mr-1"></i>{{ $member->phone }}
                            </span>
                        </a>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $member->created_at->format('d M, Y') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span
                            class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-black border border-blue-100">
                            {{ \App\Models\Lead::where('user_id', $member->id)->count() }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <button @click="editingMember = @js($member); teamView = 'form'"
                                class="text-blue-500 hover:text-blue-700 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center text-gray-500 italic bg-white">No members found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
