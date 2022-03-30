<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_penjualan', function (Blueprint $table) {
            $table->bigInteger('id_penjualan')->primary();
            $table->bigInteger('kd_produk');
            $table->string('warna');
            $table->integer('berat');
            $table->double('jumlah');
            $table->double('harga_satuan');
            $table->double('harga_total');
            $table->double('tgl_trs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_penjualan');
    }
}
