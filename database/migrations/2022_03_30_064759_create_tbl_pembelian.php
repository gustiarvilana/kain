<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pembelian', function (Blueprint $table) {
            $table->bigInteger('id_pembelian')->primary();
            $table->bigInteger('id_produk');
            $table->double('tgl_trs');
            $table->integer('jumlah');
            $table->double('harga_satuan');
            $table->double('total_harga');
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
        Schema::dropIfExists('tbl_pembelian');
    }
}
