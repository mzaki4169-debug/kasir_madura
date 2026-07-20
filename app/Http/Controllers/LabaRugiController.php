<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;

class LabaRugiController extends Controller
{
    public function index()
    {
        $detail = DetailTransaksi::with('barang')
            ->latest()
            ->get();

        $totalLaba = 0;

        foreach ($detail as $item) {

            $laba =
                ($item->harga - $item->barang->harga_beli)
                * $item->qty;

            $totalLaba += $laba;

            $item->laba = $laba;
        }

        return view(
            'laporan.laba',
            compact(
                'detail',
                'totalLaba'
            )
        );
    }
}