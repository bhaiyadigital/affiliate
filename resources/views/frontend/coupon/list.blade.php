<!-- ── My Coupons List (Responsive Wrapper) ── -->
<div class="mt-4">

    @php
        $myCoupons = \App\Models\Content::where('module', 'coupons')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
    @endphp

    <!-- ১. Desktop Table View (বড় স্ক্রিনে দেখাবে) -->
    <div class="hidden md:block overflow-hidden border border-gray-100 rounded-xl bg-white shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase border-b">
                <tr>
                    <th class="px-6 py-4">Coupon Info</th>
                    <th class="px-6 py-4 text-center">Validity</th>
                    <th class="px-6 py-4 text-center">Usage</th>
                    <th class="px-6 py-4 text-center">User Limit</th>
                    <th class="px-6 py-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($myCoupons as $coupon)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm text-blue-600 font-black tracking-widest uppercase" id="cpn-{{ $coupon->id }}">
                                    {{ $coupon->slug }}
                                </span>
                                <span class="text-xs text-gray-500 font-medium">{{ $coupon->title }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="text-xs text-gray-700 font-bold">
                                {{ $coupon->start_date ? $coupon->start_date->format('d M y') : 'N/A' }}
                                <i class="fas fa-arrow-right mx-1 text-gray-300"></i>
                                {{ $coupon->end_date ? $coupon->end_date->format('d M y') : 'N/A' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm font-black text-[#003B7A]">
                                {{ $coupon->used_count }} / {{ $coupon->views == 0 ? '∞' : $coupon->views }}
                            </span>
                            <p class="text-[10px] text-gray-400 uppercase font-bold">Redeemed</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded text-[10px] font-black border border-blue-100 uppercase">
                                {{ $coupon->name }} Times
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <button type="button" onclick="copyCouponToClipboard('cpn-{{ $coupon->id }}', this)" class="text-gray-400 hover:text-blue-600"><i class="fas fa-copy"></i></button>
                                <button type="button" @click="couponView = 'form'; editingCoupon = @js([
                                    'id' => $coupon->id, 'title' => $coupon->title, 'slug' => $coupon->slug,
                                    'start_date' => $coupon->start_date ? $coupon->start_date->format('Y-m-d\TH:i') : '',
                                    'end_date' => $coupon->end_date ? $coupon->end_date->format('Y-m-d\TH:i') : '',
                                    'name' => $coupon->name, 'views' => $coupon->views,
                                ])" class="text-gray-400 hover:text-amber-500"><i class="fas fa-edit"></i></button>
                                <form action="{{ route('coupons.destroy', $coupon->slug) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">No coupons found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ২. Mobile Card View (মোবাইলে একটির নিচে একটি কার্ড দেখাবে) -->
    <div class="md:hidden space-y-4">
        @forelse($myCoupons as $coupon)
            <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm relative overflow-hidden">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <span class="text-base text-blue-600 font-black tracking-widest uppercase block" id="cpn-mob-{{ $coupon->id }}">
                            {{ $coupon->slug }}
                        </span>
                        <span class="text-xs text-gray-500">{{ $coupon->title }}</span>
                    </div>
                    <div class="flex gap-3">
                         <button type="button" onclick="copyCouponToClipboard('cpn-mob-{{ $coupon->id }}', this)" class="text-blue-500 text-sm"><i class="fas fa-copy"></i></button>
                         <button type="button" @click="couponView = 'form'; editingCoupon = @js([
                            'id' => $coupon->id, 'title' => $coupon->title, 'slug' => $coupon->slug,
                            'start_date' => $coupon->start_date ? $coupon->start_date->format('Y-m-d\TH:i') : '',
                            'end_date' => $coupon->end_date ? $coupon->end_date->format('Y-m-d\TH:i') : '',
                            'name' => $coupon->name, 'views' => $coupon->views,
                        ])" class="text-amber-500 text-sm"><i class="fas fa-edit"></i></button>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 py-3 border-y border-gray-50 mb-3">
                    <div>
                        <p class="text-[9px] text-gray-400 font-bold uppercase">Usage</p>
                        <span class="text-sm font-black text-gray-700">{{ $coupon->used_count }} / {{ $coupon->views == 0 ? '∞' : $coupon->views }}</span>
                    </div>
                    <div class="text-right">
                        <p class="text-[9px] text-gray-400 font-bold uppercase">User Limit</p>
                        <span class="text-xs font-bold text-gray-600">{{ $coupon->name }} Times</span>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <div class="text-[10px] text-gray-500 font-bold">
                        <i class="far fa-calendar-alt mr-1"></i>
                        {{ $coupon->start_date ? $coupon->start_date->format('d M') : 'N/A' }} -
                        {{ $coupon->end_date ? $coupon->end_date->format('d M y') : 'N/A' }}
                    </div>
                    <form action="{{ route('coupons.destroy', $coupon->slug) }}" method="POST" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-400 text-xs font-bold uppercase">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-8 text-center text-gray-400 italic bg-white rounded-xl border">No coupons found.</div>
        @endforelse
    </div>
</div>
<script>
    function copyCouponToClipboard(elementId, btn) {
        const codeElement = document.getElementById(elementId);
        if (!codeElement) return;

        const textToCopy = codeElement.innerText.trim();

        navigator.clipboard.writeText(textToCopy).then(() => {
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check text-green-500"></i> COPIED!';
            btn.style.color = '#10b981';

            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.style.color = '#003B7A';
            }, 2000);
        }).catch(err => {
            console.error('Copy failed: ', err);
            alert('কপি করা সম্ভব হয়নি। ম্যানুয়ালি কপি করুন।');
        });
    }
</script>
