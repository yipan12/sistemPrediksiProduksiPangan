<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistorisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $historis = \App\Models\History::where('user_id', auth()->id())
                    ->orderBy('tanggal_prediksi', 'desc')
                    ->paginate(12);
        return view('historis.movingArrageHistoris', [
            'title' => 'Hasil Prediksi',
            'historis' => $historis
        ]);
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
    $validatedData = $request->validate([
        'produk' => 'required',
        'jumlah_1' => 'required|integer',
        'jumlah_2' => 'required|integer',
        'jumlah_3' => 'required|integer',
        'prediksi' => 'required'
    ]);
    
    // Tambahkan user_id dari user yang sedang login
    $validatedData['user_id'] = auth()->id();
    
    History::create($validatedData);
    
    return redirect()->route('MovingarageIndex')->with('status', 'prediksi berhasil di simpan');
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
