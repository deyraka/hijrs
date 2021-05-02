<?php

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MstrSatkerController;
use App\Http\Controllers\MstrUkerController;

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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::group(['prefix'=>'v1'], function(){
    Route::post('/login', [UserController::class,'login']);
    Route::post('/register', [UserController::class,'register']);
    // Route::get('/logout', [UserController::class,'logout'])->middleware('auth:api');
    /* routes for accessing master satker only*/
    /* Route::apiResource('/satker', MstrSatkerController::class)->middleware('auth:api'); */
    
    /* routes for accessing apiResources with many controller*/
    Route::middleware(['auth:api'])->group(function () {
        Route::get('/logout', [UserController::class,'logout'])->middleware('auth:api');
        Route::apiResources([
            '/satker' => MstrSatkerController::class,
            '/uker' => MstrUkerController::class,
        ]);
    });
});
