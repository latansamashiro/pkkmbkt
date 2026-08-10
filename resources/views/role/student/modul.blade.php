<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Modul | PKKMB-KT UNILAM 2026</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet" />

  <!-- ============ TOKEN TAILWIND — dipakai bareng semua halaman lain ============ -->
  <style type="text/tailwindcss">
    @theme {
        --color-navy-900: #152159;
        --color-navy-700: #1e3a8f;
        --color-navy-600: #2a4bb0;
        --color-teal-600: #0f8a8c;
        --color-teal-500: #16a0a1;
        --color-teal-tint: #e2f3f2;
        --color-lime-500: #a9c73b;
        --color-lime-tint: #f2f6e0;
        --color-navy-tint: #e6e9f6;
        --color-bg: #f2f4fa;
        --color-surface: #ffffff;
        --color-border: #e1e5f1;
        --color-ink-900: #1b2238;
        --color-ink-600: #5b6175;
        --color-ink-400: #8d92a6;
        --color-plus-500: #059669;
        --color-plus-tint: #ecfdf5;
        --color-minus-500: #dc2626;
        --color-minus-tint: #fef2f2;
        --font-sans: "Plus Jakarta Sans", sans-serif;
        --font-display: "Lora", serif;
      }
    </style>
  <style>
    @keyframes dotpulse {

      0%,
      100% {
        opacity: 1;
        transform: scale(1);
      }

      50% {
        opacity: 0.5;
        transform: scale(0.8);
      }
    }
  </style>
</head>

<body class="font-sans text-ink-900 m-0 p-0 bg-bg antialiased">
  <!-- ============ NAVBAR — IDENTIK HALAMAN LAIN ============ -->
  <header
    class="sticky top-0 z-40 flex items-center justify-between gap-4 px-4 sm:px-8 md:px-12 py-3.5 bg-navy-900 border-b border-white/10">
    <a
      href="#"
      class="flex items-center gap-2.5 z-50 no-underline"
      aria-label="PKKMB-KT UNILAM Beranda">
      <div
        class="w-[38px] h-[38px] rounded-full bg-white flex items-center justify-center font-display text-[9px] font-bold text-navy-900 text-center leading-tight flex-shrink-0 overflow-hidden">
        <img
          src="{{ asset('gambar/unilam.png') }}"
          alt="Logo UNILAM"
          class="w-full h-full object-contain" />
      </div>
      <div>
        <strong class="block font-display text-[14.5px] text-white">PKKMB-KT</strong>
        <span class="text-[10.5px] text-[#aeb6e0] tracking-[0.04em]">UNILAM 2026</span>
      </div>
    </a>

    <nav class="hidden md:flex flex-row gap-7" id="navbarLinks">
      <a
        href="#"
        class="text-white text-[13.5px] font-semibold no-underline border-b-2 border-lime-500 pb-0.5">Modul</a>
      <a
        href="{{ route('role.student.leaderboard') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Leaderboard</a>
      <a
        href="{{ route('dashboard') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Dashboard</a>
      <a
        href="{{ route('role.student.info') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Info</a>
      <a
        href="{{ route('role.student.profil') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Profil</a>
    </nav>
  </header>

  <!-- ============ HERO ============ -->
  <section
    class="relative overflow-hidden px-4 sm:px-8 md:px-12 py-10 sm:py-14 md:py-16">
    <div
      class="absolute inset-0 z-0 overflow-hidden after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-br after:from-navy-900/90 after:to-teal-600/[0.78]"
      id="heroSlideshow"></div>

    <div class="relative z-[1] max-w-[900px] mx-auto text-center">
      <div
        class="inline-flex items-center gap-[7px] bg-lime-500/[0.15] border border-lime-500/[0.35] text-[#c8e46a] text-[11px] font-bold px-3.5 py-[5px] rounded-full mb-4 tracking-[0.06em] uppercase">
        <span
          class="w-1.5 h-1.5 rounded-full bg-lime-500 animate-[dotpulse_2s_infinite]"></span>
        Panduan Peserta
      </div>
      <h1
        class="font-display text-2xl sm:text-3xl md:text-[38px] font-bold text-white mb-3 leading-[1.2]">
        Modul<br />PKKMB-KT UNILAM 2026
      </h1>
      <p
        class="text-sm text-white/75 leading-[1.7] max-w-[560px] mx-auto">
        Kenali tata tertib, atribut wajib, dan sistem penilaian sebelum
        mengikuti seluruh rangkaian kegiatan PKKMB-KT.
      </p>
    </div>
  </section>

  <!-- ============ MAIN ============ -->
  <div
    class="max-w-[900px] mx-auto px-4 sm:px-8 md:px-12 py-8 pb-[calc(74px+28px)] md:pb-8">
    <div
      class="bg-surface rounded-[18px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] px-5 sm:px-[30px] py-[26px] mb-5">
      <h2
        class="font-display text-navy-900 text-[19px] font-bold mb-4 flex items-center gap-2.5 before:content-[''] before:w-[5px] before:h-5 before:rounded-full before:bg-gradient-to-b before:from-teal-500 before:to-navy-700 before:flex-shrink-0">
        Tentang PKKMB-KT
      </h2>
      <p class="leading-[1.8] text-ink-600 text-sm m-0">
        Pengenalan Kehidupan Kampus bagi Mahasiswa Baru (PKKMB-KT) merupakan
        kegiatan awal yang bertujuan untuk membantu mahasiswa baru mengenal
        lingkungan kampus, budaya akademik, tata tertib, serta membangun
        karakter yang disiplin, bertanggung jawab, dan mampu beradaptasi
        dengan kehidupan perkuliahan.
      </p>
    </div>

    <div
      class="bg-surface rounded-[18px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] px-5 sm:px-[30px] py-[26px] mb-5">
      <h2
        class="font-display text-navy-900 text-[19px] font-bold mb-4 flex items-center gap-2.5 before:content-[''] before:w-[5px] before:h-5 before:rounded-full before:bg-gradient-to-b before:from-teal-500 before:to-navy-700 before:flex-shrink-0">
        Tata Tertib
      </h2>

      <h3 class="text-teal-600 text-[14.5px] font-bold mt-[18px] mb-2.5">
        Kehadiran
      </h3>
      <ul class="pl-5 mt-2.5">
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Hadir 15 menit sebelum kegiatan dimulai.
        </li>
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Wajib mengikuti seluruh rangkaian kegiatan PKKMB-KT.
        </li>
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Tidak diperkenankan meninggalkan kegiatan tanpa izin mentor atau
          panitia.
        </li>
      </ul>

      <h3 class="text-teal-600 text-[14.5px] font-bold mt-[18px] mb-2.5">
        Berpakaian
      </h3>
      <ul class="pl-5 mt-2.5">
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Menggunakan pakaian sesuai ketentuan panitia.
        </li>
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Berpenampilan rapi dan sopan.
        </li>
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Menggunakan atribut yang telah ditentukan.
        </li>
      </ul>

      <h3 class="text-teal-600 text-[14.5px] font-bold mt-[18px] mb-2.5">
        Sikap
      </h3>
      <ul class="pl-5 mt-2.5">
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Menghormati panitia, mentor, pemateri, dan sesama mahasiswa.
        </li>
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Menjaga ketertiban selama kegiatan berlangsung.
        </li>
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Tidak mengganggu jalannya kegiatan.
        </li>
      </ul>

      <h3 class="text-teal-600 text-[14.5px] font-bold mt-[18px] mb-2.5">
        Kebersihan
      </h3>
      <ul class="pl-5 mt-2.5">
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Menjaga kebersihan lingkungan kegiatan.
        </li>
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Membuang sampah pada tempatnya.
        </li>
      </ul>
    </div>

    <div
      class="bg-surface rounded-[18px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] px-5 sm:px-[30px] py-[26px] mb-5">
      <h2
        class="font-display text-navy-900 text-[19px] font-bold mb-4 flex items-center gap-2.5 before:content-[''] before:w-[5px] before:h-5 before:rounded-full before:bg-gradient-to-b before:from-teal-500 before:to-navy-700 before:flex-shrink-0">
        Atribut yang Harus Dibawa
      </h2>
      <ul class="pl-5 mt-2.5">
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          ID Card PKKMB.
        </li>
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Alat tulis.
        </li>
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Buku Panduan PKKMB.
        </li>
      </ul>
    </div>

    <div
      class="bg-surface rounded-[18px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] px-5 sm:px-[30px] py-[26px] mb-5">
      <h2
        class="font-display text-navy-900 text-[19px] font-bold mb-4 flex items-center gap-2.5 before:content-[''] before:w-[5px] before:h-5 before:rounded-full before:bg-gradient-to-b before:from-teal-500 before:to-navy-700 before:flex-shrink-0">
        Sistem Penilaian
      </h2>

      <h3 class="text-teal-600 text-[14.5px] font-bold mt-[18px] mb-2.5">
        ⭐ Aspek Keaktifan
      </h3>
      <table class="w-full border-collapse mt-3.5 rounded-[13px] overflow-hidden border border-border">
        <tr>
          <th class="bg-navy-900 text-white px-3.5 py-[13px] text-left text-[12.5px] font-bold">Aspek</th>
          <th width="120" class="bg-navy-900 text-white px-3.5 py-[13px] text-left text-[12.5px] font-bold">Poin</th>
        </tr>
        <tr class="bg-bg">
          <td class="px-3.5 py-[13px] border-b border-border text-[13.5px] text-ink-900">Aktif bertanya dan menjawab</td>
          <td class="px-3.5 py-[13px] border-b border-border text-[13.5px] text-ink-900"><span class="text-[#059669] font-extrabold bg-[#ecfdf5] px-2.5 py-[3px] rounded-full text-xs inline-block">+10</span></td>
        </tr>
        <tr>
          <td class="px-3.5 py-[13px] border-b border-border text-[13.5px] text-ink-900">Membantu teman</td>
          <td class="px-3.5 py-[13px] border-b border-border text-[13.5px] text-ink-900"><span class="text-[#059669] font-extrabold bg-[#ecfdf5] px-2.5 py-[3px] rounded-full text-xs inline-block">+5</span></td>
        </tr>
        <tr class="bg-bg">
          <td class="px-3.5 py-[13px] border-b border-border text-[13.5px] text-ink-900">Menjadi sukarelawan saat kegiatan</td>
          <td class="px-3.5 py-[13px] border-b border-border text-[13.5px] text-ink-900"><span class="text-[#059669] font-extrabold bg-[#ecfdf5] px-2.5 py-[3px] rounded-full text-xs inline-block">+7</span></td>
        </tr>
        <tr>
          <td class="px-3.5 py-[13px] text-[13.5px] text-ink-900">Menjaga kebersihan</td>
          <td class="px-3.5 py-[13px] text-[13.5px] text-ink-900"><span class="text-[#059669] font-extrabold bg-[#ecfdf5] px-2.5 py-[3px] rounded-full text-xs inline-block">+3</span></td>
        </tr>
      </table>

      <h3 class="text-teal-600 text-[14.5px] font-bold mt-[18px] mb-2.5">
        ⚠️ Aspek Pelanggaran
      </h3>
      <table class="w-full border-collapse mt-3.5 rounded-[13px] overflow-hidden border border-border">
        <tr>
          <th class="bg-navy-900 text-white px-3.5 py-[13px] text-left text-[12.5px] font-bold">Pelanggaran</th>
          <th width="120" class="bg-navy-900 text-white px-3.5 py-[13px] text-left text-[12.5px] font-bold">Poin</th>
        </tr>
        <tr class="bg-bg">
          <td class="px-3.5 py-[13px] border-b border-border text-[13.5px] text-ink-900">Tidak mengikuti kegiatan tanpa izin</td>
          <td class="px-3.5 py-[13px] border-b border-border text-[13.5px] text-ink-900"><span class="text-[#dc2626] font-extrabold bg-[#fef2f2] px-2.5 py-[3px] rounded-full text-xs inline-block">-15</span></td>
        </tr>
        <tr>
          <td class="px-3.5 py-[13px] border-b border-border text-[13.5px] text-ink-900">Tidak rapi / atribut tidak lengkap</td>
          <td class="px-3.5 py-[13px] border-b border-border text-[13.5px] text-ink-900"><span class="text-[#dc2626] font-extrabold bg-[#fef2f2] px-2.5 py-[3px] rounded-full text-xs inline-block">-5</span></td>
        </tr>
        <tr class="bg-bg">
          <td class="px-3.5 py-[13px] text-[13.5px] text-ink-900">Mengganggu jalannya kegiatan</td>
          <td class="px-3.5 py-[13px] text-[13.5px] text-ink-900"><span class="text-[#dc2626] font-extrabold bg-[#fef2f2] px-2.5 py-[3px] rounded-full text-xs inline-block">-10</span></td>
        </tr>
      </table>

      <div class="bg-teal-tint border-l-4 border-teal-500 px-[18px] py-4 rounded-[13px] mt-[18px] leading-[1.8] text-ink-600 text-[13.5px]">
        <b class="text-navy-900">Informasi:</b><br /><br />
        Seluruh poin keaktifan dan pelanggaran akan diinput oleh mentor
        melalui sistem PKKMB-KT. Nilai akan diakumulasikan secara otomatis dan
        digunakan sebagai dasar perhitungan
        <b class="text-navy-900">Leaderboard Mahasiswa</b>. Mahasiswa dengan poin tertinggi akan
        menempati peringkat teratas sebagai bentuk apresiasi atas keaktifan
        dan kedisiplinannya selama kegiatan berlangsung.
      </div>
    </div>

    <div
      class="bg-surface rounded-[18px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] px-5 sm:px-[30px] py-[26px] mb-5">
      <h2
        class="font-display text-navy-900 text-[19px] font-bold mb-4 flex items-center gap-2.5 before:content-[''] before:w-[5px] before:h-5 before:rounded-full before:bg-gradient-to-b before:from-teal-500 before:to-navy-700 before:flex-shrink-0">
        Reward &amp; Leaderboard
      </h2>
      <p class="leading-[1.8] text-ink-600 text-sm m-0">
        Mahasiswa yang memperoleh akumulasi poin tertinggi selama kegiatan
        PKKMB-KT akan mendapatkan apresiasi dari panitia sebagai bentuk
        penghargaan atas keaktifan, kedisiplinan, dan kontribusinya selama
        kegiatan berlangsung.
      </p>
      <ul class="pl-5 mt-2.5">
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Predikat Mahasiswa Teraktif PKKMB-KT.
        </li>
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Piagam atau penghargaan (sesuai kebijakan panitia).
        </li>
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Peringkat terbaik pada Leaderboard Mahasiswa.
        </li>
      </ul>
    </div>

    <div
      class="bg-surface rounded-[18px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] px-5 sm:px-[30px] py-[26px] mb-5">
      <h2
        class="font-display text-navy-900 text-[19px] font-bold mb-4 flex items-center gap-2.5 before:content-[''] before:w-[5px] before:h-5 before:rounded-full before:bg-gradient-to-b before:from-teal-500 before:to-navy-700 before:flex-shrink-0">
        Sanksi
      </h2>
      <p class="leading-[1.8] text-ink-600 text-sm m-0">
        Mahasiswa yang melakukan pelanggaran terhadap tata tertib PKKMB-KT
        akan diberikan sanksi sesuai tingkat pelanggaran yang dilakukan.
      </p>
      <ul class="pl-5 mt-2.5">
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Teguran lisan dari mentor.
        </li>
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Pengurangan poin penilaian.
        </li>
        <li class="mb-2.5 leading-[1.7] text-[13.5px] text-ink-600 marker:text-teal-500">
          Pembinaan oleh panitia apabila pelanggaran dilakukan secara
          berulang.
        </li>
      </ul>
    </div>
  </div>

  <!-- ============ FOOTER ============ -->
  <footer
    class="bg-[#0d1735] px-4 sm:px-8 md:px-12 py-7 flex flex-wrap justify-between items-center gap-3.5 mt-10 pb-[calc(74px+16px)] md:pb-7">
    <p class="text-[13px] text-[#4a6a9f] m-0">© 2026 PKKMB-KT UNILAM. Semua hak dilindungi.</p>
    <div class="flex gap-5">
      <a
        href="{{ route('landing.kebijakan-privasi') }}"
        class="text-[13px] text-[#4a6a9f] no-underline transition-colors hover:text-[#aeb6e0]">Kebijakan Privasi</a>
      <a
        href="{{ route('landing.syarat-ketentuan') }}"
        class="text-[13px] text-[#4a6a9f] no-underline transition-colors hover:text-[#aeb6e0]">Syarat &amp; Ketentuan</a>
      <a
        href="{{ route('landing.bantuan') }}"
        class="text-[13px] text-[#4a6a9f] no-underline transition-colors hover:text-[#aeb6e0]">Bantuan</a>
    </div>
  </footer>

  <!-- ======= BOTTOM NAV (mobile only) ======= -->
  <nav
    class="fixed bottom-0 left-0 right-0 h-[74px] bg-surface border-t border-border flex items-center justify-around px-1.5 pb-[env(safe-area-inset-bottom)] z-30 md:hidden"
    aria-label="Navigasi bawah">
    <a
      href="#"
      class="flex flex-col items-center gap-1 text-navy-900 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
        <path d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z" />
      </svg>
      <span>Modul</span>
    </a>
    <a
      href="{{ route('role.student.leaderboard') }}"
      class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
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
    <a
      href="{{ route('role.student.info') }}"
      class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 17H4l1.4-1.4A2 2 0 0 0 6 14.2V11a6 6 0 1 1 12 0v3.2c0 .5.2 1 .6 1.4L20 17h-5" />
        <path d="M9 17a3 3 0 0 0 6 0" />
      </svg>
      <span>Info</span>
    </a>
    <a
      href="{{ route('role.student.profil') }}"
      class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="8" r="3.4" />
        <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
      </svg>
      <span>Profil</span>
    </a>
  </nav>

  <script>
    // ======================================================================
    // ►► SLIDESHOW LATAR HERO — pakai jQuery. Ganti/tambah gambar di array ini.
    // ======================================================================
    $(function() {
      const heroSlideImages = [
        "{{ asset('gambar/gedungutama.jpeg') }}",
        "{{ asset('gambar/rektor.jpeg') }}",
        "{{ asset('gambar/gedung.jpeg') }}",
      ];
      const HERO_SLIDE_INTERVAL_MS = 6000;
      const $heroSlideshow = $("#heroSlideshow");
      const SLIDE_CLASS =
        "hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-[1800ms] ease-in-out";

      if ($heroSlideshow.length && heroSlideImages.length) {
        heroSlideImages.forEach((src, i) => {
          $("<div>")
            .addClass(SLIDE_CLASS)
            .addClass(i === 0 ? "opacity-100" : "opacity-0")
            .css("background-image", `url("${src}")`)
            .appendTo($heroSlideshow);
        });

        if (heroSlideImages.length > 1) {
          let currentSlide = 0;
          const $slides = $heroSlideshow.find(".hero-slide");
          setInterval(() => {
            $slides.eq(currentSlide).removeClass("opacity-100").addClass("opacity-0");
            currentSlide = (currentSlide + 1) % $slides.length;
            $slides.eq(currentSlide).removeClass("opacity-0").addClass("opacity-100");
          }, HERO_SLIDE_INTERVAL_MS);
        }
      }
    });
  </script>
</body>

</html>