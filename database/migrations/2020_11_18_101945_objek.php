<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Objek extends Migration
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
            $table->integer('id_koneksi')->length(11)->unsigned();
            $table->integer('id_objek_tipe')->length(11)->unsigned();
            $table->string('nama_table', 64)->nullable();
            $table->string('nama_kolom', 64)->nullable();
            $table->longText('query')->nullable();
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
