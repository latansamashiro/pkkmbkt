<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Input Keaktifan &amp; Pelanggaran | PKKMB-KT UNILAM 2026</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet" />
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
        --font-sans: "Plus Jakarta Sans", sans-serif;
        --font-display: "Lora", serif;
      }
    </style>
  <style>
    @keyframes pulse {

      0%,
      100% {
        opacity: 1;
        transform: scale(1);
      }

      50% {
        opacity: .5;
        transform: scale(.8);
      }
    }

    @keyframes fadeInPreview {
      from {
        opacity: 0;
        transform: translateY(-4px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .preview-card-anim {
      animation: fadeInPreview .25s ease;
    }

    .select-chevron-wrap select {
      appearance: none;
      -webkit-appearance: none;
    }

    .dropdown-scroll::-webkit-scrollbar,
    .riwayat-scroll::-webkit-scrollbar {
      width: 6px;
    }

    .dropdown-scroll::-webkit-scrollbar-thumb,
    .riwayat-scroll::-webkit-scrollbar-thumb {
      background: #e1e5f1;
      border-radius: 10px;
    }

    /* ===== Toast notifikasi -- pola standar dipakai di semua halaman Mentor ===== */
    .save-toast {
      position: fixed;
      left: 50%;
      background: #152159;
      color: #fff;
      font-size: 12.5px;
      font-weight: 700;
      border-radius: 999px;
      box-shadow: 0 10px 24px rgba(21, 33, 89, 0.16);
      opacity: 0;
      pointer-events: none;
      z-index: 60;
      display: flex;
      align-items: center;
      gap: 8px;
      bottom: calc(74px + 16px);
      transform: translateX(-50%) translateY(20px);
      padding: 12px 22px;
      transition: opacity .25s, transform .25s;
    }
    .save-toast.show {
      opacity: 1;
      transform: translateX(-50%) translateY(0);
    }
    .save-toast svg {
      width: 15px;
      height: 15px;
      color: #a9c73b;
    }
    @media (min-width: 768px) {
      .save-toast {
        bottom: 16px;
      }
    }
  </style>
</head>

<body class="font-sans text-ink-900 m-0 bg-bg antialiased min-h-screen flex flex-col">
  <header class="sticky top-0 z-50 flex items-center justify-between gap-4 bg-navy-900 border-b border-white/10" style="padding: 14px clamp(16px,5vw,48px);">
    <div class="flex items-center gap-2.5 no-underline cursor-default" aria-label="PKKMB-KT UNILAM">
      <div class="w-[38px] h-[38px] rounded-full bg-white flex items-center justify-center overflow-hidden flex-shrink-0">
        <img src="{{ asset('gambar/unilam.webp') }}" alt="Logo UNILAM" class="w-full h-full object-contain" />
      </div>
      <div>
        <strong class="block font-display text-[14.5px] text-white">SIMBA</strong>
        <span class="text-[10.5px] text-[#aeb6e0] tracking-[0.04em]">UNILAM 2026</span>
      </div>
    </div>
    <nav class="hidden md:flex gap-7">
      <a href="{{ route('role.mentor.modul') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline hover:text-white">Modul</a>
      <a href="{{ route('role.mentor.leaderboard') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline hover:text-white">Leaderboard</a>
      <a href="{{ route('dashboard') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline hover:text-white">Dashboard</a>
      <a href="{{ route('role.mentor.info') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline hover:text-white">Info</a>
      <a href="{{ route('role.mentor.profil') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline hover:text-white">Profil</a>
    </nav>
  </header>

  <section class="relative overflow-hidden" style="padding: clamp(36px,6vw,56px) clamp(16px,5vw,48px);">
    <div class="absolute inset-0 z-0 overflow-hidden after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-br after:from-navy-900/[0.94] after:to-teal-600/[0.85]" id="heroSlideshow"></div>
    <div class="relative z-[1] max-w-[1200px] mx-auto">
      <h1 class="font-display font-bold text-white mb-3 leading-[1.2] m-0" style="font-size: clamp(24px,4vw,38px);">Keaktifan &amp; Pelanggaran</h1>
      <p class="text-sm text-white/75 leading-[1.7] m-0" style="max-width: 620px;">
        Cari dan pilih mahasiswa dulu, lalu pilih indikator keaktifan atau
        pelanggaran yang sesuai — poinnya sudah ditentukan otomatis sesuai
        Ketentuan Poin Keaktifan, mentor tidak bisa mengubahnya bebas.
      </p>
    </div>
  </section>

  <main class="max-w-[1000px] mx-auto w-full flex-1" style="padding: 28px clamp(16px,5vw,48px) calc(74px + 28px);">
    <div class="inline-flex items-center gap-2 bg-surface border-[1.5px] border-border rounded-full mb-[18px] shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)]" style="padding: 9px 18px 9px 8px;">
      <span class="w-[30px] h-[30px] rounded-full bg-navy-900 text-white flex items-center justify-center">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-3.5 h-3.5">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
          <circle cx="9" cy="7" r="4" />
          <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
          <path d="M16 3.13a4 4 0 0 1 0 7.75" />
        </svg>
      </span>
      <strong class="text-[13.5px] font-extrabold text-navy-900" id="kelompokNama">{{ $group->name ?? 'Belum ada kelompok' }}</strong>
    </div>

    {{-- ===== CARI & PILIH MAHASISWA ===== --}}
    <div class="relative mb-5" style="z-index: 20;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-[15px] h-[15px] text-ink-400 pointer-events-none">
        <circle cx="11" cy="11" r="8" />
        <line x1="21" y1="21" x2="16.65" y2="16.65" />
      </svg>
      <input type="text" id="searchInput" autocomplete="off" placeholder="Cari nama atau NPM mahasiswa..." class="w-full bg-surface border-[1.5px] border-border rounded-full font-sans text-[13.5px] font-medium shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] outline-none focus:border-teal-500 focus:shadow-[0_0_0_3px_rgba(22,160,161,0.12)]" style="padding: 12px 16px 12px 40px;" />

      <div id="searchDropdown" class="hidden dropdown-scroll absolute left-0 right-0 mt-2 bg-surface border-[1.5px] border-border rounded-2xl shadow-[0_10px_24px_rgba(21,33,89,0.16)] divide-y divide-border overflow-y-auto" style="max-height: 320px;"></div>
      <p id="searchEmptyState" class="hidden text-[12px] text-ink-400 font-semibold mt-2.5 pl-1">Tidak ada mahasiswa yang cocok. Coba kata kunci lain.</p>
    </div>

    {{-- ===== BELUM PILIH MAHASISWA ===== --}}
    <div id="belumPilihState" class="text-center bg-surface border border-dashed border-border rounded-2xl" style="padding: 48px 24px;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="w-10 h-10 mx-auto mb-3 text-ink-400">
        <circle cx="11" cy="11" r="8" />
        <line x1="21" y1="21" x2="16.65" y2="16.65" />
      </svg>
      <p class="text-[13.5px] font-bold text-ink-600 m-0">Cari nama mahasiswa dulu di atas</p>
      <p class="text-[12px] text-ink-400 mt-1 m-0">Baru form catat poinnya muncul di sini.</p>
    </div>

    {{-- ===== KONTEN SETELAH MAHASISWA DIPILIH ===== --}}
    <div id="kontenMahasiswa" class="hidden">
      {{-- Kartu ringkas mahasiswa terpilih --}}
      <div class="flex items-center gap-3.5 bg-surface border-[1.5px] border-border rounded-2xl mb-5" style="padding: 16px 18px;">
        <span class="w-11 h-11 rounded-full bg-navy-tint text-navy-700 flex items-center justify-center font-extrabold text-[14px] flex-shrink-0" id="selMhsAvatar"></span>
        <div class="min-w-0">
          <p class="text-[14px] font-bold m-0 truncate" id="selMhsNama"></p>
          <p class="text-[11.5px] text-ink-400 mt-0.5 mb-0" id="selMhsNpm"></p>
        </div>
        <div class="ml-auto text-right shrink-0">
          <div class="font-display text-xl font-bold leading-none" id="selMhsTotal">0</div>
          <div class="text-[9px] text-ink-400 font-bold uppercase tracking-wide">Total Poin</div>
        </div>
        <button type="button" id="btnGantiMhs" class="shrink-0 text-[11px] font-bold text-ink-400 hover:text-teal-600 bg-bg hover:bg-teal-tint border border-border rounded-lg transition-colors" style="padding: 8px 12px;">
          Ganti
        </button>
      </div>

      {{-- 2 panel: Keaktifan & Pelanggaran --}}
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- PANEL KEAKTIFAN --}}
        <div class="bg-surface border border-border rounded-2xl flex flex-col shadow-[0_4px_18px_rgba(21,33,89,0.06)]" style="padding: 28px 26px 26px;">
          <div class="flex items-center gap-3.5 mb-5">
            <span class="w-11 h-11 rounded-full bg-teal-tint text-teal-600 flex items-center justify-center flex-shrink-0">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path d="M12 2l2.9 6.3 6.9.9-5 4.8 1.3 6.8L12 17.6 5.9 20.8l1.3-6.8-5-4.8 6.9-.9z" /></svg>
            </span>
            <div>
              <p class="font-display text-[19px] font-bold text-navy-900 m-0">Apresiasi Keaktifan</p>
              <p class="text-[13px] text-ink-400 mt-0.5 m-0">Penambahan poin</p>
            </div>
          </div>

          <label class="block text-[11.5px] font-bold uppercase tracking-wide text-ink-400 mb-2">Pilih Indikator</label>
          <div class="relative mb-4">
            <button type="button" id="triggerKeaktifan" class="w-full flex items-center justify-between gap-2 bg-bg border-[1.5px] border-border rounded-xl text-[14.5px] font-semibold text-ink-900 outline-none focus:border-teal-500 cursor-pointer text-left" style="padding: 13px 14px;">
              <span id="triggerKeaktifanLabel" class="truncate text-ink-400">— Pilih indikator —</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-[18px] h-[18px] text-ink-400 flex-shrink-0"><path d="m6 9 6 6 6-6" /></svg>
            </button>
            <div id="panelKeaktifan" class="hidden absolute left-0 right-0 mt-2 bg-surface border-[1.5px] border-border rounded-xl shadow-[0_10px_24px_rgba(21,33,89,0.16)] overflow-y-auto z-20 dropdown-scroll" style="max-height: 320px;"></div>
          </div>

          <div id="poinKeaktifanBox" class="hidden flex-col rounded-xl mb-4 border-[1.5px] border-teal-500/30 bg-teal-tint preview-card-anim" style="padding: 16px 16px 15px;">
            <div class="flex items-center justify-between mb-1.5">
              <span class="font-bold text-[14.5px] text-navy-900" id="poinKeaktifanKategori">-</span>
              <span class="font-display font-bold text-[16px] text-teal-600" id="poinKeaktifanVal">+0</span>
            </div>
            <p class="text-[13px] leading-[1.5] text-ink-600 m-0" id="poinKeaktifanDesc">-</p>
          </div>

          <label class="block text-[11.5px] font-bold uppercase tracking-wide text-ink-400 mb-2">Catatan (Opsional)</label>
          <textarea id="catatanKeaktifan" rows="3" placeholder="Tambahkan catatan..." class="w-full bg-bg border-[1.5px] border-border rounded-xl text-[14px] text-ink-900 outline-none focus:border-teal-500 resize-y mb-5" style="padding: 13px 14px; min-height: 78px;"></textarea>

          <button type="button" id="btnSimpanKeaktifan" disabled class="mt-auto w-full disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold text-[14.5px] rounded-xl transition-transform hover:-translate-y-0.5 flex items-center justify-center gap-2" style="padding: 15px 18px; background: linear-gradient(180deg, #16a0a1 0%, #0f8a8c 100%); box-shadow: 0 8px 18px -6px rgba(15,138,140,.45);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" class="w-[18px] h-[18px]"><circle cx="12" cy="12" r="10" /><path d="M12 8v8M8 12h8" /></svg>
            Simpan &amp; Tambah Poin
          </button>
        </div>

        {{-- PANEL PELANGGARAN --}}
        <div class="bg-surface border border-border rounded-2xl flex flex-col shadow-[0_4px_18px_rgba(21,33,89,0.06)]" style="padding: 28px 26px 26px;">
          <div class="flex items-center gap-3.5 mb-5">
            <span class="w-11 h-11 rounded-full flex items-center justify-center flex-shrink-0" style="background:#fdeeec; color:#d9695a;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z" /><path d="M12 9v4M12 17h.01" /></svg>
            </span>
            <div>
              <p class="font-display text-[19px] font-bold text-navy-900 m-0">Log Pelanggaran</p>
              <p class="text-[13px] text-ink-400 mt-0.5 m-0">Pengurangan poin</p>
            </div>
          </div>

          <label class="block text-[11.5px] font-bold uppercase tracking-wide text-ink-400 mb-2">Pilih Indikator</label>
          <div class="relative mb-4">
            <button type="button" id="triggerPelanggaran" class="w-full flex items-center justify-between gap-2 bg-bg border-[1.5px] border-border rounded-xl text-[14.5px] font-semibold text-ink-900 outline-none cursor-pointer text-left" style="padding: 13px 14px;">
              <span id="triggerPelanggaranLabel" class="truncate text-ink-400">— Pilih indikator —</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-[18px] h-[18px] text-ink-400 flex-shrink-0"><path d="m6 9 6 6 6-6" /></svg>
            </button>
            <div id="panelPelanggaran" class="hidden absolute left-0 right-0 mt-2 bg-surface border-[1.5px] border-border rounded-xl shadow-[0_10px_24px_rgba(21,33,89,0.16)] overflow-y-auto z-20 dropdown-scroll" style="max-height: 320px;"></div>
          </div>

          <div id="poinPelanggaranBox" class="hidden flex-col rounded-xl mb-4 preview-card-anim" style="padding: 16px 16px 15px; background:#fdeeec; border: 1.5px solid #f5d3cd;">
            <div class="flex items-center justify-between mb-1.5">
              <span class="font-bold text-[14.5px] text-navy-900" id="poinPelanggaranKategori">-</span>
              <span class="font-display font-bold text-[16px]" style="color:#d9695a;" id="poinPelanggaranVal">-0</span>
            </div>
            <p class="text-[13px] leading-[1.5] text-ink-600 m-0" id="poinPelanggaranDesc">-</p>
          </div>

          <label class="block text-[11.5px] font-bold uppercase tracking-wide text-ink-400 mb-2">Catatan / Kronologi</label>
          <textarea id="catatanPelanggaran" rows="3" placeholder="Tambahkan kronologi..." class="w-full bg-bg border-[1.5px] border-border rounded-xl text-[14px] text-ink-900 outline-none resize-y mb-5" style="padding: 13px 14px; min-height: 78px;" onfocus="this.style.borderColor='#d9695a'" onblur="this.style.borderColor=''"></textarea>

          <button type="button" id="btnSimpanPelanggaran" disabled class="mt-auto w-full disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold text-[14.5px] rounded-xl transition-transform hover:-translate-y-0.5 flex items-center justify-center gap-2" style="padding: 15px 18px; background: linear-gradient(180deg, #e8877a 0%, #d9695a 100%); box-shadow: 0 8px 18px -6px rgba(217,105,90,.5);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" class="w-[18px] h-[18px]"><circle cx="12" cy="12" r="10" /><path d="M8 12h8" /></svg>
            Simpan &amp; Kurangi Poin
          </button>
        </div>
      </div>

      {{-- Riwayat --}}
      <div class="bg-surface border-[1.5px] border-border rounded-2xl mt-5" style="padding: 18px 20px;">
        <p class="text-[13px] font-bold m-0 mb-3">Riwayat Poin</p>
        <p id="riwayatLoading" class="text-center text-[12px] text-ink-400 font-semibold" style="padding: 14px 0;">Memuat riwayat...</p>
        <div id="riwayatList" class="riwayat-scroll" style="max-height: 260px; overflow-y: auto;"></div>
      </div>
    </div>
  </main>

  <div class="save-toast" id="saveToast">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
      <path d="M20 6 9 17l-5-5" />
    </svg>
    <span class="toast-text">Poin tersimpan</span>
  </div>

  <!-- ============ MODAL KONFIRMASI SIMPAN POIN ============ -->
  <div id="modalKonfirmasiPoin" class="fixed inset-0 bg-[#0a0f28]/50 hidden items-center justify-center z-[100] p-4">
    <div class="bg-surface rounded-[22px] w-full max-w-sm p-6 relative shadow-[0_20px_50px_rgba(10,15,40,0.35)]">
      <button type="button" id="btnTutupKonfirmasi" aria-label="Tutup" class="absolute top-4 right-4 w-8 h-8 rounded-full flex items-center justify-center text-ink-400 hover:bg-bg hover:text-ink-900 transition-colors">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="w-[18px] h-[18px]"><path d="M18 6 6 18" /><path d="m6 6 12 12" /></svg>
      </button>

      <div id="konfirmasiIconWrap" class="w-14 h-14 rounded-full flex items-center justify-center mb-4">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7">
          <circle cx="12" cy="12" r="10" />
          <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
          <path d="M12 17h.01" />
        </svg>
      </div>

      <h3 class="font-display text-[19px] font-bold text-navy-900 m-0 mb-1.5">Konfirmasi Poin</h3>
      <p class="text-[13.5px] text-ink-600 leading-[1.6] m-0 mb-4">Pastikan sudah memilih indikator penilaian dengan benar sebelum disimpan.</p>

      <div id="konfirmasiRingkasan" class="rounded-xl bg-bg border border-border px-3.5 py-3 mb-5">
        <div class="flex items-center justify-between mb-1">
          <span id="konfirmasiKategori" class="text-[13.5px] font-bold text-navy-900">-</span>
          <span id="konfirmasiPoinVal" class="font-display text-[15px] font-extrabold">-</span>
        </div>
        <p id="konfirmasiIndikator" class="text-[12px] text-ink-600 m-0 leading-[1.5]">-</p>
      </div>

      <div class="flex items-center gap-3">
        <button type="button" id="btnBatalKonfirmasi" class="flex-1 border border-border text-ink-600 hover:bg-bg font-bold text-[13.5px] rounded-xl transition-colors" style="padding: 12px 16px;">Pilih Lagi</button>
        <button type="button" id="btnYaKonfirmasi" class="flex-1 text-white font-bold text-[13.5px] rounded-xl transition-transform hover:-translate-y-0.5" style="padding: 12px 16px;">Ya, Simpan</button>
      </div>
    </div>
  </div>

  <footer class="bg-[#0d1735] flex flex-wrap justify-between items-center gap-3.5" style="padding: 24px clamp(16px,5vw,48px) calc(74px + 16px);">
    <p class="text-[13px] text-[#4a6a9f] m-0">© 2026 PKKMB-KT UNILAM. Semua hak dilindungi.</p>
    <div class="flex gap-5">
      <a href="{{ route('landing.kebijakan-privasi') }}" class="text-[13px] text-[#4a6a9f] no-underline hover:text-[#aeb6e0]">Kebijakan Privasi</a>
      <a href="{{ route('landing.syarat-ketentuan') }}" class="text-[13px] text-[#4a6a9f] no-underline hover:text-[#aeb6e0]">Syarat &amp; Ketentuan</a>
      <a href="{{ route('landing.bantuan') }}" class="text-[13px] text-[#4a6a9f] no-underline hover:text-[#aeb6e0]">Bantuan</a>
    </div>
  </footer>

  <nav class="fixed bottom-0 left-0 right-0 h-[74px] bg-surface border-t border-border flex items-center justify-around px-1.5 pb-[env(safe-area-inset-bottom)] z-30 md:hidden" aria-label="Navigasi bawah">
    <a href="{{ route('role.mentor.modul') }}" class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
        <path d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z" />
      </svg>
      <span>Modul</span>
    </a>
    <a href="{{ route('role.mentor.leaderboard') }}" class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z" />
        <path d="M5 21v-5M12 21v-7M19 21v-4" />
      </svg>
      <span>Leaderboard</span>
    </a>
    <a href="{{ route('dashboard') }}" class="flex-none flex flex-col items-center justify-center text-white -mt-[30px] bg-navy-900 w-[54px] h-[54px] rounded-full shadow-[0_10px_24px_rgba(21,33,89,0.16)] no-underline [&>span]:hidden" aria-label="Beranda">
      <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 11.5 12 4l8 7.5" />
        <path d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10" />
      </svg>
      <span>Beranda</span>
    </a>
    <a href="{{ route('role.mentor.info') }}" class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="9" />
            <path d="M12 11v5" />
            <path d="M12 8h.01" />
      </svg>
      <span>Info</span>
    </a>
    <a href="{{ route('role.mentor.profil') }}" class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="8" r="3.4" />
        <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
      </svg>
      <span>Profil</span>
    </a>
  </nav>

  <script>
    $(function() {
      const CSRF_TOKEN = @json(csrf_token());
      const URL_BASE = "{{ url('mentor/keaktifan') }}"; // POST simpan | GET /{id}/riwayat

      // ======================================================================
      // ►► ANGGOTA KELOMPOK — dari database (real), bukan dummy lagi.
      // ======================================================================
      const ANGGOTA_KELOMPOK = @json($anggotaKelompok);

      // ======================================================================
      // ►► DAFTAR INDIKATOR KEAKTIFAN & PELANGGARAN — sumber: Excel "Kriteria
      // Penambahan dan Pengurangan Poin Keaktifan Peserta" (REVISI 07/08/2026).
      // Poinnya FIXED sesuai dokumen ini, mentor tinggal pilih indikatornya.
      // ======================================================================
      const KATEGORI_KEAKTIFAN = [
        { kategori: "Apresiasi Khusus", indikator: "Menjadi Petugas Protokoler/Acara Pembukaan Resmi (Pembaca Janji Mahasiswa, Panca Jiwa, Visi-Misi, Moto UNILAM, Tridarma, Dirigen, atau Pembaca Doa).", poin: 20 },
        { kategori: "Kepemimpinan", indikator: "Terpilih dan menjalankan tanggung jawab sebagai Ketua Kelompok yang dedikatif.", poin: 20 },
        { kategori: "Partisipasi Aktif", indikator: "Aktif bertanya secara kritis, logis, dan santun dalam sesi diskusi materi.", poin: 15 },
        { kategori: "Partisipasi Aktif", indikator: "Aktif memberikan jawaban, tanggapan, atau opini yang solutif atas pemantik narasumber.", poin: 15 },
        { kategori: "Kelengkapan Tugas", indikator: "Mengerjakan seluruh tugas individu dan kelompok secara jujur, mandiri, dan bebas plagiarisme tepat waktu.", poin: 15 },
        { kategori: "Tugas & Disiplin", indikator: "Mengunggah Video Perkenalan diri kreatif di media sosial tepat waktu sesuai ketentuan.", poin: 10 },
        { kategori: "Tugas & Disiplin", indikator: "Video terbaik dengan jumlah like dan komen terbanyak, tag medsosnya Unilam.", poin: 15 },
        { kategori: "Tugas & Disiplin", indikator: "Hadir dan tepat waktu di setiap sesi kegiatan.", poin: 15 },
        { kategori: "Kerapian & Atribut", indikator: "Lengkap memakai atribut resmi dan standar pakaian peserta PKKMB-KT UNILAM.", poin: 5 },
        { kategori: "Kerapian & Atribut", indikator: "Membawa seluruh perlengkapan wajib harian yang telah ditentukan oleh panitia.", poin: 5 },
        { kategori: "Partisipasi Aktif", indikator: "Menunjukan sikap proaktif dan sukarelawan selama kegiatan PKKMB-KT berlangsung.", poin: 5 },
      ];

      const KATEGORI_PELANGGARAN = [
        { kategori: "Pelanggaran Berat", indikator: "Melakukan tindakan pencurian, penggelapan, perusakan fasilitas secara sengaja, atau tindak kriminalitas lainnya yang melanggar hukum pidana.", poin: 20 },
        { kategori: "Pelanggaran Berat", indikator: "Membawa, menggunakan, atau mengonsumsi rokok, vape, minuman keras, dan Narkotika/zat terlarang di lingkungan kampus.", poin: 20 },
        { kategori: "Pelanggaran Berat", indikator: "Melakukan segala bentuk kekerasan fisik, verbal, psikologis, perundungan (bullying), maupun tekanan berbasis gender dan kekuasaan.", poin: 20 },
        { kategori: "Pelanggaran Berat", indikator: "Melakukan tindakan pelecehan seksual baik dalam bentuk candaan, komentar, gestur, maupun perbuatan tidak pantas lainnya.", poin: 20 },
        { kategori: "Pelanggaran Berat", indikator: "Menyebarkan berita bohong (hoax), provokasi isu SARA, atau ujaran kebencian di lingkungan PKKMB-KT.", poin: 20 },
        { kategori: "Pelanggaran Etika", indikator: "Bertindak tidak sopan atau menunjukkan perilaku tidak menghormati panitia, dosen, mentor, pembimbing, dan narasumber.", poin: 15 },
        { kategori: "Pelanggaran Etika", indikator: "Tidak menghargai pendapat, mencela perbedaan, atau memicu konflik horizontal sesama peserta.", poin: 15 },
        { kategori: "Pelanggaran Etika", indikator: "Menimbulkan keonaran, kegaduhan, atau melakukan aktivitas yang mengganggu jalannya proses kegiatan.", poin: 15 },
        { kategori: "Pelanggaran Disiplin", indikator: "Datang terlambat atau tidak tepat waktu tanpa alasan yang dibenarkan.", poin: 10 },
        { kategori: "Pelanggaran Disiplin", indikator: "Menggunakan gawai/handphone selama sesi materi berlangsung, kecuali atas instruksi resmi panitia.", poin: 10 },
        { kategori: "Pelanggaran Disiplin", indikator: "Meninggalkan area atau sesi acara PKKMB-KT tanpa izin resmi dari Pembimbing dan Mentor kelompok.", poin: 10 },
        { kategori: "Pelanggaran Disiplin", indikator: "Menerima tamu kunjungan selama acara berlangsung tanpa izin resmi.", poin: 10 },
        { kategori: "Pelanggaran Tugas", indikator: "Terlambat/tidak mengumpulkan tugas individu/kelompok dari batas waktu ditentukan.", poin: 5 },
        { kategori: "Pelanggaran Umum", indikator: "Tidak menjaga kebersihan lingkungan (nyampah), keindahan, kerapian, atau tidak ikut merawat fasilitas kampus.", poin: 5 },
        { kategori: "Pelanggaran Umum", indikator: "Tidak lengkap memakai atribut resmi atau melanggar standar pakaian peserta PKKMB-KT UNILAM.", poin: 5 },
      ];

      let mhsAktif = null;
      let keaktifanTerpilih = null;
      let pelanggaranTerpilih = null;

      function getInitials(nama) {
        return nama.split(" ").filter(Boolean).slice(0, 2).map((s) => s[0]).join("").toUpperCase();
      }

      // ---------- Dropdown indikator kustom (ganti <select> bawaan browser
      // biar tampilannya bisa diatur penuh & senada sama desain kartu) ----------
      function bangunDropdownIndikator(opts) {
        const { $trigger, $label, $panel, daftar, warnaAktif, onPilih } = opts;

        // Kelompokkan per kategori, render sebagai daftar dengan judul grup.
        const grup = {};
        daftar.forEach((it) => {
          if (!grup[it.kategori]) grup[it.kategori] = [];
          grup[it.kategori].push(it);
        });
        let html = "";
        Object.keys(grup).forEach((kat) => {
          html += `<p class="text-[10.5px] font-extrabold uppercase tracking-wide text-ink-400 px-3.5 pt-3 pb-1">${kat}</p>`;
          grup[kat].forEach((it, idx) => {
            const indeksGlobal = daftar.indexOf(it);
            html += `
              <button type="button" data-indeks="${indeksGlobal}" class="opsi-indikator w-full text-left px-3.5 py-2.5 text-[13px] text-ink-900 hover:bg-bg transition-colors leading-snug">
                ${it.indikator}
              </button>
            `;
          });
        });
        $panel.html(html);

        function pilihIndikator(indeks, tutupPanel = true) {
          const it = daftar[indeks];
          $label.text(it.indikator).removeClass("text-ink-400");
          if (tutupPanel) $panel.addClass("hidden");
          onPilih(it);
        }

        $panel.find(".opsi-indikator").on("click", function() {
          pilihIndikator($(this).data("indeks"));
        });

        $trigger.on("click", function(e) {
          e.stopPropagation();
          const sedangTerbuka = !$panel.hasClass("hidden");
          $(".panel-indikator-kustom").addClass("hidden");
          if (!sedangTerbuka) $panel.removeClass("hidden");
        });

        // Default: belum ada yang kepilih -- mentor harus pilih manual dulu.
      }

      const $panelKeaktifan = $("#panelKeaktifan").addClass("panel-indikator-kustom");
      const $panelPelanggaran = $("#panelPelanggaran").addClass("panel-indikator-kustom");

      bangunDropdownIndikator({
        $trigger: $("#triggerKeaktifan"),
        $label: $("#triggerKeaktifanLabel"),
        $panel: $panelKeaktifan,
        daftar: KATEGORI_KEAKTIFAN,
        onPilih: function(it) {
          keaktifanTerpilih = it;
          $("#btnSimpanKeaktifan").prop("disabled", false);
          $("#poinKeaktifanVal").text(`+${it.poin}`);
          $("#poinKeaktifanKategori").text(it.kategori);
          $("#poinKeaktifanDesc").text(it.indikator);
          $("#poinKeaktifanBox").removeClass("hidden").addClass("flex");
        },
      });

      bangunDropdownIndikator({
        $trigger: $("#triggerPelanggaran"),
        $label: $("#triggerPelanggaranLabel"),
        $panel: $panelPelanggaran,
        daftar: KATEGORI_PELANGGARAN,
        onPilih: function(it) {
          pelanggaranTerpilih = it;
          $("#btnSimpanPelanggaran").prop("disabled", false);
          $("#poinPelanggaranVal").text(`-${it.poin}`);
          $("#poinPelanggaranKategori").text(it.kategori);
          $("#poinPelanggaranDesc").text(it.indikator);
          $("#poinPelanggaranBox").removeClass("hidden").addClass("flex");
        },
      });

      // Tutup panel kalau klik di luar area dropdown.
      $(document).on("click", function(e) {
        if (!$(e.target).closest("#triggerKeaktifan, #panelKeaktifan, #triggerPelanggaran, #panelPelanggaran").length) {
          $(".panel-indikator-kustom").addClass("hidden");
        }
      });

      // ---------- Combobox cari & pilih mahasiswa ----------
      const $searchInput = $("#searchInput");
      const $dropdown = $("#searchDropdown");
      const $emptyState = $("#searchEmptyState");

      function filterMhs(q) {
        q = q.trim().toLowerCase();
        if (!q) return ANGGOTA_KELOMPOK;
        return ANGGOTA_KELOMPOK.filter((m) => m.nama.toLowerCase().includes(q) || m.npm.includes(q));
      }

      function renderDropdown(list) {
        if (list.length === 0) {
          $dropdown.addClass("hidden").html("");
          $emptyState.removeClass("hidden");
          return;
        }
        $emptyState.addClass("hidden");
        const html = list.map((m) => `
          <button type="button" data-id="${m.id}" class="mhs-option w-full flex items-center gap-3 text-left hover:bg-teal-tint transition-colors" style="padding: 12px 16px;">
            <span class="w-9 h-9 shrink-0 rounded-lg bg-navy-tint text-navy-700 flex items-center justify-center font-extrabold text-[12px]">${getInitials(m.nama)}</span>
            <span class="min-w-0">
              <span class="block text-[13px] font-bold text-ink-900 truncate">${m.nama}</span>
              <span class="block text-[11px] text-ink-400">NPM ${m.npm}</span>
            </span>
          </button>
        `).join("");
        $dropdown.html(html).removeClass("hidden");
        $dropdown.find(".mhs-option").on("click", function() {
          pilihMhs($(this).data("id"));
        });
      }

      function pilihMhs(id) {
        const m = ANGGOTA_KELOMPOK.find((x) => String(x.id) === String(id));
        if (!m) return;
        mhsAktif = m;

        $searchInput.val(m.nama);
        $dropdown.addClass("hidden");
        $emptyState.addClass("hidden");

        $("#selMhsAvatar").text(getInitials(m.nama));
        $("#selMhsNama").text(m.nama);
        $("#selMhsNpm").text(`NPM ${m.npm}`);

        $("#belumPilihState").addClass("hidden");
        $("#kontenMahasiswa").removeClass("hidden");

        // reset pilihan indikator & catatan tiap ganti mahasiswa -- balik ke
        // "belum pilih apa-apa" biar gak kebawa pilihan mahasiswa sebelumnya.
        keaktifanTerpilih = null;
        pelanggaranTerpilih = null;
        $("#triggerKeaktifanLabel").text("— Pilih indikator —").addClass("text-ink-400");
        $("#triggerPelanggaranLabel").text("— Pilih indikator —").addClass("text-ink-400");
        $("#poinKeaktifanBox, #poinPelanggaranBox").addClass("hidden").removeClass("flex");
        $("#btnSimpanKeaktifan, #btnSimpanPelanggaran").prop("disabled", true);
        $("#catatanKeaktifan, #catatanPelanggaran").val("");

        muatRiwayat();
      }

      $searchInput.on("focus", () => renderDropdown(filterMhs($searchInput.val())));
      $searchInput.on("input", () => renderDropdown(filterMhs($searchInput.val())));
      $(document).on("click", (e) => {
        if (!$searchInput.is(e.target) && !$dropdown.is(e.target) && $dropdown.has(e.target).length === 0) {
          $dropdown.addClass("hidden");
        }
      });

      $("#btnGantiMhs").on("click", function() {
        mhsAktif = null;
        $searchInput.val("").focus();
        $("#kontenMahasiswa").addClass("hidden");
        $("#belumPilihState").removeClass("hidden");
      });

      // ---------- Riwayat ----------
      function muatRiwayat() {
        if (!mhsAktif) return;
        $("#riwayatLoading").removeClass("hidden");
        $("#riwayatList").html("");

        $.get(`${URL_BASE}/${mhsAktif.id}/riwayat`)
          .done(function(res) {
            $("#selMhsTotal").text(res.total >= 0 ? `+${res.total}` : res.total)
              .css("color", res.total >= 0 ? "#16a34a" : "#dc2626");

            if (!res.riwayat || res.riwayat.length === 0) {
              $("#riwayatList").html(`<p class="text-center text-[12px] text-ink-400 font-semibold" style="padding:14px 0;">Belum ada catatan poin.</p>`);
              return;
            }
            const html = res.riwayat.map((r) => `
              <div class="flex justify-between gap-3 border-t border-dashed border-border first:border-t-0" style="padding: 10px 2px;">
                <div class="min-w-0">
                  <p class="text-[12px] font-bold text-ink-900 m-0 truncate">${r.kategori}</p>
                  <p class="text-[11px] text-ink-400 m-0 mt-0.5">${r.deskripsi}</p>
                  <p class="text-[10px] text-ink-400 m-0 mt-0.5">${r.tanggal}</p>
                </div>
                <span class="font-extrabold text-[13px] shrink-0" style="color: ${r.poin >= 0 ? '#16a34a' : '#dc2626'};">${r.poin >= 0 ? '+' : ''}${r.poin}</span>
              </div>
            `).join("");
            $("#riwayatList").html(html);
          })
          .fail(function() {
            $("#riwayatList").html(`<p class="text-center text-[12px] text-ink-400 font-semibold" style="padding:14px 0;">Gagal memuat riwayat.</p>`);
          })
          .always(function() {
            $("#riwayatLoading").addClass("hidden");
          });
      }

      // ---------- Simpan poin ----------
      function simpanPoin(tipe, itemTerpilih, $catatan, $btn) {
        if (!mhsAktif || !itemTerpilih) return;

        const poin = tipe === "pelanggaran" ? -Math.abs(itemTerpilih.poin) : Math.abs(itemTerpilih.poin);

        $btn.prop("disabled", true);
        $.ajax({
          url: URL_BASE,
          method: "POST",
          headers: { "X-CSRF-TOKEN": CSRF_TOKEN },
          data: {
            student_id: mhsAktif.id,
            kategori: itemTerpilih.kategori,
            indikator: itemTerpilih.indikator,
            poin: poin,
            catatan: $catatan.val().trim(),
          },
        })
          .done(function() {
            tampilkanToast(`${poin >= 0 ? "+" : ""}${poin} poin untuk ${mhsAktif.nama}`);
            $catatan.val("");
            muatRiwayat();
          })
          .fail(function(xhr) {
            const res = xhr.responseJSON || {};
            alert(res.message || "Gagal menyimpan poin. Coba lagi.");
          })
          .always(function() {
            $btn.prop("disabled", false);
          });
      }

      // ---------- Modal konfirmasi sebelum beneran nyimpen poin ----------
      const $modalKonfirmasi = $("#modalKonfirmasiPoin");
      let konfirmasiPending = null; // { tipe, itemTerpilih, $catatan, $btnAsli }

      function bukaKonfirmasi(tipe, itemTerpilih, $catatan, $btnAsli) {
        konfirmasiPending = { tipe, itemTerpilih, $catatan, $btnAsli };

        const isKeaktifan = tipe === "keaktifan";
        $("#konfirmasiKategori").text(itemTerpilih.kategori);
        $("#konfirmasiIndikator").text(itemTerpilih.indikator);
        $("#konfirmasiPoinVal")
          .text(`${isKeaktifan ? "+" : "-"}${itemTerpilih.poin}`)
          .css("color", isKeaktifan ? "#0f8a8c" : "#d9695a");
        $("#konfirmasiIconWrap")
          .css({ background: isKeaktifan ? "#e2f3f2" : "#fdeeec", color: isKeaktifan ? "#0f8a8c" : "#d9695a" });
        $("#btnYaKonfirmasi").css("background", isKeaktifan ? "#0f8a8c" : "#d9695a");

        $modalKonfirmasi.removeClass("hidden").addClass("flex");
      }

      function tutupKonfirmasi() {
        $modalKonfirmasi.addClass("hidden").removeClass("flex");
        konfirmasiPending = null;
      }

      $("#btnTutupKonfirmasi, #btnBatalKonfirmasi").on("click", tutupKonfirmasi);
      $modalKonfirmasi.on("click", function(e) {
        if (e.target === this) tutupKonfirmasi(); // klik di luar kartu (backdrop) -> batal, balik milih lagi
      });

      $("#btnYaKonfirmasi").on("click", function() {
        if (!konfirmasiPending) return;
        const { tipe, itemTerpilih, $catatan, $btnAsli } = konfirmasiPending;
        tutupKonfirmasi();
        simpanPoin(tipe, itemTerpilih, $catatan, $btnAsli);
      });

      $("#btnSimpanKeaktifan").on("click", function() {
        bukaKonfirmasi("keaktifan", keaktifanTerpilih, $("#catatanKeaktifan"), $(this));
      });
      $("#btnSimpanPelanggaran").on("click", function() {
        bukaKonfirmasi("pelanggaran", pelanggaranTerpilih, $("#catatanPelanggaran"), $(this));
      });

      function tampilkanToast(teks) {
        const $toast = $("#saveToast");
        $toast.find(".toast-text").text(teks);
        $toast.addClass("show");
        setTimeout(() => $toast.removeClass("show"), 2200);
      }

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO — sama seperti halaman lain.
      // ======================================================================
      const heroSlideImages = ["/gambar/gedungutama.webp", "/gambar/rektor.webp", "/gambar/gedung.webp"];
      const HERO_SLIDE_INTERVAL_MS = 6000;
      const $heroSlideshow = $("#heroSlideshow");
      if ($heroSlideshow.length && heroSlideImages.length) {
        heroSlideImages.forEach((src, i) => {
          $("<div>")
            .addClass("hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-[1800ms] ease-in-out")
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
