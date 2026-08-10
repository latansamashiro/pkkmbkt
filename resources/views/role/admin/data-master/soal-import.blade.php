@extends('layouts.admin.main')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        corePlugins: { preflight: false }
    }
</script>

<div class="flex items-center justify-between flex-wrap gap-3 mb-5">
    <div>
        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Administrasi</p>
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">Bank Soal</h2>
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-2xl p-5 mb-5">
    <label class="block text-xs font-bold text-slate-500 mb-1.5">Pilih Paket Evaluasi</label>
    <select id="examSelect" class="w-full sm:w-auto min-w-[320px] border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
        <option value="">— Pilih paket evaluasi —</option>
        @foreach ($daftarUjian as $u)
            <option value="{{ $u->id }}">{{ $u->title }} — {{ $u->subtitle }} ({{ $u->details_count }} soal)</option>
        @endforeach
    </select>
    @if ($daftarUjian->isEmpty())
        <p class="text-xs text-amber-600 font-semibold mt-2.5">Belum ada Paket Evaluasi. Buat dulu lewat menu Kelola Data → Data Soal Evaluasi.</p>
    @endif
</div>

<div id="examContent" class="hidden">
    <div class="flex items-center justify-between flex-wrap gap-3 mb-4">
        <h3 class="text-base font-extrabold text-slate-800 m-0">Daftar Soal <span id="jumlahSoalBadge" class="text-slate-400 font-semibold"></span></h3>
        <button id="btnBukaImport" class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
            <i data-lucide="upload" class="w-4 h-4"></i>Import Soal
        </button>
    </div>

    <p id="listLoading" class="text-center text-sm text-slate-400 py-4 hidden">Memuat data...</p>

    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">No</th>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100">Pertanyaan</th>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Kunci</th>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Bobot</th>
                        <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelSoal"></tbody>
            </table>
        </div>
    </div>
</div>

<p id="belumPilihState" class="text-center text-sm text-slate-400 py-10">Pilih Paket Evaluasi dulu di atas untuk lihat/kelola soalnya.</p>

<!-- ===== MODAL IMPORT ===== -->
<div id="modalImport" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6">
        <div class="flex items-start justify-between gap-4 mb-5">
            <div>
                <h3 class="text-lg font-extrabold text-slate-800 m-0">Import Soal</h3>
                <p class="text-xs text-slate-400 m-0 mt-1">Tempel teks langsung, atau upload file Word (.docx) dengan format yang sama.</p>
            </div>
            <button id="btnCloseImport" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Contoh format -->
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

        <!-- Tab sumber -->
        <div class="flex items-center gap-2 mb-4 bg-slate-100 rounded-xl p-1 w-fit">
            <button type="button" data-sumber="teks" class="tab-sumber px-4 py-2 rounded-lg text-sm font-bold transition">Tempel Teks</button>
            <button type="button" data-sumber="docx" class="tab-sumber px-4 py-2 rounded-lg text-sm font-bold transition">Upload Word (.docx)</button>
        </div>

        <div id="panelTeks">
            <textarea id="inputTeks" rows="10" placeholder="Tempel teks soal sesuai format di atas..."
                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 font-mono focus:outline-none focus:border-teal-600"></textarea>
        </div>
        <div id="panelDocx" class="hidden">
            <input type="file" id="inputFile" accept=".docx"
                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600" />
            <p class="text-xs text-slate-400 mt-2">File Word (.docx) yang isinya teks soal dengan format sama seperti contoh di atas. Formatting (bold/warna/dsb) di dalam Word diabaikan, cuma teksnya yang dibaca.</p>
        </div>

        <div id="importErrorBox" class="hidden mt-4 bg-rose-50 border border-rose-100 rounded-xl p-4">
            <p class="text-xs font-bold text-rose-600 mb-2" id="importErrorTitle"></p>
            <ul id="importErrorList" class="text-xs text-rose-600 pl-4 list-disc space-y-1"></ul>
        </div>

        <div class="flex items-center justify-end gap-3 mt-6">
            <button type="button" id="btnBatalImport" class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
            <button type="button" id="btnSubmitImport" class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">Import Sekarang</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(function() {
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        const URL_BASE = "{{ url('admin/data-master/soal') }}";
        let sumberAktif = "teks";
        let examId = "";

        function tampilkanToast(msg) {
            alert(msg); // sederhana dulu, konsisten sama pola konfirmasi lain di halaman ini
        }

        // ===== Pilih Paket Evaluasi =====
        $("#examSelect").on("change", function() {
            examId = $(this).val();
            if (!examId) {
                $("#examContent").addClass("hidden");
                $("#belumPilihState").removeClass("hidden");
                return;
            }
            $("#belumPilihState").addClass("hidden");
            $("#examContent").removeClass("hidden");
            muatSoal();
        });

        function muatSoal() {
            $("#listLoading").removeClass("hidden");
            $.get(`${URL_BASE}/items`, { exam_id: examId })
                .done(function(res) {
                    renderTabelSoal(res.data || []);
                })
                .fail(function() {
                    renderTabelSoal([]);
                    tampilkanToast("Gagal memuat data soal.");
                })
                .always(function() {
                    $("#listLoading").addClass("hidden");
                });
        }

        function renderTabelSoal(items) {
            $("#jumlahSoalBadge").text(`(${items.length} soal)`);
            if (items.length === 0) {
                $("#tabelSoal").html(`<tr><td colspan="5" class="text-center py-6 text-slate-400 text-sm">Belum ada soal untuk paket ini.</td></tr>`);
                return;
            }
            const html = items.map((it, idx) => `
                <tr class="hover:bg-slate-50">
                    <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200 align-top">${idx + 1}</td>
                    <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">
                        ${it.question}
                        <div class="text-[11px] text-slate-400 mt-1">A) ${it.option_a} &nbsp; B) ${it.option_b} &nbsp; C) ${it.option_c} &nbsp; D) ${it.option_d}</div>
                    </td>
                    <td class="px-3.5 py-3 text-sm font-bold text-teal-600 border-b border-slate-200 align-top">${it.key}</td>
                    <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200 align-top">${it.question_value}</td>
                    <td class="px-3.5 py-3 border-b border-slate-200 align-top">
                        <button data-id="${it.id}" class="btnHapusSoal w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50" aria-label="Hapus">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </td>
                </tr>
            `).join("");
            $("#tabelSoal").html(html);
            lucide.createIcons();
            $(".btnHapusSoal").on("click", function() {
                const id = $(this).data("id");
                if (!confirm("Hapus soal ini?")) return;
                $.ajax({
                    url: `${URL_BASE}/${id}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN },
                })
                    .done(function() { muatSoal(); })
                    .fail(function() { tampilkanToast("Gagal menghapus soal."); });
            });
        }

        // ===== Modal import =====
        const $modalImport = $("#modalImport");

        $("#btnBukaImport").on("click", function() {
            $("#inputTeks").val("");
            $("#inputFile").val("");
            $("#importErrorBox").addClass("hidden");
            pilihTabSumber("teks");
            $modalImport.removeClass("hidden").addClass("flex");
        });
        $("#btnCloseImport, #btnBatalImport").on("click", () => $modalImport.addClass("hidden").removeClass("flex"));
        $modalImport.on("click", function(e) { if (e.target === this) $modalImport.addClass("hidden").removeClass("flex"); });

        function pilihTabSumber(sumber) {
            sumberAktif = sumber;
            $(".tab-sumber").removeClass("bg-white text-teal-600 shadow-sm").addClass("text-slate-500");
            $(`.tab-sumber[data-sumber="${sumber}"]`).addClass("bg-white text-teal-600 shadow-sm").removeClass("text-slate-500");
            $("#panelTeks").toggleClass("hidden", sumber !== "teks");
            $("#panelDocx").toggleClass("hidden", sumber !== "docx");
        }
        $(".tab-sumber").on("click", function() { pilihTabSumber($(this).data("sumber")); });
        pilihTabSumber("teks");

        $("#btnSubmitImport").on("click", function() {
            const $btn = $(this);
            $("#importErrorBox").addClass("hidden");

            const formData = new FormData();
            formData.append("exam_id", examId);
            formData.append("sumber", sumberAktif);
            if (sumberAktif === "teks") {
                const teks = $("#inputTeks").val().trim();
                if (!teks) { tampilkanToast("Teks soal masih kosong."); return; }
                formData.append("teks", teks);
            } else {
                const file = $("#inputFile")[0].files[0];
                if (!file) { tampilkanToast("Pilih file .docx dulu."); return; }
                formData.append("file", file);
            }

            $btn.prop("disabled", true).text("Mengimpor...");
            $.ajax({
                url: `${URL_BASE}/import`,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: { "X-CSRF-TOKEN": CSRF_TOKEN },
            })
                .done(function(res) {
                    $modalImport.addClass("hidden").removeClass("flex");
                    tampilkanToast(res.message);
                    muatSoal();
                })
                .fail(function(xhr) {
                    const res = xhr.responseJSON || {};
                    if (res.errors && res.errors.length) {
                        $("#importErrorTitle").text(res.message || "Ada soal yang formatnya belum sesuai:");
                        $("#importErrorList").html(res.errors.map((e) => `<li>${e}</li>`).join(""));
                        $("#importErrorBox").removeClass("hidden");
                    } else {
                        tampilkanToast(res.message || "Gagal mengimpor soal.");
                    }
                })
                .always(function() {
                    $btn.prop("disabled", false).text("Import Sekarang");
                });
        });
    });
</script>
@endpush
