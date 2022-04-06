<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SortirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_sortir')->insert(
            [
            'id_sortir' => 1,
            'id_jenis' => 1,
            'id_supplier' => 1,
            'warna' => 'Merah',
            'berat' => '5',
            'jumlah' => '1',
            'tgl_sortir' => '20220401',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
            ],
            [
            'id_sortir' => 2,
            'id_jenis' => 1,
            'id_supplier' => 1,
            'warna' => 'Biru',
            'berat' => '5',
            'jumlah' => '1',
            'tgl_sortir' => '20220401',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
            ]
    );
    }
}
