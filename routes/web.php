<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\ProfileController as AdminProfile;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ExpensesController;
use App\Http\Controllers\User\IncomeController;
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::group(['middleware' => ['role:admin', 'auth']], function () {
    Route::get('admin/index', [AdminController::class, 'index'])->name('admin/index');
    Route::get('user/create', [AdminUser::class, 'create'])->name('user/create');
    Route::post('user/store', [AdminUser::class, 'store'])->name('user/store');
    Route::get('user/delete/{id}', [AdminUser::class, 'delete'])->name('user/delete');
    Route::get('profile/index', [AdminProfile::class, 'index'])->name('profile/index');
    Route::post('profile/store/{id}', [AdminProfile::class, 'update'])->name('profile/store');
    Route::post('profile/password/{id}', [AdminProfile::class, 'password'])->name('profile/password');
});
Route::group(['middleware' => ['role:user', 'auth']], function () {
    Route::get('user/index', [UserController::class, 'index'])->name('user/index');
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('profile/update/{id}', [ProfileController::class, 'update'])->name('profile/update');
    Route::post('profile/password/forgot/{id}', [ProfileController::class, 'forgot'])->name('profile/password/forgot');
    Route::get('expense/index', [ExpensesController::class, 'index'])->name('expense/index');
    Route::get('expense/create', [ExpensesController::class, 'create'])->name('expense/create');
    Route::post('expense/store', [ExpensesController::class, 'store'])->name('expense/store');
    Route::get('expense/edit/{id}', [ExpensesController::class, 'edit'])->name('expense/edit');
    Route::get('expense/delete/{id}', [ExpensesController::class, 'delete'])->name('expense/delete');
    Route::post('expense/update/{id}', [ExpensesController::class, 'update'])->name('expense/update');
    Route::get('income/index', [IncomeController::class, 'index'])->name('income/index');
    Route::get('income/create', [IncomeController::class, 'create'])->name('income/create');
    Route::post('income/store', [IncomeController::class, 'store'])->name('income/store');


});




  