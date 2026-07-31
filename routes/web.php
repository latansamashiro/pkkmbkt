<?php

/* -------------------------------------
Terdapat 5 Roles:
- super-admin
- advisor (pembimbing)
- mentor
- student (mahasiswa)
- committee (panitia)
---------------------------------------*/

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataMasterController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;


Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/home', [LandingController::class, 'home'])->name('landing.home');
Route::get('/sejarah', [LandingController::class, 'sejarah'])->name('landing.sejarah');
Route::get('/visi-misi', [LandingController::class, 'visiMisi'])->name('landing.visi-misi');
Route::get('/tentang-kami', [LandingController::class, 'tentangKami'])->name('landing.tentang-kami');
Route::get('/informasi', [LandingController::class, 'informasi'])->name('landing.informasi');
Route::get('/kontak', [LandingController::class, 'kontak'])->name('landing.kontak');
Route::get('/kebijakan-privasi', [LandingController::class, 'kebijakanPrivasi'])->name('landing.kebijakan-privasi');
Route::get('/syarat-ketentuan', [LandingController::class, 'syaratKetentuan'])->name('landing.syarat-ketentuan');
Route::get('/bantuan', [LandingController::class, 'bantuan'])->name('landing.bantuan');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Admin
    Route::group(['prefix' => 'admin', 'middleware' => ['accessrole:super-admin']], function () {

        // ===== Kelola Pengguna per Role =====
        Route::controller(UserController::class)->group(function () {

            // Kelola Pengguna -> super-admin
            Route::get('/user', 'index')->name('admin.user.index')->defaults('roleKey', 'SUPER-ADMIN');
            Route::post('/user', 'store')->name('admin.user.store')->defaults('roleKey', 'SUPER-ADMIN');
            Route::put('/user/{user}', 'update')->name('admin.user.update')->defaults('roleKey', 'SUPER-ADMIN');
            Route::delete('/user/{user}', 'destroy')->name('admin.user.destroy')->defaults('roleKey', 'SUPER-ADMIN');

            // Kelola Mahasiswa -> student
            Route::get('/mahasiswa', 'index')->name('admin.mahasiswa.index')->defaults('roleKey', 'STUDENT');
            Route::post('/mahasiswa', 'store')->name('admin.mahasiswa.store')->defaults('roleKey', 'STUDENT');
            Route::put('/mahasiswa/{user}', 'update')->name('admin.mahasiswa.update')->defaults('roleKey', 'STUDENT');
            Route::delete('/mahasiswa/{user}', 'destroy')->name('admin.mahasiswa.destroy')->defaults('roleKey', 'STUDENT');

            // Kelola Mentor -> mentor
            Route::get('/mentor', 'index')->name('admin.mentor.index')->defaults('roleKey', 'MENTOR');
            Route::post('/mentor', 'store')->name('admin.mentor.store')->defaults('roleKey', 'MENTOR');
            Route::put('/mentor/{user}', 'update')->name('admin.mentor.update')->defaults('roleKey', 'MENTOR');
            Route::delete('/mentor/{user}', 'destroy')->name('admin.mentor.destroy')->defaults('roleKey', 'MENTOR');

            // Kelola Advisor (Pembimbing) -> advisor
            Route::get('/advisor', 'index')->name('admin.advisor.index')->defaults('roleKey', 'ADVISOR');
            Route::post('/advisor', 'store')->name('admin.advisor.store')->defaults('roleKey', 'ADVISOR');
            Route::put('/advisor/{user}', 'update')->name('admin.advisor.update')->defaults('roleKey', 'ADVISOR');
            Route::delete('/advisor/{user}', 'destroy')->name('admin.advisor.destroy')->defaults('roleKey', 'ADVISOR');

            // Kelola Panitia -> committee
            Route::get('/panitia', 'index')->name('admin.panitia.index')->defaults('roleKey', 'COMMITTEE');
            Route::post('/panitia', 'store')->name('admin.panitia.store')->defaults('roleKey', 'COMMITTEE');
            Route::put('/panitia/{user}', 'update')->name('admin.panitia.update')->defaults('roleKey', 'COMMITTEE');
            Route::delete('/panitia/{user}', 'destroy')->name('admin.panitia.destroy')->defaults('roleKey', 'COMMITTEE');
        });

        // ===== Kelola Data Master =====
        Route::controller(DataMasterController::class)->prefix('data-master')->group(function () {
            Route::get('/', 'index')->name('admin.data-master.index');
            Route::get('/{type}/items', 'items')->name('admin.data-master.items');
            Route::post('/{type}', 'store')->name('admin.data-master.store');
            Route::put('/{type}/{id}', 'update')->name('admin.data-master.update');
            Route::delete('/{type}/{id}', 'destroy')->name('admin.data-master.destroy');
        });

        Route::get('/role', [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('/monitoring/pkkmb', [MonitoringController::class, 'pkkmb'])->name('admin.monitoring.pkkmb');
        Route::get('/monitoring/laporan', [MonitoringController::class, 'laporan'])->name('admin.monitoring.laporan');
        Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('admin.pengaturan.index');
        Route::get('/profil', [ProfilController::class, 'index'])->name('admin.profil.index');
        Route::get('/monitoring/absensi', [MonitoringController::class, 'absensi'])
            ->name('admin.monitoring.absensi');
        Route::get('/monitoring/absensi/{groupId}/{tanggal}', [MonitoringController::class, 'absensiDetail'])
            ->name('admin.monitoring.absensi.detail');
    });

    Route::get('/monitoring/keaktifan', [MonitoringController::class, 'keaktifan'])
        ->name('admin.monitoring.keaktifan');
    Route::get('/monitoring/keaktifan/{groupId}', [MonitoringController::class, 'keaktifanDetail'])
        ->name('admin.monitoring.keaktifan.detail');

    Route::get('/monitoring/pelanggaran', [MonitoringController::class, 'pelanggaran'])
        ->name('admin.monitoring.pelanggaran');
    Route::get('/monitoring/pelanggaran/{groupId}', [MonitoringController::class, 'pelanggaranDetail'])
        ->name('admin.monitoring.pelanggaran.detail');

        Route::get('/monitoring/evaluasi', [MonitoringController::class, 'evaluasi'])
    ->name('admin.monitoring.evaluasi');
Route::get('/monitoring/evaluasi/{groupId}', [MonitoringController::class, 'evaluasiDetail'])
    ->name('admin.monitoring.evaluasi.detail');

    //Advisor

    //Mentor

    //Student
    Route::group(['prefix' => 'mahasiswa', 'middleware' => ['accessrole:student']], function () {
        Route::controller(\App\Http\Controllers\Student\StudentController::class)->group(function () {
            Route::get('/modul', 'modul')->name('role.student.modul');
            Route::get('/leaderboard', 'leaderboard')->name('role.student.leaderboard');
            Route::get('/info', 'info')->name('role.student.info');
            Route::get('/profil', 'profil')->name('role.student.profil');
            Route::post('/profil', 'updateProfile')->name('role.student.profil.update');
            Route::post('/profil/password', 'updatePassword')->name('role.student.profil.password');
            Route::get('/jadwal', 'jadwal')->name('role.student.jadwal');
            Route::get('/keaktifan', 'keaktifan')->name('role.student.keaktifan');
            Route::get('/materi', 'materi')->name('role.student.materi');
            Route::get('/denah-kampus', 'denahKampus')->name('role.student.denah-kampus');
            Route::get('/evaluasi', 'evaluasi')->name('role.student.evaluasi');
            Route::get('/absensi', 'absensi')->name('role.student.absensi');
        });
    });

    //Committee
});
