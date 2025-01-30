<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Products\ProductController;
use App\Http\Controllers\Api\Sales\SaleController;
use App\Models\SaleProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'loginUser']);
    Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('product')->group(function () {
        Route::get('/list', [ProductController::class, 'list']);
        Route::get('/show/{id}', [ProductController::class, 'show']);
        Route::post('/register', [ProductController::class, 'create']);
        Route::put('/edit', [ProductController::class, 'update']);
        Route::delete('/delete/{id}', [ProductController::class, 'destroy']);
        Route::get('/report-top', [ProductController::class, 'report']);
    });

    Route::prefix('sale')->group(function () {
        Route::get('/list', [SaleController::class, 'list']);
        Route::post('/register', [SaleController::class, 'create']);
        Route::get('/show/{id}', [SaleController::class, 'show']);
        Route::get('/report', [SaleController::class, 'report']);
    });
});

