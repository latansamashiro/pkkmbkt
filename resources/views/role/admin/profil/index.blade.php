@extends(request()->routeIs('committee.*') ? 'layouts.committee.main' : 'layouts.admin.main')
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
        <h2 class="text-2xl font-extrabold text-slate-800 m-0">{{ $data['title'] }}</h2>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- ===== INFORMASI AKUN ===== -->
    <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:col-span-2">

        @if ($errors->profileUpdate->any() ?? false)
            <div class="mb-4 text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg px-3 py-2">
                {{ $errors->profileUpdate->first() }}
            </div>
        @endif

        <form id="profileForm" method="POST" action="{{ route(\Illuminate\Support\Str::before(request()->route()->getName(), '.profil') . '.profil.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center gap-4 mb-6">
                <img id="avatarPreview"
                    src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27%3E%3Crect width=%27100%27 height=%27100%27 fill=%27%23e2e8f0%27/%3E%3Ccircle cx=%2750%27 cy=%2738%27 r=%2718%27 fill=%27%2394a3b8%27/%3E%3Cpath d=%27M20 88c0-22 13-35 30-35s30 13 30 35%27 fill=%27%2394a3b8%27/%3E%3C/svg%3E' }}"
                    class="w-16 h-16 rounded-full object-cover shrink-0 border border-slate-200" alt="Foto profil" />
                <div>
                    <strong class="block text-slate-800 font-bold">{{ $user->name }}</strong>
                    <span class="text-xs text-slate-400">
                        <label for="avatarUpload" class="text-teal-600 hover:text-teal-700 font-bold cursor-pointer">Ganti foto</label>
                    </span>
                    <input type="file" id="avatarUpload" name="avatar" accept="image/*" class="hidden" />
                </div>
            </div>

            <p class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-3">Informasi Akun</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Nama</label>
                    <input type="text" value="{{ $user->name }}" readonly
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-400 bg-slate-50 cursor-not-allowed" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Email</label>
                    <input type="email" value="{{ $user->email }}" readonly
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-400 bg-slate-50 cursor-not-allowed" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Role</label>
                    <input type="text" value="{{ ucfirst(str_replace('-', ' ', strtolower($user->role_name))) }}" readonly
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-400 bg-slate-50 cursor-not-allowed" />
                </div>
                <div class="md:col-span-2">
                    <label for="inputPhone" class="block text-xs font-bold text-slate-500 mb-1.5">Nomor Telepon</label>
                    <input type="tel" id="inputPhone" name="phone_no" value="{{ old('phone_no', $user->phone_no) }}"
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- ===== UBAH PASSWORD ===== -->
    <div class="bg-white border border-slate-200 rounded-2xl p-6">
        <p class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-3">Ubah Password</p>

        @if ($errors->passwordUpdate->any() ?? false)
            <p class="text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg px-3 py-2 mb-3">
                {{ $errors->passwordUpdate->first() }}
            </p>
        @endif

        <form id="passwordForm" method="POST" action="{{ route(\Illuminate\Support\Str::before(request()->route()->getName(), '.profil') . '.profil.password') }}">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="inputPwLama" class="block text-xs font-bold text-slate-500 mb-1.5">Password Lama</label>
                    <div class="relative">
                        <input type="password" id="inputPwLama" name="old_password" placeholder="Masukkan password lama" required
                            class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 pr-10 focus:outline-none focus:border-teal-600" />
                        <button type="button" data-toggle-pw="inputPwLama" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-teal-600">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label for="inputPwBaru" class="block text-xs font-bold text-slate-500 mb-1.5">Password Baru</label>
                    <div class="relative">
                        <input type="password" id="inputPwBaru" name="new_password" placeholder="Minimal 8 karakter" minlength="8" required
                            class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 pr-10 focus:outline-none focus:border-teal-600" />
                        <button type="button" data-toggle-pw="inputPwBaru" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-teal-600">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label for="inputPwKonfirmasi" class="block text-xs font-bold text-slate-500 mb-1.5">Konfirmasi Password Baru</label>
                    <input type="password" id="inputPwKonfirmasi" name="new_password_confirmation" placeholder="Ulangi password baru" minlength="8" required
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                </div>
                <button type="submit" class="inline-flex items-center justify-center gap-2 bg-slate-800 hover:bg-slate-900 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
                    Ubah Password
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function () {
    $("[data-toggle-pw]").on("click", function () {
        const target = $(this).data("toggle-pw");
        const $inp = $("#" + target);
        $inp.attr("type", $inp.attr("type") === "password" ? "text" : "password");
    });

    $("#avatarUpload").on("change", function () {
        const file = this.files[0];
        if (!file) return;
        $("#avatarPreview").attr("src", URL.createObjectURL(file));
    });

    @if (session('profileStatus'))
        tampilkanToast(@json(session('profileStatus')));
    @endif
    @if (session('passwordStatus'))
        tampilkanToast(@json(session('passwordStatus')));
    @endif
});
</script>
@endpush
