<div class="header-top-badge">
    ✨ RECREATED AIWAVE CTA &amp; SERVICE CARD CONCEPT · DESIGN REVIEW
</div>

<!-- ২. হেডার থেকে ইনলাইন margin-top:30px সরিয়ে দিন -->
<header class="nav" id="mainNav">
    <div class="wrap nav-inner">

        <!-- 🏠 Left: Brand (Dynamic Home Link) -->
        <a href="{{ route('home.index') }}" class="brand">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 21h18M6 21V9l6-5 6 5v12M9 21v-6h6v6" />
                </svg>
            </div>
            <div>
                <div class="brand-title">Bhaiya Housing</div>
                <div class="brand-subtitle">Refer &amp; Earn</div>
            </div>
        </a>
        <!-- শুধু এই বাটনটি brand লিঙ্কের নিচে অ্যাড করুন -->
        <button id="menuToggle" style="display:none; font-size:24px; color:#175b05; order:2;" aria-label="মেনু টগল করুন"
            aria-expanded="false" aria-controls="mainMenu">
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- 💊 Center: Pill Menu (Dynamic Routes) -->
        <nav class="nav-menu">
            {{-- সব সময়ের জন্য প্রোজেক্ট লিঙ্ক --}}
            <a href="{{ route('affiliated.project') }}" class="nav-item">প্রোজেক্ট</a>
            <a href="#faq" class="nav-item">FAQ</a>
            <a href="#dashboard-section" class="nav-item">ড্যাশবোর্ড</a>

            @auth
                {{-- লগইন করা থাকলে মেনু --}}
                <a href="#refer-section" class="nav-item">রেফার জমা</a>
            @else
                {{-- গেস্ট মোডে মেনু --}}
                <a href="#features" class="nav-item">প্রক্রিয়া</a>
                <a href="#why-bhaiya" class="nav-item">কেন আমরা</a>
            @endauth
        </nav>

        <div class="nav-btns">
            @auth
                {{-- লগইন করা থাকলে প্রোফাইল ও লগআউট --}}
                <div style="display: flex; align-items: center; gap: 15px;">
                    <a href="{{ route('profile.index') }}"
                        style="font-size:14.5px; font-weight:700; color:#0F172A;">প্রোফাইল</a>
                    <form action="{{ route('frontend.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            style="font-size:13px; font-weight:700; color:#ef4444; cursor: pointer;">লগআউট</button>
                    </form>
                </div>
            @else
                <!-- এখানে রাউট লিঙ্ক বসানো হয়েছে -->
                <a href="{{ route('affiliated.login.page') }}"
                    style="font-size:14.5px; font-weight:700; color:#0F172A; padding:10px 20px;">লগইন</a>

                <a href="{{ route('affiliated.register.page') }}" class="btn-aiwave-primary">
                    যোগ দিন
                    <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="3" fill="none">
                        <path d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </a>
            @endauth
        </div>
    </div>
</header>
<style>
    /* ══════ রেসপনসিভ ফিক্স ══════ */
    @media (max-width: 991px) {
        .nav-inner {
            margin-top: 40px;
        }

        /* হেডার ও মেনু */
        #menuToggle {
            display: block !important;
        }

        .nav-btns {
            display: none;
        }

        /* মোবাইলে বাটন হাইড */
        .nav-menu {
            position: absolute;
            top: 76px;
            left: 0;
            width: 100%;
            background: #fff;
            flex-direction: column;
            padding: 20px;
            display: none;
            border-bottom: 2px solid #175b05;
            border-radius: 0 !important;
        }

        .nav-menu.active {
            display: flex;
        }

        /* গ্রিড ফিক্স (সবগুলো ১ বা ২ কলাম হয়ে যাবে) */
        .c-wrap,
        .hub-grid,
        .content-grid,
        .form-card-main,
        .input-grid {
            grid-template-columns: 1fr !important;
        }

        .trust-grid,
        .steps-grid,
        .dash-summary {
            grid-template-columns: 1fr 1fr !important;
        }

        .c-visual-card,
        .glow-overlay {
            display: none;
        }

        .hero-title,
        .main-heading {
            font-size: 32px !important;
        }

        .c-title {
            font-size: 36px !important;
        }
    }

    @media (max-width: 600px) {

        .trust-grid,
        .steps-grid,
        .dash-summary,
        .input-grid {
            grid-template-columns: 1fr !important;
        }

        .main-green-box {
            padding: 40px 20px !important;
            border-radius: 30px;
        }

        .hero-title {
            font-size: 28px !important;
        }

        .nav-inner {
            margin-top: 50px;
        }
    }
</style>
<script>
    // মোবাইল মেনু টগল লজিক
    document.getElementById('menuToggle').addEventListener('click', function () {
        const menu = document.querySelector('.nav-menu');
        menu.classList.toggle('active');
        // আইকন পরিবর্তন (Bars to X)
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-xmark');
    });
</script>
