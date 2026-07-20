<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;

        $query = Transaksi::query();

        if ($dari && $sampai) {
            $query->whereBetween(
                'tanggal',
                [$dari, $sampai]
            );
        }

        $laporan = $query
            ->latest()
            ->paginate(10);

        return view(
            'laporan.index',
            compact(
                'laporan',
                'dari',
                'sampai'
            )
        );
    }

    public function export(Request $request)
    {
        return Excel::download(
            new LaporanExport(
                $request->dari,
                $request->sampai
            ),
            'laporan_penjualan.xlsx'
        );
    }
}