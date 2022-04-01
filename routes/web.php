<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SortirController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/clear', function(){
    Artisan::call('optimize:clear');
    return 'done';
});

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

// route transaksi
Route::get('/pembelian/data',[PembelianController::class,'data']);
Route::resource('pembelian', PembelianController::class);
Route::get('/sortir/data',[SortirController::class,'data']);
Route::resource('sortir', SortirController::class);
Route::get('/penjualan/data',[PenjualanController::class,'data']);
Route::resource('penjualan', PenjualanController::class);

// route master
Route::get('/jenis/data',[JenisController::class,'data']);
Route::resource('jenis', JenisController::class);
Route::get('/produk/data',[ProdukController::class,'data']);
Route::resource('produk', ProdukController::class);
Route::get('/master/data',[MasterController::class,'data']);
Route::resource('master', MasterController::class);
Route::get('/supplier/data',[SupplierController::class,'data']);
Route::resource('supplier', SupplierController::class);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
