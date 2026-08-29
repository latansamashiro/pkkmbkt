<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <title>Monitoring Pengumpulan Tugas | PKKMB-KT UNILAM 2026</title>
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

    .tugas-table-scroll::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }

    .tugas-table-scroll::-webkit-scrollbar-thumb {
      background: #e1e5f1;
      border-radius: 10px;
    }
  </style>
</head>

<body class="font-sans text-ink-900 m-0 bg-bg antialiased min-h-screen flex flex-col">
  <header class="sticky top-0 z-50 flex items-center justify-between gap-4 bg-navy-900 border-b border-white/10" style="padding: 14px clamp(16px,5vw,48px);">
    <div class="flex items-center gap-2.5 no-underline cursor-default" aria-label="PKKMB-KT UNILAM">
      <div class="w-[38px] h-[38px] rounded-full bg-white flex items-center justify-center overflow-hidden flex-shrink-0">
        <img src="{{ asset('gambar/unilam.webp') }}" alt="Logo UNILAM" class="w-full h-full object-contain" />
      </div>
      <div>
        <strong class="block font-display text-[14.5px] text-white">PKKMB-KT</strong>
        <span class="text-[10.5px] text-[#aeb6e0] tracking-[0.04em]">UNILAM 2026</span>
      </div>
    </div>
    <nav class="hidden md:flex gap-7">
      <a href="{{ route('role.mentor.modul') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Modul</a>
      <a href="{{ route('role.mentor.leaderboard') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Leaderboard</a>
      <a href="{{ route('dashboard') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Dashboard</a>
      <a href="{{ route('role.mentor.info') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Info</a>
      <a href="{{ route('role.mentor.profil') }}" class="text-[#c7cce8] text-[13.5px] font-semibold no-underline transition-colors hover:text-white">Profil</a>
    </nav>
  </header>

  <section class="relative overflow-hidden" style="padding: clamp(36px,6vw,56px) clamp(16px,5vw,48px);">
    <div class="absolute inset-0 z-0 overflow-hidden after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-br after:from-navy-900/[0.94] after:to-teal-600/[0.85]" id="heroSlideshow"></div>
    <div class="relative z-[1] max-w-[1200px] mx-auto flex flex-wrap justify-between items-end gap-7">
      <div class="flex-1" style="min-width: 280px;">
        <h1 class="font-display font-bold text-white mb-3 leading-[1.2] m-0" style="font-size: clamp(24px,4vw,38px);">Pengumpulan Tugas</h1>
        <p class="text-sm text-white/75 leading-[1.7] m-0" style="max-width: 480px;">
          Centang tugas yang sudah dikumpulkan tiap mahasiswa langsung dari
          tabel, lalu tekan tombol <strong>Kirim</strong> di bawah tabel untuk
          menyimpan — geser ke samping kalau tugasnya banyak, geser ke bawah
          kalau mahasiswanya banyak.
        </p>
      </div>
      <div class="flex gap-0.5 rounded-[18px] flex-shrink-0" style="background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.12); padding: 16px 22px; backdrop-filter: blur(12px);">
        <div class="text-center border-r border-white/[0.12]" style="padding: 0 16px;">
          <div class="font-display text-2xl font-bold text-lime-500 leading-none" id="statSelesai">0</div>
          <div class="text-[10px] text-white/55 font-semibold mt-1 tracking-[0.04em]">Tugas Selesai</div>
        </div>
        <div class="text-center" style="padding: 0 16px;">
          <div class="font-display text-2xl font-bold text-lime-500 leading-none" id="statBelum">0</div>
          <div class="text-[10px] text-white/55 font-semibold mt-1 tracking-[0.04em]">Belum Selesai</div>
        </div>
      </div>
    </div>
  </section>

  <main class="max-w-[1100px] mx-auto w-full flex-1" style="padding: 28px clamp(16px,5vw,48px) calc(74px + 28px);">
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

    <div class="bg-surface rounded-[28px] border border-border shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] overflow-hidden">
      <div class="bg-bg border-b border-border flex justify-between items-center gap-2.5 flex-wrap" style="padding: 14px 20px;">
        <h3 class="text-xs font-extrabold uppercase tracking-[0.03em] text-navy-900 m-0">Daftar Mahasiswa &amp; Tugas</h3>
        <span class="text-[10.5px] font-bold text-ink-600 bg-surface border border-border rounded-full" id="cardCount" style="padding: 3px 10px;">0 mahasiswa</span>
      </div>
      <div class="tugas-table-scroll" style="max-height: 560px; overflow: auto;">
        <table class="w-full border-collapse" style="min-width: 560px;">
          <thead>
            <tr id="tableGroupHeadRow"></tr>
            <tr id="tableHeadRow"></tr>
          </thead>
          <tbody id="tableBody"></tbody>
        </table>
      </div>
      <div class="bg-bg border-t border-border flex justify-between items-center gap-3 flex-wrap" style="padding: 14px 20px;">
        <span class="text-[11.5px] font-bold text-lime-600" id="statusKirim">Semua status sudah tersimpan</span>
        <button type="button" id="btnKirim" disabled class="opacity-60 cursor-not-allowed inline-flex items-center gap-2 bg-navy-900 text-white text-[12.5px] font-bold rounded-full transition-colors hover:bg-navy-700" style="padding: 10px 22px; border: none;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
            <path d="M22 2 11 13" />
            <path d="M22 2 15 22l-4-9-9-4z" />
          </svg>
          Kirim Status Pengumpulan
        </button>
      </div>
    </div>
  </main>

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
        <circle cx="12" cy="12" r="9" />
            <path d="M12 11v5" />
            <path d="M12 8h.01" />
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
      // ►► DAFTAR TUGAS — tiap tugas jadi satu KOLOM di tabel.
      // ======================================================================
      const DAFTAR_TUGAS = @json($daftarTugas);

      // ======================================================================
      // ►► KELOMPOK MENTOR & STATUS TUGAS — dari database (real).
      // ======================================================================
      const KELOMPOK_MENTOR = @json($group->name ?? 'Belum ada kelompok');
      const ANGGOTA_KELOMPOK = @json($anggotaKelompok);
      const CSRF_TOKEN = @json(csrf_token());
      const SUBMIT_URL = @json(route('role.mentor.monitoring-tugas.submit'));
      let adaPerubahan = false;

      $("#kelompokNama").text(KELOMPOK_MENTOR);

      let kataKunciCari = "";

      function renderTableHead() {
        // Baris label kelompok kolom: "Tugas Individu" vs "Tugas Kelompok".
        let groupHeaderHtml =
          `<th class="border-b border-border bg-bg sticky top-0 z-[2]" colspan="2"></th>`;
        let i = 0;
        while (i < DAFTAR_TUGAS.length) {
          const tipe = DAFTAR_TUGAS[i].tipe;
          let span = 0;
          while (i < DAFTAR_TUGAS.length && DAFTAR_TUGAS[i].tipe === tipe) {
            span++;
            i++;
          }
          const LABEL_TIPE = { kelompok: "Tugas Kelompok", atk: "Penerimaan ATK", jas_almet: "Penerimaan JAS ALMAMATER" };
          const TONE_TIPE = { kelompok: "text-teal-600 bg-teal-tint", atk: "text-amber-600 bg-amber-50", jas_almet: "text-purple-600 bg-purple-50" };
          const label = LABEL_TIPE[tipe] ?? "Tugas Individu";
          const tone = TONE_TIPE[tipe] ?? "text-navy-700 bg-navy-tint";
          groupHeaderHtml += `<th colspan="${span}" class="text-center text-[10px] font-extrabold uppercase tracking-[0.05em] ${tone} border-b border-border sticky top-0 z-[2] whitespace-nowrap" style="padding:7px 14px;">${label}</th>`;
        }
        $("#tableGroupHeadRow").html(groupHeaderHtml);

        const html =
          `<th class="w-11 text-center text-[10.5px] font-extrabold uppercase tracking-[0.03em] text-navy-900 bg-bg border-b-[1.5px] border-border sticky z-[2] whitespace-nowrap" style="padding:12px 14px; top:28px;">No</th>` +
          `<th class="text-left text-[10.5px] font-extrabold uppercase tracking-[0.03em] text-navy-900 bg-bg border-b-[1.5px] border-border sticky z-[2] whitespace-nowrap" style="padding:12px 14px; min-width:200px; top:28px;">Nama</th>` +
          DAFTAR_TUGAS.map((t) => `<th class="text-center text-[10.5px] font-extrabold uppercase tracking-[0.03em] text-navy-900 bg-bg border-b-[1.5px] border-border sticky z-[2] whitespace-nowrap" style="padding:12px 14px; min-width:150px; top:28px;">${t.nama}</th>`).join("");
        $("#tableHeadRow").html(html);
      }

      function renderTableBody() {
        const $tbody = $("#tableBody");
        const filtered = ANGGOTA_KELOMPOK.filter(
          (m) => m.nama.toLowerCase().includes(kataKunciCari.toLowerCase()) || m.npm.includes(kataKunciCari),
        );
        $("#cardCount").text(`${filtered.length} mahasiswa`);

        if (filtered.length === 0) {
          $tbody.html(`<tr><td colspan="${DAFTAR_TUGAS.length + 2}"><div class="text-center text-[12.5px] text-ink-400 font-semibold" style="padding:30px 20px;">Tidak ada mahasiswa yang cocok dengan pencarian.</div></td></tr>`);
        } else {
          const html = filtered
            .map((m, i) => {
              const inisial = m.nama.split(" ").map((s) => s[0]).slice(0, 2).join("").toUpperCase();
              const kolomTugas = DAFTAR_TUGAS.map((t) => {
                const done = !!m.tugas[t.id];
                return `
                    <td class="text-center border-t border-border" style="padding:12px 14px;">
                      <button class="w-[30px] h-[30px] rounded-[9px] border-[1.5px] inline-flex items-center justify-center cursor-pointer transition-all disabled:opacity-50 disabled:cursor-wait ${done ? "bg-[#22c55e] border-[#22c55e]" : "border-border bg-surface hover:border-teal-500"}" data-student="${m.student_id}" data-tugas="${t.id}" aria-label="${t.nama}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="w-[15px] h-[15px] text-white ${done ? "opacity-100" : "opacity-0"}"><path d="M20 6 9 17l-5-5" /></svg>
                      </button>
                    </td>
                  `;
              }).join("");

              return `
                  <tr class="hover:bg-bg">
                    <td class="text-center font-bold text-ink-400 text-[12.5px] border-t border-border" style="padding:12px 14px;">${i + 1}</td>
                    <td class="border-t border-border" style="padding:12px 14px; min-width:200px;">
                      <div class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-full bg-navy-tint text-navy-700 flex items-center justify-center font-extrabold text-[11.5px] flex-shrink-0">${inisial}</span>
                        <div>
                          <p class="text-[12.5px] font-bold m-0">${m.nama}</p>
                          <p class="text-[10.5px] text-ink-400 mt-0.5 mb-0">NPM ${m.npm}</p>
                        </div>
                      </div>
                    </td>
                    ${kolomTugas}
                  </tr>
                `;
            })
            .join("");

          $tbody.html(html);

          $tbody.find("button[data-student]").on("click", function() {
            const $btn = $(this);
            const studentId = $btn.data("student");
            const taskId = String($btn.data("tugas"));
            const mhs = ANGGOTA_KELOMPOK.find((m) => String(m.student_id) === String(studentId));
            if (!mhs) return;

            // Cuma ubah state lokal dulu — belum dikirim ke server sampai
            // tombol "Kirim" ditekan.
            mhs.tugas[taskId] = !mhs.tugas[taskId];
            adaPerubahan = true;
            updateTombolKirim();
            renderTableBody();
          });
        }

        renderStatHero(filtered);
      }

      function renderStatHero(filtered) {
        let selesai = 0,
          belum = 0;
        filtered.forEach((m) => {
          DAFTAR_TUGAS.forEach((t) => {
            m.tugas[t.id] ? selesai++ : belum++;
          });
        });
        $("#statSelesai").text(selesai);
        $("#statBelum").text(belum);
      }

      // ======================================================================
      // ►► TOMBOL KIRIM — kirim SEMUA centangan sekaligus ke server, bukan
      // per klik. Selama belum dikirim, perubahan cuma ada di browser.
      // ======================================================================
      function updateTombolKirim() {
        const $btn = $("#btnKirim");
        const $status = $("#statusKirim");
        if (adaPerubahan) {
          $btn.prop("disabled", false).removeClass("opacity-60 cursor-not-allowed");
          $status.text("Ada perubahan yang belum dikirim").removeClass("text-lime-600").addClass("text-[#d97706]");
        } else {
          $btn.prop("disabled", true).addClass("opacity-60 cursor-not-allowed");
          $status.text("Semua status sudah tersimpan").removeClass("text-[#d97706]").addClass("text-lime-600");
        }
      }

      $("#btnKirim").on("click", function() {
        const $btn = $(this);
        if ($btn.prop("disabled")) return;

        const data = {};
        ANGGOTA_KELOMPOK.forEach((m) => {
          data[m.student_id] = {};
          DAFTAR_TUGAS.forEach((t) => {
            data[m.student_id][t.id] = !!m.tugas[t.id];
          });
        });

        $btn.prop("disabled", true).addClass("opacity-60 cursor-not-allowed");
        $btn.data("label", $btn.html());
        $btn.html("Mengirim...");

        $.ajax({
          url: SUBMIT_URL,
          method: "POST",
          headers: { "X-CSRF-TOKEN": CSRF_TOKEN },
          data: { data: data },
          dataType: "json",
        })
          .done(function() {
            adaPerubahan = false;
            updateTombolKirim();
          })
          .fail(function(xhr) {
            const msg = xhr.responseJSON?.message || "Gagal mengirim status tugas. Coba lagi.";
            alert(msg);
            adaPerubahan = true;
            updateTombolKirim();
          })
          .always(function() {
            $btn.html($btn.data("label"));
          });
      });

      $("#searchInput").on("input", function() {
        kataKunciCari = $(this).val();
        renderTableBody();
      });

      renderTableHead();
      renderTableBody();
      updateTombolKirim();

      window.addEventListener("beforeunload", function(e) {
        if (adaPerubahan) {
          e.preventDefault();
          e.returnValue = "";
        }
      });

      // ======================================================================
      // ►► SLIDESHOW LATAR HERO — sama seperti halaman lain.
      // ======================================================================
      const heroSlideImages = ["/gambar/gedungutama.webp", "/gambar/rektor.webp", "/gambar/gedung.webp"];
      const HERO_SLIDE_INTERVAL_MS = 6000;
      const $heroSlideshow = $("#heroSlideshow");
      if ($heroSlideshow.length && heroSlideImages.length) {
        heroSlideImages.forEach((src, i) => {
          $("<div>")
            .addClass("absolute inset-0 bg-cover bg-center transition-opacity duration-[1800ms] ease-in-out")
            .addClass(i === 0 ? "opacity-100" : "opacity-0")
            .addClass("hero-slide")
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