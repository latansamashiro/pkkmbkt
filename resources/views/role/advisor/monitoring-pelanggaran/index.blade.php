@extends('layouts.advisor.main')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = { corePlugins: { preflight: false } }
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<div class="flex items-center justify-between flex-wrap gap-3 mb-5">
    <div>
        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Monitoring</p>
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">Monitoring Pelanggaran</h2>
        <p class="text-sm text-slate-500 m-0">Hanya menampilkan kelompok yang Anda bina.</p>
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <form id="formFilter" method="GET" class="flex items-center gap-2.5 p-4 border-b border-slate-200 flex-wrap">
        <div class="flex-1 min-w-[200px] flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5">
            <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
            <input type="text" name="cari" value="{{ $filters['cari'] }}" placeholder="Cari kelompok..." class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
        </div>
        <button type="submit" class="text-sm font-bold text-teal-600 px-3 py-2.5">Cari</button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">No</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Kelompok</th>
                    <th class="text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Poin Pelanggaran</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Update Terakhir</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $idx => $l)
                    <tr class="hover:bg-slate-50">
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $idx + 1 }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $l['kelompok'] }}</td>
                        <td class="px-3.5 py-3 text-sm font-extrabold text-red-600 border-b border-slate-200 text-center">{{ $l['poin'] }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-600 border-b border-slate-200 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($l['update'])->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-3.5 py-3 border-b border-slate-200">
                            <a href="{{ route('role.advisor.monitoring.pelanggaran.detail', $l['group_id']) }}" class="text-teal-600 hover:text-teal-700">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-slate-400 text-sm">Tidak ada data pelanggaran ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () { if (window.lucide) lucide.createIcons(); });
</script>
@endpush