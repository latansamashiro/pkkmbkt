<?php
$title = $data['title'] ?? 'DASHBOARD PANITIA';
?>
<header class="topbar">
    <button class="hamburger" id="hamburgerBtn" aria-label="Buka menu">
        <span class="ic"><i data-lucide="menu"></i></span>
    </button>
    <h1 class="topbar-title">{{ $title }}</h1>
    <div class="topbar-actions">
        <div class="search-box">
            <span class="ic"><i data-lucide="search"></i></span>
            <input type="text" placeholder="Cari mahasiswa, kelompok, jadwal..." />
        </div>
        <a href="{{ route('committee.profil.index') }}" class="icon-btn" aria-label="Profil Saya">
            <span class="ic"><i data-lucide="user-round"></i></span>
        </a>
    </div>
</header>
