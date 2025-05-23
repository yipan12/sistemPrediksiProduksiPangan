<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MaHistorisController extends Controller
{
    // index
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
    // simpan
    public function store(Request $request)
    {
        if (!$request->filled('jumlah_1') || !$request->filled('jumlah_2') || !$request->filled('jumlah_3')) {
            return redirect()->back()->withErrors(['jumlah_kurang' => 'Data prediksi harus terdiri dari 3 nilai.']);
        }
        
        $validatedData = $request->validate([
            'produk' => 'required',
            'jumlah_1' => 'required|integer',
            'jumlah_2' => 'required|integer',
            'jumlah_3' => 'required|integer',
            'prediksi' => 'required|integer'
        ]);
        
        $nextMonth = Carbon::now()->addMonth();
        $bulanBerikutnya = $this->getNamaBulan($nextMonth->month);
        $tahunBerikutnya = $nextMonth->year;
        $validatedData['periode_prediksi'] = $bulanBerikutnya . ' ' . $tahunBerikutnya;
        $validatedData['user_id'] = auth()->id();
        
        History::create($validatedData);
        
        return redirect()->route('MovingarageIndex')->with('status', 'prediksi berhasil di simpan');
    }
    // hapus
    public function destroy(Request $request, $id){
        $request = History::findOrfail($id);
        $request->delete();
        return redirect()->route('MovingarageIndex')->with('status', 'hapus data berhasil');
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
