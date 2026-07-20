<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'kategori_id',
        'kode_barang',
        'nama_barang',
        'harga_beli',
        'harga_jual',
        'stok',
        'satuan'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}