<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
// use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProfileController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::middleware('auth')->group(function(){
// } );

Route::group(['middleware' => ['role:admin', 'auth']], function () {
    Route::get('admin/index', [AdminController::class, 'index'])->name('admin/index');
    Route::get('user/create', [UserController::class, 'create'])->name('user/create');
    Route::post('user/store', [UserController::class, 'store'])->name('user/store');
});

Route::group(['middleware' => ['role:user', 'auth']], function () {
    Route::get('user/index', [UserController::class, 'index'])->name('user/index');
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('profile/update/{id}', [ProfileController::class, 'update'])->name('profile/update');
    Route::post('profile/password/forgot/{id}', [ProfileController::class, 'forgot'])->name('profile/password/forgot');
});



  