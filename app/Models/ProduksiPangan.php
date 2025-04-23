<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduksiPangan extends Model
{
    use HasFactory;
    protected $table = 'produksi_pangan';

    protected $fillable  = [
        'produk',
        'jumlah',
        'tanggal',
        'harga'

    ];
}
