<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Denah Kampus | PKKMB-KT UNILAM 2026</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <style>
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
        --amber-500: #e0a728;
        --amber-tint: #fbf1dc;
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
        transform: translateX(0);
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
          transform: none;
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

      /* ======================================================================
         ►► HERO — TEKS SEKARANG RATA KIRI, meniru gaya materi.html
         (hero-info-left rata kiri, bukan lagi terpusat di tengah).
      ====================================================================== */
      .hero-info {
        position: relative;
        overflow: hidden;
        min-height: 260px;
        padding: clamp(40px, 7vw, 64px) clamp(16px, 5vw, 48px);
        display: flex;
        align-items: center;
        justify-content: flex-start;
      }
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
        max-width: 640px;
        margin: 0;
        text-align: left;
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
        max-width: 560px;
        margin: 0;
      }

      .content-wrap {
        max-width: 1180px;
        margin: 0 auto;
        padding: 28px clamp(16px, 5vw, 48px);
        padding-bottom: calc(var(--bottomnav-h) + 28px);
      }
      @media (min-width: 768px) {
        .content-wrap {
          padding-bottom: 28px;
        }
      }

      .map-shell {
        display: grid;
        grid-template-columns: 1fr;
        gap: 18px;
      }
      /* ►► MODE HP — peta ditampilkan lebih dulu di atas, daftar lokasi
         (sidebar cari + list) ditaruh di bawahnya. */
      .map-sidebar {
        order: 2;
      }
      .map-panel {
        order: 1;
      }
      @media (min-width: 900px) {
        .map-shell {
          grid-template-columns: 300px 1fr;
          align-items: start;
        }
        /* Di desktop, balik ke urutan normal: sidebar di kiri, peta di kanan */
        .map-sidebar {
          order: 0;
        }
        .map-panel {
          order: 0;
        }
      }

      .map-sidebar {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-card);
        padding: 18px;
      }
      .map-search {
        position: relative;
        margin-bottom: 14px;
      }
      .map-search i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--ink-400);
        font-size: 13px;
      }
      .map-search input {
        width: 100%;
        padding: 11px 14px 11px 38px;
        border-radius: 12px;
        border: 1px solid var(--border);
        background: var(--bg);
        font-family: var(--font-sans);
        font-size: 13px;
        color: var(--ink-900);
      }
      .map-search input:focus {
        outline: none;
        border-color: var(--teal-500);
        background: #fff;
        box-shadow: 0 0 0 4px var(--teal-tint);
      }

      .map-loclist {
        display: flex;
        flex-direction: column;
        gap: 6px;
        max-height: 440px;
        overflow-y: auto;
        padding-right: 2px;
      }
      .map-loclist::-webkit-scrollbar {
        width: 5px;
      }
      .map-loclist::-webkit-scrollbar-thumb {
        background: var(--border);
        border-radius: 10px;
      }

      .map-loc-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 12px;
        border: 1px solid transparent;
        background: transparent;
        cursor: pointer;
        text-align: left;
        width: 100%;
        font-family: var(--font-sans);
        transition: background 0.15s, border-color 0.15s;
      }
      .map-loc-item:hover {
        background: var(--bg);
      }
      .map-loc-item.active {
        background: var(--teal-tint);
        border-color: var(--teal-500);
      }
      .map-loc-icon {
        flex-shrink: 0;
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        color: #fff;
      }
      .map-loc-name {
        font-size: 13px;
        font-weight: 700;
        color: var(--ink-900);
      }
      .map-loc-cat {
        font-size: 10.5px;
        color: var(--ink-400);
        display: block;
      }

      .map-panel {
        position: relative;
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-card);
        overflow: hidden;
      }
      /* ►► RASIO PETA — DIBUAT SAMA DI SEMUA UKURAN LAYAR (tidak ada lagi
         media query yang mengubah aspect-ratio khusus desktop), dan
         gambarnya pakai <img object-fit:contain> (bukan background-image
         cover). Ini kunci supaya posisi pin (persen top/left) SELALU
         jatuh di titik yang sama persis pada gambar, baik di HP maupun
         di laptop/desktop — sebelumnya rasio beda di desktop bikin
         gambar ke-crop beda, jadi pin kelihatan geser-geser. */
      .map-image-wrap {
        position: relative;
        width: 100%;
        aspect-ratio: 4 / 3;
        background: var(--navy-tint);
        overflow: hidden;
      }
      .map-image-wrap img.map-image {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        display: block;
      }

      /* ►► PIN LOKASI DI ATAS PETA — posisi diatur pakai persen (top/left),
         dihitung terhadap gambar denah itu sendiri (object-fit: contain),
         jadi tetap konsisten di semua ukuran layar. Kalau posisi pin
         belum pas, geser angka "top"/"left" di array lokasiKampus pada
         bagian <script> di bawah (bukan di HTML — pin dibuat otomatis). */
      .map-pin {
        position: absolute;
        transform: translate(-50%, -100%) rotate(-45deg);
        width: 30px;
        height: 30px;
        border-radius: 50% 50% 50% 0;
        transform-origin: bottom center;
        background: var(--teal-500);
        border: 2.5px solid #fff;
        box-shadow: var(--shadow-pop);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 12px;
        cursor: pointer;
        touch-action: none;
        transition: transform 0.15s, background 0.15s;
      }
      .map-pin span.map-pin-icon-wrap {
        display: block;
        transform: rotate(45deg);
      }
      .map-pin:hover,
      .map-pin.active {
        background: var(--navy-900);
        transform: translate(-50%, -100%) rotate(-45deg) scale(1.12);
      }

      /* ►► LEGENDA — sekarang jadi bar statis di BAWAH gambar peta (bukan
         mengambang di atas gambar), supaya tidak menutupi denahnya. */
      .map-legend {
        border-top: 1px solid var(--border);
        background: var(--surface);
        padding: 10px 14px;
        font-size: 10.5px;
        color: var(--ink-600);
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
      }
      .map-legend span {
        display: inline-flex;
        align-items: center;
        gap: 4px;
      }
      .map-legend i {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
      }

      /* ======================================================================
         ►► TOOLBAR PETA — bar tipis di ATAS gambar berisi SATU tombol
         pilihan mode pin ("Tanpa Pin" / "Pakai Pin" bergantian saat
         diklik). Ditaruh di luar area gambar supaya tidak pernah
         menutupi denahnya.
      ====================================================================== */
      .map-toolbar {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 8px 12px;
        border-bottom: 1px solid var(--border);
        background: var(--surface);
      }
      .map-pin-mode {
        display: flex;
        align-items: center;
        gap: 7px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 99px;
        padding: 7px 14px;
        font-size: 11.5px;
        font-weight: 700;
        color: var(--ink-600);
        cursor: pointer;
        transition: background 0.15s, color 0.15s, border-color 0.15s;
      }
      .map-pin-mode:hover {
        border-color: var(--teal-500);
        color: var(--teal-600);
      }
      .map-pin-mode.pins-on {
        background: var(--navy-900);
        border-color: var(--navy-900);
        color: #fff;
      }
      .map-pin-mode i {
        font-size: 12px;
      }
      /* Saat mode "Tanpa Pin" aktif: sembunyikan semua pin di peta */
      .map-image-wrap.pins-hidden .map-pin {
        display: none;
      }

      .map-detail {
        position: fixed;
        inset: 0;
        background: rgba(10, 15, 40, 0.45);
        display: none;
        align-items: flex-end;
        justify-content: center;
        z-index: 60;
        padding: 0;
      }
      .map-detail.open {
        display: flex;
      }
      @media (min-width: 700px) {
        .map-detail {
          align-items: center;
          padding: 20px;
        }
      }
      .map-detail-card {
        background: var(--surface);
        width: 100%;
        max-width: 420px;
        border-radius: 24px 24px 0 0;
        max-height: 86vh;
        overflow-y: auto;
        box-shadow: var(--shadow-pop);
        animation: detailUp 0.25s ease;
      }
      @media (min-width: 700px) {
        .map-detail-card {
          border-radius: 24px;
        }
      }
      @keyframes detailUp {
        from {
          transform: translateY(24px);
          opacity: 0;
        }
        to {
          transform: translateY(0);
          opacity: 1;
        }
      }
      .map-detail-head {
        padding: 18px 20px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .map-detail-head h3 {
        font-family: var(--font-display);
        font-size: 18px;
        color: var(--ink-900);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
      }
      .map-detail-close {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: none;
        background: var(--bg);
        color: var(--ink-600);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .map-detail-body {
        padding: 20px;
      }

      /* ======================================================================
         ►► GALERI FOTO LOKASI — geser dengan tombol panah kiri/kanan
         ("‹" / "›") dan titik indikator di bawah, menampilkan foto asli
         tiap lokasi dari field "fotos" pada data lokasiKampus.
      ====================================================================== */
      .map-detail-gallery {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 9;
        border-radius: 14px;
        overflow: hidden;
        background: var(--navy-tint);
        margin-bottom: 16px;
      }
      .map-detail-gallery-track {
        display: flex;
        height: 100%;
        transition: transform 0.35s ease;
      }
      .gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        flex-shrink: 0;
      }
      .gallery-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: rgba(10, 15, 40, 0.55);
        color: #fff;
        font-size: 18px;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.15s, transform 0.15s;
      }
      .gallery-nav:hover {
        background: rgba(10, 15, 40, 0.8);
        transform: translateY(-50%) scale(1.08);
      }
      .gallery-nav.prev {
        left: 8px;
      }
      .gallery-nav.next {
        right: 8px;
      }
      .gallery-dots {
        position: absolute;
        bottom: 8px;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        gap: 6px;
      }
      .gallery-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.55);
        cursor: pointer;
        transition: background 0.15s, transform 0.15s;
        border: none;
        padding: 0;
      }
      .gallery-dot.active {
        background: #fff;
        transform: scale(1.3);
      }

      .map-detail-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid var(--border);
        font-size: 13px;
      }
      .map-detail-row span:first-child {
        color: var(--ink-400);
        font-weight: 600;
      }
      .map-detail-row span:last-child {
        color: var(--ink-900);
        font-weight: 700;
      }
      .map-detail-desc {
        font-size: 13.5px;
        color: var(--ink-600);
        line-height: 1.7;
        margin: 14px 0 0;
      }
      .map-detail-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
      }
      .btn-map-primary {
        flex: 1;
        text-align: center;
        background: var(--navy-900);
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 12px 0;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
      }
      .btn-map-outline {
        flex: 1;
        text-align: center;
        background: var(--bg);
        color: var(--ink-900);
        font-weight: 700;
        font-size: 13px;
        padding: 12px 0;
        border-radius: 12px;
        border: 1px solid var(--border);
        cursor: pointer;
      }

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
      @media (max-width: 767px) {
        .footer {
          padding-bottom: calc(var(--bottomnav-h) + 16px);
        }
      }

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

      

      <nav class="navbar-links" id="navbarLinks">
        <a href="{{ route('role.student.modul') }}">Modul</a>
        <a href="{{ route('role.student.leaderboard') }}">Leaderboard</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('role.student.info') }}">Info</a>
        <a href="{{ route('role.student.profil') }}">Profil</a>
      </nav>
    </header>

    <!-- ============ HERO — RATA KIRI (samakan gaya materi.html) ============ -->
    <section class="hero-info">
      <div class="hero-slideshow" id="heroSlideshow"></div>
      <div class="hero-info-inner">
        <div class="hero-eyebrow">
          <span class="dot"></span>
          Orientasi Lokasi
        </div>
        <h1>Denah Kampus<br />UNILAM Rangkasbitung</h1>
        <p class="hero-info-sub">
          Cari dan kenali lokasi gedung, fasilitas, dan area penting di
          kampus Universitas La Tansa Mashiro.
        </p>
      </div>
    </section>

    <div class="content-wrap">
      <div class="map-shell">
        <aside class="map-sidebar">
          <div class="map-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input
              type="text"
              id="mapSearchInput"
              placeholder="Cari ruangan atau lokasi..."
            />
          </div>
          <div class="map-loclist" id="mapLocList"></div>
        </aside>

        <div class="map-panel">
          <div class="map-toolbar">
            <button type="button" class="map-pin-mode pins-on" id="mapPinMode">
              <i class="fa-solid fa-location-dot"></i>
              <span id="mapPinModeLabel">Pakai Pin</span>
            </button>
          </div>
          <div class="map-image-wrap" id="mapImageWrap">
            <img class="map-image" src="{{ asset('gambar/denah.jpeg') }}" alt="Denah Kampus UNILAM" />
          </div>
          <div class="map-legend">
            <span><i style="background: var(--teal-500)"></i>Gedung / Ruang</span>
            <span><i style="background: var(--lime-500)"></i>Fasilitas Umum</span>
            <span><i style="background: var(--navy-600)"></i>Area Parkir</span>
          </div>
        </div>
      </div>
    </div>

    <!-- ============ MODAL DETAIL LOKASI — GALERI FOTO GESER ============ -->
    <div class="map-detail" id="mapDetail">
      <div class="map-detail-card">
        <div class="map-detail-head">
          <h3 id="detailTitle"><i data-lucide="map-pin"></i> Nama Lokasi</h3>
          <button class="map-detail-close" id="detailClose">
            <i data-lucide="x"></i>
          </button>
        </div>
        <div class="map-detail-body">
          <!-- ►► GALERI FOTO — diisi otomatis oleh JS dari field "fotos"
               tiap lokasi (bisa lebih dari 1 foto, geser pakai tombol
               ‹ › atau titik indikator di bawah) -->
          <div class="map-detail-gallery" id="detailGallery">
            <div class="map-detail-gallery-track" id="detailGalleryTrack"></div>
            <button class="gallery-nav prev" id="galleryPrev" aria-label="Foto sebelumnya">‹</button>
            <button class="gallery-nav next" id="galleryNext" aria-label="Foto berikutnya">›</button>
            <div class="gallery-dots" id="galleryDots"></div>
          </div>
          <div class="map-detail-row">
            <span>Kategori</span>
            <span id="detailKategori">-</span>
          </div>
          <div class="map-detail-row">
            <span>Lantai</span>
            <span id="detailLantai">-</span>
          </div>
          <p class="map-detail-desc" id="detailDesc">-</p>
          <div class="map-detail-actions">
            <button class="btn-map-outline" id="detailCloseBtn">Tutup</button>
            <a
              class="btn-map-primary"
              id="detailRuteBtn"
              href="#"
              target="_blank"
              rel="noopener noreferrer"
              >Lihat Rute</a
            >
          </div>
        </div>
      </div>
    </div>

    <footer class="footer">
      <p>© 2026 PKKMB-KT UNILAM. Semua hak dilindungi.</p>
      <div class="footer-links">
        <a href="{{ route('landing.kebijakan-privasi') }}">Kebijakan Privasi</a>
        <a href="{{ route('landing.syarat-ketentuan') }}">Syarat &amp; Ketentuan</a>
        <a href="{{ route('landing.bantuan') }}">Bantuan</a>
      </div>
    </footer>

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
        <span>Leaderboard</span>
      </a>
      <a href="{{ route('dashboard') }}" class="home" aria-label="Beranda">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 11.5 12 4l8 7.5" />
          <path d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10" />
        </svg>
        <span>Beranda</span>
      </a>
      <a href="{{ route('role.student.info') }}">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 17H4l1.4-1.4A2 2 0 0 0 6 14.2V11a6 6 0 1 1 12 0v3.2c0 .5.2 1 .6 1.4L20 17h-5" />
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
      // ======================================================================
      // ►► DATA LOKASI KAMPUS — TAMBAH / EDIT DI SINI
      //    - "top" / "left"  = koordinat pin untuk DESKTOP (persen 0–100).
      //    - "topMobile" / "leftMobile" = koordinat pin KHUSUS mode HP.
      //      Kalau field ini kosong (undefined), otomatis pakai top/left biasa.
      //    - "mapsUrl" (OPSIONAL) = link Google Maps asli lokasi itu
      //      (contoh: "https://maps.app.goo.gl/xxxxx"). Kalau diisi, tombol
      //      "Lihat Rute" akan langsung buka link ini. Kalau TIDAK diisi,
      //      otomatis pakai pencarian umum Google Maps berdasarkan nama.
      //    - "fotos" = array path foto ASLI lokasi (WAJIB diisi supaya
      //      galeri di modal detail menampilkan foto sungguhan, bukan
      //      placeholder). Boleh isi 1 foto atau lebih (misal tampak luar
      //      & tampak dalam) — kalau lebih dari 1, otomatis muncul tombol
      //      geser ‹ › dan titik indikator di bawah galeri.
      //      Simpan semua file foto di folder "{{ asset('gambar/Peta/') }}" dengan nama
      //      sesuai lokasinya, contoh: "{{ asset('gambar/Peta/Gedung A.jpeg') }}".
      // ======================================================================
      const lokasiKampus = [
        { id: "gerbang", nama: "Gerbang", kategori: "fasilitas", lantai: "-", top: 81.4, left: 58.2, topMobile: 81.2, leftMobile: 59.3, icon: "fa-door-open", mapUrl: "https://maps.app.goo.gl/MBPQcipRZC3NZxuv8", desc: "Pintu masuk utama menuju area kampus UNILAM.", fotos: ["{{ asset('gambar/Peta/Gerbang.jpeg') }}"] },
        { id: "gedung-utama", nama: "Gedung Utama (GU)", kategori: "gedung", lantai: "3 Lantai", top: 59.7, left: 78.7, topMobile: 57.9, leftMobile: 79.4, icon: "fa-building", mapsUrl: "https://maps.app.goo.gl/ycUFd26rhdKD292i6", desc: "Berisi ruang kuliah FTI, FKES, FEB, FKIP, Perpustakaan, BAAK, BAUM, Kemahasiswaan & Alumni, hingga ruang kerja sama dan Warek.", fotos: ["{{ asset('gambar/Peta/GedungUtama.jpeg') }}"] },
        { id: "gedung-rektor", nama: "Gedung Rektor", kategori: "gedung", lantai: "1 Lantai", top: 43.7, left: 88.0, topMobile: 40.7, leftMobile: 89.5, icon: "fa-user-tie", mapsUrl: "https://maps.app.goo.gl/V7gXRZceAq7e9tct7", desc: "Ruang dosen dan ruang kerja pimpinan rektorat.", fotos: ["{{ asset('gambar/Peta/GedungRektor.jpeg') }}"] },
        { id: "gedung-d", nama: "Gedung D", kategori: "gedung", lantai: "3 Lantai", top: 43.8, left: 94.5, topMobile: 42.4, leftMobile: 96.59, icon: "fa-building", mapsUrl: "https://maps.app.goo.gl/V7gXRZceAq7e9tct7", desc: "Ruang kelas D101–D203 beserta ruang dosen.", fotos: ["{{ asset('gambar/Peta/GedungD.jpeg') }}"] },
        { id: "gedung-c", nama: "Gedung C", kategori: "gedung", lantai: "2 Lantai", top: 20.3, left: 70.0, topMobile: 19.2, leftMobile: 71.4, icon: "fa-building", mapsUrl: "https://maps.app.goo.gl/P8XqX28CNXHby38f9", desc: "Ruang kelas C101–C205 beserta ruang dosen.", fotos: ["{{ asset('gambar/Peta/GedungC.jpeg') }}"] },
        { id: "gedung-e", nama: "Gedung E", kategori: "gedung", lantai: "1 Lantai", top: 30.6, left: 93.0, topMobile: 31.8, leftMobile: 94.7, icon: "fa-building", mapsUrl: "https://maps.app.goo.gl/V7gXRZceAq7e9tct7", desc: "Ruang kelas E101–E105.", fotos: ["{{ asset('gambar/Peta/GedungE.jpeg') }}"] },
        { id: "gedung-b", nama: "Gedung B", kategori: "gedung", lantai: "2 Lantai", top: 28.5, left: 49.3, topMobile: 26.6, leftMobile: 50.8, icon: "fa-building", mapsUrl: "https://maps.app.goo.gl/JiN2YzUsy4GUxymk9", desc: "Lab Jaringan, Lab Office, Ruang Operator, Lab Bidan, dan ruang kelas B101–B103.", fotos: ["{{ asset('gambar/Peta/GedungB.jpeg') }}"] },
        { id: "gedung-a", nama: "Gedung A", kategori: "gedung", lantai: "2 Lantai", top: 28.8, left: 17.6, topMobile: 26.1, leftMobile: 19.4, icon: "fa-building", mapsUrl: "https://maps.app.goo.gl/dZ4f7UFTHPiXRTDs7", desc: "Ruang kelas A101–A206 beserta ruang dosen.", fotos: ["{{ asset('gambar/Peta/GedungA.jpeg') }}"] },
        { id: "hall", nama: "Hall", kategori: "fasilitas", lantai: "-", top: 29.0, left: 75.6, topMobile: 28.7, leftMobile: 76.3, icon: "fa-people-roof", mapsUrl: "https://maps.app.goo.gl/nNcymRQvDA8oK98X9", desc: "Aula serbaguna untuk acara dan kegiatan besar kampus.", fotos: ["{{ asset('gambar/Peta/Hall.jpeg') }}"] },
        { id: "wisma-hall", nama: "Wisma Hall", kategori: "fasilitas", lantai: "-", top: 21.5, left: 80.4, topMobile: 20.2, leftMobile: 81.9, icon: "fa-hotel", mapsUrl: "https://maps.app.goo.gl/EoyvSJKDSNYGehZM8", desc: "Wisma / penginapan tamu di area Hall.", fotos: ["{{ asset('gambar/Peta/Wisma Hall.jpeg') }}"] },
        { id: "asrama", nama: "Asrama", kategori: "fasilitas", lantai: "-", top: 26.4, left: 42.0, topMobile: 25.5, leftMobile: 43.8, icon: "fa-bed", mapsUrl: "https://maps.app.goo.gl/vj21sy7fqoQvcr8m8", desc: "Tempat tinggal mahasiswa yang tinggal di lingkungan kampus.", fotos: ["{{ asset('gambar/Peta/Asrama.jpeg') }}"] },
        { id: "masjid", nama: "Masjid", kategori: "fasilitas", lantai: "-", top: 51.2, left: 42.1, topMobile: 48.7, leftMobile: 42.9, icon: "fa-mosque", mapsUrl: "https://maps.app.goo.gl/y54KYaheSWAk9WeM8", desc: "Masjid kampus untuk kegiatan ibadah civitas akademika.", fotos: ["{{ asset('gambar/Peta/Masjid.jpeg') }}"] },
        { id: "pmb-lkms", nama: "PMB / LKMS", kategori: "fasilitas", lantai: "-", top: 41.7, left: 49.1, topMobile: 40.8, leftMobile: 50.7, icon: "fa-building-columns", mapsUrl: "https://maps.app.goo.gl/Cs95mdjqwHF5tgYp6", desc: "Kantor Penerimaan Mahasiswa Baru dan LKMS.", fotos: ["{{ asset('gambar/Peta/LKMS.jpeg') }}"] },
        { id: "food-court", nama: "Food Court Unilam", kategori: "fasilitas", lantai: "-", top: 49.4, left: 73.0, topMobile: 49.3, leftMobile: 70.7, icon: "fa-utensils", mapsUrl: "https://maps.app.goo.gl/PWhyG9F517Rcwppx5", desc: "Area kantin dan tempat makan mahasiswa.", fotos: ["{{ asset('gambar/Peta/FoodCourt.jpeg') }}"] },
        { id: "lapangan-voli", nama: "Lapangan Bola Voli", kategori: "fasilitas", lantai: "-", top: 59.0, left: 49.1, topMobile: 59.1, leftMobile: 51.0, icon: "fa-volleyball", mapsUrl: "https://maps.app.goo.gl/eAaspu2C7dKtssqy7", desc: "Lapangan olahraga bola voli kampus.", fotos: ["{{ asset('gambar/Peta/LapanganBolaVoli.jpeg') }}"] },
        { id: "lapangan-putsal", nama: "Lapangan Putsal", kategori: "fasilitas", lantai: "-", top: 59.0, left: 41.7, topMobile: 59.1, leftMobile: 44.4, icon: "fa-futbol", mapsUrl: "https://maps.app.goo.gl/eAaspu2C7dKtssqy7", desc: "Lapangan olahraga futsal kampus.", fotos: ["{{ asset('gambar/Peta/LapanganBola.jpeg') }}"] },
        { id: "parkir-mobil", nama: "Parkir Mobil", kategori: "parkir", lantai: "-", top: 70.2, left: 79.0, topMobile: 70.0, leftMobile: 75.2, icon: "fa-square-parking", mapsUrl: "https://maps.app.goo.gl/ZhKLZPcFxYDbWMpV6", desc: "Area parkir kendaraan roda empat.", fotos: ["{{ asset('gambar/Peta/ParkirMobil.jpeg') }}"] },
        { id: "parkir-motor", nama: "Parkir Motor", kategori: "parkir", lantai: "-", top: 76.7, left: 78.7, topMobile: 74.4, leftMobile: 80.7, icon: "fa-motorcycle", mapsUrl: "https://maps.app.goo.gl/ZhKLZPcFxYDbWMpV6", desc: "Area parkir kendaraan roda dua.", fotos: ["{{ asset('gambar/Peta/ParkirMobil.jpeg') }}"] },
        { id: "parkir-motormahasiswa", nama: "Parkir Mobil", kategori: "parkir", lantai: "-", top: 43.0, left: 73.0, topMobile: 43.0, leftMobile: 75.7, icon: "fa-square-parking", mapsUrl: "https://maps.app.goo.gl/ZhKLZPcFxYDbWMpV6", desc: "Area parkir kendaraan roda empat.", fotos: ["{{ asset('gambar/Peta/ParkirMotor.jpeg') }}"] },     
      ];

      const kategoriColor = {
        gedung: "var(--teal-500)",
        fasilitas: "var(--lime-500)",
        parkir: "var(--navy-600)",
      };
      const kategoriLabel = {
        gedung: "Gedung / Ruang Kelas",
        fasilitas: "Fasilitas Umum",
        parkir: "Area Parkir",
      };

      // ►► Batas mode HP vs desktop — SAMA dengan breakpoint sidebar/bottom-nav
      // di CSS (min-width: 768px), supaya konsisten dengan tampilan lainnya.
      function isMobileViewport() {
        return window.innerWidth < 768;
      }
      function getEffectiveTop(loc) {
        return isMobileViewport() && loc.topMobile != null
          ? loc.topMobile
          : loc.top;
      }
      function getEffectiveLeft(loc) {
        return isMobileViewport() && loc.leftMobile != null
          ? loc.leftMobile
          : loc.left;
      }

      const mapImageWrap = document.getElementById("mapImageWrap");
      const mapLocList = document.getElementById("mapLocList");
      const mapSearchInput = document.getElementById("mapSearchInput");

      function renderSidebar(filterKeyword = "") {
        const keyword = filterKeyword.trim().toLowerCase();
        mapLocList.innerHTML = lokasiKampus
          .filter((loc) => loc.nama.toLowerCase().includes(keyword))
          .map(
            (loc) => `
              <button class="map-loc-item" data-id="${loc.id}">
                <span class="map-loc-icon" style="background:${kategoriColor[loc.kategori]}">
                  <i class="fa-solid ${loc.icon}"></i>
                </span>
                <span>
                  <span class="map-loc-name">${loc.nama}</span>
                  <span class="map-loc-cat">${kategoriLabel[loc.kategori]}</span>
                </span>
              </button>
            `,
          )
          .join("");

        mapLocList.querySelectorAll(".map-loc-item").forEach((btn) => {
          btn.addEventListener("click", () => bukaDetail(btn.dataset.id));
        });
      }

      function renderPins() {
        mapImageWrap.querySelectorAll(".map-pin").forEach((el) => el.remove());

        lokasiKampus.forEach((loc) => {
          const pin = document.createElement("button");
          pin.className = "map-pin";
          pin.id = `pin-${loc.id}`;
          pin.style.top = `${getEffectiveTop(loc)}%`;
          pin.style.left = `${getEffectiveLeft(loc)}%`;
          pin.style.background = kategoriColor[loc.kategori];
          pin.setAttribute("aria-label", loc.nama);
          pin.dataset.id = loc.id;
          pin.innerHTML = `<span class="map-pin-icon-wrap"><i class="fa-solid ${loc.icon}"></i></span>`;
          pin.addEventListener("click", () => bukaDetail(loc.id));
          mapImageWrap.appendChild(pin);
        });
      }

      // Render ulang pin saat layar berpindah antara mode HP <-> desktop
      // (misal rotasi HP, atau resize jendela browser), supaya set
      // koordinat yang dipakai selalu sesuai ukuran layar saat itu.
      let resizeTimer;
      window.addEventListener("resize", () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(renderPins, 200);
      });

      const mapDetail = document.getElementById("mapDetail");
      const detailTitle = document.getElementById("detailTitle");
      const detailKategori = document.getElementById("detailKategori");
      const detailLantai = document.getElementById("detailLantai");
      const detailDesc = document.getElementById("detailDesc");
      const detailRuteBtn = document.getElementById("detailRuteBtn");

      // ======================================================================
      // ►► GALERI FOTO — logika geser gambar (prev/next + titik indikator)
      // ======================================================================
      const galleryTrack = document.getElementById("detailGalleryTrack");
      const galleryDotsWrap = document.getElementById("galleryDots");
      const galleryPrevBtn = document.getElementById("galleryPrev");
      const galleryNextBtn = document.getElementById("galleryNext");
      let currentGalleryImages = [];
      let currentGalleryIndex = 0;

      function renderGallery(images) {
        currentGalleryImages = images;
        currentGalleryIndex = 0;

        galleryTrack.innerHTML = images
          .map((src) => `<img class="gallery-img" src="${src}" alt="Foto lokasi" />`)
          .join("");

        galleryDotsWrap.innerHTML = images
          .map(
            (_, i) =>
              `<button type="button" class="gallery-dot${i === 0 ? " active" : ""}" data-i="${i}" aria-label="Foto ke-${i + 1}"></button>`,
          )
          .join("");

        const multiple = images.length > 1;
        galleryPrevBtn.style.display = multiple ? "flex" : "none";
        galleryNextBtn.style.display = multiple ? "flex" : "none";
        galleryDotsWrap.style.display = multiple ? "flex" : "none";

        updateGalleryPosition();
      }

      function updateGalleryPosition() {
        galleryTrack.style.transform = `translateX(-${currentGalleryIndex * 100}%)`;
        galleryDotsWrap
          .querySelectorAll(".gallery-dot")
          .forEach((d, i) => d.classList.toggle("active", i === currentGalleryIndex));
      }

      galleryPrevBtn.addEventListener("click", () => {
        currentGalleryIndex =
          (currentGalleryIndex - 1 + currentGalleryImages.length) %
          currentGalleryImages.length;
        updateGalleryPosition();
      });
      galleryNextBtn.addEventListener("click", () => {
        currentGalleryIndex =
          (currentGalleryIndex + 1) % currentGalleryImages.length;
        updateGalleryPosition();
      });
      galleryDotsWrap.addEventListener("click", (e) => {
        const dot = e.target.closest(".gallery-dot");
        if (!dot) return;
        currentGalleryIndex = parseInt(dot.dataset.i, 10);
        updateGalleryPosition();
      });

      function bukaDetail(id) {
        const loc = lokasiKampus.find((l) => l.id === id);
        if (!loc) return;

        document
          .querySelectorAll(".map-pin.active, .map-loc-item.active")
          .forEach((el) => el.classList.remove("active"));
        document.getElementById(`pin-${id}`)?.classList.add("active");
        document
          .querySelector(`.map-loc-item[data-id="${id}"]`)
          ?.classList.add("active");

        detailTitle.innerHTML = `<i data-lucide="map-pin"></i> ${loc.nama}`;
        detailKategori.textContent = kategoriLabel[loc.kategori];
        detailLantai.textContent = loc.lantai;
        detailDesc.textContent = loc.desc;

        // ►► FOTO LOKASI — ambil dari "loc.fotos" (foto asli tiap lokasi).
        //    Kalau suatu lokasi belum diisi fotonya, tetap tampil 1 foto
        //    contoh placeholder supaya galeri tidak kosong/error.
        const fotos =
          loc.fotos && loc.fotos.length
            ? loc.fotos
            : [
                `https://placehold.co/700x420/16a0a1/ffffff?text=${encodeURIComponent(loc.nama)}`,
              ];
        renderGallery(fotos);

        // ►► LINK RUTE — kalau lokasi punya "mapsUrl" sendiri (link Google
        //    Maps asli, contoh: https://maps.app.goo.gl/xxxxx), tombol
        //    "Lihat Rute" akan langsung buka link itu. Kalau belum diisi,
        //    otomatis fallback ke pencarian umum berdasarkan nama lokasi.
        detailRuteBtn.href =
          loc.mapsUrl ||
          `https://www.google.com/maps/search/?api=1&query=Universitas+La+Tansa+Mashiro+${encodeURIComponent(loc.nama)}`;

        mapDetail.classList.add("open");
        lucide.createIcons();
      }

      function tutupDetail() {
        mapDetail.classList.remove("open");
        document
          .querySelectorAll(".map-pin.active, .map-loc-item.active")
          .forEach((el) => el.classList.remove("active"));
      }

      document.getElementById("detailClose").addEventListener("click", tutupDetail);
      document.getElementById("detailCloseBtn").addEventListener("click", tutupDetail);
      mapDetail.addEventListener("click", (e) => {
        if (e.target === mapDetail) tutupDetail();
      });

      mapSearchInput.addEventListener("input", (e) => renderSidebar(e.target.value));

      renderSidebar();
      renderPins();
      lucide.createIcons();

      // ======================================================================
      // ►► TOGGLE MODE PIN — satu tombol, bergantian "Tanpa Pin" <-> "Pakai Pin"
      // ======================================================================
      const mapPinMode = document.getElementById("mapPinMode");
      const mapPinModeLabel = document.getElementById("mapPinModeLabel");
      let pinsVisible = true;

      mapPinMode.addEventListener("click", () => {
        pinsVisible = !pinsVisible;
        mapImageWrap.classList.toggle("pins-hidden", !pinsVisible);
        mapPinMode.classList.toggle("pins-on", pinsVisible);
        mapPinModeLabel.textContent = pinsVisible ? "Pakai Pin" : "Tanpa Pin";
      });

      const heroSlideImages = [
        "{{ asset('gambar/gedungutama.jpeg') }}",
        "{{ asset('gambar/rektor.jpeg') }}",
        "{{ asset('gambar/gedung.jpeg') }}"];
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

      // Menu mobile (hamburger)
      
    </script>
  </body>
</html>