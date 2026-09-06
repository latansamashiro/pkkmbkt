@extends(request()->routeIs('committee.*') ? 'layouts.committee.main' : 'layouts.admin.main')
@php
    // Halaman ini dipakai bareng oleh Admin (route admin.data-master.sertifikat.*)
    // & Committee (route committee.sertifikat.*) -- base nama route diturunkan
    // otomatis dari nama route aktif, biar link AJAX-nya ikut menyesuaikan
    // tanpa perlu bikin file blade terpisah untuk tiap role.
    $sertBase = \Illuminate\Support\Str::before(request()->route()->getName(), '.index');
    $isCommittee = request()->routeIs('committee.*');
@endphp
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        corePlugins: { preflight: false } // jangan reset style global, biar tidak bentrok dengan CSS halaman lain
    }
</script>

<div class="flex items-center justify-between flex-wrap gap-3 mb-5">
    <div>
        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">
            {{ $isCommittee ? 'Kelola Data' : 'Administrasi' }}
        </p>
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">{{ $data['title'] }}</h2>
        <p class="text-xs text-slate-400 m-0 mt-1">
            Tempelkan link Google Drive sertifikat untuk tiap mahasiswa. Pastikan link sudah diatur "Anyone with the link" supaya mahasiswa bisa membukanya.
        </p>
    </div>
    @unless ($isCommittee)
        <a href="{{ route('admin.data-master.index') }}"
            class="inline-flex items-center gap-2 border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-sm px-4 py-2.5 rounded-xl transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>Kembali ke Data Master
        </a>
    @endunless
</div>

<!-- ===== KARTU STATISTIK ===== -->
<div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-5">
    <div class="bg-white border border-slate-200 rounded-2xl p-5">
        <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-navy-tint bg-indigo-50 text-indigo-600 mb-3">
            <i data-lucide="users" class="w-5 h-5"></i>
        </span>
        <p id="statTotal" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
        <p class="text-xs text-slate-400 m-0">Total Mahasiswa</p>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl p-5">
        <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-amber-50 text-amber-600 mb-3">
            <i data-lucide="award" class="w-5 h-5"></i>
        </span>
        <p id="statSudah" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
        <p class="text-xs text-slate-400 m-0">Sudah Ada Sertifikat</p>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl p-5">
        <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-slate-100 text-slate-500 mb-3">
            <i data-lucide="clock" class="w-5 h-5"></i>
        </span>
        <p id="statBelum" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
        <p class="text-xs text-slate-400 m-0">Belum Ada Sertifikat</p>
    </div>
</div>

<!-- ===== SEARCH ===== -->
<div class="flex items-center gap-3 flex-wrap mb-5">
    <div class="flex-1 min-w-[200px] flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-3.5 py-2.5">
        <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
        <input type="text" id="searchSertifikat" placeholder="Cari nama atau NPM mahasiswa..."
            class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
    </div>
    <select id="filterStatus"
        class="bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 cursor-pointer focus:outline-none">
        <option value="semua">Semua Status</option>
        <option value="sudah">Sudah Ada Sertifikat</option>
        <option value="belum">Belum Ada Sertifikat</option>
    </select>
</div>

<p id="listLoading" class="text-center text-sm text-slate-400 py-4 hidden">Memuat data...</p>

<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">No</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Nama</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">NPM</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Program Studi</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Status</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody id="tabelSertifikat"></tbody>
        </table>
    </div>
</div>

<!-- ===== MODAL TAMBAH / EDIT LINK SERTIFIKAT ===== -->
<div id="modalForm" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
        <div class="flex items-start justify-between gap-4 mb-1">
            <div>
                <h3 id="modalFormTitle" class="text-lg font-extrabold text-slate-800 m-0">Sertifikat Mahasiswa</h3>
                <p id="modalFormSubtitle" class="text-xs text-slate-400 m-0 mt-1">-</p>
            </div>
            <button id="btnCloseForm" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="formSertifikat" class="mt-4">
            <p id="formError"
                class="hidden text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg px-3 py-2 mb-3">
            </p>
            <label for="inputLinkGdrive" class="block text-xs font-bold text-slate-500 mb-1.5">Link Google Drive Sertifikat</label>
            <input type="url" id="inputLinkGdrive" placeholder="https://drive.google.com/file/d/..."
                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
            <p class="text-[11px] text-slate-400 mt-1.5">Kosongkan lalu Simpan untuk menghapus link sertifikat mahasiswa ini.</p>

            <div class="flex items-center justify-end gap-3 mt-6">
                <button type="button" id="btnBatalForm"
                    class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                <button type="submit" id="btnSimpanForm"
                    class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(function () {
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        const URL_BASE = "{{ route("{$sertBase}.items") }}".replace(/\/items$/, "");

        let allItems = [];
        let editingId = null;

        function muatSertifikat() {
            $("#listLoading").removeClass("hidden");
            $.get(`${URL_BASE}/items`, { q: $("#searchSertifikat").val().trim() })
                .done(function (res) {
                    allItems = res.data || [];
                    renderSemua();
                })
                .fail(function () {
                    allItems = [];
                    renderSemua();
                    tampilkanToast("Gagal memuat data mahasiswa.");
                })
                .always(function () {
                    $("#listLoading").addClass("hidden");
                });
        }

        function renderStats() {
            const sudah = allItems.filter((it) => !!it.certificate_link).length;
            $("#statTotal").text(allItems.length);
            $("#statSudah").text(sudah);
            $("#statBelum").text(allItems.length - sudah);
        }

        function itemsTersaring() {
            const fStatus = $("#filterStatus").val();
            return allItems.filter((it) => {
                if (fStatus === "sudah" && !it.certificate_link) return false;
                if (fStatus === "belum" && !!it.certificate_link) return false;
                return true;
            });
        }

        function renderSemua() {
            renderStats();
            const items = itemsTersaring();

            if (items.length === 0) {
                $("#tabelSertifikat").html(`<tr><td colspan="6" class="text-center py-6 text-slate-400 text-sm">Tidak ada data mahasiswa yang cocok.</td></tr>`);
                return;
            }

            const html = items.map((it, idx) => {
                const adaLink = !!it.certificate_link;
                const badge = adaLink
                    ? `<span class="text-[10px] font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2 py-1 rounded-md">Sudah Ada</span>`
                    : `<span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 bg-slate-100 px-2 py-1 rounded-md">Belum Ada</span>`;
                const tombolBuka = adaLink
                    ? `<a href="${it.certificate_link}" target="_blank" rel="noopener" aria-label="Buka Link" class="w-8 h-8 flex items-center justify-center rounded-lg text-teal-600 hover:bg-teal-50"><i data-lucide="external-link" class="w-4 h-4"></i></a>`
                    : "";
                const tombolHapus = adaLink
                    ? `<button data-aksi="hapus" data-id="${it.id}" aria-label="Hapus Link" class="w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-4 h-4"></i></button>`
                    : "";

                return `
                    <tr class="hover:bg-slate-50">
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${idx + 1}</td>
                        <td class="px-3.5 py-3 text-sm font-semibold text-slate-800 border-b border-slate-200">${it.name ?? "-"}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${it.npm ?? "-"}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${it.program_study_name ?? "-"}</td>
                        <td class="px-3.5 py-3 border-b border-slate-200">${badge}</td>
                        <td class="px-3.5 py-3 border-b border-slate-200">
                            <div class="flex items-center gap-1">
                                <button data-aksi="edit" data-id="${it.id}" aria-label="${adaLink ? "Edit Link" : "Tambah Link"}" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="${adaLink ? "pencil" : "plus"}" class="w-4 h-4"></i></button>
                                ${tombolBuka}
                                ${tombolHapus}
                            </div>
                        </td>
                    </tr>`;
            }).join("");

            $("#tabelSertifikat").html(html);
            lucide.createIcons();
            pasangAksiTombol();
        }

        function pasangAksiTombol() {
            $('[data-aksi="edit"]').off("click").on("click", function () { bukaForm(Number($(this).data("id"))); });
            $('[data-aksi="hapus"]').off("click").on("click", function () { hapusLink(Number($(this).data("id"))); });
        }

        $("#searchSertifikat").on("keyup", function () {
            clearTimeout(window.__sertSearchTimer);
            window.__sertSearchTimer = setTimeout(muatSertifikat, 300);
        });
        $("#filterStatus").on("change", renderSemua);

        // ===== Modal form (1 field saja: link Google Drive) =====
        const $modalForm = $("#modalForm");
        const $formError = $("#formError");

        function bukaForm(id) {
            editingId = id;
            $formError.addClass("hidden");
            const item = allItems.find((x) => x.id === id);
            if (!item) return;

            $("#modalFormTitle").text(item.certificate_link ? "Edit Link Sertifikat" : "Tambah Link Sertifikat");
            $("#modalFormSubtitle").text(`${item.name ?? "-"} ${item.npm ? "— " + item.npm : ""}`);
            $("#inputLinkGdrive").val(item.certificate_link ?? "");
            $modalForm.removeClass("hidden").addClass("flex");
        }
        function tutupForm() { $modalForm.addClass("hidden").removeClass("flex"); editingId = null; }

        $("#btnCloseForm").on("click", tutupForm);
        $("#btnBatalForm").on("click", tutupForm);
        $modalForm.on("click", function (e) { if (e.target === this) tutupForm(); });

        $("#formSertifikat").on("submit", function (e) {
            e.preventDefault();
            $formError.addClass("hidden");
            if (!editingId) return;

            const payload = { certificate_link: ($("#inputLinkGdrive").val() || "").trim() };
            const $btnSimpan = $("#btnSimpanForm");
            $btnSimpan.prop("disabled", true);

            $.ajax({
                url: `${URL_BASE}/${editingId}`,
                method: "PUT",
                contentType: "application/json",
                headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                data: JSON.stringify(payload),
            }).done(function (result) {
                const idx = allItems.findIndex((x) => x.id === editingId);
                if (idx > -1) allItems[idx] = { ...allItems[idx], ...result.data };
                tampilkanToast(result.message);
                tutupForm();
                renderSemua();
            }).fail(function (xhr) {
                const result = xhr.responseJSON || {};
                if (result.errors) {
                    $formError.text(Object.values(result.errors).flat().join(" "));
                } else {
                    $formError.text(result.message || "Terjadi kesalahan, silakan coba lagi.");
                }
                $formError.removeClass("hidden");
            }).always(function () {
                $btnSimpan.prop("disabled", false);
            });
        });

        function hapusLink(id) {
            const it = allItems.find((x) => x.id === id);
            if (!it) return;
            if (!confirm(`Hapus link sertifikat "${it.name}"?`)) return;

            $.ajax({
                url: `${URL_BASE}/${id}`,
                method: "DELETE",
                headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
            }).done(function (result) {
                const idx = allItems.findIndex((x) => x.id === id);
                if (idx > -1) allItems[idx].certificate_link = null;
                tampilkanToast(result.message);
                renderSemua();
            }).fail(function (xhr) {
                const result = xhr.responseJSON || {};
                tampilkanToast(result.message || "Gagal menghapus link sertifikat.");
            });
        }

        muatSertifikat();
    });
</script>
@endpush
