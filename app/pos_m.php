<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pos_m extends Model
{
    // protected $connection = 'mysql2';
    protected $table = 'koneksi';
    protected $fillable = ['nama_db', 'username', 'password', 'host', 'port'];
    public $timestamps = false;
    
}
