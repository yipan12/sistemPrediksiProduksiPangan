<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HistorisController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\lrHistorisController;
use App\Http\Controllers\MaHistorisController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\MovingArrageController;
use App\Http\Controllers\ProduksiPanganController;
use App\Http\Controllers\LinearRegresionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// view
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');


// login
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest')->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
// register
Route::get('/register', [RegistrasiController::class, 'index'])->middleware('guest');
Route::post('/register', [RegistrasiController::class, 'store']);
// data
// route produksi
Route::resource('produksi', ProduksiPanganController::class)->middleware('auth');
// route prediksi
Route::get('prediksi', [MovingArrageController::class, 'index'])->middleware('auth')->name('prediksi-pangan');
route::post('prediksi', [MovingArrageController::class, 'prediksi'])->middleware('auth')->name('prediksi-pangan2');
// route linear regresion
Route::get('linearRegresionView', [LinearRegresionController::class, 'linearRegresionView'])->middleware('auth')->name('linearView');
route::post('linearRegresion', [LinearRegresionController::class, 'linearRegresion'])->middleware('auth')->name('prediksi-linear');
// historis ma
route::post('store', [MaHistorisController::class, 'store'])->middleware('auth')->name('simpanMovingArrage');
route::get('index', [MaHistorisController::class, 'index'])->middleware('auth')->name('MovingarageIndex');
route::delete('Hapus/{id}', [MaHistorisController::class, 'destroy'])->middleware('auth')->name('hapusMaindex');
// historis  lr
route::get('Historis', [lrHistorisController::class, 'index'])->middleware('auth')->name('LrIndex');
route::post('Simpan', [lrHistorisController::class, 'store'])->middleware('auth')->name('simpanLrIndex');
route::delete('Hapus/[{id}', [lrHistorisController::class, 'destroy'])->middleware('auth')->name('hapusLrIndex');






 