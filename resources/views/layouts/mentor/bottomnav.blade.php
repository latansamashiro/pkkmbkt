{{-- resources/views/layouts/mentor/bottomnav.blade.php
     Dipakai bareng topnav.blade.php. Cara pakai:
     @include('layouts.mentor.bottomnav', ['navActive' => 'info']) --}}
@php
  $bnLinkClass = fn ($key) => 'flex flex-col items-center gap-1 text-[10px] font-bold flex-1 py-1.5 no-underline '
      . ($navActive === $key ? 'text-navy-900' : 'text-ink-400');
@endphp
<nav
  class="fixed bottom-0 left-0 right-0 h-[74px] bg-surface border-t border-border flex items-center justify-around px-1.5 pb-[env(safe-area-inset-bottom)] z-30 md:hidden"
  aria-label="Navigasi bawah">
  <a href="{{ route('role.mentor.modul') }}" class="{{ $bnLinkClass('modul') }}">
    <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
      <path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
      <path d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z" />
    </svg>
    <span>Modul</span>
  </a>
  <a href="{{ route('role.mentor.leaderboard') }}" class="{{ $bnLinkClass('leaderboard') }}">
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
  <a href="{{ route('role.mentor.info') }}" class="{{ $bnLinkClass('info') }}">
    <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
      <path d="M9 17H4l1.4-1.4A2 2 0 0 0 6 14.2V11a6 6 0 1 1 12 0v3.2c0 .5.2 1 .6 1.4L20 17h-5" />
      <path d="M9 17a3 3 0 0 0 6 0" />
    </svg>
    <span>Info</span>
  </a>
  <a href="{{ route('role.mentor.profil') }}" class="{{ $bnLinkClass('profil') }}">
    <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
      <circle cx="12" cy="8" r="3.4" />
      <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
    </svg>
    <span>Profil</span>
  </a>
</nav>
