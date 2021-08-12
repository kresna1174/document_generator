<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Scope\User;

class AuthController extends Controller
{
    public function start(){

        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('start');
    }

    public function login(Request $request){
        $data = [
            'username'  => $request->input('username'),
            'password'  => $request->input('password'),
        ];

        $rules = [
            'username'              => 'required|string',
            'password'              => 'required|string'
        ];

        $messages = [
            'username.required'     => 'Username wajib diisi',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        Auth::attempt($data);


        if (Auth::check()) {
            return redirect()->route('dashboard');

        } else {
            return redirect()->route('form')->with('errors', 'Username atau Password Salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('start');
    }
}
