@extends('layouts.admin.main')
@section('content')
    <div class="greeting">
        <div>
            <p class="greeting-eyebrow">Selamat datang kembali</p>
            <h2 class="greeting-title">Halo, {{ auth()->user()->name ?? 'Super Admin' }} 👋</h2>
        </div>
    </div>

    @php
        $statCards = [
            ['label' => 'Total Pengguna', 'value' => $totalPengguna ?? 0, 'icon' => 'users', 'chip' => 'chip-navy'],
            ['label' => 'Total Role', 'value' => $totalRole ?? 0, 'icon' => 'shield-check', 'chip' => 'chip-teal'],
            ['label' => 'Data Master', 'value' => $totalDataMaster ?? 0, 'icon' => 'database', 'chip' => 'chip-lime'],
            ['label' => 'Laporan', 'value' => $totalLaporan ?? 0, 'icon' => 'file-bar-chart-2', 'chip' => 'chip-coral'],
        ];
    @endphp

    <section class="section" style="margin-top:0">
        <div class="stat-grid">
            @foreach ($statCards as $stat)
                <div class="stat-card">
                    <span class="stat-chip {{ $stat['chip'] }}">
                        <span class="ic"><i data-lucide="{{ $stat['icon'] }}"></i></span>
                    </span>
                    <div>
                        <p class="stat-value">{{ $stat['value'] }}</p>
                        <p class="stat-label">{{ $stat['label'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <h3 class="section-title">Grafik Aktivitas Sistem</h3>
        </div>
        <div class="chart-placeholder">
            <span class="ic"><i data-lucide="line-chart"></i></span>
            Grafik aktivitas sistem &mdash; akan terisi dari data log setelah backend terhubung
        </div>
    </section>

    <section class="section">
        <div class="grid-2col">
            <div>
                <div class="section-head">
                    <h3 class="section-title">Aktivitas Terbaru</h3>
                </div>
                <div class="announce-list">
                    @forelse (($aktivitasTerbaru ?? []) as $a)
                        <div class="announce-card">
                            <span class="announce-icon {{ $a['chip'] ?? 'chip-navy' }}">
                                <span class="ic"><i data-lucide="{{ $a['icon'] ?? 'activity' }}"></i></span>
                            </span>
                            <div class="announce-body">
                                <span class="announce-tag">{{ $a['tag'] ?? '-' }}</span>
                                <p class="announce-title">{{ $a['judul'] ?? '-' }}</p>
                                <p class="announce-date">{{ $a['waktu'] ?? '-' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="announce-card">
                            <div class="announce-body">
                                <p class="announce-title">Belum ada aktivitas</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div>
                <div class="section-head">
                    <h3 class="section-title">Ringkasan Role</h3>
                    <a href="#" class="section-link">
                        Kelola<span class="ic"><i data-lucide="chevron-right"></i></span>
                    </a>
                </div>
                <div class="announce-list">
                    @forelse (($ringkasanRole ?? []) as $r)
                        <div class="announce-card">
                            <span class="announce-icon {{ $r['chip'] ?? 'chip-navy' }}">
                                <span class="ic"><i data-lucide="{{ $r['icon'] ?? 'user' }}"></i></span>
                            </span>
                            <div class="announce-body">
                                <span class="announce-tag">{{ $r['tag'] ?? '-' }}</span>
                                <p class="announce-title">{{ $r['judul'] ?? '-' }}</p>
                                <p class="announce-date">{{ $r['waktu'] ?? '-' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="announce-card">
                            <div class="announce-body">
                                <p class="announce-title">Belum ada data role</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection