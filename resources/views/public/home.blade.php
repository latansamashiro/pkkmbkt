@extends('layouts.public')

@section('title', 'PKKMB-KT UNILAM 2026')

@push('styles')
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
       ►► TANDA UNTUK EDIT SELANJUTNYA:
          - Tambah item submenu baru: copy 1 baris <a> di dalam
            .nav-dropdown-menu (lihat HTML di bagian <nav class="navbar-links">)
          - Ganti label tombol: ubah teks di <button class="nav-dropdown-toggle">
          - Ganti warna/ukuran dropdown: ubah blok CSS di bawah ini
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
      background-image:
        linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url('{{ asset('gerbang.jpeg') }}');
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      padding: clamp(48px, 8vw, 96px) clamp(16px, 5vw, 48px)
        clamp(56px, 10vw, 112px);
      display: flex;
      align-items: center;
      gap: 48px;
      flex-wrap: wrap;
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
      transition: filter 0.15s;
      box-shadow: var(--shadow-pop);
    }
    .btn-primary:hover {
      filter: brightness(1.06);
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
@endpush

@section('content')

    <!-- ============ HERO ============ -->
    <section class="hero">
      <div class="social-float">
        <!-- WhatsApp -->
        <a href="https://wa.me/6282299537888" target="_blank">
          <i class="fa-brands fa-whatsapp"></i>
        </a>

        <!-- Instagram -->
        <a href="https://www.instagram.com/unilam.official?igsh=eHhseWMzZjVibTFu" target="_blank">
          <i class="fa-brands fa-instagram"></i>
        </a>
         <a href="https://www.tiktok.com/@botakteras?_r=1&_t=ZS-97zsjIeL4g0" target="_blank">
    <i class="fa-brands fa-tiktok"></i>
  </a>
</div>
      </div>
      <div class="text-center md:text-left max-w-2xl mx-auto md:mx-0">
 <div class="text-center md:text-left max-w-2xl mx-auto md:mx-0">
  <!-- Judul Utama (Menggunakan Nagoda) -->
  <h1 class="font-nagoda text-4xl md:text-6xl text-white tracking-wide leading-none">
    Selamat Datang di
  </h1>
  
  <!-- Teks Animasi 1: PKKMB-KT (Tetap Abril Fatface, Jarak Dirapatkan dengan -mt-1 atau -mt-2) -->
  <h2 class="font-abril text-6xl md:text-8xl tracking-wide animate-gradient-text bg-gradient-to-r from-green-400 via-teal-400 to-blue-500 bg-clip-text text-transparent -mt-1 md:-mt-2 pb-1">
    PKKMB-KT
  </h2>
  
 <!-- Subjudul / Kepanjangan (Menggunakan Nagoda & Dirapatkan - Tegak) -->
<p class="font-nagoda text-base md:text-xl text-white tracking-wide opacity-90 leading-tight mt-1 mb-6">
  Pengenalan Kehidupan Kampus bagi Mahasiswa Baru - Khutbatut Ta'aruf
</p>
  <hr class="border-teal-800/50 my-4 max-w-xs" />

  <!-- Teks Animasi 2: Nama Kampus (Tetap Abril Fatface) -->
  <h3 class="text-3xl md:text-5xl font-extrabold tracking-wide text-white mt-4">
    <span class="font-abril text-4xl md:text-6xl animate-gradient-text bg-gradient-to-r from-teal-400 via-emerald-400 to-blue-400 bg-clip-text text-transparent">
      UNILAM 2026
    </span>
  </h3> 
  
  <!-- Nama Universitas (Menggunakan Nagoda) -->
  <p class="font-nagoda text-xl md:text-2xl text-slate-300 tracking-wide mt-1 mb-10">
    Universitas La Tansa Mashiro
  </p>
</div>
        <div class="hero-actions pt-10">
          <a href="{{ route('login') }}" class="btn-primary">
            Login Mahasiswa
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
          <a href="#" title="TODO: halaman login mentor belum dibuat" class="btn-primary">
            Login Mentor
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
      </div>
    </section>

    <!-- ============ CTA ============ -->
    <section class="cta-section">
      <h2>Siap Memulai Perjalananmu?</h2>
      <p>
        Bergabunglah dengan ribuan mahasiswa baru UNILAM dan mulai pengalaman
        kampus terbaikmu bersama kami.
      </p>
     <div class="cta-buttons flex items-center justify-center p-2">
  <a href="https://wa.me/622123108138?text=Halo%20Panitia,%20saya%20ingin%20bertanya%20mengenai%20acara..." 
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
        <a href="#">Kebijakan Privasi</a>
        <a href="#">Syarat &amp; Ketentuan</a>
        <a href="#">Bantuan</a>
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
    </script>
@endsection
