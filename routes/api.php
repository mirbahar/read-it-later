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
    Route::post('hashTag', [ContentController::class, 'getContentByHashTag']);
    Route::resource('contents',ContentController::class);



    /*Route::resource('pockets', PocketController::class);
    Route::delete('contents', [ContentController::class, 'destroy']);
    Route::resource('contents',ContentController::class);*/
});

/*Route::group(['prefix' => 'v1/contents'], function () {

    Route::get('contents', [PocketController::class, 'index']);
    Route::post('contents', [PocketController::class, 'store']);
    Route::get('contents/{content}', [PocketController::class, 'show']);
    Route::put('contents/{content}', [PocketController::class, 'update']);
    Route::delete('contents/{content}', [PocketController::class, 'destroy']);
});*/