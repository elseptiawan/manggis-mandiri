<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BarangController,
    AuthController,
    PelangganController,
    PenjualanController,
    PiutangController,
    PasswordController
};

Route::get('/', function () {
    return view('Page.Login.login');
})->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, "login"]);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/dashboard', [BarangController::class, "index"])->name('dashboard')->middleware('auth');

Route::group(['prefix' => '/barang','middleware' => ['auth']], function() {
    Route::get('/read',[BarangController::class, "read"]);
    Route::get('/create',[BarangController::class, "create"]);
    Route::post('/store',[BarangController::class, "store"]);
    Route::get('/edit/{id}',[BarangController::class, "edit"]);
    Route::put('/update/{id}',[BarangController::class, "update"]);
    Route::delete('/destroy/{id}',[BarangController::class, "destroy"]);
});

Route::group(['prefix' => '/pelanggan','middleware' => ['auth']], function() {
    Route::get('/',[PelangganController::class, "index"]);
    Route::get('/read',[PelangganController::class, "read"]);
    Route::get('/create',[PelangganController::class, "create"]);
    Route::post('/store',[PelangganController::class, "store"]);
    Route::get('/edit/{id}',[PelangganController::class, "edit"]);
    Route::put('/update/{id}',[PelangganController::class, "update"]);
    Route::delete('/destroy/{id}',[PelangganController::class, "destroy"]);
});

Route::group(['prefix' => '/penjualan','middleware' => ['auth']], function() {
    Route::get('/',[PenjualanController::class, "index"]);
    Route::get('/read',[PenjualanController::class, "read"]);
    Route::get('/create',[PenjualanController::class, "create"]);
    Route::post('/store',[PenjualanController::class, "store"]);
    Route::get('/edit/{id}',[PenjualanController::class, "edit"]);
    Route::put('/update/{id}',[PenjualanController::class, "update"]);
    Route::delete('/destroy/{id}',[PenjualanController::class, "destroy"]);
});

Route::group(['prefix' => '/piutang','middleware' => ['auth']], function() {
    Route::get('/',[PiutangController::class, "index"]);
    Route::get('/read',[PiutangController::class, "read"]);
    Route::get('/create',[PiutangController::class, "create"]);
    Route::post('/store',[PiutangController::class, "store"]);
    Route::get('/edit/{id}',[PiutangController::class, "edit"]);
    Route::put('/update/{id}',[PiutangController::class, "update"]);
    Route::delete('/destroy/{id}',[PiutangController::class, "destroy"]);
});

Route::group(['prefix' => '/password','middleware' => ['auth']], function() {
    Route::get('/',[PasswordController::class, "index"])->name('password');
    // Route::get('/read',[PasswordController::class, "read"]);
    // Route::get('/create',[PasswordController::class, "create"]);
    // Route::post('/store',[PasswordController::class, "store"]);
    // Route::get('/edit/{id}',[PasswordController::class, "edit"]);
    Route::post('/update',[PasswordController::class, "update"]);
});
