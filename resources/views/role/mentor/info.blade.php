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
  @include('layouts.mentor.topnav', ['navActive' => 'info'])

  <!-- ============ HERO ============ -->
  <section
    class="relative overflow-hidden px-4 sm:px-8 md:px-12 py-10 sm:py-14 md:py-16">
    <div
      class="absolute inset-0 z-0 overflow-hidden after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-br after:from-navy-900/90 after:to-teal-600/[0.78]"
      id="heroSlideshow"></div>

    <div class="relative z-[1] max-w-[900px] mx-auto text-center">
      <h1
        class="font-display text-2xl sm:text-3xl md:text-[38px] font-bold text-white mb-3 leading-[1.2]">
        Info<br />PKKMB-KT UNILAM 2026
      </h1>
      <p class="text-sm text-white/75 leading-[1.7] max-w-[520px] mx-auto">
        Pantau seluruh informasi, perubahan jadwal, dan tenggat tugas
        terbaru seputar kegiatan PKKMB-KT di sini.
      </p>
    </div>
  </section>

  <!-- ============ MAIN ============ -->
  <div
    class="max-w-[860px] mx-auto px-4 sm:px-8 md:px-12 py-10 pb-[calc(74px+28px)] md:pb-10 flex-1 w-full">
    <div class="flex items-center justify-between gap-3 flex-wrap mb-[18px]">
      <span class="text-[11px] font-extrabold tracking-[0.06em] uppercase text-ink-400">Daftar Pengumuman</span>
      <span
        class="text-[11.5px] font-bold text-ink-600 bg-surface border border-border rounded-full px-4 py-1.5 whitespace-nowrap"
        id="countBadgeLabel">3 pengumuman</span>
    </div>

    <div class="flex flex-col gap-4" id="announcementList"></div>
  </div>

  <!-- ============ FOOTER ============ -->
  @include('layouts.mentor.footer')

  <!-- ======= BOTTOM NAV (mobile only) ======= -->
  @include('layouts.mentor.bottomnav', ['navActive' => 'info'])

  <script>
    $(function() {
      // ==========================================
      // DATA PENGUMUMAN — TAMBAH / EDIT DI SINI
      // ==========================================
      const announcementData = @json($announcementData);

      const $list = $("#announcementList");
      const $countBadgeLabel = $("#countBadgeLabel");
      $countBadgeLabel.text(`${announcementData.length} pengumuman`);

      const iconCalendar = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M3 9.5h18M8 3v3M16 3v3"/></svg>`;
      const iconClock = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="8.5"/><path d="M12 7.5V12l3 2"/></svg>`;

      const CARD_BASE =
        "anno-card flex gap-4 bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] px-[18px] sm:px-[26px] py-[22px] relative overflow-hidden transition-all duration-[180ms] hover:-translate-y-0.5 hover:shadow-[0_10px_24px_rgba(21,33,89,0.16)] before:content-[''] before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1";
      const CARD_ACCENT = {
        urgent: "before:bg-amber-500",
        info: "before:bg-navy-600",
        default: "before:bg-teal-500",
      };
      const ICON_BG = {
        urgent: "bg-amber-tint",
        info: "bg-navy-tint",
        default: "bg-teal-tint",
      };
      const TAG_CLASS = {
        urgent: "bg-amber-tint text-amber-500",
        info: "bg-navy-tint text-navy-600",
        default: "bg-teal-tint text-teal-600",
      };

      function renderAnnouncements() {
        const html = announcementData
          .map((item) => {
            const variant = item.type in CARD_ACCENT ? item.type : "default";

            const metaHtml = item.meta
              .map((m) => {
                const isDeadline = m.kind === "deadline";
                const icon = isDeadline ? iconClock : iconCalendar;
                const chipClass = isDeadline ?
                  "anno-meta-chip inline-flex items-center gap-1.5 text-[11.5px] font-bold rounded-full px-3 py-[5px] [&_svg]:w-[13px] [&_svg]:h-[13px] [&_svg]:flex-shrink-0 text-amber-500 bg-amber-tint border border-transparent" :
                  "anno-meta-chip inline-flex items-center gap-1.5 text-[11.5px] font-bold rounded-full px-3 py-[5px] [&_svg]:w-[13px] [&_svg]:h-[13px] [&_svg]:flex-shrink-0 text-ink-600 bg-bg border border-border";
                return `<span class="${chipClass}">${icon}${m.text}</span>`;
              })
              .join("");

            return `
                <div class="${CARD_BASE} ${CARD_ACCENT[variant]}">
                  <div class="flex-shrink-0 w-11 h-11 rounded-[13px] flex items-center justify-center text-xl ${ICON_BG[variant]}">${item.icon}</div>
                  <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2.5 mb-1.5">
                      <p class="font-display text-base font-bold text-ink-900 m-0 leading-[1.35]">${item.title}</p>
                      <span class="flex-shrink-0 text-[10px] font-extrabold tracking-[0.04em] uppercase px-2.5 py-1 rounded-full whitespace-nowrap ${TAG_CLASS[variant]}">${item.tag}</span>
                    </div>
                    <p class="text-[13.5px] text-ink-600 leading-[1.65] mb-3 mt-0">${item.desc}</p>
                    ${metaHtml ? `<div class="flex flex-wrap gap-2">${metaHtml}</div>` : ""}
                  </div>
                </div>
              `;
          })
          .join("");

        $list.html(html);
      }

      renderAnnouncements();

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