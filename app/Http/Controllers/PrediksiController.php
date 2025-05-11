<?php

namespace App\Http\Controllers;

use App\Models\ProduksiPangan;
use Illuminate\Http\Request;

class PrediksiController extends Controller
{
    
    public function index()
    {
        $komoditas = ProduksiPangan::distinct()->pluck('produk');
        return view('prediksi.movingArage', 
        [
            'title' => 'Prediksi',
            'komoditas' => $komoditas,
            'produk' => null,
            'dataTerakhir' => collect(),
            'prediksi' => null,
        ]
    );
    }

    public function prediksi(Request $request){
        $title = 'prediksi';
        $produk = $request->input('produk');
        $komoditas = ProduksiPangan::distinct()->pluck('produk');

        $dataTerakhir = ProduksiPangan::where('produk', $produk)
        ->orderBy('tanggal', 'desc')
        ->take(3)
        ->pluck('jumlah')
        ->reverse() 
        ->values();

        $prediksi = $dataTerakhir->count() > 0 ? round($dataTerakhir->avg()) : 0 ;
        return view('prediksi.movingArage', compact('produk', 'dataTerakhir', 'prediksi', 'komoditas', 'title'));
    }

    public function linearRegresionView(){
        $komoditas = ProduksiPangan::distinct()->pluck('produk');
        return view('prediksi.LinearRegresion', [
            'title' => 'Prediksi LinearRegresion',
            'komoditas' => $komoditas
        ]);
    }
    public function linearRegresion(Request $request) {
        $title = 'linearRegresion';
        $produk = $request->input('produk');
        $komoditas = ProduksiPangan::distinct()->pluck('produk');
        
        $dataRecords = ProduksiPangan::where('produk', $produk)
            ->orderBy('tanggal')
            ->get(['tanggal', 'jumlah']);
        
        if ($dataRecords->count() == 0) {
            return back()->with('eror', 'Maaf data produksi tidak cukup untuk di prediksi');
        }
        
        $x = [];
        $y = [];
        $i = 1;
        
        foreach ($dataRecords as $row) {
            $x[] = $i++; // Menambahkan ke array, bukan menimpa
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
        
        return view('prediksi.LinearRegresion', compact('produk', 'dataRecords', 'komoditas', 'prediksi', 'title'));
    }
}
