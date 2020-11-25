<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cetak_m extends objek_m
{
    protected $table = 'cetak';
    protected $guarded = [];
    protected $primary_key = 'id';
    public $timestamps = false;

    public function scope_Jenis_dokumen($query){
        return $query->select('jenis_dokumen.*', 'objek.*', 'koneksi.*')
            ->leftJoin('jenis_dokumen', 'jenis_dokumen.id', 'cetak.id_jenis_dokumen')
            ->leftJoin('objek', 'objek.id', 'cetak.id_objek')
            ->leftJoin('koneksi', 'koneksi.id', 'cetak.id_koneksi');
    }
}
