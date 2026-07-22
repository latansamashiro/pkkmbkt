@extends('layouts.admin.main')
@section('content')
          <div class="page-head">
            <div>
              <p class="page-eyebrow">Administrasi</p>
              <h2 class="page-title">Kelola Pengguna</h2>
            </div>
            <div class="page-actions">
              <button class="btn btn-solid" id="btnTambah">
                <span class="ic"><i data-lucide="user-plus"></i></span>
                Tambah Pengguna
              </button>
            </div>
          </div>

          <div class="table-card">
            <div class="toolbar">
              <select class="filter-select" id="filterRole">
                <option value="">Semua Role</option>
                @foreach ($roles as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
              </select>
              <select class="filter-select" id="filterStatus">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
              </select>
              <div class="toolbar-search">
                <span class="ic"><i data-lucide="search"></i></span>
                <input type="text" id="searchPengguna" placeholder="Cari nama atau email..." />
              </div>
            </div>
            <div class="table-scroll">
              <table>
                <thead><tr><th>No</th><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody id="tabelPengguna"></tbody>
              </table>
            </div>
            <div class="pagination">
              <p class="pagination-info" id="paginationInfo">Showing 0 of 0</p>
              <div class="pagination-btns" id="paginationBtns"></div>
            </div>
          </div>

    <!-- ===== MODAL TAMBAH / EDIT PENGGUNA ===== -->
    <div class="modal-overlay" id="modalForm">
      <div class="modal-card">
        <div class="modal-head">
          <div>
            <h3 id="modalFormTitle">Tambah Pengguna</h3>
            <p>Buat akun pengguna baru untuk sistem PKKMB-KT.</p>
          </div>
          <button class="modal-close" id="btnCloseForm" aria-label="Tutup"><span class="ic"><i data-lucide="x"></i></span></button>
        </div>
        <form id="formPengguna">
          <p class="field-hint" id="formError" style="display:none; color:#c0392b; margin:0 0 12px;"></p>
          <div class="form-grid">
            <div class="field" style="grid-column:1/-1">
              <label for="inputNama">Nama Lengkap</label>
              <input type="text" id="inputNama" placeholder="Contoh: Deni Saputra" required />
            </div>
            <div class="field" style="grid-column:1/-1">
              <label for="inputEmail">Email</label>
              <input type="email" id="inputEmail" placeholder="nama@pkkmb.ac.id" required />
            </div>
            <div class="field" id="fieldPassword" style="grid-column:1/-1">
              <label for="inputPassword">Password</label>
              <div class="field-with-icon">
                <input type="password" id="inputPassword" placeholder="Minimal 8 karakter" />
                <button type="button" class="field-icon-btn" id="btnTogglePw"><span class="ic"><i data-lucide="eye"></i></span></button>
              </div>
              <p class="field-hint" id="hintPassword">Kosongkan saat edit jika tidak ingin mengubah password.</p>
            </div>
            <div class="field">
              <label for="inputRole">Role</label>
              <select id="inputRole" required>
                @foreach ($roles as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="field">
              <label>Status</label>
              <div class="status-toggle-group">
                <label class="status-toggle">
                  <input type="radio" name="statusPengguna" value="aktif" checked />
                  <span class="dot"></span> Aktif
                </label>
                <label class="status-toggle">
                  <input type="radio" name="statusPengguna" value="nonaktif" />
                  <span class="dot"></span> Nonaktif
                </label>
              </div>
            </div>
          </div>
          <div class="modal-actions">
            <button type="button" class="btn btn-outline" id="btnBatalForm">Batal</button>
            <button type="submit" class="btn btn-solid" id="btnSimpanForm">Simpan</button>
          </div>
        </form>
      </div>
    </div>

    <!-- ===== MODAL DETAIL PENGGUNA ===== -->
    <div class="modal-overlay" id="modalDetail">
      <div class="modal-card">
        <div class="modal-head">
          <div><h3>Detail Pengguna</h3></div>
          <button class="modal-close" id="btnCloseDetail" aria-label="Tutup"><span class="ic"><i data-lucide="x"></i></span></button>
        </div>
        <div class="detail-list">
          <div class="detail-row"><span class="dt-label">Nama</span><span class="dt-value" id="detailNama">-</span></div>
          <div class="detail-row"><span class="dt-label">Email</span><span class="dt-value" id="detailEmail">-</span></div>
          <div class="detail-row"><span class="dt-label">Role</span><span class="dt-value" id="detailRole">-</span></div>
          <div class="detail-row"><span class="dt-label">Status</span><span class="dt-value" id="detailStatus">-</span></div>
        </div>
        <div class="modal-actions">
          <button type="button" class="btn btn-outline" id="btnEditDariDetail">Edit</button>
        </div>
      </div>
    </div>
@endsection

@php
    $penggunaListJson = $users->map(fn ($u) => [
        'id' => $u->id,
        'nama' => $u->name,
        'email' => $u->email,
        'role' => $u->role_name,
        'status' => $u->status,
    ]);
@endphp

@push('scripts')
<script>
      // ===== Data asli dari database (dikirim server saat halaman dimuat) =====
      let penggunaList = @json($penggunaListJson);
      const ROLE_LABEL = @json($roles);
      const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;
      const URL_STORE = "{{ route('admin.user.store') }}";
      const URL_UPDATE_BASE = "{{ url('admin/user') }}"; // + /{id}

      const PER_PAGE = 5;
      let currentPage = 1;
      let editingId = null;

      function initials(nama) { return nama.split(" ").map((s) => s[0]).slice(0, 2).join("").toUpperCase(); }

      function filteredData() {
        const role = document.getElementById("filterRole").value;
        const status = document.getElementById("filterStatus").value;
        const q = document.getElementById("searchPengguna").value.trim().toLowerCase();
        return penggunaList.filter((p) =>
          (!role || p.role === role) &&
          (!status || p.status === status) &&
          (!q || p.nama.toLowerCase().includes(q) || p.email.toLowerCase().includes(q))
        );
      }

      function renderTabel() {
        const data = filteredData();
        const totalData = data.length;
        const totalPage = Math.max(1, Math.ceil(totalData / PER_PAGE));
        if (currentPage > totalPage) currentPage = totalPage;
        const start = (currentPage - 1) * PER_PAGE;
        const pageData = data.slice(start, start + PER_PAGE);

        const tbody = document.getElementById("tabelPengguna");
        if (pageData.length === 0) {
          tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;padding:24px;color:var(--ink-400);">Tidak ada pengguna ditemukan.</td></tr>`;
        } else {
          tbody.innerHTML = pageData.map((p, idx) => `
            <tr>
              <td>${start + idx + 1}</td>
              <td class="cell-name"><strong>${p.nama}</strong></td>
              <td>${p.email}</td>
              <td><span class="role-chip">${ROLE_LABEL[p.role] ?? p.role}</span></td>
              <td><span class="badge ${p.status === "aktif" ? "badge-active" : "badge-inactive"}"><span class="dot"></span>${p.status === "aktif" ? "Aktif" : "Nonaktif"}</span></td>
              <td>
                <div class="row-actions">
                  <button class="row-btn" data-aksi="lihat" data-id="${p.id}" aria-label="Detail"><span class="ic"><i data-lucide="eye"></i></span></button>
                  <button class="row-btn" data-aksi="edit" data-id="${p.id}" aria-label="Edit"><span class="ic"><i data-lucide="pencil"></i></span></button>
                  <button class="row-btn danger" data-aksi="hapus" data-id="${p.id}" aria-label="Hapus"><span class="ic"><i data-lucide="trash-2"></i></span></button>
                </div>
              </td>
            </tr>`).join("");
        }
        document.getElementById("paginationInfo").innerText =
          totalData === 0 ? "Showing 0 of 0" : `Showing ${start + 1}-${Math.min(start + PER_PAGE, totalData)} of ${totalData}`;
        renderPaginationBtns(totalPage);
        lucide.createIcons();
        pasangEventAksiBaris();
      }

      function renderPaginationBtns(totalPage) {
        const wrap = document.getElementById("paginationBtns");
        let html = `<button class="page-btn" id="pgPrev" aria-label="Sebelumnya"><span class="ic"><i data-lucide="chevron-left"></i></span></button>`;
        for (let p = 1; p <= totalPage; p++) html += `<button class="page-btn ${p === currentPage ? "active" : ""}" data-page="${p}">${p}</button>`;
        html += `<button class="page-btn" id="pgNext" aria-label="Berikutnya"><span class="ic"><i data-lucide="chevron-right"></i></span></button>`;
        wrap.innerHTML = html;
        wrap.querySelectorAll("[data-page]").forEach((b) => b.addEventListener("click", () => { currentPage = Number(b.dataset.page); renderTabel(); }));
        document.getElementById("pgPrev").addEventListener("click", () => { if (currentPage > 1) { currentPage--; renderTabel(); } });
        document.getElementById("pgNext").addEventListener("click", () => { if (currentPage < totalPage) { currentPage++; renderTabel(); } });
      }

      function pasangEventAksiBaris() {
        document.querySelectorAll('[data-aksi="lihat"]').forEach((b) => b.addEventListener("click", () => bukaDetail(Number(b.dataset.id))));
        document.querySelectorAll('[data-aksi="edit"]').forEach((b) => b.addEventListener("click", () => bukaForm(Number(b.dataset.id))));
        document.querySelectorAll('[data-aksi="hapus"]').forEach((b) => b.addEventListener("click", () => hapusPengguna(Number(b.dataset.id))));
      }

      ["filterRole", "filterStatus"].forEach((id) => document.getElementById(id).addEventListener("change", () => { currentPage = 1; renderTabel(); }));
      document.getElementById("searchPengguna").addEventListener("keyup", () => { currentPage = 1; renderTabel(); });

      const modalForm = document.getElementById("modalForm");
      const modalDetail = document.getElementById("modalDetail");
      const formError = document.getElementById("formError");

      function bukaForm(id) {
        editingId = id || null;
        formError.style.display = "none";
        const data = id ? penggunaList.find((p) => p.id === id) : null;
        document.getElementById("modalFormTitle").innerText = id ? "Edit Pengguna" : "Tambah Pengguna";
        document.getElementById("inputNama").value = data ? data.nama : "";
        document.getElementById("inputEmail").value = data ? data.email : "";
        document.getElementById("inputPassword").value = "";
        document.getElementById("inputPassword").required = !id;
        document.getElementById("hintPassword").style.display = id ? "block" : "none";
        document.getElementById("inputRole").value = data ? data.role : "student";
        document.querySelectorAll('input[name="statusPengguna"]').forEach((r) => { r.checked = r.value === (data ? data.status : "aktif"); });
        modalForm.classList.add("show");
      }
      function tutupForm() { modalForm.classList.remove("show"); editingId = null; document.getElementById("formPengguna").reset(); }

      document.getElementById("btnTambah").addEventListener("click", () => bukaForm(null));
      document.getElementById("btnCloseForm").addEventListener("click", tutupForm);
      document.getElementById("btnBatalForm").addEventListener("click", tutupForm);
      modalForm.addEventListener("click", (e) => { if (e.target === modalForm) tutupForm(); });
      document.getElementById("btnTogglePw").addEventListener("click", () => {
        const inp = document.getElementById("inputPassword");
        inp.type = inp.type === "password" ? "text" : "password";
      });

      document.getElementById("formPengguna").addEventListener("submit", async (e) => {
        e.preventDefault();
        formError.style.display = "none";

        const statusInput = document.querySelector('input[name="statusPengguna"]:checked');
        const payload = {
          name: document.getElementById("inputNama").value.trim(),
          email: document.getElementById("inputEmail").value.trim(),
          password: document.getElementById("inputPassword").value,
          role_name: document.getElementById("inputRole").value,
          status: statusInput ? statusInput.value : "aktif",
        };

        const btnSimpan = document.getElementById("btnSimpanForm");
        btnSimpan.disabled = true;

        try {
          const url = editingId ? `${URL_UPDATE_BASE}/${editingId}` : URL_STORE;
          const method = editingId ? "PUT" : "POST";
          const res = await fetch(url, {
            method,
            headers: {
              "Content-Type": "application/json",
              "Accept": "application/json",
              "X-CSRF-TOKEN": CSRF_TOKEN,
            },
            body: JSON.stringify(payload),
          });
          const result = await res.json();

          if (!res.ok) {
            if (result.errors) {
              const pesan = Object.values(result.errors).flat().join(" ");
              formError.innerText = pesan;
            } else {
              formError.innerText = result.message || "Terjadi kesalahan, silakan coba lagi.";
            }
            formError.style.display = "block";
            return;
          }

          const savedUser = {
            id: result.user.id,
            nama: result.user.name,
            email: result.user.email,
            role: result.user.role_name,
            status: result.user.status,
          };

          if (editingId) {
            const idx = penggunaList.findIndex((p) => p.id === editingId);
            if (idx > -1) penggunaList[idx] = savedUser;
          } else {
            penggunaList.push(savedUser);
          }

          tampilkanToast(result.message);
          tutupForm();
          renderTabel();
        } catch (err) {
          formError.innerText = "Tidak bisa terhubung ke server. Periksa koneksi Anda.";
          formError.style.display = "block";
        } finally {
          btnSimpan.disabled = false;
        }
      });

      let detailActiveId = null;
      function bukaDetail(id) {
        const p = penggunaList.find((x) => x.id === id);
        if (!p) return;
        detailActiveId = id;
        document.getElementById("detailNama").innerText = p.nama;
        document.getElementById("detailEmail").innerText = p.email;
        document.getElementById("detailRole").innerText = ROLE_LABEL[p.role] ?? p.role;
        document.getElementById("detailStatus").innerText = p.status === "aktif" ? "Aktif" : "Nonaktif";
        modalDetail.classList.add("show");
      }
      document.getElementById("btnCloseDetail").addEventListener("click", () => modalDetail.classList.remove("show"));
      modalDetail.addEventListener("click", (e) => { if (e.target === modalDetail) modalDetail.classList.remove("show"); });
      document.getElementById("btnEditDariDetail").addEventListener("click", () => {
        const id = detailActiveId;
        modalDetail.classList.remove("show");
        bukaForm(id);
      });

      async function hapusPengguna(id) {
        const p = penggunaList.find((x) => x.id === id);
        if (!p) return;
        if (!confirm(`Hapus pengguna "${p.nama}"?`)) return;

        try {
          const res = await fetch(`${URL_UPDATE_BASE}/${id}`, {
            method: "DELETE",
            headers: {
              "Accept": "application/json",
              "X-CSRF-TOKEN": CSRF_TOKEN,
            },
          });
          const result = await res.json();

          if (!res.ok) {
            tampilkanToast(result.message || "Gagal menghapus pengguna.");
            return;
          }

          penggunaList = penggunaList.filter((x) => x.id !== id);
          tampilkanToast(result.message);
          renderTabel();
        } catch (err) {
          tampilkanToast("Tidak bisa terhubung ke server.");
        }
      }

      renderTabel();
</script>
@endpush
