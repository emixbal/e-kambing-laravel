<?php

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('homeController');


Route::prefix('users')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users')->middleware('isSuperadmin');
    
    Route::get('/new', [App\Http\Controllers\UserController::class, 'create'])->name('users_create')->middleware('isSuperadmin');
    Route::post('/new', [App\Http\Controllers\UserController::class, 'store'])->name('users_store')->middleware('isSuperadmin');

    Route::get('/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users_show')->middleware('isSuperadmin');

    Route::put('/{id}/disable', [App\Http\Controllers\UserController::class, 'disableToggle'])->name('users_disable')->middleware('isSuperadmin');

    Route::get('/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users_edit')->middleware('isSuperadmin');
    Route::post('/{id}/update', [App\Http\Controllers\UserController::class, 'update'])->name('users_update')->middleware('isSuperadmin');
});

Route::group(['prefix' => 'dev', 'middleware' => ['isAdmin']], function(){
    Route::get('/{take}', [App\Http\Controllers\DeveloperController::class, 'fetchAnggotas'])->name('fetchAnggotas');
});

Route::group(['prefix' => 'kandangs', 'middleware' => ['auth']], function(){
    Route::get('/', [App\Http\Controllers\KandangController::class, 'index'])->name('listKandang');
    Route::get('/{id}', [App\Http\Controllers\KandangController::class, 'detail'])->name('kandangDetail');
});

Route::group(['prefix' => 'kambings'], function(){
    Route::get('/search', [App\Http\Controllers\KambingController::class, 'searchForm'])->name('kambingSearchForm');
    Route::get('/{id}/public', [App\Http\Controllers\KambingController::class, 'detailPublic'])->name('kambingDetailPublic');
    Route::get('/{id}/check', [App\Http\Controllers\KambingController::class, 'check'])->name('kambingCheck');
    
    Route::group(['middleware' => ['auth']], function(){
        Route::get('/', [App\Http\Controllers\KambingController::class, 'index'])->name('kambingIndex');
        Route::get('/new', [App\Http\Controllers\KambingController::class, 'index'])->name('kambingNew');
        Route::get('/{id}', [App\Http\Controllers\KambingController::class, 'detail'])->name('kambingDetail');

        Route::post('/add-medicine', [App\Http\Controllers\KambingController::class, 'addMedicineSave']);
    });
});