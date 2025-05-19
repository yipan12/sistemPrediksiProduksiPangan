<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\ProduksiPangan;
use Illuminate\Http\Request;

class ProduksiPanganController extends Controller
{
    
    // index
    public function index()
    {
        $history = \App\Models\History::where('user_id', auth()->id())->count();
        $historylr = \App\Models\Historylr::where('user_id', auth()->id())->count();
        $produksiPangan = \App\Models\ProduksiPangan::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->paginate(12);
        return view('produksi.index', [
            'title' => 'Historis',
            'produksiPangan' => $produksiPangan,
            'history' => $history,
            'historylr' => $historylr
        ]);
    }

//    create
    public function create()
    {
        
        return view('produksi.create', [
            'title' => "Produksi",
            
        ]);
    }

    public function store(Request $request)
    {
       $validatedData = $request->validate([
        'produk' => 'required|string|max:255',
        'jumlah' => 'required|integer',
        'tanggal' => 'required|date',
        'harga' => 'required|numeric'
       ]);

       $validatedData['user_id'] = auth()->id(); 
       ProduksiPangan::create($validatedData);
       return redirect()->route('produksi.index')->with('status', 'Data berhasil ditambah!');
    }
// edit
    public function edit($id)
    {
        $produksiPangan = ProduksiPangan::findOrFail($id);
        return view('produksi.edit', [
            'title' => 'Edit',
            'produksi' => $produksiPangan
        ]);
    }

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
// hapus
    public function destroy(ProduksiPangan $produksiPangan, $id)
    {
        ProduksiPangan::findOrfail($id)->delete($id);
        return redirect()->route('produksi.index')->with('status', 'data berhasil di hapus');
    }
// private method
    private function checkAndSaveAkurasi($produk){
        
    }
}
