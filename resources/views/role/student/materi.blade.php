<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Materi PKKMB-KT UNILAM 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <style>
      /* ============ DESIGN TOKENS — IDENTIK HOMEPAGE ============ */
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
        -webkit-font-smoothing: antialiased;
      }
      .font-display {
        font-family: var(--font-display);
      }
      .text-navy-900 {
        color: var(--navy-900);
      }
      .text-navy-700 {
        color: var(--navy-700);
      }
      .text-teal-600 {
        color: var(--teal-600);
      }
      .bg-navy-900 {
        background-color: var(--navy-900);
      }
      .bg-teal-600 {
        background-color: var(--teal-600);
      }
      .bg-olive-600 {
        background-color: var(--lime-500);
      }
      .border-teal-600 {
        border-color: var(--teal-600);
      }

      /* ============ NAVBAR — COPY EXACT DARI HOMEPAGE ============ */
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
        padding: clamp(48px, 8vw, 80px) clamp(16px, 5vw, 48px);
        overflow: hidden;
      }
      /* ►► SLIDESHOW LATAR HERO — sama seperti denah.html/absensi.html.
         Ganti/tambah gambar di array JS "heroSlideImages" di bawah. */
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
          rgba(21, 33, 89, 0.92) 0%,
          rgba(15, 138, 140, 0.8) 100%
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
        gap: 32px;
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
        font-size: clamp(24px, 4vw, 40px);
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
        padding: 20px 28px;
        backdrop-filter: blur(12px);
        flex-shrink: 0;
      }
      .hero-stat {
        text-align: center;
        padding: 0 20px;
        border-right: 1px solid rgba(255, 255, 255, 0.12);
      }
      .hero-stat:last-child {
        border-right: none;
      }
      .hero-stat-val {
        font-family: var(--font-display);
        font-size: 28px;
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
        max-width: 1200px;
        margin: 0 auto;
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
        background: var(--surface);
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
        padding: 20px 24px;
        margin-bottom: 32px;
        box-shadow: var(--shadow-card);
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        align-items: center;
        justify-content: space-between;
      }
      .search-wrap {
        position: relative;
        flex: 1;
        min-width: 220px;
        max-width: 420px;
      }
      .search-wrap svg {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        stroke: var(--ink-400);
        fill: none;
        pointer-events: none;
      }
      .search-wrap input {
        width: 100%;
        background: var(--bg);
        border: 1.5px solid var(--border);
        border-radius: 99px;
        padding: 10px 16px 10px 42px;
        font-family: var(--font-sans);
        font-size: 13px;
        font-weight: 500;
        color: var(--ink-900);
        transition:
          border-color 0.2s,
          box-shadow 0.2s;
        outline: none;
      }
      .search-wrap input:focus {
        border-color: var(--teal-500);
        box-shadow: 0 0 0 3px rgba(22, 160, 161, 0.12);
      }
      .count-badge {
        font-size: 11.5px;
        font-weight: 700;
        color: var(--ink-600);
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 99px;
        padding: 6px 16px;
        white-space: nowrap;
      }
      .filter-chips {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        padding-top: 12px;
        border-top: 1px solid var(--border);
        margin-top: 4px;
        width: 100%;
      }
      .chip {
        padding: 6px 16px;
        border-radius: 99px;
        font-size: 12px;
        font-weight: 700;
        border: 1.5px solid var(--border);
        background: var(--bg);
        color: var(--ink-600);
        cursor: pointer;
        transition: all 0.18s;
        white-space: nowrap;
      }
      .chip:hover {
        border-color: var(--teal-500);
        color: var(--teal-600);
      }
      .chip.active {
        background: var(--navy-900);
        border-color: var(--navy-900);
        color: #fff;
      }

      /* ============ GRID LAYOUT ============ */
      .main-grid {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 28px;
        align-items: start;
      }
      @media (max-width: 1024px) {
        .main-grid {
          grid-template-columns: 1fr;
        }
        .sidebar {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
          gap: 16px;
        }
      }

      /* ============ SECTION HEADING ============ */
      .section-head {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
      }
      .section-head-bar {
        width: 4px;
        height: 22px;
        border-radius: 99px;
      }
      .section-head h2 {
        font-family: var(--font-display);
        font-size: 18px;
        font-weight: 700;
        color: var(--ink-900);
        margin: 0;
      }
      .section-head .count {
        font-size: 11px;
        font-weight: 700;
        color: var(--ink-400);
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 99px;
        padding: 3px 10px;
        margin-left: 4px;
      }

      /* ============ VIDEO CARDS ============ */
      .video-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 40px;
      }
      .video-card {
        background: var(--surface);
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
        overflow: hidden;
        box-shadow: var(--shadow-card);
        transition:
          transform 0.2s,
          box-shadow 0.2s;
        display: flex;
        flex-direction: column;
      }
      .video-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-pop);
      }
      .video-thumb {
        height: 130px;
        position: relative;
        overflow: hidden;
        background: var(--navy-900);
      }
      .video-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
      }
      .video-thumb-gradient {
        width: 100%;
        height: 100%;
      }
      .video-thumb-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
          to top,
          rgba(21, 33, 89, 0.6) 0%,
          transparent 60%
        );
      }
      .video-duration {
        position: absolute;
        bottom: 8px;
        right: 10px;
        background: rgba(0, 0, 0, 0.55);
        backdrop-filter: blur(6px);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 6px;
      }
      .video-play-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(8px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.18s;
      }
      .video-card:hover .video-play-btn {
        background: var(--lime-500);
      }
      .video-play-btn svg {
        width: 14px;
        height: 14px;
        fill: #fff;
        margin-left: 2px;
      }
      .video-body {
        padding: 14px 16px 16px;
        display: flex;
        flex-direction: column;
        flex: 1;
        gap: 10px;
      }
      .video-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--ink-900);
        line-height: 1.45;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
      }
      .video-meta {
        font-size: 11px;
        color: var(--ink-400);
        font-weight: 600;
      }
      .video-meta span {
        color: var(--ink-600);
        font-weight: 700;
      }
      .progress-wrap {
        margin-top: auto;
      }
      .progress-labels {
        display: flex;
        justify-content: space-between;
        font-size: 10px;
        font-weight: 700;
        color: var(--ink-400);
        margin-bottom: 5px;
      }
      .progress-bar-bg {
        height: 5px;
        background: var(--bg);
        border-radius: 99px;
        overflow: hidden;
        margin-bottom: 10px;
      }
      .progress-bar-fill {
        height: 100%;
        border-radius: 99px;
        background: linear-gradient(90deg, var(--teal-500), var(--lime-500));
        transition: width 0.5s;
      }
      .progress-bar-fill.done {
        background: var(--lime-500);
      }
      .btn-watch {
        display: block;
        width: 100%;
        text-align: center;
        padding: 9px 0;
        border-radius: var(--radius-sm);
        font-size: 12px;
        font-weight: 700;
        background: var(--navy-tint);
        color: var(--navy-900);
        border: none;
        cursor: pointer;
        transition:
          background 0.18s,
          color 0.18s;
      }
      .btn-watch:hover {
        background: var(--navy-900);
        color: #fff;
      }

      /* ============ EBOOK CARDS ============ */
      .ebook-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 14px;
      }
      .ebook-card {
        background: var(--surface);
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
        padding: 18px;
        box-shadow: var(--shadow-card);
        display: flex;
        gap: 14px;
        align-items: flex-start;
        transition:
          transform 0.2s,
          box-shadow 0.2s;
      }
      .ebook-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-pop);
      }
      .ebook-icon {
        width: 48px;
        height: 56px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--teal-600), var(--navy-700));
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(15, 138, 140, 0.3);
      }
      .ebook-icon svg {
        width: 22px;
        height: 22px;
        fill: #fff;
        opacity: 0.9;
      }
      .ebook-body {
        flex: 1;
        min-width: 0;
      }
      .ebook-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--ink-900);
        line-height: 1.4;
        margin-bottom: 4px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
      }
      .ebook-meta {
        font-size: 10.5px;
        color: var(--ink-400);
        font-weight: 600;
        margin-bottom: 10px;
      }
      .btn-download {
        display: block;
        text-align: center;
        padding: 8px 0;
        border-radius: var(--radius-sm);
        font-size: 11.5px;
        font-weight: 700;
        background: var(--teal-tint);
        color: var(--teal-600);
        border: none;
        cursor: pointer;
        transition:
          background 0.18s,
          color 0.18s;
        width: 100%;
      }
      .btn-download:hover {
        background: var(--teal-600);
        color: #fff;
      }

      /* ============ EMPTY STATE ============ */
      .empty-state {
        text-align: center;
        padding: 48px 24px;
        background: var(--surface);
        border-radius: var(--radius-md);
        border: 1.5px dashed var(--border);
        display: none;
      }
      .empty-state p {
        font-size: 13px;
        color: var(--ink-400);
        font-weight: 600;
      }

      /* ============ SIDEBAR ============ */
      .sidebar {
        position: sticky;
        top: 84px;
        display: flex;
        flex-direction: column;
        gap: 16px;
      }
      .sidebar-card {
        background: var(--surface);
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
        padding: 20px;
        box-shadow: var(--shadow-card);
      }
      .sidebar-title {
        font-size: 10.5px;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--ink-400);
        margin: 0 0 14px;
      }
      .progress-ring-wrap {
        position: relative;
        width: 100px;
        height: 100px;
        margin: 0 auto 16px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .progress-ring-wrap svg {
        position: absolute;
        inset: 0;
        transform: rotate(-90deg);
      }
      .progress-ring-center {
        text-align: center;
        position: relative;
        z-index: 1;
      }
      .progress-ring-val {
        font-family: var(--font-display);
        font-size: 24px;
        font-weight: 700;
        color: var(--navy-900);
        line-height: 1;
      }
      .progress-ring-lbl {
        font-size: 9.5px;
        color: var(--ink-400);
        font-weight: 700;
        margin-top: 2px;
      }
      .sidebar-stats {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 8px;
        border-top: 1px solid var(--border);
        padding-top: 14px;
        text-align: center;
      }
      .sidebar-stat-val {
        font-size: 16px;
        font-weight: 800;
      }
      .sidebar-stat-lbl {
        font-size: 9.5px;
        color: var(--ink-400);
        font-weight: 600;
      }
      .activity-item {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border);
        margin-bottom: 12px;
      }
      .activity-item:last-child {
        padding-bottom: 0;
        border-bottom: none;
        margin-bottom: 0;
      }
      .activity-dot {
        width: 24px;
        height: 24px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 800;
        flex-shrink: 0;
        margin-top: 1px;
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
        font-size: 12px;
        font-weight: 700;
        color: var(--ink-900);
        line-height: 1.35;
      }
      .activity-sub {
        font-size: 10px;
        color: var(--ink-400);
        font-weight: 500;
        margin-top: 2px;
      }
      .download-card {
        background: linear-gradient(135deg, var(--navy-900), var(--navy-700));
        border-radius: var(--radius-md);
        padding: 20px;
        color: #fff;
        position: relative;
        overflow: hidden;
      }
      .download-card::before {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(169, 199, 59, 0.1);
        top: -40px;
        right: -30px;
        pointer-events: none;
      }
      .download-card h3 {
        font-family: var(--font-display);
        font-size: 15px;
        font-weight: 700;
        margin: 0 0 8px;
        position: relative;
        z-index: 1;
      }
      .download-card p {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.65);
        line-height: 1.6;
        margin: 0 0 14px;
        position: relative;
        z-index: 1;
      }
      .btn-drive {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 10px 0;
        background: rgba(255, 255, 255, 0.1);
        border: 1.5px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-sm);
        color: #fff;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition:
          background 0.18s,
          border-color 0.18s;
        position: relative;
        z-index: 1;
      }
      .btn-drive:hover {
        background: rgba(255, 255, 255, 0.18);
        border-color: rgba(255, 255, 255, 0.4);
      }
      .btn-drive svg {
        width: 15px;
        height: 15px;
        stroke: #fff;
        fill: none;
      }

      /* ============ MODAL ============ */
      .modal-backdrop {
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
      .modal-backdrop.open {
        display: flex;
      }
      .modal-box {
        background: var(--surface);
        border-radius: var(--radius-lg);
        max-width: 480px;
        width: 100%;
        overflow: hidden;
        box-shadow: var(--shadow-pop);
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
        background: linear-gradient(135deg, var(--navy-900), var(--navy-600));
        padding: 24px;
        color: #fff;
        position: relative;
      }
      .modal-close {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
        border: none;
        color: #fff;
        font-size: 18px;
        line-height: 1;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s;
      }
      .modal-close:hover {
        background: rgba(255, 255, 255, 0.25);
      }
      .modal-badge {
        display: inline-block;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        background: rgba(255, 255, 255, 0.15);
        padding: 4px 10px;
        border-radius: 99px;
        margin-bottom: 10px;
      }
      .modal-title {
        font-family: var(--font-display);
        font-size: 18px;
        font-weight: 700;
        line-height: 1.3;
        margin: 0;
      }
      .modal-body {
        padding: 24px;
      }
      .modal-desc {
        font-size: 13.5px;
        color: var(--ink-600);
        line-height: 1.7;
        margin: 0 0 20px;
      }
      .modal-meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        background: var(--bg);
        border-radius: var(--radius-sm);
        padding: 14px 16px;
        border: 1px solid var(--border);
        margin-bottom: 20px;
      }
      .modal-meta-lbl {
        font-size: 10.5px;
        color: var(--ink-400);
        font-weight: 600;
        margin-bottom: 3px;
      }
      .modal-meta-val {
        font-size: 13px;
        color: var(--ink-900);
        font-weight: 700;
      }
      .btn-modal-primary {
        display: block;
        width: 100%;
        text-align: center;
        padding: 12px;
        border-radius: var(--radius-sm);
        font-size: 13.5px;
        font-weight: 800;
        background: var(--navy-900);
        color: #fff;
        border: none;
        cursor: pointer;
        transition: filter 0.18s;
      }
      .btn-modal-primary:hover {
        filter: brightness(1.15);
      }
      .btn-modal-disabled {
        display: block;
        width: 100%;
        text-align: center;
        padding: 12px;
        border-radius: var(--radius-sm);
        font-size: 13.5px;
        font-weight: 800;
        background: var(--border);
        color: var(--ink-400);
        border: none;
        cursor: not-allowed;
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
        margin-top: 56px;
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

      .scroller-clean::-webkit-scrollbar {
        display: none;
      }
      .scroller-clean {
        -ms-overflow-style: none;
        scrollbar-width: none;
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
      @media (min-width: 768px) {
        .bottom-nav {
          display: none;
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
            placeholder="Cari judul materi atau pemateri..."
            oninput="handleSearchAndFilter()"
          />
        </div>
        <div class="count-badge" id="countBadgeLabel">Memuat data...</div>
        <div
          class="filter-chips scroller-clean"
          id="filterChipsContainer"
        ></div>
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
              "
            ></div>
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
              "
            ></div>
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
                  d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <path
                  stroke="url(#pg)"
                  stroke-width="3"
                  stroke-linecap="round"
                  fill="none"
                  stroke-dasharray="75, 100"
                  d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                />
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
                  style="color: #16a34a"
                >
                  0
                </div>
                <div class="sidebar-stat-lbl">Selesai</div>
              </div>
              <div>
                <div
                  class="sidebar-stat-val"
                  id="sideStatProcess"
                  style="color: #d97706"
                >
                  0
                </div>
                <div class="sidebar-stat-lbl">Progres</div>
              </div>
              <div>
                <div
                  class="sidebar-stat-val"
                  id="sideStatUnstarted"
                  style="color: var(--ink-400)"
                >
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
                stroke-linejoin="round"
              >
                <path
                  d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"
                />
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
          <button class="modal-close" onclick="closeModalEngine()">×</button>
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
          stroke-linejoin="round"
        >
          <path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
          <path
            d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z"
          />
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
          stroke-linejoin="round"
        >
          <path
            d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z"
          />
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
      const GOOGLE_DRIVE_FOLDER_URL = "#";

      const SKEMA_KATEGORI = [
        { id: "semua", label: "Semua" },
        { id: "video", label: "Video Materi" },
        { id: "ebook", label: "E-Book" },
        { id: "akademik", label: "Akademik" },
        { id: "keuangan", label: "Keuangan" },
        { id: "lkms", label: "LKMS" },
        { id: "tatib", label: "Tata Tertib" },
        { id: "organisasi", label: "Organisasi" },
        { id: "profil", label: "Profil Kampus" },
      ];

      const videoMateri = [
        {
          id: "vid-1",
          tipe: "video",
          judul: "-",
          deskripsi:
            "Membahas regulasi perkuliahan dasar, tata cara pengisian KRS online, beban SKS, kriteria kelulusan mahasiswa, dan peran dosen wali akademik.",
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
          deskripsi:
            "Panduan lengkap kedisiplinan maba di area kampus, hak proteksi mahasiswa, tata cara penyampaian aspirasi, serta sanksi administratif.",
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
          deskripsi:
            "Penjelasan teknis mekanisme validasi bank, prosedur pengajuan penangguhan/cicilan UKT, dan syarat pendaftaran beasiswa prestasi.",
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
          deskripsi:
            "Membentuk jiwa kepemimpinan mahasiswa berkarakter, teknik manajemen konflik, retorika persidangan, dan penyusunan rancangan kerja organisasi.",
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
          deskripsi:
            "Tur virtual menelusuri lab komputer, gedung rektorat, perpustakaan pusat, fasilitas olahraga, serta mengenali jajaran struktur pimpinan universitas.",
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
          deskripsi:
            "Pengenalan lembaga eksekutif dan legislatif mahasiswa tingkat universitas serta wadah pengembangan bakat minat.",
          pemateri: "BEM UNILAM",
          durasi: "30 Menit",
          youtube: "#",
          thumbnailImg: "",
          gradientFallback: "from-indigo-600 to-purple-800",
          progress: 0,
          tags: ["video", "organisasi"],
        },
      ];

      const ebookMateri = [
        {
          id: "doc-1",
          tipe: "ebook",
          judul: "Panduan Layanan Akademik & Kemahasiswaan",
          deskripsi:
            "Panduan layanan akademik dan kemahasiswaan yang mencakup proses registrasi mahasiswa, pengisian KRS, pengelolaan nilai, cuti akademik, hingga berbagai layanan administrasi mahasiswa.",
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
          deskripsi:
            "Materi pengenalan tugas dan fungsi Biro Administrasi Umum yang meliputi pengelolaan sarana prasarana, tata usaha, layanan umum kampus, serta administrasi kelembagaan.",
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
          deskripsi:
            "Panduan sistem keuangan mahasiswa yang membahas pembayaran UKT, registrasi keuangan, mekanisme beasiswa, serta berbagai layanan administrasi keuangan di lingkungan universitas.",
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
          deskripsi:
            "Materi pengembangan keterampilan manajemen yang bertujuan membentuk karakter kepemimpinan, kemampuan bekerja sama, komunikasi efektif, serta pengelolaan kegiatan kemahasiswaan.",
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
          deskripsi:
            "Kumpulan berkas SOP penunjang administrasi kemahasiswaan, validasi berkas KRS, dan birokrasi program studi.",
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

      function renderChips() {
        document.getElementById("filterChipsContainer").innerHTML =
          SKEMA_KATEGORI.map(
            (cat) => `
          <button onclick="switchFilter('${cat.id}')" class="chip ${cat.id === filterAktif ? "active" : ""}">${cat.label}</button>
        `,
          ).join("");
      }

      function switchFilter(id) {
        filterAktif = id;
        renderChips();
        handleSearchAndFilter();
      }

      function handleSearchAndFilter() {
        const kw = document.getElementById("searchInput").value.toLowerCase();
        const filtered = GABUNGAN.filter((item) => {
          const matchCat =
            filterAktif === "semua" || item.tags.includes(filterAktif);
          const matchKw =
            !kw ||
            item.judul.toLowerCase().includes(kw) ||
            item.pemateri.toLowerCase().includes(kw);
          return matchCat && matchKw;
        });
        const videos = filtered.filter((i) => i.tipe === "video");
        const ebooks = filtered.filter((i) => i.tipe === "ebook");
        renderVideos(videos);
        renderEbooks(ebooks);
        document.getElementById("countBadgeLabel").innerText =
          `${filtered.length} materi ditemukan`;
        document.getElementById("videoCount").innerText = videos.length;
        document.getElementById("ebookCount").innerText = ebooks.length;
      }

      function getGradientStyle(g) {
        const map = {
          "from-teal-600 to-blue-800":
            "linear-gradient(135deg,#0d9488,#1e40af)",
          "from-purple-600 to-indigo-800":
            "linear-gradient(135deg,#9333ea,#3730a3)",
          "from-amber-500 to-orange-700":
            "linear-gradient(135deg,#f59e0b,#c2410c)",
          "from-cyan-600 to-blue-800":
            "linear-gradient(135deg,#0891b2,#1e40af)",
          "from-purple-600 to-pink-700":
            "linear-gradient(135deg,#9333ea,#be185d)",
          "from-indigo-600 to-purple-800":
            "linear-gradient(135deg,#4f46e5,#6b21a8)",
        };
        return map[g] || "linear-gradient(135deg,#152159,#1e3a8f)";
      }

      function renderVideos(items) {
        const container = document.getElementById("videoGridContainer");
        const empty = document.getElementById("videoEmptyState");
        if (items.length === 0) {
          container.innerHTML = "";
          empty.style.display = "block";
          return;
        }
        empty.style.display = "none";

        container.innerHTML = items
          .map((v) => {
            const isDone = v.progress === 100;
            const thumbHtml = v.thumbnailImg
              ? `<img src="${v.thumbnailImg}" alt="${v.judul}" />`
              : `<div class="video-thumb-gradient" style="background:${getGradientStyle(v.gradientFallback)}"></div>`;

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
                  <button class="btn-watch" onclick="triggerDetailModalEngine('${v.id}')">Tonton Materi</button>
                </div>
              </div>
            </div>
          `;
          })
          .join("");
      }

      function renderEbooks(items) {
        const container = document.getElementById("ebookGridContainer");
        const empty = document.getElementById("ebookEmptyState");
        if (items.length === 0) {
          container.innerHTML = "";
          empty.style.display = "block";
          return;
        }
        empty.style.display = "none";

        container.innerHTML = items
          .map(
            (doc) => `
          <div class="ebook-card">
            <div class="ebook-icon">
              <svg viewBox="0 0 24 24"><path d="M4 4h11l5 5v11a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zm10 1.5V9h3.5L14 5.5zM7 13h10v1.5H7V13zm0 3h10v1.5H7V16z"/></svg>
            </div>
            <div class="ebook-body">
              <div class="ebook-title">${doc.judul}</div>
              <div class="ebook-meta">${doc.fileSize} · Diperbarui ${doc.updatedAt}</div>
              <button class="btn-download" onclick="triggerDetailModalEngine('${doc.id}')">Lihat &amp; Unduh</button>
            </div>
          </div>
        `,
          )
          .join("");
      }

      function triggerDetailModalEngine(id) {
        const item = GABUNGAN.find((x) => x.id === id);
        if (!item) return;
        document.getElementById("modalMainTitle").innerText = item.judul;
        document.getElementById("modalDescriptionText").innerText =
          item.deskripsi;
        document.getElementById("modalSpeakerName").innerText = item.pemateri;
        document.getElementById("modalDurationValue").innerText = item.durasi;

        const badge = document.getElementById("modalTypeBadge");
        const actions = document.getElementById("modalActionButtonsBox");

        if (item.tipe === "video") {
          badge.innerText = "Video Pembelajaran";
          if (item.youtube !== "#") {
            actions.innerHTML = `<a href="${item.youtube}" target="_blank" class="btn-modal-primary">Tonton Video</a>`;
          } else {
            actions.innerHTML = `<button disabled class="btn-modal-disabled">Video Belum Tersedia</button>`;
          }
        } else {
          badge.innerText = "E-Book & Dokumen PDF";
          if (item.pdf !== "#") {
            actions.innerHTML = `<a href="${item.pdf}" target="_blank" class="btn-modal-primary">Buka &amp; Unduh (${item.fileSize})</a>`;
          } else {
            actions.innerHTML = `<button disabled class="btn-modal-disabled">Materi Belum Tersedia</button>`;
          }
        }

        document.getElementById("materiDetailsModal").classList.add("open");
      }

      function closeModalEngine() {
        document.getElementById("materiDetailsModal").classList.remove("open");
      }
      document
        .getElementById("materiDetailsModal")
        .addEventListener("click", function (e) {
          if (e.target === this) closeModalEngine();
        });

      function initStats() {
        document.getElementById("statTotalVideo").innerText =
          videoMateri.length;
        document.getElementById("statTotalEbook").innerText =
          ebookMateri.length;
        const done = videoMateri.filter((v) => v.progress === 100).length;
        const inprog = videoMateri.filter(
          (v) => v.progress > 0 && v.progress < 100,
        ).length;
        const unstarted =
          videoMateri.filter((v) => v.progress === 0).length +
          ebookMateri.length;
        document.getElementById("sideStatDone").innerText = done;
        document.getElementById("sideStatProcess").innerText = inprog;
        document.getElementById("sideStatUnstarted").innerText = unstarted;
        document.getElementById("btnDownloadAll").onclick = () => {
          GOOGLE_DRIVE_FOLDER_URL !== "#"
            ? window.open(GOOGLE_DRIVE_FOLDER_URL, "_blank")
            : alert("Folder Cloud belum tersedia.");
        };
      }

      // Navbar hamburger toggle
 
      // Boot
      document.addEventListener("DOMContentLoaded", function () {
        renderChips();
        handleSearchAndFilter();
        initStats();
      });
      if (document.readyState !== "loading") {
        renderChips();
        handleSearchAndFilter();
        initStats();
      }

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO — sama seperti denah.html/absensi.html.
      //    Ganti / tambah gambar di array ini.
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