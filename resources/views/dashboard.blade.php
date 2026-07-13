<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard &mdash; PKKMBKT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.07);
        }

        .nav-item {
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-item.active::before,
        .nav-item:hover::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            border-radius: 0 4px 4px 0;
            background: linear-gradient(180deg, #6366f1, #8b5cf6);
        }

        .nav-item.active {
            background: rgba(99, 102, 241, 0.12);
            color: #a5b4fc;
        }

        .nav-item:hover {
            background: rgba(99, 102, 241, 0.08);
            color: #c7d2fe;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            background: rgba(255, 255, 255, 0.07);
            border-color: rgba(99, 102, 241, 0.3);
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        }

        .main-bg {
            background: #0d1117;
        }

        .topbar {
            background: rgba(13, 17, 23, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .avatar-ring {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
        }

        .badge {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
        }

        .logout-btn {
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
        }

        .orb-dashboard {
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.08;
            pointer-events: none;
        }

        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(99, 102, 241, 0.3);
            border-radius: 99px;
        }

        #sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 20;
            backdrop-filter: blur(4px);
        }

        #sidebar-overlay.show {
            display: block;
        }
    </style>
</head>

<body class="main-bg min-h-screen text-slate-300">

    <!-- Ambient Orbs -->
    <div class="orb-dashboard w-96 h-96 bg-indigo-600" style="top:-5rem; left:14rem;"></div>
    <div class="orb-dashboard w-80 h-80 bg-purple-600" style="bottom:-5rem; right:-2rem;"></div>

    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <div class="flex min-h-screen">

        <!-- ══════════════ SIDEBAR ══════════════ -->
        <aside id="sidebar"
            class="sidebar fixed top-0 left-0 h-full w-64 z-30 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">

            <!-- Brand -->
            <div class="flex items-center gap-3 px-6 py-6 border-b border-white/[0.06]">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0"
                    style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-white leading-tight">PKK MBKT</p>
                    <p class="text-xs text-slate-500">Portal Mahasiswa</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                <p class="text-[10px] font-semibold text-slate-600 uppercase tracking-widest px-3 mb-3">Menu Utama</p>

                <a href="{{ route('dashboard') }}"
                    class="nav-item active flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium">
                    <span class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                        style="background: rgba(99,102,241,0.2);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </span>
                    Dashboard
                </a>
            </nav>

            <!-- User Info + Logout -->
            <div class="px-3 pb-5 border-t border-white/[0.06] pt-4 space-y-2">
                <div class="flex items-center gap-3 px-3 py-3 rounded-xl bg-white/[0.03]">
                    <div
                        class="avatar-ring w-8 h-8 rounded-full flex items-center justify-center shrink-0 text-white text-xs font-bold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-semibold text-white truncate">{{ auth()->user()->name ?? 'User' }}</p>
                        <p class="text-[10px] text-slate-500 truncate">{{ auth()->user()->role_name ?? '-' }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="logout-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400">
                        <span class="w-8 h-8 rounded-lg flex items-center justify-center bg-white/[0.05]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </span>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- ══════════════ MAIN ══════════════ -->
        <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">

            <!-- Topbar -->
            <header class="topbar sticky top-0 z-10 flex items-center justify-between px-6 h-16">
                <button onclick="toggleSidebar()"
                    class="lg:hidden w-9 h-9 flex items-center justify-center rounded-lg bg-white/5 hover:bg-white/10 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="hidden lg:block">
                    <h1 class="text-base font-semibold text-white">Dashboard</h1>
                    <p class="text-xs text-slate-500">Selamat datang kembali 👋</p>
                </div>

                <div class="flex items-center gap-3 ml-auto">
                    <button
                        class="relative w-9 h-9 flex items-center justify-center rounded-lg bg-white/5 hover:bg-white/10 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-indigo-500 rounded-full"></span>
                    </button>
                    <div
                        class="avatar-ring w-9 h-9 rounded-full flex items-center justify-center text-white text-xs font-bold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6 space-y-6 fade-in">

                <!-- Greeting Banner -->
                <div class="rounded-2xl p-6 relative overflow-hidden"
                    style="background: linear-gradient(135deg, rgba(99,102,241,0.2) 0%, rgba(139,92,246,0.15) 100%); border: 1px solid rgba(99,102,241,0.25);">
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 opacity-10 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32 text-indigo-400" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z" />
                        </svg>
                    </div>
                    <p class="text-xs text-indigo-300 font-semibold uppercase tracking-widest mb-1">Portal PKK MBKT</p>
                    <h2 class="text-xl font-bold text-white mb-1">Halo, {{ auth()->user()->name ?? 'User' }}! 👋</h2>
                    <p class="text-sm text-slate-400">Anda login sebagai <span
                            class="text-indigo-300 font-medium">{{ auth()->user()->role_name ?? '-' }}</span></p>
                </div>

                <!-- Stat Cards -->
                @php
                    $stats = [
                        ['label' => 'Jadwal', 'value' => '0', 'color' => '#6366f1', 'bg' => 'rgba(99,102,241,0.15)', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['label' => 'Modul', 'value' => '0', 'color' => '#06b6d4', 'bg' => 'rgba(6,182,212,0.15)', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                        ['label' => 'Tugas', 'value' => '0', 'color' => '#10b981', 'bg' => 'rgba(16,185,129,0.15)', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                        ['label' => 'Absensi', 'value' => '0', 'color' => '#f59e0b', 'bg' => 'rgba(245,158,11,0.15)', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ];
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                    @foreach($stats as $stat)
                        <div class="stat-card rounded-2xl p-5">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest">
                                    {{ $stat['label'] }}
                                </p>
                                <span class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0"
                                    style="background: {{ $stat['bg'] }};">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2" style="color: {{ $stat['color'] }};">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}" />
                                    </svg>
                                </span>
                            </div>
                            <p class="text-3xl font-bold text-white">{{ $stat['value'] }}</p>
                            <p class="text-xs text-slate-600 mt-1">Total {{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Info & Jadwal Panels -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                    <div class="stat-card rounded-2xl p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-semibold text-white">Informasi Terbaru</h3>
                            <span
                                class="badge text-[10px] text-white font-semibold px-2 py-0.5 rounded-full">Baru</span>
                        </div>
                        <div class="space-y-3">
                            @for($i = 0; $i < 3; $i++)
                                <div class="flex items-start gap-3 p-3 rounded-xl bg-white/[0.03]">
                                    <span class="w-2 h-2 rounded-full bg-indigo-400 mt-1.5 shrink-0"></span>
                                    <div>
                                        <p class="text-xs text-slate-400">Belum ada informasi</p>
                                        <p class="text-[10px] text-slate-600 mt-0.5">—</p>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div class="stat-card rounded-2xl p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-semibold text-white">Jadwal Terdekat</h3>
                            <span class="text-[10px] text-slate-500">{{ now()->format('d M Y') }}</span>
                        </div>
                        <div class="space-y-3">
                            @for($i = 0; $i < 3; $i++)
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-white/[0.03]">
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0"
                                        style="background: rgba(99,102,241,0.15);">
                                        <span class="text-xs font-bold text-indigo-400">—</span>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-400">Belum ada jadwal</p>
                                        <p class="text-[10px] text-slate-600 mt-0.5">—</p>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                </div>
            </main>

            <footer class="px-6 py-4 border-t border-white/[0.05] text-center">
                <p class="text-xs text-slate-700">&copy; {{ date('Y') }} PKK MBKT. All rights reserved.</p>
            </footer>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const isOpen = !sidebar.classList.contains('-translate-x-full');
            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.remove('show');
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('show');
            }
        }
    </script>
</body>

</html>