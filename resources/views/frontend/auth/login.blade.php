@extends('frontend.layouts.landingFront')

@section('content')
<section class="login-section" style="padding: 100px 0; background-color: #F6F9FD;">
    <div class="wrap">
        <div class="section-head" style="text-align: center; margin-bottom: 30px;">
            <div class="eyebrow" style="color: #175b05; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px;">অ্যাফিলিয়েট মেম্বার</div>
            <h2 style="font-size: 32px; font-weight: 900; color: #101B37;">লগইন করুন</h2>
        </div>

        <div class="auth-shell" style="max-width: 450px; margin: 0 auto; background: #fff; border-radius: 35px; padding: 45px 40px; border: 1px solid #E9F0F8; box-shadow: 0 30px 60px rgba(0, 0, 0, 0.05);">

            {{-- লগইন এরর মেসেজ --}}
            @if ($errors->any())
            <div style="background: #FEF2F2; color: #DC2626; padding: 14px; border-radius: 12px; margin-bottom: 20px; font-size: 13px; font-weight: 600; border: 1px solid #FEE2E2; text-align: center;">
                {{ $errors->first() }}
            </div>
            @endif
            @if (session('success'))
            <div style="background: #F0FDF4; color: #16A34A; padding: 14px; border-radius: 12px; margin-bottom: 20px; font-size: 13px; font-weight: 600; border: 1px solid #BBF7D0; text-align: center;">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('affiliated.login') }}" method="POST">
                @csrf
                <div class="auth-field" style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13px; font-weight: 700; color: #101B37; margin-bottom: 8px;">ইমেইল এড্রেস</label>
                    <input name="email" type="email" value="{{ old('email') }}" placeholder="example@mail.com"
                        style="width: 100%; padding: 14px; border-radius: 12px; border: 1px solid #E2E8F0; background: #F8FBFF;" required>
                </div>

                <div class="auth-field" style="margin-bottom: 25px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <label style="font-size: 13px; font-weight: 700; color: #101B37; margin: 0;">পাসওয়ার্ড</label>
                        <a href="{{ route('password.request') }}" style="font-size: 12px; color: #175b05; font-weight: 600; text-decoration: none;">পাসওয়ার্ড ভুলে গেছেন?</a>
                    </div>
                    <input name="password" type="password" placeholder="••••••••"
                        style="width: 100%; padding: 14px; border-radius: 12px; border: 1px solid #E2E8F0; background: #F8FBFF;" required>
                </div>

                <button type="submit" class="auth-submit" style="width: 100%; padding: 16px; background: #175b05; color: #fff; border-radius: 12px; font-weight: 800; cursor: pointer; border: none; font-size: 16px;">লগইন করুন</button>
            </form>

            <div style="text-align: center; margin-top: 25px; font-size: 14px; color: #64748B;">
                নতুন সদস্য? <a href="{{ route('affiliated.register.page') }}" style="color: #175b05; font-weight: 700; text-decoration: none;">রেজিস্ট্রেশন করুন</a>
            </div>
        </div>
    </div>
</section>
@endsection