<?php

namespace App\Http\Controllers;


use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
    public function index()
    {    

    $produksiTerbanyak = $this->getProdukJumlahTerbanyak();

    if ($produksiTerbanyak) {
        $produksiTerbanyak->total_jumlah_formatted = $this->formatJumlah($produksiTerbanyak->total_jumlah);
    }

        return view('dashboard.dashboard', [
            'title' => 'Dashboard',
            'tanggal' =>  $this->getTanggalSekarang(),
            'total' => $this->getTotalPrediksi(),
            'akurasi' => $this->getakurasiTertinggi(),
            'akurasiRendah' => $this->getakurasiTerednah(),
            'metodeTerbaik' => $this->getAkurasiRataRata(),
            'produksiTerbanyak' => $produksiTerbanyak,
            'hasilAkurasi' => $this->getchartData(),
            'terakhirKali' => $this->getTerakkhirKaliProduksi(),
            'produk' => $this->getProduct()
        ]);
    }




    private function getchartData() {
        return $hasilakurasi = \App\Models\PerbandinganPrediksi::where('user_id', auth()->id())
        ->select('produk', 'produksi_aktual', 'prediksi_ma', 'prediksi_lr', 'prediksi_Es')
        ->get();
    }

    private function getProduct() {
        return \App\Models\PerbandinganPrediksi::where('user_id', auth()->id())
        ->distinct()
        ->pluck('produk')
        ->toArray();
    }

    private function getTerakkhirKaliProduksi(){
        $terakhirKali = \App\Models\ProduksiPangan::where('user_id', auth()->id())
        ->orderByDesc('created_at')
        ->first();
        return $waktuTerakhir = $terakhirKali ? $terakhirKali->created_at->translatedFormat('d F Y') : 'Belum Pernah Input Produksi';
    }


    //  ini ngambil data colection dari map
    private function getakurasiTertinggi(){
        $userId = auth()->id();
        $prediksi = $this->akurasiPrediksi($userId);
        return $prediksi->sortByDesc('akurasi')->first();
    }

    private function getakurasiTerednah(){
        $userId = auth()->id();
        $prediksi = $this->akurasiPrediksiRendah($userId);
        return $prediksi->sortBy('akurasi')->first();
    }

    private function getAkurasiRataRata() {
        $userId = auth()->id();
        $prediksi = $this->akurasiRataRata($userId);
        return $prediksi->sortByDesc('akurasi')->first();
    }

    private function getProdukJumlahTerbanyak() {
    return \App\Models\ProduksiPangan::select('produk', DB::raw('SUM(jumlah) as total_jumlah'))
        ->where('user_id', auth()->id())
        ->groupBy('produk')
        ->orderByDesc('total_jumlah')
        ->first();
    }

    private function formatJumlah($jumlah)
        {
            if ($jumlah >= 1000000) {
                return number_format($jumlah / 1000000, 1) . ' juta';
            } elseif ($jumlah >= 1000) {
                return number_format($jumlah / 1000, 1) . ' ribu';
            }

            return number_format($jumlah);
        }



// ini berupa colection oleh map
    private function akurasiPrediksi($userId){
      return  $data = collect([
        [
            'model' => \App\Models\History::class,
            'metode' => 'Moving Averrage',
        ],
        [
            'model' => \App\Models\HistoryEs::class,
            'metode' => 'Exponential Smoothing',
        ],
        [
            'model' => \App\Models\Historylr::class,
            'metode' => 'linear regresion',
        ],
    ])->map(function($item) use ($userId) {
        $akurasiTertinggi = $item['model']::where('user_id', $userId)->max('akurasi');

        return [
            'metode' => $item['metode'],
            'akurasi' => $akurasiTertinggi ?? 0,
        ];
    }); }

    private function akurasiRataRata($userId){
      return  $data = collect([
        [
            'model' => \App\Models\History::class,
            'metode' => 'Moving Averrage',
        ],
        [
            'model' => \App\Models\HistoryEs::class,
            'metode' => 'Exponential Smoothing',
        ],
        [
            'model' => \App\Models\Historylr::class,
            'metode' => 'linear regresion',
        ],
    ])->map(function($item) use ($userId) {
        $akurasiTertinggi = $item['model']::where('user_id', $userId)->avg('akurasi');

        return [
            'metode' => $item['metode'],
            'akurasi' => round($akurasiTertinggi ?? 0, 2)
            
        ];
    }); 
    }

     private function akurasiPrediksiRendah($userId){
      return  $data = collect([
        [
            'model' => \App\Models\History::class,
            'metode' => 'Moving Averrage',
        ],
        [
            'model' => \App\Models\HistoryEs::class,
            'metode' => 'Exponential Smoothing',
        ],
        [
            'model' => \App\Models\Historylr::class,
            'metode' => 'linear regresion',
        ],
    ])->map(function($item) use ($userId) {
        $akurasiTertinggi = $item['model']::where('user_id', $userId)->min('akurasi');

        return [
            'metode' => $item['metode'],
            'akurasi' => $akurasiTertinggi ?? 0,
        ];
    }); 

    }

    
    // ini ngambil smua count prediksi 
    private function getTotalPrediksi(){
         $userId = auth()->id();

        $totalPrediksi = collect([
        \App\Models\History::class,
        \App\Models\Historylr::class,
        \App\Models\HistoryEs::class,
            ])->reduce(function ($carry, $model) use ($userId) {
            return $carry + $model::where('user_id', $userId)->count();
            }, 0);
        
            return $totalPrediksi;
    }

    // ini ngambil tanggal sekarang
    private function getTanggalSekarang() {
        $now = Carbon::now();
        Carbon::setLocale('id');
        return $tanggal = $now->translatedFormat('l, d F Y');
    }

}
