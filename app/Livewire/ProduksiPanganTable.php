<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProduksiPangan;

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
            $query->where('produk', 'like', '%' . $this->search . '%');
        }
        
        $rataRata = round($query->avg('harga'));
        $products = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        
        return view('livewire.produksi-pangan-table', [
            'products' => $products,
            'rataRata' => $rataRata
        ]);
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