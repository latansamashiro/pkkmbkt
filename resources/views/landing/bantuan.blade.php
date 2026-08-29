<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Pusat Bantuan | PKKMB-KT UNILAM 2026</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <style>
      /* ============ DESIGN TOKENS — IDENTIK HALAMAN LAIN ============ */
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

      /* ============ NAVBAR — IDENTIK HOME_PAGE.HTML / HALAMAN LAIN ============ */
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
        min-height: 260px;
        padding: clamp(40px, 7vw, 64px) clamp(16px, 5vw, 48px);
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(
          135deg,
          rgba(21, 33, 89, 0.96) 0%,
          rgba(15, 138, 140, 0.9) 100%
        );
      }
      .hero-info-inner {
        position: relative;
        z-index: 1;
        max-width: 760px;
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
      }
      .hero-info h1 {
        font-family: var(--font-display);
        font-size: clamp(24px, 4vw, 36px);
        font-weight: 700;
        color: #fff;
        margin: 0 0 10px;
        line-height: 1.2;
      }
      .hero-info-sub {
        font-size: 13.5px;
        color: rgba(255, 255, 255, 0.78);
        line-height: 1.7;
        max-width: 560px;
        margin: 0 auto;
      }

      /* ============ CONTENT ============ */
      .content-wrap {
        max-width: 780px;
        margin: 0 auto;
        padding: 36px clamp(16px, 5vw, 48px) 60px;
      }

      .section-head {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 34px 0 16px;
      }
      .section-head:first-child {
        margin-top: 0;
      }
      .section-head i {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: var(--teal-tint);
        color: var(--teal-600);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
      }
      .section-head h2 {
        font-family: var(--font-display);
        font-size: 19px;
        font-weight: 700;
        color: var(--navy-900);
        margin: 0;
      }

      .help-intro {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-card);
        padding: 26px clamp(20px, 4vw, 30px);
      }
      .help-intro p {
        margin: 0;
        line-height: 1.85;
        color: var(--ink-600);
        font-size: 14.5px;
      }

      /* ---- FAQ ACCORDION ---- */
      .faq-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
      }
      .faq-item {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-card);
        overflow: hidden;
      }
      .faq-item summary {
        list-style: none;
        cursor: pointer;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 700;
        font-size: 14px;
        color: var(--navy-900);
      }
      .faq-item summary::-webkit-details-marker {
        display: none;
      }
      .faq-num {
        flex-shrink: 0;
        width: 26px;
        height: 26px;
        border-radius: 8px;
        background: var(--navy-tint);
        color: var(--navy-700);
        font-family: var(--font-display);
        font-size: 12.5px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .faq-item summary .chev {
        margin-left: auto;
        color: var(--ink-400);
        transition: transform 0.2s ease;
        flex-shrink: 0;
      }
      .faq-item[open] summary .chev {
        transform: rotate(180deg);
      }
      .faq-item[open] summary {
        border-bottom: 1px solid var(--border);
      }
      .faq-answer {
        padding: 14px 20px 18px 58px;
        font-size: 13.5px;
        color: var(--ink-600);
        line-height: 1.75;
      }

      /* ---- KENDALA TEKNIS ---- */
      .issue-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-card);
        padding: 20px clamp(18px, 4vw, 24px);
        margin-bottom: 14px;
      }
      .issue-card h3 {
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: var(--font-display);
        font-size: 15px;
        font-weight: 700;
        color: var(--navy-900);
        margin: 0 0 12px;
      }
      .issue-card h3 i {
        color: var(--amber-500);
        font-size: 15px;
      }
      .issue-card ul {
        margin: 0;
        padding-left: 4px;
        list-style: none;
      }
      .issue-card ul li {
        position: relative;
        padding-left: 22px;
        margin-bottom: 8px;
        font-size: 13.5px;
        color: var(--ink-600);
        line-height: 1.65;
      }
      .issue-card ul li:last-child {
        margin-bottom: 0;
      }
      .issue-card ul li::before {
        content: "";
        position: absolute;
        left: 0;
        top: 7px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--teal-500);
      }

      /* ---- PANDUAN SINGKAT (langkah bernomor) ---- */
      .step-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
      }
      .step-item {
        display: flex;
        gap: 14px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-card);
        padding: 16px 18px;
        align-items: flex-start;
      }
      .step-num {
        flex-shrink: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--lime-500), var(--teal-600));
        color: #fff;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 13.5px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .step-item h4 {
        margin: 0 0 3px;
        font-size: 14px;
        font-weight: 700;
        color: var(--navy-900);
      }
      .step-item p {
        margin: 0;
        font-size: 13px;
        color: var(--ink-600);
        line-height: 1.6;
      }

      .help-note {
        background: var(--teal-tint);
        border-left: 4px solid var(--teal-500);
        border-radius: var(--radius-sm);
        padding: 16px 18px;
        margin-top: 18px;
        font-size: 13.5px;
        color: var(--ink-600);
        line-height: 1.8;
      }

      /* ---- KONTAK & JAM LAYANAN ---- */
      .help-contact {
        background: linear-gradient(160deg, var(--navy-900), #1b2b72);
        color: #fff;
        border-radius: var(--radius-lg);
        padding: 26px clamp(20px, 4vw, 30px);
      }
      .help-contact h2 {
        font-family: var(--font-display);
        font-size: 18px;
        margin: 0 0 14px;
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .help-contact-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 12px;
        font-size: 13.5px;
        color: #cfd4ee;
        line-height: 1.6;
      }
      .help-contact-row:last-of-type {
        margin-bottom: 0;
      }
      .help-contact-row i {
        width: 16px;
        margin-top: 3px;
        color: var(--lime-500);
        flex-shrink: 0;
      }
      .help-contact a {
        color: #fff;
        font-weight: 700;
        text-decoration: underline;
      }

      .hours-card {
        margin-top: 22px;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.14);
        border-radius: var(--radius-md);
        padding: 18px 20px;
      }
      .hours-card h3 {
        font-family: var(--font-display);
        font-size: 14.5px;
        margin: 0 0 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        color: #fff;
      }
      .hours-row {
        display: flex;
        justify-content: space-between;
        padding: 7px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 13px;
      }
      .hours-row:last-child {
        border-bottom: none;
      }
      .hours-row span:first-child {
        color: #bfc6ea;
      }
      .hours-row span:last-child {
        font-weight: 700;
        color: #fff;
      }
      .hours-row.closed span:last-child {
        color: #f2a5a7;
      }

      .help-contact-foot {
        margin-top: 18px;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        font-size: 12.5px;
        color: #9aa2cc;
        line-height: 1.7;
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
        text-decoration: none;
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
      <a
        href="{{ route('landing.home') }}"
        class="navbar-brand"
        aria-label="PKKMB-KT UNILAM Beranda"
      >
        <div class="navbar-logo">
          <img src="{{ asset('gambar/unilam.webp') }}" alt="Logo UNILAM" />
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
         <a href="{{ route('landing.kebijakan-privasi') }}">Kebijakan Privasi</a>
        <a href="{{ route('landing.syarat-ketentuan') }}">Syarat &amp; Ketentuan</a>
        <a href="{{ route('landing.bantuan') }}" class="active">Bantuan</a>
      </nav>
    </header>

    <!-- ============ HERO ============ -->
    <section class="hero-info">
      <div class="hero-info-inner">
        <h1>Pusat Bantuan</h1>
        <p class="hero-info-sub">
          Selamat datang di Pusat Bantuan PKKMB-KT. Halaman ini disediakan
          untuk membantu mahasiswa baru dan peserta PKKMB dalam menggunakan
          website serta memperoleh informasi kegiatan secara cepat dan mudah.
        </p>
      </div>
    </section>

    <!-- ============ MAIN ============ -->
    <div class="content-wrap">
      <!-- ===== FAQ ===== -->
      <div class="section-head">
        <i class="fa-solid fa-circle-question"></i>
        <h2>Pertanyaan yang Sering Diajukan (FAQ)</h2>
      </div>

      <div class="faq-list">
        <!-- ►► TAMBAH / EDIT FAQ DI SINI — copy satu <details class="faq-item"> -->
        <details class="faq-item" open>
          <summary>
            <span class="faq-num">1</span>
            Bagaimana cara login ke website PKKMB-KT?
            <i class="fa-solid fa-chevron-down chev"></i>
          </summary>
          <div class="faq-answer">
            Gunakan akun yang telah diberikan oleh panitia atau pihak
            universitas. Masukkan email/NIM dan kata sandi pada halaman
            login.
          </div>
        </details>

        <details class="faq-item">
          <summary>
            <span class="faq-num">2</span>
            Saya lupa kata sandi, apa yang harus dilakukan?
            <i class="fa-solid fa-chevron-down chev"></i>
          </summary>
          <div class="faq-answer">
            Klik menu <b>Lupa Kata Sandi</b> pada halaman login atau hubungi
            panitia PKKMB melalui kontak resmi yang tersedia di bawah.
          </div>
        </details>

        <details class="faq-item">
          <summary>
            <span class="faq-num">3</span>
            Jadwal kegiatan tidak muncul, bagaimana solusinya?
            <i class="fa-solid fa-chevron-down chev"></i>
          </summary>
          <div class="faq-answer">
            Pastikan koneksi internet stabil, lalu muat ulang halaman. Jika
            jadwal masih tidak muncul, coba login kembali atau hubungi
            panitia.
          </div>
        </details>

        <details class="faq-item">
          <summary>
            <span class="faq-num">4</span>
            Bagaimana cara melihat tugas atau informasi terbaru?
            <i class="fa-solid fa-chevron-down chev"></i>
          </summary>
          <div class="faq-answer">
            Semua pengumuman, jadwal, dan tugas PKKMB akan ditampilkan pada
            halaman Dashboard setelah pengguna berhasil login.
          </div>
        </details>

        <details class="faq-item">
          <summary>
            <span class="faq-num">5</span>
            Apakah website dapat diakses melalui HP?
            <i class="fa-solid fa-chevron-down chev"></i>
          </summary>
          <div class="faq-answer">
            Ya. Website PKKMB-KT dirancang agar dapat diakses melalui
            smartphone, tablet, maupun komputer.
          </div>
        </details>
      </div>

      <!-- ===== KENDALA TEKNIS ===== -->
      <div class="section-head">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <h2>Kendala Teknis Umum</h2>
      </div>

      <div class="issue-card">
        <h3><i class="fa-solid fa-triangle-exclamation"></i>Halaman tidak dapat dibuka</h3>
        <ul>
          <li>Periksa koneksi internet.</li>
          <li>Gunakan browser terbaru seperti Google Chrome atau Microsoft Edge.</li>
          <li>Hapus cache browser jika halaman tidak diperbarui.</li>
        </ul>
      </div>

      <div class="issue-card">
        <h3><i class="fa-solid fa-triangle-exclamation"></i>Gagal login</h3>
        <ul>
          <li>Pastikan NIM atau email sudah benar.</li>
          <li>Periksa kembali penggunaan huruf besar dan kecil pada kata sandi.</li>
          <li>Coba gunakan fitur Lupa Kata Sandi.</li>
        </ul>
      </div>

      <div class="issue-card">
        <h3><i class="fa-solid fa-triangle-exclamation"></i>Data tidak tersimpan</h3>
        <ul>
          <li>Pastikan semua kolom yang wajib diisi sudah lengkap.</li>
          <li>Jangan menutup halaman sebelum proses penyimpanan selesai.</li>
          <li>Tunggu hingga muncul notifikasi berhasil disimpan.</li>
        </ul>
      </div>

      <!-- ===== PANDUAN SINGKAT ===== -->
      <div class="section-head">
        <i class="fa-solid fa-list-check"></i>
        <h2>Panduan Singkat Penggunaan Website</h2>
      </div>
      <p style="color: var(--ink-600); font-size: 13.5px; margin: -6px 0 16px; line-height: 1.7;">
        Untuk memudahkan mahasiswa baru dalam mengikuti seluruh rangkaian
        kegiatan PKKMB-KT, silakan ikuti langkah-langkah berikut:
      </p>

      <div class="step-list">
        <div class="step-item">
          <span class="step-num">1</span>
          <div>
            <h4>Login ke Website</h4>
            <p>Menggunakan akun PKKMB yang telah diberikan oleh panitia atau pihak universitas.</p>
          </div>
        </div>
        <div class="step-item">
          <span class="step-num">2</span>
          <div>
            <h4>Masuk ke Dashboard</h4>
            <p>Untuk melihat informasi utama seperti jadwal kegiatan, pengumuman, tugas, dan status kehadiran.</p>
          </div>
        </div>
        <div class="step-item">
          <span class="step-num">3</span>
          <div>
            <h4>Periksa Jadwal Kegiatan</h4>
            <p>Secara berkala agar tidak terlambat mengikuti kegiatan PKKMB-KT yang telah ditentukan.</p>
          </div>
        </div>
        <div class="step-item">
          <span class="step-num">4</span>
          <div>
            <h4>Baca Pengumuman Terbaru</h4>
            <p>Yang disampaikan oleh panitia melalui sistem website.</p>
          </div>
        </div>
        <div class="step-item">
          <span class="step-num">5</span>
          <div>
            <h4>Kerjakan dan Kumpulkan Tugas</h4>
            <p>Sesuai petunjuk yang diberikan pada menu tugas.</p>
          </div>
        </div>
        <div class="step-item">
          <span class="step-num">6</span>
          <div>
            <h4>Pantau Status Kehadiran</h4>
            <p>Untuk memastikan keikutsertaan dalam setiap kegiatan telah tercatat dengan benar.</p>
          </div>
        </div>
        <div class="step-item">
          <span class="step-num">7</span>
          <div>
            <h4>Logout Setelah Selesai</h4>
            <p>Menggunakan website demi menjaga keamanan akun dan data pribadi.</p>
          </div>
        </div>
      </div>

      <div class="help-note">
        Apabila mengalami kendala saat login, mengakses menu, melihat
        jadwal, atau mengumpulkan tugas, silakan menghubungi panitia
        PKKMB-KT melalui kontak bantuan yang tersedia pada halaman ini.
      </div>

      <!-- ===== KONTAK & JAM LAYANAN ===== -->
      <div class="help-contact" style="margin-top: 34px">
        <h2><i class="fa-solid fa-headset"></i>Kontak Resmi</h2>
        <p style="margin: 0 0 14px; color: #cfd4ee; font-size: 13.5px">
          Apabila kendala belum terselesaikan, silakan hubungi panitia
          melalui kontak resmi berikut:
        </p>

        <div class="help-contact-row">
          <i class="fa-solid fa-building-columns"></i>
          <span>PKKMB-KT Universitas La Tansa Mashiro</span>
        </div>
        <div class="help-contact-row">
          <i class="fa-solid fa-location-dot"></i>
          <span
            >Jl. Soekarno-Hatta, Kec. Rangkasbitung, Kab. Lebak,
            Banten 42317</span
          >
        </div>
        <div class="help-contact-row">
          <i class="fa-solid fa-envelope"></i>
          <span
            >Email:
            <a href="mailto:pkkmb@latansamashiro.ac.id"
              >pmb.latansamashiro@gmail.com</a
            ></span
          >
        </div>

        <div class="hours-card">
          <h3><i class="fa-solid fa-clock"></i>Jam Layanan</h3>
          <div class="hours-row">
            <span>Senin – Jumat</span>
            <span>08.00 – 16.00 WIB</span>
          </div>
          <div class="hours-row">
            <span>Sabtu</span>
            <span>08.00 – 12.00 WIB</span>
          </div>
          <div class="hours-row closed">
            <span>Minggu &amp; Hari Libur</span>
            <span>Tutup</span>
          </div>
        </div>

        <p class="help-contact-foot">
          Kami akan berusaha merespons setiap pertanyaan dan kendala
          secepat mungkin agar kegiatan PKKMB-KT dapat berjalan dengan
          lancar.<br /><br />
          Terima kasih telah menggunakan website PKKMB-KT Universitas La
          Tansa Mashiro.
        </p>
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

    <script>
      const menuToggle = document.getElementById("menuToggle");
      const navbarLinks = document.getElementById("navbarLinks");
      if (menuToggle) {
        menuToggle.addEventListener("click", function () {
          menuToggle.classList.toggle("active");
          navbarLinks.classList.toggle("active");
        });
      }
    </script>
  </body>
</html>
