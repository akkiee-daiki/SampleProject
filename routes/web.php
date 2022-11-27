<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;

Route::get('/', function () {
    return view('welcome');
});

// テスト用のコントローラ ajaxとかやるんだろう
Route::group(['prefix' => '/sample', 'as' => 'topics.'], function() {
    Route::get('/', [HelloController::class, 'index'])->name('index');
    Route::get('/getDataAsync', [HelloController::class, 'getDataAsync'])->name('getDataAsync');
    Route::post('/getDataAsync', [HelloController::class, 'getDataAsync'])->name('getDataAsync');
    Route::get('/getDataAsyncDetail', [HelloController::class, 'getDataAsyncDetail'])->name('getDataAsyncDetail');
    Route::post('/getDataAsyncDetail', [HelloController::class, 'getDataAsyncDetail'])->name('getDataAsyncDetail');
});
