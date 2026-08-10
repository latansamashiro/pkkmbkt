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
            Route::get('/mahasiswa-import/template', 'importTemplate')->name('admin.mahasiswa.import-template')->defaults('roleKey', 'STUDENT');
            Route::post('/mahasiswa-import', 'import')->name('admin.mahasiswa.import')->defaults('roleKey', 'STUDENT');

            // Kelola Mentor -> mentor
            Route::get('/mentor', 'index')->name('admin.mentor.index')->defaults('roleKey', 'MENTOR');
            Route::post('/mentor', 'store')->name('admin.mentor.store')->defaults('roleKey', 'MENTOR');
            Route::put('/mentor/{user}', 'update')->name('admin.mentor.update')->defaults('roleKey', 'MENTOR');
            Route::delete('/mentor/{user}', 'destroy')->name('admin.mentor.destroy')->defaults('roleKey', 'MENTOR');
            Route::get('/mentor-import/template', 'importTemplate')->name('admin.mentor.import-template')->defaults('roleKey', 'MENTOR');
            Route::post('/mentor-import', 'import')->name('admin.mentor.import')->defaults('roleKey', 'MENTOR');

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
            // Bank Soal — didaftarkan SEBELUM rute generik {type} di bawah,
            // supaya /soal/items, /soal/import, dst tidak "kesamber" duluan
            // oleh wildcard {type} generik (Laravel match urutan pertama menang).
            Route::get('/soal', 'soalIndex')->name('admin.data-master.soal.index');
            Route::get('/soal/items', 'soalItems')->name('admin.data-master.soal.items');
            Route::post('/soal/import', 'soalImport')->name('admin.data-master.soal.import');
            Route::delete('/soal/{id}', 'soalDestroy')->whereNumber('id')->name('admin.data-master.soal.destroy');

            Route::get('/', 'index')->name('admin.data-master.index');
            Route::get('/{type}/items', 'items')->name('admin.data-master.items');
            Route::post('/{type}', 'store')->name('admin.data-master.store');
            Route::put('/{type}/{id}', 'update')->name('admin.data-master.update');
            Route::delete('/{type}/{id}', 'destroy')->name('admin.data-master.destroy');
        });

        // ===== Kelola Kelompok (anggota) =====
        Route::controller(\App\Http\Controllers\Admin\GroupController::class)->prefix('kelompok')->group(function () {
            Route::get('/', 'index')->name('admin.kelompok.index');
            Route::post('/{group}/anggota', 'addMember')->name('admin.kelompok.anggota.store');
            Route::delete('/{group}/anggota/{student}', 'removeMember')->name('admin.kelompok.anggota.destroy');
        });

        Route::get('/role', [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('/monitoring/pkkmb', [MonitoringController::class, 'pkkmb'])->name('admin.monitoring.pkkmb');
        Route::get('/monitoring/laporan', [MonitoringController::class, 'laporan'])->name('admin.monitoring.laporan');
        Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('admin.pengaturan.index');
        Route::get('/profil', [ProfilController::class, 'index'])->name('admin.profil.index');
        Route::post('/profil', [ProfilController::class, 'updateProfile'])->name('admin.profil.update');
        Route::post('/profil/password', [ProfilController::class, 'updatePassword'])->name('admin.profil.password');
        Route::get('/monitoring/absensi', [MonitoringController::class, 'absensi'])
            ->name('admin.monitoring.absensi');
        Route::get('/monitoring/absensi/{groupId}/{tanggal}', [MonitoringController::class, 'absensiDetail'])
            ->name('admin.monitoring.absensi.detail');
        Route::get('/monitoring/absensi/{groupId}/{tanggal}/export-pdf', [MonitoringController::class, 'absensiExportPdf'])
            ->name('admin.monitoring.absensi.export-pdf');
        Route::get('/monitoring/absensi/{groupId}/{tanggal}/export-excel', [MonitoringController::class, 'absensiExportExcel'])
            ->name('admin.monitoring.absensi.export-excel');

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

        Route::get('/monitoring/tugas', [MonitoringController::class, 'tugas'])
            ->name('admin.monitoring.tugas');
        Route::get('/monitoring/tugas/{groupId}', [MonitoringController::class, 'tugasDetail'])
            ->name('admin.monitoring.tugas.detail');
        Route::get('/monitoring/tugas/{groupId}/export-excel', [MonitoringController::class, 'tugasExportExcel'])
            ->name('admin.monitoring.tugas.export-excel');
    });

    //Advisor
    Route::group(['prefix' => 'advisor', 'middleware' => ['accessrole:advisor']], function () {
        Route::controller(\App\Http\Controllers\Advisor\AdvisorController::class)->group(function () {
            Route::get('/kelompok-binaan', 'kelompokBinaan')->name('role.advisor.kelompok-binaan');
            Route::get('/kelompok-binaan/{id}', 'kelompokBinaanDetail')->name('role.advisor.kelompok-binaan.detail');

            Route::get('/profil', 'profil')->name('role.advisor.profil');
            Route::post('/profil', 'updateProfile')->name('role.advisor.profil.update');
            Route::post('/profil/password', 'updatePassword')->name('role.advisor.profil.password');

            Route::get('/monitoring/absensi', 'absensi')->name('role.advisor.monitoring.absensi');
            Route::get('/monitoring/absensi/{groupId}/{tanggal}', 'absensiDetail')->name('role.advisor.monitoring.absensi.detail');
            Route::get('/monitoring/absensi/{groupId}/{tanggal}/export-pdf', 'absensiExportPdf')->name('role.advisor.monitoring.absensi.export-pdf');
            Route::get('/monitoring/absensi/{groupId}/{tanggal}/export-excel', 'absensiExportExcel')->name('role.advisor.monitoring.absensi.export-excel');
            Route::get('/monitoring/evaluasi', 'evaluasi')->name('role.advisor.monitoring.evaluasi');
            Route::get('/monitoring/evaluasi/{groupId}', 'evaluasiDetail')->name('role.advisor.monitoring.evaluasi.detail');

            Route::get('/monitoring/tugas', 'tugas')->name('role.advisor.monitoring.tugas');
            Route::get('/monitoring/tugas/{groupId}', 'tugasDetail')->name('role.advisor.monitoring.tugas.detail');
            Route::get('/monitoring/tugas/{groupId}/export-excel', 'tugasExportExcel')->name('role.advisor.monitoring.tugas.export-excel');

            Route::get('/monitoring/keaktifan', 'keaktifan')->name('role.advisor.monitoring.keaktifan');
            Route::get('/monitoring/keaktifan/{groupId}', 'keaktifanDetail')->name('role.advisor.monitoring.keaktifan.detail');

            Route::get('/monitoring/pelanggaran', 'pelanggaran')->name('role.advisor.monitoring.pelanggaran');
            Route::get('/monitoring/pelanggaran/{groupId}', 'pelanggaranDetail')->name('role.advisor.monitoring.pelanggaran.detail');
        });
    });

    //Mentor
    Route::group(['prefix' => 'mentor', 'middleware' => ['accessrole:mentor']], function () {
        Route::controller(\App\Http\Controllers\Mentor\MentorController::class)->group(function () {
            Route::get('/modul', 'modul')->name('role.mentor.modul');
            Route::get('/leaderboard', 'leaderboard')->name('role.mentor.leaderboard');
            Route::get('/info', 'info')->name('role.mentor.info');
            Route::get('/profil', 'profil')->name('role.mentor.profil');
            Route::post('/profil', 'updateProfile')->name('role.mentor.profil.update');
            Route::post('/profil/password', 'updatePassword')->name('role.mentor.profil.password');
            Route::get('/jadwal', 'jadwal')->name('role.mentor.jadwal');
            Route::get('/absensi', 'absensi')->name('role.mentor.absensi');
            Route::post('/absensi/{template}/save', 'absensiSave')->name('role.mentor.absensi.save');
            Route::post('/absensi/{template}/submit', 'absensiSubmit')->name('role.mentor.absensi.submit');
            Route::get('/evaluasi', 'evaluasi')->name('role.mentor.evaluasi');
            Route::get('/evaluasi/detail', 'evaluasiDetail')->name('role.mentor.evaluasi.detail');
            Route::get('/keaktifan', 'keaktifan')->name('role.mentor.keaktifan');
            Route::get('/monitoring-tugas', 'monitoringTugas')->name('role.mentor.monitoring-tugas');
            Route::post('/monitoring-tugas/submit', 'monitoringTugasSubmit')->name('role.mentor.monitoring-tugas.submit');
        });
    });

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
            Route::post('/evaluasi/{exam}/submit', 'evaluasiSubmit')->name('role.student.evaluasi.submit');
            Route::post('/evaluasi/{exam}/mulai', 'evaluasiMulaiAttempt')->name('role.student.evaluasi.mulai');
            Route::get('/absensi', 'absensi')->name('role.student.absensi');
        });
    });

    //Committee
    Route::group(['prefix' => 'panitia', 'middleware' => ['accessrole:committee']], function () {

        // Route::defaults() di versi Laravel ini cuma terima (key, value) satu-satu,
        // bukan array langsung — helper kecil ini yang mengulanginya.
        $withDefaults = function ($route, array $defaults) {
            foreach ($defaults as $key => $value) {
                $route->defaults($key, $value);
            }
            return $route;
        };

        // ===== Kelola Mahasiswa Baru (reuse UserController, view komite) =====
        Route::controller(\App\Http\Controllers\Admin\UserController::class)->prefix('mahasiswa-baru')->group(function () use ($withDefaults) {
            $defaults = ['roleKey' => 'STUDENT', 'title' => 'Kelola Mahasiswa Baru', 'view' => 'role.committee.mahasiswa-baru.index'];
            $withDefaults(Route::get('/', 'index')->name('committee.mahasiswa.index'), $defaults);
            $withDefaults(Route::post('/', 'store')->name('committee.mahasiswa.store'), $defaults);
            $withDefaults(Route::put('/{user}', 'update')->name('committee.mahasiswa.update'), $defaults);
            $withDefaults(Route::delete('/{user}', 'destroy')->name('committee.mahasiswa.destroy'), $defaults);
            $withDefaults(Route::get('/import/template', 'importTemplate')->name('committee.mahasiswa.import-template'), $defaults);
            $withDefaults(Route::post('/import', 'import')->name('committee.mahasiswa.import'), $defaults);
        });

        // ===== Kelola Mentor (reuse UserController, view komite) =====
        Route::controller(\App\Http\Controllers\Admin\UserController::class)->prefix('mentor')->group(function () use ($withDefaults) {
            $defaults = ['roleKey' => 'MENTOR', 'title' => 'Kelola Mentor', 'view' => 'role.committee.mentor.index'];
            $withDefaults(Route::get('/', 'index')->name('committee.mentor.index'), $defaults);
            $withDefaults(Route::post('/', 'store')->name('committee.mentor.store'), $defaults);
            $withDefaults(Route::put('/{user}', 'update')->name('committee.mentor.update'), $defaults);
            $withDefaults(Route::delete('/{user}', 'destroy')->name('committee.mentor.destroy'), $defaults);
            $withDefaults(Route::get('/import/template', 'importTemplate')->name('committee.mentor.import-template'), $defaults);
            $withDefaults(Route::post('/import', 'import')->name('committee.mentor.import'), $defaults);
        });

        // ===== Assign Tugas ke mahasiswa/kelompok (checklist di modal "Assign") =====
        Route::controller(\App\Http\Controllers\Committee\TaskAssignmentController::class)->prefix('tugas')->group(function () {
            Route::get('/{task}/assign', 'show')->name('committee.tugas.assign.show');
            Route::post('/{task}/assign', 'save')->name('committee.tugas.assign.save');
        });

        // ===== Kelola Advisor (reuse UserController, view komite) =====
        Route::controller(\App\Http\Controllers\Admin\UserController::class)->prefix('committee/advisor')->group(function () use ($withDefaults) {
            $defaults = ['roleKey' => 'ADVISOR', 'title' => 'Kelola Advisor', 'view' => 'role.committee.advisor.index'];
            $withDefaults(Route::get('/', 'index')->name('committee.advisor.index'), $defaults);
            $withDefaults(Route::post('/', 'store')->name('committee.advisor.store'), $defaults);
            $withDefaults(Route::put('/{user}', 'update')->name('committee.advisor.update'), $defaults);
            $withDefaults(Route::delete('/{user}', 'destroy')->name('committee.advisor.destroy'), $defaults);
        });

        // ===== Kelola Anggota per Kelompok (masih pakai GroupController, tapi
        // path-nya dicocokkan ke URL yang dipakai view baru: /kelompok/kelompok/{id}/anggota...) =====
        Route::controller(\App\Http\Controllers\Admin\GroupController::class)->prefix('kelompok/kelompok')->group(function () {
            Route::get('/{group}/anggota', 'anggota')->name('committee.kelompok.anggota.index');
            Route::post('/{group}/anggota', 'addMember')->name('committee.kelompok.anggota.store');
            Route::delete('/{group}/anggota/{student}', 'removeMember')->name('committee.kelompok.anggota.destroy');
            Route::post('/{group}/anggota/import', 'importMembers')->name('committee.kelompok.anggota.import');
        });

        // Halaman daftar Kelompok itu sendiri (sama seperti Admin): pakai GroupController::index()
        // supaya data kelompok+mahasiswa langsung tersedia di halaman (bukan lewat AJAX terpisah).
        $withDefaults(
            Route::get('/kelompok', [\App\Http\Controllers\Admin\GroupController::class, 'index'])->name('committee.master.index'),
            ['title' => 'Kelola Kelompok', 'view' => 'role.committee.kelompok.index']
        );

        // ===== Jadwal, Informasi, Modul PKKMB, Materi, Evaluasi, Kelompok (reuse DataMasterController, dibatasi per tipe) =====
        Route::controller(\App\Http\Controllers\Admin\DataMasterController::class)->group(function () use ($withDefaults) {
            // Import Bank Soal — WAJIB didaftarkan SEBELUM loop $sections di bawah,
            // karena loop itu bikin rute generik POST /evaluasi/{type} yang, kalau
            // didaftarkan duluan, bakal "nyamber" /evaluasi/soal-import (dianggap
            // {type} = "soal-import") sebelum sempat ke rute spesifik ini.
            Route::post('/evaluasi/soal-import', 'soalImport')->name('committee.evaluasi.soal-import');

            $sections = [
                'data-master' => ['path' => 'jadwal',      'types' => ['jadwal'],                          'title' => 'Kelola Jadwal',      'view' => 'role.committee.jadwal.index'],
                'informasi'   => ['path' => 'informasi',   'types' => ['informasi'],                       'title' => 'Kelola Informasi',   'view' => 'role.committee.informasi.index'],
                'modul-pkkmb' => ['path' => 'modul-pkkmb', 'types' => ['modul'],                            'title' => 'Kelola Modul PKKMB', 'view' => 'role.committee.modul-pkkmb.index'],
                'materi'      => ['path' => 'materi',      'types' => ['topik'],                            'title' => 'Kelola Materi',      'view' => 'role.committee.materi.index'],
                'evaluasi'    => ['path' => 'evaluasi',    'types' => ['ujian', 'kategori_evaluasi', 'soal'], 'title' => 'Kelola Evaluasi',   'view' => 'role.committee.evaluasi.index'],
                'tugas'       => ['path' => 'tugas',       'types' => ['tugas'],                            'title' => 'Kelola Tugas',       'view' => 'role.committee.tugas.index'],
                'absensi'     => ['path' => 'absensi',     'types' => ['jadwal_absensi'],                  'title' => 'Kelola Jadwal Absensi', 'view' => 'role.committee.absensi.index'],
                'master'      => ['path' => 'kelompok',    'types' => ['kelompok'],                        'title' => 'Kelola Kelompok',    'view' => 'role.committee.kelompok.index'],
            ];

            foreach ($sections as $key => $sec) {
                $defaults = ['onlyTypes' => $sec['types'], 'title' => $sec['title'], 'view' => $sec['view']];
                // 'master' (Kelompok) index-nya didaftarkan terpisah di atas (lewat GroupController) —
                // di sini cuma daftarin items/store/update/destroy-nya saja buat 'master'.
                if ($key !== 'master') {
                    $withDefaults(Route::get("/{$sec['path']}", 'index')->name("committee.{$key}.index"), $defaults);
                }
                $withDefaults(Route::get("/{$sec['path']}/{type}/items", 'items')->name("committee.{$key}.items"), $defaults);
                $withDefaults(Route::post("/{$sec['path']}/{type}", 'store')->name("committee.{$key}.store"), $defaults);
                $withDefaults(Route::put("/{$sec['path']}/{type}/{id}", 'update')->name("committee.{$key}.update"), $defaults);
                $withDefaults(Route::delete("/{$sec['path']}/{type}/{id}", 'destroy')->name("committee.{$key}.destroy"), $defaults);
                $withDefaults(Route::patch("/{$sec['path']}/{type}/{id}/toggle-publish", 'togglePublish')->name("committee.{$key}.toggle-publish"), $defaults);
                $withDefaults(Route::patch("/{$sec['path']}/{type}/{id}/toggle-important", 'toggleImportant')->name("committee.{$key}.toggle-important"), $defaults);
            }

            // Tambah 1 hari sekaligus (3 sesi fixed) khusus untuk jadwal absensi
            Route::post('/absensi-hari', 'jadwalAbsensiStoreHari')->name('committee.absensi.store-hari');
        });

        // ===== Monitoring (read-only, reuse MonitoringController & view yang sama dengan Admin —
        // view-nya otomatis mendeteksi layout Panitia/Admin sendiri) =====
        Route::controller(MonitoringController::class)->prefix('monitoring')->group(function () {
            Route::get('/laporan', 'laporan')->name('committee.monitoring.laporan');

            Route::get('/absensi', 'absensi')->name('committee.monitoring.absensi');
            Route::get('/absensi/{groupId}/{tanggal}', 'absensiDetail')->name('committee.monitoring.absensi.detail');
            Route::get('/absensi/{groupId}/{tanggal}/export-pdf', 'absensiExportPdf')->name('committee.monitoring.absensi.export-pdf');
            Route::get('/absensi/{groupId}/{tanggal}/export-excel', 'absensiExportExcel')->name('committee.monitoring.absensi.export-excel');

            Route::get('/keaktifan', 'keaktifan')->name('committee.monitoring.keaktifan');
            Route::get('/keaktifan/{groupId}', 'keaktifanDetail')->name('committee.monitoring.keaktifan.detail');

            Route::get('/pelanggaran', 'pelanggaran')->name('committee.monitoring.pelanggaran');
            Route::get('/pelanggaran/{groupId}', 'pelanggaranDetail')->name('committee.monitoring.pelanggaran.detail');

            Route::get('/evaluasi', 'evaluasi')->name('committee.monitoring.evaluasi');
            Route::get('/evaluasi/{groupId}', 'evaluasiDetail')->name('committee.monitoring.evaluasi.detail');

            Route::get('/tugas', 'tugas')->name('committee.monitoring.tugas');
            Route::get('/tugas/{groupId}', 'tugasDetail')->name('committee.monitoring.tugas.detail');
            Route::get('/tugas/{groupId}/export-excel', 'tugasExportExcel')->name('committee.monitoring.tugas.export-excel');
        });

        // ===== Profil (reuse ProfilController, view sama seperti Admin — otomatis deteksi layout) =====
        Route::controller(\App\Http\Controllers\Admin\ProfilController::class)->prefix('profil')->group(function () use ($withDefaults) {
            $defaults = ['title' => 'Profil'];
            $withDefaults(Route::get('/', 'index')->name('committee.profil.index'), $defaults);
            Route::post('/', 'updateProfile')->name('committee.profil.update');
            Route::post('/password', 'updatePassword')->name('committee.profil.password');
        });
    });
});
