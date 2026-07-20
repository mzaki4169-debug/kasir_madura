<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class DashboardController extends Controller
{
    public function index()
{
    $totalBarang = Barang::count();
    $totalKategori = Kategori::count();
    $totalTransaksi = Transaksi::count();

    $penjualanHariIni = Transaksi::whereDate(
        'tanggal',
        today()
    )->sum('total');

    $grafik = Transaksi::selectRaw("
    DATE(tanggal) as tanggal,
    SUM(total) as total
")
->groupByRaw("DATE(tanggal)")
->orderBy("tanggal")
->limit(7)
->get();

    $profitHariIni = DetailTransaksi::with('barang')
    ->whereHas('transaksi', function ($q) {
        $q->whereDate('tanggal', today());
    })
    ->get()
    ->sum(function ($item) {
        return ($item->harga - $item->barang->harga_beli)
                * $item->qty;
    });

    $stokMenipis = Barang::where('stok', '<=', 5)->get();

    $barangTerlaris = DetailTransaksi::selectRaw(
        'barang_id, SUM(qty) as total_terjual'
    )
    ->with('barang')
    ->groupBy('barang_id')
    ->orderByDesc('total_terjual')
    ->take(5)
    ->get();

    $grafikProfit = DetailTransaksi::join(
    'barang',
    'detail_transaksi.barang_id',
    '=',
    'barang.id'
)
->join(
    'transaksi',
    'detail_transaksi.transaksi_id',
    '=',
    'transaksi.id'
)
->selectRaw("
    MONTH(transaksi.tanggal) as bulan,
    SUM(
        (detail_transaksi.harga - barang.harga_beli)
        * detail_transaksi.qty
    ) as profit
")
->groupByRaw("MONTH(transaksi.tanggal)")
->orderBy("bulan")
->get();

    $totalNilaiStok = Barang::sum(
    DB::raw('stok * harga_beli')
);

    $transaksiTerbaru = Transaksi::latest()
    ->take(5)
    ->get();

   return view('dashboard', compact(
    'totalBarang',
    'totalKategori',
    'totalTransaksi',
    'penjualanHariIni',
    'profitHariIni',
    'grafik',
    'stokMenipis',
    'barangTerlaris',
    'grafikProfit',
    'totalNilaiStok',
    'transaksiTerbaru'
));
}
}