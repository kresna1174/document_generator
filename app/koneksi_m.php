<?php

namespace App;
use App\Scopes\StatusScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class koneksi_m extends Model
{
    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new StatusScope);
    }

    // protected $connection = 'mysql2';
    protected $table = 'koneksi';
    protected $fillable = ['nama_db', 'username', 'password', 'host', 'port', 'judul'];
    public $timestamps = false;
}
