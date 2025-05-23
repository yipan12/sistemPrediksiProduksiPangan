<?php

namespace App\Http\Controllers;

use App\Models\ProduksiPangan;
use Illuminate\Http\Request;


class MovingArrageController extends Controller
{
    // untuk halaman awal dibuka 
    public function index()
    {
        $komoditas = ProduksiPangan::where('user_id', auth()->id())
        ->distinct()->pluck('produk');
        return view('prediksi.movingArage', 
        [
            'title' => 'PrediksiMovingArrage',
            'komoditas' => $komoditas,
            'produk' => null,
            'dataTerakhir' => collect(),
            'prediksi' => null,
        ]
    );
    }
    // logika untuk prediksi movingArrage
    public function prediksi(Request $request){
        $title = 'prediksi';
        $produk = $request->input('produk');
        $komoditas = ProduksiPangan::where('user_id', auth()->id())
                    ->distinct()
                    ->pluck('produk');

            $dataTerakhir = ProduksiPangan::where('user_id', auth()->id())
                    ->where('produk', $produk)
                    ->orderBy('tanggal')
                    ->take(3)
                    ->pluck('jumlah')
                    ->reverse()
                    ->values();

        $prediksi = $dataTerakhir->count() > 0 ? round($dataTerakhir->avg()) : 0 ;
        return view('prediksi.movingArage', compact('produk', 'dataTerakhir', 'prediksi', 'komoditas', 'title'));
    }
}
