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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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

        $user->name = $request->name;
        $user->phone = $request->phone;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }
        $remoteData = ['name' => $request->name];

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'বর্তমান পাসওয়ার্ডটি সঠিক নয়।']);
            }
            $newHash = Hash::make($request->new_password);
            $user->password = $newHash;
            $remoteData['password'] = $newHash;
        }

        $user->save();

        try {
            DB::connection('asset_db')->table('users')
                ->where('email', $user->email)
                ->update($remoteData);
        } catch (\Exception $e) {
            Log::error("Remote Profile Update Failed: " . $e->getMessage());
        }
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

        $isSuperAdminAction = auth()->check() && auth()->user()->isSuperAdmin();
        $hashedPassword = Hash::make($request->password);

        $status = $isSuperAdminAction ? 'active' : 'inactive';
        $verifiedAt = $isSuperAdminAction ? now() : null;
        $otp = $isSuperAdminAction ? null : rand(100000, 999999);

        $user = User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'password'       => $hashedPassword,
            'referral_code'  => 'BH-' . strtoupper(Str::random(6)),
            'parent_id'      => auth()->check() ? auth()->id() : null,
            'status'         => $status,
            'email_verified_at' => $verifiedAt,
            'otp_code'       => $otp,
            'otp_expires_at' => $isSuperAdminAction ? null : now()->addMinutes(10),
        ]);

        try {
            $remoteUserId = DB::connection('asset_db')->table('users')->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $hashedPassword,
                'status' => 'active',
                'source' => 'affiliate',
                'email_verified_at' => $verifiedAt,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $role = DB::connection('asset_db')->table('roles')->where('name', 'frontend_user')->first();
            if ($role) {
                DB::connection('asset_db')->table('user_roles')->insert(['user_id' => $remoteUserId, 'role_id' => $role->id]);
            }
        } catch (\Exception $e) {
            Log::error("Remote Sync Failed: " . $e->getMessage());
        }

        if (!$isSuperAdminAction) {
            Mail::to($user->email)->send(new OTPMail($otp, 'register'));
        }

        if (auth()->check()) {
            return back()->with([
                'success' => $isSuperAdminAction ? 'মেম্বার সরাসরি যুক্ত হয়েছে।' : 'মেম্বার যুক্ত হয়েছে, লগইনের সময় তাকে ভেরিফাই করতে হবে।',
                'active_tab' => 'team',
                'team_view'  => 'list'
            ]);
        }

        session(['verify_email' => $user->email, 'otp_purpose' => 'register']);
        return back()->with('success', 'রেজিস্ট্রেশন সফল! ইমেইলে ওটিপি পাঠানো হয়েছে।');
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
            return back()->with('error', 'ভুল ওটিপি অথবা মেয়াদের সময় শেষ!');
        }

        if (session('otp_purpose') === 'register') {
            // এখানে email_verified_at আপডেট করা হলো যেহেতু ইমেইল দিয়ে ভেরিফাই হচ্ছে
            $user->update([
                'status'            => 'active',
                'email_verified_at' => now(), // ফোনের বদলে ইমেইল ভেরিফাইড মার্ক করুন
                'otp_code'          => null,
                'otp_expires_at'    => null
            ]);

            // রিমোট সাইটে (Asset Site) সিঙ্ক করা
            try {
                DB::connection('asset_db')->table('users')
                    ->where('email', $email)
                    ->update(['email_verified_at' => now()]);
            } catch (\Exception $e) {
                Log::error("Remote Email Verification Sync Failed: " . $e->getMessage());
            }

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
        $newHash = Hash::make($request->password);
        $email = session('verify_email');

        // ১. লোকাল ডাটাবেস আপডেট
        User::where('email', $email)->update([
            'password' => $newHash,
            'otp_code' => null,
            'otp_expires_at' => null
        ]);

        // ২. রিমোট ডাটাবেস (Asset Site) আপডেট করা (এটি আগে ছিল না)
        try {
            DB::connection('asset_db')->table('users')
                ->where('email', $email)
                ->update(['password' => $newHash]);
        } catch (\Exception $e) {
            Log::error("Remote Password Reset Sync Failed: " . $e->getMessage());
        }

        session()->forget(['verify_email', 'otp_purpose', 'can_reset_password']);
        return redirect()->route('landing.index')->with('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন হয়েছে। লগইন করুন।');
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
            $user = auth()->user();

            if (!$user->email_verified_at) {

                if (!$user->otp_code) {
                    $otp = rand(100000, 999999);
                    $user->update([
                        'otp_code' => $otp,
                        'otp_expires_at' => now()->addMinutes(10)
                    ]);
                    Mail::to($user->email)->send(new OTPMail($otp, 'register'));
                }

                Auth::logout();
                session(['verify_email' => $user->email, 'otp_purpose' => 'register']);

                return back()->with('success', 'আপনার একাউন্টটি ভেরিফাই করা নেই। ইমেইলে পাঠানো ওটিপি দিন।');
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
    public function portalRedirect()
    {
        $user = auth()->user();
        $secret = env('PORTAL_SECRET_KEY');

        $signature = hash_hmac('sha256', $user->email, $secret);

        $baseUrl = env('ASSET_WEBSITE_URL');

        $url = $baseUrl . "/auto-login?email=" . urlencode($user->email) . "&signature=" . $signature;

        return redirect()->away($url);
    }
}
