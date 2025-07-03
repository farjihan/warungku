<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
    'nama',
    'kategori',
    'satuan',
    'stok',
    'harga_ecer',
    'harga_grosir',
];
}

