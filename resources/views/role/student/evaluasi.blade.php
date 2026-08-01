<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Evaluasi | PKKMB-KT UNILAM 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <style>
      /* ============ DESIGN TOKENS — IDENTIK HOMEPAGE/MATERI ============ */
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
        background: var(--bg);
        -webkit-font-smoothing: antialiased;
      }
      .font-display {
        font-family: var(--font-display);
      }

      /* ============ NAVBAR — COPY EXACT DARI HOMEPAGE/MATERI ============ */
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
        padding: clamp(40px, 7vw, 64px) clamp(16px, 5vw, 48px);
        overflow: hidden;
      }
      /* ►► SLIDESHOW LATAR HERO — sama seperti absensi/materi/denah.html.
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
          rgba(21, 33, 89, 0.94) 0%,
          rgba(15, 138, 140, 0.85) 100%
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
        background: linear-gradient(
          to bottom,
          var(--teal-500),
          var(--navy-700)
        );
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

      /* ============ KARTU KUIS (mirip kartu video di materi) ============ */
      .quiz-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 16px;
      }
      .quiz-card {
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
      .quiz-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-pop);
      }
      .quiz-thumb {
        height: 120px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .quiz-thumb-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
          to top,
          rgba(21, 33, 89, 0.45) 0%,
          transparent 60%
        );
      }
      .quiz-thumb-icon {
        width: 46px;
        height: 46px;
        stroke: #fff;
        fill: none;
        stroke-width: 1.6;
        opacity: 0.95;
        position: relative;
        z-index: 1;
      }
      .quiz-badge-count {
        position: absolute;
        bottom: 8px;
        right: 10px;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(6px);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 6px;
        z-index: 1;
      }
      .quiz-body {
        padding: 14px 16px 16px;
        display: flex;
        flex-direction: column;
        flex: 1;
        gap: 10px;
      }
      .quiz-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--ink-900);
        line-height: 1.4;
      }
      .quiz-desc {
        font-size: 11.5px;
        color: var(--ink-600);
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
      }
      .quiz-meta-row {
        display: flex;
        gap: 14px;
        font-size: 11px;
        font-weight: 600;
        color: var(--ink-400);
      }
      .quiz-meta-row span {
        display: inline-flex;
        align-items: center;
        gap: 4px;
      }
      .quiz-meta-row svg {
        width: 13px;
        height: 13px;
        stroke: var(--ink-400);
        fill: none;
        stroke-width: 1.8;
      }
      .quiz-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 10.5px;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 99px;
        width: fit-content;
      }
      .quiz-status.belum {
        background: var(--bg);
        color: var(--ink-400);
        border: 1px solid var(--border);
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
        margin-top: auto;
        display: block;
        width: 100%;
        text-align: center;
        padding: 10px 0;
        border-radius: var(--radius-sm);
        font-size: 12.5px;
        font-weight: 700;
        background: var(--navy-tint);
        color: var(--navy-900);
        border: none;
        cursor: pointer;
        transition:
          background 0.18s,
          color 0.18s;
      }
      .btn-mulai:hover {
        background: var(--navy-900);
        color: #fff;
      }

      /* ============ MODE KUIS (layar ngerjain soal ala Quizizz) ============ */
      .quiz-runner {
        position: fixed;
        inset: 0;
        z-index: 90;
        background: linear-gradient(180deg, #eef1fb 0%, #f5f3ec 100%);
        display: none;
        flex-direction: column;
        overflow-y: auto;
      }
      .quiz-runner.open {
        display: flex;
      }
      .quiz-runner::before {
        content: "";
        position: fixed;
        width: 380px;
        height: 380px;
        border-radius: 50%;
        background: rgba(22, 160, 161, 0.08);
        top: -140px;
        right: -100px;
        pointer-events: none;
        z-index: 0;
      }
      .quiz-runner::after {
        content: "";
        position: fixed;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(169, 199, 59, 0.1);
        bottom: -100px;
        left: -80px;
        pointer-events: none;
        z-index: 0;
      }

      /* Bar atas: timer + progress + tombol keluar */
      .runner-topbar {
        position: sticky;
        top: 0;
        background: linear-gradient(120deg, var(--navy-900), var(--navy-700));
        padding: 14px clamp(16px, 5vw, 48px);
        display: flex;
        align-items: center;
        gap: 16px;
        z-index: 5;
        box-shadow: 0 4px 18px rgba(21, 33, 89, 0.18);
      }
      .runner-exit {
        background: rgba(255, 255, 255, 0.12);
        border: none;
        color: #fff;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        font-size: 18px;
        cursor: pointer;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s, transform 0.15s;
      }
      .runner-exit:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: rotate(90deg);
      }
      .runner-progress-track {
        flex: 1;
        height: 8px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 99px;
        overflow: hidden;
      }
      .runner-progress-fill {
        height: 100%;
        width: 0%;
        border-radius: 99px;
        background: linear-gradient(90deg, var(--teal-500), var(--lime-500));
        transition: width 0.35s ease;
        box-shadow: 0 0 10px rgba(169, 199, 59, 0.6);
      }
      .runner-qcount {
        font-size: 12px;
        font-weight: 800;
        color: #fff;
        white-space: nowrap;
        flex-shrink: 0;
        background: rgba(255, 255, 255, 0.1);
        padding: 5px 12px;
        border-radius: 99px;
      }

      /* Lingkaran timer detik */
      .runner-timer {
        flex-shrink: 0;
        position: relative;
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s;
      }
      .runner-timer svg {
        position: absolute;
        inset: 0;
        transform: rotate(-90deg);
      }
      .runner-timer-num {
        position: relative;
        z-index: 1;
        font-size: 15px;
        font-weight: 800;
        color: #fff;
        font-family: var(--font-display);
      }
      /* Saat waktu hampir habis (<=5 detik), angka jadi merah + berkedip + membesar */
      .runner-timer.danger {
        transform: scale(1.1);
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

      /* Isi soal */
      .runner-body {
        flex: 1;
        max-width: 760px;
        width: 100%;
        margin: 0 auto;
        padding: 36px clamp(16px, 5vw, 32px) 48px;
        display: flex;
        flex-direction: column;
        position: relative;
        z-index: 1;
      }
      .runner-question-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-pop);
        padding: clamp(24px, 4vw, 40px);
        margin-bottom: 24px;
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
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: var(--teal-600);
        background: var(--teal-tint);
        padding: 5px 14px;
        border-radius: 99px;
        width: fit-content;
        margin: 0 auto 20px;
      }
      .runner-question {
        font-family: var(--font-display);
        font-size: clamp(19px, 3.2vw, 26px);
        font-weight: 700;
        color: var(--ink-900);
        line-height: 1.45;
        text-align: center;
        margin: 0;
      }
      .runner-options {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
      }
      @media (min-width: 640px) {
        .runner-options {
          grid-template-columns: 1fr 1fr;
        }
      }
      .runner-option {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 17px 18px;
        border: 2px solid var(--border);
        border-radius: var(--radius-md);
        background: var(--surface);
        cursor: pointer;
        transition:
          border-color 0.16s,
          background 0.16s,
          transform 0.12s,
          box-shadow 0.16s;
        text-align: left;
        font-family: var(--font-sans);
        box-shadow: var(--shadow-card);
        position: relative;
      }
      .runner-option:hover:not(:disabled) {
        border-color: var(--teal-500);
        transform: translateY(-3px);
        box-shadow: var(--shadow-pop);
      }
      .runner-option:disabled {
        cursor: default;
      }
      .runner-option-letter {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        background: var(--navy-tint);
        color: var(--navy-900);
        font-weight: 800;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: background 0.16s, color 0.16s;
      }
      .runner-option-text {
        font-size: 14.5px;
        font-weight: 600;
        color: var(--ink-900);
        flex: 1;
      }
      .runner-option-check {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: var(--teal-500);
        color: #fff;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: scale(0.5);
        transition: opacity 0.16s, transform 0.16s;
      }
      .runner-option-check svg {
        width: 12px;
        height: 12px;
      }
      /* State "terpilih" — netral, TIDAK menunjukkan benar/salah */
      .runner-option.selected {
        border-color: var(--teal-500);
        background: var(--teal-tint);
        box-shadow: 0 0 0 3px rgba(22, 160, 161, 0.14);
      }
      .runner-option.selected .runner-option-letter {
        background: var(--teal-600);
        color: #fff;
      }
      .runner-option.selected .runner-option-check {
        opacity: 1;
        transform: scale(1);
      }

      /* Tombol lanjut soal */
      .runner-next-wrap {
        margin-top: 28px;
        text-align: center;
        min-height: 48px;
      }
      .btn-next {
        display: none;
        align-items: center;
        gap: 8px;
        margin: 0 auto;
        background: linear-gradient(120deg, var(--navy-900), var(--navy-700));
        color: #fff;
        font-size: 13.5px;
        font-weight: 800;
        padding: 13px 40px;
        border-radius: 99px;
        border: none;
        cursor: pointer;
        box-shadow: var(--shadow-pop);
        transition:
          filter 0.18s,
          transform 0.18s;
      }
      .btn-next.show {
        display: inline-flex;
      }
      .btn-next:hover {
        filter: brightness(1.15);
        transform: translateY(-2px);
      }

      /* ============ LAYAR HASIL ============ */
      .runner-result {
        display: none;
        flex: 1;
        max-width: 500px;
        width: 100%;
        margin: 0 auto;
        padding: 36px clamp(16px, 5vw, 32px) 48px;
        text-align: center;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1;
      }
      .runner-result.show {
        display: flex;
      }
      .result-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-pop);
        padding: clamp(32px, 5vw, 48px) clamp(24px, 5vw, 40px);
        width: 100%;
        animation: cardIn 0.45s ease;
      }
      .result-score-ring {
        position: relative;
        width: 140px;
        height: 140px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .result-score-ring svg {
        position: absolute;
        inset: 0;
        transform: rotate(-90deg);
      }
      .result-score-val {
        font-family: var(--font-display);
        font-size: 36px;
        font-weight: 700;
        color: var(--navy-900);
        position: relative;
        z-index: 1;
        line-height: 1;
      }
      .result-score-lbl {
        font-size: 10px;
        color: var(--ink-400);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 2px;
        position: relative;
        z-index: 1;
      }
      .result-heading {
        font-family: var(--font-display);
        font-size: 23px;
        font-weight: 700;
        color: var(--ink-900);
        margin: 8px 0 6px;
      }
      .result-sub {
        font-size: 14px;
        color: var(--ink-600);
        font-weight: 600;
        margin: 0 0 8px;
      }
      .result-sub b {
        color: var(--teal-600);
        font-weight: 800;
      }
      .result-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 800;
        padding: 7px 18px;
        border-radius: 99px;
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
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        justify-content: center;
      }
      .btn-ulang {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: var(--teal-tint);
        color: var(--teal-600);
        border: none;
        border-radius: 99px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition:
          background 0.18s,
          color 0.18s,
          transform 0.15s;
      }
      .btn-ulang:hover {
        background: var(--teal-600);
        color: #fff;
        transform: translateY(-2px);
      }
      .btn-selesai {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        background: linear-gradient(120deg, var(--navy-900), var(--navy-700));
        color: #fff;
        border: none;
        border-radius: 99px;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        box-shadow: var(--shadow-pop);
        transition: filter 0.18s, transform 0.15s;
      }
      .btn-selesai:hover {
        filter: brightness(1.15);
        transform: translateY(-2px);
      }
      .btn-selesai:disabled {
        background: var(--border);
        color: var(--ink-400);
        box-shadow: none;
        cursor: not-allowed;
        transform: none;
      }
      .result-note {
        font-size: 12px;
        color: var(--ink-400);
        margin-top: 16px;
        max-width: 360px;
        line-height: 1.5;
      }
      .result-note.gagal {
        color: #b91c1c;
        font-weight: 600;
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
    <!-- ============ NAVBAR ============ -->
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
        <button class="runner-exit" onclick="keluarKuis()" aria-label="Keluar">
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
              d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <path
              id="runnerTimerArc"
              stroke="var(--lime-500)"
              stroke-width="3.5"
              stroke-linecap="round"
              fill="none"
              stroke-dasharray="100, 100"
              d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
            />
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
          <button class="btn-next" id="btnNext" onclick="soalBerikutnya()">
            Soal Berikutnya
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7" /></svg>
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
              d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <path
              id="resultScoreArc"
              stroke="url(#rg)"
              stroke-width="3"
              stroke-linecap="round"
              fill="none"
              stroke-dasharray="0, 100"
              d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
            />
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
          <button class="btn-ulang" onclick="ulangiKuis()">
            ↻ Ulangi Kuis
          </button>
          <button class="btn-selesai" id="btnSelesai" onclick="selesaiKuis()">
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
      /* =====================================================================
       *  ⚙️  PENGATURAN UTAMA — UBAH DI SINI SAJA
       * ===================================================================== */

      // ⏱️ WAKTU PER SOAL (dalam DETIK).
      //    Ubah angka ini untuk mengatur berapa detik tiap soal.
      //    Kalau ingin 40 detik, ganti jadi 40. Kalau 35 detik, ganti jadi 35.
      const WAKTU_PER_SOAL = 30; // <<< GANTI ANGKA DETIK DI SINI (contoh: 30, 35, 40)

      // 🎯 SKOR MINIMAL UNTUK LULUS (0–100).
      //    Kalau skor di bawah ini, tombol "Kirim Hasil" terkunci.
      const SKOR_LULUS = 75; // <<< GANTI BATAS KELULUSAN DI SINI

      /* =====================================================================
       *  📚  DATA KUIS — ISI SOAL DI SINI
       *  - Tiap kategori = 1 kartu di halaman depan.
       *  - "correctAnswer" = nomor urut jawaban benar, MULAI DARI 0.
       *      0 = Pilihan pertama (A), 1 = B, 2 = C, 3 = D.
       *  - "icon" & "warna" hanya untuk tampilan kartu (boleh diabaikan).
       * ===================================================================== */
      const DAFTAR_KUIS = [
        {
          id: "keuangan",
          judul: "Evaluasi Keuangan",
          deskripsi:
            "Uji pemahamanmu tentang UKT, beasiswa, dan administrasi keuangan mahasiswa.",
          warna: "linear-gradient(135deg,#f59e0b,#c2410c)", // warna latar ikon kartu
          soal: [
            {
              question: "Pertanyaan Keuangan No. 1: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0, // 0 = A benar
            },
            {
              question: "Pertanyaan Keuangan No. 2: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Keuangan No. 3: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Keuangan No. 4: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Keuangan No. 5: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Keuangan No. 6: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Keuangan No. 7: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Keuangan No. 8: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Keuangan No. 9: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Keuangan No. 10: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
          ],
        },
        {
          id: "akademik",
          judul: "Evaluasi Akademik",
          deskripsi:
            "Soal seputar KRS, SKS, dosen wali, dan aturan perkuliahan dasar.",
          warna: "linear-gradient(135deg,#0d9488,#1e40af)", // warna latar ikon kartu
          soal: [
            {
              question: "Pertanyaan Akademik No. 1: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0, // 0 = A benar
            },
            {
              question: "Pertanyaan Akademik No. 2: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Akademik No. 3: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Akademik No. 4: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Akademik No. 5: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Akademik No. 6: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Akademik No. 7: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Akademik No. 8: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Akademik No. 9: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Akademik No. 10: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
          ],
        },
        {
          id: "kemahasiswaan",
          judul: "Evaluasi Kemahasiswaan",
          deskripsi:
            "Materi organisasi kampus, tata tertib mahasiswa, dan LKMS.",
          warna: "linear-gradient(135deg,#9333ea,#3730a3)", // warna latar ikon kartu
          soal: [
            {
              question: "Pertanyaan Kemahasiswaan No. 1: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0, // 0 = A benar
            },
            {
              question: "Pertanyaan Kemahasiswaan No. 2: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Kemahasiswaan No. 3: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Kemahasiswaan No. 4: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Kemahasiswaan No. 5: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Kemahasiswaan No. 6: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Kemahasiswaan No. 7: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Kemahasiswaan No. 8: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Kemahasiswaan No. 9: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Kemahasiswaan No. 10: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
          ],
        },
        {
          id: "tatib",
          judul: "Evaluasi Tata Tertib",
          deskripsi:
            "Template evaluasi — silakan ganti dengan soal tata tertib kampus.",
          warna: "linear-gradient(135deg,#0891b2,#1e40af)", // warna latar ikon kartu
          soal: [
            {
              question: "Pertanyaan Tata Tertib No. 1: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0, // 0 = A benar
            },
            {
              question: "Pertanyaan Tata Tertib No. 2: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Tata Tertib No. 3: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Tata Tertib No. 4: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Tata Tertib No. 5: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Tata Tertib No. 6: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Tata Tertib No. 7: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Tata Tertib No. 8: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Tata Tertib No. 9: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Tata Tertib No. 10: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
          ],
        },
        {
          id: "organisasi",
          judul: "Evaluasi Organisasi",
          deskripsi:
            "Template evaluasi — silakan ganti dengan soal keorganisasian.",
          warna: "linear-gradient(135deg,#4f46e5,#6b21a8)", // warna latar ikon kartu
          soal: [
            {
              question: "Pertanyaan Organisasi No. 1: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0, // 0 = A benar
            },
            {
              question: "Pertanyaan Organisasi No. 2: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Organisasi No. 3: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Organisasi No. 4: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Organisasi No. 5: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Organisasi No. 6: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Organisasi No. 7: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Organisasi No. 8: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Organisasi No. 9: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Organisasi No. 10: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
          ],
        },
        {
          id: "kampus",
          judul: "Evaluasi Profil Kampus",
          deskripsi:
            "Template evaluasi — silakan ganti dengan soal profil & sejarah kampus.",
          warna: "linear-gradient(135deg,#9333ea,#be185d)", // warna latar ikon kartu
          soal: [
            {
              question: "Pertanyaan Profil Kampus No. 1: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0, // 0 = A benar
            },
            {
              question: "Pertanyaan Profil Kampus No. 2: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Profil Kampus No. 3: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Profil Kampus No. 4: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Profil Kampus No. 5: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Profil Kampus No. 6: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Profil Kampus No. 7: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Profil Kampus No. 8: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Profil Kampus No. 9: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
            {
              question: "Pertanyaan Profil Kampus No. 10: (tulis soal di sini)",
              options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D"],
              correctAnswer: 0,
            },
          ],
        },
      ];

      /* =====================================================================
       *  🔧  MULAI DARI SINI KE BAWAH ADALAH MESIN PROGRAM.
       *      Tidak perlu diubah kecuali kamu paham JavaScript.
       * ===================================================================== */

      // Menyimpan status tiap kuis: skor terbaik & apakah sudah lulus/dikirim
      const statusKuis = {};
      DAFTAR_KUIS.forEach((k) => {
        statusKuis[k.id] = { skorTerbaik: null, sudahKirim: false };
      });

      // Variabel jalannya kuis
      let kuisAktif = null; // objek kuis yang sedang dikerjakan
      let indexSoal = 0; // soal ke berapa (mulai 0)
      let jawabanUser = []; // menyimpan pilihan user tiap soal (null = tidak dijawab)
      let timerInterval = null; // penampung setInterval timer
      let sisaWaktu = WAKTU_PER_SOAL; // detik tersisa untuk soal ini

      // Ambil elemen HTML
      const pageDaftar = document.getElementById("pageDaftar");
      const quizGrid = document.getElementById("quizGridContainer");
      const runner = document.getElementById("quizRunner");
      const runnerBody = document.getElementById("runnerBody");
      const runnerResult = document.getElementById("runnerResult");

      /* ---------- RENDER KARTU KUIS DI HALAMAN DEPAN ---------- */
      function renderKartuKuis() {
        quizGrid.innerHTML = DAFTAR_KUIS.map((k) => {
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
                <button class="btn-mulai" onclick="mulaiKuis('${k.id}')">Mulai Kuis</button>
              </div>
            </div>
          `;
        }).join("");

        document.getElementById("kuisCount").innerText = DAFTAR_KUIS.length;
      }

      /* ---------- STATISTIK DI HERO ---------- */
      function renderStatHero() {
        const totalSoal = DAFTAR_KUIS.reduce((a, k) => a + k.soal.length, 0);
        const totalLulus = Object.values(statusKuis).filter(
          (s) => s.skorTerbaik !== null && s.skorTerbaik >= SKOR_LULUS,
        ).length;
        document.getElementById("statTotalKuis").innerText = DAFTAR_KUIS.length;
        document.getElementById("statTotalSoal").innerText = totalSoal;
        document.getElementById("statLulus").innerText = totalLulus;
      }

      /* ---------- MULAI MENGERJAKAN SEBUAH KUIS ---------- */
      function mulaiKuis(id) {
        kuisAktif = DAFTAR_KUIS.find((k) => k.id === id);
        indexSoal = 0;
        jawabanUser = new Array(kuisAktif.soal.length).fill(null);

        runner.classList.add("open");
        runnerBody.style.display = "flex";
        runnerResult.classList.remove("show");
        document.getElementById("runnerKategoriTag").innerText =
          kuisAktif.judul;
        document.body.style.overflow = "hidden"; // kunci scroll latar

        tampilkanSoal();
      }
      window.mulaiKuis = mulaiKuis;

      /* ---------- TAMPILKAN SATU SOAL ---------- */
      function tampilkanSoal() {
        const soal = kuisAktif.soal[indexSoal];
        const total = kuisAktif.soal.length;

        // Update progress bar & nomor soal
        document.getElementById("runnerQCount").innerText =
          `${indexSoal + 1} / ${total}`;
        document.getElementById("runnerProgressFill").style.width =
          `${(indexSoal / total) * 100}%`;

        // Tampilkan pertanyaan
        document.getElementById("runnerQuestion").innerText = soal.question;

        // Tampilkan pilihan jawaban (A, B, C, D...).
        // Kalau soal ini sudah pernah dipilih, tandai "selected" (netral, bukan benar/salah).
        const huruf = ["A", "B", "C", "D", "E", "F"];
        const pilihanSebelumnya = jawabanUser[indexSoal];
        document.getElementById("runnerOptions").innerHTML = soal.options
          .map((opt, i) => {
            const selected = pilihanSebelumnya === i ? "selected" : "";
            return `
              <button class="runner-option ${selected}" onclick="pilihJawaban(${i})">
                <span class="runner-option-letter">${huruf[i]}</span>
                <span class="runner-option-text">${opt}</span>
                <span class="runner-option-check">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5" /></svg>
                </span>
              </button>
            `;
          })
          .join("");

        // Mainkan ulang animasi masuk kartu soal setiap kali soal berganti
        const questionCard = document.getElementById("runnerQuestionCard");
        questionCard.style.animation = "none";
        void questionCard.offsetWidth;
        questionCard.style.animation = "";

        // Tombol "Soal Berikutnya" hanya muncul kalau soal ini sudah dijawab.
        const btnNext = document.getElementById("btnNext");
        if (pilihanSebelumnya !== null) {
          btnNext.classList.add("show");
        } else {
          btnNext.classList.remove("show");
        }

        // Mulai timer untuk soal ini
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

          // Kalau waktu habis -> langsung maju ke soal berikutnya.
          // (Jawaban yang sudah tersimpan tetap terpakai; jika kosong dianggap tidak dijawab.)
          if (sisaWaktu <= 0) {
            clearInterval(timerInterval);
            waktuHabis();
          }
        }, 1000);
      }

      function updateTampilanTimer() {
        const num = document.getElementById("runnerTimerNum");
        const arc = document.getElementById("runnerTimerArc");
        const wrap = document.getElementById("runnerTimer");
        num.innerText = sisaWaktu;
        // Panjang lingkaran timer mengecil seiring waktu
        const persen = (sisaWaktu / WAKTU_PER_SOAL) * 100;
        arc.setAttribute("stroke-dasharray", `${persen}, 100`);
        // 5 detik terakhir -> tanda merah berkedip
        if (sisaWaktu <= 5) {
          wrap.classList.add("danger");
        } else {
          wrap.classList.remove("danger");
        }
      }

      /* ---------- SAAT WAKTU HABIS ---------- */
      //  Langsung maju ke soal berikutnya. Kalau user sempat memilih, pilihannya
      //  tetap tersimpan; kalau belum, dianggap tidak dijawab. Benar/salah tidak
      //  diperlihatkan di sini — hanya muncul di layar hasil.
      function waktuHabis() {
        soalBerikutnya();
      }

      /* ---------- SAAT USER MEMILIH JAWABAN ---------- */
      //  Jawaban hanya disimpan & disorot (netral). Benar/salah TIDAK ditampilkan
      //  di sini. User masih boleh ganti pilihan selama belum klik "Soal Berikutnya".
      function pilihJawaban(pilihan) {
        jawabanUser[indexSoal] = pilihan; // simpan pilihan

        // Sorot opsi yang dipilih, hapus sorot dari opsi lain
        const tombol = document.querySelectorAll(".runner-option");
        tombol.forEach((btn, i) => {
          btn.classList.toggle("selected", i === pilihan);
        });

        // Tampilkan tombol lanjut
        document.getElementById("btnNext").classList.add("show");
      }
      window.pilihJawaban = pilihJawaban;

      /* ---------- LANJUT KE SOAL BERIKUTNYA / SELESAI ---------- */
      function soalBerikutnya() {
        clearInterval(timerInterval); // stop timer soal sekarang
        indexSoal++;
        if (indexSoal < kuisAktif.soal.length) {
          tampilkanSoal();
          runner.scrollTo({ top: 0, behavior: "smooth" });
        } else {
          tampilkanHasil();
        }
      }
      window.soalBerikutnya = soalBerikutnya;

      /* ---------- TAMPILKAN HASIL AKHIR ---------- */
      function tampilkanHasil() {
        clearInterval(timerInterval);
        const total = kuisAktif.soal.length;

        // Hitung jumlah benar dari jawaban yang tersimpan
        let jumlahBenar = 0;
        kuisAktif.soal.forEach((soal, i) => {
          if (jawabanUser[i] === soal.correctAnswer) jumlahBenar++;
        });

        const skor = Math.round((jumlahBenar / total) * 100);
        const lulus = skor >= SKOR_LULUS;

        // Simpan skor terbaik
        const st = statusKuis[kuisAktif.id];
        if (st.skorTerbaik === null || skor > st.skorTerbaik) {
          st.skorTerbaik = skor;
        }

        // Progress bar penuh
        document.getElementById("runnerProgressFill").style.width = "100%";

        // Isi tampilan hasil
        document.getElementById("resultScoreVal").innerText = skor;
        document
          .getElementById("resultScoreArc")
          .setAttribute("stroke-dasharray", `${skor}, 100`);
        document.getElementById("resultHeading").innerText = lulus
          ? "Selamat, Kamu Lulus! 🎉"
          : "Belum Lulus 😔";
        document.getElementById("resultSub").innerHTML =
          `Jawaban benar <b>${jumlahBenar}</b> dari <b>${total}</b> soal.`;

        document.getElementById("resultStatusWrap").innerHTML = lulus
          ? `<span class="result-status-pill lulus">✓ Lulus (minimal ${SKOR_LULUS})</span>`
          : `<span class="result-status-pill gagal">✕ Belum Lulus (minimal ${SKOR_LULUS})</span>`;

        // Aturan tombol Kirim: hanya aktif kalau lulus
        const btnSelesai = document.getElementById("btnSelesai");
        const note = document.getElementById("resultNote");
        btnSelesai.disabled = !lulus;
        if (lulus) {
          note.className = "result-note";
          note.innerText =
            "Skormu sudah memenuhi syarat. Kamu tetap boleh mengulang untuk skor lebih tinggi sebelum mengirim.";
        } else {
          note.className = "result-note gagal";
          note.innerText = `Skormu masih di bawah ${SKOR_LULUS}. Tombol "Kirim Hasil" terkunci — silakan ulangi kuis.`;
        }

        // Tampilkan layar hasil, sembunyikan soal
        runnerBody.style.display = "none";
        runnerResult.classList.add("show");
        runner.scrollTo({ top: 0, behavior: "smooth" });
      }

      /* ---------- ULANGI KUIS DARI AWAL ---------- */
      function ulangiKuis() {
        indexSoal = 0;
        jawabanUser = new Array(kuisAktif.soal.length).fill(null);
        runnerResult.classList.remove("show");
        runnerBody.style.display = "flex";
        tampilkanSoal();
      }
      window.ulangiKuis = ulangiKuis;

      /* ---------- KIRIM HASIL (hanya bila lulus) ---------- */
      function selesaiKuis() {
        statusKuis[kuisAktif.id].sudahKirim = true;
        alert(`Hasil kuis "${kuisAktif.judul}" berhasil dikirim!`);
        keluarKuis();
      }
      window.selesaiKuis = selesaiKuis;

      /* ---------- KELUAR DARI MODE KUIS ---------- */
      function keluarKuis() {
        clearInterval(timerInterval);
        runner.classList.remove("open");
        document.body.style.overflow = ""; // buka lagi scroll latar
        renderKartuKuis(); // perbarui status kartu
        renderStatHero();
      }
      window.keluarKuis = keluarKuis;

      /* ---------- NAVBAR HAMBURGER (mobile) ---------- */
   

      /* ---------- JALANKAN SAAT HALAMAN DIBUKA ---------- */
      renderKartuKuis();
      renderStatHero();

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO — sama seperti absensi/materi/denah.html.
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