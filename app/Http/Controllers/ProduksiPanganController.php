<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\History;
use App\Models\HistoryEs;
use App\Models\Historylr;
use Illuminate\Http\Request;
use App\Models\ProduksiPangan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\PerbandinganPrediksi;

class ProduksiPanganController extends Controller
{
    
    // index
    public function index()
    {
        $history = \App\Models\History::where('user_id', auth()->id())->count();
        $historylr = \App\Models\Historylr::where('user_id', auth()->id())->count();
        $historyEs = \App\Models\HistoryEs::where('user_id', auth()->id())->count();
        $produksiPangan = \App\Models\ProduksiPangan::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->paginate(10);
         $perbandinganPrediksi = \App\Models\PerbandinganPrediksi::where('user_id', auth()->id())
         ->orderBy('created_at', 'desc')
         ->paginate(10);
        return view('produksi.index', [
            'title' => 'Historis',
            'produksiPangan' => $produksiPangan,
            'history' => $history,
            'historylr' => $historylr,
            'perbandingan' => $perbandinganPrediksi,
            'historyEs' => $historyEs
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
       $produksi = ProduksiPangan::create($validatedData);
       $this->checkAndSaveAkurasi($produksi);
       return response()->json([
       'message' => 'Data berhasil ditambah!',
       'data' => $produksi
   ], 201);
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
        $produksiPangan = ProduksiPangan::findOrfail($id);
        $produksiPangan->delete();
        return redirect()->route('produksi.index')->with('status', 'data berhasil di hapus');
    }


// private method ngecek akurasi prediksi yang di buat ma dan lr
    private function checkAndSaveAkurasi($produksi){

         


        $tanggalProduksi = Carbon::parse($produksi->tanggal);
        $bulanproduksi = $this->getNamaBulan($tanggalProduksi->month);
        $tahunProduksi = $tanggalProduksi->year;
        $periode = $bulanproduksi . " " . $tahunProduksi;

        // ambil data prediksi ma yang sesuai dengan bulan nu di inputkeun pengguna
        $prediksiMA = History::where('user_id', auth()->id())
        ->where('produk', $produksi->produk)
        ->where('periode_prediksi', $periode)
        ->first();

        // ambil data prediksi lr yang sesuai dengan bulan nu di inputkeun pengguna
        $prediksiLr = Historylr::where('user_id', auth()->id())
        ->where('produk', $produksi->produk)
        ->where('periode_prediksi', $periode)
        ->first();

        $prediksiEs = HistoryEs::where('user_id', auth()->id())
        ->where('produk', $produksi->produk)
        ->where('periode_prediksi', $periode)
        ->first();

        // mun eweuh hasil dari prediksilr jeung ma maka nggeuskeun nepi ka die
        if(!$prediksiLr && !$prediksiMA){
            return;
        }

        $perbandinganData = [
            'user_id' => auth()->id(),
            'produk' => $produksi->produk,
            'produksi_aktual' => $produksi->jumlah,
            'prediksi_ma' => 0,
            'prediksi_lr' => 0,
            'prediksi_Es' => 0,
            'target_prediksi' => $periode,
            'hasil_terbaik' => '',
            'akurasi_persen' => 0
        ];

        if($prediksiMA) {
            $perbandinganData['prediksi_ma'] = $prediksiMA->prediksi;
            $selisihMA = abs($produksi->jumlah - $prediksiMA->prediksi);
            $akurasiMA = $produksi->jumlah > 0 ?
            100 - (($selisihMA/$produksi->jumlah) * 100) : 0;
            $perbandinganData['akurasi_ma'] = round(max(0, $akurasiMA), 2);
            $prediksiMA->akurasi = $akurasiMA;
            $prediksiMA->save();
        }

        if ($prediksiEs) {
            $perbandinganData['prediksi_Es'] = $prediksiEs->prediksi;
            $selisihES = abs($produksi->jumlah - $prediksiEs->prediksi);
            $akurasiES = $produksi->jumlah > 0 ? 
                100 - (($selisihES / $produksi->jumlah) * 100) : 0;
            $perbandinganData['akurasi_Es'] = round(max(0, $akurasiES), 2);
            $prediksiEs->akurasi = $akurasiES;
            $prediksiEs->save();
        }

        if ($prediksiLr) {
            $perbandinganData['prediksi_lr'] = $prediksiLr->prediksi;
            $selisihLR = abs($produksi->jumlah - $prediksiLr->prediksi);
            $akurasiLR = $produksi->jumlah > 0 ? 
                100 - (($selisihLR / $produksi->jumlah) * 100) : 0;
            $perbandinganData['akurasi_lr'] = round(max(0, $akurasiLR), 2);
            $prediksiLr->akurasi = $akurasiLR;
            $prediksiLr->save();
        }

        $akurasiMA = $perbandinganData['akurasi_ma'] ?? 0;
        $akurasiLR = $perbandinganData['akurasi_lr'] ?? 0;
        $akurasiES = $perbandinganData['akurasi_es'] ?? 0;

         if ($akurasiMA >= $akurasiLR && $akurasiMA >= $akurasiES) {
            $perbandinganData['hasil_terbaik'] = 'Moving Average';
            $perbandinganData['akurasi_persen'] = $akurasiMA;
        } elseif ($akurasiLR >= $akurasiMA && $akurasiLR >= $akurasiES) {
            $perbandinganData['hasil_terbaik'] = 'Linear Regression';
            $perbandinganData['akurasi_persen'] = $akurasiLR;
        } else {
            $perbandinganData['hasil_terbaik'] = 'Exponential Smoothing';
            $perbandinganData['akurasi_persen'] = $akurasiES;
        }
        
        PerbandinganPrediksi::create($perbandinganData);
        



    }
    // private method getnamabulan
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
