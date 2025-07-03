<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class isi_barang extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangs = [
            ['Indomie Ayam Bawang', 'Mie', 20, 3000],
            ['Indomie Goreng', 'Mie', 25, 3000],
            ['Mie Sedap Soto', 'Mie', 15, 2900],
            ['Mie Sedap Goreng', 'Mie', 10, 2900],
            ['Aqua Botol 600ml', 'Minuman', 30, 4000],
            ['Teh Pucuk', 'Minuman', 20, 5000],
            ['Fanta Kaleng', 'Minuman', 15, 6000],
            ['Coca Cola Botol', 'Minuman', 10, 7000],
            ['Pulpen Standard', 'Alat Tulis', 50, 2500],
            ['Pensil 2B', 'Alat Tulis', 40, 1500],
            ['Buku Tulis Sidu', 'Alat Tulis', 35, 3000],
            ['Penghapus Joyko', 'Alat Tulis', 25, 1000],
            ['Beras 1kg', 'Sembako', 10, 13000],
            ['Minyak Goreng 1L', 'Sembako', 10, 16000],
            ['Gula Pasir 1kg', 'Sembako', 12, 14000],
            ['Garam Dapur', 'Sembako', 20, 2000],
            ['Susu Indomilk Kotak', 'Minuman', 15, 6000],
            ['Roti Tawar Sari Roti', 'Snack', 10, 8000],
            ['Biskuit Roma Kelapa', 'Snack', 18, 5000],
            ['Chitato Sapi Panggang', 'Snack', 12, 7000],
            ['SilverQueen Mini', 'Snack', 14, 8500],
            ['Kopi ABC Sachet', 'Minuman', 50, 1500],
            ['Good Day Sachet', 'Minuman', 45, 1700],
            ['Yakult 5 Pack', 'Minuman', 8, 10000],
            ['Sikat Gigi Formula', 'Toiletries', 20, 5500],
            ['Sabun Lifebuoy', 'Toiletries', 25, 3500],
            ['Shampoo Sunsilk Sachet', 'Toiletries', 40, 1000],
            ['Pasta Gigi Pepsodent', 'Toiletries', 30, 4500],
            ['Tissue Paseo Mini', 'Toiletries', 20, 4000],
            ['Telur Ayam 1 Butir', 'Sembako', 100, 2500],
            // ... lanjutkan sampai 100 barang ...
        ];

        // Duplikasi list agar menjadi 100 item
        $barangs = array_merge($barangs, $barangs, $barangs, $barangs); // sekarang ada 120+
        $barangs = array_slice($barangs, 0, 100); // ambil 100 teratas

        foreach ($barangs as $barang) {
            DB::table('barangs')->insert([
                'nama' => $barang[0],
                'kategori' => $barang[1],
                'stok' => $barang[2],
                'harga_ecer' => $barang[3],
            ]);
        }
    }
}