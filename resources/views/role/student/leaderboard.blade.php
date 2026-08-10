<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Papan Peringkat | PKKMB-KT UNILAM 2026</title>
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
        --color-gold-500: #d4a017;
        --color-gold-tint: #fdf6e3;
        --color-bronze-500: #a9743a;
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

    .scroll-thin::-webkit-scrollbar {
      width: 5px;
    }

    .scroll-thin::-webkit-scrollbar-track {
      background: transparent;
    }

    .scroll-thin::-webkit-scrollbar-thumb {
      background: #e1e5f1;
      border-radius: 10px;
    }
  </style>
</head>

<body class="font-sans text-ink-900 m-0 p-0 bg-bg antialiased">
  <!-- ============ NAVBAR — IDENTIK HALAMAN LAIN ============ -->
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
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Modul</a>
      <a
        href="#"
        class="text-white text-[13.5px] font-semibold no-underline border-b-2 border-lime-500 pb-0.5">Leaderboard</a>
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
    class="relative overflow-hidden px-4 sm:px-8 md:px-12 py-10 sm:py-14 md:py-16">
    <div
      class="absolute inset-0 z-0 overflow-hidden after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-br after:from-navy-900/90 after:to-teal-600/[0.78]"
      id="heroSlideshow"></div>

    <div class="relative z-[1] max-w-[900px] mx-auto text-center">
      <div
        class="inline-flex items-center gap-[7px] bg-lime-500/[0.15] border border-lime-500/[0.35] text-[#c8e46a] text-[11px] font-bold px-3.5 py-[5px] rounded-full mb-4 tracking-[0.06em] uppercase">
        <span
          class="w-1.5 h-1.5 rounded-full bg-lime-500 animate-[dotpulse_2s_infinite]"></span>
        Statistik Peserta
      </div>
      <h1
        class="font-display text-2xl sm:text-3xl md:text-[38px] font-bold text-white mb-3 leading-[1.2]">
        Papan Peringkat<br />PKKMB-KT UNILAM 2026
      </h1>
      <p class="text-sm text-white/75 leading-[1.7] max-w-[520px] mx-auto">
        Pantau posisimu dan lihat siapa yang paling unggul di antara
        seluruh peserta PKKMB-KT.
      </p>
    </div>
  </section>

  <!-- ============ MAIN ============ -->
  <div
    class="max-w-[560px] mx-auto px-4 sm:px-8 md:px-12 py-8 pb-[calc(74px+28px)] md:pb-8">
    <div class="bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] overflow-hidden">
      <div class="px-5 pt-5 pb-4">
        <div class="grid grid-cols-3 gap-1.5 bg-bg border border-border p-[5px] rounded-[13px]">
          <button
            id="tab-all"
            data-kategori="ALL"
            class="board-tab text-center text-[11.5px] font-bold text-ink-600 py-[9px] px-2 rounded-[10px] border-none bg-transparent cursor-pointer transition-colors hover:text-navy-900 active bg-navy-900 text-white shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)]">
            Leaderboard
          </button>
          <button
            id="tab-male"
            data-kategori="L"
            class="board-tab text-center text-[11.5px] font-bold text-ink-600 py-[9px] px-2 rounded-[10px] border-none bg-transparent cursor-pointer transition-colors hover:text-navy-900">
            Best Male
          </button>
          <button
            id="tab-female"
            data-kategori="P"
            class="board-tab text-center text-[11.5px] font-bold text-ink-600 py-[9px] px-2 rounded-[10px] border-none bg-transparent cursor-pointer transition-colors hover:text-navy-900">
            Best Female
          </button>
        </div>
      </div>

      <div class="scroll-thin max-h-[560px] overflow-y-auto px-5 pb-5">
        <div id="podium-container"></div>
        <div id="leaderboard-list"></div>
      </div>

      <div class="px-5 pb-5 pt-4 border-t border-border">
        <button
          id="btn-load-more"
          class="w-full flex items-center justify-center gap-2 bg-navy-900 text-white text-[12.5px] font-extrabold py-[13px] border-none rounded-[13px] cursor-pointer shadow-[0_10px_24px_rgba(21,33,89,0.16)] transition-[filter] hover:brightness-[1.12] [&_svg]:w-3.5 [&_svg]:h-3.5 [&_i]:w-3.5 [&_i]:h-3.5">
          <span id="text-btn-load">Lihat Semua Peringkat</span>
          <i data-lucide="chevron-down"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- ============ FOOTER ============ -->
  <footer
    class="bg-[#0d1735] px-4 sm:px-8 md:px-12 py-7 flex flex-wrap justify-between items-center gap-3.5 mt-10 pb-[calc(74px+16px)] md:pb-7">
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
      href="#"
      class="flex flex-col items-center gap-1 text-navy-900 text-[10px] font-bold flex-1 py-1.5 no-underline">
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
        <path d="M9 17H4l1.4-1.4A2 2 0 0 0 6 14.2V11a6 6 0 1 1 12 0v3.2c0 .5.2 1 .6 1.4L20 17h-5" />
        <path d="M9 17a3 3 0 0 0 6 0" />
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
      // 1. DATA MASTER KESELURUHAN -- dari database (SEMUA mahasiswa, bukan cuma 1 kelompok),
      // diurutkan server-side berdasarkan total poin tertinggi.
      const dataMahasiswa = @json($dataMahasiswa);

      let kategoriAktif = "ALL";
      let statusLimit = true;

      const $podiumContainer = $("#podium-container");
      const $listContainer = $("#leaderboard-list");
      const $btnLoad = $("#btn-load-more");

      function renderLeaderboard() {
        let dataFilter = [...dataMahasiswa].sort((a, b) => b.skor - a.skor);

        if (kategoriAktif !== "ALL") {
          dataFilter = dataFilter.filter((mhs) => mhs.gender === kategoriAktif);
        }

        const juara1 = dataFilter[0] || {
          nama: "-",
          skor: 0,
          gender: "L"
        };
        const juara2 = dataFilter[1] || {
          nama: "-",
          skor: 0,
          gender: "L"
        };
        const juara3 = dataFilter[2] || {
          nama: "-",
          skor: 0,
          gender: "L"
        };

        $podiumContainer
          .removeClass()
          .addClass(
            "pt-[26px] flex justify-center items-end gap-2 text-center max-w-[380px] mx-auto"
          )
          .html(`
            <div class="flex-1 flex flex-col items-center">
              <div class="relative mb-2">
                <div class="podium-avatar w-14 h-14 rounded-full bg-white border-2 border-border p-0.5 flex items-center justify-center overflow-hidden text-[13px]">
                  <div class="w-full h-full rounded-full bg-bg flex items-center justify-center">${juara2.gender === "L" ? "👦" : "👧"}</div>
                </div>
                <span class="absolute -bottom-[3px] -right-[3px] w-5 h-5 text-[10px] text-white rounded-full flex items-center justify-center font-extrabold border-2 border-white bg-ink-400">2</span>
              </div>
              <p class="text-[11.5px] font-bold text-ink-900 leading-[1.3] whitespace-nowrap overflow-hidden text-ellipsis max-w-[96px]">${juara2.nama}</p>
              <p class="text-[11px] font-extrabold mt-0.5 text-teal-600">${juara2.skor}</p>
              <div class="w-full mt-2.5 rounded-t-xl flex items-center justify-center h-14 bg-gradient-to-t from-bg to-surface border-t border-border">
                <span class="font-display font-bold text-2xl text-ink-400">2</span>
              </div>
            </div>

            <div class="flex-1 flex flex-col items-center z-[1] -translate-y-2">
              <i data-lucide="crown" class="text-[#d4a017] mb-0.5"></i>
              <div class="relative mb-2">
                <div class="podium-avatar w-[72px] h-[72px] rounded-full bg-white border-[3px] border-[#d4a017] p-0.5 flex items-center justify-center overflow-hidden text-[13px] shadow-[0_10px_24px_rgba(21,33,89,0.16)]">
                  <div class="w-full h-full rounded-full bg-gold-tint flex items-center justify-center">${juara1.gender === "L" ? "👑" : "👸"}</div>
                </div>
                <span class="absolute -bottom-[3px] -right-[3px] w-6 h-6 text-[11px] text-white rounded-full flex items-center justify-center font-extrabold border-2 border-white bg-[#d4a017]">1</span>
              </div>
              <p class="text-[11.5px] font-extrabold text-ink-900 leading-[1.3] whitespace-nowrap overflow-hidden text-ellipsis max-w-[110px]">${juara1.nama}</p>
              <p class="text-[12.5px] font-extrabold mt-0.5 text-[#d4a017]">${juara1.skor}</p>
              <div class="w-full mt-2.5 rounded-t-xl flex items-center justify-center h-[88px] bg-gradient-to-t from-gold-tint to-[#fffdf5] border-t-2 border-[#d4a017]/35">
                <span class="font-display font-bold text-[38px] text-[#d4a017]/55">1</span>
              </div>
            </div>

            <div class="flex-1 flex flex-col items-center">
              <div class="relative mb-2">
                <div class="podium-avatar w-14 h-14 rounded-full bg-white border-2 border-[#a9743a]/40 p-0.5 flex items-center justify-center overflow-hidden text-[13px]">
                  <div class="w-full h-full rounded-full bg-[#a9743a]/[0.08] flex items-center justify-center">${juara3.gender === "L" ? "👦" : "👧"}</div>
                </div>
                <span class="absolute -bottom-[3px] -right-[3px] w-5 h-5 text-[10px] text-white rounded-full flex items-center justify-center font-extrabold border-2 border-white bg-[#a9743a]">3</span>
              </div>
              <p class="text-[11.5px] font-bold text-ink-900 leading-[1.3] whitespace-nowrap overflow-hidden text-ellipsis max-w-[96px]">${juara3.nama}</p>
              <p class="text-[11px] font-extrabold mt-0.5 text-teal-600">${juara3.skor}</p>
              <div class="w-full mt-2.5 rounded-t-xl flex items-center justify-center h-10 bg-gradient-to-t from-bg to-surface border-t border-border">
                <span class="font-display font-bold text-xl text-ink-400">3</span>
              </div>
            </div>
          `);

        $listContainer.empty();

        const sisaData = dataFilter.slice(3);

        sisaData.forEach((mhs, indeks) => {
          const nomorPeringkat = indeks + 4;
          const inisial = mhs.nama
            .split(" ")
            .map((n) => n[0])
            .join("")
            .substring(0, 2)
            .toUpperCase();

          const sembunyikan = statusLimit && indeks >= 4;

          const $row = $(`
              <div class="board-row flex items-center justify-between px-3.5 py-3 bg-bg border border-border rounded-[13px] transition-colors hover:border-teal-500 ${sembunyikan ? "hidden" : ""}">
                <div class="flex items-center gap-2.5">
                  <span class="w-[18px] text-center font-display text-[11px] font-bold text-ink-400">${nomorPeringkat}</span>
                  <div class="w-[30px] h-[30px] rounded-full bg-navy-tint text-navy-900 text-[10.5px] font-extrabold flex items-center justify-center">${inisial}</div>
                  <span class="text-[12.5px] font-bold text-ink-900">${mhs.nama}</span>
                </div>
                <span class="text-[12.5px] font-extrabold text-teal-600">${mhs.skor}</span>
              </div>
            `);
          $listContainer.append($row);
        });

        if (!statusLimit || sisaData.length <= 4) {
          $btnLoad.hide();
        } else {
          $btnLoad.css("display", "flex");
          $("#text-btn-load").text(`Lihat Semua Peringkat (${dataFilter.length})`);
        }

        if (window.lucide) lucide.createIcons();
      }

      function ubahKategori(kategori) {
        kategoriAktif = kategori;
        statusLimit = true;

        $(".board-tab").removeClass("active bg-navy-900 text-white shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)]");

        let $target;
        if (kategori === "ALL") $target = $("#tab-all");
        else if (kategori === "L") $target = $("#tab-male");
        else $target = $("#tab-female");

        $target.addClass("active bg-navy-900 text-white shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)]");

        renderLeaderboard();
      }

      $(".board-tab").on("click", function() {
        ubahKategori($(this).data("kategori"));
      });

      $btnLoad.on("click", function() {
        statusLimit = false;
        renderLeaderboard();
      });

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO
      // ======================================================================
      const heroSlideImages = [
        "{{ asset('gambar/gedungutama.jpeg') }}",
        "{{ asset('gambar/rektor.jpeg') }}",
        "{{ asset('gambar/gedung.jpeg') }}",
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

      // Render pertama kali
      renderLeaderboard();
    });
  </script>
</body>

</html>