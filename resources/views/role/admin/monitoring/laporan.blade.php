@extends('layouts.admin.main')
@section('content')
          <div class="page-head">
            <div>
              <p class="page-eyebrow">Monitoring</p>
              <h2 class="page-title">Monitoring Laporan</h2>
            </div>
            <div class="page-actions">
              <button class="btn btn-solid" id="btnExport">
                <span class="ic"><i data-lucide="download"></i></span>
                Export PDF
              </button>
            </div>
          </div>

          <div class="table-card">
            <div class="toolbar">
              <select class="filter-select" id="filterJenis">
                <option value="">Semua Jenis</option>
                <option value="Absensi">Absensi</option>
                <option value="Evaluasi">Evaluasi</option>
                <option value="Keaktifan">Keaktifan</option>
              </select>
              <div class="date-nav" id="dateNavTanggal">
                <button type="button" class="date-nav-btn" id="btnTanggalPrev" aria-label="Hari sebelumnya"><span class="ic"><i data-lucide="chevron-left"></i></span></button>
                <input type="date" class="filter-select" id="filterTanggal" />
                <button type="button" class="date-nav-btn" id="btnTanggalNext" aria-label="Hari berikutnya"><span class="ic"><i data-lucide="chevron-right"></i></span></button>
              </div>
              <div class="toolbar-search">
                <span class="ic"><i data-lucide="search"></i></span>
                <input type="text" id="searchLaporan" placeholder="Cari laporan..." />
              </div>
            </div>
            <div class="table-scroll">
              <table>
                <thead><tr><th>No</th><th>Jenis</th><th>Dibuat Oleh</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody id="tabelLaporan"></tbody>
              </table>
            </div>
            <div class="pagination">
              <p class="pagination-info" id="paginationInfo">Showing 0 of 0</p>
              <div class="pagination-btns" id="paginationBtns"></div>
            </div>
          </div>
@endsection

@push('scripts')
<script>
      
      // ===== DUMMY DATA (ganti dengan hasil fetch() API saat backend siap) =====
      const laporanList = [
        { id: 1, jenis: "Absensi", olehLabel: "Admin", tanggal: "2026-08-20", status: "Selesai" },
        { id: 2, jenis: "Evaluasi", olehLabel: "Mentor", tanggal: "2026-08-20", status: "Selesai" },
        { id: 3, jenis: "Keaktifan", olehLabel: "Admin", tanggal: "2026-08-21", status: "Diproses" },
        { id: 4, jenis: "Absensi", olehLabel: "Admin", tanggal: "2026-08-21", status: "Selesai" },
        { id: 5, jenis: "Evaluasi", olehLabel: "Mentor", tanggal: "2026-08-22", status: "Selesai" },
        { id: 6, jenis: "Keaktifan", olehLabel: "Admin", tanggal: "2026-08-22", status: "Selesai" },
      ];
      const PER_PAGE = 5;
      let currentPage = 1;

      function filteredData() {
        const jenis = document.getElementById("filterJenis").value;
        const tanggal = document.getElementById("filterTanggal").value;
        const q = document.getElementById("searchLaporan").value.trim().toLowerCase();
        return laporanList.filter((l) =>
          (!jenis || l.jenis === jenis) &&
          (!tanggal || l.tanggal === tanggal) &&
          (!q || l.jenis.toLowerCase().includes(q) || l.olehLabel.toLowerCase().includes(q))
        );
      }

      function tanggalIndo(iso) {
        const d = new Date(iso + "T00:00:00");
        return d.toLocaleDateString("id-ID", { day: "2-digit", month: "short", year: "numeric" });
      }

      function renderTabel() {
        const data = filteredData();
        const totalData = data.length;
        const totalPage = Math.max(1, Math.ceil(totalData / PER_PAGE));
        if (currentPage > totalPage) currentPage = totalPage;
        const start = (currentPage - 1) * PER_PAGE;
        const pageData = data.slice(start, start + PER_PAGE);
        const tbody = document.getElementById("tabelLaporan");
        if (pageData.length === 0) {
          tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;padding:24px;color:var(--ink-400);">Tidak ada laporan ditemukan.</td></tr>`;
        } else {
          tbody.innerHTML = pageData.map((l, idx) => `
            <tr>
              <td>${start + idx + 1}</td>
              <td>${l.jenis}</td>
              <td>${l.olehLabel}</td>
              <td>${tanggalIndo(l.tanggal)}</td>
              <td><span class="badge ${l.status === "Selesai" ? "badge-active" : "badge-warn"}"><span class="dot"></span>${l.status}</span></td>
              <td>
                <div class="row-actions">
                  <button class="row-btn-text" data-aksi="lihat" data-id="${l.id}">Lihat</button>
                  <button class="row-btn-text" data-aksi="unduh" data-id="${l.id}">Download</button>
                </div>
              </td>
            </tr>`).join("");
        }
        document.getElementById("paginationInfo").innerText =
          totalData === 0 ? "Showing 0 of 0" : `Showing ${start + 1}-${Math.min(start + PER_PAGE, totalData)} of ${totalData}`;
        renderPaginationBtns(totalPage);
        pasangEventAksi();
      }

      function renderPaginationBtns(totalPage) {
        const wrap = document.getElementById("paginationBtns");
        let html = `<button class="page-btn" id="pgPrev" aria-label="Sebelumnya"><span class="ic"><i data-lucide="chevron-left"></i></span></button>`;
        for (let p = 1; p <= totalPage; p++) html += `<button class="page-btn ${p === currentPage ? "active" : ""}" data-page="${p}">${p}</button>`;
        html += `<button class="page-btn" id="pgNext" aria-label="Berikutnya"><span class="ic"><i data-lucide="chevron-right"></i></span></button>`;
        wrap.innerHTML = html;
        lucide.createIcons();
        wrap.querySelectorAll("[data-page]").forEach((b) => b.addEventListener("click", () => { currentPage = Number(b.dataset.page); renderTabel(); }));
        document.getElementById("pgPrev").addEventListener("click", () => { if (currentPage > 1) { currentPage--; renderTabel(); } });
        document.getElementById("pgNext").addEventListener("click", () => { if (currentPage < totalPage) { currentPage++; renderTabel(); } });
      }

      function pasangEventAksi() {
        document.querySelectorAll('[data-aksi="lihat"]').forEach((b) => b.addEventListener("click", () => tampilkanToast("Membuka pratinjau laporan...")));
        document.querySelectorAll('[data-aksi="unduh"]').forEach((b) => b.addEventListener("click", () => tampilkanToast("Mengunduh laporan...")));
      }

      ["filterJenis", "filterTanggal"].forEach((id) => document.getElementById(id).addEventListener("change", () => { currentPage = 1; renderTabel(); }));
      document.getElementById("searchLaporan").addEventListener("keyup", () => { currentPage = 1; renderTabel(); });

      function geserTanggal(delta) {
        const input = document.getElementById("filterTanggal");
        const base = input.value ? new Date(input.value + "T00:00:00") : new Date();
        base.setDate(base.getDate() + delta);
        const yyyy = base.getFullYear();
        const mm = String(base.getMonth() + 1).padStart(2, "0");
        const dd = String(base.getDate()).padStart(2, "0");
        input.value = `${yyyy}-${mm}-${dd}`;
        currentPage = 1;
        renderTabel();
      }
      document.getElementById("btnTanggalPrev").addEventListener("click", () => geserTanggal(-1));
      document.getElementById("btnTanggalNext").addEventListener("click", () => geserTanggal(1));
      document.getElementById("btnExport").addEventListener("click", () => tampilkanToast("Menyiapkan file PDF seluruh laporan..."));

      renderTabel();

    
</script>
@endpush
