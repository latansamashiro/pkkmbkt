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

    @keyframes crownFloat {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-4px);
      }
    }

    .crown-float {
      animation: crownFloat 2.2s ease-in-out infinite;
    }

    @keyframes confettiFall {
      0% {
        transform: translateY(-10px) rotate(0deg);
        opacity: 1;
      }

      100% {
        transform: translateY(220px) rotate(360deg);
        opacity: 0;
      }
    }

    .confetti-piece {
      position: absolute;
      top: 0;
      width: 7px;
      height: 12px;
      pointer-events: none;
      animation: confettiFall 1.6s ease-in forwards;
    }

    @keyframes podiumIn {
      from {
        opacity: 0;
        transform: translateY(10px) scale(.96);
      }

      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    .podium-in {
      animation: podiumIn .45s ease both;
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
  <div id="confettiLayer" style="position:fixed;inset:0 0 auto 0;height:0;overflow:visible;pointer-events:none;z-index:70;"></div>
  @include('layouts.mentor.topnav', ['navActive' => 'leaderboard'])

  <!-- ============ HERO ============ -->
  <section class="relative overflow-hidden" style="padding: clamp(40px, 7vw, 64px) clamp(16px, 5vw, 48px);">
    <div class="absolute inset-0 z-0 overflow-hidden after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-br after:from-navy-900/90 after:to-teal-600/[0.78]" id="heroSlideshow"></div>

    <div class="relative z-[1] max-w-[900px] mx-auto text-center">
      <h1 class="font-display text-2xl sm:text-3xl md:text-[38px] font-bold text-white mb-3 leading-[1.2] m-0">Papan Peringkat<br />PKKMB-KT UNILAM 2026</h1>
      <p class="text-sm text-white/75 leading-[1.7] max-w-[520px] mx-auto">
        Pantau posisimu dan lihat siapa yang paling unggul di antara seluruh
        peserta PKKMB-KT.
      </p>
    </div>
  </section>

  <!-- ============ MAIN ============ -->
  <div class="max-w-[560px] lg:max-w-[720px] mx-auto" style="padding: 32px clamp(16px, 5vw, 48px) calc(74px + 28px);">
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
  @include('layouts.mentor.footer')

  @include('layouts.mentor.bottomnav', ['navActive' => 'leaderboard'])

  <script>
    $(function() {
      // 1. DATA MASTER KESELURUHAN -- dari database (SEMUA mahasiswa, bukan cuma 1 kelompok),
      // diurutkan server-side berdasarkan total poin tertinggi.
      const _rawDataMahasiswa = @json($dataMahasiswa);
      // Jaga-jaga: kalau data dari server ternyata bukan array (mis. cache
      // yang korup/gagal kebaca), jangan sampai seluruh script di halaman
      // ini berhenti gara-gara satu error -- fallback ke array kosong,
      // tampilan tetap jalan (cuma kosong), bukan macet total.
      const dataMahasiswa = Array.isArray(_rawDataMahasiswa) ? _rawDataMahasiswa : [];

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
            <div class="flex justify-center items-end gap-2 text-center max-w-[380px] mx-auto podium-in" style="padding-top: 26px;">
              <div class="flex-1 flex flex-col items-center">
                <div class="${PODIUM_AVATAR_WRAP}">
                  <div class="rounded-full bg-white flex items-center justify-center overflow-hidden text-[13px] w-14 h-14 border-2 border-border p-0.5">
                    <div style="width:100%;height:100%;border-radius:50%;background:#f2f4fa;display:flex;align-items:center;justify-content:center;overflow:hidden;">${juara2.foto ? `<img loading="lazy" src="${juara2.foto}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" style="width:100%;height:100%;object-fit:cover;" alt="${juara2.nama}"><span style="display:none;align-items:center;justify-content:center;width:100%;height:100%;">${juara2.gender === "L" ? "👦" : "👧"}</span>` : (juara2.gender === "L" ? "👦" : "👧")}</div>
                  </div>
                  <span class="absolute -bottom-[3px] -right-[3px] text-white rounded-full flex items-center justify-center font-extrabold border-2 border-white w-5 h-5 text-[10px] bg-ink-400">2</span>
                </div>
                <p class="${PODIUM_NAME} max-w-[96px]">${juara2.nama}</p>
                <p class="${PODIUM_SCORE} text-teal-600">${juara2.skor}</p>
                <div class="${PODIUM_BLOCK} h-14 border-t border-border" style="background: linear-gradient(to top, #f2f4fa, #ffffff);"><span class="${PODIUM_BLOCK_SPAN} text-[24px] text-ink-400">2</span></div>
              </div>

              <div class="flex-1 flex flex-col items-center z-[1] -translate-y-2">
                <i data-lucide="crown" class="text-gold-500 mb-0.5 crown-float"></i>
                <div class="${PODIUM_AVATAR_WRAP}">
                  <div class="rounded-full bg-white flex items-center justify-center overflow-hidden text-[13px] w-[72px] h-[72px] border-[3px] border-gold-500 p-0.5 shadow-[0_10px_24px_rgba(21,33,89,0.16)]">
                    <div style="width:100%;height:100%;border-radius:50%;background:#fdf6e3;display:flex;align-items:center;justify-content:center;overflow:hidden;">${juara1.foto ? `<img loading="lazy" src="${juara1.foto}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" style="width:100%;height:100%;object-fit:cover;" alt="${juara1.nama}"><span style="display:none;align-items:center;justify-content:center;width:100%;height:100%;">${juara1.gender === "L" ? "👑" : "👸"}</span>` : (juara1.gender === "L" ? "👑" : "👸")}</div>
                  </div>
                  <span class="absolute -bottom-[3px] -right-[3px] text-white rounded-full flex items-center justify-center font-extrabold border-2 border-white w-6 h-6 text-[11px] bg-gold-500">1</span>
                </div>
                <p class="${PODIUM_NAME} font-extrabold max-w-[110px]">${juara1.nama}</p>
                <p class="${PODIUM_SCORE} text-gold-500 text-[12.5px]">${juara1.skor}</p>
                <div class="${PODIUM_BLOCK} h-[88px]" style="background: linear-gradient(to top, #fdf6e3, #fffdf5); border-top: 2px solid rgba(212, 160, 23, 0.35);"><span class="${PODIUM_BLOCK_SPAN} text-[38px]" style="color: rgba(212, 160, 23, 0.55);">1</span></div>
              </div>

              <div class="flex-1 flex flex-col items-center">
                <div class="${PODIUM_AVATAR_WRAP}">
                  <div class="rounded-full bg-white flex items-center justify-center overflow-hidden text-[13px] w-14 h-14 p-0.5" style="border: 2px solid rgba(169, 116, 58, 0.4);">
                    <div style="width:100%;height:100%;border-radius:50%;background:rgba(169,116,58,0.08);display:flex;align-items:center;justify-content:center;overflow:hidden;">${juara3.foto ? `<img loading="lazy" src="${juara3.foto}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" style="width:100%;height:100%;object-fit:cover;" alt="${juara3.nama}"><span style="display:none;align-items:center;justify-content:center;width:100%;height:100%;">${juara3.gender === "L" ? "👦" : "👧"}</span>` : (juara3.gender === "L" ? "👦" : "👧")}</div>
                  </div>
                  <span class="absolute -bottom-[3px] -right-[3px] text-white rounded-full flex items-center justify-center font-extrabold border-2 border-white w-5 h-5 text-[10px] bg-bronze-500">3</span>
                </div>
                <p class="${PODIUM_NAME} max-w-[96px]">${juara3.nama}</p>
                <p class="${PODIUM_SCORE} text-teal-600">${juara3.skor}</p>
                <div class="${PODIUM_BLOCK} h-10 border-t border-border" style="background: linear-gradient(to top, #f2f4fa, #ffffff);"><span class="${PODIUM_BLOCK_SPAN} text-xl text-ink-400">3</span></div>
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
                  <div class="w-[30px] h-[30px] rounded-full bg-navy-tint text-navy-900 text-[10.5px] font-extrabold flex items-center justify-center overflow-hidden">${mhs.foto ? `<img loading="lazy" src="${mhs.foto}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" class="w-full h-full object-cover" alt="${mhs.nama}"><span style="display:none;align-items:center;justify-content:center;width:100%;height:100%;">${inisial}</span>` : inisial}</div>
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
        "/gambar/gedungutama.webp",
        "/gambar/rektor.webp",
        "/gambar/gedung.webp"
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

      // ---------- Confetti singkat pas leaderboard selesai dimuat ----------
      function tampilkanConfetti() {
        const warna = ["#d4a017", "#0f8a8c", "#a9c73b", "#152159", "#a9743a"];
        const $layer = $("#confettiLayer");
        for (let i = 0; i < 26; i++) {
          const kiri = 10 + Math.random() * 80;
          const $p = $("<span>")
            .addClass("confetti-piece")
            .css({
              left: kiri + "%",
              background: warna[i % warna.length],
              animationDelay: (Math.random() * 0.3) + "s",
              borderRadius: Math.random() > 0.5 ? "50%" : "2px",
            });
          $layer.append($p);
        }
        setTimeout(() => $layer.empty(), 2000);
      }

      // Load pertama kali saat jendela browser terbuka
      renderLeaderboard();
      tampilkanConfetti();
    });
  </script>
</body>

</html>