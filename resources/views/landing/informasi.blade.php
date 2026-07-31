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
    <title>Informasi - PKKMB-KT UNILAM 2026</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
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
          padding: 10px 16px;
          box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
          gap: 4px;
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
          padding: 6px 0;
          white-space: nowrap;
        }
        .nowrap {
  white-space: nowrap;
}
      }

      /* ======================================================================
         ►► KEDIP LEMBUT — dipakai buat dot pada eyebrow & badge "Penting"
         supaya halaman terasa lebih hidup, konsisten dengan home_page.html.
      ====================================================================== */
      @keyframes soft-pulse {
        0%,
        100% {
          opacity: 0.55;
          transform: scale(1);
        }
        50% {
          opacity: 1;
          transform: scale(1.15);
        }
      }

      /* ============ CONTENT SECTION ============ */
      .content-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: clamp(32px, 5vw, 64px) clamp(16px, 5vw, 48px);
      }
      .page-header {
        text-align: center;
        margin-bottom: 48px;
      }
      /* ►► PILL KECIL DI ATAS JUDUL — biar konsisten dengan hero-eyebrow
         di halaman lain (home_page, sejarah, visi-misi) walau di sini
         tidak ada foto latar. */
      .page-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: var(--teal-tint);
        border: 1px solid rgba(15, 138, 140, 0.25);
        color: var(--teal-600);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 99px;
        margin-bottom: 16px;
      }
      .page-eyebrow .dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--teal-600);
        animation: soft-pulse 1.8s ease-in-out infinite;
      }
      .page-header h1 {
        font-family: var(--font-display);
        font-size: clamp(28px, 4vw, 42px);
        color: var(--navy-900);
        margin: 0 0 12px;
      }
      .page-header p {
        font-size: 16px;
        color: var(--ink-600);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
      }

      /* ======================================================================
         ►► REVEAL ON SCROLL — bikin daftar info & CTA muncul halus
         (fade+naik) saat mulai kelihatan di layar.
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

      /* INFO CARD LAYOUT */
      .info-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
        margin-bottom: 48px;
      }
      @media (min-width: 768px) {
        .info-grid {
          grid-template-columns: repeat(2, 1fr);
        }
      }
      .info-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-left: 3px solid transparent;
        border-radius: var(--radius-md);
        padding: 28px;
        box-shadow: var(--shadow-card);
        transition:
          transform 0.2s ease,
          box-shadow 0.2s ease,
          border-color 0.2s ease;
      }
      .info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(21, 33, 89, 0.14);
      }
      .info-card:has(.badge-urgent) {
        border-left-color: #ff3b30;
      }
      .info-card:has(.badge-general) {
        border-left-color: var(--teal-500);
      }
      .card-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 6px;
        margin-bottom: 16px;
        letter-spacing: 0.05em;
      }
      .badge-urgent {
        background: #ffebe6;
        color: #ff3b30;
      }
      .badge-urgent .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #ff3b30;
        animation: soft-pulse 1.4s ease-in-out infinite;
      }
      .badge-general {
        background: var(--teal-tint);
        color: var(--teal-600);
      }
      .info-card h3 {
        font-family: var(--font-display);
        font-size: 20px;
        color: var(--navy-900);
        margin: 0 0 12px;
      }
      .info-card p {
        font-size: 14.5px;
        color: var(--ink-600);
        line-height: 1.7;
        margin: 0 0 20px;
      }
      .card-meta {
        font-size: 12.5px;
        color: var(--ink-400);
        display: flex;
        align-items: center;
        gap: 6px;
        border-top: 1px solid var(--border);
        padding-top: 14px;
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
    <header class="navbar">
      <a href="{{ route('landing.home') }}" class="navbar-brand" aria-label="PKKMB-KT UNILAM Beranda">
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
            Tentang
            <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
          </button>
          <div class="nav-dropdown-menu" id="dropdownTentangMenu">
            <a href="{{ route('landing.sejarah') }}">Sejarah</a>
            <a href="{{ route('landing.visi-misi') }}">Visi &amp; Misi</a>
            <a href="{{ route('landing.tentang-kami') }}">Tentang Kami</a>
          </div>
        </div>

        <a href="#" class="active">Informasi</a>
        <a href="{{ route('landing.kontak') }}">Kontak</a>
      </nav>
    </header>

    <main class="content-wrapper">
      <section class="page-header">
        <span class="page-eyebrow">
          <span class="dot"></span>
          PKKMB-KT UNILAM 2026
        </span>
        <h1>Pusat Informasi &amp; Pengumuman</h1>
        <p>
  Pantau terus informasi berkala terkait pelaksanaan PKKMB-KT
  <span class="nowrap">Universitas La Tansa Mashiro 2026</span>
  di bawah ini.
</p>
      </section>

      <section class="info-grid reveal">
        <article class="info-card">
          <span class="card-badge badge-urgent"><span class="dot"></span>Penting</span>
          <h3>Ketentuan Atribut &amp; Pakaian Peserta</h3>
          <p>
            Seluruh mahasiswa baru diwajibkan menggunakan kemeja putih polos
            lengan panjang, celana/rok kain hitam formal, serta atribut resmi
            yang dibagikan oleh panitia.
          </p>
          <div class="card-meta">
            <svg
              width="14"
              height="14"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            Diposting: 20 Juni 2026
          </div>
        </article>

        <article class="info-card">
          <span class="card-badge badge-general">Pengumuman</span>
          <h3>Pembagian Kelompok &amp; Mentor</h3>
          <p>
            Daftar pembagian kelompok besar, gugus, serta kontak mentor
            pendamping dapat Anda akses langsung setelah melakukan login ke
            dashboard Mahasiswa.
          </p>
          <div class="card-meta">
            <svg
              width="14"
              height="14"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            Diposting: 18 Juni 2026
          </div>
        </article>
      </section>
    </main>

    <section class="cta-section reveal">
      <h2>Siap Memulai Perjalananmu?</h2>
      <p>
        Bergabunglah dengan ribuan mahasiswa baru UNILAM dan mulai pengalaman
        kampus terbaikmu bersama kami.
      </p>
      <div class="cta-buttons">
        <a href="https://wa.me/6282299537888" class="btn-outline">Hubungi Panitia</a>
      </div>
    </section>

    <footer class="footer">
      <p>© 2026 PKKMB-KT UNILAM. Semua hak dilindungi.</p>
      <div class="footer-links">
        <a href="{{ route('landing.kebijakan-privasi') }}">Kebijakan Privasi</a>
        <a href="{{ route('landing.syarat-ketentuan') }}">Syarat &amp; Ketentuan</a>
        <a href="{{ route('landing.bantuan') }}">Bantuan</a>
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
      // ►► REVEAL ON SCROLL — munculkan info-grid & CTA secara halus
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