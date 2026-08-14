@extends('layouts.advisor.main')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        corePlugins: { preflight: false }
    }
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<div class="mb-5 flex items-start justify-between flex-wrap gap-3">
    <div>
        <a href="{{ route('role.advisor.monitoring.tugas') }}" class="text-sm font-semibold text-teal-600 inline-flex items-center gap-1 mb-3">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Detail Pengumpulan Tugas</p>
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">
            {{ $group->mentor->name ?? '-' }}
            <span class="text-slate-400 font-semibold">— {{ $group->name ?? '-' }}</span>
        </h2>
    </div>

    <a href="{{ route('role.advisor.monitoring.tugas.export-excel', ['groupId' => $group->id]) }}"
        class="inline-flex items-center gap-2 bg-teal-50 hover:bg-teal-100 text-teal-700 font-bold text-sm px-4 py-2.5 rounded-xl transition">
        <i data-lucide="file-spreadsheet" class="w-4 h-4"></i>Export Excel
    </a>
</div>

<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="bg-slate-100" colspan="3"></th>
                    @php
                        $groupedTasks = $tasks->groupBy('task_type');
                    @endphp
                    @php
                        $labelTipe = ['kelompok' => 'Tugas Kelompok', 'atk' => 'Penerimaan ATK', 'jas_almet' => 'Penerimaan JAS ALMET', 'individu' => 'Tugas Individu'];
                        $toneTipe = ['kelompok' => 'bg-teal-50 text-teal-600', 'atk' => 'bg-amber-50 text-amber-600', 'jas_almet' => 'bg-purple-50 text-purple-600', 'individu' => 'bg-indigo-50 text-indigo-600'];
                    @endphp
                    @foreach (['individu', 'kelompok', 'atk', 'jas_almet'] as $tipe)
                        @if (($groupedTasks[$tipe] ?? collect())->count())
                            <th colspan="{{ $groupedTasks[$tipe]->count() }}"
                                class="text-center text-[10px] font-extrabold uppercase tracking-wider px-3.5 py-2 whitespace-nowrap {{ $toneTipe[$tipe] }}">
                                {{ $labelTipe[$tipe] }}
                            </th>
                        @endif
                    @endforeach
                    <th class="bg-slate-100"></th>
                </tr>
                <tr>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">No</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Mahasiswa</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">NPM</th>
                    @foreach ($tasks as $t)
                        <th class="text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                            {{ $t->title }}
                        </th>
                    @endforeach
                    <th class="text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Selesai</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $idx => $r)
                    <tr class="hover:bg-slate-50">
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $idx + 1 }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $r['nama'] }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-500 border-b border-slate-200">{{ $r['npm'] }}</td>
                        @foreach ($tasks as $t)
                            @php $done = $r['tugas'][(string) $t->id] ?? false; @endphp
                            <td class="px-3.5 py-3 text-center border-b border-slate-200">
                                @if ($done)
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-lg text-[11px] font-extrabold bg-teal-50 text-teal-600">
                                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                    </span>
                                @else
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-lg text-[11px] font-extrabold bg-slate-100 text-slate-300">-</span>
                                @endif
                            </td>
                        @endforeach
                        <td class="px-3.5 py-3 text-center text-sm font-extrabold border-b border-slate-200 {{ $r['total'] && $r['selesai'] >= $r['total'] ? 'text-teal-600' : ($r['selesai'] > 0 ? 'text-amber-600' : 'text-slate-400') }}">
                            {{ $r['selesai'] }}/{{ $r['total'] }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $tasks->count() + 4 }}" class="text-center py-6 text-slate-400 text-sm">Tidak ada anggota di kelompok ini.</td>
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
