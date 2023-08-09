<?php

use App\Http\Controllers\AuthController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

request()->headers->set('Accept', 'application/json');

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::any('/cache', function () {
        return response()
            ->json(Carbon::now()->timezone('asia/taipei')->format('Y-m-d H:i:s'));
    })->middleware('cache.one-minute:60');

    Route::any('/no-cache', function () {
        return response()->json(Carbon::now()->timezone('asia/taipei')->format('Y-m-d H:i:s'));
    });
});
