<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Historylr;
use App\Models\PerbandinganPrediksi;
use App\Models\ProduksiPangan;
use Carbon\Carbon;
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
        ->paginate(10);
         $perbandinganPrediksi = \App\Models\PerbandinganPrediksi::where('user_id', auth()->id())
         ->orderBy('created_at', 'desc')
         ->paginate(10);
        return view('produksi.index', [
            'title' => 'Historis',
            'produksiPangan' => $produksiPangan,
            'history' => $history,
            'historylr' => $historylr,
            'perbandingan' => $perbandinganPrediksi
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

        // mun eweuh hasil dari prediksilr jeung ma maka nggeuskeun nepi ka die
        if(!$prediksiLr && !$prediksiMA){
            return;
        }

        $perbandinganData = [
            'user_id' => auth()->id(),
            'produk' => $produksi->produk,
            'produksi_aktual' => $produksi->jumlah,
            'tanggal_produksi' => $produksi->tanggal,
            'target_prediksi' => $periode
            
        ];

        $perbandinganData['prediksi_ma'] = 0;
        $perbandinganData['akurasi_ma'] = 0;
        $perbandinganData['prediksi_lr'] = 0;
        $perbandinganData['akurasi_lr'] = 0;

        if($prediksiMA) {
            $perbandinganData['prediksi_ma'] = $prediksiMA->prediksi;
            $selisihMA = abs($produksi->jumlah - $prediksiMA->prediksi);
            $akurasiMA = $produksi->jumlah > 0 ?
            100 - (($selisihMA/$produksi->jumlah) * 100) : 0;
            $perbandinganData['akurasi_ma'] = round(max(0, $akurasiMA), 2);
        }

        if ($prediksiLr) {
            $perbandinganData['prediksi_lr'] = $prediksiLr->prediksi;
            $selisihLR = abs($produksi->jumlah - $prediksiLr->prediksi);
            $akurasiLR = $produksi->jumlah > 0 ? 
                100 - (($selisihLR / $produksi->jumlah) * 100) : 0;
            $perbandinganData['akurasi_lr'] = round(max(0, $akurasiLR), 2);
        }

        if(isset($perbandinganData['akurasi_ma']) && $perbandinganData['akurasi_lr']){
            if ($perbandinganData['akurasi_ma'] > $perbandinganData['akurasi_lr']) {
                $perbandinganData['hasil_terbaik'] = 'Moving Average';
                $perbandinganData['akurasi_persen'] = $perbandinganData['akurasi_ma'];
            } else {
                $perbandinganData['hasil_terbaik'] = 'Linear Regression';
                $perbandinganData['akurasi_persen'] = $perbandinganData['akurasi_lr'];
            }
        } elseif (isset($perbandinganData['akurasi_ma'])) {
            $perbandinganData['hasil_terbaik'] = 'Moving Average';
            $perbandinganData['akurasi_persen'] = $perbandinganData['akurasi_ma'];
        } elseif (isset($perbandinganData['akurasi_lr'])) {
            $perbandinganData['hasil_terbaik'] = 'Linear Regression';
            $perbandinganData['akurasi_persen'] = $perbandinganData['akurasi_lr'];
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
