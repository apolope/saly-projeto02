<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;

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

Route::group(['middeware' => 'web'], function(){
    Auth::routes();

    Route::get('/',  [App\Http\Controllers\HomeController::class, 'index']);

    Route::prefix('books')->group(function () {
        Route::get('/', [App\Http\Controllers\BooksController::class, 'index']);
        Route::get('/create', [App\Http\Controllers\BooksController::class, 'create']);
        Route::post('/store', [App\Http\Controllers\BooksController::class, 'store']);
        Route::get('/edit/{id}', [App\Http\Controllers\BooksController::class, 'edit']);
        Route::post('/update/{id}', [App\Http\Controllers\BooksController::class, 'update']);
        Route::delete('/delete/{id}', [App\Http\Controllers\BooksController::class, 'destroy']);
    });

    Route::prefix('lends')->group(function () {
        Route::get('/', [App\Http\Controllers\LendsController::class, 'index']);
        Route::get('/returned', [App\Http\Controllers\LendsController::class, 'returned']);
        Route::post('/devolution/{id}', [App\Http\Controllers\LendsController::class, 'devolution']);
        Route::get('/create', [App\Http\Controllers\LendsController::class, 'create']);
        Route::post('/store', [App\Http\Controllers\LendsController::class, 'store']);
        Route::delete('/delete/{id}', [App\Http\Controllers\LendsController::class, 'destroy']);
    });
});
