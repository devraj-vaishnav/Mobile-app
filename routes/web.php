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
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\SaleController;

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::group(['middleware' => ['role:admin', 'auth']], function () {
    Route::get('admin/index', [AdminController::class, 'index'])->name('admin/index');
    Route::get('admin/getData', [AdminController::class, 'getData'])->name('admin/getData');
    Route::get('user/create', [AdminUser::class, 'create'])->name('user/create');
    Route::post('user/store', [AdminUser::class, 'store'])->name('user/store');
    Route::delete('user/delete/{id}', [AdminUser::class, 'destory'])->name('user/delete');
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
    Route::delete('expense/delete/{id}', [ExpensesController::class, 'destory'])->name('expense/delete');
    Route::post('expense/update/{id}', [ExpensesController::class, 'update'])->name('expense/update');
    Route::get('expense/getData', [ExpensesController::class, 'getData'])->name('expense/getData');
    Route::get('income/index', [IncomeController::class, 'index'])->name('income/index');
    Route::get('income/create', [IncomeController::class, 'create'])->name('income/create');
    Route::post('income/store', [IncomeController::class, 'store'])->name('income/store');
    Route::delete('income/delete/{id}', [IncomeController::class, 'destory'])->name('income/delete');
    Route::get('income/edit/{id}', [IncomeController::class, 'edit'])->name('income/edit');
    Route::post('income/update/{id}', [IncomeController::class, 'update'])->name('income/update');
    Route::get('income/getData', [IncomeController::class, 'getData'])->name('income/getData');

    // category 
    Route::get('category/index', [CategoryController::class, 'index'])->name('category/index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category/create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category/store');
    Route::get('category/getData', [CategoryController::class, 'getData'])->name('category/getData');
    Route::delete('category/delete/{id}', [CategoryController::class, 'destory'])->name('category/delete');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category/edit');
    Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category/update');

    // Product
    Route::get('product/index', [ProductController::class, 'index'])->name('product/index');
    Route::get('product/create', [ProductController::class, 'create'])->name('product/create');
    Route::post('product/store', [ProductController::class, 'store'])->name('product/store');
    Route::get('product/getData', [ProductController::class, 'getData'])->name('product/getData');
    Route::delete('product/delete/{id}', [ProductController::class, 'destory'])->name('product/delete');
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product/edit');
    Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product/update');
    
    // sale
    Route::get('sale/index', [SaleController::class, 'index'])->name('sale/index');
    Route::get('sale/create', [SaleController::class, 'create'])->name('sale/create');
    Route::get('sale/getData', [SaleController::class, 'getData'])->name('sale/getData');
    Route::post('sale/store', [SaleController::class, 'store'])->name('sale/store');
    Route::get('sale/findData', [SaleController::class, 'findData'])->name('sale/findData');
    Route::get('sale/edit/{id}', [SaleController::class, 'edit'])->name('sale/edit');
    Route::delete('sale/delete/{id}', [SaleController::class, 'destory'])->name('sale/delete');
    Route::post('sale/update/{id}', [SaleController::class, 'update'])->name('sale/update');
    Route::delete('sale/orderDelete/{id}', [SaleController::class, 'orderdestory'])->name('sale/orderDelete');
});




  