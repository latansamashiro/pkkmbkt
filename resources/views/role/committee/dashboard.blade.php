@extends('layouts.committee.main')
@section('content')
    <div class="greeting">
        <div>
            <p class="greeting-eyebrow">Selamat datang </p>
            <h2 class="greeting-title">HALO, {{ auth()->user()->name ?? 'Panitia' }} 👋</h2>
        </div>
        <span class="live-tag"><span class="dot"></span>Data real-time</span>
    </div>

    @php
        $statCards = [
            ['label' => 'Mahasiswa Bimbingan', 'value' => $totalMahasiswa ?? 0, 'icon' => 'graduation-cap', 'chip' => 'chip-navy'],
            ['label' => 'Kelompok', 'value' => $totalKelompok ?? 0, 'icon' => 'users', 'chip' => 'chip-teal'],
            ['label' => 'Jadwal Hari Ini', 'value' => $totalJadwalHariIni ?? 0, 'icon' => 'calendar', 'chip' => 'chip-lime'],
            ['label' => 'Pelanggaran', 'value' => $totalPelanggaran ?? 0, 'icon' => 'alert-triangle', 'chip' => 'chip-coral'],
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
            <h3 class="section-title">Grafik Keaktifan Mahasiswa</h3>
        </div>
        <div class="chart-placeholder">
            <span class="ic"><i data-lucide="line-chart"></i></span>
            Grafik keaktifan mahasiswa &mdash; akan terisi dari data log setelah backend terhubung
        </div>
    </section>

    <section class="section">
        <div class="grid-2col">
            <div>
                <div class="section-head">
                    <h3 class="section-title">Jadwal Terdekat</h3>
                </div>
                <div class="announce-list">
                    @forelse (($jadwalTerdekat ?? []) as $j)
                        <div class="announce-card">
                            <span class="announce-icon {{ $j['chip'] ?? 'chip-navy' }}">
                                <span class="ic"><i data-lucide="{{ $j['icon'] ?? 'calendar' }}"></i></span>
                            </span>
                            <div class="announce-body">
                                <span class="announce-tag">{{ $j['tag'] ?? '-' }}</span>
                                <p class="announce-title">{{ $j['judul'] ?? '-' }}</p>
                                <p class="announce-date">{{ $j['waktu'] ?? '-' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="announce-card">
                            <div class="announce-body">
                                <p class="announce-title">Belum ada jadwal</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div>
                <div class="section-head">
                    <h3 class="section-title">Info Terbaru</h3>
                    <a href="#" class="section-link">
                        Lihat semua<span class="ic"><i data-lucide="chevron-right"></i></span>
                    </a>
                </div>
                <div class="announce-list">
                    @forelse (($infoTerbaru ?? []) as $i)
                        <div class="announce-card">
                            <span class="announce-icon {{ $i['chip'] ?? 'chip-navy' }}">
                                <span class="ic"><i data-lucide="{{ $i['icon'] ?? 'megaphone' }}"></i></span>
                            </span>
                            <div class="announce-body">
                                <span class="announce-tag">{{ $i['tag'] ?? '-' }}</span>
                                <p class="announce-title">{{ $i['judul'] ?? '-' }}</p>
                                <p class="announce-date">{{ $i['waktu'] ?? '-' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="announce-card">
                            <div class="announce-body">
                                <p class="announce-title">Belum ada info</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
