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

    .board-scroll::-webkit-scrollbar {
      width: 5px;
    }

    .board-scroll::-webkit-scrollbar-track {
      background: transparent;
    }

    .board-scroll::-webkit-scrollbar-thumb {
      background: #e1e5f1;
      border-radius: 10px;
    }

    .board-row.hidden {
      display: none;
    }
  </style>
</head>

<body class="font-sans text-ink-900 m-0 p-0 bg-bg antialiased">
  <!-- ============ NAVBAR ============ -->
  <header class="sticky top-0 z-40 flex items-center justify-between gap-4 bg-navy-900 border-b border-white/10" style="padding: 14px clamp(16px, 5vw, 48px);">
    <a
      href="#"
      class="flex items-center gap-2.5 z-50 no-underline"
      aria-label="PKKMB-KT UNILAM Beranda">
      <div class="w-[38px] h-[38px] rounded-full bg-white flex items-center justify-center font-display text-[9px] font-bold text-navy-900 text-center leading-tight flex-shrink-0 overflow-hidden">
        <img src="{{ asset('gambar/unilam.png') }}" alt="Logo UNILAM" class="w-full h-full object-contain" />
      </div>
      <div>
        <strong class="block font-display text-[14.5px] text-white">PKKMB-KT</strong>
        <span class="text-[10.5px] text-[#aeb6e0] tracking-[0.04em]">UNILAM 2026</span>
      </div>
    </a>

    <button
      class="menu-toggle flex flex-col justify-between w-6 h-[18px] bg-transparent border-none cursor-pointer z-50 p-0 md:hidden [&.active_span:nth-child(1)]:translate-y-2 [&.active_span:nth-child(1)]:rotate-45 [&.active_span:nth-child(2)]:opacity-0 [&.active_span:nth-child(3)]:-translate-y-2 [&.active_span:nth-child(3)]:-rotate-45"
      id="menuToggle"
      aria-label="Buka Menu">
      <span class="block w-full h-0.5 bg-white rounded transition-all"></span>
      <span class="block w-full h-0.5 bg-white rounded transition-all"></span>
      <span class="block w-full h-0.5 bg-white rounded transition-all"></span>
    </button>

    <nav
      class="navbar-links flex flex-col fixed top-0 gap-6 w-[280px] h-screen bg-[#0d1735] shadow-[-5px_0_25px_rgba(0,0,0,0.3)] transition-[right] duration-300 md:static md:flex-row md:w-auto md:h-auto md:bg-transparent md:shadow-none md:gap-7 md:transition-none"
      id="navbarLinks"
      style="right: -100%; padding: 100px 32px 32px;">
      <a href="{{ route('role.mentor.modul') }}" class="text-[#c7cce8] text-base md:text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Modul</a>
      <a href="#" class="text-white text-base md:text-[13.5px] font-semibold no-underline border-l-[3px] md:border-l-0 md:border-b-2 border-lime-500 pl-2 md:pl-0 md:pb-0.5">Leaderboard</a>
      <a href="{{ route('dashboard') }}" class="text-[#c7cce8] text-base md:text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Dashboard</a>
      <a href="{{ route('role.mentor.info') }}" class="text-[#c7cce8] text-base md:text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Info</a>
      <a href="{{ route('role.mentor.profil') }}" class="text-[#c7cce8] text-base md:text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Profil</a>
    </nav>
  </header>

  <!-- ============ HERO ============ -->
  <section class="relative overflow-hidden" style="padding: clamp(40px, 7vw, 64px) clamp(16px, 5vw, 48px);">
    <div class="absolute inset-0 z-0 overflow-hidden after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-br after:from-navy-900/90 after:to-teal-600/[0.78]" id="heroSlideshow"></div>

    <div class="relative z-[1] max-w-[900px] mx-auto text-center">
      <div class="inline-flex items-center gap-[7px] bg-lime-500/[0.15] border border-lime-500/[0.35] text-[#c8e46a] text-[11px] font-bold px-3.5 py-[5px] rounded-full mb-4 tracking-[0.06em] uppercase">
        <span class="w-1.5 h-1.5 rounded-full bg-lime-500" style="animation: pulse 2s infinite;"></span>
        Statistik Peserta
      </div>
      <h1 class="font-display text-2xl sm:text-3xl md:text-[38px] font-bold text-white mb-3 leading-[1.2] m-0">Papan Peringkat<br />PKKMB-KT UNILAM 2026</h1>
      <p class="text-sm text-white/75 leading-[1.7] max-w-[520px] mx-auto">
        Pantau posisimu dan lihat siapa yang paling unggul di antara seluruh
        peserta PKKMB-KT.
      </p>
    </div>
  </section>

  <!-- ============ MAIN ============ -->
  <div class="max-w-[560px] mx-auto" style="padding: 32px clamp(16px, 5vw, 48px) calc(74px + 28px);">
    <div class="bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] overflow-hidden">
      <div style="padding: 20px 20px 16px;">
        <div class="grid grid-cols-3 gap-1.5 bg-bg border border-border rounded-[13px]" style="padding: 5px;">
          <button
            id="tab-all"
            class="board-tab active text-center text-[11.5px] font-bold text-ink-600 rounded-[10px] border-none bg-transparent cursor-pointer transition-all hover:text-navy-900 [&.active]:bg-navy-900 [&.active]:text-white [&.active]:shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)]"
            style="padding: 9px 8px;"
            data-kategori="ALL">
            Leaderboard
          </button>
          <button
            id="tab-male"
            class="board-tab text-center text-[11.5px] font-bold text-ink-600 rounded-[10px] border-none bg-transparent cursor-pointer transition-all hover:text-navy-900 [&.active]:bg-navy-900 [&.active]:text-white [&.active]:shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)]"
            style="padding: 9px 8px;"
            data-kategori="L">
            Best Male
          </button>
          <button
            id="tab-female"
            class="board-tab text-center text-[11.5px] font-bold text-ink-600 rounded-[10px] border-none bg-transparent cursor-pointer transition-all hover:text-navy-900 [&.active]:bg-navy-900 [&.active]:text-white [&.active]:shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)]"
            style="padding: 9px 8px;"
            data-kategori="P">
            Best Female
          </button>
        </div>
      </div>

      <div class="board-scroll" style="max-height: 560px; overflow-y: auto; padding: 0 20px 20px;">
        <div id="podium-container"></div>
        <div id="leaderboard-list" class="mt-5 flex flex-col gap-2"></div>
      </div>

      <div class="border-t border-border" style="padding: 16px 20px 20px;">
        <button
          id="btn-load-more"
          class="w-full flex items-center justify-center gap-2 bg-navy-900 text-white text-[12.5px] font-extrabold border-none rounded-[13px] cursor-pointer shadow-[0_10px_24px_rgba(21,33,89,0.16)] transition-[filter] hover:brightness-110 [&_svg]:w-3.5 [&_svg]:h-3.5 [&_i]:w-3.5 [&_i]:h-3.5"
          style="padding: 13px 0;">
          <span id="text-btn-load">Lihat Semua Peringkat</span>
          <i data-lucide="chevron-down"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- ============ FOOTER ============ -->
  <footer class="bg-[#0d1735] flex flex-wrap justify-between items-center gap-3.5 mt-10" style="padding: 28px clamp(16px, 5vw, 48px);">
    <p class="text-[13px] text-[#4a6a9f] m-0">© 2026 PKKMB-KT UNILAM. Semua hak dilindungi.</p>
    <div class="flex gap-5">
      <a href="{{ route('landing.kebijakan-privasi') }}" class="text-[13px] text-[#4a6a9f] no-underline transition-colors hover:text-[#aeb6e0]">Kebijakan Privasi</a>
      <a href="{{ route('landing.syarat-ketentuan') }}" class="text-[13px] text-[#4a6a9f] no-underline transition-colors hover:text-[#aeb6e0]">Syarat &amp; Ketentuan</a>
      <a href="{{ route('landing.bantuan') }}" class="text-[13px] text-[#4a6a9f] no-underline transition-colors hover:text-[#aeb6e0]">Bantuan</a>
    </div>
  </footer>

  <!-- ======= BOTTOM NAV (mobile only) ======= -->
  <nav class="fixed bottom-0 left-0 right-0 h-[74px] bg-surface border-t border-border flex items-center justify-around px-1.5 pb-[env(safe-area-inset-bottom)] z-30 md:hidden" aria-label="Navigasi bawah">
    <a href="{{ route('role.mentor.modul') }}" class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
        <path d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z" />
      </svg>
      <span>Modul</span>
    </a>
    <a href="#" class="flex flex-col items-center gap-1 text-navy-900 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z" />
        <path d="M5 21v-5M12 21v-7M19 21v-4" />
      </svg>
      <span>Leaderboard</span>
    </a>
    <a href="{{ route('dashboard') }}" class="flex-none flex flex-col items-center justify-center text-white -mt-[30px] bg-navy-900 w-[54px] h-[54px] rounded-full shadow-[0_10px_24px_rgba(21,33,89,0.16)] no-underline [&>span]:hidden" aria-label="Beranda">
      <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 11.5 12 4l8 7.5" />
        <path d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10" />
      </svg>
      <span>Beranda</span>
    </a>
    <a href="{{ route('role.mentor.info') }}" class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 17H4l1.4-1.4A2 2 0 0 0 6 14.2V11a6 6 0 1 1 12 0v3.2c0 .5.2 1 .6 1.4L20 17h-5" />
        <path d="M9 17a3 3 0 0 0 6 0" />
      </svg>
      <span>Info</span>
    </a>
    <a href="{{ route('role.mentor.profil') }}" class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="8" r="3.4" />
        <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
      </svg>
      <span>Profil</span>
    </a>
  </nav>

  <script>
    $(function() {
      // 1. DATA MASTER KESELURUHAN (Satu wadah berisi data Cowok (L) dan Cewek (P))
      const dataMahasiswa = [{
          nama: "Ricky Maulana",
          skor: 92,
          gender: "L"
        },
        {
          nama: "Andi Saputra",
          skor: 89,
          gender: "L"
        },
        {
          nama: "Siti Aisyah",
          skor: 88,
          gender: "P"
        },
        {
          nama: "Muhammad Farhan",
          skor: 87,
          gender: "L"
        },
        {
          nama: "Dinda Aprilia",
          skor: 86,
          gender: "P"
        },
        {
          nama: "Fajar Nugroho",
          skor: 85,
          gender: "L"
        },
        {
          nama: "Nabila Putri",
          skor: 84,
          gender: "P"
        },
        {
          nama: "Eko Prasetyo",
          skor: 83,
          gender: "L"
        },
        {
          nama: "Dewi Lestari",
          skor: 82,
          gender: "P"
        },
        {
          nama: "Rian Hidayat",
          skor: 81,
          gender: "L"
        },
        {
          nama: "Siti Nurjanah",
          skor: 80,
          gender: "P"
        },
        {
          nama: "Agus Setiawan",
          skor: 79,
          gender: "L"
        },
        {
          nama: "Mega Utami",
          skor: 78,
          gender: "P"
        },
        {
          nama: "Salman Alfarisi",
          skor: 77,
          gender: "L"
        },
        {
          nama: "Aisyah Nurul Isaa",
          skor: 76,
          gender: "P"
        },
        {
          nama: "Hendra Wijaya",
          skor: 75,
          gender: "L"
        },
        {
          nama: "Fitriani",
          skor: 74,
          gender: "P"
        },
        {
          nama: "Dimas Maulana",
          skor: 73,
          gender: "L"
        },
        {
          nama: "Anisa Fitri",
          skor: 72,
          gender: "P"
        },
      ];

      let kategoriAktif = "ALL";
      let statusLimit = true;

      const PODIUM_AVATAR_WRAP = "relative mb-2";
      const PODIUM_NAME = "text-[11.5px] font-bold text-ink-900 leading-[1.3] whitespace-nowrap overflow-hidden text-ellipsis";
      const PODIUM_SCORE = "text-[11px] font-extrabold mt-0.5";
      const PODIUM_BLOCK = "w-full mt-2.5 rounded-t-xl flex items-center justify-center";
      const PODIUM_BLOCK_SPAN = "font-display font-bold";

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

        const $podiumContainer = $("#podium-container");
        $podiumContainer.html(`
            <div class="flex justify-center items-end gap-2 text-center max-w-[380px] mx-auto" style="padding-top: 26px;">
              <div class="flex-1 flex flex-col items-center">
                <div class="${PODIUM_AVATAR_WRAP}">
                  <div class="rounded-full bg-white flex items-center justify-center overflow-hidden text-[13px] w-14 h-14 border-2 border-border p-0.5">
                    <div style="width:100%;height:100%;border-radius:50%;background:var(--bg);display:flex;align-items:center;justify-content:center;">${juara2.gender === "L" ? "👦" : "👧"}</div>
                  </div>
                  <span class="absolute -bottom-[3px] -right-[3px] text-white rounded-full flex items-center justify-center font-extrabold border-2 border-white w-5 h-5 text-[10px] bg-ink-400">2</span>
                </div>
                <p class="${PODIUM_NAME} max-w-[96px]">${juara2.nama}</p>
                <p class="${PODIUM_SCORE} text-teal-600">${juara2.skor}</p>
                <div class="${PODIUM_BLOCK} h-14 border-t border-border" style="background: linear-gradient(to top, var(--bg), var(--surface));"><span class="${PODIUM_BLOCK_SPAN} text-[24px] text-ink-400">2</span></div>
              </div>

              <div class="flex-1 flex flex-col items-center z-[1] -translate-y-2">
                <i data-lucide="crown" class="text-gold-500 mb-0.5"></i>
                <div class="${PODIUM_AVATAR_WRAP}">
                  <div class="rounded-full bg-white flex items-center justify-center overflow-hidden text-[13px] w-[72px] h-[72px] border-[3px] border-gold-500 p-0.5 shadow-[0_10px_24px_rgba(21,33,89,0.16)]">
                    <div style="width:100%;height:100%;border-radius:50%;background:var(--gold-tint);display:flex;align-items:center;justify-content:center;">${juara1.gender === "L" ? "👑" : "👸"}</div>
                  </div>
                  <span class="absolute -bottom-[3px] -right-[3px] text-white rounded-full flex items-center justify-center font-extrabold border-2 border-white w-6 h-6 text-[11px] bg-gold-500">1</span>
                </div>
                <p class="${PODIUM_NAME} font-extrabold max-w-[110px]">${juara1.nama}</p>
                <p class="${PODIUM_SCORE} text-gold-500 text-[12.5px]">${juara1.skor}</p>
                <div class="${PODIUM_BLOCK} h-[88px]" style="background: linear-gradient(to top, var(--gold-tint), #fffdf5); border-top: 2px solid rgba(212, 160, 23, 0.35);"><span class="${PODIUM_BLOCK_SPAN} text-[38px]" style="color: rgba(212, 160, 23, 0.55);">1</span></div>
              </div>

              <div class="flex-1 flex flex-col items-center">
                <div class="${PODIUM_AVATAR_WRAP}">
                  <div class="rounded-full bg-white flex items-center justify-center overflow-hidden text-[13px] w-14 h-14 p-0.5" style="border: 2px solid rgba(169, 116, 58, 0.4);">
                    <div style="width:100%;height:100%;border-radius:50%;background:rgba(169,116,58,0.08);display:flex;align-items:center;justify-content:center;">${juara3.gender === "L" ? "👦" : "👧"}</div>
                  </div>
                  <span class="absolute -bottom-[3px] -right-[3px] text-white rounded-full flex items-center justify-center font-extrabold border-2 border-white w-5 h-5 text-[10px] bg-bronze-500">3</span>
                </div>
                <p class="${PODIUM_NAME} max-w-[96px]">${juara3.nama}</p>
                <p class="${PODIUM_SCORE} text-teal-600">${juara3.skor}</p>
                <div class="${PODIUM_BLOCK} h-10 border-t border-border" style="background: linear-gradient(to top, var(--bg), var(--surface));"><span class="${PODIUM_BLOCK_SPAN} text-xl text-ink-400">3</span></div>
              </div>
            </div>
          `);

        const $listContainer = $("#leaderboard-list");
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

          const kelasHidden = statusLimit && indeks >= 4 ? "hidden" : "";

          const $itemRow = $("<div>")
            .addClass(`board-row ${kelasHidden} flex items-center justify-between bg-bg border border-border rounded-[13px] transition-colors hover:border-teal-500`)
            .css("padding", "12px 14px")
            .html(`
                <div class="flex items-center gap-2.5">
                  <span class="w-[18px] text-center font-display text-[11px] font-bold text-ink-400">${nomorPeringkat}</span>
                  <div class="w-[30px] h-[30px] rounded-full bg-navy-tint text-navy-900 text-[10.5px] font-extrabold flex items-center justify-center">${inisial}</div>
                  <span class="text-[12.5px] font-bold text-ink-900">${mhs.nama}</span>
                </div>
                <span class="text-[12.5px] font-extrabold text-teal-600">${mhs.skor}</span>
              `);
          $listContainer.append($itemRow);
        });

        const $btnLoad = $("#btn-load-more");
        if (!statusLimit || sisaData.length <= 4) {
          $btnLoad.css("display", "none");
        } else {
          $btnLoad.css("display", "flex");
          $("#text-btn-load").text(`Lihat Semua Peringkat (${dataFilter.length})`);
        }

        lucide.createIcons();
      }

      function ubahKategori(kategori) {
        kategoriAktif = kategori;
        statusLimit = true;

        $("#tab-all, #tab-male, #tab-female").removeClass("active");

        if (kategori === "ALL") {
          $("#tab-all").addClass("active");
        } else if (kategori === "L") {
          $("#tab-male").addClass("active");
        } else if (kategori === "P") {
          $("#tab-female").addClass("active");
        }

        renderLeaderboard();
      }

      $("#tab-all, #tab-male, #tab-female").on("click", function() {
        ubahKategori($(this).data("kategori"));
      });

      $("#btn-load-more").on("click", function() {
        statusLimit = false;
        renderLeaderboard();
      });

      // Navbar hamburger toggle (mobile)
      $("#menuToggle").on("click", function() {
        $(this).toggleClass("active");
        const $links = $("#navbarLinks");
        $links.toggleClass("active");
        $links.css("right", $links.hasClass("active") ? "0" : "-100%");
      });

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO
      // ======================================================================
      const heroSlideImages = [
        "/Gambar/gedungutama.jpeg",
        "/Gambar/rektor.jpeg",
        "/Gambar/gedung.jpeg"
      ];
      const HERO_SLIDE_INTERVAL_MS = 6000;
      const $heroSlideshow = $("#heroSlideshow");
      if ($heroSlideshow.length && heroSlideImages.length) {
        heroSlideImages.forEach((src, i) => {
          $("<div>")
            .addClass("hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-[1800ms] ease-in-out")
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

      // Load pertama kali saat jendela browser terbuka
      renderLeaderboard();
    });
  </script>
</body>

</html>