<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PKKMB-KT UNILAM - Login Sistem</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/pkkmbkt-theme.css'])
</head>

<body>
    <div class="login-page">
        <!-- CONTAINER FLASH NOTIFICATION / TOAST -->
        @if (session('status'))
            <div id="flashNotification" class="login-toast">
                <div class="login-toast-icon">
                    <i data-lucide="check-circle-2"></i>
                </div>
                <div>
                    <span class="login-toast-title">Berhasil!</span>
                    <span class="login-toast-desc">{{ session('status') }}</span>
                </div>
            </div>
        @endif

        <div class="login-shell">
            <!-- Panel Informasi Samping -->
            <div class="login-info">
                <div class="login-info-header">
                    <div class="login-info-logo-frame">
                        <img src="{{ asset('assets/unilam.png') }}" alt="Logo UNILAM" class="login-info-logo" />
                    </div>
                    <div class="login-info-brand">
                        <strong>UNILAM</strong>
                        <span>Portal PKKMB-KT</span>
                    </div>
                </div>

                <div class="login-info-body">
                    <h2>Mulai Langkah <br />Akademik Anda di Sini.</h2>
                    <p>
                        Selamat Datang di Portal PKKMB. Wujudkan pengalaman PKKMB yang lebih
                        modern melalui platform digital terintegrasi. Akses informasi,
                        layanan, dan seluruh aktivitas dalam satu sistem.
                    </p>
                </div>
            </div>

            <!-- Panel Form Login -->
            <div class="login-form-panel">
                <div class="login-mobile-badge">
                    <i data-lucide="graduation-cap" class="ic"></i>
                    <span>Portal Login</span>
                </div>

                <h1 class="login-heading">PKKMB-KT UNILAM</h1>
                <p class="login-subheading">Silakan login menggunakan Email dan Password Anda</p>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="login-error">
                        <div class="login-error-title">
                            <i data-lucide="alert-circle" class="ic"></i>
                            <span>Login gagal</span>
                        </div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="login-form">
                    @csrf

                    <!-- Field Email / NIM-NPM -->
                    <div>
                        <label for="email" class="login-field-label">Email atau NIM/NPM</label>
                        <div class="login-input-wrap">
                            <i data-lucide="mail" class="ic"></i>
                            <input type="text" id="email" name="email" value="{{ old('email') }}"
                                placeholder="Email atau NIM/NPM (contoh: 525241009)" autocomplete="username" required autofocus
                                class="login-input" />
                        </div>
                    </div>

                    <!-- Field Password -->
                    <div>
                        <div class="login-label-row">
                            <label for="password" class="login-field-label" style="margin-bottom:0">Password</label>
                            <a href="#" class="login-forgot">Lupa Password?</a>
                        </div>
                        <div class="login-input-wrap">
                            <i data-lucide="lock" class="ic"></i>
                            <input type="password" id="password" name="password"
                                placeholder="Masukkan password Anda" autocomplete="current-password" required
                                class="login-input has-toggle" />
                            <button type="button" id="togglePassword" class="login-toggle-btn"
                                title="Tampilkan/Sembunyikan Password">
                                <i id="eyeIcon" data-lucide="eye" class="ic"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Checkbox Simpan Sandi -->
                    <label class="login-remember" for="remember">
                        <input type="checkbox" id="remember" name="remember" />
                        Simpan Sandi
                    </label>

                    <!-- Tombol Masuk -->
                    <button type="submit" id="loginButton" class="login-submit">
                        <span>Masuk ke Akun</span>
                        <i data-lucide="arrow-right" class="ic"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            // Inisialisasi awal icon Lucide
            lucide.createIcons();

            // Logika Show / Hide Password (jQuery)
            $('#togglePassword').on('click', function () {
                var $password = $('#password');
                var isPassword = $password.attr('type') === 'password';

                $password.attr('type', isPassword ? 'text' : 'password');
                $('#eyeIcon').attr('data-lucide', isPassword ? 'eye-off' : 'eye');

                lucide.createIcons();
            });

            // Auto-hide flash notification setelah beberapa detik
            var $flash = $('#flashNotification');
            if ($flash.length) {
                setTimeout(function () {
                    $flash.css('opacity', '0').css('transform', 'translateY(-10px)');
                    setTimeout(function () {
                        $flash.remove();
                    }, 500);
                }, 4000);
            }

            // Nonaktifkan tombol submit saat form dikirim, cegah double submit
            $('form.login-form').on('submit', function () {
                $('#loginButton')
                    .prop('disabled', true)
                    .html('<span>Memproses...</span>');
            });
        });
    </script>
</body>

</html>
