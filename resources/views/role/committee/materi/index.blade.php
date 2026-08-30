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
        <button id="btnTambahMateri"
            class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
            <i data-lucide="plus" class="w-4 h-4"></i>Tambah Materi
        </button>
    </div>

    <!-- ===== KARTU STATISTIK ===== -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-indigo-50 text-indigo-600 mb-3">
                <i data-lucide="file-text" class="w-5 h-5"></i>
            </span>
            <p id="statTotal" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Total Materi</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-teal-50 text-teal-600 mb-3">
                <i data-lucide="clapperboard" class="w-5 h-5"></i>
            </span>
            <p id="statVideo" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Video</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-rose-50 text-rose-500 mb-3">
                <i data-lucide="file-type-2" class="w-5 h-5"></i>
            </span>
            <p id="statDokumen" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Dokumen / PDF</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-lime-50 text-lime-600 mb-3">
                <i data-lucide="circle-check" class="w-5 h-5"></i>
            </span>
            <p id="statPublished" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Published</p>
        </div>
    </div>

    <!-- ===== SEARCH & FILTER ===== -->
    <div class="flex items-center gap-3 flex-wrap mb-5">
        <div
            class="flex-1 min-w-[200px] flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-3.5 py-2.5">
            <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
            <input type="text" id="searchMateri" placeholder="Cari judul materi atau pemateri..."
                class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
        </div>
        <select id="filterTipe"
            class="bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 cursor-pointer focus:outline-none">
            <option value="semua">Semua Tipe</option>
        </select>
        <select id="filterKategori"
            class="bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 cursor-pointer focus:outline-none">
            <option value="semua">Semua Kategori</option>
        </select>
        <select id="filterStatus"
            class="bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 cursor-pointer focus:outline-none">
            <option value="semua">Semua Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <p id="materiLoading" class="text-center text-sm text-slate-400 py-6">Memuat data...</p>
    <p id="materiEmpty" class="hidden text-center text-sm text-slate-400 py-10">Tidak ada materi yang cocok.</p>
    <div id="materiGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-start"></div>

    <!-- ===== MODAL TAMBAH / EDIT MATERI ===== -->
    <div id="modalForm" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <h3 id="modalFormTitle" class="text-lg font-extrabold text-slate-800 m-0">Tambah Materi</h3>
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

            // ===== Konfigurasi kategori 'topik' dikirim dari DataMasterController =====
            const CATEGORY = @json($categories[0] ?? null);
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            const URL_BASE = "{{ route('committee.materi.index') }}"; // .../committee/materi

            let allItems = [];
            let editingId = null;

            // Warna badge topic_type — sesuai opsi yang ada di controller
            const TOPIK_WARNA = {
                "keunilaman": "text-sky-700 bg-sky-50",
                "akademik": "text-teal-700 bg-teal-50",
                "lkms": "text-purple-700 bg-purple-50",
                "perpustakaan": "text-indigo-700 bg-indigo-50",
                "kemahasiswaan": "text-rose-700 bg-rose-50",
                "narasumber eskternal": "text-amber-700 bg-amber-50",
            };
            const TOPIK_WARNA_DEFAULT = "text-slate-600 bg-slate-100";

            function forceUpper(el) {
                const s = el.selectionStart, e = el.selectionEnd;
                el.value = el.value.toUpperCase();
                el.setSelectionRange(s, e);
            }
            $(document).on("input", ".js-upper", function () { forceUpper(this); });

            function fieldByName(name) {
                return (CATEGORY.fields || []).find((f) => f.name === name);
            }

            // Ambil thumbnail otomatis dari YouTube atau Google Drive (file harus di-share "Anyone with the link"). Selain itu return null (fallback ikon).
            function ambilThumbnailUrl(link) {
                if (!link) return null;
                const s = String(link);

                const yt = s.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([a-zA-Z0-9_-]{11})/);
                if (yt && yt[1]) {
                    return `https://img.youtube.com/vi/${yt[1]}/hqdefault.jpg`;
                }

                const drive = s.match(/drive\.google\.com\/(?:file\/d\/|open\?id=|uc\?id=)([a-zA-Z0-9_-]+)/);
                if (drive && drive[1]) {
                    return `https://drive.google.com/thumbnail?id=${drive[1]}&sz=w480`;
                }

                return null;
            }

            // ===== Isi dropdown filter Tipe & Kategori otomatis dari options controller =====
            function isiFilterDropdown() {
                const fTipe = fieldByName("category");
                if (fTipe && fTipe.options) {
                    $("#filterTipe").append(Object.entries(fTipe.options).map(([ov, ol]) => `<option value="${ov}">${ol}</option>`).join(""));
                }
                const fKategori = fieldByName("topic_type");
                if (fKategori && fKategori.options) {
                    $("#filterKategori").append(Object.entries(fKategori.options).map(([ov, ol]) => `<option value="${ov}">${ol}</option>`).join(""));
                }
            }

            function labelOpsi(fieldName, val) {
                const f = fieldByName(fieldName);
                return (f && f.options && f.options[val]) || String(val ?? "-").toUpperCase();
            }

            // ===== Ambil data dari server =====
            function muatMateri() {
                $("#materiLoading").removeClass("hidden");
                $("#materiGrid").addClass("hidden");
                $.get(`${URL_BASE}/${CATEGORY.key}/items`)
                    .done(function (res) {
                        allItems = res.data || [];
                        renderSemua();
                    })
                    .fail(function () {
                        allItems = [];
                        renderSemua();
                        tampilkanToast("Gagal memuat data materi.");
                    })
                    .always(function () {
                        $("#materiLoading").addClass("hidden");
                        $("#materiGrid").removeClass("hidden");
                    });
            }

            // ===== Statistik =====
            function renderStats() {
                $("#statTotal").text(allItems.length);
                $("#statVideo").text(allItems.filter((it) => it.category === "video").length);
                $("#statDokumen").text(allItems.filter((it) => it.category === "ebook").length);
                $("#statPublished").text(allItems.filter((it) => it.status === "published").length);
            }

            // ===== Filter =====
            function itemsTersaring() {
                const q = $("#searchMateri").val().trim().toLowerCase();
                const fTipe = $("#filterTipe").val();
                const fKategori = $("#filterKategori").val();
                const fStatus = $("#filterStatus").val();

                return allItems.filter((it) => {
                    if (q) {
                        const cocok = String(it.title ?? "").toLowerCase().includes(q) || String(it.trainer ?? "").toLowerCase().includes(q);
                        if (!cocok) return false;
                    }
                    if (fTipe !== "semua" && it.category !== fTipe) return false;
                    if (fKategori !== "semua" && it.topic_type !== fKategori) return false;
                    if (fStatus !== "semua" && it.status !== fStatus) return false;
                    return true;
                });
            }

            // ===== Render grid kartu =====
            function renderSemua() {
                renderStats();
                const items = itemsTersaring();

                if (items.length === 0) {
                    $("#materiGrid").html("");
                    $("#materiEmpty").removeClass("hidden");
                    return;
                }
                $("#materiEmpty").addClass("hidden");

                const list = items.slice().sort((a, b) => (b.id ?? 0) - (a.id ?? 0));

                const html = list.map((it) => {
                    const isVideo = it.category === "video";
                    const isPublished = it.status === "published";
                    const gradientCls = isVideo ? "from-teal-600 to-sky-700" : "from-rose-600 to-orange-700";
                    const tipeIcon = isVideo ? "video" : "file-text";
                    const bigIcon = isVideo ? "clapperboard" : "file-text";
                    const warnaTopik = TOPIK_WARNA[String(it.topic_type ?? "").toLowerCase()] || TOPIK_WARNA_DEFAULT;
                    const labelSumber = isVideo ? "Pemateri" : "Sumber";

                    const badgeStatus = isPublished
                        ? `<span class="text-[10px] font-extrabold uppercase tracking-wider text-white bg-teal-600 px-2.5 py-1 rounded-full">Published</span>`
                        : `<span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-700 bg-white px-2.5 py-1 rounded-full">Draft</span>`;

                    const thumb = it.thumbnail_link || ambilThumbnailUrl(it.file_link);
                    const thumbnailImgHtml = thumb
                        ? `<img src="${thumb}" alt="${it.title ?? ''}" class="absolute inset-0 w-full h-full object-cover" onerror="this.style.display='none'" />`
                        : "";

                    return `
                        <div class="border border-slate-200 rounded-2xl overflow-hidden bg-white flex flex-col">
                            <div class="relative bg-gradient-to-br ${gradientCls} aspect-video flex items-center justify-center">
                                <i data-lucide="${bigIcon}" class="w-9 h-9 text-white/80"></i>
                                ${thumbnailImgHtml}
                                <span class="absolute top-2.5 left-2.5 inline-flex items-center gap-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-700 bg-white px-2.5 py-1 rounded-full">
                                    <i data-lucide="${tipeIcon}" class="w-3 h-3"></i> ${isVideo ? "Video" : "PDF"}
                                </span>
                                <span class="absolute top-2.5 right-2.5">${badgeStatus}</span>
                            </div>
                            <div class="p-4 flex flex-col flex-1">
                                <p class="text-[10px] font-extrabold uppercase tracking-wider ${warnaTopik} inline-block px-0 m-0 mb-1.5">${labelOpsi("topic_type", it.topic_type)}</p>
                                <p class="text-sm font-extrabold text-slate-800 m-0 mb-1.5 leading-snug">${it.title ?? "-"}</p>
                                <p class="text-xs text-slate-400 m-0 mb-3">${labelSumber}: ${it.trainer || "-"}</p>
                                <div class="mt-auto pt-3 border-t border-slate-100 flex items-center justify-end gap-1">
                                    <button data-aksi="preview" data-id="${it.id}" aria-label="Lihat" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="eye" class="w-4 h-4"></i></button>
                                    <button data-aksi="edit" data-id="${it.id}" aria-label="Edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                    <button data-aksi="hapus" data-id="${it.id}" aria-label="Hapus" class="w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                </div>
                            </div>
                        </div>`;
                }).join("");

                $("#materiGrid").html(html);
                lucide.createIcons();
                pasangAksiTombol();
            }

            function pasangAksiTombol() {
                $('[data-aksi="edit"]').off("click").on("click", function () { bukaForm(Number($(this).data("id"))); });
                $('[data-aksi="hapus"]').off("click").on("click", function () { hapusItem(Number($(this).data("id"))); });
                $('[data-aksi="preview"]').off("click").on("click", function () { previewItem(Number($(this).data("id"))); });
            }

            function previewItem(id) {
                const it = allItems.find((x) => x.id === id);
                if (!it) return;
                if (it.file_link) {
                    window.open(it.file_link, "_blank");
                } else {
                    tampilkanToast("Materi ini belum ada link file/video.");
                }
            }

            $("#searchMateri").on("keyup", renderSemua);
            $("#filterTipe").on("change", renderSemua);
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
                const upperCls = (f.type === "text" && f.name !== "file_link" && f.name !== "thumbnail_link" && f.name !== "download_link") ? " js-upper" : "";
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
                const data = id ? allItems.find((x) => x.id === id) : null;
                $("#modalFormTitle").text(id ? "Edit Materi" : "Tambah Materi");
                buildFormFields(data);
                lucide.createIcons();
                $modalForm.removeClass("hidden").addClass("flex");
            }
            function tutupForm() { $modalForm.addClass("hidden").removeClass("flex"); editingId = null; }

            $("#btnTambahMateri").on("click", () => bukaForm(null));
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

            function hapusItem(id) {
                const it = allItems.find((x) => x.id === id);
                if (!it) return;
                if (!confirm(`Hapus materi "${it.title}"?`)) return;

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

            isiFilterDropdown();
            muatMateri();
        });
    </script>
@endpush