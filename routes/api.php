<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 * @author : Vitor Hugo
 * @date : 22-09-2022
*/
Route::group(['prefix' => 'client'], function () {
    Route::post('/create', [UserController::class, 'create']);
    Route::get('/list', [UserController::class, 'list']);
    Route::delete('/delete/{id}', [UserController::class, 'delete']);
});

/**
 * @author : Vitor Hugo
 * @date : 22-09-2022
*/
Route::group(['prefix' => 'product'], function () {
    Route::post('/create', [ProductController::class, 'create']);
    Route::get('/list', [ProductController::class, 'list']);
    Route::delete('/delete/{id}', [ProductController::class, 'delete']);
});

