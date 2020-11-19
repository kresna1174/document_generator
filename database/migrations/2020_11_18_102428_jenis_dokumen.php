<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JenisDokumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_dokumen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_surat', 64);
            $table->string('file', 255);
            $table->integer('id_objek')->length(11)->unsigned();
            $table->integer('id_koneksi')->length(11)->unsigned();
            $table->integer('id_objek_tipe')->length(11)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_dokumen');
    }
}
