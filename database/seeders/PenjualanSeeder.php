<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_penjualan')->insert([
            'id_penjualan' => 1,
            'kd_produk' => 1,
            'warna' => 'merah',
            'berat' => '3',
            'jumlah' => '1',
            'harga_satuan' => '300000',
            'harga_total' => '300000',
            'tgl_trs' => '300000',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
