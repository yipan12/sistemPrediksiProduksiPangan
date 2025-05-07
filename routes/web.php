<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistorisController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\ProduksiPanganController;
use GuzzleHttp\Middleware;

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
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
// register
Route::get('/register', [RegistrasiController::class, 'index'])->middleware('guest');
Route::post('/register', [RegistrasiController::class, 'store']);
// data
// routes/web.php
Route::resource('produksi', ProduksiPanganController::class)->middleware('auth');
// route prediksi
Route::get('prediksi', [PrediksiController::class, 'index'])->middleware('auth')->name('prediksi-pangan');
Route::get('linearRegresionView', [PrediksiController::class, 'linearRegresionView'])->middleware('auth')->name('linearView');
route::post('prediksi', [PrediksiController::class, 'prediksi'])->middleware('auth')->name('prediksi-pangan2');
route::post('linearRegresion', [PrediksiController::class, 'linearRegresion'])->middleware('auth')->name('prediksi-linear');
// historis
route::post('store', [HistorisController::class, 'store'])->middleware('auth')->name('simpanMovingArrage');
route::get('index', [HistorisController::class, 'index'])->middleware('auth')->name('MovingarageIndex');






 