@extends('layouts.public')

@section('title', 'Kontak - Universitas La Tansa Mashiro')

@push('styles')
    <style>
      /* ============ TOKENS ============ */
      :root {
        --navy-900: #152159;
        --navy-700: #1e3a8f;
        --navy-600: #2a4bb0;
        --teal-600: #0f8a8c;
        --teal-500: #16a0a1;
        --teal-tint: #e2f3f2;
        --lime-500: #a9c73b;
        --lime-tint: #f2f6e0;
        --navy-tint: #e6e9f6;

        --paper: #f6f1e4;
        --ink: #2b2f45;

        --font-display: "Lora", serif;
        --font-sans: "Plus Jakarta Sans", sans-serif;
      }

      body {
        font-family: var(--font-sans);
        color: var(--ink);
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased;
      }
      .font-display {
        font-family: var(--font-display);
      }
      .text-navy-900 {
        color: var(--navy-900);
      }
      .text-navy-700 {
        color: var(--navy-700);
      }
      .text-teal-600 {
        color: var(--teal-600);
      }
      .bg-navy-900 {
        background-color: var(--navy-900);
      }
      .bg-teal-600 {
        background-color: var(--teal-600);
      }
      .bg-olive-600 {
        background-color: var(--lime-500);
      }
      .bg-paper {
        background-color: var(--paper);
      }
      .border-teal-600 {
        border-color: var(--teal-600);
      }

      /* ============ NAVBAR — IDENTIK DENGAN HOME_PAGE.HTML / SEJARAH.HTML ============ */
      .navbar {
        position: sticky;
        top: 0;
        z-index: 40;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 14px clamp(16px, 5vw, 48px);
        background: var(--navy-900);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      }
      .navbar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        z-index: 50;
      }

      /* === SAMA PERSIS DENGAN HOME_PAGE.HTML === */
      .navbar-logo {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-size: 9px;
        font-weight: 700;
        color: var(--navy-900);
        text-align: center;
        line-height: 1.25;
        flex-shrink: 0;
      }
      .navbar-brand-text strong {
        display: block;
        font-family: var(--font-display);
        font-size: 14.5px;
        color: #fff;
      }
      .navbar-brand-text span {
        font-size: 10.5px;
        color: #aeb6e0;
        letter-spacing: 0.04em;
      }

      /* HAMBURGER MENU BUTTON */
      .menu-toggle {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 24px;
        height: 18px;
        background: transparent;
        border: none;
        cursor: pointer;
        z-index: 50;
        padding: 0;
      }
      .menu-toggle span {
        display: block;
        width: 100%;
        height: 2px;
        background-color: #fff;
        border-radius: 2px;
        transition:
          transform 0.3s ease,
          opacity 0.3s ease;
      }
      .menu-toggle.active span:nth-child(1) {
        transform: translateY(8px) rotate(45deg);
      }
      .menu-toggle.active span:nth-child(2) {
        opacity: 0;
      }
      .menu-toggle.active span:nth-child(3) {
        transform: translateY(-8px) rotate(-45deg);
      }

      .navbar-links {
        display: none;
      }
      .navbar-links.active {
        right: 0;
      }
      .navbar-links a {
        color: #c7cce8;
        font-size: 16px;
        font-weight: 600;
        transition: color 0.15s;
        display: block;
      }
      .navbar-links a:hover,
      .navbar-links a.active {
        color: #fff;
      }
      .navbar-links a.active {
        border-left: 3px solid var(--lime-500);
        padding-left: 8px;
      }

      /* ======================================================================
         DROPDOWN "TENTANG" — sama persis dengan sejarah.html / home_page.html
      ====================================================================== */
      .nav-dropdown {
        position: relative;
        width: 100%;
      }
      .nav-dropdown-toggle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        gap: 8px;
        background: transparent;
        border: none;
        padding: 0;
        color: #c7cce8;
        font-family: var(--font-sans);
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: color 0.15s;
      }
      .nav-dropdown-toggle:hover,
      .nav-dropdown.open .nav-dropdown-toggle {
        color: #fff;
      }
      .nav-dropdown-toggle .dropdown-arrow {
        font-size: 12px;
        transition: transform 0.25s ease;
      }
      .nav-dropdown.open .dropdown-arrow {
        transform: rotate(180deg);
      }

      .nav-dropdown-menu {
        display: flex;
        flex-direction: column;
        gap: 14px;
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        padding-left: 14px;
        margin-top: 0;
        transition:
          max-height 0.3s ease,
          opacity 0.25s ease,
          margin-top 0.3s ease;
      }
      .nav-dropdown.open .nav-dropdown-menu {
        max-height: 220px;
        opacity: 1;
        margin-top: 14px;
      }
      .nav-dropdown-menu a {
        font-size: 14.5px;
        color: #9aa2cc;
      }
      .nav-dropdown-menu a::before {
        content: "— ";
        color: var(--lime-500);
      }
      .nav-dropdown-menu a:hover {
        color: #fff;
      }
      .nav-dropdown-menu a.active {
        color: #fff;
        font-weight: 700;
      }

      @media (min-width: 768px) {
        .menu-toggle {
          display: none;
        }
        .navbar-links {
          position: static;
          display: flex;
          flex-direction: row;
          width: auto;
          height: auto;
          background: transparent;
          padding: 0;
          gap: 28px;
          box-shadow: none;
          transition: none;
        }
        .navbar-links a {
          font-size: 13.5px;
        }
        .navbar-links a.active {
          border-left: none;
          border-bottom: 2px solid var(--lime-500);
          padding-left: 0;
          padding-bottom: 2px;
        }

        .nav-dropdown {
          width: auto;
        }
        .nav-dropdown-toggle {
          width: auto;
          font-size: 13.5px;
        }
        .nav-dropdown-menu {
          position: absolute;
          top: calc(100% + 14px);
          left: 0;
          min-width: 170px;
          background: #0d1735;
          border: 1px solid rgba(255, 255, 255, 0.08);
          border-radius: 12px;
          padding: 12px 18px;
          box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
          gap: 10px;
          margin-top: 0;
          transform: translateY(-6px);
          transition:
            opacity 0.2s ease,
            transform 0.2s ease,
            visibility 0.2s ease;
          max-height: none;
          visibility: hidden;
        }
        .nav-dropdown.open .nav-dropdown-menu {
          margin-top: 0;
          transform: translateY(0);
          visibility: visible;
        }
        .nav-dropdown-menu a {
          padding: 0;
          white-space: nowrap;
        }
      }

      /* Arch Divider */
      .arch-divider {
        height: 22px;
        background-repeat: repeat-x;
        background-position: center;
        background-size: 44px 22px;
        opacity: 0.55;
      }
      .arch-divider svg {
        display: block;
        margin: 0 auto;
      }
      .prose-body p {
        margin-bottom: 1.1rem;
        line-height: 1.85;
      }
    </style>
@endpush

@section('content')

    <section id="kontak" class="py-12 px-4 max-w-6xl mx-auto flex-grow w-full">
      <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold text-[#11235a] sm:text-4xl">
          Hubungi Kami
        </h1>
        <p class="mt-3 text-base text-gray-500 max-w-xl mx-auto">
          Punya pertanyaan atau ingin berdiskusi terkait pelaksanaan PKKMB-KT?
          Silakan kirimkan pesan Anda di bawah ini.
        </p>
      </div>

      <div
        class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-8 rounded-2xl shadow-sm border border-gray-100"
      >
        <div class="space-y-6 justify-between flex flex-col">
          <div>
            <h2 class="text-xl font-bold text-[#11235a] mb-4">
              Informasi Kontak
            </h2>
            <p class="text-gray-600 mb-6 text-sm leading-relaxed">
              Kami akan dengan senang hati membantu mengatasi kendala atau
              menjawab pertanyaan Anda secepat mungkin.
            </p>

            <div class="space-y-4">
              <div class="flex items-start space-x-4">
                <div class="bg-blue-50 p-3 rounded-xl text-[#11235a]">
                  <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                    />
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-800 text-sm">
                    Alamat Kampus
                  </h4>
                  <!-- ►► ALAMAT — ganti di sini kalau berubah lagi -->
                  <p class="text-gray-500 text-xs mt-0.5">
                    Jl. Soekarno - Hatta, Rangkasbitung, Kabupaten Lebak,
                    Banten 42317
                  </p>
                </div>
              </div>

              <div class="flex items-start space-x-4">
                <div class="bg-blue-50 p-3 rounded-xl text-[#11235a]">
                  <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                    />
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-800 text-sm">
                    Email Resmi
                  </h4>
                  <!-- ►► EMAIL — ganti di sini kalau berubah lagi, dan JUGA di
                       action="https://formsubmit.co/..." pada <form> di bawah -->
                  <p class="text-gray-500 text-xs mt-0.5">
                    pmblatansamashiro@gmail.com
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ======================================================================
             ►► DUA LINK FORMULIR GOOGLE — ganti URL di href kalau linknya
             berubah lagi. Keduanya buka tab baru (target="_blank").
        ====================================================================== -->
        <div class="flex flex-col gap-5 justify-center">
          <a
            href="https://docs.google.com/forms/d/e/1FAIpQLSf-wc7fjXqf6o9MEI5qUjylqjrB7hDrNbzIjY0uWQBu8b6GdA/viewform"
            target="_blank"
            rel="noopener noreferrer"
            class="group flex items-start gap-4 bg-gray-50 hover:bg-blue-50 border border-gray-200 hover:border-[#11235a]/30 rounded-xl p-6 transition"
          >
            <div class="bg-blue-100 text-[#11235a] p-3 rounded-xl shrink-0">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-4 4v-4z"
                />
              </svg>
            </div>
            <div>
              <h3 class="font-bold text-[#11235a] text-base group-hover:underline">
                Kotak Saran Online
              </h3>
              <p class="text-gray-500 text-xs mt-1 leading-relaxed">
                Sampaikan kritik, saran, atau masukan seputar pelaksanaan
                PKKMB-KT lewat formulir Google ini.
              </p>
              <span class="inline-flex items-center gap-1 text-xs font-semibold text-[#11235a] mt-3">
                Buka Formulir
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
              </span>
            </div>
          </a>

          <a
            href="https://docs.google.com/forms/d/e/1FAIpQLSdLi-lkLFlyHC30XtDbw2gO_D3w53oYuo2OsR3MSJVxhooJvw/viewform"
            target="_blank"
            rel="noopener noreferrer"
            class="group flex items-start gap-4 bg-gray-50 hover:bg-red-50 border border-gray-200 hover:border-red-300 rounded-xl p-6 transition"
          >
            <div class="bg-red-100 text-red-700 p-3 rounded-xl shrink-0">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                />
              </svg>
            </div>
            <div>
              <h3 class="font-bold text-red-700 text-base group-hover:underline">
                Layanan Aduan Kekerasan Seksual
              </h3>
              <p class="text-gray-500 text-xs mt-1 leading-relaxed">
                Laporkan kejadian kekerasan seksual secara aman dan rahasia
                melalui formulir resmi ini.
              </p>
              <span class="inline-flex items-center gap-1 text-xs font-semibold text-red-700 mt-3">
                Buka Formulir
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
              </span>
            </div>
          </a>
        </div>
      </div>
    </section>

    <footer
      class="bg-[#0d1638] text-slate-400 text-center py-10 px-5 text-xs sm:text-sm"
    >
      <img src="{{ asset('unilam.png') }}" class="h-14 w-auto mx-auto mb-4 opacity-90" />
      <p>&copy; Universitas La Tansa Mashiro. Semua hak dilindungi.</p>
    </footer>

    <script>
      lucide.createIcons();

      const menuToggle = document.getElementById("menuToggle");
      const navbarLinks = document.getElementById("navbarLinks");

      menuToggle.addEventListener("click", () => {
        menuToggle.classList.toggle("active");
        navbarLinks.classList.toggle("active");
      });

      // ======================================================================
      // ►► SCRIPT DROPDOWN "TENTANG" — sama persis dengan sejarah.html
      // ======================================================================
      const dropdownTentang = document.getElementById("dropdownTentang");
      const dropdownTentangToggle = document.getElementById(
        "dropdownTentangToggle",
      );

      dropdownTentangToggle.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        const isOpen = dropdownTentang.classList.toggle("open");
        dropdownTentangToggle.setAttribute("aria-expanded", isOpen);
      });

      document.addEventListener("click", (e) => {
        if (!dropdownTentang.contains(e.target)) {
          dropdownTentang.classList.remove("open");
          dropdownTentangToggle.setAttribute("aria-expanded", "false");
        }
      });

      const links = navbarLinks.querySelectorAll("a");
      links.forEach((link) => {
        link.addEventListener("click", () => {
          menuToggle.classList.remove("active");
          navbarLinks.classList.remove("active");
        });
      });
    </script>
@endsection
