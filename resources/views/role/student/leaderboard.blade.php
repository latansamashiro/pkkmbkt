<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Papan Peringkat | PKKMB-KT UNILAM 2026</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
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
        --gold-500: #d4a017;
        --gold-tint: #fdf6e3;
        --bronze-500: #a9743a;
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
      }
      .font-display {
        font-family: var(--font-display);
      }

      /* ============ NAVBAR — COPY EXACT DARI HOMEPAGE/MATERI/EVALUASI ============ */
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
        transition:
          transform 0.3s ease,
          opacity 0.3s ease;
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
        overflow: hidden;
        padding: clamp(40px, 7vw, 64px) clamp(16px, 5vw, 48px);
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
          rgba(21, 33, 89, 0.9) 0%,
          rgba(15, 138, 140, 0.78) 100%
        );
      }
      .hero-info-inner {
        position: relative;
        z-index: 1;
        max-width: 900px;
        margin: 0 auto;
        text-align: center;
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
        0%,
        100% {
          opacity: 1;
          transform: scale(1);
        }
        50% {
          opacity: 0.5;
          transform: scale(0.8);
        }
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
        max-width: 520px;
        margin: 0 auto;
      }

      /* ============ CONTENT ============ */
      .content-wrap {
        max-width: 560px;
        margin: 0 auto;
        padding: 32px clamp(16px, 5vw, 48px);
        padding-bottom: calc(var(--bottomnav-h) + 28px);
      }
      @media (min-width: 768px) {
        .content-wrap {
          padding-bottom: 32px;
        }
      }

      /* ============ CARD SHELL ============ */
      .board-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-card);
        overflow: hidden;
      }

      .board-head {
        padding: 20px 20px 16px;
      }
      .board-tabs {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 6px;
        background: var(--bg);
        border: 1px solid var(--border);
        padding: 5px;
        border-radius: var(--radius-sm);
      }
      .board-tab {
        text-align: center;
        font-size: 11.5px;
        font-weight: 700;
        color: var(--ink-600);
        padding: 9px 8px;
        border-radius: 10px;
        border: none;
        background: transparent;
        cursor: pointer;
        transition:
          background 0.18s,
          color 0.18s;
      }
      .board-tab:hover {
        color: var(--navy-900);
      }
      .board-tab.active {
        background: var(--navy-900);
        color: #fff;
        box-shadow: var(--shadow-card);
      }

      .board-scroll {
        max-height: 560px;
        overflow-y: auto;
        padding: 0 20px 20px;
      }
      .board-scroll::-webkit-scrollbar {
        width: 5px;
      }
      .board-scroll::-webkit-scrollbar-track {
        background: transparent;
      }
      .board-scroll::-webkit-scrollbar-thumb {
        background: var(--border);
        border-radius: 10px;
      }

      /* ============ PODIUM ============ */
      #podium-container {
        padding-top: 26px;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        gap: 8px;
        text-align: center;
        max-width: 380px;
        margin: 0 auto;
      }
      .podium-col {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      .podium-avatar-wrap {
        position: relative;
        margin-bottom: 8px;
      }
      .podium-avatar {
        border-radius: 50%;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        font-size: 13px;
      }
      .podium-badge {
        position: absolute;
        bottom: -3px;
        right: -3px;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        border: 2px solid #fff;
      }
      .podium-name {
        font-size: 11.5px;
        font-weight: 700;
        color: var(--ink-900);
        line-height: 1.3;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 96px;
      }
      .podium-score {
        font-size: 11px;
        font-weight: 800;
        margin-top: 2px;
      }
      .podium-block {
        width: 100%;
        margin-top: 10px;
        border-radius: 12px 12px 0 0;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .podium-block span {
        font-family: var(--font-display);
        font-weight: 700;
      }

      .podium-col.rank2 .podium-avatar {
        width: 56px;
        height: 56px;
        border: 2px solid var(--border);
        padding: 2px;
      }
      .podium-col.rank2 .podium-badge {
        width: 20px;
        height: 20px;
        font-size: 10px;
        background: var(--ink-400);
      }
      .podium-col.rank2 .podium-score {
        color: var(--teal-600);
      }
      .podium-col.rank2 .podium-block {
        height: 56px;
        background: linear-gradient(to top, var(--bg), var(--surface));
        border-top: 1px solid var(--border);
      }
      .podium-col.rank2 .podium-block span {
        font-size: 24px;
        color: var(--ink-400);
      }

      .podium-col.rank1 {
        z-index: 1;
        transform: translateY(-8px);
      }
      .podium-col.rank1 .crown {
        color: var(--gold-500);
        margin-bottom: 2px;
      }
      .podium-col.rank1 .podium-avatar {
        width: 72px;
        height: 72px;
        border: 3px solid var(--gold-500);
        padding: 2px;
        box-shadow: var(--shadow-pop);
      }
      .podium-col.rank1 .podium-avatar > div {
        background: var(--gold-tint);
      }
      .podium-col.rank1 .podium-badge {
        width: 24px;
        height: 24px;
        font-size: 11px;
        background: var(--gold-500);
      }
      .podium-col.rank1 .podium-name {
        font-weight: 800;
        max-width: 110px;
      }
      .podium-col.rank1 .podium-score {
        color: var(--gold-500);
        font-size: 12.5px;
      }
      .podium-col.rank1 .podium-block {
        height: 88px;
        background: linear-gradient(to top, var(--gold-tint), #fffdf5);
        border-top: 2px solid rgba(212, 160, 23, 0.35);
      }
      .podium-col.rank1 .podium-block span {
        font-size: 38px;
        color: rgba(212, 160, 23, 0.55);
      }

      .podium-col.rank3 .podium-avatar {
        width: 56px;
        height: 56px;
        border: 2px solid rgba(169, 116, 58, 0.4);
        padding: 2px;
      }
      .podium-col.rank3 .podium-avatar > div {
        background: rgba(169, 116, 58, 0.08);
      }
      .podium-col.rank3 .podium-badge {
        width: 20px;
        height: 20px;
        font-size: 10px;
        background: var(--bronze-500);
      }
      .podium-col.rank3 .podium-score {
        color: var(--teal-600);
      }
      .podium-col.rank3 .podium-block {
        height: 40px;
        background: linear-gradient(to top, var(--bg), var(--surface));
        border-top: 1px solid var(--border);
      }
      .podium-col.rank3 .podium-block span {
        font-size: 20px;
        color: var(--ink-400);
      }

      /* ============ LIST ============ */
      #leaderboard-list {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        gap: 8px;
      }
      .board-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 14px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        transition: border-color 0.15s;
      }
      .board-row.hidden {
        display: none;
      }
      .board-row:hover {
        border-color: var(--teal-500);
      }
      .board-row-left {
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .board-rank {
        width: 18px;
        text-align: center;
        font-family: var(--font-display);
        font-size: 11px;
        font-weight: 700;
        color: var(--ink-400);
      }
      .board-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--navy-tint);
        color: var(--navy-900);
        font-size: 10.5px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .board-row-name {
        font-size: 12.5px;
        font-weight: 700;
        color: var(--ink-900);
      }
      .board-row-score {
        font-size: 12.5px;
        font-weight: 800;
        color: var(--teal-600);
      }

      /* ============ FOOTER BUTTON ============ */
      .board-footer {
        padding: 16px 20px 20px;
        border-top: 1px solid var(--border);
      }
      .btn-loadmore {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: var(--navy-900);
        color: #fff;
        font-size: 12.5px;
        font-weight: 800;
        padding: 13px 0;
        border: none;
        border-radius: var(--radius-sm);
        cursor: pointer;
        box-shadow: var(--shadow-pop);
        transition: filter 0.18s;
      }
      .btn-loadmore:hover {
        filter: brightness(1.12);
      }
      .btn-loadmore svg,
      .btn-loadmore i {
        width: 14px;
        height: 14px;
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
        margin-top: 40px;
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
    <!-- ============ NAVBAR — IDENTIK HOMEPAGE/MATERI/EVALUASI ============ -->
    <header class="navbar">
      <a
        href="#"
        class="navbar-brand"
        aria-label="PKKMB-KT UNILAM Beranda"
      >
        <div class="navbar-logo">
          <img src="{{ asset('gambar/unilam.png') }}" alt="Logo UNILAM" />
        </div>
        <div class="navbar-brand-text">
          <strong>PKKMB-KT</strong>
          <span>UNILAM 2026</span>
        </div>
      </a>

      <button
        class="menu-toggle"
        id="menuToggle"
        aria-label="Buka Menu"
      ></button>

      <nav class="navbar-links" id="navbarLinks">
        <a href="{{ route('role.student.modul') }}">Modul</a>
        <a href="#" class="active">Leaderboard</a>
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
        <div class="hero-eyebrow">
          <span class="dot"></span>
          Statistik Peserta
        </div>
        <h1>Papan Peringkat<br />PKKMB-KT UNILAM 2026</h1>
        <p class="hero-info-sub">
          Pantau posisimu dan lihat siapa yang paling unggul di antara seluruh
          peserta PKKMB-KT.
        </p>
      </div>
    </section>

    <!-- ============ MAIN ============ -->
    <div class="content-wrap">
      <div class="board-card">
        <div class="board-head">
          <div class="board-tabs">
            <button
              id="tab-all"
              onclick="ubahKategori('ALL')"
              class="board-tab active"
            >
              Leaderboard
            </button>
            <button id="tab-male" onclick="ubahKategori('L')" class="board-tab">
              Best Male
            </button>
            <button
              id="tab-female"
              onclick="ubahKategori('P')"
              class="board-tab"
            >
              Best Female
            </button>
          </div>
        </div>

        <div class="board-scroll">
          <div id="podium-container"></div>
          <div id="leaderboard-list"></div>
        </div>

        <div class="board-footer">
          <button
            id="btn-load-more"
            onclick="tampilkanSemuaBaris()"
            class="btn-loadmore"
          >
            <span id="text-btn-load">Lihat Semua Peringkat</span>
            <i data-lucide="chevron-down"></i>
          </button>
        </div>
      </div>
    </div>

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
      <a href="#" class="active">
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

    <script>
      // 1. DATA MASTER KESELURUHAN (Satu wadah berisi data Cowok (L) dan Cewek (P))
      const dataMahasiswa = [
        { nama: "Ricky Maulana", skor: 92, gender: "L" },
        { nama: "Andi Saputra", skor: 89, gender: "L" },
        { nama: "Siti Aisyah", skor: 88, gender: "P" },
        { nama: "Muhammad Farhan", skor: 87, gender: "L" },
        { nama: "Dinda Aprilia", skor: 86, gender: "P" },
        { nama: "Fajar Nugroho", skor: 85, gender: "L" },
        { nama: "Nabila Putri", skor: 84, gender: "P" },
        { nama: "Eko Prasetyo", skor: 83, gender: "L" },
        { nama: "Dewi Lestari", skor: 82, gender: "P" },
        { nama: "Rian Hidayat", skor: 81, gender: "L" },
        { nama: "Siti Nurjanah", skor: 80, gender: "P" },
        { nama: "Agus Setiawan", skor: 79, gender: "L" },
        { nama: "Mega Utami", skor: 78, gender: "P" },
        { nama: "Salman Alfarisi", skor: 77, gender: "L" },
        { nama: "Aisyah Nurul Isaa", skor: 76, gender: "P" },
        { nama: "Hendra Wijaya", skor: 75, gender: "L" },
        { nama: "Fitriani", skor: 74, gender: "P" },
        { nama: "Dimas Maulana", skor: 73, gender: "L" },
        { nama: "Anisa Fitri", skor: 72, gender: "P" },
      ];

      let kategoriAktif = "ALL";
      let statusLimit = true;

      function renderLeaderboard() {
        let dataFilter = [...dataMahasiswa].sort((a, b) => b.skor - a.skor);

        if (kategoriAktif !== "ALL") {
          dataFilter = dataFilter.filter((mhs) => mhs.gender === kategoriAktif);
        }

        const juara1 = dataFilter[0] || { nama: "-", skor: 0, gender: "L" };
        const juara2 = dataFilter[1] || { nama: "-", skor: 0, gender: "L" };
        const juara3 = dataFilter[2] || { nama: "-", skor: 0, gender: "L" };

        const podiumContainer = document.getElementById("podium-container");
        podiumContainer.innerHTML = `
          <div class="podium-col rank2">
            <div class="podium-avatar-wrap">
              <div class="podium-avatar">
                <div style="width:100%;height:100%;border-radius:50%;background:var(--bg);display:flex;align-items:center;justify-content:center;">${juara2.gender === "L" ? "👦" : "👧"}</div>
              </div>
              <span class="podium-badge">2</span>
            </div>
            <p class="podium-name">${juara2.nama}</p>
            <p class="podium-score">${juara2.skor}</p>
            <div class="podium-block"><span>2</span></div>
          </div>

          <div class="podium-col rank1">
            <i data-lucide="crown" class="crown"></i>
            <div class="podium-avatar-wrap">
              <div class="podium-avatar">
                <div>${juara1.gender === "L" ? "👑" : "👸"}</div>
              </div>
              <span class="podium-badge">1</span>
            </div>
            <p class="podium-name">${juara1.nama}</p>
            <p class="podium-score">${juara1.skor}</p>
            <div class="podium-block"><span>1</span></div>
          </div>

          <div class="podium-col rank3">
            <div class="podium-avatar-wrap">
              <div class="podium-avatar">
                <div>${juara3.gender === "L" ? "👦" : "👧"}</div>
              </div>
              <span class="podium-badge">3</span>
            </div>
            <p class="podium-name">${juara3.nama}</p>
            <p class="podium-score">${juara3.skor}</p>
            <div class="podium-block"><span>3</span></div>
          </div>
        `;

        const listContainer = document.getElementById("leaderboard-list");
        listContainer.innerHTML = "";

        const sisaData = dataFilter.slice(3);

        sisaData.forEach((mhs, indeks) => {
          const nomorPeringkat = indeks + 4;
          const inisial = mhs.nama
            .split(" ")
            .map((n) => n[0])
            .join("")
            .substring(0, 2)
            .toUpperCase();

          const kelasHidden = statusLimit && indeks >= 4 ? "hidden" : "";

          const itemRow = document.createElement("div");
          itemRow.className = `board-row ${kelasHidden}`;
          itemRow.innerHTML = `
            <div class="board-row-left">
              <span class="board-rank">${nomorPeringkat}</span>
              <div class="board-avatar">${inisial}</div>
              <span class="board-row-name">${mhs.nama}</span>
            </div>
            <span class="board-row-score">${mhs.skor}</span>
          `;
          listContainer.appendChild(itemRow);
        });

        const btnLoad = document.getElementById("btn-load-more");
        if (!statusLimit || sisaData.length <= 4) {
          btnLoad.style.display = "none";
        } else {
          btnLoad.style.display = "flex";
          document.getElementById("text-btn-load").innerText =
            `Lihat Semua Peringkat (${dataFilter.length})`;
        }

        lucide.createIcons();
      }

      function ubahKategori(kategori) {
        kategoriAktif = kategori;
        statusLimit = true;

        document.getElementById("tab-all").classList.remove("active");
        document.getElementById("tab-male").classList.remove("active");
        document.getElementById("tab-female").classList.remove("active");

        if (kategori === "ALL") {
          document.getElementById("tab-all").classList.add("active");
        } else if (kategori === "L") {
          document.getElementById("tab-male").classList.add("active");
        } else if (kategori === "P") {
          document.getElementById("tab-female").classList.add("active");
        }

        renderLeaderboard();
      }

      function tampilkanSemuaBaris() {
        statusLimit = false;
        renderLeaderboard();
      }

      // Navbar hamburger toggle (mobile)
      // ======================================================================
      // ►► SLIDESHOW LATAR HERO — ganti / tambah gambar di array ini.
      // ======================================================================
      const heroSlideImages = [
        "{{ asset('gambar/gedungutama.jpeg') }}", 
        "{{ asset('gambar/rektor.jpeg') }}", 
        "{{ asset('gambar/gedung.jpeg') }}"
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

      // Load pertama kali saat jendela browser terbuka
      window.onload = function () {
        renderLeaderboard();
      };
    </script>
  </body>
</html>