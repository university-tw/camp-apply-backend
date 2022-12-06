<?php

use App\Http\Controllers\ApplyController;
use App\Http\Controllers\AuthController;
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

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::post('/apply', [ApplyController::class, 'store'])->middleware('auth:sanctum');

Route::prefix('info')->group(function () {
    Route::get('/camp/{camp}', function (\App\Models\Camp $camp) {
        return $camp->load('times');
    });
});

Route::middleware('auth:sanctum')->prefix('/me')->group(function () {
    // check if user applied a camp
    Route::get('/applied/{camp}', function (\App\Models\Camp $camp) {
        return $camp->applies()->where('user_id', auth()->user()->id)->exists();
    });
});
