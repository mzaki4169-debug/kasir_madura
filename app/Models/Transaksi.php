<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'total',
        'bayar',
        'kembalian',
        'user_id'
    ];

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}