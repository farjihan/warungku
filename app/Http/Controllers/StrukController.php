<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\PDF;
class StrukController extends Controller
{
    public function show ($id) {
        $transaksi = Transaksi::with('detail.barang')->findOrfail($id);
        return view('struk.show', compact('transaksi'));
    }
    // public function pdf($id){
    //     $transaksi = Transaksi::with('detail.barang')->findOrFail($id);
    //     $pdf = Pdf::loadview('struk.show', compact('transaksi'));
    //     return $pdf->download('struk_transaksi_'.$id.'.pdf');
    // }
}
