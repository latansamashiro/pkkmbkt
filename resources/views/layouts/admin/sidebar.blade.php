<aside
    class="sidebar fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col bg-[var(--navy-900)] p-4 text-white transition-transform duration-300 md:sticky md:top-0 md:h-screen md:translate-x-0">

    <a href="{{ route('dashboard') }}" class="mb-6 flex items-center gap-3 px-2">
        <img src="{{ asset('assets/unilam.png') }}" alt="Logo UNILAM" class="h-10 w-10 rounded-lg object-cover" />
        <div class="leading-tight">
            <strong class="block font-serif text-sm">PKKMB-KT</strong>
            <span class="text-xs text-white/60">Panel Super Admin</span>
        </div>
    </a>

    <nav aria-label="Navigasi super admin" class="flex-1 space-y-1 overflow-y-auto">
        <p class="mb-1 mt-3 px-2 text-[11px] font-bold uppercase tracking-wide text-white/40">Utama</p>
        <a href="{{ route('dashboard') }}" @class([
            'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition',
            'bg-white/10 text-white' => request()->routeIs('dashboard'),
            'text-white/70 hover:bg-white/5 hover:text-white' => !request()->routeIs('dashboard'),
        ])>
            <i data-lucide="layout-dashboard" class="h-4 w-4"></i>
            <span>Dashboard</span>
        </a>

        <p class="mb-1 mt-4 px-2 text-[11px] font-bold uppercase tracking-wide text-white/40">Administrasi</p>
        <a href="{{ route('admin.user.index') }}" @class([
            'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition',
            'bg-white/10 text-white' => request()->routeIs('admin.user.*'),
            'text-white/70 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.user.*'),
        ])>
            <i data-lucide="users" class="h-4 w-4"></i>
            <span>Kelola Pengguna</span>
        </a>
        <a href="{{ route('admin.role.index') }}" @class([
            'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition',
            'bg-white/10 text-white' => request()->routeIs('admin.role.*'),
            'text-white/70 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.role.*'),
        ])>
            <i data-lucide="shield-check" class="h-4 w-4"></i>
            <span>Kelola Role &amp; Hak Akses</span>
        </a>
        <a href="{{ route('admin.data-master.index') }}" @class([
            'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition',
            'bg-white/10 text-white' => request()->routeIs('admin.data-master.*'),
            'text-white/70 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.data-master.*'),
        ])>
            <i data-lucide="database" class="h-4 w-4"></i>
            <span>Kelola Data Master</span>
        </a>

        <p class="mb-1 mt-4 px-2 text-[11px] font-bold uppercase tracking-wide text-white/40">Monitoring</p>
        <a href="{{ route('admin.monitoring.pkkmb') }}" @class([
            'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition',
            'bg-white/10 text-white' => request()->routeIs('admin.monitoring.pkkmb'),
            'text-white/70 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.monitoring.pkkmb'),
        ])>
            <i data-lucide="bar-chart-3" class="h-4 w-4"></i>
            <span>Monitoring PKKMB</span>
        </a>
        <a href="{{ route('admin.monitoring.laporan') }}" @class([
            'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition',
            'bg-white/10 text-white' => request()->routeIs('admin.monitoring.laporan'),
            'text-white/70 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.monitoring.laporan'),
        ])>
            <i data-lucide="file-bar-chart-2" class="h-4 w-4"></i>
            <span>Monitoring Laporan</span>
        </a>

        <p class="mb-1 mt-4 px-2 text-[11px] font-bold uppercase tracking-wide text-white/40">Lainnya</p>
        <a href="{{ route('admin.pengaturan.index') }}" @class([
            'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition',
            'bg-white/10 text-white' => request()->routeIs('admin.pengaturan.*'),
            'text-white/70 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.pengaturan.*'),
        ])>
            <i data-lucide="settings" class="h-4 w-4"></i>
            <span>Pengaturan Sistem</span>
        </a>
        <a href="{{ route('admin.profil.index') }}" @class([
            'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition',
            'bg-white/10 text-white' => request()->routeIs('admin.profil.*'),
            'text-white/70 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.profil.*'),
        ])>
            <i data-lucide="user-circle" class="h-4 w-4"></i>
            <span>Profil</span>
        </a>
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="mt-4 border-t border-white/10 pt-3">
        @csrf
        <button type="submit"
            class="flex w-full items-center justify-center gap-2 rounded-lg bg-[var(--coral-500,#e0665a)]/15 px-3 py-3 text-xs font-extrabold text-[var(--coral-300,#f3a49c)] transition hover:bg-[var(--coral-500,#e0665a)]/25">
            <i data-lucide="log-out" class="h-4 w-4"></i>
            <span>Keluar</span>
        </button>
    </form>
</aside>