<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Evaluasi Maba</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>

<body class="m-0 p-0 box-border font-sans bg-[#f4f7fb] text-[#1e293b]">

  <header class="bg-[#16235b] text-white shadow-[0_5px_15px_rgba(0,0,0,.08)]" style="padding: 20px clamp(16px,4vw,32px);">
    <a href="{{ route('role.mentor.evaluasi') }}" class="text-[#c7cce8] no-underline text-sm font-semibold inline-flex items-center gap-1.5 transition-colors hover:text-white">← Kembali ke Monitoring</a>
  </header>

  <div class="max-w-[800px] mx-auto" style="padding: clamp(16px,4vw,28px);" id="pageContent">
    <!-- Konten diisi otomatis lewat JavaScript berdasarkan ?id= di URL -->
  </div>

  <script>
    $(function() {
      // ======================================================================
      // ►► "DATABASE" CONTOH DATA MABA — sesuaikan dengan data asli/backend-mu.
      //    id di sini HARUS SAMA dengan id yang dipakai di link
      //    detail_evaluasi_maba.html?id=... pada monitoring_evaluasi.html.
      //
      //    Kalau nanti kamu punya backend, ganti bagian "const dataMaba = {...}"
      //    ini dengan hasil fetch() ke server memakai id dari URL.
      // ======================================================================
      const dataMaba = {
        1: {
          nama: "Ahmad Fauzi",
          npm: "2026010001",
          kelompok: "Kelompok 3",
          evaluasi: {
            keuangan: {
              diisi: true,
              nilai: 88,
              waktu: "12 Jul 2026, 14:20"
            },
            kemahasiswaan: {
              diisi: true,
              nilai: 92,
              waktu: "13 Jul 2026, 09:05"
            },
            akademik: {
              diisi: true,
              nilai: 85,
              waktu: "13 Jul 2026, 16:40"
            },
          }
        },
        2: {
          nama: "Siti Nurhaliza",
          npm: "2026010002",
          kelompok: "Kelompok 3",
          evaluasi: {
            keuangan: {
              diisi: true,
              nilai: 90,
              waktu: "12 Jul 2026, 10:12"
            },
            kemahasiswaan: {
              diisi: false,
              nilai: null,
              waktu: null
            },
            akademik: {
              diisi: true,
              nilai: 88,
              waktu: "13 Jul 2026, 11:30"
            },
          }
        },
        3: {
          nama: "Budi Santoso",
          npm: "2026010003",
          kelompok: "Kelompok 3",
          evaluasi: {
            keuangan: {
              diisi: false,
              nilai: null,
              waktu: null
            },
            kemahasiswaan: {
              diisi: false,
              nilai: null,
              waktu: null
            },
            akademik: {
              diisi: false,
              nilai: null,
              waktu: null
            },
          }
        },
      };

      const KATEGORI = [{
          key: "keuangan",
          label: "Evaluasi Keuangan",
          icon: "💰"
        },
        {
          key: "kemahasiswaan",
          label: "Evaluasi Kemahasiswaan",
          icon: "🎓"
        },
        {
          key: "akademik",
          label: "Evaluasi Akademik",
          icon: "📘"
        },
      ];

      function renderPage() {
        const params = new URLSearchParams(window.location.search);
        const id = params.get("id");
        const maba = dataMaba[id];
        const $container = $("#pageContent");

        if (!maba) {
          $container.html(`
          <div class="bg-white rounded-2xl text-center text-[#94a3b8] shadow-[0_8px_20px_rgba(0,0,0,.05)]" style="padding: 40px 24px;">
            Data maba tidak ditemukan. Pastikan link diakses dengan
            <code>?id=</code> yang valid dari halaman Monitoring.
          </div>
        `);
          return;
        }

        const semuaSelesai = KATEGORI.every(k => maba.evaluasi[k.key].diisi);

        const cardsHtml = KATEGORI.map(k => {
          const data = maba.evaluasi[k.key];
          if (data.diisi) {
            return `
            <div class="bg-white rounded-2xl shadow-[0_8px_20px_rgba(0,0,0,.05)] mb-4 flex items-center justify-between gap-4 flex-wrap max-[520px]:flex-col max-[520px]:items-start" style="padding: 18px clamp(18px,4vw,24px);">
              <div class="flex items-center gap-3.5">
                <div class="text-2xl w-11 h-11 rounded-xl bg-[#f1f5fb] flex items-center justify-center flex-shrink-0">${k.icon}</div>
                <div>
                  <div class="font-bold text-[#16235b] text-[15px]">${k.label}</div>
                  <div class="text-[13px] font-bold mt-0.5 text-[#15803d]">✅ Sudah diisi</div>
                </div>
              </div>
              <div class="text-right text-[13px] text-[#64748b] min-w-[170px] max-[520px]:text-left max-[520px]:w-full">
                <span class="text-xl font-extrabold text-[#16235b] block">${data.nilai}</span>
                Waktu submit: ${data.waktu}
              </div>
            </div>
          `;
          }
          return `
          <div class="bg-white rounded-2xl shadow-[0_8px_20px_rgba(0,0,0,.05)] mb-4 flex items-center justify-between gap-4 flex-wrap max-[520px]:flex-col max-[520px]:items-start" style="padding: 18px clamp(18px,4vw,24px);">
            <div class="flex items-center gap-3.5">
              <div class="text-2xl w-11 h-11 rounded-xl bg-[#f1f5fb] flex items-center justify-center flex-shrink-0">${k.icon}</div>
              <div>
                <div class="font-bold text-[#16235b] text-[15px]">${k.label}</div>
                <div class="text-[13px] font-bold mt-0.5 text-[#b45309]">⏳ Belum diisi</div>
              </div>
            </div>
            <div class="text-right text-[13px] text-[#64748b] min-w-[170px] max-[520px]:text-left max-[520px]:w-full">
              <span class="text-xl font-extrabold text-[#16235b] block">—</span>
              Waktu submit: —
            </div>
          </div>
        `;
        }).join("");

        $container.html(`
        <div class="bg-white rounded-2xl shadow-[0_8px_20px_rgba(0,0,0,.05)] flex items-center justify-between gap-4 flex-wrap mb-[22px]" style="padding: 22px clamp(18px,4vw,28px);">
          <div class="flex items-center gap-3.5">
            <div class="w-[52px] h-[52px] rounded-full bg-[#e6e9f6] flex items-center justify-center text-2xl flex-shrink-0">👤</div>
            <div>
              <div class="text-lg font-extrabold text-[#16235b]">${maba.nama}</div>
              <div class="text-[13px] text-[#64748b] mt-0.5">NPM ${maba.npm} · ${maba.kelompok}</div>
            </div>
          </div>
          <span class="py-1.5 px-4 rounded-full text-[13px] font-bold inline-block whitespace-nowrap ${semuaSelesai ? "bg-[#dcfce7] text-[#15803d]" : "bg-[#fef3c7] text-[#b45309]"}">
            ${semuaSelesai ? "Selesai" : "Belum Selesai"}
          </span>
        </div>
        ${cardsHtml}
      `);
      }

      renderPage();
    });
  </script>

</body>

</html>