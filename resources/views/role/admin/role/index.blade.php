@extends('layouts.admin.main')
@section('content')
          <div class="page-head">
            <div>
              <p class="page-eyebrow">Administrasi</p>
              <h2 class="page-title">Kelola Role &amp; Hak Akses</h2>
            </div>
            <div class="page-actions">
              <button class="btn btn-solid" id="btnTambahRole">
                <span class="ic"><i data-lucide="plus"></i></span>
                Tambah Role
              </button>
            </div>
          </div>

          <div class="table-card">
            <div class="toolbar">
              <div class="toolbar-search">
                <span class="ic"><i data-lucide="search"></i></span>
                <input type="text" id="searchRole" placeholder="Cari role..." />
              </div>
            </div>
            <div class="table-scroll">
              <table>
                <thead>
                  <tr>
                    <th>Role</th>
                    <th class="center">Dashboard</th>
                    <th class="center">Pengguna</th>
                    <th class="center">Data Master</th>
                    <th class="center">Laporan</th>
                    <th class="center">Pengaturan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="tabelRole"></tbody>
              </table>
            </div>
          </div>

    <!-- ===== MODAL TAMBAH / EDIT ROLE ===== -->
    <div class="modal-overlay" id="modalForm">
      <div class="modal-card">
        <div class="modal-head">
          <div>
            <h3 id="modalFormTitle">Tambah Role</h3>
            <p>Atur nama role dan hak akses tiap modul.</p>
          </div>
          <button class="modal-close" id="btnCloseForm" aria-label="Tutup"><span class="ic"><i data-lucide="x"></i></span></button>
        </div>
        <form id="formRole">
          <div class="form-grid" style="grid-template-columns:1fr;">
            <div class="field">
              <label for="inputNamaRole">Nama Role</label>
              <input type="text" id="inputNamaRole" placeholder="Contoh: Koordinator Fakultas" required />
            </div>
          </div>
          <label style="display:block;font-size:12.5px;font-weight:700;color:var(--ink-900);margin-bottom:10px;">Hak Akses Modul</label>
          <div id="permissionList" style="display:flex;flex-direction:column;gap:10px;margin-bottom:20px;"></div>
          <div class="modal-actions">
            <button type="button" class="btn btn-outline" id="btnBatalForm">Batal</button>
            <button type="submit" class="btn btn-solid">Simpan</button>
          </div>
        </form>
      </div>
    </div>

    
@endsection

@push('scripts')
<script>
      
      // ===== DUMMY DATA (ganti dengan hasil fetch() API saat backend siap) =====
      const MODUL_LIST = [
        { key: "dashboard", label: "Dashboard" },
        { key: "pengguna", label: "Pengguna" },
        { key: "dataMaster", label: "Data Master" },
        { key: "laporan", label: "Laporan" },
        { key: "pengaturan", label: "Pengaturan" },
      ];
      let roleList = [
        { id: 1, nama: "Super Admin", akses: { dashboard: true, pengguna: true, dataMaster: true, laporan: true, pengaturan: true } },
        { id: 2, nama: "Admin", akses: { dashboard: true, pengguna: true, dataMaster: true, laporan: true, pengaturan: false } },
        { id: 3, nama: "Mentor", akses: { dashboard: true, pengguna: false, dataMaster: false, laporan: false, pengaturan: false } },
        { id: 4, nama: "Maba", akses: { dashboard: true, pengguna: false, dataMaster: false, laporan: false, pengaturan: false } },
      ];
      let editingId = null;

      function iconAkses(v) {
        return v
          ? `<span class="check-yes"><span class="ic" style="width:18px;height:18px;margin:0 auto;"><i data-lucide="check-circle-2"></i></span></span>`
          : `<span class="check-no"><span class="ic" style="width:18px;height:18px;margin:0 auto;"><i data-lucide="x-circle"></i></span></span>`;
      }

      function renderTabel() {
        const q = document.getElementById("searchRole").value.trim().toLowerCase();
        const data = roleList.filter((r) => !q || r.nama.toLowerCase().includes(q));
        const tbody = document.getElementById("tabelRole");
        if (data.length === 0) {
          tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:24px;color:var(--ink-400);">Role tidak ditemukan.</td></tr>`;
          lucide.createIcons();
          return;
        }
        tbody.innerHTML = data.map((r) => `
          <tr>
            <td><span class="role-chip">${r.nama}</span></td>
            <td class="center">${iconAkses(r.akses.dashboard)}</td>
            <td class="center">${iconAkses(r.akses.pengguna)}</td>
            <td class="center">${iconAkses(r.akses.dataMaster)}</td>
            <td class="center">${iconAkses(r.akses.laporan)}</td>
            <td class="center">${iconAkses(r.akses.pengaturan)}</td>
            <td>
              <div class="row-actions">
                <button class="row-btn" data-aksi="edit" data-id="${r.id}" aria-label="Edit"><span class="ic"><i data-lucide="pencil"></i></span></button>
                <button class="row-btn danger" data-aksi="hapus" data-id="${r.id}" aria-label="Hapus"><span class="ic"><i data-lucide="trash-2"></i></span></button>
              </div>
            </td>
          </tr>`).join("");
        lucide.createIcons();
        document.querySelectorAll('[data-aksi="edit"]').forEach((b) => b.addEventListener("click", () => bukaForm(Number(b.dataset.id))));
        document.querySelectorAll('[data-aksi="hapus"]').forEach((b) => b.addEventListener("click", () => hapusRole(Number(b.dataset.id))));
      }

      document.getElementById("searchRole").addEventListener("keyup", renderTabel);

      const modalForm = document.getElementById("modalForm");
      function renderPermissionList(akses) {
        document.getElementById("permissionList").innerHTML = MODUL_LIST.map((m) => `
          <label class="radio-status" style="justify-content:space-between;cursor:pointer;">
            <span>${m.label}</span>
            <label class="toggle-switch">
              <input type="checkbox" data-modul="${m.key}" ${akses[m.key] ? "checked" : ""} />
              <span class="toggle-slider"></span>
            </label>
          </label>`).join("");
      }

      function bukaForm(id) {
        editingId = id || null;
        const data = id ? roleList.find((r) => r.id === id) : null;
        document.getElementById("modalFormTitle").innerText = id ? "Edit Role" : "Tambah Role";
        document.getElementById("inputNamaRole").value = data ? data.nama : "";
        renderPermissionList(data ? data.akses : { dashboard: true, pengguna: false, dataMaster: false, laporan: false, pengaturan: false });
        modalForm.classList.add("show");
      }
      function tutupForm() { modalForm.classList.remove("show"); editingId = null; document.getElementById("formRole").reset(); }

      document.getElementById("btnTambahRole").addEventListener("click", () => bukaForm(null));
      document.getElementById("btnCloseForm").addEventListener("click", tutupForm);
      document.getElementById("btnBatalForm").addEventListener("click", tutupForm);
      modalForm.addEventListener("click", (e) => { if (e.target === modalForm) tutupForm(); });

      document.getElementById("formRole").addEventListener("submit", (e) => {
        e.preventDefault();
        const akses = {};
        document.querySelectorAll("#permissionList input[data-modul]").forEach((c) => { akses[c.dataset.modul] = c.checked; });
        const payload = { nama: document.getElementById("inputNamaRole").value.trim(), akses };
        // TODO: kirim payload ke API
        if (editingId) {
          const idx = roleList.findIndex((r) => r.id === editingId);
          if (idx > -1) roleList[idx] = { ...roleList[idx], ...payload };
          tampilkanToast("Role berhasil diperbarui.");
        } else {
          const idBaru = roleList.length ? Math.max(...roleList.map((r) => r.id)) + 1 : 1;
          roleList.push({ id: idBaru, ...payload });
          tampilkanToast("Role baru berhasil ditambahkan.");
        }
        tutupForm();
        renderTabel();
      });

      function hapusRole(id) {
        const r = roleList.find((x) => x.id === id);
        if (!r) return;
        if (r.nama === "Super Admin") { tampilkanToast("Role Super Admin tidak dapat dihapus."); return; }
        if (!confirm(`Hapus role "${r.nama}"?`)) return;
        roleList = roleList.filter((x) => x.id !== id);
        tampilkanToast("Role berhasil dihapus.");
        renderTabel();
      }

      renderTabel();

    
</script>
@endpush
