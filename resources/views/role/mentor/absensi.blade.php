<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <title>Kelola Presensi | PKKMB-KT UNILAM 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <style>
      :root {
        --navy-900: #152159; --navy-700: #1e3a8f; --navy-600: #2a4bb0;
        --teal-600: #0f8a8c; --teal-500: #16a0a1; --teal-tint: #e2f3f2;
        --lime-500: #a9c73b; --lime-tint: #f2f6e0; --navy-tint: #e6e9f6;
        --bg: #f2f4fa; --surface: #ffffff; --border: #e1e5f1;
        --ink-900: #1b2238; --ink-600: #5b6175; --ink-400: #8d92a6;
        --radius-lg: 28px; --radius-md: 18px; --radius-sm: 13px;
        --shadow-card: 0 2px 14px rgba(21,33,89,.07), 0 1px 2px rgba(21,33,89,.05);
        --shadow-pop: 0 10px 24px rgba(21,33,89,.16);
        --font-display: "Lora", serif; --font-sans: "Plus Jakarta Sans", sans-serif;
        --bottomnav-h: 74px;
      }
      * { box-sizing: border-box; }
      body { font-family: var(--font-sans); color: var(--ink-900); margin: 0; background: var(--bg); -webkit-font-smoothing: antialiased; min-height: 100vh; display: flex; flex-direction: column; }

      .navbar { position: sticky; top: 0; z-index: 50; display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 14px clamp(16px,5vw,48px); background: var(--navy-900); border-bottom: 1px solid rgba(255,255,255,.08); }
      .navbar-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; cursor: default; }
      .navbar-logo { width: 38px; height: 38px; border-radius: 50%; background: #fff; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0; }
      .navbar-logo img { width: 100%; height: 100%; object-fit: contain; }
      .navbar-brand-text strong { display: block; font-family: var(--font-display); font-size: 14.5px; color: #fff; }
      .navbar-brand-text span { font-size: 10.5px; color: #aeb6e0; letter-spacing: .04em; }
      .navbar-links { display: none; gap: 28px; }
      .navbar-links a { color: #c7cce8; font-size: 13.5px; font-weight: 600; transition: color .15s; text-decoration: none; }
      .navbar-links a:hover, .navbar-links a.active { color: #fff; }
      @media (min-width: 768px) { .navbar-links { display: flex; } }

      .hero-info { position: relative; padding: clamp(36px,6vw,56px) clamp(16px,5vw,48px); overflow: hidden; }
      .hero-slideshow { position: absolute; inset: 0; z-index: 0; overflow: hidden; }
      .hero-slide { position: absolute; inset: 0; background-size: cover; background-position: center; opacity: 0; transition: opacity 1.8s ease; }
      .hero-slide.active { opacity: 1; }
      .hero-slideshow::after { content: ""; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(21,33,89,.94) 0%, rgba(15,138,140,.85) 100%); }
      .hero-info-inner { position: relative; z-index: 1; max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-end; gap: 28px; }
      .hero-info-left { flex: 1; min-width: 280px; }
      .hero-eyebrow { display: inline-flex; align-items: center; gap: 7px; background: rgba(169,199,59,.15); border: 1px solid rgba(169,199,59,.35); color: #c8e46a; font-size: 11px; font-weight: 700; padding: 5px 14px; border-radius: 99px; margin-bottom: 16px; letter-spacing: .06em; text-transform: uppercase; }
      .hero-eyebrow .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--lime-500); animation: pulse 2s infinite; }
      @keyframes pulse { 0%,100% { opacity: 1; transform: scale(1); } 50% { opacity: .5; transform: scale(.8); } }
      .hero-info h1 { font-family: var(--font-display); font-size: clamp(24px,4vw,38px); font-weight: 700; color: #fff; margin: 0 0 12px; line-height: 1.2; }
      .hero-info-sub { font-size: 14px; color: rgba(255,255,255,.75); line-height: 1.7; max-width: 480px; margin: 0; }
      .hero-stats { display: flex; gap: 2px; background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.12); border-radius: var(--radius-md); padding: 16px 22px; backdrop-filter: blur(12px); flex-shrink: 0; }
      .hero-stat { text-align: center; padding: 0 16px; border-right: 1px solid rgba(255,255,255,.12); }
      .hero-stat:last-child { border-right: none; }
      .hero-stat-val { font-family: var(--font-display); font-size: 24px; font-weight: 700; color: var(--lime-500); line-height: 1; }
      .hero-stat-lbl { font-size: 10px; color: rgba(255,255,255,.55); font-weight: 600; margin-top: 4px; letter-spacing: .04em; }

      .content-wrap { max-width: 1000px; margin: 0 auto; padding: 28px clamp(16px,5vw,48px); padding-bottom: calc(var(--bottomnav-h) + 28px); width: 100%; flex: 1; }
      @media (min-width: 768px) { .content-wrap { padding-bottom: 32px; } }
      .section-head { display: flex; align-items: center; gap: 10px; margin-bottom: 14px; }
      .section-head-bar { width: 4px; height: 20px; border-radius: 99px; background: linear-gradient(to bottom, var(--teal-500), var(--navy-700)); }
      .section-head h2 { font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0; }

      .kelompok-label { display: inline-flex; align-items: center; gap: 8px; background: var(--surface); border: 1.5px solid var(--border); border-radius: 99px; padding: 9px 18px 9px 8px; margin-bottom: 18px; box-shadow: var(--shadow-card); }
      .kelompok-label .ico { width: 30px; height: 30px; border-radius: 50%; background: var(--navy-900); color: #fff; display: flex; align-items: center; justify-content: center; }
      .kelompok-label .ico svg { width: 14px; height: 14px; }
      .kelompok-label strong { font-size: 13.5px; font-weight: 800; color: var(--navy-900); }

      /* Tab HARI */
      .hari-tabs { display: flex; gap: 8px; overflow-x: auto; padding-bottom: 4px; margin-bottom: 18px; }
      .hari-tab { flex-shrink: 0; background: var(--surface); border: 1.5px solid var(--border); border-radius: var(--radius-md); padding: 10px 16px; text-align: left; cursor: pointer; transition: all .15s; min-width: 128px; }
      .hari-tab .h-label { font-size: 12.5px; font-weight: 800; color: var(--ink-900); }
      .hari-tab .h-tanggal { font-size: 10.5px; color: var(--ink-400); font-weight: 600; margin-top: 2px; }
      .hari-tab:hover { border-color: var(--teal-500); }
      .hari-tab.active { background: var(--navy-900); border-color: var(--navy-900); }
      .hari-tab.active .h-label, .hari-tab.active .h-tanggal { color: #fff; }
      .hari-tab.active .h-tanggal { color: #aeb6e0; }

      /* Statistik Hadir/Izin/Sakit/Alpa */
      .status-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-bottom: 20px; }
      @media (max-width: 480px) { .status-stats { grid-template-columns: repeat(2, 1fr); } }
      .status-stat { background: var(--surface); border-radius: var(--radius-md); border: 1px solid var(--border); border-left: 4px solid var(--accent); padding: 12px 14px; box-shadow: var(--shadow-card); }
      .status-stat .lbl { font-size: 10.5px; color: var(--ink-400); font-weight: 700; }
      .status-stat .val { font-family: var(--font-display); font-size: 22px; font-weight: 700; margin-top: 4px; }

      /* Sesi tabs */
      .sesi-tabs { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 20px; }
      .sesi-tab { background: var(--surface); border: 1.5px solid var(--border); border-radius: var(--radius-md); padding: 12px 10px; text-align: center; cursor: pointer; transition: all .15s; }
      .sesi-tab .sesi-nama { font-size: 12.5px; font-weight: 800; color: var(--ink-900); }
      .sesi-tab .sesi-jam { font-size: 10.5px; color: var(--ink-400); margin-top: 2px; font-weight: 600; }
      .sesi-tab .sesi-status { display: inline-flex; align-items: center; gap: 4px; font-size: 9.5px; font-weight: 800; text-transform: uppercase; letter-spacing: .03em; padding: 3px 9px; border-radius: 99px; margin-top: 7px; }
      .sesi-tab.buka { border-color: var(--teal-500); }
      .sesi-tab.buka .sesi-status { background: #dcfce7; color: #15803d; }
      .sesi-tab.terkunci { opacity: .6; }
      .sesi-tab.terkunci .sesi-status { background: var(--bg); color: var(--ink-400); }
      .sesi-tab.selesai .sesi-status { background: var(--navy-tint); color: var(--navy-700); }
      .sesi-tab.active-selected { box-shadow: 0 0 0 3px rgba(22,160,161,.18); }

      .lock-banner { display: flex; align-items: center; gap: 10px; background: #fff7ed; border: 1px solid #fed7aa; border-radius: var(--radius-md); padding: 12px 16px; font-size: 12.5px; color: #9a3412; font-weight: 600; margin-bottom: 16px; }
      .lock-banner svg { width: 17px; height: 17px; flex-shrink: 0; }

      .search-wrap { position: relative; margin-bottom: 16px; }
      .search-wrap svg { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); width: 15px; height: 15px; color: var(--ink-400); }
      .search-wrap input { width: 100%; background: var(--surface); border: 1.5px solid var(--border); border-radius: 99px; padding: 11px 16px 11px 40px; font-family: var(--font-sans); font-size: 13px; font-weight: 500; }
      .search-wrap input:focus { outline: none; border-color: var(--teal-500); box-shadow: 0 0 0 3px rgba(22,160,161,.12); }

      .card { background: var(--surface); border-radius: var(--radius-lg); border: 1px solid var(--border); box-shadow: var(--shadow-card); overflow: hidden; margin-bottom: 20px; }
      .card-head { padding: 14px 20px; background: var(--bg); border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; gap: 10px; flex-wrap: wrap; }
      .card-head h3 { font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: .03em; color: var(--navy-900); margin: 0; }
      .badge-count { font-size: 10.5px; font-weight: 700; color: var(--ink-600); background: var(--surface); border: 1px solid var(--border); padding: 3px 10px; border-radius: 99px; }

      /* ►► LIST BISA DI-SCROLL */
      .mhs-list-scroll { max-height: 460px; overflow-y: auto; }
      .mhs-list-scroll::-webkit-scrollbar { width: 6px; }
      .mhs-list-scroll::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }

      .mhs-row { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 13px 20px; border-top: 1px solid var(--border); flex-wrap: wrap; }
      .mhs-row:first-child { border-top: none; }
      .mhs-info { display: flex; align-items: center; gap: 11px; min-width: 0; }
      .mhs-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--navy-tint); color: var(--navy-700); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 12.5px; flex-shrink: 0; }
      .mhs-name { font-size: 13px; font-weight: 700; margin: 0; }
      .mhs-npm { font-size: 11px; color: var(--ink-400); margin: 1px 0 0; }

      .status-btns { display: flex; gap: 6px; flex-wrap: wrap; flex-shrink: 0; }
      .status-btn { padding: 7px 13px; border-radius: 99px; border: 1.5px solid var(--border); background: var(--surface); font-size: 11px; font-weight: 800; cursor: pointer; color: var(--ink-400); transition: all .12s; white-space: nowrap; }
      .status-btn:hover:not(:disabled) { transform: translateY(-1px); }
      .status-btn:disabled { cursor: not-allowed; opacity: .5; }
      .status-btn[data-k="H"].on { background: #dcfce7; border-color: #22c55e; color: #15803d; }
      .status-btn[data-k="I"].on { background: #dbeafe; border-color: #3b82f6; color: #1d4ed8; }
      .status-btn[data-k="S"].on { background: #fef3c7; border-color: #f59e0b; color: #b45309; }
      .status-btn[data-k="A"].on { background: #fee2e2; border-color: #ef4444; color: #b91c1c; }

      .empty-state { padding: 30px 20px; text-align: center; font-size: 12.5px; color: var(--ink-400); font-weight: 600; }

      .save-bar { position: sticky; bottom: calc(var(--bottomnav-h) + 12px); display: flex; justify-content: flex-end; gap: 10px; margin-top: -4px; }
      @media (min-width: 768px) { .save-bar { bottom: 16px; } }
      .btn-save { display: inline-flex; align-items: center; gap: 8px; background: var(--navy-900); color: #fff; font-weight: 800; font-size: 13px; padding: 13px 26px; border-radius: 99px; border: none; cursor: pointer; box-shadow: var(--shadow-pop); transition: filter .15s, transform .15s; }
      .btn-save:hover { filter: brightness(1.12); transform: translateY(-2px); }
      .btn-save:disabled { opacity: .45; cursor: not-allowed; transform: none; filter: none; }
      .btn-save svg { width: 16px; height: 16px; }
      .save-toast { position: fixed; bottom: calc(var(--bottomnav-h) + 16px); left: 50%; transform: translateX(-50%) translateY(20px); background: var(--navy-900); color: #fff; font-size: 12.5px; font-weight: 700; padding: 12px 22px; border-radius: 99px; box-shadow: var(--shadow-pop); opacity: 0; pointer-events: none; transition: opacity .25s, transform .25s; z-index: 60; display: flex; align-items: center; gap: 8px; }
      .save-toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }
      .save-toast svg { width: 15px; height: 15px; color: var(--lime-500); }

      .footer { background: #0d1735; padding: 24px clamp(16px,5vw,48px); display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 14px; }
      .footer p { font-size: 13px; color: #4a6a9f; margin: 0; }
      .footer-links { display: flex; gap: 20px; }
      .footer-links a { font-size: 13px; color: #4a6a9f; text-decoration: none; }
      .footer-links a:hover { color: #aeb6e0; }
      @media (max-width: 767px) { .footer { padding-bottom: calc(var(--bottomnav-h) + 16px); } }

      .bottom-nav { position: fixed; bottom: 0; left: 0; right: 0; height: var(--bottomnav-h); background: var(--surface); border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-around; padding: 0 6px; padding-bottom: env(safe-area-inset-bottom); z-index: 30; }
      .bottom-nav a { display: flex; flex-direction: column; align-items: center; gap: 4px; color: var(--ink-400); font-size: 10px; font-weight: 700; flex: 1; padding: 6px 0; text-decoration: none; }
      .bottom-nav a .ic { width: 22px; height: 22px; }
      .bottom-nav a.active { color: var(--navy-900); }
      .bottom-nav a.home { flex: 0 0 auto; color: #fff; margin-top: -30px; background: var(--navy-900); width: 54px; height: 54px; border-radius: 50%; box-shadow: var(--shadow-pop); justify-content: center; }
      .bottom-nav a.home .ic { width: 24px; height: 24px; }
      .bottom-nav a.home span { display: none; }
      @media (min-width: 768px) { .bottom-nav { display: none; } }
    </style>
  </head>
  <body>
    <header class="navbar">
      <div class="navbar-brand" aria-label="PKKMB-KT UNILAM">
        <div class="navbar-logo"><img src="{{ asset('gambar/unilam.png') }}" alt="Logo UNILAM" /></div>
        <div class="navbar-brand-text"><strong>PKKMB-KT</strong><span>UNILAM 2026</span></div>
      </div>
      <nav class="navbar-links">
        <a href="{{ route('role.mentor.modul') }}">Modul</a>
        <a href="{{ route('role.mentor.leaderboard') }}">Leaderboard</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('role.mentor.info') }}">Info</a>
        <a href="{{ route('role.mentor.profil') }}">Profil</a>
      </nav>
    </header>

    <section class="hero-info">
      <div class="hero-slideshow" id="heroSlideshow"></div>
      <div class="hero-info-inner">
        <div class="hero-info-left">
          <div class="hero-eyebrow"><span class="dot"></span> Kelola Presensi</div>
          <h1>Presensi Kelompok</h1>
          <p class="hero-info-sub">
            Catat kehadiran anggota kelompokmu per hari &amp; per sesi. Tiap
            sesi otomatis terbuka dan terkunci sesuai tanggal serta jam yang
            ditentukan.
          </p>
        </div>
        <div class="hero-stats">
          <div class="hero-stat"><div class="hero-stat-val" id="statHeroHadir">0</div><div class="hero-stat-lbl">Hadir</div></div>
          <div class="hero-stat"><div class="hero-stat-val" id="statHeroBelum">0</div><div class="hero-stat-lbl">Belum Diisi</div></div>
          <div class="hero-stat"><div class="hero-stat-val" id="statHeroTotal">0</div><div class="hero-stat-lbl">Anggota</div></div>
        </div>
      </div>
    </section>

    <main class="content-wrap">
      <div class="kelompok-label">
        <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /></svg></span>
        <strong id="kelompokNama">Kelompok 01</strong>
      </div>

      <div class="section-head"><div class="section-head-bar"></div><h2>Pilih Hari</h2></div>
      <div class="hari-tabs" id="hariTabs"></div>

      <div class="section-head"><div class="section-head-bar"></div><h2>Rekap Sesi Ini</h2></div>
      <div class="status-stats" id="statusStats"></div>

      <div class="section-head"><div class="section-head-bar"></div><h2>Pilih Sesi</h2></div>
      <div class="sesi-tabs" id="sesiTabs"></div>
      <div id="lockBannerWrap"></div>

      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
        <input type="text" id="searchInput" placeholder="Cari nama atau NPM mahasiswa..." />
      </div>

      <div class="card">
        <div class="card-head">
          <h3 id="cardTitle">Daftar Anggota</h3>
          <span class="badge-count" id="cardCount">0 mahasiswa</span>
        </div>
        <div class="mhs-list-scroll"><div id="mhsList"></div></div>
      </div>

      <div class="save-bar">
        <button class="btn-save" id="btnSimpan" style="flex:1">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z" /><path d="M17 21v-8H7v8M7 3v5h8" /></svg>
          Simpan Presensi
        </button>
        <button class="btn-save" id="btnSubmit" style="flex:1; background:#152159;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5" /></svg>
          Submit &amp; Kunci
        </button>
      </div>
    </main>

    <div class="save-toast" id="saveToast">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5" /></svg>
      <span class="toast-text">Presensi tersimpan</span>
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
      <a href="{{ route('role.mentor.modul') }}">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" /><path d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z" /></svg>
        <span>Modul</span>
      </a>
      <a href="{{ route('role.mentor.leaderboard') }}">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z" /><path d="M5 21v-5M12 21v-7M19 21v-4" /></svg>
        <span>Leaderboard</span>
      </a>
      <a href="{{ route('dashboard') }}" class="home" aria-label="Beranda">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 11.5 12 4l8 7.5" /><path d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10" /></svg>
        <span>Beranda</span>
      </a>
      <a href="{{ route('role.mentor.info') }}">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M9 17H4l1.4-1.4A2 2 0 0 0 6 14.2V11a6 6 0 1 1 12 0v3.2c0 .5.2 1 .6 1.4L20 17h-5" /><path d="M9 17a3 3 0 0 0 6 0" /></svg>
        <span>Info</span>
      </a>
      <a href="{{ route('role.mentor.profil') }}">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="3.4" /><path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" /></svg>
        <span>Profil</span>
      </a>
    </nav>

    <script>
      // ======================================================================
      // ►► KELOMPOK MENTOR — satu kelompok saja. Ganti nama & anggotanya
      //    sesuai penugasan mentor.
      // ======================================================================
      const KELOMPOK_MENTOR = @json($group->name ?? 'Belum ada kelompok');
      const ANGGOTA_KELOMPOK = @json($students->map(fn($s) => ['nama' => $s->name, 'npm' => $s->npm ?? '-', 'id' => $s->id])->values());

      // ======================================================================
      // ►► JADWAL HARI & SESI — diambil dari sesi yang dibuat Panitia
      //    (Kelola Jadwal Absensi), dikelompokkan otomatis per hari.
      // ======================================================================
      @php
          $jadwalHariJs = $templates->groupBy('day_name')->map(function ($sesiHari, $dayName) use ($attendanceMap) {
              return [
                  'key' => \Illuminate\Support\Str::slug($dayName) ?: 'hari',
                  'label' => $dayName,
                  'tanggal' => optional($sesiHari->first())->attendance_date,
                  'sesi' => $sesiHari->map(function ($t) use ($attendanceMap) {
                      return [
                          'key' => (string) $t->id,
                          'label' => $t->session_name,
                          'mulai' => substr($t->time_begin, 0, 5),
                          'selesai' => substr($t->time_end, 0, 5),
                          'terkunci' => ($attendanceMap[$t->id]['status'] ?? null) === 'submitted',
                      ];
                  })->values(),
              ];
          })->values();

          $tandaTersimpanJs = collect($attendanceMap)->mapWithKeys(function ($v, $templateId) {
              return [(string) $templateId => $v['marks']];
          });
      @endphp
      const JADWAL_HARI = @json($jadwalHariJs);

      // tanda H/I/S/A yang sudah tersimpan sebelumnya: { [templateId]: { [studentId]: 'H'|'I'|'S'|'A' } }
      const TANDA_TERSIMPAN = @json($tandaTersimpanJs);

      const CSRF_TOKEN = @json(csrf_token());

      const LABEL_STATUS = { H: "Hadir", I: "Izin", S: "Sakit", A: "Alpa" };
      const HURUF_STATUS = ["H", "I", "S", "A"];

      document.getElementById("kelompokNama").innerText = KELOMPOK_MENTOR;

      let hariAktif = JADWAL_HARI.length ? JADWAL_HARI[0].key : null;
      let sesiAktif = null;
      // dataPresensi sekarang berbasis ID mahasiswa (bukan nama), per sesi (template id):
      // { [templateId]: { [studentId]: 'H'|'I'|'S'|'A' } }
      let dataPresensi = {};
      let kataKunciCari = "";

      function formatTanggalIndo(iso) {
        const bulan = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"];
        const [y, m, d] = iso.split("-").map(Number);
        return `${d} ${bulan[m - 1]} ${y}`;
      }

      function getHari(key) { return JADWAL_HARI.find((h) => h.key === key); }
      function getSesi(hari, sesiKey) { return hari.sesi.find((s) => s.key === sesiKey); }

      function waktuGabung(tanggal, jam) { return new Date(`${tanggal}T${jam}:00`); }

      function statusSesi(hari, sesi) {
        if (sesi.terkunci) return "disubmit";
        const now = new Date();
        const mulai = waktuGabung(hari.tanggal, sesi.mulai);
        const selesai = waktuGabung(hari.tanggal, sesi.selesai);
        if (now < mulai) return "terkunci";
        if (now > selesai) return "selesai";
        return "buka";
      }

      function renderHariTabs() {
        const wrap = document.getElementById("hariTabs");
        wrap.innerHTML = JADWAL_HARI.map(
          (h) => `
            <button class="hari-tab ${h.key === hariAktif ? "active" : ""}" data-key="${h.key}">
              <div class="h-label">${h.label}</div>
              <div class="h-tanggal">${formatTanggalIndo(h.tanggal)}</div>
            </button>
          `,
        ).join("");
        wrap.querySelectorAll(".hari-tab").forEach((btn) => {
          btn.addEventListener("click", async () => {
            hariAktif = btn.dataset.key;
            const hari = getHari(hariAktif);
            const sesiBuka = hari.sesi.find((s) => statusSesi(hari, s) === "buka");
            sesiAktif = sesiBuka ? sesiBuka.key : hari.sesi[0].key;
            await muatDataPresensi();
            renderSemua();
          });
        });
      }

      function renderSesiTabs() {
        const hari = getHari(hariAktif);
        const wrap = document.getElementById("sesiTabs");
        if (!hari) { wrap.innerHTML = ""; return; }
        wrap.innerHTML = hari.sesi.map((sesi) => {
          const st = statusSesi(hari, sesi);
          const isSelected = sesi.key === sesiAktif;
          let statusHtml = "";
          if (st === "buka") statusHtml = `<span class="sesi-status">● Sedang Berlangsung</span>`;
          else if (st === "terkunci") statusHtml = `<span class="sesi-status">🔒 Belum Dibuka</span>`;
          else if (st === "disubmit") statusHtml = `<span class="sesi-status">📦 Sudah Disubmit</span>`;
          else statusHtml = `<span class="sesi-status">✓ Ditutup</span>`;
          return `
            <div class="sesi-tab ${st} ${isSelected ? "active-selected" : ""}" data-key="${sesi.key}">
              <div class="sesi-nama">${sesi.label}</div>
              <div class="sesi-jam">${sesi.mulai} - ${sesi.selesai}</div>
              ${statusHtml}
            </div>
          `;
        }).join("");
        wrap.querySelectorAll(".sesi-tab").forEach((el) => {
          el.addEventListener("click", () => {
            sesiAktif = el.dataset.key;
            renderSemua();
          });
        });
      }

      function renderLockBanner() {
        const wrap = document.getElementById("lockBannerWrap");
        const hari = getHari(hariAktif);
        if (!hari) { wrap.innerHTML = ""; return; }
        const sesi = getSesi(hari, sesiAktif);
        if (!sesi) { wrap.innerHTML = ""; return; }
        const st = statusSesi(hari, sesi);
        if (st === "buka") { wrap.innerHTML = ""; return; }
        const pesan =
          st === "terkunci"
            ? `${sesi.label} ${hari.label} (${formatTanggalIndo(hari.tanggal)}) belum dibuka. Presensi bisa diisi mulai pukul ${sesi.mulai} WIB.`
            : st === "disubmit"
            ? `${sesi.label} ${hari.label} (${formatTanggalIndo(hari.tanggal)}) sudah DISUBMIT dan menjadi arsip. Data tidak bisa diubah lagi.`
            : `${sesi.label} ${hari.label} (${formatTanggalIndo(hari.tanggal)}) sudah ditutup. Kamu masih bisa melihat rekapnya, tapi tidak bisa mengubah presensi.`;
        wrap.innerHTML = `
          <div class="lock-banner">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="10" width="16" height="10" rx="2" /><path d="M8 10V7a4 4 0 0 1 8 0v3" /></svg>
            <span>${pesan}</span>
          </div>
        `;
      }

      function tentukanHariSesiAwal() {
        if (!JADWAL_HARI.length) { hariAktif = null; sesiAktif = null; return; }
        for (const h of JADWAL_HARI) {
          const sesiBuka = h.sesi.find((s) => statusSesi(h, s) === "buka");
          if (sesiBuka) { hariAktif = h.key; sesiAktif = sesiBuka.key; return; }
        }
        for (const h of JADWAL_HARI) {
          const sesiTerkunci = h.sesi.find((s) => statusSesi(h, s) === "terkunci");
          if (sesiTerkunci) { hariAktif = h.key; sesiAktif = sesiTerkunci.key; return; }
        }
        hariAktif = JADWAL_HARI[0].key;
        sesiAktif = JADWAL_HARI[0].sesi.length ? JADWAL_HARI[0].sesi[0].key : null;
      }

      // Data presensi yang sudah tersimpan dikirim langsung dari server
      // (TANDA_TERSIMPAN), jadi tidak perlu fetch async lagi seperti sebelumnya.
      function muatDataPresensi() {
        dataPresensi = JSON.parse(JSON.stringify(TANDA_TERSIMPAN || {}));
      }

      // sesiKey di sini = ID template presensi (angka, dikirim sebagai string dari server)
      function getStatusAnggota(studentId, sesiKey) {
        return dataPresensi[sesiKey] ? (dataPresensi[sesiKey][studentId] || null) : null;
      }
      function setStatusAnggota(studentId, sesiKey, kode) {
        if (!dataPresensi[sesiKey]) dataPresensi[sesiKey] = {};
        dataPresensi[sesiKey][studentId] = kode;
      }

      function renderStatusStats() {
        const wrap = document.getElementById("statusStats");
        const hitung = { H: 0, I: 0, S: 0, A: 0 };
        ANGGOTA_KELOMPOK.forEach((m) => {
          const s = getStatusAnggota(m.id, sesiAktif);
          if (s) hitung[s]++;
        });
        const warna = { H: "#22c55e", I: "#3b82f6", S: "#f59e0b", A: "#ef4444" };
        wrap.innerHTML = HURUF_STATUS.map(
          (k) => `
            <div class="status-stat" style="--accent:${warna[k]}">
              <div class="lbl">${LABEL_STATUS[k]}</div>
              <div class="val" style="color:${warna[k]}">${hitung[k]}</div>
            </div>
          `,
        ).join("");
      }

      function renderMhsList() {
        if (!hariAktif || !sesiAktif) {
          document.getElementById("cardTitle").innerText = "Belum ada sesi absensi";
          document.getElementById("cardCount").innerText = "";
          document.getElementById("mhsList").innerHTML = `<div class="empty-state">Panitia belum membuat jadwal sesi absensi.</div>`;
          document.getElementById("btnSimpan").disabled = true;
          document.getElementById("btnSubmit").disabled = true;
          return;
        }
        const hari = getHari(hariAktif);
        const sesi = getSesi(hari, sesiAktif);
        const bisaEdit = statusSesi(hari, sesi) === "buka";
        document.getElementById("btnSimpan").disabled = !bisaEdit;
        document.getElementById("btnSubmit").disabled = !bisaEdit || sesi.terkunci;
        document.getElementById("cardTitle").innerText = `Daftar Anggota — ${sesi.label}, ${hari.label}`;

        const listEl = document.getElementById("mhsList");
        const anggota = ANGGOTA_KELOMPOK.filter(
          (m) => m.nama.toLowerCase().includes(kataKunciCari.toLowerCase()) || m.npm.includes(kataKunciCari),
        );
        document.getElementById("cardCount").innerText = `${anggota.length} mahasiswa`;

        if (anggota.length === 0) {
          listEl.innerHTML = `<div class="empty-state">${ANGGOTA_KELOMPOK.length === 0 ? "Belum ada anggota di kelompokmu." : "Tidak ada anggota yang cocok dengan pencarian."}</div>`;
        } else {
          listEl.innerHTML = anggota
            .map((m) => {
              const inisial = m.nama.split(" ").map((s) => s[0]).slice(0, 2).join("").toUpperCase();
              const statusNow = getStatusAnggota(m.id, sesiAktif);
              const tombol = HURUF_STATUS.map(
                (k) => `<button class="status-btn ${statusNow === k ? "on" : ""}" data-k="${k}" data-id="${m.id}" ${bisaEdit ? "" : "disabled"}>${LABEL_STATUS[k]}</button>`,
              ).join("");
              return `
                <div class="mhs-row">
                  <div class="mhs-info">
                    <span class="mhs-avatar">${inisial}</span>
                    <div>
                      <p class="mhs-name">${m.nama}</p>
                      <p class="mhs-npm">NPM ${m.npm}</p>
                    </div>
                  </div>
                  <div class="status-btns">${tombol}</div>
                </div>
              `;
            })
            .join("");

          listEl.querySelectorAll(".status-btn").forEach((btn) => {
            btn.addEventListener("click", () => {
              setStatusAnggota(btn.dataset.id, sesiAktif, btn.dataset.k);
              renderMhsList();
              renderStatusStats();
              renderStatHero();
            });
          });
        }
      }

      function renderStatHero() {
        let hadir = 0, belum = 0;
        ANGGOTA_KELOMPOK.forEach((m) => {
          const s = getStatusAnggota(m.id, sesiAktif);
          if (s === "H") hadir++;
          if (!s) belum++;
        });
        document.getElementById("statHeroHadir").innerText = hadir;
        document.getElementById("statHeroBelum").innerText = belum;
        document.getElementById("statHeroTotal").innerText = ANGGOTA_KELOMPOK.length;
      }

      // ======================================================================
      // ►► SIMPAN (draft) & SUBMIT (kunci permanen) — beneran ke server.
      // ======================================================================
      async function simpanPresensi() {
        if (!sesiAktif) return;
        const marks = dataPresensi[sesiAktif] || {};
        if (Object.keys(marks).length === 0) {
          alert("Isi dulu minimal satu tanda kehadiran sebelum menyimpan.");
          return;
        }
        try {
          const res = await fetch(`{{ url('mentor/absensi') }}/${sesiAktif}/save`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": CSRF_TOKEN,
              "Accept": "application/json",
            },
            body: JSON.stringify({ marks }),
          });
          const result = await res.json();
          if (!res.ok) throw new Error(result.message || "Gagal menyimpan.");
          tampilkanToast(result.message || "Presensi tersimpan.");
        } catch (e) {
          alert(e.message || "Gagal menyimpan presensi. Coba lagi.");
        }
      }

      async function submitPresensi() {
        if (!sesiAktif) return;
        const hari = getHari(hariAktif);
        const sesi = getSesi(hari, sesiAktif);
        if (!confirm(`Yakin submit presensi "${sesi.label}, ${hari.label}"? Setelah disubmit, data TIDAK BISA diubah lagi oleh siapa pun.`)) return;

        try {
          const res = await fetch(`{{ url('mentor/absensi') }}/${sesiAktif}/submit`, {
            method: "POST",
            headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
          });
          const result = await res.json();
          if (!res.ok) throw new Error(result.message || "Gagal submit.");
          sesi.terkunci = true;
          tampilkanToast(result.message || "Presensi disubmit.");
          renderSemua();
        } catch (e) {
          alert(e.message || "Gagal submit presensi. Coba lagi.");
        }
      }

      function tampilkanToast(pesan) {
        const toast = document.getElementById("saveToast");
        if (pesan) toast.querySelector(".toast-text").innerText = pesan;
        toast.classList.add("show");
        setTimeout(() => toast.classList.remove("show"), 2200);
      }

      document.getElementById("searchInput").addEventListener("input", (e) => {
        kataKunciCari = e.target.value;
        renderMhsList();
      });
      document.getElementById("btnSimpan").addEventListener("click", simpanPresensi);
      document.getElementById("btnSubmit").addEventListener("click", submitPresensi);

      function renderSemua() {
        renderHariTabs();
        renderSesiTabs();
        renderLockBanner();
        renderStatusStats();
        renderMhsList();
        renderStatHero();
      }

      function init() {
        tentukanHariSesiAwal();
        muatDataPresensi();
        renderSemua();
        setInterval(() => { renderSesiTabs(); renderLockBanner(); renderMhsList(); }, 30000);
      }
      init();

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO — sama seperti halaman lain. Ganti/tambah
      //    gambar di array ini.
      // ======================================================================
      const heroSlideImages = ["/Gambar/gedungutama.jpeg", "/Gambar/rektor.jpeg", "/Gambar/gedung.jpeg"];
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