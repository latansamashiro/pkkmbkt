<!doctype html>
<html lang="id">
  <head>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    />
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>Tentang PKKMB-KT</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <style>
        :root{
            --navy-900: #152159;
            --navy-700: #1e3a8f;
            --navy-600: #2a4bb0;
            --teal-600: #0f8a8c;
            --teal-500: #16a0a1;
            --teal-tint: #e2f3f2;
            --lime-500: #a9c73b;
            --lime-tint: #f2f6e0;
            --navy-tint: #e6e9f6;

            --bg: #f2f4fa;
            --surface: #ffffff;
            --surface-muted: #e8ebf6;
            --border: #e1e5f1;
        }

        *{ box-sizing: border-box; }

        body{
            background: var(--bg);
            color: var(--navy-900);
            font-family: "Plus Jakarta Sans", system-ui, sans-serif;
        }

        h1, h2, h3, h4{
            font-family: "Lora", Georgia, serif;
            color: var(--navy-900);
        }

        .mono{
            font-family: "JetBrains Mono", monospace;
            letter-spacing: .02em;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 40;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 14px clamp(16px, 5vw, 48px);
            background: var(--navy-900);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 50;
            text-decoration: none;
        }
        .navbar-logo {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Lora", serif;
            font-size: 9px;
            font-weight: 700;
            color: var(--navy-900);
            text-align: center;
            line-height: 1.25;
            flex-shrink: 0;
            overflow: hidden;
        }
        .navbar-logo img{
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .navbar-brand-text strong {
            display: block;
            font-family: "Lora", serif;
            font-size: 14.5px;
            color: #fff;
        }
        .navbar-brand-text span {
            font-size: 10.5px;
            color: #aeb6e0;
            letter-spacing: 0.04em;
        }
        .menu-toggle {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 24px;
            height: 18px;
            background: transparent;
            border: none;
            cursor: pointer;
            z-index: 50;
            padding: 0;
        }
        .menu-toggle span {
            display: block;
            width: 100%;
            height: 2px;
            background-color: #fff;
            border-radius: 2px;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        .menu-toggle.active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
        .menu-toggle.active span:nth-child(2) { opacity: 0; }
        .menu-toggle.active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }

        .navbar-links {
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            right: -100%;
            width: 280px;
            height: 100vh;
            background: #0d1735;
            padding: 100px 32px 32px;
            gap: 24px;
            transition: right 0.3s ease;
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.3);
            list-style: none;
            margin: 0;
        }
        .navbar-links.active { right: 0; }
        .navbar-links a {
            color: #c7cce8;
            font-size: 16px;
            font-weight: 600;
            transition: color 0.15s;
            display: block;
            text-decoration: none;
        }
        .navbar-links a:hover,
        .navbar-links a.active { color: #fff; }
        .navbar-links a.active {
            border-left: 3px solid var(--lime-500);
            padding-left: 8px;
        }

        .nav-dropdown { position: relative; width: 100%; }
        .nav-dropdown-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            gap: 8px;
            background: transparent;
            border: none;
            padding: 0;
            color: #c7cce8;
            font-family: "Plus Jakarta Sans", sans-serif;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: color 0.15s;
        }
        .nav-dropdown-toggle:hover,
        .nav-dropdown.open .nav-dropdown-toggle { color: #fff; }
        .nav-dropdown-toggle .dropdown-arrow {
            font-size: 12px;
            transition: transform 0.25s ease;
        }
        .nav-dropdown.open .dropdown-arrow { transform: rotate(180deg); }

        .nav-dropdown-menu {
            display: flex;
            flex-direction: column;
            gap: 14px;
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            padding-left: 14px;
            margin-top: 0;
            transition: max-height 0.3s ease, opacity 0.25s ease, margin-top 0.3s ease;
        }
        .nav-dropdown.open .nav-dropdown-menu {
            max-height: 260px;
            opacity: 1;
            margin-top: 14px;
        }
        .nav-dropdown-menu a { font-size: 14.5px; color: #9aa2cc; }
        .nav-dropdown-menu a::before { content: "— "; color: var(--lime-500); }
        .nav-dropdown-menu a:hover { color: #fff; }
        .nav-dropdown-menu a.active { color: #fff; font-weight: 700; }

        @media (min-width: 768px) {
            .menu-toggle { display: none; }
            .navbar-links {
                position: static;
                display: flex;
                flex-direction: row;
                width: auto;
                height: auto;
                background: transparent;
                padding: 0;
                gap: 28px;
                box-shadow: none;
                transition: none;
            }
            .navbar-links a { font-size: 13.5px; }
            .navbar-links a.active {
                border-left: none;
                border-bottom: 2px solid var(--lime-500);
                padding-left: 0;
                padding-bottom: 2px;
            }

            .nav-dropdown { width: auto; }
            .nav-dropdown-toggle { width: auto; font-size: 13.5px; }
            .nav-dropdown-menu {
                position: absolute;
                top: calc(100% + 14px);
                left: 0;
                min-width: 170px;
                background: #0d1735;
                border: 1px solid rgba(255, 255, 255, 0.08);
                border-radius: 12px;
                padding: 12px 18px;
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
                gap: 10px;
                margin-top: 0;
                transform: translateY(-6px);
                transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
                max-height: none;
                visibility: hidden;
            }
            .nav-dropdown.open .nav-dropdown-menu {
                margin-top: 0;
                transform: translateY(0);
                visibility: visible;
            }
            .nav-dropdown-menu a { padding: 0; white-space: nowrap; 
            }
            .nowrap {
  white-space: nowrap;
}
        }

        .hero{
            position: relative;
            color: #fff;
            border-radius: 24px;
            padding: 72px 60px;
            overflow: hidden;
        }
        /* Tampilan laptop */
.hero-title {
    line-height: 1.1;
}

/* Tampilan HP */
@media (max-width: 768px) {
    .hero-title::after {
        content: "";
        display: block;
    }

    .hero-title {
        max-width: 220px; /* sesuaikan sampai hasilnya pas */
    }
}

        .hero-slideshow{
            position: absolute;
            inset: 0;
            z-index: 0;
            border-radius: 24px;
            overflow: hidden;
        }
        .hero-slide{
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1.8s ease;
        }
        .hero-slide.active{ opacity: 1; }
        .hero-slideshow::after{
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(21,33,89,.88), rgba(15,138,140,.72));
        }
        .hero::before{
            content:"";
            position:absolute;
            right:-60px; top:-60px;
            width:260px; height:260px;
            border-radius:50%;
            background: radial-gradient(circle, rgba(169,199,59,.22), transparent 70%);
            z-index: 1;
        }

        .hero-content{
            position: relative;
            z-index: 2;
        }

        .hero .eyebrow{
            display:inline-flex;
            align-items:center;
            gap:7px;
            background: rgba(169,199,59,.15);
            border: 1px solid rgba(169,199,59,.35);
            border-radius: 30px;
            padding: 6px 16px;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            margin-bottom: 18px;
            color: #d3ea94;
        }
        .hero .eyebrow .dot{
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--lime-500);
        }

        .hero h1{
            color:#fff;
            font-size: 2.6rem;
            margin-bottom: 14px;
        }

        .hero .lead{
            color: rgba(255,255,255,.88);
            max-width: 620px;
            font-size: 1.05rem;
        }

        .trail{
            position: relative;
            display:flex;
            justify-content:center;
            margin: 6px 0 30px;
        }

        .trail::before{
            content:"";
            position:absolute;
            top:50%;
            left:8%;
            right:8%;
            border-top: 3px dotted var(--teal-500);
            opacity:.55;
        }

        .trail .node{
            position:relative;
            width:14px; height:14px;
            border-radius:50%;
            background: var(--teal-600);
            border: 3px solid var(--teal-tint);
            box-shadow: 0 0 0 3px var(--teal-tint);
        }

        .section-eyebrow{
            display:block;
            text-align:center;
            font-size: .8rem;
            font-weight: 600;
            color: var(--teal-600);
            text-transform: uppercase;
            letter-spacing:.08em;
            margin-bottom: 6px;
        }

        .section-title{
            font-weight:700;
            text-align:center;
            margin-bottom: 8px;
        }

        .section-sub{
            text-align:center;
            color:#6b7280;
            max-width: 560px;
            margin: 0 auto 36px;
            font-size: .95rem;
        }

        .card-custom{
            border:none;
            border-radius:18px;
            background: var(--surface);
            box-shadow:0 10px 25px rgba(21,33,89,.06);
            transition:.25s ease;
            height:100%;
        }

        .card-custom:hover{
            transform:translateY(-5px);
            box-shadow:0 16px 32px rgba(21,33,89,.1);
        }

        .about-card{
            border:1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .about-card .about-media{
            position: relative;
        }

        .about-card img{
            border-radius: 14px;
            border: 1px solid var(--border);
            max-width: 260px;
            width: 70%;
            margin: 0 auto;
            display: block;
        }

        .about-media-badge{
            position: absolute;
            bottom: 14px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--navy-900);
            color: #fff;
            font-size: .72rem;
            font-weight: 700;
            padding: 7px 16px;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            box-shadow: 0 8px 18px rgba(21,33,89,.25);
        }
        .about-media-badge i{ color: var(--lime-500); }

        .about-quote{
            border-left: 3px solid var(--teal-500);
            padding-left: 16px;
            font-style: italic;
            color: var(--navy-700);
            font-family: "Lora", serif;
            font-size: 1.02rem;
            margin: 20px 0;
        }

        .about-stats{
            display: flex;
            flex-wrap: wrap;
            gap: 22px;
            margin-top: 24px;
            padding-top: 22px;
            border-top: 1px solid var(--border);
        }
        .about-stat{
            min-width: 110px;
        }
        .about-stat .num{
            font-family: "Lora", serif;
            font-weight: 700;
            font-size: 1.6rem;
            color: var(--navy-900);
            display: block;
            line-height: 1;
        }
        .about-stat .num .accent{ color: var(--teal-600); }
        .about-stat .lbl{
            font-size: .78rem;
            color: #6b7280;
            margin-top: 4px;
            display: block;
        }

        .goal-card{
            padding: 32px 24px;
            text-align:center;
        }

        .icon-box{
            width:56px;
            height:56px;
            border-radius:14px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:22px;
            margin:0 auto 16px;
            color:#fff;
        }

        .goal-card h5{
            font-family:"Lora", serif;
            font-weight:600;
            margin-bottom:6px;
        }

        .goal-card p{
            color:#6b7280;
            font-size:.9rem;
            margin-bottom:0;
        }

        .accent-navy   .icon-box{ background: var(--navy-700); }
        .accent-teal   .icon-box{ background: var(--teal-600); }
        .accent-lime   .icon-box{ background: var(--lime-500); }
        .accent-navy2  .icon-box{ background: var(--navy-600); }

        .accent-navy{ background: var(--navy-tint); }
        .accent-teal{ background: var(--teal-tint); }
        .accent-lime{ background: var(--lime-tint); }
        .accent-navy2{ background: var(--navy-tint); }

        /* ►► GRID TUJUAN PORTAL — SELALU 4 sejajar dalam satu baris,
           baik di HP maupun desktop (tidak turun jadi 1-2 kolom). */
        .tujuan-grid{
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        @media (min-width: 576px){
            .tujuan-grid{ gap: 18px; }
        }
        @media (min-width: 992px){
            .tujuan-grid{ gap: 24px; }
        }
        .tujuan-grid .goal-card{
            padding: 14px 8px;
        }
        @media (min-width: 576px){
            .tujuan-grid .goal-card{ padding: 32px 24px; }
        }
        .tujuan-grid .icon-box{
            width: 34px; height: 34px; font-size: 15px; margin-bottom: 8px;
        }
        @media (min-width: 576px){
            .tujuan-grid .icon-box{ width: 56px; height: 56px; font-size: 22px; margin-bottom: 16px; }
        }
        .tujuan-grid .goal-card h5{ font-size: .72rem; margin-bottom: 2px; }
        @media (min-width: 576px){
            .tujuan-grid .goal-card h5{ font-size: 1.05rem; margin-bottom: 6px; }
        }
        .tujuan-grid .goal-card p{ display: none; }
        @media (min-width: 576px){
            .tujuan-grid .goal-card p{ display: block; }
        }

        /* ►► GRID FITUR UTAMA — SELALU 4 di baris atas, 3 di baris bawah,
           baik di HP maupun desktop. Tambah item baru: cukup tambah satu
           .feature-card lagi di HTML, grid ini otomatis menata ulang. */
        .fitur-grid{
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
        }
        @media (min-width: 576px){
            .fitur-grid{ gap: 16px; }
        }
        @media (min-width: 992px){
            .fitur-grid{ gap: 24px; }
        }
        .fitur-grid .feature-card{
            padding: 12px 4px;
        }
        @media (min-width: 576px){
            .fitur-grid .feature-card{ padding: 30px 20px; }
        }
        .fitur-grid .feature-card i{
            font-size: 15px; width: 32px; height: 32px; margin-bottom: 6px; border-radius: 10px;
        }
        @media (min-width: 576px){
            .fitur-grid .feature-card i{ font-size: 26px; width: 54px; height: 54px; margin-bottom: 14px; border-radius: 14px; }
        }
        .fitur-grid .feature-card h5{ font-size: .64rem; }
        @media (min-width: 576px){
            .fitur-grid .feature-card h5{ font-size: 1rem; }
        }

        .feature-card{
            padding: 30px 20px;
            text-align:center;
            border:1px solid var(--border);
        }

        .feature-card i{
            font-size: 26px;
            width:54px; height:54px;
            border-radius:14px;
            display:flex;
            align-items:center;
            justify-content:center;
            margin: 0 auto 14px;
        }

        .feature-card h5{
            font-size: 1rem;
            font-weight:600;
            margin-bottom:0;
        }

        .fc-1 i{ background: var(--teal-tint); color: var(--teal-600); }
        .fc-2 i{ background: var(--lime-tint); color: var(--lime-500); }
        .fc-3 i{ background: var(--navy-tint); color: var(--navy-700); }
        .fc-4 i{ background: var(--teal-tint); color: var(--teal-600); }
        .fc-5 i{ background: var(--navy-tint); color: var(--navy-600); }
        .fc-6 i{ background: var(--lime-tint); color: var(--lime-500); }
        .fc-7 i{ background: var(--teal-tint); color: var(--teal-600); }

        .dev-accordion{
            display: flex;
            width: 100%;
            height: clamp(300px, 62vw, 460px);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 14px 34px rgba(21,33,89,.14);
            background: #0a0f28;
        }
        @media (min-width: 992px){
            .dev-accordion{ border-radius: 24px; }
        }

        .dev-card + .dev-card{
            margin-left: -1px;
        }

        .dev-card{
            position: relative;
            flex: 1 1 0;
            min-width: 0;
            overflow: hidden;
            cursor: pointer;
            transition: flex 0.55s cubic-bezier(.4,0,.2,1);
        }
        .dev-accordion.has-active .dev-card{ flex: 0.55 1 0; }
        .dev-accordion.has-active .dev-card.active{ flex: 5.5 1 0; }

        .dev-card .top-accent{
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 5px;
            z-index: 3;
        }
        .dev-1 .top-accent{ background: var(--navy-700); }
        .dev-2 .top-accent{ background: var(--teal-600); }
        .dev-3 .top-accent{ background: var(--lime-500); }
        .dev-4 .top-accent{ background: var(--navy-600); }

        .dev-card img{
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(0.85) contrast(1.05);
            transition: filter .4s ease, transform .5s ease;
        }
        .dev-card.active img{
            filter: grayscale(0) contrast(1.02);
            transform: scale(1.03);
        }

        .dev-card .dev-shade{
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                rgba(10,15,40,.95) 0%,
                rgba(10,15,40,.55) 40%,
                rgba(10,15,40,.1) 70%,
                transparent 100%);
            z-index: 1;
        }

        .dev-label-mini{
            position: absolute;
            left: 6px;
            right: 6px;
            bottom: 10px;
            z-index: 2;
            color: #fff;
            font-family: "Lora", serif;
            font-weight: 700;
            font-size: 9.5px;
            line-height: 1.2;
            text-align: center;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-shadow: 0 1px 3px rgba(0,0,0,.5);
            opacity: 1;
            transition: opacity .2s ease;
        }
        @media (min-width: 576px){
            .dev-label-mini{
                font-size: 12px;
                -webkit-line-clamp: 2;
                bottom: 14px;
                left: 10px;
                right: 10px;
            }
        }
        .dev-card.active .dev-label-mini{
            opacity: 0;
            pointer-events: none;
        }

        .dev-info-full{
            position: absolute;
            left: 0; right: 0; bottom: 0;
            z-index: 2;
            padding: 16px 10px 18px;
            color: #fff;
            text-align: center;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity .35s ease .08s, transform .35s ease .08s;
            pointer-events: none;
        }
        @media (min-width: 768px){
            .dev-info-full{ padding: 22px 18px 24px; }
        }
        .dev-card.active .dev-info-full{
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .dev-info-full .dev-name{
            font-family: "Lora", serif;
            font-weight: 700;
            font-size: .92rem;
            margin: 0 0 2px;
        }
        @media (min-width: 768px){
            .dev-info-full .dev-name{ font-size: 1.15rem; }
        }
        .dev-info-full .dev-role{
            font-size: .68rem;
            color: rgba(255,255,255,.75);
            display: block;
            margin-bottom: 8px;
        }
        @media (min-width: 768px){
            .dev-info-full .dev-role{ font-size: .82rem; margin-bottom: 12px; }
        }
        .dev-info-full .badge-role-mini{
            display: inline-block;
            font-size: .68rem;
            font-weight: 600;
            background: rgba(255,255,255,.16);
            border: 1px solid rgba(255,255,255,.25);
            padding: 4px 10px;
            border-radius: 30px;
            margin-bottom: 12px;
            white-space: nowrap;
        }

        .dev-socials{
            display: flex;
            justify-content: center;
            gap: 8px;
        }
        .dev-socials a{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.35);
            color: #fff;
            font-size: 12px;
            transition: background .15s, transform .15s;
        }
        @media (min-width: 768px){
            .dev-socials a{ width: 36px; height: 36px; font-size: 14px; }
        }
        .dev-socials a:hover{
            background: var(--lime-500);
            color: var(--navy-900);
            transform: translateY(-2px);
        }

        .dev-hint{
            text-align: center;
            font-size: .78rem;
            color: #6b7280;
            margin-top: 14px;
        }
        .dev-hint i{ color: var(--teal-600); margin-right: 4px; }

        /* ======================================================================
           ►► "INFORMASI APLIKASI" — DIROMBAK dari tabel polos jadi panel
           berisi kartu-kartu kecil dengan ikon, biar senada dengan gaya
           kartu di section lain (Tujuan, Fitur, dst).
           - Untuk TAMBAH ITEM baru (misal "Lisensi", "Kontak Teknis"):
             copy satu blok <div class="app-info-item"> di HTML, ganti
             ikon Font Awesome-nya, dan warna aksennya (teal/lime/navy).
        ====================================================================== */
        footer{
            background: linear-gradient(160deg, var(--navy-900), #0c1442);
            border-radius:20px;
            padding: 40px clamp(24px, 5vw, 48px) 32px;
            color: rgba(255,255,255,.85);
            position: relative;
            overflow: hidden;
        }
        footer::before{
            content:"";
            position:absolute;
            left:-70px; bottom:-70px;
            width:220px; height:220px;
            border-radius:50%;
            background: radial-gradient(circle, rgba(15,138,140,.25), transparent 70%);
            pointer-events:none;
        }
        footer::after{
            content:"";
            position:absolute;
            right:-60px; top:-60px;
            width:180px; height:180px;
            border-radius:50%;
            background: radial-gradient(circle, rgba(169,199,59,.16), transparent 70%);
            pointer-events:none;
        }

        footer h4{ color:#fff; }

        .app-info-head{
            display:flex;
            align-items:center;
            gap:16px;
            margin-bottom:28px;
            position: relative;
            z-index: 1;
        }
        .app-info-logo{
            width:48px; height:48px;
            border-radius:50%;
            background:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            overflow:hidden;
            flex-shrink:0;
            box-shadow: 0 6px 16px rgba(0,0,0,.25);
        }
        .app-info-logo img{ width:100%; height:100%; object-fit:contain; }
        .app-info-sub{
            color: rgba(255,255,255,.55);
            font-size:.85rem;
            margin:2px 0 0;
        }

        .app-info-grid{
            display:grid;
            grid-template-columns: 1fr;
            gap:14px;
            position: relative;
            z-index: 1;
        }
        @media (min-width: 768px){
            .app-info-grid{ grid-template-columns: repeat(3, 1fr); gap: 18px; }
        }

        .app-info-item{
            display:flex;
            gap:14px;
            align-items:flex-start;
            background: rgba(255,255,255,.045);
            border:1px solid rgba(255,255,255,.09);
            border-radius:14px;
            padding:16px 18px;
            transition: background .2s ease, transform .2s ease, border-color .2s ease;
        }
        .app-info-item:hover{
            background: rgba(255,255,255,.08);
            transform: translateY(-3px);
            border-color: rgba(169,199,59,.4);
        }

        .app-info-icon{
            width:40px; height:40px;
            border-radius:11px;
            flex-shrink:0;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:16px;
            color:#fff;
        }
        .app-info-icon.accent-teal-i{ background: var(--teal-600); }
        .app-info-icon.accent-lime-i{ background: var(--lime-500); color: var(--navy-900); }
        .app-info-icon.accent-navy-i{ background: var(--navy-600); }

        .app-info-label{
            display:block;
            font-size:.7rem;
            text-transform:uppercase;
            letter-spacing:.07em;
            font-weight:600;
            color: rgba(255,255,255,.5);
            margin-bottom:4px;
        }
        .app-info-value{
            display:block;
            font-size:.92rem;
            color:#fff;
            line-height:1.55;
        }

        .app-info-foot{
            margin-top:26px;
            padding-top:20px;
            border-top:1px solid rgba(255,255,255,.1);
            text-align:center;
            position: relative;
            z-index: 1;
        }
        .app-info-foot p{
            margin:0;
            font-size:.8rem;
            color: rgba(255,255,255,.45);
        }

        @media (max-width: 767px){
            .hero{ padding: 48px 28px; }
            .hero h1{ font-size: 2rem; }
        }

        /* ►► WADAH KONTEN — ganti dari Bootstrap ".container" (yang lebarnya
           loncat-loncat per breakpoint dan bikin jarak kanan-kiri jadi
           tidak simetris) ke wadah kustom yang paddingnya SELALU sama
           persis dengan navbar di atas, jadi selalu rata kanan-kiri. */
        .page-container{
            max-width: 1320px;
            margin: 0 auto;
            padding-left: clamp(16px, 5vw, 48px);
            padding-right: clamp(16px, 5vw, 48px);
        }
    </style>

</head>
<body>

<header class="navbar mb-5">
    <a href="{{ route('landing.home') }}" class="navbar-brand" aria-label="PKKMB-KT UNILAM Beranda">
        <div class="navbar-logo">
            <img src="{{ asset('gambar/unilam.png') }}" alt="Logo UNILAM">
        </div>
        <div class="navbar-brand-text">
            <strong>PKKMB-KT</strong>
            <span>UNILAM 2026</span>
        </div>
    </a>

    <button class="menu-toggle" id="menuToggle" aria-label="Buka Menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <nav class="navbar-links" id="navbarLinks" aria-label="Navigasi utama">
        <a href="{{ route('landing.home') }}">Beranda</a>

        <div class="nav-dropdown" id="dropdownTentang">
            <button
                type="button"
                class="nav-dropdown-toggle"
                id="dropdownTentangToggle"
                aria-expanded="false"
                aria-controls="dropdownTentangMenu"
            >
                <a href="#" class="active">Tentang</a>
                <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
            </button>
            <div class="nav-dropdown-menu" id="dropdownTentangMenu">
                <a href="{{ route('landing.sejarah') }}">Sejarah</a>
                <a href="{{ route('landing.visi-misi') }}">Visi &amp; Misi</a>
                <a href="#" class="active">Tentang Kami</a>
            </div>
        </div>

        <a href="{{ route('landing.informasi') }}">Informasi</a>
        <a href="{{ route('landing.kontak') }}">Kontak</a>
    </nav>
</header>

<div class="page-container pb-5">

    <div class="hero mb-5">
        <div class="hero-slideshow" id="heroSlideshow"></div>

        <div class="hero-content">
            <span class="eyebrow"><span class="dot"></span><span class="whitespace-nowrap">Universitas La Tansa Mashiro</span></span>
            <h1 class="hero-title">Tentang PKKMB-KT</h1>
            <p class="lead">
                Mengenal Portal PKKMB-KT satu pintu digital yang menuntun
                perjalanan mahasiswa baru mengenal kehidupan kampus,
                dari pengenalan awal hingga siap menjadi bagian dari kampus.
            </p>
        </div>
    </div>

    <div class="trail"><span class="node"></span></div>

    <div id="tentang" class="card card-custom about-card mb-5">
        <div class="row g-0 align-items-center">
            </div>

            <div class="col-lg-7 p-5">

                <span class="section-eyebrow" style="text-align:left; display:block;">Apa itu</span>
                <h3 class="fw-bold mb-3">
                    Portal PKKMB-KT
                </h3>

                <p class="text-muted mb-0">
                    Portal PKKMB-KT merupakan platform digital yang dirancang
                    untuk mendukung seluruh rangkaian kegiatan
                    <strong>Pengenalan Kehidupan Kampus Mahasiswa Baru
                    Khutbatut Ta'aruf (PKKMB-KT)</strong>.
                    Melalui satu sistem terintegrasi, mahasiswa baru,
                    mentor, panitia, dan administrator dapat mengakses
                    seluruh layanan PKKMB-KT secara mudah, cepat,
                    dan efisien.
                </p>

                <p class="about-quote">
                    &ldquo;Satu portal, seluruh perjalanan orientasi kampus
                    &mdash; dari absen pagi hingga pengumuman kelulusan.&rdquo;
                </p>

                <div class="about-stats">
                    <div class="about-stat">
                        <span class="num"><span class="accent">7</span>+</span>
                        <span class="lbl">Fitur Utama</span>
                    </div>
                    <div class="about-stat">
                        <span class="num">100<span class="accent">%</span></span>
                        <span class="lbl">Proses Digital</span>
                    </div>
                    <div class="about-stat">
                        <span class="num"><span class="accent">4</span></span>
                        <span class="lbl">Peran Pengguna</span>
                    </div>
                    <div class="about-stat">
                        <span class="num"><span class="accent">24</span>/7</span>
                        <span class="lbl">Bisa Diakses</span>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="trail"><span class="node"></span></div>

    <div id="tujuan">
        <span class="section-eyebrow">Kenapa portal ini ada</span>
        <h3 class="section-title">Tujuan Portal</h3>
        <p class="section-sub">Empat hal yang menjadi dasar dibangunnya sistem PKKMB-KT.</p>

        <div class="tujuan-grid mb-5">

            <div class="card card-custom goal-card accent-teal">
                <div class="icon-box"><i class="fa-solid fa-laptop"></i></div>
                <h5>Digitalisasi</h5>
                <p>Digitalisasi proses PKKMB-KT.</p>
            </div>

            <div class="card card-custom goal-card accent-lime">
                <div class="icon-box"><i class="fa-solid fa-bolt"></i></div>
                <h5>Efisiensi</h5>
                <p>Mempermudah administrasi.</p>
            </div>

            <div class="card card-custom goal-card accent-navy">
                <div class="icon-box"><i class="fa-solid fa-chart-line"></i></div>
                <h5>Monitoring</h5>
                <p>Monitoring secara real-time.</p>
            </div>

            <div class="card card-custom goal-card accent-navy2">
                <div class="icon-box"><i class="fa-solid fa-shield-halved"></i></div>
                <h5>Keamanan</h5>
                <p>Data aman dan terpusat.</p>
            </div>

        </div>
    </div>

    <div class="trail"><span class="node"></span></div>

    <div id="fitur">
        <span class="section-eyebrow">Yang bisa dilakukan di dalamnya</span>
        <h3 class="section-title">Fitur Utama</h3>
        <p class="section-sub">Semua kebutuhan PKKMB-KT tersedia dalam satu portal.</p>

        <div class="fitur-grid mb-5">

            <div class="card card-custom feature-card fc-1">
                <i class="fa-solid fa-calendar-check"></i>
                <h5>Absensi</h5>
            </div>

            <div class="card card-custom feature-card fc-2">
                <i class="fa-solid fa-book-open"></i>
                <h5>Materi</h5>
            </div>

            <div class="card card-custom feature-card fc-3">
                <i class="fa-solid fa-pen-to-square"></i>
                <h5>Tugas</h5>
            </div>

            <div class="card card-custom feature-card fc-4">
                <i class="fa-solid fa-bullhorn"></i>
                <h5>Informasi</h5>
            </div>

            <div class="card card-custom feature-card fc-5">
                <i class="fa-solid fa-trophy"></i>
                <h5>Leaderboard</h5>
            </div>

            <div class="card card-custom feature-card fc-6">
                <i class="fa-solid fa-map-location-dot"></i>
                <h5>Denah Kampus</h5>
            </div>

            <div class="card card-custom feature-card fc-7">
                <i class="fa-solid fa-chart-simple"></i>
                <h5>Monitoring</h5>
            </div>

        </div>
    </div>

    <div class="trail"><span class="node"></span></div>

    <div id="tim">
        <span class="section-eyebrow">Di balik layar</span>
        <h3 class="section-title">Tim Pengembang</h3>
        <p class="section-sub">HIMA Informatika yang membangun dan merawat portal ini.</p>

        <div class="dev-accordion mb-2" id="devAccordion">

            <div class="dev-card dev-1" data-dev>
                <span class="top-accent"></span>
                <img src="{{ asset('gambar/deni.jpeg') }}" alt="Foto Deni Candra Setiawan">
                <div class="dev-shade"></div>
                <span class="dev-label-mini">Deni Candra Setiawan</span>
                <div class="dev-info-full">
                    <p class="dev-name">Deni Candra Setiawan</p>
                    <span class="dev-role">Ketua HIMA Informatika</span>
                    <span class="badge-role-mini">Project Manager &amp; System Analyst</span>
                    <div class="dev-socials">
                        <a href="https://www.instagram.com/dcs_148?igsh=eHZscTJ3ZGp6MHl4" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/deni-candra-18aa9b27a?utm_source=share_via&utm_content=profile&utm_medium=member_android" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https://github.com/candraden" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                    </div>
                </div>
            </div>

            <div class="dev-card dev-2" data-dev>
                <span class="top-accent"></span>
                <img src="{{ asset('gambar/salman.jpeg') }}" alt="Foto Salman Alfarisi">
                <div class="dev-shade"></div>
                <span class="dev-label-mini">Salman Alfarisi</span>
                <div class="dev-info-full">
                    <p class="dev-name">Salman Alfarisi</p>
                    <span class="dev-role">Wakil Ketua</span>
                    <span class="badge-role-mini">Frontend Developer</span>
                    <div class="dev-socials">
                        <a href="https://www.instagram.com/salfarisi305?igsh=MTBndTBoenoxbGV6bA==" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/salman-alfarisi-647a77384?utm_source=share_via&utm_content=profile&utm_medium=member_android" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https://github.com/salfarisi2005-max" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                    </div>
                </div>
            </div>

            <div class="dev-card dev-3" data-dev>
                <span class="top-accent"></span>
                <img src="{{ asset('gambar/azir.jpeg') }}" alt="Foto Moch. Azir Fadila">
                <div class="dev-shade"></div>
                <span class="dev-label-mini">Moch. Azir Fadila</span>
                <div class="dev-info-full">
                    <p class="dev-name">Moch. Azir Fadila</p>
                    <span class="dev-role">Divisi Penelitian</span>
                    <span class="badge-role-mini">Backend Developer &amp; QA</span>
                    <div class="dev-socials">
                        <a href="https://www.instagram.com/azirsudahmandi/" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/moch-azir-fadila-a2349a32a?utm_source=share_via&utm_content=profile&utm_medium=member_android" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https:/github.com/Azr159" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                   </div>
                </div>
            </div>

            <div class="dev-card dev-4" data-dev>
                <span class="top-accent"></span>
                <img src="{{ asset('gambar/nazrul.jpeg') }}" alt="Foto Nazrul Ibrahim Husen">
                <div class="dev-shade"></div>
                <span class="dev-label-mini">Nazrul Ibrahim Husen</span>
                <div class="dev-info-full">
                    <p class="dev-name">Nazrul Ibrahim Husen</p>
                    <span class="dev-role">Divisi Informasi Website</span>
                    <span class="badge-role-mini">Database Engineer</span>
                    <div class="dev-socials">
                        <a href="https://www.instagram.com/nazrulbae3/" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/nazrul-ibrahim-husen-95550332a/" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https://github.com/NazrulIbrahimHusen" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                   </div>
                </div>
            </div>

        </div>
        <p class="dev-hint mb-5"><i class="fa-solid fa-hand-pointer"></i>Klik / tap salah satu foto untuk melihat detailnya.</p>
    </div>

    <!-- ============ INFORMASI APLIKASI — DIROMBAK JADI PANEL KARTU ============ -->
    <footer>
        <div class="app-info-head">
            <div class="app-info-logo">
                <img src="{{ asset('gambar/unilam.png') }}" alt="Logo UNILAM">
            </div>
            <div>
                <h4 class="fw-bold mb-0">Informasi Aplikasi</h4>
                <p class="app-info-sub">Portal PKKMB-KT <span class="whitespace-nowrap">Universitas La Tansa Mashiro</span></p>
            </div>
        </div>

        <div class="app-info-grid">

            <div class="app-info-item">
                <div class="app-info-icon accent-teal-i"><i class="fa-solid fa-code-branch"></i></div>
                <div>
                    <span class="app-info-label">Versi</span>
                    <span class="app-info-value mono">1.0.0</span>
                </div>
            </div>

            <div class="app-info-item">
                <div class="app-info-icon accent-lime-i"><i class="fa-solid fa-users-gear"></i></div>
                <div>
                    <span class="app-info-label">Pengembang</span>
                    <span class="app-info-value">HIMA Informatika <span class="whitespace-nowrap">Universitas La Tansa Mashiro</span><br>Periode 2025&ndash;2026</span>
                </div>
            </div>

            <div class="app-info-item">
                <div class="app-info-icon accent-navy-i"><i class="fa-solid fa-calendar-days"></i></div>
                <div>
                    <span class="app-info-label">Tahun</span>
                    <span class="app-info-value mono">2026</span>
                </div>
            </div>

        </div>

        <div class="app-info-foot">
            <p>&copy; 2026 PKKMB-KT UNILAM &mdash; Dikembangkan oleh HIMA Informatika.</p>
            <div class="flex items-center justify-center gap-4 mt-2 text-xs" style="color: rgba(255,255,255,.45)">
                <a href="{{ route('landing.kebijakan-privasi') }}" class="hover:text-white transition" style="color: inherit">Kebijakan Privasi</a>
                <span class="opacity-40">&bull;</span>
                <a href="{{ route('landing.syarat-ketentuan') }}" class="hover:text-white transition" style="color: inherit">Syarat &amp; Ketentuan</a>
                <span class="opacity-40">&bull;</span>
                <a href="{{ route('landing.bantuan') }}" class="hover:text-white transition" style="color: inherit">Bantuan</a>
            </div>
        </div>
    </footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const menuToggle = document.getElementById("menuToggle");
    const navbarLinks = document.getElementById("navbarLinks");
    menuToggle.addEventListener("click", () => {
        menuToggle.classList.toggle("active");
        navbarLinks.classList.toggle("active");
    });
    navbarLinks.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", () => {
            menuToggle.classList.remove("active");
            navbarLinks.classList.remove("active");
        });
    });

    const dropdownTentang = document.getElementById("dropdownTentang");
    const dropdownTentangToggle = document.getElementById("dropdownTentangToggle");

    dropdownTentangToggle.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        const isOpen = dropdownTentang.classList.toggle("open");
        dropdownTentangToggle.setAttribute("aria-expanded", isOpen);
    });

    document.addEventListener("click", (e) => {
        if (!dropdownTentang.contains(e.target)) {
            dropdownTentang.classList.remove("open");
            dropdownTentangToggle.setAttribute("aria-expanded", "false");
        }
    });

    const devAccordion = document.getElementById("devAccordion");
    if (devAccordion) {
        const devCards = devAccordion.querySelectorAll("[data-dev]");
        devCards.forEach((card) => {
            card.addEventListener("click", () => {
                const alreadyActive = card.classList.contains("active");
                devCards.forEach((c) => c.classList.remove("active"));
                if (!alreadyActive) {
                    card.classList.add("active");
                    devAccordion.classList.add("has-active");
                } else {
                    devAccordion.classList.remove("has-active");
                }
            });
        });
    }

    const heroSlideImages = [
        "/gambar/gedungutama.jpeg",
        "/gambar/rektor.jpeg",
        "/gambar/gedung.jpeg",
    ];
    const HERO_SLIDE_INTERVAL_MS = 6000;

    const heroSlideshow = document.getElementById("heroSlideshow");
    if (heroSlideshow && heroSlideImages.length) {
        heroSlideImages.forEach((src, i) => {
            const slide = document.createElement("div");
            slide.className = "hero-slide" + (i === 0 ? " active" : "");
            slide.style.backgroundImage = `url("${src}")`;
            heroSlideshow.appendChild(slide);
        });

        if (heroSlideImages.length > 1) {
            let currentSlide = 0;
            const slideEls = heroSlideshow.querySelectorAll(".hero-slide");
            setInterval(() => {
                slideEls[currentSlide].classList.remove("active");
                currentSlide = (currentSlide + 1) % slideEls.length;
                slideEls[currentSlide].classList.add("active");
            }, HERO_SLIDE_INTERVAL_MS);
        }
    }
</script>
</body>
</html>