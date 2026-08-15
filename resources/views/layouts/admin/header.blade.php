<?php
$title = $data['title'] ?? 'Dashboard';
?>
<header class="topbar">
    <button class="hamburger" id="hamburgerBtn" aria-label="Buka menu">
        <span class="ic"><i data-lucide="menu"></i></span>
    </button>
    <h1 class="topbar-title">{{ $title }}</h1>
    <div class="topbar-actions">
        <div class="search-box">
            <span class="ic"><i data-lucide="search"></i></span>
            <input type="text" placeholder="Cari pengguna, role, data..." />
        </div>
        <a href="{{ route('admin.profil.index') }}" class="icon-btn" aria-label="Profil Saya" style="overflow: hidden; padding: 0;">
            @if (auth()->user()->profile_picture)
                <img src="{{ asset('storage/'.auth()->user()->profile_picture).'?v='.auth()->user()->updated_at->timestamp }}"
                    alt="Foto profil" style="width:100%; height:100%; border-radius:50%; object-fit:cover;" />
            @else
                <span class="ic"><i data-lucide="user-round"></i></span>
            @endif
        </a>
    </div>
</header>