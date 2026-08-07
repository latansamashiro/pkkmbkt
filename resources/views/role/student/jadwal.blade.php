<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Jadwal | PKKMB-KT UNILAM 2026</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
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
        @apply font-sans text-ink-900 bg-bg m-0 p-0 antialiased;
      }
      .font-display {
        @apply font-display;
      }

      /* ============ NAVBAR — IDENTIK HALAMAN LAIN ============ */
      .navbar {
        @apply sticky top-0 z-40 flex items-center justify-between gap-4 bg-navy-900 border-b border-white/10;
        padding: 14px clamp(16px, 5vw, 48px);
      }
      .navbar-brand {
        @apply flex items-center gap-2.5 z-50 no-underline;
      }
      .navbar-logo {
        @apply w-[38px] h-[38px] rounded-full bg-white flex items-center justify-center flex-shrink-0 overflow-hidden;
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

      /* ---- Dropdown "Tentang" ---- */
      .nav-dropdown {
        @apply relative w-full;
      }
      .nav-dropdown-toggle {
        @apply flex items-center justify-between w-full gap-2 bg-transparent border-none p-0 text-[#c7cce8] font-sans text-base font-semibold cursor-pointer transition-colors;
      }
      .nav-dropdown-toggle:hover,
      .nav-dropdown.open .nav-dropdown-toggle {
        @apply text-white;
      }
      .nav-dropdown-toggle .dropdown-arrow {
        @apply w-3 h-3 flex-shrink-0 transition-transform duration-[250ms] ease-in-out;
      }
      .nav-dropdown.open .dropdown-arrow {
        transform: rotate(180deg);
      }
      .nav-dropdown-menu {
        @apply flex flex-col gap-3.5 overflow-hidden opacity-0 pl-3.5 mt-0;
        max-height: 0;
        transition: max-height 0.3s ease, opacity 0.25s ease, margin-top 0.3s ease;
      }
      .nav-dropdown.open .nav-dropdown-menu {
        @apply opacity-100;
        max-height: 220px;
        margin-top: 14px;
      }
      .nav-dropdown-menu a {
        @apply text-[14.5px] text-[#9aa2cc];
      }
      .nav-dropdown-menu a::before {
        content: "— ";
        color: var(--lime-500);
      }
      .nav-dropdown-menu a:hover {
        @apply text-white;
      }
      .nav-dropdown-menu a.active {
        @apply text-white font-bold;
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
        .nav-dropdown {
          @apply w-auto;
        }
        .nav-dropdown-toggle {
          @apply w-auto text-[13.5px];
        }
        .nav-dropdown-menu {
          @apply absolute rounded-xl;
          top: calc(100% + 14px);
          left: 0;
          min-width: 170px;
          background: #0d1735;
          border: 1px solid rgba(255, 255, 255, 0.08);
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
          @apply p-0 whitespace-nowrap;
        }
      }

      /* ============ HERO — SAMA POLA DENGAN EVALUASI/MATERI ============ */
      .hero-info {
        @apply relative overflow-hidden text-white;
        padding: clamp(40px, 7vw, 64px) clamp(16px, 5vw, 48px);
        background-image: linear-gradient(
            135deg,
            rgba(21, 33, 89, 0.94) 0%,
            rgba(15, 138, 140, 0.85) 100%
          ),
          url("{{ asset('gambar/unilam.jpeg') }}");
        background-size: cover;
        background-position: center;
      }
      .hero-info::before {
        content: "";
        @apply absolute rounded-full pointer-events-none;
        width: 420px;
        height: 420px;
        background: rgba(169, 199, 59, 0.08);
        top: -160px;
        right: -100px;
      }
      .hero-info::after {
        content: "";
        @apply absolute rounded-full pointer-events-none;
        width: 260px;
        height: 260px;
        background: rgba(22, 160, 161, 0.1);
        bottom: -80px;
        left: -60px;
      }
      .hero-info-inner {
        @apply relative z-[1] max-w-[1200px] mx-auto flex flex-wrap justify-between items-end;
        gap: 32px;
      }
      .hero-info-left {
        @apply flex-1;
        min-width: 280px;
      }
      .hero-eyebrow {
        @apply inline-flex items-center gap-[7px] text-[#c8e46a] text-[11px] font-bold tracking-[0.06em] uppercase rounded-full mb-4;
        background: rgba(169, 199, 59, 0.15);
        border: 1px solid rgba(169, 199, 59, 0.35);
        padding: 5px 14px;
      }
      .hero-eyebrow svg {
        @apply w-[13px] h-[13px];
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
        @apply font-display font-bold leading-[1.2] mb-3 mt-0;
        font-size: clamp(24px, 4vw, 40px);
      }
      .hero-info-sub {
        @apply text-sm text-white/75 leading-[1.7] m-0;
        max-width: 460px;
      }

      .hero-stats {
        @apply flex gap-0.5 rounded-[18px] flex-shrink-0;
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.12);
        padding: 18px 24px;
        backdrop-filter: blur(12px);
      }
      .hero-stat {
        @apply text-center;
        padding: 0 18px;
        border-right: 1px solid rgba(255, 255, 255, 0.12);
      }
      .hero-stat:last-child {
        @apply border-r-0;
      }
      .hero-stat-val {
        @apply font-display text-2xl font-bold text-lime-500 leading-none;
      }
      .hero-stat-lbl {
        @apply text-white/55 font-bold tracking-[0.06em] uppercase mt-[5px];
        font-size: 9.5px;
      }
      .hero-stat-icon {
        @apply flex items-center justify-center gap-1;
      }
      .hero-stat-icon svg {
        @apply w-5 h-5 text-teal-500 mb-[3px];
      }

      @media (max-width: 640px) {
        .hero-info-inner {
          @apply justify-center text-center;
        }
        .hero-info-left {
          min-width: 100%;
        }
        .hero-info-sub {
          @apply mx-auto;
          max-width: 100%;
        }
        .hero-stats {
          @apply w-full justify-between;
          padding: 16px 14px;
        }
        .hero-stat {
          @apply flex-1;
          padding: 0 6px;
        }
      }

      .arch-divider {
        @apply flex justify-center;
        padding: 20px 0 4px;
      }

      /* ============ MAIN CONTENT ============ */
      .content-wrap {
        @apply max-w-[820px] mx-auto;
        padding: 8px clamp(16px, 5vw, 48px) 64px;
        padding-bottom: calc(var(--bottomnav-h) + 40px);
      }
      @media (min-width: 768px) {
        .content-wrap {
          padding-bottom: 64px;
        }
      }

      .section-head {
        @apply text-center mb-10;
      }
      .section-head h2 {
        @apply font-display font-bold text-navy-900 mb-1.5 mt-0;
        font-size: clamp(22px, 3.4vw, 28px);
      }
      .section-head p {
        @apply text-[13px] text-ink-400 font-semibold m-0;
      }

      /* ---- Timeline ---- */
      .timeline-wrap {
        @apply relative flex flex-col border-l-2 border-border;
        margin-left: 8px;
        padding-left: 30px;
        gap: 32px;
      }
      @media (min-width: 768px) {
        .timeline-wrap {
          margin-left: 150px;
        }
      }
      .timeline-item {
        @apply relative;
      }
      .timeline-dot {
        @apply absolute rounded-full bg-teal-500 border-4 border-surface;
        left: -37px;
        top: 6px;
        width: 15px;
        height: 15px;
        box-shadow: 0 0 0 1px var(--border);
      }
      .timeline-item.last .timeline-dot {
        @apply bg-lime-500;
      }
      .timeline-date {
        @apply hidden;
      }
      @media (min-width: 768px) {
        .timeline-date {
          @apply block absolute text-right;
          left: -160px;
          top: 4px;
          width: 118px;
        }
      }
      .timeline-date-day {
        @apply font-display text-[19px] font-bold text-navy-900 block;
      }
      .timeline-date-weekday {
        @apply text-[10.5px] font-extrabold text-teal-600 uppercase tracking-[0.05em];
      }
      .timeline-item.last .timeline-date-weekday {
        color: #a48a1c;
      }

      .timeline-card {
        @apply bg-surface border border-border rounded-[18px] shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] transition-all;
        padding: 22px 24px;
      }
      .timeline-card:hover {
        @apply shadow-[0_10px_24px_rgba(21,33,89,0.16)] -translate-y-0.5;
      }
      .timeline-card.highlight {
        @apply border-l-4 border-lime-500;
      }
      .timeline-date-mobile {
        @apply inline-block text-[10.5px] font-extrabold tracking-[0.04em] uppercase text-teal-600 mb-2;
      }
      .timeline-item.last .timeline-date-mobile {
        color: #a48a1c;
      }
      @media (min-width: 768px) {
        .timeline-date-mobile {
          @apply hidden;
        }
      }
      .timeline-card-head {
        @apply flex justify-between items-start flex-wrap;
        gap: 14px;
      }
      .timeline-day-badge {
        @apply text-[10.5px] font-extrabold bg-teal-tint text-teal-600 rounded-md inline-block;
        padding: 3px 10px;
      }
      .timeline-item.last .timeline-day-badge {
        @apply bg-lime-tint;
        color: #718821;
      }
      .timeline-title {
        @apply font-display text-[16.5px] font-bold text-navy-900 leading-[1.35];
        margin: 8px 0 0;
      }
      .timeline-time {
        @apply inline-flex items-center gap-1.5 text-[11.5px] font-bold text-ink-600 bg-bg rounded-lg whitespace-nowrap flex-shrink-0;
        padding: 6px 12px;
      }
      .timeline-time svg {
        @apply w-[13px] h-[13px] text-ink-400;
      }
      .timeline-list {
        @apply mt-4 pt-4 border-t border-border flex flex-col gap-2.5;
      }
      .timeline-list p {
        @apply flex gap-2 items-start text-[12.5px] text-ink-600 leading-[1.6] m-0;
      }
      .timeline-list svg {
        @apply w-[15px] h-[15px] text-lime-500 flex-shrink-0 mt-0.5;
      }
      .timeline-location {
        @apply mt-3.5 flex items-center gap-1.5 text-[11.5px] text-ink-400 font-semibold;
      }
      .timeline-location svg {
        @apply w-3.5 h-3.5;
      }

      /* ---- Catatan / help box ---- */
      .help-box {
        @apply rounded-[18px] flex gap-3.5 items-start mt-14;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        padding: 20px 22px;
      }
      .help-box-icon {
        @apply w-10 h-10 rounded-xl bg-navy-900 text-white flex items-center justify-center flex-shrink-0;
      }
      .help-box-icon svg {
        @apply w-[19px] h-[19px];
      }
      .help-box h4 {
        @apply font-display text-[15px] font-bold text-navy-900 mb-1 mt-0;
      }
      .help-box p {
        @apply m-0 text-[12.5px] leading-[1.65];
        color: #1e40af;
      }

      /* ============ CTA SECTION ============ */
      .cta-section {
        @apply text-center relative overflow-hidden;
        background: linear-gradient(135deg, var(--navy-900), var(--navy-700));
        padding: clamp(48px, 7vw, 76px) clamp(16px, 5vw, 48px);
      }
      .cta-section::before {
        content: "";
        @apply absolute rounded-full pointer-events-none;
        width: 280px;
        height: 280px;
        background: rgba(169, 199, 59, 0.08);
        top: -70px;
        left: -70px;
      }
      .cta-section::after {
        content: "";
        @apply absolute rounded-full pointer-events-none;
        width: 220px;
        height: 220px;
        background: rgba(22, 160, 161, 0.1);
        bottom: -55px;
        right: -55px;
      }
      .cta-section h2 {
        @apply font-display text-white mb-3 mt-0 relative z-[1];
        font-size: clamp(22px, 3.6vw, 34px);
      }
      .cta-section p {
        @apply text-sm mx-auto leading-[1.7] relative z-[1];
        color: #bfc6ea;
        max-width: 460px;
        margin-bottom: 28px;
      }
      .cta-buttons {
        @apply flex flex-wrap gap-3 justify-center relative z-[1];
      }
      .btn-primary {
        @apply inline-flex items-center gap-2 bg-lime-500 text-navy-900 font-sans font-extrabold text-[13.5px] rounded-full border-none cursor-pointer shadow-[0_10px_24px_rgba(21,33,89,0.16)] no-underline transition-[filter];
        padding: 12px 26px;
      }
      .btn-primary:hover {
        filter: brightness(1.06);
      }
      .btn-primary svg {
        @apply w-4 h-4;
      }
      .btn-outline {
        @apply inline-flex items-center gap-2 bg-transparent text-white font-sans font-bold text-[13.5px] rounded-full cursor-pointer no-underline transition-all;
        border: 1.5px solid rgba(255, 255, 255, 0.35);
        padding: 12px 26px;
      }
      .btn-outline:hover {
        @apply border-white bg-white/[0.08];
      }
      .btn-outline svg {
        @apply w-4 h-4;
      }

      /* ============ FOOTER ============ */
      .footer {
        @apply flex flex-wrap justify-between items-center gap-3.5;
        background: #0d1735;
        padding: 28px clamp(16px, 5vw, 48px);
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

    <nav class="navbar-links" id="navbarLinks" aria-label="Navigasi utama">
      <a href="{{ route('role.student.modul') }}">Modul</a>
      <a href="{{ route('role.student.leaderboard') }}">Leaderboard</a>
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <a href="{{ route('role.student.info') }}">Info</a>
      <a href="{{ route('role.student.profil') }}">Profil</a>
    </nav>
  </header>

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
        stroke-width="2" />
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
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="9" />
          <path d="M12 16v-4M12 8h.01" />
        </svg>
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
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M5 12h14M13 5l7 7-7 7" />
        </svg>
        Lihat Informasi Lengkap
      </a>
      <a href="{{ route('landing.kontak') }}" class="btn-outline">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z" />
        </svg>
        Hubungi Panitia
      </a>
    </div>
  </section>

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
        stroke-linejoin="round">
        <path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
        <path
          d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z" />
      </svg>
      <span>Modul</span>
    </a>
    <a href="{{ route('role.student.leaderboard') }}">
      <svg
        class="ic"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="1.7"
        stroke-linecap="round"
        stroke-linejoin="round">
        <path
          d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z" />
        <path d="M5 21v-5M12 21v-7M19 21v-4" />
      </svg>
      <span>Papan</span>
    </a>
    <a href="{{ route('dashboard') }}" class="home" aria-label="Beranda">
      <svg
        class="ic"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="1.8"
        stroke-linecap="round"
        stroke-linejoin="round">
        <path d="M4 11.5 12 4l8 7.5" />
        <path
          d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10" />
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
      <svg
        class="ic"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="1.7"
        stroke-linecap="round"
        stroke-linejoin="round">
        <circle cx="12" cy="8" r="3.4" />
        <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
      </svg>
      <span>Profil</span>
    </a>
  </nav>

  <script>
    $(function() {
      const $navbarLinks = $("#navbarLinks");
      const $dropdownTentang = $("#dropdownTentang");
      const $dropdownTentangToggle = $("#dropdownTentangToggle");

      $dropdownTentangToggle.on("click", function(e) {
        e.preventDefault();
        e.stopPropagation();
        const isOpen = $dropdownTentang.toggleClass("open").hasClass("open");
        $dropdownTentangToggle.attr("aria-expanded", isOpen);
      });

      $(document).on("click", function(e) {
        if ($dropdownTentang.length && !$dropdownTentang.is(e.target) && $dropdownTentang.has(e.target).length === 0) {
          $dropdownTentang.removeClass("open");
          $dropdownTentangToggle.attr("aria-expanded", "false");
        }
      });

      $navbarLinks.find("a").on("click", function() {
        $navbarLinks.removeClass("active");
      });
    });
  </script>
</body>

</html>