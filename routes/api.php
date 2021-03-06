<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\CategoryController;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::prefix('/v1')->group(function () {
    Route::apiResources(['apartments' => ApartmentController::class], ['names' => 'api.v1.apartments']);
    Route::apiResources(['categories' => CategoryController::class], ['names' => 'api.v1.categories']);
});

