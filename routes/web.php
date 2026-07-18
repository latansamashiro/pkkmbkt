<?php

/* -------------------------------------
Terdapat 5 Roles:
- super-admin
- advisor (pembimbing)
- mentor
- student (mahasiswa)
- committee (panitia)
---------------------------------------*/

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
    });

    //Advisor

    //Mentor

    //Student

    //Committee
});
