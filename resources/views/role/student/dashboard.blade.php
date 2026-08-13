<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Dashboard Mahasiswa | PKKMB-KT UNILAM 2026</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet" />

  <!-- ============ TOKEN TAILWIND ============ -->
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
        --color-surface-muted: #e8ebf6;
        --color-border: #e1e5f1;
        --color-ink-900: #1b2238;
        --color-ink-600: #5b6175;
        --color-ink-400: #8d92a6;
        --font-sans: "Plus Jakarta Sans", sans-serif;
        --font-display: "Lora", serif;
      }
    </style>
  <!-- ============ SISA CSS — token lama dialiaskan ke token Tailwind di
         atas supaya semua deklarasi var(--x) di bawah tetap jalan tanpa
         perlu diketik ulang satu-satu; sisanya dikonversi ke @apply
         (utility class Tailwind) sebisa mungkin, bagian yang butuh
         clamp()/keyframes/breakpoint kustom tetap CSS biasa. ============ -->
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
        --surface-muted: var(--color-surface-muted);
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
        --sidebar-w-tablet: 84px;
        --sidebar-w-desktop: 248px;
        --bottomnav-h: 74px;
      }

      * {
        @apply box-border;
      }
      html,
      body {
        @apply m-0 p-0 max-w-full overflow-x-hidden;
      }
      body {
        @apply bg-bg font-sans text-ink-900 antialiased min-h-screen w-full;
      }
      a {
        @apply text-inherit no-underline;
      }
      ul {
        @apply m-0 p-0 list-none;
      }
      button {
        font-family: inherit;
      }
      img {
        @apply block max-w-full;
      }
      svg {
        @apply block;
      }
      :focus-visible {
        @apply outline-2 outline-teal-600 rounded-md;
        outline-offset: 2px;
      }

      /* ============ APP SHELL ============ */
      .app {
        @apply flex min-h-screen;
      }

      /* ---------- Sidebar (tablet & desktop) ---------- */
      .sidebar {
        @apply hidden flex-col flex-shrink-0 text-white z-20;
        width: var(--sidebar-w-tablet);
        background: linear-gradient(180deg, var(--navy-900) 0%, #101a45 100%);
        padding: 22px 0 18px;
      }
      .sidebar-brand {
        @apply flex items-center justify-center gap-2.5 mb-2;
        padding: 0 14px 22px;
      }
      .sidebar-brand img {
        @apply w-[300px] h-auto;
      }
      .sidebar-brand .brand-text {
        @apply hidden leading-[1.15];
      }
      .sidebar-brand .brand-text strong {
        @apply font-display text-[14.5px] block;
      }
      .sidebar-brand .brand-text span {
        @apply text-[10.5px] text-[#aeb6e0] tracking-[0.04em];
      }

      .sidebar-nav {
        @apply flex-1 flex flex-col gap-1 px-3 py-1.5;
      }
      .sidebar-nav a {
        @apply flex items-center gap-3.5 rounded-[13px] text-[#c7cce8] font-semibold text-[13.5px] justify-center transition-colors;
        padding: 12px 11px;
      }
      .sidebar-nav a .ic {
        @apply w-[21px] h-[21px] flex-shrink-0;
      }
      .sidebar-nav a .label {
        @apply hidden whitespace-nowrap;
      }
      .sidebar-nav a:hover {
        @apply bg-white/[0.08] text-white;
      }
      .sidebar-nav a.active {
        @apply bg-teal-500 text-white shadow-[0_10px_24px_rgba(21,33,89,0.16)];
      }

      .sidebar-login {
        @apply flex items-center justify-center gap-2 rounded-[13px] bg-lime-500 text-navy-900 font-extrabold text-[13px] transition-[filter];
        margin: 10px 12px 0;
        padding: 13px 10px;
      }
      .sidebar-login:hover {
        filter: brightness(1.06);
      }
      .sidebar-login .label {
        @apply hidden;
      }
      .sidebar-login .ic {
        @apply w-[18px] h-[18px];
      }

      /* ---------- Main column ---------- */
      .main {
        @apply flex-1 min-w-0 flex flex-col;
      }

      .topbar {
        @apply flex items-center justify-between gap-3.5 bg-surface border-b border-border z-[15];
        padding: clamp(14px, 3vw, 18px) clamp(16px, 4vw, 28px);
      }
      .topbar-brand {
        @apply flex items-center gap-2.5;
      }
      .topbar-brand img {
        @apply h-[50px] w-auto;
      }
      .topbar-title {
        @apply hidden font-display font-semibold text-[19px] text-navy-900;
      }
      .topbar-actions {
        @apply flex items-center gap-2.5;
      }
      .avatar-btn {
        @apply w-10 h-10 rounded-full bg-navy-tint flex items-center justify-center text-navy-700 relative transition-colors;
      }
      .avatar-btn:hover {
        @apply bg-teal-tint text-teal-600;
      }
      .avatar-btn .ic {
        @apply w-5 h-5;
      }
      .avatar-dot {
        @apply absolute -top-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-lime-500 border-2 border-surface;
      }

      .topbar-logout {
        @apply w-10 h-10 rounded-full bg-[#fef2f2] text-[#dc2626] flex items-center justify-center transition-colors;
      }
      .topbar-logout:hover {
        @apply bg-[#dc2626] text-white;
      }
      .topbar-logout .ic {
        @apply w-[19px] h-[19px];
      }

      .content {
        @apply flex-1 w-full max-w-[1180px] mx-auto;
        padding: clamp(16px, 4vw, 40px) clamp(16px, 4vw, 40px)
          calc(var(--bottomnav-h) + 28px);
      }

      /* ============ HERO ============ */
      .hero {
        @apply relative overflow-hidden bg-surface-muted rounded-[28px];
        padding: clamp(20px, 5vw, 38px) clamp(18px, 5vw, 38px)
          clamp(20px, 4vw, 32px);
      }
      .hero-mosque {
        @apply absolute left-0 right-0 bottom-0 w-full h-auto opacity-[0.16] pointer-events-none;
        max-height: 78%;
      }
      .hero-arch {
        @apply absolute pointer-events-none;
        top: -18px;
        right: -22px;
        width: clamp(110px, 22vw, 210px);
        height: clamp(110px, 22vw, 210px);
      }
      .hero-eyebrow {
        @apply text-[13px] font-semibold text-ink-600 mb-1 relative z-[1];
      }
      .hero-sub {
        @apply text-[14.5px] text-ink-600 mb-1.5 relative z-[1];
      }
      .hero-title {
        @apply font-display font-bold text-navy-900 leading-[1.18] m-0 relative z-[1];
        font-size: clamp(22px, 3.6vw + 14px, 32px);
        max-width: min(420px, 80%);
      }

      .progress-block {
        @apply mt-[22px] relative z-[1];
      }
      .progress-row {
        @apply flex items-baseline justify-between mb-2.5;
      }
      .progress-label {
        @apply text-[13.5px] font-bold text-navy-900;
      }
      .progress-pct {
        @apply text-[13.5px] font-extrabold text-teal-600;
      }
      .progress-track {
        @apply h-[13px] rounded-full bg-white/75 border border-navy-900/[0.08] overflow-hidden;
      }
      .progress-fill {
        @apply h-full rounded-full;
        width: 42%;
        background: linear-gradient(90deg, var(--navy-700), var(--teal-500));
      }

      /* ============ SECTION HEADERS ============ */
      .section {
        @apply mt-[30px];
      }
      .section-head {
        @apply flex items-baseline justify-between mb-3.5;
      }
      .section-title {
        @apply font-display text-[17px] font-bold text-navy-900 m-0;
      }
      .section-link {
        @apply flex items-center gap-1 text-[12.5px] font-bold text-teal-600;
      }
      .section-link .ic {
        @apply w-3.5 h-3.5;
      }

      /* ============ MENU GRID ============ */
      .menu-grid {
        @apply grid;
        grid-template-columns: repeat(auto-fit, minmax(96px, 1fr));
        gap: clamp(8px, 2.4vw, 14px);
      }
      .menu-card {
        @apply bg-surface border border-border rounded-[18px] flex flex-col items-center text-center gap-2.5 min-w-0 transition-all;
        padding: clamp(13px, 2.4vw, 18px) 8px clamp(12px, 2vw, 15px);
      }
      .menu-card:hover {
        @apply -translate-y-[3px] shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] border-transparent;
      }
      .menu-chip {
        @apply w-[46px] h-[46px] rounded-2xl flex items-center justify-center;
      }
      .menu-chip .ic {
        @apply w-[23px] h-[23px];
      }
      .chip-navy {
        @apply bg-navy-tint text-navy-700;
      }
      .chip-teal {
        @apply bg-teal-tint text-teal-600;
      }
      .chip-lime {
        background: var(--lime-tint);
        color: #7c9426;
      }

      .menu-label {
        @apply text-[12.5px] font-bold text-ink-900 leading-[1.25];
      }
      .menu-desc {
        @apply hidden text-[11.5px] text-ink-400 leading-[1.3];
      }

      /* ============ SCHEDULE ============ */
      .schedule-card {
        @apply flex items-center gap-3.5 bg-surface border border-border rounded-[18px] p-[15px] transition-all;
      }
      .schedule-card:hover {
        @apply shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] border-transparent;
      }
      .schedule-icon {
        @apply w-[50px] h-[50px] rounded-2xl flex-shrink-0 bg-navy-900 text-white flex items-center justify-center;
      }
      .schedule-icon .ic {
        @apply w-6 h-6;
      }
      .schedule-info {
        @apply flex-1 min-w-0;
      }
      .schedule-title {
        @apply text-[14.5px] font-bold text-ink-900 mb-[3px] mt-0;
      }
      .schedule-meta {
        @apply text-[12.5px] text-ink-600 m-0 flex flex-wrap gap-1 gap-x-2.5;
      }
      .schedule-go {
        @apply text-ink-400 flex-shrink-0;
      }
      .schedule-go .ic {
        @apply w-[18px] h-[18px];
      }

      /* ============ ASIDE (desktop only) ============ */
      .aside-col {
        @apply hidden;
      }
      .login-card {
        @apply text-white rounded-[28px] relative overflow-hidden;
        background: linear-gradient(160deg, var(--navy-900), #1b2b72);
        padding: 22px 20px;
      }
      .login-card h3 {
        @apply font-display text-[17px] mb-1.5 mt-0;
      }
      .login-card p {
        @apply text-[13px] text-[#bfc6ea] mb-4 mt-0 leading-normal;
      }
      .login-card a {
        @apply inline-flex items-center gap-2 bg-lime-500 text-navy-900 font-extrabold text-[13.5px] rounded-full;
        padding: 11px 18px;
      }
      .login-card a:hover {
        filter: brightness(1.05);
      }
      .login-card .ic {
        @apply w-4 h-4;
      }

      .info-card {
        @apply mt-4 bg-surface border border-border rounded-[18px] p-[18px];
      }
      .info-card h4 {
        @apply font-display text-[14.5px] mb-2 mt-0 text-navy-900;
      }
      .info-card p {
        @apply text-[12.5px] text-ink-600 leading-[1.55] m-0;
      }

      /* ============ BOTTOM NAV (mobile) ============ */
      .bottom-nav {
        @apply fixed bottom-0 left-0 right-0 bg-surface border-t border-border flex items-center justify-around z-30;
        height: var(--bottomnav-h);
        padding: 0 6px;
        padding-bottom: env(safe-area-inset-bottom);
      }
      .bottom-nav a {
        @apply flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1;
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

      /* ============ RESPONSIVE: SHORT / LANDSCAPE PHONES ============ */
      @media (max-width: 767px) and (max-height: 480px) {
        .bottom-nav {
          @apply h-[58px];
        }
        .bottom-nav a.home {
          @apply w-11 h-11;
          margin-top: -20px;
        }
        .bottom-nav a span {
          @apply text-[9px];
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
          @apply mt-[18px];
        }
      }

      /* ============ RESPONSIVE: TABLET ============ */
      @media (min-width: 768px) {
        .sidebar {
          @apply flex;
        }
        .bottom-nav {
          @apply hidden;
        }
        .content {
          padding-bottom: clamp(28px, 4vw, 48px);
        }
        .topbar-title {
          @apply block;
        }
        .topbar-logout {
          @apply hidden;
        }
      }

      /* ============ RESPONSIVE: DESKTOP / LAPTOP ============ */
      @media (min-width: 1100px) {
        .sidebar {
          width: var(--sidebar-w-desktop);
          padding: 26px 0 22px;
        }
        .sidebar-brand {
          @apply justify-start;
          padding: 0 22px 26px;
        }
        .sidebar-brand .brand-text {
          @apply block;
        }
        .sidebar-nav {
          @apply px-4 py-1.5;
        }
        .sidebar-nav a {
          @apply justify-start;
          padding: 12px 14px;
        }
        .sidebar-nav a .label {
          @apply block;
        }
        .sidebar-login {
          @apply justify-start;
          margin: 14px 16px 0;
          padding: 13px 14px;
        }
        .sidebar-login .label {
          @apply block;
        }

        .topbar-brand {
          @apply hidden;
        }
        .content {
          @apply grid items-start;
          grid-template-columns: 1fr 320px;
          gap: 28px;
        }
        .content > .main-col {
          grid-column: 1;
        }
        .aside-col {
          @apply block;
          grid-column: 2;
        }

        .hero-title {
          max-width: min(320px, 75%);
        }
        .hero-arch {
          @apply w-[210px] h-[210px];
          top: -26px;
          right: -30px;
        }

        .menu-grid {
          grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
          @apply gap-4;
        }
        .menu-card {
          @apply items-start text-left;
          padding: 22px 20px;
        }
        .menu-desc {
          @apply block;
        }
        .menu-chip {
          @apply w-[50px] h-[50px];
        }
      }

      /* ============ MODAL KONFIRMASI LOGOUT ============ */
      .logout-modal-backdrop {
        @apply fixed inset-0 z-[100] bg-navy-900/55 hidden items-center justify-center p-4 [&.open]:flex;
        backdrop-filter: blur(6px);
      }
      .logout-modal-box {
        @apply bg-surface rounded-[28px] max-w-[340px] w-full text-center shadow-[0_10px_24px_rgba(21,33,89,0.16)];
        padding: 28px 24px 24px;
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
        @apply w-14 h-14 rounded-full bg-[#fef2f2] text-[#dc2626] flex items-center justify-center mx-auto mb-4;
      }
      .logout-modal-icon .ic {
        @apply w-[26px] h-[26px];
      }
      .logout-modal-box h3 {
        @apply font-display text-lg font-bold text-ink-900 mb-2 mt-0;
      }
      .logout-modal-box p {
        @apply text-[13px] text-ink-600 leading-[1.6] mb-[22px] mt-0;
      }
      .logout-modal-actions {
        @apply flex gap-2.5;
      }
      .btn-logout-cancel {
        @apply flex-1 rounded-[13px] border border-border bg-bg text-ink-900 font-bold text-[13.5px] cursor-pointer transition-colors;
        padding: 12px 0;
      }
      .btn-logout-cancel:hover {
        @apply bg-surface-muted;
      }
      .btn-logout-confirm {
        @apply flex-1 rounded-[13px] border-none bg-[#dc2626] text-white font-extrabold text-[13.5px] cursor-pointer transition-[filter];
        padding: 12px 0;
      }
      .btn-logout-confirm:hover {
        filter: brightness(1.1);
      }
    </style>
</head>

<body>
  <div class="app">
    <!-- ======= SIDEBAR (tablet & desktop) ======= -->
    <aside class="sidebar">
      <span
        class="sidebar-brand">
        <img
          src="{{ asset('gambar/unilam-logo-full.png') }}"
          alt="Logo UNILAM" />
      </span>

      <nav class="sidebar-nav" aria-label="Navigasi utama">
        <a href="{{ route('role.student.modul') }}">
          <svg
            class="ic"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.7"
            stroke-linecap="round"
            stroke-linejoin="round">
            <path
              d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
            <path
              d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z" />
          </svg>
          <span class="label">Modul</span>
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
          <span class="label">Leaderboard</span>
        </a>
        <a href="#" class="active">
          <svg
            class="ic"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.7"
            stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M4 11.5 12 4l8 7.5" />
            <path
              d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10" />
          </svg>
          <span class="label">Dashboard</span>
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
            <circle cx="12" cy="12" r="9" />
            <path d="M12 11v5" />
            <path d="M12 8h.01" />
          </svg>
          <span class="label">Info</span>
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
          stroke-linejoin="round">
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
            alt="Universitas La Tansa Mashiro" />
        </a>
        <h1 class="topbar-title">Dashboard Mahasiswa</h1>
        <div class="topbar-actions">
          <a href="{{ route('role.student.profil') }}" class="avatar-btn" aria-label="Masuk ke akun">
            @if (auth()->user()->profile_picture)
            <img
              src="{{ asset('storage/'.auth()->user()->profile_picture) }}"
              alt="Foto profil"
              style="width:100%; height:100%; border-radius:50%; object-fit:cover;" />
            @else
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
            @endif
            <span class="avatar-dot"></span>
          </a>
          <a href="#" class="topbar-logout" id="btnLogoutTopbar" aria-label="Logout">
            <svg
              class="ic"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round">
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
            <svg
              class="hero-mosque"
              viewBox="0 0 400 160"
              preserveAspectRatio="xMidYMax slice"
              xmlns="http://www.w3.org/2000/svg">
              <rect x="0" y="110" width="400" height="50" fill="#152159" />
              <rect x="44" y="58" width="10" height="56" fill="#152159" />
              <path d="M41 58 Q49 42 57 58 Z" fill="#152159" />
              <circle cx="49" cy="38" r="2.6" fill="#a9c73b" />
              <rect x="346" y="58" width="10" height="56" fill="#152159" />
              <path d="M343 58 Q351 42 359 58 Z" fill="#152159" />
              <circle cx="351" cy="38" r="2.6" fill="#a9c73b" />
              <path
                d="M150 114 Q150 60 200 42 Q250 60 250 114 Z"
                fill="#16a0a1" />
              <rect x="196" y="20" width="8" height="22" fill="#16a0a1" />
              <path
                d="M204 18 A6 6 0 1 1 200 8 A4.6 4.6 0 0 0 204 18 Z"
                fill="#a9c73b" />
              <path
                d="M96 114 Q96 86 116 76 Q136 86 136 114 Z"
                fill="#152159" />
              <path
                d="M264 114 Q264 86 284 76 Q304 86 304 114 Z"
                fill="#152159" />
              <path
                d="M182 160 L182 128 Q200 112 218 128 L218 160 Z"
                fill="#f2f4fa" />
              <path
                d="M120 160 L120 138 Q128 128 136 138 L136 160 Z"
                fill="#f2f4fa"
                opacity="0.85" />
              <path
                d="M264 160 L264 138 Q272 128 280 138 L280 160 Z"
                fill="#f2f4fa"
                opacity="0.85" />
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
              <a class="menu-card" href="{{ route('role.student.modul') }}">
                <span class="menu-chip chip-navy">
                  <svg
                    class="ic"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path
                      d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
                    <path
                      d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z" />
                  </svg>
                </span>
                <span class="menu-label">Modul Pembekalan</span>
                <span class="menu-desc">Materi &amp; e-modul orientasi mahasiswa baru</span>
              </a>

              <a class="menu-card" href="{{ route('role.student.absensi') }}">
                <span class="menu-chip chip-teal">
                  <svg
                    class="ic"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="5" y="4" width="14" height="17" rx="2" />
                    <path d="M9 3.5h6" />
                    <path d="M8.2 10l1.4 1.4 2.2-2.4" />
                    <path d="M14 10.2h2.2" />
                    <path d="M8 15.3h8.2" />
                  </svg>
                </span>
                <span class="menu-label">Presensi</span>
                <span class="menu-desc">Cek absensi dan status tugas harianmu</span>
              </a>

              <a class="menu-card" href="{{ route('role.student.jadwal') }}">
                <span class="menu-chip chip-lime">
                  <svg
                    class="ic"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                    stroke-linejoin="round">
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
                <span class="menu-desc">Rangkaian kegiatan &amp; jadwal resmi PKKMB</span>
              </a>

              <a class="menu-card" href="{{ route('role.student.info') }}">
                <span class="menu-chip chip-teal">
                  <svg
                    class="ic"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9" />
                    <path d="M12 11v5" />
                    <path d="M12 8h.01" />
                  </svg>
                </span>
                <span class="menu-label">Info</span>
                <span class="menu-desc">Pengumuman &amp; informasi terbaru PKKMB</span>
              </a>

              <a class="menu-card" href="{{ route('role.student.leaderboard') }}">
                <span class="menu-chip chip-lime">
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
                </span>
                <span class="menu-label">Leaderboard</span>
                <span class="menu-desc">Pantau peringkat poin keaktifanmu</span>
              </a>

              <a class="menu-card" href="{{ route('role.student.denah-kampus') }}">
                <span class="menu-chip chip-teal">
                  <svg
                    class="ic"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path
                      d="M12 21s-7-6.1-7-11.5A7 7 0 0 1 19 9.5C19 14.9 12 21 12 21Z" />
                    <circle cx="12" cy="9.3" r="2.4" />
                  </svg>
                </span>
                <span class="menu-label">Peta Lokasi</span>
                <span class="menu-desc">Temukan lokasi kegiatan di kampus</span>
              </a>

              <a class="menu-card" href="{{ route('role.student.materi') }}">
                <span class="menu-chip chip-navy">
                  <svg
                    class="ic"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="5" y="4" width="14" height="17" rx="2" />
                    <path d="M9 3.5h6" />
                    <path d="M8.3 11.2l1.4 1.4 2.3-2.5" />
                    <path d="M14.4 11.4h2" />
                    <path d="M8 16h8.2" />
                  </svg>
                </span>
                <span class="menu-label">Materi</span>
                <span class="menu-desc">Kerjakan tes pemahaman materi PKKMB</span>
              </a>

              <a class="menu-card" href="{{ route('role.student.evaluasi') }}">
                <span class="menu-chip chip-navy">
                  <svg
                    class="ic"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="5" y="4" width="14" height="17" rx="2" />
                    <path d="M9 3.5h6" />
                    <path d="M8.3 11.2l1.4 1.4 2.3-2.5" />
                    <path d="M14.4 11.4h2" />
                    <path d="M8 16h8.2" />
                  </svg>
                </span>
                <span class="menu-label">Evaluasi</span>
                <span class="menu-desc">Kerjakan tes pemahaman materi PKKMB</span>
              </a>

              <a class="menu-card" href="{{ route('role.student.keaktifan') }}">
                <span class="menu-chip chip-navy">
                  <svg
                    class="ic"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="5" y="4" width="14" height="17" rx="2" />
                    <path d="M9 3.5h6" />
                    <path d="M8.3 11.2l1.4 1.4 2.3-2.5" />
                    <path d="M14.4 11.4h2" />
                    <path d="M8 16h8.2" />
                  </svg>
                </span>
                <span class="menu-label">Keaktifan & Pelanggaran</span>
                <span class="menu-desc">Monitoring Keaktifan & Pelanggaran</span>
              </a>
            </div>
          </section>

          <!-- ===== JADWAL ===== -->
          <section class="section">
            <div class="section-head">
              <h3 class="section-title">Jadwal Hari Ini</h3>
              <a href="{{ route('role.student.jadwal') }}" class="section-link">
                Lihat Semua
                <svg
                  class="ic"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M9 6l6 6-6 6" />
                </svg>
              </a>
            </div>

@forelse ($jadwalHariIni as $j)
              <a class="schedule-card" href="{{ route('role.student.jadwal') }}">
                <span class="schedule-icon">
                  <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="4" y="5" width="16" height="16" rx="2" />
                    <path d="M8 3v4M16 3v4M4 9.5h16" />
                    <circle cx="8.3" cy="13.2" r=".9" fill="currentColor" stroke="none" />
                    <circle cx="12" cy="13.2" r=".9" fill="currentColor" stroke="none" />
                    <circle cx="15.7" cy="13.2" r=".9" fill="currentColor" stroke="none" />
                    <circle cx="8.3" cy="16.6" r=".9" fill="currentColor" stroke="none" />
                    <circle cx="12" cy="16.6" r=".9" fill="currentColor" stroke="none" />
                  </svg>
                </span>
                <span class="schedule-info">
                  <p class="schedule-title">{{ $j->title }}</p>
                  <p class="schedule-meta">
                    <span>{{ substr($j->schedule_begin_time, 0, 5) }}&ndash;{{ substr($j->schedule_end_time, 0, 5) }}</span>
                    @if ($j->place)
                      <span>&middot;</span><span>{{ $j->place }}</span>
                    @endif
                  </p>
                </span>
                <span class="schedule-go">
                  <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 6l6 6-6 6" />
                  </svg>
                </span>
              </a>
            @empty
              <p class="text-sm text-ink-400 text-center py-6 m-0">Tidak ada jadwal untuk hari ini.</p>
            @endforelse
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
      <span>Leaderboard</span>
    </a>
    <a href="#" class="home" aria-label="Dashboard">
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
      <span>Dashboard</span>
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
        <circle cx="12" cy="12" r="9" />
                    <path d="M12 11v5" />
                    <path d="M12 8h.01" />
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
    //    dulu. Tujuan link diambil dari href tombol yang diklik.
    // ======================================================================
    $(function() {
      const $logoutModal = $("#logoutModal");
      let logoutTargetUrl = "#";

      function bukaModalLogout(e) {
        e.preventDefault();
        logoutTargetUrl = $(this).attr("href");
        $logoutModal.addClass("open");
      }

      $("#btnLogoutSidebar").on("click", bukaModalLogout);
      $("#btnLogoutTopbar").on("click", bukaModalLogout);

      $("#btnLogoutCancel").on("click", () => {
        $logoutModal.removeClass("open");
      });
      $("#btnLogoutConfirm").on("click", () => {
        $("#logoutForm").trigger("submit");
      });
      $logoutModal.on("click", function(e) {
        if (e.target === this) $logoutModal.removeClass("open");
      });
    });
  </script>
</body>

</html>