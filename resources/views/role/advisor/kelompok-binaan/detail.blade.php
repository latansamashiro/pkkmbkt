@extends('layouts.advisor.main')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        corePlugins: { preflight: false }
    }
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<div class="mb-5">
    <a href="{{ route('role.advisor.kelompok-binaan') }}" class="text-sm font-semibold text-teal-600 inline-flex items-center gap-1 mb-3">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>
    <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Kelompok Binaan</p>
    <h2 class="text-2xl font-extrabold text-slate-800 m-0">{{ $kelompok->name }}</h2>
    <p class="text-sm text-slate-500 m-0">Mentor: {{ $kelompok->mentor->name ?? '—' }}</p>
</div>

<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">No</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Nama Mahasiswa</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">NPM</th>
                    <th class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">Program Studi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anggota as $idx => $m)
                    <tr class="hover:bg-slate-50">
                        <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">{{ $idx + 1 }}</td>
                        <td class="px-3.5 py-3 text-sm font-bold text-slate-800 border-b border-slate-200">{{ $m->name }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-600 border-b border-slate-200">{{ $m->npm ?? '-' }}</td>
                        <td class="px-3.5 py-3 text-sm text-slate-600 border-b border-slate-200">{{ $m->program_study_name ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-slate-400 text-sm">Belum ada anggota di kelompok ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        if (window.lucide) lucide.createIcons();
    });
</script>
@endpush
