<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Symfony\Component\VarDumper\Cloner\Data;

class SettingController extends Controller
{
    public function user(){
        return view('dashboard.usersetting');
    }

    public function keygen(){
        $key = Str::random(128);
        $model = User::findOrFail(auth()->user()->id);
        if($model->update(['key' => $key])){
            return redirect()->back()->with('data', $key);

        } else {
            return redirect()->back()->with('errors', 'Generate Gagal');
        }
    }

    public function api_keygen($id){
        $model = User::findOrFail($id);
        return response()->json([
            'key' => $model->key
        ]);
    }
}
