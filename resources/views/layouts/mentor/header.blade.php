{{-- resources/views/layouts/mentor/header.blade.php --}}
<header class="topbar !static">
  <a href="{{ route('dashboard') }}" class="topbar-brand">
    <img src="{{ asset('gambar/unilam.webp') }}" alt="Universitas La Tansa Mashiro" />
  </a>

  <h1 class="topbar-title">@yield('page-title', 'Dashboard Mentor')</h1>

  <div class="topbar-actions">
    <a href="{{ route('role.mentor.profil') }}" class="avatar-btn" aria-label="Masuk ke akun">
      @if (auth()->user()->profile_picture)
        <img
          src="{{ asset('storage/'.auth()->user()->profile_picture) }}"
          alt="Foto profil"
          class="w-full h-full rounded-full object-cover" />
      @else
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="8" r="3.4" />
          <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
        </svg>
      @endif
      <span class="avatar-dot"></span>
    </a>

    <a href="#" class="topbar-logout" id="btnLogoutTopbar" aria-label="Logout">
      <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M14 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4" />
        <path d="M10 17l5-5-5-5" />
        <path d="M15 12H3" />
      </svg>
    </a>
  </div>
</header>
