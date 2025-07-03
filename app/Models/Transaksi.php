<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    protected $fillable = [
        'tanggal',
        'pembeli',
        'total_harga',
        'user_id'
    ];
}
