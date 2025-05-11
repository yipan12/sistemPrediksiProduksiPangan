<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\ProduksiPangan;
use Illuminate\Http\Request;

class ProduksiPanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $history = \App\Models\History::get()->count();
        $produksiPangan = \App\Models\ProduksiPangan::orderBy('created_at', 'desc')->paginate(12);
        return view('produksi.index', [
            'title' => 'Historis',
            'produksiPangan' => $produksiPangan,
            'history' => $history
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('produksi.create', [
            'title' => "Produksi",
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([
        'produk' => 'required|string|max:255',
        'jumlah' => 'required|integer',
        'tanggal' => 'required|date',
        'harga' => 'required|numeric'
       ]);

       ProduksiPangan::create($validatedData);
       return redirect()->route('produksi.index')->with('status', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProduksiPangan $produksiPangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produksiPangan = ProduksiPangan::findOrFail($id);
        return view('produksi.edit', [
            'title' => 'Edit',
            'produksi' => $produksiPangan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validatedData = $request->validate([
             'produk' => "required|max:255",
             'jumlah' => 'required|integer',
             'tanggal' => 'required|date',
             'harga' => 'required|numeric'
        ]);

        ProduksiPangan::findOrFail($id)->update($validatedData);
        return redirect()->route('produksi.index')->with('status', 'Update berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProduksiPangan $produksiPangan, $id)
    {
        ProduksiPangan::findOrfail($id)->delete($id);
        return redirect()->route('produksi.index')->with('status', 'data berhasil di hapus');
    }
}
