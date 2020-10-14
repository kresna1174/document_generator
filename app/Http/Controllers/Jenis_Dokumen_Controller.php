<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Jenis_Dokumen_Controller extends Controller
{
    public function index(){
        return view('master.jenis_dokumen.index');
    }
}
