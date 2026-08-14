@extends('layouts.committee.main')
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { corePlugins: { preflight: false } }
    </script>

    @php
        // Route ini di-load lewat DataMasterController::index() dengan onlyTypes=['tugas'],
        // jadi $categories cuma berisi 1 entri konfigurasi untuk 'tugas'.
        $kategoriTugas = $categories[0] ?? null;
    @endphp

    <div class="flex items-center justify-between flex-wrap gap-3 mb-1">
        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Kelola Data</p>
    </div>
    <div class="flex items-start justify-between flex-wrap gap-3 mb-6">
        <div class="flex items-start gap-3">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-amber-50 text-amber-600 shrink-0">
                <i data-lucide="clipboard-check" class="w-5 h-5"></i>
            </span>
            <div>
                <h2 class="text-2xl font-extrabold text-slate-800 m-0">Kelola Tugas PKKMB</h2>
                <p class="text-sm text-slate-400 m-0 mt-0.5">Kelola seluruh tugas individu dan kelompok yang akan diberikan kepada mahasiswa baru.</p>
            </div>
        </div>
        <button id="btnTambahTugas"
            class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-5 py-3 rounded-xl transition shrink-0">
            <i data-lucide="plus" class="w-4 h-4"></i>Tambah Tugas
        </button>
    </div>

    <!-- STAT CARDS -->
    <div class="grid grid-cols-2 lg:grid-cols-6 gap-4 mb-5">
        <div class="bg-white border border-slate-200 rounded-2xl p-5 flex items-center gap-4">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-indigo-50 text-indigo-600 shrink-0">
                <i data-lucide="clipboard-list" class="w-5 h-5"></i>
            </span>
            <div>
                <p id="statTotal" class="text-2xl font-extrabold text-slate-800 m-0 leading-none">0</p>
                <p class="text-xs text-slate-400 m-0 mt-1">Total Tugas</p>
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 flex items-center gap-4">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-teal-50 text-teal-600 shrink-0">
                <i data-lucide="user" class="w-5 h-5"></i>
            </span>
            <div>
                <p id="statIndividu" class="text-2xl font-extrabold text-slate-800 m-0 leading-none">0</p>
                <p class="text-xs text-slate-400 m-0 mt-1">Tugas Individu</p>
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 flex items-center gap-4">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-lime-50 text-lime-600 shrink-0">
                <i data-lucide="users" class="w-5 h-5"></i>
            </span>
            <div>
                <p id="statKelompok" class="text-2xl font-extrabold text-slate-800 m-0 leading-none">0</p>
                <p class="text-xs text-slate-400 m-0 mt-1">Tugas Kelompok</p>
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 flex items-center gap-4">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-amber-50 text-amber-600 shrink-0">
                <i data-lucide="backpack" class="w-5 h-5"></i>
            </span>
            <div>
                <p id="statAtk" class="text-2xl font-extrabold text-slate-800 m-0 leading-none">0</p>
                <p class="text-xs text-slate-400 m-0 mt-1">Penerimaan ATK</p>
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 flex items-center gap-4">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-purple-50 text-purple-600 shrink-0">
                <i data-lucide="shirt" class="w-5 h-5"></i>
            </span>
            <div>
                <p id="statJasAlmet" class="text-2xl font-extrabold text-slate-800 m-0 leading-none">0</p>
                <p class="text-xs text-slate-400 m-0 mt-1">Penerimaan JAS ALMET</p>
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 flex items-center gap-4">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-rose-50 text-rose-500 shrink-0">
                <i data-lucide="check-circle-2" class="w-5 h-5"></i>
            </span>
            <div>
                <p id="statAktif" class="text-2xl font-extrabold text-slate-800 m-0 leading-none">0</p>
                <p class="text-xs text-slate-400 m-0 mt-1">Tugas Aktif</p>
            </div>
        </div>
    </div>

    <!-- FILTER BAR -->
    <div class="bg-white border border-slate-200 rounded-2xl p-4 mb-4 flex items-center gap-3 flex-wrap">
        <div class="flex-1 min-w-[200px] flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5">
            <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
            <input type="text" id="searchTugas" placeholder="Cari nama tugas..."
                class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
        </div>
        <select id="filterJenis"
            class="border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 cursor-pointer focus:outline-none focus:border-teal-600">
            <option value="">Semua Jenis</option>
            <option value="individu">Individu</option>
            <option value="kelompok">Kelompok</option>
            <option value="atk">Penerimaan ATK</option>
            <option value="jas_almet">Penerimaan JAS ALMET</option>
        </select>
        <select id="filterStatus"
            class="border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 cursor-pointer focus:outline-none focus:border-teal-600">
            <option value="">Semua Status</option>
            <option value="aktif">Aktif</option>
            <option value="draft">Draft</option>
            <option value="ditutup">Ditutup</option>
        </select>
        <button id="btnRefresh"
            class="inline-flex items-center gap-2 border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-sm px-4 py-2.5 rounded-xl transition">
            <i data-lucide="refresh-cw" class="w-4 h-4"></i>Refresh
        </button>
    </div>

    <!-- TABLE -->
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
        <p id="listLoading" class="text-center text-sm text-slate-400 py-6 hidden">Memuat data...</p>
        <div id="tableWrap" class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-4 py-3 bg-slate-50 whitespace-nowrap">No</th>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-4 py-3 bg-slate-50 whitespace-nowrap">Nama Tugas</th>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-4 py-3 bg-slate-50 whitespace-nowrap">Jenis</th>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-4 py-3 bg-slate-50 whitespace-nowrap">Deadline</th>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-4 py-3 bg-slate-50 whitespace-nowrap">Status</th>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-4 py-3 bg-slate-50 whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelTugas"></tbody>
            </table>
        </div>
    </div>

    <!-- MODAL TAMBAH / EDIT TUGAS -->
    <div id="modalForm" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <h3 id="modalFormTitle" class="text-lg font-extrabold text-slate-800 m-0">Tambah Tugas</h3>
                <button id="btnCloseForm" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form id="formItem">
                <p id="formError" class="hidden text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg px-3 py-2 mb-3"></p>
                <div id="formFields" class="grid grid-cols-1 gap-4"></div>
                <div class="flex items-center justify-end gap-3 mt-6">
                    <button type="button" id="btnBatalForm"
                        class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                    <button type="submit" id="btnSimpanForm"
                        class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL ASSIGN (CHECKLIST) -->
    <div id="modalAssign" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-lg max-h-[85vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                    <h3 id="modalAssignTitle" class="text-lg font-extrabold text-slate-800 m-0">Assign Tugas</h3>
                    <p id="modalAssignSub" class="text-xs text-slate-400 m-0 mt-1"></p>
                </div>
                <button id="btnCloseAssign" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="flex items-center gap-2 mb-3">
                <input type="text" id="searchAssign" placeholder="Cari nama/kelompok..."
                    class="flex-1 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:border-teal-600" />
                <button type="button" id="btnCentangSemua"
                    class="text-xs font-bold text-teal-700 hover:underline whitespace-nowrap px-2">Centang Semua</button>
            </div>

            <p id="assignLoading" class="text-center text-sm text-slate-400 py-4 hidden">Memuat...</p>
            <div id="assignList" class="border border-slate-200 rounded-xl divide-y divide-slate-100 max-h-96 overflow-y-auto"></div>

            <div class="flex items-center justify-end gap-3 mt-5">
                <button type="button" id="btnBatalAssign"
                    class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                <button type="button" id="btnSimpanAssign"
                    class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">Simpan Penugasan</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(function () {
            const KATEGORI = @json($kategoriTugas); // config field 'tugas' (fields, label, dst.)
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            const URL_BASE = "{{ url('panitia/tugas') }}"; // + /tugas/items | /tugas | /tugas/{id}
            const URL_ASSIGN_BASE = "{{ url('panitia/tugas') }}"; // + /{taskId}/assign
            const TYPE_KEY = "tugas";

            let allItems = [];
            let editingId = null;
            let assignTaskId = null;
            let assignItems = [];

            const BULAN = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
            function formatTanggal(ymd) {
                if (!ymd) return "-";
                const [y, m, d] = ymd.split("-").map(Number);
                if (!y || !m || !d) return ymd;
                return `${d} ${BULAN[m - 1]} ${y}`;
            }

            const JENIS_BADGE = {
                individu: "bg-teal-50 text-teal-700",
                kelompok: "bg-lime-50 text-lime-700",
                atk: "bg-amber-50 text-amber-700",
                jas_almet: "bg-purple-50 text-purple-700",
            };
            const STATUS_BADGE = {
                aktif: "bg-teal-50 text-teal-700",
                draft: "bg-amber-50 text-amber-700",
                ditutup: "bg-slate-100 text-slate-500",
            };
            const JENIS_LABEL = { individu: "Individu", kelompok: "Kelompok", atk: "Penerimaan ATK", jas_almet: "Penerimaan JAS ALMET" };
            const STATUS_LABEL = { aktif: "Aktif", draft: "Draft", ditutup: "Ditutup" };

            function badge(map, key, label) {
                const cls = map[key] || "bg-slate-100 text-slate-500";
                return `<span class="inline-block text-xs font-bold px-2.5 py-1 rounded-full ${cls}">${label}</span>`;
            }

            function forceUpper(el) {
                const s = el.selectionStart, e = el.selectionEnd;
                el.value = el.value.toUpperCase();
                el.setSelectionRange(s, e);
            }
            $(document).on("input", ".js-upper", function () { forceUpper(this); });

            // ===== Muat data & statistik =====
            function muatTugas() {
                $("#listLoading").removeClass("hidden");
                $("#tableWrap").addClass("hidden");
                $.get(`${URL_BASE}/${TYPE_KEY}/items`)
                    .done(function (res) {
                        allItems = res.data || [];
                        renderStats();
                        renderTabel();
                    })
                    .fail(function () {
                        allItems = [];
                        renderStats();
                        renderTabel();
                        tampilkanToast("Gagal memuat data tugas.");
                    })
                    .always(function () {
                        $("#listLoading").addClass("hidden");
                        $("#tableWrap").removeClass("hidden");
                    });
            }

            function renderStats() {
                $("#statTotal").text(allItems.length);
                $("#statIndividu").text(allItems.filter((x) => x.task_type === "individu").length);
                $("#statKelompok").text(allItems.filter((x) => x.task_type === "kelompok").length);
                $("#statAtk").text(allItems.filter((x) => x.task_type === "atk").length);
                $("#statJasAlmet").text(allItems.filter((x) => x.task_type === "jas_almet").length);
                $("#statAktif").text(allItems.filter((x) => x.status === "aktif").length);
            }

            function renderTabel() {
                const q = $("#searchTugas").val().trim().toLowerCase();
                const jenis = $("#filterJenis").val();
                const status = $("#filterStatus").val();

                const items = allItems.filter((it) => {
                    if (q && !String(it.title ?? "").toLowerCase().includes(q)) return false;
                    if (jenis && it.task_type !== jenis) return false;
                    if (status && it.status !== status) return false;
                    return true;
                });

                let html;
                if (items.length === 0) {
                    html = `<tr><td colspan="6" class="text-center py-8 text-slate-400 text-sm">Tidak ada data.</td></tr>`;
                } else {
                    html = items.map((it, idx) => `
                        <tr class="hover:bg-slate-50 border-t border-slate-100">
                            <td class="px-4 py-3.5 text-sm text-teal-700 font-bold align-top">${idx + 1}</td>
                            <td class="px-4 py-3.5 align-top">
                                <p class="text-sm font-bold text-slate-800 m-0">${it.title ?? "-"}</p>
                                ${it.description ? `<p class="text-xs text-slate-400 m-0 mt-0.5">${it.description}</p>` : ""}
                            </td>
                            <td class="px-4 py-3.5 align-top">${badge(JENIS_BADGE, it.task_type, JENIS_LABEL[it.task_type] ?? it.task_type ?? "-")}</td>
                            <td class="px-4 py-3.5 text-sm text-slate-700 align-top whitespace-nowrap">${formatTanggal(it.deadline)}</td>
                            <td class="px-4 py-3.5 align-top">${badge(STATUS_BADGE, it.status, STATUS_LABEL[it.status] ?? it.status ?? "-")}</td>
                            <td class="px-4 py-3.5 align-top">
                                <div class="flex items-center gap-1.5">
                                    <button data-aksi="assign" data-id="${it.id}" title="Kelola Penugasan" aria-label="Kelola Penugasan" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="eye" class="w-4 h-4"></i></button>
                                    <button data-aksi="edit" data-id="${it.id}" title="Edit" aria-label="Edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                    <button data-aksi="hapus" data-id="${it.id}" title="Hapus" aria-label="Hapus" class="w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                </div>
                            </td>
                        </tr>`).join("");
                }
                $("#tabelTugas").html(html);
                lucide.createIcons();
                $('[data-aksi="edit"]').on("click", function () { bukaForm(Number($(this).data("id"))); });
                $('[data-aksi="hapus"]').on("click", function () { hapusItem(Number($(this).data("id"))); });
                $('[data-aksi="assign"]').on("click", function () { bukaAssign(Number($(this).data("id"))); });
            }

            $("#searchTugas").on("keyup", renderTabel);
            $("#filterJenis, #filterStatus").on("change", renderTabel);
            $("#btnRefresh").on("click", muatTugas);

            // ===== Modal form tambah/edit =====
            function inputHtml(f, value) {
                const id = `field_${f.key}`;
                const req = f.required ? "required" : "";
                const val = value ?? "";
                if (f.type === "textarea") {
                    return `<textarea id="${id}" ${req} rows="3"
                             class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600 js-upper">${val}</textarea>`;
                }
                if (f.type === "select") {
                    const opts = Object.entries(f.options || {}).map(([ov, ol]) =>
                        `<option value="${ov}" ${String(val) === String(ov) ? "selected" : ""}>${ol}</option>`
                    ).join("");
                    return `<select id="${id}" ${req}
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                                <option value="">Pilih ${f.label}</option>${opts}
                            </select>`;
                }
                const upperCls = f.type === "text" ? " js-upper" : "";
                return `<input type="${f.type}" id="${id}" value="${val}" ${req}
                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600${upperCls}" />`;
            }

            function buildFormFields(data) {
                const html = KATEGORI.fields.map((f) => `
                    <div>
                        <label for="field_${f.key}" class="block text-xs font-bold text-slate-500 mb-1.5">${f.label}</label>
                        ${inputHtml(f, data ? data[f.key] : "")}
                    </div>`).join("");
                $("#formFields").html(html);
            }

            function collectFormValues() {
                const payload = {};
                KATEGORI.fields.forEach((f) => {
                    const $el = $(`#field_${f.key}`);
                    payload[f.key] = (f.type === "text" || f.type === "textarea") ? ($el.val() || "").toUpperCase() : $el.val();
                });
                return payload;
            }

            function bukaForm(id) {
                editingId = id || null;
                $("#formError").addClass("hidden");
                const data = id ? allItems.find((x) => x.id === id) : null;
                $("#modalFormTitle").text(id ? "Edit Tugas" : "Tambah Tugas");
                buildFormFields(data);
                $("#modalForm").removeClass("hidden").addClass("flex");
            }
            function tutupForm() { $("#modalForm").addClass("hidden").removeClass("flex"); editingId = null; }

            $("#btnTambahTugas").on("click", () => bukaForm(null));
            $("#btnCloseForm").on("click", tutupForm);
            $("#btnBatalForm").on("click", tutupForm);
            $("#modalForm").on("click", function (e) { if (e.target === this) tutupForm(); });

            $("#formItem").on("submit", function (e) {
                e.preventDefault();
                $("#formError").addClass("hidden");
                const payload = collectFormValues();
                const $btnSimpan = $("#btnSimpanForm");
                $btnSimpan.prop("disabled", true);

                const url = editingId ? `${URL_BASE}/${TYPE_KEY}/${editingId}` : `${URL_BASE}/${TYPE_KEY}`;
                const method = editingId ? "PUT" : "POST";

                $.ajax({
                    url, method,
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: JSON.stringify(payload),
                }).done(function (result) {
                    if (editingId) {
                        const idx = allItems.findIndex((x) => x.id === editingId);
                        if (idx > -1) allItems[idx] = result.data;
                    } else {
                        allItems.push(result.data);
                    }
                    tampilkanToast(result.message);
                    tutupForm();
                    renderStats();
                    renderTabel();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    $("#formError").text(result.errors ? Object.values(result.errors).flat().join(" ") : (result.message || "Terjadi kesalahan.")).removeClass("hidden");
                }).always(function () { $btnSimpan.prop("disabled", false); });
            });

            function hapusItem(id) {
                const it = allItems.find((x) => x.id === id);
                if (!it) return;
                if (!confirm(`Hapus tugas "${it.title}"? Penugasan yang terkait juga akan hilang.`)) return;

                $.ajax({
                    url: `${URL_BASE}/${TYPE_KEY}/${id}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    allItems = allItems.filter((x) => x.id !== id);
                    tampilkanToast(result.message);
                    renderStats();
                    renderTabel();
                }).fail(function (xhr) {
                    tampilkanToast((xhr.responseJSON || {}).message || "Gagal menghapus data.");
                });
            }

            // ===== Modal assign (checklist mahasiswa/kelompok) =====
            function bukaAssign(taskId) {
                assignTaskId = taskId;
                $("#searchAssign").val("");
                $("#assignList").empty();
                $("#assignLoading").removeClass("hidden");
                $("#modalAssign").removeClass("hidden").addClass("flex");

                $.get(`${URL_ASSIGN_BASE}/${taskId}/assign`)
                    .done(function (res) {
                        assignItems = res.items || [];
                        $("#modalAssignTitle").text(`Assign: ${res.task.title}`);
                        $("#modalAssignSub").text(res.task.task_type === "kelompok" ? "Pilih kelompok yang mendapat tugas ini." : "Pilih mahasiswa yang mendapat tugas ini.");
                        renderAssignList();
                    })
                    .fail(function () { tampilkanToast("Gagal memuat daftar assign."); $("#modalAssign").addClass("hidden").removeClass("flex"); })
                    .always(function () { $("#assignLoading").addClass("hidden"); });
            }
            $("#btnCloseAssign, #btnBatalAssign").on("click", () => $("#modalAssign").addClass("hidden").removeClass("flex"));
            $("#modalAssign").on("click", function (e) { if (e.target === this) $("#modalAssign").addClass("hidden").removeClass("flex"); });
            $("#searchAssign").on("keyup", renderAssignList);

            function renderAssignList() {
                const q = $("#searchAssign").val().trim().toLowerCase();
                const filtered = assignItems.filter((it) => !q || it.label.toLowerCase().includes(q));
                const html = filtered.map((it) => `
                    <label class="flex items-center gap-3 px-3.5 py-2.5 hover:bg-slate-50 cursor-pointer">
                        <input type="checkbox" data-id="${it.id}" class="js-assign-check accent-teal-600 w-4 h-4" ${it.checked ? "checked" : ""} />
                        <span class="text-sm text-slate-800">${it.label}</span>
                    </label>`).join("") || `<p class="text-center text-sm text-slate-400 py-5">Tidak ada data.</p>`;
                $("#assignList").html(html);
            }

            $("#btnCentangSemua").on("click", function () {
                const semuaTercentang = $(".js-assign-check").length === $(".js-assign-check:checked").length;
                $(".js-assign-check").prop("checked", !semuaTercentang);
            });

            $("#btnSimpanAssign").on("click", function () {
                $(".js-assign-check").each(function () {
                    const id = Number($(this).data("id"));
                    const item = assignItems.find((x) => x.id === id);
                    if (item) item.checked = $(this).is(":checked");
                });
                const ids = assignItems.filter((x) => x.checked).map((x) => x.id);

                const $btn = $(this);
                $btn.prop("disabled", true);
                $.ajax({
                    url: `${URL_ASSIGN_BASE}/${assignTaskId}/assign`,
                    method: "POST",
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: JSON.stringify({ ids }),
                }).done(function (result) {
                    tampilkanToast(result.message);
                    $("#modalAssign").addClass("hidden").removeClass("flex");
                }).fail(function (xhr) {
                    tampilkanToast((xhr.responseJSON || {}).message || "Gagal menyimpan penugasan.");
                }).always(function () { $btn.prop("disabled", false); });
            });

            muatTugas();
        });
    </script>
@endpush