<?php

namespace App;
use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;

class objek_m extends Model
{
    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new StatusScope);
    }
    
    protected $table = 'objek';
    protected $primary_key = 'id';
    protected $guarded = [];
    public $timestamps = false;

    public function scope_Koneksi($query){
        return $query->select('koneksi.nama_db', 'koneksi.judul', 'koneksi.username', 'koneksi.password', 'koneksi.host', 'koneksi.port', 'objek.objek','objek.id', 'objek.nama_table', 'objek.id_koneksi', 'objek.id_objek_tipe', 'objek.id_jenis_dokumen', 'objek.nama_kolom', 'objek.query', 'objek_tipe.objek_tipe', 'jenis_dokumen.nama_surat', 'jenis_dokumen.file')
        ->leftJoin('koneksi', 'koneksi.id', 'objek.id_koneksi')
        ->leftJoin('jenis_dokumen', 'jenis_dokumen.id', 'objek.id')
        ->leftJoin('objek_tipe', 'objek_tipe.id', 'objek.id_objek_tipe');
    }

    public function scope_jenis_dokumen($query){
        return $query->select('koneksi.nama_db', 'koneksi.judul', 'koneksi.username', 'koneksi.password', 'koneksi.host', 'koneksi.port', 'objek.objek','objek.id', 'objek.nama_table', 'objek.id_koneksi', 'objek.id_objek_tipe', 'objek.id_jenis_dokumen', 'objek.nama_kolom', 'objek.query', 'objek_tipe.objek_tipe', 'jenis_dokumen.nama_surat', 'jenis_dokumen.file')
        ->leftJoin('koneksi', 'koneksi.id', 'objek.id_koneksi')
        ->leftJoin('jenis_dokumen', 'jenis_dokumen.id', 'objek.id')
        ->leftJoin('objek_tipe', 'objek_tipe.id', 'objek.id_objek_tipe');
    }

    // public function scope_Get_all($query){
    //     return $query->select('koneksi.judul', 'objek.objek', 'jenis_dokumen.nama_surat')
    //     ->leftJoin('jenis_dokumen', 'jenis_dokumen.id', 'objek.id')
    //     ->leftJoin('koneksi', 'koneksi.id', 'objek.id_koneksi');
    // }

}