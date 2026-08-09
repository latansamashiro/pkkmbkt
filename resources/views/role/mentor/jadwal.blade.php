<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Jadwal | PKKMB-KT UNILAM 2026</title>
      <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <style>
      /* ============ TOKENS — IDENTIK SELURUH HALAMAN ============ */
      :root {
        --navy-900: #152159;
        --navy-700: #1e3a8f;
        --navy-600: #2a4bb0;
        --teal-600: #0f8a8c;
        --teal-500: #16a0a1;
        --teal-tint: #e2f3f2;
        --lime-500: #a9c73b;
        --lime-tint: #f2f6e0;
        --navy-tint: #e6e9f6;

        --bg: #f2f4fa;
        --surface: #ffffff;
        --border: #e1e5f1;

        --ink-900: #1b2238;
        --ink-600: #5b6175;
        --ink-400: #8d92a6;

        --radius-lg: 28px;
        --radius-md: 18px;
        --radius-sm: 13px;

        --shadow-card:
          0 2px 14px rgba(21, 33, 89, 0.07), 0 1px 2px rgba(21, 33, 89, 0.05);
        --shadow-pop: 0 10px 24px rgba(21, 33, 89, 0.16);

        --font-display: "Lora", serif;
        --font-sans: "Plus Jakarta Sans", sans-serif;
        --bottomnav-h: 74px;
      }
      * {
        box-sizing: border-box;
      }
      body {
        font-family: var(--font-sans);
        color: var(--ink-900);
        background: var(--bg);
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased;
      }
      .font-display {
        font-family: var(--font-display);
      }

      /* ============ NAVBAR — IDENTIK HALAMAN LAIN ============ */
      .navbar {
        position: sticky;
        top: 0;
        z-index: 40;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 14px clamp(16px, 5vw, 48px);
        background: var(--navy-900);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      }
      .navbar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        z-index: 50;
        text-decoration: none;
      }
      .navbar-logo {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
      }
      .navbar-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
      }
      .navbar-brand-text strong {
        display: block;
        font-family: var(--font-display);
        font-size: 14.5px;
        color: #fff;
      }
      .navbar-brand-text span {
        font-size: 10.5px;
        color: #aeb6e0;
        letter-spacing: 0.04em;
      }

      .menu-toggle {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 24px;
        height: 18px;
        background: transparent;
        border: none;
        cursor: pointer;
        z-index: 50;
        padding: 0;
      }
      .menu-toggle span {
        display: block;
        width: 100%;
        height: 2px;
        background-color: #fff;
        border-radius: 2px;
        transition: transform 0.3s ease, opacity 0.3s ease;
      }
      .menu-toggle.active span:nth-child(1) {
        transform: translateY(8px) rotate(45deg);
      }
      .menu-toggle.active span:nth-child(2) {
        opacity: 0;
      }
      .menu-toggle.active span:nth-child(3) {
        transform: translateY(-8px) rotate(-45deg);
      }

      .navbar-links {
        display: none;
        gap: 24px;
      }
      .navbar-links a {
        color: #c7cce8;
        font-size: 16px;
        font-weight: 600;
        transition: color 0.15s;
        display: block;
        text-decoration: none;
      }
      .navbar-links a:hover,
      .navbar-links a.active {
        color: #fff;
      }
      .navbar-links a.active {
        border-left: 3px solid var(--lime-500);
        padding-left: 8px;
      }

      /* ---- Dropdown "Tentang" ---- */
      .nav-dropdown {
        position: relative;
        width: 100%;
      }
      .nav-dropdown-toggle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        gap: 8px;
        background: transparent;
        border: none;
        padding: 0;
        color: #c7cce8;
        font-family: var(--font-sans);
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: color 0.15s;
      }
      .nav-dropdown-toggle:hover,
      .nav-dropdown.open .nav-dropdown-toggle {
        color: #fff;
      }
      .nav-dropdown-toggle .dropdown-arrow {
        width: 12px;
        height: 12px;
        transition: transform 0.25s ease;
        flex-shrink: 0;
      }
      .nav-dropdown.open .dropdown-arrow {
        transform: rotate(180deg);
      }
      .nav-dropdown-menu {
        display: flex;
        flex-direction: column;
        gap: 14px;
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        padding-left: 14px;
        margin-top: 0;
        transition: max-height 0.3s ease, opacity 0.25s ease, margin-top 0.3s ease;
      }
      .nav-dropdown.open .nav-dropdown-menu {
        max-height: 220px;
        opacity: 1;
        margin-top: 14px;
      }
      .nav-dropdown-menu a {
        font-size: 14.5px;
        color: #9aa2cc;
      }
      .nav-dropdown-menu a::before {
        content: "— ";
        color: var(--lime-500);
      }
      .nav-dropdown-menu a:hover {
        color: #fff;
      }
      .nav-dropdown-menu a.active {
        color: #fff;
        font-weight: 700;
      }

      @media (min-width: 768px) {
        .menu-toggle {
          display: none;
        }
        .navbar-links {
          position: static;
          display: flex;
          flex-direction: row;
          width: auto;
          height: auto;
          background: transparent;
          padding: 0;
          gap: 28px;
          box-shadow: none;
          transition: none;
        }
        .navbar-links a {
          font-size: 13.5px;
        }
        .navbar-links a.active {
          border-left: none;
          border-bottom: 2px solid var(--lime-500);
          padding-left: 0;
          padding-bottom: 2px;
        }
        .nav-dropdown {
          width: auto;
        }
        .nav-dropdown-toggle {
          width: auto;
          font-size: 13.5px;
        }
        .nav-dropdown-menu {
          position: absolute;
          top: calc(100% + 14px);
          left: 0;
          min-width: 170px;
          background: #0d1735;
          border: 1px solid rgba(255, 255, 255, 0.08);
          border-radius: 12px;
          padding: 12px 18px;
          box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
          gap: 10px;
          margin-top: 0;
          transform: translateY(-6px);
          transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
          max-height: none;
          visibility: hidden;
        }
        .nav-dropdown.open .nav-dropdown-menu {
          margin-top: 0;
          transform: translateY(0);
          visibility: visible;
        }
        .nav-dropdown-menu a {
          padding: 0;
          white-space: nowrap;
        }
      }

      /* ============ HERO — SAMA POLA DENGAN EVALUASI/MATERI ============ */
      .hero-info {
        position: relative;
        overflow: hidden;
        color: #fff;
        padding: clamp(40px, 7vw, 64px) clamp(16px, 5vw, 48px);
        background-image: linear-gradient(
            135deg,
            rgba(21, 33, 89, 0.94) 0%,
            rgba(15, 138, 140, 0.85) 100%
          ),
          url("/Gambar/unilam.jpeg");
        background-size: cover;
        background-position: center;
      }
      .hero-info::before {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        border-radius: 50%;
        background: rgba(169, 199, 59, 0.08);
        top: -160px;
        right: -100px;
        pointer-events: none;
      }
      .hero-info::after {
        content: "";
        position: absolute;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: rgba(22, 160, 161, 0.1);
        bottom: -80px;
        left: -60px;
        pointer-events: none;
      }
      .hero-info-inner {
        position: relative;
        z-index: 1;
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-end;
        gap: 32px;
      }
      .hero-info-left {
        flex: 1;
        min-width: 280px;
      }
      .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(169, 199, 59, 0.15);
        border: 1px solid rgba(169, 199, 59, 0.35);
        color: #c8e46a;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 99px;
        margin-bottom: 16px;
      }
      .hero-eyebrow svg {
        width: 13px;
        height: 13px;
      }
      .hero-eyebrow .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--lime-500);
        animation: pulse 2s infinite;
      }
      @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(0.8); }
      }
      .hero-info h1 {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: clamp(24px, 4vw, 40px);
        line-height: 1.2;
        margin: 0 0 12px;
      }
      .hero-info-sub {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.75);
        line-height: 1.7;
        max-width: 460px;
        margin: 0;
      }

      /* Panel countdown, sama persis gaya "hero-stats" di materi/evaluasi/absensi */
      .hero-stats {
        display: flex;
        gap: 2px;
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: var(--radius-md);
        padding: 18px 24px;
        backdrop-filter: blur(12px);
        flex-shrink: 0;
      }
      .hero-stat {
        text-align: center;
        padding: 0 18px;
        border-right: 1px solid rgba(255, 255, 255, 0.12);
      }
      .hero-stat:last-child {
        border-right: none;
      }
      .hero-stat-val {
        font-family: var(--font-display);
        font-size: 24px;
        font-weight: 700;
        color: var(--lime-500);
        line-height: 1;
      }
      .hero-stat-lbl {
        font-size: 9.5px;
        color: rgba(255, 255, 255, 0.55);
        font-weight: 700;
        margin-top: 5px;
        letter-spacing: 0.06em;
        text-transform: uppercase;
      }
      .hero-stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
      }
      .hero-stat-icon svg {
        width: 20px;
        height: 20px;
        color: var(--teal-500);
        margin-bottom: 3px;
      }

      /* ►► MODE HP: panel countdown jadi full-width & rata tengah di
         bawah judul, bukan numpuk di kanan (yang di layar sempit jadi
         kepotong/kekecilan) */
      @media (max-width: 640px) {
        .hero-info-inner {
          justify-content: center;
          text-align: center;
        }
        .hero-info-left {
          min-width: 100%;
        }
        .hero-info-sub {
          max-width: 100%;
          margin: 0 auto;
        }
        .hero-stats {
          width: 100%;
          justify-content: space-between;
          padding: 16px 14px;
        }
        .hero-stat {
          flex: 1;
          padding: 0 6px;
        }
      }

      /* Arch divider */
      .arch-divider {
        display: flex;
        justify-content: center;
        padding: 20px 0 4px;
      }

      /* ============ MAIN CONTENT ============ */
      .content-wrap {
        max-width: 820px;
        margin: 0 auto;
        padding: 8px clamp(16px, 5vw, 48px) 64px;
        padding-bottom: calc(var(--bottomnav-h) + 40px);
      }
      @media (min-width: 768px) {
        .content-wrap {
          padding-bottom: 64px;
        }
      }

      .section-head {
        text-align: center;
        margin-bottom: 40px;
      }
      .section-head h2 {
        font-family: var(--font-display);
        font-size: clamp(22px, 3.4vw, 28px);
        font-weight: 700;
        color: var(--navy-900);
        margin: 0 0 6px;
      }
      .section-head p {
        font-size: 13px;
        color: var(--ink-400);
        font-weight: 600;
        margin: 0;
      }

      /* ---- Timeline ---- */
      .timeline-wrap {
        position: relative;
        margin-left: 8px;
        padding-left: 30px;
        border-left: 2px solid var(--border);
        display: flex;
        flex-direction: column;
        gap: 32px;
      }
      @media (min-width: 768px) {
        .timeline-wrap {
          margin-left: 150px;
        }
      }
      .timeline-item {
        position: relative;
      }
      .timeline-dot {
        position: absolute;
        left: -37px;
        top: 6px;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background: var(--teal-500);
        border: 4px solid var(--surface);
        box-shadow: 0 0 0 1px var(--border);
      }
      .timeline-item.last .timeline-dot {
        background: var(--lime-500);
      }
      .timeline-date {
        display: none;
      }
      @media (min-width: 768px) {
        .timeline-date {
          display: block;
          position: absolute;
          left: -160px;
          top: 4px;
          width: 118px;
          text-align: right;
        }
      }
      .timeline-date-day {
        font-family: var(--font-display);
        font-size: 19px;
        font-weight: 700;
        color: var(--navy-900);
        display: block;
      }
      .timeline-date-weekday {
        font-size: 10.5px;
        font-weight: 800;
        color: var(--teal-600);
        text-transform: uppercase;
        letter-spacing: 0.05em;
      }
      .timeline-item.last .timeline-date-weekday {
        color: #a48a1c;
      }

      .timeline-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-card);
        padding: 22px 24px;
        transition: box-shadow 0.2s, transform 0.2s;
      }
      .timeline-card:hover {
        box-shadow: var(--shadow-pop);
        transform: translateY(-2px);
      }
      .timeline-card.highlight {
        border-left: 4px solid var(--lime-500);
      }
      .timeline-date-mobile {
        display: inline-block;
        font-size: 10.5px;
        font-weight: 800;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: var(--teal-600);
        margin-bottom: 8px;
      }
      .timeline-item.last .timeline-date-mobile {
        color: #a48a1c;
      }
      @media (min-width: 768px) {
        .timeline-date-mobile {
          display: none;
        }
      }
      .timeline-card-head {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        align-items: flex-start;
        flex-wrap: wrap;
      }
      .timeline-day-badge {
        font-size: 10.5px;
        font-weight: 800;
        background: var(--teal-tint);
        color: var(--teal-600);
        padding: 3px 10px;
        border-radius: 6px;
        display: inline-block;
      }
      .timeline-item.last .timeline-day-badge {
        background: var(--lime-tint);
        color: #718821;
      }
      .timeline-title {
        font-family: var(--font-display);
        font-size: 16.5px;
        font-weight: 700;
        color: var(--navy-900);
        margin: 8px 0 0;
        line-height: 1.35;
      }
      .timeline-time {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11.5px;
        font-weight: 700;
        color: var(--ink-600);
        background: var(--bg);
        padding: 6px 12px;
        border-radius: 8px;
        white-space: nowrap;
        flex-shrink: 0;
      }
      .timeline-time svg {
        width: 13px;
        height: 13px;
        color: var(--ink-400);
      }
      .timeline-list {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        gap: 10px;
      }
      .timeline-list p {
        display: flex;
        gap: 8px;
        align-items: flex-start;
        font-size: 12.5px;
        color: var(--ink-600);
        line-height: 1.6;
        margin: 0;
      }
      .timeline-list svg {
        width: 15px;
        height: 15px;
        color: var(--lime-500);
        flex-shrink: 0;
        margin-top: 2px;
      }
      .timeline-location {
        margin-top: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11.5px;
        color: var(--ink-400);
        font-weight: 600;
      }
      .timeline-location svg {
        width: 14px;
        height: 14px;
      }

      /* ---- Catatan / help box (dipakai ulang dari absensi.html) ---- */
      .help-box {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: var(--radius-md);
        padding: 20px 22px;
        display: flex;
        gap: 14px;
        align-items: flex-start;
        margin-top: 56px;
      }
      .help-box-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: var(--navy-900);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
      }
      .help-box-icon svg {
        width: 19px;
        height: 19px;
      }
      .help-box h4 {
        font-family: var(--font-display);
        font-size: 15px;
        font-weight: 700;
        color: var(--navy-900);
        margin: 0 0 4px;
      }
      .help-box p {
        margin: 0;
        font-size: 12.5px;
        color: #1e40af;
        line-height: 1.65;
      }

      /* ============ CTA SECTION ============ */
      .cta-section {
        background: linear-gradient(135deg, var(--navy-900), var(--navy-700));
        padding: clamp(48px, 7vw, 76px) clamp(16px, 5vw, 48px);
        text-align: center;
        position: relative;
        overflow: hidden;
      }
      .cta-section::before {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: rgba(169, 199, 59, 0.08);
        top: -70px;
        left: -70px;
        pointer-events: none;
      }
      .cta-section::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(22, 160, 161, 0.1);
        bottom: -55px;
        right: -55px;
        pointer-events: none;
      }
      .cta-section h2 {
        font-family: var(--font-display);
        font-size: clamp(22px, 3.6vw, 34px);
        color: #fff;
        margin: 0 0 12px;
        position: relative;
        z-index: 1;
      }
      .cta-section p {
        font-size: 14px;
        color: #bfc6ea;
        max-width: 460px;
        margin: 0 auto 28px;
        line-height: 1.7;
        position: relative;
        z-index: 1;
      }
      .cta-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        position: relative;
        z-index: 1;
      }
      .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--lime-500);
        color: var(--navy-900);
        font-family: var(--font-sans);
        font-weight: 800;
        font-size: 13.5px;
        padding: 12px 26px;
        border-radius: 99px;
        border: none;
        cursor: pointer;
        transition: filter 0.15s;
        box-shadow: var(--shadow-pop);
        text-decoration: none;
      }
      .btn-primary:hover {
        filter: brightness(1.06);
      }
      .btn-primary svg {
        width: 16px;
        height: 16px;
      }
      .btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        color: #fff;
        border: 1.5px solid rgba(255, 255, 255, 0.35);
        font-family: var(--font-sans);
        font-weight: 700;
        font-size: 13.5px;
        padding: 12px 26px;
        border-radius: 99px;
        cursor: pointer;
        transition: border-color 0.15s, background 0.15s;
        text-decoration: none;
      }
      .btn-outline:hover {
        border-color: #fff;
        background: rgba(255, 255, 255, 0.08);
      }
      .btn-outline svg {
        width: 16px;
        height: 16px;
      }

      /* ============ FOOTER ============ */
      .footer {
        background: #0d1735;
        padding: 28px clamp(16px, 5vw, 48px);
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
      }
      .footer p {
        font-size: 13px;
        color: #4a6a9f;
        margin: 0;
      }
      .footer-links {
        display: flex;
        gap: 20px;
      }
      .footer-links a {
        font-size: 13px;
        color: #4a6a9f;
        text-decoration: none;
        transition: color 0.15s;
      }
      .footer-links a:hover {
        color: #aeb6e0;
      }
      @media (max-width: 767px) {
        .footer {
          padding-bottom: calc(var(--bottomnav-h) + 16px);
        }
      }

      /* ============ BOTTOM NAV (mobile) ============ */
      .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: var(--bottomnav-h);
        background: var(--surface);
        border-top: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-around;
        padding: 0 6px;
        padding-bottom: env(safe-area-inset-bottom);
        z-index: 30;
      }
      .bottom-nav a {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        color: var(--ink-400);
        font-size: 10px;
        font-weight: 700;
        flex: 1;
        padding: 6px 0;
        text-decoration: none;
      }
      .bottom-nav a .ic {
        width: 22px;
        height: 22px;
      }
      .bottom-nav a.active {
        color: var(--navy-900);
      }
      .bottom-nav a.home {
        flex: 0 0 auto;
        color: #fff;
        margin-top: -30px;
        background: var(--navy-900);
        width: 54px;
        height: 54px;
        border-radius: 50%;
        box-shadow: var(--shadow-pop);
        justify-content: center;
      }
      .bottom-nav a.home .ic {
        width: 24px;
        height: 24px;
      }
      .bottom-nav a.home span {
        display: none;
      }
      @media (min-width: 768px) {
        .bottom-nav {
          display: none;
        }
      }
    </style>
  </head>
  <body>
    <!-- ============ NAVBAR ============ -->
    @include('layouts.mentor.navbar-classic', ['navActive' => 'jadwal'])

    <!-- ============ HERO ============ -->
    <section class="hero-info">
      <div class="hero-info-inner">
        <div class="hero-info-left">
          <span class="hero-eyebrow">
            <span class="dot"></span>
            Masuki Dunia Kampus
          </span>
          <h1>Jadwal Resmi PKKMB 2026</h1>
          <p class="hero-info-sub">
            Persiapkan dirimu, Mahasiswa Baru Universitas La Tansa Mashiro!
            Sambut babak baru akademikmu pada bulan September 2026.
          </p>
        </div>

        <div class="hero-stats">
          <div class="hero-stat">
            <div class="hero-stat-val">SEP</div>
            <div class="hero-stat-lbl">Bulan</div>
          </div>
          <div class="hero-stat">
            <div class="hero-stat-val">2026</div>
            <div class="hero-stat-lbl">Tahun</div>
          </div>
          <div class="hero-stat">
            <div class="hero-stat-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4.5" width="18" height="16" rx="3" />
                <path d="M3 9.5h18M8 2.5v4M16 2.5v4" />
              </svg>
            </div>
            <div class="hero-stat-lbl">Segera Hadir</div>
          </div>
        </div>
      </div>
    </section>

    <div class="arch-divider">
      <svg width="44" height="22" viewBox="0 0 44 22" fill="none">
        <path
          d="M2 22V14C2 9 6 5 11 3L13 1L15 3C20 5 24 9 24 14V22"
          stroke="#152159"
          stroke-width="2"
        />
      </svg>
    </div>

    <!-- ============ MAIN CONTENT ============ -->
    <main class="content-wrap">
      <div class="section-head">
        <h2>Rangkaian Kegiatan</h2>
        <p>Ikuti seluruh tahapan orientasi wajib untuk memulai perkuliahan</p>
      </div>

      <div class="timeline-wrap">
        @forelse ($jadwalList as $idx => $j)
          <div class="timeline-item">
            <div class="timeline-date">
              <span class="timeline-date-day">{{ \Carbon\Carbon::parse($j->schedule_date)->translatedFormat('d M') }}</span>
              <span class="timeline-date-weekday">{{ \Carbon\Carbon::parse($j->schedule_date)->translatedFormat('l') }}</span>
            </div>
            <div class="timeline-dot"></div>
            <div class="timeline-card">
              <span class="timeline-date-mobile">{{ \Carbon\Carbon::parse($j->schedule_date)->translatedFormat('l, d F Y') }}</span>
              <div class="timeline-card-head">
                <div>
                  <span class="timeline-day-badge">Hari ke-{{ $idx + 1 }}</span>
                  <h3 class="timeline-title">{{ $j->title }}</h3>
                </div>
                <span class="timeline-time">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 2" /></svg>
                  {{ substr($j->schedule_begin_time, 0, 5) }} - {{ substr($j->schedule_end_time, 0, 5) }}
                </span>
              </div>
              @if ($j->description)
                <div class="timeline-list">
                  @foreach (preg_split('/\r\n|\r|\n/', $j->description) as $baris)
                    @continue(trim($baris) === '')
                    <p>
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2 4-4" /><circle cx="12" cy="12" r="9" /></svg>
                      {{ $baris }}
                    </p>
                  @endforeach
                </div>
              @endif
              @if ($j->place)
                <div class="timeline-location">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-6.5 7-11a7 7 0 1 0-14 0c0 4.5 7 11 7 11Z" /><circle cx="12" cy="10" r="2.5" /></svg>
                  <span>{{ $j->place }}</span>
                </div>
              @endif
            </div>
          </div>
        @empty
          <p class="text-center text-sm text-slate-400 py-10">Jadwal PKKMB belum diisi Panitia.</p>
        @endforelse
      </div>

      <!-- CATATAN PENTING -->
      <div class="help-box">
        <div class="help-box-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9" /><path d="M12 16v-4M12 8h.01" /></svg>
        </div>
        <div>
          <h4>Catatan Penting Calon Mahasiswa</h4>
          <p>
            Perubahan detail jam acara atau ketentuan penugasan khusus akan
            diumumkan secara berkala melalui grup koordinasi mentor dan akun
            resmi Biro Kemahasiswaan UNILAM. Pastikan selalu memantau
            informasi valid.
          </p>
        </div>
      </div>
    </main>

    <!-- ============ CTA ============ -->
    <section class="cta-section">
      <h2>Siap Memulai Perjalanan Akademikmu?</h2>
      <p>
        Pastikan seluruh berkas dan atribut sudah lengkap. Hubungi mentor
        pendamping kelompokmu jika ada yang perlu ditanyakan.
      </p>
      <div class="cta-buttons">
        <a href="{{ route('landing.informasi') }}" class="btn-primary">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7" /></svg>
          Lihat Informasi Lengkap
        </a>
        <a href="{{ route('landing.kontak') }}" class="btn-outline">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z" /></svg>
          Hubungi Panitia
        </a>
      </div>
    </section>

    <!-- ============ FOOTER ============ -->
    @include('layouts.mentor.footer-classic')

    @include('layouts.mentor.bottomnav-classic', ['navActive' => 'jadwal'])

    <script>
      const navbarLinks = document.getElementById("navbarLinks");

      const dropdownTentang = document.getElementById("dropdownTentang");
      const dropdownTentangToggle = document.getElementById("dropdownTentangToggle");

      dropdownTentangToggle.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        const isOpen = dropdownTentang.classList.toggle("open");
        dropdownTentangToggle.setAttribute("aria-expanded", isOpen);
      });

      document.addEventListener("click", (e) => {
        if (!dropdownTentang.contains(e.target)) {
          dropdownTentang.classList.remove("open");
          dropdownTentangToggle.setAttribute("aria-expanded", "false");
        }
      });
    </script>
  </body>
</html>