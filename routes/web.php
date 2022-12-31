<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\QueryContrller;
use App\Http\Controllers\FruitController;

Route::get('/', function () {
    return view('welcome');
});

// テスト用のコントローラ ajaxとかやるんだろう
Route::group(['prefix' => '/sample', 'as' => 'topics.'], function() {
    Route::get('/', [HelloController::class, 'index'])->name('index');
    Route::post('/', [HelloController::class, 'index'])->name('index');
    Route::get('/getDataAsync', [HelloController::class, 'getDataAsync'])->name('getDataAsync');
    Route::get('/getDataAsyncDetail', [HelloController::class, 'getDataAsyncDetail'])->name('getDataAsyncDetail');
    Route::post('/getDataAsyncDetail', [HelloController::class, 'getDataAsyncDetail'])->name('getDataAsyncDetail');
});

Route::group(['prefix' => '/query', 'as' => 'query.'], function () {
    Route::get('/', [QueryContrller::class, 'index'])->name('index');
    Route::post('/', [QueryContrller::class, 'index'])->name('index');
    Route::get('/vegetable', [QueryContrller::class, 'vegetableIndex'])->name('vegetableIndex');
    Route::post('/store', [QueryContrller::class, 'store'])->name('store');
});

Route::group(['prefix' => '/fruit', 'as' => 'fruit.'], function (){
    Route::match(['get', 'post'], '/', [FruitController::class, 'index'])->name('index');
    Route::post('/export_csv', [FruitController::class, 'export_csv'])->name('export_csv');
    Route::get('/create', [FruitController::class, 'create'])->name('create');
    Route::post('/get_breed', [FruitController::class, 'get_breed'])->name('get_breed');
    Route::post('/create_confirm', [FruitController::class, 'create_confirm'])->name('create_confirm');
    Route::post('/store', [FruitController::class, 'store'])->name('store');
    Route::get('/edit', [FruitController::class, 'edit'])->name('edit');
    Route::post('/update', [FruitController::class, 'update'])->name('update');
    Route::post('/delete', [FruitController::class, 'destroy'])->name('destroy');
});
