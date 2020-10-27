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
        return $query->select('koneksi.nama_db', 'koneksi.username', 'koneksi.password', 'koneksi.host', 'koneksi.port', 'objek.objek','objek.id', 'objek.nama_table', 'objek.id_koneksi', 'objek.id_objek_tipe', 'objek.nama_kolom', 'objek_tipe.objek_tipe')
        ->leftJoin('koneksi', 'koneksi.id', 'objek.id_koneksi')
        ->leftJoin('objek_tipe', 'objek_tipe.id', 'objek.id_objek_tipe');
    }

}
