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
        <div class="flex items-center gap-3">
            <button id="btnImportModul"
                class="inline-flex items-center gap-2 bg-teal-50 hover:bg-teal-100 text-teal-700 font-bold text-sm px-4 py-2.5 rounded-xl transition">
                <i data-lucide="file-up" class="w-4 h-4"></i>Import dari Word
            </button>
            <button id="btnTambahBagian"
                class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
                <i data-lucide="plus" class="w-4 h-4"></i>Tambah Bagian
            </button>
        </div>
    </div>

    <p id="modulLoading" class="text-center text-sm text-slate-400 py-6">Memuat data...</p>

    <div id="modulLayout" class="hidden grid grid-cols-1 lg:grid-cols-[280px_1fr] gap-5 items-start">
        <!-- ===== SIDEBAR DAFTAR BAGIAN ===== -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4">
            <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0 mb-3 px-1">Bagian Modul</p>
            <div id="daftarBagian" class="flex flex-col gap-1.5"></div>
            <p id="daftarBagianKosong" class="hidden text-xs text-slate-400 text-center py-4">Belum ada bagian modul.</p>
        </div>

        <!-- ===== PANEL EDITOR ===== -->
        <div id="panelEditor" class="hidden bg-white border border-slate-200 rounded-2xl overflow-hidden">
            <div class="flex items-center justify-between gap-3 px-5 pt-5 pb-4 flex-wrap">
                <input type="text" id="editorJudul" placeholder="Judul bagian..."
                    class="text-lg font-extrabold text-slate-800 border-none focus:outline-none focus:ring-0 flex-1 min-w-[180px] bg-transparent" />
                <div class="flex items-center gap-2 shrink-0">
                    <div class="flex items-center bg-slate-100 rounded-full p-1">
                        <button type="button" id="btnStatusDraft"
                            class="text-xs font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-full transition">Draft</button>
                        <button type="button" id="btnStatusPublish"
                            class="text-xs font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-full transition">Publish</button>
                    </div>
                    <button type="button" id="btnHapusBagian" aria-label="Hapus bagian"
                        class="w-9 h-9 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <!-- Toolbar rich text sederhana -->
            <div class="flex items-center gap-1 px-5 py-2.5 border-y border-slate-100 bg-slate-50 flex-wrap">
                <button type="button" data-cmd="bold" class="editor-tool" title="Bold"><i data-lucide="bold" class="w-4 h-4"></i></button>
                <button type="button" data-cmd="italic" class="editor-tool" title="Italic"><i data-lucide="italic" class="w-4 h-4"></i></button>
                <button type="button" data-cmd="underline" class="editor-tool" title="Underline"><i data-lucide="underline" class="w-4 h-4"></i></button>
                <span class="w-px h-5 bg-slate-200 mx-1"></span>
                <button type="button" data-cmd="heading" class="editor-tool" title="Heading"><i data-lucide="heading" class="w-4 h-4"></i></button>
                <button type="button" data-cmd="insertUnorderedList" class="editor-tool" title="Bullet List"><i data-lucide="list" class="w-4 h-4"></i></button>
                <button type="button" data-cmd="insertOrderedList" class="editor-tool" title="Numbered List"><i data-lucide="list-ordered" class="w-4 h-4"></i></button>
                <span class="w-px h-5 bg-slate-200 mx-1"></span>
                <button type="button" data-cmd="link" class="editor-tool" title="Link"><i data-lucide="link" class="w-4 h-4"></i></button>
                <button type="button" data-cmd="image" class="editor-tool" title="Gambar"><i data-lucide="image" class="w-4 h-4"></i></button>
            </div>

            <div id="editorContent" contenteditable="true"
                class="min-h-[320px] px-5 py-4 text-sm text-slate-700 leading-relaxed focus:outline-none prose-editor"></div>

            <div class="flex items-center justify-between gap-3 px-5 py-4 border-t border-slate-100 flex-wrap">
                <button type="button" id="btnPratinjau"
                    class="inline-flex items-center gap-2 border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">
                    <i data-lucide="external-link" class="w-4 h-4"></i>Pratinjau
                </button>
                <button type="submit" id="btnSimpanBagian" form="formModulDummy"
                    class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">
                    <i data-lucide="check" class="w-4 h-4"></i>Simpan Bagian Ini
                </button>
            </div>
        </div>

        <p id="panelKosong" class="text-center text-sm text-slate-400 py-10 bg-white border border-dashed border-slate-200 rounded-2xl">
            Pilih salah satu bagian di sebelah kiri, atau tambah bagian baru.
        </p>
    </div>

    <!-- ===== MODAL PRATINJAU (read-only) ===== -->
    <div id="modalPratinjau" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[85vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-4">
                <h3 id="pratinjauJudul" class="text-xl font-extrabold text-slate-800 m-0">-</h3>
                <button id="btnClosePratinjau" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <div id="pratinjauKonten" class="text-sm text-slate-700 leading-relaxed prose-editor"></div>
        </div>
    </div>

    <style>
        .editor-tool {
            width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;
            border-radius: 8px; color: #475569;
        }
        .editor-tool:hover { background: #e2e8f0; }
        .prose-editor h3 { font-weight: 800; color: #1e293b; margin: 0 0 8px; font-size: 1.05rem; }
        .prose-editor p { margin: 0 0 10px; }
        .prose-editor ul { list-style: disc; padding-left: 22px; margin: 0 0 10px; }
        .prose-editor ol { list-style: decimal; padding-left: 22px; margin: 0 0 10px; }
        .prose-editor a { color: #0d9488; text-decoration: underline; }
    </style>

    <!-- ===== MODAL IMPORT DARI WORD ===== -->
    <div id="modalImportModul" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <div>
                    <h3 class="text-lg font-extrabold text-slate-800 m-0">Import Bagian dari Word</h3>
                    <p class="text-xs text-slate-400 m-0 mt-1">Upload file Word (.docx) berisi teks -- isinya otomatis jadi bagian baru (status Draft, review dulu sebelum di-publish).</p>
                </div>
                <button id="btnCloseImportModul" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <label class="block text-xs font-bold text-slate-500 mb-1.5">Judul Bagian (opsional)</label>
            <input type="text" id="inputJudulImport" placeholder="Kosongkan biar otomatis dari isi file"
                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 mb-4 focus:outline-none focus:border-teal-600" />

            <label class="block text-xs font-bold text-slate-500 mb-1.5">File Word (.docx)</label>
            <input type="file" id="inputFileImportModul" accept=".docx"
                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600" />
            <p class="text-xs text-slate-400 mt-2">Cuma teksnya yang dibaca (formatting Bold/warna/dsb di dalam Word diabaikan) -- bisa dirapikan lagi lewat editor setelah diimpor.</p>

            <div id="importModulErrorBox" class="hidden mt-4 bg-rose-50 border border-rose-100 rounded-xl p-3">
                <p class="text-xs font-bold text-rose-600 m-0" id="importModulErrorText"></p>
            </div>

            <div class="flex items-center justify-end gap-3 mt-6">
                <button type="button" id="btnBatalImportModul" class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                <button type="button" id="btnSubmitImportModul" class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">Import Sekarang</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(function () {

            // ===== Konfigurasi kategori 'modul' dikirim dari DataMasterController =====
            const CATEGORY = @json($categories[0] ?? null);
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            const URL_BASE = "{{ route('committee.modul-pkkmb.index') }}"; // .../committee/modul

            // Opsi status modul: 'aktif' => PUBLISHED, 'draft' => DRAFT (beda dari kategori lain!)
            const STATUS_AKTIF = "aktif";
            const STATUS_DRAFT = "draft";

            let allItems = [];
            let activeId = null;

            // ===== Ambil data dari server =====
            function muatModul() {
                $("#modulLoading").removeClass("hidden");
                $("#modulLayout").addClass("hidden");
                $.get(`${URL_BASE}/${CATEGORY.key}/items`)
                    .done(function (res) {
                        allItems = res.data || [];
                        renderDaftar();
                        if (allItems.length > 0) {
                            pilihBagian(allItems[0].id);
                        } else {
                            tampilkanPanelKosong();
                        }
                    })
                    .fail(function () {
                        allItems = [];
                        renderDaftar();
                        tampilkanPanelKosong();
                        tampilkanToast("Gagal memuat data modul.");
                    })
                    .always(function () {
                        $("#modulLoading").addClass("hidden");
                        $("#modulLayout").removeClass("hidden");
                    });
            }

            // ===== Render daftar bagian di sidebar =====
            function renderDaftar() {
                if (allItems.length === 0) {
                    $("#daftarBagian").html("");
                    $("#daftarBagianKosong").removeClass("hidden");
                    return;
                }
                $("#daftarBagianKosong").addClass("hidden");

                const html = allItems.map((it) => {
                    const aktif = it.id === activeId;
                    const isPublished = it.status === STATUS_AKTIF;
                    const baseCls = aktif
                        ? "bg-teal-600 text-white"
                        : "text-slate-700 hover:bg-slate-50";
                    const statusCls = aktif
                        ? (isPublished ? "text-teal-200" : "text-slate-300")
                        : (isPublished ? "text-teal-600" : "text-slate-400");
                    return `
                        <button type="button" data-id="${it.id}" class="daftar-bagian-item text-left px-3.5 py-3 rounded-xl transition ${baseCls}">
                            <p class="text-sm font-bold m-0">${it.section || "(Tanpa judul)"}</p>
                            <p class="text-xs font-semibold m-0 mt-0.5 ${statusCls}">${isPublished ? "Published" : "Draft"}</p>
                        </button>`;
                }).join("");
                $("#daftarBagian").html(html);
                $(".daftar-bagian-item").on("click", function () { pilihBagian(Number($(this).data("id"))); });
            }

            function tampilkanPanelKosong() {
                activeId = null;
                $("#panelEditor").addClass("hidden");
                $("#panelKosong").removeClass("hidden");
            }

            // ===== Pilih bagian untuk diedit =====
            function pilihBagian(id) {
                const it = allItems.find((x) => x.id === id);
                if (!it) { tampilkanPanelKosong(); return; }

                activeId = id;
                $("#panelKosong").addClass("hidden");
                $("#panelEditor").removeClass("hidden");

                $("#editorJudul").val(it.section || "");
                $("#editorContent").html(it.content || "");
                renderBadgeStatus(it.status);
                renderDaftar();
            }

            function renderBadgeStatus(status) {
                const isPublished = status === STATUS_AKTIF;

                $("#btnStatusDraft")
                    .removeClass()
                    .addClass(`text-xs font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-full transition ${!isPublished ? "bg-white text-slate-700 shadow-sm cursor-default" : "text-slate-400 hover:text-slate-600 cursor-pointer"}`);

                $("#btnStatusPublish")
                    .removeClass()
                    .addClass(`text-xs font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-full transition ${isPublished ? "bg-teal-600 text-white shadow-sm cursor-default" : "text-slate-400 hover:text-slate-600 cursor-pointer"}`);
            }

            function ubahStatus(statusBaru) {
            if (!activeId) return;
            const it = allItems.find((x) => x.id === activeId);
            if (!it || it.status === statusBaru) return;

            $.ajax({
                url: `${URL_BASE}/${CATEGORY.key}/${activeId}/toggle-publish`,
                method: "PATCH",
                headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
            }).done(function (result) {
                const idx = allItems.findIndex((x) => x.id === activeId);
                if (idx > -1) allItems[idx] = result.data;

                // update UI dulu, baru toast — biar toast yang error nggak nge-block render
                renderBadgeStatus(result.data.status);
                renderDaftar();
                tampilkanToast(result.message);
            }).fail(function (xhr) {
                console.error("toggle-publish gagal:", xhr.status, xhr.responseJSON);
                const result = xhr.responseJSON || {};
                tampilkanToast(result.message || "Gagal memperbarui status.");
            });
        }

            $("#btnStatusDraft").on("click", function () { ubahStatus(STATUS_DRAFT); });
            $("#btnStatusPublish").on("click", function () { ubahStatus(STATUS_AKTIF); });

            // ===== Toolbar rich text (execCommand sederhana) =====
            $(".editor-tool").on("mousedown", function (e) { e.preventDefault(); }); // jangan hilangkan seleksi teks
            $(".editor-tool").on("click", function () {
                const cmd = $(this).data("cmd");
                $("#editorContent").trigger("focus");

                if (cmd === "heading") {
                    document.execCommand("formatBlock", false, "H3");
                } else if (cmd === "link") {
                    const url = prompt("Masukkan URL link:");
                    if (url) document.execCommand("createLink", false, url);
                } else if (cmd === "image") {
                    const url = prompt("Masukkan URL gambar:");
                    if (url) document.execCommand("insertImage", false, url);
                } else {
                    document.execCommand(cmd);
                }
            });

            // ===== Tambah bagian baru =====
            $("#btnTambahBagian").on("click", function () {
                const payload = { section: "Bagian Baru", content: "", status: STATUS_DRAFT };
                $.ajax({
                    url: `${URL_BASE}/${CATEGORY.key}`,
                    method: "POST",
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: JSON.stringify(payload),
                }).done(function (result) {
                    allItems.push(result.data);
                    tampilkanToast(result.message);
                    renderDaftar();
                    pilihBagian(result.data.id);
                    $("#editorJudul").trigger("focus").trigger("select");
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    tampilkanToast(result.message || "Gagal menambah bagian.");
                });
            });

            // ===== Simpan perubahan bagian aktif =====
            $("#btnSimpanBagian").on("click", function (e) {
                e.preventDefault();
                if (!activeId) return;

                const it = allItems.find((x) => x.id === activeId);
                if (!it) return;

                const payload = {
                    section: $("#editorJudul").val().trim() || "Tanpa Judul",
                    content: $("#editorContent").html(),
                    status: it.status, // status tidak berubah dari sini, cuma lewat badge toggle
                };

                const $btn = $("#btnSimpanBagian");
                $btn.prop("disabled", true);

                $.ajax({
                    url: `${URL_BASE}/${CATEGORY.key}/${activeId}`,
                    method: "PUT",
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: JSON.stringify(payload),
                }).done(function (result) {
                    const idx = allItems.findIndex((x) => x.id === activeId);
                    if (idx > -1) allItems[idx] = result.data;
                    tampilkanToast(result.message);
                    renderDaftar();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    tampilkanToast(result.message || "Gagal menyimpan bagian.");
                }).always(function () {
                    $btn.prop("disabled", false);
                });
            });

            // ===== Hapus bagian aktif =====
            $("#btnHapusBagian").on("click", function () {
                if (!activeId) return;
                const it = allItems.find((x) => x.id === activeId);
                if (!it) return;
                if (!confirm(`Hapus bagian "${it.section}"?`)) return;

                $.ajax({
                    url: `${URL_BASE}/${CATEGORY.key}/${activeId}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    allItems = allItems.filter((x) => x.id !== activeId);
                    tampilkanToast(result.message);
                    renderDaftar();
                    if (allItems.length > 0) {
                        pilihBagian(allItems[0].id);
                    } else {
                        tampilkanPanelKosong();
                    }
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    tampilkanToast(result.message || "Gagal menghapus bagian.");
                });
            });

            // ===== Pratinjau (read-only) =====
            $("#btnPratinjau").on("click", function () {
                $("#pratinjauJudul").text($("#editorJudul").val() || "(Tanpa judul)");
                $("#pratinjauKonten").html($("#editorContent").html());
                lucide.createIcons();
                $("#modalPratinjau").removeClass("hidden").addClass("flex");
            });
            $("#btnClosePratinjau").on("click", () => $("#modalPratinjau").addClass("hidden").removeClass("flex"));
            $("#modalPratinjau").on("click", function (e) { if (e.target === this) $(this).addClass("hidden").removeClass("flex"); });

            // ===== Import Bagian dari Word (.docx) =====
            const $modalImportModul = $("#modalImportModul");

            $("#btnImportModul").on("click", function () {
                $("#inputJudulImport").val("");
                $("#inputFileImportModul").val("");
                $("#importModulErrorBox").addClass("hidden");
                $modalImportModul.removeClass("hidden").addClass("flex");
            });
            $("#btnCloseImportModul, #btnBatalImportModul").on("click", () => $modalImportModul.addClass("hidden").removeClass("flex"));
            $modalImportModul.on("click", function (e) { if (e.target === this) $(this).addClass("hidden").removeClass("flex"); });

            $("#btnSubmitImportModul").on("click", function () {
                const file = $("#inputFileImportModul")[0].files[0];
                $("#importModulErrorBox").addClass("hidden");

                if (!file) {
                    $("#importModulErrorText").text("Pilih file .docx dulu.");
                    $("#importModulErrorBox").removeClass("hidden");
                    return;
                }

                const formData = new FormData();
                formData.append("judul", $("#inputJudulImport").val().trim());
                formData.append("file", file);

                const $btn = $(this);
                $btn.prop("disabled", true).text("Mengimpor...");

                $.ajax({
                    url: `${URL_BASE}/import`,
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN },
                })
                    .done(function (res) {
                        $modalImportModul.addClass("hidden").removeClass("flex");
                        tampilkanToast(res.message || "Berhasil diimpor.");
                        muatModul();
                    })
                    .fail(function (xhr) {
                        const res = xhr.responseJSON || {};
                        $("#importModulErrorText").text(res.message || "Gagal mengimpor file. Coba lagi.");
                        $("#importModulErrorBox").removeClass("hidden");
                    })
                    .always(function () {
                        $btn.prop("disabled", false).text("Import Sekarang");
                    });
            });

            muatModul();
        });
    </script>
@endpush