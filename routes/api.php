<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\PotionController;
use App\Http\Controllers\SaleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::post('potion/add/{id}', [PotionController::class,'add'])->name('potion.add');
});
//ruta para registrarse 
Route::post('/register',[AuthController::class,'register'])->name('register');

Route::apiResource('client', ClientController::class);
Route::apiResource('ingredient', IngredientController::class);
Route::apiResource('potion', PotionController::class);
Route::apiResource('sale', SaleController::class);





