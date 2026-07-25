@extends('layouts.admin.main')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        corePlugins: { preflight: false } // jangan reset style global, biar tidak bentrok dengan CSS halaman lain
    }
</script>

<div class="flex items-center justify-between flex-wrap gap-3 mb-5">
    <div>
        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Monitoring</p>
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">Monitoring Seluruh Data PKKMB</h2>
    </div>
</div>

<div class="flex items-center gap-2.5 p-4 border border-slate-200 rounded-2xl bg-white mb-5 flex-wrap">
    <select id="filterTahun" class="text-sm font-semibold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 cursor-pointer focus:outline-none focus:border-teal-600">
        <option value="2026">Tahun 2026</option>
        <option value="2025">Tahun 2025</option>
        <option value="2024">Tahun 2024</option>
    </select>
    <select id="filterFakultas" class="text-sm font-semibold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 cursor-pointer focus:outline-none focus:border-teal-600">
        <option value="">Semua Fakultas</option>
        <option value="Teknik">Fakultas Teknik</option>
        <option value="Ekonomi">Fakultas Ekonomi</option>
        <option value="Hukum">Fakultas Hukum</option>
    </select>
    <select id="filterHari" class="text-sm font-semibold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 cursor-pointer focus:outline-none focus:border-teal-600">
        <option value="">Semua Hari</option>
        <option value="1">Hari 1</option>
        <option value="2">Hari 2</option>
        <option value="3">Hari 3</option>
    </select>
</div>

<div id="miniStats" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-6"></div>

<section>
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-extrabold text-slate-800 m-0">Grafik Kehadiran</h3>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl min-h-[220px] flex flex-col items-center justify-center gap-2 text-slate-400 text-sm font-semibold text-center px-6">
        <span class="ic"><i data-lucide="bar-chart-3" class="w-8 h-8"></i></span>
        Grafik kehadiran per hari &mdash; akan terisi dari data absensi setelah backend terhubung
    </div>
</section>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function () {

    // ===== DUMMY DATA (ganti dengan hasil fetch() API saat backend siap) =====
    const STAT_BASE = { totalMaba: 350, hadir: 320, tidakHadir: 30, evaluasiSelesai: 310, mentorAktif: 18 };

    const CHIP_CLASS = {
        "chip-navy": "bg-indigo-50 text-indigo-600",
        "chip-teal": "bg-teal-50 text-teal-600",
        "chip-coral": "bg-rose-50 text-rose-500",
        "chip-lime": "bg-lime-50 text-lime-600",
    };

    function renderStats() {
        const s = STAT_BASE;
        const items = [
            { icon: "graduation-cap", chip: "chip-navy", val: s.totalMaba, label: "Total Maba" },
            { icon: "user-check", chip: "chip-teal", val: s.hadir, label: "Hadir" },
            { icon: "user-x", chip: "chip-coral", val: s.tidakHadir, label: "Tidak Hadir" },
            { icon: "clipboard-check", chip: "chip-lime", val: s.evaluasiSelesai, label: "Evaluasi Selesai" },
            { icon: "user-round", chip: "chip-navy", val: s.mentorAktif, label: "Mentor Aktif" },
        ];
        const html = items.map((i) => `
            <div class="bg-white border border-slate-200 rounded-2xl p-4 flex items-center gap-3">
                <span class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 ${CHIP_CLASS[i.chip]}">
                    <i data-lucide="${i.icon}" class="w-5 h-5"></i>
                </span>
                <div>
                    <p class="text-xl font-extrabold text-slate-800 m-0 leading-tight">${i.val}</p>
                    <p class="text-xs font-semibold text-slate-400 m-0">${i.label}</p>
                </div>
            </div>`).join("");
        $("#miniStats").html(html);
        lucide.createIcons();
    }

    // Filter hanya memicu re-render dummy (nilai statis) -- sambungkan ke API saat backend siap
    $("#filterTahun, #filterFakultas, #filterHari").on("change", function () {
        tampilkanToast("Memuat data sesuai filter...");
        renderStats();
    });

    renderStats();
});
</script>
@endpush
