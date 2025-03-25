<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'user_id' => rand(1, 3),
                'pembeli' => 'Pelanggan ' . $i,
                'penjualan_kode' => 'PJ00' . $i,
                'penjualan_tanggal' => Carbon::now(),
            ];
        }

        DB::table('t_penjualan')->insert($data);
    }
}
