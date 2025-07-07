<?php

namespace App\Http\Controllers;

use App\Models\ProduksiPangan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function exportPdf()
    {
        $data = ProduksiPangan::where('user_id', Auth::id())->get();
        $pdf = Pdf::loadView('laporan.produksi', ['data'=> $data]);
        return $pdf->download('laporan.produksi.pdf');
        
    }
}
