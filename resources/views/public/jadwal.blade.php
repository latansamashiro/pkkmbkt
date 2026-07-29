@extends('layouts.public')

@section('title', 'PKKMB-KT UNILAM 2026')

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

        --bg: #f2f4fa;
        --surface: #ffffff;
        --surface-muted: #e8ebf6;
        --border: #e1e5f1;

        --ink-900: #1b2238;
        --ink-600: #5b6175;
        --ink-400: #8d92a6;

        --radius-lg: 28px;
        --radius-md: 18px;
        --radius-sm: 13px;

        --shadow-card:
          0 2px 14px rgba(21, 33, 89, 0.07), 0 1px 2px rgba(21, 33, 89, 0.05);
        --shadow-pop: 0 10px 24px rgba(21, 33, 89, 0.16);

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

      /* ============ NAVBAR ============ */
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

      /* Efek animasi berubah jadi silang (X) saat aktif */
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
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0;
        right: -100%;
        width: 280px;
        height: 100vh;
        background: #0d1735;
        padding: 100px 32px 32px;
        gap: 24px;
        transition: right 0.3s ease;
        box-shadow: -5px 0 25px rgba(0, 0, 0, 0.3);
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
         DROPDOWN "TENTANG" — bisa dibuka/tutup (klik) berisi Sejarah & Visi Misi
         ►► TANDA UNTUK EDIT SELANJUTNYA (sama seperti di halaman lain):
            - Tambah item submenu baru: copy 1 baris <a> di dalam
              .nav-dropdown-menu (lihat HTML di bagian <nav class="navbar-links">)
            - Ganti label tombol: ubah teks di <button class="nav-dropdown-toggle">
            - Ganti warna/ukuran dropdown: ubah blok CSS di bawah ini
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

      /* Versi mobile: submenu tampil sebagai accordion, dorong konten ke bawah */
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

      /* MEDIA QUERY UNTUK TAMPILAN LAPTOP/DESKTOP */
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

        /* Di desktop, dropdown "Tentang" tampil melayang (bukan accordion) */
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

      /* ============ HERO ============ */
      .hero {
        background-image:
          linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
          url('{{ asset('gerbang.jpeg') }}');
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        padding: clamp(48px, 8vw, 96px) clamp(16px, 5vw, 48px)
          clamp(56px, 10vw, 112px);
        display: flex;
        align-items: center;
        gap: 48px;
        flex-wrap: wrap;
      }

      .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(169, 199, 59, 0.15);
        border: 1px solid rgba(169, 199, 59, 0.35);
        color: #c8e46a;
        font-size: 12.5px;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 99px;
        margin-bottom: 18px;
      }
      .hero-eyebrow .dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--lime-500);
      }
      .hero h1 {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: clamp(28px, 5vw + 10px, 52px);
        line-height: 1.15;
        color: #fff;
        margin: 0 0 18px;
        max-width: 520px;
      }
      .hero h1 em {
        font-style: normal;
        color: var(--lime-500);
      }
      .hero-sub {
        font-size: clamp(14px, 1.5vw, 16px);
        color: #bfc6ea;
        line-height: 1.7;
        max-width: 460px;
        margin: 0 0 32px;
      }
      .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
      }
      .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--lime-500);
        color: var(--navy-900);
        font-family: var(--font-sans);
        font-weight: 800;
        font-size: 14px;
        padding: 13px 28px;
        border-radius: 99px;
        border: none;
        cursor: pointer;
        transition: filter 0.15s;
        box-shadow: var(--shadow-pop);
      }
      .btn-primary:hover {
        filter: brightness(1.06);
      }
      .btn-primary .ic {
        width: 17px;
        height: 17px;
      }
      .btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        color: #fff;
        border: 1.5px solid rgba(255, 255, 255, 0.35);
        font-family: var(--font-sans);
        font-weight: 700;
        font-size: 14px;
        padding: 13px 28px;
        border-radius: 99px;
        cursor: pointer;
        transition:
          border-color 0.15s,
          background 0.15s;
      }
      .btn-outline:hover {
        border-color: #fff;
        background: rgba(255, 255, 255, 0.08);
      }

      /* ============ CTA SECTION ============ */
      .cta-section {
        background: linear-gradient(135deg, var(--navy-900), var(--navy-700));
        padding: clamp(56px, 8vw, 96px) clamp(16px, 5vw, 48px);
        text-align: center;
        position: relative;
        overflow: hidden;
      }
      .cta-section::before {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(169, 199, 59, 0.08);
        top: -80px;
        left: -80px;
        pointer-events: none;
      }
      .cta-section::after {
        content: "";
        position: absolute;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        background: rgba(22, 160, 161, 0.1);
        bottom: -60px;
        right: -60px;
        pointer-events: none;
      }
      .cta-section h2 {
        font-family: var(--font-display);
        font-size: clamp(24px, 4vw, 40px);
        color: #fff;
        margin: 0 0 14px;
        position: relative;
        z-index: 1;
      }
      .cta-section p {
        font-size: 15px;
        color: #bfc6ea;
        max-width: 480px;
        margin: 0 auto 32px;
        line-height: 1.7;
        position: relative;
        z-index: 1;
      }
      .cta-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        position: relative;
        z-index: 1;
      }

      /* ============ FOOTER ============ */
      .footer {
        background: #0d1735;
        padding: 28px clamp(16px, 5vw, 48px);
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
      }
      .footer p {
        font-size: 13px;
        color: #4a6a9f;
        margin: 0;
      }
      .footer-links {
        display: flex;
        gap: 20px;
      }
      .footer-links a {
        font-size: 13px;
        color: #4a6a9f;
        transition: color 0.15s;
      }
      .footer-links a:hover {
        color: #aeb6e0;
      }
    </style>
@endpush

@section('content')
    <!-- ============ HERO BANNER ============ -->
    <section
      class="relative overflow-hidden bg-gradient-to-br from-[#152159] to-[#0d1735] text-white py-16 px-6 text-center"
    >
      <!-- Ornamen Dekoratif Tradisional/Modern -->
      <svg
        class="absolute -right-10 -top-10 w-64 h-64 opacity-10 pointer-events-none"
        viewBox="0 0 200 200"
        fill="none"
      >
        <path
          d="M30 190 V110 C30 75 48 48 75 30 L88 12 L101 30 C128 48 146 75 146 110 V190"
          stroke="#a9c73b"
          stroke-width="6"
        />
      </svg>

      <div class="max-w-3xl mx-auto">
        <span
          class="inline-flex items-center gap-1.5 bg-[#16a0a1]/20 border border-[#16a0a1]/30 text-teal-300 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-widest mb-4"
        >
          <i data-lucide="sparkles" class="w-3.5 h-3.5"></i> Masuki Dunia Kampus
        </span>
        <h1
          class="font-display text-3xl md:text-5xl font-bold tracking-tight mb-4"
        >
          Jadwal Resmi PKKMB 2026
        </h1>
        <p class="text-sm md:text-base text-slate-300 max-w-xl mx-auto mb-8">
          Persiapkan dirimu, Mahasiswa Baru Universitas La Tansa Mashiro! Sambut
          babak baru akademikmu pada bulan September 2026.
        </p>

        <!-- COUNTDOWN TIMER -->
        <div
          class="grid grid-cols-3 max-w-sm mx-auto bg-black/20 border border-white/5 rounded-xl p-4 backdrop-blur-md"
        >
          <div class="text-center">
            <span
              class="block font-display text-2xl md:text-3xl font-bold text-[#a9c73b]"
              >SEP</span
            >
            <span
              class="text-[10px] text-slate-400 uppercase font-bold tracking-wider"
              >Bulan</span
            >
          </div>
          <div class="text-center border-x border-white/10">
            <span
              class="block font-display text-2xl md:text-3xl font-bold text-white"
              >2026</span
            >
            <span
              class="text-[10px] text-slate-400 uppercase font-bold tracking-wider"
              >Tahun</span
            >
          </div>
          <div class="text-center flex flex-col justify-center items-center">
            <i
              data-lucide="calendar-days"
              class="w-6 h-6 text-teal-400 mb-0.5"
            ></i>
            <span
              class="text-[9px] text-slate-300 font-bold uppercase tracking-wider"
              >Segera Hadir</span
            >
          </div>
        </div>
      </div>
    </section>

    <!-- Arch Divider Line -->
    <div class="arch-divider bg-transparent my-4">
      <svg
        width="44"
        height="22"
        viewBox="0 0 44 22"
        fill="none"
        class="mx-auto"
      >
        <path
          d="M2 22V14C2 9 6 5 11 3L13 1L15 3C20 5 24 9 24 14V22"
          stroke="#152159"
          stroke-width="2"
        />
      </svg>
    </div>

    <!-- ============ MAIN CONTENT (JADWAL LINE-UP) ============ -->
    <main class="max-w-4xl mx-auto px-6 pb-20">
      <!-- PEMBERITAHUAN ALUR -->
      <div class="mb-10 text-center">
        <h2 class="font-display text-2xl md:text-3xl font-bold text-[#152159]">
          Rangkaian Kegiatan
        </h2>
        <p class="text-xs md:text-sm text-slate-500 mt-1">
          Ikuti seluruh tahapan orientasi wajib untuk memulai perkuliahan
        </p>
      </div>

      <!-- TIMELINE WRAPPER -->
      <div
        class="relative border-l-2 border-slate-200 ml-4 md:ml-32 space-y-12"
      >
        <!-- HARI 1 -->
        <div class="relative">
          <!-- Penanda Tanggal Kiri (Desktop) -->
          <div class="hidden md:block absolute -left-36 top-1 text-right w-28">
            <span class="block font-display text-xl font-bold text-[#152159]"
              >07 Sep</span
            >
            <span class="text-xs text-[#16a0a1] font-semibold uppercase"
              >Senin</span
            >
          </div>
          <!-- Bulatan Timeline -->
          <div
            class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-[#16a0a1] border-4 border-white shadow-sm"
          ></div>

          <!-- Kartu Jadwal -->
          <div
            class="glass-card rounded-2xl p-6 ml-6 transition hover:shadow-md hover:border-[#16a0a1]/30"
          >
            <span
              class="md:hidden inline-block text-xs font-bold text-[#16a0a1] uppercase mb-1"
              >Senin, 07 September 2026</span
            >
            <div class="flex items-start justify-between gap-4">
              <div>
                <span
                  class="text-[11px] font-bold bg-[#16a0a1]/10 text-[#0f8a8c] px-2 py-0.5 rounded"
                  >Hari ke-1</span
                >
                <h3 class="font-display text-lg font-bold text-[#152159] mt-2">
                  Pra-PKKMB & Pembagian Kelompok
                </h3>
              </div>
              <div class="text-right shrink-0">
                <span
                  class="flex items-center gap-1 text-xs font-semibold text-slate-500 bg-slate-100 px-2 py-1 rounded-md"
                >
                  <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>
                  07:30 - 12:00
                </span>
              </div>
            </div>

            <div
              class="mt-4 border-t border-slate-100 pt-4 text-xs md:text-sm text-slate-600 space-y-2"
            >
              <p class="flex items-center gap-2">
                <i
                  data-lucide="check-circle-2"
                  class="w-4 h-4 text-[#a9c73b]"
                ></i>
                Pengondisian barisan dan absensi mahasiswa baru.
              </p>
              <p class="flex items-center gap-2">
                <i
                  data-lucide="check-circle-2"
                  class="w-4 h-4 text-[#a9c73b]"
                ></i>
                Penjelasan atribut pakaian dan tata tertib resmi.
              </p>
              <p class="flex items-center gap-2">
                <i
                  data-lucide="check-circle-2"
                  class="w-4 h-4 text-[#a9c73b]"
                ></i>
                Pembagian mentor pendamping kelompok.
              </p>
            </div>

            <div class="mt-4 flex items-center gap-2 text-xs text-slate-400">
              <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
              <span>Lapangan Utama Kampus UNILAM</span>
            </div>
          </div>
        </div>

        <!-- HARI 2 -->
        <div class="relative">
          <div class="hidden md:block absolute -left-36 top-1 text-right w-28">
            <span class="block font-display text-xl font-bold text-[#152159]"
              >08 Sep</span
            >
            <span class="text-xs text-[#16a0a1] font-semibold uppercase"
              >Selasa</span
            >
          </div>
          <div
            class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-[#152159] border-4 border-white shadow-sm"
          ></div>

          <div
            class="glass-card rounded-2xl p-6 ml-6 transition hover:shadow-md hover:border-[#152159]/20"
          >
            <span
              class="md:hidden inline-block text-xs font-bold text-[#16a0a1] uppercase mb-1"
              >Selasa, 08 September 2026</span
            >
            <div class="flex items-start justify-between gap-4">
              <div>
                <span
                  class="text-[11px] font-bold bg-[#152159]/10 text-[#152159] px-2 py-0.5 rounded"
                  >Hari ke-2</span
                >
                <h3 class="font-display text-lg font-bold text-[#152159] mt-2">
                  Opening Ceremony & Sidang Senat Terbuka
                </h3>
              </div>
              <div class="text-right shrink-0">
                <span
                  class="flex items-center gap-1 text-xs font-semibold text-slate-500 bg-slate-100 px-2 py-1 rounded-md"
                >
                  <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>
                  07:00 - 16:00
                </span>
              </div>
            </div>

            <div
              class="mt-4 border-t border-slate-100 pt-4 text-xs md:text-sm text-slate-600 space-y-2"
            >
              <p class="flex items-center gap-2">
                <i
                  data-lucide="check-circle-2"
                  class="w-4 h-4 text-[#a9c73b]"
                ></i>
                Upacara pembukaan & pengukuhan mahasiswa baru secara simbolis.
              </p>
              <p class="flex items-center gap-2">
                <i
                  data-lucide="check-circle-2"
                  class="w-4 h-4 text-[#a9c73b]"
                ></i>
                Kuliah Umum: Pengenalan Nilai Kebangsaan dan Moderasi Beragama.
              </p>
              <p class="flex items-center gap-2">
                <i
                  data-lucide="check-circle-2"
                  class="w-4 h-4 text-[#a9c73b]"
                ></i>
                Orientasi sistem nilai kepesantrenan & filosofi "La Tansa
                Mashiro".
              </p>
            </div>

            <div class="mt-4 flex items-center gap-2 text-xs text-slate-400">
              <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
              <span>Hall / Auditorium Utama Pembela Umat</span>
            </div>
          </div>
        </div>

        <!-- HARI 3 -->
        <div class="relative">
          <div class="hidden md:block absolute -left-36 top-1 text-right w-28">
            <span class="block font-display text-xl font-bold text-[#152159]"
              >09 Sep</span
            >
            <span class="text-xs text-[#16a0a1] font-semibold uppercase"
              >Rabu</span
            >
          </div>
          <div
            class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-[#152159] border-4 border-white shadow-sm"
          ></div>

          <div
            class="glass-card rounded-2xl p-6 ml-6 transition hover:shadow-md hover:border-[#152159]/20"
          >
            <span
              class="md:hidden inline-block text-xs font-bold text-[#16a0a1] uppercase mb-1"
              >Rabu, 09 September 2026</span
            >
            <div class="flex items-start justify-between gap-4">
              <div>
                <span
                  class="text-[11px] font-bold bg-[#152159]/10 text-[#152159] px-2 py-0.5 rounded"
                  >Hari ke-3</span
                >
                <h3 class="font-display text-lg font-bold text-[#152159] mt-2">
                  Pengenalan Sistem Akademik & Fakultas
                </h3>
              </div>
              <div class="text-right shrink-0">
                <span
                  class="flex items-center gap-1 text-xs font-semibold text-slate-500 bg-slate-100 px-2 py-1 rounded-md"
                >
                  <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>
                  07:30 - 15:30
                </span>
              </div>
            </div>

            <div
              class="mt-4 border-t border-slate-100 pt-4 text-xs md:text-sm text-slate-600 space-y-2"
            >
              <p class="flex items-center gap-2">
                <i
                  data-lucide="check-circle-2"
                  class="w-4 h-4 text-[#a9c73b]"
                ></i>
                Penjelasan mekanisme KRS, perwalian, dan portal SIAKAD kampus.
              </p>
              <p class="flex items-center gap-2">
                <i
                  data-lucide="check-circle-2"
                  class="w-4 h-4 text-[#a9c73b]"
                ></i>
                Pengenalan jajaran Dekanat, dosen prodi, serta laboratorium.
              </p>
              <p class="flex items-center gap-2">
                <i
                  data-lucide="check-circle-2"
                  class="w-4 h-4 text-[#a9c73b]"
                ></i>
                Sosialisasi prospek karir dan kurikulum program studi
                masing-masing.
              </p>
            </div>

            <div class="mt-4 flex items-center gap-2 text-xs text-slate-400">
              <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
              <span>Gedung Fakultas Masing-Masing</span>
            </div>
          </div>
        </div>

        <!-- HARI 4 -->
        <div class="relative">
          <div class="hidden md:block absolute -left-36 top-1 text-right w-28">
            <span class="block font-display text-xl font-bold text-[#152159]"
              >10 Sep</span
            >
            <span class="text-xs text-[#a9c73b] font-bold uppercase"
              >Kamis</span
            >
          </div>
          <div
            class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-[#a9c73b] border-4 border-white shadow-sm"
          ></div>

          <div
            class="glass-card rounded-2xl p-6 ml-6 border-l-4 border-l-[#a9c73b] transition hover:shadow-md"
          >
            <span
              class="md:hidden inline-block text-xs font-bold text-[#a9c73b] uppercase mb-1"
              >Kamis, 10 September 2026</span
            >
            <div class="flex items-start justify-between gap-4">
              <div>
                <span
                  class="text-[11px] font-bold bg-[#a9c73b]/20 text-[#718821] px-2 py-0.5 rounded"
                  >Hari Terakhir</span
                >
                <h3 class="font-display text-lg font-bold text-[#152159] mt-2">
                  Inagurasi, Display UKM & Closing Party
                </h3>
              </div>
              <div class="text-right shrink-0">
                <span
                  class="flex items-center gap-1 text-xs font-semibold text-slate-500 bg-slate-100 px-2 py-1 rounded-md"
                >
                  <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>
                  07:30 - Selesai
                </span>
              </div>
            </div>

            <div
              class="mt-4 border-t border-slate-100 pt-4 text-xs md:text-sm text-slate-600 space-y-2"
            >
              <p class="flex items-center gap-2">
                <i
                  data-lucide="check-circle-2"
                  class="w-4 h-4 text-[#a9c73b]"
                ></i>
                Parade demonstrasi Unit Kegiatan Mahasiswa (UKM) & Organisasi
                internal.
              </p>
              <p class="flex items-center gap-2">
                <i
                  data-lucide="check-circle-2"
                  class="w-4 h-4 text-[#a9c73b]"
                ></i>
                Panggung ekspresi seni kreativitas mahasiswa baru.
              </p>
              <p class="flex items-center gap-2">
                <i
                  data-lucide="check-circle-2"
                  class="w-4 h-4 text-[#a9c73b]"
                ></i>
                Pengumuman kelompok/peserta terbaik & penutupan resmi.
              </p>
            </div>

            <div class="mt-4 flex items-center gap-2 text-xs text-slate-400">
              <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
              <span>Gedung Olahraga (GOR) / Lapangan Utama</span>
            </div>
          </div>
        </div>
      </div>

      <!-- CATATAN PENTING -->
      <div
        class="mt-16 bg-[#152159]/5 border border-[#152159]/10 rounded-2xl p-6 flex flex-col sm:flex-row gap-4 items-start"
      >
        <div
          class="w-10 h-10 rounded-xl bg-[#152159] text-white flex items-center justify-center shrink-0 shadow-sm"
        >
          <i data-lucide="info" class="w-5 h-5"></i>
        </div>
        <div>
          <h4 class="font-display font-bold text-[#152159] text-base mb-1">
            Catatan Penting Calon Mahasiswa
          </h4>
          <p class="text-xs text-slate-600 leading-relaxed">
            Perubahan detail jam acara atau ketentuan penugasan khusus akan
            diumumkan secara berkala melalui grup koordinasi mentor dan akun
            resmi Biro Kemahasiswaan UNILAM. Pastikan selalu memantau informasi
            valid.
          </p>
        </div>
      </div>
    </main>

    <!-- ============ FOOTER ============ -->
    <footer
      class="bg-[#0d1638] text-slate-400 text-center py-10 px-5 text-xs sm:text-sm"
    >
      <img src="{{ asset('unilam.png') }}" class="h-14 w-auto mx-auto mb-4 opacity-90" />
      <p>
        &copy; Universitas La Tansa Mashiro. Sejarah disusun dari arsip internal
        yayasan.
      </p>
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
      // ►► SCRIPT DROPDOWN "TENTANG" — sama persis dengan halaman lain
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
