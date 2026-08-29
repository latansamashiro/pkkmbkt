<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>DASHBOARD PANITIA &mdash; PKKMB-KT UNILAM 2026</title>
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
        @include('layouts.committee.sidebar')
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

        <div class="main">
            @include('layouts.committee.header')

            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <nav class="bottom-nav">
        <a href="{{ route('committee.master.index') }}">
            <span class="ic"><i data-lucide="users"></i></span>
            <span>Kelompok</span>
        </a>
        <a href="{{ route('committee.data-master.index') }}">
            <span class="ic"><i data-lucide="calendar"></i></span>
            <span>Jadwal</span>
        </a>
         <a href="{{ route('dashboard') }}" class="home">
            <span class="ic"><i data-lucide="layout-dashboard"></i></span>
            <span>Home</span>
        </a>
        <a href="{{ route('committee.absensi.index') }}">
            <span class="ic"><i data-lucide="calendar-check"></i></span>
            <span>Absensi</span>
        </a>
         <a href="{{ route('committee.profil.index') }}">
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

        function tampilkanToast(pesan) {
            const el = document.getElementById("toastEl");
            el.textContent = pesan;
            el.style.opacity = "1";
            el.style.transform = "translateY(0)";
            clearTimeout(window.__toastTimer);
            window.__toastTimer = setTimeout(() => {
                el.style.opacity = "0";
                el.style.transform = "translateY(20px)";
            }, 2600);
        }

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

    @stack('scripts')
</body>

</html>
