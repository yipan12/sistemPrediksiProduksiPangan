<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProduksiPangan;
use Illuminate\Support\Carbon;

class LinearRegresionController extends Controller
{
      // membuka halaman linear regresion
    public function linearRegresionView(){
        $komoditas = ProduksiPangan::where('user_id', auth()->id())
        ->distinct()
        ->pluck('produk');
        return view('prediksi.LinearRegresion', [
            'title' => 'Prediksi LinearRegresion',
            'komoditas' => $komoditas,
            'nextDate' => null,
            'prediksi' => null
        ]);
    }

    // logika dari prediksi linear regresion
    public function linearRegresion(Request $request) {
        $title = 'linearRegresion';
        $produk = $request->input('produk');
        $komoditas = ProduksiPangan::where('user_id', auth()->id())
        ->distinct()->pluck('produk');
        
        $dataRecords = ProduksiPangan::where('user_id', auth()->id())
            ->where('produk', $produk)
            ->orderBy('tanggal')
            ->get(['tanggal', 'jumlah']);

        // tanggal dari carbon
        $lastDate = Carbon::parse($dataRecords->last()->tanggal);
        $nextDate = $lastDate->copy()->addDays(30)->format('y-m-d');
        // akhir membuat tanggal
        if ($dataRecords->count() <= 2) {
            return back()->with('eror', 'Maaf data produksi tidak cukup untuk di prediksi');
        }
        
        $x = [];
        $y = [];
        $i = 1;
        
        foreach ($dataRecords as $row) {
            $x[] = $i++; 
            $y[] = $row->jumlah;
        }
        
        $n = count($x);
        $sum_x = array_sum($x);
        $sum_y = array_sum($y);
        $sum_xy = 0;
        $sum_x2 = 0;
        
        for ($j = 0; $j < $n; $j++) {
            $sum_xy += $x[$j] * $y[$j];
            $sum_x2 += $x[$j] * $x[$j];
        }
        
        $b = ($n * $sum_xy - $sum_x * $sum_y) / ($n * $sum_x2 - $sum_x * $sum_x);
        $a = ($sum_y - $b * $sum_x) / $n;
        $x_prediksi = $n + 1;
        $prediksi = round($a + $b * $x_prediksi);
        
        return view('prediksi.LinearRegresion', compact('produk', 'dataRecords', 'komoditas', 'prediksi', 'title', 'nextDate'));
    }
}   
