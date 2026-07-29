<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, viewport-fit=cover"
    />
    <title>PKKMB-KT UNILAM 2026</title>
    <style>
      :root {
        --navy-950: #0a0f2c;
        --navy-900: #152159;
        --navy-700: #1e3a8f;
        --teal-500: #16a0a1;
        --teal-400: #2ec4c5;
        --lime-500: #a9c73b;
        --gold-500: #d4af6a;
        --gold-300: #f2dea3;
      }
      * {
        box-sizing: border-box;
      }
      html,
      body {
        margin: 0;
        padding: 0;
        height: 100%;
        background: #000;
        overflow: hidden;
        font-family: "Segoe UI", "Plus Jakarta Sans", sans-serif;
      }

      /* ============ LATAR BELAKANG BERLAPIS ============ */
      #splashScreen {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background:
          radial-gradient(
            circle at 30% 20%,
            rgba(22, 160, 161, 0.18) 0%,
            transparent 45%
          ),
          radial-gradient(
            circle at 75% 80%,
            rgba(169, 199, 59, 0.12) 0%,
            transparent 40%
          ),
          radial-gradient(
            circle at 50% 50%,
            var(--navy-900) 0%,
            var(--navy-950) 60%,
            #000 100%
          );
        transition:
          opacity 0.8s ease,
          filter 0.8s ease;
      }
      #splashScreen.fade-out {
        opacity: 0;
        filter: blur(6px);
        pointer-events: none;
      }

      /* ---------- Tessellation geometris islami di latar (motif bintang 8) ---------- */
      .geo-pattern {
        position: absolute;
        inset: -10%;
        background-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120' viewBox='0 0 120 120'%3E%3Cg fill='none' stroke='%232ec4c5' stroke-width='1'%3E%3Cpath d='M60 4 L84 30 L60 56 L36 30 Z'/%3E%3Cpath d='M60 56 L84 82 L60 108 L36 82 Z'/%3E%3Cpath d='M4 60 L30 36 L56 60 L30 84 Z'/%3E%3Cpath d='M56 60 L82 36 L108 60 L82 84 Z'/%3E%3Ccircle cx='60' cy='60' r='6'/%3E%3C/g%3E%3C/svg%3E");
        background-size: 130px 130px;
        opacity: 0.09;
        animation: pattern-drift 40s linear infinite;
        mix-blend-mode: screen;
      }
      @keyframes pattern-drift {
        0% {
          transform: translate(0, 0) rotate(0deg);
        }
        100% {
          transform: translate(-130px, -130px) rotate(3deg);
        }
      }

      /* Bingkai sudut bermotif arabesque, seperti iluminasi manuskrip */
      .corner-orn {
        position: absolute;
        width: 92px;
        height: 92px;
        z-index: 2;
        opacity: 0;
        animation: fade-simple 1s ease forwards;
        animation-delay: 1.7s;
      }
      .corner-tl {
        top: 18px;
        left: 18px;
      }
      .corner-tr {
        top: 18px;
        right: 18px;
        transform: scaleX(-1);
      }
      .corner-bl {
        bottom: 18px;
        left: 18px;
        transform: scaleY(-1);
      }
      .corner-br {
        bottom: 18px;
        right: 18px;
        transform: scale(-1, -1);
      }

      /* ---------- Siluet masjid di garis langit belakang ---------- */
      .mosque-skyline {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
        opacity: 0;
        animation: fade-simple 1.2s ease forwards;
        animation-delay: 0.9s;
        pointer-events: none;
      }
      .mosque-skyline svg {
        display: block;
        width: 100%;
        height: auto;
      }
      .mosque-glow {
        animation: dome-glow 4s ease-in-out infinite;
      }
      @keyframes dome-glow {
        0%,
        100% {
          opacity: 0.55;
        }
        50% {
          opacity: 1;
        }
      }

      /* Bulan sabit & bintang kecil di langit */
      .sky-crescent {
        position: absolute;
        top: 8%;
        right: 12%;
        z-index: 1;
        opacity: 0;
        animation: fade-simple 1s ease forwards, crescent-glow 5s ease-in-out infinite;
        animation-delay: 1.1s, 2s;
      }
      @keyframes crescent-glow {
        0%,
        100% {
          filter: drop-shadow(0 0 6px rgba(242, 222, 163, 0.5));
        }
        50% {
          filter: drop-shadow(0 0 14px rgba(242, 222, 163, 0.9));
        }
      }
      .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.55;
        pointer-events: none;
      }
      .blob-teal {
        width: 420px;
        height: 420px;
        background: radial-gradient(circle, var(--teal-500), transparent 70%);
        top: -120px;
        left: -100px;
        animation: float-a 9s ease-in-out infinite;
      }
      .blob-lime {
        width: 340px;
        height: 340px;
        background: radial-gradient(circle, var(--lime-500), transparent 70%);
        bottom: -100px;
        right: -80px;
        animation: float-b 11s ease-in-out infinite;
      }
      @keyframes float-a {
        0%,
        100% {
          transform: translate(0, 0) scale(1);
        }
        50% {
          transform: translate(40px, 30px) scale(1.12);
        }
      }
      @keyframes float-b {
        0%,
        100% {
          transform: translate(0, 0) scale(1);
        }
        50% {
          transform: translate(-30px, -25px) scale(1.15);
        }
      }

      /* Partikel kecil melayang naik */
      .particle {
        position: absolute;
        bottom: -10px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.65);
        animation: rise linear infinite;
      }
      @keyframes rise {
        0% {
          transform: translateY(0) translateX(0);
          opacity: 0;
        }
        10% {
          opacity: 0.9;
        }
        90% {
          opacity: 0.5;
        }
        100% {
          transform: translateY(-110vh) translateX(var(--drift, 20px));
          opacity: 0;
        }
      }

      /* ============ LOGO DALAM LENGKUNG MIHRAB ============ */
      .logo-stage {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        opacity: 0;
        transform: scale(0.82) translateY(16px);
        animation: logo-in 1s cubic-bezier(0.19, 1, 0.22, 1) forwards;
        animation-delay: 0.1s;
      }
      @keyframes logo-in {
        to {
          opacity: 1;
          transform: scale(1) translateY(0);
        }
      }

      .arch-frame {
        position: relative;
        width: clamp(230px, 46vw, 320px);
        padding: 36px 24px 26px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .arch-frame svg.arch-svg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
      }
      .arch-svg path.arch-outline {
        fill: rgba(255, 255, 255, 0.02);
        stroke: url(#emasGradasi);
        stroke-width: 1.4;
      }
      .arch-svg path.arch-inline {
        fill: none;
        stroke: rgba(46, 196, 197, 0.55);
        stroke-width: 0.7;
      }

      .logo-frame {
        position: relative;
        overflow: hidden;
        border-radius: 14px;
        z-index: 1;
      }
      .logo-frame img {
        display: block;
        width: clamp(140px, 30vw, 200px);
        height: auto;
        filter: drop-shadow(0 12px 28px rgba(0, 0, 0, 0.55));
      }
      .logo-frame::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
          115deg,
          transparent 30%,
          rgba(255, 255, 255, 0.35) 48%,
          rgba(255, 255, 255, 0.05) 52%,
          transparent 65%
        );
        transform: translateX(-120%);
        animation: shine-sweep 1.8s ease-in-out forwards;
        animation-delay: 0.9s;
      }
      @keyframes shine-sweep {
        to {
          transform: translateX(120%);
        }
      }

      /* Medali bintang delapan (rub el hizb) menggantikan garis lengkung polos */
      .deco-line {
        margin-top: 18px;
        opacity: 0;
        animation: fade-simple 0.6s ease forwards;
        animation-delay: 1.3s;
      }
      @keyframes fade-simple {
        to {
          opacity: 1;
        }
      }
      .deco-line svg .draw {
        stroke-dasharray: 300;
        stroke-dashoffset: 300;
        animation: draw-line 1.3s ease forwards;
        animation-delay: 1.3s;
      }
      @keyframes draw-line {
        to {
          stroke-dashoffset: 0;
        }
      }

      .splash-text {
        position: relative;
        z-index: 2;
        margin-top: 16px;
        text-align: center;
        opacity: 0;
        animation: fade-simple 0.7s ease forwards;
        animation-delay: 1.5s;
      }
      .splash-text strong {
        display: block;
        color: #fff;
        font-size: 15.5px;
        font-weight: 800;
        letter-spacing: 0.16em;
        text-transform: uppercase;
      }
      .splash-text span {
        display: block;
        margin-top: 5px;
        color: var(--gold-300);
        font-size: 11px;
        letter-spacing: 0.14em;
      }
      .splash-text .ahlan {
        display: block;
        margin-bottom: 4px;
        font-style: italic;
        font-weight: 700;
        font-size: 20px;
        letter-spacing: 0.02em;
        background: linear-gradient(90deg, var(--gold-300), var(--teal-400), var(--lime-500));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
      }

      /* ============ MASKOT SAMBUTAN ============ */
      .greeters {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        padding: 0 4%;
        pointer-events: none;
      }
      .greeter {
        width: clamp(84px, 20vw, 140px);
        opacity: 0;
        transform: translateY(24px);
        animation: greeter-in 0.9s cubic-bezier(0.19, 1, 0.22, 1) forwards;
      }
      .greeter-boy {
        animation-delay: 1.9s;
      }
      .greeter-girl {
        animation-delay: 2.05s;
      }
      @keyframes greeter-in {
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      .greeter .wave-hand {
        transform-origin: 78% 40%;
        animation: wave 1.6s ease-in-out infinite;
        animation-delay: 2.6s;
      }
      @keyframes wave {
        0%,
        100% {
          transform: rotate(0deg);
        }
        25% {
          transform: rotate(-18deg);
        }
        50% {
          transform: rotate(4deg);
        }
        75% {
          transform: rotate(-12deg);
        }
      }

      .greeter-wrap {
        display: flex;
        flex-direction: column;
        align-items: center;
        pointer-events: none;
      }
      .speech-bubble {
        position: relative;
        background: #fdfdfd;
        color: var(--navy-900);
        font-size: 10.5px;
        font-weight: 800;
        letter-spacing: 0.01em;
        padding: 6px 12px;
        border-radius: 13px;
        margin-bottom: 9px;
        white-space: nowrap;
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.3);
        opacity: 0;
        transform: translateY(6px) scale(0.9);
        animation: bubble-in 0.5s cubic-bezier(0.19, 1, 0.22, 1) forwards;
      }
      .speech-bubble::after {
        content: "";
        position: absolute;
        bottom: -6px;
        left: 50%;
        transform: translateX(-50%);
        border-width: 6px 6px 0;
        border-style: solid;
        border-color: #fdfdfd transparent transparent;
      }
      .bubble-boy {
        animation-delay: 2.5s;
      }
      .bubble-girl {
        animation-delay: 2.65s;
      }
      @keyframes bubble-in {
        to {
          opacity: 1;
          transform: translateY(0) scale(1);
        }
      }

      /* ============ PROGRESS + PERSENTASE ============ */
      .progress-wrap {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        margin-top: 28px;
        opacity: 0;
        animation: fade-simple 0.6s ease forwards;
        animation-delay: 1.6s;
      }
      .progress-track {
        width: 160px;
        height: 3px;
        border-radius: 99px;
        background: rgba(255, 255, 255, 0.12);
        overflow: hidden;
      }
      .progress-fill {
        height: 100%;
        width: 0%;
        border-radius: 99px;
        background: linear-gradient(90deg, var(--teal-400), var(--gold-500), var(--lime-500));
        box-shadow: 0 0 10px rgba(46, 196, 197, 0.6);
      }
      .progress-pct {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 0.05em;
        color: #7c86b8;
        font-variant-numeric: tabular-nums;
      }

      /* ============ ISI HALAMAN DI BELAKANG ============ */
      #kontenBelakang {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f2f4fa;
        color: #5b6175;
        font-size: 13px;
      }
    </style>
  </head>
  <body>
    <!-- ====================== SPLASH SCREEN ====================== -->
    <div id="splashScreen">
      <div class="geo-pattern"></div>
      <div class="blob blob-teal"></div>
      <div class="blob blob-lime"></div>
      <div id="particleField"></div>

      <!-- Bulan sabit kecil -->
      <svg class="sky-crescent" width="46" height="46" viewBox="0 0 46 46" fill="none">
        <path d="M27 6 A17 17 0 1 0 27 40 A13.5 13.5 0 0 1 27 6 Z" fill="#f2dea3"/>
        <circle cx="37" cy="10" r="1.6" fill="#f2dea3"/>
        <circle cx="41" cy="18" r="1" fill="#f2dea3"/>
      </svg>

      <!-- Siluet masjid di garis langit -->
      <div class="mosque-skyline">
        <svg viewBox="0 0 400 130" preserveAspectRatio="xMidYMax slice" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <linearGradient id="masjidGrad" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="#1e3a8f"/>
              <stop offset="100%" stop-color="#0a0f2c"/>
            </linearGradient>
          </defs>
          <!-- badan bangunan dasar -->
          <rect x="0" y="92" width="400" height="38" fill="url(#masjidGrad)"/>
          <!-- menara kiri -->
          <rect x="34" y="48" width="10" height="46" fill="url(#masjidGrad)"/>
          <path d="M31 48 Q39 32 47 48 Z" fill="url(#masjidGrad)"/>
          <circle class="mosque-glow" cx="39" cy="30" r="2.4" fill="#f2dea3"/>
          <!-- menara kanan -->
          <rect x="356" y="48" width="10" height="46" fill="url(#masjidGrad)"/>
          <path d="M353 48 Q361 32 369 48 Z" fill="url(#masjidGrad)"/>
          <circle class="mosque-glow" cx="361" cy="30" r="2.4" fill="#f2dea3"/>
          <!-- menara tengah kiri (lebih pendek) -->
          <rect x="96" y="64" width="8" height="30" fill="url(#masjidGrad)"/>
          <path d="M93 64 Q100 52 107 64 Z" fill="url(#masjidGrad)"/>
          <!-- menara tengah kanan -->
          <rect x="296" y="64" width="8" height="30" fill="url(#masjidGrad)"/>
          <path d="M293 64 Q300 52 307 64 Z" fill="url(#masjidGrad)"/>
          <!-- kubah utama besar -->
          <path d="M150 94 Q150 46 200 30 Q250 46 250 94 Z" fill="url(#masjidGrad)"/>
          <rect x="196" y="14" width="8" height="18" fill="url(#masjidGrad)"/>
          <!-- bulan sabit di puncak kubah -->
          <path class="mosque-glow" d="M204 12 A6 6 0 1 1 200 3 A4.6 4.6 0 0 0 204 12 Z" fill="#f2dea3"/>
          <!-- kubah kecil kiri & kanan -->
          <path d="M104 94 Q104 70 122 62 Q140 70 140 94 Z" fill="url(#masjidGrad)"/>
          <path d="M260 94 Q260 70 278 62 Q296 70 296 94 Z" fill="url(#masjidGrad)"/>
          <!-- lengkung pintu gerbang & jendela dekoratif -->
          <path d="M186 130 L186 104 Q200 90 214 104 L214 130 Z" fill="#0a0f2c"/>
          <path d="M120 130 L120 112 Q130 102 140 112 L140 130 Z" fill="#0a0f2c" opacity="0.85"/>
          <path d="M260 130 L260 112 Q270 102 280 112 L280 130 Z" fill="#0a0f2c" opacity="0.85"/>
        </svg>
      </div>

      <!-- Ornamen sudut ala iluminasi manuskrip -->
      <svg class="corner-orn corner-tl" viewBox="0 0 92 92" fill="none">
        <path d="M4 4 Q 4 40 40 40 Q 4 40 4 76" stroke="#d4af6a" stroke-width="1.3" opacity="0.7"/>
        <path d="M4 4 Q 40 4 40 40 Q 40 4 76 4" stroke="#2ec4c5" stroke-width="1.1" opacity="0.6"/>
        <circle cx="4" cy="4" r="3" fill="#d4af6a" opacity="0.8"/>
        <path d="M12 4 C 20 10, 20 18, 12 22" stroke="#a9c73b" stroke-width="1" opacity="0.55" fill="none"/>
      </svg>
      <svg class="corner-orn corner-tr" viewBox="0 0 92 92" fill="none">
        <path d="M4 4 Q 4 40 40 40 Q 4 40 4 76" stroke="#d4af6a" stroke-width="1.3" opacity="0.7"/>
        <path d="M4 4 Q 40 4 40 40 Q 40 4 76 4" stroke="#2ec4c5" stroke-width="1.1" opacity="0.6"/>
        <circle cx="4" cy="4" r="3" fill="#d4af6a" opacity="0.8"/>
        <path d="M12 4 C 20 10, 20 18, 12 22" stroke="#a9c73b" stroke-width="1" opacity="0.55" fill="none"/>
      </svg>
      <svg class="corner-orn corner-bl" viewBox="0 0 92 92" fill="none">
        <path d="M4 4 Q 4 40 40 40 Q 4 40 4 76" stroke="#d4af6a" stroke-width="1.3" opacity="0.7"/>
        <path d="M4 4 Q 40 4 40 40 Q 40 4 76 4" stroke="#2ec4c5" stroke-width="1.1" opacity="0.6"/>
        <circle cx="4" cy="4" r="3" fill="#d4af6a" opacity="0.8"/>
        <path d="M12 4 C 20 10, 20 18, 12 22" stroke="#a9c73b" stroke-width="1" opacity="0.55" fill="none"/>
      </svg>
      <svg class="corner-orn corner-br" viewBox="0 0 92 92" fill="none">
        <path d="M4 4 Q 4 40 40 40 Q 4 40 4 76" stroke="#d4af6a" stroke-width="1.3" opacity="0.7"/>
        <path d="M4 4 Q 40 4 40 40 Q 40 4 76 4" stroke="#2ec4c5" stroke-width="1.1" opacity="0.6"/>
        <circle cx="4" cy="4" r="3" fill="#d4af6a" opacity="0.8"/>
        <path d="M12 4 C 20 10, 20 18, 12 22" stroke="#a9c73b" stroke-width="1" opacity="0.55" fill="none"/>
      </svg>

      <div class="logo-stage">
        <div class="arch-frame">
          <svg class="arch-svg" viewBox="0 0 268 300" preserveAspectRatio="none">
            <defs>
              <linearGradient id="emasGradasi" x1="0" y1="0" x2="268" y2="300">
                <stop offset="0%" stop-color="#a9c73b" />
                <stop offset="50%" stop-color="#d4af6a" />
                <stop offset="100%" stop-color="#2ec4c5" />
              </linearGradient>
            </defs>
            <!-- lengkung mihrab (pointed arch) sebagai bingkai luar -->
            <path class="arch-outline"
              d="M12 296 L12 140 C12 70 60 14 134 14 C208 14 256 70 256 140 L256 296"
            />
            <!-- garis dalam kedua, sedikit lebih kecil -->
            <path class="arch-inline"
              d="M26 292 L26 142 C26 82 68 30 134 30 C200 30 242 82 242 142 L242 292"
            />
          </svg>
          <div class="logo-frame">
            <img src="unilam-logo-full.png" alt="Universitas La Tansa Mashiro" />
          </div>
        </div>

        <div class="deco-line">
          <svg width="120" height="46" viewBox="0 0 120 46" fill="none">
            <!-- medali bintang delapan (rub el hizb) di tengah -->
            <g transform="translate(60,23)">
              <path class="draw" d="M0 -13 L11.2 -6.5 L11.2 6.5 L0 13 L-11.2 6.5 L-11.2 -6.5 Z"
                stroke="url(#garisGradasi)" stroke-width="1.4" fill="rgba(255,255,255,0.03)"/>
              <path class="draw" d="M-13 0 L-6.5 -11.2 L6.5 -11.2 L13 0 L6.5 11.2 L-6.5 11.2 Z"
                stroke="url(#garisGradasi)" stroke-width="1.1" fill="none" opacity="0.85"/>
            </g>
            <path class="draw" d="M2 23 C 18 12, 30 12, 40 20" stroke="url(#garisGradasi)" stroke-width="1.6" stroke-linecap="round"/>
            <path class="draw" d="M118 23 C 102 12, 90 12, 80 20" stroke="url(#garisGradasi)" stroke-width="1.6" stroke-linecap="round"/>
            <defs>
              <linearGradient id="garisGradasi" x1="0" y1="0" x2="120" y2="0">
                <stop offset="0%" stop-color="#a9c73b" />
                <stop offset="50%" stop-color="#d4af6a" />
                <stop offset="100%" stop-color="#2ec4c5" />
              </linearGradient>
            </defs>
          </svg>
        </div>

        <div class="splash-text">
          <span class="ahlan">اَهْلًا وَسَهْلًا</span>
          <strong>PKKMB-KT UNILAM 2026</strong>
          <span>Universitas La Tansa Mashiro</span>
        </div>

        <div class="progress-wrap">
          <div class="progress-track">
            <div class="progress-fill" id="progressFill"></div>
          </div>
          <div class="progress-pct" id="progressPct">0%</div>
        </div>
      </div>

      <!-- Maskot mahasiswa baru menyambut: cowok & cewek -->
      <div class="greeters">
        <div class="greeter-wrap">
          <div class="speech-bubble bubble-boy">Ahlan wa Sahlan!</div>
          <svg class="greeter greeter-boy" viewBox="0 0 100 150" xmlns="http://www.w3.org/2000/svg">
            <ellipse cx="50" cy="146" rx="26" ry="5" fill="#000" opacity="0.25"/>
            <!-- kaki -->
            <rect x="34" y="112" width="12" height="30" rx="5" fill="#152159"/>
            <rect x="54" y="112" width="12" height="30" rx="5" fill="#152159"/>
            <rect x="30" y="138" width="18" height="7" rx="3" fill="#0a0f2c"/>
            <rect x="52" y="138" width="18" height="7" rx="3" fill="#0a0f2c"/>
            <!-- baju koko lengan panjang -->
            <path d="M30 70 Q50 58 70 70 L74 118 Q50 128 26 118 Z" fill="#eef2fb"/>
            <path d="M50 70 L50 118" stroke="#d8deee" stroke-width="1"/>
            <!-- lengan kiri turun -->
            <path d="M30 74 Q18 84 20 104" stroke="#eef2fb" stroke-width="12" stroke-linecap="round" fill="none"/>
            <circle cx="20" cy="106" r="6" fill="#e2b48a"/>
            <!-- lengan kanan melambai -->
            <g class="wave-hand">
              <path d="M70 74 Q84 66 84 48" stroke="#eef2fb" stroke-width="12" stroke-linecap="round" fill="none"/>
              <circle cx="85" cy="46" r="7" fill="#e2b48a"/>
            </g>
            <!-- sarung/kain sederhana -->
            <path d="M32 108 Q50 118 68 108 L66 118 Q50 126 34 118 Z" fill="#16a0a1" opacity="0.85"/>
            <!-- leher & kepala -->
            <rect x="45" y="58" width="10" height="12" fill="#e2b48a"/>
            <circle cx="50" cy="46" r="17" fill="#e2b48a"/>
            <!-- rambut pendek -->
            <path d="M33 42 Q33 26 50 26 Q67 26 67 42 Q67 34 50 34 Q33 34 33 42 Z" fill="#241c14"/>
            <!-- peci -->
            <path d="M35 32 Q50 20 65 32 Q65 26 50 24 Q35 26 35 32 Z" fill="#0a0f2c"/>
            <rect x="35" y="30" width="30" height="6" rx="2" fill="#152159"/>
            <!-- wajah -->
            <circle cx="44" cy="47" r="1.6" fill="#1a1a1a"/>
            <circle cx="56" cy="47" r="1.6" fill="#1a1a1a"/>
            <path d="M44 54 Q50 58 56 54" stroke="#7a4a2a" stroke-width="1.6" fill="none" stroke-linecap="round"/>
          </svg>
        </div>

        <div class="greeter-wrap">
          <div class="speech-bubble bubble-girl">Selamat Datang!</div>
          <svg class="greeter greeter-girl" viewBox="0 0 100 150" xmlns="http://www.w3.org/2000/svg">
            <ellipse cx="50" cy="146" rx="26" ry="5" fill="#000" opacity="0.25"/>
            <!-- kaki -->
            <rect x="30" y="136" width="16" height="7" rx="3" fill="#0a0f2c"/>
            <rect x="54" y="136" width="16" height="7" rx="3" fill="#0a0f2c"/>
            <!-- rok panjang -->
            <path d="M28 96 Q50 84 72 96 L80 140 Q50 150 20 140 Z" fill="#1e3a8f"/>
            <path d="M50 96 L50 140" stroke="#16276b" stroke-width="1"/>
            <!-- baju atasan -->
            <path d="M32 62 Q50 52 68 62 L72 100 Q50 108 28 100 Z" fill="#a9c73b"/>
            <!-- lengan kiri turun -->
            <path d="M32 66 Q20 78 22 98" stroke="#a9c73b" stroke-width="12" stroke-linecap="round" fill="none"/>
            <circle cx="22" cy="100" r="6" fill="#e2b48a"/>
            <!-- lengan kanan melambai -->
            <g class="wave-hand">
              <path d="M68 66 Q82 58 82 40" stroke="#a9c73b" stroke-width="12" stroke-linecap="round" fill="none"/>
              <circle cx="83" cy="38" r="7" fill="#e2b48a"/>
            </g>
            <!-- kerudung/hijab: menutup seluruh rambut, leher, dan turun menutupi bahu & dada -->
            <path d="M22 92 Q17 46 32 27 Q42 14 50 14 Q58 14 68 27 Q83 46 78 92 Q78 100 68 104 L32 104 Q22 100 22 92 Z" fill="#2ec4c5"/>
            <!-- wajah (oval, tampil di atas kerudung) -->
            <ellipse cx="50" cy="45" rx="15" ry="16" fill="#e2b48a"/>
            <!-- lipatan depan kerudung di garis dahi -->
            <path d="M35 38 Q50 27 65 38 Q65 32 50 29 Q35 32 35 38 Z" fill="#16a0a1"/>
            <!-- lipatan bawah dagu, menutup leher sepenuhnya -->
            <path d="M36 57 Q50 69 64 57 L64 66 Q50 76 36 66 Z" fill="#16a0a1"/>
            <!-- wajah: mata, senyum, pipi -->
            <circle cx="44" cy="45" r="1.5" fill="#1a1a1a"/>
            <circle cx="56" cy="45" r="1.5" fill="#1a1a1a"/>
            <path d="M44 52 Q50 56 56 52" stroke="#b5495a" stroke-width="1.6" fill="none" stroke-linecap="round"/>
            <circle cx="40" cy="49" r="2.2" fill="#e58a9a" opacity="0.5"/>
            <circle cx="60" cy="49" r="2.2" fill="#e58a9a" opacity="0.5"/>
          </svg>
        </div>
      </div>
    </div>

    <script>
      // ==========================================================================
      // KONFIGURASI
      // ==========================================================================
      const DURASI_SPLASH_MS = 5000;
      const TUJUAN = "{{ route('public.home') }}";
      const JUMLAH_PARTIKEL = 26;

      const field = document.getElementById("particleField");
      for (let i = 0; i < JUMLAH_PARTIKEL; i++) {
        const p = document.createElement("div");
        p.className = "particle";
        const ukuran = Math.random() * 3 + 1.5;
        p.style.width = ukuran + "px";
        p.style.height = ukuran + "px";
        p.style.left = Math.random() * 100 + "%";
        p.style.setProperty("--drift", Math.random() * 60 - 30 + "px");
        p.style.animationDuration = 5 + Math.random() * 6 + "s";
        p.style.animationDelay = Math.random() * 5 + "s";
        field.appendChild(p);
      }

      const progressFill = document.getElementById("progressFill");
      const progressPct = document.getElementById("progressPct");
      const mulai = performance.now();

      function updateProgress(now) {
        const berjalan = now - mulai;
        const persen = Math.min(
          100,
          Math.round((berjalan / DURASI_SPLASH_MS) * 100),
        );
        progressFill.style.width = persen + "%";
        progressPct.innerText = persen + "%";
        if (persen < 100) requestAnimationFrame(updateProgress);
      }
      requestAnimationFrame(updateProgress);

      window.addEventListener("load", () => {
        setTimeout(() => {
          const splash = document.getElementById("splashScreen");
          splash.classList.add("fade-out");
          setTimeout(() => {
            window.location.href = TUJUAN;
          }, 750);
        }, DURASI_SPLASH_MS);
      });
    </script>
  </body>
</html>