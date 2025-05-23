<?php

namespace App\Http\Controllers;

use App\Models\ProduksiPangan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class exponentialSmoothingController extends Controller
{
    // index
    public function index (){
        $komoditas = ProduksiPangan::where('user_id', auth()->id())
        ->distinct()
        ->pluck('produk');
        
    return view('prediksi.exponentialSmoothin', [
        'title' => 'prediksiExponential',
        'komoditas' => $komoditas,
        'prediksi' => null
    ]);
    }
    // sistem prediksi exponentialSmoothin
    public function exponentialSmoothing(Request $request){
        $title = "Exponential Smoothing";
        $produk = $request->input('produk');
        $alpha = 0.3;

        $komoditas = ProduksiPangan::where('user_id', auth()->id())
        ->distinct()
        ->pluck('produk');

        $dataRecord = ProduksiPangan::where('user_id', auth()->id())
        ->where('produk', $produk)
        ->orderBy('tanggal')
        ->get(['tanggal', 'jumlah']);

        if($dataRecord->count() <= 2){
            return redirect()->route('expoIndex')->with('eror', 'Maaf data prediksi belum memenuhi untuk di prediksi');
        }
          $lastDate = Carbon::parse($dataRecord->last()->tanggal);
          $nextDate = $lastDate->copy()->addDays(30)->format('Y-m-d');
        // sistem prediksi exponential
        $values = $dataRecord->pluck('jumlah')->toArray();
        $n = count($values);
    
        $forecast = [$values[0]];
        for ($i = 1; $i < $n; $i++) {
            $forecast[$i] = $alpha * $values[$i-1] + (1 - $alpha) * $forecast[$i-1];
        }
        $prediksi = round($alpha * $values[$n-1] + (1 - $alpha) * $forecast[$n-1]);
        return view('prediksi.exponentialSmoothin', compact('produk', 'title', 'prediksi', 'dataRecord' ,'komoditas' , 'nextDate'));
    }

}
