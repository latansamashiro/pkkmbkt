<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Input Keaktifan &amp; Pelanggaran | PKKMB-KT UNILAM 2026</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet" />
  <style type="text/tailwindcss">
    @theme {
        --color-navy-900: #152159;
        --color-navy-700: #1e3a8f;
        --color-navy-600: #2a4bb0;
        --color-teal-600: #0f8a8c;
        --color-teal-500: #16a0a1;
        --color-teal-tint: #e2f3f2;
        --color-lime-500: #a9c73b;
        --color-lime-tint: #f2f6e0;
        --color-navy-tint: #e6e9f6;
        --color-bg: #f2f4fa;
        --color-surface: #ffffff;
        --color-border: #e1e5f1;
        --color-ink-900: #1b2238;
        --color-ink-600: #5b6175;
        --color-ink-400: #8d92a6;
        --font-sans: "Plus Jakarta Sans", sans-serif;
        --font-display: "Lora", serif;
      }
    </style>
  <style>
    @keyframes pulse {

      0%,
      100% {
        opacity: 1;
        transform: scale(1);
      }

      50% {
        opacity: .5;
        transform: scale(.8);
      }
    }

    .mhs-list-scroll::-webkit-scrollbar {
      width: 6px;
    }

    .mhs-list-scroll::-webkit-scrollbar-thumb {
      background: #e1e5f1;
      border-radius: 10px;
    }
  </style>
</head>

<body class="font-sans text-ink-900 m-0 bg-bg antialiased min-h-screen flex flex-col">
  <header class="sticky top-0 z-50 flex items-center justify-between gap-4 bg-navy-900 border-b border-white/10" style="padding: 14px clamp(16px,5vw,48px);">
    <div class="flex items-center gap-2.5 no-underline cursor-default" aria-label="PKKMB-KT UNILAM">
      <div class="w-[38px] h-[38px] rounded-full bg-white flex items-center justify-center overflow-hidden flex-shrink-0">
        <img src="{{ asset('gambar/unilam.png') }}" alt="Logo UNILAM" class="w-full h-full object-contain" />
      </div>
      <div>
        <strong class="block font-display text-[14.5px] text-white">PKKMB-KT</strong>
        <span class="text-[10.5px] text-[#aeb6e0] tracking-[0.04em]">UNILAM 2026</span>
      </div>
    </div>
    <nav class="hidden md:flex gap-7">
      <a href="{{ route('role.mentor.modul') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline hover:text-white">Modul</a>
      <a href="{{ route('role.mentor.leaderboard') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline hover:text-white">Leaderboard</a>
      <a href="{{ route('dashboard') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline hover:text-white">Dashboard</a>
      <a href="{{ route('role.mentor.info') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline hover:text-white">Info</a>
      <a href="{{ route('role.mentor.profil') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline hover:text-white">Profil</a>
    </nav>
  </header>

  <section class="relative overflow-hidden" style="padding: clamp(36px,6vw,56px) clamp(16px,5vw,48px);">
    <div class="absolute inset-0 z-0 overflow-hidden after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-br after:from-navy-900/[0.94] after:to-teal-600/[0.85]" id="heroSlideshow"></div>
    <div class="relative z-[1] max-w-[1200px] mx-auto">
      <div class="inline-flex items-center gap-[7px] text-[#c8e46a] text-[11px] font-bold rounded-full mb-4 tracking-[0.06em] uppercase" style="background: rgba(169,199,59,.15); border: 1px solid rgba(169,199,59,.35); padding: 5px 14px;">
        <span class="w-1.5 h-1.5 rounded-full bg-lime-500" style="animation: pulse 2s infinite;"></span> Input Poin
      </div>
      <h1 class="font-display font-bold text-white mb-3 leading-[1.2] m-0" style="font-size: clamp(24px,4vw,38px);">Keaktifan &amp; Pelanggaran</h1>
      <p class="text-sm text-white/75 leading-[1.7] m-0" style="max-width: 560px;">
        Klik salah satu tombol untuk menambah poin keaktifan atau mengurangi
        poin karena pelanggaran. Semua pilihan poin sudah ditentukan
        jumlahnya, jadi tidak bisa diubah bebas oleh mentor.
      </p>
    </div>
  </section>

  <main class="max-w-[1000px] mx-auto w-full flex-1" style="padding: 28px clamp(16px,5vw,48px) calc(74px + 28px);">
    <div class="inline-flex items-center gap-2 bg-surface border-[1.5px] border-border rounded-full mb-[18px] shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)]" style="padding: 9px 18px 9px 8px;">
      <span class="w-[30px] h-[30px] rounded-full bg-navy-900 text-white flex items-center justify-center">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-3.5 h-3.5">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
          <circle cx="9" cy="7" r="4" />
          <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
          <path d="M16 3.13a4 4 0 0 1 0 7.75" />
        </svg>
      </span>
      <strong class="text-[13.5px] font-extrabold text-navy-900" id="kelompokNama">Kelompok 01</strong>
    </div>

    <div class="relative mb-[18px]">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-[15px] h-[15px] text-ink-400">
        <circle cx="11" cy="11" r="8" />
        <line x1="21" y1="21" x2="16.65" y2="16.65" />
      </svg>
      <input type="text" id="searchInput" placeholder="Cari nama atau NPM mahasiswa..." class="w-full bg-surface border-[1.5px] border-border rounded-full font-sans text-[13.5px] font-medium shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] outline-none focus:border-teal-500 focus:shadow-[0_0_0_3px_rgba(22,160,161,0.12)]" style="padding: 12px 16px 12px 40px;" />
    </div>

    <div class="mhs-list-scroll" style="max-height: 620px; overflow-y: auto; padding-right: 2px;">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="mhsGrid"></div>
    </div>
  </main>

  <div class="fixed left-1/2 -translate-x-1/2 bg-navy-900 text-white text-[12.5px] font-bold rounded-full shadow-[0_10px_24px_rgba(21,33,89,0.16)] opacity-0 pointer-events-none transition-all z-[60] flex items-center gap-2" id="saveToast" style="bottom: calc(74px + 16px); padding: 12px 22px; transform: translateX(-50%) translateY(20px);">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" class="w-[15px] h-[15px] text-lime-500">
      <path d="M20 6 9 17l-5-5" />
    </svg>
    <span id="saveToastText">Poin tersimpan</span>
  </div>

  <footer class="bg-[#0d1735] flex flex-wrap justify-between items-center gap-3.5" style="padding: 24px clamp(16px,5vw,48px) calc(74px + 16px);">
    <p class="text-[13px] text-[#4a6a9f] m-0">© 2026 PKKMB-KT UNILAM. Semua hak dilindungi.</p>
    <div class="flex gap-5">
      <a href="{{ route('landing.kebijakan-privasi') }}" class="text-[13px] text-[#4a6a9f] no-underline hover:text-[#aeb6e0]">Kebijakan Privasi</a>
      <a href="{{ route('landing.syarat-ketentuan') }}" class="text-[13px] text-[#4a6a9f] no-underline hover:text-[#aeb6e0]">Syarat &amp; Ketentuan</a>
      <a href="{{ route('landing.bantuan') }}" class="text-[13px] text-[#4a6a9f] no-underline hover:text-[#aeb6e0]">Bantuan</a>
    </div>
  </footer>

  <nav class="fixed bottom-0 left-0 right-0 h-[74px] bg-surface border-t border-border flex items-center justify-around px-1.5 pb-[env(safe-area-inset-bottom)] z-30 md:hidden" aria-label="Navigasi bawah">
    <a href="{{ route('role.mentor.modul') }}" class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 5.5C4 4.7 4.7 4 5.5 4H11v16H5.5C4.7 20 4 19.3 4 18.5z" />
        <path d="M20 5.5c0-.8-.7-1.5-1.5-1.5H13v16h5.5c.8 0 1.5-.7 1.5-1.5z" />
      </svg>
      <span>Modul</span>
    </a>
    <a href="{{ route('role.mentor.leaderboard') }}" class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 3l1.8 3.6L18 7.2l-3 2.9.7 4.1L12 12.3l-3.7 1.9.7-4.1-3-2.9 4.2-.6z" />
        <path d="M5 21v-5M12 21v-7M19 21v-4" />
      </svg>
      <span>Leaderboard</span>
    </a>
    <a href="{{ route('dashboard') }}" class="flex-none flex flex-col items-center justify-center text-white -mt-[30px] bg-navy-900 w-[54px] h-[54px] rounded-full shadow-[0_10px_24px_rgba(21,33,89,0.16)] no-underline [&>span]:hidden" aria-label="Beranda">
      <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 11.5 12 4l8 7.5" />
        <path d="M6 10v9.5a.5.5 0 0 0 .5.5H10v-6h4v6h3.5a.5.5 0 0 0 .5-.5V10" />
      </svg>
      <span>Beranda</span>
    </a>
    <a href="{{ route('role.mentor.info') }}" class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 17H4l1.4-1.4A2 2 0 0 0 6 14.2V11a6 6 0 1 1 12 0v3.2c0 .5.2 1 .6 1.4L20 17h-5" />
        <path d="M9 17a3 3 0 0 0 6 0" />
      </svg>
      <span>Info</span>
    </a>
    <a href="{{ route('role.mentor.profil') }}" class="flex flex-col items-center gap-1 text-ink-400 text-[10px] font-bold flex-1 py-1.5 no-underline">
      <svg class="w-[22px] h-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="8" r="3.4" />
        <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6" />
      </svg>
      <span>Profil</span>
    </a>
  </nav>

  <script>
    $(function() {
      // ======================================================================
      // ►► KELOMPOK MENTOR — satu kelompok saja.
      // ======================================================================
      const KELOMPOK_MENTOR = "Kelompok 01";
      const ANGGOTA_KELOMPOK = [{
          nama: "Alexander Arul Husein",
          npm: "525241019"
        },
        {
          nama: "Bunga Citra Lestari",
          npm: "525241020"
        },
        {
          nama: "Dimas Prakoso",
          npm: "525241021"
        },
        {
          nama: "Eka Putri Ramadhani",
          npm: "525241022"
        },
        {
          nama: "Farhan Maulana",
          npm: "525241023"
        },
        {
          nama: "Gita Ayu Saputri",
          npm: "525241024"
        },
      ];

      // 🏷️ DAFTAR POIN TETAP — mentor cuma bisa PILIH dari daftar ini.
      const PRESET_PLUS = [{
          label: "Aktif bertanya",
          poin: 5
        },
        {
          label: "Membantu teman",
          poin: 5
        },
        {
          label: "Jadi perwakilan kelompok",
          poin: 10
        },
      ];
      const PRESET_MINUS = [{
          label: "Ribut",
          poin: 10
        },
        {
          label: "Terlambat",
          poin: 5
        },
        {
          label: "Atribut tidak lengkap",
          poin: 5
        },
      ];

      $("#kelompokNama").text(KELOMPOK_MENTOR);

      let kataKunciCari = "";
      let riwayatKelompok = {}; // { "Nama": [ {tipe,judul,poin,tanggal} ] }

      function storageKeyPoin() {
        return `poin:${KELOMPOK_MENTOR}`;
      }

      async function muatRiwayat() {
        riwayatKelompok = {};
        try {
          const res = await window.storage.get(storageKeyPoin(), true);
          if (res && res.value) {
            const arr = JSON.parse(res.value);
            if (Array.isArray(arr)) {
              arr.forEach((item) => {
                if (!riwayatKelompok[item.nama]) riwayatKelompok[item.nama] = [];
                riwayatKelompok[item.nama].push(item);
              });
            }
          }
        } catch (e) {
          // belum ada riwayat tersimpan untuk kelompok ini — normal di awal
        }
      }

      async function simpanRiwayat() {
        const gabung = [];
        Object.keys(riwayatKelompok).forEach((nama) => riwayatKelompok[nama].forEach((item) => gabung.push(item)));
        try {
          await window.storage.set(storageKeyPoin(), JSON.stringify(gabung), true);
        } catch (e) {
          alert("Gagal menyimpan poin. Coba lagi.");
        }
      }

      function tambahPoin(nama, tipe, judul, poin) {
        if (!riwayatKelompok[nama]) riwayatKelompok[nama] = [];
        riwayatKelompok[nama].push({
          nama,
          tipe,
          judul,
          poin,
          tanggal: new Date().toLocaleDateString("id-ID", {
            day: "2-digit",
            month: "short",
            year: "numeric"
          }),
        });
        simpanRiwayat();
        tampilkanToast(`${tipe === "keaktifan" ? "+" : "-"}${poin} poin untuk ${nama}`);
        renderMhsGrid();
      }

      function totalPoin(nama) {
        const list = riwayatKelompok[nama] || [];
        let plus = 0,
          minus = 0;
        list.forEach((r) => {
          if (r.tipe === "keaktifan") plus += r.poin;
          else minus += r.poin;
        });
        return {
          bersih: plus - minus,
          list
        };
      }

      function renderMhsGrid() {
        const $grid = $("#mhsGrid");
        const anggota = ANGGOTA_KELOMPOK.filter(
          (m) => m.nama.toLowerCase().includes(kataKunciCari.toLowerCase()) || m.npm.includes(kataKunciCari),
        );

        if (anggota.length === 0) {
          $grid.html(`<div class="text-center text-[12.5px] text-ink-400 font-semibold col-span-full" style="padding:30px 20px;">Tidak ada mahasiswa yang cocok dengan pencarian.</div>`);
          return;
        }

        const html = anggota
          .map((m) => {
            const inisial = m.nama.split(" ").map((s) => s[0]).slice(0, 2).join("").toUpperCase();
            const t = totalPoin(m.nama);
            const presetPlusHtml = PRESET_PLUS.map(
              (p) => `<button class="text-[11.5px] font-bold rounded-full border-[1.5px] cursor-pointer transition-all bg-surface border-[#bbf7d0] text-[#15803d] hover:bg-[#f0fdf4] hover:-translate-y-px" style="padding:8px 13px;" data-nama="${m.nama}" data-tipe="keaktifan" data-judul="${p.label}" data-poin="${p.poin}">+${p.poin} ${p.label}</button>`,
            ).join("");
            const presetMinusHtml = PRESET_MINUS.map(
              (p) => `<button class="text-[11.5px] font-bold rounded-full border-[1.5px] cursor-pointer transition-all bg-surface border-[#fecaca] text-[#b91c1c] hover:bg-[#fef2f2] hover:-translate-y-px" style="padding:8px 13px;" data-nama="${m.nama}" data-tipe="pelanggaran" data-judul="${p.label}" data-poin="${p.poin}">-${p.poin} ${p.label}</button>`,
            ).join("");
            const riwayatHtml = t.list.length ?
              t.list.slice().reverse().map(
                (r) => `
                      <div class="flex justify-between gap-2 text-[11px] border-t border-dashed border-border first:border-t-0" style="padding:6px 0;">
                        <span class="text-ink-600">${r.judul} · ${r.tanggal}</span>
                        <span class="font-extrabold ${r.tipe === "keaktifan" ? "text-[#15803d]" : "text-[#b91c1c]"}">${r.tipe === "keaktifan" ? "+" : "-"}${r.poin}</span>
                      </div>
                    `,
              ).join("") :
              `<div class="flex justify-between gap-2 text-[11px]" style="padding:6px 0;"><span class="text-ink-600">Belum ada catatan.</span></div>`;

            return `
                <div class="bg-surface rounded-[18px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)]" style="padding:16px;">
                  <div class="flex items-center gap-2.5 mb-3">
                    <span class="w-[38px] h-[38px] rounded-full bg-navy-tint text-navy-700 flex items-center justify-center font-extrabold text-[13px] flex-shrink-0">${inisial}</span>
                    <div>
                      <p class="text-[13.5px] font-bold m-0">${m.nama}</p>
                      <p class="text-[11px] text-ink-400 mt-0.5 mb-0">NPM ${m.npm}</p>
                    </div>
                    <div class="ml-auto text-right">
                      <div class="font-display text-lg font-bold leading-none" style="color:${t.bersih >= 0 ? "#16a34a" : "#dc2626"}">${t.bersih >= 0 ? "+" : ""}${t.bersih}</div>
                      <div class="text-[9px] text-ink-400 font-bold uppercase">Total Poin</div>
                    </div>
                  </div>

                  <div class="text-[10px] font-extrabold uppercase tracking-[0.04em] text-ink-400" style="margin:10px 0 6px;">Tambah Poin Keaktifan</div>
                  <div class="flex gap-1.5 flex-wrap">${presetPlusHtml}</div>

                  <div class="text-[10px] font-extrabold uppercase tracking-[0.04em] text-ink-400" style="margin:10px 0 6px;">Kurangi Poin (Pelanggaran)</div>
                  <div class="flex gap-1.5 flex-wrap">${presetMinusHtml}</div>

                  <button class="riwayat-toggle flex items-center gap-1.5 text-[11px] font-bold text-teal-600 mt-3 cursor-pointer bg-none border-none p-0 [&.open>svg]:rotate-180" data-nama="${m.nama}">
                    Lihat riwayat (${t.list.length})
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 transition-transform"><path d="M6 9l6 6 6-6" /></svg>
                  </button>
                  <div class="riwayat-list overflow-hidden transition-[max-height] duration-[250ms] ease-in-out" style="max-height:0;">${riwayatHtml}</div>
                </div>
              `;
          })
          .join("");

        $grid.html(html);

        $grid.find(".preset-chip, button[data-tipe]").on("click", function() {
          const $btn = $(this);
          tambahPoin($btn.data("nama"), $btn.data("tipe"), $btn.data("judul"), Number($btn.data("poin")));
        });

        $grid.find(".riwayat-toggle").on("click", function() {
          const $btn = $(this);
          const $list = $btn.next(".riwayat-list");
          const opening = !$btn.hasClass("open");
          $btn.toggleClass("open");
          if (opening) {
            $list.css("max-height", "220px").css("overflow-y", "auto").css("margin-top", "8px");
          } else {
            $list.css("max-height", "0").css("overflow-y", "hidden").css("margin-top", "0");
          }
        });
      }

      function tampilkanToast(teks) {
        const $toast = $("#saveToast");
        $("#saveToastText").text(teks);
        $toast.removeClass("opacity-0 pointer-events-none").addClass("opacity-100");
        $toast.css("transform", "translateX(-50%) translateY(0)");
        setTimeout(() => {
          $toast.removeClass("opacity-100").addClass("opacity-0 pointer-events-none");
          $toast.css("transform", "translateX(-50%) translateY(20px)");
        }, 2200);
      }

      $("#searchInput").on("input", function() {
        kataKunciCari = $(this).val();
        renderMhsGrid();
      });

      async function init() {
        await muatRiwayat();
        renderMhsGrid();
      }
      init();

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO — sama seperti halaman lain.
      // ======================================================================
      const heroSlideImages = ["/Gambar/gedungutama.jpeg", "/Gambar/rektor.jpeg", "/Gambar/gedung.jpeg"];
      const HERO_SLIDE_INTERVAL_MS = 6000;
      const $heroSlideshow = $("#heroSlideshow");
      if ($heroSlideshow.length && heroSlideImages.length) {
        heroSlideImages.forEach((src, i) => {
          $("<div>")
            .addClass("hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-[1800ms] ease-in-out")
            .addClass(i === 0 ? "opacity-100" : "opacity-0")
            .css("background-image", `url("${src}")`)
            .appendTo($heroSlideshow);
        });
        if (heroSlideImages.length > 1) {
          let currentSlide = 0;
          const $slides = $heroSlideshow.find(".hero-slide");
          setInterval(() => {
            $slides.eq(currentSlide).removeClass("opacity-100").addClass("opacity-0");
            currentSlide = (currentSlide + 1) % $slides.length;
            $slides.eq(currentSlide).removeClass("opacity-0").addClass("opacity-100");
          }, HERO_SLIDE_INTERVAL_MS);
        }
      }
    });
  </script>
</body>

</html>