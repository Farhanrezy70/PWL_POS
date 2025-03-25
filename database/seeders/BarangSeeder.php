<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'kategori_id' => rand(1, 5),
                'barang_kode' => 'BR00' . $i,
                'barang_nama' => 'Barang ' . $i,
                'harga_beli' => rand(10000, 50000),
                'harga_jual' => rand(60000, 100000),
            ];
        }

        DB::table('m_barang')->insert($data);
    }
}
