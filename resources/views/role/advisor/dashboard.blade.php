<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard Dosen Pembimbing &mdash; PKKMB-KT UNILAM 2026</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/pkkmbkt-theme.css'])
</head>

<body>
    <div class="placeholder-page">
        <div class="placeholder-topbar">
            <div class="placeholder-brand">
                <span class="placeholder-brand-badge">P</span>
                <div>
                    <strong>PKKMB-KT</strong>
                    <span>Panel Dosen Pembimbing</span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="placeholder-logout">
                    <span class="ic"><i data-lucide="log-out"></i></span>
                    Keluar
                </button>
            </form>
        </div>

        <div class="placeholder-body">
            <div class="placeholder-card">
                <div class="placeholder-icon">
                    <i data-lucide="user-cog"></i>
                </div>
                <span class="placeholder-role">ADVISOR</span>
                <h1 class="placeholder-title">Halo, {{ auth()->user()->name }}</h1>
                <p class="placeholder-desc">
                    Dashboard Dosen Pembimbing sedang disiapkan. Halaman ini akan diganti dengan
                    tampilan dan menu Dosen Pembimbing yang sesungguhnya.
                </p>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
