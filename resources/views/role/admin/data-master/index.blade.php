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
            <h2 class="text-2xl font-extrabold text-slate-800 m-0">{{ $data['title'] }}</h2>
        </div>
    </div>

    <div id="masterGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"></div>

    <!-- ===== MODAL DAFTAR DATA MASTER PER KATEGORI ===== -->
    <div id="modalList" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-4xl max-h-[85vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <div>
                    <h3 id="modalListTitle" class="text-lg font-extrabold text-slate-800 m-0">-</h3>
                    <p class="text-xs text-slate-400 m-0 mt-1">Kelola isi data master untuk kategori ini.</p>
                </div>
                <button id="btnCloseList" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="flex items-center gap-3 mb-4 flex-wrap">
                <div
                    class="flex-1 min-w-[200px] flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
                    <input type="text" id="searchItem" placeholder="Cari data..."
                        class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
                </div>
                <button id="btnTambahItem"
                    class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
                    <i data-lucide="plus" class="w-4 h-4"></i>Tambah
                </button>
            </div>

            <p id="listLoading" class="text-center text-sm text-slate-400 py-4 hidden">Memuat data...</p>

            <div id="listTableWrap" class="border border-slate-200 rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr id="tabelItemHead"></tr>
                        </thead>
                        <tbody id="tabelItem"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== MODAL TAMBAH / EDIT ITEM (field dibuat dinamis lewat JS) ===== -->
    <div id="modalForm" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <h3 id="modalFormTitle" class="text-lg font-extrabold text-slate-800 m-0">Tambah Data</h3>
                <button id="btnCloseForm" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form id="formItem">
                <p id="formError"
                    class="hidden text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg px-3 py-2 mb-3">
                </p>
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
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(function () {

            // ===== Data kategori & konfigurasi field dari server =====
            const CATEGORIES = @json($categories);
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            const URL_BASE = "{{ url('admin/data-master') }}"; // + /{type}/items | /{type} | /{type}/{id}

            let activeKategori = null;
            let activeItems = [];
            let editingId = null;

            function forceUpper(el) {
                const s = el.selectionStart, e = el.selectionEnd;
                el.value = el.value.toUpperCase();
                el.setSelectionRange(s, e);
            }
            $(document).on("input", ".js-upper", function () { forceUpper(this); });

            // ===== Grid kategori =====
            function renderGrid() {
                const html = CATEGORIES.map((k) => `
                    <div data-key="${k.key}" class="master-card bg-white border border-slate-200 rounded-2xl p-5 cursor-pointer hover:shadow-md hover:border-teal-300 transition">
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-11 h-11 rounded-xl flex items-center justify-center ${k.chip}">
                                <i data-lucide="${k.icon}" class="w-5 h-5"></i>
                            </span>
                            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                        </div>
                        <p class="text-sm font-bold text-slate-800 m-0">${k.label}</p>
                        <p class="text-2xl font-extrabold text-slate-800 m-0 mt-1">${k.total}</p>
                        <p class="text-xs text-slate-400 m-0">data tersimpan</p>
                    </div>`).join("");
                $("#masterGrid").html(html);
                lucide.createIcons();
                $(".master-card").on("click", function () {
                    const key = $(this).data("key");
                    // "soal" (Bank Soal) punya halaman & alur sendiri (terikat ke
                    // Paket Evaluasi/exam_id), jadi diarahkan ke halaman terpisah,
                    // bukan modal generik di halaman ini.
                    if (key === "soal") {
                        window.location.href = "{{ route('admin.data-master.soal.index') }}";
                        return;
                    }
                    bukaList(key);
                });
            }

            const $modalList = $("#modalList");
            const $modalForm = $("#modalForm");
            const $formError = $("#formError");

            // ===== Modal daftar (list per kategori) =====
            function bukaList(key) {
                activeKategori = CATEGORIES.find((k) => k.key === key);
                $("#modalListTitle").text(activeKategori.label);
                $("#searchItem").val("");
                renderItemHeader();
                $modalList.removeClass("hidden").addClass("flex");
                muatItems();
            }
            $("#btnCloseList").on("click", () => $modalList.addClass("hidden").removeClass("flex"));
            $modalList.on("click", function (e) { if (e.target === this) $modalList.addClass("hidden").removeClass("flex"); });
            $("#searchItem").on("keyup", renderItemTabel);

            function muatItems() {
                $("#listLoading").removeClass("hidden");
                $("#listTableWrap").addClass("hidden");
                $.get(`${URL_BASE}/${activeKategori.key}/items`)
                    .done(function (res) {
                        activeItems = res.data || [];
                        renderItemTabel();
                    })
                    .fail(function () {
                        activeItems = [];
                        renderItemTabel();
                        tampilkanToast("Gagal memuat data.");
                    })
                    .always(function () {
                        $("#listLoading").addClass("hidden");
                        $("#listTableWrap").removeClass("hidden");
                    });
            }

            // Header tabel dibangun sesuai list_cols kategori yang lagi aktif.
            function renderItemHeader() {
                const thClass = "text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap";
                let html = `<th class="${thClass}">No</th>`;
                Object.entries(activeKategori.list_cols).forEach(([key, label]) => {
                    html += `<th class="${thClass}">${label}</th>`;
                });
                html += `<th class="${thClass}">Aksi</th>`;
                $("#tabelItemHead").html(html);
            }

            function renderItemTabel() {
                const q = $("#searchItem").val().trim().toLowerCase();
                const displayKey = activeKategori.display;
                const items = activeItems.filter((it) => !q || String(it[displayKey] ?? "").toLowerCase().includes(q));

                const colKeys = Object.keys(activeKategori.list_cols);
                const totalCols = colKeys.length + 2; // No + Aksi

                let html;
                if (items.length === 0) {
                    html = `<tr><td colspan="${totalCols}" class="text-center py-5 text-slate-400 text-sm">Tidak ada data.</td></tr>`;
                } else {
                    html = items.map((it, idx) => {
                        const cells = colKeys.map((key) =>
                            `<td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${it[key] ?? "-"}</td>`
                        ).join("");
                        return `<tr class="hover:bg-slate-50">
                                    <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${idx + 1}</td>
                                    ${cells}
                                    <td class="px-3.5 py-3 border-b border-slate-200">
                                        <div class="flex items-center gap-2">
                                            <button data-aksi="edit" data-id="${it.id}" aria-label="Edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                            <button data-aksi="hapus" data-id="${it.id}" aria-label="Hapus" class="w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                        </div>
                                    </td>
                                </tr>`;
                    }).join("");
                }
                $("#tabelItem").html(html);
                lucide.createIcons();
                $('[data-aksi="edit"]').on("click", function () { bukaForm(Number($(this).data("id"))); });
                $('[data-aksi="hapus"]').on("click", function () { hapusItem(Number($(this).data("id"))); });
            }

            // ===== Modal form (dibangun dinamis dari activeKategori.fields) =====
            function inputHtml(f, value) {
                const id = `field_${f.name}`;
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
                if (f.type === "checkbox") {
                    return `<label class="inline-flex items-center gap-2 text-sm text-slate-700 cursor-pointer h-[42px]">
                                                    <input type="checkbox" id="${id}" class="accent-teal-600 w-4 h-4" ${value ? "checked" : ""} /> ${f.label}
                                                </label>`;
                }
                // text, number, date, time -- kecuali field URL (file_link/thumbnail_link/download_link),
                // yang harus dibiarkan apa adanya karena huruf besar/kecil di URL itu penting.
                const upperCls = (f.type === "text" && f.name !== "file_link" && f.name !== "thumbnail_link" && f.name !== "download_link") ? " js-upper" : "";
                return `<input type="${f.type}" id="${id}" value="${val}" ${req}
                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600${upperCls}" />`;
            }

            function applyDependentFilters(changedFieldName, changedValue) {
                const dependents = activeKategori.fields.filter((f) => f.filter_by === changedFieldName);
                dependents.forEach((dep) => {
                    const meta = dep.options_meta || [];
                    const filtered = changedValue ? meta.filter((m) => String(m.filter_value) === String(changedValue)) : meta;
                    const $el = $(`#field_${dep.name}`);
                    const currentVal = $el.val();
                    const opts = filtered
                        .map((m) => `<option value="${m.value}" ${String(currentVal) === String(m.value) ? "selected" : ""}>${m.label}</option>`)
                        .join("");
                    $el.html(`<option value="">Pilih ${dep.label}</option>${opts}`);
                    if (!filtered.some((m) => String(m.value) === String(currentVal))) {
                        $el.val("");
                    }
                });
            }

            function buildFormFields(data) {
                const html = activeKategori.fields.map((f) => {
                    if (f.type === "checkbox") {
                        return `<div>${inputHtml(f, data ? data[f.name] : false)}</div>`;
                    }
                    return `<div>
                                    <label for="field_${f.name}" class="block text-xs font-bold text-slate-500 mb-1.5">${f.label}</label>
                                    ${inputHtml(f, data ? data[f.name] : "")}
                                </div>`;
                }).join("");
                $("#formFields").html(html);

                activeKategori.fields.forEach((f) => {
                    const hasDependents = activeKategori.fields.some((d) => d.filter_by === f.name);
                    if (hasDependents) {
                        applyDependentFilters(f.name, data ? data[f.name] : "");
                        $(`#field_${f.name}`).on("change", function () {
                            applyDependentFilters(f.name, $(this).val());
                        });
                    }
                });
            }

            function collectFormValues() {
                const payload = {};
                activeKategori.fields.forEach((f) => {
                    const $el = $(`#field_${f.name}`);
                    if (f.type === "checkbox") {
                        payload[f.name] = $el.is(":checked");
                    } else if (f.type === "text" || f.type === "textarea") {
                        // file_link, thumbnail_link & download_link biarkan apa adanya (URL), sisanya upper-case
                        payload[f.name] = (f.name === "file_link" || f.name === "thumbnail_link" || f.name === "download_link") ? ($el.val() || "") : ($el.val() || "").toUpperCase();
                    } else {
                        payload[f.name] = $el.val();
                    }
                });
                return payload;
            }

            function bukaForm(id) {
                editingId = id || null;
                $formError.addClass("hidden");
                const data = id ? activeItems.find((x) => x.id === id) : null;
                $("#modalFormTitle").text(id ? `Edit ${activeKategori.label}` : `Tambah ${activeKategori.label}`);
                buildFormFields(data);
                $modalForm.removeClass("hidden").addClass("flex");
            }
            function tutupForm() { $modalForm.addClass("hidden").removeClass("flex"); editingId = null; }

            $("#btnTambahItem").on("click", () => bukaForm(null));
            $("#btnCloseForm").on("click", tutupForm);
            $("#btnBatalForm").on("click", tutupForm);
            $modalForm.on("click", function (e) { if (e.target === this) tutupForm(); });

            $("#formItem").on("submit", function (e) {
                e.preventDefault();
                $formError.addClass("hidden");

                const payload = collectFormValues();
                const $btnSimpan = $("#btnSimpanForm");
                $btnSimpan.prop("disabled", true);

                const url = editingId ? `${URL_BASE}/${activeKategori.key}/${editingId}` : `${URL_BASE}/${activeKategori.key}`;
                const method = editingId ? "PUT" : "POST";

                $.ajax({
                    url, method,
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: JSON.stringify(payload),
                }).done(function (result) {
                    if (editingId) {
                        const idx = activeItems.findIndex((x) => x.id === editingId);
                        if (idx > -1) activeItems[idx] = result.data;
                    } else {
                        activeItems.push(result.data);
                    }
                    const cat = CATEGORIES.find((c) => c.key === activeKategori.key);
                    if (cat) cat.total = activeItems.length;

                    tampilkanToast(result.message);
                    tutupForm();
                    renderItemTabel();
                    renderGrid();
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

            function hapusItem(id) {
                const it = activeItems.find((x) => x.id === id);
                if (!it) return;
                const label = it[activeKategori.display] ?? "data ini";
                if (!confirm(`Hapus "${label}"?`)) return;

                $.ajax({
                    url: `${URL_BASE}/${activeKategori.key}/${id}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    activeItems = activeItems.filter((x) => x.id !== id);
                    const cat = CATEGORIES.find((c) => c.key === activeKategori.key);
                    if (cat) cat.total = activeItems.length;

                    tampilkanToast(result.message);
                    renderItemTabel();
                    renderGrid();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    tampilkanToast(result.message || "Gagal menghapus data.");
                });
            }

            renderGrid();
        });
    </script>
@endpush