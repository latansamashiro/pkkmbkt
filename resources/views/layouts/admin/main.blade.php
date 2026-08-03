<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
        @include('layouts.admin.sidebar')
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

        <div class="main">
            @include('layouts.admin.header')

            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <nav class="bottom-nav">
        <a href="{{ route('dashboard') }}" class="active">
            <span class="ic"><i data-lucide="layout-dashboard"></i></span>
            <span>Home</span>
        </a>
        <a href="{{ route('admin.user.index') }}">
            <span class="ic"><i data-lucide="users"></i></span>
            <span>Pengguna</span>
        </a>
        <a href="{{ route('admin.data-master.index') }}" class="home">
            <span class="ic"><i data-lucide="database"></i></span>
            <span>Master</span>
        </a>
        <a href="{{ route('admin.monitoring.pkkmb') }}">
            <span class="ic"><i data-lucide="bar-chart-3"></i></span>
            <span>Monitor</span>
        </a>
        <a href="{{ route('admin.profil.index') }}">
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

    <!-- ======= MODAL KONFIRMASI LOGOUT ======= -->
    <div id="logoutModal" class="logout-modal-backdrop"
        style="display:none; position:fixed; inset:0; z-index:100; background:rgba(21,33,89,.55); backdrop-filter:blur(4px); align-items:center; justify-content:center; padding:16px;">
        <div class="logout-modal-box"
            style="background:#fff; border-radius:28px; max-width:340px; width:100%; padding:28px; text-align:center; box-shadow:0 25px 50px -12px rgba(0,0,0,.25);">
            <div
                style="width:56px; height:56px; border-radius:9999px; background:#fef2f2; color:#dc2626; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                <span class="ic" style="width:26px;height:26px;"><i data-lucide="log-out"></i></span>
            </div>
            <h3 style="font-family:'Lora',serif; font-size:18px; font-weight:700; color:#1b2238; margin:0 0 8px;">
                Yakin ingin keluar?</h3>
            <p style="font-size:13px; color:#5b6175; line-height:1.6; margin:0 0 20px;">
                Kamu akan keluar dari akun ini dan harus masuk kembali untuk mengakses dashboard.</p>
            <div style="display:flex; gap:10px;">
                <button type="button" id="btnLogoutCancel"
                    style="flex:1; padding:12px; border-radius:12px; border:1px solid #e1e5f1; background:#f2f4fa; color:#1b2238; font-weight:700; font-size:13.5px; cursor:pointer;">Tidak</button>
                <button type="button" id="btnLogoutConfirm"
                    style="flex:1; padding:12px; border-radius:12px; border:none; background:#dc2626; color:#fff; font-weight:800; font-size:13.5px; cursor:pointer;">Ya,
                    Keluar</button>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}" id="logoutForm" style="display:none;">
        @csrf
    </form>

    <script>
        // ===== Konfirmasi logout (tombol Keluar di sidebar) =====
        (function () {
            const modal = document.getElementById("logoutModal");
            const btnSidebar = document.getElementById("btnLogoutSidebar");
            const btnCancel = document.getElementById("btnLogoutCancel");
            const btnConfirm = document.getElementById("btnLogoutConfirm");
            const logoutForm = document.getElementById("logoutForm");

            function bukaModal(e) {
                if (e) e.preventDefault();
                modal.style.display = "flex";
            }
            function tutupModal() {
                modal.style.display = "none";
            }

            if (btnSidebar) btnSidebar.addEventListener("click", bukaModal);
            if (btnCancel) btnCancel.addEventListener("click", tutupModal);
            if (btnConfirm) btnConfirm.addEventListener("click", () => logoutForm.submit());
            if (modal) {
                modal.addEventListener("click", (e) => {
                    if (e.target === modal) tutupModal();
                });
            }
        })();
    </script>

    @stack('scripts')
</body>

</html>