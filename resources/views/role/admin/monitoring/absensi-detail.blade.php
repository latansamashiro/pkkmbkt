@extends('layouts.admin.main')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        corePlugins: { preflight: false }
    }
</script>

<div class="mb-5 flex items-start justify-between flex-wrap gap-3">
    <div>
        <a href="{{ route('admin.monitoring.absensi') }}" class="text-sm font-semibold text-teal-600 inline-flex items-center gap-1 mb-3">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Detail Absensi</p>
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">
            {{ $group->mentor->name ?? '-' }}
            <span class="text-slate-400 font-semibold">— {{ $group->name ?? '-' }}</span>
        </h2>
        <p class="text-sm text-slate-500 m-0">{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d M Y') }}</p>
    </div>

    @if ($adaSubmitted)
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.monitoring.absensi.export-pdf', ['groupId' => $group->id, 'tanggal' => $tanggal]) }}"
                target="_blank"
                class="inline-flex items-center gap-2 bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-sm px-4 py-2.5 rounded-xl transition">
                <i data-lucide="file-text" class="w-4 h-4"></i>Export PDF
            </a>
            <a href="{{ route('admin.monitoring.absensi.export-excel', ['groupId' => $group->id, 'tanggal' => $tanggal]) }}"
                class="inline-flex items-center gap-2 bg-teal-50 hover:bg-teal-100 text-teal-700 font-bold text-sm px-4 py-2.5 rounded-xl transition">
                <i data-lucide="file-spreadsheet" class="w-4 h-4"></i>Export Excel
            </a>
        </div>
    @else
        <p class="text-xs text-slate-400 italic max-w-[220px] text-right">
            Export tersedia setelah minimal satu sesi di tanggal ini disubmit mentor.
        </p>
    @endif
</div>

<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">No</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Mahasiswa</th>
                    @foreach ($sesiList as $i => $sesi)
                        <th class="text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                            Sesi {{ $i + 1 }}
                        </th>
                    @endforeach
                    <th class="text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($matrix as $idx => $m)
                    <tr class="hover:bg-slate-50">
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $idx + 1 }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $m['nama'] }}</td>
                        @foreach ($m['sesi'] as $status)
                            @php
                                $badge = match($status) {
                                    'hadir' => ['H', 'bg-teal-50 text-teal-600'],
                                    'izin'  => ['I', 'bg-sky-50 text-sky-600'],
                                    'sakit' => ['S', 'bg-amber-100 text-amber-700'],
                                    'alfa'  => ['A', 'bg-rose-50 text-rose-600'],
                                    default => ['-', 'bg-slate-100 text-slate-400'],
                                };
                            @endphp
                            <td class="px-3.5 py-3 text-center border-b border-slate-200">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-lg text-[11px] font-extrabold {{ $badge[1] }}">{{ $badge[0] }}</span>
                            </td>
                        @endforeach
                        <td class="px-3.5 py-3 text-center text-sm font-extrabold border-b border-slate-200 {{ $m['persen'] >= 75 ? 'text-teal-600' : ($m['persen'] >= 40 ? 'text-amber-600' : 'text-rose-600') }}">
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
    </div>
</div>
@endsection

@push('scripts')
<script>
    if (window.lucide) lucide.createIcons();
</script>
@endpush