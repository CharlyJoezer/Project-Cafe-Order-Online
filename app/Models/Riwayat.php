<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    protected $table = 'riwayat';
    protected $guarded = ['id'];
    protected $casts = [
        'list_pesanan' => 'array',
        'jumlah_pesanan' => 'array'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
