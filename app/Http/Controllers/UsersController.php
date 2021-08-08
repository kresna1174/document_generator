<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $title = 'Users';
        return view('master.users.index', compact('title'));
    }

    public function get(){
        $model = User::all();
        return view('master.users.get', compact('model'));
    }

    public function create(){
        return view('master.users.create');
    }

    public function get_data(){
        $model = User::orderBy('id', 'ASC')->get();
        $response    = [
            'message' => 'Data User Berdasarkan ID',
            'data'    => $model
        ];
        return response()->json($response, Response::HTTP_OK);
    }


    public function store(Request $request)
    {
        $rules = [
            'name'                  => 'required|min:3',
            'password'              => 'required',
            'confirm'               => 'required|same:password'
        ];

        $messages = [
            'name.required'         => 'Nama harus diisi',
            'name.min'              => 'Nama minimal 3 karakter',
            'password.required'     => 'Password harus diisi',
            'confirm.required'      => 'Konfirmasi password harus diisi',
            'confirm.same'          => 'Password tidak sama dengan konfirmasi password'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'message'   => 'Gagal Menambahkan User',
                'errors'    => $validator->errors()
            ], 400);
        }

        $users = new User;
        $users->name = ($request->name);
        $users->password = Hash::make($request->password);
        $simpan = $users->save();

        if($simpan){
            return [
                'success' => true,
                'message' => 'Data Berhasil Di Tambahkan'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'Data Gagal Di Tambahkan'
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $model = User::findOrFail($id);
        return view('master.users.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function keygen($id){
        $model = User::findOrFail($id);
        $key = Str::random(128);
        if($model->update(['key' => $key])){
            return redirect()->back()->with('data', $key);
        } else {
            return redirect()->back()->with('errors', 'Generate Gagal');
        }
    }

    public function change_password(Request $request,$id){
        $model = User::findOrFail($id);
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

        $hashedPassword = $model->password;
        if (Hash::check($request->oldpassword , $hashedPassword)) {
                $users = User::find($model->id);
                $users->update(['password' => bcrypt($request->newpassword)]);
            if($users){
                return redirect()->back()->with('new','Berhasil Mengganti Password');
            }
            else{
                Session::flash('errors');
                return redirect()->back();
            }
        }
        else{
            Session::flash('errors');
            return redirect()->back();
        }
    }

    public function name(Request $request,$id){
        $data = User::findOrFail($id);
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

    public function destroy($id)
    {
        $model = User::find($id);
        if($model){
            if($model->delete()){
                return [
                    'success' => true,
                    'message' => 'Data Berhasil Di Hapus'
                ];
            }else{
                return [
                    'success' => false,
                    'message' => 'Data Gagal Di Hapus'
                ];
            }
        }else{
            return [
                'success' => false,
                'message' => 'Data Tidak Di Temukan'
            ];
        }
    }
}
