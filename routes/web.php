<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    AuthController
};

Route::get('/', function () {
    return view('Page.Login.login');
});
Route::post('/login', [AuthController::class, "login"]);
Route::get('/dashboard', [HomeController::class, "index"]);
