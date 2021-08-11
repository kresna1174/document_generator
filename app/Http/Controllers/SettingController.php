<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function change_password(Request $request){
        $rules = [
            'oldpassword'           => 'required',
            'newpassword'           => 'required',
            'confirmed'             => 'required|same:newpassword'
        ];
        $mesagges = [
            'oldpassword.required'        => 'Password Lama Harus Diisi',
            'newpassword.required'        => 'Password Baru Harus Diisi',
            'confirmed.required'          => 'Konfirmasi Password Harus Diisi',
            'confirmed.same'              => 'Password Tidak Sama Dengan Konfirmasi Password'
        ];

        $validator = Validator::make($request->all(), $rules, $mesagges);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        if (Hash::check($request->oldpassword ,  auth()->user()->password )) {
            if (!Hash::check($request->newpassword , auth()->user()->password)) {
                $users = User::find(auth()->user()->id);
                $users->update(['password' => bcrypt($request->newpassword)]);
                if($users){
                    return redirect()->back()->with('new', 'Berhasil Mengganti Password');
                }
                else{
                    Session::flash('errors');
                    return redirect()->back();
                }
            }else{
                session()->flash('old','Password Harus Baru');
                return redirect()->back();
            }
        }else{
            session()->flash('old','Password Lama Salah');
            return redirect()->back();
        }
    }

    public function name(Request $request){
        $data = User::findOrFail(auth()->user()->id);
        $rules = [
            'name'              => 'required|min:3',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()->with('error', 'Nama minimal 3 karakter');
        }

        $data -> update(['name' => $request->name]);
        if($data){
            return redirect()->back()->with('success', 'Berhasil Mengubah Nama');
        }
    }
}