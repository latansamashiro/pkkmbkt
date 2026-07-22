@extends('layouts.admin.main')
@section('content')
          <div class="page-head">
            <div>
              <p class="page-eyebrow">Administrasi</p>
              <h2 class="page-title">Kelola Data Master</h2>
            </div>
          </div>

          <div class="master-grid" id="masterGrid"></div>

    <!-- ===== MODAL DAFTAR DATA MASTER PER KATEGORI ===== -->
    <div class="modal-overlay" id="modalList">
      <div class="modal-card wide">
        <div class="modal-head">
          <div>
            <h3 id="modalListTitle">Data Fakultas</h3>
            <p>Kelola isi data master untuk kategori ini.</p>
          </div>
          <button class="modal-close" id="btnCloseList" aria-label="Tutup"><span class="ic"><i data-lucide="x"></i></span></button>
        </div>
        <div class="toolbar" style="padding:0 0 14px;border:none;">
          <div class="toolbar-search" style="flex:1;">
            <span class="ic"><i data-lucide="search"></i></span>
            <input type="text" id="searchItem" placeholder="Cari data..." />
          </div>
          <button class="btn btn-solid" id="btnTambahItem"><span class="ic"><i data-lucide="plus"></i></span>Tambah</button>
        </div>
        <div class="table-card" style="border-radius:var(--radius-sm);">
          <div class="table-scroll">
            <table>
              <thead><tr><th>No</th><th>Nama</th><th>Aksi</th></tr></thead>
              <tbody id="tabelItem"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- ===== MODAL TAMBAH / EDIT ITEM ===== -->
    <div class="modal-overlay" id="modalForm">
      <div class="modal-card">
        <div class="modal-head">
          <div><h3 id="modalFormTitle">Tambah Data</h3></div>
          <button class="modal-close" id="btnCloseForm" aria-label="Tutup"><span class="ic"><i data-lucide="x"></i></span></button>
        </div>
        <form id="formItem">
          <div class="form-grid" style="grid-template-columns:1fr;">
            <div class="field">
              <label for="inputNamaItem" id="labelNamaItem">Nama</label>
              <input type="text" id="inputNamaItem" required />
            </div>
          </div>
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
      const KATEGORI = [
        { key: "fakultas", icon: "landmark", chip: "chip-navy", label: "Data Fakultas", items: ["Fakultas Teknik", "Fakultas Ekonomi", "Fakultas Hukum", "Fakultas Pertanian"] },
        { key: "prodi", icon: "graduation-cap", chip: "chip-teal", label: "Data Program Studi", items: ["Teknik Informatika", "Manajemen", "Akuntansi", "Ilmu Hukum", "Agroteknologi"] },
        { key: "tahun", icon: "calendar-range", chip: "chip-lime", label: "Data Tahun PKKMB", items: ["PKKMB 2024", "PKKMB 2025", "PKKMB 2026"] },
        { key: "kelompok", icon: "users-round", chip: "chip-coral", label: "Data Kelompok", items: ["Kelompok 01", "Kelompok 02", "Kelompok 03", "Kelompok 04"] },
        { key: "ruangan", icon: "door-open", chip: "chip-navy", label: "Data Ruangan", items: ["Hall Utama", "Aula Fakultas Teknik", "Ruang Serbaguna A"] },
        { key: "jadwal", icon: "calendar-days", chip: "chip-teal", label: "Data Jadwal", items: ["Hari 1 - Pembukaan", "Hari 2 - Materi Wajib", "Hari 3 - Penutupan"] },
      ];

      let activeKategori = null;

      function renderGrid() {
        document.getElementById("masterGrid").innerHTML = KATEGORI.map((k) => `
          <div class="master-card" data-key="${k.key}">
            <div class="master-card-top">
              <span class="stat-chip ${k.chip}"><span class="ic"><i data-lucide="${k.icon}"></i></span></span>
              <span class="ic" style="width:16px;height:16px;color:var(--ink-400);"><i data-lucide="chevron-right"></i></span>
            </div>
            <p class="master-card-title">${k.label}</p>
            <p class="master-card-count">${k.items.length}</p>
            <p class="master-card-label">data tersimpan</p>
          </div>`).join("");
        lucide.createIcons();
        document.querySelectorAll(".master-card").forEach((c) => c.addEventListener("click", () => bukaList(c.dataset.key)));
      }

      const modalList = document.getElementById("modalList");
      const modalForm = document.getElementById("modalForm");

      function bukaList(key) {
        activeKategori = KATEGORI.find((k) => k.key === key);
        document.getElementById("modalListTitle").innerText = activeKategori.label;
        document.getElementById("searchItem").value = "";
        document.getElementById("labelNamaItem").innerText = "Nama " + activeKategori.label.replace("Data ", "");
        renderItemTabel();
        modalList.classList.add("show");
      }
      document.getElementById("btnCloseList").addEventListener("click", () => modalList.classList.remove("show"));
      modalList.addEventListener("click", (e) => { if (e.target === modalList) modalList.classList.remove("show"); });
      document.getElementById("searchItem").addEventListener("keyup", renderItemTabel);

      function renderItemTabel() {
        const q = document.getElementById("searchItem").value.trim().toLowerCase();
        const items = activeKategori.items.filter((it) => !q || it.toLowerCase().includes(q));
        const tbody = document.getElementById("tabelItem");
        if (items.length === 0) {
          tbody.innerHTML = `<tr><td colspan="3" style="text-align:center;padding:20px;color:var(--ink-400);">Tidak ada data.</td></tr>`;
        } else {
          tbody.innerHTML = items.map((it, idx) => `
            <tr>
              <td>${idx + 1}</td>
              <td>${it}</td>
              <td>
                <div class="row-actions">
                  <button class="row-btn" data-aksi="edit" data-idx="${activeKategori.items.indexOf(it)}" aria-label="Edit"><span class="ic"><i data-lucide="pencil"></i></span></button>
                  <button class="row-btn danger" data-aksi="hapus" data-idx="${activeKategori.items.indexOf(it)}" aria-label="Hapus"><span class="ic"><i data-lucide="trash-2"></i></span></button>
                </div>
              </td>
            </tr>`).join("");
        }
        lucide.createIcons();
        document.querySelectorAll('[data-aksi="edit"]').forEach((b) => b.addEventListener("click", () => bukaForm(Number(b.dataset.idx))));
        document.querySelectorAll('[data-aksi="hapus"]').forEach((b) => b.addEventListener("click", () => hapusItem(Number(b.dataset.idx))));
      }

      let editingIdx = null;
      function bukaForm(idx) {
        editingIdx = idx === undefined ? null : idx;
        document.getElementById("modalFormTitle").innerText = editingIdx === null ? "Tambah Data" : "Edit Data";
        document.getElementById("inputNamaItem").value = editingIdx === null ? "" : activeKategori.items[editingIdx];
        modalForm.classList.add("show");
      }
      function tutupForm() { modalForm.classList.remove("show"); editingIdx = null; document.getElementById("formItem").reset(); }
      document.getElementById("btnTambahItem").addEventListener("click", () => bukaForm(null));
      document.getElementById("btnCloseForm").addEventListener("click", tutupForm);
      document.getElementById("btnBatalForm").addEventListener("click", tutupForm);
      modalForm.addEventListener("click", (e) => { if (e.target === modalForm) tutupForm(); });

      document.getElementById("formItem").addEventListener("submit", (e) => {
        e.preventDefault();
        const nilai = document.getElementById("inputNamaItem").value.trim();
        // TODO: kirim ke API sesuai kategori aktif
        if (editingIdx === null) {
          activeKategori.items.push(nilai);
          tampilkanToast("Data berhasil ditambahkan.");
        } else {
          activeKategori.items[editingIdx] = nilai;
          tampilkanToast("Data berhasil diperbarui.");
        }
        tutupForm();
        renderItemTabel();
        renderGrid();
      });

      function hapusItem(idx) {
        if (!confirm(`Hapus "${activeKategori.items[idx]}"?`)) return;
        activeKategori.items.splice(idx, 1);
        tampilkanToast("Data berhasil dihapus.");
        renderItemTabel();
        renderGrid();
      }

      renderGrid();

    
</script>
@endpush
