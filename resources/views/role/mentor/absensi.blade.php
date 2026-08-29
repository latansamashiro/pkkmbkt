{{-- resources/views/role/mentor/absensi.blade.php --}}
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Kelola Presensi | PKKMB-KT UNILAM 2026</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet" />

  <style type="text/tailwindcss">
    @theme {
        --color-navy-900: #152159;
        --color-navy-700: #1e3a8f;
        --color-navy-600: #2a4bb0;
        --color-teal-600: #0f8a8c;
        --color-teal-500: #16a0a1;
        --color-teal-tint: #e2f3f2;
        --color-lime-500: #a9c73b;
        --color-lime-tint: #f2f6e0;
        --color-navy-tint: #e6e9f6;
        --color-bg: #f2f4fa;
        --color-surface: #ffffff;
        --color-surface-muted: #e8ebf6;
        --color-border: #e1e5f1;
        --color-ink-900: #1b2238;
        --color-ink-600: #5b6175;
        --color-ink-400: #8d92a6;
        --font-sans: "Plus Jakarta Sans", sans-serif;
        --font-display: "Lora", serif;
      }
  </style>

  <style type="text/tailwindcss">
    /* ===== Wrapper konten (pola sama seperti halaman Mentor lain) ===== */
    .content { @apply flex-1 w-full mx-auto; max-width: 1180px; padding: clamp(16px, 4vw, 40px) clamp(16px, 4vw, 40px) calc(74px + 28px); }
    @media (min-width: 768px) { .content { padding-bottom: clamp(28px, 4vw, 48px); } }

    /* ===== Hero & section header (dipindah dari layouts.mentor.main, dipakai apa adanya) ===== */
    .hero { @apply relative overflow-hidden bg-surface-muted rounded-[28px]; padding: clamp(20px, 5vw, 38px) clamp(18px, 5vw, 38px) clamp(20px, 4vw, 32px); }
    .hero-eyebrow { @apply text-[13px] font-semibold text-ink-600 mb-1 relative z-[1]; }
    .hero-sub { @apply text-[14.5px] text-ink-600 mb-1.5 relative z-[1]; }
    .hero-title { @apply font-display font-bold text-navy-900 leading-[1.18] m-0 relative z-[1]; font-size: clamp(22px, 3.6vw + 14px, 32px); max-width: min(420px, 80%); }

    .section { @apply mt-[30px]; }
    .section-head { @apply flex items-baseline justify-between mb-3.5; }
    .section-title { @apply font-display text-[17px] font-bold text-navy-900 m-0; }

    .hero-stats-row { @apply grid gap-2.5 mt-5; grid-template-columns: repeat(3, 1fr); }
    .hero-stat-box { @apply bg-white/70 rounded-2xl text-center; padding: 12px 8px; }
    .hero-stat-box .val { @apply font-display text-xl font-bold text-navy-900 leading-none; }
    .hero-stat-box .lbl { @apply text-[10.5px] font-bold text-ink-600 mt-1; }

    .kelompok-label { @apply inline-flex items-center gap-2 bg-surface border-[1.5px] border-border rounded-full mb-[18px] shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)]; padding: 9px 18px 9px 8px; }
    .kelompok-label .ico { @apply w-[30px] h-[30px] rounded-full bg-navy-900 text-white flex items-center justify-center; }
    .kelompok-label .ico svg { @apply w-3.5 h-3.5; }
    .kelompok-label strong { @apply text-[13.5px] font-extrabold text-navy-900; }

    .hari-tabs { @apply flex gap-2 overflow-x-auto mb-[18px]; padding-bottom: 4px; }
    .hari-tab { @apply flex-shrink-0 bg-surface border-[1.5px] border-border rounded-[18px] text-left cursor-pointer transition-all; padding: 10px 16px; min-width: 128px; }
    .hari-tab .h-label { @apply text-[12.5px] font-extrabold text-ink-900; }
    .hari-tab .h-tanggal { @apply text-[10.5px] text-ink-400 font-semibold mt-0.5; }
    .hari-tab:hover { @apply border-teal-500; }
    .hari-tab.active { @apply bg-navy-900 border-navy-900; }
    .hari-tab.active .h-label, .hari-tab.active .h-tanggal { @apply text-white; }
    .hari-tab.active .h-tanggal { color: #aeb6e0; }

    .status-stats { @apply grid gap-2.5 mb-5; grid-template-columns: repeat(4, 1fr); }
    @media (max-width: 480px) { .status-stats { grid-template-columns: repeat(2, 1fr); } }
    .status-stat { @apply bg-surface rounded-[18px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)]; border-left: 4px solid var(--accent); padding: 12px 14px; }
    .status-stat .lbl { @apply text-[10.5px] text-ink-400 font-bold; }
    .status-stat .val { @apply font-display text-[22px] font-bold mt-1; }

    .sesi-tabs { @apply grid gap-2.5 mb-5; grid-template-columns: repeat(3, 1fr); }
    .sesi-tab { @apply bg-surface border-[1.5px] border-border rounded-[18px] text-center cursor-pointer transition-all; padding: 12px 10px; }
    .sesi-tab .sesi-nama { @apply text-[12.5px] font-extrabold text-ink-900; }
    .sesi-tab .sesi-jam { @apply text-[10.5px] text-ink-400 mt-0.5 font-semibold; }
    .sesi-tab .sesi-status { @apply inline-flex items-center gap-1 text-[9.5px] font-extrabold uppercase tracking-[0.03em] rounded-full mt-[7px]; padding: 3px 9px; }
    .sesi-tab.buka { @apply border-teal-500; }
    .sesi-tab.buka .sesi-status { background: #dcfce7; color: #15803d; }
    .sesi-tab.terkunci { @apply opacity-60; }
    .sesi-tab.terkunci .sesi-status { @apply bg-bg text-ink-400; }
    .sesi-tab.selesai .sesi-status { @apply bg-navy-tint text-navy-700; }
    .sesi-tab.active-selected { box-shadow: 0 0 0 3px rgba(22,160,161,.18); }

    .lock-banner { @apply flex items-center gap-2.5 rounded-[18px] font-semibold mb-4; background: #fff7ed; border: 1px solid #fed7aa; padding: 12px 16px; font-size: 12.5px; color: #9a3412; }
    .lock-banner svg { @apply w-[17px] h-[17px] flex-shrink-0; }

    .search-wrap { @apply relative mb-4; }
    .search-wrap svg { @apply absolute left-3.5 top-1/2 -translate-y-1/2 w-[15px] h-[15px] text-ink-400; }
    .search-wrap input { @apply w-full bg-surface border-[1.5px] border-border rounded-full font-sans text-[13px] font-medium; padding: 11px 16px 11px 40px; }
    .search-wrap input:focus { @apply outline-none border-teal-500; box-shadow: 0 0 0 3px rgba(22,160,161,.12); }

    .absensi-card { @apply bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] overflow-hidden mb-5; }
    .absensi-card-head { @apply bg-bg border-b border-border flex justify-between items-center gap-2.5 flex-wrap; padding: 14px 20px; }
    .absensi-card-head h3 { @apply text-xs font-extrabold uppercase tracking-[0.03em] text-navy-900 m-0; }
    .badge-count { @apply text-[10.5px] font-bold text-ink-600 bg-surface border border-border rounded-full; padding: 3px 10px; }

    .mhs-list-scroll { max-height: 460px; overflow-y: auto; }
    .mhs-list-scroll::-webkit-scrollbar { width: 6px; }
    .mhs-list-scroll::-webkit-scrollbar-thumb { background: var(--color-border); border-radius: 10px; }

    .mhs-row { @apply flex items-center justify-between gap-3 border-t border-border flex-wrap first:border-t-0; padding: 13px 20px; }
    .mhs-info { @apply flex items-center gap-2.5 min-w-0; }
    .mhs-avatar { @apply w-9 h-9 rounded-full bg-navy-tint text-navy-700 flex items-center justify-center font-extrabold text-[12.5px] flex-shrink-0; }
    .mhs-name { @apply text-[13px] font-bold m-0; }
    .mhs-npm { @apply text-[11px] text-ink-400 mt-0.5 mb-0; }

    .status-btns { @apply flex gap-1.5 flex-wrap flex-shrink-0; }
    .status-btn { @apply rounded-full border-[1.5px] border-border bg-surface text-[11px] font-extrabold cursor-pointer text-ink-400 transition-all whitespace-nowrap; padding: 7px 13px; }
    .status-btn:hover:not(:disabled) { @apply -translate-y-px; }
    .status-btn:disabled { @apply cursor-not-allowed opacity-50; }
    .status-btn[data-k="H"].on { background: #dcfce7; border-color: #22c55e; color: #15803d; }
    .status-btn[data-k="I"].on { background: #dbeafe; border-color: #3b82f6; color: #1d4ed8; }
    .status-btn[data-k="S"].on { background: #fef3c7; border-color: #f59e0b; color: #b45309; }
    .status-btn[data-k="A"].on { background: #fee2e2; border-color: #ef4444; color: #b91c1c; }

    .empty-state { @apply text-center text-[12.5px] text-ink-400 font-semibold; padding: 30px 20px; }

    .save-bar { @apply sticky flex justify-end gap-2.5 z-10; bottom: 16px; margin-top: -4px; }
    .btn-save { @apply inline-flex items-center justify-center gap-2 bg-navy-900 text-white font-extrabold text-[13px] rounded-full border-none cursor-pointer shadow-[0_10px_24px_rgba(21,33,89,0.16)] transition-all flex-1; padding: 13px 26px; }
    .btn-save:hover:not(:disabled) { @apply -translate-y-0.5; filter: brightness(1.12); }
    .btn-save:disabled { @apply opacity-45 cursor-not-allowed; transform: none; filter: none; }
    .btn-save svg { @apply w-4 h-4; }
    .btn-save.btn-submit { background: var(--color-navy-900); }

    .save-toast { @apply fixed left-1/2 bg-navy-900 text-white text-[12.5px] font-bold rounded-full shadow-[0_10px_24px_rgba(21,33,89,0.16)] opacity-0 pointer-events-none z-[60] flex items-center gap-2; bottom: calc(74px + 16px); transform: translateX(-50%) translateY(20px); padding: 12px 22px; transition: opacity .25s, transform .25s; }
    .save-toast.show { @apply opacity-100; transform: translateX(-50%) translateY(0); }
    .save-toast svg { @apply w-[15px] h-[15px] text-lime-500; }
    @media (min-width: 768px) { .save-toast { bottom: 16px; } }
  </style>
</head>

<body class="font-sans text-ink-900 m-0 bg-bg antialiased min-h-screen flex flex-col">
  @include('layouts.mentor.topnav', ['navActive' => 'absensi'])

  <div class="content">

    <!-- ===== HERO ===== -->
    <section class="hero">
      <p class="hero-eyebrow">Kelola Presensi</p>
      <p class="hero-sub">Presensi kelompok</p>
      <h2 class="hero-title">
        <span id="kelompokNama">{{ $group->name ?? 'Belum ada kelompok' }}</span>
      </h2>
      <p class="text-[13px] text-ink-600 mt-2 relative z-[1] max-w-[420px]">
        Catat kehadiran anggota kelompokmu per hari &amp; per sesi. Tiap sesi
        otomatis terbuka dan terkunci sesuai tanggal serta jam yang ditentukan.
      </p>

      <div class="hero-stats-row relative z-[1]">
        <div class="hero-stat-box">
          <div class="val" id="statHeroHadir">0</div>
          <div class="lbl">Hadir</div>
        </div>
        <div class="hero-stat-box">
          <div class="val" id="statHeroBelum">0</div>
          <div class="lbl">Belum Diisi</div>
        </div>
        <div class="hero-stat-box">
          <div class="val" id="statHeroTotal">0</div>
          <div class="lbl">Anggota</div>
        </div>
      </div>
    </section>

    <!-- ===== PILIH HARI ===== -->
    <section class="section">
      <div class="section-head">
        <h3 class="section-title">Pilih Hari</h3>
      </div>
      <div class="hari-tabs" id="hariTabs"></div>
    </section>

    <!-- ===== REKAP SESI ===== -->
    <section class="section">
      <div class="section-head">
        <h3 class="section-title">Rekap Sesi Ini</h3>
      </div>
      <div class="status-stats" id="statusStats"></div>
    </section>

    <!-- ===== PILIH SESI ===== -->
    <section class="section">
      <div class="section-head">
        <h3 class="section-title">Pilih Sesi</h3>
      </div>
      <div class="sesi-tabs" id="sesiTabs"></div>
      <div id="lockBannerWrap"></div>

      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8" />
          <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
        <input type="text" id="searchInput" placeholder="Cari nama atau NPM mahasiswa..." />
      </div>

      <div class="absensi-card">
        <div class="absensi-card-head">
          <h3 id="cardTitle">Daftar Anggota</h3>
          <span class="badge-count" id="cardCount">0 mahasiswa</span>
        </div>
        <div class="mhs-list-scroll">
          <div id="mhsList"></div>
        </div>
      </div>

      <div class="save-bar">
        <button class="btn-save" id="btnSimpan">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z" />
            <path d="M17 21v-8H7v8M7 3v5h8" />
          </svg>
          Simpan Presensi
        </button>
        <button class="btn-save btn-submit" id="btnSubmit">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5" />
          </svg>
          Submit &amp; Kunci
        </button>
      </div>
    </section>

    <div class="save-toast" id="saveToast">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 6 9 17l-5-5" />
      </svg>
      <span class="toast-text">Presensi tersimpan</span>
    </div>

  </div>

  @include('layouts.mentor.footer')

  @include('layouts.mentor.bottomnav', ['navActive' => 'absensi'])

  <script>
    $(function () {
      // ======================================================================
      // ►► KELOMPOK MENTOR — satu kelompok saja.
      // ======================================================================
      const KELOMPOK_MENTOR = @json($group->name ?? 'Belum ada kelompok');
      const ANGGOTA_KELOMPOK = @json($students->map(fn($s) => ['nama' => $s->name, 'npm' => $s->npm ?? '-', 'id' => $s->id])->values());

      // ======================================================================
      // ►► JADWAL HARI & SESI — diambil dari sesi yang dibuat Panitia
      //    (Kelola Jadwal Absensi), dikelompokkan otomatis per hari.
      // ======================================================================
      @php
        $jadwalHariJs = $templates->groupBy('attendance_date')->map(function ($sesiHari, $tanggal) use ($attendanceMap) {
          $dayName = optional($sesiHari->first())->day_name;
          return [
            'key' => (string) $tanggal,
            'label' => $dayName,
            'tanggal' => $tanggal,
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

      $("#kelompokNama").text(KELOMPOK_MENTOR);

      let hariAktif = JADWAL_HARI.length ? JADWAL_HARI[0].key : null;
      let sesiAktif = null;
      // dataPresensi berbasis ID mahasiswa, per sesi (template id):
      // { [templateId]: { [studentId]: 'H'|'I'|'S'|'A' } }
      let dataPresensi = {};
      let kataKunciCari = "";

      function formatTanggalIndo(iso) {
        const bulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
        const [y, m, d] = iso.split("-").map(Number);
        return `${d} ${bulan[m - 1]} ${y}`;
      }

      function getHari(key) {
        return JADWAL_HARI.find((h) => h.key === key);
      }

      function getSesi(hari, sesiKey) {
        return hari.sesi.find((s) => s.key === sesiKey);
      }

      function waktuGabung(tanggal, jam) {
        return new Date(`${tanggal}T${jam}:00`);
      }

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
        const $wrap = $("#hariTabs");
        const html = JADWAL_HARI.map(
          (h) => `
              <button class="hari-tab ${h.key === hariAktif ? "active" : ""}" data-key="${h.key}">
                <div class="h-label">${h.label}</div>
                <div class="h-tanggal">${formatTanggalIndo(h.tanggal)}</div>
              </button>
            `,
        ).join("");
        $wrap.html(html);
        $wrap.find(".hari-tab").on("click", async function () {
          hariAktif = $(this).data("key").toString();
          const hari = getHari(hariAktif);
          const sesiBuka = hari.sesi.find((s) => statusSesi(hari, s) === "buka");
          sesiAktif = sesiBuka ? sesiBuka.key : hari.sesi[0].key;
          await muatDataPresensi();
          renderSemua();
        });
      }

      function renderSesiTabs() {
        const hari = getHari(hariAktif);
        const $wrap = $("#sesiTabs");
        if (!hari) {
          $wrap.html("");
          return;
        }
        const html = hari.sesi.map((sesi) => {
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
        $wrap.html(html);
        $wrap.find(".sesi-tab").on("click", function () {
          sesiAktif = $(this).data("key").toString();
          renderSemua();
        });
      }

      function renderLockBanner() {
        const $wrap = $("#lockBannerWrap");
        const hari = getHari(hariAktif);
        if (!hari) {
          $wrap.html("");
          return;
        }
        const sesi = getSesi(hari, sesiAktif);
        if (!sesi) {
          $wrap.html("");
          return;
        }
        const st = statusSesi(hari, sesi);
        if (st === "buka") {
          $wrap.html("");
          return;
        }
        const pesan =
          st === "terkunci" ?
          `${sesi.label} ${hari.label} (${formatTanggalIndo(hari.tanggal)}) belum dibuka. Presensi bisa diisi mulai pukul ${sesi.mulai} WIB.` :
          st === "disubmit" ?
          `${sesi.label} ${hari.label} (${formatTanggalIndo(hari.tanggal)}) sudah DISUBMIT dan menjadi arsip. Data tidak bisa diubah lagi.` :
          `${sesi.label} ${hari.label} (${formatTanggalIndo(hari.tanggal)}) sudah ditutup. Kamu masih bisa melihat rekapnya, tapi tidak bisa mengubah presensi.`;
        $wrap.html(`
            <div class="lock-banner">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="10" width="16" height="10" rx="2" /><path d="M8 10V7a4 4 0 0 1 8 0v3" /></svg>
              <span>${pesan}</span>
            </div>
          `);
      }

      function tentukanHariSesiAwal() {
        if (!JADWAL_HARI.length) {
          hariAktif = null;
          sesiAktif = null;
          return;
        }
        for (const h of JADWAL_HARI) {
          const sesiBuka = h.sesi.find((s) => statusSesi(h, s) === "buka");
          if (sesiBuka) {
            hariAktif = h.key;
            sesiAktif = sesiBuka.key;
            return;
          }
        }
        for (const h of JADWAL_HARI) {
          const sesiTerkunci = h.sesi.find((s) => statusSesi(h, s) === "terkunci");
          if (sesiTerkunci) {
            hariAktif = h.key;
            sesiAktif = sesiTerkunci.key;
            return;
          }
        }
        hariAktif = JADWAL_HARI[0].key;
        sesiAktif = JADWAL_HARI[0].sesi.length ? JADWAL_HARI[0].sesi[0].key : null;
      }

      // Data presensi yang sudah tersimpan dikirim langsung dari server (TANDA_TERSIMPAN).
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
        const $wrap = $("#statusStats");
        const hitung = { H: 0, I: 0, S: 0, A: 0 };
        ANGGOTA_KELOMPOK.forEach((m) => {
          const s = getStatusAnggota(m.id, sesiAktif);
          if (s) hitung[s]++;
        });
        const warna = { H: "#22c55e", I: "#3b82f6", S: "#f59e0b", A: "#ef4444" };
        const html = HURUF_STATUS.map(
          (k) => `
              <div class="status-stat" style="--accent:${warna[k]}">
                <div class="lbl">${LABEL_STATUS[k]}</div>
                <div class="val" style="color:${warna[k]}">${hitung[k]}</div>
              </div>
            `,
        ).join("");
        $wrap.html(html);
      }

      function renderMhsList() {
        if (!hariAktif || !sesiAktif) {
          $("#cardTitle").text("Belum ada sesi absensi");
          $("#cardCount").text("");
          $("#mhsList").html(`<div class="empty-state">Panitia belum membuat jadwal sesi absensi.</div>`);
          $("#btnSimpan").prop("disabled", true);
          $("#btnSubmit").prop("disabled", true);
          return;
        }
        const hari = getHari(hariAktif);
        const sesi = getSesi(hari, sesiAktif);
        const bisaEdit = statusSesi(hari, sesi) === "buka";
        $("#btnSimpan").prop("disabled", !bisaEdit);
        $("#btnSubmit").prop("disabled", !bisaEdit || sesi.terkunci);
        $("#cardTitle").text(`Daftar Anggota — ${sesi.label}, ${hari.label}`);

        const $listEl = $("#mhsList");
        const anggota = ANGGOTA_KELOMPOK.filter(
          (m) => m.nama.toLowerCase().includes(kataKunciCari.toLowerCase()) || m.npm.includes(kataKunciCari),
        );
        $("#cardCount").text(`${anggota.length} mahasiswa`);

        if (anggota.length === 0) {
          $listEl.html(`<div class="empty-state">${ANGGOTA_KELOMPOK.length === 0 ? "Belum ada anggota di kelompokmu." : "Tidak ada anggota yang cocok dengan pencarian."}</div>`);
        } else {
          const html = anggota
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

          $listEl.html(html);

          $listEl.find(".status-btn").on("click", function () {
            const $btn = $(this);
            setStatusAnggota($btn.data("id").toString(), sesiAktif, $btn.data("k"));
            renderMhsList();
            renderStatusStats();
            renderStatHero();
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
        $("#statHeroHadir").text(hadir);
        $("#statHeroBelum").text(belum);
        $("#statHeroTotal").text(ANGGOTA_KELOMPOK.length);
      }

      // ======================================================================
      // ►► SIMPAN (draft) & SUBMIT (kunci permanen) — beneran ke server.
      // ======================================================================
      async function simpanKeServer(diam = false) {
        if (!sesiAktif) return false;
        const marks = dataPresensi[sesiAktif] || {};
        if (Object.keys(marks).length === 0) {
          if (!diam) alert("Isi dulu minimal satu tanda kehadiran sebelum menyimpan.");
          return false;
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
          if (!diam) tampilkanToast(result.message || "Presensi tersimpan.");
          return true;
        } catch (e) {
          if (!diam) alert(e.message || "Gagal menyimpan presensi. Coba lagi.");
          return false;
        }
      }

      async function simpanPresensi() {
        await simpanKeServer(false);
      }

      async function submitPresensi() {
        if (!sesiAktif) return;
        const hari = getHari(hariAktif);
        const sesi = getSesi(hari, sesiAktif);

        const marks = dataPresensi[sesiAktif] || {};
        if (Object.keys(marks).length === 0) {
          alert("Isi dulu minimal satu tanda kehadiran sebelum submit.");
          return;
        }

        if (!confirm(`Yakin submit presensi "${sesi.label}, ${hari.label}"? Setelah disubmit, data TIDAK BISA diubah lagi oleh siapa pun.`)) return;

        const tersimpan = await simpanKeServer(true);
        if (!tersimpan) {
          alert("Gagal menyimpan presensi sebelum submit. Coba lagi.");
          return;
        }

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
        const $toast = $("#saveToast");
        if (pesan) $toast.find(".toast-text").text(pesan);
        $toast.addClass("show");
        setTimeout(() => $toast.removeClass("show"), 2200);
      }

      $("#searchInput").on("input", function () {
        kataKunciCari = $(this).val();
        renderMhsList();
      });
      $("#btnSimpan").on("click", simpanPresensi);
      $("#btnSubmit").on("click", submitPresensi);

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
        setInterval(() => {
          renderSesiTabs();
          renderLockBanner();
          renderMhsList();
        }, 30000);
      }
      init();
    });
  </script>
</body>

</html>
