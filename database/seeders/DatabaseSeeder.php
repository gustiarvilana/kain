<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(PembelianSeeder::class);
        $this->call(PenjualanSeeder::class);
        $this->call(SortirSeeder::class);
        $this->call(jenisSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(MasterSeeder::class);
    }
}
