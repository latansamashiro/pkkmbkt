<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Evaluasi | PKKMB-KT UNILAM 2026</title>
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
        padding: clamp(40px, 7vw, 64px) clamp(16px, 5vw, 48px);
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
        gap: 32px;
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
        @apply font-display font-bold text-white leading-[1.2] mb-3 mt-0;
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
        padding: 20px 28px;
        backdrop-filter: blur(12px);
      }
      .hero-stat {
        @apply text-center;
        padding: 0 20px;
        border-right: 1px solid rgba(255, 255, 255, 0.12);
      }
      .hero-stat:last-child {
        @apply border-r-0;
      }
      .hero-stat-val {
        @apply font-display text-[28px] font-bold text-lime-500 leading-none;
      }
      .hero-stat-lbl {
        @apply font-semibold mt-1 tracking-[0.04em];
        font-size: 10px;
        color: rgba(255, 255, 255, 0.55);
      }

      /* ============ MAIN CONTENT ============ */
      .content-wrap {
        @apply max-w-[1200px] mx-auto;
        padding: 40px clamp(16px, 5vw, 48px);
        padding-bottom: calc(var(--bottomnav-h) + 28px);
      }
      @media (min-width: 768px) {
        .content-wrap {
          padding-bottom: 40px;
        }
      }

      /* ============ SECTION HEADING ============ */
      .section-head {
        @apply flex items-center gap-2.5 mb-5;
      }
      .section-head-bar {
        @apply w-1 rounded-full;
        height: 22px;
        background: linear-gradient(
          to bottom,
          var(--teal-500),
          var(--navy-700)
        );
      }
      .section-head h2 {
        @apply font-display text-lg font-bold text-ink-900 m-0;
      }
      .section-head .count {
        @apply text-[11px] font-bold text-ink-400 bg-bg border border-border rounded-full ml-1;
        padding: 3px 10px;
      }

      /* ============ KARTU KUIS ============ */
      .quiz-grid {
        @apply grid gap-4;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      }
      .quiz-card {
        @apply bg-surface rounded-[18px] border border-border overflow-hidden shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] flex flex-col transition-all;
      }
      .quiz-card:hover {
        @apply -translate-y-[3px] shadow-[0_10px_24px_rgba(21,33,89,0.16)];
      }
      .quiz-thumb {
        @apply relative overflow-hidden flex items-center justify-center;
        height: 120px;
      }
      .quiz-thumb-overlay {
        @apply absolute inset-0;
        background: linear-gradient(
          to top,
          rgba(21, 33, 89, 0.45) 0%,
          transparent 60%
        );
      }
      .quiz-thumb-icon {
        @apply w-[46px] h-[46px] opacity-95 relative z-[1];
        stroke: #fff;
        fill: none;
        stroke-width: 1.6;
      }
      .quiz-badge-count {
        @apply absolute text-white text-[10px] font-bold rounded-md z-[1];
        bottom: 8px;
        right: 10px;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(6px);
        padding: 3px 8px;
      }
      .quiz-body {
        @apply flex flex-col flex-1 gap-2.5;
        padding: 14px 16px 16px;
      }
      .quiz-title {
        @apply text-sm font-bold text-ink-900 leading-[1.4];
      }
      .quiz-desc {
        @apply text-[11.5px] text-ink-600 leading-[1.5] overflow-hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
      }
      .quiz-meta-row {
        @apply flex gap-3.5 text-[11px] font-semibold text-ink-400;
      }
      .quiz-meta-row span {
        @apply inline-flex items-center gap-1;
      }
      .quiz-meta-row svg {
        @apply w-[13px] h-[13px];
        stroke: var(--ink-400);
        fill: none;
        stroke-width: 1.8;
      }
      .quiz-status {
        @apply inline-flex items-center gap-1.5 text-[10.5px] font-extrabold rounded-full;
        width: fit-content;
        padding: 3px 10px;
      }
      .quiz-status.belum {
        @apply bg-bg text-ink-400 border border-border;
      }
      .quiz-status.lulus {
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
      }
      .quiz-status.gagal {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
      }
      .btn-mulai {
        @apply mt-auto block w-full text-center rounded-[13px] text-[12.5px] font-bold bg-navy-tint text-navy-900 border-none cursor-pointer transition-colors;
        padding: 10px 0;
      }
      .btn-mulai:hover {
        @apply bg-navy-900 text-white;
      }

      /* ============ MODE KUIS ============ */
      .quiz-runner {
        @apply fixed inset-0 z-[90] hidden flex-col overflow-y-auto [&.open]:flex;
        background: linear-gradient(180deg, #eef1fb 0%, #f5f3ec 100%);
      }
      .quiz-runner::before {
        content: "";
        @apply fixed rounded-full pointer-events-none z-0;
        width: 380px;
        height: 380px;
        background: rgba(22, 160, 161, 0.08);
        top: -140px;
        right: -100px;
      }
      .quiz-runner::after {
        content: "";
        @apply fixed rounded-full pointer-events-none z-0;
        width: 300px;
        height: 300px;
        background: rgba(169, 199, 59, 0.1);
        bottom: -100px;
        left: -80px;
      }

      .runner-topbar {
        @apply sticky top-0 flex items-center gap-4 z-[5];
        background: linear-gradient(120deg, var(--navy-900), var(--navy-700));
        padding: 14px clamp(16px, 5vw, 48px);
        box-shadow: 0 4px 18px rgba(21, 33, 89, 0.18);
      }
      .runner-exit {
        @apply border-none text-white w-[34px] h-[34px] rounded-full text-lg cursor-pointer flex-shrink-0 flex items-center justify-center transition-all;
        background: rgba(255, 255, 255, 0.12);
      }
      .runner-exit:hover {
        @apply rotate-90;
        background: rgba(255, 255, 255, 0.25);
      }
      .runner-progress-track {
        @apply flex-1 h-2 rounded-full overflow-hidden;
        background: rgba(255, 255, 255, 0.15);
      }
      .runner-progress-fill {
        @apply h-full rounded-full;
        width: 0%;
        background: linear-gradient(90deg, var(--teal-500), var(--lime-500));
        transition: width 0.35s ease;
        box-shadow: 0 0 10px rgba(169, 199, 59, 0.6);
      }
      .runner-qcount {
        @apply text-xs font-extrabold text-white whitespace-nowrap flex-shrink-0 rounded-full;
        background: rgba(255, 255, 255, 0.1);
        padding: 5px 12px;
      }

      .runner-timer {
        @apply flex-shrink-0 relative w-[46px] h-[46px] flex items-center justify-center transition-transform;
      }
      .runner-timer svg {
        @apply absolute inset-0;
        transform: rotate(-90deg);
      }
      .runner-timer-num {
        @apply relative z-[1] text-[15px] font-extrabold text-white font-display;
      }
      .runner-timer.danger {
        @apply scale-110;
      }
      .runner-timer.danger .runner-timer-num {
        color: #ff6b6b;
        animation: blink 0.6s infinite;
      }
      @keyframes blink {
        50% {
          opacity: 0.35;
        }
      }

      .runner-body {
        @apply flex-1 max-w-[760px] w-full mx-auto flex flex-col relative z-[1];
        padding: 36px clamp(16px, 5vw, 32px) 48px;
      }
      .runner-question-card {
        @apply bg-surface rounded-[28px] shadow-[0_10px_24px_rgba(21,33,89,0.16)] mb-6;
        padding: clamp(24px, 4vw, 40px);
        animation: cardIn 0.4s ease;
      }
      @keyframes cardIn {
        from {
          opacity: 0;
          transform: translateY(10px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      .runner-kategori-tag {
        @apply inline-flex items-center gap-1.5 text-[11px] font-extrabold tracking-[0.06em] uppercase text-teal-600 bg-teal-tint rounded-full mx-auto mb-5;
        width: fit-content;
        padding: 5px 14px;
      }
      .runner-question {
        @apply font-display font-bold text-ink-900 leading-[1.45] text-center m-0;
        font-size: clamp(19px, 3.2vw, 26px);
      }
      .runner-options {
        @apply grid gap-3;
        grid-template-columns: 1fr;
      }
      @media (min-width: 640px) {
        .runner-options {
          grid-template-columns: 1fr 1fr;
        }
      }
      .runner-option {
        @apply flex items-center gap-3.5 rounded-[18px] bg-surface cursor-pointer text-left font-sans shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] relative;
        padding: 17px 18px;
        border: 2px solid var(--border);
        transition: border-color 0.16s, background 0.16s, transform 0.12s, box-shadow 0.16s;
      }
      .runner-option:hover:not(:disabled) {
        @apply border-teal-500 -translate-y-[3px] shadow-[0_10px_24px_rgba(21,33,89,0.16)];
      }
      .runner-option:disabled {
        @apply cursor-default;
      }
      .runner-option-letter {
        @apply w-8 h-8 rounded-[9px] bg-navy-tint text-navy-900 font-extrabold text-[13px] flex items-center justify-center flex-shrink-0 transition-colors;
      }
      .runner-option-text {
        @apply text-[14.5px] font-semibold text-ink-900 flex-1;
      }
      .runner-option-check {
        @apply w-[22px] h-[22px] rounded-full bg-teal-500 text-white flex-shrink-0 flex items-center justify-center opacity-0;
        transform: scale(0.5);
        transition: opacity 0.16s, transform 0.16s;
      }
      .runner-option-check svg {
        @apply w-3 h-3;
      }
      .runner-option.selected {
        @apply border-teal-500 bg-teal-tint;
        box-shadow: 0 0 0 3px rgba(22, 160, 161, 0.14);
      }
      .runner-option.selected .runner-option-letter {
        @apply bg-teal-600 text-white;
      }
      .runner-option.selected .runner-option-check {
        @apply opacity-100;
        transform: scale(1);
      }

      .runner-next-wrap {
        @apply mt-7 text-center;
        min-height: 48px;
      }
      .btn-next {
        @apply hidden items-center gap-2 mx-auto text-white text-[13.5px] font-extrabold rounded-full border-none cursor-pointer shadow-[0_10px_24px_rgba(21,33,89,0.16)];
        background: linear-gradient(120deg, var(--navy-900), var(--navy-700));
        padding: 13px 40px;
        transition: filter 0.18s, transform 0.18s;
      }
      .btn-next.show {
        @apply inline-flex;
      }
      .btn-next:hover {
        @apply -translate-y-0.5;
        filter: brightness(1.15);
      }

      /* ============ LAYAR HASIL ============ */
      .runner-result {
        @apply hidden flex-1 max-w-[500px] w-full mx-auto text-center flex-col items-center justify-center relative z-[1];
        padding: 36px clamp(16px, 5vw, 32px) 48px;
      }
      .runner-result.show {
        @apply flex;
      }
      .result-card {
        @apply bg-surface rounded-[28px] shadow-[0_10px_24px_rgba(21,33,89,0.16)] w-full;
        padding: clamp(32px, 5vw, 48px) clamp(24px, 5vw, 40px);
        animation: cardIn 0.45s ease;
      }
      .result-score-ring {
        @apply relative w-[140px] h-[140px] mx-auto mb-5 flex items-center justify-center;
      }
      .result-score-ring svg {
        @apply absolute inset-0;
        transform: rotate(-90deg);
      }
      .result-score-val {
        @apply font-display text-[36px] font-bold text-navy-900 relative z-[1] leading-none;
      }
      .result-score-lbl {
        @apply text-[10px] text-ink-400 font-bold uppercase tracking-[0.05em] mt-0.5 relative z-[1];
      }
      .result-heading {
        @apply font-display text-[23px] font-bold text-ink-900;
        margin: 8px 0 6px;
      }
      .result-sub {
        @apply text-sm text-ink-600 font-semibold mb-2 mt-0;
      }
      .result-sub b {
        @apply text-teal-600 font-extrabold;
      }
      .result-status-pill {
        @apply inline-flex items-center gap-1.5 text-xs font-extrabold rounded-full;
        padding: 7px 18px;
        margin: 6px 0 26px;
      }
      .result-status-pill.lulus {
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
      }
      .result-status-pill.gagal {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
      }
      .result-actions {
        @apply flex gap-3 flex-wrap justify-center;
      }
      .btn-ulang {
        @apply inline-flex items-center gap-2 bg-teal-tint text-teal-600 border-none rounded-full text-[13px] font-bold cursor-pointer;
        padding: 12px 24px;
        transition: background 0.18s, color 0.18s, transform 0.15s;
      }
      .btn-ulang:hover {
        @apply -translate-y-0.5 bg-teal-600 text-white;
      }
      .btn-selesai {
        @apply inline-flex items-center gap-2 text-white border-none rounded-full text-[13px] font-extrabold cursor-pointer shadow-[0_10px_24px_rgba(21,33,89,0.16)];
        background: linear-gradient(120deg, var(--navy-900), var(--navy-700));
        padding: 12px 28px;
        transition: filter 0.18s, transform 0.15s;
      }
      .btn-selesai:hover {
        @apply -translate-y-0.5;
        filter: brightness(1.15);
      }
      .btn-selesai:disabled {
        @apply bg-border text-ink-400 shadow-none cursor-not-allowed;
        background-image: none;
        transform: none;
      }
      .result-note {
        @apply text-xs text-ink-400 leading-[1.5];
        margin-top: 16px;
        max-width: 360px;
      }
      .result-note.gagal {
        @apply font-semibold;
        color: #b91c1c;
      }

      /* ============ FOOTER ============ */
      .footer {
        @apply flex flex-wrap justify-between items-center gap-3.5 mt-14;
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
    <a
      href="{{ route('dashboard') }}"
      class="navbar-brand"
      aria-label="PKKMB-KT UNILAM Beranda">
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
          Evaluasi Materi
        </div>
        <h1>Kuis Evaluasi<br />PKKMB-KT UNILAM 2026</h1>
        <p class="hero-info-sub">
          Pilih kategori kuis yang ingin kamu kerjakan. Soal dikerjakan satu
          per satu dengan batas waktu di tiap soal. Skor minimal 75 untuk
          lulus.
        </p>
      </div>
      <div class="hero-stats">
        <div class="hero-stat">
          <div class="hero-stat-val" id="statTotalKuis">0</div>
          <div class="hero-stat-lbl">Total Kuis</div>
        </div>
        <div class="hero-stat">
          <div class="hero-stat-val" id="statTotalSoal">0</div>
          <div class="hero-stat-lbl">Total Soal</div>
        </div>
        <div class="hero-stat">
          <div class="hero-stat-val" id="statLulus">0</div>
          <div class="hero-stat-lbl">Lulus</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ MAIN — DAFTAR KARTU KUIS ============ -->
  <div class="content-wrap" id="pageDaftar">
    <div class="section-head">
      <div class="section-head-bar"></div>
      <h2>Pilih Kuis Evaluasi</h2>
      <span class="count" id="kuisCount">0</span>
    </div>
    <div class="quiz-grid" id="quizGridContainer"></div>
  </div>

  <!-- ============ MODE KUIS (layar ngerjain soal) ============ -->
  <section class="quiz-runner" id="quizRunner">
    <!-- Bar atas -->
    <div class="runner-topbar">
      <button class="runner-exit" id="btnRunnerExit" aria-label="Keluar">
        ×
      </button>
      <div class="runner-progress-track">
        <div class="runner-progress-fill" id="runnerProgressFill"></div>
      </div>
      <div class="runner-qcount" id="runnerQCount">1 / 10</div>
      <div class="runner-timer" id="runnerTimer">
        <svg viewBox="0 0 36 36" width="44" height="44">
          <path
            stroke="rgba(255,255,255,0.18)"
            stroke-width="3.5"
            fill="none"
            d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
          <path
            id="runnerTimerArc"
            stroke="var(--lime-500)"
            stroke-width="3.5"
            stroke-linecap="round"
            fill="none"
            stroke-dasharray="100, 100"
            d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
        </svg>
        <span class="runner-timer-num" id="runnerTimerNum">30</span>
      </div>
    </div>

    <!-- Isi soal -->
    <div class="runner-body" id="runnerBody">
      <div class="runner-question-card" id="runnerQuestionCard">
        <div class="runner-kategori-tag" id="runnerKategoriTag">Kategori</div>
        <h2 class="runner-question" id="runnerQuestion">Pertanyaan…</h2>
      </div>
      <div class="runner-options" id="runnerOptions"></div>
      <div class="runner-next-wrap">
        <button class="btn-next" id="btnNext">
          Soal Berikutnya
          <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14M13 5l7 7-7 7" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Layar hasil -->
    <div class="runner-result" id="runnerResult">
      <div class="result-card">
        <div class="result-score-ring">
          <svg viewBox="0 0 36 36" width="140" height="140">
            <path
              stroke="#e8ebf6"
              stroke-width="3"
              fill="none"
              d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
            <path
              id="resultScoreArc"
              stroke="url(#rg)"
              stroke-width="3"
              stroke-linecap="round"
              fill="none"
              stroke-dasharray="0, 100"
              d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
            <defs>
              <linearGradient id="rg" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" stop-color="#16a0a1" />
                <stop offset="100%" stop-color="#a9c73b" />
              </linearGradient>
            </defs>
          </svg>
          <div style="text-align: center">
            <div class="result-score-val" id="resultScoreVal">0</div>
            <div class="result-score-lbl">Skor</div>
          </div>
        </div>
        <h2 class="result-heading" id="resultHeading">Selesai!</h2>
        <p class="result-sub" id="resultSub"></p>
        <div id="resultStatusWrap"></div>
        <div class="result-actions">
          <button class="btn-ulang" id="btnUlangKuis">
            ↻ Ulangi Kuis
          </button>
          <button class="btn-selesai" id="btnSelesai">
            Kirim Hasil
          </button>
        </div>
        <p class="result-note" id="resultNote"></p>
      </div>
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
      /* =====================================================================
       *  ⚙️  PENGATURAN UTAMA — UBAH DI SINI SAJA
       * ===================================================================== */

      const WAKTU_PER_SOAL = 30; // <<< GANTI ANGKA DETIK DI SINI (contoh: 30, 35, 40)
      const SKOR_LULUS = 75; // <<< GANTI BATAS KELULUSAN DI SINI

      /* =====================================================================
       *  📚  DATA KUIS — ISI SOAL DI SINI
       * ===================================================================== */
      const DAFTAR_KUIS = @json($daftarKuis);
      const STATUS_AWAL = @json($statusAwal);
      const CSRF_TOKEN_EVAL = @json(csrf_token());
      /* =====================================================================
       *  🔧  MULAI DARI SINI KE BAWAH ADALAH MESIN PROGRAM.
       * ===================================================================== */

      const statusKuis = {};
      DAFTAR_KUIS.forEach((k) => {
        statusKuis[k.id] = STATUS_AWAL[k.id]
          ? { skorTerbaik: STATUS_AWAL[k.id].skorTerbaik, sudahKirim: STATUS_AWAL[k.id].sudahKirim }
          : { skorTerbaik: null, sudahKirim: false };
      });

      let kuisAktif = null;
      let indexSoal = 0;
      let jawabanUser = [];
      let timerInterval = null;
      let sisaWaktu = WAKTU_PER_SOAL;

      const $quizGrid = $("#quizGridContainer");
      const $runner = $("#quizRunner");
      const $runnerBody = $("#runnerBody");
      const $runnerResult = $("#runnerResult");

      /* ---------- RENDER KARTU KUIS DI HALAMAN DEPAN ---------- */
      function renderKartuKuis() {
        const html = DAFTAR_KUIS.map((k) => {
          const st = statusKuis[k.id];
          let statusHtml = `<span class="quiz-status belum">Belum dikerjakan</span>`;
          if (st.skorTerbaik !== null) {
            if (st.skorTerbaik >= SKOR_LULUS) {
              statusHtml = `<span class="quiz-status lulus">✓ Lulus · Skor ${st.skorTerbaik}</span>`;
            } else {
              statusHtml = `<span class="quiz-status gagal">✕ Belum lulus · Skor ${st.skorTerbaik}</span>`;
            }
          }
          return `
            <div class="quiz-card">
              <div class="quiz-thumb" style="background:${k.warna}">
                <div class="quiz-thumb-overlay"></div>
                <svg class="quiz-thumb-icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M9 11l2 2 4-4" />
                  <rect x="4" y="4" width="16" height="16" rx="3" />
                </svg>
                <span class="quiz-badge-count">${k.soal.length} soal</span>
              </div>
              <div class="quiz-body">
                <div class="quiz-title">${k.judul}</div>
                <div class="quiz-desc">${k.deskripsi}</div>
                <div class="quiz-meta-row">
                  <span>
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                    ${WAKTU_PER_SOAL} dtk/soal
                  </span>
                  <span>
                    <svg viewBox="0 0 24 24"><path d="M9 11l2 2 4-4"/><circle cx="12" cy="12" r="9"/></svg>
                    Min. ${SKOR_LULUS}
                  </span>
                </div>
                ${statusHtml}
                <button class="btn-mulai" data-kuis-id="${k.id}">Mulai Kuis</button>
              </div>
            </div>
          `;
        }).join("");

        $quizGrid.html(html);
        $quizGrid.find(".btn-mulai").on("click", function() {
          mulaiKuis($(this).data("kuis-id"));
        });

        $("#kuisCount").text(DAFTAR_KUIS.length);
      }

      /* ---------- STATISTIK DI HERO ---------- */
      function renderStatHero() {
        const totalSoal = DAFTAR_KUIS.reduce((a, k) => a + k.soal.length, 0);
        const totalLulus = Object.values(statusKuis).filter(
          (s) => s.skorTerbaik !== null && s.skorTerbaik >= SKOR_LULUS,
        ).length;
        $("#statTotalKuis").text(DAFTAR_KUIS.length);
        $("#statTotalSoal").text(totalSoal);
        $("#statLulus").text(totalLulus);
      }

      /* ---------- MULAI MENGERJAKAN SEBUAH KUIS ---------- */
      function mulaiKuis(id) {
        // .data("kuis-id") otomatis dikonversi jQuery jadi angka kalau attribute-nya
        // cuma angka (mis. "3" -> 3), padahal k.id di DAFTAR_KUIS itu string -> String()
        // di sini biar perbandingannya selalu ketemu, gak peduli tipe aslinya.
        kuisAktif = DAFTAR_KUIS.find((k) => String(k.id) === String(id));
        if (!kuisAktif) return; // jaga-jaga kalau memang belum ada datanya sama sekali
        indexSoal = 0;
        jawabanUser = new Array(kuisAktif.soal.length).fill(null);

        $runner.addClass("open");
        $runnerBody.css("display", "flex");
        $runnerResult.removeClass("show");
        $("#runnerKategoriTag").text(kuisAktif.judul);
        $("body").css("overflow", "hidden");

        tampilkanSoal();
      }

      /* ---------- TAMPILKAN SATU SOAL ---------- */
      function tampilkanSoal() {
        const soal = kuisAktif.soal[indexSoal];
        const total = kuisAktif.soal.length;

        $("#runnerQCount").text(`${indexSoal + 1} / ${total}`);
        $("#runnerProgressFill").css("width", `${(indexSoal / total) * 100}%`);
        $("#runnerQuestion").text(soal.question);

        const huruf = ["A", "B", "C", "D", "E", "F"];
        const pilihanSebelumnya = jawabanUser[indexSoal];
        const html = soal.options
          .map((opt, i) => {
            const selected = pilihanSebelumnya === i ? "selected" : "";
            return `
              <button class="runner-option ${selected}" data-pilihan="${i}">
                <span class="runner-option-letter">${huruf[i]}</span>
                <span class="runner-option-text">${opt}</span>
                <span class="runner-option-check">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5" /></svg>
                </span>
              </button>
            `;
          })
          .join("");

        const $runnerOptions = $("#runnerOptions");
        $runnerOptions.html(html);
        $runnerOptions.find(".runner-option").on("click", function() {
          pilihJawaban(parseInt($(this).data("pilihan"), 10));
        });

        const $questionCard = $("#runnerQuestionCard");
        $questionCard.css("animation", "none");
        void $questionCard[0].offsetWidth;
        $questionCard.css("animation", "");

        const $btnNext = $("#btnNext");
        $btnNext.toggleClass("show", pilihanSebelumnya !== null);

        mulaiTimer();
      }

      /* ---------- TIMER PER SOAL ---------- */
      function mulaiTimer() {
        clearInterval(timerInterval);
        sisaWaktu = WAKTU_PER_SOAL;
        updateTampilanTimer();

        timerInterval = setInterval(() => {
          sisaWaktu--;
          updateTampilanTimer();

          if (sisaWaktu <= 0) {
            clearInterval(timerInterval);
            waktuHabis();
          }
        }, 1000);
      }

      function updateTampilanTimer() {
        const $num = $("#runnerTimerNum");
        const $arc = $("#runnerTimerArc");
        const $wrap = $("#runnerTimer");
        $num.text(sisaWaktu);
        const persen = (sisaWaktu / WAKTU_PER_SOAL) * 100;
        $arc.attr("stroke-dasharray", `${persen}, 100`);
        $wrap.toggleClass("danger", sisaWaktu <= 5);
      }

      /* ---------- SAAT WAKTU HABIS ---------- */
      function waktuHabis() {
        soalBerikutnya();
      }

      /* ---------- SAAT USER MEMILIH JAWABAN ---------- */
      function pilihJawaban(pilihan) {
        jawabanUser[indexSoal] = pilihan;

        $(".runner-option").each(function(i) {
          $(this).toggleClass("selected", i === pilihan);
        });

        $("#btnNext").addClass("show");
      }

      /* ---------- LANJUT KE SOAL BERIKUTNYA / SELESAI ---------- */
      function soalBerikutnya() {
        clearInterval(timerInterval);
        indexSoal++;
        if (indexSoal < kuisAktif.soal.length) {
          tampilkanSoal();
          $runner[0].scrollTo({
            top: 0,
            behavior: "smooth"
          });
        } else {
          tampilkanHasil();
        }
      }

      /* ---------- TAMPILKAN HASIL AKHIR ---------- */
      function tampilkanHasil() {
        clearInterval(timerInterval);
        const total = kuisAktif.soal.length;

        let jumlahBenar = 0;
        kuisAktif.soal.forEach((soal, i) => {
          if (jawabanUser[i] === soal.correctAnswer) jumlahBenar++;
        });

        const skor = Math.round((jumlahBenar / total) * 100);
        const lulus = skor >= SKOR_LULUS;

        const st = statusKuis[kuisAktif.id];
        if (st.skorTerbaik === null || skor > st.skorTerbaik) {
          st.skorTerbaik = skor;
        }

        $("#runnerProgressFill").css("width", "100%");

        $("#resultScoreVal").text(skor);
        $("#resultScoreArc").attr("stroke-dasharray", `${skor}, 100`);
        $("#resultHeading").text(lulus ? "Selamat, Kamu Lulus! 🎉" : "Belum Lulus 😔");
        $("#resultSub").html(`Jawaban benar <b>${jumlahBenar}</b> dari <b>${total}</b> soal.`);

        $("#resultStatusWrap").html(
          lulus ?
          `<span class="result-status-pill lulus">✓ Lulus (minimal ${SKOR_LULUS})</span>` :
          `<span class="result-status-pill gagal">✕ Belum Lulus (minimal ${SKOR_LULUS})</span>`,
        );

        const $btnSelesai = $("#btnSelesai");
        const $note = $("#resultNote");
        $btnSelesai.prop("disabled", !lulus);
        if (lulus) {
          $note.attr("class", "result-note");
          $note.text(
            "Skormu sudah memenuhi syarat. Kamu tetap boleh mengulang untuk skor lebih tinggi sebelum mengirim.",
          );
        } else {
          $note.attr("class", "result-note gagal");
          $note.text(`Skormu masih di bawah ${SKOR_LULUS}. Tombol "Kirim Hasil" terkunci — silakan ulangi kuis.`);
        }

        $runnerBody.css("display", "none");
        $runnerResult.addClass("show");
        $runner[0].scrollTo({
          top: 0,
          behavior: "smooth"
        });
      }

      /* ---------- ULANGI KUIS DARI AWAL ---------- */
      function ulangiKuis() {
        indexSoal = 0;
        jawabanUser = new Array(kuisAktif.soal.length).fill(null);
        $runnerResult.removeClass("show");
        $runnerBody.css("display", "flex");
        tampilkanSoal();
      }

      /* ---------- KIRIM HASIL (hanya bila lulus) ---------- */
      function selesaiKuis() {
        const $btn = $("#btnSelesai");
        $btn.prop("disabled", true);

        $.ajax({
          url: `{{ url('mahasiswa/evaluasi') }}/${kuisAktif.id}/submit`,
          method: "POST",
          contentType: "application/json",
          headers: { "X-CSRF-TOKEN": CSRF_TOKEN_EVAL, "Accept": "application/json" },
          data: JSON.stringify({ jawaban: jawabanUser }),
        }).done(function (result) {
          statusKuis[kuisAktif.id].sudahKirim = true;
          statusKuis[kuisAktif.id].skorTerbaik = result.skor;
          alert(`Hasil kuis "${kuisAktif.judul}" berhasil dikirim! Skor tersimpan: ${result.skor}.`);
          keluarKuis();
        }).fail(function () {
          alert("Gagal mengirim hasil kuis. Coba lagi.");
          $btn.prop("disabled", false);
        });
      }

      /* ---------- KELUAR DARI MODE KUIS ---------- */
      function keluarKuis() {
        clearInterval(timerInterval);
        $runner.removeClass("open");
        $("body").css("overflow", "");
        renderKartuKuis();
        renderStatHero();
      }

      $("#btnRunnerExit").on("click", keluarKuis);
      $("#btnNext").on("click", soalBerikutnya);
      $("#btnUlangKuis").on("click", ulangiKuis);
      $("#btnSelesai").on("click", selesaiKuis);

      /* ---------- JALANKAN SAAT HALAMAN DIBUKA ---------- */
      renderKartuKuis();
      renderStatHero();

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