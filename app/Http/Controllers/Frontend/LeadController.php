<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeadController extends Controller
{
    public function storeLead(Request $request)
    {

        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'min:7',
                'max:20',
                'regex:/^\+?[0-9]+$/',
            ],
            'budget' => 'nullable|numeric|min:0',
        ], [
            'phone.regex' => 'সঠিক ফোন নাম্বার দিন ।',
            'phone.min'   => 'ফোন নাম্বারটি অন্তত ৭ ডিজিটের হতে হবে।',
        ]);


        if (Lead::where('phone', $request->phone)->whereIn('status', [1, 2, 3, 4])->exists()) {
            return back()->with('error', 'এই নম্বরটি দিয়ে ইতিমধ্যে একটি লিড প্রক্রিয়াধীন আছে।')->withInput();
        }

        $type = $request->input('type', 'refer_link');
        $ownerId = null;

        $refCode = $request->input('ref') ?? ($request->query('ref') ?? $request->cookie('referred_by'));
        $ownerId = null;

        if (auth()->check() && $request->input('type') === 'manual') {
            $ownerId = auth()->id();
        } elseif ($refCode) {
            $foundUser = User::where('referral_code', $refCode)->first();
            if ($foundUser) {
                $ownerId = $foundUser->id;
            }
        }

        if (!$ownerId) {
            return back()->with('error', 'সঠিক রেফারেল কোড পাওয়া যায়নি। মেইন লিঙ্কে ক্লিক করুন।');
        }

        $ownerUser = User::find($ownerId);
        $leaderId = $ownerUser ? $ownerUser->parent_id : null;

        $validCoupon = null;
        if ($request->filled('coupon_code')) {
            $couponInput = \Illuminate\Support\Str::slug(trim($request->coupon_code));
            $coupon = Content::where('module', 'coupons')->where('slug', $couponInput)->first();
            if ($coupon && $coupon->isCouponValid()['status'] && !$coupon->isUserLimitReached($request->phone)) {
                $validCoupon = $coupon->slug;
                // কাউন্ট বাড়ানো
                $extra = $coupon->extra ?? [];
                $extra['used_count'] = ($extra['used_count'] ?? 0) + 1;
                $coupon->update(['extra' => $extra]);
            }
        }

        // ৭. লিড সেভ
        Lead::create([
            'user_id'             => $ownerId,
            'referrer_id'         => $leaderId,
            'name'                => $request->name,
            'phone'               => $request->phone,
            'interested_location' => $request->interested_location,
            'budget'              => $request->budget,
            'coupon_code'         => $validCoupon,
            'status'              => Lead::STATUS_PENDING,
            'type'                => $type,
        ]);

        return back()->with([
            'success' => 'আপনার তথ্য সফলভাবে জমা হয়েছে।',
            'active_tab' => 'leads',
            'lead_view' => 'list'
        ]);
    }
    public function updateLead(Request $request, Lead $lead)
    {
        if ($lead->user_id !== auth()->id()) abort(403);

        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'interested_location' => 'nullable|string|max:255',
            'budget' => 'nullable|numeric|min:0', // এখানেও min:0 যোগ করে দিন
        ]);

        $lead->update($request->all());

        // --- এই অংশটি পরিবর্তন করুন ---
        return back()->with([
            'success' => 'Lead updated successfully!',
            'active_tab' => 'leads' // এই সিগন্যালটি ট্যাব ধরে রাখবে
        ]);
    }

    public function destroyLead(Lead $lead)
    {
        if ($lead->user_id !== auth()->id()) abort(403);
        $lead->delete();

        return back()->with('success', 'Lead deleted successfully!');
    }
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Lead::with('user');

        if (!$user->isSuperAdmin()) {

            $myTeamUserIds = User::where('parent_id', $user->id)->pluck('id')->toArray();

            $query->where(function ($q) use ($user, $myTeamUserIds) {
                $q->where('user_id', $user->id)
                    ->orWhere('referrer_id', $user->id)
                    ->orWhereIn('user_id', $myTeamUserIds);
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // ৩. ফিল্টার: টাইপ (Type - Manual/Refer Link)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // ৪. ফিল্টার: নাম দিয়ে সার্চ (Search by Name)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $leads = $query->latest()
            ->paginate(10)
            ->withQueryString();

        $statusLabels = Lead::statusLabels();

        return view('leads.index', compact('leads', 'statusLabels'));
    }
    /**
     * এডিট ফর্ম
     */
    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        $statusLabels = Lead::statusLabels();

        return view('leads.edit', compact('lead', 'statusLabels'));
    }

    /**
     * lead update
     */
    public function update(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);

        $validated = $request->validate([
            'name'                => 'required|string|max:255',
            'phone'               => [
                'required',
                'string',
                'min:7',
                'max:20',
                'regex:/^\+?[0-9]+$/',
            ],
            'interested_location' => 'nullable|string|max:255',
            'budget'              => 'nullable|numeric',
            'status'              => ['required', Rule::in([1, 2, 3, 4, 5])],
        ], [
            'phone.regex' => 'ফোন নাম্বারে শুধুমাত্র সংখ্যা এবং শুরুতে + চিহ্ন ব্যবহার করা যাবে।',
        ]);


        $lead->update($validated);

        return redirect()->route('admin.leads.index')
            ->with('success', 'লিড সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * updatestatus
     */
    public function updateStatus(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);

        $request->validate([
            'status' => ['required', Rule::in([1, 2, 3, 4, 5])]
        ]);

        $lead->update(['status' => $request->status]);

        return response()->json([
            'success'      => true,
            'message'      => 'স্ট্যাটাস পরিবর্তন হয়েছে: ' . $lead->status_label,
            'status_label' => $lead->status_label
        ]);
    }

    /**
     * (Soft Delete)
     */
    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return redirect()->route('admin.leads.index')
            ->with('success', 'লিডটি ডিলিট করা হয়েছে।');
    }


    public function storeCoupon(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'slug'       => 'required|string|unique:contents,slug',
            'short'      => 'nullable|string',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after:start_date',
            'name'       => 'required|integer|min:1', // Usage Limit Per User
            'views'      => 'required|integer|min:0', // Total Usage Limit
        ]);

        Content::create([
            'module'     => 'coupons',
            'user_id'    => auth()->id(),
            'title'      => $request->title,
            'slug'       => \Illuminate\Support\Str::slug($request->slug),
            'short'      => $request->short,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'name'       => $request->name,  // User Limit
            'views'      => $request->views, // Total Limit
            'status'     => 1,
        ]);

        return redirect()->route('profile.index')->with([
            'success' => 'Coupon generated successfully!',
            'active_tab' => 'coupons',
            'coupon_view' => 'list'
        ]);
    }
    // ১. কুপন আপডেট মেথড
    public function updateCoupon(Request $request, $id)
    {
        // স্ল্যাগ এবং ইউজার আইডি দিয়ে কুপনটি খুঁজে বের করা
        $coupon = Content::where('module', 'coupons')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $request->validate([
            'title'      => 'required|string|max:255',
            'slug'       => 'required|string|unique:contents,slug,' . $coupon->id, // নিজের স্ল্যাগ বাদ দিয়ে ইউনিক চেক
            'short'      => 'nullable|string',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after:start_date',
            'name'       => 'required|integer|min:1',
            'views'      => 'required|integer|min:0',
        ]);

        $coupon->update([
            'title'      => $request->title,
            'slug'       => \Illuminate\Support\Str::slug($request->slug),
            'short'      => $request->short,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'name'       => $request->name,
            'views'      => $request->views,
        ]);

        return redirect()->route('profile.index')->with([
            'success' => 'Coupon updated successfully!',
            'active_tab' => 'coupons',
            'coupon_view' => 'list'
        ]);
    }

    // ২. কুপন ডিলিট মেথড
    public function destroyCoupon($slug)
    {
        $coupon = Content::where('module', 'coupons')
            ->where('slug', $slug)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $coupon->delete();

        return redirect()->route('profile.index')->with([
            'success' => 'Coupon deleted successfully!',
            'active_tab' => 'coupons'
        ]);
    }
}
