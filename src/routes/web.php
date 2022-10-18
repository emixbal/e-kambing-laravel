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

Route::prefix('users')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users')->middleware('isSuperadmin');
    
    Route::get('/new', [App\Http\Controllers\UserController::class, 'create'])->name('users_create')->middleware('isSuperadmin');
    Route::post('/new', [App\Http\Controllers\UserController::class, 'store'])->name('users_store')->middleware('isSuperadmin');

    Route::get('/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users_show')->middleware('isSuperadmin');

    Route::put('/{id}/disable', [App\Http\Controllers\UserController::class, 'disableToggle'])->name('users_disable')->middleware('isSuperadmin');

    Route::get('/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users_edit')->middleware('isSuperadmin');
    Route::post('/{id}/update', [App\Http\Controllers\UserController::class, 'update'])->name('users_update')->middleware('isSuperadmin');
});

Route::group(['prefix' => 'units', 'middleware' => ['isAdmin']], function(){
    Route::get('/', [App\Http\Controllers\UnitController::class, 'index'])->name('units');
    Route::get('/new', [App\Http\Controllers\UnitController::class, 'create'])->name('units_create');
    Route::post('/new', [App\Http\Controllers\UnitController::class, 'store'])->name('units_store');

    Route::get('/{id}/edit', [App\Http\Controllers\UnitController::class, 'edit'])->name('units_edit');
    Route::post('/{id}/edit', [App\Http\Controllers\UnitController::class, 'update'])->name('units_update');
});

Route::group(['prefix' => 'dev', 'middleware' => ['isAdmin']], function(){
    Route::get('/{take}', [App\Http\Controllers\DeveloperController::class, 'fetchAnggotas'])->name('fetchAnggotas');
});

Route::group(['prefix' => 'kambings'], function(){
    Route::get('/', [App\Http\Controllers\DeveloperController::class, 'fetchAnggotas'])->name('fetchAnggotas');
});