@extends('layouts.admin.main')
@section('content')
          <div class="page-head">
            <div>
              <p class="page-eyebrow">Lainnya</p>
              <h2 class="page-title">Profil</h2>
            </div>
          </div>

          <form id="formProfil" class="profile-card">
            <div class="profile-photo-row">
              <div class="profile-photo" id="profilInisial">SA</div>
              <div class="profile-meta">
                <strong id="profilNamaTampil">Super Admin</strong>
                <span>Foto profil &mdash; </span>
                <button type="button" class="row-btn-text" id="btnGantiFoto" style="padding:0;">Ganti foto</button>
              </div>
            </div>

            <p class="form-section-title">Informasi Akun</p>
            <div class="form-grid">
              <div class="field" style="grid-column:1/-1;">
                <label for="inputNamaProfil">Nama</label>
                <input type="text" id="inputNamaProfil" value="Super Admin" required />
              </div>
              <div class="field">
                <label for="inputEmailProfil">Email</label>
                <input type="email" id="inputEmailProfil" value="admin@pkkmb.ac.id" required />
              </div>
              <div class="field">
                <label for="inputUsernameProfil">Username</label>
                <input type="text" id="inputUsernameProfil" value="superadmin" required />
              </div>
              <div class="field">
                <label>Role</label>
                <input type="text" class="field-readonly" value="Super Admin" readonly />
              </div>
            </div>

            <hr class="form-divider" />

            <p class="form-section-title">Ubah Password</p>
            <div class="form-grid">
              <div class="field">
                <label for="inputPwLama">Password Lama</label>
                <div class="field-with-icon">
                  <input type="password" id="inputPwLama" placeholder="Masukkan password lama" />
                  <button type="button" class="field-icon-btn" data-toggle-pw="inputPwLama"><span class="ic"><i data-lucide="eye"></i></span></button>
                </div>
              </div>
              <div class="field">
                <label for="inputPwBaru">Password Baru</label>
                <div class="field-with-icon">
                  <input type="password" id="inputPwBaru" placeholder="Minimal 8 karakter" />
                  <button type="button" class="field-icon-btn" data-toggle-pw="inputPwBaru"><span class="ic"><i data-lucide="eye"></i></span></button>
                </div>
              </div>
            </div>

            <div class="modal-actions" style="margin-top:6px;">
              <button type="submit" class="btn btn-solid">Update Profil</button>
            </div>
          </form>
@endsection

@push('scripts')
<script>
      
      // ===== DUMMY DATA (ganti dengan hasil fetch() API saat backend siap) =====
      document.getElementById("btnGantiFoto").addEventListener("click", () => tampilkanToast("Pilih foto baru dari perangkat Anda..."));

      document.querySelectorAll("[data-toggle-pw]").forEach((btn) => {
        btn.addEventListener("click", () => {
          const inp = document.getElementById(btn.dataset.togglePw);
          inp.type = inp.type === "password" ? "text" : "password";
        });
      });

      document.getElementById("inputNamaProfil").addEventListener("input", (e) => {
        document.getElementById("profilNamaTampil").innerText = e.target.value || "Super Admin";
      });

      document.getElementById("formProfil").addEventListener("submit", (e) => {
        e.preventDefault();
        const pwLama = document.getElementById("inputPwLama").value;
        const pwBaru = document.getElementById("inputPwBaru").value;
        if (pwBaru && !pwLama) { tampilkanToast("Masukkan password lama untuk mengganti password."); return; }
        if (pwBaru && pwBaru.length < 8) { tampilkanToast("Password baru minimal 8 karakter."); return; }
        // TODO: kirim data profil (dan password bila diisi) ke API
        tampilkanToast("Profil berhasil diperbarui.");
        document.getElementById("inputPwLama").value = "";
        document.getElementById("inputPwBaru").value = "";
      });

    
</script>
@endpush
