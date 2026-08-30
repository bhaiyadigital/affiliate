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
        // ১. ভ্যালিডেশন
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => [
                'required',
                'string',
                'min:7',
                'max:20',
                'phone'    => ['required', 'string', 'unique:users,phone', 'regex:/^\+?[0-9]+(?:-[0-9]+)*$/'],
            ],
            'budget' => 'nullable|numeric|min:0',
        ], [
            'phone.regex' => 'সঠিক ফোন নাম্বার দিন ।',
            'phone.min'   => 'ফোন নাম্বারটি অন্তত ৭ ডিজিটের হতে হবে।',
        ]);

        $duplicateQuery = Lead::whereIn('status', [1, 2, 3, 4])
            ->where(function ($q) use ($request) {
                $q->where('phone', $request->phone);
                if ($request->filled('email')) {
                    $q->orWhere('email', $request->email);
                }
            })->first();

        if ($duplicateQuery) {
            $errorMsg = $duplicateQuery->phone == $request->phone
                ? 'এই ফোন নম্বরটি দিয়ে ইতিমধ্যে একটি লিড আছে।'
                : 'এই ইমেলটি দিয়ে ইতিমধ্যে একটি লিড আছে।';

            return back()
                ->withErrors([
                    'phone' => ($duplicateQuery->phone == $request->phone) ? $errorMsg : null,
                    'email' => ($duplicateQuery->email == $request->email) ? $errorMsg : null,
                ])
                ->withInput()
                ->with([
                    'active_tab' => 'leads',
                    'lead_view'  => 'form'
                ]);
        }

        $ownerId = null;
        $validCoupon = null;
        $type = 'manual';

        $refCode = $request->input('ref') ?? ($request->query('ref') ?? $request->cookie('referred_by'));

        if (auth()->check() && $request->input('type') === 'manual') {
            $ownerId = auth()->id();
            $type = 'manual';
        } elseif ($refCode && $refCode !== 'null') {
            $foundUser = User::where('referral_code', $refCode)->first();
            if ($foundUser) {
                $ownerId = $foundUser->id;
                $type = 'refer_link';
            }
        }

        if ($request->filled('coupon_code')) {
            $couponInput = \Illuminate\Support\Str::slug(trim($request->coupon_code));
            $coupon = Content::where('module', 'coupons')->where('slug', $couponInput)->first();

            if ($coupon) {
                $validity = $coupon->isCouponValid();

                if ($validity['status'] && !$coupon->isUserLimitReached($request->phone)) {
                    $validCoupon = $coupon->slug;

                    if (!$ownerId) {
                        $ownerId = $coupon->user_id;
                        $type = 'coupon';
                    }

                    $extra = $coupon->extra ?? [];
                    $extra['used_count'] = (int)($extra['used_count'] ?? 0) + 1;
                    $coupon->extra = $extra; // ১. সরাসরি প্রপার্টিতে এসাইন করুন
                    $coupon->save();
                } else {
                    return back()->with('error', $validity['message'] ?? 'কুপনটি সঠিক নয় অথবা মেয়াদ শেষ।')->withInput();
                }
            } else {
                return back()->with('error', 'কুপন কোডটি আমাদের সিস্টেমে পাওয়া যায়নি।')->withInput();
            }
        }

        // ৫. বাধ্যতামূলক চেক: ওনার না থাকলে ডাটা সেভ হবে না (No Default Admin)
        if (!$ownerId) {
            return back()->with('error', 'তথ্য জমা দেওয়ার জন্য একটি সঠিক রেফারেল লিঙ্ক অথবা বৈধ কুপন কোড প্রয়োজন।')->withInput();
        }

        // ৬. লিডার (Leader) আইডি বের করা
        $ownerUser = User::find($ownerId);
        $leaderId = $ownerUser ? $ownerUser->parent_id : null;

        // ৭. ডাটা সেভ করা
        Lead::create([
            'user_id'             => $ownerId,
            'referrer_id'         => $leaderId,
            'name'                => $request->name,
            'email'               => $request->email,
            'phone'               => $request->phone,
            'interested_location' => $request->interested_location,
            'budget'              => $request->budget,
            'coupon_code'         => $validCoupon,
            'status'              => Lead::STATUS_PENDING,
            'type'                => $type,
        ]);
        $previousUrl = url()->previous();

        // ২. ইউআরএল থেকে কুয়েরি স্ট্রিং (? এর পরের অংশ) বাদ দেওয়া
        $cleanUrl = strtok($previousUrl, '?');


        return redirect($cleanUrl)->with([
            'success'    => 'আপনার তথ্য সফলভাবে গ্রহণ করা হয়েছে। আমাদের টিম শীঘ্রই আপনার সাথে যোগাযোগ করবে।',
            'active_tab' => 'leads',
            'lead_view'  => 'list'
        ])->withCookie(cookie()->forget('referred_by'));
    }
    public function updateLead(Request $request, Lead $lead)
    {
        if ((int) $lead->user_id !== (int) auth()->id()) {
            abort(403, 'Unauthorized.');
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => [
                'nullable',
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

        $lead->update($request->only(['name', 'email', 'phone', 'interested_location', 'budget']));
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
        // তারিখ ফিল্টার লজিক (Updated)
        if ($request->filled('date_range')) {
            $range = $request->date_range;

            if ($range == 'today') {
                $query->whereDate('created_at', today());
            } elseif ($range == '7_days') {
                $query->where('created_at', '>=', now()->subDays(7));
            } elseif ($range == '30_days') {
                $query->where('created_at', '>=', now()->subDays(30));
            } elseif ($range == 'this_month') {
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            } elseif ($range == 'custom' && $request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('created_at', [
                    \Carbon\Carbon::parse($request->start_date)->startOfDay(),
                    \Carbon\Carbon::parse($request->end_date)->endOfDay()
                ]);
            }
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
            'email'               => 'nullable|email|max:255',
            'phone'               => [
                'required',
                'string',
                'min:7',
                'max:20',
                'regex:/^\+?[0-9]+$/',
            ],
            'interested_location' => 'nullable|string|max:255',
            'budget'              => 'nullable|numeric',
            'remarks'              => 'nullable|',
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
    public function addCommission(Request $request, Lead $lead)
    {
        // Optional: only allow commission on completed leads
        if ($lead->status != 5) {
            return back()->with('error', 'Commission can only be added for completed leads.');
        }

        $validated = $request->validate([
            'commission_amount' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'commission_note'   => ['nullable', 'string', 'max:1000'],
        ]);

        $lead->update([
            'commission_amount' => $validated['commission_amount'],
            'commission_note'   => $validated['commission_note'] ?? null,
        ]);

        return back()->with('success', 'Commission added successfully for ' . $lead->name . '.');
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

        return redirect()->route('profile.index', 'coupons')->with([
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

        return redirect()->route('profile.index', 'coupons')->with([
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

        return redirect()->route('profile.index', 'coupons')->with([
            'success' => 'Coupon deleted successfully!',
            'active_tab' => 'coupons'
        ]);
    }
}
