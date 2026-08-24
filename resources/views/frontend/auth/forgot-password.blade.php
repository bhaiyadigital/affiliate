@extends('frontend.layouts.landingFront')

@section('content')
<section class="forgot-section" style="padding: 100px 0; background-color: #F6F9FD;">
    <div class="wrap">
        <div class="section-head" style="text-align: center; margin-bottom: 30px;">
            <div class="eyebrow" style="color: #059669; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px;">অ্যাকাউন্ট রিকভারি</div>
            <h2 style="font-size: 32px; font-weight: 900; color: #101B37;">পাসওয়ার্ড রিসেট করুন</h2>
            <p style="color: #64748B; font-size: 14px;">আপনার অ্যাকাউন্টের ইমেইল এড্রেসটি লিখুন, আমরা একটি ওটিপি পাঠাবো।</p>
        </div>

        <div class="auth-shell" style="max-width: 450px; margin: 0 auto; background: #fff; border-radius: 35px; padding: 45px 40px; border: 1px solid #E9F0F8; box-shadow: 0 30px 60px rgba(0, 0, 0, 0.05);">

            @if(session('error'))
                <div style="background: #FEF2F2; color: #DC2626; padding: 14px; border-radius: 12px; margin-bottom: 20px; font-size: 13px; font-weight: 600; border: 1px solid #FEE2E2; text-align: center;">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('password.sendOtp') }}" method="POST">
                @csrf
                <div class="auth-field" style="margin-bottom: 25px;">
                    <label style="display: block; font-size: 13px; font-weight: 700; color: #101B37; margin-bottom: 8px;">ইমেইল এড্রেস</label>
                    <input name="email" type="email" value="{{ old('email') }}" placeholder="example@mail.com"
                           style="width: 100%; padding: 14px; border-radius: 12px; border: 1px solid @error('email') #EF4444 @else #E2E8F0 @enderror; background: #F8FBFF;" required>
                    @error('email') <span style="color: #EF4444; font-size: 12px; margin-top: 5px; display: block; font-weight: 600;">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="auth-submit" style="width: 100%; padding: 16px; background: #007D4F; color: #fff; border-radius: 12px; font-weight: 800; cursor: pointer; border: none; font-size: 16px;">ওটিপি পাঠান</button>
            </form>

            <div style="text-align: center; margin-top: 25px; font-size: 14px; color: #64748B;">
                পাসওয়ার্ড মনে পড়েছে? <a href="{{ route('affiliated.login.page') }}" style="color: #007D4F; font-weight: 700; text-decoration: none;">লগইন করুন</a>
            </div>
        </div>
    </div>
</section>
@endsection
