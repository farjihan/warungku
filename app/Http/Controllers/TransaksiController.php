<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use DB;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->get();
        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = Barang::all();
        return view('transaksi.create', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barangs,id',
            'jumlah.*' => 'required|integer|min:1',
            'harga_satuan.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $transaksi = Transaksi::create([
                'tanggal' => $request->tanggal,
                'pembeli' => $request->pembeli,
                'total_harga' => 0,
                'user_id' => auth()->id(),
            ]);

            $total = 0;

            foreach ($request->barang_id as $index => $barang_id) {
                $barang = Barang::findOrFail($barang_id);
                $jumlah = $request->jumlah[$index];
                $harga = $request->harga_satuan[$index];

                if ($barang->stok < $jumlah) {
                    return back()->withErrors(['stok' => "Stok barang {$barang->nama} tidak cukup"]);
                }

                $barang->stok -= $jumlah;
                $barang->save();

                $subtotal = $jumlah * $harga;
                $total += $subtotal;

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $barang_id,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $harga,
                    'subtotal' => $subtotal,
                ]);
            }

            $transaksi->total_harga = $total;
            $transaksi->save();

            DB::commit();
            return redirect()->route('struk.show', $transaksi->id)->with('success', 'Transaksi multi-barang berhasil dicatat!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan transaksi.']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        $transaksi->load('detail.barang');
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksi::with('detail.barang')->findOrFail($id);
        $barang = Barang::all();
        return view('transaksi.edit', compact('transaksi', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barangs, id',
            'jumlah.*' => 'required|integer|min:1',
            'harga_satuan.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $transaksi = Transaksi::with('detail')->findOrFail($id);

            //kembalikan stok lama
            foreach ($transaksi->detail() as $item) {
                $item->barang->stok += $item->jumlah;
                $item->barang->save();
            }

            //Hapus detail lama
            $transaksi->detail()->delete();

            //Update data transaksi utama
            $transaksi->update([
                'tanggal' => $request->tanggal,
                'pembeli' => $request->pembeli,
            ]);

            //Simpan detail baru
            $total = 0;

            foreach ($request->barang_id as $i => $barang_id) {
                $barang = Barang::findOrFail($barang_id);
                $jumlah = request()->jumlah[$i] + $barang->jumlah;
                $harga = request()->harga_satuan[$i];

                if ($barang->stok < $jumlah) {
                    return back()->withErrors(['stok' => "Stok Barang {$barang->nama} tidak cukup"]);
                }

                $barang->stok -= $jumlah;
                $barang->save();

                $subtotal = $jumlah * $harga;
                $total += $subtotal;

                DetailTransaksi::created([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $barang->id,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $harga,
                    'subtotal' => $subtotal
                ]);
            }
            $transaksi->update([
                'total_harga' => $total,
            ]);

            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi Berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memperbarui transaksi.']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        DB::beginTransaction();

        try {

            foreach ($transaksi->detail as $item) {
                $barang = $item->barang;
                $barang->stok += $item->jumlah;
                $barang->save();
            }
            $transaksi->detail()->delete();
            $transaksi->delete();

            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus dan stook dikembalikan.');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors([
                'error' => 'Gagal menghapus transaksi.'
            ]);
        }
    }
}
