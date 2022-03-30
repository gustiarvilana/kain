<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master', function (Blueprint $table) {
            $table->string('jenis');
            $table->string('warna');
            $table->integer('berat_kg');
            $table->double('harga_kg');
            $table->integer('jumlah');
            $table->integer('sts_produk');
            $table->double('harga_beli');
            $table->double('hpp');
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
        Schema::dropIfExists('tbl_master');
    }
}
