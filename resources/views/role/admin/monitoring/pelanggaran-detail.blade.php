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

<div class="mb-5">
    <a href="{{ route($monBase.'.pelanggaran') }}" class="text-sm font-semibold text-teal-600 inline-flex items-center gap-1 mb-3">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>
    <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Detail Pelanggaran</p>
    <h2 class="text-2xl font-extrabold text-slate-800 m-0">
        {{ $group->mentor->name ?? '-' }}
        <span class="text-slate-400 font-semibold">— {{ $group->name ?? '-' }}</span>
    </h2>
</div>

<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">No</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Mahasiswa</th>
                    <th class="text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Poin Pelanggaran</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Update Terakhir</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $idx => $r)
                    <tr class="hover:bg-slate-50">
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $idx + 1 }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $r['nama'] }}</td>
                        <td class="px-3.5 py-3 text-sm font-extrabold text-red-600 border-b border-slate-200 text-center">{{ $r['poin'] }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-600 border-b border-slate-200 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($r['update'])->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-3.5 py-3 text-sm text-slate-600 border-b border-slate-200">{{ $r['keterangan'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-slate-400 text-sm">Belum ada data Pelanggaran di kelompok ini.</td>
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