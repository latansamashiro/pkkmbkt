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

<div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
    <div class="bg-white border border-slate-200 rounded-2xl p-6">
        <h3 class="text-base font-extrabold text-slate-800 mb-4">Data Diri</h3>
        <form method="POST" action="{{ route('role.advisor.profil.update') }}" enctype="multipart/form-data" class="flex flex-col gap-3">
            @csrf
            @if ($errors->any())
                <div class="bg-rose-50 border border-rose-100 rounded-xl px-3.5 py-2.5">
                    <p class="text-xs font-bold text-rose-600 m-0">{{ $errors->first() }}</p>
                </div>
            @endif

            <div class="flex items-center gap-4 mb-1">
                <div class="relative w-[76px] h-[76px] shrink-0">
                    <div class="w-full h-full rounded-full overflow-hidden bg-slate-100 border-2 border-slate-200">
                        <img id="avatarPreview"
                            src="{{ auth()->user()->profile_picture ? asset('storage/'.auth()->user()->profile_picture).'?v='.auth()->user()->updated_at->timestamp : 'data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 100 100%27%3E%3Crect width=%27100%27 height=%27100%27 fill=%27%23e2e8f0%27/%3E%3Ccircle cx=%2750%27 cy=%2738%27 r=%2718%27 fill=%27%2394a3b8%27/%3E%3Cpath d=%27M20 88c0-22 13-35 30-35s30 13 30 35%27 fill=%27%2394a3b8%27/%3E%3C/svg%3E' }}"
                            alt="Foto Profil" class="w-full h-full object-cover" />
                    </div>
                    <label for="avatarUpload"
                        class="absolute bottom-0 right-0 w-6 h-6 rounded-full bg-teal-600 text-white flex items-center justify-center cursor-pointer border-2 border-white">
                        <i data-lucide="camera" class="w-3 h-3"></i>
                        <input type="file" id="avatarUpload" name="avatar" accept="image/*" class="hidden" />
                    </label>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500 m-0">Foto Profil</p>
                    <p class="text-[11px] text-slate-400 m-0 mt-0.5">JPG/PNG/WEBP, maks. 2MB</p>
                </div>
            </div>

            <div>
                <label class="text-xs font-bold text-slate-500">Nama</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full mt-1 text-sm border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:border-teal-600" />
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500">Email</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full mt-1 text-sm border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:border-teal-600" />
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500">No HP</label>
                <input type="text" name="phone_no" value="{{ old('phone_no', auth()->user()->phone_no) }}" class="w-full mt-1 text-sm border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:border-teal-600" />
            </div>
            <button type="submit" class="mt-2 bg-[#152159] hover:bg-[#1e3a8f] text-white text-sm font-bold px-4 py-2.5 rounded-xl self-start">
                Update Profil
            </button>
        </form>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl p-6">
        <h3 class="text-base font-extrabold text-slate-800 mb-4">Ganti Password</h3>
        <form method="POST" action="{{ route('role.advisor.profil.password') }}" class="flex flex-col gap-3">
            @csrf
            <div>
                <label class="text-xs font-bold text-slate-500">Password Saat Ini</label>
                <input type="password" name="current_password" class="w-full mt-1 text-sm border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:border-teal-600" />
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500">Password Baru</label>
                <input type="password" name="password" class="w-full mt-1 text-sm border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:border-teal-600" />
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="w-full mt-1 text-sm border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:border-teal-600" />
            </div>
            <button type="submit" class="mt-2 bg-[#152159] hover:bg-[#1e3a8f] text-white text-sm font-bold px-4 py-2.5 rounded-xl self-start">
                Ubah Password
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        if (window.lucide) lucide.createIcons();

        $("#avatarUpload").on("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => $("#avatarPreview").attr("src", e.target.result);
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush
