{{-- resources/views/layouts/mentor/bottomnav-classic.blade.php
     Dipakai bareng navbar-classic.blade.php. Cara pakai:
     @include('layouts.mentor.bottomnav-classic', ['navActive' => 'jadwal']) --}}
<nav class="bottom-nav" aria-label="Navigasi bawah">
  <a href="{{ route('role.mentor.modul') }}" class="{{ ($navActive ?? '') === 'modul' ? 'active' : '' }}">
    <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
      <path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
      <path d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z" />
    </svg>
    <span>Modul</span>
  </a>
  <a href="{{ route('role.mentor.leaderboard') }}" class="{{ ($navActive ?? '') === 'leaderboard' ? 'active' : '' }}">
    <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
      <path d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z" />
      <path d="M5 21v-5M12 21v-7M19 21v-4" />
    </svg>
    <span>Leaderboard</span>
  </a>
  <a href="{{ route('dashboard') }}" class="home" aria-label="Beranda">
    <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
      <path d="M4 11.5 12 4l8 7.5" />
      <path d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10" />
    </svg>
    <span>Beranda</span>
  </a>
  <a href="{{ route('role.mentor.info') }}" class="{{ ($navActive ?? '') === 'info' ? 'active' : '' }}">
    <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
      <path d="M9 17H4l1.4-1.4A2 2 0 0 0 6 14.2V11a6 6 0 1 1 12 0v3.2c0 .5.2 1 .6 1.4L20 17h-5" />
      <path d="M9 17a3 3 0 0 0 6 0" />
    </svg>
    <span>Info</span>
  </a>
  <a href="{{ route('role.mentor.profil') }}" class="{{ ($navActive ?? '') === 'profil' ? 'active' : '' }}">
    <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
      <circle cx="12" cy="8" r="3.4" />
      <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
    </svg>
    <span>Profil</span>
  </a>
</nav>
