<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BarangController,
    AuthController,
    PelangganController,
    PenjualanController,
    PiutangController,
    PasswordController,
    LaporanController,
    KaryawanController
};

Route::get('/', function () {
    return view('Page.Login.login');
})->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, "login"]);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/dashboard', [BarangController::class, "index"])->name('dashboard')->middleware(['auth', 'role:administrasi,pemiliktoko,pelayantoko,gudang']);

Route::group(['prefix' => '/barang','middleware' => ['auth', 'role:administrasi,pemiliktoko,pelayantoko,gudang']], function() {
    Route::get('/read-barang-masuk',[BarangController::class, "readbarangmasuk"]);
    Route::get('/read-barang-keluar',[BarangController::class, "readbarangkeluar"]);
    Route::get('/read-stok-barang',[BarangController::class, "readstokbarang"]);
    Route::get('/create',[BarangController::class, "create"]);
    Route::post('/store',[BarangController::class, "store"]);
    Route::get('/edit-barang-masuk/{id}',[BarangController::class, "editbarangmasuk"]);
    Route::get('/edit-stok-barang/{id}',[BarangController::class, "editstokbarang"]);
    Route::put('/update-barang-masuk/{id}',[BarangController::class, "updateBarangMasuk"]);
    Route::put('/update-stok-barang/{id}',[BarangController::class, "updateStokBarang"]);
    Route::delete('/destroy/{id}',[BarangController::class, "destroy"]);
});

Route::group(['prefix' => '/pelanggan','middleware' => ['auth', 'role:administrasi,pemiliktoko,pelayantoko']], function() {
    Route::get('/',[PelangganController::class, "index"]);
    Route::get('/read',[PelangganController::class, "read"]);
    Route::get('/create',[PelangganController::class, "create"]);
    Route::post('/store',[PelangganController::class, "store"]);
    Route::get('/edit/{id}',[PelangganController::class, "edit"]);
    Route::put('/update/{id}',[PelangganController::class, "update"]);
    Route::delete('/destroy/{id}',[PelangganController::class, "destroy"]);
});

Route::group(['prefix' => '/penjualan','middleware' => ['auth', 'role:administrasi,pemiliktoko,pelayantoko']], function() {
    Route::get('/',[PenjualanController::class, "index"]);
    Route::get('/read',[PenjualanController::class, "read"]);
    Route::get('/create',[PenjualanController::class, "create"]);
    Route::post('/store',[PenjualanController::class, "store"]);
    Route::get('/edit/{id}',[PenjualanController::class, "edit"]);
    Route::post('/update/{id}',[PenjualanController::class, "update"]);
    Route::delete('/destroy/{id}',[PenjualanController::class, "destroy"]);
});

Route::group(['prefix' => '/piutang','middleware' => ['auth', 'role:administrasi,pemiliktoko,pelayantoko,pelanggan']], function() {
    Route::get('/',[PiutangController::class, "index"])->name('piutang');
    Route::get('/read',[PiutangController::class, "read"]);
    Route::get('/create',[PiutangController::class, "create"]);
    Route::get('/get-sisa-hutang/{id}',[PiutangController::class, "getSisaHutang"]);
    Route::post('/store',[PiutangController::class, "store"]);
    Route::get('/edit/{id}',[PiutangController::class, "edit"]);
    Route::post('/update/{id}',[PiutangController::class, "update"]);
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

Route::group(['prefix' => '/laporan','middleware' => ['auth', 'role:administrasi,pemiliktoko']], function() {
    Route::get('/',[LaporanController::class, "index"]);
    Route::get('/piutang',[LaporanController::class, "readpiutang"]);
    Route::get('/piutang/{id}',[LaporanController::class, "detailpiutang"]);
    Route::get('/rincian-hutang/{id}',[LaporanController::class, "rincianHutang"])->name('rincianHutang');
    Route::get('/barang-masuk',[LaporanController::class, "readbarangmasuk"]);
    Route::get('/barang-keluar',[LaporanController::class, "readbarangkeluar"]);
});

Route::group(['prefix' => '/karyawan','middleware' => ['auth', 'role:administrasi,pemiliktoko']], function() {
    Route::get('/',[KaryawanController::class, "index"]);
    Route::get('/read',[KaryawanController::class, "read"]);
    Route::get('/create',[KaryawanController::class, "create"]);
    Route::post('/store',[KaryawanController::class, "store"]);
    Route::get('/edit/{id}',[KaryawanController::class, "edit"]);
    Route::put('/update/{id}',[KaryawanController::class, "update"]);
    Route::delete('/destroy/{id}',[KaryawanController::class, "destroy"]);
});
