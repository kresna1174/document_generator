<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class objek_m extends Model
{
    protected $table = 'object';
    protected $fillable = ['objek', 'koneksi', 'objek_tipe', 'nama_table', 'nama_kolom'];
    public $timestamps = false;
}
