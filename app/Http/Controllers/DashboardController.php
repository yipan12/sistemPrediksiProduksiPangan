<?php

namespace App\Http\Controllers;


use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class DashboardController extends Controller
{
    
    public function index()
    {    
        return view('dashboard.dashboard', [
            'title' => 'Dashboard',
            'tanggal' =>  $this->getTanggalSekarang(),
            'total' => $this->getTotalPrediksi(),
            'akurasi' => $this->getakurasiTertinggi(),
            'akurasiRendah' => $this->getakurasiTerednah(),
            'metodeTerbaik' => $this->getAkurasiRataRata()
        ]);
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
            'akurasi' => round($akurasiRataRata ?? 0, 2),
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
