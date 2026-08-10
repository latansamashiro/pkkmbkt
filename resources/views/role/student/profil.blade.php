{{-- resources/views/role/mentor/profil.blade.php --}}
@extends('layouts.mentor.main')

@section('title', 'Profil Mentor | PKKMB-KT UNILAM 2026')
@section('page-title', 'Profil')

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    .profil-hero { position: relative; overflow: hidden; border-radius: var(--radius-lg); text-align: center; background: linear-gradient(135deg, rgba(21, 33, 89, 0.94), rgba(15, 138, 140, 0.85)); padding: clamp(32px, 6vw, 52px) clamp(20px, 5vw, 40px); }
    .profil-hero-inner { position: relative; z-index: 1; max-width: 620px; margin: 0 auto; }
    .profil-hero h1 { font-family: var(--font-display); font-size: clamp(22px, 3.6vw, 34px); font-weight: 700; color: #fff; margin: 0 0 12px; line-height: 1.2; }
    .profil-hero-sub { font-size: 14px; color: rgba(255, 255, 255, 0.75); line-height: 1.7; margin: 0; }

    .profile-grid { display: grid; grid-template-columns: 1fr; gap: 24px; align-items: start; }
    @media (min-width: 1024px) { .profile-grid { grid-template-columns: 320px 1fr; } }
    .stack-gap { display: flex; flex-direction: column; gap: 24px; }

    .avatar-card { background: var(--surface); border-radius: var(--radius-lg); border: 1px solid var(--border); box-shadow: var(--shadow-card); padding: clamp(24px, 4vw, 32px); display: flex; flex-direction: column; align-items: center; text-align: center; }
    .avatar-wrap { position: relative; width: 140px; height: 140px; margin-bottom: 18px; }
    .avatar-wrap .ring { width: 100%; height: 100%; border-radius: 50%; overflow: hidden; background: var(--navy-tint); box-shadow: var(--shadow-pop); }
    .avatar-wrap img { width: 100%; height: 100%; object-fit: cover; }
    .avatar-cam { position: absolute; bottom: 2px; right: 2px; width: 42px; height: 42px; border-radius: 50%; background: var(--teal-500); color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: var(--shadow-pop); transition: transform 0.15s, background 0.15s; }
    .avatar-cam:hover { background: var(--teal-600); transform: scale(1.08); }

    .avatar-name { font-family: var(--font-display); font-size: 22px; font-weight: 700; color: var(--ink-900); margin: 0; }
    .avatar-role { display: inline-block; font-size: 12.5px; font-weight: 700; color: var(--teal-600); background: var(--teal-tint); border-radius: 99px; padding: 5px 16px; margin-top: 8px; }
    .avatar-divider { width: 100%; border-top: 1px solid var(--border); margin: 22px 0; }
    .avatar-hint { font-size: 12px; color: var(--ink-600); line-height: 1.6; background: var(--amber-tint); border: 1px dashed var(--amber-500); border-radius: var(--radius-md); padding: 14px 16px; text-align: left; }
    .avatar-hint i { color: var(--amber-500); margin-right: 6px; }
    .avatar-hint b { color: var(--ink-900); }

    .form-card { background: var(--surface); border-radius: var(--radius-lg); border: 1px solid var(--border); box-shadow: var(--shadow-card); overflow: hidden; }
    .form-card-head { display: flex; align-items: center; gap: 10px; padding: 20px clamp(20px, 4vw, 28px); border-bottom: 1px solid var(--border); background: var(--bg); }
    .form-card-head .dot { width: 10px; height: 10px; border-radius: 50%; background: var(--teal-500); }
    .form-card-head.head-amber .dot { background: var(--amber-500); }
    .form-card-head h3 { font-family: var(--font-display); font-size: 16px; font-weight: 700; color: var(--ink-900); margin: 0; }

    .lock-banner { display: flex; align-items: flex-start; gap: 10px; font-size: 12px; line-height: 1.6; color: var(--ink-600); background: var(--navy-tint); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 12px 14px; margin: 0 clamp(20px, 4vw, 28px); margin-top: clamp(20px, 4vw, 28px); }
    .lock-banner i { color: var(--navy-700); margin-top: 2px; font-size: 13px; }

    .form-body { padding: clamp(20px, 4vw, 28px); }
    .field-grid { display: grid; grid-template-columns: 1fr; gap: 20px; }
    @media (min-width: 640px) { .field-grid { grid-template-columns: 1fr 1fr; } }
    .field-full { grid-column: 1 / -1; }
    .field-label { display: flex; align-items: center; gap: 6px; font-size: 11px; font-weight: 800; letter-spacing: 0.05em; text-transform: uppercase; color: var(--ink-400); margin-bottom: 8px; }
    .field-label .lock-tag { display: inline-flex; align-items: center; gap: 4px; font-size: 9.5px; font-weight: 800; letter-spacing: 0.03em; text-transform: none; color: var(--ink-600); background: var(--surface-muted, #e8ebf6); border: 1px solid var(--border); border-radius: 99px; padding: 2px 8px; }
    .field-label .lock-tag i { font-size: 9px; }
    .field-input-wrap { position: relative; }
    .field-input-wrap i.field-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--ink-400); font-size: 14px; }
    .field-input-wrap i.field-lock-icon { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--ink-400); font-size: 13px; }
    .field-input { width: 100%; padding: 11px 14px 11px 40px; border-radius: 12px; border: 1px solid var(--border); background: var(--bg); font-family: var(--font-sans); font-size: 13.5px; font-weight: 500; color: var(--ink-900); transition: border-color 0.15s, background 0.15s, box-shadow 0.15s; }
    .field-input:focus { outline: none; border-color: var(--teal-500); background: #fff; box-shadow: 0 0 0 4px var(--teal-tint); }
    .field-input:disabled { background: var(--border); color: var(--ink-600); cursor: not-allowed; padding-right: 36px; }
    textarea.field-input { padding-left: 14px; resize: none; }

    .gender-toggle { display: flex; gap: 10px; }
    .gender-toggle input { display: none; }
    .gender-pill { flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 11px 14px; border-radius: 12px; border: 1px solid var(--border); background: var(--bg); font-size: 13.5px; font-weight: 700; color: var(--ink-600); cursor: pointer; transition: border-color 0.15s, background 0.15s, color 0.15s; }
    .gender-pill i { font-size: 14px; }
    .gender-toggle input:checked + .gender-pill { border-color: var(--teal-500); background: var(--teal-tint); color: var(--teal-600); }
    .gender-toggle.locked .gender-pill { cursor: not-allowed; opacity: 0.7; }
    .gender-toggle.locked input[value="laki-laki"]:checked + .gender-pill { background: #dbeafe; border-color: #2563eb; color: #2563eb; }
    .gender-toggle.locked input[value="perempuan"]:checked + .gender-pill { background: #fce7f3; border-color: #ec4899; color: #ec4899; }

    .form-actions { display: flex; align-items: center; justify-content: flex-end; gap: 12px; padding-top: 20px; margin-top: 6px; border-top: 1px solid var(--border); }
    .btn-ghost { padding: 11px 22px; border-radius: 12px; font-size: 13.5px; font-weight: 700; color: var(--ink-600); background: transparent; border: none; cursor: pointer; transition: background 0.15s; }
    .btn-ghost:hover { background: var(--bg); }
    .btn-save { padding: 12px 26px; border-radius: 12px; font-size: 13.5px; font-weight: 700; color: #fff; background: var(--navy-900); border: none; cursor: pointer; box-shadow: var(--shadow-pop); transition: background 0.15s, transform 0.15s; text-decoration: none; display: inline-block; }
    .btn-save:hover { background: var(--navy-700); }
    .btn-save:active { transform: scale(0.98); }

    .password-note { font-size: 12px; color: var(--ink-600); line-height: 1.6; margin: 0 0 18px; }
    .password-error { font-size: 12px; font-weight: 700; color: #c0392b; margin: -10px 0 16px; display: none; }
    .password-error.show { display: block; }

    .profil-toast { position: fixed; bottom: calc(var(--bottomnav-h) + 16px); left: 50%; transform: translateX(-50%) translateY(20px); z-index: 100; opacity: 0; pointer-events: none; transition: opacity .25s, transform .25s; background: var(--navy-900); color: #fff; padding: 12px 22px; border-radius: 999px; font-size: 13px; font-weight: 700; box-shadow: var(--shadow-pop); white-space: nowrap; }
    .profil-toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }
    @media (min-width: 768px) { .profil-toast { bottom: 16px; } }
  </style>
@endpush

@section('content')

  <!-- ===== HERO ===== -->
  <section class="profil-hero">
    <div class="profil-hero-inner">
      <div class="hero-eyebrow">
        <span class="dot"></span>
        Pengaturan Akun
      </div>
      <h1>Profil Akun Mentor</h1>
      <p class="profil-hero-sub">
        Kelola informasi profil, NPM, dan pembaruan data mentor
        Universitas La Tansa Mashiro.
      </p>
    </div>
  </section>

  <!-- ===== FORM ===== -->
  <section class="section">
    <div class="profile-grid">
      <div class="avatar-card">
        <div class="avatar-wrap">
          <div class="ring">
            <img
              id="avatarPreview"
              src="{{ auth()->user()->profile_picture ? asset('storage/'.auth()->user()->profile_picture) : 'data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27%3E%3Crect width=%27100%27 height=%27100%27 fill=%27%23e2e8f0%27/%3E%3Ccircle cx=%2750%27 cy=%2738%27 r=%2718%27 fill=%27%2394a3b8%27/%3E%3Cpath d=%27M20 88c0-22 13-35 30-35s30 13 30 35%27 fill=%27%2394a3b8%27/%3E%3C/svg%3E' }}"
              alt="Foto Profil" />
          </div>
          <label for="avatarUpload" class="avatar-cam">
            <i class="fa-solid fa-camera"></i>
            <input type="file" id="avatarUpload" name="avatar" form="profileForm" accept="image/*" class="hidden" style="display: none" />
          </label>
        </div>

        <h2 id="summaryName" class="avatar-name">{{ auth()->user()->name }}</h2>
        <span id="summaryRole" class="avatar-role">Mentor {{ auth()->user()->program_study_name ?? '-' }}</span>

        <div class="avatar-divider"></div>

        <p class="avatar-hint">
          <i class="fa-solid fa-triangle-exclamation"></i><b>Wajib menggunakan foto asli / wajah sendiri</b> (bukan
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
                  <span class="lock-tag"><i class="fa-solid fa-lock"></i>Terkunci</span>
                </label>
                <div class="field-input-wrap">
                  <i class="fa-solid fa-id-card field-icon"></i>
                  <input type="text" id="inputName" value="{{ auth()->user()->name }}" class="field-input" disabled readonly />
                  <i class="fa-solid fa-lock field-lock-icon"></i>
                </div>
              </div>

              <div>
                <label class="field-label">
                  Nomor Identitas / NPM
                  <span class="lock-tag"><i class="fa-solid fa-lock"></i>Terkunci</span>
                </label>
                <div class="field-input-wrap">
                  <i class="fa-solid fa-graduation-cap field-icon"></i>
                  <input type="text" id="inputNPM" value="{{ auth()->user()->npm ?? '-' }}" class="field-input" disabled readonly />
                  <i class="fa-solid fa-lock field-lock-icon"></i>
                </div>
              </div>

              <div>
                <label class="field-label">
                  Alamat Email
                  <span class="lock-tag"><i class="fa-solid fa-lock"></i>Terkunci</span>
                </label>
                <div class="field-input-wrap">
                  <i class="fa-solid fa-envelope field-icon"></i>
                  <input type="email" value="{{ auth()->user()->email }}" class="field-input" disabled readonly />
                  <i class="fa-solid fa-lock field-lock-icon"></i>
                </div>
              </div>

              <div>
                <label class="field-label">
                  Program Studi
                  <span class="lock-tag"><i class="fa-solid fa-lock"></i>Terkunci</span>
                </label>
                <div class="field-input-wrap">
                  <i class="fa-solid fa-briefcase field-icon"></i>
                  <input type="text" id="inputRole" value="{{ auth()->user()->program_study_name ?? '-' }}" class="field-input" disabled readonly />
                  <i class="fa-solid fa-lock field-lock-icon"></i>
                </div>
              </div>

              <div>
                <label class="field-label">Nomor Telepon</label>
                <div class="field-input-wrap">
                  <i class="fa-solid fa-phone field-icon"></i>
                  <input type="tel" name="phone_no" value="{{ old('phone_no', auth()->user()->phone_no) }}" class="field-input" />
                </div>
              </div>

              <div class="field-full">
                <label class="field-label">
                  Jenis Kelamin
                  <span class="lock-tag"><i class="fa-solid fa-lock"></i>Terkunci</span>
                </label>
                <div class="gender-toggle locked">
                  <label>
                    <input type="radio" name="gender" value="laki-laki" @checked(auth()->user()->gender === 'laki-laki') disabled />
                    <span class="gender-pill"><i class="fa-solid fa-mars"></i> Laki-laki</span>
                  </label>
                  <label>
                    <input type="radio" name="gender" value="perempuan" @checked(auth()->user()->gender === 'perempuan') disabled />
                    <span class="gender-pill"><i class="fa-solid fa-venus"></i> Perempuan</span>
                  </label>
                </div>
              </div>
            </div>

            <div class="form-actions">
              <button type="button" onclick="window.history.back()" class="btn-ghost">Batal</button>
              <button type="submit" class="btn-save">Simpan Perubahan</button>
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
            <p class="password-error show" style="margin: 16px clamp(20px,4vw,28px) 0;">{{ $errors->passwordUpdate->first() }}</p>
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
                  <input type="password" id="oldPassword" name="old_password" class="field-input" placeholder="Masukkan kata sandi lama" required />
                </div>
              </div>

              <div>
                <label class="field-label">Kata Sandi Baru</label>
                <div class="field-input-wrap">
                  <i class="fa-solid fa-key field-icon"></i>
                  <input type="password" id="newPassword" name="new_password" class="field-input" placeholder="Minimal 8 karakter" minlength="8" required />
                </div>
              </div>

              <div>
                <label class="field-label">Konfirmasi Kata Sandi Baru</label>
                <div class="field-input-wrap">
                  <i class="fa-solid fa-key field-icon"></i>
                  <input type="password" id="confirmPassword" name="new_password_confirmation" class="field-input" placeholder="Ulangi kata sandi baru" minlength="8" required />
                </div>
              </div>
            </div>

            <p id="passwordError" class="password-error">Kata sandi baru dan konfirmasi tidak sama.</p>

            <div class="form-actions">
              <button type="button" id="cancelPasswordBtn" class="btn-ghost">Batal</button>
              <button type="submit" class="btn-save">Ubah Kata Sandi</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== TOAST NOTIFIKASI ===== -->
  <div class="profil-toast" id="profilToast"></div>

@endsection

@push('scripts')
  <script>
    $(function () {
      $("#avatarUpload").on("change", function () {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = (e) => $("#avatarPreview").attr("src", e.target.result);
          reader.readAsDataURL(file);
        }
      });

      // Nama, NPM, Email, Program Studi & Jenis Kelamin terkunci (disabled).
      // Ringkasan nama/role di kartu avatar sudah dirender langsung dari
      // data user di server, jadi tidak perlu ditimpa lagi lewat JS di sini.
      // profileForm adalah form sungguhan (POST ke server), jadi tidak
      // perlu preventDefault lagi di sini.

      // ======================================================================
      // ►► UBAH KATA SANDI
      // ======================================================================
      const $passwordForm = $("#passwordForm");
      const $oldPassword = $("#oldPassword");
      const $newPassword = $("#newPassword");
      const $confirmPassword = $("#confirmPassword");
      const $passwordError = $("#passwordError");

      $("#cancelPasswordBtn").on("click", function () {
        $passwordForm.trigger("reset");
        $passwordError.removeClass("show");
      });

      $passwordForm.on("submit", function (e) {
        $passwordError.removeClass("show");

        if ($newPassword.val().length < 8) {
          e.preventDefault();
          $passwordError.text("Kata sandi baru minimal 8 karakter.").addClass("show");
          return;
        }

        if ($newPassword.val() !== $confirmPassword.val()) {
          e.preventDefault();
          $passwordError.text("Kata sandi baru dan konfirmasi tidak sama.").addClass("show");
          return;
        }

        if ($newPassword.val() === $oldPassword.val()) {
          e.preventDefault();
          $passwordError.text("Kata sandi baru tidak boleh sama dengan kata sandi lama.").addClass("show");
          return;
        }

        // Lolos validasi di browser -> form lanjut submit sungguhan ke server.
      });

      // ======================================================================
      // ►► TOAST NOTIFIKASI
      // ======================================================================
      function tampilkanToast(pesan) {
        const $toast = $("#profilToast");
        $toast.text(pesan).addClass("show");
        clearTimeout(window.__toastTimer);
        window.__toastTimer = setTimeout(() => $toast.removeClass("show"), 2600);
      }

      @if (session('profileStatus'))
        tampilkanToast(@json(session('profileStatus')));
      @endif
      @if (session('passwordStatus'))
        tampilkanToast(@json(session('passwordStatus')));
      @endif
    });
  </script>
@endpush