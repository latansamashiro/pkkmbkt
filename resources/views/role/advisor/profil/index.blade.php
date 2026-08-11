@extends('layouts.advisor.main')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        corePlugins: { preflight: false }
    }
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<div class="mb-5">
    <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Lainnya</p>
    <h2 class="text-2xl font-extrabold text-slate-800 m-0">Profil</h2>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 items-start">
    <!-- ============ DATA DIRI (SEBAGIAN TERKUNCI) ============ -->
    <div class="bg-white border border-[#e1e5f1] rounded-[28px] shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] overflow-hidden">
        <div class="flex items-center gap-2.5 px-5 sm:px-7 py-5 border-b border-[#e1e5f1] bg-[#f2f4fa]">
            <span class="w-2.5 h-2.5 rounded-full bg-[#0f8a8c]"></span>
            <h3 class="text-base font-extrabold text-[#1b2238] m-0">Data Diri</h3>
        </div>

        <div class="flex flex-col items-center text-center px-5 sm:px-7 pt-6 sm:pt-7">
            <div class="relative w-[110px] h-[110px] mb-2">
                <div class="w-full h-full rounded-full overflow-hidden bg-[#e6e9f6] shadow-[0_10px_24px_rgba(21,33,89,0.16)]">
                    <img
                        id="avatarPreview"
                        src="{{ auth()->user()->profile_picture ? asset('storage/'.auth()->user()->profile_picture) : 'data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27%3E%3Crect width=%27100%27 height=%27100%27 fill=%27%23e2e8f0%27/%3E%3Ccircle cx=%2750%27 cy=%2738%27 r=%2718%27 fill=%27%2394a3b8%27/%3E%3Cpath d=%27M20 88c0-22 13-35 30-35s30 13 30 35%27 fill=%27%2394a3b8%27/%3E%3C/svg%3E' }}"
                        alt="Foto Profil"
                        class="w-full h-full object-cover" />
                </div>
                <label
                    for="avatarUpload"
                    class="absolute bottom-0 right-0 w-9 h-9 rounded-full bg-[#16a0a1] text-white flex items-center justify-center cursor-pointer shadow-[0_10px_24px_rgba(21,33,89,0.16)] transition-all hover:bg-[#0f8a8c] hover:scale-[1.08]">
                    <i data-lucide="camera" class="w-4 h-4"></i>
                    <input
                        type="file"
                        id="avatarUpload"
                        name="avatar"
                        form="profileForm"
                        accept="image/*"
                        class="hidden" />
                </label>
            </div>
            <p class="text-[11px] text-[#8d92a6] leading-[1.5] max-w-[260px] m-0">
                Format JPG, PNG, atau WEBP, maksimal 2MB.
            </p>
        </div>

        <div class="flex items-start gap-2.5 text-xs leading-[1.6] text-[#5b6175] bg-[#e6e9f6] border border-[#e1e5f1] rounded-[18px] px-3.5 py-3 mx-5 sm:mx-7 mt-5">
            <i data-lucide="lock" class="w-[13px] h-[13px] text-[#1e3a8f] mt-0.5 flex-shrink-0"></i>
            <span>
                Data bertanda <b>"Terkunci"</b> tidak dapat diubah sendiri karena
                bersumber dari data resmi. Jika ada kesalahan data, silakan hubungi
                panitia/admin PKKMB-KT UNILAM.
            </span>
        </div>

        <form id="profileForm" method="POST" action="{{ route('role.advisor.profil.update') }}" enctype="multipart/form-data" class="p-5 sm:p-7 flex flex-col gap-5">
            @csrf
            <div>
                <label class="flex items-center gap-1.5 text-[11px] font-extrabold tracking-[0.05em] uppercase text-[#8d92a6] mb-2">
                    Nama
                    <span class="inline-flex items-center gap-1 text-[9.5px] font-extrabold tracking-[0.03em] normal-case text-[#5b6175] bg-[#e8ebf6] border border-[#e1e5f1] rounded-full px-2 py-0.5"><i data-lucide="lock" class="w-[9px] h-[9px]"></i>Terkunci</span>
                </label>
                <div class="relative">
                    <i data-lucide="id-card" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#8d92a6]"></i>
                    <input
                        type="text"
                        value="{{ old('name', auth()->user()->name) }}"
                        class="w-full py-[11px] pl-10 pr-9 rounded-xl border border-[#e1e5f1] text-[13.5px] font-medium bg-[#e1e5f1] text-[#5b6175] cursor-not-allowed"
                        disabled
                        readonly />
                    <i data-lucide="lock" class="w-[13px] h-[13px] absolute right-3.5 top-1/2 -translate-y-1/2 text-[#8d92a6]"></i>
                </div>
            </div>

            <div>
                <label class="flex items-center gap-1.5 text-[11px] font-extrabold tracking-[0.05em] uppercase text-[#8d92a6] mb-2">
                    Email
                    <span class="inline-flex items-center gap-1 text-[9.5px] font-extrabold tracking-[0.03em] normal-case text-[#5b6175] bg-[#e8ebf6] border border-[#e1e5f1] rounded-full px-2 py-0.5"><i data-lucide="lock" class="w-[9px] h-[9px]"></i>Terkunci</span>
                </label>
                <div class="relative">
                    <i data-lucide="mail" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#8d92a6]"></i>
                    <input
                        type="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        class="w-full py-[11px] pl-10 pr-9 rounded-xl border border-[#e1e5f1] text-[13.5px] font-medium bg-[#e1e5f1] text-[#5b6175] cursor-not-allowed"
                        disabled
                        readonly />
                    <i data-lucide="lock" class="w-[13px] h-[13px] absolute right-3.5 top-1/2 -translate-y-1/2 text-[#8d92a6]"></i>
                </div>
            </div>

            <div>
                <label class="text-[11px] font-extrabold tracking-[0.05em] uppercase text-[#8d92a6] mb-2 block">No HP</label>
                <div class="relative">
                    <i data-lucide="phone" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#8d92a6]"></i>
                    <input
                        type="text"
                        name="phone_no"
                        value="{{ old('phone_no', auth()->user()->phone_no) }}"
                        class="w-full py-[11px] pl-10 pr-3.5 rounded-xl border border-[#e1e5f1] bg-[#f2f4fa] text-[13.5px] font-medium text-[#1b2238] transition-all focus:outline-none focus:border-[#16a0a1] focus:bg-white focus:shadow-[0_0_0_4px_#e2f3f2]" />
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 mt-1 border-t border-[#e1e5f1]">
                <button type="submit" class="py-3 px-[26px] rounded-xl text-[13.5px] font-bold text-white bg-[#152159] border-none cursor-pointer shadow-[0_10px_24px_rgba(21,33,89,0.16)] transition-all hover:bg-[#1e3a8f] active:scale-[0.98]">
                    Update Profil
                </button>
            </div>
        </form>
    </div>

    <!-- ============ GANTI PASSWORD ============ -->
    <div class="bg-white border border-[#e1e5f1] rounded-[28px] shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] overflow-hidden">
        <div class="flex items-center gap-2.5 px-5 sm:px-7 py-5 border-b border-[#e1e5f1] bg-[#f2f4fa]">
            <span class="w-2.5 h-2.5 rounded-full bg-[#e0a728]"></span>
            <h3 class="text-base font-extrabold text-[#1b2238] m-0">Ganti Password</h3>
        </div>

        <form method="POST" action="{{ route('role.advisor.profil.password') }}" class="p-5 sm:p-7 flex flex-col gap-5">
            @csrf
            <p class="text-xs text-[#5b6175] leading-[1.6] m-0">
                Masukkan password saat ini, lalu buat password baru minimal 8
                karakter. Pastikan konfirmasi password baru sama persis.
            </p>

            <div>
                <label class="text-[11px] font-extrabold tracking-[0.05em] uppercase text-[#8d92a6] mb-2 block">Password Saat Ini</label>
                <div class="relative">
                    <i data-lucide="lock" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#8d92a6]"></i>
                    <input
                        type="password"
                        name="current_password"
                        class="w-full py-[11px] pl-10 pr-3.5 rounded-xl border border-[#e1e5f1] bg-[#f2f4fa] text-[13.5px] font-medium text-[#1b2238] transition-all focus:outline-none focus:border-[#16a0a1] focus:bg-white focus:shadow-[0_0_0_4px_#e2f3f2]" />
                </div>
            </div>

            <div>
                <label class="text-[11px] font-extrabold tracking-[0.05em] uppercase text-[#8d92a6] mb-2 block">Password Baru</label>
                <div class="relative">
                    <i data-lucide="key" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#8d92a6]"></i>
                    <input
                        type="password"
                        name="password"
                        minlength="8"
                        class="w-full py-[11px] pl-10 pr-3.5 rounded-xl border border-[#e1e5f1] bg-[#f2f4fa] text-[13.5px] font-medium text-[#1b2238] transition-all focus:outline-none focus:border-[#16a0a1] focus:bg-white focus:shadow-[0_0_0_4px_#e2f3f2]" />
                </div>
            </div>

            <div>
                <label class="text-[11px] font-extrabold tracking-[0.05em] uppercase text-[#8d92a6] mb-2 block">Konfirmasi Password Baru</label>
                <div class="relative">
                    <i data-lucide="key" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#8d92a6]"></i>
                    <input
                        type="password"
                        name="password_confirmation"
                        minlength="8"
                        class="w-full py-[11px] pl-10 pr-3.5 rounded-xl border border-[#e1e5f1] bg-[#f2f4fa] text-[13.5px] font-medium text-[#1b2238] transition-all focus:outline-none focus:border-[#16a0a1] focus:bg-white focus:shadow-[0_0_0_4px_#e2f3f2]" />
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 mt-1 border-t border-[#e1e5f1]">
                <button type="submit" class="py-3 px-[26px] rounded-xl text-[13.5px] font-bold text-white bg-[#152159] border-none cursor-pointer shadow-[0_10px_24px_rgba(21,33,89,0.16)] transition-all hover:bg-[#1e3a8f] active:scale-[0.98]">
                    Ubah Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        if (window.lucide) lucide.createIcons();

        $("#avatarUpload").on("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $("#avatarPreview").attr("src", e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush