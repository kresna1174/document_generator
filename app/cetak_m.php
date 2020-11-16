<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cetak_m extends Model
{
    protected $table = 'cetak';
    protected $guarded = [];
    protected $primary_key = 'id';
    public $timestamps = false;

    public function scope_Jenis_dokumen($query){
        return $query->select('jenis_dokumen.*', 'cetak.id_nama_surat')
            ->leftJoin('jenis_dokumen', 'jenis_dokumen.id', 'cetak.id');
    }
}
