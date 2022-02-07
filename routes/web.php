<?php

use App\Http\Controllers\GroupModuleController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[MainController::class,'index'])->name('index');
Route::post('/',[MainController::class,'login'])->name('login');

Route::group(['middleware' => ['authCheck']],function(){
    Route::get('/home',[MainController::class,'home'])->name('home');
    Route::get('/logout',[MainController::class,'logout'])->name('logout');
    Route::get('ubahpassword', [MainController::class, 'ubahPassword'])->name('ubahpassword');
    Route::post('ubahpassword', [MainController::class, 'changePassword'])->name('changepassword');

    Route::prefix('groupuser')->group(function () {
        Route::get('/', [GroupUserController::class, 'index'])->name('groupuser.index');
        Route::get('/create', [GroupUserController::class, 'create'])->name('groupuser.create');
        Route::post('/create', [GroupUserController::class, 'store'])->name('groupuser.store');
        Route::get('/edit/{id}', [GroupUserController::class, 'edit'])->name('groupuser.edit');
        Route::post('/edit/{id}', [GroupUserController::class, 'update'])->name('groupuser.update');
        Route::get('/delete/{id}', [GroupUserController::class, 'delete'])->name('groupuser.delete');
        Route::post('/delete/{id}', [GroupUserController::class, 'destroy'])->name('groupuser.destroy');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/create', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/edit/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
        Route::post('/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::prefix('groupmodule')->group(function () {
        Route::get('/', [GroupModuleController::class, 'index'])->name('groupmodule.index');
        Route::get('/create', [GroupModuleController::class, 'create'])->name('groupmodule.create');
        Route::post('/create', [GroupModuleController::class, 'store'])->name('groupmodule.store');
        Route::get('/edit/{id}', [GroupModuleController::class, 'edit'])->name('groupmodule.edit');
        Route::post('/edit/{id}', [GroupModuleController::class, 'update'])->name('groupmodule.update');
        Route::get('/delete/{id}', [GroupModuleController::class, 'delete'])->name('groupmodule.delete');
        Route::post('/delete/{id}', [GroupModuleController::class, 'destroy'])->name('groupmodule.destroy');
    });

    Route::prefix('module')->group(function () {
        Route::get('/', [ModuleController::class, 'index'])->name('module.index');
        Route::get('/create', [ModuleController::class, 'create'])->name('module.create');
        Route::post('/create', [ModuleController::class, 'store'])->name('module.store');
        Route::get('/edit/{id}', [ModuleController::class, 'edit'])->name('module.edit');
        Route::post('/edit/{id}', [ModuleController::class, 'update'])->name('module.update');
        Route::get('/delete/{id}', [ModuleController::class, 'delete'])->name('module.delete');
        Route::post('/delete/{id}', [ModuleController::class, 'destroy'])->name('module.destroy');
    });
});


