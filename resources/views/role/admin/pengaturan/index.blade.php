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
        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Lainnya</p>
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">Pengaturan Sistem</h2>
    </div>
</div>

<form id="formPengaturan" class="w-full">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- ===== UMUM ===== -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:col-span-2">
            <p class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-1">Umum</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
                <div class="flex items-center justify-between gap-4 py-4 border-b border-slate-100">
                    <div>
                        <p class="text-sm font-bold text-slate-800 m-0">Nama Aplikasi</p>
                        <p class="text-xs text-slate-400 m-0">Tampil di judul halaman dan sidebar.</p>
                    </div>
                    <input type="text" id="inputNamaApp" value="PKKMB-KT"
                        class="border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 w-40 focus:outline-none focus:border-teal-600" />
                </div>

                <div class="flex items-center justify-between gap-4 py-4 border-b border-slate-100">
                    <div>
                        <p class="text-sm font-bold text-slate-800 m-0">Logo</p>
                        <p class="text-xs text-slate-400 m-0">PNG/SVG, latar transparan disarankan.</p>
                    </div>
                    <button type="button" id="btnUploadLogo"
                        class="inline-flex items-center gap-2 border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition whitespace-nowrap">
                        <i data-lucide="upload" class="w-4 h-4"></i>Upload Logo
                    </button>
                </div>

                <div class="flex items-center justify-between gap-4 py-4 md:border-b-0 border-b border-slate-100">
                    <div>
                        <p class="text-sm font-bold text-slate-800 m-0">Tahun PKKMB Aktif</p>
                        <p class="text-xs text-slate-400 m-0">Menentukan periode data yang ditampilkan.</p>
                    </div>
                    <select id="inputTahunAktif"
                        class="border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm font-semibold text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                        <option value="2026">2026</option>
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                    </select>
                </div>

                <div class="flex items-center justify-between gap-4 py-4">
                    <div>
                        <p class="text-sm font-bold text-slate-800 m-0">Bahasa</p>
                        <p class="text-xs text-slate-400 m-0">Bahasa antarmuka default untuk semua pengguna.</p>
                    </div>
                    <select id="inputBahasa"
                        class="border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm font-semibold text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                        <option value="id">Indonesia</option>
                        <option value="en">English</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- ===== BASIS DATA ===== -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <p class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-1">Basis Data</p>

            <div class="flex items-center justify-between gap-4 py-4 border-b border-slate-100 flex-wrap">
                <div>
                    <p class="text-sm font-bold text-slate-800 m-0">Backup Database</p>
                    <p class="text-xs text-slate-400 m-0" id="lastBackupInfo">Terakhir backup: belum pernah.</p>
                </div>
                <button type="button" id="btnBackup"
                    class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition whitespace-nowrap">
                    <i data-lucide="database-backup" class="w-4 h-4"></i>Backup Sekarang
                </button>
            </div>

            <div class="flex items-center justify-between gap-4 py-4 flex-wrap">
                <div>
                    <p class="text-sm font-bold text-slate-800 m-0">Restore Database</p>
                    <p class="text-xs text-slate-400 m-0">Mengganti seluruh data saat ini dengan file backup.</p>
                </div>
                <button type="button" id="btnRestore"
                    class="inline-flex items-center gap-2 border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition whitespace-nowrap">
                    <i data-lucide="upload" class="w-4 h-4"></i>Upload Backup
                </button>
            </div>
        </div>

        <!-- ===== MODE SISTEM ===== -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <p class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-1">Mode Sistem</p>

            <div class="flex items-center justify-between gap-4 py-4">
                <div>
                    <p class="text-sm font-bold text-slate-800 m-0">Mode Maintenance</p>
                    <p class="text-xs text-slate-400 m-0">Saat aktif, hanya Super Admin yang bisa mengakses sistem.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer shrink-0">
                    <input type="checkbox" id="inputMaintenance" class="sr-only peer" />
                    <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:bg-teal-600 transition-colors"></div>
                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                </label>
            </div>
        </div>

    </div>

    <div class="mt-6">
        <button type="submit"
            class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition">
            <i data-lucide="save" class="w-4 h-4"></i>Simpan
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function () {

    // ===== DUMMY DATA / STATE (ganti dengan hasil fetch() API saat backend siap) =====
    $("#btnUploadLogo").on("click", () => tampilkanToast("Pilih file logo dari perangkat Anda..."));

    $("#btnBackup").on("click", function () {
        if (!confirm("Backup seluruh database sekarang? Proses ini mungkin memakan waktu beberapa menit.")) return;
        // TODO: panggil endpoint backup di sisi server
        const now = new Date().toLocaleString("id-ID", { dateStyle: "medium", timeStyle: "short" });
        $("#lastBackupInfo").text("Terakhir backup: " + now);
        tampilkanToast("Backup database berhasil dijalankan.");
    });

    $("#btnRestore").on("click", function () {
        if (!confirm("Restore akan MENGGANTI seluruh data saat ini dengan isi file backup. Lanjutkan?")) return;
        // TODO: buka file picker lalu kirim file ke endpoint restore
        tampilkanToast("Pilih file backup untuk memulai proses restore...");
    });

    $("#inputMaintenance").on("change", function () {
        tampilkanToast(this.checked ? "Mode maintenance diaktifkan." : "Mode maintenance dinonaktifkan.");
    });

    $("#formPengaturan").on("submit", function (e) {
        e.preventDefault();
        // TODO: kirim seluruh field pengaturan ke API
        tampilkanToast("Pengaturan sistem berhasil disimpan.");
    });
});
</script>
@endpush
