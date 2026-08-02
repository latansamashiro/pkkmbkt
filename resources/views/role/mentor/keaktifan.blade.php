<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <title>Input Keaktifan &amp; Pelanggaran | PKKMB-KT UNILAM 2026</title>
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
      .hero-info-inner { position: relative; z-index: 1; max-width: 1200px; margin: 0 auto; }
      .hero-eyebrow { display: inline-flex; align-items: center; gap: 7px; background: rgba(169,199,59,.15); border: 1px solid rgba(169,199,59,.35); color: #c8e46a; font-size: 11px; font-weight: 700; padding: 5px 14px; border-radius: 99px; margin-bottom: 16px; letter-spacing: .06em; text-transform: uppercase; }
      .hero-eyebrow .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--lime-500); animation: pulse 2s infinite; }
      @keyframes pulse { 0%,100% { opacity: 1; transform: scale(1); } 50% { opacity: .5; transform: scale(.8); } }
      .hero-info h1 { font-family: var(--font-display); font-size: clamp(24px,4vw,38px); font-weight: 700; color: #fff; margin: 0 0 12px; line-height: 1.2; }
      .hero-info-sub { font-size: 14px; color: rgba(255,255,255,.75); line-height: 1.7; max-width: 560px; margin: 0; }

      .content-wrap { max-width: 1000px; margin: 0 auto; padding: 28px clamp(16px,5vw,48px); padding-bottom: calc(var(--bottomnav-h) + 28px); width: 100%; flex: 1; }
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

      /* ►► LIST BISA DI-SCROLL supaya kalau anggota banyak halaman tidak
         kepanjangan. */
      .mhs-list-scroll { max-height: 620px; overflow-y: auto; padding-right: 2px; }
      .mhs-list-scroll::-webkit-scrollbar { width: 6px; }
      .mhs-list-scroll::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }

      .mhs-grid { display: grid; grid-template-columns: 1fr; gap: 12px; }
      @media (min-width: 640px) { .mhs-grid { grid-template-columns: 1fr 1fr; } }

      .mhs-card { background: var(--surface); border-radius: var(--radius-md); border: 1px solid var(--border); box-shadow: var(--shadow-card); padding: 16px; }
      .mhs-card-head { display: flex; align-items: center; gap: 11px; margin-bottom: 12px; }
      .mhs-avatar { width: 38px; height: 38px; border-radius: 50%; background: var(--navy-tint); color: var(--navy-700); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 13px; flex-shrink: 0; }
      .mhs-name { font-size: 13.5px; font-weight: 700; margin: 0; }
      .mhs-npm { font-size: 11px; color: var(--ink-400); margin: 1px 0 0; }
      .mhs-poin-total { margin-left: auto; text-align: right; }
      .mhs-poin-total .num { font-family: var(--font-display); font-size: 18px; font-weight: 700; color: var(--navy-900); line-height: 1; }
      .mhs-poin-total .lbl { font-size: 9px; color: var(--ink-400); font-weight: 700; text-transform: uppercase; }

      /* ►► HANYA PRESET TETAP — mentor TIDAK BISA input poin bebas, supaya
         tidak ada yang tiba-tiba kasih +100 seenaknya. Semua nilai poin
         sudah ditentukan lewat daftar PRESET_PLUS / PRESET_MINUS di JS. */
      .preset-title { font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: .04em; color: var(--ink-400); margin: 10px 0 6px; }
      .preset-row { display: flex; gap: 6px; flex-wrap: wrap; }
      .preset-chip { font-size: 11.5px; font-weight: 700; padding: 8px 13px; border-radius: 99px; border: 1.5px solid; cursor: pointer; transition: all .12s; background: var(--surface); }
      .preset-chip.plus { border-color: #bbf7d0; color: #15803d; }
      .preset-chip.plus:hover { background: #f0fdf4; transform: translateY(-1px); }
      .preset-chip.minus { border-color: #fecaca; color: #b91c1c; }
      .preset-chip.minus:hover { background: #fef2f2; transform: translateY(-1px); }

      .riwayat-toggle { display: flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 700; color: var(--teal-600); margin-top: 12px; cursor: pointer; background: none; border: none; padding: 0; }
      .riwayat-toggle svg { width: 12px; height: 12px; transition: transform .2s; }
      .riwayat-toggle.open svg { transform: rotate(180deg); }
      .riwayat-list { max-height: 0; overflow: hidden; transition: max-height .25s ease; }
      .riwayat-list.open { max-height: 220px; overflow-y: auto; margin-top: 8px; }
      .riwayat-item { display: flex; justify-content: space-between; gap: 8px; font-size: 11px; padding: 6px 0; border-top: 1px dashed var(--border); }
      .riwayat-item:first-child { border-top: none; }
      .riwayat-item .judul { color: var(--ink-600); }
      .riwayat-item .poin.plus { color: #15803d; font-weight: 800; }
      .riwayat-item .poin.minus { color: #b91c1c; font-weight: 800; }

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

      .save-toast { position: fixed; bottom: calc(var(--bottomnav-h) + 16px); left: 50%; transform: translateX(-50%) translateY(20px); background: var(--navy-900); color: #fff; font-size: 12.5px; font-weight: 700; padding: 12px 22px; border-radius: 99px; box-shadow: var(--shadow-pop); opacity: 0; pointer-events: none; transition: opacity .25s, transform .25s; z-index: 60; display: flex; align-items: center; gap: 8px; }
      .save-toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }
      .save-toast svg { width: 15px; height: 15px; color: var(--lime-500); }
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
        <div class="hero-eyebrow"><span class="dot"></span> Input Poin</div>
        <h1>Keaktifan &amp; Pelanggaran</h1>
        <p class="hero-info-sub">
          Klik salah satu tombol untuk menambah poin keaktifan atau mengurangi
          poin karena pelanggaran. Semua pilihan poin sudah ditentukan
          jumlahnya, jadi tidak bisa diubah bebas oleh mentor.
        </p>
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

      <div class="mhs-list-scroll"><div class="mhs-grid" id="mhsGrid"></div></div>
    </main>

    <div class="save-toast" id="saveToast">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5" /></svg>
      <span id="saveToastText">Poin tersimpan</span>
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
      const KELOMPOK_MENTOR = "Kelompok 01";
      const ANGGOTA_KELOMPOK = [
        { nama: "Alexander Arul Husein", npm: "525241019" },
        { nama: "Bunga Citra Lestari", npm: "525241020" },
        { nama: "Dimas Prakoso", npm: "525241021" },
        { nama: "Eka Putri Ramadhani", npm: "525241022" },
        { nama: "Farhan Maulana", npm: "525241023" },
        { nama: "Gita Ayu Saputri", npm: "525241024" },
      ];

      // 🏷️ DAFTAR POIN TETAP — mentor cuma bisa PILIH dari daftar ini,
      //    tidak bisa mengetik nilai poin sendiri. Ubah/tambah pilihan di
      //    sini kalau perlu alasan lain.
      const PRESET_PLUS = [
        { label: "Aktif bertanya", poin: 5 },
        { label: "Membantu teman", poin: 5 },
        { label: "Jadi perwakilan kelompok", poin: 10 },
      ];
      const PRESET_MINUS = [
        { label: "Ribut", poin: 10 },
        { label: "Terlambat", poin: 5 },
        { label: "Atribut tidak lengkap", poin: 5 },
      ];

      document.getElementById("kelompokNama").innerText = KELOMPOK_MENTOR;

      let kataKunciCari = "";
      let riwayatKelompok = {}; // { "Nama": [ {tipe,judul,poin,tanggal} ] }

      function storageKeyPoin() { return `poin:${KELOMPOK_MENTOR}`; }

      async function muatRiwayat() {
        riwayatKelompok = {};
        try {
          const res = await window.storage.get(storageKeyPoin(), true);
          if (res && res.value) {
            const arr = JSON.parse(res.value);
            if (Array.isArray(arr)) {
              arr.forEach((item) => {
                if (!riwayatKelompok[item.nama]) riwayatKelompok[item.nama] = [];
                riwayatKelompok[item.nama].push(item);
              });
            }
          }
        } catch (e) {
          // belum ada riwayat tersimpan untuk kelompok ini — normal di awal
        }
      }

      async function simpanRiwayat() {
        const gabung = [];
        Object.keys(riwayatKelompok).forEach((nama) => riwayatKelompok[nama].forEach((item) => gabung.push(item)));
        try {
          await window.storage.set(storageKeyPoin(), JSON.stringify(gabung), true);
        } catch (e) {
          alert("Gagal menyimpan poin. Coba lagi.");
        }
      }

      function tambahPoin(nama, tipe, judul, poin) {
        if (!riwayatKelompok[nama]) riwayatKelompok[nama] = [];
        riwayatKelompok[nama].push({
          nama, tipe, judul, poin,
          tanggal: new Date().toLocaleDateString("id-ID", { day: "2-digit", month: "short", year: "numeric" }),
        });
        simpanRiwayat();
        tampilkanToast(`${tipe === "keaktifan" ? "+" : "-"}${poin} poin untuk ${nama}`);
        renderMhsGrid();
      }

      function totalPoin(nama) {
        const list = riwayatKelompok[nama] || [];
        let plus = 0, minus = 0;
        list.forEach((r) => { if (r.tipe === "keaktifan") plus += r.poin; else minus += r.poin; });
        return { bersih: plus - minus, list };
      }

      function renderMhsGrid() {
        const grid = document.getElementById("mhsGrid");
        const anggota = ANGGOTA_KELOMPOK.filter(
          (m) => m.nama.toLowerCase().includes(kataKunciCari.toLowerCase()) || m.npm.includes(kataKunciCari),
        );

        if (anggota.length === 0) {
          grid.innerHTML = `<div class="empty-state">Tidak ada mahasiswa yang cocok dengan pencarian.</div>`;
          return;
        }

        grid.innerHTML = anggota
          .map((m) => {
            const inisial = m.nama.split(" ").map((s) => s[0]).slice(0, 2).join("").toUpperCase();
            const t = totalPoin(m.nama);
            const presetPlusHtml = PRESET_PLUS.map(
              (p) => `<button class="preset-chip plus" data-nama="${m.nama}" data-tipe="keaktifan" data-judul="${p.label}" data-poin="${p.poin}">+${p.poin} ${p.label}</button>`,
            ).join("");
            const presetMinusHtml = PRESET_MINUS.map(
              (p) => `<button class="preset-chip minus" data-nama="${m.nama}" data-tipe="pelanggaran" data-judul="${p.label}" data-poin="${p.poin}">-${p.poin} ${p.label}</button>`,
            ).join("");
            const riwayatHtml = t.list.length
              ? t.list.slice().reverse().map(
                  (r) => `
                    <div class="riwayat-item">
                      <span class="judul">${r.judul} · ${r.tanggal}</span>
                      <span class="poin ${r.tipe === "keaktifan" ? "plus" : "minus"}">${r.tipe === "keaktifan" ? "+" : "-"}${r.poin}</span>
                    </div>
                  `,
                ).join("")
              : `<div class="riwayat-item"><span class="judul">Belum ada catatan.</span></div>`;

            return `
              <div class="mhs-card">
                <div class="mhs-card-head">
                  <span class="mhs-avatar">${inisial}</span>
                  <div>
                    <p class="mhs-name">${m.nama}</p>
                    <p class="mhs-npm">NPM ${m.npm}</p>
                  </div>
                  <div class="mhs-poin-total">
                    <div class="num" style="color:${t.bersih >= 0 ? "#16a34a" : "#dc2626"}">${t.bersih >= 0 ? "+" : ""}${t.bersih}</div>
                    <div class="lbl">Total Poin</div>
                  </div>
                </div>

                <div class="preset-title">Tambah Poin Keaktifan</div>
                <div class="preset-row">${presetPlusHtml}</div>

                <div class="preset-title">Kurangi Poin (Pelanggaran)</div>
                <div class="preset-row">${presetMinusHtml}</div>

                <button class="riwayat-toggle" data-nama="${m.nama}">
                  Lihat riwayat (${t.list.length})
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6" /></svg>
                </button>
                <div class="riwayat-list">${riwayatHtml}</div>
              </div>
            `;
          })
          .join("");

        grid.querySelectorAll(".preset-chip").forEach((btn) => {
          btn.addEventListener("click", () => {
            tambahPoin(btn.dataset.nama, btn.dataset.tipe, btn.dataset.judul, Number(btn.dataset.poin));
          });
        });

        grid.querySelectorAll(".riwayat-toggle").forEach((btn) => {
          btn.addEventListener("click", () => {
            btn.classList.toggle("open");
            btn.nextElementSibling.classList.toggle("open");
          });
        });
      }

      function tampilkanToast(teks) {
        const toast = document.getElementById("saveToast");
        document.getElementById("saveToastText").innerText = teks;
        toast.classList.add("show");
        setTimeout(() => toast.classList.remove("show"), 2200);
      }

      document.getElementById("searchInput").addEventListener("input", (e) => {
        kataKunciCari = e.target.value;
        renderMhsGrid();
      });

      async function init() {
        await muatRiwayat();
        renderMhsGrid();
      }
      init();

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