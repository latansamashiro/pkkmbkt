@extends('layouts.admin.main')
@section('content')
          <div class="page-head">
            <div>
              <p class="page-eyebrow">Lainnya</p>
              <h2 class="page-title">Pengaturan Sistem</h2>
            </div>
          </div>

          <form id="formPengaturan" class="settings-card">
            <p class="form-section-title">Umum</p>
            <div class="settings-row">
              <div><p class="settings-row-label">Nama Aplikasi</p><p class="settings-row-hint">Tampil di judul halaman dan sidebar.</p></div>
              <div class="settings-row-control"><input type="text" id="inputNamaApp" value="PKKMB-KT" /></div>
            </div>
            <div class="settings-row">
              <div><p class="settings-row-label">Logo</p><p class="settings-row-hint">PNG/SVG, latar transparan disarankan.</p></div>
              <div class="settings-row-control">
                <button type="button" class="btn btn-outline" id="btnUploadLogo"><span class="ic"><i data-lucide="upload"></i></span>Upload Logo</button>
              </div>
            </div>
            <div class="settings-row">
              <div><p class="settings-row-label">Tahun PKKMB Aktif</p><p class="settings-row-hint">Menentukan periode data yang ditampilkan.</p></div>
              <div class="settings-row-control">
                <select id="inputTahunAktif">
                  <option value="2026">2026</option>
                  <option value="2025">2025</option>
                  <option value="2024">2024</option>
                </select>
              </div>
            </div>
            <div class="settings-row">
              <div><p class="settings-row-label">Bahasa</p><p class="settings-row-hint">Bahasa antarmuka default untuk semua pengguna.</p></div>
              <div class="settings-row-control">
                <select id="inputBahasa">
                  <option value="id">Indonesia</option>
                  <option value="en">English</option>
                </select>
              </div>
            </div>

            <p class="form-section-title" style="margin-top:6px;">Basis Data</p>
            <div class="settings-row">
              <div><p class="settings-row-label">Backup Database</p><p class="settings-row-hint" id="lastBackupInfo">Terakhir backup: belum pernah.</p></div>
              <div class="settings-row-control">
                <button type="button" class="btn btn-teal" id="btnBackup"><span class="ic"><i data-lucide="database-backup"></i></span>Backup Sekarang</button>
              </div>
            </div>
            <div class="settings-row">
              <div><p class="settings-row-label">Restore Database</p><p class="settings-row-hint">Mengganti seluruh data saat ini dengan file backup.</p></div>
              <div class="settings-row-control">
                <button type="button" class="btn btn-outline" id="btnRestore"><span class="ic"><i data-lucide="upload"></i></span>Upload Backup</button>
              </div>
            </div>

            <p class="form-section-title" style="margin-top:6px;">Mode Sistem</p>
            <div class="settings-row">
              <div><p class="settings-row-label">Mode Maintenance</p><p class="settings-row-hint">Saat aktif, hanya Super Admin yang bisa mengakses sistem.</p></div>
              <div class="settings-row-control">
                <label class="toggle-switch">
                  <input type="checkbox" id="inputMaintenance" />
                  <span class="toggle-slider"></span>
                </label>
              </div>
            </div>

            <div class="modal-actions" style="margin-top:22px;">
              <button type="submit" class="btn btn-solid"><span class="ic"><i data-lucide="save"></i></span>Simpan</button>
            </div>
          </form>
@endsection

@push('scripts')
<script>
      
      // ===== DUMMY DATA / STATE (ganti dengan hasil fetch() API saat backend siap) =====
      document.getElementById("btnUploadLogo").addEventListener("click", () => tampilkanToast("Pilih file logo dari perangkat Anda..."));

      document.getElementById("btnBackup").addEventListener("click", () => {
        if (!confirm("Backup seluruh database sekarang? Proses ini mungkin memakan waktu beberapa menit.")) return;
        // TODO: panggil endpoint backup di sisi server
        const now = new Date().toLocaleString("id-ID", { dateStyle: "medium", timeStyle: "short" });
        document.getElementById("lastBackupInfo").innerText = "Terakhir backup: " + now;
        tampilkanToast("Backup database berhasil dijalankan.");
      });

      document.getElementById("btnRestore").addEventListener("click", () => {
        if (!confirm("Restore akan MENGGANTI seluruh data saat ini dengan isi file backup. Lanjutkan?")) return;
        // TODO: buka file picker lalu kirim file ke endpoint restore
        tampilkanToast("Pilih file backup untuk memulai proses restore...");
      });

      document.getElementById("inputMaintenance").addEventListener("change", (e) => {
        tampilkanToast(e.target.checked ? "Mode maintenance diaktifkan." : "Mode maintenance dinonaktifkan.");
      });

      document.getElementById("formPengaturan").addEventListener("submit", (e) => {
        e.preventDefault();
        // TODO: kirim seluruh field pengaturan ke API
        tampilkanToast("Pengaturan sistem berhasil disimpan.");
      });

    
</script>
@endpush
