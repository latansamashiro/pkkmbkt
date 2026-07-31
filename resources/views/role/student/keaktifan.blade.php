<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Poin Keaktifan &amp; Pelanggaran | PKKMB-KT UNILAM 2026</title>
     <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <style>
      /* ============ DESIGN TOKENS — IDENTIK HALAMAN LAIN ============ */
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

      /* ============ NAVBAR — COPY EXACT DARI HALAMAN LAIN ============ */
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
        display: none;
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
      /* ►► SLIDESHOW LATAR HERO — sama seperti halaman lain. Ganti/tambah
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

      /* ============ TOTAL KEAKTIFAN & PELANGGARAN ============ */
      .poin-total-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 20px;
      }
      @media (max-width: 560px) {
        .poin-total-grid {
          grid-template-columns: 1fr;
        }
      }
      .poin-total-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-card);
        padding: 22px;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: transform 0.18s, box-shadow 0.18s;
      }
      .poin-total-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-pop);
      }
      .poin-total-card.keaktifan {
        border-left: 4px solid #22c55e;
      }
      .poin-total-card.pelanggaran {
        border-left: 4px solid #ef4444;
      }
      .poin-total-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
      }
      .poin-total-icon svg {
        width: 24px;
        height: 24px;
      }
      .poin-total-card.keaktifan .poin-total-icon {
        background: #f0fdf4;
        color: #16a34a;
      }
      .poin-total-card.pelanggaran .poin-total-icon {
        background: #fef2f2;
        color: #dc2626;
      }
      .poin-total-val {
        font-family: var(--font-display);
        font-size: 30px;
        font-weight: 700;
        line-height: 1;
      }
      .poin-total-card.keaktifan .poin-total-val {
        color: #16a34a;
      }
      .poin-total-card.pelanggaran .poin-total-val {
        color: #dc2626;
      }
      .poin-total-lbl {
        font-size: 12.5px;
        color: var(--ink-900);
        font-weight: 700;
        margin-top: 4px;
      }
      .poin-total-count {
        font-size: 11px;
        color: var(--ink-400);
        font-weight: 600;
        margin-top: 2px;
      }

      .poin-filter-chips {
        display: flex;
        gap: 8px;
        padding: 12px 22px;
        border-bottom: 1px solid var(--border);
        background: var(--bg);
        flex-wrap: wrap;
      }
      .poin-chip {
        padding: 6px 14px;
        border-radius: 99px;
        font-size: 11.5px;
        font-weight: 700;
        border: 1.5px solid var(--border);
        background: var(--surface);
        color: var(--ink-600);
        cursor: pointer;
        transition: all 0.15s;
      }
      .poin-chip:hover {
        border-color: var(--teal-500);
        color: var(--teal-600);
      }
      .poin-chip.active {
        background: var(--navy-900);
        border-color: var(--navy-900);
        color: #fff;
      }

      .poin-list {
        display: flex;
        flex-direction: column;
      }
      .poin-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 14px 22px;
        border-top: 1px solid var(--border);
        transition: background 0.15s;
      }
      .poin-row:hover {
        background: var(--bg);
      }
      .poin-row:first-child {
        border-top: none;
      }
      .poin-row-info {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
      }
      .poin-row-icon {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
      }
      .poin-row-icon svg {
        width: 17px;
        height: 17px;
      }
      .poin-row-icon.plus {
        background: #f0fdf4;
        color: #16a34a;
      }
      .poin-row-icon.minus {
        background: #fef2f2;
        color: #dc2626;
      }
      .poin-row-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--ink-900);
        margin: 0;
        line-height: 1.4;
      }
      .poin-row-date {
        font-size: 11px;
        color: var(--ink-400);
        margin: 2px 0 0;
      }
      .poin-badge {
        flex-shrink: 0;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 14px;
        padding: 6px 13px;
        border-radius: 99px;
        white-space: nowrap;
      }
      .poin-badge.plus {
        background: #f0fdf4;
        color: #15803d;
      }
      .poin-badge.minus {
        background: #fef2f2;
        color: #b91c1c;
      }
      .poin-empty {
        padding: 32px 22px;
        text-align: center;
        font-size: 12.5px;
        color: var(--ink-400);
        font-weight: 600;
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
            Rekam Poin Pribadi
          </div>
          <h1>Poin Keaktifan<br />&amp; Pelanggaran</h1>
          <p class="hero-info-sub">
            Pantau poin yang kamu dapat dari keaktifan dan poin yang berkurang
            akibat pelanggaran selama PKKMB-KT. Data yang ditampilkan hanya
            milik akunmu sendiri.
          </p>
        </div>
        <div class="hero-stats">
          <div class="hero-stat">
            <div class="hero-stat-val" id="heroTotalKeaktifan">0</div>
            <div class="hero-stat-lbl">Keaktifan</div>
          </div>
          <div class="hero-stat">
            <div class="hero-stat-val" id="heroTotalPelanggaran">0</div>
            <div class="hero-stat-lbl">Pelanggaran</div>
          </div>
        </div>
      </div>
    </section>

    <main class="content-wrap">
      <!-- ============ IDENTITAS AKUN — HANYA DATA MILIK SENDIRI ============ -->
      <div class="identity-card">
        <div class="identity-avatar">
          <img src="{{ auth()->user()->profile_picture ? asset('storage/'.auth()->user()->profile_picture) : 'data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27%3E%3Crect width=%27100%27 height=%27100%27 fill=%27%23e2e8f0%27/%3E%3Ccircle cx=%2750%27 cy=%2738%27 r=%2718%27 fill=%27%2394a3b8%27/%3E%3Cpath d=%27M20 88c0-22 13-35 30-35s30 13 30 35%27 fill=%27%2394a3b8%27/%3E%3C/svg%3E' }}" alt="Foto Profil" />
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
        <h2>Ringkasan Poin</h2>
      </div>

      <!-- Ringkasan: total poin Keaktifan & total poin Pelanggaran -->
      <div class="poin-total-grid">
        <div class="poin-total-card keaktifan">
          <span class="poin-total-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M5 12l7-7 7 7" /></svg>
          </span>
          <div>
            <div class="poin-total-val" id="totalKeaktifanVal">+0</div>
            <div class="poin-total-lbl">Poin Keaktifan</div>
            <div class="poin-total-count" id="countKeaktifan">0 catatan</div>
          </div>
        </div>
        <div class="poin-total-card pelanggaran">
          <span class="poin-total-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7" /></svg>
          </span>
          <div>
            <div class="poin-total-val" id="totalPelanggaranVal">-0</div>
            <div class="poin-total-lbl">Poin Pelanggaran</div>
            <div class="poin-total-count" id="countPelanggaran">0 catatan</div>
          </div>
        </div>
      </div>

      <!-- Riwayat poin (bisa difilter Semua / Keaktifan / Pelanggaran) -->
      <div class="card">
        <div class="card-head">
          <h3>
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--teal-500)">
              <path d="M9 11l3 3L22 4" />
              <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
            </svg>
            <span>Riwayat Poin</span>
          </h3>
        </div>
        <div class="poin-filter-chips">
          <button type="button" class="poin-chip active" data-filter="semua">Semua</button>
          <button type="button" class="poin-chip" data-filter="keaktifan">Keaktifan</button>
          <button type="button" class="poin-chip" data-filter="pelanggaran">Pelanggaran</button>
        </div>
        <div class="poin-list" id="poinList"></div>
      </div>

      <div class="help-box">
        <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10" />
          <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
          <path d="M12 17h.01" />
        </svg>
        <p>
          <strong>Halaman ini hanya menampilkan poin milik akun Anda sendiri.</strong>
          Anda tidak dapat melihat poin mahasiswa lain maupun kelompok lain.
          Jika menemukan ketidaksesuaian data, harap konfirmasi langsung kepada
          mentor pendamping kelompok Anda.
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
        <span>Leaderboard</span>
      </a>
      <a href="{{ route('dashboard') }}" class="home" aria-label="Beranda">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 11.5 12 4l8 7.5" />
          <path d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10" />
        </svg>
        <span>Beranda</span>
      </a>
      <a href="{{ route('role.student.info') }}">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 17H4l1.4-1.4A2 2 0 0 0 6 14.2V11a6 6 0 1 1 12 0v3.2c0 .5.2 1 .6 1.4L20 17h-5" />
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
      //    yang diambil dari sesi login, supaya tidak mungkin ada mahasiswa
      //    lain yang bisa melihat data orang lain.
      // ======================================================================
      const CURRENT_STUDENT = {
        nama: "Alexander Arul Husein",
        npm: "525241019",
        kelompok: "Kelompok 01",
      };
      document.getElementById("identityName").textContent = CURRENT_STUDENT.nama;
      document.getElementById("identityNPM").textContent = CURRENT_STUDENT.npm;
      document.getElementById("identityKelompok").textContent = CURRENT_STUDENT.kelompok;

      // ======================================================================
      // ►► POIN KEAKTIFAN & PELANGGARAN — ISI / EDIT CATATAN DI SINI
      //    - "tipe": "keaktifan" (menambah poin) atau "pelanggaran" (mengurangi poin)
      //    - "poin": nilai positif (angka besarnya saja, tanda +/- otomatis)
      // ======================================================================
      const riwayatPoin = [
        {
          tipe: "keaktifan",
          judul: "Aktif bertanya saat sesi materi akademik",
          poin: 5,
          tanggal: "07 Sep 2026",
        },
        {
          tipe: "keaktifan",
          judul: "Menjadi perwakilan kelompok saat diskusi kelas",
          poin: 10,
          tanggal: "08 Sep 2026",
        },
        {
          tipe: "keaktifan",
          judul: "Membantu mentor mengondisikan barisan kelompok",
          poin: 5,
          tanggal: "09 Sep 2026",
        },
        {
          tipe: "pelanggaran",
          judul: "Terlambat mengikuti sesi pagi",
          poin: 5,
          tanggal: "08 Sep 2026",
        },
        {
          tipe: "pelanggaran",
          judul: "Tidak memakai atribut lengkap sesuai ketentuan",
          poin: 10,
          tanggal: "09 Sep 2026",
        },
      ];

      const iconKeaktifan = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M5 12l7-7 7 7" /></svg>`;
      const iconPelanggaran = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7" /></svg>`;

      let filterPoinAktif = "semua";

      function renderRingkasanPoin() {
        const catatanKeaktifan = riwayatPoin.filter((r) => r.tipe === "keaktifan");
        const catatanPelanggaran = riwayatPoin.filter((r) => r.tipe === "pelanggaran");
        const totalKeaktifan = catatanKeaktifan.reduce((a, r) => a + r.poin, 0);
        const totalPelanggaran = catatanPelanggaran.reduce((a, r) => a + r.poin, 0);

        document.getElementById("totalKeaktifanVal").innerText = `+${totalKeaktifan}`;
        document.getElementById("totalPelanggaranVal").innerText = `-${totalPelanggaran}`;
        document.getElementById("countKeaktifan").innerText = `${catatanKeaktifan.length} catatan`;
        document.getElementById("countPelanggaran").innerText = `${catatanPelanggaran.length} catatan`;

        document.getElementById("heroTotalKeaktifan").innerText = `+${totalKeaktifan}`;
        document.getElementById("heroTotalPelanggaran").innerText = `-${totalPelanggaran}`;
      }

      function renderRiwayatPoin() {
        const listEl = document.getElementById("poinList");
        const data =
          filterPoinAktif === "semua"
            ? riwayatPoin
            : riwayatPoin.filter((r) => r.tipe === filterPoinAktif);

        if (data.length === 0) {
          listEl.innerHTML = `<div class="poin-empty">Belum ada catatan untuk filter ini.</div>`;
          return;
        }

        listEl.innerHTML = data
          .map((r) => {
            const isPlus = r.tipe === "keaktifan";
            return `
              <div class="poin-row">
                <div class="poin-row-info">
                  <span class="poin-row-icon ${isPlus ? "plus" : "minus"}">
                    ${isPlus ? iconKeaktifan : iconPelanggaran}
                  </span>
                  <div>
                    <p class="poin-row-title">${r.judul}</p>
                    <p class="poin-row-date">${r.tanggal}</p>
                  </div>
                </div>
                <span class="poin-badge ${isPlus ? "plus" : "minus"}">${isPlus ? "+" : "-"}${r.poin}</span>
              </div>
            `;
          })
          .join("");
      }

      document.querySelectorAll(".poin-chip").forEach((chip) => {
        chip.addEventListener("click", () => {
          document.querySelectorAll(".poin-chip").forEach((c) => c.classList.remove("active"));
          chip.classList.add("active");
          filterPoinAktif = chip.dataset.filter;
          renderRiwayatPoin();
        });
      });

      renderRingkasanPoin();
      renderRiwayatPoin();

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO — sama seperti halaman lain. Ganti / tambah
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