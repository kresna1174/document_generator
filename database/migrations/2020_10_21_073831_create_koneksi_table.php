<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKoneksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('koneksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_db', 20);
            $table->string('username', 64);
            $table->string('password', 64)->nullable();
            $table->string('host', 64);
            $table->string('port', 64);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('koneksi');
    }
}
