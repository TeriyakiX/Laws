<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CurrenciesController;
use App\Http\Controllers\Admin\BeliefsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/admin', function () {
//    return view('admin');
//});
Route::middleware(['admin'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin');

        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'userIndex'])->name('admin.user.index');
        //    Route::get('/user/create', [UserController::class, 'Create'])->name('admin.user.create');
            Route::get('/update/form', [UserController::class, 'UpdateForm'])->name('admin.user.update');
            Route::post('/update', [UserController::class, 'Update'])->name('user.update');
            Route::get('/delete', [UserController::class, 'Delete'])->name('admin.user.delete');
            Route::get('/ban/form', [UserController::class, 'BanForm'])->name('admin.user.ban');
            Route::post('/ban', [UserController::class, 'Ban'])->name('user.ban');
            Route::get('/unban', [UserController::class, 'UnBan'])->name('admin.user.unban');
        });

        Route::prefix('currencies')->group(function () {
            Route::get('/', [CurrenciesController::class, 'index'])->name('admin.curs.index');
            Route::get('/update/form', [CurrenciesController::class, 'updateForm'])->name('admin.curs.update');
            Route::post('/update', [CurrenciesController::class, 'update'])->name('curs.update');
            Route::get('/create/form', [CurrenciesController::class, 'createForm'])->name('admin.curs.create');
            Route::post('/create', [CurrenciesController::class, 'create'])->name('curs.create');
            Route::get('/delete', [CurrenciesController::class, 'delete'])->name('admin.curs.delete');
        });

        Route::prefix('beliefs')->group(function () {
            Route::get('/', [BeliefsController::class, 'index'])->name('admin.bel.index');
            Route::get('/update/form', [BeliefsController::class, 'updateForm'])->name('admin.bel.update');
            Route::post('/update', [BeliefsController::class, 'update'])->name('bel.update');
            Route::get('/create/form', [BeliefsController::class, 'createForm'])->name('admin.bel.create');
            Route::post('/create', [BeliefsController::class, 'create'])->name('bel.create');
            Route::get('/delete', [BeliefsController::class, 'delete'])->name('admin.bel.delete');
        });
    });
});


