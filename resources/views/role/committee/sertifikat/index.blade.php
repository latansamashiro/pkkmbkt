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
            <p class="text-xs text-slate-400 m-0 mt-1">
                Cukup diisi sekali (status Published) — link Google Drive ini akan bisa dibuka oleh <b>semua mahasiswa</b> lewat halaman E-Sertifikat mereka. Pastikan link sudah diatur "Anyone with the link" di Google Drive.
            </p>
        </div>
        <button id="btnTambahSertifikat"
            class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
            <i data-lucide="plus" class="w-4 h-4"></i>Tambah Sertifikat
        </button>
    </div>

    <p id="listLoading" class="text-center text-sm text-slate-400 py-6 hidden">Memuat data...</p>
    <p id="listEmpty" class="hidden text-center text-sm text-slate-400 py-10">Belum ada data sertifikat. Klik "Tambah Sertifikat" untuk menambahkan link Google Drive-nya.</p>

    <div id="listWrap" class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">No</th>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100">Judul</th>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100">Link Google Drive</th>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Status</th>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelSertifikat"></tbody>
            </table>
        </div>
    </div>

    <!-- ===== MODAL TAMBAH / EDIT SERTIFIKAT ===== -->
    <div id="modalForm" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <h3 id="modalFormTitle" class="text-lg font-extrabold text-slate-800 m-0">Tambah Sertifikat</h3>
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

            // ===== Konfigurasi kategori 'sertifikat' dikirim dari DataMasterController =====
            const CATEGORY = @json($categories[0] ?? null);
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            const URL_BASE = "{{ route('committee.sertifikat.index') }}"; // .../panitia/sertifikat

            let allItems = [];
            let editingId = null;

            function forceUpper(el) {
                const s = el.selectionStart, e = el.selectionEnd;
                el.value = el.value.toUpperCase();
                el.setSelectionRange(s, e);
            }
            $(document).on("input", ".js-upper", function () { forceUpper(this); });

            // ===== Ambil data dari server =====
            function muatSertifikat() {
                $("#listLoading").removeClass("hidden");
                $("#listWrap").addClass("hidden");
                $("#listEmpty").addClass("hidden");
                $.get(`${URL_BASE}/${CATEGORY.key}/items`)
                    .done(function (res) {
                        allItems = res.data || [];
                        renderTabel();
                    })
                    .fail(function () {
                        allItems = [];
                        renderTabel();
                        tampilkanToast("Gagal memuat data sertifikat.");
                    })
                    .always(function () {
                        $("#listLoading").addClass("hidden");
                    });
            }

            function renderTabel() {
                if (allItems.length === 0) {
                    $("#listWrap").addClass("hidden");
                    $("#listEmpty").removeClass("hidden");
                    return;
                }
                $("#listEmpty").addClass("hidden");
                $("#listWrap").removeClass("hidden");

                // urutkan id terbesar (terbaru) dulu
                const list = allItems.slice().sort((a, b) => (b.id ?? 0) - (a.id ?? 0));

                const html = list.map((it, idx) => {
                    const isPublished = it.status === "published";
                    const badgeStatus = isPublished
                        ? `<span class="text-[10px] font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2 py-1 rounded-md whitespace-nowrap">Published</span>`
                        : `<span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 bg-slate-100 px-2 py-1 rounded-md whitespace-nowrap">Draft</span>`;
                    const eyeIcon = isPublished ? "eye" : "eye-off";

                    return `
                        <tr class="hover:bg-slate-50">
                            <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200 align-top">${idx + 1}</td>
                            <td class="px-3.5 py-3 text-sm font-semibold text-slate-800 border-b border-slate-200 align-top">${it.title ?? "-"}</td>
                            <td class="px-3.5 py-3 text-sm border-b border-slate-200 align-top max-w-[280px]">
                                <a href="${it.link_gdrive}" target="_blank" rel="noopener" class="text-teal-600 hover:underline break-all">${it.link_gdrive ?? "-"}</a>
                            </td>
                            <td class="px-3.5 py-3 border-b border-slate-200 align-top">${badgeStatus}</td>
                            <td class="px-3.5 py-3 border-b border-slate-200 align-top">
                                <div class="flex items-center gap-1">
                                    <button data-aksi="edit" data-id="${it.id}" aria-label="Edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                    <button data-aksi="publish" data-id="${it.id}" aria-label="Publish/Draft" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="${eyeIcon}" class="w-4 h-4"></i></button>
                                    <button data-aksi="hapus" data-id="${it.id}" aria-label="Hapus" class="w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
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
                $('[data-aksi="hapus"]').off("click").on("click", function () { hapusItem(Number($(this).data("id"))); });
                $('[data-aksi="publish"]').off("click").on("click", function () { togglePublish(Number($(this).data("id"))); });
            }

            // ===== Modal form (dibangun dinamis dari CATEGORY.fields) =====
            const $modalForm = $("#modalForm");
            const $formError = $("#formError");

            function inputHtml(f, value) {
                const id = `field_${f.name}`;
                const req = f.required ? "required" : "";
                const val = value ?? "";

                if (f.type === "select") {
                    const opts = Object.entries(f.options || {}).map(([ov, ol]) =>
                        `<option value="${ov}" ${String(val) === String(ov) ? "selected" : ""}>${ol}</option>`
                    ).join("");
                    return `<select id="${id}" ${req}
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                        <option value="">Pilih ${f.label}</option>${opts}
                        </select>`;
                }
                // "link_gdrive" sengaja TIDAK di-uppercase (js-upper) -- huruf besar/kecil di URL itu penting.
                const upperCls = (f.type === "text" && f.name !== "link_gdrive") ? " js-upper" : "";
                return `<input type="${f.type}" id="${id}" value="${val}" ${req}
                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600${upperCls}" />`;
            }

            function buildFormFields(data) {
                const html = CATEGORY.fields.map((f) => {
                    return `<div>
                        <label for="field_${f.name}" class="block text-xs font-bold text-slate-500 mb-1.5">${f.label}</label>
                        ${inputHtml(f, data ? data[f.name] : "")}
                        </div>`;
                }).join("");
                $("#formFields").html(html);
            }

            // PENTING: field bertipe "select" (mis. Status) HARUS dikirim
            // apa adanya ("published"/"draft"), JANGAN di-uppercase --
            // opsinya di server memang huruf kecil (lihat Rule::in() di
            // DataMasterController). Cuma field teks (title, dll di luar
            // link_gdrive) yang di-uppercase.
            function collectFormValues() {
                const payload = {};
                CATEGORY.fields.forEach((f) => {
                    const $el = $(`#field_${f.name}`);
                    if (f.type === "select") {
                        payload[f.name] = $el.val();
                    } else if (f.name === "link_gdrive") {
                        payload[f.name] = $el.val() || "";
                    } else {
                        payload[f.name] = ($el.val() || "").toUpperCase();
                    }
                });
                return payload;
            }

            function bukaForm(id) {
                editingId = id || null;
                $formError.addClass("hidden");
                const data = id ? allItems.find((x) => x.id === id) : null;
                $("#modalFormTitle").text(id ? "Edit Sertifikat" : "Tambah Sertifikat");
                buildFormFields(data);
                lucide.createIcons();
                $modalForm.removeClass("hidden").addClass("flex");
            }
            function tutupForm() { $modalForm.addClass("hidden").removeClass("flex"); editingId = null; }

            $("#btnTambahSertifikat").on("click", () => bukaForm(null));
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
                    renderTabel();
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

            function togglePublish(id) {
                $.ajax({
                    url: `${URL_BASE}/${CATEGORY.key}/${id}/toggle-publish`,
                    method: "PATCH",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    const idx = allItems.findIndex((x) => x.id === id);
                    if (idx > -1) allItems[idx] = result.data;
                    tampilkanToast(result.message);
                    renderTabel();
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
                    renderTabel();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    tampilkanToast(result.message || "Gagal menghapus data.");
                });
            }

            muatSertifikat();
        });
    </script>
@endpush