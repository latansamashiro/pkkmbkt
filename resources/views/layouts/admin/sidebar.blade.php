<aside class="sidebar">
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <img src="{{ asset('assets/unilam.png') }}" alt="Logo UNILAM" class="brand-badge" />
        <div class="brand-text"><strong>PKKMB-KT</strong><span>Panel Super Admin</span></div>
    </a>
    <nav class="sidebar-nav" aria-label="Navigasi super admin">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="ic"><i data-lucide="layout-dashboard"></i></span>
            <span class="label">Dashboard</span>
        </a>

        <button type="button" class="sidebar-group-toggle" data-group="administrasi">
            <span>Administrasi</span>
            <i data-lucide="chevron-down" class="chevron"></i>
        </button>
        <div class="sidebar-group-content" data-group-content="administrasi">
            <a href="{{ route('admin.user.index') }}" class="{{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="users"></i></span>
                <span class="label">Kelola Admin</span>
            </a>
            <a href="{{ route('admin.mahasiswa.index') }}"
                class="{{ request()->routeIs('admin.mahasiswa.*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="graduation-cap"></i></span>
                <span class="label">Kelola Mahasiswa</span>
            </a>
            <a href="{{ route('admin.mentor.index') }}" class="{{ request()->routeIs('admin.mentor.*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="user-check"></i></span>
                <span class="label">Kelola Mentor</span>
            </a>
            <a href="{{ route('admin.advisor.index') }}"
                class="{{ request()->routeIs('admin.advisor.*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="user-cog"></i></span>
                <span class="label">Kelola Advisor</span>
            </a>
            <a href="{{ route('admin.kelompok.index') }}"
                class="{{ request()->routeIs('admin.kelompok.*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="users-round"></i></span>
                <span class="label">Kelola Kelompok</span>
            </a>
            <a href="{{ route('admin.panitia.index') }}"
                class="{{ request()->routeIs('admin.panitia.*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="briefcase"></i></span>
                <span class="label">Kelola Panitia</span>
            </a>
            <a href="{{ route('admin.role.index') }}" class="{{ request()->routeIs('admin.role.*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="shield-check"></i></span>
                <span class="label">Kelola Role & Hak Akses</span>
            </a>
            <a href="{{ route('admin.data-master.index') }}"
                class="{{ request()->routeIs('admin.data-master.*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="database"></i></span>
                <span class="label">Kelola Data Master</span>
            </a>
        </div>

        <button type="button" class="sidebar-group-toggle" data-group="monitoring">
            <span>Monitoring</span>
            <i data-lucide="chevron-down" class="chevron"></i>
        </button>
        <div class="sidebar-group-content" data-group-content="monitoring">
            <a href="{{ route('admin.monitoring.pkkmb') }}"
                class="{{ request()->routeIs('admin.monitoring.pkkmb') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="bar-chart-3"></i></span>
                <span class="label">Monitoring PKKMB</span>
            </a>
            <a href="{{ route('admin.monitoring.absensi') }}"
                class="{{ request()->routeIs('admin.monitoring.absensi*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="calendar-check"></i></span>
                <span class="label">Absensi</span>
            </a>
            <a href="{{ route('admin.monitoring.evaluasi') }}"
                class="{{ request()->routeIs('admin.monitoring.evaluasi*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="clipboard-check"></i></span>
                <span class="label">Evaluasi</span>
            </a>
            <a href="{{ route('admin.monitoring.keaktifan') }}"
                class="{{ request()->routeIs('admin.monitoring.keaktifan*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="activity"></i></span>
                <span class="label">Keaktifan</span>
            </a>
            <a href="{{ route('admin.monitoring.pelanggaran') }}"
                class="{{ request()->routeIs('admin.monitoring.pelanggaran*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="alert-triangle"></i></span>
                <span class="label">Pelanggaran</span>
            </a>
            <a href="{{ route('admin.monitoring.laporan') }}"
                class="{{ request()->routeIs('admin.monitoring.laporan') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="file-bar-chart-2"></i></span>
                <span class="label">Monitoring Laporan</span>
            </a>
        </div>

        <button type="button" class="sidebar-group-toggle" data-group="lainnya">
            <span>Lainnya</span>
            <i data-lucide="chevron-down" class="chevron"></i>
        </button>
        <div class="sidebar-group-content" data-group-content="lainnya">
            <a href="{{ route('admin.pengaturan.index') }}"
                class="{{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}">
                <span class="ic"><i data-lucide="settings"></i></span>
                <span class="label">Pengaturan Sistem</span>
            </a>
        </div>
    </nav>

    <nav class="sidebar-nav" style="flex:none; border-top:1px solid rgba(255,255,255,0.08); padding-top:8px;" aria-label="Profil">
        <a href="{{ route('admin.profil.index') }}" class="{{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
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

<script>
    (function () {
        // Buka/tutup tiap grup sidebar, dan ingat pilihannya per browser (localStorage)
        // supaya tetap kebuka/tertutup pas pindah halaman (karena ini bukan SPA).
        document.querySelectorAll(".sidebar-group-toggle").forEach(function (btn) {
            var group = btn.dataset.group;
            var content = document.querySelector('[data-group-content="' + group + '"]');
            if (!content) return;

            var savedState = localStorage.getItem("sidebarGroup:" + group);
            // Kalau ada link yang lagi aktif di dalam grup ini, paksa terbuka
            // biar user tidak bingung kenapa halaman aktifnya "hilang".
            var adaAktif = content.querySelector("a.active") !== null;
            // Defaultnya TERTUTUP (biar sidebar tidak kepanjangan pas awal buka),
            // kecuali grup ini lagi aktif, atau user pernah buka manual sebelumnya.
            var harusTertutup = adaAktif ? false : (savedState ? savedState === "collapsed" : true);

            if (harusTertutup) {
                btn.classList.add("collapsed");
                content.classList.add("collapsed");
            }

            btn.addEventListener("click", function () {
                var collapsed = btn.classList.toggle("collapsed");
                content.classList.toggle("collapsed", collapsed);
                localStorage.setItem("sidebarGroup:" + group, collapsed ? "collapsed" : "open");
            });
        });
    })();
</script>
