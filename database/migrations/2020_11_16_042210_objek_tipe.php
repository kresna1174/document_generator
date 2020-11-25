<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ObjekTipe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_tipe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('objek_tipe', 64);
        });
        \DB::table('objek_tipe')->insert([
            'objek_tipe' => 'table',
        ]);
        \DB::table('objek_tipe')->insert([
            'objek_tipe' => 'query',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objek_tipe');
    }
}
