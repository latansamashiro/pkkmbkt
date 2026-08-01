@extends('layouts.committee.main')
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: { preflight: false } // jangan reset style global, biar tidak bentrok dengan CSS halaman lain
        }
    </script>

    <div class="flex items-center justify-between flex-wrap gap-3 mb-5">
        <div>
            <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Kelola Data</p>
            <h2 class="text-2xl font-extrabold text-slate-800 m-0">{{ $data['title'] }}</h2>
        </div>
        <button id="btnTambahInfo"
            class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
            <i data-lucide="megaphone" class="w-4 h-4"></i>Tambah Pengumuman
        </button>
    </div>

    <!-- ===== KARTU STATISTIK ===== -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-indigo-50 text-indigo-600 mb-3">
                <i data-lucide="megaphone" class="w-5 h-5"></i>
            </span>
            <p id="statTotal" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Total Pengumuman</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-teal-50 text-teal-600 mb-3">
                <i data-lucide="circle-check" class="w-5 h-5"></i>
            </span>
            <p id="statPublished" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Published</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-lime-50 text-lime-600 mb-3">
                <i data-lucide="archive-restore" class="w-5 h-5"></i>
            </span>
            <p id="statDraft" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Draft</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-rose-50 text-rose-500 mb-3">
                <i data-lucide="star" class="w-5 h-5"></i>
            </span>
            <p id="statPenting" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Ditandai Penting</p>
        </div>
    </div>

    <!-- ===== SEARCH & FILTER ===== -->
    <div class="flex items-center gap-3 flex-wrap mb-5">
        <div
            class="flex-1 min-w-[200px] flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-3.5 py-2.5">
            <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
            <input type="text" id="searchInfo" placeholder="Cari judul pengumuman..."
                class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
        </div>
        <select id="filterKategori"
            class="bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 cursor-pointer focus:outline-none">
            <option value="semua">Semua Kategori</option>
        </select>
        <select id="filterStatus"
            class="bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 cursor-pointer focus:outline-none">
            <option value="semua">Semua Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
            <option value="penting">Ditandai Penting</option>
        </select>
    </div>

    <p id="infoLoading" class="text-center text-sm text-slate-400 py-6">Memuat data...</p>
    <p id="infoEmpty" class="hidden text-center text-sm text-slate-400 py-10">Tidak ada pengumuman yang cocok.</p>
    <div id="infoGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 items-start"></div>

    <!-- ===== MODAL TAMBAH / EDIT PENGUMUMAN ===== -->
    <div id="modalForm" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <h3 id="modalFormTitle" class="text-lg font-extrabold text-slate-800 m-0">Tambah Pengumuman</h3>
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

            // ===== Konfigurasi kategori 'informasi' dikirim dari DataMasterController =====
            const CATEGORY = @json($categories[0] ?? null);
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            const URL_BASE = "{{ route('committee.informasi.index') }}"; // .../committee/informasi

            let allItems = [];
            let editingId = null;

            // Warna badge kategori — sesuai opsi yang ada di controller saat ini
            const KATEGORI_WARNA = {
                "jadwal": "text-sky-700 bg-sky-50",
                "umum": "text-teal-700 bg-teal-50",
                "tugas & evaluasi": "text-purple-700 bg-purple-50",
                "kelompok & mentor": "text-indigo-700 bg-indigo-50",
                "darurat": "text-rose-700 bg-rose-50",
            };
            const KATEGORI_WARNA_DEFAULT = "text-slate-600 bg-slate-100";

            function forceUpper(el) {
                const s = el.selectionStart, e = el.selectionEnd;
                el.value = el.value.toUpperCase();
                el.setSelectionRange(s, e);
            }
            $(document).on("input", ".js-upper", function () { forceUpper(this); });

            // ===== Isi dropdown filter kategori otomatis dari options controller =====
            function isiFilterKategori() {
                const fKategori = (CATEGORY.fields || []).find((f) => f.name === "category");
                if (!fKategori || !fKategori.options) return;
                const opts = Object.entries(fKategori.options).map(([ov, ol]) =>
                    `<option value="${ov}">${ol}</option>`
                ).join("");
                $("#filterKategori").append(opts);
            }

            // ===== Ambil data dari server =====
            function muatInfo() {
                $("#infoLoading").removeClass("hidden");
                $("#infoGrid").addClass("hidden");
                $.get(`${URL_BASE}/${CATEGORY.key}/items`)
                    .done(function (res) {
                        allItems = res.data || [];
                        renderSemua();
                    })
                    .fail(function () {
                        allItems = [];
                        renderSemua();
                        tampilkanToast("Gagal memuat data pengumuman.");
                    })
                    .always(function () {
                        $("#infoLoading").addClass("hidden");
                        $("#infoGrid").removeClass("hidden");
                    });
            }

            // ===== Statistik =====
            function renderStats() {
                $("#statTotal").text(allItems.length);
                $("#statPublished").text(allItems.filter((it) => it.status === "published").length);
                $("#statDraft").text(allItems.filter((it) => it.status === "draft").length);
                $("#statPenting").text(allItems.filter((it) => !!it.important_flag).length);
            }

            // ===== Filter (search + kategori + status) =====
            function itemsTersaring() {
                const q = $("#searchInfo").val().trim().toLowerCase();
                const fKategori = $("#filterKategori").val();
                const fStatus = $("#filterStatus").val();

                return allItems.filter((it) => {
                    if (q && !String(it.title ?? "").toLowerCase().includes(q)) return false;
                    if (fKategori !== "semua" && it.category !== fKategori) return false;
                    if (fStatus === "published" && it.status !== "published") return false;
                    if (fStatus === "draft" && it.status !== "draft") return false;
                    if (fStatus === "penting" && !it.important_flag) return false;
                    return true;
                });
            }

            function labelKategori(val) {
                const fKategori = (CATEGORY.fields || []).find((f) => f.name === "category");
                return (fKategori && fKategori.options && fKategori.options[val]) || String(val ?? "-").toUpperCase();
            }

            // ===== Render grid kartu =====
            function renderSemua() {
                renderStats();
                const items = itemsTersaring();

                if (items.length === 0) {
                    $("#infoGrid").html("");
                    $("#infoEmpty").removeClass("hidden");
                    return;
                }
                $("#infoEmpty").addClass("hidden");

                // urutkan id terbesar (terbaru) dulu — controller ini tidak mengirim created_at
                const list = items.slice().sort((a, b) => (b.id ?? 0) - (a.id ?? 0));

                const html = list.map((it) => {
                    const isPenting = !!it.important_flag;
                    const isPublished = it.status === "published";
                    const cardCls = isPenting ? "bg-amber-50/60 border-amber-200" : "bg-white border-slate-200";
                    const warnaKategori = KATEGORI_WARNA[String(it.category ?? "").toLowerCase()] || KATEGORI_WARNA_DEFAULT;

                    const badgePenting = isPenting
                        ? `<span class="text-[10px] font-extrabold uppercase tracking-wider text-rose-600 bg-rose-50 px-2 py-1 rounded-md">Penting</span>`
                        : "";
                    const badgeKategori = it.category
                        ? `<span class="text-[10px] font-extrabold uppercase tracking-wider ${warnaKategori} px-2 py-1 rounded-md">${labelKategori(it.category)}</span>`
                        : "";
                    const badgeStatus = isPublished
                        ? `<span class="text-[10px] font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2 py-1 rounded-md shrink-0">Published</span>`
                        : `<span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 bg-slate-100 px-2 py-1 rounded-md shrink-0">Draft</span>`;

                    const eyeIcon = isPublished ? "eye" : "eye-off";
                    const desc = it.description ? String(it.description) : "";

                    return `
                        <div class="border ${cardCls} rounded-2xl p-5 flex flex-col">
                            <div class="flex items-start justify-between gap-2 mb-3">
                                <div class="flex items-center gap-2 flex-wrap">
                                    ${badgePenting}
                                    ${badgeKategori}
                                </div>
                                ${badgeStatus}
                            </div>
                            <p class="text-base font-extrabold text-slate-800 m-0 mb-2">${it.title ?? "-"}</p>
                            <p class="text-sm text-slate-500 m-0 mb-4 line-clamp-3">${desc}</p>
                            <div class="mt-auto pt-3 border-t border-slate-100 flex items-center justify-end gap-1">
                                <button data-aksi="edit" data-id="${it.id}" aria-label="Edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                <button data-aksi="penting" data-id="${it.id}" aria-label="Tandai Penting" class="w-8 h-8 flex items-center justify-center rounded-lg ${isPenting ? "text-amber-500" : "text-slate-400"} hover:bg-slate-100"><i data-lucide="star" class="w-4 h-4"></i></button>
                                <button data-aksi="publish" data-id="${it.id}" aria-label="Publish/Draft" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="${eyeIcon}" class="w-4 h-4"></i></button>
                                <button data-aksi="hapus" data-id="${it.id}" aria-label="Hapus" class="w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </div>
                        </div>`;
                }).join("");

                $("#infoGrid").html(html);
                lucide.createIcons();
                pasangAksiTombol();
            }

            function pasangAksiTombol() {
                $('[data-aksi="edit"]').off("click").on("click", function () { bukaForm(Number($(this).data("id"))); });
                $('[data-aksi="hapus"]').off("click").on("click", function () { hapusItem(Number($(this).data("id"))); });
                $('[data-aksi="penting"]').off("click").on("click", function () { toggleImportant(Number($(this).data("id"))); });
                $('[data-aksi="publish"]').off("click").on("click", function () { togglePublish(Number($(this).data("id"))); });
            }

            $("#searchInfo").on("keyup", renderSemua);
            $("#filterKategori").on("change", renderSemua);
            $("#filterStatus").on("change", renderSemua);

            // ===== Modal form (dibangun dinamis dari CATEGORY.fields) =====
            const $modalForm = $("#modalForm");
            const $formError = $("#formError");

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
                const upperCls = f.type === "text" ? " js-upper" : "";
                return `<input type="${f.type}" id="${id}" value="${val}" ${req}
                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600${upperCls}" />`;
            }

            function buildFormFields(data) {
                const html = CATEGORY.fields.map((f) => {
                    if (f.type === "checkbox") {
                        return `<div>${inputHtml(f, data ? data[f.name] : false)}</div>`;
                    }
                    return `<div>
                        <label for="field_${f.name}" class="block text-xs font-bold text-slate-500 mb-1.5">${f.label}</label>
                        ${inputHtml(f, data ? data[f.name] : "")}
                        </div>`;
                }).join("");
                $("#formFields").html(html);
            }

            function collectFormValues() {
                const payload = {};
                CATEGORY.fields.forEach((f) => {
                    const $el = $(`#field_${f.name}`);
                    if (f.type === "checkbox") {
                        payload[f.name] = $el.is(":checked");
                    } else if (f.type === "text" || f.type === "textarea") {
                        payload[f.name] = ($el.val() || "").toUpperCase();
                    } else {
                        payload[f.name] = $el.val();
                    }
                });
                return payload;
            }

            function bukaForm(id) {
                editingId = id || null;
                $formError.addClass("hidden");
                const data = id ? allItems.find((x) => x.id === id) : null;
                $("#modalFormTitle").text(id ? "Edit Pengumuman" : "Tambah Pengumuman");
                buildFormFields(data);
                lucide.createIcons();
                $modalForm.removeClass("hidden").addClass("flex");
            }
            function tutupForm() { $modalForm.addClass("hidden").removeClass("flex"); editingId = null; }

            $("#btnTambahInfo").on("click", () => bukaForm(null));
            $("#btnCloseForm").on("click", tutupForm);
            $("#btnBatalForm").on("click", tutupForm);
            $modalForm.on("click", function (e) { if (e.target === this) tutupForm(); });

            $("#formItem").on("submit", function (e) {
                e.preventDefault();
                $formError.addClass("hidden");

                const payload = collectFormValues();
                const $btnSimpan = $("#btnSimpanForm");
                $btnSimpan.prop("disabled", true);

                const url = editingId ? `${URL_BASE}/${CATEGORY.key}/${editingId}` : `${URL_BASE}/${CATEGORY.key}`;
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

            // ===== Toggle cepat (bintang / mata) — endpoint PATCH khusus =====
            function toggleImportant(id) {
                $.ajax({
                    url: `${URL_BASE}/${CATEGORY.key}/${id}/toggle-important`,
                    method: "PATCH",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    const idx = allItems.findIndex((x) => x.id === id);
                    if (idx > -1) allItems[idx] = result.data;
                    tampilkanToast(result.message);
                    renderSemua();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    tampilkanToast(result.message || "Gagal memperbarui data.");
                });
            }

            function togglePublish(id) {
                $.ajax({
                    url: `${URL_BASE}/${CATEGORY.key}/${id}/toggle-publish`,
                    method: "PATCH",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    const idx = allItems.findIndex((x) => x.id === id);
                    if (idx > -1) allItems[idx] = result.data;
                    tampilkanToast(result.message);
                    renderSemua();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    tampilkanToast(result.message || "Gagal memperbarui status.");
                });
            }

            function hapusItem(id) {
                const it = allItems.find((x) => x.id === id);
                if (!it) return;
                if (!confirm(`Hapus "${it.title}"?`)) return;

                $.ajax({
                    url: `${URL_BASE}/${CATEGORY.key}/${id}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    allItems = allItems.filter((x) => x.id !== id);
                    tampilkanToast(result.message);
                    renderSemua();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    tampilkanToast(result.message || "Gagal menghapus data.");
                });
            }

            isiFilterKategori();
            muatInfo();
        });
    </script>
@endpush