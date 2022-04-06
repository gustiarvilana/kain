<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('tbl_pembelian')->insert([
            'id_pembelian' => 1,
            'id_produk' => 1,
            'tgl_trs' => '20220401',
            'jumlah' => '10',
            'harga_satuan' => '30000',
            'total_harga' => '300000',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
