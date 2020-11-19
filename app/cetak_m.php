<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cetak_m extends objek_m
{
    protected $table = 'cetak';
    protected $guarded = [];
    protected $primary_key = 'id';
    public $timestamps = false;

    // public function scope_Jenis_dokumen($query){
    //     return $query->select('jenis_dokumen.nama_surat', 'objek.objek', 'koneksi.judul')
    // }
}
