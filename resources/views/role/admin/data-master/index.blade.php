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
        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Administrasi</p>
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">Kelola Data Master</h2>
    </div>
</div>

<div id="masterGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"></div>

<!-- ===== MODAL DAFTAR DATA MASTER PER KATEGORI ===== -->
<div id="modalList" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[85vh] overflow-y-auto p-6">
        <div class="flex items-start justify-between gap-4 mb-5">
            <div>
                <h3 id="modalListTitle" class="text-lg font-extrabold text-slate-800 m-0">Data Fakultas</h3>
                <p class="text-xs text-slate-400 m-0 mt-1">Kelola isi data master untuk kategori ini.</p>
            </div>
            <button id="btnCloseList" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <div class="flex items-center gap-3 mb-4 flex-wrap">
            <div class="flex-1 min-w-[200px] flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
                <input type="text" id="searchItem" placeholder="Cari data..." class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
            </div>
            <button id="btnTambahItem" class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
                <i data-lucide="plus" class="w-4 h-4"></i>Tambah
            </button>
        </div>

        <div class="border border-slate-200 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100">No</th>
                            <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100">Nama</th>
                            <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelItem"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ===== MODAL TAMBAH / EDIT ITEM ===== -->
<div id="modalForm" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl w-full max-w-md p-6">
        <div class="flex items-start justify-between gap-4 mb-5">
            <h3 id="modalFormTitle" class="text-lg font-extrabold text-slate-800 m-0">Tambah Data</h3>
            <button id="btnCloseForm" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="formItem">
            <div>
                <label for="inputNamaItem" id="labelNamaItem" class="block text-xs font-bold text-slate-500 mb-1.5">Nama</label>
                <input type="text" id="inputNamaItem" required
                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
            </div>
            <div class="flex items-center justify-end gap-3 mt-6">
                <button type="button" id="btnBatalForm" class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function () {

    // ===== DUMMY DATA (ganti dengan hasil fetch() API saat backend siap) =====
    const KATEGORI = [
        { key: "fakultas", icon: "landmark", chip: "bg-indigo-50 text-indigo-600", label: "Data Fakultas", items: ["Fakultas Teknik", "Fakultas Ekonomi", "Fakultas Hukum", "Fakultas Pertanian"] },
        { key: "prodi", icon: "graduation-cap", chip: "bg-teal-50 text-teal-600", label: "Data Program Studi", items: ["Teknik Informatika", "Manajemen", "Akuntansi", "Ilmu Hukum", "Agroteknologi"] },
        { key: "tahun", icon: "calendar-range", chip: "bg-lime-50 text-lime-600", label: "Data Tahun PKKMB", items: ["PKKMB 2024", "PKKMB 2025", "PKKMB 2026"] },
        { key: "kelompok", icon: "users-round", chip: "bg-rose-50 text-rose-500", label: "Data Kelompok", items: ["Kelompok 01", "Kelompok 02", "Kelompok 03", "Kelompok 04"] },
        { key: "ruangan", icon: "door-open", chip: "bg-indigo-50 text-indigo-600", label: "Data Ruangan", items: ["Hall Utama", "Aula Fakultas Teknik", "Ruang Serbaguna A"] },
        { key: "jadwal", icon: "calendar-days", chip: "bg-teal-50 text-teal-600", label: "Data Jadwal", items: ["Hari 1 - Pembukaan", "Hari 2 - Materi Wajib", "Hari 3 - Penutupan"] },
    ];

    let activeKategori = null;

    function renderGrid() {
        const html = KATEGORI.map((k) => `
            <div data-key="${k.key}" class="master-card bg-white border border-slate-200 rounded-2xl p-5 cursor-pointer hover:shadow-md hover:border-teal-300 transition">
                <div class="flex items-center justify-between mb-4">
                    <span class="w-11 h-11 rounded-xl flex items-center justify-center ${k.chip}">
                        <i data-lucide="${k.icon}" class="w-5 h-5"></i>
                    </span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                </div>
                <p class="text-sm font-bold text-slate-800 m-0">${k.label}</p>
                <p class="text-2xl font-extrabold text-slate-800 m-0 mt-1">${k.items.length}</p>
                <p class="text-xs text-slate-400 m-0">data tersimpan</p>
            </div>`).join("");
        $("#masterGrid").html(html);
        lucide.createIcons();
        $(".master-card").on("click", function () { bukaList($(this).data("key")); });
    }

    const $modalList = $("#modalList");
    const $modalForm = $("#modalForm");

    function bukaList(key) {
        activeKategori = KATEGORI.find((k) => k.key === key);
        $("#modalListTitle").text(activeKategori.label);
        $("#searchItem").val("");
        $("#labelNamaItem").text("Nama " + activeKategori.label.replace("Data ", ""));
        renderItemTabel();
        $modalList.removeClass("hidden").addClass("flex");
    }
    $("#btnCloseList").on("click", () => $modalList.addClass("hidden").removeClass("flex"));
    $modalList.on("click", function (e) { if (e.target === this) $modalList.addClass("hidden").removeClass("flex"); });
    $("#searchItem").on("keyup", renderItemTabel);

    function renderItemTabel() {
        const q = $("#searchItem").val().trim().toLowerCase();
        const items = activeKategori.items.filter((it) => !q || it.toLowerCase().includes(q));
        let html;
        if (items.length === 0) {
            html = `<tr><td colspan="3" class="text-center py-5 text-slate-400 text-sm">Tidak ada data.</td></tr>`;
        } else {
            html = items.map((it, idx) => {
                const realIdx = activeKategori.items.indexOf(it);
                return `
                <tr class="hover:bg-slate-50">
                    <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${idx + 1}</td>
                    <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${it}</td>
                    <td class="px-3.5 py-3 border-b border-slate-200">
                        <div class="flex items-center gap-2">
                            <button data-aksi="edit" data-idx="${realIdx}" aria-label="Edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                            <button data-aksi="hapus" data-idx="${realIdx}" aria-label="Hapus" class="w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </div>
                    </td>
                </tr>`;
            }).join("");
        }
        $("#tabelItem").html(html);
        lucide.createIcons();
        $('[data-aksi="edit"]').on("click", function () { bukaForm(Number($(this).data("idx"))); });
        $('[data-aksi="hapus"]').on("click", function () { hapusItem(Number($(this).data("idx"))); });
    }

    let editingIdx = null;
    function bukaForm(idx) {
        editingIdx = idx === undefined ? null : idx;
        $("#modalFormTitle").text(editingIdx === null ? "Tambah Data" : "Edit Data");
        $("#inputNamaItem").val(editingIdx === null ? "" : activeKategori.items[editingIdx]);
        $modalForm.removeClass("hidden").addClass("flex");
    }
    function tutupForm() { $modalForm.addClass("hidden").removeClass("flex"); editingIdx = null; $("#formItem")[0].reset(); }
    $("#btnTambahItem").on("click", () => bukaForm(null));
    $("#btnCloseForm").on("click", tutupForm);
    $("#btnBatalForm").on("click", tutupForm);
    $modalForm.on("click", function (e) { if (e.target === this) tutupForm(); });

    $("#formItem").on("submit", function (e) {
        e.preventDefault();
        const nilai = $("#inputNamaItem").val().trim();
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
});
</script>
@endpush
