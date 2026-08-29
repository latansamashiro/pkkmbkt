<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Syarat &amp; Ketentuan | PKKMB-KT UNILAM 2026</title>
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
        font-size: 13px;
        color: rgba(255, 255, 255, 0.72);
        line-height: 1.6;
        max-width: 520px;
        margin: 0 auto;
      }

      /* ============ CONTENT ============ */
      .content-wrap {
        max-width: 760px;
        margin: 0 auto;
        padding: 36px clamp(16px, 5vw, 48px) 60px;
      }

      .policy-intro {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-card);
        padding: 26px clamp(20px, 4vw, 30px);
        margin-bottom: 22px;
      }
      .policy-intro p {
        margin: 0;
        line-height: 1.85;
        color: var(--ink-600);
        font-size: 14.5px;
      }

      .policy-card {
        background: var(--surface);
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-card);
        padding: 24px clamp(20px, 4vw, 28px);
        margin-bottom: 18px;
      }
      .policy-card h2 {
        font-family: var(--font-display);
        color: var(--navy-900);
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 14px;
        display: flex;
        align-items: center;
        gap: 12px;
      }
      .policy-num {
        flex-shrink: 0;
        width: 30px;
        height: 30px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--teal-500), var(--navy-700));
        color: #fff;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .policy-card p {
        line-height: 1.85;
        color: var(--ink-600);
        font-size: 14px;
        margin: 0 0 10px;
      }
      .policy-card p:last-child {
        margin-bottom: 0;
      }
      .policy-card ul {
        margin: 8px 0 12px;
        padding-left: 4px;
        list-style: none;
      }
      .policy-card ul li {
        position: relative;
        padding-left: 22px;
        margin-bottom: 9px;
        line-height: 1.7;
        font-size: 14px;
        color: var(--ink-600);
      }
      .policy-card ul li::before {
        content: "";
        position: absolute;
        left: 0;
        top: 8px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--lime-500);
      }
      .policy-card ul li:last-child {
        margin-bottom: 0;
      }
      /* Larangan (pasal 4) pakai bullet merah muda peringatan, beda dari yang lain */
      .policy-card.warn ul li::before {
        background: #e0787a;
      }

      /* Kartu kontak, disorot beda dari kartu lain */
      .policy-contact {
        background: linear-gradient(160deg, var(--navy-900), #1b2b72);
        color: #fff;
        border-radius: var(--radius-lg);
        padding: 26px clamp(20px, 4vw, 30px);
        margin-top: 22px;
      }
      .policy-contact h2 {
        font-family: var(--font-display);
        font-size: 18px;
        margin: 0 0 14px;
        display: flex;
        align-items: center;
        gap: 12px;
      }
      .policy-contact .policy-num {
        background: var(--lime-500);
        color: var(--navy-900);
      }
      .policy-contact-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 12px;
        font-size: 13.5px;
        color: #cfd4ee;
        line-height: 1.6;
      }
      .policy-contact-row:last-of-type {
        margin-bottom: 0;
      }
      .policy-contact-row i {
        width: 16px;
        margin-top: 3px;
        color: var(--lime-500);
        flex-shrink: 0;
      }
      .policy-contact a {
        color: #fff;
        font-weight: 700;
        text-decoration: underline;
      }
      .policy-contact-foot {
        margin-top: 18px;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        font-size: 12.5px;
        color: #9aa2cc;
        line-height: 1.7;
      }

      /* Kartu "Perlindungan Data Pribadi" — beri tautan ke Kebijakan Privasi */
      .policy-card a.policy-link {
        color: var(--teal-600);
        font-weight: 700;
        text-decoration: none;
        border-bottom: 1.5px solid var(--teal-tint);
      }
      .policy-card a.policy-link:hover {
        border-bottom-color: var(--teal-500);
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
          <strong>SIMBA</strong>
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
        <a href="{{ route('landing.syarat-ketentuan') }}" class="active">Syarat &amp; Ketentuan</a>
        <a href="{{ route('landing.bantuan') }}">Bantuan</a>
      </nav>
    </header>

    <!-- ============ HERO ============ -->
    <section class="hero-info">
      <div class="hero-info-inner">
        <h1>Syarat dan Ketentuan</h1>
        <p class="hero-info-sub">
          PKKMB-KT Universitas La Tansa Mashiro &middot; Terakhir diperbarui:
          22 Juli 2026
        </p>
      </div>
    </section>

    <!-- ============ MAIN ============ -->
    <div class="content-wrap">
      <div class="policy-intro">
        <p>
          Selamat datang di website PKKMB-KT Universitas La Tansa Mashiro.
          Dengan mengakses dan menggunakan website ini, pengguna dianggap
          telah membaca, memahami, dan menyetujui seluruh syarat dan
          ketentuan yang berlaku.
        </p>
      </div>

      <!-- 1 -->
      <div class="policy-card">
        <h2><span class="policy-num">1</span>Ketentuan Umum</h2>
        <p>
          Website PKKMB-KT disediakan sebagai media informasi, administrasi,
          dan komunikasi resmi kegiatan Pengenalan Kehidupan Kampus bagi
          Mahasiswa Baru Universitas La Tansa Mashiro.
        </p>
        <p>
          Pengguna wajib menggunakan website PKKMB sesuai peruntukanya serta mematuhi peraturan yang berlaku dan kebijakan penyelenggara.
        </p>
      </div>

      <!-- 2 -->
      <div class="policy-card">
        <h2><span class="policy-num">2</span>Akun dan Akses Pengguna</h2>
        <ul>
          <li>
            Pengguna bertanggung jawab atas kerahasiaan akun, kata sandi, dan
            informasi login yang dimiliki.
          </li>
          <li>Dilarang memberikan akses akun kepada pihak lain tanpa izin.</li>
          <li>
            Segala aktivitas yang terjadi melalui akun pengguna menjadi
            tanggung jawab pemilik akun.
          </li>
        </ul>
      </div>

      <!-- 3 -->
      <div class="policy-card">
        <h2><span class="policy-num">3</span>Kewajiban Pengguna</h2>
        <p>Pengguna wajib:</p>
        <ul>
          <li>Memberikan data yang benar, akurat, dan terbaru.</li>
          <li>Menjaga etika dalam penggunaan website.</li>
          <li>
            Tidak mengunggah konten yang mengandung unsur SARA, pornografi,
            kekerasan, ujaran kebencian, atau pelanggaran hak cipta.
          </li>
          <li>
            Tidak melakukan tindakan yang dapat merusak sistem, server,
            jaringan, atau keamanan website.
          </li>
        </ul>
      </div>

      <!-- 4 -->
      <div class="policy-card warn">
        <h2><span class="policy-num">4</span>Larangan Penggunaan</h2>
        <p>Pengguna dilarang:</p>
        <ul>
          <li>Mengakses sistem tanpa izin.</li>
          <li>
            Melakukan peretasan, manipulasi data, atau penyalahgunaan fitur
            website.
          </li>
          <li>Menyebarkan virus, malware, atau program berbahaya lainnya.</li>
          <li>
            Menggunakan website untuk kepentingan komersial tanpa persetujuan
            Universitas La Tansa Mashiro.
          </li>
        </ul>
      </div>

      <!-- 5 -->
      <div class="policy-card">
        <h2><span class="policy-num">5</span>Informasi dan Konten</h2>
        <p>
          Seluruh informasi, logo, desain, dokumen, dan konten yang terdapat
          pada website merupakan milik Universitas La Tansa Mashiro atau
          digunakan secara sah.
        </p>
        <p>
          Pengguna tidak diperkenankan menyalin, menggandakan,
          mempublikasikan, atau mendistribusikan konten tanpa izin tertulis
          dari pihak universitas.
        </p>
      </div>

      <!-- 6 -->
      <div class="policy-card">
        <h2><span class="policy-num">6</span>Jadwal dan Perubahan Kegiatan</h2>
        <p>
          Panitia PKKMB-KT berhak melakukan perubahan terhadap jadwal,
          lokasi, ketentuan kegiatan, maupun informasi lainnya apabila
          diperlukan.
        </p>
        <p>
          Perubahan akan diumumkan melalui website resmi atau media
          komunikasi yang ditetapkan oleh panitia.
        </p>
      </div>

      <!-- 7 -->
      <div class="policy-card">
        <h2><span class="policy-num">7</span>Tanggung Jawab</h2>
        <p>
          Universitas La Tansa Mashiro berupaya menyediakan layanan website
          yang akurat dan dapat diakses dengan baik. Namun, kami tidak
          menjamin bahwa website akan selalu bebas dari gangguan teknis,
          kesalahan sistem, atau akses yang terputus.
        </p>
        <p>
          Pengguna memahami bahwa penggunaan website dilakukan atas risiko
          masing-masing.
        </p>
      </div>

      <!-- 8 -->
      <div class="policy-card">
        <h2><span class="policy-num">8</span>Perlindungan Data Pribadi</h2>
        <p>
          Pengelolaan data pribadi pengguna mengacu pada
          <a href="{{ route('landing.kebijakan-privasi') }}" class="policy-link"
            >Kebijakan Privasi PKKMB-KT Universitas La Tansa Mashiro</a
          >
          yang menjadi bagian tidak terpisahkan dari syarat dan ketentuan
          ini.
        </p>
      </div>

      <!-- 9 -->
      <div class="policy-card warn">
        <h2>
          <span class="policy-num">9</span>Penangguhan atau Penghapusan Akses
        </h2>
        <p>
          Panitia atau pihak universitas berhak menangguhkan, membatasi, atau
          menghapus akses pengguna apabila ditemukan pelanggaran terhadap
          syarat dan ketentuan yang berlaku.
        </p>
      </div>

      <!-- 10 -->
      <div class="policy-card">
        <h2><span class="policy-num">10</span>Hukum yang Berlaku</h2>
        <p>
          Syarat dan Ketentuan ini diatur dan ditafsirkan berdasarkan hukum
          yang berlaku di Republik Indonesia.
        </p>
      </div>

      <!-- 11 — Kontak, disorot beda -->
      <div class="policy-contact">
        <h2><span class="policy-num">11</span>Kontak Resmi</h2>
        <p style="margin: 0 0 14px; color: #cfd4ee; font-size: 13.5px">
          Apabila terdapat pertanyaan mengenai Syarat dan Ketentuan ini,
          silakan menghubungi:
        </p>

        <div class="policy-contact-row">
          <i class="fa-solid fa-building-columns"></i>
          <span>PKKMB-KT Universitas La Tansa Mashiro</span>
        </div>
        <div class="policy-contact-row">
          <i class="fa-solid fa-location-dot"></i>
          <span
            >Jl. Soekarno-Hatta, Kec. Rangkasbitung, Kab. Lebak,
            Banten 42317</span
          >
        </div>
        <div class="policy-contact-row">
          <i class="fa-solid fa-envelope"></i>
          <span
            >Email:
            <a href="mailto:pkkmb@latansamashiro.ac.id"
              >pmb.latansamashiro@gmail.com</a
            ></span
          >
        </div>

        <p class="policy-contact-foot">
          Dengan menggunakan website PKKMB-KT Universitas La Tansa Mashiro,
          pengguna menyatakan telah menyetujui seluruh Syarat dan Ketentuan
          yang tercantum di atas.
        </p>
      </div>
    </div>

    <!-- ============ FOOTER ============ -->
    <footer class="footer">
      <p>© 2026 PKKMB-KT UNILAM. Semua hak dilindungi.</p>
      <div class="footer-links">
        <a href="{{ route('landing.kebijakan-privasi') }}">Kebijakan Privasi</a>
        <a href="{{ route('landing.syarat-ketentuan') }}" class="active">Syarat &amp; Ketentuan</a>
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
