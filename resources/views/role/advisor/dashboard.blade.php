@extends('layouts.advisor.main')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = { corePlugins: { preflight: false } }
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-7 items-start">
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
            <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
            <circle cx="10" cy="7" r="4" />
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
            <path d="M9 12l2 2 4-4" />
            <circle cx="12" cy="12" r="9" />
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
            <path d="M22 10 12 5 2 10l10 5 10-5Z" />
            <path d="M6 12v5c0 1.5 2.7 3 6 3s6-1.5 6-3v-5" />
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
              <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
              <circle cx="10" cy="7" r="4" />
              <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
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

        <a href="{{ route('role.advisor.monitoring.tugas') }}" class="flex flex-col sm:items-start items-center text-center sm:text-left gap-2.5 bg-white border border-[#e1e5f1] rounded-2xl p-4 sm:p-5 hover:-translate-y-1 hover:shadow-lg transition">
          <span class="w-[46px] h-[46px] rounded-[14px] bg-[#e6e9f6] text-[#1e3a8f] flex items-center justify-center">
            <svg class="w-[23px] h-[23px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
              <rect x="5" y="4" width="14" height="17" rx="2" />
              <path d="M9 3.5h6" />
              <path d="M8.3 11.2l1.4 1.4 2.3-2.5" />
              <path d="M14.4 11.4h2" />
              <path d="M8 16h8.2" />
            </svg>
          </span>
          <span class="text-[12.5px] font-bold text-[#1b2238] leading-tight">Monitoring Pengumpulan Tugas</span>
          <span class="hidden sm:block text-[11.5px] text-[#8d92a6] leading-snug">Pengumpulan Tugas Mahasiswa</span>
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
@endsection
