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
        <button id="btnTambah"
            class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
            <i data-lucide="user-plus" class="w-4 h-4"></i>Tambah {{ $roleLabel }}
        </button>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
        <div class="flex items-center gap-2.5 p-4 border-b border-slate-200 flex-wrap">
            <select id="filterStatus"
                class="text-sm font-semibold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 cursor-pointer focus:outline-none focus:border-teal-600">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
            <div
                class="flex-1 min-w-[200px] flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
                <input type="text" id="searchPengguna" placeholder="Cari nama atau email..."
                    class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th
                            class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                            No</th>
                            @if ($showNim)
                            <th
                                class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                                NPM</th>
                        @endif
                        <th
                            class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                            Nama</th>
                        <th
                            class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                            Email</th>
                        @if ($showAcademic)
                            <th
                                class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                                No. HP</th>
                            <th
                                class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                                Prodi</th>
                        @endif
                        <th
                            class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                            Status</th>
                        
                        <th
                            class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelPengguna"></tbody>
            </table>
        </div>
        <div class="flex items-center justify-between p-4 flex-wrap gap-3">
            <p id="paginationInfo" class="text-xs font-semibold text-slate-400 m-0">Showing 0 of 0</p>
            <div id="paginationBtns" class="flex items-center gap-1.5"></div>
        </div>
    </div>

    <!-- ===== MODAL TAMBAH / EDIT PENGGUNA ===== -->
    <div id="modalForm" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-1">
                <div>
                    <h3 id="modalFormTitle" class="text-lg font-extrabold text-slate-800 m-0">Tambah {{ $roleLabel }}</h3>
                    <p class="text-xs text-slate-400 m-0 mt-1">Buat akun {{ strtolower($roleLabel) }} baru untuk sistem
                        PKKMB-KT.</p>
                </div>
                <button id="btnCloseForm" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form id="formPengguna" class="mt-4">
                <p id="formError"
                    class="hidden text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg px-3 py-2 mb-3">
                </p>
                <div class="grid grid-cols-1 gap-4">
                      @if ($showNim)
                        <div>
                            <label for="inputNpm" class="block text-xs font-bold text-slate-500 mb-1.5">NPM</label>
                            <input type="text" id="inputNpm" placeholder="CONTOH: 2210631170001" required
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                        </div>
                    @endif
                    <div>
                        <label for="inputNama" class="block text-xs font-bold text-slate-500 mb-1.5">Nama Lengkap</label>
                        <input type="text" id="inputNama" placeholder="CONTOH: AZIR GANTENG" required
                            oninput="this.value = this.value.toUpperCase()"
                            class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                    </div>
                    <div>
                        <label for="inputEmail" class="block text-xs font-bold text-slate-500 mb-1.5">Email</label>
                        <input type="email" id="inputEmail" placeholder="nama@pkkmb.ac.id" required
                            class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                    </div>
                    <div>
                        <label for="inputPassword" class="block text-xs font-bold text-slate-500 mb-1.5">Password</label>
                        <div class="relative">
                            <input type="password" id="inputPassword" placeholder="Minimal 8 karakter"
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 pr-10 focus:outline-none focus:border-teal-600" />
                            <button type="button" id="btnTogglePw"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-teal-600">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <p id="hintPassword" class="text-xs text-slate-400 mt-1.5">Kosongkan saat edit jika tidak ingin
                            mengubah password.</p>
                    </div>
                    @if ($showAcademic)
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="inputPhone" class="block text-xs font-bold text-slate-500 mb-1.5">No. HP</label>
                                <input type="text" id="inputPhone" placeholder="08xxxxxxxxxx" required
                                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                            </div>
                            <div>
                                <label for="inputGender" class="block text-xs font-bold text-slate-500 mb-1.5">Jenis
                                    Kelamin</label>
                                <select id="inputGender" required
                                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                                    <option value="">Pilih</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="inputFakultas" class="block text-xs font-bold text-slate-500 mb-1.5">Fakultas</label>
                            <select id="inputFakultas" required
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                                <option value="">Pilih Fakultas</option>
                                @foreach ($faculties as $f)
                                    <option value="{{ $f->name }}">{{ $f->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="inputProdi" class="block text-xs font-bold text-slate-500 mb-1.5">Program Studi</label>
                            <select id="inputProdi" required disabled
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600 disabled:bg-slate-50">
                                <option value="">Pilih Fakultas dahulu</option>
                            </select>
                        </div>
                    @endif
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-1.5">Status</label>
                        <div class="flex items-center gap-3 h-[42px]">
                            <label class="inline-flex items-center gap-1.5 text-sm text-slate-700 cursor-pointer">
                                <input type="radio" name="statusPengguna" value="aktif" checked class="accent-teal-600" />
                                Aktif
                            </label>
                            <label class="inline-flex items-center gap-1.5 text-sm text-slate-700 cursor-pointer">
                                <input type="radio" name="statusPengguna" value="nonaktif" class="accent-teal-600" />
                                Nonaktif
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-3 mt-6">
                    <button type="button" id="btnBatalForm"
                        class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                    <button type="submit" id="btnSimpanForm"
                        class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MODAL DETAIL PENGGUNA ===== -->
    <div id="modalDetail" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md p-6">
            <div class="flex items-start justify-between gap-4 mb-4">
                <h3 class="text-lg font-extrabold text-slate-800 m-0">Detail {{ $roleLabel }}</h3>
                <button id="btnCloseDetail" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <div class="divide-y divide-slate-100">
                <div class="flex items-center justify-between py-2.5"><span
                        class="text-xs font-bold text-slate-400">Nama</span><span id="detailNama"
                        class="text-sm font-semibold text-slate-800">-</span></div>
                <div class="flex items-center justify-between py-2.5"><span
                        class="text-xs font-bold text-slate-400">Email</span><span id="detailEmail"
                        class="text-sm font-semibold text-slate-800">-</span></div>
                @if ($showNim)
                    <div class="flex items-center justify-between py-2.5"><span
                            class="text-xs font-bold text-slate-400">NPM</span><span id="detailNpm"
                            class="text-sm font-semibold text-slate-800">-</span></div>
                @endif
                @if ($showAcademic)
                    <div class="flex items-center justify-between py-2.5"><span class="text-xs font-bold text-slate-400">No.
                            HP</span><span id="detailPhone" class="text-sm font-semibold text-slate-800">-</span></div>
                    <div class="flex items-center justify-between py-2.5"><span class="text-xs font-bold text-slate-400">Jenis
                            Kelamin</span><span id="detailGender" class="text-sm font-semibold text-slate-800">-</span></div>
                    <div class="flex items-center justify-between py-2.5"><span
                            class="text-xs font-bold text-slate-400">Fakultas</span><span id="detailFakultas"
                            class="text-sm font-semibold text-slate-800">-</span></div>
                    <div class="flex items-center justify-between py-2.5"><span
                            class="text-xs font-bold text-slate-400">Prodi</span><span id="detailProdi"
                            class="text-sm font-semibold text-slate-800">-</span></div>
                @endif
                <div class="flex items-center justify-between py-2.5"><span
                        class="text-xs font-bold text-slate-400">Status</span><span id="detailStatus"
                        class="text-sm font-semibold text-slate-800">-</span></div>
            </div>
            <div class="flex items-center justify-end mt-6">
                <button type="button" id="btnEditDariDetail"
                    class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Edit</button>
            </div>
        </div>
    </div>
@endsection

@php
    $penggunaListJson = $users->map(fn($u) => [
        'id' => $u->id,
        'npm' => $u->npm,
        'nama' => $u->name,
        'email' => $u->email,
        'status' => $u->status,
        'phone_no' => $u->phone_no,
        'faculty_name' => $u->faculty_name,
        'program_study_name' => $u->program_study_name,
        'gender' => $u->gender,
    ]);
@endphp

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(function () {

            // ===== Data asli dari database (dikirim server saat halaman dimuat) =====
            let penggunaList = @json($penggunaListJson);
            const SHOW_ACADEMIC = @json($showAcademic);
            const SHOW_NIM = @json($showNim);
            const FACULTIES = @json($faculties); // [{id, name, program_studies: [{id, name}, ...]}]
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            // Base URL sama untuk index/store, tinggal tambah /{id} untuk update & delete.
            // Otomatis mengikuti halaman mana pun ini dipanggil (kelola-mahasiswa, kelola-mentor, dst).
            const URL_BASE = "{{ url()->current() }}";

            const PER_PAGE = 5;
            let currentPage = 1;
            let editingId = null;

            function filteredData() {
                const status = $("#filterStatus").val();
                const q = $("#searchPengguna").val().trim().toLowerCase();
                return penggunaList.filter((p) =>
                    (!status || p.status === status) &&
                    (!q || p.nama.toLowerCase().includes(q) || p.email.toLowerCase().includes(q))
                );
            }

            function badgeClass(status) {
                return status === "aktif" ? "bg-teal-50 text-teal-600" : "bg-rose-50 text-rose-500";
            }

            function genderLabel(g) {
                return g === "L" ? "Laki-laki" : g === "P" ? "Perempuan" : "-";
            }

            // Isi ulang dropdown Program Studi sesuai Fakultas yang dipilih.
            // Kalau selectedProdiName cocok dengan salah satu opsi, otomatis ke-pilih (dipakai saat bukaForm edit).
            function isiOpsiProdi(facultyName, selectedProdiName) {
                const faculty = FACULTIES.find((f) => f.name === facultyName);
                const programs = faculty ? faculty.program_studies : [];
                const opts = programs
                    .map((p) => `<option value="${p.name}" ${selectedProdiName === p.name ? "selected" : ""}>${p.name}</option>`)
                    .join("");
                $("#inputProdi")
                    .html(`<option value="">${programs.length ? "Pilih Program Studi" : "Pilih Fakultas dahulu"}</option>${opts}`)
                    .prop("disabled", programs.length === 0);
            }

            $("#inputFakultas").on("change", function () {
                isiOpsiProdi($(this).val(), null);
            });

            function renderTabel() {
                const data = filteredData();
                const totalData = data.length;
                const totalPage = Math.max(1, Math.ceil(totalData / PER_PAGE));
                if (currentPage > totalPage) currentPage = totalPage;
                const start = (currentPage - 1) * PER_PAGE;
                const pageData = data.slice(start, start + PER_PAGE);
                const totalCols = (SHOW_ACADEMIC ? 7 : 5) + (SHOW_NIM ? 1 : 0);

                let html;
                if (pageData.length === 0) {
                    html = `<tr><td colspan="${totalCols}" class="text-center py-6 text-slate-400 text-sm">Tidak ada data ditemukan.</td></tr>`;
                } else {
                    html = pageData.map((p, idx) => `
                            <tr class="hover:bg-slate-50">
                                <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${start + idx + 1}</td>
                                <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200 font-semibold">${p.nama}</td>
                                <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${p.email}</td>
                                ${SHOW_ACADEMIC ? `
                                <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${p.phone_no ?? "-"}</td>
                                <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${p.program_study_name ?? "-"}</td>
                                ` : ""}
                                <td class="px-3.5 py-3 border-b border-slate-200">
                                    <span class="inline-flex items-center gap-1 text-[11px] font-extrabold px-2.5 py-1 rounded-full ${badgeClass(p.status)}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>${p.status === "aktif" ? "Aktif" : "Nonaktif"}
                                    </span>
                                </td>
                                ${SHOW_NIM ? `
                                <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${p.npm ?? "-"}</td>
                                ` : ""}
                                <td class="px-3.5 py-3 border-b border-slate-200">
                                    <div class="flex items-center gap-1">
                                        <button data-aksi="lihat" data-id="${p.id}" aria-label="Detail" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="eye" class="w-4 h-4"></i></button>
                                        <button data-aksi="edit" data-id="${p.id}" aria-label="Edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                        <button data-aksi="hapus" data-id="${p.id}" aria-label="Hapus" class="w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                    </div>
                                </td>
                            </tr>`).join("");
                }
                $("#tabelPengguna").html(html);
                $("#paginationInfo").text(
                    totalData === 0 ? "Showing 0 of 0" : `Showing ${start + 1}-${Math.min(start + PER_PAGE, totalData)} of ${totalData}`
                );
                renderPaginationBtns(totalPage);
                lucide.createIcons();
                pasangEventAksiBaris();
            }

            function renderPaginationBtns(totalPage) {
                const btnBase = "w-8 h-8 flex items-center justify-center rounded-lg border text-sm font-semibold transition";
                let html = `<button id="pgPrev" aria-label="Sebelumnya" class="${btnBase} border-slate-200 text-slate-500 hover:bg-slate-50"><i data-lucide="chevron-left" class="w-4 h-4"></i></button>`;
                for (let p = 1; p <= totalPage; p++) {
                    const active = p === currentPage ? "bg-teal-600 text-white border-teal-600" : "border-slate-200 text-slate-600 hover:bg-slate-50";
                    html += `<button data-page="${p}" class="${btnBase} ${active}">${p}</button>`;
                }
                html += `<button id="pgNext" aria-label="Berikutnya" class="${btnBase} border-slate-200 text-slate-500 hover:bg-slate-50"><i data-lucide="chevron-right" class="w-4 h-4"></i></button>`;
                $("#paginationBtns").html(html);
                lucide.createIcons();
                $("[data-page]").on("click", function () { currentPage = Number($(this).data("page")); renderTabel(); });
                $("#pgPrev").on("click", () => { if (currentPage > 1) { currentPage--; renderTabel(); } });
                $("#pgNext").on("click", () => { if (currentPage < totalPage) { currentPage++; renderTabel(); } });
            }

            function pasangEventAksiBaris() {
                $('[data-aksi="lihat"]').on("click", function () { bukaDetail(Number($(this).data("id"))); });
                $('[data-aksi="edit"]').on("click", function () { bukaForm(Number($(this).data("id"))); });
                $('[data-aksi="hapus"]').on("click", function () { hapusPengguna(Number($(this).data("id"))); });
            }

            $("#filterStatus").on("change", () => { currentPage = 1; renderTabel(); });
            $("#searchPengguna").on("keyup", () => { currentPage = 1; renderTabel(); });

            const $modalForm = $("#modalForm");
            const $modalDetail = $("#modalDetail");
            const $formError = $("#formError");

            function bukaForm(id) {
                editingId = id || null;
                $formError.addClass("hidden");
                const data = id ? penggunaList.find((p) => p.id === id) : null;
                $("#modalFormTitle").text(id ? "Edit {{ $roleLabel }}" : "Tambah {{ $roleLabel }}");
                $("#inputNama").val(data ? data.nama : "");
                $("#inputEmail").val(data ? data.email : "");
                $("#inputPassword").val("").prop("required", !id);
                $("#hintPassword").toggle(!!id);

                if (SHOW_NIM) {
                    $("#inputNpm").val(data ? data.npm : "");
                }

                if (SHOW_ACADEMIC) {
                    $("#inputPhone").val(data ? data.phone_no : "");
                    $("#inputGender").val(data ? data.gender : "");
                    $("#inputFakultas").val(data ? data.faculty_name : "");
                    isiOpsiProdi(data ? data.faculty_name : "", data ? data.program_study_name : null);
                }

                $('input[name="statusPengguna"]').each(function () { this.checked = this.value === (data ? data.status : "aktif"); });
                $modalForm.removeClass("hidden").addClass("flex");
            }
            function tutupForm() { $modalForm.addClass("hidden").removeClass("flex"); editingId = null; $("#formPengguna")[0].reset(); }

            $("#btnTambah").on("click", () => bukaForm(null));
            $("#btnCloseForm").on("click", tutupForm);
            $("#btnBatalForm").on("click", tutupForm);
            $modalForm.on("click", function (e) { if (e.target === this) tutupForm(); });
            $("#btnTogglePw").on("click", () => {
                const $inp = $("#inputPassword");
                $inp.attr("type", $inp.attr("type") === "password" ? "text" : "password");
            });

            $("#formPengguna").on("submit", function (e) {
                e.preventDefault();
                $formError.addClass("hidden");

                const statusVal = $('input[name="statusPengguna"]:checked').val() || "aktif";
                const payload = {
                    name: $("#inputNama").val().trim().toUpperCase(),
                    email: $("#inputEmail").val().trim(),
                    password: $("#inputPassword").val(),
                    status: statusVal,
                };

                if (SHOW_NIM) {
                    payload.npm = $("#inputNpm").val().trim();
                }

                if (SHOW_ACADEMIC) {
                    payload.phone_no = $("#inputPhone").val().trim();
                    payload.gender = $("#inputGender").val();
                    payload.faculty_name = $("#inputFakultas").val().trim();
                    payload.program_study_name = $("#inputProdi").val().trim();
                }

                const $btnSimpan = $("#btnSimpanForm");
                $btnSimpan.prop("disabled", true);

                const url = editingId ? `${URL_BASE}/${editingId}` : URL_BASE;
                const method = editingId ? "PUT" : "POST";

                $.ajax({
                    url, method,
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: JSON.stringify(payload),
                }).done(function (result) {
                    const savedUser = {
                        id: result.user.id,
                        npm: result.user.npm,
                        nama: result.user.name,
                        email: result.user.email,
                        status: result.user.status,
                        phone_no: result.user.phone_no,
                        faculty_name: result.user.faculty_name,
                        program_study_name: result.user.program_study_name,
                        gender: result.user.gender,
                    };
                    if (editingId) {
                        const idx = penggunaList.findIndex((p) => p.id === editingId);
                        if (idx > -1) penggunaList[idx] = savedUser;
                    } else {
                        penggunaList.push(savedUser);
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

            let detailActiveId = null;
            function bukaDetail(id) {
                const p = penggunaList.find((x) => x.id === id);
                if (!p) return;
                detailActiveId = id;
                $("#detailNama").text(p.nama);
                $("#detailEmail").text(p.email);
                if (SHOW_NIM) {
                    $("#detailNpm").text(p.npm || "-");
                }
                if (SHOW_ACADEMIC) {
                    $("#detailPhone").text(p.phone_no || "-");
                    $("#detailGender").text(genderLabel(p.gender));
                    $("#detailFakultas").text(p.faculty_name || "-");
                    $("#detailProdi").text(p.program_study_name || "-");
                }
                $("#detailStatus").text(p.status === "aktif" ? "Aktif" : "Nonaktif");
                $modalDetail.removeClass("hidden").addClass("flex");
            }
            $("#btnCloseDetail").on("click", () => $modalDetail.addClass("hidden").removeClass("flex"));
            $modalDetail.on("click", function (e) { if (e.target === this) $modalDetail.addClass("hidden").removeClass("flex"); });
            $("#btnEditDariDetail").on("click", () => {
                const id = detailActiveId;
                $modalDetail.addClass("hidden").removeClass("flex");
                bukaForm(id);
            });

            function hapusPengguna(id) {
                const p = penggunaList.find((x) => x.id === id);
                if (!p) return;
                if (!confirm(`Hapus "${p.nama}"?`)) return;

                $.ajax({
                    url: `${URL_BASE}/${id}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    penggunaList = penggunaList.filter((x) => x.id !== id);
                    tampilkanToast(result.message);
                    renderTabel();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    tampilkanToast(result.message || "Gagal menghapus data.");
                });
            }

            renderTabel();
        });
    </script>
@endpush