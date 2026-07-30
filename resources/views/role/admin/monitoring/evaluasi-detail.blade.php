@extends('layouts.admin.main')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        corePlugins: { preflight: false }
    }
</script>

<div class="mb-5">
    <a href="{{ route('admin.monitoring.evaluasi') }}" class="text-sm font-semibold text-teal-600 inline-flex items-center gap-1 mb-3">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>
    <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Detail Evaluasi</p>
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
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Nama Anggota</th>
                    @foreach ($categories as $cat)
                        <th class="text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">{{ $cat->name }}</th>
                    @endforeach
                    <th class="text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Rata-rata</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $idx => $r)
                    <tr class="hover:bg-slate-50">
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $idx + 1 }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $r['nama'] }}</td>
                        @foreach ($categories as $cat)
                            <td class="px-3.5 py-3 text-sm text-center border-b border-slate-200 {{ $r['nilai'][$cat->id] === null ? 'text-slate-300' : 'text-slate-800' }}">
                                {{ $r['nilai'][$cat->id] ?? '—' }}
                            </td>
                        @endforeach
                        <td class="px-3.5 py-3 text-sm text-center font-extrabold border-b border-slate-200 {{ $r['rata'] === null ? 'text-slate-300' : 'text-teal-600' }}">
                            {{ $r['rata'] ?? '—' }}
                        </td>
                        <td class="px-3.5 py-3 border-b border-slate-200">
                            @php
                                $badge = match($r['status']) {
                                    'Lulus' => 'bg-teal-50 text-teal-600',
                                    'Belum Lulus' => 'bg-amber-100 text-amber-700',
                                    default => 'bg-slate-100 text-slate-400',
                                };
                            @endphp
                            <span class="inline-flex items-center gap-1 text-[11px] font-extrabold px-2.5 py-1 rounded-full {{ $badge }}">{{ $r['status'] }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($categories) + 4 }}" class="text-center py-6 text-slate-400 text-sm">Tidak ada anggota di kelompok ini.</td>
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