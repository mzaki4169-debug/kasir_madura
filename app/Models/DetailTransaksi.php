<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';

    protected $fillable = [
        'transaksi_id',
        'barang_id',
        'qty',
        'harga',
        'subtotal'
    ];

    // Relasi balik ke Transaksi utama
   public function barang()
{
    return $this->belongsTo(Barang::class);
}

public function transaksi()
{
    return $this->belongsTo(Transaksi::class);
}
}