<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Dashboard PKKMB-KT UNILAM 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <style>
      /* ============ TOKENS ============ */
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
        --surface-muted: #e8ebf6;
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

        --sidebar-w-tablet: 84px;
        --sidebar-w-desktop: 248px;
        --bottomnav-h: 74px;
      }

      * {
        box-sizing: border-box;
      }
      html,
      body {
        margin: 0;
        padding: 0;
        max-width: 100%;
        overflow-x: hidden;
      }
      body {
        background: var(--bg);
        font-family: var(--font-sans);
        color: var(--ink-900);
        -webkit-font-smoothing: antialiased;
        min-height: 100vh;
        width: 100%;
      }
      a {
        color: inherit;
        text-decoration: none;
      }
      ul {
        margin: 0;
        padding: 0;
        list-style: none;
      }
      button {
        font-family: inherit;
      }
      img {
        display: block;
        max-width: 100%;
      }
      svg {
        display: block;
      }
      :focus-visible {
        outline: 2.5px solid var(--teal-600);
        outline-offset: 2px;
        border-radius: 6px;
      }

      /* ============ APP SHELL ============ */
      .app {
        display: flex;
        min-height: 100vh;
      }

      /* ---------- Sidebar (tablet & desktop) ---------- */
      /* ---------- Sidebar (tablet & desktop) ---------- */
      /* ►► TIDAK STICKY — ikut scroll ke bawah bersama halaman, sama
         persis seperti di dashboard_mahasiswa.html. */
      .sidebar {
        display: none;
        flex-direction: column;
        width: var(--sidebar-w-tablet);
        flex-shrink: 0;
        background: linear-gradient(180deg, var(--navy-900) 0%, #101a45 100%);
        color: #fff;
        padding: 22px 0 18px;
        z-index: 20;
      }
      .sidebar-brand {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 0 14px 22px;
        margin-bottom: 8px;
      }
      .sidebar-brand img {
        width: 300px;
        height: auto;
      }
      .sidebar-brand .brand-text {
        display: none;
        line-height: 1.15;
      }
      .sidebar-brand .brand-text strong {
        font-family: var(--font-display);
        font-size: 14.5px;
        display: block;
      }
      .sidebar-brand .brand-text span {
        font-size: 10.5px;
        color: #aeb6e0;
        letter-spacing: 0.04em;
      }

      .sidebar-nav {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding: 6px 12px;
      }
      .sidebar-nav a {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 12px 11px;
        border-radius: var(--radius-sm);
        color: #c7cce8;
        font-weight: 600;
        font-size: 13.5px;
        transition:
          background 0.15s ease,
          color 0.15s ease;
        justify-content: center;
      }
      .sidebar-nav a .ic {
        width: 21px;
        height: 21px;
        flex-shrink: 0;
      }
      .sidebar-nav a .label {
        display: none;
        white-space: nowrap;
      }
      .sidebar-nav a:hover {
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
      }
      .sidebar-nav a.active {
        background: var(--teal-500);
        color: #fff;
        box-shadow: var(--shadow-pop);
      }

      .sidebar-login {
        margin: 10px 12px 0;
        padding: 13px 10px;
        border-radius: var(--radius-sm);
        background: var(--lime-500);
        color: var(--navy-900);
        font-weight: 800;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: filter 0.15s ease;
      }
      .sidebar-login:hover {
        filter: brightness(1.06);
      }
      .sidebar-login .label {
        display: none;
      }
      .sidebar-login .ic {
        width: 18px;
        height: 18px;
      }

      /* ---------- Main column ---------- */
      .main {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
      }

      /* Topbar */
      /* Topbar — ►► TIDAK STICKY, ikut scroll turun bersama halaman,
         sama persis seperti di dashboard_mahasiswa.html. */
      .topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: clamp(14px, 3vw, 18px) clamp(16px, 4vw, 28px);
        background: var(--surface);
        border-bottom: 1px solid var(--border);
        z-index: 15;
      }
      .topbar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .topbar-brand img {
        height: 50px;
        width: auto;
      }
      .topbar-title {
        display: none;
        font-family: var(--font-display);
        font-weight: 600;
        font-size: 19px;
        color: var(--navy-900);
      }
      .topbar-actions {
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .avatar-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--navy-tint);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--navy-700);
        position: relative;
        transition: background 0.15s ease;
      }
      .avatar-btn:hover {
        background: var(--teal-tint);
        color: var(--teal-600);
      }
      .avatar-btn .ic {
        width: 20px;
        height: 20px;
      }
      .avatar-dot {
        position: absolute;
        top: -2px;
        right: -2px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--lime-500);
        border: 2px solid var(--surface);
      }

      /* ►► TOMBOL LOGOUT DI TOPBAR — cuma buat mode HP (sidebar dengan
         tombol Logout-nya baru muncul mulai layar tablet ke atas, jadi
         di HP sebelumnya tidak ada cara logout sama sekali). Otomatis
         hilang begitu sidebar muncul supaya tidak dobel. */
      .topbar-logout {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #fef2f2;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s ease, color 0.15s ease;
      }
      .topbar-logout:hover {
        background: #dc2626;
        color: #fff;
      }
      .topbar-logout .ic {
        width: 19px;
        height: 19px;
      }

      /* ============ MODAL KONFIRMASI LOGOUT ============ */
      .logout-modal-backdrop {
        position: fixed;
        inset: 0;
        z-index: 100;
        background: rgba(21, 33, 89, 0.55);
        backdrop-filter: blur(6px);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 16px;
      }
      .logout-modal-backdrop.open {
        display: flex;
      }
      .logout-modal-box {
        background: var(--surface);
        border-radius: var(--radius-lg);
        max-width: 340px;
        width: 100%;
        padding: 28px 24px 24px;
        text-align: center;
        box-shadow: var(--shadow-pop);
        animation: logoutModalIn 0.2s ease;
      }
      @keyframes logoutModalIn {
        from {
          opacity: 0;
          transform: scale(0.95) translateY(10px);
        }
        to {
          opacity: 1;
          transform: scale(1) translateY(0);
        }
      }
      .logout-modal-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #fef2f2;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
      }
      .logout-modal-icon .ic {
        width: 26px;
        height: 26px;
      }
      .logout-modal-box h3 {
        font-family: var(--font-display);
        font-size: 18px;
        font-weight: 700;
        color: var(--ink-900);
        margin: 0 0 8px;
      }
      .logout-modal-box p {
        font-size: 13px;
        color: var(--ink-600);
        line-height: 1.6;
        margin: 0 0 22px;
      }
      .logout-modal-actions {
        display: flex;
        gap: 10px;
      }
      .btn-logout-cancel {
        flex: 1;
        padding: 12px 0;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border);
        background: var(--bg);
        color: var(--ink-900);
        font-weight: 700;
        font-size: 13.5px;
        cursor: pointer;
        transition: background 0.15s;
      }
      .btn-logout-cancel:hover {
        background: var(--surface-muted);
      }
      .btn-logout-confirm {
        flex: 1;
        padding: 12px 0;
        border-radius: var(--radius-sm);
        border: none;
        background: #dc2626;
        color: #fff;
        font-weight: 800;
        font-size: 13.5px;
        cursor: pointer;
        transition: filter 0.15s;
      }
      .btn-logout-confirm:hover {
        filter: brightness(1.1);
      }

      /* Content */
      .content {
        flex: 1;
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
        padding: clamp(16px, 4vw, 40px) clamp(16px, 4vw, 40px)
          calc(var(--bottomnav-h) + 28px);
      }

      /* ============ HERO ============ */
      /* ►► LATAR HERO — ilustrasi masjid digambar langsung pakai SVG
         (elemen <svg class="hero-mosque"> di HTML di bawah), sama persis
         seperti di dashboard_mahasiswa.html, jadi tidak butuh file foto. */
      .hero {
        position: relative;
        overflow: hidden;
        background: var(--surface-muted);
        border-radius: var(--radius-lg);
        padding: clamp(20px, 5vw, 38px) clamp(18px, 5vw, 38px)
          clamp(20px, 4vw, 32px);
      }
      .hero-mosque {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: auto;
        max-height: 78%;
        opacity: 0.16;
        pointer-events: none;
      }
      .hero-eyebrow {
        font-size: 13px;
        font-weight: 600;
        color: var(--ink-600);
        margin: 0 0 4px;
        position: relative;
        z-index: 1;
      }
      .hero-sub {
        font-size: 14.5px;
        color: var(--ink-600);
        margin: 0 0 6px;
        position: relative;
        z-index: 1;
      }
      .hero-title {
        font-family: var(--font-display);
        font-weight: 700;
        color: var(--navy-900);
        font-size: clamp(22px, 3.6vw + 14px, 32px);
        line-height: 1.18;
        margin: 0;
        max-width: min(420px, 80%);
        position: relative;
        z-index: 1;
      }

      .progress-block {
        margin-top: 22px;
        position: relative;
        z-index: 1;
      }
      .progress-row {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 9px;
      }
      .progress-label {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--navy-900);
      }
      .progress-pct {
        font-size: 13.5px;
        font-weight: 800;
        color: var(--teal-600);
      }
      .progress-track {
        height: 13px;
        border-radius: 99px;
        background: rgba(255, 255, 255, 0.75);
        border: 1px solid rgba(21, 33, 89, 0.08);
        overflow: hidden;
      }
      .progress-fill {
        height: 100%;
        border-radius: 99px;
        width: 42%;
        background: linear-gradient(90deg, var(--navy-700), var(--teal-500));
      }

      /* ============ SECTION HEADERS ============ */
      .section {
        margin-top: 30px;
      }
      .section-head {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 14px;
      }
      .section-title {
        font-family: var(--font-display);
        font-size: 17px;
        font-weight: 700;
        color: var(--navy-900);
        margin: 0;
      }
      .section-link {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 12.5px;
        font-weight: 700;
        color: var(--teal-600);
      }
      .section-link .ic {
        width: 14px;
        height: 14px;
      }

      /* ============ MENU GRID ============ */
      .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(96px, 1fr));
        gap: clamp(8px, 2.4vw, 14px);
      }
      .menu-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: clamp(13px, 2.4vw, 18px) 8px clamp(12px, 2vw, 15px);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 9px;
        min-width: 0;
        transition:
          transform 0.15s ease,
          box-shadow 0.15s ease,
          border-color 0.15s ease;
      }
      .menu-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-card);
        border-color: transparent;
      }
      .menu-chip {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .menu-chip .ic {
        width: 23px;
        height: 23px;
      }
      .chip-navy {
        background: var(--navy-tint);
        color: var(--navy-700);
      }
      .chip-teal {
        background: var(--teal-tint);
        color: var(--teal-600);
      }
      .chip-lime {
        background: var(--lime-tint);
        color: #7c9426;
      }

      .menu-label {
        font-size: 12.5px;
        font-weight: 700;
        color: var(--ink-900);
        line-height: 1.25;
      }
      .menu-desc {
        display: none;
        font-size: 11.5px;
        color: var(--ink-400);
        line-height: 1.3;
      }

      /* ============ SCHEDULE ============ */
      .schedule-card {
        display: flex;
        align-items: center;
        gap: 14px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 15px;
        transition:
          box-shadow 0.15s ease,
          border-color 0.15s ease;
      }
      .schedule-card:hover {
        box-shadow: var(--shadow-card);
        border-color: transparent;
      }
      .schedule-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        flex-shrink: 0;
        background: var(--navy-900);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
      }
      .schedule-icon .ic {
        width: 24px;
        height: 24px;
      }
      .schedule-info {
        flex: 1;
        min-width: 0;
      }
      .schedule-title {
        font-size: 14.5px;
        font-weight: 700;
        color: var(--ink-900);
        margin: 0 0 3px;
      }
      .schedule-meta {
        font-size: 12.5px;
        color: var(--ink-600);
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 4px 10px;
      }
      .schedule-go {
        color: var(--ink-400);
        flex-shrink: 0;
      }
      .schedule-go .ic {
        width: 18px;
        height: 18px;
      }

      /* ============ ASIDE (desktop only) ============ */
      .aside-col {
        display: none;
      }
      .login-card {
        background: linear-gradient(160deg, var(--navy-900), #1b2b72);
        color: #fff;
        border-radius: var(--radius-lg);
        padding: 22px 20px;
        position: relative;
        overflow: hidden;
      }
      .login-card h3 {
        font-family: var(--font-display);
        font-size: 17px;
        margin: 0 0 6px;
      }
      .login-card p {
        font-size: 13px;
        color: #bfc6ea;
        margin: 0 0 16px;
        line-height: 1.5;
      }
      .login-card a {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--lime-500);
        color: var(--navy-900);
        font-weight: 800;
        font-size: 13.5px;
        padding: 11px 18px;
        border-radius: 999px;
      }
      .login-card a:hover {
        filter: brightness(1.05);
      }
      .login-card .ic {
        width: 16px;
        height: 16px;
      }

      .info-card {
        margin-top: 16px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 18px;
      }
      .info-card h4 {
        font-family: var(--font-display);
        font-size: 14.5px;
        margin: 0 0 8px;
        color: var(--navy-900);
      }
      .info-card p {
        font-size: 12.5px;
        color: var(--ink-600);
        line-height: 1.55;
        margin: 0;
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

      /* ============ RESPONSIVE: SHORT / LANDSCAPE PHONES ============ */
      @media (max-width: 767px) and (max-height: 480px) {
        .bottom-nav {
          height: 58px;
        }
        .bottom-nav a.home {
          width: 44px;
          height: 44px;
          margin-top: -20px;
        }
        .bottom-nav a span {
          font-size: 9px;
        }
        .content {
          padding-top: 12px;
          padding-bottom: 74px;
        }
        .hero {
          padding-top: 16px;
          padding-bottom: 14px;
        }
        .section {
          margin-top: 18px;
        }
      }

      /* ============ RESPONSIVE: TABLET ============ */
      @media (min-width: 768px) {
        .sidebar {
          display: flex;
        }
        .bottom-nav {
          display: none;
        }
        .content {
          padding-bottom: clamp(28px, 4vw, 48px);
        }
        .topbar-title {
          display: block;
        }
        /* Sidebar sudah punya tombol Logout sendiri mulai ukuran ini,
           jadi tombol logout di topbar (khusus HP) disembunyikan. */
        .topbar-logout {
          display: none;
        }
      }

      /* ============ RESPONSIVE: DESKTOP / LAPTOP ============ */
      @media (min-width: 1100px) {
        .sidebar {
          width: var(--sidebar-w-desktop);
          padding: 26px 0 22px;
        }
        .sidebar-brand {
          justify-content: flex-start;
          padding: 0 22px 26px;
        }
        .sidebar-brand .brand-text {
          display: block;
        }
        .sidebar-nav {
          padding: 6px 16px;
        }
        .sidebar-nav a {
          justify-content: flex-start;
          padding: 12px 14px;
        }
        .sidebar-nav a .label {
          display: block;
        }
        .sidebar-login {
          margin: 14px 16px 0;
          justify-content: flex-start;
          padding: 13px 14px;
        }
        .sidebar-login .label {
          display: block;
        }

        .topbar-brand {
          display: none;
        }
        .content {
          display: grid;
          grid-template-columns: 1fr 320px;
          gap: 28px;
          align-items: start;
        }
        .content > .main-col {
          grid-column: 1;
        }
        .aside-col {
          display: block;
          grid-column: 2;
          position: sticky;
          top: 96px;
        }

        .hero-title {
          max-width: min(320px, 75%);
        }

        .menu-grid {
          grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
          gap: 16px;
        }
        .menu-card {
          align-items: flex-start;
          text-align: left;
          padding: 22px 20px;
        }
        .menu-desc {
          display: block;
        }
        .menu-chip {
          width: 50px;
          height: 50px;
        }
      }
    </style>
  </head>
  <body>
    <div class="app">
      <!-- ======= SIDEBAR (tablet & desktop) ======= -->
      <aside class="sidebar">
        <span class="sidebar-brand">
          <img
            src="{{ asset('gambar/unilam-logo-full.png') }}"
            alt="Logo UNILAM"
          />
        </span>

        <nav class="sidebar-nav" aria-label="Navigasi utama">
          <a href="#">
            <svg
                class="ic"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z"/>
                <path d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z"/>
            </svg>
            <span class="label">Modul PKKMB</span>
            </a>
          <a href="#">
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
                d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z"
              />
              <path d="M5 21v-5M12 21v-7M19 21v-4" />
            </svg>
            <span class="label">Leaderboard</span>
          </a>
          <a href="{{ route('dashboard') }}" class="active">
            <svg
              class="ic"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="1.7"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M4 11.5 12 4l8 7.5" />
              <path
                d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10"
              />
            </svg>
            <span class="label">Beranda</span>
          </a>
          
          <a href="#">
            <svg
              class="ic"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="1.7"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M9 18h6" />
              <path d="M10 21h4" />
              <path
                d="M12 3a6 6 0 0 0-3.6 10.8c.4.3.6.8.6 1.3V16h6v-.9c0-.5.2-1 .6-1.3A6 6 0 0 0 12 3Z"
              />
            </svg>
            <span class="label">Info</span>
          </a>
          <a href="#">
            <svg
              class="ic"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="1.7"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <circle cx="12" cy="8" r="3.4" />
              <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
            </svg>
            <span class="label">Profil</span>
          </a>
        </nav>

        <a href="#" class="sidebar-login" id="btnLogoutSidebar">
          <svg
            class="ic"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path d="M14 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4" />
            <path d="M10 17l5-5-5-5" />
            <path d="M15 12H3" />
          </svg>
          <span class="label">Logout</span>
        </a>
      </aside>

      <!-- ======= MAIN ======= -->
      <div class="main">
        <header class="topbar" style="position: static !important;">
          <a href="{{ route('dashboard') }}" class="topbar-brand">
            <img
              src="{{ asset('gambar/unilam.png') }}"
              alt="Universitas La Tansa Mashiro"
            />
          </a>
          <h1 class="topbar-title">Dashboard Mentor</h1>
          <div class="topbar-actions">
            <a href="#" class="avatar-btn" aria-label="Masuk ke akun">
              @if (auth()->user()->profile_picture)
                <img
                  src="{{ asset('storage/'.auth()->user()->profile_picture) }}"
                  alt="Foto profil"
                  style="width:100%; height:100%; border-radius:50%; object-fit:cover;"
                />
              @else
                <svg
                  class="ic"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.7"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <circle cx="12" cy="8" r="3.4" />
                  <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
                </svg>
              @endif
              <span class="avatar-dot"></span>
            </a>
            <!-- ►► LOGOUT KHUSUS MODE HP — otomatis hilang begitu sidebar
                 (dengan tombol Logout sendiri) muncul di layar tablet ke atas. -->
            <a href="#" class="topbar-logout" id="btnLogoutTopbar" aria-label="Logout">
              <svg
                class="ic"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path d="M14 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4" />
                <path d="M10 17l5-5-5-5" />
                <path d="M15 12H3" />
              </svg>
            </a>
          </div>
        </header>

        <div class="content">
          <div class="main-col">
            <!-- ===== HERO ===== -->
            <section class="hero">
              <!-- ►► ILUSTRASI MASJID — digambar langsung pakai SVG, tidak
                   perlu file foto. Warnanya ikut palet situs (navy/teal/lime),
                   sama persis seperti di dashboard_mahasiswa.html. -->
              <svg
                class="hero-mosque"
                viewBox="0 0 400 160"
                preserveAspectRatio="xMidYMax slice"
                xmlns="http://www.w3.org/2000/svg"
              >
                <!-- badan bangunan -->
                <rect x="0" y="110" width="400" height="50" fill="#152159" />
                <!-- menara kiri -->
                <rect x="44" y="58" width="10" height="56" fill="#152159" />
                <path d="M41 58 Q49 42 57 58 Z" fill="#152159" />
                <circle cx="49" cy="38" r="2.6" fill="#a9c73b" />
                <!-- menara kanan -->
                <rect x="346" y="58" width="10" height="56" fill="#152159" />
                <path d="M343 58 Q351 42 359 58 Z" fill="#152159" />
                <circle cx="351" cy="38" r="2.6" fill="#a9c73b" />
                <!-- kubah utama -->
                <path
                  d="M150 114 Q150 60 200 42 Q250 60 250 114 Z"
                  fill="#16a0a1"
                />
                <rect x="196" y="20" width="8" height="22" fill="#16a0a1" />
                <path
                  d="M204 18 A6 6 0 1 1 200 8 A4.6 4.6 0 0 0 204 18 Z"
                  fill="#a9c73b"
                />
                <!-- kubah kecil kiri & kanan -->
                <path
                  d="M96 114 Q96 86 116 76 Q136 86 136 114 Z"
                  fill="#152159"
                />
                <path
                  d="M264 114 Q264 86 284 76 Q304 86 304 114 Z"
                  fill="#152159"
                />
                <!-- lengkung pintu -->
                <path
                  d="M182 160 L182 128 Q200 112 218 128 L218 160 Z"
                  fill="#f2f4fa"
                />
                <path
                  d="M120 160 L120 138 Q128 128 136 138 L136 160 Z"
                  fill="#f2f4fa"
                  opacity="0.85"
                />
                <path
                  d="M264 160 L264 138 Q272 128 280 138 L280 160 Z"
                  fill="#f2f4fa"
                  opacity="0.85"
                />
              </svg>
              <p class="hero-eyebrow">Hai, {{ auth()->user()->name }}</p>
              <p class="hero-sub">Selamat datang di</p>
              <h2 class="hero-title">PKKMB-KT UNILAM 2026</h2>

              <div class="progress-block">
                <div class="progress-row">
                  <span class="progress-label">Progres PKKMB-KT</span>
                  <span class="progress-pct">42%</span>
                </div>
                <div class="progress-track">
                  <div class="progress-fill"></div>
                </div>
              </div>
            </section>

            <!-- ===== MENU UTAMA ===== -->
            <section class="section">
              <div class="section-head">
                <h3 class="section-title">Menu Utama</h3>
              </div>
              <div class="menu-grid">
                <a class="menu-card" href="#">
                  <span class="menu-chip chip-navy">
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
                        d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z"
                      />
                      <path
                        d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z"
                      />
                    </svg>
                  </span>
                  <span class="menu-label">Modul Pembekalan</span>
                  <span class="menu-desc"
                    >Materi &amp; e-modul orientasi mahasiswa baru</span
                  >
                </a>

                <a class="menu-card" href="#">
                  <span class="menu-chip chip-teal">
                    <svg
                      class="ic"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.7"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <rect x="5" y="4" width="14" height="17" rx="2" />
                      <path d="M9 3.5h6" />
                      <path d="M8.2 10l1.4 1.4 2.2-2.4" />
                      <path d="M14 10.2h2.2" />
                      <path d="M8 15.3h8.2" />
                    </svg>
                  </span>
                  <span class="menu-label">Kelola Presensi</span>
                  <span class="menu-desc"
                    >Cek absensi dan status kehadiran anggota kelompok</span
                  >
                </a>

                <a class="menu-card" href="#">
                  <span class="menu-chip chip-lime">
                    <svg
                      class="ic"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.7"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <rect x="4" y="5" width="16" height="16" rx="2" />
                      <path d="M8 3v4M16 3v4M4 9.5h16" />
                      <circle cx="8.3" cy="13.2" r=".9" fill="currentColor" stroke="none" />
                      <circle cx="12" cy="13.2" r=".9" fill="currentColor" stroke="none" />
                      <circle cx="15.7" cy="13.2" r=".9" fill="currentColor" stroke="none" />
                      <circle cx="8.3" cy="16.6" r=".9" fill="currentColor" stroke="none" />
                      <circle cx="12" cy="16.6" r=".9" fill="currentColor" stroke="none" />
                    </svg>
                  </span>
                  <span class="menu-label">Jadwal</span>
                  <span class="menu-desc"
                    >Rangkaian kegiatan &amp; jadwal resmi PKKMB</span
                  >
                </a>

                <a class="menu-card" href="#">
                  <span class="menu-chip chip-teal">
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
                  </span>
                  <span class="menu-label">Info</span>
                  <span class="menu-desc"
                    >Pengumuman &amp; informasi terbaru PKKMB</span
                  >
                </a>

                <a class="menu-card" href="#">
                  <span class="menu-chip chip-lime">
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
                        d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z"
                      />
                      <path d="M5 21v-5M12 21v-7M19 21v-4" />
                    </svg>
                  </span>
                  <span class="menu-label">Leaderboard</span>
                  <span class="menu-desc"
                    >Pantau peringkat poin keaktifan mahasiswa</span
                  >
                </a>

               <a class="menu-card" href="#">
                <span class="menu-chip chip-teal">
                    <svg
                    class="ic"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    >
                    <rect x="6" y="4" width="12" height="16" rx="2"></rect>
                    <path d="M9 4.5h6"></path>
                    <path d="M9 10l1.5 1.5L14 8"></path>
                    <path d="M9 15l1.5 1.5L14 13"></path>
                    </svg>
                </span>
                <span class="menu-label">Input Keaktifan &amp; Pelanggaran</span>
                <span class="menu-desc">
                    Catat keaktifan dan pelanggaran mahasiswa
                </span>
                </a>

                <a class="menu-card" href="#">
                  <span class="menu-chip chip-navy">
                    <svg
                      class="ic"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.7"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <rect x="5" y="4" width="14" height="17" rx="2" />
                      <path d="M9 3.5h6" />
                      <path d="M8.3 11.2l1.4 1.4 2.3-2.5" />
                      <path d="M14.4 11.4h2" />
                      <path d="M8 16h8.2" />
                    </svg>
                  </span>
                  <span class="menu-label">Monitoring Evaluasi</span>
                  <span class="menu-desc"
                    >Memantau Hasil Evaluasi dan Progres Mahasiswa Baru</span>
                </a>

                 <a class="menu-card" href="#">
                  <span class="menu-chip chip-navy">
                    <svg
                      class="ic"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.7"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <rect x="5" y="4" width="14" height="17" rx="2" />
                      <path d="M9 3.5h6" />
                      <path d="M8.3 11.2l1.4 1.4 2.3-2.5" />
                      <path d="M14.4 11.4h2" />
                      <path d="M8 16h8.2" />
                    </svg>
                  </span>
                  <span class="menu-label">Monitoring Pengumpulan Tugas</span>
                  <span class="menu-desc"
                    >Memantau Pengumpulam Tugas Individu &amp; Kelompok</span>
                </a>
              </div>
            </section>

            <!-- ===== JADWAL ===== -->
            <section class="section">
              <div class="section-head">
                <h3 class="section-title">Jadwal Hari Ini</h3>
                <a href="#" class="section-link">
                  Lihat Semua
                  <svg
                    class="ic"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M9 6l6 6-6 6" />
                  </svg>
                </a>
              </div>

              <a class="schedule-card" href="#">
                <span class="schedule-icon">
                  <svg
                    class="ic"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <rect x="4" y="5" width="16" height="16" rx="2" />
                    <path d="M8 3v4M16 3v4M4 9.5h16" />
                    <circle
                      cx="8.3"
                      cy="13.2"
                      r=".9"
                      fill="currentColor"
                      stroke="none"
                    />
                    <circle
                      cx="12"
                      cy="13.2"
                      r=".9"
                      fill="currentColor"
                      stroke="none"
                    />
                    <circle
                      cx="15.7"
                      cy="13.2"
                      r=".9"
                      fill="currentColor"
                      stroke="none"
                    />
                    <circle
                      cx="8.3"
                      cy="16.6"
                      r=".9"
                      fill="currentColor"
                      stroke="none"
                    />
                    <circle
                      cx="12"
                      cy="16.6"
                      r=".9"
                      fill="currentColor"
                      stroke="none"
                    />
                  </svg>
                </span>
                <span class="schedule-info">
                  <p class="schedule-title">Pembekalan PKKMB</p>
                  <p class="schedule-meta">
                    <span>08.00&ndash;09.00</span><span>&middot;</span
                    ><span>Hall Unilam</span>
                  </p>
                </span>
                <span class="schedule-go">
                  <svg
                    class="ic"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M9 6l6 6-6 6" />
                  </svg>
                </span>
              </a>
            </section>
          </div>

          <!-- ===== ASIDE (desktop only) ===== -->
          <div class="aside-col">
            <div class="info-card">
              <h4>Pengumuman</h4>
              <p>
                Pastikan kamu hadir 15 menit lebih awal pada setiap sesi
                pembekalan dan membawa kartu peserta PKKMB-KT.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ======= BOTTOM NAV (mobile only) ======= -->
    <nav class="bottom-nav" aria-label="Navigasi bawah">
      <a href="#">
        <svg
          class="ic"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="1.7"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
          <path
            d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z"
          />
        </svg>
        <span>Modul</span>
      </a>
      <a href="#">
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
            d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z"
          />
          <path d="M5 21v-5M12 21v-7M19 21v-4" />
        </svg>
        <span>Leaderboard</span>
      </a>
      <a href="{{ route('dashboard') }}" class="home" aria-label="Beranda">
        <svg
          class="ic"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="1.8"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path d="M4 11.5 12 4l8 7.5" />
          <path
            d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10"
          />
        </svg>
        <span>Beranda</span>
      </a>
      <a href="#">
        <svg
          class="ic"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="1.7"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path d="M9 18h6" />
          <path d="M10 21h4" />
          <path
            d="M12 3a6 6 0 0 0-3.6 10.8c.4.3.6.8.6 1.3V16h6v-.9c0-.5.2-1 .6-1.3A6 6 0 0 0 12 3Z"
          />
        </svg>
        <span>Info</span>
      </a>
      <a href="#">
        <svg
          class="ic"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="1.7"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <circle cx="12" cy="8" r="3.4" />
          <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
        </svg>
        <span>Profil</span>
      </a>
    </nav>

    <!-- ======= MODAL KONFIRMASI LOGOUT ======= -->
    <div class="logout-modal-backdrop" id="logoutModal">
      <div class="logout-modal-box">
        <div class="logout-modal-icon">
          <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4" />
            <path d="M10 17l5-5-5-5" />
            <path d="M15 12H3" />
          </svg>
        </div>
        <h3>Yakin ingin keluar?</h3>
        <p>Kamu akan keluar dari akun ini dan harus masuk kembali untuk mengakses dashboard.</p>
        <div class="logout-modal-actions">
          <button type="button" class="btn-logout-cancel" id="btnLogoutCancel">Tidak</button>
          <button type="button" class="btn-logout-confirm" id="btnLogoutConfirm">Ya, Keluar</button>
        </div>
      </div>
    </div>

    <form method="POST" action="{{ route('logout') }}" id="logoutForm" style="display:none">
      @csrf
    </form>

    <script>
      // ======================================================================
      // ►► KONFIRMASI LOGOUT — tombol Logout (sidebar & topbar HP) tidak
      //    langsung pindah halaman, tapi buka modal "Yakin ingin keluar?"
      //    dulu. Konfirmasi akan submit form logout Laravel yang sebenarnya.
      // ======================================================================
      const logoutModal = document.getElementById("logoutModal");
      const btnLogoutConfirm = document.getElementById("btnLogoutConfirm");
      const btnLogoutCancel = document.getElementById("btnLogoutCancel");

      function bukaModalLogout(e) {
        e.preventDefault();
        logoutModal.classList.add("open");
      }

      document.getElementById("btnLogoutSidebar")?.addEventListener("click", bukaModalLogout);
      document.getElementById("btnLogoutTopbar")?.addEventListener("click", bukaModalLogout);

      btnLogoutCancel.addEventListener("click", () => {
        logoutModal.classList.remove("open");
      });
      btnLogoutConfirm.addEventListener("click", () => {
        document.getElementById("logoutForm").submit();
      });
      logoutModal.addEventListener("click", (e) => {
        if (e.target === logoutModal) logoutModal.classList.remove("open");
      });
    </script>
  </body>
</html>