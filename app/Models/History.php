<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = 'history';
    protected $fillable  = [
        'produk',
        'jumlah_1',
        'jumlah_2',
        'jumlah_3',
        'prediksi',
        'user_id'
        
    ];
    public $timestamps = false; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
