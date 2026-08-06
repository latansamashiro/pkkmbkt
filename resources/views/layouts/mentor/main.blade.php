<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>@yield('title', 'Dashboard PKKMB-KT UNILAM 2026')</title>

  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

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
        --color-surface-muted: #e8ebf6;
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
        --surface-muted: var(--color-surface-muted);
        --border: var(--color-border);
        --ink-900: var(--color-ink-900);
        --ink-600: var(--color-ink-600);
        --ink-400: var(--color-ink-400);
        --radius-lg: 28px;
        --radius-md: 18px;
        --radius-sm: 13px;
        --shadow-card: 0 2px 14px rgba(21, 33, 89, 0.07), 0 1px 2px rgba(21, 33, 89, 0.05);
        --shadow-pop: 0 10px 24px rgba(21, 33, 89, 0.16);
        --sidebar-w-tablet: 84px;
        --sidebar-w-desktop: 248px;
        --bottomnav-h: 74px;
      }

      * { @apply box-border; }
      html, body { @apply m-0 p-0 max-w-full overflow-x-hidden; }
      body { @apply bg-bg font-sans text-ink-900 antialiased min-h-screen w-full; }
      a { @apply text-inherit no-underline; }
      ul { @apply m-0 p-0 list-none; }
      button { font-family: inherit; }
      img { @apply block max-w-full; }
      svg { @apply block; }
      :focus-visible { @apply outline-2 outline-teal-600 rounded-md; outline-offset: 2px; }

      /* ============ APP SHELL ============ */
      .app { @apply flex min-h-screen; }

      .sidebar {
        @apply hidden flex-col flex-shrink-0 text-white z-20;
        width: var(--sidebar-w-tablet);
        background: linear-gradient(180deg, var(--navy-900) 0%, #101a45 100%);
        padding: 22px 0 18px;
      }
      .sidebar-brand { @apply flex items-center justify-center gap-2.5 mb-2; padding: 0 14px 22px; }
      .sidebar-brand img { @apply w-[300px] h-auto; }
      .sidebar-brand .brand-text { @apply hidden leading-[1.15]; }
      .sidebar-brand .brand-text strong { @apply font-display text-[14.5px] block; }
      .sidebar-brand .brand-text span { @apply text-[10.5px] text-[#aeb6e0] tracking-[0.04em]; }

      .sidebar-nav { @apply flex-1 flex flex-col gap-1 px-3 py-1.5; }
      .sidebar-nav a {
        @apply flex items-center gap-3.5 rounded-[13px] text-[#c7cce8] font-semibold text-[13.5px] justify-center transition-colors;
        padding: 12px 11px;
      }
      .sidebar-nav a .ic { @apply w-[21px] h-[21px] flex-shrink-0; }
      .sidebar-nav a .label { @apply hidden whitespace-nowrap; }
      .sidebar-nav a:hover { @apply bg-white/[0.08] text-white; }
      .sidebar-nav a.active { @apply bg-teal-500 text-white shadow-[0_10px_24px_rgba(21,33,89,0.16)]; }

      .sidebar-login {
        @apply flex items-center justify-center gap-2 rounded-[13px] bg-lime-500 text-navy-900 font-extrabold text-[13px] transition-[filter];
        margin: 10px 12px 0;
        padding: 13px 10px;
      }
      .sidebar-login:hover { filter: brightness(1.06); }
      .sidebar-login .label { @apply hidden; }
      .sidebar-login .ic { @apply w-[18px] h-[18px]; }

      .main { @apply flex-1 min-w-0 flex flex-col; }

      .topbar {
        @apply flex items-center justify-between gap-3.5 bg-surface border-b border-border z-[15];
        padding: clamp(14px, 3vw, 18px) clamp(16px, 4vw, 28px);
      }
      .topbar-brand { @apply flex items-center gap-2.5; }
      .topbar-brand img { @apply h-[50px] w-auto; }
      .topbar-title { @apply hidden font-display font-semibold text-[19px] text-navy-900; }
      .topbar-actions { @apply flex items-center gap-2.5; }
      .avatar-btn { @apply w-10 h-10 rounded-full bg-navy-tint flex items-center justify-center text-navy-700 relative transition-colors; }
      .avatar-btn:hover { @apply bg-teal-tint text-teal-600; }
      .avatar-btn .ic { @apply w-5 h-5; }
      .avatar-dot { @apply absolute -top-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-lime-500 border-2 border-surface; }

      .topbar-logout { @apply w-10 h-10 rounded-full bg-[#fef2f2] text-[#dc2626] flex items-center justify-center transition-colors; }
      .topbar-logout:hover { @apply bg-[#dc2626] text-white; }
      .topbar-logout .ic { @apply w-[19px] h-[19px]; }

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
        from { opacity: 0; transform: scale(0.95) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
      }
      .logout-modal-icon { @apply w-14 h-14 rounded-full bg-[#fef2f2] text-[#dc2626] flex items-center justify-center mx-auto mb-4; }
      .logout-modal-icon .ic { @apply w-[26px] h-[26px]; }
      .logout-modal-box h3 { @apply font-display text-lg font-bold text-ink-900 mb-2 mt-0; }
      .logout-modal-box p { @apply text-[13px] text-ink-600 leading-[1.6] mb-[22px] mt-0; }
      .logout-modal-actions { @apply flex gap-2.5; }
      .btn-logout-cancel {
        @apply flex-1 rounded-[13px] border border-border bg-bg text-ink-900 font-bold text-[13.5px] cursor-pointer transition-colors;
        padding: 12px 0;
      }
      .btn-logout-cancel:hover { @apply bg-surface-muted; }
      .btn-logout-confirm {
        @apply flex-1 rounded-[13px] border-none bg-[#dc2626] text-white font-extrabold text-[13.5px] cursor-pointer transition-[filter];
        padding: 12px 0;
      }
      .btn-logout-confirm:hover { filter: brightness(1.1); }

      .content { @apply flex-1 w-full max-w-[1180px] mx-auto; padding: clamp(16px, 4vw, 40px) clamp(16px, 4vw, 40px) calc(var(--bottomnav-h) + 28px); }

      /* ============ HERO ============ */
      .hero { @apply relative overflow-hidden bg-surface-muted rounded-[28px]; padding: clamp(20px, 5vw, 38px) clamp(18px, 5vw, 38px) clamp(20px, 4vw, 32px); }
      .hero-mosque { @apply absolute left-0 right-0 bottom-0 w-full h-auto opacity-[0.16] pointer-events-none; max-height: 78%; }
      .hero-eyebrow { @apply text-[13px] font-semibold text-ink-600 mb-1 relative z-[1]; }
      .hero-sub { @apply text-[14.5px] text-ink-600 mb-1.5 relative z-[1]; }
      .hero-title { @apply font-display font-bold text-navy-900 leading-[1.18] m-0 relative z-[1]; font-size: clamp(22px, 3.6vw + 14px, 32px); max-width: min(420px, 80%); }

      .progress-block { @apply mt-[22px] relative z-[1]; }
      .progress-row { @apply flex items-baseline justify-between mb-2.5; }
      .progress-label { @apply text-[13.5px] font-bold text-navy-900; }
      .progress-pct { @apply text-[13.5px] font-extrabold text-teal-600; }
      .progress-track { @apply h-[13px] rounded-full bg-white/75 border border-navy-900/[0.08] overflow-hidden; }
      .progress-fill { @apply h-full rounded-full; background: linear-gradient(90deg, var(--navy-700), var(--teal-500)); }

      /* ============ SECTION HEADERS ============ */
      .section { @apply mt-[30px]; }
      .section-head { @apply flex items-baseline justify-between mb-3.5; }
      .section-title { @apply font-display text-[17px] font-bold text-navy-900 m-0; }
      .section-link { @apply flex items-center gap-1 text-[12.5px] font-bold text-teal-600; }
      .section-link .ic { @apply w-3.5 h-3.5; }

      /* ============ MENU GRID ============ */
      .menu-grid { @apply grid; grid-template-columns: repeat(auto-fit, minmax(96px, 1fr)); gap: clamp(8px, 2.4vw, 14px); }
      .menu-card { @apply bg-surface border border-border rounded-[18px] flex flex-col items-center text-center gap-2.5 min-w-0 transition-all; padding: clamp(13px, 2.4vw, 18px) 8px clamp(12px, 2vw, 15px); }
      .menu-card:hover { @apply -translate-y-[3px] shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] border-transparent; }
      .menu-chip { @apply w-[46px] h-[46px] rounded-2xl flex items-center justify-center; }
      .menu-chip .ic { @apply w-[23px] h-[23px]; }
      .chip-navy { @apply bg-navy-tint text-navy-700; }
      .chip-teal { @apply bg-teal-tint text-teal-600; }
      .chip-lime { background: var(--lime-tint); color: #7c9426; }

      .menu-label { @apply text-[12.5px] font-bold text-ink-900 leading-[1.25]; }
      .menu-desc { @apply hidden text-[11.5px] text-ink-400 leading-[1.3]; }

      /* ============ SCHEDULE ============ */
      .schedule-card { @apply flex items-center gap-3.5 bg-surface border border-border rounded-[18px] p-[15px] transition-all; }
      .schedule-card:hover { @apply shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] border-transparent; }
      .schedule-icon { @apply w-[50px] h-[50px] rounded-2xl flex-shrink-0 bg-navy-900 text-white flex items-center justify-center; }
      .schedule-icon .ic { @apply w-6 h-6; }
      .schedule-info { @apply flex-1 min-w-0; }
      .schedule-title { @apply text-[14.5px] font-bold text-ink-900 mb-[3px] mt-0; }
      .schedule-meta { @apply text-[12.5px] text-ink-600 m-0 flex flex-wrap gap-1 gap-x-2.5; }
      .schedule-go { @apply text-ink-400 flex-shrink-0; }
      .schedule-go .ic { @apply w-[18px] h-[18px]; }

      /* ============ ASIDE (desktop only) ============ */
      .aside-col { @apply hidden; }
      .info-card { @apply mt-4 bg-surface border border-border rounded-[18px] p-[18px]; }
      .info-card h4 { @apply font-display text-[14.5px] mb-2 mt-0 text-navy-900; }
      .info-card p { @apply text-[12.5px] text-ink-600 leading-[1.55] m-0; }

      /* ============ BOTTOM NAV (mobile) ============ */
      .bottom-nav { @apply fixed bottom-0 left-0 right-0 bg-surface border-t border-border flex items-center justify-around z-30; height: var(--bottomnav-h); padding: 0 6px; padding-bottom: env(safe-area-inset-bottom); }
      .bottom-nav a { @apply flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1; padding: 6px 0; }
      .bottom-nav a .ic { @apply w-[22px] h-[22px]; }
      .bottom-nav a.active { @apply text-navy-900; }
      .bottom-nav a.home { @apply flex-none text-white bg-navy-900 w-[54px] h-[54px] rounded-full shadow-[0_10px_24px_rgba(21,33,89,0.16)] justify-center; margin-top: -30px; }
      .bottom-nav a.home .ic { @apply w-6 h-6; }
      .bottom-nav a.home span { @apply hidden; }

      /* ============ RESPONSIVE: SHORT / LANDSCAPE PHONES ============ */
      @media (max-width: 767px) and (max-height: 480px) {
        .bottom-nav { @apply h-[58px]; }
        .bottom-nav a.home { @apply w-11 h-11; margin-top: -20px; }
        .bottom-nav a span { @apply text-[9px]; }
        .content { padding-top: 12px; padding-bottom: 74px; }
        .hero { padding-top: 16px; padding-bottom: 14px; }
        .section { @apply mt-[18px]; }
      }

      /* ============ RESPONSIVE: TABLET ============ */
      @media (min-width: 768px) {
        .sidebar { @apply flex; }
        .bottom-nav { @apply hidden; }
        .content { padding-bottom: clamp(28px, 4vw, 48px); }
        .topbar-title { @apply block; }
        .topbar-logout { @apply hidden; }
      }

      /* ============ RESPONSIVE: DESKTOP / LAPTOP ============ */
      @media (min-width: 1100px) {
        .sidebar { width: var(--sidebar-w-desktop); padding: 26px 0 22px; }
        .sidebar-brand { @apply justify-start; padding: 0 22px 26px; }
        .sidebar-brand .brand-text { @apply block; }
        .sidebar-nav { @apply px-4 py-1.5; }
        .sidebar-nav a { @apply justify-start; padding: 12px 14px; }
        .sidebar-nav a .label { @apply block; }
        .sidebar-login { @apply justify-start; margin: 14px 16px 0; padding: 13px 14px; }
        .sidebar-login .label { @apply block; }

        .topbar-brand { @apply hidden; }
        .content { @apply grid items-start; grid-template-columns: 1fr 320px; gap: 28px; }
        .content > .main-col { grid-column: 1; }
        .aside-col { @apply block sticky; grid-column: 2; top: 96px; }

        .hero-title { max-width: min(320px, 75%); }

        .menu-grid { grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); @apply gap-4; }
        .menu-card { @apply items-start text-left; padding: 22px 20px; }
        .menu-desc { @apply block; }
        .menu-chip { @apply w-[50px] h-[50px]; }
      }
  </style>

  @stack('styles')
</head>

<body>
  <div class="app">
    @include('layouts.mentor.sidebar')

    <div class="main">
      @include('layouts.mentor.header')

      <div class="content">
        <div class="main-col">
          @yield('content')
        </div>

        @hasSection('aside')
          <div class="aside-col">
            @yield('aside')
          </div>
        @endif
      </div>
    </div>
  </div>

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

  <form method="POST" action="{{ route('logout') }}" id="logoutForm" class="hidden">
    @csrf
  </form>

  <script>
    // ======================================================================
    // ►► KONFIRMASI LOGOUT (dipakai di semua halaman yang extends layout ini)
    // ======================================================================
    $(function () {
      const $logoutModal = $("#logoutModal");

      function bukaModalLogout(e) {
        e.preventDefault();
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
      $logoutModal.on("click", function (e) {
        if (e.target === this) $logoutModal.removeClass("open");
      });
    });
  </script>

  @stack('scripts')
</body>

</html>
