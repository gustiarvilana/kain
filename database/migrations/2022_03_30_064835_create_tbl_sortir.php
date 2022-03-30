<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSortir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sortir', function (Blueprint $table) {
            $table->bigInteger('id_sortir');
            $table->bigInteger('id_jenis');
            $table->bigInteger('id_supplier');
            $table->string('warna');
            $table->integer('berat');
            $table->double('jumlah');
            $table->double('tgl_sortir');
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
        Schema::dropIfExists('tbl_sortir');
    }
}
