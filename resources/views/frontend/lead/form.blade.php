<div x-show="showLeadModal" x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto"
     style="display: none;">

    <!-- Background Drop / Overlay -->
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"
         @click="showLeadModal = false"
         x-show="showLeadModal"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <!-- Modal Dialog Content -->
    <div class="relative bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden my-8 z-10"
         x-show="showLeadModal"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-4">

        <!-- Modal Header -->
        <div class="bg-[#003B7A] px-6 py-4 flex justify-between items-center text-white">
            <div>
                <h3 class="font-bold text-lg" x-text="viewOnly ? 'Lead Details' : (editingLead && editingLead.id ? 'Update Lead Details' : 'Submit New Lead')"></h3>
                <p class="text-blue-200 text-xs mt-0.5">Please provide accurate information about the potential client.</p>
            </div>
            <button type="button" @click="showLeadModal = false" class="text-white hover:text-red-300 p-1 transition-colors text-xl leading-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body / Form -->
        <div class="p-6 md:p-8 max-h-[80vh] overflow-y-auto">
            <form :action="editingLead && editingLead.id ? '{{ url('leads') }}/' + editingLead.id : '{{ route('lead.store') }}'" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm">
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
                <input type="hidden" name="id" x-model="editingLead.id">
                <template x-if="editingLead && editingLead.id">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                <input type="hidden" name="type" value="manual">

                <div class="space-y-5">
                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase mb-1 block">Customer Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" :disabled="viewOnly" required x-model="editingLead.name" placeholder="Full Name"
                            class="w-full border border-gray-300 px-4 py-2.5 text-sm rounded-xl focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A] outline-none bg-white">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase mb-1 block">Phone Number <span class="text-red-500">*</span></label>
                        <input type="tel" name="phone" :disabled="viewOnly" required x-model="editingLead.phone" placeholder="01XXXXXXXXX"
                            class="w-full border border-gray-300 px-4 py-2.5 text-sm rounded-xl focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A] outline-none bg-white">
                    </div>
                    {{-- Email Address Field --}}
                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase mb-1 block">Email Address (Optional)</label>
                        <input type="email" name="email" :disabled="viewOnly" x-model="editingLead.email" placeholder="customer@example.com"
                            class="w-full border px-4 py-2.5 text-sm rounded-xl outline-none bg-white focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A] @error('email') border-red-500 @else border-gray-300 @enderror">
                        @error('email')
                            <span class="text-red-500 text-[10px] font-bold uppercase mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-gray-600 uppercase mb-1 block">Project</label>
                            <select name="interested_location" :disabled="viewOnly" x-model="editingLead.interested_location"
                                class="w-full border border-gray-300 px-4 py-2.5 text-sm rounded-xl focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A] outline-none bg-white">
                                <option value="">Select Project</option>
                                @foreach ($shared_projects as $project)
                                    <option value="{{ $project->title }}">{{ $project->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-600 uppercase mb-1 block">Budget (Optional)</label>
                            <input type="number" name="budget" :disabled="viewOnly" min="1" x-model="editingLead.budget" placeholder="Budget"
                                class="w-full border border-gray-300 px-4 py-2.5 text-sm rounded-xl focus:ring-2 focus:ring-[#003B7A] focus:border-[#003B7A] outline-none bg-white">
                        </div>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="button" @click="showLeadModal = false"
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-xl font-bold text-sm uppercase transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="flex-1 bg-[#003B7A] text-white py-3 rounded-xl font-bold text-sm uppercase tracking-wider hover:bg-blue-900 transition-all shadow-md">
                            <span x-text="editingLead && editingLead.id ? 'Update Lead' : 'Submit Lead'"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
