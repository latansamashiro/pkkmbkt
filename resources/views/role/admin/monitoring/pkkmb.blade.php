@extends('layouts.admin.main')
@section('content')
          <div class="page-head">
            <div>
              <p class="page-eyebrow">Monitoring</p>
              <h2 class="page-title">Monitoring Seluruh Data PKKMB</h2>
            </div>
          </div>

          <div class="toolbar" style="border:1px solid var(--border);border-radius:var(--radius-md);background:var(--surface);margin-bottom:20px;">
            <select class="filter-select" id="filterTahun">
              <option value="2026">Tahun 2026</option>
              <option value="2025">Tahun 2025</option>
              <option value="2024">Tahun 2024</option>
            </select>
            <select class="filter-select" id="filterFakultas">
              <option value="">Semua Fakultas</option>
              <option value="Teknik">Fakultas Teknik</option>
              <option value="Ekonomi">Fakultas Ekonomi</option>
              <option value="Hukum">Fakultas Hukum</option>
            </select>
            <select class="filter-select" id="filterHari">
              <option value="">Semua Hari</option>
              <option value="1">Hari 1</option>
              <option value="2">Hari 2</option>
              <option value="3">Hari 3</option>
            </select>
          </div>

          <div class="mini-stats" id="miniStats"></div>

          <section class="section" style="margin-top:0;">
            <div class="section-head"><h3 class="section-title">Grafik Kehadiran</h3></div>
            <div class="chart-placeholder">
              <span class="ic"><i data-lucide="bar-chart-3"></i></span>
              Grafik kehadiran per hari &mdash; akan terisi dari data absensi setelah backend terhubung
            </div>
          </section>
@endsection

@push('scripts')
<script>
      
      // ===== DUMMY DATA (ganti dengan hasil fetch() API saat backend siap) =====
      const STAT_BASE = { totalMaba: 350, hadir: 320, tidakHadir: 30, evaluasiSelesai: 310, mentorAktif: 18 };

      function renderStats() {
        const s = STAT_BASE;
        const items = [
          { icon: "graduation-cap", chip: "chip-navy", val: s.totalMaba, label: "Total Maba" },
          { icon: "user-check", chip: "chip-teal", val: s.hadir, label: "Hadir" },
          { icon: "user-x", chip: "chip-coral", val: s.tidakHadir, label: "Tidak Hadir" },
          { icon: "clipboard-check", chip: "chip-lime", val: s.evaluasiSelesai, label: "Evaluasi Selesai" },
          { icon: "user-round", chip: "chip-navy", val: s.mentorAktif, label: "Mentor Aktif" },
        ];
        document.getElementById("miniStats").innerHTML = items.map((i) => `
          <div class="mini-card">
            <span class="mini-chip ${i.chip}"><span class="ic"><i data-lucide="${i.icon}"></i></span></span>
            <div><p class="mini-value">${i.val}</p><p class="mini-label">${i.label}</p></div>
          </div>`).join("");
        lucide.createIcons();
      }

      // Filter hanya memicu re-render dummy (nilai statis) -- sambungkan ke API saat backend siap
      ["filterTahun", "filterFakultas", "filterHari"].forEach((id) =>
        document.getElementById(id).addEventListener("change", () => {
          tampilkanToast("Memuat data sesuai filter...");
          renderStats();
        })
      );

      renderStats();

    
</script>
@endpush
