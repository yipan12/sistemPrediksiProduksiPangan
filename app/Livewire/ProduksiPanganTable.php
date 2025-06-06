<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProduksiPangan;
use Illuminate\Support\Facades\DB;

class ProduksiPanganTable extends Component
{
    use WithPagination;
    
    public $search = '';
    public $perPage = 12;
    
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $query = ProduksiPangan::where('user_id', auth()->id());
        
        if (!empty($this->search)) {
            $query->where('produk', 'like', '%'. $this->search .'%');
        }
        
        $rataRata = round($query->avg('harga'));
        $products = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        
        return view('livewire.produksi-pangan-table', [
            'products' => $products,
            'rataRata' => $rataRata,
            'totalProduksi' => $this->totalProduksi(),
            'produksiTerbanyak' => $this->produksiTerbanyak(),
            'updateTerakhir' => $this->TerakhirUpdate()
        ]);
    }

    public function TerakhirUpdate() {
        return \App\Models\ProduksiPangan::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->pluck('created_at')
        ->first();
    }

    public function totalProduksi(){
        return \App\Models\ProduksiPangan::where('user_id', auth()->id())->sum('jumlah');
    }

    public function produksiTerbanyak(){
        return \App\Models\ProduksiPangan::where('user_id', auth()->id())
        ->select('produk', DB::raw('SUM(jumlah) as total_jumlah'))
        ->groupBy('produk')
        ->orderByDesc('total_jumlah')
        ->first();
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatePerPage()
    {
        $this->resetPage();
    }
}