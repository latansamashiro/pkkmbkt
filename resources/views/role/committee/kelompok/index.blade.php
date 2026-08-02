@extends('layouts.committee.main')
@section('content')

    <div class="page-head" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div>
            <p class="eyebrow" style="font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.06em;color:#94a3b8;margin:0;">Kelola Data</p>
            <h2 style="font-size:26px;font-weight:800;margin:0;color:#152159;">Kelompok</h2>
        </div>
        <button id="btnTambah" style="display:inline-flex;align-items:center;gap:8px;background:var(--navy-900,#152159);color:#fff;font-weight:800;font-size:13px;padding:12px 20px;border:none;border-radius:999px;cursor:pointer;">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Kelompok
        </button>
    </div>

    <!-- STAT CARDS -->
    <div id="statCards" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;margin-bottom:20px;"></div>

    <!-- SEARCH + FILTER -->
    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:16px;">
        <div style="flex:1;min-width:240px;display:flex;align-items:center;gap:8px;background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:12px 16px;">
            <i data-lucide="search" class="w-4 h-4" style="color:#94a3b8;flex-shrink:0;"></i>
            <input type="text" id="searchKelompok" placeholder="Cari nama kelompok atau mentor..." style="border:none;background:transparent;font-size:13px;width:100%;outline:none;" />
        </div>
        <select id="filterMentor" class="inp" style="min-width:170px;">
            <option value="">Semua Mentor</option>
        </select>
    </div>

    <!-- TABEL -->
    <div class="card" style="background:#fff;border:1px solid #e2e8f0;border-radius:16px;overflow:hidden;">
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr>
                        <th class="th-cell">Kelompok</th>
                        <th class="th-cell">Mentor</th>
                        <th class="th-cell">Advisor</th>
                        <th class="th-cell">Anggota</th>
                        <th class="th-cell">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelKelompok"></tbody>
            </table>
        </div>
        <p id="listLoading" style="display:none;text-align:center;font-size:13px;color:#94a3b8;padding:20px 0;">Memuat data...</p>
    </div>

    <!-- MODAL TAMBAH / EDIT -->
    <div id="modalForm" class="modal-overlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);align-items:center;justify-content:center;padding:16px;z-index:50;">
        <div style="background:#fff;border-radius:16px;width:100%;max-width:440px;max-height:90vh;overflow-y:auto;padding:24px;">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:16px;">
                <h3 id="modalFormTitle" style="font-size:17px;font-weight:800;margin:0;">Tambah Kelompok</h3>
                <button id="btnCloseForm" aria-label="Tutup" style="all:unset;cursor:pointer;color:#94a3b8;"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <form id="formItem">
                <p id="formError" style="display:none;font-size:12px;font-weight:700;color:#e11d48;background:#fff1f2;border:1px solid #fecdd3;border-radius:10px;padding:8px 12px;margin-bottom:12px;"></p>
                <div id="formFields" style="display:grid;gap:14px;"></div>
                <div style="display:flex;align-items:center;justify-content:flex-end;gap:10px;margin-top:22px;">
                    <button type="button" id="btnBatalForm" style="border:1px solid #e2e8f0;background:#fff;color:#334155;font-weight:800;font-size:13px;padding:10px 16px;border-radius:10px;cursor:pointer;">Batal</button>
                    <button type="submit" id="btnSimpanForm" style="background:var(--navy-900,#152159);color:#fff;font-weight:800;font-size:13px;padding:10px 16px;border:none;border-radius:10px;cursor:pointer;">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DETAIL -->
    <div id="modalDetail" class="modal-overlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);align-items:center;justify-content:center;padding:16px;z-index:50;">
        <div style="background:#fff;border-radius:16px;width:100%;max-width:420px;padding:24px;">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:16px;">
                <h3 style="font-size:17px;font-weight:800;margin:0;">Detail Kelompok</h3>
                <button id="btnCloseDetail" aria-label="Tutup" style="all:unset;cursor:pointer;color:#94a3b8;"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <div id="detailBody" style="border-top:1px solid #f1f5f9;"></div>
        </div>
    </div>

    <!-- MODAL KELOLA ANGGOTA -->
    <div id="modalAnggota" class="modal-overlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);align-items:center;justify-content:center;padding:16px;z-index:50;">
        <div style="background:#fff;border-radius:16px;width:100%;max-width:680px;max-height:88vh;overflow-y:auto;padding:24px;">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:4px;">
                <div>
                    <h3 id="modalAnggotaTitle" style="font-size:17px;font-weight:800;margin:0;">-</h3>
                    <p id="modalAnggotaSub" style="font-size:12px;color:#94a3b8;margin:4px 0 0;">-</p>
                </div>
                <button id="btnCloseAnggota" aria-label="Tutup" style="all:unset;cursor:pointer;color:#94a3b8;"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>

            <div id="anggotaError" style="display:none;margin-top:12px;font-size:12px;font-weight:700;color:#e11d48;background:#fff1f2;border:1px solid #fecdd3;border-radius:10px;padding:8px 12px;"></div>
            <div id="anggotaInfo" style="display:none;margin-top:12px;font-size:12px;font-weight:700;color:#0d9488;background:#ecfdf5;border:1px solid #a7f3d0;border-radius:10px;padding:8px 12px;"></div>

            <!-- Upload Excel -->
            <div style="margin-top:16px;border:1px dashed #cbd5e1;border-radius:12px;padding:14px 16px;display:flex;align-items:center;gap:12px;flex-wrap:wrap;background:#f8fafc;">
                <div style="width:38px;height:38px;border-radius:10px;background:#eef2ff;color:#4338ca;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i data-lucide="file-up" class="w-4 h-4"></i>
                </div>
                <div style="flex:1;min-width:180px;">
                    <p style="font-size:12px;font-weight:800;margin:0;color:#334155;">Upload dari Excel/CSV</p>
                    <p style="font-size:11px;color:#94a3b8;margin:2px 0 0;">Baris pertama header, wajib ada kolom <b>npm</b>. Mahasiswa harus sudah terdaftar di Mahasiswa Baru.</p>
                </div>
                <input type="file" id="inputExcelAnggota" accept=".xlsx,.xls,.csv" style="font-size:12px;" />
                <button id="btnUploadExcel" style="display:inline-flex;align-items:center;gap:6px;background:#1e293b;color:#fff;font-weight:800;font-size:12px;padding:8px 14px;border:none;border-radius:8px;cursor:pointer;white-space:nowrap;">
                    <i data-lucide="upload" class="w-4 h-4"></i> Import
                </button>
            </div>

            <!-- Tambah manual dari daftar mahasiswa -->
            <div style="margin-top:16px;display:flex;flex-wrap:wrap;gap:8px;">
                <div style="flex:1;min-width:200px;display:flex;align-items:center;gap:8px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:10px 14px;">
                    <i data-lucide="search" class="w-4 h-4" style="color:#94a3b8;flex-shrink:0;"></i>
                    <input type="text" id="searchMahasiswaBaru" placeholder="Cari nama / email mahasiswa..." style="border:none;background:transparent;font-size:13px;width:100%;outline:none;" />
                </div>
                <select id="filterProdiBaru" class="inp" style="max-width:220px;">
                    <option value="">Semua Program Studi</option>
                </select>
            </div>
            <div style="margin-top:8px;display:flex;align-items:flex-start;gap:8px;">
                <select id="selectMahasiswaBaru" size="6" class="inp" style="flex:1;"></select>
                <button id="btnTambahAnggota" style="display:inline-flex;align-items:center;gap:8px;background:var(--navy-900,#152159);color:#fff;font-weight:800;font-size:13px;padding:10px 16px;border:none;border-radius:10px;cursor:pointer;white-space:nowrap;">
                    <i data-lucide="user-plus" class="w-4 h-4"></i> Tambah
                </button>
            </div>
            <p style="font-size:11px;color:#94a3b8;margin:6px 0 16px;">
                Hanya menampilkan mahasiswa yang belum tergabung di kelompok manapun. Pilih satu nama, lalu klik Tambah.
            </p>

            <div style="border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th class="th-cell">Nama</th>
                            <th class="th-cell">Email</th>
                            <th class="th-cell" style="text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelAnggota"></tbody>
                </table>
                <p id="anggotaKosong" style="display:none;text-align:center;font-size:13px;color:#94a3b8;padding:20px 0;">Belum ada anggota di kelompok ini.</p>
            </div>
        </div>
    </div>

    <style>
        .th-cell{text-align:left;font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.05em;color:#94a3b8;padding:12px 16px;background:#f8fafc;white-space:nowrap;}
        td.td-cell{padding:14px 16px;font-size:13px;border-bottom:1px solid #eef1f6;vertical-align:middle;}
        .inp{border:1px solid #e2e8f0;border-radius:10px;padding:10px 14px;font-size:13px;outline:none;cursor:pointer;width:100%;}
        input.inp{cursor:text;}
        .lbl{display:block;font-size:12px;font-weight:800;color:#64748b;margin-bottom:6px;}
        .btn-icon{all:unset;width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:8px;color:#94a3b8;cursor:pointer;}
        .btn-icon:hover{background:#f1f5f9;color:#334155;}
        .stat-card{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:18px;display:flex;align-items:center;gap:14px;}
        .stat-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .detail-row{display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f1f5f9;font-size:13px;}
        .detail-lbl{font-size:11px;font-weight:800;color:#94a3b8;}
    </style>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(function () {
            const CATEGORY = @json(collect($categories)->firstWhere('key', 'kelompok'));
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            const URL_BASE = "{{ url()->current() }}";

            let items = [];
            let editingId = null;

            function muatData() {
                $("#listLoading").show();
                $.get(`${URL_BASE}/kelompok/items`)
                    .done(function (res) {
                        items = res.data || [];
                        isiFilterMentor();
                        renderStats();
                        renderTabel();
                    })
                    .fail(function () {
                        items = [];
                        renderTabel();
                        tampilkanToast("Gagal memuat data kelompok.");
                    })
                    .always(function () { $("#listLoading").hide(); });
            }

            function renderStats() {
                const total = items.length;
                const rataAnggota = total ? Math.round(items.reduce((a, b) => a + (b.member_count || 0), 0) / total) : 0;
                const belumAdaMentor = items.filter((it) => !it.mentor_name).length;

                $("#statCards").html(`
                    <div class="stat-card">
                        <span class="stat-icon" style="background:#eef2ff;color:#4338ca;"><i data-lucide="users-round" class="w-5 h-5"></i></span>
                        <div><p style="font-size:22px;font-weight:800;margin:0;">${total}</p><p style="font-size:12px;color:#94a3b8;margin:0;">Total Kelompok</p></div>
                    </div>
                    <div class="stat-card">
                        <span class="stat-icon" style="background:#ecfdf5;color:#0d9488;"><i data-lucide="user" class="w-5 h-5"></i></span>
                        <div><p style="font-size:22px;font-weight:800;margin:0;">${rataAnggota}</p><p style="font-size:12px;color:#94a3b8;margin:0;">Rata-rata Anggota</p></div>
                    </div>
                    <div class="stat-card">
                        <span class="stat-icon" style="background:#fff1f2;color:#e11d48;"><i data-lucide="user-x" class="w-5 h-5"></i></span>
                        <div><p style="font-size:22px;font-weight:800;margin:0;">${belumAdaMentor}</p><p style="font-size:12px;color:#94a3b8;margin:0;">Belum Ada Mentor</p></div>
                    </div>
                `);
                lucide.createIcons();
            }

            function isiFilterMentor() {
                const mentors = [...new Set(items.filter((it) => it.mentor_name).map((it) => it.mentor_name))].sort();
                const current = $("#filterMentor").val() || "";
                $("#filterMentor").html('<option value="">Semua Mentor</option>' + mentors.map((m) => `<option value="${m}">${m}</option>`).join(""));
                $("#filterMentor").val(current);
            }

            function filteredData() {
                const q = $("#searchKelompok").val().trim().toLowerCase();
                const mentor = $("#filterMentor").val();
                return items.filter((it) =>
                    (!mentor || it.mentor_name === mentor) &&
                    (!q || (it.name || "").toLowerCase().includes(q) || (it.mentor_name || "").toLowerCase().includes(q) || (it.code || "").toLowerCase().includes(q))
                );
            }

            function renderTabel() {
                const data = filteredData();
                if (data.length === 0) {
                    $("#tabelKelompok").html(`<tr><td colspan="5" style="text-align:center;padding:30px 0;color:#94a3b8;font-size:13px;">Tidak ada data kelompok.</td></tr>`);
                    return;
                }
                const html = data.map((it) => `
                    <tr>
                        <td class="td-cell">
                            <p style="font-weight:800;margin:0;color:#1e293b;">${it.name}</p>
                            <p style="font-size:11px;color:#94a3b8;margin:2px 0 0;">${it.code}</p>
                        </td>
                        <td class="td-cell">${it.mentor_name ? it.mentor_name : `<span style="font-size:11px;font-weight:800;padding:3px 10px;border-radius:999px;background:#f1f5f9;color:#94a3b8;">Belum ada</span>`}</td>
                        <td class="td-cell">${it.advisor_name || "-"}</td>
                        <td class="td-cell">${it.member_count ?? 0} / ${it.max_member} maba</td>
                        <td class="td-cell">
                            <div style="display:flex;align-items:center;gap:2px;">
                                <button data-aksi="anggota" data-id="${it.id}" aria-label="Kelola Anggota" class="btn-icon" title="Kelola Anggota"><i data-lucide="users" class="w-4 h-4"></i></button>
                                <button data-aksi="lihat" data-id="${it.id}" aria-label="Detail" class="btn-icon"><i data-lucide="eye" class="w-4 h-4"></i></button>
                                <button data-aksi="edit" data-id="${it.id}" aria-label="Edit" class="btn-icon"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                <button data-aksi="hapus" data-id="${it.id}" aria-label="Hapus" class="btn-icon" style="color:#f43f5e;"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </div>
                        </td>
                    </tr>
                `).join("");
                $("#tabelKelompok").html(html);
                lucide.createIcons();
                $('[data-aksi="lihat"]').on("click", function () { bukaDetail(Number($(this).data("id"))); });
                $('[data-aksi="edit"]').on("click", function () { bukaForm(Number($(this).data("id"))); });
                $('[data-aksi="hapus"]').on("click", function () { hapusItem(Number($(this).data("id"))); });
                $('[data-aksi="anggota"]').on("click", function () { bukaAnggota(Number($(this).data("id"))); });
            }

            $("#searchKelompok").on("keyup", renderTabel);
            $("#filterMentor").on("change", renderTabel);

            // ===== Form dinamis dari CATEGORY.fields (sama seperti dipakai Admin Data Master) =====
            function inputHtml(f, value) {
                const id = `field_${f.name}`;
                const req = f.required ? "required" : "";
                const val = value ?? "";
                if (f.type === "select") {
                    const opts = Object.entries(f.options || {}).map(([ov, ol]) =>
                        `<option value="${ov}" ${String(val) === String(ov) ? "selected" : ""}>${ol}</option>`
                    ).join("");
                    return `<select id="${id}" ${req} class="inp"><option value="">Pilih ${f.label}</option>${opts}</select>`;
                }
                return `<input type="${f.type}" id="${id}" value="${val}" ${req} class="inp" />`;
            }

            function applyDependentFilters(changedFieldName, changedValue) {
                const dependents = CATEGORY.fields.filter((f) => f.filter_by === changedFieldName);
                dependents.forEach((dep) => {
                    const meta = dep.options_meta || [];
                    const filtered = changedValue ? meta.filter((m) => String(m.filter_value) === String(changedValue)) : meta;
                    const $el = $(`#field_${dep.name}`);
                    const currentVal = $el.val();
                    const opts = filtered.map((m) => `<option value="${m.value}" ${String(currentVal) === String(m.value) ? "selected" : ""}>${m.label}</option>`).join("");
                    $el.html(`<option value="">Pilih ${dep.label}</option>${opts}`);
                    if (!filtered.some((m) => String(m.value) === String(currentVal))) $el.val("");
                });
            }

            function buildFormFields(data) {
                const html = CATEGORY.fields.map((f) =>
                    `<div><label for="field_${f.name}" class="lbl">${f.label}</label>${inputHtml(f, data ? data[f.name] : "")}</div>`
                ).join("");
                $("#formFields").html(html);

                // Kalau lagi edit, cari tahu prodi si mentor yang sudah tersimpan,
                // biar dropdown Program Studi otomatis ke-set (bukan kosong / "Pilih Fakultas").
                CATEGORY.fields.forEach((f) => {
                    if (f.filter_by && data && data[f.name]) {
                        const meta = f.options_meta || [];
                        const selectedMeta = meta.find((m) => String(m.value) === String(data[f.name]));
                        if (selectedMeta && selectedMeta.filter_value) {
                            $(`#field_${f.filter_by}`).val(selectedMeta.filter_value);
                        }
                    }
                });

                CATEGORY.fields.forEach((f) => {
                    const hasDependents = CATEGORY.fields.some((d) => d.filter_by === f.name);
                    if (hasDependents) {
                        applyDependentFilters(f.name, $(`#field_${f.name}`).val() || "");
                        $(`#field_${f.name}`).on("change", function () { applyDependentFilters(f.name, $(this).val()); });
                    }
                });
            }

            function collectFormValues() {
                const payload = {};
                CATEGORY.fields.forEach((f) => {
                    if (f.virtual) return;
                    const $el = $(`#field_${f.name}`);
                    payload[f.name] = f.type === "number" ? $el.val() : ($el.val() || "").toUpperCase ? ($el.val() || "") : $el.val();
                });
                return payload;
            }

            const $modalForm = $("#modalForm");
            const $modalDetail = $("#modalDetail");
            const $formError = $("#formError");

            function bukaForm(id) {
                editingId = id || null;
                $formError.hide();
                const data = id ? items.find((x) => x.id === id) : null;
                $("#modalFormTitle").text(id ? "Edit Kelompok" : "Tambah Kelompok");
                buildFormFields(data);
                $modalForm.css("display", "flex");
            }
            function tutupForm() { $modalForm.css("display", "none"); editingId = null; }

            $("#btnTambah").on("click", () => bukaForm(null));
            $("#btnCloseForm").on("click", tutupForm);
            $("#btnBatalForm").on("click", tutupForm);
            $modalForm.on("click", function (e) { if (e.target === this) tutupForm(); });

            $("#formItem").on("submit", function (e) {
                e.preventDefault();
                $formError.hide();
                const payload = collectFormValues();
                const $btnSimpan = $("#btnSimpanForm");
                $btnSimpan.prop("disabled", true);

                const url = editingId ? `${URL_BASE}/kelompok/${editingId}` : `${URL_BASE}/kelompok`;
                const method = editingId ? "PUT" : "POST";

                $.ajax({
                    url, method,
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: JSON.stringify(payload),
                }).done(function (result) {
                    tampilkanToast(result.message);
                    tutupForm();
                    muatData();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    if (result.errors) $formError.text(Object.values(result.errors).flat().join(" "));
                    else $formError.text(result.message || "Terjadi kesalahan, silakan coba lagi.");
                    $formError.show();
                }).always(function () { $btnSimpan.prop("disabled", false); });
            });

            function bukaDetail(id) {
                const it = items.find((x) => x.id === id);
                if (!it) return;
                $("#detailBody").html(`
                    <div class="detail-row"><span class="detail-lbl">Kode</span><span>${it.code}</span></div>
                    <div class="detail-row"><span class="detail-lbl">Nama</span><span>${it.name}</span></div>
                    <div class="detail-row"><span class="detail-lbl">Mentor</span><span>${it.mentor_name || "-"}</span></div>
                    <div class="detail-row"><span class="detail-lbl">Advisor</span><span>${it.advisor_name || "-"}</span></div>
                    <div class="detail-row"><span class="detail-lbl">Anggota</span><span>${it.member_count ?? 0} / ${it.max_member}</span></div>
                `);
                $modalDetail.css("display", "flex");
            }
            $("#btnCloseDetail").on("click", () => $modalDetail.css("display", "none"));
            $modalDetail.on("click", function (e) { if (e.target === this) $modalDetail.css("display", "none"); });

            function hapusItem(id) {
                const it = items.find((x) => x.id === id);
                if (!it) return;
                if (!confirm(`Hapus kelompok "${it.name}"?`)) return;

                $.ajax({
                    url: `${URL_BASE}/kelompok/${id}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    tampilkanToast(result.message);
                    muatData();
                }).fail(function (xhr) {
                    tampilkanToast((xhr.responseJSON && xhr.responseJSON.message) || "Gagal menghapus data.");
                });
            }

            // ===== Modal Kelola Anggota =====
            const $modalAnggota = $("#modalAnggota");
            let activeGroupId = null;
            let anggotaMembers = [];
            let anggotaAvailable = [];

            function bukaAnggota(id) {
                activeGroupId = id;
                $("#anggotaError").hide();
                $("#anggotaInfo").hide();
                $("#searchMahasiswaBaru").val("");
                $("#inputExcelAnggota").val("");
                $("#modalAnggotaTitle").text("Memuat...");
                $modalAnggota.css("display", "flex");
                muatAnggota();
            }
            function tutupAnggota() { $modalAnggota.css("display", "none"); activeGroupId = null; }
            $("#btnCloseAnggota").on("click", tutupAnggota);
            $modalAnggota.on("click", function (e) { if (e.target === this) tutupAnggota(); });

            function muatAnggota() {
                $.get(`${URL_BASE}/kelompok/${activeGroupId}/anggota`)
                    .done(function (res) {
                        $("#modalAnggotaTitle").text(`Kelola Anggota — ${res.group.name}`);
                        $("#modalAnggotaSub").text(`${res.group.member_count}/${res.group.max_member} anggota`);
                        anggotaMembers = res.members || [];
                        anggotaAvailable = res.available || [];
                        renderTabelAnggota();
                        isiFilterProdi();
                        renderPilihanMahasiswa();
                        // sinkron jumlah anggota di tabel kelompok utama tanpa reload seluruh data
                        const it = items.find((x) => x.id === activeGroupId);
                        if (it) { it.member_count = res.group.member_count; renderTabel(); renderStats(); }
                    })
                    .fail(function () {
                        tampilkanToast("Gagal memuat data anggota.");
                        tutupAnggota();
                    });
            }

            function renderTabelAnggota() {
                $("#anggotaKosong").toggle(anggotaMembers.length === 0);
                const html = anggotaMembers.map((s) => `
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:10px 14px;font-size:13px;font-weight:700;">${s.name}</td>
                        <td style="padding:10px 14px;font-size:13px;color:#64748b;">${s.email}</td>
                        <td style="padding:10px 14px;text-align:right;">
                            <button data-id="${s.id}" class="btn-keluarkan" style="all:unset;color:#f43f5e;font-size:12px;font-weight:800;cursor:pointer;">Keluarkan</button>
                        </td>
                    </tr>
                `).join("");
                $("#tabelAnggota").html(html);
                $(".btn-keluarkan").on("click", function () { keluarkanAnggota(Number($(this).data("id"))); });
            }

            function isiFilterProdi() {
                const $filter = $("#filterProdiBaru");
                const current = $filter.val() || "";
                const daftarProdi = [...new Set(anggotaAvailable.map((s) => s.program_study_name || "Tanpa Program Studi"))].sort();
                $filter.html('<option value="">Semua Program Studi</option>' + daftarProdi.map((p) => `<option value="${p}">${p}</option>`).join(""));
                $filter.val(current);
            }

            function renderPilihanMahasiswa() {
                const keyword = ($("#searchMahasiswaBaru").val() || "").toLowerCase().trim();
                const prodiFilter = $("#filterProdiBaru").val() || "";

                const tersedia = anggotaAvailable.filter((s) => {
                    const prodi = s.program_study_name || "Tanpa Program Studi";
                    if (prodiFilter && prodi !== prodiFilter) return false;
                    if (keyword && !(s.name.toLowerCase().includes(keyword) || s.email.toLowerCase().includes(keyword))) return false;
                    return true;
                });

                const grup = {};
                tersedia.forEach((s) => {
                    const prodi = s.program_study_name || "Tanpa Program Studi";
                    (grup[prodi] = grup[prodi] || []).push(s);
                });

                const $select = $("#selectMahasiswaBaru").empty();
                const prodiUrut = Object.keys(grup).sort();

                if (!prodiUrut.length) {
                    $select.append(`<option value="" disabled>Tidak ada mahasiswa yang cocok</option>`);
                    return;
                }

                prodiUrut.forEach((prodi) => {
                    const $grp = $(`<optgroup label="${prodi} (${grup[prodi].length})"></optgroup>`);
                    grup[prodi].forEach((s) => $grp.append(`<option value="${s.id}">${s.name} — ${s.email}</option>`));
                    $select.append($grp);
                });
            }

            $("#searchMahasiswaBaru").on("keyup", renderPilihanMahasiswa);
            $("#filterProdiBaru").on("change", renderPilihanMahasiswa);

            $("#btnTambahAnggota").on("click", function () {
                const studentId = $("#selectMahasiswaBaru").val();
                if (!studentId || !activeGroupId) return;
                $("#anggotaError").hide();

                $.ajax({
                    url: `${URL_BASE}/kelompok/${activeGroupId}/anggota`,
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: { student_id: studentId },
                }).done(function () {
                    muatAnggota();
                }).fail(function (xhr) {
                    $("#anggotaError").text((xhr.responseJSON && xhr.responseJSON.message) || "Gagal menambahkan anggota.").show();
                });
            });

            function keluarkanAnggota(studentId) {
                if (!activeGroupId) return;
                if (!confirm("Keluarkan mahasiswa ini dari kelompok?")) return;

                $.ajax({
                    url: `${URL_BASE}/kelompok/${activeGroupId}/anggota/${studentId}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function () {
                    muatAnggota();
                }).fail(function (xhr) {
                    $("#anggotaError").text((xhr.responseJSON && xhr.responseJSON.message) || "Gagal mengeluarkan anggota.").show();
                });
            }

            $("#btnUploadExcel").on("click", function () {
                const file = $("#inputExcelAnggota")[0].files[0];
                if (!file || !activeGroupId) {
                    $("#anggotaError").text("Pilih file Excel/CSV dulu.").show();
                    return;
                }
                $("#anggotaError").hide();
                $("#anggotaInfo").hide();

                const formData = new FormData();
                formData.append("file", file);

                const $btn = $(this);
                $btn.prop("disabled", true);

                $.ajax({
                    url: `${URL_BASE}/kelompok/${activeGroupId}/anggota/import`,
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: formData,
                    contentType: false,
                    processData: false,
                }).done(function (result) {
                    $("#anggotaInfo").text(result.message).show();
                    $("#inputExcelAnggota").val("");
                    muatAnggota();
                }).fail(function (xhr) {
                    $("#anggotaError").text((xhr.responseJSON && xhr.responseJSON.message) || "Gagal mengimpor file.").show();
                }).always(function () {
                    $btn.prop("disabled", false);
                });
            });

            muatData();
        });
    </script>
@endpush