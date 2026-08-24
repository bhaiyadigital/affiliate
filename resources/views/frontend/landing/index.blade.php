@extends('frontend.layouts.landingFront')

@section('content')


    <section class="custom-hero">
        <div class="c-wrap">
            <!-- বাম পাশের লেখা -->
            <div class="hero-left">
                <div class="c-badge"><span></span> Bhaiya Referral Program</div>
                <h1 class="c-title">আপনার পরিচিতজনই হতে পারে আমাদের <b>পরবর্তী সন্তুষ্ট গ্রাহক</b></h1>
                <p class="c-desc">
                    কাউকে ফ্ল্যাট বা জমি কেনার জন্য পরিচয় করিয়ে দিন। চুক্তি সম্পন্ন হলে সর্বোচ্চ
                    <mark>৳৩,০০,০০০</mark> পর্যন্ত রেফার কমিশন পান সরাসরি আপনার অ্যাকাউন্টে।
                </p>
                <div class="c-btn-group">
                    <a href="#refer" class="btn-green">রেফার শুরু করুন <i class="fas fa-arrow-right"></i></a>
                    <a href="tel:01922030303" class="btn-white"><i class="fas fa-phone"></i> ০১৯২২-০৩০৩০৩</a>
                </div>
                <div class="c-stats">
                    <div class="s-item">
                        <b class="stat-number" data-target="12">০</b><b>+ বছর</b>
                        <span>বিশ্বস্ত অভিজ্ঞতা</span>
                    </div>
                    <div class="s-item">
                        <b>৳</b><b class="stat-number" data-target="300000">০</b>
                        <span>সর্বোচ্চ বোনাস</span>
                    </div>
                    <div class="s-item">
                        <b class="stat-number" data-target="5">০</b><b>টি</b>
                        <span>সক্রিয় প্রজেক্ট</span>
                    </div>
                </div>
            </div>

            <!-- ডান পাশের ছবি/কার্ড -->
            <!-- কার্ডের মেইন প্যারেন্ট -->
            <div class="visual-parent anim-float">

                <!-- আপনার ব্যাকগ্রাউন্ড ইমেজ (যেমন: ডট বা কোনো শেপ) -->
                <img src="{{asset('./images/hero/dot.avif')}}" class="card-bg-img" alt="background">

                <!-- আপনার আসল কার্ড -->
                <div class="c-visual-card">
                    <div
                        style="display:flex; justify-content: space-between; margin-bottom: 30px; font-weight: 700; font-size: 14px;">
                        <span><i class="fas fa-circle" style="color:#10B981; font-size:8px;"></i> লাইভ রেফারেল প্রবাহ</span>
                        <span style="color:#047857; text-transform: uppercase; font-size: 11px;">স্বচ্ছ ও নিরাপদ</span>
                    </div>
                    <div class="green-box">
                        <p
                            style="font-size: 12px; text-transform: uppercase; letter-spacing: 2px; opacity: 0.8; margin-bottom: 10px;">
                            সর্বোচ্চ কমিশন সুবিধা</p>
                        <h2 style="font-size: 52px; font-weight: 900; margin: 0; ">৳৩,০০,০০০</h2>
                        <p style="font-size: 13px; opacity: 0.7; margin-top: 10px;">প্রতিটি সফল অ্যাপার্টমেন্ট রেফারেলের
                            ক্ষেত্রে</p>
                    </div>
                    <p style="text-align:center; font-weight: 800; font-size: 15px; color: #1E293B; margin-top:30px;">কমিশন
                        প্রাপ্তি</p>
                </div>

            </div>

        </div>
    </section>

    <!-- নিচের ৪টি ট্রাস্ট বক্স -->
    <section class="trust-section">
        <div class="trust-grid">
            <div class="trust-box"><i class="fas fa-shield-alt"></i>
                <div><b style="display:block;">১০০% নিরাপদ</b><span
                        style="font-size:12px; color:#697383; font-weight: 400;">স্বচ্ছ পেআউট
                        চুক্তি</span></div>
            </div>
            <div class="trust-box"><i class="fas fa-bolt"></i>
                <div><b style="display:block;">দ্রুততম পেমেন্ট</b><span
                        style="font-size:12px; color:#697383; font-weight: 400;">বুকিং
                        রেজিস্ট্রেশনের পরই</span></div>
            </div>
            <div class="trust-box"><i class="fas fa-headset"></i>
                <div><b style="display:block;">ডেডিকেটেড সাপোর্ট</b><span
                        style="font-size:12px; color:#697383; font-weight: 400;">সম্পূর্ণ
                        গাইডলাইন</span></div>
            </div>
            <div class="trust-box"><i class="fas fa-map-marker-alt"></i>
                <div><b style="display:block;">প্রিমিয়াম লোকেশন</b><span
                        style="font-size:12px; color:#697383; font-weight: 400;">ঢাকার সেরা
                        প্রজেক্টসমূহ</span></div>
            </div>
        </div>
    </section>
    <!-- HOW IT WORKS SECTION - IMAGE PERFECT VERSION -->
    <div class="container">
        <div class="header">
            <h1>কিভাবে কাজ করে?</h1>
            <p>মাত্র ৪টি সহজ ধাপে আপনার রেফারেল কমিশন নিশ্চিত করুন।</p>
        </div>

        <div class="steps-wrapper">
            <div class="progress-line"></div>
            <div class="progress-fill" id="progressFill"></div>
            <div class="animated-dot" id="animatedDot"></div>

            <div class="steps-grid">
                <div class="step-item" id="step1">
                    <div class="icon-circle">01</div>
                    <h3>রেজিস্টার করুন</h3>
                    <p>ফ্রি অ্যাকাউন্ট তৈরি করুন এবং আপনার ইউনিক রেফারেল লিংক পান।</p>
                </div>

                <div class="step-item" id="step2">
                    <div class="icon-circle">02</div>
                    <h3>কাস্টমার রেফার করুন</h3>
                    <p>তথ্য ফর্মে জমা দিন অথবা রেফারেল লিংক শেয়ার করুন।</p>
                </div>

                <div class="step-item" id="step3">
                    <div class="icon-circle">03</div>
                    <h3>সাইট ভিজিট</h3>
                    <p>সেলস টিম কাস্টমারকে সাইট ভিজিটের ব্যবস্থা করবে।</p>
                </div>

                <div class="step-item" id="step4">
                    <div class="icon-circle">04</div>
                    <h3>কমিশন পান</h3>
                    <p>বুকিং সম্পন্ন হলে সরাসরি ব্যাংকে পেমেন্ট পাবেন।</p>
                </div>
            </div>
        </div>


    </div>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }



        .header {
            text-align: center;
            margin-bottom: 60px;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 600;
            color: var(--text-primary, #000);
            margin-bottom: 10px;
        }

        .header p {
            font-size: 14px;
            color: var(--text-secondary, #666);
        }

        .steps-wrapper {
            position: relative;
            margin-bottom: 40px;
        }

        .progress-line {
            position: absolute;
            top: 24px;
            left: 60px;
            right: 60px;
            height: 2px;
            background: #e5e7eb;
            z-index: 1;
        }

        .progress-fill {
            position: absolute;
            top: 24px;
            left: 60px;
            height: 2px;
            background: #10b981;
            z-index: 2;
            width: 0%;
            transition: width 0.1s linear;
        }

        .steps-grid {
            display: flex;
            justify-content: space-between;
            position: relative;
            z-index: 3;
        }

        .step-item {
            text-align: center;
            flex: 1;
        }

        .icon-circle {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            border: 2px solid #d1d5db;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 24px;
            font-weight: 600;
            color: var(--text-secondary, #999);
            background: white;
            transition: all 0.1s ease;
            position: relative;
        }

        .step-item.active .icon-circle {
            border-color: #175b05;
            color: white;
            background: #009d0a;
        }

        .step-item.completed .icon-circle {
            border-color: #009d0a;
            background: #009d0a;
            color: white;
        }

        .step-item h3 {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary, #000);
            margin-bottom: 8px;
        }

        .step-item p {
            font-size: 13px;
            color: #175b05;
            line-height: 1.5;
            max-width: 140px;
            margin: 0 auto;
        }

        .animated-dot {
            position: absolute;
            width: 12px;
            height: 12px;
            background: #175b05;
            border-radius: 50%;
            top: 18px;
            left: 60px;
            animation: moveDot 8s linear infinite;
            z-index: 4;
            box-shadow: 0 0 8px rgba(16, 185, 129, 0.5);
        }

        @keyframes moveDot {
            0% {
                left: 60px;
            }

            25% {
                left: calc(25% + 30px);
            }

            50% {
                left: calc(50% + 30px);
            }

            75% {
                left: calc(75% + 30px);
            }

            100% {
                left: calc(100% - 66px);
            }
        }

        /* 📱 মোবাইল ভার্সন ফিক্স - ডট এবং লাইন পজিশন সঠিক করা */
        @media (max-width: 768px) {
            .steps-wrapper {
                padding-left: 0px;
                /* প্যাডিং ক্লিন করা হলো */
                margin-top: 20px;
            }

            /* লাইনটিকে আইকনের ঠিক মাঝখানে রাখা (Left: 47px) */
            .progress-line,
            .progress-fill {
                left: 47px;
                width: 2px;
                right: auto;
                top: 20px;
                bottom: 20px;
                height: auto;
                position: absolute;
            }

            .progress-fill {
                height: 0%;
                /* JS দিয়ে কন্ট্রোল হবে */
            }

            /* ডটটিকে লাইনের ওপর সেন্টার করা (Left: 42px) */
            /* ক্যালকুলেশন: লাইন ৪৭px + (২px লাইন / ২) - (১২px ডট / ২) = ৪২px */
            .animated-dot {
                left: 42px !important;
                top: 20px;
                width: 12px;
                height: 12px;
                position: absolute;
                animation: moveDotVertical 8s linear infinite;
            }

            .steps-grid {
                flex-direction: column;
                gap: 40px;
                align-items: flex-start;
                padding-left: 25px;
                /* আইকনগুলোর বাম পাশের গ্যাপ */
                position: relative;
            }

            .step-item {
                text-align: left;
                display: flex;
                gap: 20px;
                align-items: center;
                width: 100%;
                position: relative;
                z-index: 5;
            }

            .icon-circle {
                margin: 0;
                flex-shrink: 0;
                width: 45px;
                height: 45px;
                font-size: 18px;
                background: white;
            }

            /* ভার্টিক্যাল মুভমেন্ট এনিমেশন */
            @keyframes moveDotVertical {
                0% {
                    top: 20px;
                }

                100% {
                    top: calc(100% - 25px);
                }
            }
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 30px;
        }

        button {
            padding: 10px 24px;
            border: 0.5px solid var(--border, #d0d0d0);
            border-radius: 6px;
            background: var(--fill-secondary, #f0f0f0);
            cursor: pointer;
            font-size: 14px;
            color: var(--text-primary, #000);
            transition: all 0.2s;
            font-weight: 500;
        }

        button:hover {
            background: var(--fill-ghost-hover, #e5e5e5);
        }
    </style>

    <script>
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const step3 = document.getElementById('step3');
        const step4 = document.getElementById('step4');
        const progressFill = document.getElementById('progressFill');

        function updateSteps(progress) {
            // আগের সব রিমুভ লজিক ঠিক থাকবে...
            step1.classList.remove('active', 'completed');
            step2.classList.remove('active', 'completed');
            step3.classList.remove('active', 'completed');
            step4.classList.remove('active', 'completed');

            // ডেক্সটপে প্রস্থ (Width) এবং মোবাইলে উচ্চতা (Height) আপডেট করবে
            progressFill.style.width = window.innerWidth > 768 ? progress + '%' : '2px';
            progressFill.style.height = window.innerWidth <= 768 ? progress + '%' : '2px';

            // বাকি স্টেপ কন্ডিশনগুলো (if-else) আগের মতোই থাকবে...
            if (progress >= 0 && progress < 25) { step1.classList.add('active'); }
            else if (progress >= 25) { step1.classList.add('completed'); }

            if (progress >= 25 && progress < 50) { step2.classList.add('active'); }
            else if (progress >= 50) { step2.classList.add('completed'); }

            if (progress >= 50 && progress < 75) { step3.classList.add('active'); }
            else if (progress >= 75) { step3.classList.add('completed'); }

            if (progress >= 75) { step4.classList.add('active'); }
        }

        let animationRunning = true;

        function animateProgress() {
            let progress = 0;
            const startTime = Date.now();
            const duration = 8000; // 8 seconds

            const animate = () => {
                if (!animationRunning) return;

                const elapsed = (Date.now() - startTime) % duration;
                progress = (elapsed / duration) * 100;

                updateSteps(progress);

                requestAnimationFrame(animate);
            };

            animate();
        }

        function resetAnimation() {
            updateSteps(0);
        }

        // Start animation on load
        animateProgress();
    </script>
    <!-- কেন ভাইয়া হাউজিং-এ রেফার করবেন? (Centered Design) -->
    <section class="feature-hub-section" id="why-bhaiya">
        <div class="wrap">
            <!-- Section Header (Centered) -->
            <div class="section-head-hub reveal">
                <div class="top-badge">ফিউচারিস্টিক শোটাইম</div>
                <h2 class="hub-main-title">কেন ভাইয়া হাউজিং-এ রেফার করবেন?</h2>
                <p class="hub-sub-title">ক্লিক বা হোভার করে আমাদের ৪টি প্রধান সুবিধার লাইভ ফিচার ডেমো দেখুন:</p>
            </div>

            <!-- Main Interactive Container -->
            <div class="hub-outer-card reveal">
                <div class="hub-grid">
                    <!-- Left Sidebar -->
                    <div class="hub-sidebar">
                        <div class="hub-nav-card active" onclick="updateHub(0, this)">
                            <div class="nav-icon-box"><i class="fas fa-shield-alt"></i></div>
                            <div class="nav-texts">
                                <h4>১. ১২+ বছরের শতভাগ সুনাম</h4>
                                <p>২০১২ থেকে ঢাকায় আবাসন নিশ্চিত করে আসছি।</p>
                            </div>
                        </div>

                        <div class="hub-nav-card" onclick="updateHub(1, this)">
                            <div class="nav-icon-box"><i class="fas fa-clock"></i></div>
                            <div class="nav-texts">
                                <h4>২. দ্রুততম ব্যাংক পেআউট</h4>
                                <p>বুকিং রেজিস্ট্রেশন সম্পন্নের সাথে সাথে পেমেন্ট।</p>
                            </div>
                        </div>

                        <div class="hub-nav-card" onclick="updateHub(2, this)">
                            <div class="nav-icon-box"><i class="fas fa-home"></i></div>
                            <div class="nav-texts">
                                <h4>৩. ঢাকার সেরা প্রাইম স্পটসমূহ</h4>
                                <p>বারিধারা, উত্তরা, মিরপুর ও ধানমন্ডি সংলগ্ন প্রজেক্ট।</p>
                            </div>
                        </div>

                        <div class="hub-nav-card" onclick="updateHub(3, this)">
                            <div class="nav-icon-box"><i class="fas fa-users"></i></div>
                            <div class="nav-texts">
                                <h4>৪. নিজস্ব সেলস ও সাইট সাপোর্ট</h4>
                                <p>আপনার কাস্টমারকে প্রজেক্ট ঘুরে দেখানো ও গাইডেন্স।</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Display Screen -->
                    <div class="hub-display-screen">
                        <div class="screen-content active" id="content-0">
                            <span class="screen-mini-tag">বিশ্বস্ততা ও অভিজ্ঞতা</span>
                            <h3 class="screen-big-title">১২+ বছরের অটুট সুনাম ও শতভাগ গ্রাহক আস্থা</h3>
                            <p class="screen-description">Bhaiya Housing নির্দিষ্ট সময়ের মধ্যে আন্তর্জাতিক
                                স্ট্যান্ডার্ডের
                                ফ্ল্যাট হস্তান্তর করার জন্য দীর্ঘ এক দশক ধরে পরিচিত।</p>
                        </div>
                        <div class="screen-content" id="content-1">
                            <span class="screen-mini-tag">ইনস্ট্যান্ট পেমেন্ট</span>
                            <h3 class="screen-big-title">বুকিং রেজিস্ট্রেশন হতেই সরাসরি ব্যাংক ট্রান্সফার</h3>
                            <p class="screen-description">প্রতিটি সফল অ্যাপার্টমেন্ট রেফারেলের ক্ষেত্রে কমিশন সরাসরি
                                গ্রাহকের ব্যাংক একাউন্টে জমা হয়।</p>
                        </div>
                        <div class="screen-content" id="content-2">
                            <span class="screen-mini-tag">আকর্ষণীয় স্থানসমূহ</span>
                            <h3 class="screen-big-title">ঢাকার সেরা প্রজেক্ট লোকেশনসমূহ</h3>
                            <p class="screen-description">কাস্টমারদের জন্য বেছে নেওয়ার সুবিধার্থে একাধিক ঢাকার
                                গুরুত্বপূর্ণ
                                পয়েন্টে প্রজেক্ট বিদ্যমান।</p>
                        </div>
                        <div class="screen-content" id="content-3">
                            <span class="screen-mini-tag">প্রফেশনাল গাইডেন্স</span>
                            <h3 class="screen-big-title">নিজস্ব সেলস ও সাইট সাপোর্ট টিম</h3>
                            <p class="screen-description">আপনার কাস্টমারকে নিয়ে সাইট ঘুরে দেখানো এবং ক্লায়েন্ট
                                হ্যান্ডলিং
                                সম্পন্ন করে আমাদের এক্সপার্ট সেলস টিম।</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="dashboard-section" id="dashboard-section">
        <div class="wrap">

            <div class="section-head">
                <h2>স্বাগতম@auth ,{{ Auth::user()->name }}@endauth</h2>
                <p>আপনার রেফারেল এবং কমিশনের সর্বশেষ অবস্থা নিচে দেখুন।</p>
            </div>

            <div id="dashPanel" class="dash-panel active" style="display: block;">
                <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @auth

                    <button class="dash-logout"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ← লগআউট করুন
                    </button>
                @endauth
                <div class="dash-summary">
                    <div class="dash-stat"><b>৮</b><span>মোট রেফারেল</span></div>
                    <div class="dash-stat"><b>৩</b><span>প্রক্রিয়াধীন</span></div>
                    <div class="dash-stat"><b>২</b><span>বুকিং সম্পন্ন</span></div>
                    <div class="dash-stat"><b>৳৪,৫০,০০০</b><span>মোট কমিশন (অর্জিত)</span></div>
                </div>
                <div class="dash-table-wrap">
                    <table class="dash-table">
                        <thead>
                            <tr>
                                <th>নাম</th>
                                <th>প্রজেক্ট</th>
                                <th>রেফার তারিখ</th>
                                <th>স্টেজ</th>
                                <th>কমিশন</th>
                            </tr>
                        </thead>
                        <tbody style="color: #f4efe2;">
                            <tr>
                                <td data-label="নাম">রাকিব হাসান</td>
                                <td data-label="প্রজেক্ট">Gulf Panorama</td>
                                <td data-label="রেফার তারিখ">০২ জুন ২০২৬</td>
                                <td data-label="স্টেজ"><span class="stage-pill stage-5">কমিশন প্রদত্ত</span></td>
                                <td data-label="কমিশন">৳২,৫০,০০০</td>
                            </tr>
                            <tr>
                                <td data-label="নাম">শিরিন আক্তার</td>
                                <td data-label="প্রজেক্ট">Daisy Dell</td>
                                <td data-label="রেফার তারিখ">১৮ জুন ২০২৬</td>
                                <td data-label="স্টেজ"><span class="stage-pill stage-5">কমিশন প্রদত্ত</span></td>
                                <td data-label="কমিশন">৳২,০০,০০০</td>
                            </tr>
                            <tr>
                                <td data-label="নাম">ইমরান খান</td>
                                <td data-label="প্রজেক্ট">Olivia</td>
                                <td data-label="রেফার তারিখ">০৫ জুলাই ২০২৬</td>
                                <td data-label="স্টেজ"><span class="stage-pill stage-4">বুকিং সম্পন্ন</span></td>
                                <td data-label="কমিশন">প্রক্রিয়াধীন</td>
                            </tr>
                            <tr>
                                <td data-label="নাম">নাজমুল হক</td>
                                <td data-label="প্রজেক্ট">Park Oasis</td>
                                <td data-label="রেফার তারিখ">০৯ জুলাই ২০২৬</td>
                                <td data-label="স্টেজ"><span class="stage-pill stage-3">সাইট ভিজিট</span></td>
                                <td data-label="কমিশন">—</td>
                            </tr>
                            <tr>
                                <td data-label="নাম">ফারহানা ইসলাম</td>
                                <td data-label="প্রজেক্ট">Sheuly's Garden</td>
                                <td data-label="রেফার তারিখ">১১ জুলাই ২০২৬</td>
                                <td data-label="স্টেজ"><span class="stage-pill stage-2">যোগাযোগ করা হয়েছে</span></td>
                                <td data-label="কমিশন">—</td>
                            </tr>
                            <tr>
                                <td data-label="নাম">তানভীর আহমেদ</td>
                                <td data-label="প্রজেক্ট">Gulf Panorama</td>
                                <td data-label="রেফার তারিখ">১৩ জুলাই ২০২৬</td>
                                <td data-label="স্টেজ"><span class="stage-pill stage-1">রেফার করা হয়েছে</span></td>
                                <td data-label="কমিশন">—</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="link-gen-note" style="color:darkgray">ডেমো ডেটা — বাস্তব ব্যবহারে এই তালিকা আপনার প্রকৃত
                    রেফারেল
                    অনুযায়ী
                    স্বয়ংক্রিয়ভাবে আপডেট হবে।</p>
            </div>
        </div>
    </section>

    <!-- Bhaiya Housing Hero Section -->
    <section class="refer-hero-section">
        <div class="container mx-auto">

            <!-- Main Dark Green Container -->
            <div class="main-green-box">

                <!-- Side Glow Effect (ইমেজের মতো ডান পাশের আভা) -->
                <div class="glow-overlay"></div>

                <div class="content-grid">

                    <!-- Left: Info -->
                    <div class="left-content">
                        <div class="top-badge">
                            GET STARTED WITH BHAIYA HOUSING
                        </div>

                        <h1 class="hero-title">
                            ডিজিটাল রেফারেল প্ল্যাটফর্মে নতুন অভিজ্ঞতা নিন
                        </h1>

                        <p class="hero-desc">
                            অনলাইনে সরাসরি তথ্য সাবমিট করুন বা ইউনিক লিঙ্ক বানিয়ে কাস্টমারদের জানান। আমাদের বিশ্বস্ত
                            টিম বাকি সব প্রক্রিয়া সহজ করে দেবে।
                        </p>

                        <a href="{{ route('affiliated.register.page') }}" class="cta-button">
                            এখনই রেফার শুরু করুন &nbsp; →
                        </a>
                    </div>

                    <!-- Right: Tracker Card (Glassmorphism) -->
                    <div class="right-visual">
                        <div class="glass-tracker-card">
                            <div class="card-header">
                                <div class="status-left">
                                    <i class="fa-solid fa-bolt text-amber-400"></i>
                                    লাইভ ড্যাশবোর্ড ট্র্যাকার
                                </div>
                                <div class="status-right">১০০% নিরাপদ</div>
                            </div>

                            <div class="card-amount">
                                ৳৩,০০,০০০
                            </div>

                            <div class="card-footer">
                                প্রতি চুক্তিতে নিশ্চিত বোনাস। কোনো প্রকার গোপন শর্ত ছাড়া সরাসরি ব্যাংক অ্যাকাউন্টে
                                জমা।
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @auth
        <!-- Form Section Header -->
        <div class="container" style="text-align: center; margin-top: 80px; margin-bottom: 40px;">
            <div style="color: #F59E0B; font-weight: 700; font-size: 14px; margin-bottom: 10px;">
                <span
                    style="width: 30px; height: 2px; background: #F59E0B; display: inline-block; vertical-align: middle; margin-right: 10px;"></span>
                রেফার জমা দিন
            </div>
            <h2 style="font-size: 42px; font-weight: 900; color: #101B37;">
                আপনার ক্লায়েন্টের তথ্য জমা দিন</h2>
        </div>
        <!-- Main Form Card -->
        <section class="referral-form-container" id="refer-section">
            <div class="form-card-main">
                <!-- Left Side (Dark Section) -->
                <div class="form-dark-side">
                    <h3 class="side-title">রেফার করুন, উপার্জন নিশ্চিত করুন</h3>
                    <p class="side-desc">আপনার পরিচিত কাউকে ফ্ল্যাট বা জমি কিনতে পাঠান। বুকিং হলেই কমিশন সরাসরি আপনার
                        ব্যাংকে।</p>

                    <ul class="benefit-list">
                        <li><span class="icon-circle"><i class="fas fa-check"></i></span> সরাসরি ব্যাংক ট্রান্সফার</li>
                        <li><span class="icon-circle"><i class="fas fa-check"></i></span> ফ্রি সাইট ভিজিট ব্যবস্থা</li>
                        <li><span class="icon-circle"><i class="fas fa-check"></i></span> শতভাগ তথ্য গোপনীয়তা</li>
                        <li><span class="icon-circle"><i class="fas fa-check"></i></span> সর্বোচ্চ ৩,০০,০০০ কমিশন</li>
                    </ul>
                </div>

                <!-- Right Side (Form Section) -->
                <div class="form-white-side">
                    <h3 class="form-input-title">কাস্টমারের তথ্য</h3>
                    @if(session('success'))
                        <div
                            style="background: #D1FAE5; color: #065F46; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-weight: 600;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- সাধারণ এরর মেসেজ প্রদর্শন (যেমন: কুপন ভুল বা রেফার লিংক নেই) -->
                    @if(session('error'))
                        <div
                            style="background: #FEE2E2; color: #B91C1C; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-weight: 600;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('lead.store') }}" method="POST">
                        @csrf
                        <!-- ওনার আইডি ধরার জন্য ম্যানুয়াল টাইপ পাঠানো হচ্ছে -->
                        <input type="hidden" name="type" value="manual">

                        <div class="input-grid">
                            <!-- কাস্টমারের নাম -->
                            <div class="input-item">
                                <label>কাস্টমারের নাম <span style="color:red">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="পূর্ণ নাম" required
                                    style="@error('name') border-color: #EF4444; @enderror">
                                @error('name') <span
                                    style="color: #EF4444; font-size: 11px; margin-top: 5px; font-weight: 600;">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- ফোন নম্বর -->
                            <div class="input-item">
                                <label>ফোন নম্বর <span style="color:red">*</span></label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="017XXXXXXXX" required
                                    style="@error('phone') border-color: #EF4444; @enderror">
                                @error('phone') <span
                                    style="color: #EF4444; font-size: 11px; margin-top: 5px; font-weight: 600;">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- ইমেল (নতুন যুক্ত করা হয়েছে) -->
                            <div class="input-item">
                                <label>ইমেল (ঐচ্ছিক)</label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="example@mail.com"
                                    style="@error('email') border-color: #EF4444; @enderror">
                                @error('email') <span
                                    style="color: #EF4444; font-size: 11px; margin-top: 5px; font-weight: 600;">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- পছন্দের প্রজেক্ট -->
                            <div class="input-item">
                                <label>পছন্দের প্রজেক্ট</label>
                                <select name="interested_location">
                                    <option value="">— নির্বাচন করুন —</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->title }}" {{ old('interested_location') == $project->title ? 'selected' : '' }}>
                                            {{ $project->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- বাজেট -->
                            <div class="input-item">
                                <label>বাজেট (টাকা)</label>
                                <input type="number" name="budget" value="{{ old('budget') }}" placeholder="আনুমানিক বাজেট"
                                    style="@error('budget') border-color: #EF4444; @enderror">
                                @error('budget') <span
                                    style="color: #EF4444; font-size: 11px; margin-top: 5px; font-weight: 600;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="form-submit-btn">
                            তথ্য সাবমিট করুন &nbsp; →
                        </button>
                    </form>
                </div>
            </div>
        </section>
    @endauth
    <section class="faq-section" id="faq">
        <div class="container">
            <!-- Section Header -->
            <div class="faq-header">
                <div class="faq-label">
                    <span class="orange-line"></span> সচরাচর জিজ্ঞাসা
                </div>
                <h2 class="faq-main-title">কিছু সাধারণ প্রশ্নোত্তর</h2>
            </div>

            <!-- FAQ List -->
            <div class="faq-wrapper">
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        রেফারেল কমিশন কত?
                        <span class="faq-icon"><i class="fas fa-plus"></i></span>
                    </button>
                    <div class="faq-answer">
                        <p>প্রজেক্ট ও ইউনিটের সাইজ ভেদে সর্বনিম্ন ৳৫০,০০০ থেকে সর্বোচ্চ ৳৩,০০,০০০ পর্যন্ত কমিশন
                            পাওয়া যায়।</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        কমিশন কবে পাবো?
                        <span class="faq-icon"><i class="fas fa-plus"></i></span>
                    </button>
                    <div class="faq-answer">
                        <p>রেফারকৃত কাস্টমারের বুকিং মানি জমা হওয়ার পর চুক্তি অনুযায়ী নির্ধারিত সময়ের মধ্যে
                            ব্যাংক ট্রান্সফার করা হয়।</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        কোন কোন প্রজেক্টে রেফার করা যাবে?
                        <span class="faq-icon"><i class="fas fa-plus"></i></span>
                    </button>
                    <div class="faq-answer">
                        <p>বারিধারা, মিরপুর, উত্তরা, আফতাবনগর ও মোহাম্মদপুরের চলমান সকল প্রজেক্টে রেফারেল
                            গ্রহণযোগ্য।</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        আমার তথ্য কি নিরাপদ?
                        <span class="faq-icon"><i class="fas fa-plus"></i></span>
                    </button>
                    <div class="faq-answer">
                        <p>হ্যাঁ, আপনার এবং আপনার ক্লায়েন্টের সমস্ত তথ্য এনক্রিপ্টেড এবং শতভাগ গোপনীয়।</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="referral-cta-section">
        <div class="container">
            <!-- Main Card with Theme Green Background -->
            <div class="cta-theme-card">
                <h2 class="cta-title">আজই শুরু করুন আপনার রেফারেল যাত্রা</h2>
                <p class="cta-subtitle">একটি সফল রেফারেলই আপনার উপার্জন হতে পারে সর্বোচ্চ ৩ লাখ টাকা।</p>

                <div class="cta-btn-wrapper">
                    <!-- White Button to pop against Green background -->
                    <a href="{{route('affiliated.login.page')}}" class="cta-white-btn">
                        <span>এখনই রেফার জমা দিন</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>

    document.addEventListener('DOMContentLoaded', function () {
        // ১. যদি ফরমের কোনো ভ্যালিডেশন এরর থাকে (যেমন: ফোন নাম্বার ভুল বা ডুপ্লিকেট)
        @if($errors->any())
            // সব লজিক বাদ দিয়ে সরাসরি ফরম সেকশনে নিয়ে যাবে
            setTimeout(() => {
                const referSection = document.getElementById('refer-section');
                if (referSection) {
                    if (typeof lenis !== 'undefined') {
                        // Lenis থাকলে স্মুথ স্ক্রল
                        lenis.scrollTo('#refer-section', { offset: -100 });
                    } else {
                        // সাধারণ ব্রাউজার স্ক্রল
                        referSection.scrollIntoView({ behavior: 'auto', block: 'center' });
                    }
                }
            }, 300); // ৩০০ মিলিসেকেন্ড সময় দেওয়া হলো যাতে পেজ পুরোপুরি লোড হয়
        @endif

        // ২. যদি কন্ট্রোলার থেকে ম্যানুয়ালি কোনো এরর পাঠানো হয় (যেমন: সেশন এরর)
        @if(session('error'))
            setTimeout(() => {
                const referSection = document.getElementById('refer-section');
                if (referSection) {
                    if (typeof lenis !== 'undefined') {
                        lenis.scrollTo('#refer-section', { offset: -100 });
                    } else {
                        referSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            }, 300);
        @endif

        // ৩. শুধুমাত্র সফলভাবে জমা হলে ড্যাশবোর্ডে যাবে (Landing Page Dashboard)
        @if(session('success'))
            setTimeout(() => {
                const dashSection = document.getElementById('dashboard-section');
                if (dashSection) {
                    if (typeof lenis !== 'undefined') {
                        lenis.scrollTo('#dashboard-section');
                    } else {
                        dashSection.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            }, 300);
        @endif
});
</script>
