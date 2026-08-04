<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Dashboard Pembimbing & Koordinator &mdash; PKKMB-KT UNILAM 2026</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
  />

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            display: ['Lora', 'serif'],
            sans: ['Plus Jakarta Sans', 'sans-serif'],
          },
        },
      },
    };
  </script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  @vite(['resources/css/pkkmbkt-theme.css'])
</head>
<body class="bg-[#f2f4fa] font-sans text-[#1b2238] min-h-screen">
  <div class="flex min-h-screen">
    <!-- ======= SIDEBAR (tablet & desktop) ======= -->
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <img src="{{ asset('assets/unilam.png') }}" alt="Logo UNILAM" class="brand-badge" />
            <div class="brand-text"><strong>PKKMB-KT</strong><span>Panel Pembimbing</span></div>
        </a>
        <nav class="sidebar-nav" aria-label="Navigasi pembimbing">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="layout-dashboard"></i></span>
                <span class="label">Dashboard</span>
            </a>

            <p class="sidebar-group-label">Kelola Data</p>
            <a href="{{ route('role.advisor.kelompok-binaan') }}"
                class="{{ request()->routeIs('role.advisor.kelompok-binaan*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="users-round"></i></span>
                <span class="label">Kelompok Binaan</span>
            </a>

            <p class="sidebar-group-label">Monitoring</p>
            <a href="{{ route('role.advisor.monitoring.absensi') }}"
                class="{{ request()->routeIs('role.advisor.monitoring.absensi*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="calendar-check"></i></span>
                <span class="label">Absensi</span>
            </a>
            <a href="{{ route('role.advisor.monitoring.evaluasi') }}"
                class="{{ request()->routeIs('role.advisor.monitoring.evaluasi*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="clipboard-check"></i></span>
                <span class="label">Evaluasi</span>
            </a>
            <a href="{{ route('role.advisor.monitoring.keaktifan') }}"
                class="{{ request()->routeIs('role.advisor.monitoring.keaktifan*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="activity"></i></span>
                <span class="label">Keaktifan</span>
            </a>
            <a href="{{ route('role.advisor.monitoring.pelanggaran') }}"
                class="{{ request()->routeIs('role.advisor.monitoring.pelanggaran*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="alert-triangle"></i></span>
                <span class="label">Pelanggaran</span>
            </a>

            <p class="sidebar-group-label">Lainnya</p>
            <a href="#" class="disabled" aria-disabled="true">
                <span class="ic"><i data-lucide="trophy"></i></span>
                <span class="label">Leaderboard</span>
            </a>
            <a href="{{ route('role.advisor.profil') }}"
                class="{{ request()->routeIs('role.advisor.profil*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="user-circle"></i></span>
                <span class="label">Profil</span>
            </a>
        </nav>

        <div class="sidebar-logout" style="border:none; padding:0; margin:10px 10px 0;">
            <button type="button" id="btnLogoutSidebar"
                style="all:unset; display:flex; align-items:center; justify-content:center; gap:8px; width:100%; padding:12px 10px; border-radius:var(--radius-sm); background:rgba(224,102,90,0.14); color:#f3a49c; font-weight:800; font-size:12.5px; cursor:pointer;">
                <span class="ic"><i data-lucide="log-out"></i></span>
                <span class="label">Keluar</span>
            </button>
        </div>
    </aside>

    <!-- ======= MAIN ======= -->
    <div class="flex-1 min-w-0 flex flex-col">
      <header class="flex items-center justify-between gap-3.5 px-4 sm:px-7 py-4 bg-white border-b border-[#e1e5f1]">
        <a href="{{ route('dashboard') }}" class="md:hidden">
          <img src="{{ asset('gambar/unilam.png') }}" alt="Universitas La Tansa Mashiro" class="h-10 w-auto" />
        </a>
        <h1 class="hidden md:block font-display font-semibold text-lg text-[#152159]">Dashboard Pembimbing & Koordinator</h1>

        <div class="flex items-center gap-2.5">
          <a href="#" class="relative w-10 h-10 rounded-full bg-[#e6e9f6] text-[#1e3a8f] flex items-center justify-center hover:bg-[#e2f3f2] hover:text-[#0f8a8c] transition" aria-label="Masuk ke akun">
            @if (auth()->user()->profile_picture)
              <img src="{{ asset('storage/'.auth()->user()->profile_picture) }}" alt="Foto profil" class="w-full h-full rounded-full object-cover" />
            @else
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="3.4" />
                <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
              </svg>
            @endif
            <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-[#a9c73b] border-2 border-white"></span>
          </a>
          <a href="#" id="btnLogoutTopbar" class="md:hidden w-10 h-10 rounded-full bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition" aria-label="Logout">
            <svg class="w-[19px] h-[19px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M14 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4" />
              <path d="M10 17l5-5-5-5" />
              <path d="M15 12H3" />
            </svg>
          </a>
        </div>
      </header>

      <div class="flex-1 w-full max-w-6xl mx-auto px-4 sm:px-7 py-6 pb-28 md:pb-10 grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-7 items-start">
        <div class="min-w-0">
          <!-- ===== HERO ===== -->
          <section class="relative overflow-hidden bg-[#e8ebf6] rounded-[28px] px-5 sm:px-9 pt-6 sm:pt-9 pb-6 sm:pb-8">
            <svg class="absolute left-0 right-0 bottom-0 w-full h-auto max-h-[78%] opacity-[.16] pointer-events-none" viewBox="0 0 400 160" preserveAspectRatio="xMidYMax slice" xmlns="http://www.w3.org/2000/svg">
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

            <p class="relative text-[13px] font-semibold text-[#5b6175] mb-1">Hai, {{ auth()->user()->name }}</p>
            <p class="relative text-[14.5px] text-[#5b6175] mb-1.5">Selamat datang di</p>
            <h2 class="relative font-display font-bold text-[#152159] text-2xl sm:text-3xl leading-tight max-w-xs mb-6">PKKMB-KT UNILAM 2026</h2>

            <div class="relative">
              <div class="flex items-baseline justify-between mb-2 gap-2">
                <span class="text-[13.5px] font-bold text-[#152159]">Rata-rata Kehadiran Kelompok Binaan</span>
                <span class="text-[13.5px] font-extrabold text-[#0f8a8c]">{{ $stats['rata_kehadiran'] ?? 0 }}%</span>
              </div>
              <div class="h-[13px] rounded-full bg-white/75 border border-[#152159]/10 overflow-hidden">
                <div class="h-full rounded-full bg-gradient-to-r from-[#1e3a8f] to-[#16a0a1]" style="width: {{ $stats['rata_kehadiran'] ?? 0 }}%"></div>
              </div>
            </div>
          </section>

          <!-- ===== RINGKASAN ===== -->
          <section class="mt-7 grid grid-cols-1 sm:grid-cols-3 gap-3.5">
            <div class="flex items-center gap-3 bg-white border border-[#e1e5f1] rounded-2xl p-4">
              <span class="w-11 h-11 shrink-0 rounded-[14px] bg-[#e6e9f6] text-[#1e3a8f] flex items-center justify-center">
                <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/>
                  <circle cx="10" cy="7" r="4"/>
                </svg>
              </span>
              <div>
                <p class="text-lg font-extrabold text-[#1b2238] m-0">{{ $stats['total_kelompok'] ?? 0 }}</p>
                <p class="text-[11.5px] font-semibold text-[#8d92a6] m-0">Kelompok Binaan</p>
              </div>
            </div>
            <div class="flex items-center gap-3 bg-white border border-[#e1e5f1] rounded-2xl p-4">
              <span class="w-11 h-11 shrink-0 rounded-[14px] bg-[#e2f3f2] text-[#0f8a8c] flex items-center justify-center">
                <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M9 12l2 2 4-4"/>
                  <circle cx="12" cy="12" r="9"/>
                </svg>
              </span>
              <div>
                <p class="text-lg font-extrabold text-[#1b2238] m-0">{{ $stats['total_mentor'] ?? 0 }}</p>
                <p class="text-[11.5px] font-semibold text-[#8d92a6] m-0">Mentor</p>
              </div>
            </div>
            <div class="flex items-center gap-3 bg-white border border-[#e1e5f1] rounded-2xl p-4">
              <span class="w-11 h-11 shrink-0 rounded-[14px] bg-[#f2f6e0] text-[#7c9426] flex items-center justify-center">
                <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 10 12 5 2 10l10 5 10-5Z"/>
                  <path d="M6 12v5c0 1.5 2.7 3 6 3s6-1.5 6-3v-5"/>
                </svg>
              </span>
              <div>
                <p class="text-lg font-extrabold text-[#1b2238] m-0">{{ $stats['total_mahasiswa'] ?? 0 }}</p>
                <p class="text-[11.5px] font-semibold text-[#8d92a6] m-0">Mahasiswa Binaan</p>
              </div>
            </div>
          </section>

          <!-- ===== MENU UTAMA ===== -->
          <section class="mt-7">
            <h3 class="font-display text-[17px] font-bold text-[#152159] mb-3.5">Menu Utama</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">

              <a href="{{ route('role.advisor.kelompok-binaan') }}" class="flex flex-col sm:items-start items-center text-center sm:text-left gap-2.5 bg-white border border-[#e1e5f1] rounded-2xl p-4 sm:p-5 hover:-translate-y-1 hover:shadow-lg transition">
                <span class="w-[46px] h-[46px] rounded-[14px] bg-[#e6e9f6] text-[#1e3a8f] flex items-center justify-center">
                  <svg class="w-[23px] h-[23px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/>
                    <circle cx="10" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                  </svg>
                </span>
                <span class="text-[12.5px] font-bold text-[#1b2238] leading-tight">Data Kelompok Binaan</span>
                <span class="hidden sm:block text-[11.5px] text-[#8d92a6] leading-snug">Daftar kelompok &amp; mentor yang Anda bina</span>
              </a>

              <a href="{{ route('role.advisor.monitoring.absensi') }}" class="flex flex-col sm:items-start items-center text-center sm:text-left gap-2.5 bg-white border border-[#e1e5f1] rounded-2xl p-4 sm:p-5 hover:-translate-y-1 hover:shadow-lg transition">
                <span class="w-[46px] h-[46px] rounded-[14px] bg-[#e2f3f2] text-[#0f8a8c] flex items-center justify-center">
                  <svg class="w-[23px] h-[23px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="5" y="4" width="14" height="17" rx="2" />
                    <path d="M9 3.5h6" />
                    <path d="M8.2 10l1.4 1.4 2.2-2.4" />
                    <path d="M14 10.2h2.2" />
                    <path d="M8 15.3h8.2" />
                  </svg>
                </span>
                <span class="text-[12.5px] font-bold text-[#1b2238] leading-tight">Monitoring Absensi</span>
                <span class="hidden sm:block text-[11.5px] text-[#8d92a6] leading-snug">Rekap kehadiran per sesi tiap kelompok binaan</span>
              </a>

              <a href="{{ route('role.advisor.monitoring.evaluasi') }}" class="flex flex-col sm:items-start items-center text-center sm:text-left gap-2.5 bg-white border border-[#e1e5f1] rounded-2xl p-4 sm:p-5 hover:-translate-y-1 hover:shadow-lg transition">
                <span class="w-[46px] h-[46px] rounded-[14px] bg-[#e6e9f6] text-[#1e3a8f] flex items-center justify-center">
                  <svg class="w-[23px] h-[23px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="5" y="4" width="14" height="17" rx="2" />
                    <path d="M9 3.5h6" />
                    <path d="M8.3 11.2l1.4 1.4 2.3-2.5" />
                    <path d="M14.4 11.4h2" />
                    <path d="M8 16h8.2" />
                  </svg>
                </span>
                <span class="text-[12.5px] font-bold text-[#1b2238] leading-tight">Monitoring Evaluasi</span>
                <span class="hidden sm:block text-[11.5px] text-[#8d92a6] leading-snug">Progres evaluasi kelompok binaan</span>
              </a>

              <a href="{{ route('role.advisor.monitoring.keaktifan') }}" class="flex flex-col sm:items-start items-center text-center sm:text-left gap-2.5 bg-white border border-[#e1e5f1] rounded-2xl p-4 sm:p-5 hover:-translate-y-1 hover:shadow-lg transition">
                <span class="w-[46px] h-[46px] rounded-[14px] bg-[#e2f3f2] text-[#0f8a8c] flex items-center justify-center">
                  <svg class="w-[23px] h-[23px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="6" y="4" width="12" height="16" rx="2"></rect>
                    <path d="M9 4.5h6"></path>
                    <path d="M9 10l1.5 1.5L14 8"></path>
                    <path d="M9 15l1.5 1.5L14 13"></path>
                  </svg>
                </span>
                <span class="text-[12.5px] font-bold text-[#1b2238] leading-tight">Monitoring Keaktifan</span>
                <span class="hidden sm:block text-[11.5px] text-[#8d92a6] leading-snug">Poin keaktifan kelompok binaan</span>
              </a>

              <a href="{{ route('role.advisor.monitoring.pelanggaran') }}" class="flex flex-col sm:items-start items-center text-center sm:text-left gap-2.5 bg-white border border-[#e1e5f1] rounded-2xl p-4 sm:p-5 hover:-translate-y-1 hover:shadow-lg transition">
                <span class="w-[46px] h-[46px] rounded-[14px] bg-[#e6e9f6] text-[#1e3a8f] flex items-center justify-center">
                  <svg class="w-[23px] h-[23px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 9v4" />
                    <path d="M12 17h.01" />
                    <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                  </svg>
                </span>
                <span class="text-[12.5px] font-bold text-[#1b2238] leading-tight">Monitoring Pelanggaran</span>
                <span class="hidden sm:block text-[11.5px] text-[#8d92a6] leading-snug">Poin pelanggaran kelompok binaan</span>
              </a>

              <a href="#" class="flex flex-col sm:items-start items-center text-center sm:text-left gap-2.5 bg-white border border-[#e1e5f1] rounded-2xl p-4 sm:p-5 opacity-50 cursor-not-allowed" aria-disabled="true">
                <span class="w-[46px] h-[46px] rounded-[14px] bg-[#f2f6e0] text-[#7c9426] flex items-center justify-center">
                  <svg class="w-[23px] h-[23px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z" />
                    <path d="M5 21v-5M12 21v-7M19 21v-4" />
                  </svg>
                </span>
                <span class="text-[12.5px] font-bold text-[#1b2238] leading-tight">Monitoring Leaderboard</span>
                <span class="hidden sm:block text-[11.5px] text-[#8d92a6] leading-snug">Segera hadir</span>
              </a>

              <a href="{{ route('role.advisor.profil') }}" class="flex flex-col sm:items-start items-center text-center sm:text-left gap-2.5 bg-white border border-[#e1e5f1] rounded-2xl p-4 sm:p-5 hover:-translate-y-1 hover:shadow-lg transition">
                <span class="w-[46px] h-[46px] rounded-[14px] bg-[#e2f3f2] text-[#0f8a8c] flex items-center justify-center">
                  <svg class="w-[23px] h-[23px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="8" r="3.4" />
                    <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
                  </svg>
                </span>
                <span class="text-[12.5px] font-bold text-[#1b2238] leading-tight">Profil</span>
                <span class="hidden sm:block text-[11.5px] text-[#8d92a6] leading-snug">Data diri &amp; ganti password</span>
              </a>
            </div>
          </section>
        </div>

        <!-- ===== ASIDE (desktop only) ===== -->
        <div class="hidden lg:block sticky top-24">
          <div class="bg-white border border-[#e1e5f1] rounded-2xl p-[18px]">
            <h4 class="font-display text-[14.5px] font-bold text-[#152159] mb-2">Pengumuman</h4>
            <p class="text-[12.5px] text-[#5b6175] leading-relaxed m-0">
              Pastikan Anda memantau kehadiran dan evaluasi kelompok binaan secara berkala.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ======= BOTTOM NAV (mobile only) ======= -->
  <nav class="md:hidden fixed bottom-0 inset-x-0 h-[74px] bg-white border-t border-[#e1e5f1] flex items-center justify-around px-1.5 z-30" style="padding-bottom: env(safe-area-inset-bottom)" aria-label="Navigasi bawah">
    <a href="{{ route('role.advisor.kelompok-binaan') }}" class="flex flex-col items-center gap-1 text-[#8d92a6] text-[10px] font-bold flex-1 py-1.5">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/>
        <circle cx="10" cy="7" r="4"/>
      </svg>
      <span>Kelompok</span>
    </a>
    <a href="{{ route('role.advisor.monitoring.absensi') }}" class="flex flex-col items-center gap-1 text-[#8d92a6] text-[10px] font-bold flex-1 py-1.5">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <rect x="5" y="4" width="14" height="17" rx="2" />
        <path d="M9 3.5h6" />
        <path d="M8.2 10l1.4 1.4 2.2-2.4" />
        <path d="M14 10.2h2.2" />
        <path d="M8 15.3h8.2" />
      </svg>
      <span>Absensi</span>
    </a>
    <a href="{{ route('dashboard') }}" class="flex-none -mt-8 w-14 h-14 rounded-full bg-[#152159] text-white flex items-center justify-center shadow-lg shadow-[#152159]/40" aria-label="Beranda">
      <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 11.5 12 4l8 7.5" />
        <path d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10" />
      </svg>
    </a>
    <a href="{{ route('role.advisor.monitoring.evaluasi') }}" class="flex flex-col items-center gap-1 text-[#8d92a6] text-[10px] font-bold flex-1 py-1.5">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <rect x="5" y="4" width="14" height="17" rx="2" />
        <path d="M9 3.5h6" />
        <path d="M8.3 11.2l1.4 1.4 2.3-2.5" />
        <path d="M14.4 11.4h2" />
        <path d="M8 16h8.2" />
      </svg>
      <span>Evaluasi</span>
    </a>
    <a href="{{ route('role.advisor.profil') }}" class="flex flex-col items-center gap-1 text-[#8d92a6] text-[10px] font-bold flex-1 py-1.5">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="8" r="3.4" />
        <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
      </svg>
      <span>Profil</span>
    </a>
  </nav>

  <!-- ======= MODAL KONFIRMASI LOGOUT ======= -->
  <div id="logoutModal" class="hidden fixed inset-0 z-[100] bg-[#152159]/55 backdrop-blur-sm items-center justify-center p-4">
    <div class="bg-white rounded-[28px] max-w-[340px] w-full p-7 text-center shadow-2xl">
      <div class="w-14 h-14 rounded-full bg-red-50 text-red-600 flex items-center justify-center mx-auto mb-4">
        <svg class="w-[26px] h-[26px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4" />
          <path d="M10 17l5-5-5-5" />
          <path d="M15 12H3" />
        </svg>
      </div>
      <h3 class="font-display text-lg font-bold text-[#1b2238] mb-2">Yakin ingin keluar?</h3>
      <p class="text-[13px] text-[#5b6175] leading-relaxed mb-5">Kamu akan keluar dari akun ini dan harus masuk kembali untuk mengakses dashboard.</p>
      <div class="flex gap-2.5">
        <button type="button" id="btnLogoutCancel" class="flex-1 py-3 rounded-xl border border-[#e1e5f1] bg-[#f2f4fa] text-[#1b2238] font-bold text-[13.5px] hover:bg-[#e8ebf6] transition">Tidak</button>
        <button type="button" id="btnLogoutConfirm" class="flex-1 py-3 rounded-xl bg-red-600 text-white font-extrabold text-[13.5px] hover:brightness-110 transition">Ya, Keluar</button>
      </div>
    </div>
  </div>

  <form method="POST" action="{{ route('logout') }}" id="logoutForm" class="hidden">
    @csrf
  </form>

  <script>
    lucide.createIcons();
  </script>

  <script>
    // ======================================================================
    // ►► KONFIRMASI LOGOUT (jQuery) — tombol Logout (sidebar & topbar HP)
    //    tidak langsung pindah halaman, tapi buka modal konfirmasi dulu.
    //    Konfirmasi akan submit form logout Laravel yang sebenarnya.
    // ======================================================================
    $(function () {
      function bukaModalLogout(e) {
        e.preventDefault();
        $('#logoutModal').removeClass('hidden').addClass('flex');
      }

      $('#btnLogoutSidebar, #btnLogoutTopbar').on('click', bukaModalLogout);

      $('#btnLogoutCancel').on('click', function () {
        $('#logoutModal').addClass('hidden').removeClass('flex');
      });

      $('#btnLogoutConfirm').on('click', function () {
        $('#logoutForm').trigger('submit');
      });

      $('#logoutModal').on('click', function (e) {
        if (e.target === this) {
          $(this).addClass('hidden').removeClass('flex');
        }
      });
    });
  </script>
</body>
</html>