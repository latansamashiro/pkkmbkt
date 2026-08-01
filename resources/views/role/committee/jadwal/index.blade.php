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
        <button id="btnTambahJadwal"
            class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
            <i data-lucide="calendar-plus" class="w-4 h-4"></i>Tambah Jadwal
        </button>
    </div>

    <!-- ===== KARTU STATISTIK ===== -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-indigo-50 text-indigo-600 mb-3">
                <i data-lucide="calendar-days" class="w-5 h-5"></i>
            </span>
            <p id="statTotal" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Total Agenda</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-teal-50 text-teal-600 mb-3">
                <i data-lucide="calendar-check" class="w-5 h-5"></i>
            </span>
            <p id="statHariIni" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Agenda Hari Ini</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-rose-50 text-rose-500 mb-3">
                <i data-lucide="star" class="w-5 h-5"></i>
            </span>
            <p id="statPenting" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Ditandai Penting</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-lime-50 text-lime-600 mb-3">
                <i data-lucide="archive-restore" class="w-5 h-5"></i>
            </span>
            <p id="statDraft" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Draft (Belum Publish)</p>
        </div>
    </div>

    <!-- ===== SEARCH & FILTER ===== -->
    <div class="flex items-center gap-3 flex-wrap mb-5">
        <div
            class="flex-1 min-w-[200px] flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-3.5 py-2.5">
            <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
            <input type="text" id="searchJadwal" placeholder="Cari agenda kegiatan..."
                class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
        </div>
        <select id="filterTanggal"
            class="bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 cursor-pointer focus:outline-none">
            <option value="semua">Semua Tanggal</option>
            <option value="hari_ini">Hari Ini</option>
            <option value="besok">Besok</option>
            <option value="minggu_ini">Minggu Ini</option>
            <option value="lewat">Sudah Lewat</option>
        </select>
        <select id="filterStatus"
            class="bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 cursor-pointer focus:outline-none">
            <option value="semua">Semua Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
            <option value="penting">Ditandai Penting</option>
        </select>
    </div>

    <p id="jadwalLoading" class="text-center text-sm text-slate-400 py-6">Memuat data...</p>
    <p id="jadwalEmpty" class="hidden text-center text-sm text-slate-400 py-10">Tidak ada agenda yang cocok.</p>
    <div id="jadwalTimeline" class="flex flex-col gap-6"></div>

    <!-- ===== MODAL TAMBAH / EDIT JADWAL ===== -->
    <div id="modalForm" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <h3 id="modalFormTitle" class="text-lg font-extrabold text-slate-800 m-0">Tambah Jadwal</h3>
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

            // ===== Konfigurasi kategori 'jadwal' dikirim dari DataMasterController =====
            // (route committee.data-master.index membatasi onlyTypes ke ['jadwal'],
            //  jadi $categories cuma berisi satu entri)
            const CATEGORY = @json($categories[0] ?? null);
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            const URL_BASE = "{{ route('committee.data-master.index') }}"; // .../committee/data-master

            let allItems = [];
            let editingId = null;

            const HARI = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            const BULAN = ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AGU", "SEP", "OKT", "NOV", "DES"];

            function todayStr() {
                const d = new Date();
                return d.getFullYear() + "-" + String(d.getMonth() + 1).padStart(2, "0") + "-" + String(d.getDate()).padStart(2, "0");
            }

            function forceUpper(el) {
                const s = el.selectionStart, e = el.selectionEnd;
                el.value = el.value.toUpperCase();
                el.setSelectionRange(s, e);
            }
            $(document).on("input", ".js-upper", function () { forceUpper(this); });

            // ===== Ambil data dari server =====
            function muatJadwal() {
                $("#jadwalLoading").removeClass("hidden");
                $("#jadwalTimeline").addClass("hidden");
                $.get(`${URL_BASE}/${CATEGORY.key}/items`)
                    .done(function (res) {
                        allItems = res.data || [];
                        renderSemua();
                    })
                    .fail(function () {
                        allItems = [];
                        renderSemua();
                        tampilkanToast("Gagal memuat data jadwal.");
                    })
                    .always(function () {
                        $("#jadwalLoading").addClass("hidden");
                        $("#jadwalTimeline").removeClass("hidden");
                    });
            }

            // ===== Statistik =====
            function renderStats() {
                const today = todayStr();
                $("#statTotal").text(allItems.length);
                $("#statHariIni").text(allItems.filter((it) => it.schedule_date === today).length);
                $("#statPenting").text(allItems.filter((it) => !!it.important_flag).length);
                $("#statDraft").text(allItems.filter((it) => it.status === "draft").length);
            }

            // ===== Filter (search + tanggal + status) =====
            function itemsTersaring() {
                const q = $("#searchJadwal").val().trim().toLowerCase();
                const fTgl = $("#filterTanggal").val();
                const fStatus = $("#filterStatus").val();
                const today = todayStr();
                const todayDate = new Date(today);

                return allItems.filter((it) => {
                    if (q && !String(it.title ?? "").toLowerCase().includes(q)) return false;

                    if (fStatus === "published" && it.status !== "published") return false;
                    if (fStatus === "draft" && it.status !== "draft") return false;
                    if (fStatus === "penting" && !it.important_flag) return false;

                    if (fTgl !== "semua" && it.schedule_date) {
                        const d = new Date(it.schedule_date);
                        if (fTgl === "hari_ini" && it.schedule_date !== today) return false;
                        if (fTgl === "besok") {
                            const besok = new Date(todayDate); besok.setDate(besok.getDate() + 1);
                            const besokStr = besok.getFullYear() + "-" + String(besok.getMonth() + 1).padStart(2, "0") + "-" + String(besok.getDate()).padStart(2, "0");
                            if (it.schedule_date !== besokStr) return false;
                        }
                        if (fTgl === "minggu_ini") {
                            const diffDays = Math.round((d - todayDate) / 86400000);
                            if (diffDays < 0 || diffDays > 7) return false;
                        }
                        if (fTgl === "lewat" && d >= todayDate) return false;
                    }
                    return true;
                });
            }

            // ===== Render timeline dikelompokkan per tanggal =====
            function renderSemua() {
                renderStats();
                const items = itemsTersaring();

                if (items.length === 0) {
                    $("#jadwalTimeline").html("");
                    $("#jadwalEmpty").removeClass("hidden");
                    return;
                }
                $("#jadwalEmpty").addClass("hidden");

                // kelompokkan per tanggal
                const grup = {};
                items.forEach((it) => {
                    const key = it.schedule_date || "-";
                    if (!grup[key]) grup[key] = [];
                    grup[key].push(it);
                });

                const tanggalUrut = Object.keys(grup).sort();
                const today = todayStr();

                const html = tanggalUrut.map((tgl) => {
                    const list = grup[tgl].slice().sort((a, b) => String(a.schedule_begin_time).localeCompare(String(b.schedule_begin_time)));
                    const d = new Date(tgl);
                    const isHariIni = tgl === today;
                    const labelHari = isNaN(d) ? "" : HARI[d.getDay()];
                    const noTgl = isNaN(d) ? "-" : String(d.getDate()).padStart(2, "0");
                    const noBulan = isNaN(d) ? "-" : BULAN[d.getMonth()];

                    const itemsHtml = list.map((it) => {
                        const isPenting = !!it.important_flag;
                        const isPublished = it.status === "published";
                        const rowCls = isPenting
                            ? "bg-amber-50/60 border-amber-200"
                            : "bg-white border-slate-200";
                        const dotCls = isPenting ? "bg-rose-500" : "bg-teal-500";

                        const badgePenting = isPenting
                            ? `<span class="text-[10px] font-extrabold uppercase tracking-wider text-rose-600 bg-rose-50 px-2 py-1 rounded-md">Penting</span>`
                            : "";
                        const badgeStatus = isPublished
                            ? `<span class="text-[10px] font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2 py-1 rounded-md">Published</span>`
                            : `<span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 bg-slate-100 px-2 py-1 rounded-md">Draft</span>`;

                        const eyeIcon = isPublished ? "eye" : "eye-off";
                        const jamMulai = String(it.schedule_begin_time ?? "").slice(0, 5);
                        const jamSelesai = String(it.schedule_end_time ?? "").slice(0, 5);

                        return `
                            <div class="relative pl-6">
                                <span class="absolute left-0 top-6 w-2.5 h-2.5 rounded-full ${dotCls}"></span>
                                <div class="flex items-start justify-between gap-3 border ${rowCls} rounded-2xl p-4">
                                    <div class="flex items-start gap-4 min-w-0">
                                        <div class="shrink-0 w-14">
                                            <p class="text-sm font-extrabold text-slate-800 m-0">${jamMulai}</p>
                                            <p class="text-[11px] text-slate-400 m-0">${jamMulai} - ${jamSelesai}</p>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2 flex-wrap mb-1">
                                                <p class="text-sm font-extrabold text-slate-800 m-0">${it.title ?? "-"}</p>
                                                ${badgePenting}
                                                ${badgeStatus}
                                            </div>
                                            <p class="text-xs text-slate-400 m-0 flex items-center gap-1">
                                                <i data-lucide="map-pin" class="w-3.5 h-3.5"></i> ${it.place ?? "-"}
                                            </p>
                                            <p class="text-xs text-slate-400 m-0 flex items-center gap-1 mt-0.5">
                                                <i data-lucide="user" class="w-3.5 h-3.5"></i> PIC: ${it.pic ?? "-"}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1 shrink-0">
                                        <button data-aksi="edit" data-id="${it.id}" aria-label="Edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                        <button data-aksi="penting" data-id="${it.id}" aria-label="Tandai Penting" class="w-8 h-8 flex items-center justify-center rounded-lg ${isPenting ? "text-amber-500" : "text-slate-400"} hover:bg-slate-100"><i data-lucide="star" class="w-4 h-4"></i></button>
                                        <button data-aksi="publish" data-id="${it.id}" aria-label="Publish/Draft" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="${eyeIcon}" class="w-4 h-4"></i></button>
                                        <button data-aksi="hapus" data-id="${it.id}" aria-label="Hapus" class="w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                    </div>
                                </div>
                            </div>`;
                    }).join("");

                    return `
                        <div class="flex gap-4">
                            <div class="shrink-0 w-14 h-14 rounded-2xl flex flex-col items-center justify-center ${isHariIni ? "bg-teal-600 text-white" : "bg-white border border-slate-200 text-slate-800"}">
                                <span class="text-lg font-extrabold leading-none">${noTgl}</span>
                                <span class="text-[10px] font-bold leading-none mt-0.5">${noBulan}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-extrabold text-slate-800 m-0">${isHariIni ? "Hari Ini · " + labelHari : labelHari}</p>
                                <p class="text-xs text-slate-400 m-0 mb-3">${list.length} agenda terjadwal</p>
                                <div class="flex flex-col gap-3 border-l-2 border-dashed border-slate-200 ml-1">
                                    ${itemsHtml}
                                </div>
                            </div>
                        </div>`;
                }).join("");

                $("#jadwalTimeline").html(html);
                lucide.createIcons();
                pasangAksiTombol();
            }

            function pasangAksiTombol() {
                $('[data-aksi="edit"]').off("click").on("click", function () { bukaForm(Number($(this).data("id"))); });
                $('[data-aksi="hapus"]').off("click").on("click", function () { hapusItem(Number($(this).data("id"))); });
                $('[data-aksi="penting"]').off("click").on("click", function () { toggleImportant(Number($(this).data("id"))); });
                $('[data-aksi="publish"]').off("click").on("click", function () { togglePublish(Number($(this).data("id"))); });
            }

            $("#searchJadwal").on("keyup", renderSemua);
            $("#filterTanggal").on("change", renderSemua);
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
                $("#modalFormTitle").text(id ? "Edit Jadwal" : "Tambah Jadwal");
                buildFormFields(data);
                lucide.createIcons();
                $modalForm.removeClass("hidden").addClass("flex");
            }
            function tutupForm() { $modalForm.addClass("hidden").removeClass("flex"); editingId = null; }

            $("#btnTambahJadwal").on("click", () => bukaForm(null));
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

            // ===== Toggle cepat (bintang / mata) — pakai endpoint PATCH khusus, ringan tanpa kirim seluruh field =====
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

            muatJadwal();
        });
    </script>
@endpush