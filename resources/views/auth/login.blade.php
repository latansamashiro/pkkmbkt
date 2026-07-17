<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PKKMB-KT UNILAM - Login Sistem</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .custom-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-slate-100 via-indigo-500 to-blue-900 min-h-screen flex items-center justify-center p-4 sm:p-6 md:p-8 font-sans relative overflow-x-hidden">
    <!-- CONTAINER FLASH NOTIFICATION / TOAST -->
    @if (session('status'))
        <div id="flashNotification"
            class="fixed top-5 right-5 z-50 transition-all duration-500 ease-out transform translate-y-0 opacity-100 flex items-center p-4 mb-4 w-full max-w-sm bg-white rounded-2xl shadow-2xl border border-emerald-100">
            <div
                class="inline-flex items-center justify-center shrink-0 w-10 h-10 text-emerald-500 bg-emerald-50 rounded-xl">
                <i data-lucide="check-circle-2" class="w-6 h-6"></i>
            </div>
            <div class="ms-3 text-sm font-medium text-slate-800">
                <span class="font-bold block text-emerald-600">Berhasil!</span>
                <span class="text-slate-500 text-xs">{{ session('status') }}</span>
            </div>
        </div>
    @endif

    <div
        class="bg-white/75 backdrop-blur-lg w-full max-w-4xl rounded-3xl shadow-2xl overflow-hidden grid md:grid-cols-2 min-h-[550px] custom-transition border border-white/40">
        <!-- Panel Informasi Samping -->
        <div
            class="hidden md:flex flex-col justify-between p-12 bg-gradient-to-br from-blue-600/85 to-indigo-700/85 text-white relative overflow-hidden">
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-white/10 rounded-full blur-xl"></div>
            <div class="absolute -bottom-20 -right-20 w-60 h-60 bg-indigo-500/20 rounded-full blur-2xl"></div>

            <!-- Header Instansi -->
            <div class="flex items-center space-x-6 z-10">
                <img src="{{ asset('assets/unilam.png') }}" alt="Logo UNILAM"
                    class="w-28 h-28 object-contain filter drop-shadow-lg" />
                <div class="flex flex-col justify-center">
                    <span
                        class="font-black tracking-widest text-4xl uppercase leading-none drop-shadow-md">UNILAM</span>
                    <span class="text-xs text-blue-100/90 tracking-widest uppercase font-bold mt-2.5 drop-shadow-xs">
                        Portal PKKMB-KT
                    </span>
                </div>
            </div>

            <!-- Teks Sambutan -->
            <div class="space-y-4 z-10 mb-auto mt-12">
                <h2 class="text-3xl font-black leading-tight tracking-tight">
                    Mulai Langkah <br />Akademik Anda di Sini.
                </h2>
                <p class="text-blue-50 text-sm leading-relaxed opacity-90">
                    Selamat Datang di Portal PKKMB Wujudkan pengalaman PKKMB yang lebih
                    modern melalui platform digital terintegrasi. Akses informasi,
                    layanan, dan seluruh aktivitas dalam satu sistem.
                </p>
            </div>
        </div>

        <!-- Panel Form Login -->
        <div class="p-8 sm:p-12 flex flex-col justify-center bg-white/40 backdrop-blur-sm">
            <div class="mb-8 text-center md:text-left">
                <div
                    class="md:hidden inline-flex items-center space-x-2 bg-blue-50/70 backdrop-blur-xs px-3 py-1.5 rounded-full mb-4">
                    <i data-lucide="graduation-cap" class="w-4 h-4 text-blue-600"></i>
                    <span class="text-xs font-bold text-blue-700 uppercase tracking-wider">PORTAL LOGIN</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                    PKKMB-KT UNILAM
                </h1>
                <p class="text-sm font-medium text-slate-500 mt-1">
                    Silakan login menggunakan Email dan Password Anda
                </p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                        <span class="font-bold">Login gagal</span>
                    </div>
                    <ul class="ml-6 list-disc space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Field Email -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Alamat Email
                    </label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 custom-transition">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Masukkan email terdaftar" autocomplete="email" required autofocus
                            class="w-full pl-11 pr-4 py-3 border border-slate-300/60 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-100 bg-white/50 focus:bg-white custom-transition shadow-sm" />
                    </div>
                </div>


                <!-- Field Password -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Password
                        </label>
                        <a href="#"
                            class="text-xs font-semibold text-blue-600 hover:text-blue-700 hover:underline custom-transition">
                            Lupa Password?
                        </a>
                    </div>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 custom-transition">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <input type="password" id="password" name="password" placeholder="Masukkan password Anda"
                            autocomplete="current-password" required
                            class="w-full pl-11 pr-12 py-3 border border-slate-300/60 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-100 bg-white/50 focus:bg-white custom-transition shadow-sm" />
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-blue-600 custom-transition cursor-pointer"
                            title="Tampilkan/Sembunyikan Password">
                            <i id="eyeIcon" data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Checkbox Simpan Sandi -->
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember"
                        class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 focus:ring-2 cursor-pointer" />
                    <label for="remember" class="ml-2 text-xs font-medium text-slate-600 cursor-pointer select-none">
                        Simpan Sandi
                    </label>
                </div>

                <!-- Tombol Masuk -->
                <button type="submit" id="loginButton"
                    class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 active:scale-[0.99] text-white font-bold rounded-xl text-sm shadow-lg shadow-blue-500/20 hover:shadow-blue-500/30 custom-transition flex items-center justify-center space-x-2 cursor-pointer mt-2 text-center">
                    <span>Masuk ke Akun</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        // Inisialisasi awal icon Lucide
        lucide.createIcons();

        // Logika Show / Hide Password
        const passwordInput = document.getElementById("password");
        const togglePasswordBtn = document.getElementById("togglePassword");
        const eyeIcon = document.getElementById("eyeIcon");

        togglePasswordBtn.addEventListener("click", function () {
            const isPassword = passwordInput.getAttribute("type") === "password";
            passwordInput.setAttribute("type", isPassword ? "text" : "password");
            eyeIcon.setAttribute("data-lucide", isPassword ? "eye-off" : "eye");
            lucide.createIcons();
        });
    </script>
</body>

</html>