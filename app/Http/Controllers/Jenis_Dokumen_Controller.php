<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\pos_m;

class Jenis_Dokumen_Controller extends Controller
{
    public function index(){
        $title = 'Master Jenis Dokumen';
        return view('master.jenis_dokumen.index', compact('title'));
    }

    public function get_data(){
        return Datatables::of(pos_m::all())
        ->make(true);
        return view('master.jenis_dokumen.index');
    }
}
