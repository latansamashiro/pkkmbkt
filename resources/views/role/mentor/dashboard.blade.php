{{-- resources/views/mentor/dashboard.blade.php --}}
@extends('layouts.mentor.main')

@section('title', 'Dashboard PKKMB-KT UNILAM 2026')
@section('page-title', 'Dashboard Mentor')

@section('content')

  <!-- ===== HERO ===== -->
  <section class="hero">
    <svg class="hero-mosque" viewBox="0 0 400 160" preserveAspectRatio="xMidYMax slice" xmlns="http://www.w3.org/2000/svg">
      <rect x="0" y="110" width="400" height="50" fill="#152159" />
      <rect x="44" y="58" width="10" height="56" fill="#152159" />
      <path d="M41 58 Q49 42 57 58 Z" fill="#152159" />
      <circle cx="49" cy="38" r="2.6" fill="#a9c73b" />
      <rect x="346" y="58" width="10" height="56" fill="#152159" />
      <path d="M343 58 Q351 42 359 58 Z" fill="#152159" />
      <circle cx="351" cy="38" r="2.6" fill="#a9c73b" />
      <path d="M150 114 Q150 60 200 42 Q250 60 250 114 Z" fill="#16a0a1" />
      <rect x="196" y="20" width="8" height="22" fill="#16a0a1" />
      <path d="M204 18 A6 6 0 1 1 200 8 A4.6 4.6 0 0 0 204 18 Z" fill="#a9c73b" />
      <path d="M96 114 Q96 86 116 76 Q136 86 136 114 Z" fill="#152159" />
      <path d="M264 114 Q264 86 284 76 Q304 86 304 114 Z" fill="#152159" />
      <path d="M182 160 L182 128 Q200 112 218 128 L218 160 Z" fill="#f2f4fa" />
      <path d="M120 160 L120 138 Q128 128 136 138 L136 160 Z" fill="#f2f4fa" opacity="0.85" />
      <path d="M264 160 L264 138 Q272 128 280 138 L280 160 Z" fill="#f2f4fa" opacity="0.85" />
    </svg>
    <p class="hero-eyebrow">Hai, {{ auth()->user()->name }}</p>
    <p class="hero-sub">Selamat datang di</p>
    <h2 class="hero-title">PKKMB-KT UNILAM 2026</h2>

    <div class="progress-block">
      <div class="progress-row">
        <span class="progress-label">Progres PKKMB-KT</span>
        <span class="progress-pct">{{ $progres ?? 42 }}%</span>
      </div>
      <div class="progress-track">
        <div class="progress-fill" style="width: {{ $progres ?? 42 }}%"></div>
      </div>
    </div>
  </section>

  <!-- ===== MENU UTAMA ===== -->
  <section class="section">
    <div class="section-head">
      <h3 class="section-title">Menu Utama</h3>
    </div>
    <div class="menu-grid">
      <a class="menu-card" href="{{ route('role.mentor.modul') }}">
        <span class="menu-chip chip-navy">
          <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
            <path d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z" />
          </svg>
        </span>
        <span class="menu-label">Modul Pembekalan</span>
        <span class="menu-desc">Materi &amp; e-modul orientasi mahasiswa baru</span>
      </a>

      <a class="menu-card" href="{{ route('role.mentor.absensi') }}">
        <span class="menu-chip chip-teal">
          <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
            <rect x="5" y="4" width="14" height="17" rx="2" />
            <path d="M9 3.5h6" />
            <path d="M8.2 10l1.4 1.4 2.2-2.4" />
            <path d="M14 10.2h2.2" />
            <path d="M8 15.3h8.2" />
          </svg>
        </span>
        <span class="menu-label">Kelola Presensi</span>
        <span class="menu-desc">Cek absensi dan status kehadiran anggota kelompok</span>
      </a>

      <a class="menu-card" href="{{ route('role.mentor.jadwal') }}">
        <span class="menu-chip chip-lime">
          <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
            <rect x="4" y="5" width="16" height="16" rx="2" />
            <path d="M8 3v4M16 3v4M4 9.5h16" />
            <circle cx="8.3" cy="13.2" r=".9" fill="currentColor" stroke="none" />
            <circle cx="12" cy="13.2" r=".9" fill="currentColor" stroke="none" />
            <circle cx="15.7" cy="13.2" r=".9" fill="currentColor" stroke="none" />
            <circle cx="8.3" cy="16.6" r=".9" fill="currentColor" stroke="none" />
            <circle cx="12" cy="16.6" r=".9" fill="currentColor" stroke="none" />
          </svg>
        </span>
        <span class="menu-label">Jadwal</span>
        <span class="menu-desc">Rangkaian kegiatan &amp; jadwal resmi PKKMB</span>
      </a>

      <a class="menu-card" href="{{ route('role.mentor.info') }}">
        <span class="menu-chip chip-teal">
          <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 17H4l1.4-1.4A2 2 0 0 0 6 14.2V11a6 6 0 1 1 12 0v3.2c0 .5.2 1 .6 1.4L20 17h-5" />
            <path d="M9 17a3 3 0 0 0 6 0" />
          </svg>
        </span>
        <span class="menu-label">Info</span>
        <span class="menu-desc">Pengumuman &amp; informasi terbaru PKKMB</span>
      </a>

      <a class="menu-card" href="{{ route('role.mentor.leaderboard') }}">
        <span class="menu-chip chip-lime">
          <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z" />
            <path d="M5 21v-5M12 21v-7M19 21v-4" />
          </svg>
        </span>
        <span class="menu-label">Leaderboard</span>
        <span class="menu-desc">Pantau peringkat poin keaktifan mahasiswa</span>
      </a>

      <a class="menu-card" href="{{ route('role.mentor.keaktifan') }}">
        <span class="menu-chip chip-teal">
          <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
            <rect x="6" y="4" width="12" height="16" rx="2"></rect>
            <path d="M9 4.5h6"></path>
            <path d="M9 10l1.5 1.5L14 8"></path>
            <path d="M9 15l1.5 1.5L14 13"></path>
          </svg>
        </span>
        <span class="menu-label">Input Keaktifan &amp; Pelanggaran</span>
        <span class="menu-desc">Catat keaktifan dan pelanggaran mahasiswa</span>
      </a>

      <a class="menu-card" href="{{ route('role.mentor.evaluasi') }}">
        <span class="menu-chip chip-navy">
          <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
            <rect x="5" y="4" width="14" height="17" rx="2" />
            <path d="M9 3.5h6" />
            <path d="M8.3 11.2l1.4 1.4 2.3-2.5" />
            <path d="M14.4 11.4h2" />
            <path d="M8 16h8.2" />
          </svg>
        </span>
        <span class="menu-label">Monitoring Evaluasi</span>
        <span class="menu-desc">Memantau Hasil Evaluasi dan Progres Mahasiswa Baru</span>
      </a>

      <a class="menu-card" href="{{ route('role.mentor.monitoring-tugas') }}">
        <span class="menu-chip chip-navy">
          <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
            <rect x="5" y="4" width="14" height="17" rx="2" />
            <path d="M9 3.5h6" />
            <path d="M8.3 11.2l1.4 1.4 2.3-2.5" />
            <path d="M14.4 11.4h2" />
            <path d="M8 16h8.2" />
          </svg>
        </span>
        <span class="menu-label">Monitoring Pengumpulan Tugas</span>
        <span class="menu-desc">Memantau Pengumpulam Tugas Individu &amp; Kelompok</span>
      </a>
    </div>
  </section>

  <!-- ===== JADWAL ===== -->
  <section class="section">
    <div class="section-head">
      <h3 class="section-title">Jadwal Hari Ini</h3>
      <a href="{{ route('role.mentor.jadwal') }}" class="section-link">
        Lihat Semua
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 6l6 6-6 6" />
        </svg>
      </a>
    </div>

    <a class="schedule-card" href="{{ route('role.mentor.jadwal') }}">
      <span class="schedule-icon">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
          <rect x="4" y="5" width="16" height="16" rx="2" />
          <path d="M8 3v4M16 3v4M4 9.5h16" />
          <circle cx="8.3" cy="13.2" r=".9" fill="currentColor" stroke="none" />
          <circle cx="12" cy="13.2" r=".9" fill="currentColor" stroke="none" />
          <circle cx="15.7" cy="13.2" r=".9" fill="currentColor" stroke="none" />
          <circle cx="8.3" cy="16.6" r=".9" fill="currentColor" stroke="none" />
          <circle cx="12" cy="16.6" r=".9" fill="currentColor" stroke="none" />
        </svg>
      </span>
      <span class="schedule-info">
        <p class="schedule-title">Pembekalan PKKMB</p>
        <p class="schedule-meta">
          <span>08.00&ndash;09.00</span><span>&middot;</span><span>Hall Unilam</span>
        </p>
      </span>
      <span class="schedule-go">
        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 6l6 6-6 6" />
        </svg>
      </span>
    </a>
  </section>

@endsection

@section('aside')
  <div class="info-card">
    <h4>Pengumuman</h4>
    <p>
      Pastikan kamu hadir 15 menit lebih awal pada setiap sesi
      pembekalan dan membawa kartu peserta PKKMB-KT.
    </p>
  </div>
@endsection