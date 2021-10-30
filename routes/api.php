<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/client', [ClientController::class, 'index']);
// Route::middleware('auth:sanctum')->group(function(){
//     Route::apiResource('client', ClientController::class);

// });
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout',[AuthController::class,'logout']);
});

Route::post('/register',[AuthController::class,'register']);

Route::apiResource('client', ClientController::class);

