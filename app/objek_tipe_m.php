<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class objek_tipe_m extends Model
{
    protected $table = 'objek_tipe';
    protected $primary_key = 'id';
    protected $guarded = [];
    public $timestimes = false;
}
