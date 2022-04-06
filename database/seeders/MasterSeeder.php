<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_master')->insert([
            'jenis' => 'Kain',
            'warna' => 'Merah',
            'berat_kg' => '10',
            'harga_kg' => '30000',
            'jumlah' => '10',
            'sts_produk' => '1',
            'harga_beli' => '20000',
            'hpp' => '40000',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
