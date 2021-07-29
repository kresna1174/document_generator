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
            'name'      => $request->input('name'),
            'password'  => $request->input('password'),
        ];

        $rules = [
            'name'                  => 'required|string',
            'password'              => 'required|string'
        ];

        $messages = [
            'name.required'         => 'Username wajib diisi',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];
        $response = 'Username atau Password Salah';

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
