<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\PocketController;

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

Route::group(['prefix' => 'v1'], function () {

    Route::resource('pockets', PocketController::class);
    Route::resource('contents',ContentController::class);
});