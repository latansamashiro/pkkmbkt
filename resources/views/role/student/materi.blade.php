<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Materi PKKMB-KT UNILAM 2026</title>
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
        @apply font-sans text-ink-900 m-0 p-0 antialiased;
      }
      .font-display {
        @apply font-display;
      }
      .text-navy-900 {
        @apply text-navy-900;
      }
      .text-navy-700 {
        @apply text-navy-700;
      }
      .text-teal-600 {
        @apply text-teal-600;
      }
      .bg-navy-900 {
        @apply bg-navy-900;
      }
      .bg-teal-600 {
        @apply bg-teal-600;
      }
      .bg-olive-600 {
        @apply bg-lime-500;
      }
      .border-teal-600 {
        @apply border-teal-600;
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
        padding: clamp(48px, 8vw, 80px) clamp(16px, 5vw, 48px);
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
          rgba(21, 33, 89, 0.92) 0%,
          rgba(15, 138, 140, 0.8) 100%
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
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(0.8); }
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

      /* ============ FILTER BAR ============ */
      .filter-bar {
        @apply bg-surface rounded-[18px] border border-border mb-8 shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] flex flex-wrap items-center justify-between;
        padding: 20px 24px;
        gap: 16px;
      }
      .search-wrap {
        @apply relative flex-1;
        min-width: 220px;
        max-width: 420px;
      }
      .search-wrap svg {
        @apply absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none;
        stroke: var(--ink-400);
        fill: none;
      }
      .search-wrap input {
        @apply w-full bg-bg rounded-full font-sans text-[13px] font-medium text-ink-900 outline-none;
        border: 1.5px solid var(--border);
        padding: 10px 16px 10px 42px;
        transition: border-color 0.2s, box-shadow 0.2s;
      }
      .search-wrap input:focus {
        @apply border-teal-500;
        box-shadow: 0 0 0 3px rgba(22, 160, 161, 0.12);
      }
      .count-badge {
        @apply text-[11.5px] font-bold text-ink-600 bg-bg border border-border rounded-full whitespace-nowrap;
        padding: 6px 16px;
      }
      .filter-chips {
        @apply flex gap-2 flex-wrap border-t border-border w-full;
        padding-top: 12px;
        margin-top: 4px;
      }
      .chip {
        @apply rounded-full text-xs font-bold cursor-pointer whitespace-nowrap transition-all;
        border: 1.5px solid var(--border);
        background: var(--bg);
        color: var(--ink-600);
        padding: 6px 16px;
      }
      .chip:hover {
        @apply border-teal-500 text-teal-600;
      }
      .chip.active {
        @apply bg-navy-900 border-navy-900 text-white;
      }

      /* ============ GRID LAYOUT ============ */
      .main-grid {
        @apply grid items-start;
        grid-template-columns: 1fr 300px;
        gap: 28px;
      }
      @media (max-width: 1024px) {
        .main-grid {
          grid-template-columns: 1fr;
        }
        .sidebar {
          @apply grid gap-4;
          grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        }
      }

      /* ============ SECTION HEADING ============ */
      .section-head {
        @apply flex items-center gap-2.5 mb-5;
      }
      .section-head-bar {
        @apply w-1 rounded-full;
        height: 22px;
      }
      .section-head h2 {
        @apply font-display text-lg font-bold text-ink-900 m-0;
      }
      .section-head .count {
        @apply text-[11px] font-bold text-ink-400 bg-bg border border-border rounded-full ml-1;
        padding: 3px 10px;
      }

      /* ============ VIDEO CARDS ============ */
      .video-grid {
        @apply grid gap-4 mb-10;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      }
      .video-card {
        @apply bg-surface rounded-[18px] border border-border overflow-hidden shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] flex flex-col transition-all;
      }
      .video-card:hover {
        @apply -translate-y-[3px] shadow-[0_10px_24px_rgba(21,33,89,0.16)];
      }
      .video-thumb {
        @apply relative overflow-hidden bg-navy-900;
        height: 130px;
      }
      .video-thumb img {
        @apply w-full h-full object-cover block;
      }
      .video-thumb-gradient {
        @apply w-full h-full;
      }
      .video-thumb-overlay {
        @apply absolute inset-0;
        background: linear-gradient(
          to top,
          rgba(21, 33, 89, 0.6) 0%,
          transparent 60%
        );
      }
      .video-duration {
        @apply absolute text-white text-[10px] font-bold rounded-md;
        bottom: 8px;
        right: 10px;
        background: rgba(0, 0, 0, 0.55);
        backdrop-filter: blur(6px);
        padding: 3px 8px;
      }
      .video-play-btn {
        @apply absolute w-9 h-9 rounded-full flex items-center justify-center;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(8px);
        transition: background 0.18s;
      }
      .video-card:hover .video-play-btn {
        @apply bg-lime-500;
      }
      .video-play-btn svg {
        @apply w-3.5 h-3.5 ml-0.5;
        fill: #fff;
      }
      .video-body {
        @apply flex flex-col flex-1 gap-2.5;
        padding: 14px 16px 16px;
      }
      .video-title {
        @apply text-[13px] font-bold text-ink-900 leading-[1.45] overflow-hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
      }
      .video-meta {
        @apply text-[11px] text-ink-400 font-semibold;
      }
      .video-meta span {
        @apply text-ink-600 font-bold;
      }
      .progress-wrap {
        @apply mt-auto;
      }
      .progress-labels {
        @apply flex justify-between text-[10px] font-bold text-ink-400 mb-1.5;
      }
      .progress-bar-bg {
        @apply h-[5px] bg-bg rounded-full overflow-hidden mb-2.5;
      }
      .progress-bar-fill {
        @apply h-full rounded-full;
        background: linear-gradient(90deg, var(--teal-500), var(--lime-500));
        transition: width 0.5s;
      }
      .progress-bar-fill.done {
        @apply bg-lime-500;
      }
      .btn-watch {
        @apply block w-full text-center rounded-[13px] text-xs font-bold bg-navy-tint text-navy-900 border-none cursor-pointer transition-colors;
        padding: 9px 0;
      }
      .btn-watch:hover {
        @apply bg-navy-900 text-white;
      }

      /* ============ EBOOK CARDS ============ */
      .ebook-grid {
        @apply grid gap-3.5;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
      }
      .ebook-card {
        @apply bg-surface rounded-[18px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] flex gap-3.5 items-start transition-all;
        padding: 18px;
      }
      .ebook-card:hover {
        @apply -translate-y-0.5 shadow-[0_10px_24px_rgba(21,33,89,0.16)];
      }
      .ebook-icon {
        @apply w-12 rounded-[10px] flex items-center justify-center flex-shrink-0;
        height: 56px;
        background: linear-gradient(135deg, var(--teal-600), var(--navy-700));
        box-shadow: 0 4px 12px rgba(15, 138, 140, 0.3);
      }
      .ebook-icon svg {
        @apply w-[22px] h-[22px] opacity-90;
        fill: #fff;
      }
      .ebook-body {
        @apply flex-1 min-w-0;
      }
      .ebook-title {
        @apply text-[13px] font-bold text-ink-900 leading-[1.4] mb-1 overflow-hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
      }
      .ebook-meta {
        @apply text-[10.5px] text-ink-400 font-semibold mb-2.5;
      }
      .btn-download {
        @apply block text-center rounded-[13px] text-[11.5px] font-bold bg-teal-tint text-teal-600 border-none cursor-pointer transition-colors w-full;
        padding: 8px 0;
      }
      .btn-download:hover {
        @apply bg-teal-600 text-white;
      }

      /* ============ EMPTY STATE ============ */
      .empty-state {
        @apply text-center bg-surface rounded-[18px] hidden;
        padding: 48px 24px;
        border: 1.5px dashed var(--border);
      }
      .empty-state p {
        @apply text-[13px] text-ink-400 font-semibold;
      }

      /* ============ SIDEBAR ============ */
      .sidebar {
        @apply sticky flex flex-col gap-4;
        top: 84px;
      }
      .sidebar-card {
        @apply bg-surface rounded-[18px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)];
        padding: 20px;
      }
      .sidebar-title {
        @apply text-[10.5px] font-extrabold tracking-[0.08em] uppercase text-ink-400 mb-3.5 mt-0;
      }
      .progress-ring-wrap {
        @apply relative w-[100px] h-[100px] mx-auto mb-4 flex items-center justify-center;
      }
      .progress-ring-wrap svg {
        @apply absolute inset-0;
        transform: rotate(-90deg);
      }
      .progress-ring-center {
        @apply text-center relative z-[1];
      }
      .progress-ring-val {
        @apply font-display text-2xl font-bold text-navy-900 leading-none;
      }
      .progress-ring-lbl {
        @apply text-ink-400 font-bold mt-0.5;
        font-size: 9.5px;
      }
      .sidebar-stats {
        @apply grid gap-2 border-t border-border text-center;
        grid-template-columns: 1fr 1fr 1fr;
        padding-top: 14px;
      }
      .sidebar-stat-val {
        @apply text-base font-extrabold;
      }
      .sidebar-stat-lbl {
        @apply text-ink-400 font-semibold;
        font-size: 9.5px;
      }
      .activity-item {
        @apply flex gap-2.5 items-start border-b border-border;
        padding-bottom: 12px;
        margin-bottom: 12px;
      }
      .activity-item:last-child {
        @apply pb-0 border-b-0 mb-0;
      }
      .activity-dot {
        @apply w-6 h-6 rounded-md flex items-center justify-center text-[10px] font-extrabold flex-shrink-0 mt-px;
      }
      .activity-dot.done {
        background: #f0fdf4;
        color: #16a34a;
        border: 1px solid #bbf7d0;
      }
      .activity-dot.progress {
        background: #fffbeb;
        color: #d97706;
        border: 1px solid #fde68a;
      }
      .activity-text {
        @apply text-xs font-bold text-ink-900 leading-[1.35];
      }
      .activity-sub {
        @apply text-[10px] text-ink-400 font-medium mt-0.5;
      }
      .download-card {
        @apply rounded-[18px] text-white relative overflow-hidden;
        background: linear-gradient(135deg, var(--navy-900), var(--navy-700));
        padding: 20px;
      }
      .download-card::before {
        content: "";
        @apply absolute rounded-full pointer-events-none;
        width: 120px;
        height: 120px;
        background: rgba(169, 199, 59, 0.1);
        top: -40px;
        right: -30px;
      }
      .download-card h3 {
        @apply font-display text-[15px] font-bold mb-2 mt-0 relative z-[1];
      }
      .download-card p {
        @apply text-xs leading-[1.6] relative z-[1];
        color: rgba(255, 255, 255, 0.65);
        margin: 0 0 14px;
      }
      .btn-drive {
        @apply flex items-center justify-center gap-2 w-full text-white text-[12.5px] font-bold cursor-pointer relative z-[1];
        padding: 10px 0;
        background: rgba(255, 255, 255, 0.1);
        border: 1.5px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-sm);
        transition: background 0.18s, border-color 0.18s;
      }
      .btn-drive:hover {
        background: rgba(255, 255, 255, 0.18);
        border-color: rgba(255, 255, 255, 0.4);
      }
      .btn-drive svg {
        @apply w-[15px] h-[15px];
        stroke: #fff;
        fill: none;
      }

      /* ============ MODAL ============ */
      .modal-backdrop {
        @apply fixed inset-0 z-[100] hidden items-center justify-center p-4 [&.open]:flex;
        background: rgba(21, 33, 89, 0.55);
        backdrop-filter: blur(6px);
      }
      .modal-box {
        @apply bg-surface rounded-[28px] max-w-[480px] w-full overflow-hidden shadow-[0_10px_24px_rgba(21,33,89,0.16)];
        animation: modal-in 0.22s ease;
      }
      @keyframes modal-in {
        from {
          opacity: 0;
          transform: scale(0.95) translateY(12px);
        }
        to {
          opacity: 1;
          transform: scale(1) translateY(0);
        }
      }
      .modal-header {
        @apply text-white relative;
        background: linear-gradient(135deg, var(--navy-900), var(--navy-600));
        padding: 24px;
      }
      .modal-close {
        @apply absolute w-8 h-8 rounded-full border-none text-white text-lg leading-none cursor-pointer flex items-center justify-center transition-colors;
        top: 14px;
        right: 14px;
        background: rgba(255, 255, 255, 0.12);
      }
      .modal-close:hover {
        background: rgba(255, 255, 255, 0.25);
      }
      .modal-badge {
        @apply inline-block text-[9px] font-extrabold tracking-[0.1em] uppercase rounded-full mb-2.5;
        background: rgba(255, 255, 255, 0.15);
        padding: 4px 10px;
      }
      .modal-title {
        @apply font-display text-lg font-bold leading-[1.3] m-0;
      }
      .modal-body {
        @apply p-6;
      }
      .modal-desc {
        @apply text-[13.5px] text-ink-600 leading-[1.7] mb-5 mt-0;
      }
      .modal-meta-grid {
        @apply grid gap-3 bg-bg border border-border mb-5;
        grid-template-columns: 1fr 1fr;
        border-radius: var(--radius-sm);
        padding: 14px 16px;
      }
      .modal-meta-lbl {
        @apply text-[10.5px] text-ink-400 font-semibold mb-1;
      }
      .modal-meta-val {
        @apply text-[13px] text-ink-900 font-bold;
      }
      .btn-modal-primary {
        @apply block w-full text-center rounded-[13px] text-[13.5px] font-extrabold bg-navy-900 text-white border-none cursor-pointer no-underline transition-[filter];
        padding: 12px;
      }
      .btn-modal-primary:hover {
        filter: brightness(1.15);
      }
      .btn-modal-disabled {
        @apply block w-full text-center rounded-[13px] text-[13.5px] font-extrabold bg-border text-ink-400 border-none cursor-not-allowed;
        padding: 12px;
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

      .scroller-clean::-webkit-scrollbar {
        display: none;
      }
      .scroller-clean {
        -ms-overflow-style: none;
        scrollbar-width: none;
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
      @media (min-width: 768px) {
        .bottom-nav {
          @apply hidden;
        }
      }
    </style>
</head>

<body>
  <!-- ============ NAVBAR — IDENTIK HOMEPAGE ============ -->
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
          LMS &amp; E-Learning Center
        </div>
        <h1>Materi PKKMB-KT<br />UNILAM 2026</h1>
        <p class="hero-info-sub">
          Pusat materi akademik digital. Selesaikan seluruh modul video dan
          unduh berkas panduan resmi sebelum masa perkuliahan dimulai.
        </p>
      </div>
      <div class="hero-stats">
        <div class="hero-stat">
          <div class="hero-stat-val" id="statTotalVideo">0</div>
          <div class="hero-stat-lbl">Total Video</div>
        </div>
        <div class="hero-stat">
          <div class="hero-stat-val" id="statTotalEbook">0</div>
          <div class="hero-stat-lbl">Total E-Book</div>
        </div>
        <div class="hero-stat">
          <div class="hero-stat-val" id="statGlobalProgress">75%</div>
          <div class="hero-stat-lbl">Progres</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ MAIN ============ -->
  <div class="content-wrap">
    <!-- Filter Bar -->
    <div class="filter-bar">
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" stroke-width="2">
          <circle cx="11" cy="11" r="8" />
          <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
        <input
          type="text"
          id="searchInput"
          placeholder="Cari judul materi atau pemateri..." />
      </div>
      <div class="count-badge" id="countBadgeLabel">Memuat data...</div>
      <div
        class="filter-chips scroller-clean"
        id="filterChipsContainer"></div>
    </div>

    <!-- Grid -->
    <div class="main-grid">
      <div>
        <!-- Video Section -->
        <div class="section-head">
          <div
            class="section-head-bar"
            style="
                background: linear-gradient(
                  to bottom,
                  var(--teal-500),
                  var(--navy-700)
                );
              "></div>
          <h2>Video Materi PKKMB-KT</h2>
          <span class="count" id="videoCount">0</span>
        </div>
        <div class="video-grid" id="videoGridContainer"></div>
        <div class="empty-state" id="videoEmptyState">
          <p>Tidak ada video yang cocok dengan pencarian ini.</p>
        </div>

        <!-- Ebook Section -->
        <div class="section-head" style="margin-top: 8px">
          <div
            class="section-head-bar"
            style="
                background: linear-gradient(
                  to bottom,
                  var(--teal-600),
                  #6d28d9
                );
              "></div>
          <h2>E-Book &amp; Panduan PKKMB</h2>
          <span class="count" id="ebookCount">0</span>
        </div>
        <div class="ebook-grid" id="ebookGridContainer"></div>
        <div class="empty-state" id="ebookEmptyState">
          <p>Tidak ada dokumen yang cocok dengan pencarian ini.</p>
        </div>
      </div>

      <!-- Sidebar -->
      <aside class="sidebar">
        <!-- Progress Card -->
        <div class="sidebar-card" style="text-align: center">
          <p class="sidebar-title">Kemajuan Pembelajaran</p>
          <div class="progress-ring-wrap">
            <svg viewBox="0 0 36 36" width="100" height="100">
              <path
                stroke="#e8ebf6"
                stroke-width="3"
                stroke-linecap="round"
                fill="none"
                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
              <path
                stroke="url(#pg)"
                stroke-width="3"
                stroke-linecap="round"
                fill="none"
                stroke-dasharray="75, 100"
                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
              <defs>
                <linearGradient id="pg" x1="0%" y1="0%" x2="100%" y2="0%">
                  <stop offset="0%" stop-color="#16a0a1" />
                  <stop offset="100%" stop-color="#a9c73b" />
                </linearGradient>
              </defs>
            </svg>
            <div class="progress-ring-center">
              <div class="progress-ring-val">75%</div>
              <div class="progress-ring-lbl">Selesai</div>
            </div>
          </div>
          <div class="sidebar-stats">
            <div>
              <div
                class="sidebar-stat-val"
                id="sideStatDone"
                style="color: #16a34a">
                0
              </div>
              <div class="sidebar-stat-lbl">Selesai</div>
            </div>
            <div>
              <div
                class="sidebar-stat-val"
                id="sideStatProcess"
                style="color: #d97706">
                0
              </div>
              <div class="sidebar-stat-lbl">Progres</div>
            </div>
            <div>
              <div
                class="sidebar-stat-val"
                id="sideStatUnstarted"
                style="color: var(--ink-400)">
                0
              </div>
              <div class="sidebar-stat-lbl">Belum</div>
            </div>
          </div>
        </div>

        <!-- Activity Card -->
        <div class="sidebar-card">
          <p class="sidebar-title">Aktivitas Terakhir</p>
          <div class="activity-item">
            <div class="activity-dot done">✓</div>
            <div>
              <div class="activity-text">Selesai Membaca E-Book PKKMB</div>
              <div class="activity-sub">10 menit yang lalu</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="activity-dot progress">•</div>
            <div>
              <div class="activity-text">Menonton Tata Tertib Mahasiswa</div>
              <div class="activity-sub">Progress 45% · 1 jam lalu</div>
            </div>
          </div>
        </div>

        <!-- Download Card -->
        <div class="download-card">
          <h3>Download Semua Materi</h3>
          <p>
            Akses folder Google Drive untuk mengunduh seluruh materi, video,
            dan dokumen SOP secara kolektif.
          </p>
          <button class="btn-drive" id="btnDownloadAll">
            <svg
              viewBox="0 0 24 24"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round">
              <path
                d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3" />
            </svg>
            Buka Cloud Google Drive
          </button>
        </div>
      </aside>
    </div>
  </div>

  <!-- ============ MODAL ============ -->
  <div class="modal-backdrop" id="materiDetailsModal">
    <div class="modal-box">
      <div class="modal-header">
        <button class="modal-close" id="btnCloseMateriModal">×</button>
        <span class="modal-badge" id="modalTypeBadge">Format</span>
        <h3 class="modal-title" id="modalMainTitle">Judul Materi</h3>
      </div>
      <div class="modal-body">
        <p class="modal-desc" id="modalDescriptionText"></p>
        <div class="modal-meta-grid">
          <div>
            <div class="modal-meta-lbl">Pemateri / Narasumber</div>
            <div class="modal-meta-val" id="modalSpeakerName">—</div>
          </div>
          <div>
            <div class="modal-meta-lbl">Estimasi Durasi</div>
            <div class="modal-meta-val" id="modalDurationValue">—</div>
          </div>
        </div>
        <div id="modalActionButtonsBox"></div>
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
      const GOOGLE_DRIVE_FOLDER_URL = "#";

      const SKEMA_KATEGORI = [{
          id: "semua",
          label: "Semua"
        },
        {
          id: "video",
          label: "Video Materi"
        },
        {
          id: "ebook",
          label: "E-Book"
        },
        {
          id: "akademik",
          label: "Akademik"
        },
        {
          id: "keuangan",
          label: "Keuangan"
        },
        {
          id: "lkms",
          label: "LKMS"
        },
        {
          id: "tatib",
          label: "Tata Tertib"
        },
        {
          id: "organisasi",
          label: "Organisasi"
        },
        {
          id: "profil",
          label: "Profil Kampus"
        },
      ];

      const videoMateri = [{
          id: "vid-1",
          tipe: "video",
          judul: "-",
          deskripsi: "Membahas regulasi perkuliahan dasar, tata cara pengisian KRS online, beban SKS, kriteria kelulusan mahasiswa, dan peran dosen wali akademik.",
          pemateri: "-",
          durasi: "45 Menit",
          youtube: "-",
          thumbnailImg: "{{ asset('gambar/unilam.jpeg') }}",
          gradientFallback: "from-teal-600 to-blue-800",
          progress: 100,
          tags: ["video", "akademik"],
        },
        {
          id: "vid-2",
          tipe: "video",
          judul: "-",
          deskripsi: "Panduan lengkap kedisiplinan maba di area kampus, hak proteksi mahasiswa, tata cara penyampaian aspirasi, serta sanksi administratif.",
          pemateri: "Penjualan",
          durasi: "35 Menit",
          youtube: "-",
          thumbnailImg: "{{ asset('gambar/unilam.png') }}",
          gradientFallback: "from-purple-600 to-indigo-800",
          progress: 45,
          tags: ["video", "tatib"],
        },
        {
          id: "vid-3",
          tipe: "video",
          judul: "Keuangan Mahasiswa",
          deskripsi: "Penjelasan teknis mekanisme validasi bank, prosedur pengajuan penangguhan/cicilan UKT, dan syarat pendaftaran beasiswa prestasi.",
          pemateri: "Gufron",
          durasi: "28 Menit",
          youtube: "#",
          thumbnailImg: "",
          gradientFallback: "from-amber-500 to-orange-700",
          progress: 0,
          tags: ["video", "keuangan"],
        },
        {
          id: "vid-4",
          tipe: "video",
          judul: "Kepemimpinan Mahasiswa",
          deskripsi: "Membentuk jiwa kepemimpinan mahasiswa berkarakter, teknik manajemen konflik, retorika persidangan, dan penyusunan rancangan kerja organisasi.",
          pemateri: "Panitia LKMS",
          durasi: "60 Menit",
          youtube: "#",
          thumbnailImg: "",
          gradientFallback: "from-cyan-600 to-blue-800",
          progress: 15,
          tags: ["video", "lkms"],
        },
        {
          id: "vid-5",
          tipe: "video",
          judul: "Tur Virtual Kampus",
          deskripsi: "Tur virtual menelusuri lab komputer, gedung rektorat, perpustakaan pusat, fasilitas olahraga, serta mengenali jajaran struktur pimpinan universitas.",
          pemateri: "Humas UNILAM",
          durasi: "20 Menit",
          youtube: "#",
          thumbnailImg: "",
          gradientFallback: "from-purple-600 to-pink-700",
          progress: 100,
          tags: ["video", "profil"],
        },
        {
          id: "vid-6",
          tipe: "video",
          judul: "Pengenalan Organisasi Kampus",
          deskripsi: "Pengenalan lembaga eksekutif dan legislatif mahasiswa tingkat universitas serta wadah pengembangan bakat minat.",
          pemateri: "BEM UNILAM",
          durasi: "30 Menit",
          youtube: "#",
          thumbnailImg: "",
          gradientFallback: "from-indigo-600 to-purple-800",
          progress: 0,
          tags: ["video", "organisasi"],
        },
      ];

      const ebookMateri = [{
          id: "doc-1",
          tipe: "ebook",
          judul: "Panduan Layanan Akademik & Kemahasiswaan",
          deskripsi: "Panduan layanan akademik dan kemahasiswaan yang mencakup proses registrasi mahasiswa, pengisian KRS, pengelolaan nilai, cuti akademik, hingga berbagai layanan administrasi mahasiswa.",
          pemateri: "Biro Akademik",
          durasi: "15 Menit Baca",
          pdf: "#",
          fileSize: "4.2 MB",
          updatedAt: "18 Juni 2026",
          tags: ["ebook", "akademik"],
        },
        {
          id: "doc-2",
          tipe: "ebook",
          judul: "Panduan Administrasi Umum Kampus",
          deskripsi: "Materi pengenalan tugas dan fungsi Biro Administrasi Umum yang meliputi pengelolaan sarana prasarana, tata usaha, layanan umum kampus, serta administrasi kelembagaan.",
          pemateri: "Biro AU",
          durasi: "15 Menit Baca",
          pdf: "#",
          fileSize: "3.1 MB",
          updatedAt: "18 Juni 2026",
          tags: ["ebook", "profil"],
        },
        {
          id: "doc-3",
          tipe: "ebook",
          judul: "Panduan Sistem Keuangan Mahasiswa",
          deskripsi: "Panduan sistem keuangan mahasiswa yang membahas pembayaran UKT, registrasi keuangan, mekanisme beasiswa, serta berbagai layanan administrasi keuangan di lingkungan universitas.",
          pemateri: "Biro Keuangan",
          durasi: "15 Menit Baca",
          pdf: "#",
          fileSize: "2.5 MB",
          updatedAt: "15 Juni 2026",
          tags: ["ebook", "keuangan"],
        },
        {
          id: "doc-4",
          tipe: "ebook",
          judul: "Panduan LKMS Mahasiswa Baru",
          deskripsi: "Materi pengembangan keterampilan manajemen yang bertujuan membentuk karakter kepemimpinan, kemampuan bekerja sama, komunikasi efektif, serta pengelolaan kegiatan kemahasiswaan.",
          pemateri: "Kemahasiswaan",
          durasi: "15 Menit Baca",
          pdf: "#",
          fileSize: "1.8 MB",
          updatedAt: "12 Juni 2026",
          tags: ["ebook", "lkms"],
        },
        {
          id: "doc-5",
          tipe: "ebook",
          judul: "Panduan Perpustakaan UNILAM",
          deskripsi: "Kumpulan berkas SOP penunjang administrasi kemahasiswaan, validasi berkas KRS, dan birokrasi program studi.",
          pemateri: "Perpustakaan UNILAM",
          durasi: "50 Menit Baca",
          pdf: "#",
          fileSize: "2.9 MB",
          updatedAt: "18 Juni 2026",
          tags: ["ebook", "akademik"],
        },
      ];

      const GABUNGAN = [...videoMateri, ...ebookMateri];
      let filterAktif = "semua";

      const $filterChipsContainer = $("#filterChipsContainer");
      const $searchInput = $("#searchInput");
      const $countBadgeLabel = $("#countBadgeLabel");
      const $videoCount = $("#videoCount");
      const $ebookCount = $("#ebookCount");
      const $videoGridContainer = $("#videoGridContainer");
      const $videoEmptyState = $("#videoEmptyState");
      const $ebookGridContainer = $("#ebookGridContainer");
      const $ebookEmptyState = $("#ebookEmptyState");
      const $materiDetailsModal = $("#materiDetailsModal");

      function renderChips() {
        const html = SKEMA_KATEGORI.map(
          (cat) => `
              <button data-filter-id="${cat.id}" class="chip ${cat.id === filterAktif ? "active" : ""}">${cat.label}</button>
            `,
        ).join("");
        $filterChipsContainer.html(html);

        $filterChipsContainer.find(".chip").on("click", function() {
          switchFilter($(this).data("filter-id"));
        });
      }

      function switchFilter(id) {
        filterAktif = id;
        renderChips();
        handleSearchAndFilter();
      }

      function handleSearchAndFilter() {
        const kw = $searchInput.val().toLowerCase();
        const filtered = GABUNGAN.filter((item) => {
          const matchCat =
            filterAktif === "semua" || item.tags.includes(filterAktif);
          const matchKw = !kw ||
            item.judul.toLowerCase().includes(kw) ||
            item.pemateri.toLowerCase().includes(kw);
          return matchCat && matchKw;
        });
        const videos = filtered.filter((i) => i.tipe === "video");
        const ebooks = filtered.filter((i) => i.tipe === "ebook");
        renderVideos(videos);
        renderEbooks(ebooks);
        $countBadgeLabel.text(`${filtered.length} materi ditemukan`);
        $videoCount.text(videos.length);
        $ebookCount.text(ebooks.length);
      }

      function getGradientStyle(g) {
        const map = {
          "from-teal-600 to-blue-800": "linear-gradient(135deg,#0d9488,#1e40af)",
          "from-purple-600 to-indigo-800": "linear-gradient(135deg,#9333ea,#3730a3)",
          "from-amber-500 to-orange-700": "linear-gradient(135deg,#f59e0b,#c2410c)",
          "from-cyan-600 to-blue-800": "linear-gradient(135deg,#0891b2,#1e40af)",
          "from-purple-600 to-pink-700": "linear-gradient(135deg,#9333ea,#be185d)",
          "from-indigo-600 to-purple-800": "linear-gradient(135deg,#4f46e5,#6b21a8)",
        };
        return map[g] || "linear-gradient(135deg,#152159,#1e3a8f)";
      }

      function renderVideos(items) {
        if (items.length === 0) {
          $videoGridContainer.html("");
          $videoEmptyState.css("display", "block");
          return;
        }
        $videoEmptyState.css("display", "none");

        const html = items
          .map((v) => {
            const isDone = v.progress === 100;
            const thumbHtml = v.thumbnailImg ?
              `<img src="${v.thumbnailImg}" alt="${v.judul}" />` :
              `<div class="video-thumb-gradient" style="background:${getGradientStyle(v.gradientFallback)}"></div>`;

            return `
              <div class="video-card">
                <div class="video-thumb">
                  ${thumbHtml}
                  <div class="video-thumb-overlay"></div>
                  <div class="video-play-btn">
                    <svg viewBox="0 0 10 12"><path d="M0 0L10 6 0 12z"/></svg>
                  </div>
                  <div class="video-duration">${v.durasi}</div>
                </div>
                <div class="video-body">
                  <div>
                    <div class="video-title">${v.judul}</div>
                    <div class="video-meta">Narasumber: <span>${v.pemateri}</span></div>
                  </div>
                  <div class="progress-wrap">
                    <div class="progress-labels">
                      <span>Progres Menonton</span>
                      <span style="color:${isDone ? "#16a34a" : "var(--teal-600)"}">${v.progress}%</span>
                    </div>
                    <div class="progress-bar-bg">
                      <div class="progress-bar-fill ${isDone ? "done" : ""}" style="width:${v.progress}%"></div>
                    </div>
                    <button class="btn-watch" data-detail-id="${v.id}">Tonton Materi</button>
                  </div>
                </div>
              </div>
            `;
          })
          .join("");

        $videoGridContainer.html(html);
        $videoGridContainer.find(".btn-watch").on("click", function() {
          triggerDetailModalEngine($(this).data("detail-id"));
        });
      }

      function renderEbooks(items) {
        if (items.length === 0) {
          $ebookGridContainer.html("");
          $ebookEmptyState.css("display", "block");
          return;
        }
        $ebookEmptyState.css("display", "none");

        const html = items
          .map(
            (doc) => `
            <div class="ebook-card">
              <div class="ebook-icon">
                <svg viewBox="0 0 24 24"><path d="M4 4h11l5 5v11a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zm10 1.5V9h3.5L14 5.5zM7 13h10v1.5H7V13zm0 3h10v1.5H7V16z"/></svg>
              </div>
              <div class="ebook-body">
                <div class="ebook-title">${doc.judul}</div>
                <div class="ebook-meta">${doc.fileSize} · Diperbarui ${doc.updatedAt}</div>
                <button class="btn-download" data-detail-id="${doc.id}">Lihat &amp; Unduh</button>
              </div>
            </div>
          `,
          )
          .join("");

        $ebookGridContainer.html(html);
        $ebookGridContainer.find(".btn-download").on("click", function() {
          triggerDetailModalEngine($(this).data("detail-id"));
        });
      }

      function triggerDetailModalEngine(id) {
        const item = GABUNGAN.find((x) => x.id === id);
        if (!item) return;
        $("#modalMainTitle").text(item.judul);
        $("#modalDescriptionText").text(item.deskripsi);
        $("#modalSpeakerName").text(item.pemateri);
        $("#modalDurationValue").text(item.durasi);

        const $badge = $("#modalTypeBadge");
        const $actions = $("#modalActionButtonsBox");

        if (item.tipe === "video") {
          $badge.text("Video Pembelajaran");
          if (item.youtube !== "#") {
            $actions.html(`<a href="${item.youtube}" target="_blank" class="btn-modal-primary">Tonton Video</a>`);
          } else {
            $actions.html(`<button disabled class="btn-modal-disabled">Video Belum Tersedia</button>`);
          }
        } else {
          $badge.text("E-Book & Dokumen PDF");
          if (item.pdf !== "#") {
            $actions.html(`<a href="${item.pdf}" target="_blank" class="btn-modal-primary">Buka &amp; Unduh (${item.fileSize})</a>`);
          } else {
            $actions.html(`<button disabled class="btn-modal-disabled">Materi Belum Tersedia</button>`);
          }
        }

        $materiDetailsModal.addClass("open");
      }

      function closeModalEngine() {
        $materiDetailsModal.removeClass("open");
      }

      $("#btnCloseMateriModal").on("click", closeModalEngine);
      $materiDetailsModal.on("click", function(e) {
        if (e.target === this) closeModalEngine();
      });

      function initStats() {
        $("#statTotalVideo").text(videoMateri.length);
        $("#statTotalEbook").text(ebookMateri.length);
        const done = videoMateri.filter((v) => v.progress === 100).length;
        const inprog = videoMateri.filter(
          (v) => v.progress > 0 && v.progress < 100,
        ).length;
        const unstarted =
          videoMateri.filter((v) => v.progress === 0).length +
          ebookMateri.length;
        $("#sideStatDone").text(done);
        $("#sideStatProcess").text(inprog);
        $("#sideStatUnstarted").text(unstarted);
        $("#btnDownloadAll").on("click", () => {
          GOOGLE_DRIVE_FOLDER_URL !== "#" ?
            window.open(GOOGLE_DRIVE_FOLDER_URL, "_blank") :
            alert("Folder Cloud belum tersedia.");
        });
      }

      $searchInput.on("input", handleSearchAndFilter);

      // Boot
      renderChips();
      handleSearchAndFilter();
      initStats();

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