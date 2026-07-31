<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Absensi Saya | PKKMB-KT UNILAM 2026</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />


    <style>
      /* ============ DESIGN TOKENS — IDENTIK HOMEPAGE/MATERI/EVALUASI ============ */
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
        margin: 0;
        padding: 0;
        background: var(--bg);
        -webkit-font-smoothing: antialiased;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
      }
      .font-display {
        font-family: var(--font-display);
      }

      /* ============ NAVBAR — COPY EXACT DARI HOMEPAGE/MATERI/EVALUASI ============ */
      .navbar {
        position: sticky;
        top: 0;
        z-index: 50;
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
        font-family: var(--font-display);
        font-size: 9px;
        font-weight: 700;
        color: var(--navy-900);
        text-align: center;
        line-height: 1.25;
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
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0;
        right: -100%;
        width: 280px;
        height: 100vh;
        background: #0d1735;
        padding: 100px 32px 32px;
        gap: 24px;
        transition: right 0.3s ease;
        box-shadow: -5px 0 25px rgba(0, 0, 0, 0.3);
      }
      .navbar-links.active {
        right: 0;
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
      }

      /* ============ HERO ============ */
      .hero-info {
        position: relative;
        padding: clamp(36px, 6vw, 56px) clamp(16px, 5vw, 48px);
        overflow: hidden;
      }
      /* ►► SLIDESHOW LATAR HERO — sama seperti info.html. Ganti/tambah
         gambar di array JS "heroSlideImages" di bagian bawah file ini. */
      .hero-slideshow {
        position: absolute;
        inset: 0;
        z-index: 0;
        overflow: hidden;
      }
      .hero-slide {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        opacity: 0;
        transition: opacity 1.8s ease;
      }
      .hero-slide.active {
        opacity: 1;
      }
      .hero-slideshow::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
          135deg,
          rgba(21, 33, 89, 0.94) 0%,
          rgba(15, 138, 140, 0.85) 100%
        );
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
        gap: 28px;
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
        padding: 5px 14px;
        border-radius: 99px;
        margin-bottom: 16px;
        letter-spacing: 0.06em;
        text-transform: uppercase;
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
        font-size: clamp(24px, 4vw, 38px);
        font-weight: 700;
        color: #fff;
        margin: 0 0 12px;
        line-height: 1.2;
      }
      .hero-info-sub {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.75);
        line-height: 1.7;
        max-width: 460px;
        margin: 0;
      }

      .hero-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
        flex-shrink: 0;
      }

      /* ---- Date navigator: satu kartu kaca berisi panah prev/next,
             tampilan tanggal (klik untuk buka kalender native), dan
             pil "Hari Ini" yang hanya muncul kalau sedang melihat
             tanggal selain hari ini. ---- */
      .date-nav {
        display: flex;
        align-items: stretch;
        gap: 2px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.16);
        border-radius: 99px;
        padding: 5px;
        backdrop-filter: blur(14px);
        box-shadow: 0 6px 18px rgba(9, 14, 40, 0.18);
      }
      .date-arrow {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        border-radius: 50%;
        border: none;
        background: transparent;
        color: rgba(255, 255, 255, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.15s, color 0.15s;
      }
      .date-arrow svg {
        width: 16px;
        height: 16px;
      }
      .date-arrow:hover:not(:disabled) {
        background: rgba(255, 255, 255, 0.14);
        color: #fff;
      }
      .date-arrow:disabled {
        opacity: 0.3;
        cursor: not-allowed;
      }
      .date-display {
        position: relative;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 0 14px;
        border-radius: 99px;
        cursor: pointer;
        min-width: 168px;
        justify-content: center;
      }
      .date-display:hover {
        background: rgba(255, 255, 255, 0.08);
      }
      .date-display svg {
        width: 15px;
        height: 15px;
        color: var(--lime-500);
        flex-shrink: 0;
      }
      .date-display-text {
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        white-space: nowrap;
        pointer-events: none;
      }
      .date-display-text .weekday {
        color: rgba(255, 255, 255, 0.6);
        font-weight: 600;
      }
      .date-input {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        border: none;
        padding: 0;
      }
      .btn-today {
        font-size: 11.5px;
        font-weight: 800;
        color: var(--navy-900);
        background: var(--lime-500);
        border: none;
        border-radius: 99px;
        padding: 0 16px;
        margin-left: 3px;
        cursor: pointer;
        display: flex;
        align-items: center;
        transition: filter 0.15s, transform 0.15s, opacity 0.2s, max-width 0.25s, padding 0.25s;
        white-space: nowrap;
        overflow: hidden;
      }
      .btn-today:hover {
        filter: brightness(1.08);
        transform: translateY(-1px);
      }
      .btn-today.is-hidden {
        opacity: 0;
        max-width: 0;
        padding: 0;
        margin-left: 0;
        pointer-events: none;
      }

      .hero-stats {
        display: flex;
        gap: 2px;
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: var(--radius-md);
        padding: 16px 22px;
        backdrop-filter: blur(12px);
        flex-shrink: 0;
      }
      .hero-stat {
        text-align: center;
        padding: 0 16px;
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
        font-size: 10px;
        color: rgba(255, 255, 255, 0.55);
        font-weight: 600;
        margin-top: 4px;
        letter-spacing: 0.04em;
      }

      /* ============ MAIN CONTENT ============ */
      .content-wrap {
        max-width: 1000px;
        margin: 0 auto;
        padding: 32px clamp(16px, 5vw, 48px);
        padding-bottom: calc(var(--bottomnav-h) + 28px);
        width: 100%;
        flex: 1;
      }
      @media (min-width: 768px) {
        .content-wrap {
          padding-bottom: 32px;
        }
      }

      .section-head {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
      }
      .section-head-bar {
        width: 4px;
        height: 20px;
        border-radius: 99px;
        background: linear-gradient(to bottom, var(--teal-500), var(--navy-700));
      }
      .section-head h2 {
        font-family: var(--font-display);
        font-size: 16px;
        font-weight: 700;
        color: var(--ink-900);
        margin: 0;
      }

      /* ============ KARTU IDENTITAS AKUN — HANYA DATA MILIK SENDIRI ============ */
      .identity-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-card);
        padding: 18px 22px;
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
      }
      .identity-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        overflow: hidden;
        background: var(--teal-tint);
        flex-shrink: 0;
        border: 3px solid var(--teal-tint);
      }
      .identity-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
      .identity-name {
        font-family: var(--font-display);
        font-size: 17px;
        font-weight: 700;
        color: var(--ink-900);
        margin: 0;
      }
      .identity-meta {
        font-size: 12px;
        color: var(--ink-600);
        margin: 4px 0 0;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
      }
      .identity-meta .badge-kelompok {
        font-size: 10px;
        background: var(--navy-tint);
        color: var(--navy-900);
        padding: 3px 10px;
        border-radius: 99px;
        font-weight: 800;
        font-family: monospace;
      }
      .identity-lock {
        margin-left: auto;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 700;
        color: var(--teal-600);
        background: var(--teal-tint);
        padding: 7px 14px;
        border-radius: 99px;
        flex-shrink: 0;
      }
      .identity-lock svg {
        width: 12px;
        height: 12px;
      }
      @media (max-width: 520px) {
        .identity-lock span.lock-text {
          display: none;
        }
        .identity-lock {
          padding: 8px;
        }
      }

      .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 24px;
      }
      @media (max-width: 640px) {
        .stats-grid {
          grid-template-columns: repeat(2, 1fr);
        }
      }
      .stat-card {
        background: var(--surface);
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
        border-left: 4px solid var(--accent);
        padding: 14px;
        box-shadow: var(--shadow-card);
        transition: transform 0.18s, box-shadow 0.18s;
      }
      .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-pop);
      }
      .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
      }
      .stat-lbl {
        font-size: 11px;
        color: var(--ink-400);
        font-weight: 600;
      }
      .stat-icon {
        width: 26px;
        height: 26px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .stat-val {
        font-family: var(--font-display);
        font-size: 26px;
        font-weight: 700;
        margin-top: 8px;
      }
      .stat-val small {
        font-family: var(--font-sans);
        font-size: 11px;
        font-weight: 500;
        color: var(--ink-400);
      }

      .card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-card);
        overflow: hidden;
        margin-bottom: 20px;
      }
      .card-head {
        padding: 16px 22px;
        background: var(--bg);
        border-bottom: 1px solid var(--border);
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
      }
      .card-head h3 {
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: var(--navy-900);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
      }
      .source-badge {
        font-size: 10px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 99px;
      }
      .source-live {
        background: #dcfce7;
        color: #15803d;
      }
      .source-demo {
        background: #fef3c7;
        color: #b45309;
      }

      /* ============ DAFTAR SESI (Pagi/Siang/Sore) ============ */
      .session-list {
        display: flex;
        flex-direction: column;
      }
      .session-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 16px 22px;
        border-top: 1px solid var(--border);
        transition: background 0.15s;
      }
      .session-row:hover {
        background: var(--bg);
      }
      .session-row:first-child {
        border-top: none;
      }
      .session-info {
        display: flex;
        align-items: center;
        gap: 12px;
      }
      .session-icon {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: var(--teal-tint);
        color: var(--teal-600);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
      }
      .session-icon svg {
        width: 18px;
        height: 18px;
      }
      .session-name {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--ink-900);
        margin: 0;
      }
      .session-time {
        font-size: 11px;
        color: var(--ink-400);
        margin: 2px 0 0;
      }

      .status-badge {
        display: inline-block;
        min-width: 96px;
        text-align: center;
        padding: 7px 14px;
        border-radius: 99px;
        font-weight: 700;
        font-size: 11.5px;
      }
      .badge-hadir {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
      }
      .badge-sakit {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
      }
      .badge-izin {
        background: #dbeafe;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
      }
      .badge-alpha {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
      }
      .badge-belum {
        background: #f1f5f9;
        color: var(--ink-400);
        border: 1px solid var(--border);
        font-weight: 500;
      }

      .help-box {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: var(--radius-md);
        padding: 16px 18px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
      }
      .help-box svg {
        width: 18px;
        height: 18px;
        stroke: #1d4ed8;
        flex-shrink: 0;
        margin-top: 1px;
      }
      .help-box p {
        margin: 0;
        font-size: 12px;
        color: #1e40af;
        line-height: 1.6;
      }
      .help-box p strong {
        display: block;
        margin-bottom: 2px;
      }

      /* ============ FOOTER ============ */
      .footer {
        background: #0d1735;
        padding: 24px clamp(16px, 5vw, 48px);
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
    <header class="navbar">
      <a href="{{ route('dashboard') }}" class="navbar-brand" aria-label="PKKMB-KT UNILAM Beranda">
        <div class="navbar-logo">
          <img src="{{ asset('gambar/unilam.png') }}" alt="Logo UNILAM" />
        </div>
        <div class="navbar-brand-text">
          <strong>PKKMB-KT</strong>
          <span>UNILAM 2026</span>
        </div>
      </a>

      <button class="menu-toggle" id="menuToggle" aria-label="Buka Menu">
        
      </button>

      <nav class="navbar-links" id="navbarLinks">
        <a href="{{ route('role.student.modul') }}">Modul</a>
        <a href="{{ route('role.student.leaderboard') }}">Leaderboard</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('role.student.info') }}">Info</a>
        <a href="{{ route('role.student.profil') }}">Profil</a>
      </nav>
    </header>

    <!-- ============ HERO ============ -->
    <section class="hero-info">
      <!-- ►► SLIDESHOW LATAR — slide diisi otomatis lewat JS di bawah -->
      <div class="hero-slideshow" id="heroSlideshow"></div>

      <div class="hero-info-inner">
        <div class="hero-info-left">
          <div class="hero-eyebrow">
            <span class="dot"></span>
            Rekam Kehadiran Pribadi
          </div>
          <h1>Absensi<br />Lihat Kehadiran Saya</h1>
          <p class="hero-info-sub">
            Pantau status kehadiranmu di setiap sesi PKKMB-KT. Data yang
            ditampilkan hanya milik akunmu sendiri.
          </p>
        </div>
        <div class="hero-right">
          <div class="date-nav">
            <button type="button" class="date-arrow" id="prevDay" aria-label="Hari sebelumnya">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6" /></svg>
            </button>
            <div class="date-display" id="dateDisplay">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4.5" width="18" height="16" rx="3" />
                <path d="M3 9.5h18M8 2.5v4M16 2.5v4" />
              </svg>
              <span class="date-display-text" id="datePill">Kamis, 30 Jul 2026</span>
              <input type="date" id="dateInput" class="date-input" />
            </div>
            <button type="button" class="date-arrow" id="nextDay" aria-label="Hari berikutnya">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6" /></svg>
            </button>
            <button type="button" class="btn-today is-hidden" id="btnToday">Hari Ini</button>
          </div>
        </div>
      </div>
    </section>

    <main class="content-wrap">
      <!-- ============ IDENTITAS AKUN — HANYA DATA MILIK SENDIRI ============ -->
      <div class="identity-card">
        <div class="identity-avatar">
          <img src="{{ asset('gambar/nazrul.jpeg') }}" alt="Foto Profil" />
        </div>
        <div>
          <p class="identity-name" id="identityName">Alexander Arul Husein</p>
          <p class="identity-meta">
            NPM <span id="identityNPM">525241019</span>
            <span class="badge-kelompok" id="identityKelompok">Kelompok 01</span>
          </p>
        </div>
        <span class="identity-lock">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <rect x="4" y="10" width="16" height="10" rx="2" />
            <path d="M8 10V7a4 4 0 0 1 8 0v3" />
          </svg>
          <span class="lock-text">Data pribadi</span>
        </span>
      </div>

      <div class="section-head">
        <div class="section-head-bar"></div>
        <h2>Ringkasan Kehadiran</h2>
      </div>
      <div class="stats-grid">
        <div class="stat-card" style="--accent: #22c55e">
          <div class="stat-top">
            <span class="stat-lbl">Hadir</span>
            <span class="stat-icon" style="background: #f0fdf4; color: #16a34a">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                <path d="M22 4 12 14.01l-3-3" />
              </svg>
            </span>
          </div>
          <p class="stat-val" id="stat-hadir">0 <small>sesi</small></p>
        </div>
        <div class="stat-card" style="--accent: #f59e0b">
          <div class="stat-top">
            <span class="stat-lbl">Sakit</span>
            <span class="stat-icon" style="background: #fffbeb; color: #d97706">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 4v10.54a4 4 0 1 1-4 0V4a2 2 0 0 1 4 0Z" />
              </svg>
            </span>
          </div>
          <p class="stat-val" id="stat-sakit">0 <small>sesi</small></p>
        </div>
        <div class="stat-card" style="--accent: #3b82f6">
          <div class="stat-top">
            <span class="stat-lbl">Izin</span>
            <span class="stat-icon" style="background: #eff6ff; color: #2563eb">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <path d="M14 2v6h6" />
              </svg>
            </span>
          </div>
          <p class="stat-val" id="stat-izin">0 <small>sesi</small></p>
        </div>
        <div class="stat-card" style="--accent: #ef4444">
          <div class="stat-top">
            <span class="stat-lbl">Alpha</span>
            <span class="stat-icon" style="background: #fef2f2; color: #dc2626">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                <path d="M12 9v4M12 17h.01" />
              </svg>
            </span>
          </div>
          <p class="stat-val" id="stat-alpha">0 <small>sesi</small></p>
        </div>
      </div>

      <div class="card">
        <div class="card-head">
          <h3>
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--teal-500)">
              <circle cx="12" cy="12" r="10" />
              <path d="M12 6v6l4 2" />
            </svg>
            <span id="sessionCardTitle">Detail Kehadiran Hari Ini</span>
          </h3>
          <span class="source-badge" id="sourceBadge">Memuat...</span>
        </div>
        <div class="session-list" id="sessionList"></div>
      </div>

      <div class="help-box">
        <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10" />
          <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
          <path d="M12 17h.01" />
        </svg>
        <p>
          <strong>Halaman ini hanya menampilkan absensi milik akun Anda sendiri.</strong>
          Anda tidak dapat melihat status kehadiran mahasiswa lain maupun kelompok lain.
          Jika menemukan ketidaksesuaian data, harap konfirmasi langsung kepada mentor
          pendamping kelompok Anda dengan membawa bukti presensi manual.
        </p>
      </div>
    </main>

    <!-- ============ FOOTER ============ -->
    <footer class="footer">
      <p>© 2026 PKKMB-KT UNILAM. Semua hak dilindungi.</p>
      <div class="footer-links">
        <a href="{{ route('landing.kebijakan-privasi') }}">Kebijakan Privasi</a>
        <a href="{{ route('landing.syarat-ketentuan') }}">Syarat &amp; Ketentuan</a>
        <a href="{{ route('landing.bantuan') }}">Bantuan</a>
      </div>
    </footer>

    <!-- ======= BOTTOM NAV (mobile only) ======= -->
    <nav class="bottom-nav" aria-label="Navigasi bawah">
      <a href="{{ route('role.student.modul') }}">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
          <path d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z" />
        </svg>
        <span>Modul</span>
      </a>
      <a href="{{ route('role.student.leaderboard') }}">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z" />
          <path d="M5 21v-5M12 21v-7M19 21v-4" />
        </svg>
        <span>Papan</span>
      </a>
      <a href="{{ route('dashboard') }}" class="home" aria-label="Beranda">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 11.5 12 4l8 7.5" />
          <path d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10" />
        </svg>
        <span>Beranda</span>
      </a>
       <a href="{{ route('role.student.info') }}">
        <svg
          class="ic"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="1.7"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path
            d="M9 17H4l1.4-1.4A2 2 0 0 0 6 14.2V11a6 6 0 1 1 12 0v3.2c0 .5.2 1 .6 1.4L20 17h-5"
          />
          <path d="M9 17a3 3 0 0 0 6 0" />
        </svg>
        <span>Info</span>
      </a>
      <a href="{{ route('role.student.profil') }}">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="8" r="3.4" />
          <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
        </svg>
        <span>Profil</span>
      </a>
    </nav>

    <script>
      /* ---------- NAVBAR HAMBURGER (mobile) ---------- */
    
      // ======================================================================
      // ►► IDENTITAS AKUN YANG SEDANG LOGIN — GANTI DENGAN DATA ASLI
      //    Saat ini masih hardcode karena belum ada sistem login/backend
      //    beneran. Kalau nanti sudah ada, gantikan blok ini dengan data
      //    yang diambil dari sesi login (mis. dari server / token JWT),
      //    supaya tidak mungkin ada mahasiswa lain yang bisa mengganti
      //    NPM di localStorage untuk melihat data orang lain.
      // ======================================================================
      const CURRENT_STUDENT = {
        nama: "Alexander Arul Husein",
        npm: "525241019",
        kelompok: "Kelompok 01",
      };

      document.getElementById("identityName").textContent = CURRENT_STUDENT.nama;
      document.getElementById("identityNPM").textContent = CURRENT_STUDENT.npm;
      document.getElementById("identityKelompok").textContent = CURRENT_STUDENT.kelompok;

      // Kode singkat (dari panel mentor) -> label penuh dipakai halaman ini
      const KODE_KE_LABEL = { H: "Hadir", S: "Sakit", I: "Izin", A: "Alpha" };
      const DEMO_STATUSES = ["Hadir", "Hadir", "Hadir", "Sakit", "Izin", "Alpha"];

      let currentDate = new Date().toISOString().slice(0, 10);
      let isLiveData = false;

      function storageKey(group, date) {
        return `absensi:${group}:${date}`;
      }

      function formatTanggalIndo(isoDate) {
        const hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        const bulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
        const [y, m, d] = isoDate.split("-").map(Number);
        const namaHari = hari[new Date(y, m - 1, d).getDay()];
        return `${namaHari}, ${d} ${bulan[m - 1]} ${y}`;
      }

      // Status demo deterministik berdasarkan nama, dipakai HANYA kalau
      // mentor belum mengirim data live untuk kelompok & tanggal ini.
      function statusDemoUntukSaya() {
        let hash = 0;
        for (const ch of CURRENT_STUDENT.nama) hash += ch.charCodeAt(0);
        return {
          pagi: DEMO_STATUSES[hash % DEMO_STATUSES.length],
          siang: DEMO_STATUSES[(hash + 1) % DEMO_STATUSES.length],
          sore: DEMO_STATUSES[(hash + 2) % DEMO_STATUSES.length],
        };
      }

      function getStatusBadge(status) {
        if (status === "Hadir") return `<span class="status-badge badge-hadir">Hadir</span>`;
        if (status === "Sakit") return `<span class="status-badge badge-sakit">Sakit</span>`;
        if (status === "Izin") return `<span class="status-badge badge-izin">Izin</span>`;
        if (status === "Alpha") return `<span class="status-badge badge-alpha">Alpha</span>`;
        return `<span class="status-badge badge-belum">Belum Mulai</span>`;
      }

      function updateStats(myStatus) {
        let hadir = 0, sakit = 0, izin = 0, alpha = 0;
        [myStatus.pagi, myStatus.siang, myStatus.sore].forEach((stat) => {
          if (stat === "Hadir") hadir++;
          else if (stat === "Sakit") sakit++;
          else if (stat === "Izin") izin++;
          else if (stat === "Alpha") alpha++;
        });
        document.getElementById("stat-hadir").innerHTML = `${hadir} <small>sesi</small>`;
        document.getElementById("stat-sakit").innerHTML = `${sakit} <small>sesi</small>`;
        document.getElementById("stat-izin").innerHTML = `${izin} <small>sesi</small>`;
        document.getElementById("stat-alpha").innerHTML = `${alpha} <small>sesi</small>`;
      }

      function renderSessionList(myStatus) {
        const sessions = [
          {
            key: "pagi",
            label: "Sesi Pagi",
            time: "08:00 WIB",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5" /><path d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4" /></svg>`,
          },
          {
            key: "siang",
            label: "Sesi Siang",
            time: "13:00 WIB",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4" /><path d="M12 3v2M12 19v2M3 12h2M19 12h2" /></svg>`,
          },
          {
            key: "sore",
            label: "Sesi Sore",
            time: "16:00 WIB",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v6" /><path d="M5.6 8.6l1.4 1.4M18.4 8.6l-1.4 1.4" /><path d="M3 16h18" /><path d="M5 20h14" /></svg>`,
          },
        ];

        const list = document.getElementById("sessionList");
        list.innerHTML = sessions
          .map(
            (s) => `
              <div class="session-row">
                <div class="session-info">
                  <span class="session-icon">${s.icon}</span>
                  <div>
                    <p class="session-name">${s.label}</p>
                    <p class="session-time">${s.time}</p>
                  </div>
                </div>
                ${getStatusBadge(myStatus[s.key])}
              </div>
            `,
          )
          .join("");
      }

      // ======================================================================
      // ►► AMBIL DATA — hanya baris milik CURRENT_STUDENT dari data kelompok
      //    yang dikirim mentor. Data mahasiswa lain di kelompok yang sama
      //    TIDAK PERNAH dikirim ke tampilan / disimpan di variabel manapun
      //    di halaman ini, jadi tidak bisa "diintip" lewat console browser.
      // ======================================================================
      async function ambilStatusSaya() {
        try {
          const res = await window.storage.get(
            storageKey(CURRENT_STUDENT.kelompok, currentDate),
            true,
          );
          if (res && res.value) {
            const payload = JSON.parse(res.value);
            if (payload && Array.isArray(payload.rows)) {
              const baris = payload.rows.find(
                (r) =>
                  r.nama &&
                  r.nama.trim().toLowerCase() ===
                    CURRENT_STUDENT.nama.trim().toLowerCase(),
              );
              if (baris) {
                isLiveData = true;
                return {
                  pagi: KODE_KE_LABEL[baris.pagi] || "Belum Mulai",
                  siang: KODE_KE_LABEL[baris.siang] || "Belum Mulai",
                  sore: KODE_KE_LABEL[baris.sore] || "Belum Mulai",
                };
              }
            }
          }
        } catch (e) {
          // belum ada data tersimpan untuk kelompok/tanggal ini
        }
        isLiveData = false;
        return statusDemoUntukSaya();
      }

      async function renderHalaman() {
        document.getElementById("datePill").textContent = formatTanggalIndo(currentDate);
        document.getElementById("sessionCardTitle").textContent =
          currentDate === new Date().toISOString().slice(0, 10)
            ? "Detail Kehadiran Hari Ini"
            : `Detail Kehadiran ${formatTanggalIndo(currentDate)}`;

        const sourceBadge = document.getElementById("sourceBadge");
        sourceBadge.textContent = "Memuat...";
        sourceBadge.className = "source-badge";

        const myStatus = await ambilStatusSaya();

        if (isLiveData) {
          sourceBadge.textContent = "Data Live dari Mentor";
          sourceBadge.className = "source-badge source-live";
        } else {
          sourceBadge.textContent = "Data Contoh (Belum Dikirim Mentor)";
          sourceBadge.className = "source-badge source-demo";
        }

        updateStats(myStatus);
        renderSessionList(myStatus);
        updateKontrolNavigasi();
      }

      // ======================================================================
      // ►► GANTI TANGGAL — mahasiswa bisa cek riwayat kehadirannya sendiri
      //    di tanggal lain (tidak bisa lebih dari hari ini / masa depan).
      // ======================================================================
      const dateInput = document.getElementById("dateInput");
      const btnToday = document.getElementById("btnToday");
      const prevDayBtn = document.getElementById("prevDay");
      const nextDayBtn = document.getElementById("nextDay");
      const todayIso = new Date().toISOString().slice(0, 10);

      dateInput.max = todayIso;
      dateInput.value = currentDate;

      function pindahHari(delta) {
        const d = new Date(currentDate + "T00:00:00");
        d.setDate(d.getDate() + delta);
        const iso = d.toISOString().slice(0, 10);
        if (iso > todayIso) return; // tidak boleh ke masa depan
        currentDate = iso;
        dateInput.value = iso;
        renderHalaman();
      }

      function updateKontrolNavigasi() {
        nextDayBtn.disabled = currentDate >= todayIso;
        if (currentDate === todayIso) {
          btnToday.classList.add("is-hidden");
        } else {
          btnToday.classList.remove("is-hidden");
        }
      }

      dateInput.addEventListener("change", () => {
        if (!dateInput.value) return;
        currentDate = dateInput.value;
        renderHalaman();
      });

      prevDayBtn.addEventListener("click", () => pindahHari(-1));
      nextDayBtn.addEventListener("click", () => pindahHari(1));

      // Klik di area tampilan tanggal (ikon/teks) langsung membuka kalender
      // native, supaya user bisa lompat ke bulan/tahun lain dengan mudah,
      // bukan cuma geser sehari demi sehari lewat tombol panah.
      const dateDisplay = document.getElementById("dateDisplay");
      dateDisplay.addEventListener("click", (e) => {
        if (e.target === dateInput) return; // biarkan klik pada input asli jalan normal
        if (typeof dateInput.showPicker === "function") {
          try {
            dateInput.showPicker();
          } catch (err) {
            dateInput.focus();
          }
        } else {
          dateInput.focus();
          dateInput.click();
        }
      });

      btnToday.addEventListener("click", () => {
        currentDate = todayIso;
        dateInput.value = todayIso;
        renderHalaman();
      });

      renderHalaman();

      // Auto-refresh tiap 15 detik HANYA kalau sedang melihat tanggal hari ini
      // (data riwayat tanggal lampau tidak perlu di-refresh terus-menerus)
      setInterval(() => {
        if (currentDate === todayIso) renderHalaman();
      }, 15000);

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO — sama seperti info.html. Ganti / tambah
      //    gambar di array ini.
      // ======================================================================
      const heroSlideImages = [
        "{{ asset('gambar/gedungutama.jpeg') }}",
        "{{ asset('gambar/rektor.jpeg') }}",
        "{{ asset('gambar/gedung.jpeg') }}",
      ];
      const HERO_SLIDE_INTERVAL_MS = 6000;
      const heroSlideshow = document.getElementById("heroSlideshow");
      if (heroSlideshow && heroSlideImages.length) {
        heroSlideImages.forEach((src, i) => {
          const slide = document.createElement("div");
          slide.className = "hero-slide" + (i === 0 ? " active" : "");
          slide.style.backgroundImage = `url("${src}")`;
          heroSlideshow.appendChild(slide);
        });
        if (heroSlideImages.length > 1) {
          let currentSlide = 0;
          const slideEls = heroSlideshow.querySelectorAll(".hero-slide");
          setInterval(() => {
            slideEls[currentSlide].classList.remove("active");
            currentSlide = (currentSlide + 1) % slideEls.length;
            slideEls[currentSlide].classList.add("active");
          }, HERO_SLIDE_INTERVAL_MS);
        }
      }
    </script>
  </body>
</html>