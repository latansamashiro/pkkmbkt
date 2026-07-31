<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Dashboard Panitia &mdash; PKKMB-KT UNILAM 2026</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <style>
      /* ============ TOKENS (sinkron dengan index.html & dashboard_mahasiswa.html) ============ */
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
        --coral-500: #e0665a;
        --coral-tint: #fbeae8;

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
        --sidebar-w-desktop: 264px;
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
      img,
      svg {
        display: block;
      }
      svg.icon {
        width: 100%;
        height: 100%;
      }
      :focus-visible {
        outline: 2.5px solid var(--teal-600);
        outline-offset: 2px;
        border-radius: 6px;
      }
      .font-display {
        font-family: var(--font-display);
      }

      /* ============ APP SHELL ============ */
      .app {
        display: flex;
        min-height: 100vh;
      }

      /* ---------- Sidebar (tablet & desktop) ---------- */
      .sidebar {
        display: none;
        flex-direction: column;
        width: var(--sidebar-w-tablet);
        flex-shrink: 0;
        background: linear-gradient(180deg, var(--navy-900) 0%, #101a45 100%);
        color: #fff;
        position: sticky;
        top: 0;
        height: 100vh;
        padding: 22px 0 18px;
        z-index: 20;
        overflow-y: auto;
      }
      .sidebar-brand {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 0 14px 20px;
        margin-bottom: 6px;
        flex-shrink: 0;
      }
      .brand-badge {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--lime-500);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-size: 13px;
        font-weight: 700;
        color: var(--navy-900);
        flex-shrink: 0;
      }
      .sidebar-brand .brand-text {
        display: none;
        line-height: 1.15;
      }
      .sidebar-brand .brand-text strong {
        font-family: var(--font-display);
        font-size: 14px;
        display: block;
      }
      .sidebar-brand .brand-text span {
        font-size: 10px;
        color: #aeb6e0;
        letter-spacing: 0.04em;
      }

      .sidebar-nav {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 2px;
        padding: 4px 10px;
      }
      .sidebar-group-label {
        display: none;
        font-size: 10.5px;
        font-weight: 800;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: #6c76ab;
        padding: 16px 12px 6px;
      }
      .sidebar-group-label:first-child {
        padding-top: 6px;
      }
      .sidebar-nav a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 11px;
        border-radius: var(--radius-sm);
        color: #c7cce8;
        font-weight: 600;
        font-size: 13px;
        transition:
          background 0.15s ease,
          color 0.15s ease;
        justify-content: center;
      }
      .sidebar-nav a .ic {
        width: 19px;
        height: 19px;
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

      .sidebar-logout {
        margin: 10px 10px 0;
        padding: 12px 10px;
        border-radius: var(--radius-sm);
        background: rgba(224, 102, 90, 0.14);
        color: #f3a49c;
        font-weight: 800;
        font-size: 12.5px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background 0.15s ease;
        flex-shrink: 0;
      }
      .sidebar-logout:hover {
        background: rgba(224, 102, 90, 0.24);
      }
      .sidebar-logout .label {
        display: none;
      }
      .sidebar-logout .ic {
        width: 17px;
        height: 17px;
      }

      /* ---------- Main column ---------- */
      .main {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
      }

      /* Topbar */
      .topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: clamp(14px, 3vw, 18px) clamp(16px, 4vw, 28px);
        background: var(--surface);
        border-bottom: 1px solid var(--border);
        position: sticky;
        top: 0;
        z-index: 15;
      }
      .topbar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .topbar-title {
        display: none;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 19px;
        color: var(--navy-900);
      }
      .topbar-actions {
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .search-box {
        display: none;
        align-items: center;
        gap: 8px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 999px;
        padding: 9px 14px;
        min-width: 220px;
      }
      .search-box .ic {
        width: 16px;
        height: 16px;
        color: var(--ink-400);
        flex-shrink: 0;
      }
      .search-box input {
        border: none;
        background: transparent;
        font-family: inherit;
        font-size: 13px;
        color: var(--ink-900);
        width: 100%;
      }
      .search-box input:focus {
        outline: none;
      }
      .icon-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--navy-tint);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--navy-700);
        position: relative;
        cursor: pointer;
        transition: background 0.15s ease;
        flex-shrink: 0;
      }
      .icon-btn:hover {
        background: var(--teal-tint);
        color: var(--teal-600);
      }
      .icon-btn .ic {
        width: 19px;
        height: 19px;
      }
      .icon-btn .dot-badge {
        position: absolute;
        top: -1px;
        right: -1px;
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: var(--coral-500);
        border: 2px solid var(--surface);
      }
      .avatar-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--navy-900);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
      }

      /* Content */
      .content {
        flex: 1;
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
        padding: clamp(16px, 4vw, 32px) clamp(16px, 4vw, 32px)
          calc(var(--bottomnav-h) + 28px);
      }

      /* ============ HERO GREETING ============ */
      .greeting {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 22px;
      }
      .greeting-eyebrow {
        font-size: 13px;
        font-weight: 600;
        color: var(--ink-600);
        margin: 0 0 4px;
      }
      .greeting-title {
        font-family: var(--font-display);
        font-weight: 700;
        color: var(--navy-900);
        font-size: clamp(21px, 2.6vw + 12px, 28px);
        margin: 0;
      }
      .live-tag {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: var(--teal-tint);
        color: var(--teal-600);
        font-size: 12.5px;
        font-weight: 800;
        padding: 8px 14px;
        border-radius: 999px;
      }
      .live-tag .dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--teal-600);
        animation: pulse 1.6s infinite ease-in-out;
      }
      @keyframes pulse {
        0%,
        100% {
          opacity: 1;
        }
        50% {
          opacity: 0.35;
        }
      }

      /* ============ SECTION HEADERS ============ */
      .section {
        margin-top: 28px;
      }
      .section-head {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 14px;
        gap: 10px;
        flex-wrap: wrap;
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
        flex-shrink: 0;
      }
      .section-link .ic {
        width: 14px;
        height: 14px;
      }

      /* ============ STAT GRID (widget dashboard sesuai PRD) ============ */
      .stat-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
      }
      .stat-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 16px 16px 14px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        transition:
          transform 0.15s ease,
          box-shadow 0.15s ease;
      }
      .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-card);
      }
      .stat-chip {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .stat-chip .ic {
        width: 19px;
        height: 19px;
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
      .chip-coral {
        background: var(--coral-tint);
        color: var(--coral-500);
      }
      .stat-value {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: clamp(20px, 2vw + 12px, 25px);
        color: var(--ink-900);
        line-height: 1;
      }
      .stat-label {
        font-size: 12px;
        color: var(--ink-600);
        font-weight: 600;
        line-height: 1.3;
      }
      .stat-trend {
        font-size: 11px;
        font-weight: 700;
      }
      .trend-up {
        color: var(--teal-600);
      }
      .trend-down {
        color: var(--coral-500);
      }
      .trend-flat {
        color: var(--ink-400);
      }

      /* ---- kartu kehadiran (progress ring) ---- */
      .stat-card.wide {
        grid-column: span 2;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
      }
      .ring-wrap {
        position: relative;
        width: 66px;
        height: 66px;
        flex-shrink: 0;
      }
      .ring-wrap svg {
        transform: rotate(-90deg);
        width: 66px;
        height: 66px;
      }
      .ring-bg {
        fill: none;
        stroke: var(--surface-muted);
        stroke-width: 7;
      }
      .ring-fill {
        fill: none;
        stroke: var(--teal-600);
        stroke-width: 7;
        stroke-linecap: round;
      }
      .ring-pct {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 15px;
        color: var(--navy-900);
      }

      /* ============ TWO-COLUMN: LEADERBOARD + PENGUMUMAN ============ */
      .grid-2col {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
      }

      /* ---- Leaderboard ---- */
      .board-list {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        overflow: hidden;
      }
      .board-row {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 13px 16px;
        border-bottom: 1px solid var(--border);
      }
      .board-row:last-child {
        border-bottom: none;
      }
      .board-rank {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 12.5px;
        flex-shrink: 0;
        background: var(--surface-muted);
        color: var(--ink-600);
      }
      .board-row:nth-child(1) .board-rank {
        background: var(--lime-500);
        color: var(--navy-900);
      }
      .board-row:nth-child(2) .board-rank {
        background: #cfd5ef;
        color: var(--navy-900);
      }
      .board-row:nth-child(3) .board-rank {
        background: #e8c9a0;
        color: var(--navy-900);
      }
      .board-info {
        flex: 1;
        min-width: 0;
      }
      .board-name {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--ink-900);
        margin: 0 0 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      .board-meta {
        font-size: 11.5px;
        color: var(--ink-400);
        margin: 0;
      }
      .board-score {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 15px;
        color: var(--teal-600);
        flex-shrink: 0;
      }

      /* ---- Pengumuman ---- */
      .announce-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
      }
      .announce-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 15px 16px;
        display: flex;
        gap: 13px;
        transition:
          transform 0.15s ease,
          box-shadow 0.15s ease;
      }
      .announce-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-card);
      }
      .announce-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .announce-icon .ic {
        width: 19px;
        height: 19px;
      }
      .announce-body {
        flex: 1;
        min-width: 0;
      }
      .announce-tag {
        display: inline-block;
        font-size: 10.5px;
        font-weight: 800;
        letter-spacing: 0.03em;
        text-transform: uppercase;
        color: var(--ink-400);
        margin-bottom: 3px;
      }
      .announce-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--ink-900);
        margin: 0 0 3px;
      }
      .announce-date {
        font-size: 11.5px;
        color: var(--ink-400);
        margin: 0;
      }

      /* ============ AKSI CEPAT ============ */
      .quick-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 12px;
      }
      .quick-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 16px 14px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        transition:
          transform 0.15s ease,
          box-shadow 0.15s ease;
      }
      .quick-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-card);
      }
      .quick-card .stat-chip {
        width: 36px;
        height: 36px;
      }
      .quick-label {
        font-size: 12.5px;
        font-weight: 700;
        color: var(--ink-900);
        line-height: 1.3;
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
        .search-box {
          display: flex;
        }
        .stat-grid {
          grid-template-columns: repeat(3, 1fr);
        }
        .stat-card.wide {
          grid-column: span 3;
        }
      }

      /* ============ RESPONSIVE: DESKTOP ============ */
      @media (min-width: 1100px) {
        .sidebar {
          width: var(--sidebar-w-desktop);
          padding: 26px 0 22px;
        }
        .sidebar-brand {
          justify-content: flex-start;
          padding: 0 22px 22px;
        }
        .sidebar-brand .brand-text {
          display: block;
        }
        .sidebar-group-label {
          display: block;
        }
        .sidebar-nav {
          padding: 4px 14px;
        }
        .sidebar-nav a {
          justify-content: flex-start;
        }
        .sidebar-nav a .label {
          display: block;
        }
        .sidebar-logout {
          justify-content: flex-start;
          margin: 10px 14px 0;
        }
        .sidebar-logout .label {
          display: block;
        }
        .stat-grid {
          grid-template-columns: repeat(4, 1fr);
        }
        .stat-card.wide {
          grid-column: span 2;
        }
        .grid-2col {
          grid-template-columns: 1.1fr 1fr;
        }
      }

      @media (prefers-reduced-motion: reduce) {
        .live-tag .dot {
          animation: none;
        }
        .stat-card,
        .announce-card,
        .quick-card {
          transition: none;
        }
      }
      /* ============ HAMBURGER + DRAWER MOBILE ============ */
      .hamburger {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border);
        background: var(--surface);
        border-radius: 10px;
        color: var(--ink-900);
        cursor: pointer;
        flex-shrink: 0;
        padding: 0;
      }
      .hamburger:hover { background: var(--bg); }
      .hamburger .ic { width: 20px; height: 20px; }

      .sidebar-backdrop {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(21, 33, 89, 0.5);
        backdrop-filter: blur(2px);
        z-index: 40;
      }

      /* Di HP: sidebar jadi drawer geser dengan label lengkap */
      @media (max-width: 767px) {
        /* Topbar tetap menempel di atas saat scroll (HP) */
        .topbar {
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          z-index: 30;
        }
        .content {
          padding-top: 82px;
        }
        /* Cegah scroll horizontal dari drawer, khusus HP */
        html,
        body {
          overflow-x: hidden;
        }
        .sidebar {
          display: flex;
          position: fixed;
          top: 0;
          left: 0;
          height: 100vh;
          width: 264px;
          transform: translateX(-100%);
          transition: transform 0.3s ease;
          z-index: 50;
        }
        .sidebar.open { transform: translateX(0); }
        .sidebar-backdrop.show { display: block; }
        .sidebar-brand { justify-content: flex-start; padding: 0 22px 22px; }
        .sidebar-brand .brand-text { display: block; }
        .sidebar-group-label { display: block; }
        .sidebar-nav { padding: 4px 14px; }
        .sidebar-nav a { justify-content: flex-start; }
        .sidebar-nav a .label { display: block; }
        .sidebar-logout { justify-content: flex-start; margin: 10px 14px 0; }
        .sidebar-logout .label { display: block; }
      }
      @media (min-width: 768px) {
        .hamburger { display: none; }
      }
    </style>
  </head>
  <body>
    <div class="app">
      <!-- ============ SIDEBAR ============ -->
      <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
          <div class="brand-badge">UL</div>
          <div class="brand-text">
            <strong>PKKMB-KT</strong>
            <span>Panel Panitia</span>
          </div>
        </a>

        <nav class="sidebar-nav" aria-label="Navigasi panitia">
          <p class="sidebar-group-label">Utama</p>
          <a href="{{ route('dashboard') }}" class="active">
            <span class="ic"><i data-lucide="layout-dashboard"></i></span>
            <span class="label">Dashboard</span>
          </a>

          <p class="sidebar-group-label">Kelola Data</p>
          <a href="#">
            <span class="ic"><i data-lucide="graduation-cap"></i></span>
            <span class="label">Mahasiswa Baru</span>
          </a>
          <a href="#">
            <span class="ic"><i data-lucide="user-round"></i></span>
            <span class="label">Mentor</span>
          </a>
          <a href="#">
            <span class="ic"><i data-lucide="users-round"></i></span>
            <span class="label">Kelompok</span>
          </a>
          <a href="#">
            <span class="ic"><i data-lucide="users-round"></i></span>
            <span class="label">Kelola Absensi</span>
          </a>
           <a href="#">
            <span class="ic"><i data-lucide="clipboard-check"></i></span>
            <span class="label">Kelola Tugas</span>
          </a>
          <a href="#">
            <span class="ic"><i data-lucide="calendar-days"></i></span>
            <span class="label">Jadwal</span>
          </a>
          <a href="#">
            <span class="ic"><i data-lucide="megaphone"></i></span>
            <span class="label">Info</span>
          </a>
          <a href="#">
            <span class="ic"><i data-lucide="book-open"></i></span>
            <span class="label">Modul PKKMB</span>
          </a>
          <a href="#">
            <span class="ic"><i data-lucide="file-text"></i></span>
            <span class="label">Materi</span>
          </a>
          <a href="#">
            <span class="ic"><i data-lucide="clipboard-list"></i></span>
            <span class="label">Evaluasi</span>
          </a>

          <p class="sidebar-group-label">Monitoring</p>
          <a href="#">
            <span class="ic"><i data-lucide="calendar-check-2"></i></span>
            <span class="label">Absensi</span>
          </a>
          <a href="#">
            <span class="ic"><i data-lucide="clipboard-check"></i></span>
            <span class="label">Evaluasi</span>
          </a>
          <a href="#">
            <span class="ic"><i data-lucide="activity"></i></span>
            <span class="label">Keaktifan</span>
          </a>
          <a href="#">
            <span class="ic"><i data-lucide="shield-alert"></i></span>
            <span class="label">Pelanggaran</span>
          </a>

          <p class="sidebar-group-label">Lainnya</p>
          <a href="#">
            <span class="ic"><i data-lucide="trophy"></i></span>
            <span class="label">Leaderboard</span>
          </a>
          <a href="#">
            <span class="ic"><i data-lucide="download"></i></span>
            <span class="label">Laporan</span>
          </a>
          <a href="#">
            <span class="ic"><i data-lucide="user-circle"></i></span>
            <span class="label">Profil</span>
          </a>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="sidebar-logout">
            @csrf
            <button type="submit" style="all:unset; display:flex; align-items:center; gap:10px; width:100%; cursor:pointer;">
                <span class="ic"><i data-lucide="log-out"></i></span>
                <span class="label">Keluar</span>
            </button>
        </form>
      </aside>

      <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

      <!-- ============ MAIN ============ -->
      <div class="main">
        <!-- Topbar -->
        <header class="topbar">
          <button class="hamburger" id="hamburgerBtn" aria-label="Buka menu">
            <span class="ic"><i data-lucide="menu"></i></span>
          </button>
          <div class="topbar-brand">
            <h1 class="topbar-title">Dashboard</h1>
          </div>

          <div class="topbar-actions">
            <div class="search-box">
              <span class="ic"><i data-lucide="search"></i></span>
              <input type="text" placeholder="Cari mahasiswa, mentor, kelompok..." />
            </div>
            <button class="icon-btn" aria-label="Notifikasi">
              <span class="ic"><i data-lucide="bell"></i></span>
              <span class="dot-badge"></span>
            </button>
            <a href="#" class="avatar-btn">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</a>
          </div>
        </header>

        <!-- Content -->
        <div class="content">
          <!-- Greeting -->
          <div class="greeting">
            <div>
              <p class="greeting-eyebrow">Kamis, 9 Juli 2026</p>
              <h2 class="greeting-title">Selamat datang kembali, {{ auth()->user()->name }}!</h2>
            </div>
            <span class="live-tag">
              <span class="dot"></span>
              Data real-time
            </span>
          </div>

          <!-- ===== WIDGET DASHBOARD (sesuai PRD bagian 1) ===== -->
          <section class="section" style="margin-top: 0">
            <div class="stat-grid">
              <div class="stat-card">
                <span class="stat-chip chip-navy"><span class="ic"><i data-lucide="graduation-cap"></i></span></span>
                <div>
                  <p class="stat-value">1.240</p>
                  <p class="stat-label">Total Mahasiswa Baru</p>
                </div>
              </div>

              <div class="stat-card">
                <span class="stat-chip chip-teal"><span class="ic"><i data-lucide="user-round"></i></span></span>
                <div>
                  <p class="stat-value">86</p>
                  <p class="stat-label">Total Mentor</p>
                </div>
              </div>

              <div class="stat-card">
                <span class="stat-chip chip-lime"><span class="ic"><i data-lucide="users-round"></i></span></span>
                <div>
                  <p class="stat-value">62</p>
                  <p class="stat-label">Total Kelompok</p>
                </div>
              </div>

              <div class="stat-card">
                <span class="stat-chip chip-coral"><span class="ic"><i data-lucide="calendar-days"></i></span></span>
                <div>
                  <p class="stat-value">18</p>
                  <p class="stat-label">Total Kegiatan</p>
                </div>
              </div>

              <div class="stat-card">
                <span class="stat-chip chip-navy"><span class="ic"><i data-lucide="file-text"></i></span></span>
                <div>
                  <p class="stat-value">34</p>
                  <p class="stat-label">Total Materi</p>
                </div>
              </div>

              <div class="stat-card">
                <span class="stat-chip chip-teal"><span class="ic"><i data-lucide="clipboard-list"></i></span></span>
                <div>
                  <p class="stat-value">12</p>
                  <p class="stat-label">Total Evaluasi</p>
                </div>
              </div>

              <div class="stat-card">
                <span class="stat-chip chip-lime"><span class="ic"><i data-lucide="clipboard-check"></i></span></span>
                <div>
                  <p class="stat-value">742</p>
                  <p class="stat-label">Evaluasi Selesai</p>
                </div>
              </div>

              <div class="stat-card">
                <span class="stat-chip chip-coral"><span class="ic"><i data-lucide="clipboard-x"></i></span></span>
                <div>
                  <p class="stat-value">498</p>
                  <p class="stat-label">Evaluasi Belum Selesai</p>
                </div>
              </div>

              <!-- Kehadiran hari ini: progress ring -->
              <div class="stat-card wide">
                <div>
                  <p class="stat-label" style="margin-bottom: 6px">Persentase Kehadiran Hari Ini</p>
                  <p class="stat-value" style="font-size: 15px; color: var(--ink-600); font-family: var(--font-sans); font-weight: 700;">
                    1.086 dari 1.240 mahasiswa hadir
                  </p>
                </div>
                <div class="ring-wrap">
                  <svg viewBox="0 0 66 66">
                    <circle class="ring-bg" cx="33" cy="33" r="27" />
                    <circle
                      class="ring-fill"
                      cx="33"
                      cy="33"
                      r="27"
                      stroke-dasharray="169.6"
                      stroke-dashoffset="24.5"
                    />
                  </svg>
                  <span class="ring-pct">87%</span>
                </div>
              </div>
            </div>
          </section>

          <!-- ===== AKSI CEPAT ===== -->
          <section class="section">
            <div class="section-head">
              <h3 class="section-title">Aksi Cepat</h3>
            </div>
            <div class="quick-grid">
              <a class="quick-card" href="#">
                <span class="stat-chip chip-navy"><span class="ic"><i data-lucide="user-plus"></i></span></span>
                <span class="quick-label">Tambah Maba</span>
              </a>
              <a class="quick-card" href="#">
                <span class="stat-chip chip-teal"><span class="ic"><i data-lucide="calendar-plus"></i></span></span>
                <span class="quick-label">Susun Jadwal</span>
              </a>
              <a class="quick-card" href="#">
                <span class="stat-chip chip-lime"><span class="ic"><i data-lucide="megaphone"></i></span></span>
                <span class="quick-label">Buat Pengumuman</span>
              </a>
              <a class="quick-card" href="#">
                <span class="stat-chip chip-coral"><span class="ic"><i data-lucide="clipboard-list"></i></span></span>
                <span class="quick-label">Buat Evaluasi</span>
              </a>
              <a class="quick-card" href="#">
                <span class="stat-chip chip-navy"><span class="ic"><i data-lucide="download"></i></span></span>
                <span class="quick-label">Ekspor Laporan</span>
              </a>
            </div>
          </section>

          <!-- ===== LEADERBOARD + PENGUMUMAN ===== -->
          <section class="section">
            <div class="grid-2col">
              <!-- Leaderboard mahasiswa -->
              <div>
                <div class="section-head">
                  <h3 class="section-title">Leaderboard Mahasiswa</h3>
                  <a href="#" class="section-link">
                    Lihat Semua
                    <span class="ic"><i data-lucide="chevron-right"></i></span>
                  </a>
                </div>
                <div class="board-list">
                  <div class="board-row">
                    <span class="board-rank">1</span>
                    <div class="board-info">
                      <p class="board-name">Ahmad Fauzan Ramadhan</p>
                      <p class="board-meta">Kelompok 14 &middot; Teknik Informatika</p>
                    </div>
                    <span class="board-score">982</span>
                  </div>
                  <div class="board-row">
                    <span class="board-rank">2</span>
                    <div class="board-info">
                      <p class="board-name">Siti Nur Aisyah</p>
                      <p class="board-meta">Kelompok 07 &middot; Manajemen</p>
                    </div>
                    <span class="board-score">965</span>
                  </div>
                  <div class="board-row">
                    <span class="board-rank">3</span>
                    <div class="board-info">
                      <p class="board-name">Muhammad Rizky Pratama</p>
                      <p class="board-meta">Kelompok 22 &middot; Akuntansi</p>
                    </div>
                    <span class="board-score">951</span>
                  </div>
                  <div class="board-row">
                    <span class="board-rank">4</span>
                    <div class="board-info">
                      <p class="board-name">Dewi Anggraini</p>
                      <p class="board-meta">Kelompok 03 &middot; Hukum</p>
                    </div>
                    <span class="board-score">944</span>
                  </div>
                  <div class="board-row">
                    <span class="board-rank">5</span>
                    <div class="board-info">
                      <p class="board-name">Bagas Adi Saputra</p>
                      <p class="board-meta">Kelompok 31 &middot; Teknik Sipil</p>
                    </div>
                    <span class="board-score">930</span>
                  </div>
                </div>
              </div>

              <!-- Pengumuman terbaru -->
              <div>
                <div class="section-head">
                  <h3 class="section-title">Pengumuman Terbaru</h3>
                  <a href="#" class="section-link">
                    Kelola
                    <span class="ic"><i data-lucide="chevron-right"></i></span>
                  </a>
                </div>
                <div class="announce-list">
                  <a class="announce-card" href="#">
                    <span class="announce-icon chip-teal"><span class="ic"><i data-lucide="megaphone"></i></span></span>
                    <div class="announce-body">
                      <span class="announce-tag">Pengumuman</span>
                      <p class="announce-title">Pembagian Kelompok Sudah Terbit</p>
                      <p class="announce-date">28 Juni 2026</p>
                    </div>
                  </a>
                  <a class="announce-card" href="#">
                    <span class="announce-icon chip-navy"><span class="ic"><i data-lucide="calendar-clock"></i></span></span>
                    <div class="announce-body">
                      <span class="announce-tag">Jadwal</span>
                      <p class="announce-title">Pembekalan Hari Pertama di Hall Unilam</p>
                      <p class="announce-date">30 Juni 2026</p>
                    </div>
                  </a>
                  <a class="announce-card" href="#">
                    <span class="announce-icon chip-coral"><span class="ic"><i data-lucide="alarm-clock"></i></span></span>
                    <div class="announce-body">
                      <span class="announce-tag">Deadline</span>
                      <p class="announce-title">Batas Pengisian Data Mahasiswa</p>
                      <p class="announce-date">2 Juli 2026</p>
                    </div>
                  </a>
                  <a class="announce-card" href="#">
                    <span class="announce-icon chip-lime"><span class="ic"><i data-lucide="shirt"></i></span></span>
                    <div class="announce-body">
                      <span class="announce-tag">Dresscode</span>
                      <p class="announce-title">Ketentuan Pakaian Hari ke-2 dan ke-3</p>
                      <p class="announce-date">1 Juli 2026</p>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>


    <!-- ============ SCRIPT ============ -->
    <script>
      lucide.createIcons();

      // ===== Menu hamburger (drawer navigasi untuk HP) =====
      (function () {
        const ham = document.getElementById("hamburgerBtn");
        const sb = document.querySelector(".sidebar");
        const bd = document.getElementById("sidebarBackdrop");
        if (ham && sb && bd) {
          const openMenu = () => { sb.classList.add("open"); bd.classList.add("show"); };
          const closeMenu = () => { sb.classList.remove("open"); bd.classList.remove("show"); };
          ham.addEventListener("click", openMenu);
          bd.addEventListener("click", closeMenu);
          sb.querySelectorAll("a").forEach((a) => a.addEventListener("click", closeMenu));
        }
      })();
    </script>
  </body>
</html>