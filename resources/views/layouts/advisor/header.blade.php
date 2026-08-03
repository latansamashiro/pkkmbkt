<?php
$title = $data['title'] ?? 'DASHBOARD PEMBIMBING & KOORDINATOR';
?>
<header class="topbar">
    <button class="hamburger" id="hamburgerBtn" aria-label="Buka menu">
        <span class="ic"><i data-lucide="menu"></i></span>
    </button>
    <h1 class="topbar-title">{{ $title }}</h1>
    <div class="topbar-actions">
        <div class="search-box">
            <span class="ic"><i data-lucide="search"></i></span>
            <input type="text" placeholder="Cari kelompok binaan, jadwal..." />
        </div>
        <button class="icon-btn" aria-label="Notifikasi">
            <span class="ic"><i data-lucide="bell"></i></span>
            <span class="dot-badge"></span>
        </button>
    </div>
</header>
