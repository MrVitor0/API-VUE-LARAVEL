<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
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
     /**
     * @method POST
     * @param Request $request
     * @expects {int: id, string: desname, string: desemail, string: desdocument, string: dtbirth, string: descep, string: descidade, string: desbairro, string: deslogradouro, string: descomplemento, string: desnumero}
     * @return \Illuminate\Http\JsonResponse
    */
    Route::post('/create', [UserController::class, 'create']);
    /**
     * @method GET
     * @param Request $request
     * @expects {id, desname, desemail, desdocument, dtbirth, descep, descidade, desbairro, deslogradouro, descomplemento, desnumero}
     * @return \Illuminate\Http\JsonResponse
    */
    Route::get('/list', [UserController::class, 'list']);
     /**
     * @method DELETE
     * @param Request $request
     * @expects {integer: id}
     * @return \Illuminate\Http\JsonResponse
    */
    Route::delete('/delete/{id}', [UserController::class, 'delete']);
});
/**
 * @author : Vitor Hugo
 * @date : 22-09-2022
*/
Route::group(['prefix' => 'product'], function () {
    /**
     * @method POST
     * @param Request $request
     * @expects {string: desname, string: desprice}
     * @return \Illuminate\Http\JsonResponse
    */
    Route::post('/create', [ProductController::class, 'create']);
    /**
     * @method GET
     * @param Request $request
     * @expects {desname, desprice}
     * @return \Illuminate\Http\JsonResponse
    */
    Route::get('/list', [ProductController::class, 'list']);
    /**
     * @method DELETE
     * @param Request $request
     * @expects {integer: id}
     * @return \Illuminate\Http\JsonResponse
    */
    Route::delete('/delete/{id}', [ProductController::class, 'delete']);
});
/**
 * @author : Vitor Hugo
 * @date : 23-09-2022
*/
Route::group(['prefix' => 'sell'], function () {
    /**
     * @method POST
     * @param Request $request
     * @expects {integer: idclient, string: desproducts}
     * @return \Illuminate\Http\JsonResponse
    */
    Route::post('/create', [SellController::class, 'create']);
    /**
     * @method GET
     * @param Request $request
     * @expects {null}
     * @return \Illuminate\Http\JsonResponse
    */
    Route::get('/list', [SellController::class, 'list']);
    /**
     * @method DELETE
     * @param Request $request
     * @expects {integer: id}
     * @return \Illuminate\Http\JsonResponse
    */
    Route::delete('/delete/{id}', [SellController::class, 'delete']);
});
