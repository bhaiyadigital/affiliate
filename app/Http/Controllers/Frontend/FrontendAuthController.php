<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DownloadLog;
use App\Models\Lead;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FrontendAuthController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $downloadLogs = DownloadLog::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get();

        $leadQuery = Lead::with('user');

        if (!$user->isSuperAdmin()) {
            $myTeamUserIds = User::where('parent_id', $user->id)->pluck('id')->toArray();

            $leadQuery->where(function ($q) use ($user, $myTeamUserIds) {
                $q->where('user_id', $user->id)
                    ->orWhere('referrer_id', $user->id)
                    ->orWhereIn('user_id', $myTeamUserIds);
            });
        }

        if (request()->filled('member_id')) {
            $leadQuery->where('user_id', request('member_id'));
        }

        if (request()->filled('status')) {
            $leadQuery->where('status', request('status'));
        }

        $leads = $leadQuery->latest()->paginate(10)->withQueryString();

        $members = $user->isSuperAdmin()
            ? User::orderBy('name')->get()
            : User::where('parent_id', $user->id)->orWhere('id', $user->id)->orderBy('name')->get();

        return view('frontend.auth.profile', compact('downloadLogs', 'leads', 'members'));
    }
    //profile update
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;

        if ($request->hasFile('avatar')) {
            if ($user->getAttributes()['avatar']) {
                Storage::disk('public')->delete($user->getAttributes()['avatar']);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['nullable', 'email', 'unique:users,email'],
            'phone' => ['required', 'string', 'unique:users,phone', 'regex:/^\+?[0-9]+$/'],
            'password' => ['required', 'min:6'],
        ]);
        $parentId = null;
        if (auth()->check()) {
            $parentId = auth()->id();
        } else {
            $refCode = $request->cookie('referred_by');
            if ($refCode) {
                try {
                    $decodedId = base_convert($refCode, 36, 10) - 50000;
                    $parentId = ($decodedId > 0) ? User::where('id', $decodedId)->value('id') : null;
                } catch (\Exception $e) {
                    $parentId = null;
                }
            }
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'password'  => Hash::make($request->password),
            'referral_code' => 'BH-' . strtoupper(Str::random(6)),
            'parent_id' => $parentId,
            'status'    => 'active',
        ]);

        if (auth()->check()) {
            return back()->with([
                'success' => 'নতুন টিম মেম্বার একাউন্ট সফলভাবে তৈরি হয়েছে।',
                'active_tab' => 'team',
                'team_view'  => 'list'
            ]);
        }

        Auth::login($user);
        return redirect()->route('profile.index');
    }

    public function affiliatedLogin(Request $request)
    {
        $request->validate([
            'phone'    => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return redirect()->route('profile.index');
        }

        return back()->withInput()->withErrors(['phone' => 'ভুল মোবাইল নম্বর বা পাসওয়ার্ড।']);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing.index');
    }
    public function updateMember(Request $request, $id)
    {
        $member = User::where('id', $id)->where('parent_id', auth()->id())->firstOrFail();

        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $member->update([
            'name'  => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $member->update(['password' => Hash::make($request->password)]);
        }

        return back()->with([
            'success'     => 'মেম্বারের তথ্য আপডেট করা হয়েছে।',
            'active_tab'  => 'team',
            'team_view'   => 'list' // আপডেট শেষে লিস্টে ফেরত পাঠাবে
        ]);
    }
}
