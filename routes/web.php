<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HistorisController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EsHistorisController;
use App\Http\Controllers\exponentialSmoothing;
use App\Http\Controllers\exponentialSmoothingController;
use App\Http\Controllers\lrHistorisController;
use App\Http\Controllers\MaHistorisController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\MovingArrageController;
use App\Http\Controllers\ProduksiPanganController;
use App\Http\Controllers\LinearRegresionController;
use App\Http\Controllers\perbandinganController;
use App\Models\HistoryEs;
use App\Models\PerbandinganPrediksi;
use App\Models\ProduksiPangan;

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
Route::post('prediksi', [MovingArrageController::class, 'prediksi'])->middleware('auth')->name('prediksi-pangan2');
// route linear regresion
Route::get('linearRegresionView', [LinearRegresionController::class, 'linearRegresionView'])->middleware('auth')->name('linearView');
Route::post('linearRegresion', [LinearRegresionController::class, 'linearRegresion'])->middleware('auth')->name('prediksi-linear');
// route exponential
Route::get('expoIndex', [exponentialSmoothingController::class, 'index'])->middleware('auth')->name('expoIndex');
Route::post('expoPrediksi', [exponentialSmoothingController::class, 'exponentialSmoothing'])->middleware('auth')->name('expoPrediksi');
// historis ma
Route::post('store', [MaHistorisController::class, 'store'])->middleware('auth')->name('simpanMovingArrage');
Route::get('index', [MaHistorisController::class, 'index'])->middleware('auth')->name('MovingarageIndex');
Route::delete('hapus/{id}', [MaHistorisController::class, 'destroy'])->middleware('auth')->name('hapusMaIndex');
// historis  lr
Route::get('Historis', [lrHistorisController::class, 'index'])->middleware('auth')->name('LrIndex');
Route::post('Simpan', [lrHistorisController::class, 'store'])->middleware('auth')->name('simpanLrIndex');
Route::delete('Hapus/{id}', [lrHistorisController::class, 'destroy'])->middleware('auth')->name('hapusLrIndex');
// historis es
Route::get('indexEs', [EsHistorisController::class, 'index'])->middleware('auth')->name('EsIndex');
Route::post('SimpanEs', [EsHistorisController::class, 'simpanEsHistory'])->middleware('auth')->name('simpanEs');
Route::delete('delete/{id}', [EsHistorisController::class, 'destroy'])->middleware('auth')->name('esHapus');
// route hapus
Route::delete('destroy/{id}', [perbandinganController::class, 'destroy'])->middleware('auth')->name('hapusPerbandingan');



Route::get('/prediksiajacoba', function () {
    return view('prediksi.Prediksi', [
        'title' => 'coba',
        'komoditas' => null
    ]);
})->name('predi')->middleware('auth');



 