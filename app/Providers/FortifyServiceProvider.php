<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Paksa redirect ke /login setelah logout (bukan balik ke halaman
        // sebelumnya), biar konsisten sama PreventBackHistory middleware.
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/login');
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        // Login boleh pakai EMAIL LENGKAP (mis. mentor@gmail.com) ATAU cuma
        // NIM/NPM aja (mis. 525241009) -- kalau yang diketik gak mengandung
        // "@", dianggap NIM/NPM. Dicoba 2 cara: (1) cocokkan ke kolom email
        // hasil "npm@unilam.ac.id", (2) cocokkan LANGSUNG ke kolom npm --
        // jaga-jaga kalau email akun yang sebenarnya di database gak persis
        // ngikutin pola "npm@unilam.ac.id".
        Fortify::authenticateUsing(function (Request $request) {
            $login = trim((string) $request->input(Fortify::username()));

            if (str_contains($login, '@')) {
                $user = \App\Models\User::where('email', $login)->first();
            } else {
                $user = \App\Models\User::where('email', $login . '@unilam.ac.id')
                    ->orWhere('npm', $login)
                    ->first();
            }

                 if (!$user || !\Illuminate\Support\Facades\Hash::check($request->input('password'), $user->password)) {
                return null;
            }

            // Akun yang sudah dinonaktifkan panitia/admin tidak boleh bisa
            // login sama sekali, walau email/password yang dimasukkan benar.
            if ($user->status !== 'aktif') {
                return null;
            }

            return $user;
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        Fortify::loginView(function () {
            return view('auth.login');
        });
    }
}
