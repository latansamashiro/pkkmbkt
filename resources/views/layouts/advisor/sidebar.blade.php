<aside class="sidebar">
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <img src="{{ asset('assets/unilam.png') }}" alt="Logo UNILAM" class="brand-badge" />
        <div class="brand-text"><strong>PKKMB-KT</strong><span>Panel Pembimbing</span></div>
    </a>
    <nav class="sidebar-nav" aria-label="Navigasi pembimbing">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="ic"><i data-lucide="layout-dashboard"></i></span>
            <span class="label">Dashboard</span>
        </a>

        <p class="sidebar-group-label">Kelola Data</p>
        <a href="{{ route('role.advisor.kelompok-binaan') }}"
            class="{{ request()->routeIs('role.advisor.kelompok-binaan*') ? 'active' : '' }}">
            <span class="ic"><i data-lucide="users-round"></i></span>
            <span class="label">Kelompok Binaan</span>
        </a>

        <p class="sidebar-group-label">Monitoring</p>
        <a href="{{ route('role.advisor.monitoring.absensi') }}"
            class="{{ request()->routeIs('role.advisor.monitoring.absensi*') ? 'active' : '' }}">
            <span class="ic"><i data-lucide="calendar-check"></i></span>
            <span class="label">Absensi</span>
        </a>
        <a href="#" class="disabled" aria-disabled="true">
            <span class="ic"><i data-lucide="clipboard-check"></i></span>
            <span class="label">Evaluasi</span>
        </a>
        <a href="#" class="disabled" aria-disabled="true">
            <span class="ic"><i data-lucide="activity"></i></span>
            <span class="label">Keaktifan</span>
        </a>
        <a href="#" class="disabled" aria-disabled="true">
            <span class="ic"><i data-lucide="alert-triangle"></i></span>
            <span class="label">Pelanggaran</span>
        </a>

        <p class="sidebar-group-label">Lainnya</p>
        <a href="#" class="disabled" aria-disabled="true">
            <span class="ic"><i data-lucide="trophy"></i></span>
            <span class="label">Leaderboard</span>
        </a>
        <a href="{{ route('role.advisor.profil') }}"
            class="{{ request()->routeIs('role.advisor.profil*') ? 'active' : '' }}">
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
