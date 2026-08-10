{{-- resources/views/role/mentor/modul.blade.php --}}
@extends('layouts.mentor.main')

@section('title', 'Modul | PKKMB-KT UNILAM 2026')
@section('page-title', 'Modul Pembekalan')

@push('styles')
  <style type="text/tailwindcss">
    .modul-card { @apply bg-surface rounded-[18px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] mb-5; padding: 26px clamp(20px, 4vw, 30px); }
    .modul-card h2 { @apply font-display text-navy-900 text-[19px] font-bold mb-4 mt-0 flex items-center gap-2.5; }
    .modul-card h2 .dot { @apply w-[5px] h-5 rounded-full flex-shrink-0; background: linear-gradient(to bottom, var(--teal-500), var(--navy-700)); }
    .modul-card h3 { @apply text-teal-600 text-[14.5px] font-bold; margin: 18px 0 10px; }
    .modul-card ul { @apply pl-5 mt-2.5; }
    .modul-card ul li { @apply mb-2.5 leading-[1.7] text-[13.5px] text-ink-600; }
    .modul-card ul li::marker { color: var(--teal-500); }
    .modul-table { @apply w-full border-collapse rounded-[13px] overflow-hidden border border-border mt-3.5; }
    .modul-table th { @apply bg-navy-900 text-white text-left text-[12.5px] font-bold; padding: 13px 14px; }
    .modul-table td { @apply text-[13.5px] text-ink-900 border-b border-border; padding: 13px 14px; }
    .modul-table tr:last-child td { @apply border-b-0; }
    .modul-table tr:nth-child(even) td { @apply bg-bg; }
    .poin-plus { @apply text-plus-500 font-extrabold bg-plus-tint rounded-full text-xs inline-block; padding: 3px 10px; }
    .poin-minus { @apply text-minus-500 font-extrabold bg-minus-tint rounded-full text-xs inline-block; padding: 3px 10px; }
    .modul-note { @apply bg-teal-tint border-l-4 border-teal-500 rounded-[13px] mt-[18px] leading-[1.8] text-ink-600 text-[13.5px]; padding: 16px 18px; }
  </style>
@endpush

@section('content')

  <!-- ===== HERO ===== -->
  <section class="hero">
    <p class="hero-eyebrow">Panduan Peserta</p>
    <p class="hero-sub">Modul</p>
    <h2 class="hero-title">PKKMB-KT UNILAM 2026</h2>
    <p class="text-[13px] text-ink-600 mt-2 relative z-[1] max-w-[420px]">
      Kenali tata tertib, atribut wajib, dan sistem penilaian sebelum
      mengikuti seluruh rangkaian kegiatan PKKMB-KT.
    </p>
  </section>

  <!-- ===== TENTANG ===== -->
  <section class="section">
    <div class="modul-card">
      <h2><span class="dot"></span>Tentang PKKMB-KT</h2>
      <p class="leading-[1.8] text-ink-600 text-sm m-0">
        Pengenalan Kehidupan Kampus bagi Mahasiswa Baru (PKKMB-KT) merupakan
        kegiatan awal yang bertujuan untuk membantu mahasiswa baru mengenal
        lingkungan kampus, budaya akademik, tata tertib, serta membangun
        karakter yang disiplin, bertanggung jawab, dan mampu beradaptasi
        dengan kehidupan perkuliahan.
      </p>
    </div>

    <div class="modul-card">
      <h2><span class="dot"></span>Tata Tertib</h2>

      <h3>Kehadiran</h3>
      <ul>
        <li>Hadir 15 menit sebelum kegiatan dimulai.</li>
        <li>Wajib mengikuti seluruh rangkaian kegiatan PKKMB-KT.</li>
        <li>Tidak diperkenankan meninggalkan kegiatan tanpa izin mentor atau panitia.</li>
      </ul>

      <h3>Berpakaian</h3>
      <ul>
        <li>Menggunakan pakaian sesuai ketentuan panitia.</li>
        <li>Berpenampilan rapi dan sopan.</li>
        <li>Menggunakan atribut yang telah ditentukan.</li>
      </ul>

      <h3>Sikap</h3>
      <ul>
        <li>Menghormati panitia, mentor, pemateri, dan sesama mahasiswa.</li>
        <li>Menjaga ketertiban selama kegiatan berlangsung.</li>
        <li>Tidak mengganggu jalannya kegiatan.</li>
      </ul>

      <h3>Kebersihan</h3>
      <ul>
        <li>Menjaga kebersihan lingkungan kegiatan.</li>
        <li>Membuang sampah pada tempatnya.</li>
      </ul>
    </div>

    <div class="modul-card">
      <h2><span class="dot"></span>Atribut yang Harus Dibawa</h2>
      <ul>
        <li>ID Card PKKMB.</li>
        <li>Alat tulis.</li>
        <li>Buku Panduan PKKMB.</li>
      </ul>
    </div>

    <div class="modul-card">
      <h2><span class="dot"></span>Sistem Penilaian</h2>

      <h3>⭐ Aspek Keaktifan</h3>
      <table class="modul-table">
        <tr><th>Aspek</th><th width="120">Poin</th></tr>
        <tr><td>Aktif bertanya dan menjawab</td><td><span class="poin-plus">+10</span></td></tr>
        <tr><td>Membantu teman</td><td><span class="poin-plus">+5</span></td></tr>
        <tr><td>Menjadi sukarelawan saat kegiatan</td><td><span class="poin-plus">+7</span></td></tr>
        <tr><td>Menjaga kebersihan</td><td><span class="poin-plus">+3</span></td></tr>
      </table>

      <h3>⚠️ Aspek Pelanggaran</h3>
      <table class="modul-table">
        <tr><th>Pelanggaran</th><th width="120">Poin</th></tr>
        <tr><td>Tidak mengikuti kegiatan tanpa izin</td><td><span class="poin-minus">-15</span></td></tr>
        <tr><td>Tidak rapi / atribut tidak lengkap</td><td><span class="poin-minus">-5</span></td></tr>
        <tr><td>Mengganggu jalannya kegiatan</td><td><span class="poin-minus">-10</span></td></tr>
      </table>

      <div class="modul-note">
        <b class="text-navy-900">Informasi:</b><br /><br />
        Seluruh poin keaktifan dan pelanggaran akan diinput oleh mentor
        melalui sistem PKKMB-KT. Nilai akan diakumulasikan secara otomatis dan
        digunakan sebagai dasar perhitungan
        <b class="text-navy-900">Leaderboard Mahasiswa</b>. Mahasiswa dengan poin tertinggi akan
        menempati peringkat teratas sebagai bentuk apresiasi atas keaktifan
        dan kedisiplinannya selama kegiatan berlangsung.
      </div>
    </div>

    <div class="modul-card">
      <h2><span class="dot"></span>Reward &amp; Leaderboard</h2>
      <p class="leading-[1.8] text-ink-600 text-sm m-0">
        Mahasiswa yang memperoleh akumulasi poin tertinggi selama kegiatan
        PKKMB-KT akan mendapatkan apresiasi dari panitia sebagai bentuk
        penghargaan atas keaktifan, kedisiplinan, dan kontribusinya selama
        kegiatan berlangsung.
      </p>
      <ul>
        <li>Predikat Mahasiswa Teraktif PKKMB-KT.</li>
        <li>Piagam atau penghargaan (sesuai kebijakan panitia).</li>
        <li>Peringkat terbaik pada Leaderboard Mahasiswa.</li>
      </ul>
    </div>

    <div class="modul-card">
      <h2><span class="dot"></span>Sanksi</h2>
      <p class="leading-[1.8] text-ink-600 text-sm m-0">
        Mahasiswa yang melakukan pelanggaran terhadap tata tertib PKKMB-KT
        akan diberikan sanksi sesuai tingkat pelanggaran yang dilakukan.
      </p>
      <ul>
        <li>Teguran lisan dari mentor.</li>
        <li>Pengurangan poin penilaian.</li>
        <li>Pembinaan oleh panitia apabila pelanggaran dilakukan secara berulang.</li>
      </ul>
    </div>
  </section>

@endsection