<?php

namespace App;
use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;

class jenis_dokumen_m extends Model
{
    protected $table = 'jenis_dokumen';
    protected $primary_key = 'id';
    protected $guarded = [];
    public $timestamps = false;

    // public function scope_Objek($query){
    //     return $query->select('objek.id_jenis_dokumen', 'objek.objek', 'jenis_dokumen.*','koneksi.judul')
    //     ->leftJoin('koneksi', 'koneksi.id', 'jenis_dokumen.id_koneksi')
    //     ->leftJoin('objek', 'objek.id', 'jenis_dokumen.id_objek');
    // }

    public function scope_dashboard($query){
        return $query->select('objek.*', 'objek.objek', 'jenis_dokumen.*', 'koneksi.judul')
        ->leftJoin('koneksi', 'koneksi.id', 'jenis_dokumen.id_koneksi')
        ->leftJoin('objek', 'objek.id', 'jenis_dokumen.id_objek');
    }
}
