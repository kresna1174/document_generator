<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jenis_dokumen_m;
use App\cetak_m;
use App\objek_m;
class CetakController extends Controller
{
    public function index(){
        $title = 'Cetak';
        return view('cetak.index', compact('title'));
    }

    public function get_data(){
        $model = jenis_dokumen_m::_objek()->get();
        return view('cetak.get', compact('model'));
    }

    public function create($id){
        $model = jenis_dokumen_m::_objek()->find($id);
        $nama_surat = jenis_dokumen_m::pluck('nama_surat', 'id');
        return view('cetak.create', compact('nama_surat', 'model'));
    }

    public function store(Request $request, $id){
        $rules = self::validation($request->all());
        $messages = self::validation_message($request->all());
        $validator = \Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'message' => 'error input',
                'errors' => $validator->messages()
            ], 400);
        }
    //     $credentials = $request->key;
    //     $model = objek_m::get('nama_kolom');
    //     $data = objek_m::find($id);
    //     foreach($model as $row){
    //         if($data){
    //            if($credentials === $row['nama_kolom']){
    //                return response()->json([
    //                    'message' => 'sukses',
    //                    'success' => true
    //                 ], 200);
    //             }else{
    //                 return response()->json([
    //                     'message' => 'key salah',
    //                     'success' => false
    //                 ], 400);
    //            }
    //        }else{
    //             return response()->json([
    //                 'message' => 'key tidak di temukan',
    //                 'success' => false
    //             ], 400);
    //        }
    //    }
        $credentials = [
            'password' => $request->key
        ];
        if (\Auth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => 'login sukses!!'
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password Salah'
            ], 400);
        }
    }

    public function view(){
        return view('cetak.view');
    }


    public function validation(){
        return [
            'key' => 'required'
        ];
    }

    public function validation_message(){
        $messages = [];
        $messages['key.required'] = 'Nama surat harus di isi';
        return $messages;
    }
}
