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
        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Monitoring</p>
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">Monitoring Laporan</h2>
    </div>
    <a href="#" id="btnExport" class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
        <i data-lucide="download" class="w-4 h-4"></i>
        Export PDF
    </a>
</div>

<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <form id="formFilter" method="GET" class="flex items-center gap-2.5 p-4 border-b border-slate-200 flex-wrap">
        <select name="jenis" id="filterJenis" onchange="document.getElementById('formFilter').submit()" class="text-sm font-semibold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 cursor-pointer focus:outline-none focus:border-teal-600">
            <option value="">Semua Jenis</option>
            <option value="Absensi" @selected($filters['jenis'] === 'Absensi')>Absensi</option>
            <option value="Evaluasi" @selected($filters['jenis'] === 'Evaluasi')>Evaluasi</option>
            <option value="Keaktifan" @selected($filters['jenis'] === 'Keaktifan')>Keaktifan</option>
            <option value="Pelanggaran" @selected($filters['jenis'] === 'Pelanggaran')>Pelanggaran</option>
        </select>
        <input type="date" name="tanggal" id="filterTanggal" value="{{ $filters['tanggal'] }}" onchange="document.getElementById('formFilter').submit()" class="text-sm font-semibold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 cursor-pointer focus:outline-none focus:border-teal-600" />
        <div class="flex-1 min-w-[200px] flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5">
            <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
            <input type="text" name="cari" value="{{ $filters['cari'] }}" placeholder="Cari laporan..." class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
        </div>
        <button type="submit" class="text-sm font-bold text-teal-600 px-3 py-2.5">Cari</button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">No</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Jenis</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Dibuat Oleh</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Tanggal</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Status</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $idx => $l)
                    @php
                        $lihatUrl = null;
                        $downloadUrl = null;

                        if (($l['group_id'] ?? null)) {
                            if ($l['jenis'] === 'Absensi') {
                                $lihatUrl = route('admin.monitoring.absensi.detail', ['groupId' => $l['group_id'], 'tanggal' => $l['tanggal']]);
                                if ($l['submitted'] ?? false) {
                                    $downloadUrl = route('admin.monitoring.absensi.export-pdf', ['groupId' => $l['group_id'], 'tanggal' => $l['tanggal']]);
                                }
                            } elseif ($l['jenis'] === 'Evaluasi') {
                                $lihatUrl = route('admin.monitoring.evaluasi.detail', $l['group_id']);
                            } elseif ($l['jenis'] === 'Keaktifan') {
                                $lihatUrl = route('admin.monitoring.keaktifan.detail', $l['group_id']);
                            } elseif ($l['jenis'] === 'Pelanggaran') {
                                $lihatUrl = route('admin.monitoring.pelanggaran.detail', $l['group_id']);
                            }
                        }
                    @endphp
                    <tr class="hover:bg-slate-50">
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ ($page - 1) * $perPage + $idx + 1 }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $l['jenis'] }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $l['oleh_label'] }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($l['tanggal'])->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-3.5 py-3 border-b border-slate-200">
                            <span class="inline-flex items-center gap-1 text-[11px] font-extrabold px-2.5 py-1 rounded-full {{ $l['status'] === 'Selesai' ? 'bg-teal-50 text-teal-600' : 'bg-amber-100 text-amber-700' }}">
                                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>{{ $l['status'] }}
                            </span>
                        </td>
                        <td class="px-3.5 py-3 border-b border-slate-200">
                            <div class="flex items-center gap-3">
                                @if ($lihatUrl)
                                    <a href="{{ $lihatUrl }}" class="text-teal-600 hover:text-teal-700 text-xs font-bold">Lihat</a>
                                @else
                                    <span class="text-slate-300 text-xs font-bold cursor-not-allowed" title="Kelompok tidak diketahui">Lihat</span>
                                @endif

                                @if ($downloadUrl)
                                    <a href="{{ $downloadUrl }}" target="_blank" class="text-teal-600 hover:text-teal-700 text-xs font-bold">Download</a>
                                @elseif ($l['jenis'] === 'Absensi')
                                    <span class="text-slate-300 text-xs font-bold cursor-not-allowed" title="Baru bisa didownload setelah absensi ini disubmit mentor">Download</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-slate-400 text-sm">Tidak ada laporan ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex items-center justify-between p-4 flex-wrap gap-3">
        <p class="text-xs font-semibold text-slate-400 m-0">
            Showing {{ $laporan->count() ? (($page - 1) * $perPage + 1) : 0 }}-{{ ($page - 1) * $perPage + $laporan->count() }} of {{ $total }}
        </p>
        <div class="flex items-center gap-1.5">
            @php
                $q = request()->except('page');
            @endphp
            <a href="{{ request()->fullUrlWithQuery(['page' => max(1, $page - 1)]) }}" class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
            </a>
            @for ($p = 1; $p <= $totalPage; $p++)
                <a href="{{ request()->fullUrlWithQuery(['page' => $p]) }}" class="w-8 h-8 flex items-center justify-center rounded-lg border text-sm font-semibold {{ $p === $page ? 'bg-teal-600 text-white border-teal-600' : 'border-slate-200 text-slate-600 hover:bg-slate-50' }}">{{ $p }}</a>
            @endfor
            <a href="{{ request()->fullUrlWithQuery(['page' => min($totalPage, $page + 1)]) }}" class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50">
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    if (window.lucide) lucide.createIcons();
</script>
@endpush