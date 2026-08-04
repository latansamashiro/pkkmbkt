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
        <form method="POST" action="{{ route('role.advisor.profil.update') }}" class="flex flex-col gap-3">
            @csrf
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
    });
</script>
@endpush
