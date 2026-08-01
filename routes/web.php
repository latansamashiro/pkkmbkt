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
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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
            Route::patch('/{type}/{id}/toggle-important', 'toggleImportant')->name('admin.data-master.toggle-important');
            Route::patch('/{type}/{id}/toggle-publish', 'togglePublish')->name('admin.data-master.toggle-publish');
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

    //Committee
    // Todo:ganti 'accessrole:committee' kalau slug role di middleware-mu berbeda
    Route::group(['prefix' => 'committee', 'middleware' => ['accessrole:committee']], function () {

        Route::controller(UserController::class)->group(function () {
            // Kelola Mahasiswa Baru -> student
            Route::get('/mahasiswa', 'index')
                ->name('committee.mahasiswa.index')
                ->defaults('roleKey', 'STUDENT')
                ->defaults('view', 'role.committee.mahasiswa-baru.index');
            Route::post('/mahasiswa', 'store')
                ->name('committee.mahasiswa.store')
                ->defaults('roleKey', 'STUDENT');
            Route::put('/mahasiswa/{user}', 'update')
                ->name('committee.mahasiswa.update')
                ->defaults('roleKey', 'STUDENT');
            Route::delete('/mahasiswa/{user}', 'destroy')
                ->name('committee.mahasiswa.destroy')
                ->defaults('roleKey', 'STUDENT');

            // Kelola Mentor -> mentor
            Route::get('/mentor', 'index')
                ->name('committee.mentor.index')
                ->defaults('roleKey', 'MENTOR')
                ->defaults('view', 'role.committee.mentor.index');
            Route::post('/mentor', 'store')
                ->name('committee.mentor.store')
                ->defaults('roleKey', 'MENTOR');
            Route::put('/mentor/{user}', 'update')
                ->name('committee.mentor.update')
                ->defaults('roleKey', 'MENTOR');
            Route::delete('/mentor/{user}', 'destroy')
                ->name('committee.mentor.destroy')
                ->defaults('roleKey', 'MENTOR');
        });

        // ===== Kelola Jadwal (reuse DataMasterController, dibatasi hanya tipe 'jadwal') =====
        Route::controller(DataMasterController::class)->prefix('data-master')->group(function () {
            Route::get('/', 'index')
                ->name('committee.data-master.index')
                ->defaults('onlyTypes', ['jadwal'])
                ->defaults('view', 'role.committee.jadwal.index')
                ->defaults('title', 'Kelola Jadwal');
            Route::get('/{type}/items', 'items')->name('committee.data-master.items')->defaults('onlyTypes', ['jadwal']);
            Route::post('/{type}', 'store')->name('committee.data-master.store')->defaults('onlyTypes', ['jadwal']);
            Route::put('/{type}/{id}', 'update')->name('committee.data-master.update')->defaults('onlyTypes', ['jadwal']);
            Route::delete('/{type}/{id}', 'destroy')->name('committee.data-master.destroy')->defaults('onlyTypes', ['jadwal']);
            Route::patch('/{type}/{id}/toggle-important', 'toggleImportant')->name('committee.data-master.toggle-important')->defaults('onlyTypes', ['jadwal']);
            Route::patch('/{type}/{id}/toggle-publish', 'togglePublish')->name('committee.data-master.toggle-publish')->defaults('onlyTypes', ['jadwal']);
        });

        // ===== Data Master Panitia lainnya (Kelompok) =====
        // 'informasi', 'modul', 'topik', 'ujian', 'kategori_evaluasi' sudah dikeluarkan karena punya halaman & route sendiri
        Route::controller(DataMasterController::class)->prefix('data')->group(function () {
            $onlyTypes = ['kelompok'];

            Route::get('/', 'index')
                ->name('committee.master.index')
                ->defaults('onlyTypes', $onlyTypes)
                ->defaults('view', 'role.committee.data-master.index')
                ->defaults('title', 'Kelola Data Master');
            Route::get('/{type}/items', 'items')->name('committee.master.items')->defaults('onlyTypes', $onlyTypes);
            Route::post('/{type}', 'store')->name('committee.master.store')->defaults('onlyTypes', $onlyTypes);
            Route::put('/{type}/{id}', 'update')->name('committee.master.update')->defaults('onlyTypes', $onlyTypes);
            Route::delete('/{type}/{id}', 'destroy')->name('committee.master.destroy')->defaults('onlyTypes', $onlyTypes);
            Route::patch('/{type}/{id}/toggle-important', 'toggleImportant')->name('committee.master.toggle-important')->defaults('onlyTypes', $onlyTypes);
            Route::patch('/{type}/{id}/toggle-publish', 'togglePublish')->name('committee.master.toggle-publish')->defaults('onlyTypes', $onlyTypes);
        });

        // ===== Kelola Evaluasi (Kategori Evaluasi + Paket Evaluasi tipe 'ujian' + Bank Soal tipe 'soal' bersarang di exam_id) =====
        Route::controller(DataMasterController::class)->prefix('evaluasi')->group(function () {
            $onlyTypes = ['kategori_evaluasi', 'ujian', 'soal'];

            Route::get('/', 'index')
                ->name('committee.evaluasi.index')
                ->defaults('onlyTypes', $onlyTypes)
                ->defaults('view', 'role.committee.evaluasi.index')
                ->defaults('title', 'Kelola Evaluasi');
            Route::get('/{type}/items', 'items')->name('committee.evaluasi.items')->defaults('onlyTypes', $onlyTypes);
            Route::post('/{type}', 'store')->name('committee.evaluasi.store')->defaults('onlyTypes', $onlyTypes);
            Route::put('/{type}/{id}', 'update')->name('committee.evaluasi.update')->defaults('onlyTypes', $onlyTypes);
            Route::delete('/{type}/{id}', 'destroy')->name('committee.evaluasi.destroy')->defaults('onlyTypes', $onlyTypes);
        });

        // ===== Kelola Informasi (halaman & desain sendiri, reuse DataMasterController tipe 'informasi') =====
        Route::controller(DataMasterController::class)->prefix('informasi')->group(function () {
            Route::get('/', 'index')
                ->name('committee.informasi.index')
                ->defaults('onlyTypes', ['informasi'])
                ->defaults('view', 'role.committee.informasi.index')
                ->defaults('title', 'Kelola Informasi');
            Route::get('/{type}/items', 'items')->name('committee.informasi.items')->defaults('onlyTypes', ['informasi']);
            Route::post('/{type}', 'store')->name('committee.informasi.store')->defaults('onlyTypes', ['informasi']);
            Route::put('/{type}/{id}', 'update')->name('committee.informasi.update')->defaults('onlyTypes', ['informasi']);
            Route::delete('/{type}/{id}', 'destroy')->name('committee.informasi.destroy')->defaults('onlyTypes', ['informasi']);
            Route::patch('/{type}/{id}/toggle-important', 'toggleImportant')->name('committee.informasi.toggle-important')->defaults('onlyTypes', ['informasi']);
            Route::patch('/{type}/{id}/toggle-publish', 'togglePublish')->name('committee.informasi.toggle-publish')->defaults('onlyTypes', ['informasi']);
        });

        // ===== Kelola Materi Pembelajaran (halaman & desain sendiri, reuse DataMasterController tipe 'topik') =====
        Route::controller(DataMasterController::class)->prefix('materi')->group(function () {
            Route::get('/', 'index')
                ->name('committee.materi.index')
                ->defaults('onlyTypes', ['topik'])
                ->defaults('view', 'role.committee.materi.index')
                ->defaults('title', 'Materi Pembelajaran');
            Route::get('/{type}/items', 'items')->name('committee.materi.items')->defaults('onlyTypes', ['topik']);
            Route::post('/{type}', 'store')->name('committee.materi.store')->defaults('onlyTypes', ['topik']);
            Route::put('/{type}/{id}', 'update')->name('committee.materi.update')->defaults('onlyTypes', ['topik']);
            Route::delete('/{type}/{id}', 'destroy')->name('committee.materi.destroy')->defaults('onlyTypes', ['topik']);
            Route::patch('/{type}/{id}/toggle-publish', 'togglePublish')->name('committee.materi.toggle-publish')->defaults('onlyTypes', ['topik']);
        });

        // ===== Kelola Modul PKKMB (editor per-bagian, reuse DataMasterController tipe 'modul') =====
        Route::controller(DataMasterController::class)->prefix('modul')->group(function () {
            Route::get('/', 'index')
                ->name('committee.modul-pkkmb.index')
                ->defaults('onlyTypes', ['modul'])
                ->defaults('view', 'role.committee.modul-pkkmb.index')
                ->defaults('title', 'Modul PKKMB');
            Route::get('/{type}/items', 'items')->name('committee.modul-pkkmb.items')->defaults('onlyTypes', ['modul']);
            Route::post('/{type}', 'store')->name('committee.modul-pkkmb.store')->defaults('onlyTypes', ['modul']);
            Route::put('/{type}/{id}', 'update')->name('committee.modul-pkkmb.update')->defaults('onlyTypes', ['modul']);
            Route::delete('/{type}/{id}', 'destroy')->name('committee.modul-pkkmb.destroy')->defaults('onlyTypes', ['modul']);
            Route::patch('/{type}/{id}/toggle-publish', 'togglePublish')->name('committee.modul-pkkmb.toggle-publish')->defaults('onlyTypes', ['modul']);
        });
    });

});