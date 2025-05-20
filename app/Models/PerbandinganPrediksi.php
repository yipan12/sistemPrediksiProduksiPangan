<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbandinganPrediksi extends Model
{
    use HasFactory;
    protected $table = 'hasilakurasi';

    protected $fillable = [
        'user_id',
        'produk',
        'produksi_aktual',
        'prediksi_ma',
        'prediksi_lr',
        'target_prediksi',
        'hasil_terbaik',
        'akurasi_persen'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
