<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\QueryContrller;
use App\Http\Controllers\FruitController;
use App\Http\Controllers\MeatController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\LoginController;

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
    Route::post('/export_csv',  [FruitController::class, 'export_csv'])->name('export_csv');
    Route::get('/create', [FruitController::class, 'create'])->name('create');
    Route::post('/get_breed', [FruitController::class, 'get_breed'])->name('get_breed');
    Route::post('/create_confirm', [FruitController::class, 'create_confirm'])->name('create_confirm');
    Route::post('/store', [FruitController::class, 'store'])->name('store');
    Route::get('/edit', [FruitController::class, 'edit'])->name('edit');
    Route::post('/update', [FruitController::class, 'update'])->name('update');
    Route::post('/delete', [FruitController::class, 'destroy'])->name('destroy');
    Route::get('/pull_down', [FruitController::class, 'pull_down'])->name('pull_down');
});

Route::group(['prefix' => '/meat', 'as' => 'meat.'], function (){
    Route::match(['get', 'meat'], '/', [MeatController::class, 'index'])->name('index');
    Route::get('/create', [MeatController::class, 'create'])->name('create');
    Route::post('/get_selects', [MeatController::class, 'getSelects'])->name('get_selects');
    Route::post('/create_confirm', [MeatController::class, 'create_confirm'])->name('create_confirm');
    Route::post('/export_csv',  [MeatController::class, 'export_csv'])->name('export_csv');
});

Route::group(['prefix' => '/food', 'as' => 'food.'], function () {
   Route::match(['get', 'post'], '/', [FoodController::class, 'index'])->name('index');
});

Route::group(['prefix' => 'login', 'as' => 'login.'], function () {
   Route::get('/', [LoginController::class, 'showLogin'])->name('show_login');
   Route::post('/', [LoginController::class, 'authenticate'])->name('authenticate');
});

// 認証
Route::group(['middleware' => 'auth'], function () {
    Route::get('/after_login', [LoginController::class, 'afterLogin'])->name('after_login');
});


