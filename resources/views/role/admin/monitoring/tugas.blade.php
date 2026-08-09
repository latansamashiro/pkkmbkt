@extends(request()->routeIs('committee.*') ? 'layouts.committee.main' : 'layouts.admin.main')
@php
    // dipakai buat bikin nama route dinamis (admin.monitoring.* atau committee.monitoring.*)
    $monBase = \Illuminate\Support\Str::before(request()->route()->getName(), '.monitoring') . '.monitoring';
@endphp
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
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">Monitoring Pengumpulan Tugas</h2>
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <form id="formFilter" method="GET" class="flex items-center gap-2.5 p-4 border-b border-slate-200 flex-wrap">
        <div class="flex-1 min-w-[200px] flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5">
            <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
            <input type="text" name="cari" value="{{ $filters['cari'] }}" placeholder="Cari mentor atau kelompok..." class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
        </div>
        <button type="submit" class="text-sm font-bold text-teal-600 px-3 py-2.5">Cari</button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">No</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Mentor — Kelompok</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Update Terakhir</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Status</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $idx => $l)
                    <tr class="hover:bg-slate-50">
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $idx + 1 }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $l['oleh_label'] }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200 whitespace-nowrap">
                            {{ $l['tanggal'] ? \Carbon\Carbon::parse($l['tanggal'])->translatedFormat('d M Y, H:i') : '-' }}
                        </td>
                        <td class="px-3.5 py-3 text-sm border-b border-slate-200">
                            @php
                                $badge = str_starts_with($l['status'], 'Selesai') ? 'bg-teal-50 text-teal-600'
                                    : (str_starts_with($l['status'], 'Berjalan') ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-400');
                            @endphp
                            <span class="inline-flex items-center gap-1 text-[11px] font-extrabold px-2.5 py-1 rounded-full {{ $badge }}">{{ $l['status'] }}</span>
                        </td>
                        <td class="px-3.5 py-3 border-b border-slate-200">
                            <a href="{{ route($monBase.'.tugas.detail', $l['group_id']) }}" class="text-teal-600 hover:text-teal-700">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-slate-400 text-sm">Tidak ada data pengumpulan tugas ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    if (window.lucide) lucide.createIcons();
</script>
@endpush
