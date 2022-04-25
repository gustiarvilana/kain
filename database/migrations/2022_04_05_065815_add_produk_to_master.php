<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProdukToMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_master', function (Blueprint $table) {
            $table->string('jenis')->change();
            $table->string('kd_produk')->after('jenis');
            $table->string('kd_jenis')->after('kd_produk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_master', function (Blueprint $table) {
            //
        });
    }
}
