<?php


use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProduksiPanganExport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EsHistorisController;
use App\Http\Controllers\lrHistorisController;
use App\Http\Controllers\MaHistorisController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\MovingArrageController;
use App\Http\Controllers\perbandinganController;
use App\Http\Controllers\ProduksiPanganController;
use App\Http\Controllers\LinearRegresionController;
use App\Http\Controllers\exponentialSmoothingController;
use App\Http\Controllers\landingPagesController;
use App\Http\Controllers\LaporanController;

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

// Landing
Route::get('/', [landingPagesController::class, 'index'])->name('landing')->middleware('guest');
// login
Route::get('/loginIndex', [LoginController::class, 'index'])->name('loginIndex')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest')->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
// register
Route::get('/registrasi.index', [RegistrasiController::class, 'index'])->name('registrasi.index')->middleware('guest');
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
// login lupa password
route::get('lupaPassword', [LoginController::class, 'showForgotEmail'])->middleware('guest')->name('lupaPassword');
Route::post('/forgot-password', [LoginController::class, 'sendResetLinkEmail'])
    ->name('password.email')
    ->middleware('guest');
Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])
    ->name('password.reset')
    ->middleware('guest');
Route::post('/reset-password', [LoginController::class, 'resetPassword'])
    ->name('password.update')
    ->middleware('guest');

Route::get('/export-produksi', function () {
    return Excel::download(new ProduksiPanganExport, 'produksi-pangan.xlsx');
})->name('export.produksi')->middleware('auth');

Route::get('/export-produksi-pdf', [LaporanController::class, 'exportPdf'])
    ->name('export.produksi.pdf')
    ->middleware('auth');


