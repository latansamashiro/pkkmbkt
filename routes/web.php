<?php

/* -------------------------------------
Terdapat 5 Roles:
- super-admin
- advisor (pembimbing)
- mentor
- student (mahasiswa)
- committee (panitia)
---------------------------------------*/

use App\Http\Controllers\Admin\DataMasterController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

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
    });

    //Advisor

    //Mentor

    //Student

    //Committee
});