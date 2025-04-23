<?php

namespace App\Http\Controllers;

use App\Models\ProduksiPangan;
use Illuminate\Http\Request;

class PrediksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $komoditas = ProduksiPangan::distinct()->pluck('produk');
        return view('prediksi.index', 
        [
            'title' => 'Prediksi',
            'komoditas' => $komoditas
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
        ->pluck('jumlah');

        $prediksi = $dataTerakhir->count() > 0 ? round($dataTerakhir->avg()) : 0 ;
        return view('prediksi.index', compact('produk', 'dataTerakhir', 'prediksi', 'komoditas', 'title'));
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
