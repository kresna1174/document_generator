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
            $table->string('objek');
            $table->string('id_koneksi');
            $table->string('id_objek_tipe');
            $table->string('nama_table')->nullable();
            $table->string('nama_kolom')->nullable();
            $table->string('query')->nullable();
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
