<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;



Route::get('/',[AuthController::class,'homePage'])->name('home');
Route::get('register',[AuthController::class,'index']);
Route::post('register',[AuthController::class,'store'])->name('register');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'loginPage']);
    Route::post('login', [AuthController::class, 'login'])->name('login');
});


Route::middleware('auth')->group(function(){
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    Route::post('logout',[AuthController::class,'logout'])->name('logout');    

    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
});
