<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_kategori' => 'Makanan'],
            ['nama_kategori' => 'Minuman'],
            ['nama_kategori' => 'Rokok'],
            ['nama_kategori' => 'Sembako']
        ];

        foreach ($data as $item) {
            Kategori::create($item);
        }
    }
}