<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Modul | PKKMB-KT UNILAM 2026</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <style>
      /* ============ DESIGN TOKENS — IDENTIK HOMEPAGE/MATERI/EVALUASI/LEADERBOARD ============ */
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
        --plus-500: #059669;
        --plus-tint: #ecfdf5;
        --minus-500: #dc2626;
        --minus-tint: #fef2f2;
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

      /* ============ NAVBAR — COPY EXACT DARI HALAMAN LAIN ============ */
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
        overflow: hidden;
        padding: clamp(40px, 7vw, 64px) clamp(16px, 5vw, 48px);
      }
      /* ►► SLIDESHOW LATAR HERO — sama seperti home_page.html/tentang.html.
         Ganti/tambah gambar di array JS "heroSlideImages" di bawah file
         ini. Durasi tiap gambar diatur lewat "HERO_SLIDE_INTERVAL_MS". */
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
        max-width: 900px;
        margin: 0 auto;
        text-align: center;
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
        margin: 0 auto;
      }

      /* ============ CONTENT ============ */
      .content-wrap {
        max-width: 900px;
        margin: 0 auto;
        padding: 32px clamp(16px, 5vw, 48px);
        padding-bottom: calc(var(--bottomnav-h) + 28px);
      }
      @media (min-width: 768px) {
        .content-wrap {
          padding-bottom: 32px;
        }
      }

      /* ============ CARD ============ */
      .card {
        background: var(--surface);
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-card);
        padding: 26px clamp(20px, 4vw, 30px);
        margin-bottom: 20px;
      }
      .card h2 {
        font-family: var(--font-display);
        color: var(--navy-900);
        font-size: 19px;
        font-weight: 700;
        margin: 0 0 16px;
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .card h2::before {
        content: "";
        width: 5px;
        height: 20px;
        border-radius: 99px;
        background: linear-gradient(
          to bottom,
          var(--teal-500),
          var(--navy-700)
        );
        flex-shrink: 0;
      }
      .card h3 {
        color: var(--teal-600);
        font-size: 14.5px;
        font-weight: 700;
        margin: 18px 0 10px;
      }
      .card p {
        line-height: 1.8;
        color: var(--ink-600);
        font-size: 14px;
        margin: 0;
      }

      ul {
        padding-left: 20px;
        margin-top: 10px;
      }
      li {
        margin-bottom: 10px;
        line-height: 1.7;
        font-size: 13.5px;
        color: var(--ink-600);
      }
      li::marker {
        color: var(--teal-500);
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 14px;
        border-radius: var(--radius-sm);
        overflow: hidden;
        border: 1px solid var(--border);
      }
      th {
        background: var(--navy-900);
        color: #fff;
        padding: 13px 14px;
        text-align: left;
        font-size: 12.5px;
        font-weight: 700;
      }
      td {
        padding: 13px 14px;
        border-bottom: 1px solid var(--border);
        font-size: 13.5px;
        color: var(--ink-900);
      }
      tr:last-child td {
        border-bottom: none;
      }
      tr:nth-child(even) td {
        background: var(--bg);
      }

      .plus {
        color: var(--plus-500);
        font-weight: 800;
        background: var(--plus-tint);
        padding: 3px 10px;
        border-radius: 99px;
        font-size: 12px;
        display: inline-block;
      }
      .minus {
        color: var(--minus-500);
        font-weight: 800;
        background: var(--minus-tint);
        padding: 3px 10px;
        border-radius: 99px;
        font-size: 12px;
        display: inline-block;
      }

      .note {
        background: var(--teal-tint);
        border-left: 4px solid var(--teal-500);
        padding: 16px 18px;
        border-radius: var(--radius-sm);
        margin-top: 18px;
        line-height: 1.8;
        color: var(--ink-600);
        font-size: 13.5px;
      }
      .note b {
        color: var(--navy-900);
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
    <!-- ============ NAVBAR — IDENTIK HALAMAN LAIN ============ -->
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

      <button
        class="menu-toggle"
        id="menuToggle"
        aria-label="Buka Menu"
      ></button>

      <nav class="navbar-links" id="navbarLinks">
        <a href="#" class="active">Modul</a>
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
        <div class="hero-eyebrow">
          <span class="dot"></span>
          Panduan Peserta
        </div>
        <h1>Modul<br />PKKMB-KT UNILAM 2026</h1>
        <p class="hero-info-sub">
          Kenali tata tertib, atribut wajib, dan sistem penilaian sebelum
          mengikuti seluruh rangkaian kegiatan PKKMB-KT.
        </p>
      </div>
    </section>

    <!-- ============ MAIN ============ -->
    <div class="content-wrap">
      <div class="card">
        <h2>Tentang PKKMB-KT</h2>
        <p>
          Pengenalan Kehidupan Kampus bagi Mahasiswa Baru (PKKMB-KT) merupakan
          kegiatan awal yang bertujuan untuk membantu mahasiswa baru mengenal
          lingkungan kampus, budaya akademik, tata tertib, serta membangun
          karakter yang disiplin, bertanggung jawab, dan mampu beradaptasi
          dengan kehidupan perkuliahan.
        </p>
      </div>

      <div class="card">
        <h2>Tata Tertib</h2>

        <h3>Kehadiran</h3>
        <ul>
          <li>Hadir 15 menit sebelum kegiatan dimulai.</li>
          <li>Wajib mengikuti seluruh rangkaian kegiatan PKKMB-KT.</li>
          <li>
            Tidak diperkenankan meninggalkan kegiatan tanpa izin mentor atau
            panitia.
          </li>
        </ul>

        <h3>Berpakaian</h3>
        <ul>
          <li>Menggunakan pakaian sesuai ketentuan panitia.</li>
          <li>Berpenampilan rapi dan sopan.</li>
          <li>Menggunakan atribut yang telah ditentukan.</li>
        </ul>

        <h3>Sikap</h3>
        <ul>
          <li>Menghormati panitia, mentor, pemateri, dan sesama mahasiswa.</li>
          <li>Menjaga ketertiban selama kegiatan berlangsung.</li>
          <li>Tidak mengganggu jalannya kegiatan.</li>
        </ul>

        <h3>Kebersihan</h3>
        <ul>
          <li>Menjaga kebersihan lingkungan kegiatan.</li>
          <li>Membuang sampah pada tempatnya.</li>
        </ul>
      </div>

      <div class="card">
        <h2>Atribut yang Harus Dibawa</h2>
        <ul>
          <li>ID Card PKKMB.</li>
          <li>Alat tulis.</li>
          <li>Buku Panduan PKKMB.</li>
        </ul>
      </div>

      <div class="card">
        <h2>Sistem Penilaian</h2>

        <h3>⭐ Aspek Keaktifan</h3>
        <table>
          <tr>
            <th>Aspek</th>
            <th width="120">Poin</th>
          </tr>
          <tr>
            <td>Aktif bertanya dan menjawab</td>
            <td><span class="plus">+10</span></td>
          </tr>
          <tr>
            <td>Membantu teman</td>
            <td><span class="plus">+5</span></td>
          </tr>
          <tr>
            <td>Menjadi sukarelawan saat kegiatan</td>
            <td><span class="plus">+7</span></td>
          </tr>
          <tr>
            <td>Menjaga kebersihan</td>
            <td><span class="plus">+3</span></td>
          </tr>
        </table>

        <h3>⚠️ Aspek Pelanggaran</h3>
        <table>
          <tr>
            <th>Pelanggaran</th>
            <th width="120">Poin</th>
          </tr>
          <tr>
            <td>Tidak mengikuti kegiatan tanpa izin</td>
            <td><span class="minus">-15</span></td>
          </tr>
          <tr>
            <td>Tidak rapi / atribut tidak lengkap</td>
            <td><span class="minus">-5</span></td>
          </tr>
          <tr>
            <td>Mengganggu jalannya kegiatan</td>
            <td><span class="minus">-10</span></td>
          </tr>
        </table>

        <div class="note">
          <b>Informasi:</b><br /><br />
          Seluruh poin keaktifan dan pelanggaran akan diinput oleh mentor
          melalui sistem PKKMB-KT. Nilai akan diakumulasikan secara otomatis dan
          digunakan sebagai dasar perhitungan
          <b>Leaderboard Mahasiswa</b>. Mahasiswa dengan poin tertinggi akan
          menempati peringkat teratas sebagai bentuk apresiasi atas keaktifan
          dan kedisiplinannya selama kegiatan berlangsung.
        </div>
      </div>

      <div class="card">
        <h2>Reward &amp; Leaderboard</h2>
        <p>
          Mahasiswa yang memperoleh akumulasi poin tertinggi selama kegiatan
          PKKMB-KT akan mendapatkan apresiasi dari panitia sebagai bentuk
          penghargaan atas keaktifan, kedisiplinan, dan kontribusinya selama
          kegiatan berlangsung.
        </p>
        <ul>
          <li>Predikat Mahasiswa Teraktif PKKMB-KT.</li>
          <li>Piagam atau penghargaan (sesuai kebijakan panitia).</li>
          <li>Peringkat terbaik pada Leaderboard Mahasiswa.</li>
        </ul>
      </div>

      <div class="card">
        <h2>Sanksi</h2>
        <p>
          Mahasiswa yang melakukan pelanggaran terhadap tata tertib PKKMB-KT
          akan diberikan sanksi sesuai tingkat pelanggaran yang dilakukan.
        </p>
        <ul>
          <li>Teguran lisan dari mentor.</li>
          <li>Pengurangan poin penilaian.</li>
          <li>
            Pembinaan oleh panitia apabila pelanggaran dilakukan secara
            berulang.
          </li>
        </ul>
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
      <a href="#" class="active">
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
        <span>Leaderboard</span>
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
      // Navbar hamburger toggle (mobile)
     

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO — ganti / tambah gambar di array ini.
      // ======================================================================
      const heroSlideImages = ["{{ asset('gambar/gedungutama.jpeg') }}", "{{ asset('gambar/rektor.jpeg') }}", "{{ asset('gambar/gedung.jpeg') }}"];
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