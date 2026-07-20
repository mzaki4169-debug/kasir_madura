<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        Barang::insert([
            [
                'kategori_id' => 1,
                'kode_barang' => 'BRG001',
                'nama_barang' => 'Indomie Goreng',
                'harga_beli' => 3000,
                'harga_jual' => 4000,
                'stok' => 100,
                'satuan' => 'pcs',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kategori_id' => 2,
                'kode_barang' => 'BRG002',
                'nama_barang' => 'Aqua 600ml',
                'harga_beli' => 2500,
                'harga_jual' => 3500,
                'stok' => 80,
                'satuan' => 'botol',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}