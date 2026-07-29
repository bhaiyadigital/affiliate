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
    <style>
        :root {
            --bg: #0F2A25;
            --bg-alt: #123832;
            --surface: #16413A;
            --surface-2: #1C4C43;
            --gold: #C9A227;
            --gold-light: #E7C766;
            --cream: #F4EFE2;
            --muted: #9FBDB2;
            --line: rgba(244, 239, 226, 0.14);
            --shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
            --serif: 'Noto Serif Bengali', 'Noto Serif', serif;
            --sans: 'Hind Siliguri', 'Inter', sans-serif;
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

        /* ---------------- NAV ---------------- */
        header.nav {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(15, 42, 37, 0.86);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--line);
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 28px;
            max-width: 1180px;
            margin: 0 auto;
        }

        .brand {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .brand .name {
            font-family: var(--sans);
            font-weight: 700;
            font-size: 19px;
            letter-spacing: 0.3px;
        }

        .brand .tag {
            font-size: 11.5px;
            color: var(--gold-light);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 3px;
        }

        .nav-link {
            font-size: 14px;
            color: var(--muted);
            text-decoration: none;
            display: none;
        }

        @media (min-width:640px) {
            .nav-link {
                display: inline;
            }
        }

        .nav-link:hover {
            color: var(--gold-light);
        }

        .nav-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--gold);
            color: #17281f;
            padding: 10px 20px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 14.5px;
            text-decoration: none;
            border: 1px solid var(--gold);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .nav-cta:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(201, 162, 39, 0.35);
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

    <header class="nav">
        <div class="nav-inner">
            <div class="brand">
                <span class="name">Bhaiya Housing</span>
                <span class="tag">Refer &amp; Earn</span>
            </div>
            <div style="display:flex; align-items:center; gap:18px;">
                <?php if(auth()->guard()->check()): ?>
                    <a href="#refer" class="nav-link" style="display: inline;">রেফার করুন</a>
                    <a href="<?php echo e(route('profile.index')); ?>" class="nav-cta">প্রোফাইল</a>
                <?php else: ?>
                    <a href="<?php echo e(route('affiliated.project')); ?>" class="nav-link" style="display: inline;">প্রোজেক </a>
                    <a href="#dashboard" class="nav-link">অ্যাফিলিয়েট লগইন</a>
                    <a href="#refer" class="nav-cta">যোগ দিন</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="wrap hero-grid">
            <div>
                <div class="eyebrow">BHAIYA REFER PROGRAM</div>
                <h1 class="headline">আপনার চেনা মানুষটাই<br>হতে পারে আমাদের <em>পরবর্তী গ্রাহক</em></h1>
                <p class="lede">আপনার আশেপাশে কেউ ফ্ল্যাট বা বাড়ি কিনতে চাইছেন? তাকে Bhaiya Housing-এর সাথে পরিচয়
                    করিয়ে দিন। ক্রয় সম্পন্ন হলে আপনি পাবেন সর্বোচ্চ <strong
                        style="color:var(--gold-light)">৳৩,০০,০০০</strong> পর্যন্ত রেফার কমিশন — কোনো ঝামেলা ছাড়াই।</p>
                <div class="cta-row">
                    <a href="#refer" class="btn-primary">রেফার করা শুরু করুন</a>
                    <a href="tel:01922030303" class="btn-ghost">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M6.6 10.8c1.4 2.8 3.8 5.2 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.3 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8Z" />
                        </svg>
                        01922-030303
                    </a>
                </div>
                <div class="stat-row">
                    <div class="stat"><b>১২+</b><span>বছরের অভিজ্ঞতা</span></div>
                    <div class="stat"><b>৳৩,০০,০০০</b><span>সর্বোচ্চ কমিশন</span></div>
                    <div class="stat"><b>৫টি</b><span>চলমান প্রজেক্ট</span></div>
                </div>
            </div>

            <div class="hero-visual">
                <svg viewBox="0 0 480 460" width="100%" role="img"
                    aria-label="রেফার করুন, বাড়ি কিনুন, কমিশন পান — সাইকেল ডায়াগ্রাম">
                    <!-- connecting flow paths -->
                    <path class="flow-line" d="M110 130 C 180 90, 280 90, 350 150" stroke="#E7C766" stroke-width="2"
                        fill="none" opacity="0.75" />
                    <path class="flow-line" d="M360 190 C 380 260, 340 320, 260 350" stroke="#E7C766" stroke-width="2"
                        fill="none" opacity="0.75" />
                    <path class="flow-line" d="M190 355 C 120 330, 90 250, 100 175" stroke="#E7C766" stroke-width="2"
                        fill="none" opacity="0.75" />

                    <!-- node: You -->
                    <g transform="translate(95,115)">
                        <circle class="pulse-ring" r="46" fill="none" stroke="#C9A227" stroke-width="1.5" />
                        <circle r="40" fill="#16413A" stroke="#C9A227" stroke-width="1.5" />
                        <g transform="translate(-13,-16)" stroke="#E7C766" stroke-width="1.8" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="13" cy="8" r="7" />
                            <path d="M1 30c1-9 8-14 12-14s11 5 12 14" />
                        </g>
                        <text x="0" y="58" text-anchor="middle" fill="#9FBDB2" font-size="12"
                            font-family="Hind Siliguri, sans-serif">আপনি</text>
                    </g>

                    <!-- node: House -->
                    <g transform="translate(360,170)">
                        <circle class="pulse-ring" r="50" fill="none" stroke="#C9A227" stroke-width="1.5" />
                        <circle r="44" fill="#16413A" stroke="#C9A227" stroke-width="1.5" />
                        <g transform="translate(-17,-15)" stroke="#E7C766" stroke-width="1.8" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M0 16 L17 2 L34 16" />
                            <path d="M5 14 V32 H29 V14" />
                            <rect x="14" y="20" width="7" height="12" />
                        </g>
                        <text x="0" y="66" text-anchor="middle" fill="#9FBDB2" font-size="12"
                            font-family="Hind Siliguri, sans-serif">ক্রয় সম্পন্ন</text>
                    </g>

                    <!-- node: Wallet / commission -->
                    <g transform="translate(220,368)">
                        <circle class="pulse-ring" r="48" fill="none" stroke="#C9A227" stroke-width="1.5" />
                        <circle r="42" fill="#16413A" stroke="#C9A227" stroke-width="1.5" />
                        <g transform="translate(-16,-13)" stroke="#E7C766" stroke-width="1.8" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="0" y="4" width="32" height="22" rx="3" />
                            <path d="M0 10 H32" />
                            <circle cx="24" cy="17" r="2.6" fill="#E7C766" stroke="none" />
                        </g>
                        <text x="0" y="62" text-anchor="middle" fill="#9FBDB2" font-size="12"
                            font-family="Hind Siliguri, sans-serif">কমিশন</text>
                    </g>

                    <!-- floating taka symbols -->
                    <text class="float-coin" x="300" y="70" fill="#E7C766" font-size="20"
                        font-family="Noto Serif Bengali, serif" opacity="0.85">৳</text>
                    <text class="float-coin d2" x="60" y="260" fill="#E7C766" font-size="16"
                        font-family="Noto Serif Bengali, serif" opacity="0.7">৳</text>
                    <text class="float-coin d3" x="410" y="330" fill="#E7C766" font-size="18"
                        font-family="Noto Serif Bengali, serif" opacity="0.75">৳</text>

                    <text x="240" y="440" text-anchor="middle" fill="#E7C766" font-size="16" font-weight="700"
                        font-family="Noto Serif Bengali, serif">সর্বোচ্চ ৳৩,০০,০০০ পর্যন্ত</text>
                </svg>
            </div>
        </div>
    </section>

    <section class="methods" id="methods">
        <div class="wrap">
            <div class="section-head">
                <div class="eyebrow">রেফার করার পদ্ধতি</div>
                <h2>২টি সহজ উপায়ে রেফার করুন</h2>
                <p>যেভাবে আপনার জন্য সুবিধাজনক, সেভাবেই শুরু করুন — দুটো পদ্ধতিই সমান কার্যকর।</p>
            </div>
            <div class="method-grid">
                <div class="method-card">
                    <div class="method-badge">০১</div>
                    <svg viewBox="0 0 24 24" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 21s-7-5.2-7-11a7 7 0 0 1 14 0c0 5.8-7 11-7 11Z" />
                        <circle cx="12" cy="10" r="2.6" />
                    </svg>
                    <h3>সরাসরি পরিচয় করিয়ে দিন</h3>
                    <p>আপনার পরিচিত কারো নাম ও নম্বর সরাসরি আমাদের ফর্মে জমা দিন। আমাদের টিম নিজে থেকে তার সাথে যোগাযোগ
                        করে নেবে।</p>
                    <a href="#refer-direct" class="method-link">ফর্ম পূরণ করুন
                        <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>
                </div>
                <div class="method-card">
                    <div class="method-badge">০২</div>
                    <svg viewBox="0 0 24 24" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M9 15 15 9M8 12l-2.5 2.5a3.5 3.5 0 0 0 5 5L13 17M16 12l2.5-2.5a3.5 3.5 0 0 0-5-5L11 7" />
                    </svg>
                    <h3>আপনার রেফারেল লিংক শেয়ার করুন</h3>
                    <p>আপনার নিজের ইউনিক লিংক জেনারেট করুন এবং প্রজেক্টের লিংক তাকে পাঠান। তিনি লিংকে গিয়ে নিজেই তার
                        তথ্য জমা দেবেন — এরপর আমরা যোগাযোগ করবো।</p>
                    <a href="#refer-link" class="method-link">লিংক জেনারেট করুন
                        <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="steps" id="how">
        <div class="wrap">
            <div class="section-head">
                <div class="eyebrow">কিভাবে কাজ করে</div>
                <h2>৪টি সহজ ধাপে আয় শুরু</h2>
                <p>রেফার করা থেকে কমিশন হাতে পাওয়া পর্যন্ত পুরো প্রক্রিয়াটি সহজ এবং স্বচ্ছ।</p>
            </div>
            <div class="step-track">
                <div class="step-card">
                    <div class="step-num">
                        <svg viewBox="0 0 24 24" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="6" cy="12" r="3" />
                            <circle cx="18" cy="6" r="3" />
                            <circle cx="18" cy="18" r="3" />
                            <path d="M8.6 10.6 15.4 7.4M8.6 13.4l6.8 3.2" />
                        </svg>
                    </div>
                    <div class="step-tag">ধাপ ০১</div>
                    <h3>পরিচয় করিয়ে দিন</h3>
                    <p>আপনার পরিচিত কেউ যদি ফ্ল্যাট বা বাড়ি কিনতে আগ্রহী হন, তার নাম ও নম্বর আমাদের জানান।</p>
                </div>
                <div class="step-card">
                    <div class="step-num">
                        <svg viewBox="0 0 24 24" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 21s-7-5.2-7-11a7 7 0 0 1 14 0c0 5.8-7 11-7 11Z" />
                            <circle cx="12" cy="10" r="2.6" />
                        </svg>
                    </div>
                    <div class="step-tag">ধাপ ০২</div>
                    <h3>সাইট ভিজিট</h3>
                    <p>আমাদের সেলস টিম যোগাযোগ করে প্রজেক্ট ভিজিট ও প্রয়োজনীয় তথ্য দেবে।</p>
                </div>
                <div class="step-card">
                    <div class="step-num">
                        <svg viewBox="0 0 24 24" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 12.5 9.5 18 20 6" />
                        </svg>
                    </div>
                    <div class="step-tag">ধাপ ০৩</div>
                    <h3>বুকিং সম্পন্ন</h3>
                    <p>তিনি পছন্দের ইউনিট বুকিং ও রেজিস্ট্রেশন সম্পন্ন করলেই আপনি কমিশনের জন্য যোগ্য হয়ে যান।</p>
                </div>
                <div class="step-card">
                    <div class="step-num">
                        <svg viewBox="0 0 24 24" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="6" width="18" height="13" rx="2" />
                            <path d="M3 10h18" />
                            <circle cx="16" cy="14" r="1.4" fill="currentColor" stroke="none" />
                        </svg>
                    </div>
                    <div class="step-tag">ধাপ ০৪</div>
                    <h3>কমিশন পান</h3>
                    <p>রেজিস্ট্রেশনের পর নির্ধারিত সময়ে সরাসরি আপনার একাউন্টে কমিশন পৌঁছে যাবে।</p>
                </div>
            </div>
        </div>
    </section>

    <section class="commission" id="commission">
        <div class="wrap comm-grid">
            <div class="comm-figure">
                <div class="label">সর্বোচ্চ কমিশন</div>
                <div class="amount" id="countAmount">৳০</div>
                <div class="per">প্রতিটি সফল রেফারেলে</div>
            </div>
            <div>
                <div class="eyebrow">কমিশন স্ট্রাকচার</div>
                <h2 style="font-family:var(--serif); font-size:clamp(24px,3vw,32px); margin-bottom:14px;">ইউনিট
                    অনুযায়ী কমিশন — একটি উদাহরণ</h2>
                <p style="color:var(--muted); font-size:15px;">প্রজেক্ট ও ইউনিটের ধরন অনুযায়ী কমিশনের পরিমাণ নির্ধারিত
                    হয়। নিচের টেবিলটি একটি সাধারণ ধারণা দেয়ার জন্য।</p>
                <table class="comm-table">
                    <thead>
                        <tr>
                            <th>ইউনিট ধরন</th>
                            <th>আনুমানিক আকার</th>
                            <th>কমিশন রেঞ্জ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>কমপ্যাক্ট ইউনিট</td>
                            <td>৮০০–১২০০ বর্গফুট</td>
                            <td>৳৫০,০০০–১,০০,০০০</td>
                        </tr>
                        <tr>
                            <td>স্ট্যান্ডার্ড ইউনিট</td>
                            <td>১২০০–১৮০০ বর্গফুট</td>
                            <td>৳১,০০,০০০–২,০০,০০০</td>
                        </tr>
                        <tr>
                            <td>প্রিমিয়াম / কমার্শিয়াল</td>
                            <td>১৮০০+ বর্গফুট</td>
                            <td>৳২,০০,০০০–৩,০০,০০০</td>
                        </tr>
                    </tbody>
                </table>
                <p class="comm-note">*চূড়ান্ত কমিশন প্রজেক্ট, ইউনিট মূল্য ও শর্তাবলীর উপর নির্ভরশীল। বিস্তারিত জানতে
                    আমাদের টিমের সাথে যোগাযোগ করুন।</p>
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
                <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="chip">
                        <b><?php echo e($project->title); ?></b>
                        <?php if($project->destination): ?>
                            — <?php echo e($project->destination->title); ?>

                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="chip text-gray-400 italic">No projects available</div>
                <?php endif; ?>
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
            <?php if(session('success')): ?>
                <div id="form-alert"
                    style="background: rgba(143, 224, 166, 0.15); border: 1px solid #8FE0A6; color: #8FE0A6; padding: 16px; border-radius: 12px; margin-bottom: 25px; text-align: center; font-weight: 600; font-size: 15px;">
                    <i class="fas fa-check-circle" style="margin-right: 8px;"></i> <?php echo e(session('success')); ?>

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
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>
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
                                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($project->slug); ?>"><?php echo e($project->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <form class="refer-form" action="<?php echo e(route('lead.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="type" value="manual">
                        <div class="row">
                            <div><label>নাম</label><input name="name" type="text" required></div>
                            <div><label>নম্বর</label><input name="phone" type="tel" required></div>
                            <div><label>পছন্দের স্থান</label>
                                <select name="interested_location"
                                    style="width: 100%; background: var(--bg-alt); color: var(--cream); padding: 12px; border: 1px solid var(--line); border-radius: 9px;">
                                    <option value="">-- প্রজেক্ট নির্বাচন করুন --</option>
                                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($project->title); ?>"><?php echo e($project->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div><label>বাজেট</label><input name="budget" type="number" step="any"></div>
                        </div>
                        <button type="submit" class="auth-submit">সাবমিট করুন</button>
                    </form>
                </div>
            <?php else: ?>
                <?php
                    // ইউআরএল এ ref=123 আছে কি না দেখা
                    $refId = request()->query('ref') ?? request()->cookie('referred_by');
                ?>

                <?php if($refId): ?>
                    <form class="refer-form" action="<?php echo e(route('lead.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <!-- টাইপ অবশ্যই refer_link যাবে -->
                        <input type="hidden" name="type" value="refer_link">

                        <div class="row">
                            <div><label>আপনার নাম</label><input name="name" type="text" required></div>
                            <div><label>আপনার নম্বর</label><input name="phone" type="tel" required></div>
                            <div><label>পছন্দের স্থান</label>
                                <select name="interested_location"
                                    style="width: 100%; background: var(--bg-alt); color: var(--cream); padding: 12px; border: 1px solid var(--line); border-radius: 9px;">
                                    <option value="">-- প্রজেক্ট নির্বাচন করুন --</option>
                                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($project->title); ?>"><?php echo e($project->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div><label>বাজেট</label><input name="budget" type="number" step="any"></div>
                        </div>
                        <button type="submit" class="auth-submit">তথ্য জমা দিন</button>
                    </form>
                <?php else: ?>
                    <a href="#dashboard" class="btn-primary">লগইন করে রেফার করুন</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
    <section class="dashboard-section" id="dashboard">
        <div class="wrap">
            <?php if(auth()->guard()->guest()): ?>
                <div class="section-head">
                    <div class="eyebrow">অ্যাফিলিয়েট মেম্বার</div>
                    <h2>লগইন করে আপনার রেফারেলের স্ট্যাটাস দেখুন</h2>
                    <p>রেজিস্ট্রেশন করে একবার লগইন করলেই আপনার প্রতিটি রেফারেল কোন স্টেজে আছে তা দেখতে পাবেন।</p>
                </div>

                <div id="authView">
                    <div class="auth-shell">
                        <div class="auth-tabs">
                            <button class="auth-tab-btn active" data-auth="login">লগইন</button>
                            <button class="auth-tab-btn" data-auth="register">রেজিস্ট্রেশন</button>
                        </div>



                        <!-- Login Form -->
                        <form id="loginForm" action="<?php echo e(route('affiliated.login')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php if($errors->any()): ?>
                                <p style="color:red; font-size:12px;"><?php echo e($errors->first()); ?></p>
                            <?php endif; ?>
                            <div class="auth-field">
                                <label for="lemail">মোবাইল নম্বর</label>
                                <input name="phone" id="lemail" type="tel" placeholder="01XXXXXXXXX" required>
                            </div>
                            <div class="auth-field">
                                <label for="lpass">পাসওয়ার্ড</label>
                                <input name="password" id="lpass" type="password" placeholder="••••••••" required>
                            </div>
                            <button type="submit" class="auth-submit">লগইন করুন</button>
                        </form>

                        <!-- Registration Form -->
                        <form id="registerForm" style="display:none;" action="<?php echo e(route('affiliated.register')); ?>"
                            method="POST">
                            <?php echo csrf_field(); ?>
                            <?php if($errors->any()): ?>
                                <p style="color:red; font-size:12px;"><?php echo e($errors->first()); ?></p>
                            <?php endif; ?>
                            <div class="auth-field">
                                <label for="rgname">পূর্ণ নাম</label>
                                <input name="name" id="rgname" type="text" placeholder="আপনার নাম" required>
                            </div>
                            <div class="auth-field">
                                <label for="rgphone">মোবাইল নম্বর</label>
                                <input name="phone" id="rgphone" type="tel" placeholder="01XXXXXXXXX" required>
                            </div>
                            <div class="auth-field">
                                <label for="rgpass">পাসওয়ার্ড</label>
                                <input name="password" id="rgpass" type="password" placeholder="একটি পাসওয়ার্ড দিন"
                                    required>
                            </div>
                            <button type="submit" class="auth-submit">অ্যাকাউন্ট তৈরি করুন</button>
                        </form>
                        <p class="auth-demo-note">* এটি একটি ডেমো — বাস্তব লগইন সিস্টেম Bhaiya Housing-এর সার্ভারের সাথে
                            যুক্ত করতে হবে।</p>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>

                <div class="section-head">
                    <div class="eyebrow">অ্যাফিলিয়েট ড্যাশবোর্ড</div>
                    <h2>স্বাগতম, <?php echo e(Auth::user()->name); ?></h2>
                    <p>আপনার রেফারেল এবং কমিশনের সর্বশেষ অবস্থা নিচে দেখুন।</p>
                </div>

                <div id="dashPanel" class="dash-panel active" style="display: block;">
                    <form id="logout-form" action="<?php echo e(route('frontend.logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
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
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <div class="wrap">
            <div class="foot-brand">Bhaiya Housing</div>
            <div class="foot-contact">
                <span>📞 01922-030303</span>
                <span>✉️ info@bhaiyahousing.com</span>
            </div>
            <div>Century Trade Center, Road # 17, Banani C/A, Dhaka-1213</div>
            <div style="margin-top:16px; opacity:0.7;">© 2026 Bhaiya Housing — Refer &amp; Earn Program</div>
        </div>
    </footer>

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
        document.querySelectorAll('.auth-tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.auth-tab-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                document.getElementById('loginForm').style.display = btn.dataset.auth === 'login' ?
                    'block' : 'none';
                document.getElementById('registerForm').style.display = btn.dataset.auth === 'register' ?
                    'block' : 'none';
            });
        });

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
</body>

</html>
<?php /**PATH C:\laragon\www\affiliate-project\resources\views/frontend/landing/index.blade.php ENDPATH**/ ?>