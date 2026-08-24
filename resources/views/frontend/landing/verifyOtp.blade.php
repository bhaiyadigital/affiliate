@extends('frontend.layouts.landingFront')
@section('content')
    <style>
        :root {
            /* আপনার চাহিদা অনুযায়ী নতুন ৩-কালার গ্রেডিয়েন্ট */
            --custom-gradient: linear-gradient(to right, #175b05 0%, #009d0a 50%, #175b05 100%);
            --shadow: 0 40px 100px rgba(0, 0, 0, 0.15);
        }

        .auth-page {
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background-color: #F8FAFC;
        }

        .auth-shell {
            max-width: 450px;
            width: 100%;
            background: var(--custom-gradient) !important;
            border-radius: 35px;
            padding: 50px 40px;
            box-shadow: var(--shadow);
            color: #ffffff;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        /* ডেকোরেশন শাইন */
        .auth-shell::after {
            content: "";
            position: absolute;
            top: -20%;
            left: -20%;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            filter: blur(40px);
            border-radius: 50%;
        }

        .auth-title {
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .auth-desc {
            font-size: 14px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .auth-field {
            text-align: left;
        }

        .auth-field label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            display: block;
        }

        /* ইনপুট ফিল্ড - গ্লাস ইফেক্ট */
        .auth-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            padding: 15px;
            border-radius: 15px;
            color: #ffffff !important;
            outline: none;
            font-size: 16px;
            transition: 0.3s;
        }

        .auth-input:focus {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: #ffffff !important;
        }

        /* ওটিপি ইনপুট স্পেশাল */
        .otp-input {
            text-align: center;
            letter-spacing: 12px;
            font-size: 36px;
            font-weight: 900;
            padding: 20px !important;
        }

        /* মেইন সাদা বাটন */
        .auth-submit-btn {
            width: 100%;
            background: #ffffff !important;
            color: #175b05 !important;
            border: none;
            padding: 18px;
            border-radius: 15px;
            font-weight: 900;
            font-size: 17px;
            cursor: pointer;
            margin-top: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .auth-submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        /* টাইমার ডিজাইন */
        #countdown {
            font-weight: 900;
            background: rgba(0, 0, 0, 0.2);
            padding: 4px 10px;
            border-radius: 8px;
            font-family: monospace;
        }

        .secondary-link {
            color: #ffffff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            opacity: 0.8;
            transition: 0.3s;
        }

        .secondary-link:hover {
            opacity: 1;
            text-decoration: underline;
        }
    </style>

    <div class="auth-page">
        <div class="auth-shell" data-lenis-prevent>
            <h3 class="auth-title">
                {{ session('can_reset_password') ? 'নতুন পাসওয়ার্ড' : 'ভেরিফিকেশন' }}
            </h3>
            <p class="auth-desc">
                আপনার <b>{{ session('verify_email') }}</b> ঠিকানায় সিকিউরিটি কোড পাঠানো হয়েছে।
            </p>

            @if(session('success'))
                <div style="background:rgba(255,255,255,0.2); border:1px solid #fff; padding:10px; border-radius:10px; margin-bottom:20px; font-size:13px;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div style="background:rgba(255,0,0,0.15); border:1px solid #ff9b9b; padding:10px; border-radius:10px; margin-bottom:20px; font-size:13px;">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('can_reset_password'))
                {{-- পাসওয়ার্ড রিসেট ফর্ম --}}
                <form action="{{ route('password.update.final') }}" method="POST">
                    @csrf
                    <div class="auth-field" style="margin-bottom:15px;">
                        <label>নতুন পাসওয়ার্ড</label>
                        <input name="password" type="password" class="auth-input" placeholder="সর্বনিম্ন ৬ ডিজিট" required autofocus>
                    </div>
                    <div class="auth-field" style="margin-bottom:25px;">
                        <label>পাসওয়ার্ড নিশ্চিত করুন</label>
                        <input name="password_confirmation" type="password" class="auth-input" placeholder="আবার লিখুন" required>
                    </div>
                    <button type="submit" class="auth-submit-btn">পাসওয়ার্ড আপডেট করুন</button>
                </form>
            @else
                {{-- ওটিপি ভেরিফাই ফর্ম --}}
                <form action="{{ route('otp.verify.submit') }}" method="POST">
                    @csrf
                    <div class="auth-field" style="margin-bottom:20px;">
                        <input name="otp" type="text" class="auth-input otp-input" placeholder="------" maxlength="6" required autofocus autocomplete="one-time-code">
                    </div>

                    <div style="margin-bottom: 25px; font-size: 14px;">
                        কোডটির মেয়াদ আছে: <span id="countdown">--:--</span>
                    </div>

                    <button type="submit" class="auth-submit-btn">ভেরিফাই করুন &nbsp; →</button>

                    <div style="display: flex; justify-content: space-between; margin-top: 25px;">
                        <a href="{{ route('otp.resend') }}" class="secondary-link">আবার পাঠান</a>
                        <a href="{{ route('otp.cancel') }}" class="secondary-link">বাতিল করুন</a>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const expiresAtStr = "{{ $expiresAt }}";
            if (!expiresAtStr || document.getElementById('countdown') === null) return;

            const countdownElement = document.getElementById('countdown');
            const expiryTime = new Date(expiresAtStr).getTime();
            const englishToBangla = { '0': '০', '1': '১', '2': '২', '3': '৩', '4': '৪', '5': '৫', '6': '৬', '7': '৭', '8': '৮', '9': '৯' };

            function formatToBangla(input) {
                return input.toString().replace(/\d/g, m => englishToBangla[m]);
            }

            const timer = setInterval(function () {
                const now = new Date().getTime();
                const distance = expiryTime - now;

                if (distance < 0) {
                    clearInterval(timer);
                    countdownElement.innerHTML = "মেয়াদ শেষ";
                    countdownElement.style.color = "#ff8484";
                    return;
                }

                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                const minStr = minutes < 10 ? "0" + minutes : minutes;
                const secStr = seconds < 10 ? "0" + seconds : seconds;

                countdownElement.innerHTML = formatToBangla(minStr) + ":" + formatToBangla(secStr);
            }, 1000);
        });
    </script>
@endsection
