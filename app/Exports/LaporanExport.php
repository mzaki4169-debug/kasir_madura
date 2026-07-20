<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromCollection
{
    protected $dari;
    protected $sampai;

    public function __construct($dari,$sampai)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
    }

    public function collection()
    {
        return Transaksi::whereBetween(
            'tanggal',
            [
                $this->dari,
                $this->sampai
            ]
        )->get([
            'kode_transaksi',
            'tanggal',
            'total'
        ]);
    }
}