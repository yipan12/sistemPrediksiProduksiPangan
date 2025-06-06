<?php

namespace App\Livewire;

use Livewire\Component;
use \App\Models\HistoryEs;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class ExponentialSmoothingHistoris extends Component
{
    use WithPagination;
    public $search;
    public $periode;
    public $akurasi;

    public function render()
    {
          $query = HistoryEs::where('user_id', auth()->id());
        if(!empty($this->search)){
            $query->where('produk', 'like', '%'. $this->search . '%');
        }

       if ($this->periode) {
            $bulanSekarang = Carbon::now();
            $periodeList = [];

            if ($this->periode === '3_bulan') {
                for ($i = 0; $i < 3; $i++) {
                    $periodeList[] = $bulanSekarang->copy()->subMonths($i)->format('Y-m');
                }
            } elseif ($this->periode === '6_bulan') {
                for ($i = 0; $i < 6; $i++) {
                    $periodeList[] = $bulanSekarang->copy()->subMonths($i)->format('Y-m');
                }
            } elseif ($this->periode === '1_tahun') {
                for ($i = 0; $i < 12; $i++) {
                    $periodeList[] = $bulanSekarang->copy()->subMonths($i)->format('Y-m');
                }
            }

            $query->whereIn('periode_prediksi', $periodeList);
        }

        if(!empty($this->akurasi)){
            $query->where('akurasi', '>=', $this->akurasi);
        }
        $historis = $query->orderBy('periode_prediksi')->paginate(12);
        return view('livewire.exponential-smoothing-historis', [
            'historis' => $historis
        ]);
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingAkurasi()
    {
        $this->resetPage();
    }
}
