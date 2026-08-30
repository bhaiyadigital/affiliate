<div x-show="showViewModal" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    style="display: none;">

    <div class="absolute inset-0 bg-black/50" @click="showViewModal = false"></div>

    <div class="relative bg-white w-full max-w-lg rounded-xl shadow-xl overflow-hidden"
        x-show="showViewModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100">

        <div class="bg-[#003B7A] px-6 py-4 flex justify-between items-center">
            <h3 class="text-white font-bold text-lg">Lead Details</h3>
            <button @click="showViewModal = false" class="text-white hover:text-gray-200">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <div class="p-6 space-y-4" x-show="viewingLead">
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase block">Customer Name</span>
                <span class="text-base font-bold text-gray-800" x-text="viewingLead?.name"></span>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase block">Phone</span>
                    <span class="text-sm text-gray-700" x-text="viewingLead?.phone"></span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase block">Source</span>
                    <span class="text-sm text-gray-700 uppercase" x-text="viewingLead?.type"></span>
                </div>
            </div>

            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase block">Interested Location</span>
                <span class="text-sm text-gray-700" x-text="viewingLead?.interested_location"></span>
            </div>

            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase block">Status</span>
                <span class="text-sm text-gray-700" x-text="viewingLead?.status_label"></span>
            </div>

            {{-- Remarks - only show if exists --}}
            <div x-show="viewingLead?.remarks">
                <span class="text-[10px] font-bold text-gray-400 uppercase block">Remarks</span>
                <p class="text-sm text-gray-700 whitespace-pre-line bg-gray-50 border border-gray-100 rounded-lg p-3 mt-1"
                    x-text="viewingLead?.remarks"></p>
            </div>

            {{-- Commission - only show if exists --}}
            <div x-show="viewingLead?.commission_amount">
                <span class="text-[10px] font-bold text-gray-400 uppercase block">Commission</span>
                <p class="text-sm text-gray-700 bg-gray-50 border border-gray-100 rounded-lg p-3 mt-1">
                    ৳<span x-text="viewingLead?.commission_amount"></span>
                </p>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
            <button @click="showViewModal = false"
                class="bg-white border border-gray-300 text-gray-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-gray-100 transition-colors">
                Close
            </button>
        </div>
    </div>
</div>