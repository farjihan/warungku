<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    public function barang(){
        return $this->belongsTo(Barang::class);
    }

    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }

    protected $fillable = [
        'transaksi_id',
        'barang_id',
        'jumlah',
        'harga_satuan',
        'subtotal',
    ];
}
