<div class="mb-10 bg-[#f8fafc] p-10 rounded-2xl border border-blue-100 shadow-inner max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-base font-bold text-[#003B7A] uppercase flex items-center gap-2">
            {{-- কন্ডিশনে .id যোগ করা হয়েছে --}}
            <i class="fas" :class="editingMember.id ? 'fa-user-edit' : 'fa-user-plus'"></i>
            <span x-text="editingMember.id ? 'Edit Team Member' : 'Create New Team Member Account'"></span>
        </h3>
        {{-- ক্যানসেল করলে ডাটা রিসেট হবে --}}
        <button @click="editingMember = { id: null, name: '', phone: '', email: '' }; teamView = 'list'" class="text-red-500 text-sm font-bold hover:underline">Cancel</button>
    </div>

    {{-- ফর্ম অ্যাকশনে .id চেক করা হয়েছে --}}
    <form :action="editingMember.id ? '/team/update/' + editingMember.id : '{{ route('affiliated.register') }}'" method="POST">
        @csrf
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm animate-hero-text">
                <div class="flex items-center mb-2">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                    <h4 class="text-red-800 font-bold text-xs uppercase tracking-widest">ভুলগুলো ঠিক করুন</h4>
                </div>
                <ul class="list-disc list-inside text-red-700 text-xs space-y-1 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
       <input type="hidden" name="id" x-model="editingMember.id">
        <template x-if="editingMember.id">
            <input type="hidden" name="_method" value="PUT">
        </template>

        <input type="hidden" name="is_from_leader" value="1">

        <div class="space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="text-sm font-bold text-gray-500 uppercase mb-2 block tracking-widest">Member Name</label>
                    {{-- x-model থেকে Ternary Operator ( ? : ) সরিয়ে সরাসরি ভেরিয়েবল দেওয়া হয়েছে এরর বন্ধ করতে --}}
                    <input type="text" name="name" required x-model="editingMember.name"
                        class="w-full border border-gray-300 px-4 py-2.5 text-base focus:border-[#003B7A] outline-none rounded-xl bg-white">
                </div>
                <div>
                    <label class="text-sm font-bold text-gray-500 uppercase mb-2 block tracking-widest">Phone Number</label>
                    <input type="tel" name="phone" required
                        x-model="editingMember.phone"
                        @input="editingMember.phone = $event.target.value.replace(/[^\d+]/g, '')"
                        class="w-full border border-gray-300 px-4 py-2.5 text-base focus:border-[#003B7A] outline-none rounded-xl bg-white">
                </div>
            </div>

            <div>
                <label class="text-sm font-bold text-gray-500 uppercase mb-2 block tracking-widest">Email Address</label>
                <input type="email" name="email" required x-model="editingMember.email"
                    class="w-full border border-gray-300 px-4 py-2.5 text-base focus:border-[#003B7A] outline-none rounded-xl bg-white">
            </div>

            <div>
                <label class="text-sm font-bold text-gray-500 uppercase mb-2 block tracking-widest">
                    <span x-text="editingMember.id ? 'New Password (Leave blank to keep same)' : 'Initial Password'"></span>
                </label>
                <input type="password" name="password" :required="!editingMember.id"
                    class="w-full border border-gray-300 px-4 py-2.5 text-base focus:border-[#003B7A] outline-none rounded-xl bg-white">
            </div>

            <div class="pt-4 flex flex-col gap-3">
                <button type="submit"
                    class="w-full bg-[#003B7A] text-white py-4 rounded-2xl font-bold text-base uppercase tracking-widest hover:bg-[#002a58] transition-all shadow-lg">
                    <span x-text="editingMember.id ? 'Update Member Account' : 'Generate Member Account'"></span>
                </button>
            </div>
        </div>
    </form>
</div>
