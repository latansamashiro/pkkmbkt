<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Modul | PKKMB-KT UNILAM 2026</title>
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
        --color-plus-500: #059669;
        --color-plus-tint: #ecfdf5;
        --color-minus-500: #dc2626;
        --color-minus-tint: #fef2f2;
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
  @include('layouts.mentor.topnav', ['navActive' => 'modul'])

  <!-- ============ HERO ============ -->
  <section class="relative overflow-hidden" style="padding: clamp(40px, 7vw, 64px) clamp(16px, 5vw, 48px);">
    <div class="absolute inset-0 z-0 overflow-hidden after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-br after:from-navy-900/90 after:to-teal-600/[0.78]" id="heroSlideshow"></div>

    <div class="relative z-[1] max-w-[900px] mx-auto text-center">
      <h1 class="font-display text-2xl sm:text-3xl md:text-[38px] font-bold text-white mb-3 leading-[1.2] m-0">Modul<br />PKKMB-KT UNILAM 2026</h1>
      <p class="text-sm text-white/75 leading-[1.7] max-w-[560px] mx-auto">
        Kenali tata tertib, atribut wajib, dan sistem penilaian sebelum
        mengikuti seluruh rangkaian kegiatan PKKMB-KT.
      </p>
    </div>
  </section>

  <!-- ============ MAIN ============ -->
  <div class="max-w-[900px] mx-auto" style="padding: 32px clamp(16px, 5vw, 48px) calc(74px + 28px);">
    {{-- Semua konten di sini murni dari database (dikelola Panitia lewat
         "Kelola Modul PKKMB") -- gak ada lagi teks bawaan/hardcode. --}}
    @forelse ($modulData as $itemModul)
      <div class="bg-surface rounded-[18px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] mb-5" style="padding: 26px clamp(20px, 4vw, 30px);">
        <h2 class="font-display text-navy-900 text-[19px] font-bold mb-4 mt-0 flex items-center gap-2.5">
          <span class="w-[5px] h-5 rounded-full flex-shrink-0" style="background: linear-gradient(to bottom, #16a0a1, #1e3a8f);"></span>
          {{ $itemModul->section }}
        </h2>
        <div class="leading-[1.8] text-ink-600 text-sm">
          {!! $itemModul->content !!}
        </div>
      </div>
    @empty
      <div class="bg-surface rounded-[18px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] text-center" style="padding: 40px 26px;">
        <p class="text-ink-400 text-sm m-0">Belum ada konten modul yang dipublish. Silakan cek lagi nanti.</p>
      </div>
    @endforelse
  </div>

  <!-- ============ FOOTER ============ -->
  @include('layouts.mentor.footer')

  @include('layouts.mentor.bottomnav', ['navActive' => 'modul'])

  <script>
    $(function() {
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
      const heroSlideImages = ["/gambar/gedungutama.webp", "/gambar/rektor.webp", "/gambar/gedung.webp"];
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