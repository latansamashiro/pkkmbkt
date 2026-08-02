<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <title>Monitoring Pengumpulan Tugas | PKKMB-KT UNILAM 2026</title>
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

      .content-wrap { max-width: 1100px; margin: 0 auto; padding: 28px clamp(16px,5vw,48px); padding-bottom: calc(var(--bottomnav-h) + 28px); width: 100%; flex: 1; }
      @media (min-width: 768px) { .content-wrap { padding-bottom: 32px; } }
      .section-head { display: flex; align-items: center; gap: 10px; margin-bottom: 14px; }
      .section-head-bar { width: 4px; height: 20px; border-radius: 99px; background: linear-gradient(to bottom, var(--teal-500), var(--navy-700)); }
      .section-head h2 { font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0; }

      .kelompok-label { display: inline-flex; align-items: center; gap: 8px; background: var(--surface); border: 1.5px solid var(--border); border-radius: 99px; padding: 9px 18px 9px 8px; margin-bottom: 18px; box-shadow: var(--shadow-card); }
      .kelompok-label .ico { width: 30px; height: 30px; border-radius: 50%; background: var(--navy-900); color: #fff; display: flex; align-items: center; justify-content: center; }
      .kelompok-label .ico svg { width: 14px; height: 14px; }
      .kelompok-label strong { font-size: 13.5px; font-weight: 800; color: var(--navy-900); }

      .search-wrap { position: relative; margin-bottom: 18px; }
      .search-wrap svg { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); width: 15px; height: 15px; color: var(--ink-400); }
      .search-wrap input { width: 100%; background: var(--surface); border: 1.5px solid var(--border); border-radius: 99px; padding: 12px 16px 12px 40px; font-family: var(--font-sans); font-size: 13.5px; font-weight: 500; box-shadow: var(--shadow-card); }
      .search-wrap input:focus { outline: none; border-color: var(--teal-500); box-shadow: 0 0 0 3px rgba(22,160,161,.12); }

      .card { background: var(--surface); border-radius: var(--radius-lg); border: 1px solid var(--border); box-shadow: var(--shadow-card); overflow: hidden; }
      .card-head { padding: 14px 20px; background: var(--bg); border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; gap: 10px; flex-wrap: wrap; }
      .card-head h3 { font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: .03em; color: var(--navy-900); margin: 0; }
      .badge-count { font-size: 10.5px; font-weight: 700; color: var(--ink-600); background: var(--surface); border: 1px solid var(--border); padding: 3px 10px; border-radius: 99px; }

      /* ►► TABEL — bisa scroll horizontal (kalau tugasnya banyak kolom)
         SEKALIGUS scroll vertikal (kalau mahasiswanya banyak baris). */
      .tugas-table-scroll { max-height: 560px; overflow: auto; }
      .tugas-table-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
      .tugas-table-scroll::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }

      .tugas-table { width: 100%; border-collapse: collapse; min-width: 560px; }
      .tugas-table thead th {
        position: sticky; top: 0; z-index: 2;
        background: var(--bg); border-bottom: 1.5px solid var(--border);
        font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: .03em;
        color: var(--navy-900); padding: 12px 14px; text-align: left; white-space: nowrap;
      }
      .tugas-table thead th.col-no { width: 44px; text-align: center; }
      .tugas-table thead th.col-tugas { text-align: center; min-width: 150px; }
      .tugas-table tbody td { padding: 12px 14px; border-top: 1px solid var(--border); vertical-align: middle; }
      .tugas-table tbody tr:hover { background: var(--bg); }
      .tugas-table td.col-no { text-align: center; font-weight: 700; color: var(--ink-400); font-size: 12.5px; }
      .col-nama { min-width: 200px; }
      .col-nama .mhs-info { display: flex; align-items: center; gap: 10px; }
      .mhs-avatar { width: 32px; height: 32px; border-radius: 50%; background: var(--navy-tint); color: var(--navy-700); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 11.5px; flex-shrink: 0; }
      .mhs-name { font-size: 12.5px; font-weight: 700; margin: 0; }
      .mhs-npm { font-size: 10.5px; color: var(--ink-400); margin: 1px 0 0; }

      .td-check { text-align: center; }
      .check-toggle { width: 30px; height: 30px; border-radius: 9px; border: 1.5px solid var(--border); background: var(--surface); display: inline-flex; align-items: center; justify-content: center; cursor: pointer; transition: all .15s; }
      .check-toggle svg { width: 15px; height: 15px; opacity: 0; transition: opacity .12s; color: #fff; }
      .check-toggle.done { background: #22c55e; border-color: #22c55e; }
      .check-toggle.done svg { opacity: 1; }
      .check-toggle:hover:not(.done) { border-color: var(--teal-500); }

      .empty-state { padding: 30px 20px; text-align: center; font-size: 12.5px; color: var(--ink-400); font-weight: 600; }

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
          <div class="hero-eyebrow"><span class="dot"></span> Monitoring</div>
          <h1>Pengumpulan Tugas</h1>
          <p class="hero-info-sub">
            Centang tugas yang sudah dikumpulkan tiap mahasiswa langsung dari
            tabel — geser ke samping kalau tugasnya banyak, geser ke bawah
            kalau mahasiswanya banyak.
          </p>
        </div>
        <div class="hero-stats">
          <div class="hero-stat"><div class="hero-stat-val" id="statSelesai">0</div><div class="hero-stat-lbl">Tugas Selesai</div></div>
          <div class="hero-stat"><div class="hero-stat-val" id="statBelum">0</div><div class="hero-stat-lbl">Belum Selesai</div></div>
        </div>
      </div>
    </section>

    <main class="content-wrap">
      <div class="kelompok-label">
        <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /></svg></span>
        <strong id="kelompokNama">Kelompok 01</strong>
      </div>

      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
        <input type="text" id="searchInput" placeholder="Cari nama atau NPM mahasiswa..." />
      </div>

      <div class="card">
        <div class="card-head">
          <h3>Daftar Mahasiswa &amp; Tugas</h3>
          <span class="badge-count" id="cardCount">0 mahasiswa</span>
        </div>
        <div class="tugas-table-scroll">
          <table class="tugas-table">
            <thead><tr id="tableHeadRow"></tr></thead>
            <tbody id="tableBody"></tbody>
          </table>
        </div>
      </div>
    </main>

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
      // ►► DAFTAR TUGAS — tiap tugas jadi satu KOLOM di tabel. Tambah tugas
      //    baru di sini.
      // ======================================================================
      const DAFTAR_TUGAS = [
        { id: "tugas1", nama: "Resume Materi Akademik" },
        { id: "tugas2", nama: "Tugas Kelompok LKMS" },
        { id: "tugas3", nama: "Essay Nilai Kebangsaan" },
      ];

      // ======================================================================
      // ►► KELOMPOK MENTOR & STATUS TUGAS — satu kelompok saja.
      // ======================================================================
      const KELOMPOK_MENTOR = "Kelompok 01";
      const ANGGOTA_KELOMPOK = [
        { nama: "Alexander Arul Husein", npm: "525241019", tugas: { tugas1: true, tugas2: true, tugas3: false } },
        { nama: "Bunga Citra Lestari", npm: "525241020", tugas: { tugas1: true, tugas2: false, tugas3: false } },
        { nama: "Dimas Prakoso", npm: "525241021", tugas: { tugas1: false, tugas2: false, tugas3: false } },
        { nama: "Eka Putri Ramadhani", npm: "525241022", tugas: { tugas1: true, tugas2: true, tugas3: true } },
        { nama: "Farhan Maulana", npm: "525241023", tugas: { tugas1: true, tugas2: false, tugas3: false } },
        { nama: "Gita Ayu Saputri", npm: "525241024", tugas: { tugas1: false, tugas2: false, tugas3: false } },
        { nama: "Hendra Wijaya", npm: "525241025", tugas: { tugas1: true, tugas2: true, tugas3: false } },
        { nama: "Indah Permata Sari", npm: "525241026", tugas: { tugas1: true, tugas2: true, tugas3: true } },
        { nama: "Joko Anggoro", npm: "525241027", tugas: { tugas1: false, tugas2: false, tugas3: false } },
        { nama: "Kirana Dewi", npm: "525241028", tugas: { tugas1: true, tugas2: false, tugas3: false } },
      ];

      document.getElementById("kelompokNama").innerText = KELOMPOK_MENTOR;

      let kataKunciCari = "";

      function renderTableHead() {
        const row = document.getElementById("tableHeadRow");
        row.innerHTML =
          `<th class="col-no">No</th><th>Nama</th>` +
          DAFTAR_TUGAS.map((t) => `<th class="col-tugas">${t.nama}</th>`).join("");
      }

      function renderTableBody() {
        const tbody = document.getElementById("tableBody");
        const filtered = ANGGOTA_KELOMPOK.filter(
          (m) => m.nama.toLowerCase().includes(kataKunciCari.toLowerCase()) || m.npm.includes(kataKunciCari),
        );
        document.getElementById("cardCount").innerText = `${filtered.length} mahasiswa`;

        if (filtered.length === 0) {
          tbody.innerHTML = `<tr><td colspan="${DAFTAR_TUGAS.length + 2}"><div class="empty-state">Tidak ada mahasiswa yang cocok dengan pencarian.</div></td></tr>`;
        } else {
          tbody.innerHTML = filtered
            .map((m, i) => {
              const inisial = m.nama.split(" ").map((s) => s[0]).slice(0, 2).join("").toUpperCase();
              const kolomTugas = DAFTAR_TUGAS.map((t) => {
                const done = !!m.tugas[t.id];
                return `
                  <td class="td-check">
                    <button class="check-toggle ${done ? "done" : ""}" data-npm="${m.npm}" data-tugas="${t.id}" aria-label="${t.nama}">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M20 6 9 17l-5-5" /></svg>
                    </button>
                  </td>
                `;
              }).join("");

              return `
                <tr>
                  <td class="col-no">${i + 1}</td>
                  <td class="col-nama">
                    <div class="mhs-info">
                      <span class="mhs-avatar">${inisial}</span>
                      <div>
                        <p class="mhs-name">${m.nama}</p>
                        <p class="mhs-npm">NPM ${m.npm}</p>
                      </div>
                    </div>
                  </td>
                  ${kolomTugas}
                </tr>
              `;
            })
            .join("");

          tbody.querySelectorAll(".check-toggle").forEach((btn) => {
            btn.addEventListener("click", () => {
              const mhs = ANGGOTA_KELOMPOK.find((m) => m.npm === btn.dataset.npm);
              mhs.tugas[btn.dataset.tugas] = !mhs.tugas[btn.dataset.tugas];
              renderTableBody();
            });
          });
        }

        renderStatHero(filtered);
      }

      function renderStatHero(filtered) {
        let selesai = 0, belum = 0;
        filtered.forEach((m) => {
          DAFTAR_TUGAS.forEach((t) => { m.tugas[t.id] ? selesai++ : belum++; });
        });
        document.getElementById("statSelesai").innerText = selesai;
        document.getElementById("statBelum").innerText = belum;
      }

      document.getElementById("searchInput").addEventListener("input", (e) => {
        kataKunciCari = e.target.value;
        renderTableBody();
      });

      renderTableHead();
      renderTableBody();

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO — sama seperti halaman lain.
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