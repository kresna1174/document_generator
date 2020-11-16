<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableObjek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('objek', 64);
            $table->integer('id_koneksi', 11);
            $table->integer('id_objek_tipe', 11);
            $table->string('nama_table', 64)->nullable();
            $table->string('nama_kolom', 64)->nullable();
            $table->string('query', 64)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objek');
    }
}
