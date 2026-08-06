<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\DownloadLog;
use App\Models\Lead;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            'name'             => 'required|string|max:255',
            'phone'            => 'nullable|string|max:255',
            'avatar'           => 'nullable|image',
            'current_password' => 'nullable|required_with:new_password',
            'new_password'     => 'nullable|min:6|confirmed',
        ]);

        $successMessage = 'Profile updated successfully.';

        // নাম ও ফোন আপডেট
        $user->name = $request->name;
        $user->phone = $request->phone;

        // ইমেজ আপলোড লজিক (আগের মতো)
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        // পাসওয়ার্ড পরিবর্তন লজিক এবং স্পেসিফিক মেসেজ সেট করা
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'বর্তমান পাসওয়ার্ডটি সঠিক নয়।']);
            }
            $user->password = Hash::make($request->new_password);

            // পাসওয়ার্ড চেঞ্জ হলে মেসেজ পাল্টে যাবে
            $successMessage = 'Password changed successfully.';
        }

        $user->save();

        // 'active_tab' পাঠানো হচ্ছে যাতে আপনি প্রোফাইল পেজেই থাকেন
        return back()->with([
            'success' => $successMessage,
            'active_tab' => 'profile'
        ]);
    }
    public function register(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => 'required|email|unique:users,email',
            'phone'    => ['required', 'string', 'unique:users,phone', 'regex:/^\+?[0-9]+$/'],
            'password' => ['required', 'min:6'],
        ]);

        $otp = rand(100000, 999999);
        $user = User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'password'       => Hash::make($request->password),
            'referral_code'  => 'BH-' . strtoupper(Str::random(6)),
            'parent_id'      => auth()->check() ? auth()->id() : null,
            'status'         => 'inactive',
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OTPMail($otp, 'register'));

        session(['verify_email' => $user->email, 'otp_purpose' => 'register']);

        return back()->with('success', 'রেজিস্ট্রেশন সফল! আপনার ইমেইলে ভেরিফিকেশন কোড পাঠানো হয়েছে।');
    }

    public function sendResetOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();
        $otp = rand(100000, 999999);

        $user->update([
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(10)
        ]);

        Mail::to($user->email)->send(new OTPMail($otp, 'reset_password'));

        session(['verify_email' => $user->email, 'otp_purpose' => 'reset_password']);
        return back()->with('success', 'আপনার ইমেইলে পাসওয়ারড রিসেট কোড পাঠানো হয়েছে।');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required']);
        $email = session('verify_email');

        $user = User::where('email', $email)->where('otp_code', $request->otp)->first();

        if (!$user || now()->gt($user->otp_expires_at)) {
            return back()->with('error', 'ভুল ওটিপি অথবা মেয়াদের সময় শেষ হয়ে গেছে!');
        }

        if (session('otp_purpose') === 'register') {
            $user->update(['status' => 'active', 'phone_verified_at' => now(), 'otp_code' => null]);
            Auth::login($user);
            session()->forget(['verify_email', 'otp_purpose']);
            return redirect()->route('profile.index');
        }

        if (session('otp_purpose') === 'reset_password') {
            session(['can_reset_password' => true]);
            return back()->with('success', 'ইমেইল ভেরিফাইড! এখন নতুন পাসওয়ার্ড দিন।');
        }
    }

    public function resendOtp()
    {
        $email = session('verify_email');
        if (!$email) return back();

        $otp = rand(100000, 999999);
        $user = User::where('email', $email)->first();

        $user->update([
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(10)
        ]);

        Mail::to($email)->send(new OTPMail($otp, session('otp_purpose')));

        return back()->with('success', 'নতুন কোড পাঠানো হয়েছে।');
    }

    public function finalPasswordUpdate(Request $request)
    {
        $request->validate(['password' => 'required|min:6|confirmed']);

        User::where('email', session('verify_email'))->update([
            'password' => Hash::make($request->password),
            'otp_code' => null,
            'otp_expires_at' => null
        ]);

        session()->forget(['verify_email', 'otp_purpose', 'can_reset_password']);
        return redirect()->route('landing.index')->with('success', 'পাসওয়ারড সফলভাবে পরিবর্তন হয়েছে। লগইন করুন।');
    }

    public function cancelAuth()
    {
        session()->forget(['verify_email', 'otp_purpose', 'can_reset_password']);
        return back();
    }
    public function affiliatedLogin(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            if (auth()->user()->status !== 'active') {
                Auth::logout();
                session(['verify_email' => $request->email, 'otp_purpose' => 'register']);
                return back()->with('error', 'আপনার একাউন্টটি ভেরিফাই করা নেই। ওটিপি দিন।');
            }

            return redirect()->route('profile.index');
        }

        return back()->withInput()->withErrors(['email' => 'ভুল ইমেইল বা পাসওয়ার্ড।']);
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
            'team_view'   => 'list'
        ]);
    }
}
