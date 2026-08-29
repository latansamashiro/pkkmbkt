<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Poin Keaktifan &amp; Pelanggaran | PKKMB-KT UNILAM 2026</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
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
        --color-border: #e1e5f1;
        --color-ink-900: #1b2238;
        --color-ink-600: #5b6175;
        --color-ink-400: #8d92a6;
        --font-sans: "Plus Jakarta Sans", sans-serif;
        --font-display: "Lora", serif;
      }
    </style>
  <style>
    @keyframes dotpulse {

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
  </style>
</head>

<body class="font-sans text-ink-900 m-0 p-0 bg-bg antialiased min-h-screen flex flex-col">
  <!-- ============ NAVBAR ============ -->
  <header
    class="sticky top-0 z-50 flex items-center justify-between gap-4 px-4 sm:px-8 md:px-12 py-3.5 bg-navy-900 border-b border-white/10">
    <a
      href="{{ route('dashboard') }}"
      class="flex items-center gap-2.5 z-50 no-underline"
      aria-label="PKKMB-KT UNILAM Beranda">
      <div
        class="w-[38px] h-[38px] rounded-full bg-white flex items-center justify-center font-display text-[9px] font-bold text-navy-900 text-center leading-tight flex-shrink-0 overflow-hidden">
        <img
          src="{{ asset('gambar/unilam.webp') }}"
          alt="Logo UNILAM"
          class="w-full h-full object-contain" />
      </div>
      <div>
        <strong class="block font-display text-[14.5px] text-white">SIMBA</strong>
        <span class="text-[10.5px] text-[#aeb6e0] tracking-[0.04em]">UNILAM 2026</span>
      </div>
    </a>

    <nav class="hidden md:flex flex-row gap-7" id="navbarLinks">
      <a
        href="{{ route('role.student.modul') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Modul</a>
      <a
        href="{{ route('role.student.leaderboard') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Leaderboard</a>
      <a
        href="{{ route('dashboard') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Dashboard</a>
      <a
        href="{{ route('role.student.info') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Info</a>
      <a
        href="{{ route('role.student.profil') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Profil</a>
    </nav>
  </header>

  <!-- ============ HERO ============ -->
  <section
    class="relative overflow-hidden px-4 sm:px-8 md:px-12 py-9 sm:py-12 md:py-14">
    <div
      class="absolute inset-0 z-0 overflow-hidden after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-br after:from-navy-900/[0.94] after:to-teal-600/85"
      id="heroSlideshow"></div>

    <div class="relative z-[1] max-w-[1200px] mx-auto flex flex-wrap justify-between items-end gap-7">
      <div class="flex-1 min-w-[280px]">
        <h1 class="font-display text-2xl sm:text-3xl md:text-[38px] font-bold text-white mb-3 leading-[1.2]">
          Poin Keaktifan<br />&amp; Pelanggaran
        </h1>
        <p class="text-sm text-white/75 leading-[1.7] max-w-[460px]">
          Pantau poin yang kamu dapat dari keaktifan dan poin yang berkurang
          akibat pelanggaran selama PKKMB-KT. Data yang ditampilkan hanya
          milik akunmu sendiri.
        </p>
      </div>
      <div class="flex gap-0.5 bg-white/[0.07] border border-white/[0.12] rounded-[18px] px-[22px] py-4 backdrop-blur-md flex-shrink-0">
        <div class="text-center px-4 border-r border-white/[0.12] last:border-r-0">
          <div class="font-display text-2xl font-bold text-lime-500 leading-none" id="heroTotalKeaktifan">0</div>
          <div class="text-[10px] text-white/55 font-semibold mt-1 tracking-[0.04em]">Keaktifan</div>
        </div>
        <div class="text-center px-4 border-r border-white/[0.12] last:border-r-0">
          <div class="font-display text-2xl font-bold text-lime-500 leading-none" id="heroTotalPelanggaran">0</div>
          <div class="text-[10px] text-white/55 font-semibold mt-1 tracking-[0.04em]">Pelanggaran</div>
        </div>
      </div>
    </div>
  </section>

  <main class="max-w-[1000px] mx-auto px-4 sm:px-8 md:px-12 py-8 pb-[calc(74px+28px)] md:pb-8 w-full flex-1">
    <!-- ============ IDENTITAS AKUN — HANYA DATA MILIK SENDIRI ============ -->
    <div class="bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] px-[22px] py-[18px] flex items-center gap-4 mb-6">
      <div class="w-14 h-14 rounded-full overflow-hidden bg-teal-tint flex-shrink-0 border-[3px] border-teal-tint">
        <img
          src="{{ auth()->user()->profile_picture ? asset('storage/'.auth()->user()->profile_picture) : 'data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27%3E%3Crect width=%27100%27 height=%27100%27 fill=%27%23e2e8f0%27/%3E%3Ccircle cx=%2750%27 cy=%2738%27 r=%2718%27 fill=%27%2394a3b8%27/%3E%3Cpath d=%27M20 88c0-22 13-35 30-35s30 13 30 35%27 fill=%27%2394a3b8%27/%3E%3C/svg%3E' }}"
          alt="Foto Profil"
          class="w-full h-full object-cover" />
      </div>
      <div>
        <p class="font-display text-[17px] font-bold text-ink-900 m-0" id="identityName">{{ $identitas['nama'] }}</p>
        <p class="text-xs text-ink-600 mt-1 flex items-center gap-2 flex-wrap">
          NPM <span id="identityNPM">{{ $identitas['npm'] ?? '-' }}</span>
          <span class="text-[10px] bg-navy-tint text-navy-900 px-2.5 py-[3px] rounded-full font-extrabold font-mono" id="identityKelompok">{{ $identitas['kelompok'] }}</span>
        </p>
      </div>
      <span class="ml-auto inline-flex items-center gap-1.5 text-[11px] font-bold text-teal-600 bg-teal-tint px-3.5 py-[7px] rounded-full flex-shrink-0 [&_svg]:w-3 [&_svg]:h-3 max-[520px]:px-2">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
          <rect x="4" y="10" width="16" height="10" rx="2" />
          <path d="M8 10V7a4 4 0 0 1 8 0v3" />
        </svg>
        <span class="max-[520px]:hidden">Data pribadi</span>
      </span>
    </div>

    <div class="flex items-center gap-2.5 mb-4">
      <div class="w-1 h-5 rounded-full bg-gradient-to-b from-teal-500 to-navy-700"></div>
      <h2 class="font-display text-base font-bold text-ink-900 m-0">Ringkasan Poin</h2>
    </div>

    <!-- Ringkasan: total poin Keaktifan & total poin Pelanggaran -->
    <div class="grid grid-cols-1 min-[561px]:grid-cols-2 gap-4 mb-5">
      <div class="bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] p-[22px] flex items-center gap-4 transition-all hover:-translate-y-[3px] hover:shadow-[0_10px_24px_rgba(21,33,89,0.16)] border-l-4 border-l-[#22c55e]">
        <span class="w-[52px] h-[52px] rounded-[15px] flex items-center justify-center flex-shrink-0 [&_svg]:w-6 [&_svg]:h-6 bg-[#f0fdf4] text-[#16a34a]">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 19V5M5 12l7-7 7 7" />
          </svg>
        </span>
        <div>
          <div class="font-display text-3xl font-bold leading-none text-[#16a34a]" id="totalKeaktifanVal">+0</div>
          <div class="text-[12.5px] text-ink-900 font-bold mt-1">Poin Keaktifan</div>
          <div class="text-[11px] text-ink-400 font-semibold mt-0.5" id="countKeaktifan">0 catatan</div>
        </div>
      </div>
      <div class="bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] p-[22px] flex items-center gap-4 transition-all hover:-translate-y-[3px] hover:shadow-[0_10px_24px_rgba(21,33,89,0.16)] border-l-4 border-l-[#ef4444]">
        <span class="w-[52px] h-[52px] rounded-[15px] flex items-center justify-center flex-shrink-0 [&_svg]:w-6 [&_svg]:h-6 bg-[#fef2f2] text-[#dc2626]">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 5v14M5 12l7 7 7-7" />
          </svg>
        </span>
        <div>
          <div class="font-display text-3xl font-bold leading-none text-[#dc2626]" id="totalPelanggaranVal">-0</div>
          <div class="text-[12.5px] text-ink-900 font-bold mt-1">Poin Pelanggaran</div>
          <div class="text-[11px] text-ink-400 font-semibold mt-0.5" id="countPelanggaran">0 catatan</div>
        </div>
      </div>
    </div>

    <!-- Riwayat poin (bisa difilter Semua / Keaktifan / Pelanggaran) -->
    <div class="bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] overflow-hidden mb-5">
      <div class="px-[22px] py-4 bg-bg border-b border-border flex flex-wrap justify-between items-center gap-3">
        <h3 class="text-xs font-extrabold uppercase tracking-[0.03em] text-navy-900 m-0 flex items-center gap-2">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-teal-500">
            <path d="M9 11l3 3L22 4" />
            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
          </svg>
          <span>Riwayat Poin</span>
        </h3>
      </div>
      <div class="flex gap-2 px-[22px] py-3 border-b border-border bg-bg flex-wrap">
        <button type="button" class="poin-chip px-3.5 py-1.5 rounded-full text-[11.5px] font-bold border-[1.5px] cursor-pointer transition-all active bg-navy-900 border-navy-900 text-white" data-filter="semua">Semua</button>
        <button type="button" class="poin-chip px-3.5 py-1.5 rounded-full text-[11.5px] font-bold border-[1.5px] border-border bg-surface text-ink-600 cursor-pointer transition-all hover:border-teal-500 hover:text-teal-600" data-filter="keaktifan">Keaktifan</button>
        <button type="button" class="poin-chip px-3.5 py-1.5 rounded-full text-[11.5px] font-bold border-[1.5px] border-border bg-surface text-ink-600 cursor-pointer transition-all hover:border-teal-500 hover:text-teal-600" data-filter="pelanggaran">Pelanggaran</button>
      </div>
      <div class="flex flex-col" id="poinList"></div>
    </div>

    <div class="bg-[#eff6ff] border border-[#bfdbfe] rounded-[18px] px-[18px] py-4 flex gap-3 items-start">
      <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-[18px] h-[18px] stroke-[#1d4ed8] flex-shrink-0 mt-px">
        <circle cx="12" cy="12" r="10" />
        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
        <path d="M12 17h.01" />
      </svg>
      <p class="m-0 text-xs text-[#1e40af] leading-[1.6]">
        <strong class="block mb-0.5">Halaman ini hanya menampilkan poin milik akun Anda sendiri.</strong>
        Anda tidak dapat melihat poin mahasiswa lain maupun kelompok lain.
        Jika menemukan ketidaksesuaian data, harap konfirmasi langsung kepada
        mentor pendamping kelompok Anda.
      </p>
    </div>
  </main>

  <!-- ============ FOOTER ============ -->
  <footer class="bg-[#0d1735] px-4 sm:px-8 md:px-12 py-6 flex flex-wrap justify-between items-center gap-3.5 pb-[calc(74px+16px)] md:pb-6">
    <p class="text-[13px] text-[#4a6a9f] m-0">© 2026 PKKMB-KT UNILAM. Semua hak dilindungi.</p>
    <div class="flex gap-5">
      <a
        href="{{ route('landing.kebijakan-privasi') }}"
        class="text-[13px] text-[#4a6a9f] no-underline transition-colors hover:text-[#aeb6e0]">Kebijakan Privasi</a>
      <a
        href="{{ route('landing.syarat-ketentuan') }}"
        class="text-[13px] text-[#4a6a9f] no-underline transition-colors hover:text-[#aeb6e0]">Syarat &amp; Ketentuan</a>
      <a
        href="{{ route('landing.bantuan') }}"
        class="text-[13px] text-[#4a6a9f] no-underline transition-colors hover:text-[#aeb6e0]">Bantuan</a>
    </div>
  </footer>

  <!-- ======= BOTTOM NAV (mobile only) ======= -->
  <nav
    class="fixed bottom-0 left-0 right-0 h-[74px] bg-surface border-t border-border flex items-center justify-around px-1.5 pb-[env(safe-area-inset-bottom)] z-30 md:hidden"
    aria-label="Navigasi bawah">
    <a
      href="{{ route('role.student.modul') }}"
      class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
        <path d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z" />
      </svg>
      <span>Modul</span>
    </a>
    <a
      href="{{ route('role.student.leaderboard') }}"
      class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z" />
        <path d="M5 21v-5M12 21v-7M19 21v-4" />
      </svg>
      <span>Leaderboard</span>
    </a>
    <a
      href="{{ route('dashboard') }}"
      class="flex-none flex flex-col items-center justify-center text-white -mt-[30px] bg-navy-900 w-[54px] h-[54px] rounded-full shadow-[0_10px_24px_rgba(21,33,89,0.16)] no-underline [&>span]:hidden"
      aria-label="Beranda">
      <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 11.5 12 4l8 7.5" />
        <path d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10" />
      </svg>
      <span>Beranda</span>
    </a>
    <a
      href="{{ route('role.student.info') }}"
      class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="9" />
            <path d="M12 11v5" />
            <path d="M12 8h.01" />
      </svg>
      <span>Info</span>
    </a>
    <a
      href="{{ route('role.student.profil') }}"
      class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="8" r="3.4" />
        <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
      </svg>
      <span>Profil</span>
    </a>
  </nav>

  <script>
    $(function() {
      // ======================================================================
      // ►► POIN KEAKTIFAN & PELANGGARAN — dari database (tabel activities),
      //    cuma punya akun yang lagi login (dibatasi di controller).
      // ======================================================================
      const riwayatPoin = @json($riwayatPoin);

      const iconKeaktifan = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M5 12l7-7 7 7" /></svg>`;
      const iconPelanggaran = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7" /></svg>`;

      let filterPoinAktif = "semua";

      function renderRingkasanPoin() {
        const catatanKeaktifan = riwayatPoin.filter((r) => r.tipe === "keaktifan");
        const catatanPelanggaran = riwayatPoin.filter((r) => r.tipe === "pelanggaran");
        const totalKeaktifan = catatanKeaktifan.reduce((a, r) => a + r.poin, 0);
        const totalPelanggaran = catatanPelanggaran.reduce((a, r) => a + r.poin, 0);

        $("#totalKeaktifanVal").text(`+${totalKeaktifan}`);
        $("#totalPelanggaranVal").text(`-${totalPelanggaran}`);
        $("#countKeaktifan").text(`${catatanKeaktifan.length} catatan`);
        $("#countPelanggaran").text(`${catatanPelanggaran.length} catatan`);

        $("#heroTotalKeaktifan").text(`+${totalKeaktifan}`);
        $("#heroTotalPelanggaran").text(`-${totalPelanggaran}`);
      }

      function renderRiwayatPoin() {
        const $listEl = $("#poinList");
        const data =
          filterPoinAktif === "semua" ?
          riwayatPoin :
          riwayatPoin.filter((r) => r.tipe === filterPoinAktif);

        if (data.length === 0) {
          $listEl.html(
            `<div class="px-[22px] py-8 text-center text-[12.5px] text-ink-400 font-semibold">Belum ada catatan untuk filter ini.</div>`,
          );
          return;
        }

        const html = data
          .map((r) => {
            const isPlus = r.tipe === "keaktifan";
            const iconClass = isPlus ?
              "w-[38px] h-[38px] rounded-[11px] flex items-center justify-center flex-shrink-0 [&_svg]:w-[17px] [&_svg]:h-[17px] bg-[#f0fdf4] text-[#16a34a]" :
              "w-[38px] h-[38px] rounded-[11px] flex items-center justify-center flex-shrink-0 [&_svg]:w-[17px] [&_svg]:h-[17px] bg-[#fef2f2] text-[#dc2626]";
            const badgeClass = isPlus ?
              "flex-shrink-0 font-display font-bold text-sm px-[13px] py-1.5 rounded-full whitespace-nowrap bg-[#f0fdf4] text-[#15803d]" :
              "flex-shrink-0 font-display font-bold text-sm px-[13px] py-1.5 rounded-full whitespace-nowrap bg-[#fef2f2] text-[#b91c1c]";
            return `
                <div class="poin-row flex items-center justify-between gap-3.5 px-[22px] py-3.5 border-t border-border transition-colors hover:bg-bg first:border-t-0">
                  <div class="flex items-center gap-3 min-w-0">
                    <span class="${iconClass}">
                      ${isPlus ? iconKeaktifan : iconPelanggaran}
                    </span>
                    <div>
                      <p class="text-[13px] font-bold text-ink-900 m-0 leading-[1.4]">${r.judul}</p>
                      <p class="text-[11px] text-ink-400 mt-0.5">${r.tanggal}</p>
                    </div>
                  </div>
                  <span class="${badgeClass}">${isPlus ? "+" : "-"}${r.poin}</span>
                </div>
              `;
          })
          .join("");

        $listEl.html(html);
      }

      $(".poin-chip").on("click", function() {
        $(".poin-chip")
          .removeClass("active bg-navy-900 border-navy-900 text-white")
          .addClass("border-border bg-surface text-ink-600");
        $(this)
          .removeClass("border-border bg-surface text-ink-600")
          .addClass("active bg-navy-900 border-navy-900 text-white");
        filterPoinAktif = $(this).data("filter");
        renderRiwayatPoin();
      });

      renderRingkasanPoin();
      renderRiwayatPoin();

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO
      // ======================================================================
      const heroSlideImages = [
        "{{ asset('gambar/gedungutama.webp') }}",
        "{{ asset('gambar/rektor.webp') }}",
        "{{ asset('gambar/gedung.webp') }}",
      ];
      const HERO_SLIDE_INTERVAL_MS = 6000;
      const $heroSlideshow = $("#heroSlideshow");
      const SLIDE_CLASS =
        "hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-[1800ms] ease-in-out";

      if ($heroSlideshow.length && heroSlideImages.length) {
        heroSlideImages.forEach((src, i) => {
          $("<div>")
            .addClass(SLIDE_CLASS)
            .addClass(i === 0 ? "opacity-100" : "opacity-0")
            .css("background-image", `url("${src}")`)
            .appendTo($heroSlideshow);
        });

        if (heroSlideImages.length > 1) {
          let currentSlide = 0;
          const $slides = $heroSlideshow.find(".hero-slide");
          setInterval(() => {
            $slides.eq(currentSlide).removeClass("opacity-100").addClass("opacity-0");
            currentSlide = (currentSlide + 1) % $slides.length;
            $slides.eq(currentSlide).removeClass("opacity-0").addClass("opacity-100");
          }, HERO_SLIDE_INTERVAL_MS);
        }
      }
    });
  </script>
</body>

</html>