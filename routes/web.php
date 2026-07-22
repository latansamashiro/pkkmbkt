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
        Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
        Route::post('/user', [UserController::class, 'store'])->name('admin.user.store');
        Route::put('/user/{user}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
        Route::get('/role', [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('/data-master', [DataMasterController::class, 'index'])->name('admin.data-master.index');
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
