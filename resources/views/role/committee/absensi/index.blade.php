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
                Setiap hari otomatis punya 3 sesi tetap: <b>Sesi 1 (08.00&ndash;10.00)</b>, <b>Sesi 2 (13.00&ndash;15.00)</b>,
                <b>Sesi 3 (16.00&ndash;18.00)</b>. Tinggal masukkan tanggalnya. Sesi yang sudah punya absensi
                yang disubmit mentor tidak bisa diubah/dihapus lagi &mdash; datanya jadi arsip.
            </p>
        </div>
        <button id="btnTambahHari"
            class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
            <i data-lucide="calendar-plus" class="w-4 h-4"></i>Tambah Hari
        </button>
    </div>

    <p id="sesiLoading" class="text-center text-sm text-slate-400 py-6">Memuat data...</p>

    <div id="sesiTableWrap" class="hidden bg-white border border-slate-200 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="text-left text-[11px] font-bold uppercase tracking-wide text-slate-400 px-4 py-3">Hari / Sesi</th>
                        <th class="text-left text-[11px] font-bold uppercase tracking-wide text-slate-400 px-4 py-3">Jam</th>
                        <th class="text-left text-[11px] font-bold uppercase tracking-wide text-slate-400 px-4 py-3">Status</th>
                        <th class="text-right text-[11px] font-bold uppercase tracking-wide text-slate-400 px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelSesi"></tbody>
            </table>
        </div>
        <p id="sesiEmpty" class="hidden text-center text-sm text-slate-400 py-10">Belum ada sesi absensi dibuat.</p>
    </div>

    <!-- ===== MODAL TAMBAH HARI (otomatis buat 3 sesi fixed) ===== -->
    <div id="modalTambahHari" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-sm p-6">
            <div class="flex items-start justify-between gap-4 mb-2">
                <h3 class="text-lg font-extrabold text-slate-800 m-0">Tambah Hari</h3>
                <button id="btnCloseTambahHari" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <p class="text-xs text-slate-400 mb-4">
                3 sesi (08.00&ndash;10.00, 13.00&ndash;15.00, 16.00&ndash;18.00) otomatis dibuat untuk tanggal ini.
            </p>
            <form id="formTambahHari">
                <p id="tambahHariError"
                    class="hidden text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg px-3 py-2 mb-3"></p>
                <label for="inputTanggalHari" class="block text-xs font-bold text-slate-500 mb-1.5">Tanggal</label>
                <input type="date" id="inputTanggalHari" required
                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                <div class="flex items-center justify-end gap-3 mt-6">
                    <button type="button" id="btnBatalTambahHari"
                        class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                    <button type="submit" id="btnSimpanTambahHari"
                        class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MODAL EDIT SESI (satu sesi, kalau perlu diubah manual) ===== -->
    <div id="modalForm" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <h3 id="modalFormTitle" class="text-lg font-extrabold text-slate-800 m-0">Edit Sesi</h3>
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
            // Route committee.absensi.index membatasi onlyTypes ke ['jadwal_absensi'],
            // jadi $categories cuma berisi satu entri.
            const CATEGORY = @json($categories[0] ?? null);
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            const URL_BASE = "{{ route('committee.absensi.index') }}";

            let allItems = [];
            let editingId = null;

            function muatSesi() {
                $("#sesiLoading").removeClass("hidden");
                $("#sesiTableWrap").addClass("hidden");
                $.get(`${URL_BASE}/${CATEGORY.key}/items`)
                    .done(function (res) {
                        allItems = res.data || [];
                        renderTabel();
                    })
                    .fail(function () {
                        allItems = [];
                        renderTabel();
                        tampilkanToast("Gagal memuat data jadwal absensi.");
                    })
                    .always(function () {
                        $("#sesiLoading").addClass("hidden");
                        $("#sesiTableWrap").removeClass("hidden");
                    });
            }

            function statusSesi(it) {
                const now = new Date();
                const mulai = new Date(`${it.attendance_date}T${it.time_begin}`);
                const selesai = new Date(`${it.attendance_date}T${it.time_end}`);
                if (now < mulai) return { label: "Belum Dibuka", cls: "bg-slate-100 text-slate-500" };
                if (now > selesai) return { label: "Sudah Lewat", cls: "bg-slate-100 text-slate-500" };
                return { label: "Sedang Berlangsung", cls: "bg-teal-50 text-teal-600" };
            }

            function renderTabel() {
                const items = allItems.slice().sort((a, b) =>
                    String(a.attendance_date + a.time_begin).localeCompare(b.attendance_date + b.time_begin)
                );
                $("#sesiEmpty").toggleClass("hidden", items.length > 0);

                // kelompokkan per (tanggal) — satu hari = satu grup, isinya 3 sesi
                const grup = {};
                items.forEach((it) => {
                    (grup[it.attendance_date] = grup[it.attendance_date] || []).push(it);
                });

                const $tbody = $("#tabelSesi").empty();

                Object.keys(grup).sort().forEach((tanggal) => {
                    const sesiHari = grup[tanggal];
                    const dayName = sesiHari[0].day_name;
                    const tanggalLabel = new Date(tanggal + "T00:00:00").toLocaleDateString("id-ID", { day: "numeric", month: "long", year: "numeric" });
                    const groupKey = tanggal;
                    const terbuka = localStorage.getItem("jadwalAbsensiHari:" + groupKey) === "buka";

                    $tbody.append(`
                        <tr class="hari-header cursor-pointer hover:bg-slate-50 border-b border-slate-100" data-day="${groupKey}">
                            <td class="px-4 py-3" colspan="3">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400 chevron-hari ${terbuka ? 'rotate-90' : ''}" style="transition:transform .15s"></i>
                                    <span class="text-sm font-bold text-slate-800">${dayName}</span>
                                    <span class="text-xs text-slate-400">${tanggalLabel}</span>
                                    <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500">${sesiHari.length} sesi</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <button data-aksi="hapus-hari" data-tanggal="${groupKey}" aria-label="Hapus semua sesi hari ini" class="w-8 h-8 inline-flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                    `);

                    sesiHari.forEach((it) => {
                        const st = statusSesi(it);
                        $tbody.append(`
                            <tr class="sesi-row border-b border-slate-100 last:border-0 ${terbuka ? '' : 'hidden'}" data-day-of="${groupKey}">
                                <td class="px-4 py-2.5 pl-11 text-sm text-slate-700">${it.session_name}</td>
                                <td class="px-4 py-2.5 text-sm text-slate-500">${String(it.time_begin).slice(0,5)} - ${String(it.time_end).slice(0,5)}</td>
                                <td class="px-4 py-2.5"><span class="text-[11px] font-bold px-2.5 py-1 rounded-full ${st.cls}">${st.label}</span></td>
                                <td class="px-4 py-2.5 text-right whitespace-nowrap">
                                    <button data-aksi="edit" data-id="${it.id}" aria-label="Edit" class="w-8 h-8 inline-flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                    <button data-aksi="hapus" data-id="${it.id}" aria-label="Hapus" class="w-8 h-8 inline-flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                </td>
                            </tr>
                        `);
                    });
                });

                lucide.createIcons();
                pasangAksiTombol();
            }

            function pasangAksiTombol() {
                $(".hari-header").off("click").on("click", function (e) {
                    if ($(e.target).closest('[data-aksi="hapus-hari"]').length) return; // jangan buka/tutup kalau yang diklik tombol hapus
                    const day = $(this).data("day");
                    const $rows = $(`.sesi-row[data-day-of="${day}"]`);
                    const $chevron = $(this).find(".chevron-hari");
                    const akanBuka = $rows.first().hasClass("hidden");

                    $rows.toggleClass("hidden", !akanBuka);
                    $chevron.toggleClass("rotate-90", akanBuka);
                    localStorage.setItem("jadwalAbsensiHari:" + day, akanBuka ? "buka" : "tutup");
                });
                $('[data-aksi="edit"]').off("click").on("click", function (e) { e.stopPropagation(); bukaForm(Number($(this).data("id"))); });
                $('[data-aksi="hapus"]').off("click").on("click", function (e) { e.stopPropagation(); hapusItem(Number($(this).data("id"))); });
                $('[data-aksi="hapus-hari"]').off("click").on("click", function (e) { e.stopPropagation(); hapusSatuHari($(this).data("tanggal")); });
            }

            function hapusSatuHari(tanggal) {
                const sesiHari = allItems.filter((x) => x.attendance_date === tanggal);
                if (!sesiHari.length) return;
                if (!confirm(`Hapus semua sesi (${sesiHari.length} sesi) di tanggal ${tanggal}? Sesi yang sudah punya data absensi tidak akan terhapus.`)) return;

                let sisa = sesiHari.length;
                let adaGagal = false;
                sesiHari.forEach((it) => {
                    $.ajax({
                        url: `${URL_BASE}/${CATEGORY.key}/${it.id}`,
                        method: "DELETE",
                        headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    }).done(function () {
                        allItems = allItems.filter((x) => x.id !== it.id);
                    }).fail(function () {
                        adaGagal = true;
                    }).always(function () {
                        sisa--;
                        if (sisa === 0) {
                            renderTabel();
                            tampilkanToast(adaGagal ? "Sebagian sesi terhapus, sebagian lagi gagal (sudah punya data absensi)." : "Semua sesi di hari itu berhasil dihapus.");
                        }
                    });
                });
            }

            // ===== Modal form (dibangun dinamis dari CATEGORY.fields) =====
            const $modalForm = $("#modalForm");
            const $formError = $("#formError");

            function inputHtml(f, value) {
                const id = `field_${f.name}`;
                const req = f.required ? "required" : "";
                const val = value ?? "";

                if (f.type === "select") {
                    const opsi = Object.entries(f.options || {})
                        .map(([k, label]) => `<option value="${k}" ${String(val) === String(k) ? "selected" : ""}>${label}</option>`)
                        .join("");
                    return `<select id="${id}" ${req}
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                        <option value="">Pilih...</option>${opsi}
                    </select>`;
                }

                return `<input type="${f.type}" id="${id}" value="${val}" ${req}
                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />`;
            }

            function buildFormFields(data) {
                const html = CATEGORY.fields.map((f) => `
                    <div>
                        <label for="field_${f.name}" class="block text-xs font-bold text-slate-500 mb-1.5">${f.label}</label>
                        ${inputHtml(f, data ? data[f.name] : "")}
                    </div>
                `).join("");
                $("#formFields").html(html);
            }

            function collectFormValues() {
                const payload = {};
                CATEGORY.fields.forEach((f) => {
                    payload[f.name] = $(`#field_${f.name}`).val();
                });
                return payload;
            }

            function bukaForm(id) {
                editingId = id || null;
                $formError.addClass("hidden");
                const data = id ? allItems.find((x) => x.id === id) : null;
                $("#modalFormTitle").text(id ? "Edit Sesi" : "Tambah Sesi");
                buildFormFields(data);
                lucide.createIcons();
                $modalForm.removeClass("hidden").addClass("flex");
            }
            function tutupForm() { $modalForm.addClass("hidden").removeClass("flex"); editingId = null; }

            // ===== Modal Tambah Hari (bikin 3 sesi fixed sekaligus) =====
            const $modalHari = $("#modalTambahHari");
            const $hariError = $("#tambahHariError");

            function bukaTambahHari() {
                $hariError.addClass("hidden");
                $("#inputTanggalHari").val("");
                $modalHari.removeClass("hidden").addClass("flex");
            }
            function tutupTambahHari() { $modalHari.addClass("hidden").removeClass("flex"); }

            $("#btnTambahHari").on("click", bukaTambahHari);
            $("#btnCloseTambahHari").on("click", tutupTambahHari);
            $("#btnBatalTambahHari").on("click", tutupTambahHari);
            $modalHari.on("click", function (e) { if (e.target === this) tutupTambahHari(); });

            $("#formTambahHari").on("submit", function (e) {
                e.preventDefault();
                $hariError.addClass("hidden");
                const tanggal = $("#inputTanggalHari").val();
                if (!tanggal) return;

                const $btn = $("#btnSimpanTambahHari");
                $btn.prop("disabled", true);

                $.ajax({
                    url: `{{ route('committee.absensi.store-hari') }}`,
                    method: "POST",
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: JSON.stringify({ attendance_date: tanggal }),
                }).done(function (result) {
                    allItems.push(...result.data);
                    tampilkanToast(result.message);
                    tutupTambahHari();
                    renderTabel();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    $hariError.text(result.message || "Terjadi kesalahan, silakan coba lagi.").removeClass("hidden");
                }).always(function () {
                    $btn.prop("disabled", false);
                });
            });
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

            function hapusItem(id) {
                const it = allItems.find((x) => x.id === id);
                if (!it) return;
                if (!confirm(`Hapus sesi "${it.session_name}" (${it.day_name})?`)) return;

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
                    tampilkanToast(result.message || "Gagal menghapus data. Kemungkinan sesi ini sudah punya data absensi.");
                });
            }

            muatSesi();
        });
    </script>
@endpush
