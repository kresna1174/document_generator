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
    protected $fillable = ['objek', 'koneksi', 'objek_tipe', 'nama_table', 'nama_kolom'];
    public $timestamps = false;

    public function scope_Koneksi($query){
        $query->select('*')
        ->leftJoin('koneksi', 'koneksi.id', 'objek.id');
    }

}
