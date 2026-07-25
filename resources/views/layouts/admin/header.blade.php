<?php
$title = $data['title'] ?? 'Dashboard';
?>
<header class="sticky top-0 z-30 flex items-center gap-4 border-b border-slate-200 bg-white px-4 py-3 md:px-6">
    <button id="hamburgerBtn" aria-label="Buka menu"
        class="grid h-10 w-10 place-items-center rounded-lg text-[var(--navy-900)] hover:bg-slate-100 md:hidden">
        <i data-lucide="menu" class="h-5 w-5"></i>
    </button>

    <h1 class="flex-1 truncate font-serif text-lg font-bold text-[var(--navy-900)] md:text-xl">
        {{ $title }}
    </h1>

    <div class="flex items-center gap-2 md:gap-3">
        <div class="relative hidden items-center sm:flex">
            <i data-lucide="search" class="pointer-events-none absolute left-3 h-4 w-4 text-slate-400"></i>
            <input type="text" placeholder="Cari pengguna, role, data..."
                class="w-56 rounded-full border border-slate-200 bg-slate-50 py-2 pl-9 pr-4 text-sm text-slate-700 outline-none transition focus:border-[var(--teal-500,#0d9488)] focus:bg-white md:w-72" />
        </div>

        <button aria-label="Notifikasi"
            class="relative grid h-10 w-10 place-items-center rounded-full text-[var(--navy-900)] hover:bg-slate-100">
            <i data-lucide="bell" class="h-5 w-5"></i>
            <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-[var(--coral-500,#e0665a)]"></span>
        </button>
    </div>
</header>