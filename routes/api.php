<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cache', function () {
    return response()
        ->json(Carbon::now()->timezone('asia/taipei')->format('Y-m-d H:i:s'))
        ->setCache(['max_age' => 60]);
});

Route::get('/no-cache', function () {
    return response()->json(Carbon::now()->timezone('asia/taipei')->format('Y-m-d H:i:s'));
});
