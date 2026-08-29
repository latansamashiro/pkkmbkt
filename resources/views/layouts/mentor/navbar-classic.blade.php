{{-- resources/views/layouts/mentor/navbar-classic.blade.php
     Dipakai di halaman yang masih pakai CSS custom (.navbar, .navbar-links) — Jadwal, Profil.
     Cara pakai: @include('layouts.mentor.navbar-classic', ['navActive' => 'jadwal']) --}}
<header class="navbar">
  <a href="#" class="navbar-brand" aria-label="PKKMB-KT UNILAM Beranda">
    <div class="navbar-logo">
      <img src="{{ asset('gambar/unilam.webp') }}" alt="Logo UNILAM" />
    </div>
    <div class="navbar-brand-text">
      <strong>PKKMB-KT</strong>
      <span>UNILAM 2026</span>
    </div>
  </a>

  <nav class="navbar-links" id="navbarLinks" aria-label="Navigasi utama">
    <a href="{{ route('role.mentor.modul') }}" class="{{ ($navActive ?? '') === 'modul' ? 'active' : '' }}">Modul</a>
    <a href="{{ route('role.mentor.leaderboard') }}" class="{{ ($navActive ?? '') === 'leaderboard' ? 'active' : '' }}">Leaderboard</a>
    <a href="{{ route('dashboard') }}" class="{{ ($navActive ?? '') === 'dashboard' ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('role.mentor.info') }}" class="{{ ($navActive ?? '') === 'info' ? 'active' : '' }}">Info</a>
    <a href="{{ route('role.mentor.profil') }}" class="{{ ($navActive ?? '') === 'profil' ? 'active' : '' }}">Profil</a>
  </nav>
</header>
