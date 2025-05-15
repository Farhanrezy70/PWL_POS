<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Pastikan mengimpor DB
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data yang akan dimasukkan ke dalam tabel m_supplier
        $data = [
            [
                'supplier_id' => 1,
                'supplier_nama' => 'Bagas', // Pastikan nilai dalam tanda kutip
            ],
            [
                'supplier_id' => 2,
                'supplier_nama' => 'Agus',  // Pastikan nilai dalam tanda kutip
            ],
            [
                'supplier_id' => 3,
                'supplier_nama' => 'Beni',  // Pastikan nilai dalam tanda kutip
            ],
        ];

        // Insert data ke tabel m_supplier
        DB::table('m_supplier')->insert($data);
    }
}
