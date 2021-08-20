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

    public function get_api($id){
        $model = User::findOrFail($id);
        if($model) {
            return response()->json([
                'success' => true,
                'message' => $model
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Tidak Di Temukan'
            ]);
        }
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
            'username'              => 'required|min:3',
            'name'                  => 'required|min:3',
            'password'              => 'required',
            'confirm'               => 'required|same:password'
        ];

        $messages = [
            'username.required'     => 'Username harus diisi',
            'username.min'          => 'Username minimal 3 karakter',
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
        $users->username = ($request->username);
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
    public function reset($id){
        $model = User::findOrFail($id);
        return view('master.users.reset', compact('model'));
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
            'password'              => 'required',
            'confirmed'             => 'required|same:password'
        ];
        $mesagges = [
            'password.required'           => 'Password Baru Harus Diisi',
            'confirmed.required'          => 'Konfirmasi Password Harus Diisi',
            'confirmed.same'              => 'Password Tidak Sama Dengan Konfirmasi Password'
        ];

        $validator = Validator::make($request->all(), $rules, $mesagges);
        if($validator->fails()){
            return response()->json([
                'message'   => 'Gagal Mengganti Password',
                'errors'    => $validator->errors()
            ], 400);
        }
        $hashedValue= $model->password;
        if(Hash::check($request->password, $hashedValue)){
            return [
                'success' => false,
                'message' => "Password Harus Baru"
            ];
        }
        $users = User::find($model->id);
        $users->update(['password' => bcrypt($request->password)]);
        if($users){
            return[
                'success' => true,
                'message' => 'Data Berhasil Di Update'
            ];
        }
        else{
            return [
                'success' => false,
                'message' => 'Data Gagal Di Tambahkan'
            ];
        }
    }

    public function name(Request $request,$id){
        $data = User::findOrFail($id);
        $rules = [
            'name'              => 'required|min:3',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                'message'   => 'Gagal Mengganti Password',
                'errors'    => $validator->errors()
            ], 400);
        }

        $data -> update(['name' => $request->name]);
        if($data){
            return[
                'success' => true,
                'message' => 'Data Berhasil Di Update'
            ];
        }
    }

    public function view($id){
        $model = User::findOrFail($id);
        return view('master.users.view', compact('model'));
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
