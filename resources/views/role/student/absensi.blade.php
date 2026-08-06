<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Absensi Saya | PKKMB-KT UNILAM 2026</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet" />

  <style type="text/tailwindcss">
    @theme {
        --color-navy-900: #152159;
        --color-navy-700: #1e3a8f;
        --color-navy-600: #2a4bb0;
        --color-teal-600: #0f8a8c;
        --color-teal-500: #16a0a1;
        --color-teal-tint: #e2f3f2;
        --color-lime-500: #a9c73b;
        --color-lime-tint: #f2f6e0;
        --color-navy-tint: #e6e9f6;
        --color-bg: #f2f4fa;
        --color-surface: #ffffff;
        --color-border: #e1e5f1;
        --color-ink-900: #1b2238;
        --color-ink-600: #5b6175;
        --color-ink-400: #8d92a6;
        --font-sans: "Plus Jakarta Sans", sans-serif;
        --font-display: "Lora", serif;
      }
    </style>
  <style type="text/tailwindcss">
    :root {
        --navy-900: var(--color-navy-900);
        --navy-700: var(--color-navy-700);
        --navy-600: var(--color-navy-600);
        --teal-600: var(--color-teal-600);
        --teal-500: var(--color-teal-500);
        --teal-tint: var(--color-teal-tint);
        --lime-500: var(--color-lime-500);
        --lime-tint: var(--color-lime-tint);
        --navy-tint: var(--color-navy-tint);
        --bg: var(--color-bg);
        --surface: var(--color-surface);
        --border: var(--color-border);
        --ink-900: var(--color-ink-900);
        --ink-600: var(--color-ink-600);
        --ink-400: var(--color-ink-400);
        --radius-lg: 28px;
        --radius-md: 18px;
        --radius-sm: 13px;
        --shadow-card:
          0 2px 14px rgba(21, 33, 89, 0.07), 0 1px 2px rgba(21, 33, 89, 0.05);
        --shadow-pop: 0 10px 24px rgba(21, 33, 89, 0.16);
        --bottomnav-h: 74px;
      }
      * {
        @apply box-border;
      }
      body {
        @apply font-sans text-ink-900 bg-bg m-0 p-0 antialiased min-h-screen flex flex-col;
      }
      .font-display {
        @apply font-display;
      }

      /* ============ NAVBAR ============ */
      .navbar {
        @apply sticky top-0 z-40 flex items-center justify-between gap-4 bg-navy-900 border-b border-white/10;
        padding: 14px clamp(16px, 5vw, 48px);
      }
      .navbar-brand {
        @apply flex items-center gap-2.5 z-50 no-underline;
      }
      .navbar-logo {
        @apply w-[38px] h-[38px] rounded-full bg-white flex items-center justify-center flex-shrink-0 overflow-hidden;
        line-height: 1.25;
      }
      .navbar-logo img {
        @apply w-full h-full object-contain;
      }
      .navbar-brand-text strong {
        @apply block font-display text-[14.5px] text-white;
      }
      .navbar-brand-text span {
        @apply text-[10.5px] text-[#aeb6e0] tracking-[0.04em];
      }
      .menu-toggle {
        @apply flex flex-col justify-between w-6 h-[18px] bg-transparent border-none cursor-pointer z-50 p-0;
      }
      .menu-toggle span {
        @apply block w-full h-0.5 bg-white rounded;
        transition: transform 0.3s ease, opacity 0.3s ease;
      }
      .menu-toggle.active span:nth-child(1) {
        transform: translateY(8px) rotate(45deg);
      }
      .menu-toggle.active span:nth-child(2) {
        @apply opacity-0;
      }
      .menu-toggle.active span:nth-child(3) {
        transform: translateY(-8px) rotate(-45deg);
      }
      .navbar-links {
        @apply hidden;
      }
      .navbar-links.active {
        right: 0;
      }
      .navbar-links a {
        @apply text-[#c7cce8] text-base font-semibold block no-underline transition-colors;
      }
      .navbar-links a:hover,
      .navbar-links a.active {
        @apply text-white;
      }
      .navbar-links a.active {
        @apply border-l-[3px] border-lime-500 pl-2;
      }
      @media (min-width: 768px) {
        .menu-toggle {
          @apply hidden;
        }
        .navbar-links {
          @apply static flex flex-row w-auto h-auto bg-transparent p-0 gap-7 shadow-none;
          transition: none;
        }
        .navbar-links a {
          @apply text-[13.5px];
        }
        .navbar-links a.active {
          @apply border-l-0 border-b-2 border-lime-500 pl-0 pb-0.5;
        }
      }

      /* ============ HERO ============ */
      .hero-info {
        @apply relative overflow-hidden;
        padding: clamp(36px, 6vw, 56px) clamp(16px, 5vw, 48px);
      }
      .hero-slideshow {
        @apply absolute inset-0 z-0 overflow-hidden;
      }
      .hero-slide {
        @apply absolute inset-0 bg-cover bg-center opacity-0;
        transition: opacity 1.8s ease;
      }
      .hero-slide.active {
        @apply opacity-100;
      }
      .hero-slideshow::after {
        content: "";
        @apply absolute inset-0;
        background: linear-gradient(
          135deg,
          rgba(21, 33, 89, 0.94) 0%,
          rgba(15, 138, 140, 0.85) 100%
        );
      }
      .hero-info-inner {
        @apply relative z-[1] max-w-[1200px] mx-auto flex flex-wrap justify-between items-end;
        gap: 28px;
      }
      .hero-info-left {
        @apply flex-1;
        min-width: 280px;
      }
      .hero-eyebrow {
        @apply inline-flex items-center gap-[7px] text-[#c8e46a] text-[11px] font-bold rounded-full mb-4 tracking-[0.06em] uppercase;
        background: rgba(169, 199, 59, 0.15);
        border: 1px solid rgba(169, 199, 59, 0.35);
        padding: 5px 14px;
      }
      .hero-eyebrow .dot {
        @apply w-1.5 h-1.5 rounded-full bg-lime-500;
        animation: pulse 2s infinite;
      }
      @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(0.8); }
      }
      .hero-info h1 {
        @apply font-display font-bold text-white leading-[1.2] mb-3 mt-0;
        font-size: clamp(24px, 4vw, 38px);
      }
      .hero-info-sub {
        @apply text-sm text-white/75 leading-[1.7] m-0;
        max-width: 460px;
      }

      .hero-right {
        @apply flex flex-col items-end gap-2.5 flex-shrink-0;
      }

      .date-nav {
        @apply flex items-stretch gap-0.5 rounded-full;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.16);
        padding: 5px;
        backdrop-filter: blur(14px);
        box-shadow: 0 6px 18px rgba(9, 14, 40, 0.18);
      }
      .date-arrow {
        @apply w-[34px] h-[34px] flex-shrink-0 rounded-full border-none bg-transparent flex items-center justify-center cursor-pointer transition-colors;
        color: rgba(255, 255, 255, 0.7);
      }
      .date-arrow svg {
        @apply w-4 h-4;
      }
      .date-arrow:hover:not(:disabled) {
        @apply text-white;
        background: rgba(255, 255, 255, 0.14);
      }
      .date-arrow:disabled {
        @apply opacity-30 cursor-not-allowed;
      }
      .date-display {
        @apply relative flex items-center gap-2 rounded-full cursor-pointer justify-center;
        padding: 0 14px;
        min-width: 168px;
      }
      .date-display:hover {
        background: rgba(255, 255, 255, 0.08);
      }
      .date-display svg {
        @apply w-[15px] h-[15px] text-lime-500 flex-shrink-0;
      }
      .date-display-text {
        @apply text-[13px] font-bold text-white whitespace-nowrap pointer-events-none;
      }
      .date-display-text .weekday {
        @apply font-semibold;
        color: rgba(255, 255, 255, 0.6);
      }
      .date-input {
        @apply absolute inset-0 w-full h-full opacity-0 cursor-pointer border-none p-0;
      }
      .btn-today {
        @apply text-[11.5px] font-extrabold text-navy-900 bg-lime-500 border-none rounded-full cursor-pointer flex items-center whitespace-nowrap overflow-hidden;
        padding: 0 16px;
        margin-left: 3px;
        transition: filter 0.15s, transform 0.15s, opacity 0.2s, max-width 0.25s, padding 0.25s;
      }
      .btn-today:hover {
        @apply -translate-y-px;
        filter: brightness(1.08);
      }
      .btn-today.is-hidden {
        @apply opacity-0 pointer-events-none;
        max-width: 0;
        padding: 0;
        margin-left: 0;
      }

      .hero-stats {
        @apply flex gap-0.5 rounded-[18px] flex-shrink-0;
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.12);
        padding: 16px 22px;
        backdrop-filter: blur(12px);
      }
      .hero-stat {
        @apply text-center;
        padding: 0 16px;
        border-right: 1px solid rgba(255, 255, 255, 0.12);
      }
      .hero-stat:last-child {
        @apply border-r-0;
      }
      .hero-stat-val {
        @apply font-display text-2xl font-bold text-lime-500 leading-none;
      }
      .hero-stat-lbl {
        @apply font-semibold mt-1 tracking-[0.04em];
        font-size: 10px;
        color: rgba(255, 255, 255, 0.55);
      }

      /* ============ MAIN CONTENT ============ */
      .content-wrap {
        @apply max-w-[1000px] mx-auto w-full flex-1;
        padding: 32px clamp(16px, 5vw, 48px);
        padding-bottom: calc(var(--bottomnav-h) + 28px);
      }
      @media (min-width: 768px) {
        .content-wrap {
          padding-bottom: 32px;
        }
      }

      .section-head {
        @apply flex items-center gap-2.5 mb-4;
      }
      .section-head-bar {
        @apply w-1 h-5 rounded-full;
        background: linear-gradient(to bottom, var(--teal-500), var(--navy-700));
      }
      .section-head h2 {
        @apply font-display text-base font-bold text-ink-900 m-0;
      }

      /* ============ KARTU IDENTITAS ============ */
      .identity-card {
        @apply bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] flex items-center gap-4 mb-6;
        padding: 18px 22px;
      }
      .identity-avatar {
        @apply w-14 h-14 rounded-full overflow-hidden bg-teal-tint flex-shrink-0 border-[3px] border-teal-tint;
      }
      .identity-avatar img {
        @apply w-full h-full object-cover;
      }
      .identity-name {
        @apply font-display text-[17px] font-bold text-ink-900 m-0;
      }
      .identity-meta {
        @apply text-xs text-ink-600 mt-1 flex items-center gap-2 flex-wrap;
      }
      .identity-meta .badge-kelompok {
        @apply text-[10px] bg-navy-tint text-navy-900 rounded-full font-extrabold font-mono;
        padding: 3px 10px;
      }
      .identity-lock {
        @apply ml-auto inline-flex items-center gap-1.5 text-[11px] font-bold text-teal-600 bg-teal-tint rounded-full flex-shrink-0;
        padding: 7px 14px;
      }
      .identity-lock svg {
        @apply w-3 h-3;
      }
      @media (max-width: 520px) {
        .identity-lock span.lock-text {
          @apply hidden;
        }
        .identity-lock {
          @apply p-2;
        }
      }

      .stats-grid {
        @apply grid gap-3.5 mb-6;
        grid-template-columns: repeat(4, 1fr);
      }
      @media (max-width: 640px) {
        .stats-grid {
          grid-template-columns: repeat(2, 1fr);
        }
      }
      .stat-card {
        @apply bg-surface rounded-[18px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] p-3.5 transition-all;
        border-left: 4px solid var(--accent);
      }
      .stat-card:hover {
        @apply -translate-y-0.5 shadow-[0_10px_24px_rgba(21,33,89,0.16)];
      }
      .stat-top {
        @apply flex justify-between items-start;
      }
      .stat-lbl {
        @apply text-[11px] text-ink-400 font-semibold;
      }
      .stat-icon {
        @apply w-[26px] h-[26px] rounded-lg flex items-center justify-center;
      }
      .stat-val {
        @apply font-display text-2xl font-bold mt-2;
      }
      .stat-val small {
        @apply font-sans text-[11px] font-medium text-ink-400;
      }

      .card {
        @apply bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] overflow-hidden mb-5;
      }
      .card-head {
        @apply bg-bg border-b border-border flex flex-wrap justify-between items-center gap-3;
        padding: 16px 22px;
      }
      .card-head h3 {
        @apply text-xs font-extrabold uppercase tracking-[0.03em] text-navy-900 m-0 flex items-center gap-2;
      }
      .source-badge {
        @apply text-[10px] font-extrabold rounded-full;
        padding: 4px 10px;
      }
      .source-live {
        background: #dcfce7;
        color: #15803d;
      }
      .source-demo {
        background: #fef3c7;
        color: #b45309;
      }

      /* ============ DAFTAR SESI ============ */
      .session-list {
        @apply flex flex-col;
      }
      .session-row {
        @apply flex items-center justify-between gap-3.5 border-t border-border transition-colors first:border-t-0 hover:bg-bg;
        padding: 16px 22px;
      }
      .session-info {
        @apply flex items-center gap-3;
      }
      .session-icon {
        @apply w-10 h-10 rounded-[11px] bg-teal-tint text-teal-600 flex items-center justify-center flex-shrink-0;
      }
      .session-icon svg {
        @apply w-[18px] h-[18px];
      }
      .session-name {
        @apply text-[13.5px] font-bold text-ink-900 m-0;
      }
      .session-time {
        @apply text-[11px] text-ink-400 mt-0.5;
      }

      .status-badge {
        @apply inline-block text-center rounded-full font-bold text-[11.5px];
        min-width: 96px;
        padding: 7px 14px;
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
        @apply text-ink-400 font-medium;
        background: #f1f5f9;
        border: 1px solid var(--border);
      }

      .help-box {
        @apply rounded-[18px] flex gap-3 items-start;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        padding: 16px 18px;
      }
      .help-box svg {
        @apply w-[18px] h-[18px] flex-shrink-0 mt-px;
        stroke: #1d4ed8;
      }
      .help-box p {
        @apply m-0 text-xs leading-[1.6];
        color: #1e40af;
      }
      .help-box p strong {
        @apply block mb-0.5;
      }

      /* ============ FOOTER ============ */
      .footer {
        @apply flex flex-wrap justify-between items-center gap-3.5;
        background: #0d1735;
        padding: 24px clamp(16px, 5vw, 48px);
      }
      .footer p {
        @apply text-[13px] m-0;
        color: #4a6a9f;
      }
      .footer-links {
        @apply flex gap-5;
      }
      .footer-links a {
        @apply text-[13px] no-underline transition-colors;
        color: #4a6a9f;
      }
      .footer-links a:hover {
        @apply text-[#aeb6e0];
      }
      @media (max-width: 767px) {
        .footer {
          padding-bottom: calc(var(--bottomnav-h) + 16px);
        }
      }

      /* ============ BOTTOM NAV (mobile) ============ */
      .bottom-nav {
        @apply fixed bottom-0 left-0 right-0 bg-surface border-t border-border flex items-center justify-around z-30;
        height: var(--bottomnav-h);
        padding: 0 6px;
        padding-bottom: env(safe-area-inset-bottom);
      }
      .bottom-nav a {
        @apply flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 no-underline;
        padding: 6px 0;
      }
      .bottom-nav a .ic {
        @apply w-[22px] h-[22px];
      }
      .bottom-nav a.active {
        @apply text-navy-900;
      }
      .bottom-nav a.home {
        @apply flex-none text-white bg-navy-900 w-[54px] h-[54px] rounded-full shadow-[0_10px_24px_rgba(21,33,89,0.16)] justify-center;
        margin-top: -30px;
      }
      .bottom-nav a.home .ic {
        @apply w-6 h-6;
      }
      .bottom-nav a.home span {
        @apply hidden;
      }
      @media (min-width: 768px) {
        .bottom-nav {
          @apply hidden;
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
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
              <path d="M15 18l-6-6 6-6" />
            </svg>
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
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 18l6-6-6-6" />
            </svg>
          </button>
          <button type="button" class="btn-today is-hidden" id="btnToday">Hari Ini</button>
        </div>
      </div>
    </div>
  </section>

  <main class="content-wrap">
    <!-- ============ IDENTITAS AKUN ============ -->
    <div class="identity-card">
      <div class="identity-avatar">
        <img src="{{ auth()->user()->profile_picture ? asset('storage/'.auth()->user()->profile_picture) : 'data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27%3E%3Crect width=%27100%27 height=%27100%27 fill=%27%23e2e8f0%27/%3E%3Ccircle cx=%2750%27 cy=%2738%27 r=%2718%27 fill=%27%2394a3b8%27/%3E%3Cpath d=%27M20 88c0-22 13-35 30-35s30 13 30 35%27 fill=%27%2394a3b8%27/%3E%3C/svg%3E' }}" alt="Foto Profil" />
      </div>
      <div>
        <p class="identity-name" id="identityName">{{ auth()->user()->name }}</p>
        <p class="identity-meta">
          NPM <span id="identityNPM">{{ auth()->user()->npm ?? '-' }}</span>
          <span class="badge-kelompok" id="identityKelompok">{{ $groupName ?? 'Belum tergabung kelompok' }}</span>
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
        stroke-linejoin="round">
        <path
          d="M9 17H4l1.4-1.4A2 2 0 0 0 6 14.2V11a6 6 0 1 1 12 0v3.2c0 .5.2 1 .6 1.4L20 17h-5" />
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
    $(function() {
      // ======================================================================
      // ►► IDENTITAS AKUN — diambil dari sesi login Laravel
      // ======================================================================
      const CURRENT_STUDENT = {
        nama: @json(auth() -> user() -> name),
        kelompok: @json($groupName ?? 'Belum tergabung kelompok'),
      };

      const KODE_KE_LABEL = {
        H: "Hadir",
        S: "Sakit",
        I: "Izin",
        A: "Alpha"
      };
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
        let hadir = 0,
          sakit = 0,
          izin = 0,
          alpha = 0;
        [myStatus.pagi, myStatus.siang, myStatus.sore].forEach((stat) => {
          if (stat === "Hadir") hadir++;
          else if (stat === "Sakit") sakit++;
          else if (stat === "Izin") izin++;
          else if (stat === "Alpha") alpha++;
        });
        $("#stat-hadir").html(`${hadir} <small>sesi</small>`);
        $("#stat-sakit").html(`${sakit} <small>sesi</small>`);
        $("#stat-izin").html(`${izin} <small>sesi</small>`);
        $("#stat-alpha").html(`${alpha} <small>sesi</small>`);
      }

      function renderSessionList(myStatus) {
        const sessions = [{
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

        const html = sessions
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

        $("#sessionList").html(html);
      }

      // ======================================================================
      // ►► AMBIL DATA — hanya baris milik CURRENT_STUDENT
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
        $("#datePill").text(formatTanggalIndo(currentDate));
        $("#sessionCardTitle").text(
          currentDate === new Date().toISOString().slice(0, 10) ?
          "Detail Kehadiran Hari Ini" :
          `Detail Kehadiran ${formatTanggalIndo(currentDate)}`,
        );

        const $sourceBadge = $("#sourceBadge");
        $sourceBadge.text("Memuat...").attr("class", "source-badge");

        const myStatus = await ambilStatusSaya();

        if (isLiveData) {
          $sourceBadge.text("Data Live dari Mentor").attr("class", "source-badge source-live");
        } else {
          $sourceBadge.text("Data Contoh (Belum Dikirim Mentor)").attr("class", "source-badge source-demo");
        }

        updateStats(myStatus);
        renderSessionList(myStatus);
        updateKontrolNavigasi();
      }

      // ======================================================================
      // ►► GANTI TANGGAL
      // ======================================================================
      const $dateInput = $("#dateInput");
      const $btnToday = $("#btnToday");
      const $prevDayBtn = $("#prevDay");
      const $nextDayBtn = $("#nextDay");
      const todayIso = new Date().toISOString().slice(0, 10);

      $dateInput.attr("max", todayIso).val(currentDate);

      function pindahHari(delta) {
        const d = new Date(currentDate + "T00:00:00");
        d.setDate(d.getDate() + delta);
        const iso = d.toISOString().slice(0, 10);
        if (iso > todayIso) return;
        currentDate = iso;
        $dateInput.val(iso);
        renderHalaman();
      }

      function updateKontrolNavigasi() {
        $nextDayBtn.prop("disabled", currentDate >= todayIso);
        $btnToday.toggleClass("is-hidden", currentDate === todayIso);
      }

      $dateInput.on("change", function() {
        if (!$dateInput.val()) return;
        currentDate = $dateInput.val();
        renderHalaman();
      });

      $prevDayBtn.on("click", () => pindahHari(-1));
      $nextDayBtn.on("click", () => pindahHari(1));

      const $dateDisplay = $("#dateDisplay");
      $dateDisplay.on("click", function(e) {
        if (e.target === $dateInput[0]) return;
        const inputEl = $dateInput[0];
        if (typeof inputEl.showPicker === "function") {
          try {
            inputEl.showPicker();
          } catch (err) {
            inputEl.focus();
          }
        } else {
          inputEl.focus();
          inputEl.click();
        }
      });

      $btnToday.on("click", () => {
        currentDate = todayIso;
        $dateInput.val(todayIso);
        renderHalaman();
      });

      renderHalaman();

      setInterval(() => {
        if (currentDate === todayIso) renderHalaman();
      }, 15000);

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO
      // ======================================================================
      const heroSlideImages = [
        "{{ asset('gambar/gedungutama.jpeg') }}",
        "{{ asset('gambar/rektor.jpeg') }}",
        "{{ asset('gambar/gedung.jpeg') }}",
      ];
      const HERO_SLIDE_INTERVAL_MS = 6000;
      const $heroSlideshow = $("#heroSlideshow");
      if ($heroSlideshow.length && heroSlideImages.length) {
        heroSlideImages.forEach((src, i) => {
          $("<div>")
            .addClass("hero-slide" + (i === 0 ? " active" : ""))
            .css("background-image", `url("${src}")`)
            .appendTo($heroSlideshow);
        });
        if (heroSlideImages.length > 1) {
          let currentSlide = 0;
          const $slides = $heroSlideshow.find(".hero-slide");
          setInterval(() => {
            $slides.eq(currentSlide).removeClass("active");
            currentSlide = (currentSlide + 1) % $slides.length;
            $slides.eq(currentSlide).addClass("active");
          }, HERO_SLIDE_INTERVAL_MS);
        }
      }
    });
  </script>
</body>

</html>