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
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">Monitoring Seluruh Data PKKMB</h2>
    </div>
</div>

<form id="formFilter" method="GET" class="flex items-center gap-2.5 p-4 border border-slate-200 rounded-2xl bg-white mb-5 flex-wrap">
    <select name="tahun" id="filterTahun" class="text-sm font-semibold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 cursor-pointer focus:outline-none focus:border-teal-600">
        <option value="2026" @selected($data['filters']['tahun'] == 2026)>Tahun 2026</option>
        <option value="2025" @selected($data['filters']['tahun'] == 2025)>Tahun 2025</option>
        <option value="2024" @selected($data['filters']['tahun'] == 2024)>Tahun 2024</option>
    </select>
    <select name="fakultas" id="filterFakultas" class="text-sm font-semibold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 cursor-pointer focus:outline-none focus:border-teal-600">
        <option value="">Semua Fakultas</option>
        @foreach ($faculties ?? [] as $f)
            <option value="{{ $f->name }}" @selected($data['filters']['fakultas'] === $f->name)>{{ $f->name }}</option>
        @endforeach
    </select>
    <select name="hari" id="filterHari" class="text-sm font-semibold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 cursor-pointer focus:outline-none focus:border-teal-600">
        <option value="">Semua Hari</option>
        <option value="1" @selected($data['filters']['hari'] == 1)>Hari 1</option>
        <option value="2" @selected($data['filters']['hari'] == 2)>Hari 2</option>
        <option value="3" @selected($data['filters']['hari'] == 3)>Hari 3</option>
    </select>
</form>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-6">
    <div class="bg-white border border-slate-200 rounded-2xl p-4 flex items-center gap-3">
        <span class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 bg-indigo-50 text-indigo-600">
            <i data-lucide="graduation-cap" class="w-5 h-5"></i>
        </span>
        <div>
            <p class="text-xl font-extrabold text-slate-800 m-0 leading-tight">{{ $data['stats']['totalMaba'] }}</p>
            <p class="text-xs font-semibold text-slate-400 m-0">Total Maba</p>
        </div>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl p-4 flex items-center gap-3">
        <span class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 bg-teal-50 text-teal-600">
            <i data-lucide="user-check" class="w-5 h-5"></i>
        </span>
        <div>
            <p class="text-xl font-extrabold text-slate-800 m-0 leading-tight">{{ $data['stats']['hadir'] }}</p>
            <p class="text-xs font-semibold text-slate-400 m-0">Hadir</p>
        </div>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl p-4 flex items-center gap-3">
        <span class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 bg-rose-50 text-rose-500">
            <i data-lucide="user-x" class="w-5 h-5"></i>
        </span>
        <div>
            <p class="text-xl font-extrabold text-slate-800 m-0 leading-tight">{{ $data['stats']['tidakHadir'] }}</p>
            <p class="text-xs font-semibold text-slate-400 m-0">Tidak Hadir</p>
        </div>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl p-4 flex items-center gap-3">
        <span class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 bg-lime-50 text-lime-600">
            <i data-lucide="clipboard-check" class="w-5 h-5"></i>
        </span>
        <div>
            <p class="text-xl font-extrabold text-slate-800 m-0 leading-tight">{{ $data['stats']['evaluasiSelesai'] ?? '-' }}</p>
            <p class="text-xs font-semibold text-slate-400 m-0">Evaluasi Selesai</p>
        </div>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl p-4 flex items-center gap-3">
        <span class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 bg-indigo-50 text-indigo-600">
            <i data-lucide="user-round" class="w-5 h-5"></i>
        </span>
        <div>
            <p class="text-xl font-extrabold text-slate-800 m-0 leading-tight">{{ $data['stats']['mentorAktif'] }}</p>
            <p class="text-xs font-semibold text-slate-400 m-0">Mentor Aktif</p>
        </div>
    </div>
</div>

<section>
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-extrabold text-slate-800 m-0">Grafik Kehadiran</h3>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl min-h-[220px] flex flex-col items-center justify-center gap-2 text-slate-400 text-sm font-semibold text-center px-6">
        <span class="ic"><i data-lucide="bar-chart-3" class="w-8 h-8"></i></span>
        Grafik kehadiran per hari &mdash; akan terisi dari data absensi setelah backend terhubung
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.getElementById('filterTahun').addEventListener('change', () => document.getElementById('formFilter').submit());
    document.getElementById('filterFakultas').addEventListener('change', () => document.getElementById('formFilter').submit());
    document.getElementById('filterHari').addEventListener('change', () => document.getElementById('formFilter').submit());
</script>
@endpush