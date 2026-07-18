<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <title>Dashboard Super Admin &mdash; PKKMB-KT UNILAM 2026</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    @vite(['resources/css/pkkmbkt-theme.css'])
</head>

<body>
    <div class="app">
        <aside class="sidebar">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <img src="{{ asset('assets/unilam.png') }}" alt="Logo UNILAM" class="brand-badge" />
                <div class="brand-text"><strong>PKKMB-KT</strong><span>Panel Super Admin</span></div>
            </a>
            <nav class="sidebar-nav" aria-label="Navigasi super admin">
                <p class="sidebar-group-label">Utama</p>
                <a href="{{ route('dashboard') }}" class="active">
                    <span class="ic"><i data-lucide="layout-dashboard"></i></span>
                    <span class="label">Dashboard</span>
                </a>
                <p class="sidebar-group-label">Administrasi</p>
                <a href="#">
                    <span class="ic"><i data-lucide="users"></i></span>
                    <span class="label">Kelola Pengguna</span>
                </a>
                <a href="#">
                    <span class="ic"><i data-lucide="shield-check"></i></span>
                    <span class="label">Kelola Role & Hak Akses</span>
                </a>
                <a href="#">
                    <span class="ic"><i data-lucide="database"></i></span>
                    <span class="label">Kelola Data Master</span>
                </a>
                <p class="sidebar-group-label">Monitoring</p>
                <a href="#">
                    <span class="ic"><i data-lucide="bar-chart-3"></i></span>
                    <span class="label">Monitoring PKKMB</span>
                </a>
                <a href="#">
                    <span class="ic"><i data-lucide="file-bar-chart-2"></i></span>
                    <span class="label">Monitoring Laporan</span>
                </a>
                <p class="sidebar-group-label">Lainnya</p>
                <a href="#">
                    <span class="ic"><i data-lucide="settings"></i></span>
                    <span class="label">Pengaturan Sistem</span>
                </a>
                <a href="#">
                    <span class="ic"><i data-lucide="user-circle"></i></span>
                    <span class="label">Profil</span>
                </a>
            </nav>

            <form method="POST" action="{{ route('logout') }}" class="sidebar-logout"
                style="border:none; padding:0; margin:10px 10px 0;">
                @csrf
                <button type="submit"
                    style="all:unset; display:flex; align-items:center; justify-content:center; gap:8px; width:100%; padding:12px 10px; border-radius:var(--radius-sm); background:rgba(224,102,90,0.14); color:#f3a49c; font-weight:800; font-size:12.5px; cursor:pointer;">
                    <span class="ic"><i data-lucide="log-out"></i></span>
                    <span class="label">Keluar</span>
                </button>
            </form>
        </aside>
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

        <div class="main">
            <header class="topbar">
                <button class="hamburger" id="hamburgerBtn" aria-label="Buka menu">
                    <span class="ic"><i data-lucide="menu"></i></span>
                </button>
                <h1 class="topbar-title">Dashboard</h1>
                <div class="topbar-actions">
                    <div class="search-box">
                        <span class="ic"><i data-lucide="search"></i></span>
                        <input type="text" placeholder="Cari pengguna, role, data..." />
                    </div>
                    <button class="icon-btn" aria-label="Notifikasi">
                        <span class="ic"><i data-lucide="bell"></i></span>
                        <span class="dot-badge"></span>
                    </button>

                </div>
            </header>

            <div class="content">
                <div class="greeting">
                    <div>
                        <p class="greeting-eyebrow">Selamat datang kembali</p>
                        <h2 class="greeting-title">Halo, {{ auth()->user()->name ?? 'Super Admin' }} 👋</h2>
                    </div>
                    <span class="live-tag"><span class="dot"></span>Data real-time</span>
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
            </div>
        </div>
    </div>

    <nav class="bottom-nav">
        <a href="{{ route('dashboard') }}" class="active">
            <span class="ic"><i data-lucide="layout-dashboard"></i></span>
            <span>Home</span>
        </a>
        <a href="#">
            <span class="ic"><i data-lucide="users"></i></span>
            <span>Pengguna</span>
        </a>
        <a href="#" class="home">
            <span class="ic"><i data-lucide="database"></i></span>
            <span>Master</span>
        </a>
        <a href="#">
            <span class="ic"><i data-lucide="bar-chart-3"></i></span>
            <span>Monitor</span>
        </a>
        <a href="#">
            <span class="ic"><i data-lucide="user-circle"></i></span>
            <span>Profil</span>
        </a>
    </nav>

    <div class="toast-wrap" id="toastWrap"
        style="position:fixed;bottom:24px;left:50%;transform:translateX(-50%);z-index:100;">
        <div id="toastEl"
            style="opacity:0;pointer-events:none;transition:opacity .25s, transform .25s;transform:translateY(20px);background:var(--navy-900);color:#fff;padding:12px 22px;border-radius:999px;font-size:13px;font-weight:700;box-shadow:0 10px 24px rgba(21,33,89,.25);">
        </div>
    </div>

    <script>
        lucide.createIcons();

        // ===== Menu hamburger (drawer navigasi untuk HP) =====
        (function () {
            const ham = document.getElementById("hamburgerBtn");
            const sb = document.querySelector(".sidebar");
            const bd = document.getElementById("sidebarBackdrop");
            if (ham && sb && bd) {
                const openMenu = () => { sb.classList.add("open"); bd.classList.add("show"); };
                const closeMenu = () => { sb.classList.remove("open"); bd.classList.remove("show"); };
                ham.addEventListener("click", openMenu);
                bd.addEventListener("click", closeMenu);
                sb.querySelectorAll("a").forEach((a) => a.addEventListener("click", closeMenu));
            }
        })();
    </script>
</body>

</html>