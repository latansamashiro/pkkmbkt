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
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">Profil</h2>
    </div>
</div>

<form id="formProfil" class="w-full">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- ===== INFORMASI AKUN ===== -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:col-span-2">
            <div class="flex items-center gap-4 mb-6">
                <div id="profilInisial" class="w-16 h-16 rounded-full bg-teal-600 text-white flex items-center justify-center font-extrabold text-lg shrink-0">
                    {{ strtoupper(substr($user->name ?? 'SA', 0, 1)) }}
                </div>
                <div>
                    <strong id="profilNamaTampil" class="block text-slate-800 font-bold">{{ $user->name ?? 'Super Admin' }}</strong>
                    <span class="text-xs text-slate-400">Foto profil &mdash;
                        <button type="button" id="btnGantiFoto" class="text-teal-600 hover:text-teal-700 font-bold">Ganti foto</button>
                    </span>
                </div>
            </div>

            <p class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-3">Informasi Akun</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label for="inputNamaProfil" class="block text-xs font-bold text-slate-500 mb-1.5">Nama</label>
                    <input type="text" id="inputNamaProfil" value="{{ $user->name ?? 'Super Admin' }}" required
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                </div>
                <div>
                    <label for="inputEmailProfil" class="block text-xs font-bold text-slate-500 mb-1.5">Email</label>
                    <input type="email" id="inputEmailProfil" value="{{ $user->email ?? 'admin@pkkmb.ac.id' }}" required
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Role</label>
                    <input type="text" value="{{ ucfirst(str_replace('-', ' ', $user->role_name ?? 'super-admin')) }}" readonly
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-400 bg-slate-50 cursor-not-allowed" />
                </div>
            </div>
        </div>

        <!-- ===== UBAH PASSWORD ===== -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <p class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-3">Ubah Password</p>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="inputPwLama" class="block text-xs font-bold text-slate-500 mb-1.5">Password Lama</label>
                    <div class="relative">
                        <input type="password" id="inputPwLama" placeholder="Masukkan password lama"
                            class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 pr-10 focus:outline-none focus:border-teal-600" />
                        <button type="button" data-toggle-pw="inputPwLama" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-teal-600">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label for="inputPwBaru" class="block text-xs font-bold text-slate-500 mb-1.5">Password Baru</label>
                    <div class="relative">
                        <input type="password" id="inputPwBaru" placeholder="Minimal 8 karakter"
                            class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 pr-10 focus:outline-none focus:border-teal-600" />
                        <button type="button" data-toggle-pw="inputPwBaru" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-teal-600">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-6">
        <button type="submit" class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition">
            Update Profil
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function () {

    $("#btnGantiFoto").on("click", () => tampilkanToast("Pilih foto baru dari perangkat Anda..."));

    $("[data-toggle-pw]").on("click", function () {
        const target = $(this).data("toggle-pw");
        const $inp = $("#" + target);
        $inp.attr("type", $inp.attr("type") === "password" ? "text" : "password");
    });

    $("#inputNamaProfil").on("input", function () {
        $("#profilNamaTampil").text($(this).val() || "Super Admin");
        $("#profilInisial").text(($(this).val() || "S").charAt(0).toUpperCase());
    });

    $("#formProfil").on("submit", function (e) {
        e.preventDefault();
        const pwLama = $("#inputPwLama").val();
        const pwBaru = $("#inputPwBaru").val();
        if (pwBaru && !pwLama) { tampilkanToast("Masukkan password lama untuk mengganti password."); return; }
        if (pwBaru && pwBaru.length < 8) { tampilkanToast("Password baru minimal 8 karakter."); return; }
        // TODO: kirim data profil (dan password bila diisi) ke API
        tampilkanToast("Profil berhasil diperbarui.");
        $("#inputPwLama").val("");
        $("#inputPwBaru").val("");
    });
});
</script>
@endpush
