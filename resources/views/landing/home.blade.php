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
    <title>PKKMB-KT UNILAM 2026</title>
    <!-- Masukkan link font ini di dalam tag <head> -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <style>
    /* Deklarasi Class Font Custom */
    .font-abril {
      font-family: 'Abril Fatface', serif;
    }

    /* Animasi warna yang digabungkan sebelumnya */
    @keyframes gradient-move {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .animate-gradient-text {
      background-size: 200% 200%;
      animation: gradient-move 4s ease infinite;
    }

    /* ►► KEDIP LEMBUT UNTUK AKSEN GLOW & DOT — bikin hero terasa "hidup" */
    @keyframes soft-pulse {
      0%, 100% { opacity: 0.55; transform: scale(1); }
      50% { opacity: 0.9; transform: scale(1.08); }
    }

    .social-float {
position: fixed;
right: 20px;
bottom: 20px;
display: flex;
flex-direction: column;
gap: 15px;
z-index: 9999;
}

.social-float a {
width: 55px;
height: 55px;
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
text-decoration: none;
box-shadow: 0 5px 15px rgba(0,0,0,0.25);
transition: all 0.3s ease;
}

.social-float a:hover {
transform: scale(1.1);
}

.social-float i {
font-size: 28px;
color: white;
}

.social-float .fa-whatsapp {
color: #25D366;
}

.social-float .fa-instagram {
color: #E1306C;
}

.social-float .fa-tiktok {
color: #ffffff;
}

.social-float a {
background: rgba(20, 20, 20, 0.9);
}
    /* Instagram */
    .social-float a:last-child {
      background: linear-gradient(
        45deg,
        
      );
    }
    .hero {
      position: relative;
    }
    /* ============ TOKENS ============ */
    :root {
      --navy-900: #152159;
      --navy-700: #1e3a8f;
      --navy-600: #2a4bb0;
      --teal-600: #355657;
      --teal-500: #16a0a1;
      --teal-tint: #e2f3f2;
      --lime-500: #a9c73b;
      --lime-tint: #f2f6e0;
      --navy-tint: #e6e9f6;

      --bg: #f2f4fa;
      --surface: #ffffff;
      --surface-muted: #e8ebf6;
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
    }

    /* ======================================================================
       ►► CATATAN PENTING soal scroll horizontal:
       Sebelumnya di sini ada aturan `html, body { overflow-x: hidden; }`
       untuk mencegah geser ke samping. TAPI aturan itu justru MEMATAHKAN
       navbar sticky (posisi nempel di atas), karena begitu overflow-x
       diatur di <html>/<body>, browser otomatis membuat <body> jadi
       "kontainer scroll" sendiri, dan itu bikin `position: sticky` di
       navbar tidak lagi nempel ke viewport.
       Solusinya: JANGAN pasang overflow-x:hidden di html/body. Section
       yang berpotensi melebar ke samping (.hero, .cta-section) sudah
       masing-masing punya `overflow: hidden` sendiri di bawah, jadi tetap
       aman dari geser horizontal tanpa mematahkan sticky nav.
    ====================================================================== */

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
    /* ============ NAVBAR ============ */
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

    /* Efek animasi berubah jadi silang (X) saat aktif */
    .menu-toggle.active span:nth-child(1) {
      transform: translateY(8px) rotate(45deg);
    }
    .menu-toggle.active span:nth-child(2) {
      opacity: 0;
    }
    .menu-toggle.active span:nth-child(3) {
      transform: translateY(-8px) rotate(-45deg);
    }

    /* FIX: navbar-links pakai transform, bukan geser lewat "right"
       (ini aman, tidak mematahkan sticky nav — beda dengan overflow-x
       di html/body yang sudah dihapus di atas) */
    .navbar-links {
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0;
      right: 0;
      width: 50%;
      height: 100vh;
      background: #0d1735;
      padding: 100px 32px 32px;
      gap: 24px;
      transform: translateX(100%);
      transition: transform 0.3s ease;
      box-shadow: -5px 0 25px rgba(0, 0, 0, 0.3);
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

    /* Versi mobile: submenu tampil sebagai accordion, dorong konten ke bawah */
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

    /* MEDIA QUERY UNTUK TAMPILAN LAPTOP/DESKTOP */
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

      /* Di desktop, dropdown "Tentang" tampil melayang (bukan accordion) */
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

    /* ============ HERO ============ */
    .hero {
      min-height: 100vh;
      padding: clamp(48px, 8vw, 96px) clamp(16px, 5vw, 48px)
        clamp(56px, 10vw, 112px);
      display: flex;
      align-items: center;
      gap: 48px;
      flex-wrap: wrap;
      overflow: hidden;
    }

    /* ►► SLIDESHOW LATAR HERO — ganti/tambah gambar di array JS
       "heroSlideImages" pada bagian bawah file ini. Durasi tiap gambar
       diatur lewat variabel "HERO_SLIDE_INTERVAL_MS" di script yang sama. */
    .hero-slideshow {
      position: absolute;
      inset: 0;
      z-index: -1;
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
        opacity 1.6s ease,
        transform 8s ease;
    }
    .hero-slide.active {
      opacity: 1;
      transform: scale(1);
    }
    /* ►► OPACITY GELAP DI ATAS SLIDESHOW — biar teks tetap kebaca jelas
       di atas foto apa pun yang lagi tampil. Ubah angka di bawah
       kalau mau lebih gelap/terang. */
    .hero-slideshow::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(
        180deg,
        rgba(3, 8, 26, 0.5) 0%,
        rgba(3, 8, 26, 0.35) 45%,
        rgba(3, 8, 26, 0.65) 100%
      );
    }

    /* ►► AKSEN GLOW DEKORATIF DI HERO — bikin tampilan lebih premium
       tanpa mengganggu keterbacaan teks. Posisinya ambient di pojok. */
    .hero-glow {
      position: absolute;
      border-radius: 50%;
      filter: blur(70px);
      pointer-events: none;
      animation: soft-pulse 6s ease-in-out infinite;
    }
    .hero-glow--teal {
      width: 320px;
      height: 320px;
      background: rgba(22, 160, 161, 0.32);
      top: 6%;
      left: -80px;
    }
    .hero-glow--lime {
      width: 260px;
      height: 260px;
      background: rgba(169, 199, 59, 0.26);
      bottom: 8%;
      right: -60px;
      animation-delay: 2s;
    }

    /* Panel dihapus sesuai permintaan — teks tampil langsung tanpa kotak */
    .hero-panel {
      position: relative;
      z-index: 1;
    }

    /* ►► WARNA BRAND — dipakai di teks judul bergradasi.
       Ganti tiga kode warna di sini kalau brand color berubah lagi. */
    .brand-gradient-text {
      background-image: linear-gradient(90deg, #004a8f, #00a79d, #a6ce39);
      background-size: 200% 200%;
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      animation: gradient-move 5s ease infinite;
    }

    .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: rgba(169, 199, 59, 0.15);
      border: 1px solid rgba(169, 199, 59, 0.35);
      color: #c8e46a;
      font-size: 12.5px;
      font-weight: 700;
      padding: 5px 14px;
      border-radius: 99px;
      margin-bottom: 18px;
    }
    .hero-eyebrow .dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: var(--lime-500);
      animation: soft-pulse 1.8s ease-in-out infinite;
    }
    .hero h1 {
      font-family: var(--font-display);
      font-weight: 700;
      font-size: clamp(28px, 5vw + 10px, 52px);
      line-height: 1.15;
      color: #fff;
      margin: 0 0 18px;
      max-width: 520px;
    }
    .hero h1 em {
      font-style: normal;
      color: var(--lime-500);
    }
    .hero-sub {
      font-size: clamp(14px, 1.5vw, 16px);
      color: #bfc6ea;
      line-height: 1.7;
      max-width: 460px;
      margin: 0 0 32px;
    }
    .hero-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
    }

    .btn-primary {
      position: relative;
      overflow: hidden;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--lime-500);
      color: var(--navy-900);
      font-family: var(--font-sans);
      font-weight: 800;
      font-size: 14px;
      padding: 13px 28px;
      border-radius: 99px;
      border: none;
      cursor: pointer;
      transition:
        filter 0.15s,
        transform 0.15s;
      box-shadow: var(--shadow-pop);
    }
    .btn-primary:hover {
      filter: brightness(1.06);
      transform: translateY(-1px);
    }
    /* ►► EFEK KILAU (SHINE) SAAT HOVER — sapuan cahaya melintasi tombol */
    .btn-primary::after {
      content: "";
      position: absolute;
      top: 0;
      left: -75%;
      width: 45%;
      height: 100%;
      background: linear-gradient(
        120deg,
        transparent,
        rgba(255, 255, 255, 0.6),
        transparent
      );
      transform: skewX(-20deg);
      transition: left 0.65s ease;
    }
    .btn-primary:hover::after {
      left: 125%;
    }
    .btn-primary .ic {
      width: 17px;
      height: 17px;
    }
    .btn-outline {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: transparent;
      color: #fff;
      border: 1.5px solid rgba(255, 255, 255, 0.35);
      font-family: var(--font-sans);
      font-weight: 700;
      font-size: 14px;
      padding: 13px 28px;
      border-radius: 99px;
      cursor: pointer;
      transition:
        border-color 0.15s,
        background 0.15s;
    }
    .btn-outline:hover {
      border-color: #fff;
      background: rgba(255, 255, 255, 0.08);
    }

    /* Catatan kecil di bawah tombol login — memperjelas siapa yang boleh pakai */
    .hero-login-note {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 12px;
      color: #93a0d1;
      margin-top: 10px;
    }
    .hero-login-note i {
      font-size: 11px;
      color: var(--lime-500);
    }

    /* ============ CTA SECTION ============ */
    .cta-section {
      background: linear-gradient(135deg, var(--navy-900), var(--navy-700));
      padding: clamp(56px, 8vw, 96px) clamp(16px, 5vw, 48px);
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .cta-section::before {
      content: "";
      position: absolute;
      width: 300px;
      height: 300px;
      border-radius: 50%;
      background: rgba(169, 199, 59, 0.08);
      top: -80px;
      left: -80px;
      pointer-events: none;
    }
    .cta-section::after {
      content: "";
      position: absolute;
      width: 240px;
      height: 240px;
      border-radius: 50%;
      background: rgba(22, 160, 161, 0.1);
      bottom: -60px;
      right: -60px;
      pointer-events: none;
    }
    .cta-section h2 {
      font-family: var(--font-display);
      font-size: clamp(24px, 4vw, 40px);
      color: #fff;
      margin: 0 0 14px;
      position: relative;
      z-index: 1;
    }
    .cta-section p {
      font-size: 15px;
      color: #bfc6ea;
      max-width: 480px;
      margin: 0 auto 32px;
      line-height: 1.7;
      position: relative;
      z-index: 1;
    }
    .cta-buttons {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      justify-content: center;
      position: relative;
      z-index: 1;
    }

    /* ======================================================================
       ►► REVEAL ON SCROLL — bikin section CTA muncul halus (fade+naik)
       saat mulai kelihatan di layar. Tidak mengubah struktur HTML, cuma
       tambah class "reveal" pada section lalu JS toggle "is-visible".
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

    /* ============ FOOTER ============ */
    .footer {
      background: #0d1735;
      padding: 28px clamp(16px, 5vw, 48px);
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      gap: 14px;
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
      transition: color 0.15s;
    }
    .footer-links a:hover {
      color: #aeb6e0;
    }
  </style>
  </head>
  <body>
    <!-- ============ NAVBAR ============ -->
    <header class="navbar">
      <a href="{{ route('landing.home') }}" class="navbar-brand" aria-label="PKKMB-KT UNILAM Beranda">
        <div class="navbar-logo">
          <img src="{{ asset('gambar/unilam.webp') }}" alt="Logo UNILAM" />
        </div>
        <div class="navbar-brand-text">
          <strong>PKKMB-KT</strong>
          <span>UNILAM 2026</span>
        </div>
      </a>

      <!-- Tombol Garis Tiga (Hanya muncul di HP) -->
      <button class="menu-toggle" id="menuToggle" aria-label="Buka Menu">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <nav class="navbar-links" id="navbarLinks" aria-label="Navigasi utama">
        <a href="{{ route('landing.home') }}" class="active">Beranda</a>

        <!-- ======================================================================
             ►► DROPDOWN "TENTANG" DI SINI
             - Tambah link baru: copy salah satu <a> di dalam .nav-dropdown-menu
        ====================================================================== -->
        <div class="nav-dropdown" id="dropdownTentang">
          <button
            type="button"
            class="nav-dropdown-toggle"
            id="dropdownTentangToggle"
            aria-expanded="false"
            aria-controls="dropdownTentangMenu"
          >
            Tentang
            <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
          </button>
          <div class="nav-dropdown-menu" id="dropdownTentangMenu">
            <!-- TAMBAH / GANTI ITEM SUBMENU DI SINI -->
            <a href="{{ route('landing.sejarah') }}">Sejarah</a>
            <a href="{{ route('landing.visi-misi') }}">Visi &amp; Misi</a>
            <a href="{{ route('landing.tentang-kami') }}">Tentang Kami</a>
          </div>
        </div>
        <!-- ====================== AKHIR DROPDOWN "TENTANG" ====================== -->

        <a href="{{ route('landing.informasi') }}">Informasi</a>
        <a href="{{ route('landing.kontak') }}">Kontak</a>
      </nav>
    </header>

    <!-- ============ HERO ============ -->
    <section class="hero">
      <!-- ►► SLIDESHOW LATAR — slide diisi otomatis lewat JS di bawah -->
      <div class="hero-slideshow" id="heroSlideshow"></div>
      <!-- ►► AKSEN GLOW DEKORATIF — teal & lime, memberi kesan lebih premium -->
      <span class="hero-glow hero-glow--teal"></span>
      <span class="hero-glow hero-glow--lime"></span>

      <div class="social-float">
        <!-- WhatsApp -->
        <a href="https://wa.me/6282299537888" target="_blank">
          <i class="fa-brands fa-whatsapp"></i>
        </a>

        <!-- Instagram -->
        <a href="https://www.instagram.com/unilam.official?igsh=eHhseWMzZjVibTFu" target="_blank">
          <i class="fa-brands fa-instagram"></i>
        </a>
         <a href="https://www.tiktok.com/@unilam.official?is_from_webapp=1&sender_device=pc" target="_blank">
    <i class="fa-brands fa-tiktok"></i>
  </a>
</div>
      </div>

      <!-- ======================================================================
           ►► TEKS UTAMA HERO
           Warna judul pakai gradasi brand: #004a8f → #00a79d → #a6ce39
      ====================================================================== -->
      <div class="hero-panel text-center md:text-left max-w-2xl mx-auto md:mx-0">
        <p class="font-display text-lg md:text-2xl text-white/90 tracking-wide leading-none mb-1">
          Selamat Datang di
        </p>

        <h2 class="font-abril text-5xl md:text-8xl tracking-wide brand-gradient-text animate-gradient-text -mt-1 md:-mt-2 pb-1">
          PKKMB-KT
        </h2>

        <p class="text-sm md:text-lg text-white/85 tracking-wide leading-snug mt-2 mb-5 max-w-lg mx-auto md:mx-0">
          Pengenalan Kehidupan Kampus bagi Mahasiswa Baru Khutbatut Ta'aruf
        </p>

        <hr class="border-teal-800/50 my-4 max-w-xs mx-auto md:mx-0" />

        <h3 class="text-2xl md:text-4xl font-extrabold tracking-wide mt-4">
          <span class="font-abril text-3xl md:text-5xl brand-gradient-text animate-gradient-text">
            UNILAM 2026
          </span>
        </h3>

        <p class="font-display italic text-lg md:text-xl text-white/80 tracking-wide mt-2 mb-8">
          Universitas La Tansa Mashiro
        </p>

        <div class="hero-actions">
          <!-- ►► TOMBOL LOGIN — KHUSUS MENTOR, MBA & PANITIA (bukan peserta) -->
          <a href="{{ Route::has('login') ? route('login') : url('/login') }}" class="btn-primary">
            <i class="fa-solid fa-user-shield ic"></i>
            Login Peserta PKKMB-KT
            <svg
              class="ic"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
        </div>
        <p class="hero-login-note">
          <i class="fa-solid fa-circle-info"></i>
          Jika Lupa Password, hubungi panitia via WhatsApp
        </p>
      </div>
    </section>

    <!-- ============ CTA ============ -->
    <section class="cta-section reveal">
      <h2>Siap Memulai Perjalananmu?</h2>
      <p>
        Bergabunglah dengan ribuan mahasiswa baru UNILAM dan mulai pengalaman
        kampus terbaikmu bersama kami.
      </p>
     <div class="cta-buttons flex items-center justify-center p-2">
  <a href="https://wa.me/6282299537888" 
     class="btn-outline" 
     target="_blank" 
     rel="noopener noreferrer">
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

    <!-- ============ SCRIPT LIVE TOGGLE ============ -->
    <script>
      lucide.createIcons();

      const menuToggle = document.getElementById("menuToggle");
      const navbarLinks = document.getElementById("navbarLinks");

      menuToggle.addEventListener("click", () => {
        menuToggle.classList.toggle("active");
        navbarLinks.classList.toggle("active");
      });

      // ======================================================================
      // ►► SCRIPT DROPDOWN "TENTANG" — buka/tutup submenu Sejarah & Visi Misi
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

      // Menutup menu otomatis jika link diklik
      const links = navbarLinks.querySelectorAll("a");
      links.forEach((link) => {
        link.addEventListener("click", () => {
          menuToggle.classList.remove("active");
          navbarLinks.classList.remove("active");
        });
      });
      // ======================================================================
      // ►► SLIDESHOW LATAR HERO — ganti / tambah gambar di array ini.
      //    HERO_SLIDE_INTERVAL_MS = jeda waktu tiap gambar (dalam milidetik).
      //    5000 = 5 detik. Tinggal ubah angka ini kalau mau lebih cepat/lambat.
      // ======================================================================
      const heroSlideImages = [
        "/gambar/gedungutama.webp",
        "/gambar/rektor.webp",
        "/gambar/gedung.webp",
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
      // ►► REVEAL ON SCROLL — munculkan section CTA secara halus
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