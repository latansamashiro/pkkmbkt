<!doctype html>
<html lang="id">
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <title>@yield('title', 'PKKMB-KT UNILAM 2026')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    @stack('styles')
  </head>
  <body @yield('body_class', '')>
    <header class="navbar">
      <a href="{{ route('public.home') }}" class="navbar-brand" aria-label="PKKMB-KT UNILAM Beranda">
        <div class="navbar-logo">
          <img src="{{ asset('unilam.png') }}" alt="Logo UNILAM" />
        </div>
        <div class="navbar-brand-text">
          <strong>PKKMB-KT</strong>
          <span>UNILAM 2026</span>
        </div>
      </a>

      <nav class="navbar-links" id="navbarLinks" aria-label="Navigasi utama">
        <a href="{{ route('public.home') }}" @if(request()->routeIs('public.home')) class="active" @endif>Beranda</a>

        <div class="nav-dropdown" id="dropdownTentang">
          <button type="button" class="nav-dropdown-toggle" id="dropdownTentangToggle" aria-expanded="false" aria-controls="dropdownTentangMenu">
            Tentang
            <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
          </button>
          <div class="nav-dropdown-menu" id="dropdownTentangMenu">
            {{-- TODO: sejarah.html & visi-misi.html belum dibuatkan, sementara diarahkan ke "#" --}}
            <a href="#">Sejarah</a>
            <a href="#">Visi &amp; Misi</a>
          </div>
        </div>

        <a href="{{ route('public.informasi') }}" @if(request()->routeIs('public.informasi')) class="active" @endif>Informasi</a>
        <a href="{{ route('public.jadwal') }}" @if(request()->routeIs('public.jadwal')) class="active" @endif>Jadwal</a>
        <a href="{{ route('public.kontak') }}" @if(request()->routeIs('public.kontak')) class="active" @endif>Kontak</a>
      </nav>
    </header>

    @yield('content')

    <script>
      lucide.createIcons();

      const navbarLinks = document.getElementById("navbarLinks");

      const dropdownTentang = document.getElementById("dropdownTentang");
      const dropdownTentangToggle = document.getElementById("dropdownTentangToggle");

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

      const navLinksAll = navbarLinks.querySelectorAll("a");
      navLinksAll.forEach((link) => {
        link.addEventListener("click", () => {
          navbarLinks.classList.remove("active");
        });
      });
    </script>

    @stack('scripts')
  </body>
</html>
