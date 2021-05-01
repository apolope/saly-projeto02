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

Route::group(['middeware' => 'web'], function(){
    Route::get('/',  [App\Http\Controllers\HomeController::class, 'index']);

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

    Route::prefix('books')->group(function () {
        Route::get('/', [App\Http\Controllers\BooksController::class, 'index']);
        Route::get('/create', [App\Http\Controllers\BooksController::class, 'create']);
        Route::post('/store', [App\Http\Controllers\BooksController::class, 'store']);
    });

});




