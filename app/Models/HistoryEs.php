<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryEs extends Model
{
    use HasFactory;
    protected $table = 'historyes';

    protected $fillable = [
        'produk',
        'prediksi',
        'akurasi',
        'periode_prediksi',
        'user_id',
        'tanggal_prediksi'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
