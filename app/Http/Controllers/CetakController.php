<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function index(){
        $title = 'Cetak';
        return view('cetak.index', compact('title'));
    }
}
