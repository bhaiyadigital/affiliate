<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bhaiya Housing — Refer &amp; Earn</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@400;600;700;900&family=Hind+Siliguri:wght@300;400;500;600;700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        /* ══════════════════════════════════════════════
       LENIS & BASE RESET
    ══════════════════════════════════════════════ */
        html.lenis,
        html.lenis body {
            height: auto;
        }

        .lenis.lenis-smooth {
            scroll-behavior: auto !important;
        }

        .lenis.lenis-smooth [data-lenis-prevent] {
            overscroll-behavior: contain;
        }

        .lenis.lenis-stopped {
            overflow: hidden;
        }

        .lenis.lenis-scrolling iframe {
            pointer-events: none;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 16px;
        }

        body {
            color: #1E293B;
            line-height: 1.65;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            font-family: 'Hind Siliguri', sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img,
        svg {
            display: block;
            max-width: 100%;
        }

        button {
            cursor: pointer;
            border: none;
            background: none;
        }

        .wrap {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 24px;
        }




        :focus-visible {
            outline: 2px solid #012d20;
            outline-offset: 3px;
        }


        :root {
            --primary: #012d20;
            /* Deep Green */
            --primary-light: #065e43;
            /* Light Green */
            --primary-dark: #001c15;


            --primary-gradient: linear-gradient(135deg, #012d20 0%, #065e43 100%);
            --rainbow-gradient: linear-gradient(90deg, #012d20 0%, #065e43 50%, #001c15 100%);

            --card-bg: #FFFFFF;
            --card-border: #E2E8F0;
            --shadow-glow: 0 20px 40px -10px rgba(23, 91, 5, 0.25);
            --radius-card: 28px;
            --radius-pill: 9999px;
            --transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* ১. বাটন এবং বড় বক্সগুলোর ব্যাকগ্রাউন্ড */
        .btn-green,
        .green-box,
        .main-green-box,
        .hub-display-screen,
        .cta-theme-card,
        .form-dark-side,
        .form-submit-btn {
            background: var(--primary-gradient) !important;
        }

        /* ২. টেক্সট কালার (Heading highlights) */
        .c-title b,
        .brand-title,
        .hub-nav-card.active .nav-texts h4,
        .status-left i {
            color: #012d20 !important;
        }

        /* ৩. আইকন এবং ছোট ব্যাজ */
        .trust-box i,
        .brand-icon,
        .nav-icon-box {
            background: var(--primary-gradient);
            color: #fff !important;
        }

        /* ৪. হোভার এবং বর্ডার */
        .trust-box:hover,
        .hub-nav-card.active {
            border-color: #065e43 !important;
        }

        .hub-nav-card.active::before {
            background: #065e43 !important;
        }



        /* ৬. ইনপুট ফোকাস */
        .input-item input:focus,
        .input-item select:focus {
            border-color: #065e43 !important;
            box-shadow: 0 0 0 4px rgba(0, 157, 10, 0.05);
        }

        .header-top-badge {
            background: var(--primary-gradient) !important;
        }

        #menuToggle {
            color: #012d20 !important;
        }

        .nav-menu.active {
            border-bottom: 2px solid #012d20 !important;
        }

        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .d-1 {
            transition-delay: 0.12s;
        }

        .d-2 {
            transition-delay: 0.24s;
        }

        @keyframes floatSoft {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes marquee {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .anim-float {
            animation: floatSoft 4.5s ease-in-out infinite;
        }

        .theme-gradient-text {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* AiWave Rainbow Subtitle Badge */
        .rainbow-subtitle-badge {
            display: inline-block;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 12px;
        }

        /* Buttons */
        .btn-aiwave-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 36px;
            border-radius: var(--radius-pill);
            background: var(--primary-gradient);
            color: #FFFFFF;
            font-size: 16px;
            font-weight: 800;
            box-shadow: var(--shadow-glow);
            transition: var(--transition);
        }

        .btn-aiwave-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 24px 48px rgba(5, 150, 105, 0.4);
        }

        /* ══════════════════════════════════════════════
       HEADER
    ══════════════════════════════════════════════ */
        /* ব্যাজের জন্য নির্দিষ্ট স্টাইল */
        .header-top-badge {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 32px;
            /* ৩২ পিক্সেল উচ্চতা */
            background: var(--primary-gradient);
            color: #FFFFFF;
            text-align: center;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
            z-index: 10001;
            /* হেডারের চেয়ে বেশি */
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
        }

        /* হেডারের জন্য স্টিকি ফিক্স */
        header.nav {
            position: sticky !important;
            top: 32px;
            /* ব্যাজের উচ্চতা ৩২ পিক্সেল, তাই টপ ৩২ হবে */
            z-index: 10000;
            background: rgba(246, 249, 253, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }

        /* স্ক্রল করলে হেডারের ব্যাকগ্রাউন্ড সাদা হবে */
        header.nav.scrolled {
            background: #FFFFFF;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 76px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            background: var(--primary-gradient);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            box-shadow: 0 6px 16px rgba(5, 150, 105, 0.3);
            transition: var(--transition);
        }

        .brand-icon svg {
            width: 24px;
            height: 24px;
            stroke: #FFFFFF;
            fill: none;
        }

        .brand-title {
            font-weight: 900;
            font-size: 18px;
            color: #065e43;
            line-height: 1.1;
        }

        .brand-subtitle {
            font-size: 11px;
            font-weight: 800;
            color: #B45309;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #FFFFFF;
            padding: 5px;
            border-radius: var(--radius-pill);
            border: 1px solid #E2E8F0;
        }

        .nav-item {
            font-size: 14px;
            font-weight: 600;
            color: #475569;
            padding: 8px 18px;
            border-radius: var(--radius-pill);
            transition: var(--transition);
        }

        .nav-item:hover {
            color: #012d20;
            background: #ECFDF5;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--bg);
            color: var(--cream);
            line-height: 1.65;
            overflow-x: hidden;
            padding-top: 32px;
        }

        a {
            color: inherit;
        }

        img,
        svg {
            display: block;
            max-width: 100%;
        }

        .wrap {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 28px;
        }


        :focus-visible {
            outline: 2px solid var(--gold-light);
            outline-offset: 3px;
        }

        /* subtle backdrop texture */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at 15% 8%, rgba(201, 162, 39, 0.10), transparent 45%),
                radial-gradient(circle at 90% 25%, rgba(201, 162, 39, 0.06), transparent 40%);
            pointer-events: none;
            z-index: 0;
        }


        /* ২. অ্যানিমেশন ইফেক্ট */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-100 {
            transition-delay: 0.2s;
        }

        /* ══════ রেসপনসিভ ফিক্স ══════ */
        @media (max-width: 991px) {
            .nav-inner {
                margin-top: 0 !important;
                /* এখানে ৪০পিএক্স ছিল, সেটি ০ করে দিন */
                height: 70px;
                /* হেডারের উচ্চতা ঠিক রাখার জন্য */
            }

            #menuToggle {
                display: block !important;
            }

            .nav-btns {
                display: none;
            }

            /* মোবাইলে মেনু পজিশন ঠিক করা */
            .nav-menu {
                position: absolute;
                top: 70px;
                /* হেডারের হাইট অনুযায়ী */
                left: 0;
                width: 100%;
                background: #fff;
                display: none;
                flex-direction: column;
                padding: 20px;
                border-bottom: 2px solid #012d20;
            }
        }

        @media (max-width: 600px) {
            .nav-inner {
                margin-top: 0 !important;
                /* এখানে ৫০পিএক্স ছিল, সেটি ০ করে দিন */
            }

            /* উপরের ব্যাজটি মোবাইলে ২ লাইন হয়ে গেলে যাতে হেডার নিচে না নামে */
            .header-top-badge {
                font-size: 10px;
                /* লেখা ছোট করা হলো */
                height: auto;
                padding: 5px;
            }

            body {
                padding-top: 40px;
                /* ব্যাজের উচ্চতা অনুযায়ী অ্যাডজাস্ট */
            }
        }

        /* ৩. ফ্লোটিং অ্যানিমেশন (ডান পাশের কার্ডের জন্য) */
        @keyframes floaty {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .anim-float {
            animation: floaty 6s ease-in-out infinite;
        }

        .custom-hero {
            background-color: #F8FAFC;
            padding: 80px 0;
            overflow: hidden;
        }

        .c-wrap {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 50px;
            align-items: center;
        }

        /* লেফট কন্টেন্ট */
        .c-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ECFDF5;
            border: 1px solid #D1FAE5;
            color: #065F46;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        .c-badge span {
            width: 8px;
            height: 8px;
            background: #012d20;
            border-radius: 50%;
            display: inline-block;
        }

        .c-title {
            font-size: 54px;
            font-weight: 900;
            line-height: 1.2;
            color: #101828;
            margin-bottom: 20px;
        }

        .c-title b {
            color: #047857;
            font-weight: 900;
        }

        .c-desc {
            font-size: 18px;
            color: #475569;
            margin-bottom: 35px;
            line-height: 1.7;
            max-width: 550px;
        }

        .c-desc mark {
            background: #FEF9C3;
            color: #854D0E;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 700;
        }

        .c-btn-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .btn-green {
            background: #047857;
            color: white;
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 20px rgba(4, 120, 87, 0.2);
        }

        .btn-white {
            background: white;
            border: 1px solid #E2E8F0;
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: 700;
            color: #101828;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        /* রাইট সাইড ইলাস্ট্রেশন */
        .c-visual-card {
            background: white;
            border: 1px solid #E2E8F0;
            border-radius: 40px;
            padding: 40px;
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.05);
            position: relative;
            animation: floatAnim 5s ease-in-out infinite;
            z-index: 2;
            /* ইমেজের ওপরে থাকবে */
        }

        .visual-parent {
            position: relative;
            padding: 50px;
            display: inline-block;
        }

        .card-bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            z-index: 1;
            opacity: 0.1;
            pointer-events: none;
        }

        .green-box {
            background: #047857;
            border-radius: 28px;
            padding: 45px 20px;
            text-align: center;
            color: white;
            box-shadow: 0 20px 40px rgba(4, 120, 87, 0.25);
        }

        /* স্ট্যাটস এরিয়া */
        .c-stats {
            display: flex;
            gap: 50px;
            padding-top: 30px;
            border-top: 1px solid #E2E8F0;
        }

        .s-item b {
            display: inline-block;
            /* block এর বদলে inline-block */
            font-size: 30px;
            font-weight: 900;
            color: #101828;
            line-height: 1.1;
            vertical-align: baseline;
            /* লেখাগুলোকে সমান সমান্তরালে রাখবে */
        }

        .s-item span {
            display: block;
            font-size: 13px;
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 5px;
        }

        /* নিচের ট্রাস্ট বার */
        .trust-section {
            padding: 50px 0;
        }

        .line-divider {
            width: 100%;
            height: 1px;
            background-color: #86a9a0;
            display: block;
            margin: 0;
        }

        .trust-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            padding: 0 10px;
        }

        .trust-box {
            background: #F8FAFC;
            padding: 25px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid #F1F5F9;
            transition: 0.3s;
        }

        .trust-box:hover {
            border-color: #10B981;
            transform: translateY(-3px);
        }

        .trust-box i {
            width: 50px;
            height: 50px;
            background: #ecfdf5 !important;
            /* হালকা গ্রিন ব্যাকগ্রাউন্ড */
            border-radius: 12px;
            display: flex !important;
            align-items: center;
            justify-content: center;
            color: #012d20 !important;
            /* আপনার দেওয়া ডিপ গ্রিন কালার */
            font-size: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.04);

            /* ⚠️ এই ৩টি লাইন আইকন শো করার জন্য সবচেয়ে জরুরি */
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
            font-style: normal !important;

            flex-shrink: 0;
        }

        /* ══════ রেসপনসিভ ফিক্স (মোবাইলেও কার্ড দেখাবে) ══════ */
        @media (max-width: 991px) {
            .c-wrap {
                grid-template-columns: 1fr !important;
                /* কলাম একটি হয়ে যাবে */
                text-align: center;
                gap: 40px;
            }

            /* ফ্লোটিং কার্ড এখন দৃশ্যমান হবে */
            .visual-parent {
                display: block !important;
                margin: 0 auto !important;
                max-width: 450px;
                padding: 20px;
            }

            .c-visual-card {
                display: block !important;
                padding: 30px 20px !important;
            }

            .nav-btns {
                display: none;
            }

            /* মোবাইলে মেনু পজিশন */
            .nav-menu {
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background: #fff;
                display: none;
                flex-direction: column;
                padding: 20px;
                border-bottom: 2px solid #012d20;
            }

            /* স্ট্যাটাস সেকশন এক লাইনে রাখার জন্য */
            .c-stats {
                justify-content: center !important;
                gap: 15px !important;
                flex-wrap: nowrap !important;
                /* ভাঙবে না */
            }

            .s-item b {
                font-size: 16px !important;
                /* সাইজ কমানো হলো যাতে ১ লাইনে থাকে */
                white-space: nowrap !important;
            }

            .s-item span {
                font-size: 10px !important;
            }
        }

        @media (max-width: 600px) {
            .nav-inner {
                margin-top: 0 !important;
            }

            .header-top-badge {
                font-size: 10px;
                height: auto;
                padding: 5px;
            }

            body {
                padding-top: 40px;
            }

            /* ছোট ফোনে ৩ লাখ টাকা লেখাটি অ্যাডজাস্টমেন্ট */
            .green-box h2 {
                font-size: 32px !important;
                white-space: nowrap;
            }
        }

        @keyframes floatAnim {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        /* ---------------- STEPS ---------------- */
        .section-head {
            max-width: 640px;
            margin: 0 auto 52px;
            text-align: center;
            color: #f4efe2;
        }

        .section-head .eyebrow {
            justify-content: center;
        }

        .section-head .eyebrow::before {
            display: none;
        }

        .section-head h2 {
            font-weight: 700;
            font-size: clamp(26px, 3.4vw, 38px);
            color: #f4efe2;
        }

        .section-head p {
            color: var(--muted);
            margin-top: 14px;
            font-size: 15.5px;
        }

        .steps {
            padding: 96px 0 100px;
            border-top: 1px solid var(--line);
        }

        .step-track {
            position: relative;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 26px;
        }

        .step-track::before {
            content: "";
            position: absolute;
            top: 46px;
            left: 8%;
            right: 8%;
            height: 2px;
            background-image: repeating-linear-gradient(90deg, var(--gold-light) 0 10px, transparent 10px 20px);
            opacity: 0.4;
        }

        .step-card {
            position: relative;
            text-align: left;
        }

        .step-num {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 92px;
            height: 92px;
            border-radius: 50%;
            background: var(--surface);
            border: 1px solid var(--line);
            margin-bottom: 22px;
            position: relative;
            z-index: 2;
        }

        .step-num svg {
            width: 38px;
            height: 38px;
            stroke: var(--gold-light);
            fill: none;
        }

        .step-tag {
            font-weight: 700;
            color: var(--gold-light);
            font-size: 12.5px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .step-card h3 {
            font-size: 20px;
            font-weight: 700;
            margin: 8px 0 10px;
            color: var(--cream);
        }

        .step-card p {
            font-size: 14.5px;
            color: var(--muted);
        }


        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* --- Feature Hub Exact Design CSS --- */
        .feature-hub-section {
            background: white;
            padding: 50px 0;
        }

        .section-head-hub {
            text-align: center;
            margin-bottom: 50px;
        }

        .top-badge {
            display: inline-block;
            background: #E8F7F0 !important;
            color: #012d20 !important;
            font-size: 12px;
            font-weight: 800;
            padding: 6px 18px;
            border-radius: 50px;
            margin-bottom: 15px;
        }

        .hub-main-title {
            font-size: 40px;
            font-weight: 800;
            color: #101B37 !important;
            margin: 0 auto 15px auto;
        }

        .hub-sub-title {
            color: #374151 !important;
            margin: 0 auto;
        }

        .hub-outer-card {
            background: #F8FBFF !important;
            border: 1px solid #E9F0F8;
            border-radius: 40px;
            padding: 40px;
        }

        .hub-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 40px;
            align-items: center;
        }

        .hub-nav-card {
            background: #fff !important;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 22px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 18px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: 0.3s;
        }

        .hub-nav-card.active {
            background: #EEF9F5 !important;
            border-color: #007D4F !important;
        }

        .hub-nav-card.active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 6px;
            background: #007D4F !important;
        }

        .nav-icon-box {
            width: 50px;
            height: 50px;
            background: #F1F5F9;
            color: #012d20 !important;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #101B37;
            font-size: 18px;
        }

        .hub-nav-card.active .nav-icon-box {
            background: #012d20 !important;
            color: #fff !important;
        }

        .hub-display-screen {
            background: linear-gradient(135deg, #012d20 0%, #065e43 100%) !important;
            border-radius: 35px;
            padding: 60px 50px;
            min-height: 480px;
            display: flex;
            align-items: center;
            color: #fff !important;
            box-shadow: 0 30px 60px rgba(0, 125, 79, 0.2);
        }

        .screen-mini-tag {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 12px;
            margin-bottom: 25px;
        }

        .screen-big-title {
            font-size: 38px;
            font-weight: 800;
            margin-bottom: 25px;
            color: #fff !important;
        }

        .screen-content {
            display: none;
        }

        .screen-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        /* ══════════════════════════════════════════════
   FEATURE HUB RESPONSIVE (WHY BHAIYA SECTION)
══════════════════════════════════════════════ */

        @media (max-width: 991px) {
            .feature-hub-section {
                padding: 40px 0;
            }

            .hub-main-title {
                font-size: 30px;
                /* মোবাইলে শিরোনাম একটু ছোট */
            }

            .hub-outer-card {
                padding: 20px;
                /* বাইরের কার্ডের প্যাডিং কমানো হয়েছে */
                border-radius: 30px;
            }

            .hub-grid {
                grid-template-columns: 1fr;
                /* ২ কলাম থেকে ১ কলামে পরিবর্তন */
                gap: 30px;
            }

            .hub-sidebar {
                order: 1;
                /* বাটনগুলো উপরে থাকবে */
            }

            .hub-display-screen {
                order: 2;
                /* সবুজ কন্টেন্ট বক্স নিচে থাকবে */
                min-height: auto;
                /* হাইট অটো করা হয়েছে যাতে কন্টেন্ট অনুযায়ী বাড়ে */
                padding: 40px 30px;
                border-radius: 25px;
            }

            .screen-big-title {
                font-size: 28px;
            }
        }

        @media (max-width: 600px) {
            .hub-nav-card {
                padding: 15px;
                gap: 12px;
                border-radius: 15px;
            }

            .nav-icon-box {
                width: 40px;
                height: 40px;
                font-size: 16px;
                flex-shrink: 0;
                /* আইকন যাতে ছোট হয়ে চ্যাপ্টা না হয়ে যায় */
            }

            .hub-nav-card h4 {
                font-size: 15px;
                line-height: 1.4;
            }

            .hub-nav-card p {
                font-size: 12px;
                display: none;
                /* খুব ছোট ফোনে বর্ণনা হাইড করে শুধু শিরোনাম রাখা হয়েছে ক্লিনিংয়ের জন্য */
            }

            .hub-nav-card.active p {
                display: block;
                /* শুধুমাত্র একটিভ কার্ডের বর্ণনা দেখাবে */
                margin-top: 5px;
            }

            .screen-big-title {
                font-size: 24px;
                margin-bottom: 15px;
            }

            .screen-description {
                font-size: 14px;
            }
        }

        /* ---------------- FINAL CTA / FOOTER ---------------- */
        .cta-final {
            padding: 90px 0;
            text-align: center;
            background: radial-gradient(circle at 50% 0%, rgba(201, 162, 39, 0.12), transparent 60%);
            border-top: 1px solid var(--line);
        }

        .cta-final h2 {
            font-weight: 700;
            font-size: clamp(26px, 3.6vw, 40px);
            max-width: 620px;
            margin: 0 auto 16px;
        }

        .cta-final p {
            color: var(--muted);
            max-width: 480px;
            margin: 0 auto 34px;
        }

        .refer-form {
            max-width: 560px;
            margin: 0 auto;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 30px;
            text-align: left;
            box-shadow: var(--shadow);
        }

        .refer-form .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 14px;
        }

        .refer-form label {
            font-size: 12.5px;
            color: var(--muted);
            display: block;
            margin-bottom: 6px;
            letter-spacing: 0.3px;
        }

        .refer-form input,
        .refer-form select {
            width: 100%;
            background: var(--bg-alt);
            border: 1px solid var(--line);
            border-radius: 9px;
            padding: 12px 14px;
            color: var(--cream);
            font-size: 14.5px;
        }

        .refer-form input:focus,
        .refer-form select:focus {
            border-color: var(--gold-light);
        }

        .refer-form .full {
            grid-column: 1/-1;
        }

        .refer-form button {
            width: 100%;
            margin-top: 6px;
            background: var(--gold);
            color: #17281f;
            border: none;
            border-radius: 9px;
            padding: 14px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
        }

        .form-note {
            font-size: 12px;
            color: var(--muted);
            margin-top: 12px;
            text-align: center;
        }

        footer {
            padding: 50px 0 34px;
            border-top: 1px solid var(--line);
            text-align: center;
            color: var(--muted);
            font-size: 13px;
        }

        footer .foot-brand {
            color: var(--cream);
            font-size: 17px;
            margin-bottom: 10px;
        }

        footer .foot-contact {
            margin-bottom: 18px;
            display: flex;
            gap: 18px;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* FAQ Section Styles */
        .faq-section {
            padding: 50px 0;
            background-color: #fff;
        }

        .faq-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .faq-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: #B45309;
            font-weight: 700;
            font-size: 16px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .orange-line {
            width: 25px;
            height: 2px;
            background-color: #B45309;
        }

        .faq-main-title {
            font-size: 42px;
            font-weight: 900;
            color: #101B37;
        }

        .faq-wrapper {
            max-width: 850px;
            margin: 0 auto;
        }

        .faq-item {
            border-bottom: 1px solid #EDF2F7;
        }

        .faq-question {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 0;
            background: none;
            border: none;
            font-size: 18px;
            font-weight: 700;
            color: #101B37;
            cursor: pointer;
            text-align: left;
            transition: 0.3s;
        }

        .faq-icon {
            width: 32px;
            height: 32px;
            background-color: #F1F5F9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #64748B;
            transition: all 0.3s ease;
        }

        /* Open State Styling */
        .faq-item.active .faq-question {
            color: #101B37;
        }

        .faq-item.active .faq-icon {
            background-color: #0B1120;
            /* Dark Navy from image */
            color: #fff;
            transform: rotate(45deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .faq-item.active .faq-answer {
            max-height: 200px;
        }

        .faq-answer p {
            padding-bottom: 30px;
            color: #64748B;
            font-size: 15px;
            line-height: 1.8;
        }

        /* Hover effect */
        .faq-question:hover .faq-icon {
            background-color: #E2E8F0;
        }

        /* ---------------- signature SVG animations ---------------- */
        .flow-line {
            stroke-dasharray: 6 8;
            animation: dashmove 3.4s linear infinite;
        }

        @keyframes dashmove {
            to {
                stroke-dashoffset: -140;
            }
        }

        .pulse-ring {
            animation: pulse 2.6s ease-in-out infinite;
            transform-origin: center;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.55;
            }

            50% {
                transform: scale(1.12);
                opacity: 0.15;
            }
        }

        .float-coin {
            animation: floaty 3.6s ease-in-out infinite;
        }

        @keyframes floaty {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-9px);
            }
        }

        .float-coin.d2 {
            animation-delay: .8s;
        }

        .float-coin.d3 {
            animation-delay: 1.6s;
        }

        @media (prefers-reduced-motion: reduce) {

            .flow-line,
            .pulse-ring,
            .float-coin {
                animation: none !important;
            }
        }

        /* ---------------- METHODS ---------------- */
        .methods {
            padding: 90px 0 20px;
        }

        .method-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 26px;
        }

        .method-card {
            position: relative;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 38px 32px 32px;
        }

        .method-badge {
            position: absolute;
            top: -16px;
            left: 32px;
            background: var(--gold);
            color: #17281f;
            font-weight: 800;
            font-size: 13px;
            padding: 6px 14px;
            border-radius: 999px;
        }

        .method-card svg {
            width: 32px;
            height: 32px;
            stroke: var(--gold-light);
            fill: none;
            margin-bottom: 18px;
        }

        .method-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .method-card p {
            font-size: 14.5px;
            color: var(--muted);
            margin-bottom: 20px;
        }

        .method-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--gold-light);
            text-decoration: none;
            font-weight: 600;
            font-size: 14.5px;
        }

        .method-link svg {
            width: 16px;
            height: 16px;
            margin: 0;
            stroke: var(--gold-light);
        }

        /* ---------------- TABS (refer section) ---------------- */
        .refer-tabs {
            display: flex;
            gap: 10px;
            max-width: 560px;
            margin: 0 auto 22px;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 6px;
        }

        .refer-tab-btn {
            flex: 1;
            border: none;
            background: none;
            color: var(--muted);
            font-weight: 600;
            font-size: 14px;
            padding: 11px 10px;
            border-radius: 999px;
            cursor: pointer;
            transition: background .2s ease, color .2s ease;
        }

        .refer-tab-btn.active {
            background: var(--gold);
            color: #17281f;
        }

        .refer-pane {
            display: none;
        }

        .refer-pane.active {
            display: block;
        }

        /* link generator */
        .link-gen-intro {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 18px;
        }

        .link-list {
            margin-top: 6px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .link-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            background: var(--bg-alt);
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 12px 14px;
        }

        .link-row .lname {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--cream);
            flex-shrink: 0;
            min-width: 110px;
        }

        .link-row .lurl {
            font-size: 12.5px;
            color: var(--muted);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            flex: 1;
        }

        .copy-btn {
            background: none;
            border: 1px solid var(--line);
            color: var(--gold-light);
            border-radius: 7px;
            padding: 7px 12px;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            flex-shrink: 0;
            transition: border-color .2s ease, background .2s ease;
        }

        .copy-btn:hover {
            border-color: var(--gold-light);
            background: rgba(201, 162, 39, 0.08);
        }

        .link-gen-note {
            font-size: 12.5px;
            color: var(--muted);
            margin-top: 14px;
            text-align: center;
        }

        .dashboard-section {
            padding: 100px 0;
            position: relative;
            /* আপনার দেওয়া ইমেজটি ব্যাকগ্রাউন্ড হিসেবে */
            background-image: url("<?php echo e(asset('./images/hero/backgroud.jpeg')); ?>") !important;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            overflow: hidden;
        }

        /* আগের সব ::before (টেক্সচার/কালার) বাদ দেওয়া হয়েছে */
        .dashboard-section::before {
            display: none !important;
        }


        #dashPanel {
            position: relative;
            z-index: 5;
            background: rgba(255, 255, 255, 0.03) !important;
            /* খুব হালকা সাদা স্বচ্ছতা */
            backdrop-filter: blur(15px);
            /* পেছনের ইমেজ ব্লার করার জন্য */
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
            padding: 60px 40px;
            color: #ffffff;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.5);
        }

        /* Dashboard Dark Panel */
        .dash-dark-container {
            background: #012d20;
            /* স্ক্রিনশটের মতো ডার্ক গ্রিন */
            border-radius: 40px;
            padding: 60px 40px;
            color: #fff;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.2);
        }

        .dash-logout {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
            cursor: pointer;
            text-decoration: underline;
            margin-bottom: 30px;
        }

        .dash-summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .dash-stat {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px 20px;
            text-align: left;
        }

        .dash-stat b {
            display: block;
            font-size: 32px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 5px;
        }

        .dash-stat span {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 500;
        }

        .dash-table-wrap {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            overflow: hidden;
        }

        .dash-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .dash-table th {
            padding: 20px;
            font-size: 16px;
            color: #fff;
            text-transform: uppercase;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dash-table td {
            padding: 20px;
            font-size: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .stage-pill {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
        }

        .stage-5 {
            background: rgba(16, 185, 129, 0.2);
            color: #fff;
        }

        .stage-4 {
            background: rgba(245, 158, 11, 0.2);
            color: #fff;
        }

        .stage-3 {
            background: rgba(59, 130, 246, 0.2);
            color: #fff;
        }


        @media (max-width: 991px) {
            .dash-summary {
                grid-template-columns: 1fr 1fr;
            }

            .dash-dark-container {
                padding: 30px 20px;
            }
        }

        /* Container styling */
        .referral-form-container {
            padding: 20px 0 100px;
            display: flex;
            justify-content: center;
        }

        .form-card-main {
            width: 100%;
            max-width: 1100px;
            background: #fff;
            border-radius: 40px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.05);
            border: 1px solid #f0f4f8;
        }

        /* Left Dark Side */
        .form-dark-side {
            flex: 0 0 42%;
            background: #06523e;
            /* Deep Dark Blue/Black */
            padding: 60px 50px;
            color: #fff;
        }

        .side-title {
            font-size: 32px;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 20px;
        }

        .side-desc {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .benefit-list {
            list-style: none;
            padding: 0;
        }

        .benefit-list li {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            font-weight: 500;
            font-size: 15px;
        }

        .icon-circle {
            width: 26px;
            height: 26px;
            background: #10B981;
            /* Green color */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: white;
            flex-shrink: 0;
        }

        /* Right White Side */
        .form-white-side {
            flex: 1;
            padding: 60px 50px;
            background: #fff;
        }

        .form-input-title {
            font-size: 24px;
            font-weight: 800;
            color: #101B37;
            margin-bottom: 35px;
        }

        .input-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .input-item {
            display: flex;
            flex-direction: column;
        }

        .input-item label {
            font-size: 11px;
            font-weight: 700;
            color: #768191;
            text-transform: uppercase;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .input-item input,
        .input-item select {
            width: 100%;
            padding: 16px 20px;
            background: #F8FBFF;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            font-size: 15px;
            color: #334155;
            outline: none;
            transition: 0.3s;
        }

        .input-item input:focus,
        .input-item select:focus {
            border-color: #10B981;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.05);
        }

        /* Submit Button */
        .form-submit-btn {
            width: 100%;
            margin-top: 40px;
            background: #06523e;
            /* Matching left side */
            color: #fff;
            padding: 20px;
            border-radius: 15px;
            font-weight: 800;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .form-submit-btn:hover {
            background: #10B981;
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 991px) {
            .form-card-main {
                flex-direction: column;
            }

            .form-dark-side {
                padding: 40px 30px;
            }

            .form-white-side {
                padding: 40px 30px;
            }
        }

        @media (max-width: 600px) {
            .input-grid {
                grid-template-columns: 1fr;
            }

            .side-title {
                font-size: 26px;
            }
        }

        /* Referral CTA Section Styles - Theme Version */
        .referral-cta-section {
            padding: 60px 0 50px;
            background-color: #f8fafc;
        }

        .cta-theme-card {
            background-color: #005a3c;
            /* Bhaiya Housing Theme Green */
            border-radius: 40px;
            padding: 80px 40px;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 90, 60, 0.25);
            position: relative;
            overflow: hidden;
        }

        .cta-title {
            font-size: 48px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .cta-subtitle {
            font-size: 17px;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 45px;
        }

        .cta-btn-wrapper {
            display: flex;
            justify-content: center;
        }

        /* White Button with Green Text and Cut-Corner */
        .cta-white-btn {
            background-color: #ffffff;
            color: #005a3c;
            text-decoration: none;
            padding: 10px 45px;
            font-size: 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            /* Top-right corner cut effect as per image */
            border-radius: 8px;
        }

        .cta-white-btn span {
            font-size: 16px;
        }



        .cta-white-btn:hover {
            background-color: #f0fdf4;
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        /* Responsive */
        @media (max-width: 991px) {
            .cta-title {
                font-size: 36px;
            }

            .cta-theme-card {
                padding: 60px 20px;
            }
        }

        @media (max-width: 600px) {
            .cta-title {
                font-size: 28px;
            }

            .cta-white-btn {
                width: 100%;
                padding: 18px 30px;
            }
        }

        .refer-hero-section {
            padding: 100px 0;
            background-color: #f8fafc;

        }

        .main-green-box {
            position: relative;

            /* বামে গাঢ় (#012d20), মাঝখানে হালকা (#065e43), ডানে গাঢ় (#012d20) */
            background: linear-gradient(to right, #012d20 0%, #065e43 50%, #012d20 100%) !important;

            border-radius: 60px;
            /* পিল শেপড রাউন্ডেড কোণা */
            padding: 80px 60px;
            overflow: hidden;

            /* আপনার নতুন গ্রিন অনুযায়ী শ্যাডো অ্যাডজাস্টমেন্ট */
            box-shadow: 0 40px 80px rgba(23, 91, 5, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* শাইন ইফেক্ট আরও ফুটিয়ে তোলার জন্য ওভারলে অ্যাডজাস্টমেন্ট (ঐচ্ছিক) */
        .glow-overlay {
            position: absolute;
            top: -20%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            pointer-events: none;
            z-index: 1;
        }

        /* ৪. গ্রিড লেআউট */
        .content-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 50px;
            align-items: center;
            position: relative;
            z-index: 10;
        }

        /* ৫. টেক্সট স্টাইল */
        .top-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            color: #fcd34d;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 2px;
            padding: 8px 20px;
            border-radius: 50px;
            margin-bottom: 25px;
        }

        .hero-title {
            color: #ffffff;
            font-size: 54px;
            font-weight: 900;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-desc {
            color: rgba(255, 255, 255, 0.8);
            font-size: 18px;
            line-height: 1.7;
            margin-bottom: 40px;
            max-width: 500px;
        }

        /* ৬. বাটন */
        .cta-button {
            display: inline-block;
            background: #ffffff;
            color: #005a3c;
            padding: 18px 40px;
            border-radius: 100px;
            font-weight: 800;
            font-size: 18px;
            text-decoration: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: 0.3s ease;
        }

        .cta-button:hover {
            transform: translateY(-3px);
        }

        /* ৭. গ্লাস কার্ড (Glassmorphism) */
        .glass-tracker-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
            padding: 40px;
            color: #ffffff;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .stat-number {
            display: inline-block;
            min-width: 20px;
            /* যাতে সংখ্যা বাড়লে অন্য লেখা ধাক্কা না দেয় */
        }

        .status-left {
            font-size: 13px;
            font-weight: 500;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-right {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.616);
            font-weight: 700;
            text-transform: uppercase;
        }

        .card-amount {
            font-size: 58px;
            font-weight: 900;
            margin-bottom: 20px;
            letter-spacing: -1px;
        }

        .card-footer {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.6;
        }

        /* ৮. মোবাইল রেসপনসিভনেস (যাতে হিজিবিজি না হয়) */
        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-title {
                font-size: 40px;
            }

            .hero-desc {
                margin: 0 auto 30px;
            }

            .main-green-box {
                padding: 60px 30px;
            }

            .card-amount {
                font-size: 45px;
            }
        }

        /* ══════════════════════════════════════════════
   DASHBOARD SECTION RESPONSIVE FIX
══════════════════════════════════════════════ */

        @media (max-width: 991px) {
            .dashboard-section {
                padding: 60px 0;
                /* প্যাডিং কমানো হয়েছে */
            }

            .section-head h2 {
                font-size: 28px !important;
                text-align: center;
            }

            .section-head p {
                text-align: center;
                font-size: 14px;
            }

            /* ড্যাশবোর্ড কার্ডের ২ কলাম লেআউট */
            .dash-summary {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 15px;
            }

            .dash-stat {
                padding: 20px 15px;
            }

            .dash-stat b {
                font-size: 24px;
                /* নম্বর একটু ছোট করা হয়েছে */
            }
        }

        @media (max-width: 768px) {

            /* টেবিল রেসপনসিভ ফিক্স */
            .dash-table-wrap {
                overflow-x: auto;
                /* মোবাইলে টেবিলটি ডানে-বামে স্ক্রল করা যাবে */
                -webkit-overflow-scrolling: touch;
                border-radius: 15px;
            }

            .dash-table {
                min-width: 700px;
                /* টেবিল যাতে খুব বেশি চ্যাপ্টা না হয় */
            }

            .dash-table th,
            .dash-table td {
                padding: 15px 12px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .dash-summary {
                grid-template-columns: 1fr !important;
                /* একদম ছোট ফোনে ১ কলাম */
            }

            .dash-logout {
                display: block;
                margin: 0 auto 20px;
                text-align: center;
            }

            .section-head h2 {
                font-size: 24px !important;
            }
        }

        /* ══════════════════════════════════════════════
   DASHBOARD TABLE - MOBILE VIEW FIX (Final)
══════════════════════════════════════════════ */

        @media screen and (max-width: 768px) {

            /* আগের দেওয়া কোনো min-width থাকলে তা বাতিল করা */
            .dash-table {
                min-width: 100% !important;
                display: block !important;
            }

            /* টেবিল হেডার (Desktop Header) পুরোপুরি হাইড করা */
            .dash-table thead {
                display: none !important;
            }

            .dash-table tbody,
            .dash-table tr {
                display: block !important;
                width: 100% !important;
            }

            /* প্রতিটি রো (Row) এখন একটি কার্ডের মতো দেখাবে */
            .dash-table tr {
                background: rgba(255, 255, 255, 0.05) !important;
                border: 1px solid rgba(255, 255, 255, 0.1) !important;
                margin-bottom: 15px !important;
                border-radius: 12px !important;
                padding: 10px !important;
            }

            /* প্রতিটি সেল (Cell) সেটিংস */
            .dash-table td {
                display: flex !important;
                justify-content: space-between !important;
                /* লেবেল বামে, ডেটা ডানে */
                align-items: center !important;
                padding: 10px 5px !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
                text-align: right !important;
                width: 100% !important;
                color: #FFFFFF !important;
                font-size: 14px !important;
            }

            .dash-table td:last-child {
                border-bottom: none !important;
            }

            /* বাম পাশে গোল্ডেন লেবেল দেখানোর জন্য (এটি data-label অ্যাট্রিবিউট থেকে আসে) */
            .dash-table td::before {
                content: attr(data-label) !important;
                font-weight: 700 !important;
                color: #e5c566 !important;
                font-size: 12px !important;
                text-transform: uppercase;
                text-align: left !important;
                flex: 1;
                /* লেবেলকে জায়গা দেওয়া */
            }

            /* কমিশনের টাকার অঙ্ক বা স্ট্যাটাস টেক্সটকে ডানে রাখা */
            .dash-table td>span,
            .dash-table td {
                flex: 1;
            }

            /* স্টেজ পিল মোবাইলে অ্যাডজাস্টমেন্ট */
            .stage-pill {
                display: inline-block !important;
                font-size: 10px !important;
                padding: 4px 10px !important;
                margin-left: auto;
                /* ডানে পুশ করা */
            }
        }
    </style>
</head>

<body>

    <?php echo $__env->make('frontend.landing.front.landingNav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <main>
        <?php echo $__env->yieldContent('content'); ?>

    </main>
    <?php echo $__env->make('frontend.landing.front.landingFooter', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ১. অ্যানিমেশন অবজারভার (Reveal effect)
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.15 });

            document.querySelectorAll('.reveal').forEach(r => observer.observe(r));

            // ২. রেফার মেথড ট্যাব (যদি ট্যাব ইন্টারফেস ব্যবহার করেন)
            document.querySelectorAll('.refer-tab-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.refer-tab-btn').forEach(b => b.classList.remove('active'));
                    document.querySelectorAll('.refer-pane').forEach(p => p.classList.remove('active'));
                    btn.classList.add('active');
                    const targetPane = document.querySelector(`.refer-pane[data-pane="${btn.dataset.tab}"]`);
                    if (targetPane) targetPane.classList.add('active');
                });
            });

            // ৩. লারাভেল এরর থাকলে অটো স্ক্রল করা
            <?php if($errors->any()): ?>
                const element = document.getElementById('dashboard-section');
                if (element) {
                    element.scrollIntoView({ behavior: 'smooth' });
                }
            <?php endif; ?>
});

        // ৪. FAQ টগল ফাংশন
        function toggleFaq(button) {
            const item = button.parentElement;
            const isOpen = item.classList.contains('active');
            document.querySelectorAll('.faq-item').forEach(el => el.classList.remove('active'));
            if (!isOpen) item.classList.add('active');
        }

        // ৫. "কেন ভাইয়া" হাব আপডেট ফাংশন
        function updateHub(index, element) {
            document.querySelectorAll('.hub-nav-card').forEach(card => card.classList.remove('active'));
            element.classList.add('active');
            document.querySelectorAll('.screen-content').forEach(content => content.classList.remove('active'));
            document.getElementById('content-' + index).classList.add('active');
        }

        // ৬. লিংক জেনারেট এবং কপি করার ফাংশন (Auth থাকলে কাজ করবে)
        function generateProjectLink() {
            const select = document.getElementById('projectSelect');
            if (!select) return;
            const slug = select.value;
            const projectName = select.options[select.selectedIndex].text;
            const refCode = "<?php echo e(auth()->check() ? auth()->user()->referral_code : ''); ?>";

            if (!slug) { alert('প্রজেক্ট সিলেক্ট করুন'); return; }

            const baseUrl = window.location.origin + '/project/' + slug + '?ref=' + refCode;

            const container = document.getElementById('linkContainer');
            if (container) {
                container.innerHTML = `
            <div class="link-row" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; background: #F8FBFF; border-radius: 10px; border: 1px solid #E2E8F0; margin-top: 15px;">
                <span class="lname" style="flex: 0 0 100px; color: #1E293B; font-size: 13px;">${projectName}</span>
                <span class="lurl" id="generated-link-text" style="flex: 1; color: #64748B; font-size: 11px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin: 0 10px;">${baseUrl}</span>
                <button type="button" class="copy-btn" style="flex: 0 0 70px; background: #012d20; color: white; border-radius: 6px; padding: 5px; font-size: 12px; cursor: pointer;" onclick="copySpecificLink('generated-link-text', this)">কপি</button>
            </div>
        `;
            }
        }

        function copySpecificLink(id, btn) {
            const text = document.getElementById(id).innerText;
            navigator.clipboard.writeText(text).then(() => {
                const originalText = btn.textContent;
                btn.textContent = 'কপি হয়েছে ✓';
                setTimeout(() => {
                    btn.textContent = originalText;
                }, 1500);
            });
        }
        document.addEventListener('DOMContentLoaded', function () {
            // ১. ইংরেজি সংখ্যাকে বাংলায় রূপান্তর এবং ফরম্যাট করার ফাংশন
            function formatBengali(number) {
                const digits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

                // কমা ফরম্যাটিং (যেমন: 3,00,000)
                let formatted = number.toLocaleString('en-IN');

                // ইংরেজি ডিজিটকে বাংলা ডিজিটে রূপান্তর
                return formatted.replace(/\d/g, (d) => digits[d]);
            }

            // ২. কাউন্টার অ্যানিমেশন ফাংশন
            function startCounter(el) {
                const target = parseInt(el.getAttribute('data-target'));
                const duration = 3000; // ২ সেকেন্ড সময় নিবে
                const start = 0;
                const startTime = performance.now();

                function update(currentTime) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);

                    // সংখ্যা গণনা
                    const currentCount = Math.floor(progress * target);
                    el.innerText = formatBengali(currentCount);

                    if (progress < 1) {
                        requestAnimationFrame(update);
                    } else {
                        el.innerText = formatBengali(target); // নিশ্চিত করতে যে টার্গেট সংখ্যায় পৌঁছেছে
                    }
                }
                requestAnimationFrame(update);
            }

            // ৩. স্ক্রল করলে অ্যানিমেশন শুরু করার জন্য Observer
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const numbers = entry.target.querySelectorAll('.stat-number');
                        numbers.forEach(num => startCounter(num));
                        counterObserver.unobserve(entry.target); // একবার অ্যানিমেশন হয়ে গেলে আর হবে না
                    }
                });
            }, { threshold: 0.5 });

            // সেকশনটি ট্র্যাক করা শুরু করুন
            const statsSection = document.querySelector('.c-stats');
            if (statsSection) {
                counterObserver.observe(statsSection);
            }
        });
    </script>
</body>

</html>
<?php /**PATH C:\laragon\www\affiliate-project\resources\views/frontend/layouts/landingFront.blade.php ENDPATH**/ ?>