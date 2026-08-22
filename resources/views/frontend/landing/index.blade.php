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
                    <div class="s-item"><b>১২+ বছর</b><span>বিশ্বস্ত অভিজ্ঞতা</span></div>
                    <div class="s-item"><b>৳৩,০০,০০০</b><span>সর্বোচ্চ বোনাস</span></div>
                    <div class="s-item"><b>৫টি</b><span>সক্রিয় প্রজেক্ট</span></div>
                </div>
            </div>

            <!-- ডান পাশের ছবি/কার্ড -->
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
                    <h2 style="font-size: 52px; font-weight: 900; margin: 0; font-family: serif;">৳৩,০০,০০০</h2>
                    <p style="font-size: 13px; opacity: 0.7; margin-top: 10px;">প্রতিটি সফল অ্যাপার্টমেন্ট রেফারেলের
                        ক্ষেত্রে</p>
                </div>

                <p style="text-align:center; font-weight: 800; font-size: 15px; color: #1E293B;">কমিশন প্রাপ্তি</p>
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


    <section class="features-section" id="features">
        <div class="container">
            <div class="line-divider"></div>
            <!-- Section Header -->
            <div class="section-intro reveal">
                <div class="orange-label">
                    <span class="line"></span> প্রক্রিয়া
                </div>
                <h2 class="main-heading">কিভাবে কাজ করে?</h2>
                <p class="sub-text">মাত্র ৪টি সহজ ধাপে আপনার রেফারেল কমিশন নিশ্চিত করুন।</p>
            </div>

            <!-- Steps Timeline -->
            <div class="steps-wrapper reveal d-1">
                <div class="connecting-line"></div>

                <div class="steps-grid">
                    <!-- Step 1 -->
                    <div class="step-item">
                        <div class="icon-box-wrapper">
                            <div class="icon-circle">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M19 8v6M22 11h-6" />
                                </svg>
                            </div>
                            <span class="step-badge">01</span>
                        </div>
                        <h4>রেজিস্টার করুন</h4>
                        <p>ফ্রি অ্যাকাউন্ট তৈরি করুন এবং আপনার ইউনিক রেফারেল লিঙ্ক পান।</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="step-item">
                        <div class="icon-box-wrapper">
                            <div class="icon-circle">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path
                                        d="M4 4h16c1.1 0 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg>
                            </div>
                            <span class="step-badge">02</span>
                        </div>
                        <h4>কাস্টমার রেফার করুন</h4>
                        <p>তথ্য ফর্মে জমা দিন অথবা রেফারেল লিঙ্ক শেয়ার করুন।</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="step-item">
                        <div class="icon-box-wrapper">
                            <div class="icon-circle">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M3 21h18M6 21V9l6-5 6 5v12M9 21v-6h6v6" />
                                </svg>
                            </div>
                            <span class="step-badge">03</span>
                        </div>
                        <h4>সাইট ভিজিট</h4>
                        <p>সেলস টিম কাস্টমারকে সাইট ভিজিটের ব্যবস্থা করবে।</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="step-item">
                        <div class="icon-box-wrapper">
                            <div class="icon-circle">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="2" y="5" width="20" height="14" rx="2" />
                                    <line x1="2" y1="10" x2="22" y2="10" />
                                </svg>
                            </div>
                            <span class="step-badge">04</span>
                        </div>
                        <h4>কমিশন পান</h4>
                        <p>বুকিং সম্পন্ন হলে সরাসরি ব্যাংকে পেমেন্ট পাবেন।</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                        <p class="screen-description">Bhaiya Housing নির্দিষ্ট সময়ের মধ্যে আন্তর্জাতিক স্ট্যান্ডার্ডের ফ্ল্যাট হস্তান্তর করার জন্য দীর্ঘ এক দশক ধরে পরিচিত।</p>
                    </div>
                    <div class="screen-content" id="content-1">
                        <span class="screen-mini-tag">ইনস্ট্যান্ট পেমেন্ট</span>
                        <h3 class="screen-big-title">বুকিং রেজিস্ট্রেশন হতেই সরাসরি ব্যাংক ট্রান্সফার</h3>
                        <p class="screen-description">প্রতিটি সফল অ্যাপার্টমেন্ট রেফারেলের ক্ষেত্রে কমিশন সরাসরি গ্রাহকের ব্যাংক একাউন্টে জমা হয়।</p>
                    </div>
                    <div class="screen-content" id="content-2">
                        <span class="screen-mini-tag">আকর্ষণীয় স্থানসমূহ</span>
                        <h3 class="screen-big-title">ঢাকার সেরা প্রজেক্ট লোকেশনসমূহ</h3>
                        <p class="screen-description">কাস্টমারদের জন্য বেছে নেওয়ার সুবিধার্থে একাধিক ঢাকার গুরুত্বপূর্ণ পয়েন্টে প্রজেক্ট বিদ্যমান।</p>
                    </div>
                    <div class="screen-content" id="content-3">
                        <span class="screen-mini-tag">প্রফেশনাল গাইডেন্স</span>
                        <h3 class="screen-big-title">নিজস্ব সেলস ও সাইট সাপোর্ট টিম</h3>
                        <p class="screen-description">আপনার কাস্টমারকে নিয়ে সাইট ঘুরে দেখানো এবং ক্লায়েন্ট হ্যান্ডলিং সম্পন্ন করে আমাদের এক্সপার্ট সেলস টিম।</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <section class="why">
        <div class="wrap">
            <div class="section-head">
                <div class="eyebrow">কেন Bhaiya Housing</div>
                <h2>বিশ্বাসের সাথে আয় করুন</h2>
            </div>
            <div class="why-grid">
                <div class="why-card">
                    <svg viewBox="0 0 24 24" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3 4 7v5c0 5 3.4 8.5 8 9 4.6-.5 8-4 8-9V7l-8-4Z" />
                        <path d="m9 12 2 2 4-4" />
                    </svg>
                    <h3>১২+ বছরের ট্র্যাক রেকর্ড</h3>
                    <p>২০১২ সাল থেকে মানসম্মত নির্মাণ ও সময়মতো হস্তান্তরের অঙ্গীকার নিয়ে কাজ করছে Bhaiya Housing।</p>
                </div>
                <div class="why-card">
                    <svg viewBox="0 0 24 24" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4.5 8-11V5l-8-3-8 3v6c0 6.5 8 11 8 11Z" />
                    </svg>
                    <h3>স্বচ্ছ প্রক্রিয়া</h3>
                    <p>প্রতিটি রেফারেল ট্র্যাক করা হয় এবং কমিশন প্রদানের শর্ত স্পষ্টভাবে জানানো হয়।</p>
                </div>
                <div class="why-card">
                    <svg viewBox="0 0 24 24" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 21h18M6 21V9l6-5 6 5v12M9 21v-6h6v6" />
                    </svg>
                    <h3>একাধিক প্রজেক্ট</h3>
                    <p>ঢাকার বিভিন্ন লোকেশনে চলমান প্রজেক্ট, তাই রেফার করার সুযোগও বেশি।</p>
                </div>
            </div>
            <div class="projects-strip">
                @forelse($projects as $project)
                    <div class="chip">
                        <b>{{ $project->title }}</b>
                        @if ($project->destination)
                            — {{ $project->destination->title }}
                        @endif
                    </div>
                @empty
                    <div class="chip text-gray-400 italic">No projects available</div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="faq" id="faq">
        <div class="wrap">
            <div class="section-head">
                <div class="eyebrow">প্রশ্ন-উত্তর</div>
                <h2>সচরাচর জিজ্ঞাসা</h2>
            </div>
            <div class="faq-list">
                <div class="faq-item open">
                    <button class="faq-q">কে রেফার করতে পারবে?
                        <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </button>
                    <div class="faq-a">
                        <div class="faq-a-inner">বাংলাদেশের যেকোনো প্রাপ্তবয়স্ক ব্যক্তি এই রেফার প্রোগ্রামে অংশ নিতে
                            পারবেন। কোনো বিশেষ যোগ্যতার প্রয়োজন নেই।</div>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-q">কমিশন কখন পাবো?
                        <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </button>
                    <div class="faq-a">
                        <div class="faq-a-inner">রেফার করা গ্রাহকের বুকিং ও রেজিস্ট্রেশন সম্পন্ন হওয়ার পর নির্ধারিত
                            সময়ের মধ্যে কমিশন প্রদান করা হয়।</div>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-q">কতজনকে রেফার করা যাবে?
                        <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </button>
                    <div class="faq-a">
                        <div class="faq-a-inner">যত খুশি ততজনকে রেফার করতে পারবেন। প্রতিটি সফল ক্রয়ের জন্য আলাদাভাবে
                            কমিশন প্রযোজ্য।</div>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-q">রেফারেলের অবস্থা কীভাবে জানবো?
                        <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </button>
                    <div class="faq-a">
                        <div class="faq-a-inner">ফোন বা ইমেইলের মাধ্যমে আমাদের টিমের সাথে যোগাযোগ রেখে আপনার রেফারেলের
                            সর্বশেষ অবস্থা জানতে পারবেন।</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cta-final" id="refer">
        <div class="wrap">
            @if (session('success'))
                <div id="form-alert"
                    style="background: rgba(143, 224, 166, 0.15); border: 1px solid #8FE0A6; color: #8FE0A6; padding: 16px; border-radius: 12px; margin-bottom: 25px; text-align: center; font-weight: 600; font-size: 15px;">
                    <i class="fas fa-check-circle" style="margin-right: 8px;"></i> {{ session('success') }}
                </div>
                <script>
                    document.getElementById('form-alert').scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    setTimeout(() => {
                        document.getElementById('form-alert').style.transition = 'opacity 0.5s ease';
                        document.getElementById('form-alert').style.opacity = '0';
                        setTimeout(() => document.getElementById('form-alert').remove(), 500);
                    }, 5000);
                </script>
            @endif
            @auth
                <h2>আজই রেফার করা শুরু করুন</h2>
                <div class="refer-tabs">
                    <button class="refer-tab-btn active" data-tab="link">লিংক শেয়ার করুন</button>
                    <button class="refer-tab-btn" data-tab="direct">সরাসরি জমা দিন</button>
                </div>

                <div class="refer-pane active" id="refer-link" data-pane="link">
                    <div class="refer-form">
                        <p style="margin-bottom: 12px; font-size: 14px; color: var(--gold-light);">প্রজেক্ট সিলেক্ট করে
                            লিঙ্ক জেনারেট করুন:</p>

                        <div style="margin-bottom: 20px;">
                            <select id="projectSelect"
                                style="width: 100%; background: var(--bg-alt); color: var(--cream); padding: 12px; border: 1px solid var(--line); border-radius: 9px; margin-bottom: 10px;">
                                <option value="">-- প্রজেক্ট নির্বাচন করুন --</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->slug }}">{{ $project->title }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="auth-submit" onclick="generateProjectLink()">লিঙ্ক তৈরি
                                করুন</button>
                        </div>

                        <div id="linkContainer" class="link-list">
                        </div>
                    </div>
                </div>

                <!-- ম্যানুয়াল লিড সাবমিট ট্যাব -->
                <div class="refer-pane" id="refer-direct" data-pane="direct">
                    <form class="refer-form" action="{{ route('lead.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="manual">
                        <div class="row">
                            <div><label>নাম</label><input name="name" type="text" required></div>
                            <div><label>নম্বর</label><input name="phone" type="tel" required></div>
                            <div>
                                <label>ইমেইল (ঐচ্ছিক)</label>
                                <input name="email" type="email" placeholder="example@mail.com">
                            </div>
                            <div><label>পছন্দের স্থান</label>
                                <select name="interested_location"
                                    style="width: 100%; background: var(--bg-alt); color: var(--cream); padding: 12px; border: 1px solid var(--line); border-radius: 9px;">
                                    <option value="">-- প্রজেক্ট নির্বাচন করুন --</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->title }}">{{ $project->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div><label>বাজেট</label><input name="budget" type="number" step="any"></div>
                        </div>
                        <button type="submit" class="auth-submit">সাবমিট করুন</button>
                    </form>
                </div>
            @else
                @php
                    $refId = request()->query('ref') ?? request()->cookie('referred_by');
                @endphp

                @if ($refId)
                    <form class="refer-form" action="{{ route('lead.store') }}" method="POST">
                        @csrf
                        <!-- টাইপ অবশ্যই refer_link যাবে -->
                        <input type="hidden" name="type" value="refer_link">

                        <div class="row">
                            <div><label>আপনার নাম</label><input name="name" type="text" required></div>
                            <div><label>আপনার নম্বর</label><input name="phone" type="tel" required></div>

                            <div>
                                <label>ইমেইল (ঐচ্ছিক)</label>
                                <input name="email" type="email" placeholder="example@mail.com">
                            </div>
                            <div><label>পছন্দের স্থান</label>
                                <select name="interested_location"
                                    style="width: 100%; background: var(--bg-alt); color: var(--cream); padding: 12px; border: 1px solid var(--line); border-radius: 9px;">
                                    <option value="">-- প্রজেক্ট নির্বাচন করুন --</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->title }}">{{ $project->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div><label>বাজেট</label><input name="budget" type="number" step="any"></div>
                        </div>
                        <button type="submit" class="auth-submit">তথ্য জমা দিন</button>
                    </form>
                @else
                    <a href="#dashboard" class="btn-primary">লগইন করে রেফার করুন</a>
                @endif
            @endauth
        </div>
    </section>
    <section class="dashboard-section" id="dashboard">
        <div class="wrap">
            @guest
                <div class="section-head">
                    <div class="eyebrow">অ্যাফিলিয়েট মেম্বার</div>
                    <h2>লগইন করে আপনার রেফারেলের স্ট্যাটাস দেখুন</h2>
                    <p>রেজিস্ট্রেশন করে একবার লগইন করলেই আপনার প্রতিটি রেফারেল কোন স্টেজে আছে তা দেখতে পাবেন।</p>
                </div>

                <div id="authView">
                    <div class="auth-shell">

                        <!-- ── সাধারণ লগইন ও রেজিস্ট্রেশন ট্যাব ── -->
                        <div class="auth-tabs" id="tabHeader">
                            <button
                                class="auth-tab-btn {{ $errors->hasAny(['name', 'email', 'phone', 'password']) ? '' : 'active' }}"
                                onclick="showAuth('login')">লগইন</button>
                            <button
                                class="auth-tab-btn {{ $errors->hasAny(['name', 'email', 'phone', 'password']) ? 'active' : '' }}"
                                onclick="showAuth('register')">রেজিস্ট্রেশন</button>
                        </div>

                        <!-- ১. লগইন ফর্ম (শুধু ইমেইল ও পাসওয়ার্ড) -->
                        <div id="loginSection"
                            style="{{ $errors->hasAny(['name', 'email', 'phone', 'password']) ? 'display: none;' : 'display: block;' }}">
                            <form action="{{ route('affiliated.login') }}" method="POST">
                                @csrf
                                @if ($errors->any())
                                    <div
                                        style="background: rgba(255, 132, 132, 0.15); border: 1px solid #ff8484; color: #ff8484; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 13px; text-align: center;">
                                        <i class="fas fa-exclamation-circle" style="margin-right: 5px;"></i>
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                <div class="auth-field">
                                    <label>ইমেইল এড্রেস</label>
                                    <input name="email" type="email" placeholder="example@mail.com" required>
                                </div>
                                <div class="auth-field">
                                    <label>পাসওয়ার্ড</label>
                                    <input name="password" type="password" placeholder="••••••••" required>
                                </div>
                                <button type="submit" class="auth-submit">লগইন করুন</button>
                                <p onclick="showAuth('forgot')"
                                    style="text-align:center; cursor:pointer; font-size:12px; margin-top:15px; color:var(--gold-light);">
                                    পাসওয়ার্ড ভুলে গেছেন?</p>
                            </form>
                        </div>

                        <!-- ২. রেজিস্ট্রেশন ফর্ম (ইমেইল ও ফোন নম্বর দুটিই) -->
                        <div id="registerSection"
                            style="{{ $errors->hasAny(['name', 'email', 'phone', 'password']) ? 'display: block;' : 'display: none;' }}">
                            <form action="{{ route('affiliated.register') }}" method="POST">
                                @csrf
                                @if ($errors->any() && $errors->hasAny(['name', 'email', 'phone', 'password']))
                                    <div
                                        style="background: rgba(255, 132, 132, 0.15); border: 1px solid #ff8484; color: #ff8484; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 13px; text-align: center;">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                <div class="auth-field"><label>পূর্ণ নাম</label><input name="name" type="text" required>
                                </div>
                                <div class="auth-field"><label>ইমেইল এড্রেস</label><input name="email" type="email" required>
                                </div>
                                <div class="auth-field"><label>মোবাইল নম্বর</label><input name="phone" type="tel" required>
                                </div>
                                <div class="auth-field"><label>পাসওয়ার্ড</label><input name="password" type="password"
                                        placeholder="সর্বনিম্ন ৬ ডিজিট" required></div>
                                <button type="submit" class="auth-submit">অ্যাকাউন্ট তৈরি করুন</button>
                            </form>
                        </div>

                        <!-- ৩. ফরগট পাসওয়ার্ড ফর্ম (ইমেইল দিয়ে) -->
                        <div id="forgotSection" style="display: none;">
                            <h3 style="text-align:center; margin-bottom:20px; color:var(--gold-light); font-size:18px;">
                                পাসওয়ার্ড রিসেট</h3>
                            <form action="{{ route('password.sendOtp') }}" method="POST">
                                @csrf
                                <div class="auth-field"><label>রেজিস্টার্ড ইমেইল এড্রেস</label><input name="email" type="email"
                                        required></div>
                                <button type="submit" class="auth-submit">ওটিপি পাঠান</button>
                                <p onclick="showAuth('login')"
                                    style="text-align:center; cursor:pointer; font-size:12px; margin-top:15px; color:var(--muted);">
                                    ← লগইন-এ ফিরে যান</p>
                            </form>
                        </div>

                    </div>
                </div>
            @endguest
            @auth

                <div class="section-head">
                    <div class="eyebrow">অ্যাফিলিয়েট ড্যাশবোর্ড</div>
                    <h2>স্বাগতম, {{ Auth::user()->name }}</h2>
                    <p>আপনার রেফারেল এবং কমিশনের সর্বশেষ অবস্থা নিচে দেখুন।</p>
                </div>

                <div id="dashPanel" class="dash-panel active" style="display: block;">
                    <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button class="dash-logout"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ← লগআউট করুন
                    </button>
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
                            <tbody>
                                <tr>
                                    <td>রাকিব হাসান</td>
                                    <td>Gulf Panorama</td>
                                    <td>০২ জুন ২০২৬</td>
                                    <td><span class="stage-pill stage-5">কমিশন প্রদত্ত</span></td>
                                    <td>৳২,৫০,০০০</td>
                                </tr>
                                <tr>
                                    <td>শিরিন আক্তার</td>
                                    <td>Daisy Dell</td>
                                    <td>১৮ জুন ২০২৬</td>
                                    <td><span class="stage-pill stage-5">কমিশন প্রদত্ত</span></td>
                                    <td>৳২,০০,০০০</td>
                                </tr>
                                <tr>
                                    <td>ইমরান খান</td>
                                    <td>Olivia</td>
                                    <td>০৫ জুলাই ২০২৬</td>
                                    <td><span class="stage-pill stage-4">বুকিং সম্পন্ন</span></td>
                                    <td>প্রক্রিয়াধীন</td>
                                </tr>
                                <tr>
                                    <td>নাজমুল হক</td>
                                    <td>Park Oasis</td>
                                    <td>০৯ জুলাই ২০২৬</td>
                                    <td><span class="stage-pill stage-3">সাইট ভিজিট</span></td>
                                    <td>—</td>
                                </tr>
                                <tr>
                                    <td>ফারহানা ইসলাম</td>
                                    <td>Sheuly's Garden</td>
                                    <td>১১ জুলাই ২০২৬</td>
                                    <td><span class="stage-pill stage-2">যোগাযোগ করা হয়েছে</span></td>
                                    <td>—</td>
                                </tr>
                                <tr>
                                    <td>তানভীর আহমেদ</td>
                                    <td>Gulf Panorama</td>
                                    <td>১৩ জুলাই ২০২৬</td>
                                    <td><span class="stage-pill stage-1">রেফার করা হয়েছে</span></td>
                                    <td>—</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="link-gen-note">ডেমো ডেটা — বাস্তব ব্যবহারে এই তালিকা আপনার প্রকৃত রেফারেল অনুযায়ী
                        স্বয়ংক্রিয়ভাবে আপডেট হবে।</p>
                </div>
            @endauth
        </div>
    </section>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.reveal, .steps-timeline').forEach(r => observer.observe(r));
    });
</script>
