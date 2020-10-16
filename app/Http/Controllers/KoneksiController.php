<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KoneksiController extends Controller
{
    public function index(){
        $title = 'Master Koneksi';
        return view('master.koneksi.index', compact('title'));
    }
}
