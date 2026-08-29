<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Profil Mahasiswa | PKKMB-KT UNILAM 2026</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
        --color-amber-500: #e0a728;
        --color-amber-tint: #fbf1dc;
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
  <header
    class="sticky top-0 z-40 flex items-center justify-between gap-4 px-4 sm:px-8 md:px-12 py-3.5 bg-navy-900 border-b border-white/10">
    <a
      href="{{ route('dashboard') }}"
      class="flex items-center gap-2.5 z-50 no-underline"
      aria-label="PKKMB-KT UNILAM Beranda">
      <div
        class="w-[38px] h-[38px] rounded-full bg-white flex items-center justify-center font-display text-[9px] font-bold text-navy-900 text-center leading-tight flex-shrink-0 overflow-hidden">
        <img
          src="{{ asset('gambar/unilam.webp') }}"
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
        href="{{ route('role.student.modul') }}"
        class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Modul</a>
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
        href="#"
        class="text-white text-[13.5px] font-semibold no-underline border-b-2 border-lime-500 pb-0.5">Profil</a>
    </nav>
  </header>

  <section
    class="relative overflow-hidden px-4 sm:px-8 md:px-12 py-10 sm:py-14 md:py-16">
    <div
      class="absolute inset-0 z-0 overflow-hidden after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-br after:from-navy-900/90 after:to-teal-600/[0.78]"
      id="heroSlideshow"></div>

    <div class="relative z-[1] max-w-[900px] mx-auto text-center">
      <h1
        class="font-display text-2xl sm:text-3xl md:text-[38px] font-bold text-white mb-3 leading-[1.2]">
        Profil <br /> Akun Mahasiswa
      </h1>
      <p class="text-sm text-white/75 leading-[1.7] max-w-[560px] mx-auto">
        Kelola informasi profil, NPM, dan pembaruan data mahasiswa
        Universitas La Tansa Mashiro.
      </p>
    </div>
  </section>

  <div class="max-w-[1000px] mx-auto px-4 sm:px-8 md:px-12 py-10 pb-[calc(74px+28px)] md:pb-10">
    <div class="grid grid-cols-1 lg:grid-cols-[320px_1fr] gap-6 items-start">
      <div class="bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] p-6 sm:p-8 flex flex-col items-center text-center">
        <div class="relative w-[140px] h-[140px] mb-[18px]">
          <div class="w-full h-full rounded-full overflow-hidden bg-navy-tint shadow-[0_10px_24px_rgba(21,33,89,0.16)]">
            <img
              id="avatarPreview"
              src="{{ auth()->user()->profile_picture ? asset('storage/'.auth()->user()->profile_picture).'?v='.auth()->user()->updated_at->timestamp : 'data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27%3E%3Crect width=%27100%27 height=%27100%27 fill=%27%23e2e8f0%27/%3E%3Ccircle cx=%2750%27 cy=%2738%27 r=%2718%27 fill=%27%2394a3b8%27/%3E%3Cpath d=%27M20 88c0-22 13-35 30-35s30 13 30 35%27 fill=%27%2394a3b8%27/%3E%3C/svg%3E' }}"
              alt="Foto Profil"
              class="w-full h-full object-cover" />
          </div>
          <label
            for="avatarUpload"
            class="absolute bottom-0.5 right-0.5 w-[42px] h-[42px] rounded-full bg-teal-500 text-white flex items-center justify-center cursor-pointer shadow-[0_10px_24px_rgba(21,33,89,0.16)] transition-all hover:bg-teal-600 hover:scale-[1.08]">
            <i class="fa-solid fa-camera"></i>
            <input
              type="file"
              id="avatarUpload"
              name="avatar"
              form="profileForm"
              accept="image/*"
              class="hidden" />
          </label>
        </div>

        <h2 id="summaryName" class="font-display text-[22px] font-bold text-ink-900 m-0">{{ auth()->user()->name }}</h2>
        <span id="summaryRole" class="inline-block text-[12.5px] font-bold text-teal-600 bg-teal-tint rounded-full px-4 py-[5px] mt-2">Mahasiswa {{ auth()->user()->program_study_name ?? '-' }}</span>

        <div class="w-full border-t border-border my-[22px]"></div>

        <p class="text-xs text-ink-600 leading-[1.6] bg-amber-tint border border-dashed border-amber-500 rounded-[18px] px-4 py-3.5 text-left">
          <i class="fa-solid fa-triangle-exclamation text-amber-500 mr-1.5"></i><b class="text-ink-900">Wajib menggunakan foto asli / wajah sendiri</b> (bukan
          kartun, anime, foto orang lain, atau logo) untuk keperluan
          verifikasi identitas selama kegiatan PKKMB. Format
          <b class="text-ink-900">JPG, PNG, atau WEBP</b>, maksimal 2MB.
        </p>
      </div>

      <div class="flex flex-col gap-6">
        <!-- ============ INFORMASI PRIBADI (SEBAGIAN TERKUNCI) ============ -->
        <div class="bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] overflow-hidden">
          <div class="flex items-center gap-2.5 px-5 sm:px-7 py-5 border-b border-border bg-bg">
            <span class="w-2.5 h-2.5 rounded-full bg-teal-500"></span>
            <h3 class="font-display text-base font-bold text-ink-900 m-0">Detail Informasi Pribadi</h3>
          </div>

          <div class="flex items-start gap-2.5 text-xs leading-[1.6] text-ink-600 bg-navy-tint border border-border rounded-[18px] px-3.5 py-3 mx-5 sm:mx-7 mt-5 sm:mt-7">
            <i class="fa-solid fa-lock text-navy-700 mt-0.5 text-[13px]"></i>
            <span>
              Data bertanda <b>"Terkunci"</b> tidak dapat diubah sendiri
              oleh mahasiswa karena bersumber dari data pendaftaran resmi.
              Jika ada kesalahan data, silakan hubungi panitia/admin
              PKKMB-KT UNILAM.
            </span>
          </div>

          @if ($errors->profileUpdate->any() ?? false)
          <div class="flex items-start gap-2.5 text-xs leading-[1.6] text-ink-600 border rounded-[18px] px-3.5 py-3 mx-5 sm:mx-7 mt-5 sm:mt-7 bg-[#fdecea] border-[#e0665a]/[0.33]">
            <i class="fa-solid fa-triangle-exclamation text-[#e0665a] mt-0.5 text-[13px]"></i>
            <span>{{ $errors->profileUpdate->first() }}</span>
          </div>
          @endif

          <form id="profileForm" class="p-5 sm:p-7" method="POST" action="{{ route('role.student.profil.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div class="col-span-full">
                <label class="flex items-center gap-1.5 text-[11px] font-extrabold tracking-[0.05em] uppercase text-ink-400 mb-2">
                  Nama Lengkap
                  <span class="inline-flex items-center gap-1 text-[9.5px] font-extrabold tracking-[0.03em] normal-case text-ink-600 bg-[#e8ebf6] border border-border rounded-full px-2 py-0.5"><i class="fa-solid fa-lock text-[9px]"></i>Terkunci</span>
                </label>
                <div class="relative">
                  <i class="fa-solid fa-id-card absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-400 text-sm"></i>
                  <input
                    type="text"
                    id="inputName"
                    value="{{ auth()->user()->name }}"
                    class="w-full py-[11px] pl-10 pr-9 rounded-xl border border-border font-sans text-[13.5px] font-medium transition-all focus:outline-none focus:border-teal-500 focus:bg-white focus:shadow-[0_0_0_4px_var(--color-teal-tint)] bg-border text-ink-600 cursor-not-allowed"
                    disabled
                    readonly />
                  <i class="fa-solid fa-lock absolute right-3.5 top-1/2 -translate-y-1/2 text-ink-400 text-[13px]"></i>
                </div>
              </div>

              <div>
                <label class="flex items-center gap-1.5 text-[11px] font-extrabold tracking-[0.05em] uppercase text-ink-400 mb-2">
                  Nomor Identitas / NPM
                  <span class="inline-flex items-center gap-1 text-[9.5px] font-extrabold tracking-[0.03em] normal-case text-ink-600 bg-[#e8ebf6] border border-border rounded-full px-2 py-0.5"><i class="fa-solid fa-lock text-[9px]"></i>Terkunci</span>
                </label>
                <div class="relative">
                  <i class="fa-solid fa-graduation-cap absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-400 text-sm"></i>
                  <input
                    type="text"
                    id="inputNPM"
                    value="{{ auth()->user()->npm ?? '-' }}"
                    class="w-full py-[11px] pl-10 pr-9 rounded-xl border border-border font-sans text-[13.5px] font-medium transition-all focus:outline-none focus:border-teal-500 focus:bg-white focus:shadow-[0_0_0_4px_var(--color-teal-tint)] bg-border text-ink-600 cursor-not-allowed"
                    disabled
                    readonly />
                  <i class="fa-solid fa-lock absolute right-3.5 top-1/2 -translate-y-1/2 text-ink-400 text-[13px]"></i>
                </div>
              </div>

              <div>
                <label class="flex items-center gap-1.5 text-[11px] font-extrabold tracking-[0.05em] uppercase text-ink-400 mb-2">
                  Alamat Email
                  <span class="inline-flex items-center gap-1 text-[9.5px] font-extrabold tracking-[0.03em] normal-case text-ink-600 bg-[#e8ebf6] border border-border rounded-full px-2 py-0.5"><i class="fa-solid fa-lock text-[9px]"></i>Terkunci</span>
                </label>
                <div class="relative">
                  <i class="fa-solid fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-400 text-sm"></i>
                  <input
                    type="email"
                    value="{{ auth()->user()->email }}"
                    class="w-full py-[11px] pl-10 pr-9 rounded-xl border border-border font-sans text-[13.5px] font-medium transition-all focus:outline-none focus:border-teal-500 focus:bg-white focus:shadow-[0_0_0_4px_var(--color-teal-tint)] bg-border text-ink-600 cursor-not-allowed"
                    disabled
                    readonly />
                  <i class="fa-solid fa-lock absolute right-3.5 top-1/2 -translate-y-1/2 text-ink-400 text-[13px]"></i>
                </div>
              </div>

              <div>
                <label class="flex items-center gap-1.5 text-[11px] font-extrabold tracking-[0.05em] uppercase text-ink-400 mb-2">
                  Program Studi
                  <span class="inline-flex items-center gap-1 text-[9.5px] font-extrabold tracking-[0.03em] normal-case text-ink-600 bg-[#e8ebf6] border border-border rounded-full px-2 py-0.5"><i class="fa-solid fa-lock text-[9px]"></i>Terkunci</span>
                </label>
                <div class="relative">
                  <i class="fa-solid fa-briefcase absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-400 text-sm"></i>
                  <input
                    type="text"
                    id="inputRole"
                    value="{{ auth()->user()->program_study_name ?? '-' }}"
                    class="w-full py-[11px] pl-10 pr-9 rounded-xl border border-border font-sans text-[13.5px] font-medium transition-all focus:outline-none focus:border-teal-500 focus:bg-white focus:shadow-[0_0_0_4px_var(--color-teal-tint)] bg-border text-ink-600 cursor-not-allowed"
                    disabled
                    readonly />
                  <i class="fa-solid fa-lock absolute right-3.5 top-1/2 -translate-y-1/2 text-ink-400 text-[13px]"></i>
                </div>
              </div>

              <div>
                <label class="flex items-center gap-1.5 text-[11px] font-extrabold tracking-[0.05em] uppercase text-ink-400 mb-2">Nomor Telepon</label>
                <div class="relative">
                  <i class="fa-solid fa-phone absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-400 text-sm"></i>
                  <input
                    type="tel"
                    name="phone_no"
                    value="{{ old('phone_no', auth()->user()->phone_no) }}"
                    class="w-full py-[11px] pl-10 pr-3.5 rounded-xl border border-border bg-bg font-sans text-[13.5px] font-medium text-ink-900 transition-all focus:outline-none focus:border-teal-500 focus:bg-white focus:shadow-[0_0_0_4px_var(--color-teal-tint)]" />
                </div>
              </div>

              <div class="col-span-full">
                <label class="flex items-center gap-1.5 text-[11px] font-extrabold tracking-[0.05em] uppercase text-ink-400 mb-2">
                  Jenis Kelamin
                  <span class="inline-flex items-center gap-1 text-[9.5px] font-extrabold tracking-[0.03em] normal-case text-ink-600 bg-[#e8ebf6] border border-border rounded-full px-2 py-0.5"><i class="fa-solid fa-lock text-[9px]"></i>Terkunci</span>
                </label>
                @php
                  // Data gender formatnya beda-beda tergantung cara input akunnya:
                  // form manual admin pakai 'L'/'P', tapi hasil import Excel pakai
                  // 'laki-laki'/'perempuan' -- disamakan dulu di sini.
                  $genderMentah = strtolower((string) auth()->user()->gender);
                  $isPerempuan = in_array($genderMentah, ['p', 'perempuan'], true);
                @endphp
                <input type="hidden" name="gender" value="{{ $isPerempuan ? 'perempuan' : 'laki-laki' }}" />
                @if ($isPerempuan)
                  <span class="w-full flex items-center justify-center gap-2 py-[11px] px-3.5 rounded-xl border border-[#ec4899] bg-[#fce7f3] text-[13.5px] font-bold text-[#ec4899]">
                    <i class="fa-solid fa-venus text-sm"></i> Perempuan
                  </span>
                @else
                  <span class="w-full flex items-center justify-center gap-2 py-[11px] px-3.5 rounded-xl border border-[#2563eb] bg-[#dbeafe] text-[13.5px] font-bold text-[#2563eb]">
                    <i class="fa-solid fa-mars text-sm"></i> Laki-laki
                  </span>
                @endif
              </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-5 mt-1.5 border-t border-border">
              <button
                type="button"
                id="btnBatalProfil"
                class="py-[11px] px-[22px] rounded-xl text-[13.5px] font-bold text-ink-600 bg-transparent border-none cursor-pointer transition-colors hover:bg-bg">
                Batal
              </button>
              <button type="submit" class="py-3 px-[26px] rounded-xl text-[13.5px] font-bold text-white bg-navy-900 border-none cursor-pointer shadow-[0_10px_24px_rgba(21,33,89,0.16)] transition-all hover:bg-navy-700 active:scale-[0.98] no-underline inline-block">
                Simpan Perubahan
              </button>
            </div>
          </form>
        </div>

        <!-- ============ UBAH KATA SANDI ============ -->
        <div class="bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] overflow-hidden">
          <div class="flex items-center gap-2.5 px-5 sm:px-7 py-5 border-b border-border bg-bg">
            <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
            <h3 class="font-display text-base font-bold text-ink-900 m-0">Ubah Kata Sandi</h3>
          </div>

          <form id="passwordForm" class="p-5 sm:p-7" method="POST" action="{{ route('role.student.profil.password') }}">
            @csrf
            <p class="text-xs text-ink-600 leading-[1.6] mb-[18px] mt-0">
              Masukkan kata sandi lama, lalu buat kata sandi baru minimal
              8 karakter. Pastikan konfirmasi kata sandi baru sama persis.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div class="col-span-full">
                <label class="flex items-center gap-1.5 text-[11px] font-extrabold tracking-[0.05em] uppercase text-ink-400 mb-2">Kata Sandi Lama</label>
                <div class="relative">
                  <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-400 text-sm"></i>
                  <input
                    type="password"
                    id="oldPassword"
                    name="old_password"
                    class="w-full py-[11px] pl-10 pr-3.5 rounded-xl border border-border bg-bg font-sans text-[13.5px] font-medium text-ink-900 transition-all focus:outline-none focus:border-teal-500 focus:bg-white focus:shadow-[0_0_0_4px_var(--color-teal-tint)]"
                    placeholder="Masukkan kata sandi lama"
                    required />
                </div>
              </div>

              <div>
                <label class="flex items-center gap-1.5 text-[11px] font-extrabold tracking-[0.05em] uppercase text-ink-400 mb-2">Kata Sandi Baru</label>
                <div class="relative">
                  <i class="fa-solid fa-key absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-400 text-sm"></i>
                  <input
                    type="password"
                    id="newPassword"
                    name="new_password"
                    class="w-full py-[11px] pl-10 pr-3.5 rounded-xl border border-border bg-bg font-sans text-[13.5px] font-medium text-ink-900 transition-all focus:outline-none focus:border-teal-500 focus:bg-white focus:shadow-[0_0_0_4px_var(--color-teal-tint)]"
                    placeholder="Minimal 8 karakter"
                    minlength="8"
                    required />
                </div>
              </div>

              <div>
                <label class="flex items-center gap-1.5 text-[11px] font-extrabold tracking-[0.05em] uppercase text-ink-400 mb-2">Konfirmasi Kata Sandi Baru</label>
                <div class="relative">
                  <i class="fa-solid fa-key absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-400 text-sm"></i>
                  <input
                    type="password"
                    id="confirmPassword"
                    name="new_password_confirmation"
                    class="w-full py-[11px] pl-10 pr-3.5 rounded-xl border border-border bg-bg font-sans text-[13.5px] font-medium text-ink-900 transition-all focus:outline-none focus:border-teal-500 focus:bg-white focus:shadow-[0_0_0_4px_var(--color-teal-tint)]"
                    placeholder="Ulangi kata sandi baru"
                    minlength="8"
                    required />
                </div>
              </div>
            </div>

            <p id="passwordError" class="text-xs font-bold text-[#c0392b] mt-2 mb-4 hidden">
              Kata sandi baru dan konfirmasi tidak sama.
            </p>

            <div class="flex items-center justify-end gap-3 pt-5 mt-1.5 border-t border-border">
              <button
                type="button"
                id="cancelPasswordBtn"
                class="py-[11px] px-[22px] rounded-xl text-[13.5px] font-bold text-ink-600 bg-transparent border-none cursor-pointer transition-colors hover:bg-bg">
                Batal
              </button>
              <button type="submit" id="submitPasswordBtn" class="py-3 px-[26px] rounded-xl text-[13.5px] font-bold text-white bg-navy-900 border-none cursor-pointer shadow-[0_10px_24px_rgba(21,33,89,0.16)] transition-all hover:bg-navy-700 active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed">
                Ubah Kata Sandi
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <footer class="bg-[#0d1735] px-4 sm:px-8 md:px-12 py-7 flex flex-wrap justify-between items-center gap-3.5 mt-14 pb-[calc(74px+16px)] md:pb-7">
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

  <nav
    class="fixed bottom-0 left-0 right-0 h-[74px] bg-surface border-t border-border flex items-center justify-around px-1.5 pb-[env(safe-area-inset-bottom)] z-30 md:hidden"
    aria-label="Navigasi bawah">
    <a
      href="{{ route('role.student.modul') }}"
      class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
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
        <circle cx="12" cy="12" r="9" />
            <path d="M12 11v5" />
            <path d="M12 8h.01" />
      </svg>
      <span>Info</span>
    </a>
    <a
      href="#"
      class="flex flex-col items-center gap-1 text-navy-900 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="8" r="3.4" />
        <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
      </svg>
      <span>Profil</span>
    </a>
  </nav>

  <!-- ============ TOAST NOTIFIKASI (sama seperti dashboard admin) ============ -->
  <div class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[100]" id="toastWrap">
    <div
      id="toastEl"
      class="opacity-0 pointer-events-none transition-all duration-[250ms] translate-y-5 bg-navy-900 text-white px-[22px] py-3 rounded-full text-[13px] font-bold shadow-[0_10px_24px_rgba(21,33,89,0.25)]"></div>
  </div>

  <script>
    $(function() {
      const $avatarUpload = $("#avatarUpload");
      const $avatarPreview = $("#avatarPreview");

      $avatarUpload.on("change", function() {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            $avatarPreview.attr("src", e.target.result);
          };
          reader.readAsDataURL(file);
        }
      });

      $("#btnBatalProfil").on("click", function() {
        window.history.back();
      });

      // Nama, NPM, Email, Program Studi & Jenis Kelamin terkunci (disabled).
      // Ringkasan nama/role di kartu avatar sudah dirender langsung dari
      // data user di server (lihat blade di atas), jadi tidak perlu
      // ditimpa lagi lewat JS di sini.

      // profileForm sekarang form sungguhan (POST ke server),
      // jadi tidak perlu preventDefault lagi di sini.

      // ======================================================================
      // ►► UBAH KATA SANDI
      // ======================================================================
      const $passwordForm = $("#passwordForm");
      const $oldPassword = $("#oldPassword");
      const $newPassword = $("#newPassword");
      const $confirmPassword = $("#confirmPassword");
      const $passwordError = $("#passwordError");
      const $submitPasswordBtn = $("#submitPasswordBtn");

      $("#cancelPasswordBtn").on("click", function() {
        $passwordForm[0].reset();
        $passwordError.removeClass("block").addClass("hidden");
      });

      $passwordForm.on("submit", function(e) {
        // Dulu form ini submit biasa (reload halaman penuh) -> sekarang
        // dikirim lewat AJAX supaya halaman TIDAK reload, baik pas gagal
        // (mis. kata sandi lama salah) maupun pas berhasil.
        e.preventDefault();
        $passwordError.removeClass("block").addClass("hidden");

        const oldVal = $oldPassword.val();
        const newVal = $newPassword.val();
        const confirmVal = $confirmPassword.val();

        if (newVal.length < 8) {
          $passwordError.text("Kata sandi baru minimal 8 karakter.").removeClass("hidden").addClass("block");
          return;
        }

        if (newVal !== confirmVal) {
          $passwordError.text("Kata sandi baru dan konfirmasi tidak sama.").removeClass("hidden").addClass("block");
          return;
        }

        if (newVal === oldVal) {
          $passwordError.text("Kata sandi baru tidak boleh sama dengan kata sandi lama.").removeClass("hidden").addClass("block");
          return;
        }

        // Lolos validasi di browser -> kirim ke server (route('role.student.profil.password'))
        // buat verifikasi kata sandi lama & penyimpanan kata sandi baru yang sebenarnya.
        $submitPasswordBtn.prop("disabled", true).text("Menyimpan...");

        $.ajax({
          url: $passwordForm.attr("action"),
          method: "POST",
          data: $passwordForm.serialize(),
          dataType: "json",
        })
          .done(function(res) {
            $passwordForm[0].reset();
            tampilkanToast(res.message || "Kata sandi berhasil diubah.");
          })
          .fail(function(xhr) {
            const res = xhr.responseJSON || {};
            let pesan = res.message || "Gagal mengubah kata sandi. Coba lagi.";
            if (res.errors) {
              const pesanPertama = Object.values(res.errors)[0];
              if (pesanPertama && pesanPertama[0]) pesan = pesanPertama[0];
            }
            $passwordError.text(pesan).removeClass("hidden").addClass("block");
          })
          .always(function() {
            $submitPasswordBtn.prop("disabled", false).text("Ubah Kata Sandi");
          });
      });

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO
      // ======================================================================
      const heroSlideImages = [
        "{{ asset('gambar/gedungutama.webp') }}",
        "{{ asset('gambar/rektor.webp') }}",
        "{{ asset('gambar/gedung.webp') }}",
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

      // ======================================================================
      // ►► TOAST NOTIFIKASI
      // ======================================================================
      window.tampilkanToast = function(pesan) {
        const $el = $("#toastEl");
        $el.text(pesan).removeClass("opacity-0 pointer-events-none translate-y-5").addClass("opacity-100 translate-y-0");
        clearTimeout(window.__toastTimer);
        window.__toastTimer = setTimeout(() => {
          $el.removeClass("opacity-100 translate-y-0").addClass("opacity-0 pointer-events-none translate-y-5");
        }, 2600);
      };

      @if(session('profileStatus'))
      tampilkanToast(@json(session('profileStatus')));
      @endif
    });
  </script>
</body>

</html>