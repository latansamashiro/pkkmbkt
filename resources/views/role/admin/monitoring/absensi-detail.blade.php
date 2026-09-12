@extends(request()->routeIs('committee.*') ? 'layouts.committee.main' : 'layouts.admin.main')
@php
    // dipakai buat bikin nama route dinamis (admin.monitoring.* atau committee.monitoring.*)
    $monBase = \Illuminate\Support\Str::before(request()->route()->getName(), '.monitoring') . '.monitoring';

    // Sesi mana saja yang statusnya belum 'submitted' (masih draft) -- dipakai untuk
    // kasih tanda per kolom + catatan di bawah tombol Export, bukan buat nyembunyikan
    // tombolnya. Bisa saja sebagian sesi sudah submit dan sebagian belum
    // (mis. sesi 1 & 2 submitted, sesi 3 masih draft).
    $sesiBelumSubmit = collect($sesiList)->filter(fn ($s) => $s->status !== 'submitted')->values();
@endphp
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        corePlugins: { preflight: false }
    }
</script>

<div class="mb-5 flex items-start justify-between flex-wrap gap-3">
    <div>
        <a href="{{ route($monBase.'.absensi') }}" class="text-sm font-semibold text-teal-600 inline-flex items-center gap-1 mb-3">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Detail Absensi</p>
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">
            {{ $group->mentor->name ?? '-' }}
            <span class="text-slate-400 font-semibold">— {{ $group->name ?? '-' }}</span>
        </h2>
        <p class="text-sm text-slate-500 m-0">{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d M Y') }}</p>
    </div>

    <div class="flex flex-col items-end gap-1.5">
        <div class="flex items-center gap-2">
            <a href="{{ route($monBase.'.absensi.export-pdf', ['groupId' => $group->id, 'tanggal' => $tanggal]) }}"
                target="_blank"
                class="inline-flex items-center gap-2 bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-sm px-4 py-2.5 rounded-xl transition">
                <i data-lucide="file-text" class="w-4 h-4"></i>Export PDF
            </a>
            <a href="{{ route($monBase.'.absensi.export-excel', ['groupId' => $group->id, 'tanggal' => $tanggal]) }}"
                class="inline-flex items-center gap-2 bg-teal-50 hover:bg-teal-100 text-teal-700 font-bold text-sm px-4 py-2.5 rounded-xl transition">
                <i data-lucide="file-spreadsheet" class="w-4 h-4"></i>Export Excel
            </a>
        </div>
        @if ($sesiBelumSubmit->isNotEmpty())
            <p class="text-[11px] font-semibold text-amber-600 max-w-[260px] text-right m-0">
                ⚠ Sesi {{ $sesiBelumSubmit->map(fn ($s) => collect($sesiList)->search($s) + 1)->implode(', ') }}
                belum disubmit mentor — hasil export masih ditandai draft.
            </p>
        @endif
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">No</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Mahasiswa</th>
                    @foreach ($sesiList as $i => $sesi)
                        <th class="text-center text-[11px] font-extrabold uppercase tracking-wider px-3.5 py-3 whitespace-nowrap {{ $sesi->status !== 'submitted' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-400' }}">
                            Sesi {{ $i + 1 }}
                            @if ($sesi->status !== 'submitted')
                                <br><span class="normal-case font-semibold text-[9px]">(draft)</span>
                            @endif
                        </th>
                    @endforeach
                    <th class="text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($matrix as $idx => $m)
                    <tr class="hover:bg-slate-50" data-row-student="{{ $m['student_id'] }}">
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $idx + 1 }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $m['nama'] }}</td>
                        @foreach ($m['sesi'] as $i => $s)
                            @php
                                $badge = match($s['status_presence']) {
                                    'hadir' => ['H', 'bg-teal-50 text-teal-600'],
                                    'izin'  => ['I', 'bg-sky-50 text-sky-600'],
                                    'sakit' => ['S', 'bg-amber-100 text-amber-700'],
                                    'alfa'  => ['A', 'bg-rose-50 text-rose-600'],
                                    default => ['-', 'bg-slate-100 text-slate-400'],
                                };
                            @endphp
                            <td class="px-3.5 py-3 text-center border-b border-slate-200 {{ (($sesiList[$i]->status ?? null) !== 'submitted') ? 'bg-amber-50/50' : '' }}" data-cell-sesi="{{ $i }}">
                                <button type="button" data-aksi="edit-sesi"
                                    data-student-id="{{ $m['student_id'] }}"
                                    data-nama="{{ $m['nama'] }}"
                                    data-sesi-index="{{ $i }}"
                                    data-attendance-id="{{ $s['attendance_id'] }}"
                                    data-status="{{ $s['status_presence'] }}"
                                    aria-label="Edit kehadiran {{ $m['nama'] }} sesi {{ $i + 1 }}"
                                    class="inline-flex items-center justify-center w-6 h-6 rounded-lg text-[11px] font-extrabold {{ $badge[1] }} hover:ring-2 hover:ring-offset-1 hover:ring-teal-400 transition cursor-pointer">{{ $badge[0] }}</button>
                            </td>
                        @endforeach
                        <td class="px-3.5 py-3 text-center text-sm font-extrabold border-b border-slate-200 {{ $m['persen'] >= 75 ? 'text-teal-600' : ($m['persen'] >= 40 ? 'text-amber-600' : 'text-rose-600') }}" data-cell-persen>
                            {{ $m['persen'] }}%
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($sesiList) + 3 }}" class="text-center py-6 text-slate-400 text-sm">Tidak ada anggota di kelompok ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="flex items-center gap-4 p-3.5 border-t border-slate-200">
        <span class="text-[11px] font-semibold text-slate-400"><span class="text-teal-600 font-extrabold">H</span> Hadir</span>
        <span class="text-[11px] font-semibold text-slate-400"><span class="text-sky-600 font-extrabold">I</span> Izin</span>
        <span class="text-[11px] font-semibold text-slate-400"><span class="text-amber-600 font-extrabold">S</span> Sakit</span>
        <span class="text-[11px] font-semibold text-slate-400"><span class="text-rose-600 font-extrabold">A</span> Alfa</span>
        @if ($sesiBelumSubmit->isNotEmpty())
            <span class="text-[11px] font-semibold text-amber-600 ml-auto">Kolom kuning = sesi belum disubmit mentor (draft)</span>
        @endif
    </div>
</div>

<!-- ===== MODAL EDIT KEHADIRAN (satu sesi saja -- admin/panitia bisa ubah walau sesi sudah disubmit) ===== -->
<div id="modalEditKehadiran" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl w-full max-w-sm p-6">
        <div class="flex items-start justify-between gap-4 mb-1">
            <h3 class="text-lg font-extrabold text-slate-800 m-0">Edit Kehadiran</h3>
            <button type="button" id="btnCloseEditKehadiran" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <p id="editKehadiranNama" class="text-sm text-slate-500 mb-4"></p>
        <p class="text-[11px] text-amber-600 bg-amber-50 border border-amber-100 rounded-lg px-3 py-2 mb-4">
            Perubahan hanya berlaku untuk sesi ini dan langsung tersimpan, termasuk kalau sesinya sudah disubmit mentor.
        </p>
        <p id="editKehadiranError" class="hidden text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg px-3 py-2 mb-3"></p>
        <form id="formEditKehadiran">
            <label for="fieldStatusSesi" class="block text-xs font-bold text-slate-500 mb-1.5">Status Kehadiran</label>
            <select id="fieldStatusSesi"
                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                <option value="hadir">Hadir</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
                <option value="alfa">Alfa</option>
            </select>
            <div class="flex items-center justify-end gap-3 mt-6">
                <button type="button" id="btnBatalEditKehadiran"
                    class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                <button type="submit" id="btnSimpanEditKehadiran"
                    class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    if (window.lucide) lucide.createIcons();

    (function () {
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;
        const URL_UPDATE_BASE = "{{ route($monBase.'.absensi.update-mahasiswa', ['groupId' => $group->id, 'tanggal' => $tanggal, 'studentId' => '__ID__']) }}";
        const BADGE = {
            hadir: ['H', 'bg-teal-50 text-teal-600'],
            izin:  ['I', 'bg-sky-50 text-sky-600'],
            sakit: ['S', 'bg-amber-100 text-amber-700'],
            alfa:  ['A', 'bg-rose-50 text-rose-600'],
        };

        const $modal = $('#modalEditKehadiran');
        const $error = $('#editKehadiranError');
        let current = null; // { studentId, sesiIndex, attendanceId }

        function bukaModal(btn) {
            const $btn = $(btn);
            current = {
                studentId: $btn.data('student-id'),
                sesiIndex: $btn.data('sesi-index'),
                attendanceId: $btn.data('attendance-id'),
            };
            const status = $btn.data('status');

            $error.addClass('hidden');
            $('#editKehadiranNama').text(`${$btn.data('nama')} — Sesi ${current.sesiIndex + 1}`);
            $('#fieldStatusSesi').val(['hadir', 'izin', 'sakit', 'alfa'].includes(status) ? status : 'hadir');

            $modal.removeClass('hidden').addClass('flex');
        }

        function tutupModal() {
            $modal.addClass('hidden').removeClass('flex');
            current = null;
        }

        $(document).on('click', '[data-aksi="edit-sesi"]', function () { bukaModal(this); });
        $('#btnCloseEditKehadiran, #btnBatalEditKehadiran').on('click', tutupModal);
        $modal.on('click', function (e) { if (e.target === this) tutupModal(); });

        $('#formEditKehadiran').on('submit', function (e) {
            e.preventDefault();
            if (!current) return;
            $error.addClass('hidden');

            const statusBaru = $('#fieldStatusSesi').val();
            const $btn = $('#btnSimpanEditKehadiran');
            $btn.prop('disabled', true);

            $.ajax({
                url: URL_UPDATE_BASE.replace('__ID__', current.studentId),
                method: 'PUT',
                contentType: 'application/json',
                headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' },
                // cuma kirim sesi yang diklik, bukan semua sesi hari itu.
                data: JSON.stringify({
                    sesi: [{ attendance_id: current.attendanceId, status_presence: statusBaru }],
                }),
            }).done(function (result) {
                // update sel yang diklik + persentase baris, tanpa reload halaman.
                const $row = $(`tr[data-row-student="${current.studentId}"]`);
                const $tombolSel = $row.find(`td[data-cell-sesi="${current.sesiIndex}"] [data-aksi="edit-sesi"]`);
                const badge = BADGE[statusBaru] || ['-', 'bg-slate-100 text-slate-400'];

                $tombolSel
                    .attr('class', `inline-flex items-center justify-center w-6 h-6 rounded-lg text-[11px] font-extrabold ${badge[1]} hover:ring-2 hover:ring-offset-1 hover:ring-teal-400 transition cursor-pointer`)
                    .attr('data-status', statusBaru)
                    .text(badge[0]);

                if (result.data && typeof result.data.persen !== 'undefined') {
                    $row.find('td[data-cell-persen]').text(`${result.data.persen}%`);
                }

                tutupModal();
                if (typeof tampilkanToast === 'function') {
                    tampilkanToast(result.message);
                } else {
                    alert(result.message);
                }
            }).fail(function (xhr) {
                const result = xhr.responseJSON || {};
                $error.text(result.message || 'Terjadi kesalahan, silakan coba lagi.').removeClass('hidden');
            }).always(function () {
                $btn.prop('disabled', false);
            });
        });
    })();
</script>
@endpush