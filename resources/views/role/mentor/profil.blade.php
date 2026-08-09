<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Profil Mentor | PKKMB-KT UNILAM 2026</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <style>
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
        --amber-500: #e0a728;
        --amber-tint: #fbf1dc;
        --bg: #f2f4fa;
        --surface: #ffffff;
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
        --bottomnav-h: 74px;
      }

    * {
        box-sizing: border-box;
      }
      body {
        font-family: var(--font-sans);
        color: var(--ink-900);
        margin: 0;
        padding: 0;
        background: var(--bg);
        -webkit-font-smoothing: antialiased;
      }
      .font-display {
        font-family: var(--font-display);
      }


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
        text-decoration: none;
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
        overflow: hidden;
      }
      .navbar-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
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
        display: none;
        gap: 24px;
      }
      .navbar-links a {
        color: #c7cce8;
        font-size: 16px;
        font-weight: 600;
        transition: color 0.15s;
        display: block;
        text-decoration: none;
      }
      .navbar-links a:hover,
      .navbar-links a.active {
        color: #fff;
      }
      .navbar-links a.active {
        border-left: 3px solid var(--lime-500);
        padding-left: 8px;
      }
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
      }

      /* ============ HERO ============ */
      .hero-info {
        position: relative;
        overflow: hidden;
        padding: clamp(40px, 7vw, 64px) clamp(16px, 5vw, 48px);
      }
      /* ►► SLIDESHOW LATAR HERO — sama seperti home_page.html/tentang.html.
         Ganti/tambah gambar di array JS "heroSlideImages" di bawah file
         ini. Durasi tiap gambar diatur lewat "HERO_SLIDE_INTERVAL_MS". */
      .hero-slideshow {
        position: absolute;
        inset: 0;
        z-index: 0;
        overflow: hidden;
      }
      .hero-slide {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        opacity: 0;
        transition: opacity 1.8s ease;
      }
      .hero-slide.active {
        opacity: 1;
      }
      .hero-slideshow::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
          135deg,
          rgba(21, 33, 89, 0.9) 0%,
          rgba(15, 138, 140, 0.78) 100%
        );
      }
      .hero-info-inner {
        position: relative;
        z-index: 1;
        max-width: 900px;
        margin: 0 auto;
        text-align: center;
      }
      .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(169, 199, 59, 0.15);
        border: 1px solid rgba(169, 199, 59, 0.35);
        color: #c8e46a;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 99px;
        margin-bottom: 16px;
        letter-spacing: 0.06em;
        text-transform: uppercase;
      }
      .hero-eyebrow .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--lime-500);
        animation: pulse 2s infinite;
      }
      @keyframes pulse {
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
      .hero-info h1 {
        font-family: var(--font-display);
        font-size: clamp(24px, 4vw, 38px);
        font-weight: 700;
        color: #fff;
        margin: 0 0 12px;
        line-height: 1.2;
      }
      .hero-info-sub {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.75);
        line-height: 1.7;
        max-width: 560px;
        margin: 0 auto;
      }

      .content-wrap {
        max-width: 1000px;
        margin: 0 auto;
        padding: 40px clamp(16px, 5vw, 48px);
        padding-bottom: calc(var(--bottomnav-h) + 28px);
      }
      @media (min-width: 768px) {
        .content-wrap {
          padding-bottom: 40px;
        }
      }

      .profile-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
        align-items: start;
      }
      @media (min-width: 1024px) {
        .profile-grid {
          grid-template-columns: 320px 1fr;
        }
      }

      .stack-gap {
        display: flex;
        flex-direction: column;
        gap: 24px;
      }

      .avatar-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-card);
        padding: clamp(24px, 4vw, 32px);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
      }
      .avatar-wrap {
        position: relative;
        width: 140px;
        height: 140px;
        margin-bottom: 18px;
      }
      .avatar-wrap .ring {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        overflow: hidden;
        background: var(--navy-tint);
        box-shadow: var(--shadow-pop);
      }
      .avatar-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
      .avatar-cam {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: var(--teal-500);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: var(--shadow-pop);
        transition: transform 0.15s, background 0.15s;
      }
      .avatar-cam:hover {
        background: var(--teal-600);
        transform: scale(1.08);
      }

      .avatar-name {
        font-family: var(--font-display);
        font-size: 22px;
        font-weight: 700;
        color: var(--ink-900);
        margin: 0;
      }
      .avatar-role {
        display: inline-block;
        font-size: 12.5px;
        font-weight: 700;
        color: var(--teal-600);
        background: var(--teal-tint);
        border-radius: 99px;
        padding: 5px 16px;
        margin-top: 8px;
      }
      .avatar-divider {
        width: 100%;
        border-top: 1px solid var(--border);
        margin: 22px 0;
      }
      .avatar-hint {
        font-size: 12px;
        color: var(--ink-600);
        line-height: 1.6;
        background: var(--amber-tint);
        border: 1px dashed var(--amber-500);
        border-radius: var(--radius-md);
        padding: 14px 16px;
        text-align: left;
      }
      .avatar-hint i {
        color: var(--amber-500);
        margin-right: 6px;
      }
      .avatar-hint b {
        color: var(--ink-900);
      }

      .form-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-card);
        overflow: hidden;
      }
      .form-card-head {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 20px clamp(20px, 4vw, 28px);
        border-bottom: 1px solid var(--border);
        background: var(--bg);
      }
      .form-card-head .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--teal-500);
      }
      .form-card-head.head-amber .dot {
        background: var(--amber-500);
      }
      .form-card-head h3 {
        font-family: var(--font-display);
        font-size: 16px;
        font-weight: 700;
        color: var(--ink-900);
        margin: 0;
      }

      /* Catatan field terkunci di kepala kartu */
      .lock-banner {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 12px;
        line-height: 1.6;
        color: var(--ink-600);
        background: var(--navy-tint);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 12px 14px;
        margin: 0 clamp(20px, 4vw, 28px);
        margin-top: clamp(20px, 4vw, 28px);
      }
      .lock-banner i {
        color: var(--navy-700);
        margin-top: 2px;
        font-size: 13px;
      }

      .form-body {
        padding: clamp(20px, 4vw, 28px);
      }
      .field-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
      }
      @media (min-width: 640px) {
        .field-grid {
          grid-template-columns: 1fr 1fr;
        }
      }
      .field-full {
        grid-column: 1 / -1;
      }
      .field-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: var(--ink-400);
        margin-bottom: 8px;
      }
      .field-label .lock-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 9.5px;
        font-weight: 800;
        letter-spacing: 0.03em;
        text-transform: none;
        color: var(--ink-600);
        background: var(--surface-muted, #e8ebf6);
        border: 1px solid var(--border);
        border-radius: 99px;
        padding: 2px 8px;
      }
      .field-label .lock-tag i {
        font-size: 9px;
      }
      .field-input-wrap {
        position: relative;
      }
      .field-input-wrap i.field-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--ink-400);
        font-size: 14px;
      }
      .field-input-wrap i.field-lock-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--ink-400);
        font-size: 13px;
      }
      .field-input {
        width: 100%;
        padding: 11px 14px 11px 40px;
        border-radius: 12px;
        border: 1px solid var(--border);
        background: var(--bg);
        font-family: var(--font-sans);
        font-size: 13.5px;
        font-weight: 500;
        color: var(--ink-900);
        transition:
          border-color 0.15s,
          background 0.15s,
          box-shadow 0.15s;
      }
      .field-input:focus {
        outline: none;
        border-color: var(--teal-500);
        background: #fff;
        box-shadow: 0 0 0 4px var(--teal-tint);
      }
      .field-input:disabled {
        background: var(--border);
        color: var(--ink-600);
        cursor: not-allowed;
        padding-right: 36px;
      }
      textarea.field-input {
        padding-left: 14px;
        resize: none;
      }

      .gender-toggle {
        display: flex;
        gap: 10px;
      }
      .gender-toggle input {
        display: none;
      }
      .gender-pill {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 14px;
        border-radius: 12px;
        border: 1px solid var(--border);
        background: var(--bg);
        font-size: 13.5px;
        font-weight: 700;
        color: var(--ink-600);
        cursor: pointer;
        transition:
          border-color 0.15s,
          background 0.15s,
          color 0.15s;
      }
      .gender-pill i {
        font-size: 14px;
      }
      .gender-toggle input:checked + .gender-pill {
        border-color: var(--teal-500);
        background: var(--teal-tint);
        color: var(--teal-600);
      }
      .gender-toggle.locked .gender-pill {
        cursor: not-allowed;
        opacity: 0.7;
      }
      .gender-toggle.locked input[value="laki-laki"]:checked + .gender-pill {
    background: #dbeafe;
    border-color: #2563eb;
    color: #2563eb;
}

.gender-toggle.locked input[value="perempuan"]:checked + .gender-pill {
    background: #fce7f3;
    border-color: #ec4899;
    color: #ec4899;
}
      .form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 20px;
        margin-top: 6px;
        border-top: 1px solid var(--border);
      }
      .btn-ghost {
        padding: 11px 22px;
        border-radius: 12px;
        font-size: 13.5px;
        font-weight: 700;
        color: var(--ink-600);
        background: transparent;
        border: none;
        cursor: pointer;
        transition: background 0.15s;
      }
      .btn-ghost:hover {
        background: var(--bg);
      }
      .btn-save {
        padding: 12px 26px;
        border-radius: 12px;
        font-size: 13.5px;
        font-weight: 700;
        color: #fff;
        background: var(--navy-900);
        border: none;
        cursor: pointer;
        box-shadow: var(--shadow-pop);
        transition: background 0.15s, transform 0.15s;
        text-decoration: none;
        display: inline-block;
      }
      .btn-save:hover {
        background: var(--navy-700);
      }
      .btn-save:active {
        transform: scale(0.98);
      }

      .password-note {
        font-size: 12px;
        color: var(--ink-600);
        line-height: 1.6;
        margin: 0 0 18px;
      }
      .password-error {
        font-size: 12px;
        font-weight: 700;
        color: #c0392b;
        margin: -10px 0 16px;
        display: none;
      }
      .password-error.show {
        display: block;
      }

      .footer {
        background: #0d1735;
        padding: 28px clamp(16px, 5vw, 48px);
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        margin-top: 56px;
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
        text-decoration: none;
        transition: color 0.15s;
      }
      .footer-links a:hover {
        color: #aeb6e0;
      }
      @media (max-width: 767px) {
        .footer {
          padding-bottom: calc(var(--bottomnav-h) + 16px);
        }
      }

      .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: var(--bottomnav-h);
        background: var(--surface);
        border-top: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-around;
        padding: 0 6px;
        padding-bottom: env(safe-area-inset-bottom);
        z-index: 30;
      }
      .bottom-nav a {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        color: var(--ink-400);
        font-size: 10px;
        font-weight: 700;
        flex: 1;
        padding: 6px 0;
        text-decoration: none;
      }
      .bottom-nav a .ic {
        width: 22px;
        height: 22px;
      }
      .bottom-nav a.active {
        color: var(--navy-900);
      }
      .bottom-nav a.home {
        flex: 0 0 auto;
        color: #fff;
        margin-top: -30px;
        background: var(--navy-900);
        width: 54px;
        height: 54px;
        border-radius: 50%;
        box-shadow: var(--shadow-pop);
        justify-content: center;
      }
      .bottom-nav a.home .ic {
        width: 24px;
        height: 24px;
      }
      .bottom-nav a.home span {
        display: none;
      }
      @media (min-width: 768px) {
        .bottom-nav {
          display: none;
        }
      }
    </style>
  </head>

  <body>
    @include('layouts.mentor.navbar-classic', ['navActive' => 'profil'])

    <section class="hero-info">
      <div class="hero-slideshow" id="heroSlideshow"></div>

      <div class="hero-info-inner">
        <div class="hero-eyebrow">
          <span class="dot"></span>
          Pengaturan Akun
        </div>
        <h1>Profil <br /> Akun Mentor</h1>
        <b class="hero-info-sub">
          Kelola informasi profil, NPM, dan pembaruan data mentor
          <p>Universitas La Tansa Mashiro.
        </p>
      </div>
    </section>

    <div class="content-wrap">
      <div class="profile-grid">
        <div class="avatar-card">
          <div class="avatar-wrap">
            <div class="ring">
              <img
                id="avatarPreview"
                src="{{ auth()->user()->profile_picture ? asset('storage/'.auth()->user()->profile_picture) : 'data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27%3E%3Crect width=%27100%27 height=%27100%27 fill=%27%23e2e8f0%27/%3E%3Ccircle cx=%2750%27 cy=%2738%27 r=%2718%27 fill=%27%2394a3b8%27/%3E%3Cpath d=%27M20 88c0-22 13-35 30-35s30 13 30 35%27 fill=%27%2394a3b8%27/%3E%3C/svg%3E' }}"
                alt="Foto Profil"
              />
            </div>
            <label for="avatarUpload" class="avatar-cam">
              <i class="fa-solid fa-camera"></i>
              <input
                type="file"
                id="avatarUpload"
                name="avatar"
                form="profileForm"
                accept="image/*"
                class="hidden"
                style="display: none"
              />
            </label>
          </div>

          <h2 id="summaryName" class="avatar-name">{{ auth()->user()->name }}</h2>
          <span id="summaryRole" class="avatar-role"
            >Mentor {{ auth()->user()->program_study_name ?? '-' }}</span
          >

          <div class="avatar-divider"></div>

          <p class="avatar-hint">
            <i class="fa-solid fa-triangle-exclamation"></i
            ><b>Wajib menggunakan foto asli / wajah sendiri</b> (bukan
            kartun, anime, foto orang lain, atau logo) untuk keperluan
            verifikasi identitas selama kegiatan PKKMB. Format
            <b>JPG, PNG, atau WEBP</b>, maksimal 2MB.
          </p>
        </div>

        <div class="stack-gap">
          <!-- ============ INFORMASI PRIBADI (SEBAGIAN TERKUNCI) ============ -->
          <div class="form-card">
            <div class="form-card-head">
              <span class="dot"></span>
              <h3>Detail Informasi Pribadi</h3>
            </div>

            <div class="lock-banner">
              <i class="fa-solid fa-lock"></i>
              <span>
                Data bertanda <b>"Terkunci"</b> tidak dapat diubah sendiri
                oleh mentor karena bersumber dari data pendaftaran resmi.
                Jika ada kesalahan data, silakan hubungi panitia/admin
                PKKMB-KT UNILAM.
              </span>
            </div>

                        @if ($errors->profileUpdate->any() ?? false)
              <div class="lock-banner" style="background:#fdecea; border-color:#e0665a55;">
                <i class="fa-solid fa-triangle-exclamation" style="color:#e0665a;"></i>
                <span>{{ $errors->profileUpdate->first() }}</span>
              </div>
            @endif

            <form id="profileForm" class="form-body" method="POST" action="{{ route('role.mentor.profil.update') }}" enctype="multipart/form-data">
              @csrf
              <div class="field-grid">
                <div class="field-full">
                  <label class="field-label">
                    Nama Lengkap
                    <span class="lock-tag"
                      ><i class="fa-solid fa-lock"></i>Terkunci</span
                    >
                  </label>
                  <div class="field-input-wrap">
                    <i class="fa-solid fa-id-card field-icon"></i>
                    <input
                      type="text"
                      id="inputName"
                      value="{{ auth()->user()->name }}"
                      class="field-input"
                      disabled
                      readonly
                    />
                    <i class="fa-solid fa-lock field-lock-icon"></i>
                  </div>
                </div>

                <div>
                  <label class="field-label">
                    Nomor Identitas / NPM
                    <span class="lock-tag"
                      ><i class="fa-solid fa-lock"></i>Terkunci</span
                    >
                  </label>
                  <div class="field-input-wrap">
                    <i class="fa-solid fa-graduation-cap field-icon"></i>
                    <input
                      type="text"
                      id="inputNPM"
                      value="{{ auth()->user()->npm ?? '-' }}"
                      class="field-input"
                      disabled
                      readonly
                    />
                    <i class="fa-solid fa-lock field-lock-icon"></i>
                  </div>
                </div>

                <div>
                  <label class="field-label">
                    Alamat Email
                    <span class="lock-tag"
                      ><i class="fa-solid fa-lock"></i>Terkunci</span
                    >
                  </label>
                  <div class="field-input-wrap">
                    <i class="fa-solid fa-envelope field-icon"></i>
                    <input
                      type="email"
                      value="{{ auth()->user()->email }}"
                      class="field-input"
                      disabled
                      readonly
                    />
                    <i class="fa-solid fa-lock field-lock-icon"></i>
                  </div>
                </div>

                <div>
                  <label class="field-label">
                    Program Studi
                    <span class="lock-tag"
                      ><i class="fa-solid fa-lock"></i>Terkunci</span
                    >
                  </label>
                  <div class="field-input-wrap">
                    <i class="fa-solid fa-briefcase field-icon"></i>
                    <input
                      type="text"
                      id="inputRole"
                      value="{{ auth()->user()->program_study_name ?? '-' }}"
                      class="field-input"
                      disabled
                      readonly
                    />
                    <i class="fa-solid fa-lock field-lock-icon"></i>
                  </div>
                </div>

                <div>
                  <label class="field-label">Nomor Telepon</label>
                  <div class="field-input-wrap">
                    <i class="fa-solid fa-phone field-icon"></i>
                    <input
                      type="tel"
                      name="phone_no"
                      value="{{ old('phone_no', auth()->user()->phone_no) }}"
                      class="field-input"
                    />
                  </div>
                </div>

                <div class="field-full">
                  <label class="field-label">
                    Jenis Kelamin
                    <span class="lock-tag"
                      ><i class="fa-solid fa-lock"></i>Terkunci</span
                    >
                  </label>
                  <div class="gender-toggle locked">
                    <label>
                      <input
                        type="radio"
                        name="gender"
                        value="laki-laki"
                        @checked(auth()->user()->gender === 'laki-laki')
                        disabled
                      />
                      <span class="gender-pill">
                        <i class="fa-solid fa-mars"></i> Laki-laki
                      </span>
                    </label>
                    <label>
                      <input
                        type="radio"
                        name="gender"
                        value="perempuan"
                        @checked(auth()->user()->gender === 'perempuan')
                        disabled
                      />
                      <span class="gender-pill">
                        <i class="fa-solid fa-venus"></i> Perempuan
                      </span>
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-actions">
                <button
                  type="button"
                  onclick="window.history.back()"
                  class="btn-ghost"
                >
                  Batal
                </button>
                <button type="submit" class="btn-save">
                  Simpan Perubahan
                </button>
              </div>
            </form>
          </div>

          <!-- ============ UBAH KATA SANDI ============ -->
          <div class="form-card">
            <div class="form-card-head head-amber">
              <span class="dot"></span>
              <h3>Ubah Kata Sandi</h3>
            </div>

            @if ($errors->passwordUpdate->any() ?? false)
              <p class="password-error show">{{ $errors->passwordUpdate->first() }}</p>
            @endif

            <form id="passwordForm" class="form-body" method="POST" action="{{ route('role.mentor.profil.password') }}">
              @csrf
              <p class="password-note">
                Masukkan kata sandi lama, lalu buat kata sandi baru minimal
                8 karakter. Pastikan konfirmasi kata sandi baru sama persis.
              </p>

              <div class="field-grid">
                <div class="field-full">
                  <label class="field-label">Kata Sandi Lama</label>
                  <div class="field-input-wrap">
                    <i class="fa-solid fa-lock field-icon"></i>
                    <input
                      type="password"
                      id="oldPassword"
                      name="old_password"
                      class="field-input"
                      placeholder="Masukkan kata sandi lama"
                      required
                    />
                  </div>
                </div>

                <div>
                  <label class="field-label">Kata Sandi Baru</label>
                  <div class="field-input-wrap">
                    <i class="fa-solid fa-key field-icon"></i>
                    <input
                      type="password"
                      id="newPassword"
                      name="new_password"
                      class="field-input"
                      placeholder="Minimal 8 karakter"
                      minlength="8"
                      required
                    />
                  </div>
                </div>

                <div>
                  <label class="field-label">Konfirmasi Kata Sandi Baru</label>
                  <div class="field-input-wrap">
                    <i class="fa-solid fa-key field-icon"></i>
                    <input
                      type="password"
                      id="confirmPassword"
                      name="new_password_confirmation"
                      class="field-input"
                      placeholder="Ulangi kata sandi baru"
                      minlength="8"
                      required
                    />
                  </div>
                </div>
              </div>

              <p id="passwordError" class="password-error">
                Kata sandi baru dan konfirmasi tidak sama.
              </p>

              <div class="form-actions">
                <button
                  type="button"
                  id="cancelPasswordBtn"
                  class="btn-ghost"
                >
                  Batal
                </button>
                <button type="submit" class="btn-save">
                  Ubah Kata Sandi
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    @include('layouts.mentor.footer-classic')

    @include('layouts.mentor.bottomnav-classic', ['navActive' => 'profil'])

    <script>
      const avatarUpload = document.getElementById("avatarUpload");
      const avatarPreview = document.getElementById("avatarPreview");
      const inputName = document.getElementById("inputName");
      const summaryName = document.getElementById("summaryName");
      const inputRole = document.getElementById("inputRole");
      const summaryRole = document.getElementById("summaryRole");
      const profileForm = document.getElementById("profileForm");

      avatarUpload.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            avatarPreview.setAttribute("src", e.target.result);
          };
          reader.readAsDataURL(file);
        }
      });

      // Nama, NPM, Email, Program Studi & Jenis Kelamin terkunci (disabled).
      // Ringkasan nama/role di kartu avatar sudah dirender langsung dari
      // data user di server, jadi tidak perlu ditimpa lagi lewat JS di sini.

      // profileForm sekarang form sungguhan (POST ke server),
      // jadi tidak perlu preventDefault lagi di sini.

      // ======================================================================
      // ►► UBAH KATA SANDI
      // ======================================================================
      const passwordForm = document.getElementById("passwordForm");
      const oldPassword = document.getElementById("oldPassword");
      const newPassword = document.getElementById("newPassword");
      const confirmPassword = document.getElementById("confirmPassword");
      const passwordError = document.getElementById("passwordError");
      const cancelPasswordBtn = document.getElementById("cancelPasswordBtn");

      cancelPasswordBtn.addEventListener("click", function () {
        passwordForm.reset();
        passwordError.classList.remove("show");
      });

      passwordForm.addEventListener("submit", function (e) {
        passwordError.classList.remove("show");

        if (newPassword.value.length < 8) {
          e.preventDefault();
          passwordError.textContent =
            "Kata sandi baru minimal 8 karakter.";
          passwordError.classList.add("show");
          return;
        }

        if (newPassword.value !== confirmPassword.value) {
          e.preventDefault();
          passwordError.textContent =
            "Kata sandi baru dan konfirmasi tidak sama.";
          passwordError.classList.add("show");
          return;
        }

        if (newPassword.value === oldPassword.value) {
          e.preventDefault();
          passwordError.textContent =
            "Kata sandi baru tidak boleh sama dengan kata sandi lama.";
          passwordError.classList.add("show");
          return;
        }

        // Lolos validasi di browser -> form lanjut submit sungguhan ke server.
      });

      const heroSlideImages = [
        "/Gambar/gedungutama.jpeg",
        "/Gambar/rektor.jpeg",
        "/Gambar/gedung.jpeg",
      ];
      const HERO_SLIDE_INTERVAL_MS = 6000;
      const heroSlideshow = document.getElementById("heroSlideshow");
      if (heroSlideshow && heroSlideImages.length) {
        heroSlideImages.forEach((src, i) => {
          const slide = document.createElement("div");
          slide.className = "hero-slide" + (i === 0 ? " active" : "");
          slide.style.backgroundImage = `url("${src}")`;
          heroSlideshow.appendChild(slide);
        });
        if (heroSlideImages.length > 1) {
          let currentSlide = 0;
          const slideEls = heroSlideshow.querySelectorAll(".hero-slide");
          setInterval(() => {
            slideEls[currentSlide].classList.remove("active");
            currentSlide = (currentSlide + 1) % slideEls.length;
            slideEls[currentSlide].classList.add("active");
          }, HERO_SLIDE_INTERVAL_MS);
        }
      }

    </script>

    <!-- ============ TOAST NOTIFIKASI (sama seperti dashboard admin) ============ -->
    <div class="toast-wrap" id="toastWrap"
      style="position:fixed;bottom:24px;left:50%;transform:translateX(-50%);z-index:100;">
      <div id="toastEl"
        style="opacity:0;pointer-events:none;transition:opacity .25s, transform .25s;transform:translateY(20px);background:var(--navy-900, #152159);color:#fff;padding:12px 22px;border-radius:999px;font-size:13px;font-weight:700;box-shadow:0 10px 24px rgba(21,33,89,.25);">
      </div>
    </div>

    <script>
      function tampilkanToast(pesan) {
        const el = document.getElementById("toastEl");
        el.textContent = pesan;
        el.style.opacity = "1";
        el.style.transform = "translateY(0)";
        clearTimeout(window.__toastTimer);
        window.__toastTimer = setTimeout(() => {
          el.style.opacity = "0";
          el.style.transform = "translateY(20px)";
        }, 2600);
      }

      @if (session('profileStatus'))
        tampilkanToast(@json(session('profileStatus')));
      @endif
      @if (session('passwordStatus'))
        tampilkanToast(@json(session('passwordStatus')));
      @endif
    </script>
  </body>
</html>