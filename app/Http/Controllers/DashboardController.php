<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        $start = Carbon::now()->subDays(6)->startOfDay();
        $end   = Carbon::now()->endOfDay();

        $raw = Transaksi::whereBetween('tanggal', [$start, $end])
            ->selectRaw('DATE(tanggal) as tanggal, SUM(total_harga) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get()
            ->pluck('total', 'tanggal')
            ->toArray();

        // Pastikan semua hari ada
        $labels = [];
        $data   = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = Carbon::now()->subDays($i)->toDateString();
            $labels[] = Carbon::parse($day)->isoFormat('ddd'); // Sen, Sel, ...
            $data[]   = $raw[$day] ?? 0;
        }


        $stokMinimal = 5;
        $barangHabis = Barang::where('stok', '<=', $stokMinimal)->get();

        return view('dashboard', compact('labels', 'data', 'barangHabis'));
    }
}
