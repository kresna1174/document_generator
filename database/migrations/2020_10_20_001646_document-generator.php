<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocumentGenerator extends Migration
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
            $table->string('koneksi');
            $table->string('objek_tipe');
            $table->string('nama_table');
            $table->string('nama_kolom');
        });
        Schema::create('koneksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_db');
            $table->string('username');
            $table->string('password');
            $table->string('host');
            $table->string('port');
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
        Schema::dropIfExists('koneksi');
    }
}
