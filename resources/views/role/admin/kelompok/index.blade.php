@extends('layouts.admin.main')
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: { preflight: false } // jangan reset style global, biar tidak bentrok dengan CSS halaman lain
        }
    </script>
    <style>
        .kk-badge { display: inline-flex; align-items: center; gap: 6px; font-size: 11px; font-weight: 700; padding: 5px 12px; border-radius: 999px; }
        .kk-badge .dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }
        .kk-badge.active { background: #e2f3f2; color: #0f8a8c; }
        .kk-badge.inactive { background: #fbeae8; color: #e0665a; }
        .kk-row-btn { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 9px; color: #5b6175; background: transparent; border: none; cursor: pointer; transition: background .15s, color .15s; }
        .kk-row-btn:hover { background: #eef0f8; color: #152159; }
        .kk-row-btn.danger:hover { background: #fbeae8; color: #e0665a; }
        .kk-progress-track { width: 100%; height: 6px; border-radius: 99px; background: #eef0f8; overflow: hidden; }
        .kk-progress-fill { height: 100%; border-radius: 99px; background: #16a0a1; }
        .kk-progress-fill.low { background: #e0665a; }
    </style>

    <div class="flex items-center justify-between flex-wrap gap-3 mb-5">
        <div>
            <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Kelola Data</p>
            <h2 class="text-2xl font-extrabold text-slate-800 m-0">{{ $data['title'] }}</h2>
        </div>
        <button id="btnTambahKelompok"
            class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
            <i data-lucide="plus" class="w-4 h-4"></i>Tambah Kelompok
        </button>
    </div>

    <!-- Mini stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
        <div class="bg-white border border-slate-200 rounded-2xl p-4 flex items-center gap-3">
            <span class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0"><i data-lucide="users-round" class="w-5 h-5"></i></span>
            <div><p class="text-xl font-extrabold text-slate-800 m-0">{{ $groups->count() }}</p><p class="text-xs text-slate-400 m-0">Total Kelompok</p></div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-4 flex items-center gap-3">
            <span class="w-11 h-11 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shrink-0"><i data-lucide="user-round" class="w-5 h-5"></i></span>
            <div><p class="text-xl font-extrabold text-slate-800 m-0">{{ $groups->count() ? round($groups->avg('members_count'), 1) : 0 }}</p><p class="text-xs text-slate-400 m-0">Rata-rata Anggota</p></div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-4 flex items-center gap-3">
            <span class="w-11 h-11 rounded-xl bg-lime-50 text-lime-600 flex items-center justify-center shrink-0"><i data-lucide="trending-up" class="w-5 h-5"></i></span>
            <div>
                <p class="text-xl font-extrabold text-slate-800 m-0">{{ $groups->count() ? round($groups->avg(fn($g) => $g->max_member ? ($g->members_count / $g->max_member * 100) : 0)) : 0 }}%</p>
                <p class="text-xs text-slate-400 m-0">Kapasitas Rata-rata</p>
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-4 flex items-center gap-3">
            <span class="w-11 h-11 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center shrink-0"><i data-lucide="user-x" class="w-5 h-5"></i></span>
            <div><p class="text-xl font-extrabold text-slate-800 m-0">{{ $groups->whereNull('mentor_id')->count() }}</p><p class="text-xs text-slate-400 m-0">Belum Ada Mentor</p></div>
        </div>
    </div>

    @if ($groups->isEmpty())
        <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center">
            <p class="text-sm text-slate-500 m-0">Belum ada kelompok. Klik "Tambah Kelompok" di atas untuk membuat yang pertama.</p>
        </div>
    @else
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
            <div class="p-4 flex flex-col sm:flex-row gap-3 border-b border-slate-100">
                <div class="flex-1 flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
                    <input type="text" id="searchKelompok" placeholder="Cari nama kelompok atau mentor..."
                        class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
                </div>
                <select id="filterMentor" class="sm:w-52 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                    <option value="">Semua Mentor</option>
                    <option value="ada">Sudah Ada Mentor</option>
                    <option value="belum">Belum Ada Mentor</option>
                </select>
                <select id="filterProdi" class="sm:w-52 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                    <option value="">Semua Program Studi</option>
                    @foreach ($faculties as $f)
                        @foreach ($f->programStudies as $p)
                            <option value="{{ $p->name }}">{{ $p->name }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="text-left text-[11px] font-bold uppercase tracking-wide text-slate-400 px-4 py-3">Kelompok</th>
                            <th class="text-left text-[11px] font-bold uppercase tracking-wide text-slate-400 px-4 py-3">Mentor</th>
                            <th class="text-left text-[11px] font-bold uppercase tracking-wide text-slate-400 px-4 py-3">Anggota</th>
                            <th class="text-left text-[11px] font-bold uppercase tracking-wide text-slate-400 px-4 py-3">Kapasitas</th>
                            <th class="text-left text-[11px] font-bold uppercase tracking-wide text-slate-400 px-4 py-3">Status</th>
                            <th class="text-right text-[11px] font-bold uppercase tracking-wide text-slate-400 px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelKelompok"></tbody>
                </table>
                <p id="kelompokKosong" class="hidden text-center text-sm text-slate-400 py-10">Tidak ada kelompok yang cocok dengan pencarian/filter.</p>
            </div>
        </div>
    @endif

    <!-- ===== MODAL TAMBAH / EDIT KELOMPOK ===== -->
    <div id="modalKelompok" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md p-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <h3 id="modalKelompokTitle" class="text-lg font-extrabold text-slate-800 m-0">Tambah Kelompok</h3>
                <button id="btnCloseKelompok" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form id="formKelompok" class="grid grid-cols-1 gap-4">
                <p id="kelompokFormError" class="hidden text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg px-3 py-2"></p>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Kode Kelompok</label>
                    <input type="text" id="inputKode" required oninput="this.value = this.value.toUpperCase()" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Nama Kelompok</label>
                    <input type="text" id="inputNamaKelompok" required oninput="this.value = this.value.toUpperCase()" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Mentor</label>
                    <select id="inputMentorId" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                        <option value="">Belum ada</option>
                        @foreach ($mentors as $m)
                            <option value="{{ $m->id }}">{{ $m->name }}{{ $m->program_study_name ? ' — ' . $m->program_study_name : '' }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Pembimbing</label>
                    <select id="inputAdvisorId" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                        <option value="">Belum ada</option>
                        @foreach ($advisors as $a)
                            <option value="{{ $a->id }}">{{ $a->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Koordinator</label>
                    <select id="inputKoordinatorId" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                        <option value="">Belum ada</option>
                        @foreach ($koordinators as $k)
                            <option value="{{ $k->id }}">{{ $k->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Maks. Anggota</label>
                    <input type="number" id="inputMaxMember" min="1" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                </div>
                <div class="flex items-center justify-end gap-3 mt-2">
                    <button type="button" id="btnBatalKelompok" class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                    <button type="submit" id="btnSimpanKelompok" class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MODAL DETAIL (lihat anggota & info, read-only) ===== -->
    <div id="modalDetail" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md max-h-[85vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                    <h3 id="modalDetailTitle" class="text-lg font-extrabold text-slate-800 m-0">-</h3>
                    <p id="modalDetailSub" class="text-xs text-slate-400 m-0 mt-1">-</p>
                </div>
                <button id="btnCloseDetail" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <div id="detailAnggotaList" class="divide-y divide-slate-100"></div>
            <p id="detailAnggotaKosong" class="hidden text-center text-sm text-slate-400 py-6">Belum ada anggota di kelompok ini.</p>
        </div>
    </div>

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
        'mentor_id' => $g->mentor_id,
        'advisor' => $g->advisor?->name,
        'advisor_id' => $g->advisor_id,
        'koordinator' => $g->koordinator?->name,
        'koordinator_id' => $g->koordinator_id,
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
            const DATA_MASTER_URL = "{{ route('admin.data-master.index') }}"; // .../data-master -> tambah "/kelompok" di belakangnya
            let groupList = @json($groupsJson);
            let studentList = @json($studentsJson);
            let activeGroupId = null;
            let editingGroupId = null;

            // ================== TABEL KELOMPOK ==================
            function renderTable() {
                const keyword = ($("#searchKelompok").val() || "").toLowerCase().trim();
                const filterMentor = $("#filterMentor").val() || "";
                const filterProdi = $("#filterProdi").val() || ""; // tambahan

                const tampil = groupList.filter((g) => {
                    if (keyword && !((g.name || "").toLowerCase().includes(keyword) || (g.mentor || "").toLowerCase().includes(keyword) || (g.code || "").toLowerCase().includes(keyword))) return false;
                    if (filterMentor === "ada" && !g.mentor_id) return false;
                    if (filterMentor === "belum" && g.mentor_id) return false;
                    if (filterProdi && !studentList.some((s) => s.group_id === g.id && s.prodi === filterProdi)) return false; // tambahan
                    return true;
                });

                $("#kelompokKosong").toggleClass("hidden", tampil.length > 0);
                const $tbody = $("#tabelKelompok").empty();

                tampil.forEach((g) => {
                    const persen = g.max_member ? Math.round((g.member_count / g.max_member) * 100) : 0;
                    const statusAktif = !!g.mentor_id;

                    $tbody.append(`
                        <tr class="border-b border-slate-100 last:border-0">
                            <td class="px-4 py-3">
                                <p class="text-sm font-bold text-slate-800 m-0">${g.name}</p>
                                <p class="text-xs text-slate-400 m-0">${g.code}</p>
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600">
                                <p class="m-0">${g.mentor || '<span class="text-slate-400 italic">Belum ada mentor</span>'}</p>
                                <p class="text-xs text-slate-400 m-0 mt-0.5">Pembimbing: ${g.advisor || '-'} &middot; Koordinator: ${g.koordinator || '-'}</p>
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600">${g.member_count} mahasiswa</td>
                            <td class="px-4 py-3" style="min-width:140px">
                                <div class="flex items-center justify-between text-[11px] text-slate-400 mb-1">
                                    <span>Kapasitas</span><span>${persen}%</span>
                                </div>
                                <div class="kk-progress-track"><div class="kk-progress-fill ${persen < 50 ? 'low' : ''}" style="width:${Math.min(persen,100)}%"></div></div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="kk-badge ${statusAktif ? 'active' : 'inactive'}"><span class="dot"></span>${statusAktif ? 'Aktif' : 'Perlu Tindak'}</span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <button class="kk-row-btn btn-detail" data-id="${g.id}" aria-label="Lihat anggota & progress"><i data-lucide="eye" class="w-4 h-4"></i></button>
                                    <button class="kk-row-btn btn-edit" data-id="${g.id}" aria-label="Edit kelompok"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                    <button class="kk-row-btn btn-kelola-anggota" data-id="${g.id}" aria-label="Kelola anggota"><i data-lucide="user-plus" class="w-4 h-4"></i></button>
                                    <button class="kk-row-btn btn-edit" data-id="${g.id}" aria-label="Tentukan mentor"><i data-lucide="user-round-cog" class="w-4 h-4"></i></button>
                                    <button class="kk-row-btn danger btn-hapus" data-id="${g.id}" aria-label="Hapus"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                </div>
                            </td>
                        </tr>
                    `);
                });

                if (window.lucide) lucide.createIcons();
                $(".btn-detail").off("click").on("click", function () { bukaDetail(Number($(this).data("id"))); });
                $(".btn-edit").off("click").on("click", function () { bukaFormKelompok(Number($(this).data("id"))); });
                $(".btn-kelola-anggota").off("click").on("click", function () { bukaModalAnggota(Number($(this).data("id"))); });
                $(".btn-hapus").off("click").on("click", function () { hapusKelompok(Number($(this).data("id"))); });
            }

            $("#searchKelompok").on("keyup", renderTable);
            $("#filterMentor").on("change", renderTable);
            $("#filterProdi").on("change", renderTable); // tambahan

            // ================== TAMBAH / EDIT KELOMPOK (reuse endpoint Data Master, type=kelompok) ==================
            const $modalKelompok = $("#modalKelompok");
            const $kelompokFormError = $("#kelompokFormError");

            function bukaFormKelompok(id) {
                editingGroupId = id || null;
                $kelompokFormError.addClass("hidden");
                const g = id ? groupList.find((x) => x.id === id) : null;

                $("#modalKelompokTitle").text(id ? "Edit Kelompok" : "Tambah Kelompok");
                $("#inputKode").val(g ? g.code : "");
                $("#inputNamaKelompok").val(g ? g.name : "");
                $("#inputMentorId").val(g && g.mentor_id ? g.mentor_id : "");
                $("#inputAdvisorId").val(g && g.advisor_id ? g.advisor_id : "");
                $("#inputKoordinatorId").val(g && g.koordinator_id ? g.koordinator_id : "");
                $("#inputMaxMember").val(g ? g.max_member : "");

                $modalKelompok.removeClass("hidden").addClass("flex");
            }
            function tutupFormKelompok() { $modalKelompok.addClass("hidden").removeClass("flex"); editingGroupId = null; }

            $("#btnTambahKelompok").on("click", () => bukaFormKelompok(null));
            $("#btnCloseKelompok").on("click", tutupFormKelompok);
            $("#btnBatalKelompok").on("click", tutupFormKelompok);
            $modalKelompok.on("click", function (e) { if (e.target === this) tutupFormKelompok(); });

            $("#formKelompok").on("submit", function (e) {
                e.preventDefault();
                $kelompokFormError.addClass("hidden");

                const payload = {
                    code: $("#inputKode").val().trim(),
                    name: $("#inputNamaKelompok").val().trim(),
                    mentor_id: $("#inputMentorId").val() || null,
                    advisor_id: $("#inputAdvisorId").val() || null,
                    koordinator_id: $("#inputKoordinatorId").val() || null,
                    max_member: $("#inputMaxMember").val(),
                };

                const url = editingGroupId
                    ? `${DATA_MASTER_URL}/kelompok/${editingGroupId}`
                    : `${DATA_MASTER_URL}/kelompok`;
                const method = editingGroupId ? "PUT" : "POST";

                const $btn = $("#btnSimpanKelompok");
                $btn.prop("disabled", true);

                $.ajax({
                    url, method,
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: JSON.stringify(payload),
                }).done(function (result) {
                    const d = result.data;
                    const mapped = {
                        id: d.id, code: d.code, name: d.name,
                        mentor_id: d.mentor_id, advisor_id: d.advisor_id, koordinator_id: d.koordinator_id,
                        mentor: $("#inputMentorId option:selected").text() === "Belum ada" ? null : $("#inputMentorId option:selected").text().split(" — ")[0],
                        advisor: $("#inputAdvisorId option:selected").text() === "Belum ada" ? null : $("#inputAdvisorId option:selected").text().split(" — ")[0],
                        koordinator: $("#inputKoordinatorId option:selected").text() === "Belum ada" ? null : $("#inputKoordinatorId option:selected").text().split(" — ")[0],
                        max_member: d.max_member,
                        member_count: editingGroupId ? (groupList.find(g => g.id === editingGroupId)?.member_count || 0) : 0,
                    };
                    if (editingGroupId) {
                        const idx = groupList.findIndex((g) => g.id === editingGroupId);
                        if (idx > -1) groupList[idx] = mapped;
                    } else {
                        groupList.push(mapped);
                    }
                    tampilkanToast(result.message || "Kelompok tersimpan.");
                    tutupFormKelompok();
                    renderTable();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    if (result.errors) {
                        $kelompokFormError.text(Object.values(result.errors).flat().join(" "));
                    } else {
                        $kelompokFormError.text(result.message || "Terjadi kesalahan, silakan coba lagi.");
                    }
                    $kelompokFormError.removeClass("hidden");
                }).always(function () {
                    $btn.prop("disabled", false);
                });
            });

            function hapusKelompok(id) {
                const g = groupList.find((x) => x.id === id);
                if (!g) return;
                if (!confirm(`Hapus kelompok "${g.name}"? Anggota di dalamnya juga akan lepas dari kelompok ini.`)) return;

                $.ajax({
                    url: `${DATA_MASTER_URL}/kelompok/${id}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    groupList = groupList.filter((x) => x.id !== id);
                    studentList.forEach((s) => { if (s.group_id === id) s.group_id = null; });
                    tampilkanToast(result.message || "Kelompok dihapus.");
                    renderTable();
                }).fail(function (xhr) {
                    tampilkanToast((xhr.responseJSON && xhr.responseJSON.message) || "Gagal menghapus kelompok.");
                });
            }

            // ================== DETAIL (read-only) ==================
            const $modalDetail = $("#modalDetail");
            function bukaDetail(groupId) {
                const g = groupList.find((x) => x.id === groupId);
                if (!g) return;
                $("#modalDetailTitle").text(g.name);
                $("#modalDetailSub").text(`${g.code} • Mentor: ${g.mentor || 'Belum ada'} • Pembimbing: ${g.advisor || 'Belum ada'} • Koordinator: ${g.koordinator || 'Belum ada'} • ${g.member_count}/${g.max_member} anggota`);

                const anggota = studentList.filter((s) => s.group_id === groupId);
                const $list = $("#detailAnggotaList").empty();
                $("#detailAnggotaKosong").toggleClass("hidden", anggota.length > 0);
                anggota.forEach((s) => {
                    $list.append(`
                        <div class="py-2.5 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-slate-800 m-0">${s.name}</p>
                                <p class="text-xs text-slate-400 m-0">${s.prodi || '-'}</p>
                            </div>
                            <span class="text-xs text-slate-400">${s.email}</span>
                        </div>
                    `);
                });
                $modalDetail.removeClass("hidden").addClass("flex");
            }
            $("#btnCloseDetail").on("click", () => $modalDetail.addClass("hidden").removeClass("flex"));
            $modalDetail.on("click", function (e) { if (e.target === this) $modalDetail.addClass("hidden").removeClass("flex"); });

            // ================== KELOLA ANGGOTA (sudah ada sebelumnya, tidak diubah logic-nya) ==================
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
                    url: `{{ url('admin/kelompok') }}/${activeGroupId}/anggota`,
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: { student_id: studentId },
                }).done(function (result) {
                    const idx = studentList.findIndex((s) => s.id === result.student.id);
                    if (idx > -1) studentList[idx].group_id = activeGroupId;

                    const g = groupList.find((g) => g.id === activeGroupId);
                    if (g) g.member_count = result.member_count;

                    renderTable();
                    renderAnggota();
                }).fail(function (xhr) {
                    tampilkanErrorAnggota((xhr.responseJSON && xhr.responseJSON.message) || "Gagal menambahkan anggota.");
                });
            });

            function keluarkanAnggota(studentId) {
                if (!activeGroupId) return;
                if (!confirm("Keluarkan mahasiswa ini dari kelompok?")) return;

                $.ajax({
                    url: `{{ url('admin/kelompok') }}/${activeGroupId}/anggota/${studentId}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    const idx = studentList.findIndex((s) => s.id === studentId);
                    if (idx > -1) studentList[idx].group_id = null;

                    const g = groupList.find((g) => g.id === activeGroupId);
                    if (g) g.member_count = result.member_count;

                    renderTable();
                    renderAnggota();
                }).fail(function (xhr) {
                    tampilkanErrorAnggota((xhr.responseJSON && xhr.responseJSON.message) || "Gagal mengeluarkan anggota.");
                });
            }

            renderTable();
        });
    </script>
@endpush
