@extends('layouts.admin.main')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        corePlugins: { preflight: false } // jangan reset style global, biar tidak bentrok dengan CSS halaman lain
    }
</script>

<div class="flex items-center justify-between flex-wrap gap-3 mb-5">
    <div>
        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Monitoring</p>
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">Monitoring Laporan</h2>
    </div>
    <button id="btnExport" class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
        <i data-lucide="download" class="w-4 h-4"></i>
        Export PDF
    </button>
</div>

<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <div class="flex items-center gap-2.5 p-4 border-b border-slate-200 flex-wrap">
        <select id="filterJenis" class="text-sm font-semibold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 cursor-pointer focus:outline-none focus:border-teal-600">
            <option value="">Semua Jenis</option>
            <option value="Absensi">Absensi</option>
            <option value="Evaluasi">Evaluasi</option>
            <option value="Keaktifan">Keaktifan</option>
        </select>
        <div class="flex items-center gap-1 bg-slate-50 border border-slate-200 rounded-xl p-1">
            <button type="button" id="btnTanggalPrev" aria-label="Hari sebelumnya" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white text-slate-400 hover:bg-teal-50 hover:text-teal-600 transition">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
            </button>
            <input type="date" id="filterTanggal" class="text-sm font-semibold text-slate-800 bg-transparent border-none px-2 py-2 cursor-pointer focus:outline-none" />
            <button type="button" id="btnTanggalNext" aria-label="Hari berikutnya" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white text-slate-400 hover:bg-teal-50 hover:text-teal-600 transition">
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </button>
        </div>
        <div class="flex-1 min-w-[200px] flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5">
            <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
            <input type="text" id="searchLaporan" placeholder="Cari laporan..." class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">No</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Jenis</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Dibuat Oleh</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Tanggal</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Status</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody id="tabelLaporan"></tbody>
        </table>
    </div>
    <div class="flex items-center justify-between p-4 flex-wrap gap-3">
        <p id="paginationInfo" class="text-xs font-semibold text-slate-400 m-0">Showing 0 of 0</p>
        <div id="paginationBtns" class="flex items-center gap-1.5"></div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function () {

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
        const jenis = $("#filterJenis").val();
        const tanggal = $("#filterTanggal").val();
        const q = $("#searchLaporan").val().trim().toLowerCase();
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

    function badgeClass(status) {
        return status === "Selesai" ? "bg-teal-50 text-teal-600" : "bg-amber-100 text-amber-700";
    }

    function renderTabel() {
        const data = filteredData();
        const totalData = data.length;
        const totalPage = Math.max(1, Math.ceil(totalData / PER_PAGE));
        if (currentPage > totalPage) currentPage = totalPage;
        const start = (currentPage - 1) * PER_PAGE;
        const pageData = data.slice(start, start + PER_PAGE);

        let html;
        if (pageData.length === 0) {
            html = `<tr><td colspan="6" class="text-center py-6 text-slate-400 text-sm">Tidak ada laporan ditemukan.</td></tr>`;
        } else {
            html = pageData.map((l, idx) => `
                <tr class="hover:bg-slate-50">
                    <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${start + idx + 1}</td>
                    <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${l.jenis}</td>
                    <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${l.olehLabel}</td>
                    <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200 whitespace-nowrap">${tanggalIndo(l.tanggal)}</td>
                    <td class="px-3.5 py-3 border-b border-slate-200">
                        <span class="inline-flex items-center gap-1 text-[11px] font-extrabold px-2.5 py-1 rounded-full ${badgeClass(l.status)}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>${l.status}
                        </span>
                    </td>
                    <td class="px-3.5 py-3 border-b border-slate-200">
                        <div class="flex items-center gap-3">
                            <button data-aksi="lihat" data-id="${l.id}" class="text-teal-600 hover:text-teal-700 text-xs font-bold">Lihat</button>
                            <button data-aksi="unduh" data-id="${l.id}" class="text-teal-600 hover:text-teal-700 text-xs font-bold">Download</button>
                        </div>
                    </td>
                </tr>`).join("");
        }
        $("#tabelLaporan").html(html);
        $("#paginationInfo").text(
            totalData === 0 ? "Showing 0 of 0" : `Showing ${start + 1}-${Math.min(start + PER_PAGE, totalData)} of ${totalData}`
        );
        renderPaginationBtns(totalPage);
        pasangEventAksi();
    }

    function renderPaginationBtns(totalPage) {
        const btnBase = "w-8 h-8 flex items-center justify-center rounded-lg border text-sm font-semibold transition";
        let html = `<button id="pgPrev" aria-label="Sebelumnya" class="${btnBase} border-slate-200 text-slate-500 hover:bg-slate-50"><i data-lucide="chevron-left" class="w-4 h-4"></i></button>`;
        for (let p = 1; p <= totalPage; p++) {
            const active = p === currentPage ? "bg-teal-600 text-white border-teal-600" : "border-slate-200 text-slate-600 hover:bg-slate-50";
            html += `<button data-page="${p}" class="${btnBase} ${active}">${p}</button>`;
        }
        html += `<button id="pgNext" aria-label="Berikutnya" class="${btnBase} border-slate-200 text-slate-500 hover:bg-slate-50"><i data-lucide="chevron-right" class="w-4 h-4"></i></button>`;
        $("#paginationBtns").html(html);
        lucide.createIcons();
        $("[data-page]").on("click", function () { currentPage = Number($(this).data("page")); renderTabel(); });
        $("#pgPrev").on("click", () => { if (currentPage > 1) { currentPage--; renderTabel(); } });
        $("#pgNext").on("click", () => { if (currentPage < totalPage) { currentPage++; renderTabel(); } });
    }

    function pasangEventAksi() {
        $('[data-aksi="lihat"]').on("click", () => tampilkanToast("Membuka pratinjau laporan..."));
        $('[data-aksi="unduh"]').on("click", () => tampilkanToast("Mengunduh laporan..."));
    }

    $("#filterJenis, #filterTanggal").on("change", () => { currentPage = 1; renderTabel(); });
    $("#searchLaporan").on("keyup", () => { currentPage = 1; renderTabel(); });

    function geserTanggal(delta) {
        const input = $("#filterTanggal");
        const base = input.val() ? new Date(input.val() + "T00:00:00") : new Date();
        base.setDate(base.getDate() + delta);
        const yyyy = base.getFullYear();
        const mm = String(base.getMonth() + 1).padStart(2, "0");
        const dd = String(base.getDate()).padStart(2, "0");
        input.val(`${yyyy}-${mm}-${dd}`);
        currentPage = 1;
        renderTabel();
    }
    $("#btnTanggalPrev").on("click", () => geserTanggal(-1));
    $("#btnTanggalNext").on("click", () => geserTanggal(1));
    $("#btnExport").on("click", () => tampilkanToast("Menyiapkan file PDF seluruh laporan..."));

    renderTabel();
});
</script>
@endpush
