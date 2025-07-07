<?php

namespace App\Exports;

use App\Models\ProduksiPangan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;

class ProduksiPanganExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProduksiPangan::where('user_id', Auth::id())->get();
    }
}
