<?php

namespace App\Http\Controllers;

use App\Models\Historylr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class lrHistorisController extends Controller
{
    // index
    public function index(){
        $historis = \App\Models\Historylr::where('user_id', auth()->id())
        ->orderBy('tanggal_prediksi', 'desc')
        ->paginate(12);

        return view('historis.linearRegresionHistoris', 
    [
        'title' => 'historis',
        'historis' => $historis
    ]
    );}
    // simpan prediksi
    public function store(Request $request){
        $validatedData = $request->validate([
            'produk' => 'required',
            'prediksi' => 'required|integer'
        ]);

        $tanggalPrediksi = Carbon::now()->format('Y-m-d');

        $nextMonth = Carbon::now()->addMonth();
        $bulanSelanjutnya = $this->getNamaBulan($nextMonth->month);
        $tahunBerikutnya = $nextMonth->year;
        
        $validatedData['tanggal_prediksi'] = $tanggalPrediksi;
        $validatedData['periode_prediksi'] = $bulanSelanjutnya . " " . $tahunBerikutnya;
        $validatedData['user_id'] = auth()->id();
        Historylr::create($validatedData);
        return redirect()->route('LrIndex')->with('status', 'prediksi berhasil di simpan');


    }
// untuk penamaan bulan
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

        // hapus 
        public function destroy(Request $request, $id){
           $request =  Historylr::findOrfail($id);
           $request->delete();
        return redirect()->route('LrIndex')->with('status', 'Data berhasil di hapus');
        }
}
