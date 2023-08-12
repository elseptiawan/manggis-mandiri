<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    AuthController
};

Route::get('/', function () {
    return view('Page.Login.login');
})->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, "login"]);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/dashboard', [HomeController::class, "index"])->name('dashboard')->middleware('auth');
