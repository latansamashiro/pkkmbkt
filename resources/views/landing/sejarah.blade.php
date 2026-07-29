<!doctype html>
<html lang="id">
  <head>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    />
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Sejarah Universitas La Tansa Mashiro</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;0,700;1,500&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <style>
      /* ============ TOKENS ============ */
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

        --paper: #f6f1e4;
        --ink: #2b2f45;

        --font-display: "Lora", serif;
        --font-sans: "Plus Jakarta Sans", sans-serif;
      }

      body {
        font-family: var(--font-sans);
        color: var(--ink);
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
      .bg-paper {
        background-color: var(--paper);
      }
      .border-teal-600 {
        border-color: var(--teal-600);
      }

      /* ============ NAVBAR — IDENTIK DENGAN HOME_PAGE.HTML ============ */
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
      }

      /* === SAMA PERSIS DENGAN HOME_PAGE.HTML === */
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

      /* HAMBURGER MENU BUTTON */
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
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0;
        right: -100%;
        width: 280px;
        height: 100vh;
        background: #0d1735;
        padding: 100px 32px 32px;
        gap: 24px;
        transition: right 0.3s ease;
        box-shadow: -5px 0 25px rgba(0, 0, 0, 0.3);
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
      }
      .navbar-links a:hover,
      .navbar-links a.active {
        color: #fff;
      }
      .navbar-links a.active {
        border-left: 3px solid var(--lime-500);
        padding-left: 8px;
      }

      /* ======================================================================
         DROPDOWN "TENTANG" — bisa dibuka/tutup (klik) berisi Sejarah & Visi Misi
      ====================================================================== */
      .nav-dropdown {
        position: relative;
        width: 100%;
      }
      .nav-dropdown-toggle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        gap: 8px;
        background: transparent;
        border: none;
        padding: 0;
        color: #c7cce8;
        font-family: var(--font-sans);
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: color 0.15s;
      }
      .nav-dropdown-toggle:hover,
      .nav-dropdown.open .nav-dropdown-toggle {
        color: #fff;
      }
      .nav-dropdown-toggle .dropdown-arrow {
        font-size: 12px;
        transition: transform 0.25s ease;
      }
      .nav-dropdown.open .dropdown-arrow {
        transform: rotate(180deg);
      }

      .nav-dropdown-menu {
        display: flex;
        flex-direction: column;
        gap: 14px;
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        padding-left: 14px;
        margin-top: 0;
        transition:
          max-height 0.3s ease,
          opacity 0.25s ease,
          margin-top 0.3s ease;
      }
      .nav-dropdown.open .nav-dropdown-menu {
        max-height: 220px;
        opacity: 1;
        margin-top: 14px;
      }
      .nav-dropdown-menu a {
        font-size: 14.5px;
        color: #9aa2cc;
      }
      .nav-dropdown-menu a::before {
        content: "— ";
        color: var(--lime-500);
      }
      .nav-dropdown-menu a:hover {
        color: #fff;
      }
      .nav-dropdown-menu a.active {
        color: #fff;
        font-weight: 700;
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

        .nav-dropdown {
          width: auto;
        }
        .nav-dropdown-toggle {
          width: auto;
          font-size: 13.5px;
        }
        .nav-dropdown-menu {
          position: absolute;
          top: calc(100% + 14px);
          left: 0;
          min-width: 170px;
          background: #0d1735;
          border: 1px solid rgba(255, 255, 255, 0.08);
          border-radius: 12px;
          padding: 12px 18px;
          box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
          gap: 10px;
          margin-top: 0;
          transform: translateY(-6px);
          transition:
            opacity 0.2s ease,
            transform 0.2s ease,
            visibility 0.2s ease;
          max-height: none;
          visibility: hidden;
        }
        .nav-dropdown.open .nav-dropdown-menu {
          margin-top: 0;
          transform: translateY(0);
          visibility: visible;
        }
        .nav-dropdown-menu a {
          padding: 0;
          white-space: nowrap;
        }
      }

      /* Arch Divider */
      .arch-divider {
        height: 22px;
        background-repeat: repeat-x;
        background-position: center;
        background-size: 44px 22px;
        opacity: 0.55;
      }
      .arch-divider svg {
        display: block;
        margin: 0 auto;
      }
      .prose-body p {
        margin-bottom: 1.1rem;
        line-height: 1.85;
      }

      /* ======================================================================
         ►► HERO — SEKARANG PAKAI SLIDESHOW BERGANTI-GANTI (SAMA SEPERTI
         HOME_PAGE.HTML), BUKAN 1 FOTO STATIS LAGI.
         - Untuk GANTI/TAMBAH FOTO: cari array "heroSlideImages" di bagian
           <script> paling bawah, tambah/hapus baris path foto di situ.
         - Untuk atur KECEPATAN GANTI FOTO: ubah "HERO_SLIDE_INTERVAL_MS".
         - Untuk atur GELAP-TERANG overlay di atas foto: ubah opacity di
           background gradient pada .hero-slideshow::after di bawah ini.
      ====================================================================== */
      .hero-photo {
        position: relative;
        isolation: isolate;
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
        transform: scale(1.06);
        transition:
          opacity 1.8s ease,
          transform 8s ease;
      }
      .hero-slide.active {
        opacity: 1;
        transform: scale(1);
      }
      .hero-slideshow::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
          180deg,
          rgba(8, 14, 42, 0.72) 0%,
          rgba(8, 14, 42, 0.58) 45%,
          rgba(8, 14, 42, 0.82) 100%
        );
      }
      .hero-photo > .relative {
        position: relative;
        z-index: 1;
      }

      /* Aksen dekoratif kecil di hero supaya lebih "hidup" */
      .hero-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        pointer-events: none;
        z-index: 0;
      }
      .hero-glow--teal {
        width: 260px;
        height: 260px;
        background: rgba(22, 160, 161, 0.35);
        top: -60px;
        left: -60px;
      }
      .hero-glow--lime {
        width: 220px;
        height: 220px;
        background: rgba(169, 199, 59, 0.28);
        bottom: -50px;
        right: -50px;
      }

      /* ======================================================================
         ►► REVEAL ON SCROLL — bikin tiap section muncul halus (fade+naik)
         saat mulai kelihatan di layar, biar halaman terasa lebih "hidup".
         Tidak mengubah struktur HTML, cuma tambah class "reveal" via JS
         pada tiap <section> dan toggle "is-visible" saat masuk viewport.
      ====================================================================== */
      .reveal {
        opacity: 0;
        transform: translateY(28px);
        transition:
          opacity 0.8s ease,
          transform 0.8s ease;
      }
      .reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
      }

      /* Foto-foto konten diberi efek hover halus supaya terasa premium */
      .photo-frame {
        overflow: hidden;
      }
      .photo-frame img {
        transition: transform 0.6s ease;
      }
      .photo-frame:hover img {
        transform: scale(1.045);
      }

      /* ======================================================================
         LINIMASA / TIMELINE BERANTAI — garis penghubung antar tahun
      ====================================================================== */
      .timeline-section {
        overflow: hidden;
      }
      .timeline-wrap {
        position: relative;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 6px;
      }
      .timeline-svg {
        position: absolute;
        top: 0;
        left: 0;
        pointer-events: none;
      }
      .timeline-track {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        min-width: 820px;
        position: relative;
        z-index: 1;
      }
      .timeline-item {
        position: relative;
        flex: 1;
        min-width: 118px;
        padding: 78px 10px 4px;
        text-align: center;
      }
      .timeline-dot {
        position: absolute;
        left: 50%;
        top: 44px;
        transform: translateX(-50%);
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #5ee6d0;
        box-shadow: 0 0 0 4px rgba(94, 230, 208, 0.15);
        z-index: 2;
        transition:
          transform 0.25s ease,
          box-shadow 0.25s ease;
      }
      .timeline-item:hover .timeline-dot {
        transform: translateX(-50%) scale(1.25);
        box-shadow: 0 0 0 6px rgba(94, 230, 208, 0.22);
      }
      .timeline-item[data-wave="up"] .timeline-dot {
        top: 18px;
      }
      .timeline-item[data-wave="down"] .timeline-dot {
        top: 50px;
      }
      .timeline-item--final .timeline-dot {
        width: 17px;
        height: 17px;
        background: #c7e26b;
        box-shadow:
          0 0 0 5px rgba(199, 226, 107, 0.2),
          0 0 14px rgba(199, 226, 107, 0.6);
      }
      .timeline-item--final:hover .timeline-dot {
        transform: translateX(-50%) scale(1.2);
      }
      .timeline-item--final[data-wave="up"] .timeline-dot {
        top: 16px;
      }
      .timeline-item--final[data-wave="down"] .timeline-dot {
        top: 48px;
      }
      .timeline-year {
        font-family: var(--font-display);
        font-weight: 700;
        color: #5ee6d0;
        font-size: 15px;
        margin: 0 0 6px;
      }
      .timeline-item--final .timeline-year {
        color: #c7e26b;
        font-size: 16px;
      }
      .timeline-desc {
        font-size: 11.5px;
        color: #cfd4ee;
        line-height: 1.45;
        margin: 0;
      }
      .timeline-item--final .timeline-desc {
        color: #fff;
        font-weight: 600;
      }
      @media (min-width: 640px) {
        .timeline-desc {
          font-size: 12.5px;
        }
      }
      .nowrap {
        white-space: nowrap;
      }
    </style>
  </head>

  <body class="bg-white">
    <!-- ============ NAVBAR — IDENTIK DENGAN HOME_PAGE.HTML ============ -->
    <header class="navbar">
      <a href="#" class="navbar-brand" aria-label="PKKMB-KT UNILAM Beranda">
        <div class="navbar-logo">
          <img src="{{ asset('gambar/unilam.png') }}" alt="Logo UNILAM" />
        </div>
        <div class="navbar-brand-text">
          <strong>PKKMB-KT</strong>
          <span>UNILAM 2026</span>
        </div>
      </a>

      <button class="menu-toggle" id="menuToggle" aria-label="Buka Menu">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <nav class="navbar-links" id="navbarLinks" aria-label="Navigasi utama">
        <a href="{{ route('landing.home') }}">Beranda</a>

        <div class="nav-dropdown" id="dropdownTentang">
          <button
            type="button"
            class="nav-dropdown-toggle"
            id="dropdownTentangToggle"
            aria-expanded="false"
            aria-controls="dropdownTentangMenu"
          >
           <a href="#" class="active">Tentang</a>
            <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
          </button>
          <div class="nav-dropdown-menu" id="dropdownTentangMenu">
            <a href="#" class="active">Sejarah</a>
            <a href="{{ route('landing.visi-misi') }}">Visi &amp; Misi</a>
            <a href="{{ route('landing.tentang-kami') }}">Tentang Kami</a>
          </div>
        </div>

        <a href="{{ route('landing.informasi') }}">Informasi</a>
        <a href="{{ route('landing.kontak') }}">Kontak</a>
      </nav>
    </header>

    <!-- ============ HERO — LATAR SLIDESHOW BERGANTI-GANTI ============ -->
    <section class="relative overflow-hidden text-white hero-photo">
      <!-- diisi otomatis lewat JS: div .hero-slide untuk tiap foto -->
      <div class="hero-slideshow" id="heroSlideshow"></div>
      <span class="hero-glow hero-glow--teal"></span>
      <span class="hero-glow hero-glow--lime"></span>

      <div
        class="relative max-w-3xl mx-auto px-6 sm:px-8 py-16 sm:py-24 text-center"
      >
        <img
          src="{{ asset('gambar/unilam.png') }}"
          alt="Logo Universitas La Tansa Mashiro"
          class="h-20 sm:h-24 w-auto mx-auto mb-6 drop-shadow-lg"
        />
        <p
          class="text-xs sm:text-sm font-bold tracking-[0.2em] text-teal-300 uppercase mb-3"
        >
          Sejarah Berdirinya
        </p>
        <h1
          class="font-display font-bold text-3xl sm:text-5xl leading-tight mb-5"
        >
          Universitas <span class="nowrap">La Tansa Mashiro</span>
        </h1>
        <p class="font-display italic text-base sm:text-xl text-slate-200">
          "La Tansa Mashiro" &mdash; jangan lupa tempat kembali.
        </p>
      </div>
    </section>

    <!-- ============ LINIMASA RINGKAS (BERANTAI) ============ -->
    <section class="bg-[#0d1638] text-white timeline-section reveal">
      <div class="max-w-6xl mx-auto px-5 sm:px-8 py-8">
        <div class="timeline-wrap" id="timelineWrap">
          <svg class="timeline-svg" id="timelineSvg"></svg>
          <ol class="timeline-track" id="timelineTrack">
            <li class="timeline-item" data-wave="up">
              <span class="timeline-dot"></span>
              <p class="timeline-year">1965</p>
              <p class="timeline-desc">Kyai Rifai lulus Pondok Pesantren Gontor</p>
            </li>
            <li class="timeline-item" data-wave="down">
              <span class="timeline-dot"></span>
              <p class="timeline-year">1968</p>
              <p class="timeline-desc">Berdirinya Pondok Pesantren Daar El-Qolam</p>
            </li>
            <li class="timeline-item" data-wave="up">
              <span class="timeline-dot"></span>
              <p class="timeline-year">1991</p>
              <p class="timeline-desc">Berdirinya Pondok Pesantren <span class="nowrap">La Tansa</span></p>
            </li>
            <li class="timeline-item" data-wave="down">
              <span class="timeline-dot"></span>
              <p class="timeline-year">1996</p>
              <p class="timeline-desc">Berdirinya STIE dan STAI <span class="nowrap">La Tansa Mashiro</span></p>
            </li>
            <li class="timeline-item" data-wave="up">
              <span class="timeline-dot"></span>
              <p class="timeline-year">2006</p>
              <p class="timeline-desc">Berdirinya Akademi Kebidanan <span class="nowrap">La Tansa Mashiro</span></p>
            </li>
            <li class="timeline-item" data-wave="down">
              <span class="timeline-dot"></span>
              <p class="timeline-year">2018</p>
              <p class="timeline-desc">Berdirinya STKIP <span class="nowrap">La Tansa Mashiro</span></p>
            </li>
            <li class="timeline-item timeline-item--final" data-wave="up">
              <span class="timeline-dot"></span>
              <p class="timeline-year">2023</p>
              <p class="timeline-desc">RESMI menjadi Universitas <span class="nowrap">La Tansa Mashiro</span></p>
            </li>
          </ol>
        </div>
      </div>
    </section>
    <!-- ====================== AKHIR LINIMASA BERANTAI ====================== -->

    <script>
      function drawTimelineWave() {
        const wrap = document.getElementById("timelineWrap");
        const svg = document.getElementById("timelineSvg");
        const track = document.getElementById("timelineTrack");
        if (!wrap || !svg || !track) return;
        const dots = wrap.querySelectorAll(".timeline-dot");
        if (!dots.length) return;

        const fullWidth = track.scrollWidth;
        const fullHeight = track.offsetHeight;
        svg.setAttribute("width", fullWidth);
        svg.setAttribute("height", fullHeight);
        svg.setAttribute("viewBox", `0 0 ${fullWidth} ${fullHeight}`);
        svg.style.width = fullWidth + "px";
        svg.style.height = fullHeight + "px";

        const wrapRect = wrap.getBoundingClientRect();
        const scrollLeft = wrap.scrollLeft;

        const points = Array.from(dots).map((dot) => {
          const r = dot.getBoundingClientRect();
          return {
            x: r.left + r.width / 2 - wrapRect.left + scrollLeft,
            y: r.top + r.height / 2 - wrapRect.top,
          };
        });

        let d = `M ${points[0].x} ${points[0].y}`;
        for (let i = 0; i < points.length - 1; i++) {
          const p0 = points[i === 0 ? 0 : i - 1];
          const p1 = points[i];
          const p2 = points[i + 1];
          const p3 = points[i + 2 < points.length ? i + 2 : i + 1];
          const cp1x = p1.x + (p2.x - p0.x) / 6;
          const cp1y = p1.y + (p2.y - p0.y) / 6;
          const cp2x = p2.x - (p3.x - p1.x) / 6;
          const cp2y = p2.y - (p3.y - p1.y) / 6;
          d += ` C ${cp1x} ${cp1y}, ${cp2x} ${cp2y}, ${p2.x} ${p2.y}`;
        }

        svg.innerHTML = `
          <defs>
            <linearGradient id="waveGrad" x1="0" y1="0" x2="1" y2="0">
              <stop offset="0%" stop-color="#5ee6d0" stop-opacity="0.55"/>
              <stop offset="85%" stop-color="#5ee6d0" stop-opacity="0.55"/>
              <stop offset="100%" stop-color="#c7e26b" stop-opacity="0.9"/>
            </linearGradient>
          </defs>
          <path d="${d}" fill="none" stroke="url(#waveGrad)" stroke-width="2.5" stroke-linecap="round"/>
        `;
      }

      window.addEventListener("load", () => {
        drawTimelineWave();
        setTimeout(drawTimelineWave, 350);
      });
      window.addEventListener("resize", drawTimelineWave);
      window.addEventListener("orientationchange", () => {
        setTimeout(drawTimelineWave, 200);
      });
    </script>

    <!-- arch divider -->
    <div class="arch-divider bg-white">
      <svg width="44" height="22" viewBox="0 0 44 22" fill="none">
        <path
          d="M2 22V14C2 9 6 5 11 3L13 1L15 3C20 5 24 9 24 14V22"
          stroke="#128E8A"
          stroke-width="2"
        />
      </svg>
    </div>

    <!-- ============ SECTION 1: AKAR DARI PESANTREN ============ -->
    <section class="max-w-5xl mx-auto px-5 sm:px-8 py-12 sm:py-16 reveal">
      <div class="grid sm:grid-cols-2 gap-8 sm:gap-12 items-center">
        <div>
          <p
            class="text-xs font-bold tracking-[0.2em] text-teal-600 uppercase mb-2"
          >
            1965 &ndash; 1991
          </p>
          <h2
            class="font-display font-bold text-2xl sm:text-3xl text-navy-900 mb-5"
          >
            Akar dari Pesantren
          </h2>
          <div class="prose-body text-[15px] sm:text-base text-slate-700">
            <p>
              Sejarah Universitas La Tansa Mashiro tidak bisa lepas dari sosok
              ulama Banten, alumnus Pondok Modern Gontor lulusan tahun 1965, KH.
              Drs. Ahmad Rifai Arif (Kyai Rifai). Beliau bersama keluarga
              besarnya mendirikan Pondok Pesantren Daar El-Qolam di Tangerang
              pada tahun 1968. Selang dua dekade, tepatnya tahun 1991,
              semangatnya membangun umat mendorong Kyai Rifai untuk mendirikan
              pondok pesantren kedua bernama Pondok Pesantren La Tansa di daerah
              pegunungan Parakansantri, Kabupaten Lebak, Banten &mdash;
              berbatasan dengan Kabupaten Bogor, Jawa Barat.
            </p>
            <p>
              Latar belakang berdirinya Pondok Pesantren La Tansa tidak persis
              sama dengan pondok pertamanya. Cita-citanya terlihat lebih
              kompleks dan holistik, dipersiapkan untuk menjawab dinamika
              kehidupan masyarakat muslim di dunia &mdash; proyeksinya tidak
              berhenti pada pendidikan dasar dan menengah, namun linear dengan
              pendidikan tinggi setingkat universitas. Itulah mengapa gedung
              besar yang dibangun pada fase awal di Pondok Pesantren La Tansa
              sudah diberi nama &ldquo;Unilam&rdquo;, akronim dari
              &ldquo;Universitas La Tansa Mashiro&rdquo;, sebagai bentuk
              keyakinan akan lahirnya sebuah universitas.
            </p>
          </div>
        </div>
        <div class="photo-frame rounded-2xl shadow-xl">
          <img
            src="{{ asset('gambar/Drs. KH. Ahmad Rifai Arief.png') }}"
            alt="Foto KH. Ahmad Rifai Arif"
            class="w-full object-cover aspect-[4/5]"
          />
        </div>
      </div>
    </section>

    <!-- ============ PLAQUE: MAKNA NAMA ============ -->
    <section class="max-w-3xl mx-auto px-5 sm:px-8 pb-12 sm:pb-16 reveal">
      <div
        class="bg-paper rounded-2xl border border-amber-900/10 px-6 sm:px-10 py-9 sm:py-11 text-center relative shadow-[0_18px_45px_-15px_rgba(21,33,89,0.35)]"
      >
        <svg
          class="w-9 h-9 mx-auto mb-4 text-navy-900/70"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="1.6"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path d="M5 19V11c0-4 3-7 7-9 4 2 7 5 7 9v8" />
          <path d="M9 19v-5c0-1.7 1.3-3 3-3s3 1.3 3 3v5" />
        </svg>
        <p
          class="font-display italic text-lg sm:text-xl text-navy-900 leading-relaxed"
        >
          &ldquo;La Tansa Mashiro&rdquo; berasal dari bahasa Arab yang berarti
          &ldquo;Jangan Lupa Tempat Kembali&rdquo;.
        </p>
        <p class="text-sm sm:text-[15px] text-slate-600 mt-4 leading-relaxed">
          Mengandung makna filosofis bagi berdirinya UNILAM: setiap manusia
          sebagai makhluk dan hamba Allah Swt. pasti akan kembali kepada-Nya
          untuk diminta pertanggungjawaban atas amal selama hidup di dunia
          &mdash; maka sebaik-baik bekal kembali adalah takwa, baik dalam
          kesalehan spiritual maupun dalam manifestasinya pada aktivitas dan
          kepemimpinan di tengah masyarakat. Inilah fondasi Tri Dharma UNILAM
          yang ditanamkan pendirinya tiga dekade lalu.
        </p>
      </div>
    </section>

    <!-- arch divider -->
    <div class="arch-divider bg-white">
      <svg width="44" height="22" viewBox="0 0 44 22" fill="none">
        <path
          d="M2 22V14C2 9 6 5 11 3L13 1L15 3C20 5 24 9 24 14V22"
          stroke="#128E8A"
          stroke-width="2"
        />
      </svg>
    </div>

    <!-- ============ SECTION 2: LAHIR DARI RAHIM PONDOK ============ -->
    <section class="bg-slate-50 reveal">
      <div class="max-w-5xl mx-auto px-5 sm:px-8 py-12 sm:py-16">
        <div class="grid sm:grid-cols-2 gap-8 sm:gap-12 items-center">
          <div class="photo-frame rounded-2xl shadow-xl sm:order-1">
            <img
              src="{{ asset('gambar/gedungutama.jpeg') }}"
              alt="Foto gedung UNILAM 1993"
              class="w-full object-cover aspect-[4/3]"
            />
          </div>
          <div class="sm:order-2">
            <p
              class="text-xs font-bold tracking-[0.2em] text-teal-600 uppercase mb-2"
            >
              1993
            </p>
            <h2
              class="font-display font-bold text-2xl sm:text-3xl text-navy-900 mb-5"
            >
              Lahir dari Rahim Pondok Pesantren La Tansa
            </h2>
            <div class="prose-body text-[15px] sm:text-base text-slate-700">
              <p>
                Dua tahun pasca beroperasinya Pondok Pesantren La Tansa,
                tepatnya tahun 1993, Kyai Rifai memulai debutnya di dunia
                perguruan tinggi. Berkat dukungan sahabat-sahabat akademikinya,
                beliau memproklamirkan UNILAM sebagai nama perguruan tinggi yang
                baru saja didirikannya. Di gedung itulah para mahasiswa, yang
                sebagian besar berasal dari guru pengabdian Pondok Pesantren La
                Tansa, memulai perkuliahan &mdash; diajar oleh sahabat-sahabat
                Kyai Rifai, para akademisi dari almamaternya, IAIN Serang, dan
                kampus lain di Jakarta, yang menempuh jalan panjang dan berkelok
                sejauh kurang lebih 70 km dari Serang ke Parakansantri setiap
                kali mengajar.
              </p>
              <p>
                Sebagai bentuk apresiasi, perlu disebutkan nama-nama sahabat
                Kyai Rifai yang hadir dalam pertemuan pertama membahas rencana
                pendirian UNILAM: Drs. MA. Tihami, MA, Drs. Najmuddin, Drs. H.E.
                Syibli Syarjaya, dan Drs. M. Hudori. Pertemuan itu melahirkan
                tim yang disebut Panitia Sembilan, diketuai Drs. MA. Tihami,
                yang bergerak mengurus proses perizinan universitas. Forum
                sempat menyepakati enam fakultas, yang kemudian mengerucut
                menjadi tiga: Fakultas Ekonomi, Fakultas Agama Islam, dan
                Fakultas Teknologi Pertanian. Pada penerimaan mahasiswa baru
                tahun akademik 1993&ndash;1994, hanya Fakultas Ekonomi dan
                Fakultas Agama Islam yang siap beroperasi, dengan rektor pertama
                Prof. Dr. H. Abdurrahman Partosentono.
              </p>
              <p>
                Kedua fakultas ini kemudian berkembang menjadi Sekolah Tinggi
                Ilmu Ekonomi (STIE) jurusan Manajemen dan Sekolah Tinggi Ilmu
                Ushuluddin (STIU) jurusan Communication dan Penyiaran Islam,
                yang belakangan menjadi Sekolah Tinggi Agama Islam (STAI). Pada
                tahun 1996, kampus berpindah dari Pondok Pesantren La Tansa di
                Parakansantri ke Rangkasbitung, ibu kota Kabupaten Lebak.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ SECTION 3: SEPERTI KAPAL PECAH ============ -->
    <section class="max-w-5xl mx-auto px-5 sm:px-8 py-12 sm:py-16 reveal">
      <div class="grid sm:grid-cols-2 gap-8 sm:gap-12 items-center">
        <div>
          <p
            class="text-xs font-bold tracking-[0.2em] text-teal-600 uppercase mb-2"
          >
            Akhir 1990-an &ndash; 2018
          </p>
          <h2
            class="font-display font-bold text-2xl sm:text-3xl text-navy-900 mb-5"
          >
            &ldquo;Seperti Kapal Pecah&rdquo;
          </h2>
          <div class="prose-body text-[15px] sm:text-base text-slate-700">
            <p>
              Tidak lama setelah kepindahan kampus, Kyai Rifai berpulang di
              Gintung, Tangerang, pada tahun 1997. Sempat lesu dan dirundung
              pesimisme, perjuangan membesarkan UNILAM &mdash; yang saat itu
              dikenal sebagai Perguruan Tinggi La Tansa Mashiro Rangkasbitung
              &mdash; kembali bergeliat di bawah komando Soleh Rosyad, suami
              dari putri tertua Kyai Rifai, yang menyerap baik pesan-pesan
              perjuangan dan harapan besar sang pendiri.
            </p>
            <p>
              Komplek kampus di Rangkasbitung kala itu belum tampak seperti
              kampus pada umumnya. Berdiri di tengah semak belukar, sawah, dan
              rawa di bilangan Pasir Jati, masyarakat sekitar menjulukinya
              &ldquo;kapal pecah&rdquo; &mdash; gedung satu lantai berlumut
              dengan tiang besi behel dan material papan berserakan, jalan yang
              jauh dari mulus, dan jumlah mahasiswa tak lebih dari 80 orang.
              Namun berkat kesabaran dan konsistensi para pewaris nilai
              perjuangan Kyai Rifai, kampus ini melewati masa-masa kritisnya.
            </p>
            <p>
              Di lima tahun pertama abad ke-21, UNILAM menambah program studi
              untuk melengkapi STIE dan STAI: Akademi Kebidanan (Akbid) La Tansa
              Mashiro berdiri pada 2006, membawa nilai tambah kemandirian dan
              keislaman ala pesantren bagi mahasiswinya. Setelah menanti dua
              belas tahun, STIE, STAI, dan Akbid berhasil melahirkan Sekolah
              Tinggi Keguruan dan Ilmu Pendidikan (STKIP) pada 2018.
            </p>
          </div>
        </div>
        <div class="photo-frame rounded-2xl shadow-xl">
          <img
            src="{{ asset('gambar/unilam.jpeg') }}"
            alt="Foto kampus Rangkasbitung"
            class="w-full object-cover aspect-[4/3]"
          />
        </div>
      </div>
    </section>

    <!-- arch divider -->
    <div class="arch-divider bg-white">
      <svg width="44" height="22" viewBox="0 0 44 22" fill="none">
        <path
          d="M2 22V14C2 9 6 5 11 3L13 1L15 3C20 5 24 9 24 14V22"
          stroke="#128E8A"
          stroke-width="2"
        />
      </svg>
    </div>

    <!-- ============ SECTION 4: MENJADI UNIVERSITAS ============ -->
    <section class="bg-navy-900 text-white reveal">
      <div class="max-w-4xl mx-auto px-5 sm:px-8 py-14 sm:py-20 text-center">
        <p
          class="text-xs font-bold tracking-[0.2em] text-[#C7E26B] uppercase mb-2"
        >
          Januari 2023
        </p>
        <h2 class="font-display font-bold text-2xl sm:text-4xl mb-6">
          Resmi Menjadi Universitas
        </h2>

        <div
          class="relative w-full rounded-2xl shadow-2xl overflow-hidden mb-8"
          style="aspect-ratio: 16 / 7"
        >
          <iframe
            class="absolute inset-0 w-full h-full"
            src="https://www.youtube.com/embed/MbH9NbkFQJM"
            title="Resmi Menjadi Universitas La Tansa Mashiro"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen
          ></iframe>
        </div>

        <div
          class="prose-body text-left sm:text-center text-[15px] sm:text-base text-slate-200 max-w-3xl mx-auto"
        >
          <p>
            Dengan empat lembaga pendidikan tinggi di Yayasan La Tansa Mashiro
            yang kala itu diketuai Hj. Ernawati Sulhatul Imama, M.Pd.I,
            keinginan menggabungkan keempatnya menjadi satu universitas makin
            kuat. Tim akselerasi dibentuk untuk memproses perizinan ke
            Kemenristekdikti, dan dengan kerja keras tim serta dukungan yayasan,
            status universitas berhasil diraih pada Januari 2023. Rapat Yayasan
            La Tansa Mashiro menetapkan nama Unilam tetap dipakai sebagai
            warisan nilai perjuangan sang pendiri, dengan Dr. KH. Soleh, MM
            sebagai rektor pertama.
          </p>
          <p>
            Berdasarkan SK Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi
            Nom 97/E/O/2023 tentang izin penggabungan Akademi Kebidanan La Tansa
            Mashiro, Sekolah Tinggi Keguruan dan Ilmu Pendidikan La Tansa
            Mashiro, dan Sekolah Tinggi Ilmu Ekonomi La Tansa Mashiro, Perguruan
            Tinggi La Tansa Mashiro telah resmi menjadi Universitas La Tansa
            Mashiro.
          </p>
        </div>
      </div>
    </section>

    <!-- ============ FOOTER ============ -->
    <footer
      class="bg-[#0d1638] text-slate-400 text-center py-10 px-5 text-xs sm:text-sm"
    >
      <img src="{{ asset('gambar/unilam.png') }}" class="h-14 w-auto mx-auto mb-4 opacity-90" />
      <p>
        &copy; Universitas La Tansa Mashiro. Sejarah disusun dari arsip internal
        yayasan.
      </p>
    </footer>

    <script>
      lucide.createIcons();

      const menuToggle = document.getElementById("menuToggle");
      const navbarLinks = document.getElementById("navbarLinks");

      menuToggle.addEventListener("click", () => {
        menuToggle.classList.toggle("active");
        navbarLinks.classList.toggle("active");
      });

      const dropdownTentang = document.getElementById("dropdownTentang");
      const dropdownTentangToggle = document.getElementById(
        "dropdownTentangToggle",
      );

      dropdownTentangToggle.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        const isOpen = dropdownTentang.classList.toggle("open");
        dropdownTentangToggle.setAttribute("aria-expanded", isOpen);
      });

      document.addEventListener("click", (e) => {
        if (!dropdownTentang.contains(e.target)) {
          dropdownTentang.classList.remove("open");
          dropdownTentangToggle.setAttribute("aria-expanded", "false");
        }
      });

      const links = navbarLinks.querySelectorAll("a");
      links.forEach((link) => {
        link.addEventListener("click", () => {
          menuToggle.classList.remove("active");
          navbarLinks.classList.remove("active");
        });
      });

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO — sama seperti home_page.html.
      //    Tambah/ganti foto tinggal edit array di bawah ini.
      // ======================================================================
      const heroSlideImages = [
        "/gambar/unilam.jpeg",
        "/gambar/rektor.jpeg",
        "/gambar/gedungutama.jpeg",
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

      // ======================================================================
      // ►► REVEAL ON SCROLL — munculkan tiap section secara halus
      // ======================================================================
      const revealEls = document.querySelectorAll(".reveal");
      if ("IntersectionObserver" in window && revealEls.length) {
        const io = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              if (entry.isIntersecting) {
                entry.target.classList.add("is-visible");
                io.unobserve(entry.target);
              }
            });
          },
          { threshold: 0.15 },
        );
        revealEls.forEach((el) => io.observe(el));
      } else {
        revealEls.forEach((el) => el.classList.add("is-visible"));
      }
    </script>
  </body>
</html>