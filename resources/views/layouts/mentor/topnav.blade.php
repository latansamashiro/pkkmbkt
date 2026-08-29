{{-- resources/views/layouts/mentor/topnav.blade.php
     Dipakai di halaman yang masih pakai desain "hero foto" (Info, Leaderboard, Modul).
     Cara pakai: @include('layouts.mentor.topnav', ['navActive' => 'info']) --}}
<header
  class="sticky top-0 z-40 flex items-center justify-between gap-4 px-4 sm:px-8 md:px-12 py-3.5 bg-navy-900 border-b border-white/10">
  <a
    href="#"
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
      <strong class="block font-display text-[14.5px] text-white">PKKMB-KT</strong>
      <span class="text-[10.5px] text-[#aeb6e0] tracking-[0.04em]">UNILAM 2026</span>
    </div>
  </a>

  <nav class="hidden md:flex flex-row gap-7" id="navbarLinks">
    @php
      $navLinkClass = fn ($key) => $navActive === $key
          ? 'text-white text-[13.5px] font-semibold no-underline border-b-2 border-lime-500 pb-0.5'
          : 'text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white';
    @endphp
    <a href="{{ route('role.mentor.modul') }}" class="{{ $navLinkClass('modul') }}">Modul</a>
    <a href="{{ route('role.mentor.leaderboard') }}" class="{{ $navLinkClass('leaderboard') }}">Leaderboard</a>
    <a href="{{ route('dashboard') }}" class="{{ $navLinkClass('dashboard') }}">Dashboard</a>
    <a href="{{ route('role.mentor.info') }}" class="{{ $navLinkClass('info') }}">Info</a>
    <a href="{{ route('role.mentor.profil') }}" class="{{ $navLinkClass('profil') }}">Profil</a>
  </nav>
</header>
