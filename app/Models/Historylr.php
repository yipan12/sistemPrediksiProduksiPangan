<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historylr extends Model
{
    use HasFactory;
    protected $table = 'historylr';
    protected $fillable = [
        'produk',
        'prediksi',
        'periode_prediksi',
        'user_id',
        'tanggal_prediksi'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
