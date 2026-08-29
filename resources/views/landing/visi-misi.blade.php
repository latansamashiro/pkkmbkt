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
    <title>Visi &amp; Misi - Universitas La Tansa Mashiro</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;0,700;1,500&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <style>
      /* ============ TOKENS — SAMA PERSIS DENGAN SEJARAH.HTML ============ */
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

      /* ============ NAVBAR — IDENTIK DENGAN SEJARAH.HTML / HOME_PAGE.HTML ============ */
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
        width: 50%;
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
         DROPDOWN "TENTANG" — sama persis dengan sejarah.html / home_page.html
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

      /* Arch Divider — sama persis dengan sejarah.html */
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
         SEJARAH.HTML DAN HOME_PAGE.HTML), BUKAN 1 FOTO STATIS LAGI.
         - Untuk GANTI/TAMBAH FOTO: cari array "heroSlideImages" di
           <script> paling bawah, tambah/hapus baris path foto di situ.
         - Untuk atur KECEPATAN GANTI FOTO: ubah "HERO_SLIDE_INTERVAL_MS".
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
         saat mulai kelihatan di layar. Tidak mengubah struktur HTML, cuma
         tambah class "reveal" pada tiap <section> lalu JS toggle
         "is-visible" saat masuk viewport.
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

      /* ======================================================================
         KARTU MISI / TUJUAN — daftar bernomor
         ►► TANDA EDIT: untuk menambah/mengubah poin, cari
            <ol class="goal-list"> di HTML lalu copy satu <li class="goal-item">
      ====================================================================== */
      .goal-list {
        display: grid;
        grid-template-columns: 1fr;
        gap: 18px;
        list-style: none;
        margin: 0;
        padding: 0;
      }
      @media (min-width: 768px) {
        .goal-list {
          grid-template-columns: repeat(2, 1fr);
        }
      }
      .goal-item {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        background: var(--surface, #fff);
        border: 1px solid #e1e5f1;
        border-radius: 16px;
        padding: 18px 20px;
        box-shadow: 0 2px 14px rgba(21, 33, 89, 0.06);
        transition:
          transform 0.25s ease,
          box-shadow 0.25s ease,
          border-color 0.25s ease;
      }
      .goal-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(21, 33, 89, 0.14);
        border-color: rgba(22, 160, 161, 0.35);
      }
      .goal-number {
        flex-shrink: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--teal-500), var(--lime-500));
        color: #fff;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.25s ease;
      }
      .goal-item:hover .goal-number {
        transform: scale(1.12);
      }
      .goal-text {
        font-size: 14.5px;
        line-height: 1.7;
        color: #3d4262;
        margin: 0;
      }
    </style>
  </head>

  <body class="bg-white">
    <!-- ============ NAVBAR — IDENTIK DENGAN SEJARAH.HTML ============ -->
    <header class="navbar">
      <a href="{{ route('landing.home') }}" class="navbar-brand" aria-label="PKKMB-KT UNILAM Beranda">
        <div class="navbar-logo">
          <img src="{{ asset('gambar/unilam.webp') }}" alt="Logo UNILAM" />
        </div>
        <div class="navbar-brand-text">
          <strong>SIMBA</strong>
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
            <a href="{{ route('landing.sejarah') }}">Sejarah</a>
            <a href="#" class="active">Visi &amp; Misi</a>
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
          src="{{ asset('gambar/unilam.webp') }}"
          alt="Logo Universitas La Tansa Mashiro"
          class="h-20 sm:h-24 w-auto mx-auto mb-6 drop-shadow-lg"
        />
        <p
          class="text-xs sm:text-sm font-bold tracking-[0.2em] text-teal-300 uppercase mb-3"
        >
          Arah &amp; Cita-Cita
        </p>
        <h1
          class="font-display font-bold text-3xl sm:text-5xl leading-tight mb-5"
        >
          Visi &amp; Misi
        </h1>
        <p class="font-display italic text-base sm:text-xl text-slate-200">
          Universitas La Tansa Mashiro
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

    <!-- ============ PLAQUE: VISI ============ -->
    <section class="max-w-3xl mx-auto px-5 sm:px-8 py-12 sm:py-16 reveal">
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
          <path d="M12 2l2.4 6.6L21 11l-6.6 2.4L12 20l-2.4-6.6L3 11l6.6-2.4z" />
        </svg>
        <p
          class="text-xs font-bold tracking-[0.2em] text-teal-600 uppercase mb-4"
        >
          Visi
        </p>
        <p
          class="font-display italic text-lg sm:text-2xl text-navy-900 leading-relaxed"
        >
          &ldquo;Menjadi Universitas La Tansa Mashiro yang unggul, berdaya
          saing global, berjiwa entrepreneur, berlandaskan akhlakul
          karimah.&rdquo;
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

    <!-- ============ SECTION: MISI ============ -->
    <section class="bg-slate-50 reveal">
      <div class="max-w-5xl mx-auto px-5 sm:px-8 py-12 sm:py-16">
        <p
          class="text-xs font-bold tracking-[0.2em] text-teal-600 uppercase mb-2 text-center"
        >
          Berdasarkan Visi Tersebut
        </p>
        <h2
          class="font-display font-bold text-2xl sm:text-3xl text-navy-900 mb-8 text-center"
        >
          Misi <span class="whitespace-nowrap">Universitas La Tansa Mashiro</span>
        </h2>

        <!-- ►► TAMBAH / GANTI POIN MISI DI SINI -->
        <ol class="goal-list">
          <li class="goal-item">
            <span class="goal-number">1</span>
            <p class="goal-text">
              Menyelenggarakan pendidikan tinggi yang menghasilkan sumber daya
              manusia yang profesional di bidangnya.
            </p>
          </li>
          <li class="goal-item">
            <span class="goal-number">2</span>
            <p class="goal-text">
              Menyelenggarakan penelitian dalam rangka mengembangkan ilmu
              pengetahuan dan teknologi yang berintegritas.
            </p>
          </li>
          <li class="goal-item">
            <span class="goal-number">3</span>
            <p class="goal-text">
              Menyelenggarakan pengabdian kepada masyarakat yang mendorong
              pengembangan potensi kewirausahaan, <span class="whitespace-nowrap">good attitude</span>
              dalam masyarakat.
            </p>
          </li>
          <li class="goal-item">
            <span class="goal-number">4</span>
            <p class="goal-text">
              Menjalin kerjasama secara berkesinambungan dengan lembaga
              pendidikan, lembaga penelitian, pemerintah, dunia usaha dan
              masyarakat baik dalam negeri maupun luar negeri.
            </p>
          </li>
          <li class="goal-item">
            <span class="goal-number">5</span>
            <p class="goal-text">
              Mengembangkan manajemen perguruan tinggi yang profesional
              berdasarkan prinsip kualitas, otonomi, transparansi dan
              akuntabilitas.
            </p>
          </li>
        </ol>
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

    <!-- ============ SECTION: TUJUAN ============ -->
    <section class="max-w-5xl mx-auto px-5 sm:px-8 py-12 sm:py-16 reveal">
      <p
        class="text-xs font-bold tracking-[0.2em] text-teal-600 uppercase mb-2 text-center"
      >
        Sesuai Visi &amp; Misi
      </p>
      <h2
        class="font-display font-bold text-2xl sm:text-3xl text-navy-900 mb-8 text-center"
      >
        Tujuan <span class="whitespace-nowrap">Universitas La Tansa Mashiro</span>
      </h2>

      <!-- ►► TAMBAH / GANTI POIN TUJUAN DI SINI -->
      <ol class="goal-list">
        <li class="goal-item">
          <span class="goal-number">1</span>
          <p class="goal-text">
            Menghasilkan lulusan yang berkualitas dengan kemampuan akademik,
            profesional, berakhlakul karimah, mandiri, memiliki jiwa
            kepemimpinan dan <span class="whitespace-nowrap">entrepreneurship</span>, serta mampu bersaing secara
            global.
          </p>
        </li>
        <li class="goal-item">
          <span class="goal-number">2</span>
          <p class="goal-text">
            Menghasilkan penelitian yang dapat memberikan kontribusi terhadap
            pengembangan ilmu pengetahuan dan teknologi yang berintegritas.
          </p>
        </li>
        <li class="goal-item">
          <span class="goal-number">3</span>
          <p class="goal-text">
            Menghasilkan pengabdian kepada masyarakat yang mendorong
            pengembangan potensi, kewirausahaan, <span class="whitespace-nowrap">good attitude</span> dalam
            masyarakat.
          </p>
        </li>
        <li class="goal-item">
          <span class="goal-number">4</span>
          <p class="goal-text">
            Menghasilkan kerjasama lembaga pendidikan, lembaga penelitian,
            pemerintah, dunia usaha dan masyarakat untuk mewujudkan visi
            sebagai perguruan tinggi unggulan dan bertaraf internasional.
          </p>
        </li>
        <li class="goal-item">
          <span class="goal-number">5</span>
          <p class="goal-text">
            Menerapkan prinsip-prinsip <span class="whitespace-nowrap">Good University Governance (GUG)</span>.
          </p>
        </li>
      </ol>
    </section>

    <!-- ============ FOOTER — IDENTIK DENGAN SEJARAH.HTML ============ -->
    <footer
      class="bg-[#0d1638] text-slate-400 text-center py-10 px-5 text-xs sm:text-sm"
    >
      <img src="{{ asset('gambar/unilam.webp') }}" class="h-14 w-auto mx-auto mb-4 opacity-90" />
      <p>
        &copy; Universitas La Tansa Mashiro. Visi, misi, dan tujuan disusun
        berdasarkan dokumen resmi universitas.
      </p>
      <div class="flex items-center justify-center gap-4 mt-4">
        <a href="{{ route('landing.kebijakan-privasi') }}" class="text-slate-400 hover:text-white transition">Kebijakan Privasi</a>
        <span class="opacity-40">&bull;</span>
        <a href="{{ route('landing.syarat-ketentuan') }}" class="text-slate-400 hover:text-white transition">Syarat &amp; Ketentuan</a>
        <span class="opacity-40">&bull;</span>
        <a href="{{ route('landing.bantuan') }}" class="text-slate-400 hover:text-white transition">Bantuan</a>
      </div>
    </footer>

    <script>
      lucide.createIcons();

      const menuToggle = document.getElementById("menuToggle");
      const navbarLinks = document.getElementById("navbarLinks");

      menuToggle.addEventListener("click", () => {
        menuToggle.classList.toggle("active");
        navbarLinks.classList.toggle("active");
      });

      // ======================================================================
      // ►► SCRIPT DROPDOWN "TENTANG" — sama persis dengan sejarah.html
      // ======================================================================
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
      // ►► SLIDESHOW LATAR HERO — sama seperti sejarah.html & home_page.html.
      //    Tambah/ganti foto tinggal edit array di bawah ini.
      // ======================================================================
      const heroSlideImages = [
        "/gambar/rektor.webp",
        "/gambar/gedungutama.webp",
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