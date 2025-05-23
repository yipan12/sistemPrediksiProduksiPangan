<?php

namespace App\Http\Controllers;

use App\Models\HistoryEs;
use App\Models\PerbandinganPrediksi;
use Illuminate\Http\Request;

class perbandinganController extends Controller
{
    public function destroy(Request $request, $id){
        $hapus = PerbandinganPrediksi::findOrfail($id);
        $hapus->delete();
        return redirect()->route('produksi.index')->with('hapus', 'Data perbandingan telah di hapus' );
    }
}
