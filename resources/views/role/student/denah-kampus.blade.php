<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Denah Kampus | PKKMB-KT UNILAM 2026</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet" />

  <!-- ======================================================================
         ►► TOKEN TAILWIND — semua warna & font kustom didaftarkan di sini
         lewat @theme, supaya bisa dipakai sebagai utility class biasa
         (contoh: bg-navy-900, text-teal-500, font-display, dst).
    ====================================================================== -->
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
        --color-amber-500: #e0a728;
        --color-amber-tint: #fbf1dc;
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

  <!-- ======================================================================
         ►► SISA CSS MANUAL — hanya untuk hal yang tidak praktis lewat
         utility class Tailwind: animasi @keyframes dan scrollbar tipis.
    ====================================================================== -->
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

    @keyframes detailUp {
      from {
        transform: translateY(24px);
        opacity: 0;
      }

      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .scroll-thin::-webkit-scrollbar {
      width: 5px;
    }

    .scroll-thin::-webkit-scrollbar-thumb {
      background: #e1e5f1;
      border-radius: 10px;
    }
  </style>
</head>

<body class="font-sans text-ink-900 m-0 p-0 bg-bg antialiased">
  <header
    class="sticky top-0 z-40 flex items-center justify-between gap-4 px-4 sm:px-8 md:px-12 py-3.5 bg-navy-900 border-b border-white/10">
    <a
      href="#"
      class="flex items-center gap-2.5 z-50 no-underline"
      aria-label="PKKMB-KT UNILAM Beranda">
      <div
        class="w-[38px] h-[38px] rounded-full bg-white flex items-center justify-center font-display text-[9px] font-bold text-navy-900 text-center leading-tight flex-shrink-0 overflow-hidden">
        <img
          src="{{ asset('gambar/unilam.png') }}"
          alt="Logo UNILAM"
          class="w-full h-full object-contain" />
      </div>
      <div>
        <strong class="block font-display text-[14.5px] text-white">PKKMB-KT</strong>
        <span class="text-[10.5px] text-[#aeb6e0] tracking-[0.04em]">UNILAM 2026</span>
      </div>
    </a>

    <nav class="hidden md:flex flex-row gap-7" id="navbarLinks">
      <a
        href="{{ route('role.student.modul') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white [&.active]:text-white [&.active]:border-b-2 [&.active]:border-lime-500 [&.active]:pb-0.5">Modul</a>
      <a
        href="{{ route('role.student.leaderboard') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white [&.active]:text-white [&.active]:border-b-2 [&.active]:border-lime-500 [&.active]:pb-0.5">Leaderboard</a>
      <a
        href="{{ route('dashboard') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white [&.active]:text-white [&.active]:border-b-2 [&.active]:border-lime-500 [&.active]:pb-0.5">Dashboard</a>
      <a
        href="{{ route('role.student.info') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white [&.active]:text-white [&.active]:border-b-2 [&.active]:border-lime-500 [&.active]:pb-0.5">Info</a>
      <a
        href="{{ route('role.student.profil') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white [&.active]:text-white [&.active]:border-b-2 [&.active]:border-lime-500 [&.active]:pb-0.5">Profil</a>
    </nav>
  </header>

  <!-- ============ HERO ============ -->
  <section
    class="relative overflow-hidden min-h-[260px] px-4 sm:px-8 md:px-12 py-10 sm:py-14 md:py-16 flex items-center justify-start">
    <div
      class="hero-slideshow absolute inset-0 z-0 overflow-hidden after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-br after:from-navy-900/90 after:to-teal-600/[0.78]"
      id="heroSlideshow"></div>
    <div class="relative z-[1] max-w-[640px] mx-0 text-left">
      <div
        class="inline-flex items-center gap-[7px] bg-lime-500/[0.15] border border-lime-500/[0.35] text-[#c8e46a] text-[11px] font-bold px-3.5 py-[5px] rounded-full mb-4 tracking-[0.06em] uppercase">
        <span
          class="w-1.5 h-1.5 rounded-full bg-lime-500 animate-[dotpulse_2s_infinite]"></span>
        Orientasi Lokasi
      </div>
      <h1
        class="font-display text-2xl sm:text-3xl md:text-[38px] font-bold text-white mb-3 leading-[1.2]">
        Denah Kampus<br />UNILAM Rangkasbitung
      </h1>
      <p class="text-sm text-white/75 leading-[1.7] max-w-[560px] m-0">
        Cari dan kenali lokasi gedung, fasilitas, dan area penting di
        kampus Universitas La Tansa Mashiro.
      </p>
    </div>
  </section>

  <div
    class="max-w-[1180px] mx-auto px-4 sm:px-8 md:px-12 py-7 pb-[calc(74px+28px)] md:pb-7">
    <div
      class="grid grid-cols-1 min-[900px]:grid-cols-[300px_1fr] gap-[18px] min-[900px]:items-start">
      <aside
        class="order-2 min-[900px]:order-none bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] p-[18px]">
        <div class="relative mb-3.5">
          <i
            class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-400 text-[13px]"></i>
          <input
            type="text"
            id="mapSearchInput"
            placeholder="Cari ruangan atau lokasi..."
            class="w-full py-[11px] pl-[38px] pr-3.5 rounded-xl border border-border bg-bg font-sans text-[13px] text-ink-900 focus:outline-none focus:border-teal-500 focus:bg-white focus:shadow-[0_0_0_4px_var(--color-teal-tint)]" />
        </div>
        <div
          class="scroll-thin flex flex-col gap-1.5 max-h-[440px] overflow-y-auto pr-0.5"
          id="mapLocList"></div>
      </aside>

      <div
        class="order-1 min-[900px]:order-none relative bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] overflow-hidden">
        <div
          class="flex justify-end items-center px-3 py-2 border-b border-border bg-surface">
          <button
            type="button"
            class="flex items-center gap-[7px] bg-bg border border-border rounded-full px-3.5 py-[7px] text-[11.5px] font-bold text-ink-600 cursor-pointer transition-colors hover:border-teal-500 hover:text-teal-600 [&.pins-on]:bg-navy-900 [&.pins-on]:border-navy-900 [&.pins-on]:text-white pins-on"
            id="mapPinMode">
            <i class="fa-solid fa-location-dot text-xs"></i>
            <span id="mapPinModeLabel">Pakai Pin</span>
          </button>
        </div>
        <div
          class="map-image-wrap relative w-full aspect-[4/3] bg-navy-tint overflow-hidden [&.pins-hidden_.map-pin]:hidden"
          id="mapImageWrap">
          <img
            class="map-image absolute inset-0 w-full h-full object-contain object-center block"
            src="{{ asset('gambar/denah.jpeg') }}"
            alt="Denah Kampus UNILAM" />
        </div>
        <div
          class="border-t border-border bg-surface px-3.5 py-2.5 text-[10.5px] text-ink-600 flex gap-3.5 flex-wrap">
          <span class="inline-flex items-center gap-1"><i class="w-2 h-2 rounded-full inline-block bg-teal-500"></i>Gedung / Ruang</span>
          <span class="inline-flex items-center gap-1"><i class="w-2 h-2 rounded-full inline-block bg-lime-500"></i>Fasilitas Umum</span>
          <span class="inline-flex items-center gap-1"><i class="w-2 h-2 rounded-full inline-block bg-navy-600"></i>Area Parkir</span>
        </div>
      </div>
    </div>
  </div>

  <!-- ============ MODAL DETAIL LOKASI ============ -->
  <div
    class="fixed inset-0 bg-[#0a0f28]/45 hidden items-end justify-center z-[60] p-0 min-[700px]:items-center min-[700px]:p-5 [&.open]:flex"
    id="mapDetail">
    <div
      class="bg-surface w-full max-w-[420px] rounded-t-[24px] min-[700px]:rounded-[24px] max-h-[86vh] overflow-y-auto shadow-[0_10px_24px_rgba(21,33,89,0.16)] animate-[detailUp_0.25s_ease]">
      <div
        class="px-5 py-[18px] border-b border-border flex items-center justify-between">
        <h3
          class="font-display text-lg text-ink-900 m-0 flex items-center gap-2"
          id="detailTitle">
          <i data-lucide="map-pin"></i> Nama Lokasi
        </h3>
        <button
          class="w-[30px] h-[30px] rounded-full border-none bg-bg text-ink-600 cursor-pointer flex items-center justify-center"
          id="detailClose">
          <i data-lucide="x"></i>
        </button>
      </div>
      <div class="p-5">
        <div
          class="map-detail-gallery relative w-full aspect-video rounded-[14px] overflow-hidden bg-navy-tint mb-4"
          id="detailGallery">
          <div
            class="flex h-full transition-transform duration-[350ms] ease-in-out"
            id="detailGalleryTrack"
            style="transform: translateX(0)"></div>
          <button
            class="gallery-nav absolute top-1/2 -translate-y-1/2 left-2 w-8 h-8 rounded-full border-none bg-[#0a0f28]/55 text-white text-lg leading-none flex items-center justify-center cursor-pointer transition-all hover:bg-[#0a0f28]/80 hover:scale-105"
            id="galleryPrev"
            aria-label="Foto sebelumnya">
            ‹
          </button>
          <button
            class="gallery-nav absolute top-1/2 -translate-y-1/2 right-2 w-8 h-8 rounded-full border-none bg-[#0a0f28]/55 text-white text-lg leading-none flex items-center justify-center cursor-pointer transition-all hover:bg-[#0a0f28]/80 hover:scale-105"
            id="galleryNext"
            aria-label="Foto berikutnya">
            ›
          </button>
          <div
            class="absolute bottom-2 left-0 right-0 flex justify-center gap-1.5"
            id="galleryDots"></div>
        </div>
        <div
          class="flex justify-between py-2.5 border-b border-border text-[13px]">
          <span class="text-ink-400 font-semibold">Kategori</span>
          <span class="text-ink-900 font-bold" id="detailKategori">-</span>
        </div>
        <div
          class="flex justify-between py-2.5 border-b border-border text-[13px]">
          <span class="text-ink-400 font-semibold">Lantai</span>
          <span class="text-ink-900 font-bold" id="detailLantai">-</span>
        </div>
        <p
          class="text-[13.5px] text-ink-600 leading-[1.7] mt-3.5 mb-0"
          id="detailDesc">
          -
        </p>
        <div class="flex gap-2.5 mt-5">
          <button
            class="flex-1 text-center bg-bg text-ink-900 font-bold text-[13px] py-3 rounded-xl border border-border cursor-pointer"
            id="detailCloseBtn">
            Tutup
          </button>
          <a
            class="flex-1 text-center bg-navy-900 text-white font-bold text-[13px] py-3 rounded-xl border-none cursor-pointer no-underline inline-block"
            id="detailRuteBtn"
            href="#"
            target="_blank"
            rel="noopener noreferrer">Lihat Rute</a>
        </div>
      </div>
    </div>
  </div>

  <footer
    class="bg-[#0d1735] px-4 sm:px-8 md:px-12 py-7 flex flex-wrap justify-between items-center gap-3.5 mt-10 pb-[calc(74px+16px)] md:pb-7">
    <p class="text-[13px] text-[#4a6a9f] m-0">
      © 2026 PKKMB-KT UNILAM. Semua hak dilindungi.
    </p>
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

  <nav
    class="fixed bottom-0 left-0 right-0 h-[74px] bg-surface border-t border-border flex items-center justify-around px-1.5 pb-[env(safe-area-inset-bottom)] z-30 md:hidden"
    aria-label="Navigasi bawah">
    <a
      href="{{ route('role.student.modul') }}"
      class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline [&.active]:text-navy-900">
      <svg
        class="w-[22px] h-[22px]"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="1.7"
        stroke-linecap="round"
        stroke-linejoin="round">
        <path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
        <path d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z" />
      </svg>
      <span>Modul</span>
    </a>
    <a
      href="{{ route('role.student.leaderboard') }}"
      class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline [&.active]:text-navy-900">
      <svg
        class="w-[22px] h-[22px]"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="1.7"
        stroke-linecap="round"
        stroke-linejoin="round">
        <path
          d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z" />
        <path d="M5 21v-5M12 21v-7M19 21v-4" />
      </svg>
      <span>Leaderboard</span>
    </a>
    <a
      href="{{ route('dashboard') }}"
      class="flex-none flex flex-col items-center justify-center text-white -mt-[30px] bg-navy-900 w-[54px] h-[54px] rounded-full shadow-[0_10px_24px_rgba(21,33,89,0.16)] no-underline [&>span]:hidden"
      aria-label="Beranda">
      <svg
        class="w-6 h-6"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="1.8"
        stroke-linecap="round"
        stroke-linejoin="round">
        <path d="M4 11.5 12 4l8 7.5" />
        <path
          d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10" />
      </svg>
      <span>Beranda</span>
    </a>
    <a
      href="{{ route('role.student.info') }}"
      class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline [&.active]:text-navy-900">
      <svg
        class="w-[22px] h-[22px]"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="1.7"
        stroke-linecap="round"
        stroke-linejoin="round">
        <path
          d="M9 17H4l1.4-1.4A2 2 0 0 0 6 14.2V11a6 6 0 1 1 12 0v3.2c0 .5.2 1 .6 1.4L20 17h-5" />
        <path d="M9 17a3 3 0 0 0 6 0" />
      </svg>
      <span>Info</span>
    </a>
    <a
      href="{{ route('role.student.profil') }}"
      class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline [&.active]:text-navy-900">
      <svg
        class="w-[22px] h-[22px]"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="1.7"
        stroke-linecap="round"
        stroke-linejoin="round">
        <circle cx="12" cy="8" r="3.4" />
        <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
      </svg>
      <span>Profil</span>
    </a>
  </nav>

  <script>
    // ======================================================================
    // ►► DATA LOKASI KAMPUS — TAMBAH / EDIT DI SINI (tidak berubah dari versi
    //    sebelumnya; lihat komentar detail di masing-masing field).
    // ======================================================================
    const lokasiKampus = [{
        id: "gerbang",
        nama: "Gerbang",
        kategori: "fasilitas",
        lantai: "-",
        top: 81.4,
        left: 58.2,
        topMobile: 81.2,
        leftMobile: 59.3,
        icon: "fa-door-open",
        mapUrl: "https://maps.app.goo.gl/MBPQcipRZC3NZxuv8",
        desc: "Pintu masuk utama menuju area kampus UNILAM.",
        fotos: ["{{ asset('gambar/Peta/Gerbang.jpeg') }}"]
      },
      {
        id: "gedung-utama",
        nama: "Gedung Utama (GU)",
        kategori: "gedung",
        lantai: "3 Lantai",
        top: 59.7,
        left: 78.7,
        topMobile: 57.9,
        leftMobile: 79.4,
        icon: "fa-building",
        mapsUrl: "https://maps.app.goo.gl/ycUFd26rhdKD292i6",
        desc: "Berisi ruang kuliah FTI, FKES, FEB, FKIP, Perpustakaan, BAAK, BAUM, Kemahasiswaan & Alumni, hingga ruang kerja sama dan Warek.",
        fotos: ["{{ asset('gambar/Peta/GedungUtama.jpeg') }}"]
      },
      {
        id: "gedung-rektor",
        nama: "Gedung Rektor",
        kategori: "gedung",
        lantai: "1 Lantai",
        top: 43.7,
        left: 88.0,
        topMobile: 40.7,
        leftMobile: 89.5,
        icon: "fa-user-tie",
        mapsUrl: "https://maps.app.goo.gl/V7gXRZceAq7e9tct7",
        desc: "Ruang dosen dan ruang kerja pimpinan rektorat.",
        fotos: ["{{ asset('gambar/Peta/GedungRektor.jpeg') }}"]
      },
      {
        id: "gedung-d",
        nama: "Gedung D",
        kategori: "gedung",
        lantai: "3 Lantai",
        top: 43.8,
        left: 94.5,
        topMobile: 42.4,
        leftMobile: 96.59,
        icon: "fa-building",
        mapsUrl: "https://maps.app.goo.gl/V7gXRZceAq7e9tct7",
        desc: "Ruang kelas D101–D203 beserta ruang dosen.",
        fotos: ["{{ asset('gambar/Peta/GedungD.jpeg') }}"]
      },
      {
        id: "gedung-c",
        nama: "Gedung C",
        kategori: "gedung",
        lantai: "2 Lantai",
        top: 20.3,
        left: 70.0,
        topMobile: 19.2,
        leftMobile: 71.4,
        icon: "fa-building",
        mapsUrl: "https://maps.app.goo.gl/P8XqX28CNXHby38f9",
        desc: "Ruang kelas C101–C205 beserta ruang dosen.",
        fotos: ["{{ asset('gambar/Peta/GedungC.jpeg') }}"]
      },
      {
        id: "gedung-e",
        nama: "Gedung E",
        kategori: "gedung",
        lantai: "1 Lantai",
        top: 30.6,
        left: 93.0,
        topMobile: 31.8,
        leftMobile: 94.7,
        icon: "fa-building",
        mapsUrl: "https://maps.app.goo.gl/V7gXRZceAq7e9tct7",
        desc: "Ruang kelas E101–E105.",
        fotos: ["{{ asset('gambar/Peta/GedungE.jpeg') }}"]
      },
      {
        id: "gedung-b",
        nama: "Gedung B",
        kategori: "gedung",
        lantai: "2 Lantai",
        top: 28.5,
        left: 49.3,
        topMobile: 26.6,
        leftMobile: 50.8,
        icon: "fa-building",
        mapsUrl: "https://maps.app.goo.gl/JiN2YzUsy4GUxymk9",
        desc: "Lab Jaringan, Lab Office, Ruang Operator, Lab Bidan, dan ruang kelas B101–B103.",
        fotos: ["{{ asset('gambar/Peta/GedungB.jpeg') }}"]
      },
      {
        id: "gedung-a",
        nama: "Gedung A",
        kategori: "gedung",
        lantai: "2 Lantai",
        top: 28.8,
        left: 17.6,
        topMobile: 26.1,
        leftMobile: 19.4,
        icon: "fa-building",
        mapsUrl: "https://maps.app.goo.gl/dZ4f7UFTHPiXRTDs7",
        desc: "Ruang kelas A101–A206 beserta ruang dosen.",
        fotos: ["{{ asset('gambar/Peta/GedungA.jpeg') }}"]
      },
      {
        id: "hall",
        nama: "Hall",
        kategori: "fasilitas",
        lantai: "-",
        top: 29.0,
        left: 75.6,
        topMobile: 28.7,
        leftMobile: 76.3,
        icon: "fa-people-roof",
        mapsUrl: "https://maps.app.goo.gl/nNcymRQvDA8oK98X9",
        desc: "Aula serbaguna untuk acara dan kegiatan besar kampus.",
        fotos: ["{{ asset('gambar/Peta/Hall.jpeg') }}"]
      },
      {
        id: "wisma-hall",
        nama: "Wisma Hall",
        kategori: "fasilitas",
        lantai: "-",
        top: 21.5,
        left: 80.4,
        topMobile: 20.2,
        leftMobile: 81.9,
        icon: "fa-hotel",
        mapsUrl: "https://maps.app.goo.gl/EoyvSJKDSNYGehZM8",
        desc: "Wisma / penginapan tamu di area Hall.",
        fotos: ["{{ asset('gambar/Peta/Wisma Hall.jpeg') }}"]
      },
      {
        id: "asrama",
        nama: "Asrama",
        kategori: "fasilitas",
        lantai: "-",
        top: 26.4,
        left: 42.0,
        topMobile: 25.5,
        leftMobile: 43.8,
        icon: "fa-bed",
        mapsUrl: "https://maps.app.goo.gl/vj21sy7fqoQvcr8m8",
        desc: "Tempat tinggal mahasiswa yang tinggal di lingkungan kampus.",
        fotos: ["{{ asset('gambar/Peta/Asrama.jpeg') }}"]
      },
      {
        id: "masjid",
        nama: "Masjid",
        kategori: "fasilitas",
        lantai: "-",
        top: 51.2,
        left: 42.1,
        topMobile: 48.7,
        leftMobile: 42.9,
        icon: "fa-mosque",
        mapsUrl: "https://maps.app.goo.gl/y54KYaheSWAk9WeM8",
        desc: "Masjid kampus untuk kegiatan ibadah civitas akademika.",
        fotos: ["{{ asset('gambar/Peta/Masjid.jpeg') }}"]
      },
      {
        id: "pmb-lkms",
        nama: "PMB / LKMS",
        kategori: "fasilitas",
        lantai: "-",
        top: 41.7,
        left: 49.1,
        topMobile: 40.8,
        leftMobile: 50.7,
        icon: "fa-building-columns",
        mapsUrl: "https://maps.app.goo.gl/Cs95mdjqwHF5tgYp6",
        desc: "Kantor Penerimaan Mahasiswa Baru dan LKMS.",
        fotos: ["{{ asset('gambar/Peta/LKMS.jpeg') }}"]
      },
      {
        id: "food-court",
        nama: "Food Court Unilam",
        kategori: "fasilitas",
        lantai: "-",
        top: 49.4,
        left: 73.0,
        topMobile: 49.3,
        leftMobile: 70.7,
        icon: "fa-utensils",
        mapsUrl: "https://maps.app.goo.gl/PWhyG9F517Rcwppx5",
        desc: "Area kantin dan tempat makan mahasiswa.",
        fotos: ["{{ asset('gambar/Peta/FoodCourt.jpeg') }}"]
      },
      {
        id: "lapangan-voli",
        nama: "Lapangan Bola Voli",
        kategori: "fasilitas",
        lantai: "-",
        top: 59.0,
        left: 49.1,
        topMobile: 59.1,
        leftMobile: 51.0,
        icon: "fa-volleyball",
        mapsUrl: "https://maps.app.goo.gl/eAaspu2C7dKtssqy7",
        desc: "Lapangan olahraga bola voli kampus.",
        fotos: ["{{ asset('gambar/Peta/LapanganBolaVoli.jpeg') }}"]
      },
      {
        id: "lapangan-putsal",
        nama: "Lapangan Putsal",
        kategori: "fasilitas",
        lantai: "-",
        top: 59.0,
        left: 41.7,
        topMobile: 59.1,
        leftMobile: 44.4,
        icon: "fa-futbol",
        mapsUrl: "https://maps.app.goo.gl/eAaspu2C7dKtssqy7",
        desc: "Lapangan olahraga futsal kampus.",
        fotos: ["{{ asset('gambar/Peta/LapanganBola.jpeg') }}"]
      },
      {
        id: "parkir-mobil",
        nama: "Parkir Mobil",
        kategori: "parkir",
        lantai: "-",
        top: 70.2,
        left: 79.0,
        topMobile: 70.0,
        leftMobile: 75.2,
        icon: "fa-square-parking",
        mapsUrl: "https://maps.app.goo.gl/ZhKLZPcFxYDbWMpV6",
        desc: "Area parkir kendaraan roda empat.",
        fotos: ["{{ asset('gambar/Peta/ParkirMobil.jpeg') }}"]
      },
      {
        id: "parkir-motor",
        nama: "Parkir Motor",
        kategori: "parkir",
        lantai: "-",
        top: 76.7,
        left: 78.7,
        topMobile: 74.4,
        leftMobile: 80.7,
        icon: "fa-motorcycle",
        mapsUrl: "https://maps.app.goo.gl/ZhKLZPcFxYDbWMpV6",
        desc: "Area parkir kendaraan roda dua.",
        fotos: ["{{ asset('gambar/Peta/ParkirMobil.jpeg') }}"]
      },
      {
        id: "parkir-motormahasiswa",
        nama: "Parkir Mobil",
        kategori: "parkir",
        lantai: "-",
        top: 43.0,
        left: 73.0,
        topMobile: 43.0,
        leftMobile: 75.7,
        icon: "fa-square-parking",
        mapsUrl: "https://maps.app.goo.gl/ZhKLZPcFxYDbWMpV6",
        desc: "Area parkir kendaraan roda empat.",
        fotos: ["{{ asset('gambar/Peta/ParkirMotor.jpeg') }}"]
      },
    ];

    // Warna kategori memakai token Tailwind kustom (lihat @theme di <head>)
    const kategoriColor = {
      gedung: "#16a0a1", // teal-500
      fasilitas: "#a9c73b", // lime-500
      parkir: "#2a4bb0", // navy-600
    };
    const kategoriLabel = {
      gedung: "Gedung / Ruang Kelas",
      fasilitas: "Fasilitas Umum",
      parkir: "Area Parkir",
    };

    $(function() {
      // ►► Batas mode HP vs desktop — SAMA dengan breakpoint md: (768px) di
      // Tailwind, supaya konsisten dengan tampilan lainnya.
      function isMobileViewport() {
        return $(window).width() < 768;
      }

      function getEffectiveTop(loc) {
        return isMobileViewport() && loc.topMobile != null ?
          loc.topMobile :
          loc.top;
      }

      function getEffectiveLeft(loc) {
        return isMobileViewport() && loc.leftMobile != null ?
          loc.leftMobile :
          loc.left;
      }

      const $mapImageWrap = $("#mapImageWrap");
      const $mapLocList = $("#mapLocList");
      const $mapSearchInput = $("#mapSearchInput");

      // Kelas utility Tailwind dipusatkan di sini supaya tidak diulang-ulang
      // di setiap template string di bawah.
      const LOC_ITEM_CLASS =
        "map-loc-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl border border-transparent bg-transparent cursor-pointer text-left w-full font-sans transition-colors hover:bg-bg [&.active]:bg-teal-tint [&.active]:border-teal-500";
      const LOC_ICON_CLASS =
        "flex-shrink-0 w-8 h-8 rounded-[10px] flex items-center justify-center text-[13px] text-white";
      const LOC_NAME_CLASS = "text-[13px] font-bold text-ink-900 block";
      const LOC_CAT_CLASS = "text-[10.5px] text-ink-400 block";

      function renderSidebar(filterKeyword = "") {
        const keyword = filterKeyword.trim().toLowerCase();
        const html = lokasiKampus
          .filter((loc) => loc.nama.toLowerCase().includes(keyword))
          .map(
            (loc) => `
                <button class="${LOC_ITEM_CLASS}" data-id="${loc.id}">
                  <span class="${LOC_ICON_CLASS}" style="background:${kategoriColor[loc.kategori]}">
                    <i class="fa-solid ${loc.icon}"></i>
                  </span>
                  <span>
                    <span class="${LOC_NAME_CLASS}">${loc.nama}</span>
                    <span class="${LOC_CAT_CLASS}">${kategoriLabel[loc.kategori]}</span>
                  </span>
                </button>
              `,
          )
          .join("");

        $mapLocList.html(html);

        $mapLocList.find(".map-loc-item").on("click", function() {
          bukaDetail($(this).data("id"));
        });
      }

      const PIN_CLASS =
        "map-pin absolute -translate-x-1/2 -translate-y-full rotate-[-45deg] origin-bottom w-[30px] h-[30px] rounded-[50%_50%_50%_0] border-[2.5px] border-white shadow-[0_10px_24px_rgba(21,33,89,0.16)] flex items-center justify-center text-white text-xs cursor-pointer transition-transform transition-colors duration-150 [touch-action:none] hover:bg-navy-900 hover:scale-[1.12] [&.active]:bg-navy-900 [&.active]:scale-[1.12]";

      function renderPins() {
        $mapImageWrap.find(".map-pin").remove();

        lokasiKampus.forEach((loc) => {
          const $pin = $("<button>")
            .addClass(PIN_CLASS)
            .attr("id", `pin-${loc.id}`)
            .attr("aria-label", loc.nama)
            .attr("data-id", loc.id)
            .css({
              top: `${getEffectiveTop(loc)}%`,
              left: `${getEffectiveLeft(loc)}%`,
              background: kategoriColor[loc.kategori],
            })
            .html(`<span class="block rotate-45"><i class="fa-solid ${loc.icon}"></i></span>`)
            .on("click", () => bukaDetail(loc.id));

          $mapImageWrap.append($pin);
        });
      }

      // Render ulang pin saat layar berpindah antara mode HP <-> desktop
      let resizeTimer;
      $(window).on("resize", () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(renderPins, 200);
      });

      const $mapDetail = $("#mapDetail");
      const $detailTitle = $("#detailTitle");
      const $detailKategori = $("#detailKategori");
      const $detailLantai = $("#detailLantai");
      const $detailDesc = $("#detailDesc");
      const $detailRuteBtn = $("#detailRuteBtn");

      // ======================================================================
      // ►► GALERI FOTO
      // ======================================================================
      const $galleryTrack = $("#detailGalleryTrack");
      const $galleryDotsWrap = $("#galleryDots");
      const $galleryPrevBtn = $("#galleryPrev");
      const $galleryNextBtn = $("#galleryNext");
      let currentGalleryImages = [];
      let currentGalleryIndex = 0;

      function renderGallery(images) {
        currentGalleryImages = images;
        currentGalleryIndex = 0;

        $galleryTrack.html(
          images
          .map(
            (src) =>
            `<img class="gallery-img w-full h-full object-cover flex-shrink-0" src="${src}" alt="Foto lokasi" />`,
          )
          .join(""),
        );

        $galleryDotsWrap.html(
          images
          .map(
            (_, i) =>
            `<button type="button" class="gallery-dot w-1.5 h-1.5 rounded-full cursor-pointer transition-all border-none p-0" data-i="${i}" aria-label="Foto ke-${i + 1}"></button>`,
          )
          .join(""),
        );

        const multiple = images.length > 1;
        $galleryPrevBtn.css("display", multiple ? "flex" : "none");
        $galleryNextBtn.css("display", multiple ? "flex" : "none");
        $galleryDotsWrap.css("display", multiple ? "flex" : "none");

        updateGalleryPosition();
      }

      function updateGalleryPosition() {
        $galleryTrack.css("transform", `translateX(-${currentGalleryIndex * 100}%)`);
        $galleryDotsWrap.find(".gallery-dot").each(function(i) {
          const isActive = i === currentGalleryIndex;
          $(this)
            .toggleClass("bg-white", isActive)
            .toggleClass("scale-125", isActive)
            .toggleClass("bg-white/55", !isActive);
        });
      }

      $galleryPrevBtn.on("click", () => {
        currentGalleryIndex =
          (currentGalleryIndex - 1 + currentGalleryImages.length) %
          currentGalleryImages.length;
        updateGalleryPosition();
      });
      $galleryNextBtn.on("click", () => {
        currentGalleryIndex =
          (currentGalleryIndex + 1) % currentGalleryImages.length;
        updateGalleryPosition();
      });
      $galleryDotsWrap.on("click", ".gallery-dot", function() {
        currentGalleryIndex = parseInt($(this).data("i"), 10);
        updateGalleryPosition();
      });

      function bukaDetail(id) {
        const loc = lokasiKampus.find((l) => l.id === id);
        if (!loc) return;

        $(".map-pin.active, .map-loc-item.active").removeClass("active");
        $(`#pin-${id}`).addClass("active");
        $(`.map-loc-item[data-id="${id}"]`).addClass("active");

        $detailTitle.html(`<i data-lucide="map-pin"></i> ${loc.nama}`);
        $detailKategori.text(kategoriLabel[loc.kategori]);
        $detailLantai.text(loc.lantai);
        $detailDesc.text(loc.desc);

        const fotos =
          loc.fotos && loc.fotos.length ?
          loc.fotos :
          [
            `https://placehold.co/700x420/16a0a1/ffffff?text=${encodeURIComponent(loc.nama)}`,
          ];
        renderGallery(fotos);

        $detailRuteBtn.attr(
          "href",
          loc.mapsUrl ||
          `https://www.google.com/maps/search/?api=1&query=Universitas+La+Tansa+Mashiro+${encodeURIComponent(loc.nama)}`,
        );

        $mapDetail.addClass("open");
        lucide.createIcons();
      }

      function tutupDetail() {
        $mapDetail.removeClass("open");
        $(".map-pin.active, .map-loc-item.active").removeClass("active");
      }

      $("#detailClose").on("click", tutupDetail);
      $("#detailCloseBtn").on("click", tutupDetail);
      $mapDetail.on("click", function(e) {
        if (e.target === this) tutupDetail();
      });

      $mapSearchInput.on("input", function() {
        renderSidebar($(this).val());
      });

      renderSidebar();
      renderPins();
      lucide.createIcons();

      // ======================================================================
      // ►► TOGGLE MODE PIN
      // ======================================================================
      const $mapPinMode = $("#mapPinMode");
      const $mapPinModeLabel = $("#mapPinModeLabel");
      let pinsVisible = true;

      $mapPinMode.on("click", () => {
        pinsVisible = !pinsVisible;
        $mapImageWrap.toggleClass("pins-hidden", !pinsVisible);
        $mapPinMode.toggleClass("pins-on", pinsVisible);
        $mapPinModeLabel.text(pinsVisible ? "Pakai Pin" : "Tanpa Pin");
      });

      // ======================================================================
      // ►► HERO SLIDESHOW
      // ======================================================================
      const heroSlideImages = [
        "{{ asset('gambar/gedungutama.jpeg') }}",
        "{{ asset('gambar/rektor.jpeg') }}",
        "{{ asset('gambar/gedung.jpeg') }}",
      ];
      const HERO_SLIDE_INTERVAL_MS = 6000;
      const $heroSlideshow = $("#heroSlideshow");
      const HERO_SLIDE_BASE_CLASS =
        "hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-[1800ms] ease-in-out";
      if ($heroSlideshow.length && heroSlideImages.length) {
        heroSlideImages.forEach((src, i) => {
          $("<div>")
            .addClass(`${HERO_SLIDE_BASE_CLASS} ${i === 0 ? "opacity-100" : "opacity-0"}`)
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