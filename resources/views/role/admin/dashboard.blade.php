@extends('layouts.admin.main')
@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Selamat datang kembali</p>
            <h2 class="font-serif text-xl font-bold text-[var(--navy-900)] md:text-2xl">
                Halo, {{ auth()->user()->name ?? 'Super Admin' }} 👋
            </h2>
        </div>
        <span
            class="inline-flex items-center gap-2 rounded-full bg-[var(--teal-500,#0d9488)]/10 px-3 py-1.5 text-xs font-bold text-[var(--teal-600,#0f766e)]">
            <span class="h-1.5 w-1.5 rounded-full bg-[var(--teal-500,#0d9488)]"></span>
            Data real-time
        </span>
    </div>

    @php
        $statCards = [
            ['label' => 'Total Pengguna', 'value' => $totalPengguna ?? 0, 'icon' => 'users', 'chip' => 'bg-[var(--navy-900)]'],
            ['label' => 'Total Role', 'value' => $totalRole ?? 0, 'icon' => 'shield-check', 'chip' => 'bg-[var(--teal-500,#0d9488)]'],
            ['label' => 'Data Master', 'value' => $totalDataMaster ?? 0, 'icon' => 'database', 'chip' => 'bg-[var(--lime-500,#84cc16)]'],
            ['label' => 'Laporan', 'value' => $totalLaporan ?? 0, 'icon' => 'file-bar-chart-2', 'chip' => 'bg-[var(--coral-500,#e0665a)]'],
        ];
    @endphp

    <section class="mb-6">
        <div class="grid grid-cols-2 gap-3 lg:grid-cols-4 lg:gap-4">
            @foreach ($statCards as $stat)
                <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <span class="grid h-11 w-11 shrink-0 place-items-center rounded-xl {{ $stat['chip'] }} text-white">
                        <i data-lucide="{{ $stat['icon'] }}" class="h-5 w-5"></i>
                    </span>
                    <div class="min-w-0">
                        <p class="truncate text-xl font-bold text-[var(--navy-900)]">{{ $stat['value'] }}</p>
                        <p class="truncate text-xs font-medium text-slate-500">{{ $stat['label'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mb-6">
        <div class="mb-3 flex items-center justify-between">
            <h3 class="font-serif text-base font-bold text-[var(--navy-900)] md:text-lg">Grafik Aktivitas Sistem</h3>
        </div>
        <div
            class="flex h-48 flex-col items-center justify-center gap-2 rounded-2xl border border-dashed border-slate-300 bg-white text-sm text-slate-400 md:h-64">
            <i data-lucide="line-chart" class="h-8 w-8"></i>
            <span class="max-w-xs text-center">Grafik aktivitas sistem &mdash; akan terisi dari data log setelah
                backend terhubung</span>
        </div>
    </section>

    <section>
        <div class="grid gap-6 lg:grid-cols-2">
            <div>
                <div class="mb-3 flex items-center justify-between">
                    <h3 class="font-serif text-base font-bold text-[var(--navy-900)] md:text-lg">Aktivitas Terbaru</h3>
                </div>
                <div class="space-y-2">
                    @forelse (($aktivitasTerbaru ?? []) as $a)
                        <div class="flex items-start gap-3 rounded-xl border border-slate-200 bg-white p-3">
                            <span
                                class="grid h-9 w-9 shrink-0 place-items-center rounded-lg {{ $a['chip'] ?? 'bg-[var(--navy-900)]' }} text-white">
                                <i data-lucide="{{ $a['icon'] ?? 'activity' }}" class="h-4 w-4"></i>
                            </span>
                            <div class="min-w-0">
                                <span
                                    class="text-[11px] font-bold uppercase tracking-wide text-slate-400">{{ $a['tag'] ?? '-' }}</span>
                                <p class="truncate text-sm font-semibold text-[var(--navy-900)]">{{ $a['judul'] ?? '-' }}</p>
                                <p class="text-xs text-slate-400">{{ $a['waktu'] ?? '-' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-xl border border-slate-200 bg-white p-4">
                            <p class="text-sm text-slate-400">Belum ada aktivitas</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div>
                <div class="mb-3 flex items-center justify-between">
                    <h3 class="font-serif text-base font-bold text-[var(--navy-900)] md:text-lg">Ringkasan Role</h3>
                    <a href="#"
                        class="inline-flex items-center gap-1 text-xs font-bold text-[var(--teal-600,#0f766e)] hover:underline">
                        Kelola <i data-lucide="chevron-right" class="h-3.5 w-3.5"></i>
                    </a>
                </div>
                <div class="space-y-2">
                    @forelse (($ringkasanRole ?? []) as $r)
                        <div class="flex items-start gap-3 rounded-xl border border-slate-200 bg-white p-3">
                            <span
                                class="grid h-9 w-9 shrink-0 place-items-center rounded-lg {{ $r['chip'] ?? 'bg-[var(--navy-900)]' }} text-white">
                                <i data-lucide="{{ $r['icon'] ?? 'user' }}" class="h-4 w-4"></i>
                            </span>
                            <div class="min-w-0">
                                <span
                                    class="text-[11px] font-bold uppercase tracking-wide text-slate-400">{{ $r['tag'] ?? '-' }}</span>
                                <p class="truncate text-sm font-semibold text-[var(--navy-900)]">{{ $r['judul'] ?? '-' }}</p>
                                <p class="text-xs text-slate-400">{{ $r['waktu'] ?? '-' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-xl border border-slate-200 bg-white p-4">
                            <p class="text-sm text-slate-400">Belum ada data role</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection