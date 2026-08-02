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
            <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Administrasi</p>
            <h2 class="text-2xl font-extrabold text-slate-800 m-0">{{ $data['title'] }}</h2>
            <p class="text-xs text-slate-400 m-0 mt-1">
                Atur anggota tiap kelompok. Untuk menambah kelompok baru atau mengganti mentor/advisor-nya, buka
                <a href="{{ route('admin.data-master.index') }}" class="text-teal-600 font-bold hover:underline">Kelola Data Master &rarr; Data Kelompok</a>.
            </p>
        </div>
    </div>

    @if ($groups->isEmpty())
        <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center">
            <p class="text-sm text-slate-500 m-0">
                Belum ada kelompok. Buat dulu di
                <a href="{{ route('admin.data-master.index') }}" class="text-teal-600 font-bold hover:underline">Kelola Data Master &rarr; Data Kelompok</a>.
            </p>
        </div>
    @endif

    <div id="kelompokGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"></div>

    <!-- ===== MODAL KELOLA ANGGOTA ===== -->
    <div id="modalAnggota" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[85vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-1">
                <div>
                    <h3 id="modalAnggotaTitle" class="text-lg font-extrabold text-slate-800 m-0">-</h3>
                    <p id="modalAnggotaSub" class="text-xs text-slate-400 m-0 mt-1">-</p>
                </div>
                <button id="btnCloseAnggota" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div id="anggotaError" class="hidden mt-3 text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-200 rounded-lg px-3 py-2"></div>

            <!-- Tambah anggota -->
            <div class="mt-4 flex flex-col sm:flex-row gap-2">
                <div class="flex-1 flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
                    <input type="text" id="searchMahasiswaBaru" placeholder="Cari nama / email mahasiswa..."
                        class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
                </div>
                <select id="filterProdiBaru"
                    class="sm:w-52 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                    <option value="">Semua Program Studi</option>
                </select>
            </div>
            <div class="mt-2 flex items-center gap-2">
                <select id="selectMahasiswaBaru" size="6"
                    class="flex-1 border border-slate-200 rounded-xl px-3.5 py-2 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                </select>
                <button id="btnTambahAnggota"
                    class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition shrink-0 self-start">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>Tambah
                </button>
            </div>
            <p class="text-[11px] text-slate-400 mt-1.5 mb-4">
                Hanya menampilkan mahasiswa yang belum tergabung di kelompok manapun. Pilih satu nama di daftar, lalu klik Tambah.
            </p>

            <!-- Daftar anggota -->
            <div class="border border-slate-200 rounded-xl overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="text-left text-[11px] font-bold uppercase tracking-wide text-slate-400 px-4 py-2.5">Nama</th>
                            <th class="text-left text-[11px] font-bold uppercase tracking-wide text-slate-400 px-4 py-2.5">Email</th>
                            <th class="text-right text-[11px] font-bold uppercase tracking-wide text-slate-400 px-4 py-2.5">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelAnggota"></tbody>
                </table>
                <p id="anggotaKosong" class="hidden text-center text-sm text-slate-400 py-6">Belum ada anggota di kelompok ini.</p>
            </div>
        </div>
    </div>
@endsection

@php
    $groupsJson = $groups->map(fn($g) => [
        'id' => $g->id,
        'code' => $g->code,
        'name' => $g->name,
        'mentor' => $g->mentor?->name,
        'advisor' => $g->advisor?->name,
        'max_member' => $g->max_member,
        'member_count' => $g->members_count,
    ]);
    $studentsJson = $students->map(fn($s) => [
        'id' => $s->id,
        'name' => $s->name,
        'email' => $s->email,
        'prodi' => $s->program_study_name,
        'group_id' => $memberMap[$s->id] ?? null,
    ]);
@endphp

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(function () {
            const CSRF_TOKEN = "{{ csrf_token() }}";
            let groupList = @json($groupsJson);
            let studentList = @json($studentsJson);
            let activeGroupId = null;

            function initialsColor(id) {
                const palette = ['bg-teal-50 text-teal-600', 'bg-indigo-50 text-indigo-600', 'bg-rose-50 text-rose-500', 'bg-amber-50 text-amber-600', 'bg-lime-50 text-lime-600'];
                return palette[id % palette.length];
            }

            function renderGrid() {
                const $grid = $("#kelompokGrid");
                $grid.empty();
                groupList.forEach((g) => {
                    const penuh = g.member_count >= g.max_member;
                    $grid.append(`
                        <div class="bg-white border border-slate-200 rounded-2xl p-5">
                            <div class="flex items-start justify-between gap-3">
                                <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 ${initialsColor(g.id)}">
                                    <i data-lucide="users-round" class="w-5 h-5"></i>
                                </div>
                                <span class="text-[11px] font-bold px-2.5 py-1 rounded-full ${penuh ? 'bg-rose-50 text-rose-500' : 'bg-teal-50 text-teal-600'}">
                                    ${g.member_count}/${g.max_member} anggota
                                </span>
                            </div>
                            <h3 class="text-base font-extrabold text-slate-800 mt-3 mb-0.5">${g.name}</h3>
                            <p class="text-xs text-slate-400 m-0 mb-3">Kode: ${g.code}</p>
                            <div class="text-xs text-slate-500 space-y-1 mb-4">
                                <p class="m-0"><span class="font-bold text-slate-600">Mentor:</span> ${g.mentor || '-'}</p>
                                <p class="m-0"><span class="font-bold text-slate-600">Advisor:</span> ${g.advisor || '-'}</p>
                            </div>
                            <button data-id="${g.id}" class="btn-kelola-anggota w-full inline-flex items-center justify-center gap-2 bg-slate-800 hover:bg-slate-900 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
                                <i data-lucide="settings-2" class="w-4 h-4"></i>Kelola Anggota
                            </button>
                        </div>
                    `);
                });
                if (window.lucide) lucide.createIcons();
                $(".btn-kelola-anggota").on("click", function () {
                    bukaModalAnggota(Number($(this).data("id")));
                });
            }

            function renderAnggota() {
                const group = groupList.find((g) => g.id === activeGroupId);
                if (!group) return;

                $("#modalAnggotaTitle").text(`Kelola Anggota — ${group.name}`);
                $("#modalAnggotaSub").text(`${group.member_count}/${group.max_member} anggota`);

                const anggota = studentList.filter((s) => s.group_id === activeGroupId);
                const $tbody = $("#tabelAnggota").empty();
                $("#anggotaKosong").toggleClass("hidden", anggota.length > 0);

                anggota.forEach((s) => {
                    $tbody.append(`
                        <tr class="border-b border-slate-100 last:border-0" data-student-id="${s.id}">
                            <td class="px-4 py-2.5 text-sm font-semibold text-slate-800">${s.name}</td>
                            <td class="px-4 py-2.5 text-sm text-slate-500">${s.email}</td>
                            <td class="px-4 py-2.5 text-right">
                                <button data-id="${s.id}" class="btn-keluarkan text-rose-500 hover:text-rose-700 text-xs font-bold">Keluarkan</button>
                            </td>
                        </tr>
                    `);
                });

                // dropdown cuma nampilin mahasiswa yang belum punya kelompok sama sekali
                isiFilterProdi();
                renderPilihanMahasiswa();

                $(".btn-keluarkan").on("click", function () {
                    keluarkanAnggota(Number($(this).data("id")));
                });
            }

            function isiFilterProdi() {
                const $filter = $("#filterProdiBaru");
                const prodiTerpakai = $filter.val() || "";
                const daftarProdi = [...new Set(
                    studentList.filter((s) => !s.group_id).map((s) => s.prodi || "Tanpa Program Studi")
                )].sort();

                $filter.html('<option value="">Semua Program Studi</option>' +
                    daftarProdi.map((p) => `<option value="${p}">${p}</option>`).join(""));
                $filter.val(prodiTerpakai);
            }

            function renderPilihanMahasiswa() {
                const keyword = ($("#searchMahasiswaBaru").val() || "").toLowerCase().trim();
                const prodiFilter = $("#filterProdiBaru").val() || "";

                const tersedia = studentList.filter((s) => {
                    if (s.group_id) return false;
                    const prodi = s.prodi || "Tanpa Program Studi";
                    if (prodiFilter && prodi !== prodiFilter) return false;
                    if (keyword && !(s.name.toLowerCase().includes(keyword) || s.email.toLowerCase().includes(keyword))) return false;
                    return true;
                });

                // kelompokkan per program studi biar gampang disisir
                const grup = {};
                tersedia.forEach((s) => {
                    const prodi = s.prodi || "Tanpa Program Studi";
                    (grup[prodi] = grup[prodi] || []).push(s);
                });

                const $select = $("#selectMahasiswaBaru").empty();
                const prodiUrut = Object.keys(grup).sort();

                if (!prodiUrut.length) {
                    $select.append(`<option value="" disabled>Tidak ada mahasiswa yang cocok</option>`);
                    return;
                }

                prodiUrut.forEach((prodi) => {
                    const $group = $(`<optgroup label="${prodi} (${grup[prodi].length})"></optgroup>`);
                    grup[prodi].forEach((s) => {
                        $group.append(`<option value="${s.id}">${s.name} — ${s.email}</option>`);
                    });
                    $select.append($group);
                });
            }

            $("#searchMahasiswaBaru").on("keyup", renderPilihanMahasiswa);
            $("#filterProdiBaru").on("change", renderPilihanMahasiswa);

            function bukaModalAnggota(groupId) {
                activeGroupId = groupId;
                $("#anggotaError").addClass("hidden");
                $("#searchMahasiswaBaru").val("");
                renderAnggota();
                $("#modalAnggota").removeClass("hidden").addClass("flex");
            }
            function tutupModalAnggota() {
                $("#modalAnggota").addClass("hidden").removeClass("flex");
                activeGroupId = null;
            }
            $("#btnCloseAnggota").on("click", tutupModalAnggota);
            $("#modalAnggota").on("click", function (e) { if (e.target === this) tutupModalAnggota(); });

            function tampilkanErrorAnggota(pesan) {
                $("#anggotaError").text(pesan).removeClass("hidden");
            }

            $("#btnTambahAnggota").on("click", function () {
                const studentId = $("#selectMahasiswaBaru").val();
                if (!studentId || !activeGroupId) return;
                $("#anggotaError").addClass("hidden");

                $.ajax({
                    url: `{{ url()->current() }}/${activeGroupId}/anggota`,
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: { student_id: studentId },
                }).done(function (result) {
                    const idx = studentList.findIndex((s) => s.id === result.student.id);
                    if (idx > -1) studentList[idx].group_id = activeGroupId;

                    const g = groupList.find((g) => g.id === activeGroupId);
                    if (g) g.member_count = result.member_count;

                    renderGrid();
                    renderAnggota();
                }).fail(function (xhr) {
                    tampilkanErrorAnggota((xhr.responseJSON && xhr.responseJSON.message) || "Gagal menambahkan anggota.");
                });
            });

            function keluarkanAnggota(studentId) {
                if (!activeGroupId) return;
                if (!confirm("Keluarkan mahasiswa ini dari kelompok?")) return;

                $.ajax({
                    url: `{{ url()->current() }}/${activeGroupId}/anggota/${studentId}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    const idx = studentList.findIndex((s) => s.id === studentId);
                    if (idx > -1) studentList[idx].group_id = null;

                    const g = groupList.find((g) => g.id === activeGroupId);
                    if (g) g.member_count = result.member_count;

                    renderGrid();
                    renderAnggota();
                }).fail(function (xhr) {
                    tampilkanErrorAnggota((xhr.responseJSON && xhr.responseJSON.message) || "Gagal mengeluarkan anggota.");
                });
            }

            renderGrid();
        });
    </script>
@endpush
