<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Evaluasi Maba</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Plus Jakarta Sans',sans-serif;
}

body{
  background:#f4f7fb;
  color:#1e293b;
}

header{
  background:#16235b;
  color:white;
  padding:20px clamp(16px,4vw,32px);
  box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.back-link{
  color:#c7cce8;
  text-decoration:none;
  font-size:14px;
  font-weight:600;
  display:inline-flex;
  align-items:center;
  gap:6px;
}
.back-link:hover{
  color:#fff;
}

.container{
  max-width:800px;
  margin:auto;
  padding:clamp(16px,4vw,28px);
}

/* ===== Profil Maba ===== */
.profile-card{
  background:white;
  border-radius:16px;
  padding:22px clamp(18px,4vw,28px);
  box-shadow:0 8px 20px rgba(0,0,0,.05);
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:16px;
  flex-wrap:wrap;
  margin-bottom:22px;
}

.profile-info{
  display:flex;
  align-items:center;
  gap:14px;
}

.profile-avatar{
  width:52px;
  height:52px;
  border-radius:50%;
  background:#e6e9f6;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:24px;
  flex-shrink:0;
}

.profile-name{
  font-size:18px;
  font-weight:800;
  color:#16235b;
}
.profile-meta{
  font-size:13px;
  color:#64748b;
  margin-top:2px;
}

.badge{
  padding:7px 16px;
  border-radius:30px;
  font-size:13px;
  font-weight:700;
  display:inline-block;
  white-space:nowrap;
}
.success{
  background:#dcfce7;
  color:#15803d;
}
.warning{
  background:#fef3c7;
  color:#b45309;
}

/* ===== Kartu Evaluasi per Kategori ===== */
.eval-card{
  background:white;
  border-radius:16px;
  padding:18px clamp(18px,4vw,24px);
  box-shadow:0 8px 20px rgba(0,0,0,.05);
  margin-bottom:16px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:16px;
  flex-wrap:wrap;
}

.eval-left{
  display:flex;
  align-items:center;
  gap:14px;
}

.eval-icon{
  font-size:26px;
  width:44px;
  height:44px;
  border-radius:12px;
  background:#f1f5fb;
  display:flex;
  align-items:center;
  justify-content:center;
  flex-shrink:0;
}

.eval-title{
  font-weight:700;
  color:#16235b;
  font-size:15px;
}

.eval-status{
  font-size:13px;
  font-weight:700;
  margin-top:2px;
}
.eval-status.done{ color:#15803d; }
.eval-status.pending{ color:#b45309; }

.eval-right{
  text-align:right;
  font-size:13px;
  color:#64748b;
  min-width:170px;
}
.eval-right .nilai{
  font-size:20px;
  font-weight:800;
  color:#16235b;
  display:block;
}

@media (max-width:520px){
  .eval-card{
    flex-direction:column;
    align-items:flex-start;
  }
  .eval-right{
    text-align:left;
    width:100%;
  }
}

#notFound{
  background:white;
  border-radius:16px;
  padding:40px 24px;
  text-align:center;
  color:#94a3b8;
  box-shadow:0 8px 20px rgba(0,0,0,.05);
}

</style>

</head>

<body>

<header>
  <a href="{{ route('role.mentor.evaluasi') }}" class="back-link">← Kembali ke Monitoring</a>
</header>

<div class="container" id="pageContent">
  <!-- Konten diisi otomatis lewat JavaScript berdasarkan ?id= di URL -->
</div>

<script>
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
        keuangan:      { diisi: true,  nilai: 88, waktu: "12 Jul 2026, 14:20" },
        kemahasiswaan: { diisi: true,  nilai: 92, waktu: "13 Jul 2026, 09:05" },
        akademik:      { diisi: true,  nilai: 85, waktu: "13 Jul 2026, 16:40" },
      }
    },
    2: {
      nama: "Siti Nurhaliza",
      npm: "2026010002",
      kelompok: "Kelompok 3",
      evaluasi: {
        keuangan:      { diisi: true,  nilai: 90, waktu: "12 Jul 2026, 10:12" },
        kemahasiswaan: { diisi: false, nilai: null, waktu: null },
        akademik:      { diisi: true,  nilai: 88, waktu: "13 Jul 2026, 11:30" },
      }
    },
    3: {
      nama: "Budi Santoso",
      npm: "2026010003",
      kelompok: "Kelompok 3",
      evaluasi: {
        keuangan:      { diisi: false, nilai: null, waktu: null },
        kemahasiswaan: { diisi: false, nilai: null, waktu: null },
        akademik:      { diisi: false, nilai: null, waktu: null },
      }
    },
  };

  const KATEGORI = [
    { key: "keuangan",      label: "Evaluasi Keuangan",      icon: "💰" },
    { key: "kemahasiswaan", label: "Evaluasi Kemahasiswaan", icon: "🎓" },
    { key: "akademik",      label: "Evaluasi Akademik",      icon: "📘" },
  ];

  function renderPage() {
    const params = new URLSearchParams(window.location.search);
    const id = params.get("id");
    const maba = dataMaba[id];
    const container = document.getElementById("pageContent");

    if (!maba) {
      container.innerHTML = `
        <div id="notFound">
          Data maba tidak ditemukan. Pastikan link diakses dengan
          <code>?id=</code> yang valid dari halaman Monitoring.
        </div>
      `;
      return;
    }

    const semuaSelesai = KATEGORI.every(k => maba.evaluasi[k.key].diisi);

    const cardsHtml = KATEGORI.map(k => {
      const data = maba.evaluasi[k.key];
      if (data.diisi) {
        return `
          <div class="eval-card">
            <div class="eval-left">
              <div class="eval-icon">${k.icon}</div>
              <div>
                <div class="eval-title">${k.label}</div>
                <div class="eval-status done">✅ Sudah diisi</div>
              </div>
            </div>
            <div class="eval-right">
              <span class="nilai">${data.nilai}</span>
              Waktu submit: ${data.waktu}
            </div>
          </div>
        `;
      }
      return `
        <div class="eval-card">
          <div class="eval-left">
            <div class="eval-icon">${k.icon}</div>
            <div>
              <div class="eval-title">${k.label}</div>
              <div class="eval-status pending">⏳ Belum diisi</div>
            </div>
          </div>
          <div class="eval-right">
            <span class="nilai">—</span>
            Waktu submit: —
          </div>
        </div>
      `;
    }).join("");

    container.innerHTML = `
      <div class="profile-card">
        <div class="profile-info">
          <div class="profile-avatar">👤</div>
          <div>
            <div class="profile-name">${maba.nama}</div>
            <div class="profile-meta">NPM ${maba.npm} · ${maba.kelompok}</div>
          </div>
        </div>
        <span class="badge ${semuaSelesai ? "success" : "warning"}">
          ${semuaSelesai ? "Selesai" : "Belum Selesai"}
        </span>
      </div>
      ${cardsHtml}
    `;
  }

  renderPage();
</script>

</body>
</html>
