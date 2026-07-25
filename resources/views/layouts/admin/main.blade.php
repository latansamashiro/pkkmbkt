<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard Super Admin &mdash; PKKMB-KT UNILAM 2026</title>

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['Lora', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                },
            },
        };
    </script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Lucide icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Tetap dipakai hanya untuk definisi CSS custom property (token warna) -->
    @vite(['resources/css/pkkmbkt-theme.css'])
</head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-800">
    <div class="app flex min-h-screen">
        @include('layouts.admin.sidebar')

        <div id="sidebarBackdrop" class="fixed inset-0 z-30 hidden bg-black/40 md:hidden"></div>

        <div class="main flex min-h-screen flex-1 flex-col">
            @include('layouts.admin.header')

            <div class="content flex-1 px-4 pb-24 pt-4 md:px-6 md:pb-6">
                @yield('content')
            </div>
        </div>
    </div>

    <nav
        class="fixed inset-x-0 bottom-0 z-30 flex items-center justify-around border-t border-slate-200 bg-white py-2 md:hidden">
        <a href="{{ route('dashboard') }}"
            class="flex flex-col items-center gap-1 px-2 py-1 text-[11px] font-semibold text-[var(--navy-900)]">
            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('admin.user.index') }}"
            class="flex flex-col items-center gap-1 px-2 py-1 text-[11px] font-semibold text-slate-500">
            <i data-lucide="users" class="h-5 w-5"></i>
            <span>Pengguna</span>
        </a>
        <a href="{{ route('admin.data-master.index') }}"
            class="flex flex-col items-center gap-1 px-2 py-1 text-[11px] font-semibold text-slate-500">
            <i data-lucide="database" class="h-5 w-5"></i>
            <span>Master</span>
        </a>
        <a href="{{ route('admin.monitoring.pkkmb') }}"
            class="flex flex-col items-center gap-1 px-2 py-1 text-[11px] font-semibold text-slate-500">
            <i data-lucide="bar-chart-3" class="h-5 w-5"></i>
            <span>Monitor</span>
        </a>
        <a href="{{ route('admin.profil.index') }}"
            class="flex flex-col items-center gap-1 px-2 py-1 text-[11px] font-semibold text-slate-500">
            <i data-lucide="user-circle" class="h-5 w-5"></i>
            <span>Profil</span>
        </a>
    </nav>

    <div id="toastWrap" class="fixed bottom-6 left-1/2 z-[100] -translate-x-1/2">
        <div id="toastEl"
            class="pointer-events-none translate-y-5 rounded-full bg-[var(--navy-900)] px-6 py-3 text-[13px] font-bold text-white opacity-0 shadow-lg transition-all duration-200">
        </div>
    </div>

    <script>
        lucide.createIcons();

        function tampilkanToast(pesan) {
            const $toast = $('#toastEl');
            $toast.text(pesan)
                .removeClass('opacity-0 translate-y-5')
                .addClass('opacity-100 translate-y-0');

            clearTimeout(window.__toastTimer);
            window.__toastTimer = setTimeout(() => {
                $toast.removeClass('opacity-100 translate-y-0')
                    .addClass('opacity-0 translate-y-5');
            }, 2600);
        }

        // ===== Menu hamburger (drawer navigasi untuk HP) =====
        $(function () {
            const $sidebar = $('.sidebar');
            const $backdrop = $('#sidebarBackdrop');

            function openMenu() {
                $sidebar.removeClass('-translate-x-full').addClass('translate-x-0');
                $backdrop.removeClass('hidden');
            }

            function closeMenu() {
                $sidebar.removeClass('translate-x-0').addClass('-translate-x-full');
                $backdrop.addClass('hidden');
            }

            $('#hamburgerBtn').on('click', openMenu);
            $backdrop.on('click', closeMenu);
            $sidebar.find('a').on('click', closeMenu);
        });
    </script>

    @stack('scripts')
</body>

</html>