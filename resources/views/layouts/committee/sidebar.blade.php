<aside class="sidebar">
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <img src="{{ asset('assets/unilam.png') }}" alt="Logo UNILAM" class="brand-badge" />
        <div class="brand-text"><strong>PKKMB-KT</strong><span>Panel Panitia</span></div>
    </a>
    <nav class="sidebar-nav" aria-label="Navigasi panitia">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="ic"><i data-lucide="layout-dashboard"></i></span>
            <span class="label">Dashboard</span>
        </a>

        <p class="sidebar-group-label">Kelola Data</p>
        <a href="{{ route('committee.mahasiswa.index') }}"
            class="{{ request()->routeIs('committee.mahasiswa.*') ? 'active' : '' }}">
            <span class="ic"><i data-lucide="graduation-cap"></i></span>
            <span class="label">Mahasiswa Baru</span>
        </a>
        <a href="{{ route('committee.mentor.index') }}"
            class="{{ request()->routeIs('committee.mentor.*') ? 'active' : '' }}">
            <span class="ic"><i data-lucide="user-check"></i></span>
            <span class="label">Mentor</span>
        </a>
        <a href="{{ route('committee.master.index') }}" class="{{ request()->routeIs('committee.master.*') ? 'active' : '' }}">
            <span class="ic"><i data-lucide="users-round"></i></span>
            <span class="label">Kelompok</span>
        </a>
        <a href="{{ route('committee.data-master.index') }}" class="{{ request()->routeIs('committee.data-master.*') ? 'active' : '' }}">
            <span class="ic"><i data-lucide="calendar-days"></i></span>
            <span class="label">Jadwal</span>
        </a>
        <a href="#">
            <span class="ic"><i data-lucide="calendar-check"></i></span>
            <span class="label">Absensi</span>
        </a>
        <a href="{{ route('committee.informasi.index') }}" class="{{ request()->routeIs('committee.informasi.*') ? 'active' : '' }}">
            <span class="ic"><i data-lucide="megaphone"></i></span>
            <span class="label">Informasi</span>
        </a>
        <a href="{{ route('committee.modul-pkkmb.index') }}" class="{{ request()->routeIs('committee.master.*') ? 'active' : '' }}">
            <span class="ic"><i data-lucide="book-open"></i></span>
            <span class="label">Modul PKKMB</span>
        </a>
          <a href="{{ route('committee.materi.index') }}" class="{{ request()->routeIs('committee.materi.*') ? 'active' : '' }}">
            <span class="ic"><i data-lucide="presentation"></i></span>
            <span class="label">Materi</span>
        </a>
         <a href="{{ route('committee.evaluasi.index') }}" class="{{ request()->routeIs('committee.evaluasi.*') ? 'active' : '' }}">
            <span class="ic"><i data-lucide="clipboard-list"></i></span>
            <span class="label">Evaluasi</span>
        </a>

        <p class="sidebar-group-label">Monitoring</p>
        <a href="#">
            <span class="ic"><i data-lucide="calendar-check"></i></span>
            <span class="label">Absensi</span>
        </a>
        <a href="#">
            <span class="ic"><i data-lucide="clipboard-check"></i></span>
            <span class="label">Evaluasi</span>
        </a>
        <a href="#">
            <span class="ic"><i data-lucide="activity"></i></span>
            <span class="label">Keaktifan</span>
        </a>
        <a href="#">
            <span class="ic"><i data-lucide="alert-triangle"></i></span>
            <span class="label">Pelanggaran</span>
        </a>

        <p class="sidebar-group-label">Lainnya</p>
        <a href="#">
            <span class="ic"><i data-lucide="trophy"></i></span>
            <span class="label">Leaderboard</span>
        </a>
        <a href="#">
            <span class="ic"><i data-lucide="download"></i></span>
            <span class="label">Laporan</span>
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