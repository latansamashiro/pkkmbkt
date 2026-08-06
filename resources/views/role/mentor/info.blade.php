<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Pengumuman | PKKMB-KT UNILAM 2026</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
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
        <img src="\Gambar\unilam.png" alt="Logo UNILAM" class="w-full h-full object-contain" />
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
      <a href="{{ route('role.mentor.leaderboard') }}" class="text-[#c7cce8] text-base md:text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Leaderboard</a>
      <a href="{{ route('dashboard') }}" class="text-[#c7cce8] text-base md:text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Dashboard</a>
      <a href="#" class="text-white text-base md:text-[13.5px] font-semibold no-underline border-l-[3px] md:border-l-0 md:border-b-2 border-lime-500 pl-2 md:pl-0 md:pb-0.5">Info</a>
      <a href="{{ route('role.mentor.profil') }}" class="text-[#c7cce8] text-base md:text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Profil</a>
    </nav>
  </header>

  <!-- ============ HERO ============ -->
  <section class="relative overflow-hidden" style="padding: clamp(40px, 7vw, 64px) clamp(16px, 5vw, 48px);">
    <div class="absolute inset-0 z-0 overflow-hidden after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-br after:from-navy-900/90 after:to-teal-600/[0.78]" id="heroSlideshow"></div>

    <div class="relative z-[1] max-w-[900px] mx-auto text-center">
      <div class="inline-flex items-center gap-[7px] bg-lime-500/[0.15] border border-lime-500/[0.35] text-[#c8e46a] text-[11px] font-bold px-3.5 py-[5px] rounded-full mb-4 tracking-[0.06em] uppercase">
        <span class="w-1.5 h-1.5 rounded-full bg-lime-500" style="animation: pulse 2s infinite;"></span>
        Info Terbaru
      </div>
      <h1 class="font-display text-2xl sm:text-3xl md:text-[38px] font-bold text-white mb-3 leading-[1.2] m-0">Info<br />PKKMB-KT UNILAM 2026</h1>
      <p class="text-sm text-white/75 leading-[1.7] max-w-[520px] mx-auto">
        Pantau seluruh informasi, perubahan jadwal, dan tenggat tugas terbaru
        seputar kegiatan PKKMB-KT di sini.
      </p>
    </div>
  </section>

  <!-- ============ MAIN ============ -->
  <div class="max-w-[860px] mx-auto" style="padding: 40px clamp(16px, 5vw, 48px) calc(74px + 28px);">
    <div class="flex items-center justify-between gap-3 flex-wrap mb-[18px]">
      <span class="text-[11px] font-extrabold tracking-[0.06em] uppercase text-ink-400">Daftar Pengumuman</span>
      <span class="text-[11.5px] font-bold text-ink-600 bg-surface border border-border rounded-full whitespace-nowrap" id="countBadgeLabel" style="padding: 6px 16px;">3 pengumuman</span>
    </div>

    <div class="flex flex-col gap-4" id="announcementList"></div>
  </div>

  <!-- ============ FOOTER ============ -->
  <footer class="bg-[#0d1735] flex flex-wrap justify-between items-center gap-3.5 mt-14" style="padding: 28px clamp(16px, 5vw, 48px);">
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
    <a href="{{ route('role.mentor.leaderboard') }}" class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
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
    <a href="#" class="flex flex-col items-center gap-1 text-navy-900 text-[10px] font-bold flex-1 py-1.5 no-underline">
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
      // ==========================================
      // DATA PENGUMUMAN — TAMBAH / EDIT DI SINI
      // ==========================================
      const announcementData = [{
          icon: "📢",
          type: "urgent",
          tag: "Wajib",
          title: "Pengumuman",
          desc: "Besok seluruh peserta wajib memakai almamater.",
          meta: [{
            kind: "date",
            text: "09 Juli 2026"
          }],
        },
        {
          icon: "📢",
          type: "info",
          tag: "Perubahan Jadwal",
          title: "Perubahan Jadwal",
          desc: "Materi Bela Negara dipindah ke Aula B.",
          meta: [],
        },
        {
          icon: "📢",
          type: "default",
          tag: "Tugas",
          title: "Pengumpulan Tugas",
          desc: "Batas akhir pengumpulan tugas materi.",
          meta: [{
            kind: "deadline",
            text: "Deadline: 10 Juli, 23.59 WIB"
          }],
        },
      ];

      const $listEl = $("#announcementList");
      $("#countBadgeLabel").text(`${announcementData.length} pengumuman`);

      const iconCalendar = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-[13px] h-[13px] flex-shrink-0"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M3 9.5h18M8 3v3M16 3v3"/></svg>`;
      const iconClock = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-[13px] h-[13px] flex-shrink-0"><circle cx="12" cy="12" r="8.5"/><path d="M12 7.5V12l3 2"/></svg>`;

      const cardBase =
        "flex gap-4 bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] relative overflow-hidden transition-all hover:-translate-y-0.5 hover:shadow-[0_10px_24px_rgba(21,33,89,0.16)] before:content-[''] before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1";
      const cardVariant = {
        urgent: "before:bg-amber-500",
        info: "before:bg-navy-600",
        default: "before:bg-teal-500",
      };
      const iconVariant = {
        urgent: "bg-amber-tint",
        info: "bg-navy-tint",
        default: "bg-teal-tint",
      };
      const tagVariant = {
        urgent: "bg-amber-tint text-amber-500",
        info: "bg-navy-tint text-navy-600",
        default: "bg-teal-tint text-teal-600",
      };

      function renderAnnouncements() {
        const html = announcementData
          .map((item) => {
            const variant = item.type === "urgent" ? "urgent" : item.type === "info" ? "info" : "default";

            const metaHtml = item.meta
              .map((m) => {
                const isDeadline = m.kind === "deadline";
                const icon = isDeadline ? iconClock : iconCalendar;
                const chipClass = isDeadline ?
                  "inline-flex items-center gap-1.5 text-[11.5px] font-bold text-amber-500 bg-amber-tint rounded-full" :
                  "inline-flex items-center gap-1.5 text-[11.5px] font-bold text-ink-600 bg-bg border border-border rounded-full";
                return `<span class="${chipClass}" style="padding:5px 12px;">${icon}${m.text}</span>`;
              })
              .join("");

            return `
                <div class="${cardBase} ${cardVariant[variant]}" style="padding: 22px clamp(18px, 4vw, 26px);">
                  <div class="flex-shrink-0 w-11 h-11 rounded-[13px] ${iconVariant[variant]} flex items-center justify-center text-xl">${item.icon}</div>
                  <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2.5 mb-1.5">
                      <p class="font-display text-base font-bold text-ink-900 m-0 leading-[1.35]">${item.title}</p>
                      <span class="flex-shrink-0 text-[10px] font-extrabold tracking-[0.04em] uppercase rounded-full whitespace-nowrap ${tagVariant[variant]}" style="padding:4px 10px;">${item.tag}</span>
                    </div>
                    <p class="text-[13.5px] text-ink-600 leading-[1.65] mb-3 mt-0">${item.desc}</p>
                    ${metaHtml ? `<div class="flex flex-wrap gap-2">${metaHtml}</div>` : ""}
                  </div>
                </div>
              `;
          })
          .join("");

        $listEl.html(html);
      }

      renderAnnouncements();

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
        "/Gambar/gedung.jpeg",
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
    });
  </script>
</body>

</html>