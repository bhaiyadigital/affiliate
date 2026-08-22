<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bhaiya Housing — Refer &amp; Earn</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@400;600;700;900&family=Hind+Siliguri:wght@300;400;500;600;700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
            <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
       /* ══════════════════════════════════════════════
       LENIS & BASE RESET
    ══════════════════════════════════════════════ */
    html.lenis, html.lenis body { height: auto; }
    .lenis.lenis-smooth { scroll-behavior: auto !important; }
    .lenis.lenis-smooth [data-lenis-prevent] { overscroll-behavior: contain; }
    .lenis.lenis-stopped { overflow: hidden; }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { font-size: 16px; }
    body {
      background-color: #F6F9FD;
      color: #1E293B;
      font-family: 'Hind Siliguri', 'Inter', system-ui, sans-serif;
      line-height: 1.65;
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
    }
    a { color: inherit; text-decoration: none; }
    img, svg { display: block; max-width: 100%; }
    button { font-family: inherit; cursor: pointer; border: none; background: none; }

    .wrap { max-width: 1240px; margin: 0 auto; padding: 0 24px; }
    section { position: relative; z-index: 1; }

    ::selection { background: #E0F2FE; color: #0369A1; }
    :focus-visible { outline: 2px solid #059669; outline-offset: 3px; }

    /* ══════════════════════════════════════════════
       AIWAVE LIGHT THEME TOKENS
    ══════════════════════════════════════════════ */
    :root {
      --primary:          #059669;
      --primary-dark:     #064E3B;
      --primary-gradient:  linear-gradient(90deg, #059669 0%, #10B981 50%, #D97706 100%);
      --rainbow-gradient:  linear-gradient(90deg, #FF5B26 0%, #F59E0B 50%, #10B981 100%);

      --card-bg:          #FFFFFF;
      --card-border:      #E2E8F0;

      --shadow-aiwave:    0 20px 40px -10px rgba(15, 23, 42, 0.08);
      --shadow-glow:      0 20px 40px -10px rgba(5, 150, 105, 0.25);

      --radius-card:      28px;
      --radius-pill:      9999px;
      --transition:       all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .reveal {
      opacity: 0;
      transform: translateY(28px);
      transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .reveal.visible { opacity: 1; transform: translateY(0); }
    .d-1 { transition-delay: 0.12s; }
    .d-2 { transition-delay: 0.24s; }

    @keyframes floatSoft { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
    @keyframes marquee { 0% { transform: translateX(0%); } 100% { transform: translateX(-50%); } }
    .anim-float { animation: floatSoft 4.5s ease-in-out infinite; }

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
    header.nav {
      position: sticky; top: 0; z-index: 100;
      background: rgba(246, 249, 253, 0.88);
      backdrop-filter: blur(20px) saturate(180%);
      -webkit-backdrop-filter: blur(20px) saturate(180%);
      border-bottom: 1px solid rgba(226, 232, 240, 0.8);
      transition: var(--transition);
    }
    header.nav.scrolled { background: rgba(255, 255, 255, 0.96); box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
    .nav-inner { display: flex; align-items: center; justify-content: space-between; height: 76px; }
    .brand { display: flex; align-items: center; gap: 12px; }
    .brand-icon {
      width: 44px; height: 44px; background: var(--primary-gradient); border-radius: 14px;
      display: flex; align-items: center; justify-content: center; color: #FFFFFF;
      box-shadow: 0 6px 16px rgba(5, 150, 105, 0.3); transition: var(--transition);
    }
    .brand-icon svg { width: 24px; height: 24px; stroke: #FFFFFF; fill: none; }
    .brand-title { font-weight: 900; font-size: 18px; color: #064E3B; line-height: 1.1; }
    .brand-subtitle { font-size: 11px; font-weight: 800; color: #D97706; letter-spacing: 2px; text-transform: uppercase; }

    .nav-menu {
      display: flex; align-items: center; gap: 6px;
      background: #FFFFFF; padding: 5px; border-radius: var(--radius-pill); border: 1px solid #E2E8F0;
    }
    .nav-item { font-size: 14px; font-weight: 600; color: #475569; padding: 8px 18px; border-radius: var(--radius-pill); transition: var(--transition); }
    .nav-item:hover { color: #059669; background: #ECFDF5; }

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
            font-family: var(--sans);
            line-height: 1.65;
            overflow-x: hidden;
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

        ::selection {
            background: var(--gold);
            color: #12241f;
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



        section {
            position: relative;
            z-index: 1;
        }

        /* ---------------- HERO ---------------- */
        .hero {
            padding: 74px 0 60px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            gap: 48px;
            align-items: center;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 12.5px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gold-light);
            font-weight: 600;
            margin-bottom: 22px;
        }

        .eyebrow::before {
            content: "";
            width: 26px;
            height: 1px;
            background: var(--gold-light);
        }

        h1.headline {
            font-family: var(--serif);
            font-weight: 700;
            font-size: clamp(34px, 4.6vw, 54px);
            line-height: 1.28;
            color: var(--cream);
            margin-bottom: 22px;
        }

        h1.headline em {
            font-style: normal;
            color: var(--gold-light);
        }

        .lede {
            font-size: 17px;
            color: var(--muted);
            max-width: 520px;
            margin-bottom: 32px;
        }

        .cta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 40px;
        }

        .btn-primary {
            background: var(--gold);
            color: #17281f;
            font-weight: 700;
            padding: 15px 30px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 15.5px;
            letter-spacing: 0.2px;
            box-shadow: 0 12px 28px rgba(201, 162, 39, 0.25);
            transition: transform .2s ease, box-shadow .2s ease;
            border: 1px solid var(--gold);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 34px rgba(201, 162, 39, 0.38);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 24px;
            border-radius: 10px;
            border: 1px solid var(--line);
            color: var(--cream);
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: border-color .2s ease, background .2s ease;
        }

        .btn-ghost:hover {
            border-color: var(--gold-light);
            background: rgba(244, 239, 226, 0.04);
        }

        .btn-ghost svg {
            width: 18px;
            height: 18px;
            stroke: var(--gold-light);
        }

        .stat-row {
            display: flex;
            gap: 34px;
            flex-wrap: wrap;
        }

        .stat b {
            display: block;
            font-family: var(--serif);
            font-weight: 700;
            font-size: 24px;
            color: var(--gold-light);
        }

        .stat span {
            font-size: 12.5px;
            color: var(--muted);
            letter-spacing: 0.3px;
        }

        /* hero visual */
        .hero-visual {
            position: relative;
            background: radial-gradient(circle at 50% 45%, rgba(201, 162, 39, 0.10), transparent 65%);
            border-radius: 24px;
            padding: 10px;
        }

        /* ---------------- STEPS ---------------- */
        .section-head {
            max-width: 640px;
            margin: 0 auto 52px;
            text-align: center;
        }

        .section-head .eyebrow {
            justify-content: center;
        }

        .section-head .eyebrow::before {
            display: none;
        }

        .section-head h2 {
            font-family: var(--serif);
            font-weight: 700;
            font-size: clamp(26px, 3.4vw, 38px);
            color: var(--cream);
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
            font-family: var(--sans);
            font-weight: 700;
            color: var(--gold-light);
            font-size: 12.5px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .step-card h3 {
            font-family: var(--serif);
            font-size: 20px;
            font-weight: 700;
            margin: 8px 0 10px;
            color: var(--cream);
        }

        .step-card p {
            font-size: 14.5px;
            color: var(--muted);
        }

        /* ---------------- COMMISSION ---------------- */
        .commission {
            padding: 90px 0 100px;
            background: linear-gradient(180deg, var(--bg-alt), var(--bg));
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
        }

        .comm-grid {
            display: grid;
            grid-template-columns: 0.85fr 1.15fr;
            gap: 56px;
            align-items: center;
        }

        .comm-figure {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 22px;
            padding: 44px 36px;
            text-align: center;
            box-shadow: var(--shadow);
        }

        .comm-figure .label {
            font-size: 13px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 14px;
        }

        .comm-figure .amount {
            font-family: var(--serif);
            font-weight: 900;
            font-size: clamp(38px, 5vw, 56px);
            color: var(--gold-light);
            line-height: 1;
        }

        .comm-figure .per {
            font-size: 14px;
            color: var(--muted);
            margin-top: 12px;
        }

        .comm-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .comm-table th,
        .comm-table td {
            text-align: left;
            padding: 16px 14px;
            font-size: 14.5px;
            border-bottom: 1px solid var(--line);
        }

        .comm-table th {
            color: var(--gold-light);
            font-weight: 600;
            font-size: 12.5px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .comm-table td:last-child {
            color: var(--gold-light);
            font-weight: 700;
            text-align: right;
        }

        .comm-note {
            font-size: 12.5px;
            color: var(--muted);
            margin-top: 16px;
        }

        /* ---------------- WHY ---------------- */
        .why {
            padding: 96px 0;
        }

        .why-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 26px;
        }

        .why-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 32px 28px;
        }

        .why-card svg {
            width: 30px;
            height: 30px;
            stroke: var(--gold-light);
            fill: none;
            margin-bottom: 18px;
        }

        .why-card h3 {
            font-family: var(--serif);
            font-size: 18.5px;
            margin-bottom: 10px;
        }

        .why-card p {
            font-size: 14px;
            color: var(--muted);
        }

        .projects-strip {
            margin-top: 44px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        .chip {
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 9px 18px;
            font-size: 13.5px;
            color: var(--muted);
        }

        .chip b {
            color: var(--gold-light);
            font-weight: 600;
        }

        /* ---------------- FAQ ---------------- */
        .faq {
            padding: 90px 0 100px;
            border-top: 1px solid var(--line);
        }

        .faq-list {
            max-width: 760px;
            margin: 0 auto;
        }

        .faq-item {
            border-bottom: 1px solid var(--line);
        }

        .faq-q {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            color: var(--cream);
            font-family: var(--sans);
            font-size: 16.5px;
            font-weight: 600;
            padding: 22px 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .faq-q svg {
            width: 18px;
            height: 18px;
            stroke: var(--gold-light);
            flex-shrink: 0;
            transition: transform .25s ease;
        }

        .faq-item.open .faq-q svg {
            transform: rotate(45deg);
        }

        .faq-a {
            max-height: 0;
            overflow: hidden;
            transition: max-height .3s ease;
            font-size: 14.5px;
            color: var(--muted);
        }

        .faq-a-inner {
            padding: 0 4px 22px;
        }

        .faq-item.open .faq-a {
            max-height: 220px;
        }

        /* ---------------- FINAL CTA / FOOTER ---------------- */
        .cta-final {
            padding: 90px 0;
            text-align: center;
            background: radial-gradient(circle at 50% 0%, rgba(201, 162, 39, 0.12), transparent 60%);
            border-top: 1px solid var(--line);
        }

        .cta-final h2 {
            font-family: var(--serif);
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
            font-family: var(--sans);
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
            font-family: var(--serif);
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
            font-family: var(--sans);
        }

        .method-card svg {
            width: 32px;
            height: 32px;
            stroke: var(--gold-light);
            fill: none;
            margin-bottom: 18px;
        }

        .method-card h3 {
            font-family: var(--serif);
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
            font-family: var(--sans);
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
            font-family: 'Inter', monospace;
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

        /* ---------------- DASHBOARD ---------------- */
        .dashboard-section {
            padding: 90px 0 100px;
            border-top: 1px solid var(--line);
        }

        .auth-shell {
            max-width: 420px;
            margin: 0 auto;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 30px;
            box-shadow: var(--shadow);
        }

        .auth-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--line);
        }

        .auth-tab-btn {
            flex: 1;
            background: none;
            border: none;
            padding: 10px;
            color: var(--muted);
            font-family: var(--sans);
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            border-bottom: 2px solid transparent;
        }

        .auth-tab-btn.active {
            color: var(--gold-light);
            border-color: var(--gold-light);
        }

        .auth-field {
            margin-bottom: 14px;
        }

        .auth-field label {
            font-size: 12.5px;
            color: var(--muted);
            display: block;
            margin-bottom: 6px;
        }

        .auth-field input {
            width: 100%;
            background: var(--bg-alt);
            border: 1px solid var(--line);
            border-radius: 9px;
            padding: 12px 14px;
            color: var(--cream);
            font-family: var(--sans);
            font-size: 14.5px;
        }

        .auth-field input:focus {
            border-color: var(--gold-light);
        }

        .auth-submit {
            width: 100%;
            background: var(--gold);
            color: #17281f;
            border: none;
            border-radius: 9px;
            padding: 13px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            margin-top: 4px;
        }

        .auth-demo-note {
            font-size: 12px;
            color: var(--muted);
            text-align: center;
            margin-top: 14px;
        }

        .dash-panel {
            display: none;
        }

        .dash-panel.active {
            display: block;
        }

        .dash-summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 30px;
        }

        .dash-stat {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 22px;
        }

        .dash-stat b {
            display: block;
            font-family: var(--serif);
            font-size: 24px;
            color: var(--gold-light);
        }

        .dash-stat span {
            font-size: 12.5px;
            color: var(--muted);
        }

        .dash-table-wrap {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 16px;
            overflow: hidden;
        }

        .dash-table {
            width: 100%;
            border-collapse: collapse;
        }

        .dash-table th,
        .dash-table td {
            padding: 14px 16px;
            text-align: left;
            font-size: 13.5px;
            border-bottom: 1px solid var(--line);
        }

        .dash-table th {
            color: var(--muted);
            font-weight: 600;
            font-size: 11.5px;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            background: var(--bg-alt);
        }

        .dash-table tr:last-child td {
            border-bottom: none;
        }

        .stage-pill {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .stage-1 {
            background: rgba(159, 189, 178, 0.15);
            color: #9FBDB2;
        }

        .stage-2 {
            background: rgba(201, 162, 39, 0.15);
            color: #E7C766;
        }

        .stage-3 {
            background: rgba(230, 175, 90, 0.18);
            color: #F0B860;
        }

        .stage-4 {
            background: rgba(120, 190, 140, 0.18);
            color: #8FE0A6;
        }

        .stage-5 {
            background: rgba(120, 190, 140, 0.28);
            color: #8FE0A6;
            font-weight: 700;
        }

        .dash-logout {
            font-size: 13px;
            color: var(--muted);
            text-decoration: underline;
            cursor: pointer;
            background: none;
            border: none;
            margin-bottom: 24px;
        }

        /* ---------------- responsive ---------------- */
        @media (max-width:900px) {
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .hero-visual {
                order: -1;
            }

            .step-track {
                grid-template-columns: 1fr 1fr;
            }

            .step-track::before {
                display: none;
            }

            .comm-grid {
                grid-template-columns: 1fr;
            }

            .why-grid {
                grid-template-columns: 1fr;
            }

            .method-grid {
                grid-template-columns: 1fr;
            }

            .dash-summary {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width:560px) {
            .step-track {
                grid-template-columns: 1fr;
            }

            .refer-form .row {
                grid-template-columns: 1fr;
            }

            .nav-inner {
                padding: 14px 18px;
            }

            .wrap {
                padding: 0 18px;
            }

            .stat-row {
                gap: 22px;
            }

            .link-gen-intro {
                grid-template-columns: 1fr;
            }

            .dash-summary {
                grid-template-columns: 1fr 1fr;
            }

            .link-row {
                flex-wrap: wrap;
            }

            .dash-table {
                font-size: 12px;
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
        // FAQ accordion
        document.querySelectorAll('.faq-item').forEach(item => {
            item.querySelector('.faq-q').addEventListener('click', () => {
                const isOpen = item.classList.contains('open');
                document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
                if (!isOpen) item.classList.add('open');
            });
        });

        // Bangladeshi-style comma count-up for commission figure
        function bnFormat(num) {
            let s = String(num);
            let last3 = s.slice(-3);
            let rest = s.slice(0, -3);
            if (rest !== '') last3 = ',' + last3;
            rest = rest.replace(/\B(?=(\d{2})+(?!\d))/g, ',');
            const digits = '০১২৩৪৫৬৭৮৯';
            return (rest + last3).replace(/\d/g, d => digits[d]);
        }
        const amountEl = document.getElementById('countAmount');
        let animated = false;

        function runCount() {
            if (animated) return;
            animated = true;
            const target = 300000,
                dur = 1400,
                start = performance.now();

            function tick(now) {
                const p = Math.min(1, (now - start) / dur);
                const val = Math.floor(p * target / 1000) * 1000;
                amountEl.textContent = '৳' + bnFormat(val);
                if (p < 1) requestAnimationFrame(tick);
                else amountEl.textContent = '৳' + bnFormat(target);
            }
            requestAnimationFrame(tick);
        }
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) runCount();
            });
        }, {
            threshold: 0.5
        });
        obs.observe(document.querySelector('.comm-figure'));

        // Refer method tabs (direct vs link)
        document.querySelectorAll('.refer-tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.refer-tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.refer-pane').forEach(p => p.classList.remove('active'));
                btn.classList.add('active');
                document.querySelector('.refer-pane[data-pane="' + btn.dataset.tab + '"]').classList.add(
                    'active');
            });
        });
        // deep-link support: #refer-link jumps straight to link tab
        if (location.hash === '#refer-link') {
            document.querySelector('.refer-tab-btn[data-tab="link"]').click();
        }

        // Auth tabs (login vs register)
        function showAuth(mode) {
            const loginSec = document.getElementById('loginSection');
            const registerSec = document.getElementById('registerSection');
            const forgotSec = document.getElementById('forgotSection');
            const tabHeader = document.getElementById('tabHeader');
            const tabs = document.querySelectorAll('.auth-tab-btn');

            // সব হাইড করা
            loginSec.style.display = 'none';
            registerSec.style.display = 'none';
            forgotSec.style.display = 'none';
            tabs.forEach(t => t.classList.remove('active'));

            if (mode === 'login') {
                loginSec.style.display = 'block';
                tabHeader.style.display = 'flex';
                tabs[0].classList.add('active');
            } else if (mode === 'register') {
                registerSec.style.display = 'block';
                tabHeader.style.display = 'flex';
                tabs[1].classList.add('active');
            } else if (mode === 'forgot') {
                forgotSec.style.display = 'block';
                tabHeader.style.display = 'none'; // পাসওয়ার্ড রিসেট করার সময় ট্যাব লুকিয়ে রাখা
            }
        }

        function showDashboard() {
            document.getElementById('authView').style.display = 'none';
            document.getElementById('dashPanel').classList.add('active');
            document.getElementById('dashPanel').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function hideDashboard() {
            document.getElementById('dashPanel').classList.remove('active');
            document.getElementById('authView').style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', function () {
            if ("<?php echo e(Auth::check()); ?>") {
                generateDynamicLinks();
            }
        });

        function generateProjectLink() {
            const select = document.getElementById('projectSelect');
            const slug = select.value;
            const projectName = select.options[select.selectedIndex].text;

            const refCode = "<?php echo e(auth()->check() ? auth()->user()->referral_code : ''); ?>";

            if (!slug) { alert('প্রজেক্ট সিলেক্ট করুন'); return; }

            const baseUrl = window.location.origin + '/project/' + slug + '?ref=' + refCode;

            document.getElementById('linkContainer').innerHTML = `
        <div class="link-row" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; background: var(--bg-alt); border-radius: 10px; border: 1px solid var(--line); margin-top: 15px;">
            <span class="lname" style="flex: 0 0 100px; color: var(--cream); font-size: 13px;">${projectName}</span>
            <span class="lurl" id="generated-link-text" style="flex: 1; color: var(--muted); font-size: 11px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin: 0 10px;">${baseUrl}</span>
            <button type="button" class="copy-btn" style="flex: 0 0 70px; background: var(--gold); border-radius: 6px; padding: 5px; font-size: 12px; cursor: pointer;" onclick="copySpecificLink('generated-link-text', this)">কপি</button>
        </div>
    `;
        }

        function copySpecificLink(id, btn) {
            const text = document.getElementById(id).innerText;
            navigator.clipboard.writeText(text).then(() => {
                const originalText = btn.textContent;
                btn.textContent = 'কপি হয়েছে ✓';
                btn.style.color = '#fff';
                btn.style.background = 'var(--gold)';
                setTimeout(() => {
                    btn.textContent = originalText;
                    btn.style.color = 'var(--gold-light)';
                    btn.style.background = 'none';
                }, 1500);
            });
        }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php if($errors->any()): ?>
            const element = document.getElementById('dashboard');
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        <?php endif; ?>
    });
</script>
</body>

</html>
<?php /**PATH C:\laragon\www\affiliate-project\resources\views/frontend/layouts/landingFront.blade.php ENDPATH**/ ?>