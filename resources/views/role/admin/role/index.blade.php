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
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">Kelola Role &amp; Hak Akses</h2>
    </div>
    <button id="btnTambahRole" class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
        <i data-lucide="plus" class="w-4 h-4"></i>Tambah Role
    </button>
</div>

<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <div class="flex items-center gap-2.5 p-4 border-b border-slate-200 flex-wrap">
        <div class="flex-1 min-w-[200px] flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5">
            <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
            <input type="text" id="searchRole" placeholder="Cari role..." class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Role</th>
                    <th class="text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Dashboard</th>
                    <th class="text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Pengguna</th>
                    <th class="text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Data Master</th>
                    <th class="text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Laporan</th>
                    <th class="text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Pengaturan</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody id="tabelRole"></tbody>
        </table>
    </div>
</div>

<!-- ===== MODAL TAMBAH / EDIT ROLE ===== -->
<div id="modalForm" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
        <div class="flex items-start justify-between gap-4 mb-1">
            <div>
                <h3 id="modalFormTitle" class="text-lg font-extrabold text-slate-800 m-0">Tambah Role</h3>
                <p class="text-xs text-slate-400 m-0 mt-1">Atur nama role dan hak akses tiap modul.</p>
            </div>
            <button id="btnCloseForm" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="formRole" class="mt-4">
            <div class="mb-4">
                <label for="inputNamaRole" class="block text-xs font-bold text-slate-500 mb-1.5">Nama Role</label>
                <input type="text" id="inputNamaRole" placeholder="Contoh: Koordinator Fakultas" required
                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
            </div>
            <label class="block text-xs font-bold text-slate-500 mb-2">Hak Akses Modul</label>
            <div id="permissionList" class="flex flex-col gap-2 mb-2"></div>
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
            ? `<i data-lucide="check-circle-2" class="w-[18px] h-[18px] mx-auto text-teal-600"></i>`
            : `<i data-lucide="x-circle" class="w-[18px] h-[18px] mx-auto text-slate-300"></i>`;
    }

    function renderTabel() {
        const q = $("#searchRole").val().trim().toLowerCase();
        const data = roleList.filter((r) => !q || r.nama.toLowerCase().includes(q));

        if (data.length === 0) {
            $("#tabelRole").html(`<tr><td colspan="7" class="text-center py-6 text-slate-400 text-sm">Role tidak ditemukan.</td></tr>`);
            lucide.createIcons();
            return;
        }

        const html = data.map((r) => `
            <tr class="hover:bg-slate-50">
                <td class="px-3.5 py-3 border-b border-slate-200"><span class="inline-block text-[11px] font-bold px-2.5 py-1 rounded-full bg-slate-100 text-slate-600">${r.nama}</span></td>
                <td class="px-3.5 py-3 text-center border-b border-slate-200">${iconAkses(r.akses.dashboard)}</td>
                <td class="px-3.5 py-3 text-center border-b border-slate-200">${iconAkses(r.akses.pengguna)}</td>
                <td class="px-3.5 py-3 text-center border-b border-slate-200">${iconAkses(r.akses.dataMaster)}</td>
                <td class="px-3.5 py-3 text-center border-b border-slate-200">${iconAkses(r.akses.laporan)}</td>
                <td class="px-3.5 py-3 text-center border-b border-slate-200">${iconAkses(r.akses.pengaturan)}</td>
                <td class="px-3.5 py-3 border-b border-slate-200">
                    <div class="flex items-center gap-1">
                        <button data-aksi="edit" data-id="${r.id}" aria-label="Edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                        <button data-aksi="hapus" data-id="${r.id}" aria-label="Hapus" class="w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                    </div>
                </td>
            </tr>`).join("");
        $("#tabelRole").html(html);
        lucide.createIcons();
        $('[data-aksi="edit"]').on("click", function () { bukaForm(Number($(this).data("id"))); });
        $('[data-aksi="hapus"]').on("click", function () { hapusRole(Number($(this).data("id"))); });
    }

    $("#searchRole").on("keyup", renderTabel);

    const $modalForm = $("#modalForm");
    function renderPermissionList(akses) {
        const html = MODUL_LIST.map((m) => `
            <label class="flex items-center justify-between gap-3 cursor-pointer border border-slate-200 rounded-xl px-3.5 py-2.5">
                <span class="text-sm text-slate-700">${m.label}</span>
                <span class="relative inline-flex items-center">
                    <input type="checkbox" data-modul="${m.key}" ${akses[m.key] ? "checked" : ""} class="sr-only peer" />
                    <span class="w-[40px] h-[22px] bg-slate-200 rounded-full peer-checked:bg-teal-600 transition-colors block"></span>
                    <span class="absolute left-[3px] top-[3px] w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-[18px]"></span>
                </span>
            </label>`).join("");
        $("#permissionList").html(html);
    }

    function bukaForm(id) {
        editingId = id || null;
        const data = id ? roleList.find((r) => r.id === id) : null;
        $("#modalFormTitle").text(id ? "Edit Role" : "Tambah Role");
        $("#inputNamaRole").val(data ? data.nama : "");
        renderPermissionList(data ? data.akses : { dashboard: true, pengguna: false, dataMaster: false, laporan: false, pengaturan: false });
        $modalForm.removeClass("hidden").addClass("flex");
    }
    function tutupForm() { $modalForm.addClass("hidden").removeClass("flex"); editingId = null; $("#formRole")[0].reset(); }

    $("#btnTambahRole").on("click", () => bukaForm(null));
    $("#btnCloseForm").on("click", tutupForm);
    $("#btnBatalForm").on("click", tutupForm);
    $modalForm.on("click", function (e) { if (e.target === this) tutupForm(); });

    $("#formRole").on("submit", function (e) {
        e.preventDefault();
        const akses = {};
        $("#permissionList input[data-modul]").each(function () { akses[$(this).data("modul")] = this.checked; });
        const payload = { nama: $("#inputNamaRole").val().trim(), akses };
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
});
</script>
@endpush
