<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\Content;
use App\Models\DownloadLog;
use App\Models\Lead;
use App\Models\Role;
use App\Models\User;
use App\Rules\ValidPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class FrontendAuthController extends Controller
{
    public function index(Request $request, $tab = 'dashboard')
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
        if ($request->filled('date_range')) {
            $range = $request->date_range;

            if ($range == 'today') {
                $leadQuery->whereDate('created_at', today());
            } elseif ($range == '7_days') {
                $leadQuery->where('created_at', '>=', now()->subDays(7));
            } elseif ($range == '30_days') {
                $leadQuery->where('created_at', '>=', now()->subDays(30));
            } elseif ($range == 'this_month') {
                $leadQuery->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            } elseif ($range == 'custom' && $request->filled('from') && $request->filled('to')) {
                $leadQuery->whereBetween('created_at', [
                    \Carbon\Carbon::parse($request->from)->startOfDay(),
                    \Carbon\Carbon::parse($request->to)->endOfDay()
                ]);
            }
        }
        // সার্চ লজিক যোগ করুন
        if ($request->filled('search')) {
            $search = $request->search;
            $leadQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('interested_location', 'like', "%$search%");
            });
        }
        $allLeads = (clone $leadQuery)->get();
        $leads = $leadQuery->latest()->paginate(10)->withQueryString();

        $members = $user->isSuperAdmin()
            ? User::orderBy('name')->get()
            : User::where('parent_id', $user->id)->orWhere('id', $user->id)->orderBy('name')->get();
        $projects = Content::where('module', 'project')
            ->where('status', 1)
            ->latest()
            ->get();
        return view('frontend.auth.profile', compact('downloadLogs', 'leads', 'members', 'allLeads', 'tab','projects'));
    }
    //profile update
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'             => 'required|string|max:255',
            'phone'            => 'nullable|string|max:255',
            new ValidPhoneNumber(),
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
                return back()->withErrors(['current_password' => 'বর্তমান পাসওয়ার্ডটি সঠিক নয়।'])->with('active_tab', 'profile');
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
            'phone'      => ['required', 'string', new ValidPhoneNumber(), 'unique:users,phone'],
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
            $remoteUser = DB::connection('asset_db')->table('users')->where('email', $request->email)->first();
            if (!$remoteUser) {
                $remoteUserId = DB::connection('asset_db')->table('users')->insertGetId([
                    'name'              => $request->name,
                    'email'             => $request->email,
                    'password'          => $hashedPassword,
                    'status'            => 'active',
                    'email_verified_at' => $verifiedAt,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);
            } else {
                $remoteUserId = $remoteUser->id;
                DB::connection('asset_db')->table('users')->where('id', $remoteUserId)->update([
                    'password'   => $hashedPassword,
                    'updated_at' => now(),
                ]);
            }
            $role = DB::connection('asset_db')->table('roles')->where('name', 'frontend_user')->first();
            if ($role) {
                DB::connection('asset_db')->table('user_roles')->updateOrInsert(
                    ['user_id' => $remoteUserId, 'role_id' => $role->id],
                    ['user_id' => $remoteUserId, 'role_id' => $role->id]
                );
            }
        } catch (\Exception $e) {
            Log::error("Remote Sync Failed: " . $e->getMessage());
        }

        if (!$isSuperAdminAction) {
            $this->sendOtp($user->email, $otp, $user->name, 'register');
        }

        if (auth()->check()) {
            return back()->with([
                'success' => $isSuperAdminAction ? 'মেম্বার সরাসরি যুক্ত হয়েছে।' : 'মেম্বার যুক্ত হয়েছে, লগইনের সময় তাকে ভেরিফাই করতে হবে।',
                'active_tab' => 'team',
                'team_view'  => 'list'
            ]);
        }

        session(['verify_email' => $user->email, 'otp_purpose' => 'register']);
        return redirect()->route('verify.otp')->with('success', 'রেজিস্ট্রেশন সফল! ইমেইলে ওটিপি পাঠানো হয়েছে।');
    }
    public function sendReset(Request $request)
    {
        return view('frontend.auth.forgot-password');
    }

    public function sendResetOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'এই ইমেইলটি আমাদের সিস্টেমে পাওয়া যায়নি।');
        }

        $otp = rand(100000, 999999);
        $user->update([
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(10)
        ]);

        $this->sendOtp($user->email, $otp, $user->name, 'reset_password');
        session(['verify_email' => $user->email, $user->name, 'otp_purpose' => 'reset_password']);

        return redirect()->route('verify.otp')->with('success', 'ওটিপি কোড পাঠানো হয়েছে।');
    }
    public function verifyOtpForm()
    {
        $email = session('verify_email');
        if (!$email) {
            return redirect()->route('home.index');
        }

        $user = User::where('email', $email)->first();

        // Carbon::parse ব্যবহার করে স্ট্রিং থেকে অবজেক্ট করা হচ্ছে
        $expiresAt = $user && $user->otp_expires_at
            ? \Carbon\Carbon::parse($user->otp_expires_at)->toIso8601String()
            : null;

        return view('frontend.landing.verifyOtp', compact('expiresAt'));
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
            return redirect()->route('verify.otp')->with('success', 'ইমেইল ভেরিফাইড! এখন নতুন পাসওয়ার্ড দিন।');
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

        $this->sendOtp($email, $otp, $user->name, session('otp_purpose'));

        return back()->with('success', 'নতুন কোড পাঠানো হয়েছে।');
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
        return redirect()->route('affiliated.login.page')->with('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন হয়েছে। লগইন করুন।');
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
                    $this->sendOtp($user->email, $otp, $user->name, 'register');
                }

                Auth::logout();
                session(['verify_email' => $user->email, 'otp_purpose' => 'register']);

                return redirect()->route('verify.otp')->with('success', 'আপনার একাউন্টটি ভেরিফাই করুন।');
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
        return redirect()->route('home.index');
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
    private function sendOtp($email, $otp, $name = 'User', $purpose = 'register')
    {
        if ($purpose === 'register') {
            $title = 'Account Verification';
            $message = " Bhaiya Affiliate Program-এ রেজিস্ট্রেশন করার জন্য আপনাকে ধন্যবাদ।\n\nআপনার একাউন্ট ভেরিফাই করতে নিচের কোডটি ব্যবহার করুন:\n\nকোড: " . $otp . "\n\nএই কোডটি ১০ মিনিটের জন্য কার্যকর।";
        } else {
            $title = 'Password Reset';
            $message = "আপনার পাসওয়ার্ড রিসেট করার জন্য একটি অনুরোধ পাওয়া গেছে।\n\nসিকিউরিটি কোড: " . $otp . "\n\nএই কোডটি ১০ মিনিটের জন্য কার্যকর।";
        }

        try {
            Log::info("📧 Sending OTP via Mailer API", ['email' => $email, 'otp' => $otp]);

            $response = Http::withoutVerifying()
                ->timeout(30)
                ->withHeaders([
                    'X-API-Key' => config('services.mailer.key'),
                ])
                ->post(config('services.mailer.url'), [
                    'type'    => 'verification',
                    'to'      => trim($email),
                    'subject' => $title . ' -  Bhaiya Affiliate Program',
                    'data'    => [
                        'eyebrow' => ' Bhaiya Affiliate Program',
                        'site_name' => ' Bhaiya Affiliate Program',
                        'site_logo' => 'https://asset.bhaiyahousing.com/storage/settings/2043f208-bd04-4331-8894-0f6f1fc83d14.png',
                        'heading' => $title,
                        'name' => $name,
                        'message' => $message,
                        'otp_code'  => $otp,
                        'otp_expiry' => '10 minutes',

                    ],

                ]);

            if ($response->successful()) {
                Log::info("OTP Sent Successfully", ['email' => $email, 'log_id' => $response->json('log_id')]);
            } else {
                Log::error("OTP Failed", ['status' => $response->status()]);
            }
        } catch (\Throwable $e) {
            Log::error("OTP Exception", ['error' => $e->getMessage()]);
        }
    }
}
