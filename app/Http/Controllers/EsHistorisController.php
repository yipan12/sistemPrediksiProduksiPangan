<?php

namespace App\Http\Controllers;

use App\Models\HistoryEs;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class EsHistorisController extends Controller
{
    
    public function index(){
        $historis = \App\Models\HistoryEs::where('user_id', auth()->id())
        ->orderBy('tanggal_prediksi', 'desc')
        ->paginate(12);

        return view('historis.exponentialSmoothingHistoris', [
            'title' => 'Historis',
            'historis' => $historis
        ]);
    }


    public function simpanEsHistory(Request $request) {
        $validatedData = $request->validate([
            'produk' => 'required',
            'prediksi' => 'required|integer'
        ]);

        $tanggalPrediksi = Carbon::now()->format('Y-m-d');
        
        $nextMonth = Carbon::now()->addMonth();
        $bulanSelanjutnya = $this->getNamaBulan($nextMonth->month);
        $tahunselanjutnya = $nextMonth->year;

        $validatedData['user_id'] = auth()->id();
        $validatedData['tanggal_prediksi'] = $tanggalPrediksi;
        $validatedData['periode_prediksi'] = $bulanSelanjutnya . ' ' . $tahunselanjutnya;
        HistoryEs::create($validatedData);
        return redirect()->route('expoIndex')->with('status', 'prediksi berhasil di simpan');
    }
    // 
    public function destroy(Request $request, $id){
        $hapus = HistoryEs::findOrfail($id);
        $hapus->delete();
        return redirect()->route('EsIndex')->with('status', 'Data berhasil di hapus');
    }

    // private method
      private function getNamaBulan($bulan)
        {
            $namaBulan = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
            ];
            
            return $namaBulan[$bulan];
        }
}
