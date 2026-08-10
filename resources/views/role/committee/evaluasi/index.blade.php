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
        <div class="flex items-center gap-2">
            <button id="btnKelolaKategori" type="button"
                class="inline-flex items-center gap-2 border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">
                <i data-lucide="folder-cog" class="w-4 h-4"></i>Kelola Kategori
            </button>
            <button id="btnTambahPaket"
                class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
                <i data-lucide="plus" class="w-4 h-4"></i>Tambah Paket Evaluasi
            </button>
        </div>
    </div>

    <!-- ===== KARTU STATISTIK ===== -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-indigo-50 text-indigo-600 mb-3">
                <i data-lucide="clipboard-list" class="w-5 h-5"></i>
            </span>
            <p id="statPaket" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Paket Evaluasi</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-teal-50 text-teal-600 mb-3">
                <i data-lucide="circle-help" class="w-5 h-5"></i>
            </span>
            <p id="statTotalSoal" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Total Soal</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-lime-50 text-lime-600 mb-3">
                <i data-lucide="list-checks" class="w-5 h-5"></i>
            </span>
            <p id="statRataSoal" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Rata-rata Soal / Paket</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <span class="w-11 h-11 rounded-xl flex items-center justify-center bg-rose-50 text-rose-500 mb-3">
                <i data-lucide="target" class="w-5 h-5"></i>
            </span>
            <p id="statRataPassing" class="text-2xl font-extrabold text-slate-800 m-0">0</p>
            <p class="text-xs text-slate-400 m-0">Rata-rata Passing Score</p>
        </div>
    </div>

    <p class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-3">Paket Evaluasi</p>
    <p id="paketLoading" class="text-center text-sm text-slate-400 py-6">Memuat data...</p>
    <div id="paketGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6"></div>

    <!-- ===== PANEL BANK SOAL ===== -->
    <div id="panelSoal" class="hidden bg-white border border-slate-200 rounded-2xl">
        <div class="flex items-center justify-between gap-3 p-5 flex-wrap border-b border-slate-100">
            <div>
                <p id="soalPanelJudul" class="text-lg font-extrabold text-slate-800 m-0">Bank Soal</p>
                <p id="soalPanelSub" class="text-xs text-slate-400 m-0 mt-0.5">-</p>
            </div>
            <div class="flex items-center gap-2">
                <button id="btnImportSoal"
                    class="inline-flex items-center gap-2 bg-white border border-teal-600 hover:bg-teal-50 text-teal-600 font-bold text-sm px-4 py-2.5 rounded-xl transition">
                    <i data-lucide="upload" class="w-4 h-4"></i>Import Soal
                </button>
                <button id="btnTambahSoal"
                    class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
                    <i data-lucide="plus" class="w-4 h-4"></i>Tambah Soal
                </button>
            </div>
        </div>
        <p id="soalLoading" class="text-center text-sm text-slate-400 py-6">Memuat soal...</p>
        <p id="soalEmpty" class="hidden text-center text-sm text-slate-400 py-8">Belum ada soal di paket ini.</p>
        <div id="daftarSoal" class="divide-y divide-slate-100"></div>
    </div>
    <p id="panelSoalKosong" class="text-center text-sm text-slate-400 py-10 bg-white border border-dashed border-slate-200 rounded-2xl">
        Pilih salah satu Paket Evaluasi di atas untuk kelola soalnya.
    </p>

    <!-- ===== MODAL IMPORT SOAL ===== -->
    <div id="modalImportSoal" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <div>
                    <h3 class="text-lg font-extrabold text-slate-800 m-0">Import Soal</h3>
                    <p class="text-xs text-slate-400 m-0 mt-1">Tempel teks langsung, atau upload file Word (.docx) dengan format yang sama. Diimpor ke paket yang lagi dipilih: <strong id="importPaketNama">-</strong>.</p>
                </div>
                <button id="btnCloseImportSoal" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-4">
                <p class="text-xs font-bold text-slate-600 mb-2">Format tiap soal (pisahkan antar-soal dengan baris <code>---</code>):</p>
                <pre class="text-[11.5px] text-slate-500 whitespace-pre-wrap leading-[1.6] m-0">Pertanyaan: Apa ibu kota Indonesia?
A) Bandung
B) Jakarta
C) Surabaya
D) Medan
Kunci: B
Bobot: 10
---
Pertanyaan: 2 + 2 = ?
A) 3
B) 4
C) 5
D) 6
Kunci: B
Bobot: 5</pre>
            </div>

            <div class="flex items-center gap-2 mb-4 bg-slate-100 rounded-xl p-1 w-fit">
                <button type="button" data-sumber="teks" class="tab-sumber-soal px-4 py-2 rounded-lg text-sm font-bold transition">Tempel Teks</button>
                <button type="button" data-sumber="docx" class="tab-sumber-soal px-4 py-2 rounded-lg text-sm font-bold transition">Upload Word (.docx)</button>
            </div>

            <div id="panelTeksSoal">
                <textarea id="inputTeksSoal" rows="10" placeholder="Tempel teks soal sesuai format di atas..."
                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 font-mono focus:outline-none focus:border-teal-600"></textarea>
            </div>
            <div id="panelDocxSoal" class="hidden">
                <input type="file" id="inputFileSoal" accept=".docx"
                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600" />
                <p class="text-xs text-slate-400 mt-2">File Word (.docx) yang isinya teks soal dengan format sama seperti contoh di atas.</p>
            </div>

            <div id="importSoalErrorBox" class="hidden mt-4 bg-rose-50 border border-rose-100 rounded-xl p-4">
                <p class="text-xs font-bold text-rose-600 mb-2" id="importSoalErrorTitle"></p>
                <ul id="importSoalErrorList" class="text-xs text-rose-600 pl-4 list-disc space-y-1"></ul>
            </div>

            <div class="flex items-center justify-end gap-3 mt-6">
                <button type="button" id="btnBatalImportSoal" class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                <button type="button" id="btnSubmitImportSoal" class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">Import Sekarang</button>
            </div>
        </div>
    </div>

    <!-- ===== MODAL KELOLA KATEGORI (daftar + form tambah/edit jadi satu) ===== -->
    <div id="modalKategori" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-4">
                <h3 class="text-lg font-extrabold text-slate-800 m-0">Kelola Kategori Evaluasi</h3>
                <button id="btnCloseKategori" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <p id="kategoriModalLoading" class="text-xs text-slate-400 mb-2">Memuat...</p>
            <div id="daftarKategoriModal" class="border border-slate-200 rounded-xl divide-y divide-slate-100 mb-4 overflow-hidden"></div>
            <p id="kategoriModalEmpty" class="hidden text-xs text-slate-400 mb-4">Belum ada kategori evaluasi.</p>

            <p id="formKategoriMode" class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-2">Tambah Kategori Baru</p>
            <form id="formKategori">
                <p id="formKategoriError"
                    class="hidden text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg px-3 py-2 mb-3">
                </p>
                <div id="formKategoriFields" class="grid grid-cols-1 gap-4"></div>
                <div class="flex items-center justify-end gap-3 mt-4">
                    <button type="button" id="btnBatalEditKategori"
                        class="hidden border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal Edit</button>
                    <button type="submit" id="btnSimpanKategori"
                        class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MODAL TAMBAH / EDIT PAKET ===== -->
    <div id="modalPaket" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <h3 id="modalPaketTitle" class="text-lg font-extrabold text-slate-800 m-0">Tambah Paket Evaluasi</h3>
                <button id="btnClosePaket" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form id="formPaket">
                <p id="formPaketError"
                    class="hidden text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg px-3 py-2 mb-3">
                </p>
                <div id="formPaketFields" class="grid grid-cols-1 gap-4"></div>
                <div class="flex items-center justify-end gap-3 mt-6">
                    <button type="button" id="btnBatalPaket"
                        class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                    <button type="submit" id="btnSimpanPaket"
                        class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MODAL TAMBAH / EDIT SOAL ===== -->
    <div id="modalSoal" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <h3 id="modalSoalTitle" class="text-lg font-extrabold text-slate-800 m-0">Tambah Soal</h3>
                <button id="btnCloseSoal" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form id="formSoal">
                <p id="formSoalError"
                    class="hidden text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg px-3 py-2 mb-3">
                </p>
                <div id="formSoalFields" class="grid grid-cols-1 gap-4"></div>
                <div class="flex items-center justify-end gap-3 mt-6">
                    <button type="button" id="btnBatalSoal"
                        class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                    <button type="submit" id="btnSimpanSoal"
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

            // ===== Konfigurasi tipe 'ujian' & 'soal' dikirim dari DataMasterController =====
            const CATEGORIES = @json($categories ?? []);
            const CATEGORY_PAKET = CATEGORIES.find((c) => c.key === "ujian");
            const CATEGORY_SOAL = CATEGORIES.find((c) => c.key === "soal");
            const CATEGORY_KATEGORI = CATEGORIES.find((c) => c.key === "kategori_evaluasi");
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            const URL_BASE = "{{ route('committee.evaluasi.index') }}"; // .../committee/evaluasi

            let allPaket = [];
            let allSoal = [];
            let allKategori = [];
            let editingPaketId = null;
            let editingSoalId = null;
            let editingKategoriId = null;
            let activeExamId = null;

            function forceUpper(el) {
                const s = el.selectionStart, e = el.selectionEnd;
                el.value = el.value.toUpperCase();
                el.setSelectionRange(s, e);
            }
            $(document).on("input", ".js-upper", function () { forceUpper(this); });

            // Ikon & warna kartu paket — dicocokkan dari nama kategori (title), fallback slate kalau tidak dikenali
            const PAKET_TAMPILAN = {
                "keuangan": { icon: "wallet", bg: "bg-orange-500" },
                "akademik": { icon: "graduation-cap", bg: "bg-sky-600" },
                "kemahasiswaan": { icon: "users", bg: "bg-purple-600" },
                "darurat": { icon: "siren", bg: "bg-rose-600" },
            };
            const PAKET_TAMPILAN_DEFAULT = { icon: "clipboard-list", bg: "bg-slate-500" };

            // ===================== KATEGORI EVALUASI =====================

            function muatKategori(callback) {
                $("#kategoriModalLoading").removeClass("hidden");
                $.get(`${URL_BASE}/${CATEGORY_KATEGORI.key}/items`)
                    .done(function (res) {
                        allKategori = (res.data || []).slice().sort((a, b) => Number(a.urutan || 0) - Number(b.urutan || 0));
                        renderKategori();
                        sinkronOptionsKategoriKePaket();
                        if (callback) callback();
                    })
                    .fail(function () {
                        allKategori = [];
                        renderKategori();
                        tampilkanToast("Gagal memuat kategori evaluasi.");
                    })
                    .always(function () {
                        $("#kategoriModalLoading").addClass("hidden");
                    });
            }

            function sinkronOptionsKategoriKePaket() {
                const fTitle = (CATEGORY_PAKET.fields || []).find((f) => f.name === "title");
                if (!fTitle) return;
                const options = {};
                allKategori.forEach((k) => { options[k.name] = `EVALUASI ${k.name}`; });
                fTitle.options = options;
            }

            function renderKategori() {
                if (allKategori.length === 0) {
                    $("#daftarKategoriModal").html("");
                    $("#kategoriModalEmpty").removeClass("hidden");
                    return;
                }
                $("#kategoriModalEmpty").addClass("hidden");

                const html = allKategori.map((k) => `
                    <div class="flex items-center justify-between gap-3 px-4 py-2.5">
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-slate-800 m-0 truncate">${k.name}</p>
                            <p class="text-[11px] text-slate-400 m-0">Urutan ${k.urutan}</p>
                        </div>
                        <div class="flex items-center gap-1 shrink-0">
                            <button type="button" data-aksi="edit-kategori" data-id="${k.id}" aria-label="Edit" class="w-7 h-7 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="pencil" class="w-3.5 h-3.5"></i></button>
                            <button type="button" data-aksi="hapus-kategori" data-id="${k.id}" aria-label="Hapus" class="w-7 h-7 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                        </div>
                    </div>`).join("");
                $("#daftarKategoriModal").html(html);
                lucide.createIcons();

                $('[data-aksi="edit-kategori"]').off("click").on("click", function () { masukModeEditKategori(Number($(this).data("id"))); });
                $('[data-aksi="hapus-kategori"]').off("click").on("click", function () { hapusKategori(Number($(this).data("id"))); });
            }

            const $modalKategori = $("#modalKategori");
            const $formKategoriError = $("#formKategoriError");

            function bukaModalKategori() {
                keluarModeEditKategori();
                $modalKategori.removeClass("hidden").addClass("flex");
                muatKategori();
            }
            function tutupModalKategori() { $modalKategori.addClass("hidden").removeClass("flex"); keluarModeEditKategori(); }

            function masukModeEditKategori(id) {
                editingKategoriId = id;
                $formKategoriError.addClass("hidden");
                const data = allKategori.find((x) => x.id === id);
                $("#formKategoriMode").text(`Edit Kategori: ${data ? data.name : ""}`);
                buildFormFields("#formKategoriFields", CATEGORY_KATEGORI.fields, data);
                $("#btnSimpanKategori").text("Simpan Perubahan");
                $("#btnBatalEditKategori").removeClass("hidden");
                lucide.createIcons();
            }
            function keluarModeEditKategori() {
                editingKategoriId = null;
                $formKategoriError.addClass("hidden");
                $("#formKategoriMode").text("Tambah Kategori Baru");
                buildFormFields("#formKategoriFields", CATEGORY_KATEGORI.fields, null);
                $("#btnSimpanKategori").text("Tambah");
                $("#btnBatalEditKategori").addClass("hidden");
                lucide.createIcons();
            }

            $("#btnKelolaKategori").on("click", bukaModalKategori);
            $("#btnCloseKategori").on("click", tutupModalKategori);
            $("#btnBatalEditKategori").on("click", keluarModeEditKategori);
            $modalKategori.on("click", function (e) { if (e.target === this) tutupModalKategori(); });

            $("#formKategori").on("submit", function (e) {
                e.preventDefault();
                $formKategoriError.addClass("hidden");
                const payload = collectFormValues(CATEGORY_KATEGORI.fields);
                const $btn = $("#btnSimpanKategori");
                $btn.prop("disabled", true);

                const url = editingKategoriId ? `${URL_BASE}/${CATEGORY_KATEGORI.key}/${editingKategoriId}` : `${URL_BASE}/${CATEGORY_KATEGORI.key}`;
                const method = editingKategoriId ? "PUT" : "POST";

                $.ajax({
                    url, method,
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: JSON.stringify(payload),
                }).done(function (result) {
                    tampilkanToast(result.message);
                    keluarModeEditKategori();
                    muatKategori();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    $formKategoriError.text(result.errors ? Object.values(result.errors).flat().join(" ") : (result.message || "Terjadi kesalahan."));
                    $formKategoriError.removeClass("hidden");
                }).always(function () { $btn.prop("disabled", false); });
            });

            function hapusKategori(id) {
                const k = allKategori.find((x) => x.id === id);
                if (!k) return;
                if (!confirm(`Hapus kategori "${k.name}"? Paket evaluasi yang sudah pakai nama kategori ini tidak ikut berubah/terhapus.`)) return;

                $.ajax({
                    url: `${URL_BASE}/${CATEGORY_KATEGORI.key}/${id}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    tampilkanToast(result.message);
                    if (editingKategoriId === id) keluarModeEditKategori();
                    muatKategori();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    tampilkanToast(result.message || "Gagal menghapus kategori.");
                });
            }

            // ===================== PAKET EVALUASI =====================

            function muatPaket() {
                $("#paketLoading").removeClass("hidden");
                $("#paketGrid").addClass("hidden");
                $.get(`${URL_BASE}/${CATEGORY_PAKET.key}/items`)
                    .done(function (res) {
                        allPaket = res.data || [];
                        renderStatsPaket();
                        renderGridPaket();
                    })
                    .fail(function () {
                        allPaket = [];
                        renderStatsPaket();
                        renderGridPaket();
                        tampilkanToast("Gagal memuat paket evaluasi.");
                    })
                    .always(function () {
                        $("#paketLoading").addClass("hidden");
                        $("#paketGrid").removeClass("hidden");
                    });
            }

            function renderStatsPaket() {
                $("#statPaket").text(allPaket.length);
                const totalSoalGlobal = (CATEGORY_SOAL && CATEGORY_SOAL.total) || 0;
                $("#statTotalSoal").text(totalSoalGlobal);
                $("#statRataSoal").text(allPaket.length ? Math.round(totalSoalGlobal / allPaket.length) : 0);
                const rataPassing = allPaket.length
                    ? Math.round(allPaket.reduce((sum, p) => sum + Number(p.passing_grade || 0), 0) / allPaket.length)
                    : 0;
                $("#statRataPassing").text(rataPassing);
            }

            function renderGridPaket() {
                if (allPaket.length === 0) {
                    $("#paketGrid").html(`<p class="col-span-full text-center text-sm text-slate-400 py-6">Belum ada paket evaluasi.</p>`);
                    return;
                }

                const html = allPaket.map((p) => {
                    const tampilan = PAKET_TAMPILAN[String(p.title ?? "").toLowerCase()] || PAKET_TAMPILAN_DEFAULT;
                    const aktif = p.id === activeExamId;
                    const cardBorder = aktif ? "border-teal-500 ring-1 ring-teal-500" : "border-slate-200";

                    return `
                        <div data-id="${p.id}" class="paket-card border ${cardBorder} rounded-2xl p-5 bg-white">
                            <div class="flex items-center justify-between mb-4">
                                <span class="w-12 h-12 rounded-xl flex items-center justify-center ${tampilan.bg} text-white">
                                    <i data-lucide="${tampilan.icon}" class="w-5 h-5"></i>
                                </span>
                            </div>
                            <p class="text-sm font-extrabold text-slate-800 m-0 mb-3 uppercase">Evaluasi ${p.title ?? "-"}</p>
                            <div class="flex items-center gap-6 mb-3">
                                <div>
                                    <p class="text-lg font-extrabold text-slate-800 m-0">${p.max_question ?? 0}</p>
                                    <p class="text-[11px] text-slate-400 m-0">Soal</p>
                                </div>
                                <div>
                                    <p class="text-lg font-extrabold text-slate-800 m-0">${p.passing_grade ?? 0}</p>
                                    <p class="text-[11px] text-slate-400 m-0">Passing</p>
                                </div>
                            </div>
                            <div class="pt-3 border-t border-slate-100 flex items-center gap-2">
                                <button type="button" data-aksi="kelola-soal" data-id="${p.id}"
                                    class="flex-1 inline-flex items-center justify-center gap-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs px-3 py-2 rounded-lg transition">
                                    <i data-lucide="list-checks" class="w-3.5 h-3.5"></i> Kelola Soal
                                </button>
                                <button type="button" data-aksi="edit-paket" data-id="${p.id}" aria-label="Edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                <button type="button" data-aksi="hapus-paket" data-id="${p.id}" aria-label="Hapus" class="w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </div>
                        </div>`;
                }).join("");

                $("#paketGrid").html(html);
                lucide.createIcons();

                $('[data-aksi="kelola-soal"]').off("click").on("click", function () { pilihPaket(Number($(this).data("id"))); });
                $('[data-aksi="edit-paket"]').off("click").on("click", function (e) { e.stopPropagation(); bukaFormPaket(Number($(this).data("id"))); });
                $('[data-aksi="hapus-paket"]').off("click").on("click", function (e) { e.stopPropagation(); hapusPaket(Number($(this).data("id"))); });
            }

            function pilihPaket(examId) {
                activeExamId = examId;
                renderGridPaket();
                $("#panelSoalKosong").addClass("hidden");
                $("#panelSoal").removeClass("hidden");
                const p = allPaket.find((x) => x.id === examId);
                $("#soalPanelJudul").text(`Bank Soal — Evaluasi ${p ? p.title : ""}`);
                $("#soalPanelSub").text(p ? `${p.max_question} soal · Passing score ${p.passing_grade}` : "");
                muatSoal();
            }

            // ----- Modal Tambah/Edit Paket -----
            const $modalPaket = $("#modalPaket");
            const $formPaketError = $("#formPaketError");

            function bukaFormPaket(id) {
                editingPaketId = id || null;
                $formPaketError.addClass("hidden");
                const data = id ? allPaket.find((x) => x.id === id) : null;
                $("#modalPaketTitle").text(id ? "Edit Paket Evaluasi" : "Tambah Paket Evaluasi");
                buildFormFields("#formPaketFields", CATEGORY_PAKET.fields, data);
                lucide.createIcons();
                $modalPaket.removeClass("hidden").addClass("flex");
            }
            function tutupFormPaket() { $modalPaket.addClass("hidden").removeClass("flex"); editingPaketId = null; }

            $("#btnTambahPaket").on("click", () => bukaFormPaket(null));
            $("#btnClosePaket").on("click", tutupFormPaket);
            $("#btnBatalPaket").on("click", tutupFormPaket);
            $modalPaket.on("click", function (e) { if (e.target === this) tutupFormPaket(); });

            $("#formPaket").on("submit", function (e) {
                e.preventDefault();
                $formPaketError.addClass("hidden");
                const payload = collectFormValues(CATEGORY_PAKET.fields);
                const $btn = $("#btnSimpanPaket");
                $btn.prop("disabled", true);

                const url = editingPaketId ? `${URL_BASE}/${CATEGORY_PAKET.key}/${editingPaketId}` : `${URL_BASE}/${CATEGORY_PAKET.key}`;
                const method = editingPaketId ? "PUT" : "POST";

                $.ajax({
                    url, method,
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: JSON.stringify(payload),
                }).done(function (result) {
                    if (editingPaketId) {
                        const idx = allPaket.findIndex((x) => x.id === editingPaketId);
                        if (idx > -1) allPaket[idx] = result.data;
                    } else {
                        allPaket.push(result.data);
                    }
                    tampilkanToast(result.message);
                    tutupFormPaket();
                    renderStatsPaket();
                    renderGridPaket();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    $formPaketError.text(result.errors ? Object.values(result.errors).flat().join(" ") : (result.message || "Terjadi kesalahan."));
                    $formPaketError.removeClass("hidden");
                }).always(function () { $btn.prop("disabled", false); });
            });

            function hapusPaket(id) {
                const p = allPaket.find((x) => x.id === id);
                if (!p) return;
                if (!confirm(`Hapus paket "Evaluasi ${p.title}"? Semua soal di dalamnya juga ikut terhapus kalau relasinya cascade.`)) return;

                $.ajax({
                    url: `${URL_BASE}/${CATEGORY_PAKET.key}/${id}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    allPaket = allPaket.filter((x) => x.id !== id);
                    tampilkanToast(result.message);
                    renderStatsPaket();
                    renderGridPaket();
                    if (activeExamId === id) {
                        activeExamId = null;
                        $("#panelSoal").addClass("hidden");
                        $("#panelSoalKosong").removeClass("hidden");
                    }
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    tampilkanToast(result.message || "Gagal menghapus paket.");
                });
            }

            // ===================== BANK SOAL =====================

            function muatSoal() {
                if (!activeExamId) return;
                $("#soalLoading").removeClass("hidden");
                $("#daftarSoal").addClass("hidden");
                $.get(`${URL_BASE}/${CATEGORY_SOAL.key}/items`, { exam_id: activeExamId })
                    .done(function (res) {
                        allSoal = res.data || [];
                        renderDaftarSoal();
                    })
                    .fail(function () {
                        allSoal = [];
                        renderDaftarSoal();
                        tampilkanToast("Gagal memuat soal.");
                    })
                    .always(function () {
                        $("#soalLoading").addClass("hidden");
                        $("#daftarSoal").removeClass("hidden");
                    });
            }

            // ----- Import Soal (tempel teks / upload .docx) -----
            const $modalImportSoal = $("#modalImportSoal");
            const URL_IMPORT_SOAL = "{{ route('committee.evaluasi.soal-import') }}";
            let sumberImportSoal = "teks";

            $("#btnImportSoal").on("click", function () {
                if (!activeExamId) return;
                const p = allPaket.find((x) => x.id === activeExamId);
                $("#importPaketNama").text(p ? `Evaluasi ${p.title}` : "-");
                $("#inputTeksSoal").val("");
                $("#inputFileSoal").val("");
                $("#importSoalErrorBox").addClass("hidden");
                pilihTabSumberSoal("teks");
                $modalImportSoal.removeClass("hidden").addClass("flex");
            });
            $("#btnCloseImportSoal, #btnBatalImportSoal").on("click", () => $modalImportSoal.addClass("hidden").removeClass("flex"));
            $modalImportSoal.on("click", function (e) { if (e.target === this) $modalImportSoal.addClass("hidden").removeClass("flex"); });

            function pilihTabSumberSoal(sumber) {
                sumberImportSoal = sumber;
                $(".tab-sumber-soal").removeClass("bg-white text-teal-600 shadow-sm").addClass("text-slate-500");
                $(`.tab-sumber-soal[data-sumber="${sumber}"]`).addClass("bg-white text-teal-600 shadow-sm").removeClass("text-slate-500");
                $("#panelTeksSoal").toggleClass("hidden", sumber !== "teks");
                $("#panelDocxSoal").toggleClass("hidden", sumber !== "docx");
            }
            $(".tab-sumber-soal").on("click", function () { pilihTabSumberSoal($(this).data("sumber")); });

            $("#btnSubmitImportSoal").on("click", function () {
                const $btn = $(this);
                $("#importSoalErrorBox").addClass("hidden");

                const formData = new FormData();
                formData.append("exam_id", activeExamId);
                formData.append("sumber", sumberImportSoal);
                if (sumberImportSoal === "teks") {
                    const teks = $("#inputTeksSoal").val().trim();
                    if (!teks) { tampilkanToast("Teks soal masih kosong."); return; }
                    formData.append("teks", teks);
                } else {
                    const file = $("#inputFileSoal")[0].files[0];
                    if (!file) { tampilkanToast("Pilih file .docx dulu."); return; }
                    formData.append("file", file);
                }

                $btn.prop("disabled", true).text("Mengimpor...");
                $.ajax({
                    url: URL_IMPORT_SOAL,
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN },
                })
                    .done(function (res) {
                        $modalImportSoal.addClass("hidden").removeClass("flex");
                        tampilkanToast(res.message);
                        muatSoal();
                    })
                    .fail(function (xhr) {
                        const res = xhr.responseJSON || {};
                        if (res.errors && res.errors.length) {
                            $("#importSoalErrorTitle").text(res.message || "Ada soal yang formatnya belum sesuai:");
                            $("#importSoalErrorList").html(res.errors.map((e) => `<li>${e}</li>`).join(""));
                            $("#importSoalErrorBox").removeClass("hidden");
                        } else {
                            tampilkanToast(res.message || "Gagal mengimpor soal.");
                        }
                    })
                    .always(function () {
                        $btn.prop("disabled", false).text("Import Sekarang");
                    });
            });

            function renderDaftarSoal() {
                if (allSoal.length === 0) {
                    $("#daftarSoal").html("");
                    $("#soalEmpty").removeClass("hidden");
                    return;
                }
                $("#soalEmpty").addClass("hidden");

                const html = allSoal.map((s, idx) => `
                    <div class="flex items-start justify-between gap-3 p-5">
                        <div class="flex items-start gap-3 min-w-0">
                            <span class="w-7 h-7 shrink-0 rounded-lg bg-slate-100 text-slate-600 text-xs font-extrabold flex items-center justify-center">${idx + 1}</span>
                            <div class="min-w-0">
                                <span class="text-[10px] font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2 py-1 rounded-md">Pilihan Ganda</span>
                                <p class="text-sm text-slate-800 m-0 mt-2">${s.question ?? "-"}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 shrink-0">
                            <button data-aksi="edit-soal" data-id="${s.id}" aria-label="Edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                            <button data-aksi="hapus-soal" data-id="${s.id}" aria-label="Hapus" class="w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </div>
                    </div>`).join("");

                $("#daftarSoal").html(html);
                lucide.createIcons();
                $('[data-aksi="edit-soal"]').off("click").on("click", function () { bukaFormSoal(Number($(this).data("id"))); });
                $('[data-aksi="hapus-soal"]').off("click").on("click", function () { hapusSoal(Number($(this).data("id"))); });
            }

            // ----- Modal Tambah/Edit Soal -----
            const $modalSoal = $("#modalSoal");
            const $formSoalError = $("#formSoalError");

            function bukaFormSoal(id) {
                editingSoalId = id || null;
                $formSoalError.addClass("hidden");
                const data = id ? allSoal.find((x) => x.id === id) : null;
                $("#modalSoalTitle").text(id ? "Edit Soal" : "Tambah Soal");
                buildFormFields("#formSoalFields", CATEGORY_SOAL.fields, data);
                lucide.createIcons();
                $modalSoal.removeClass("hidden").addClass("flex");
            }
            function tutupFormSoal() { $modalSoal.addClass("hidden").removeClass("flex"); editingSoalId = null; }

            $("#btnTambahSoal").on("click", () => bukaFormSoal(null));
            $("#btnCloseSoal").on("click", tutupFormSoal);
            $("#btnBatalSoal").on("click", tutupFormSoal);
            $modalSoal.on("click", function (e) { if (e.target === this) tutupFormSoal(); });

            $("#formSoal").on("submit", function (e) {
                e.preventDefault();
                $formSoalError.addClass("hidden");
                const payload = collectFormValues(CATEGORY_SOAL.fields);
                payload.exam_id = activeExamId; // wajib: soal terikat ke paket yang lagi aktif
                const $btn = $("#btnSimpanSoal");
                $btn.prop("disabled", true);

                const url = editingSoalId ? `${URL_BASE}/${CATEGORY_SOAL.key}/${editingSoalId}` : `${URL_BASE}/${CATEGORY_SOAL.key}`;
                const method = editingSoalId ? "PUT" : "POST";

                $.ajax({
                    url, method,
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: JSON.stringify(payload),
                }).done(function (result) {
                    if (editingSoalId) {
                        const idx = allSoal.findIndex((x) => x.id === editingSoalId);
                        if (idx > -1) allSoal[idx] = result.data;
                    } else {
                        allSoal.push(result.data);
                    }
                    tampilkanToast(result.message);
                    tutupFormSoal();
                    renderDaftarSoal();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    $formSoalError.text(result.errors ? Object.values(result.errors).flat().join(" ") : (result.message || "Terjadi kesalahan."));
                    $formSoalError.removeClass("hidden");
                }).always(function () { $btn.prop("disabled", false); });
            });

            function hapusSoal(id) {
                const s = allSoal.find((x) => x.id === id);
                if (!s) return;
                if (!confirm("Hapus soal ini?")) return;

                $.ajax({
                    url: `${URL_BASE}/${CATEGORY_SOAL.key}/${id}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    allSoal = allSoal.filter((x) => x.id !== id);
                    tampilkanToast(result.message);
                    renderDaftarSoal();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    tampilkanToast(result.message || "Gagal menghapus soal.");
                });
            }

            // ===================== Helper form dinamis (dipakai Paket & Soal) =====================

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

            function buildFormFields(containerSel, fields, data) {
                const html = fields.map((f) => {
                    if (f.type === "checkbox") {
                        return `<div>${inputHtml(f, data ? data[f.name] : false)}</div>`;
                    }
                    return `<div>
                        <label for="field_${f.name}" class="block text-xs font-bold text-slate-500 mb-1.5">${f.label}</label>
                        ${inputHtml(f, data ? data[f.name] : "")}
                        </div>`;
                }).join("");
                $(containerSel).html(html);
            }

            function collectFormValues(fields) {
                const payload = {};
                fields.forEach((f) => {
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

            muatKategori();
            muatPaket();
        });
    </script>
@endpush