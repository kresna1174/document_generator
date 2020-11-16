<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jenis_dokumen_m;
use App\cetak_m;
class CetakController extends Controller
{
    public function index(){
        $title = 'Cetak';
        return view('cetak.index', compact('title'));
    }

    public function get_data(){
        $model = cetak_m::_jenis_dokumen()->get();
        return view('cetak.get', compact('model'));
    }

    public function create(){
        $nama_surat = jenis_dokumen_m::pluck('nama_surat', 'id');
        return view('cetak.create', compact('nama_surat'));
    }

    public function store(Request $request){
        $rules = self::validation($request->all());
        $messages = self::validation_message($request->all());
        $validator = \Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'message' => 'error input',
                'errors' => $validator->messages()
            ], 400);
        }

        if(cetak_m::create($request->all())){
            return [
                'success' => true,
                'message' => 'data berhasil di tambahkan'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'data gagal di tambahkan'
            ];
        }
    }

    public function edit($id){
        $model = cetak_m::findOrFail($id);
        $nama_surat = jenis_dokumen_m::pluck('nama_surat', 'id');
        return view('cetak.edit', compact('model', 'nama_surat'));
    }

    public function update(Request $request, $id){
        $rules = self::validation($request->all());
        $messages = self::validation_message($request->all());
        $validator = \Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'message' => 'error input',
                'errors' => $validator->messages()
            ], 400);
        }
        $model = cetak_m::findOrFail($id);
        if($model::update($request->all())){
            return [
                'success' => true,
                'message' => 'data berhasil di update'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'data gagal di update'
            ];
        }
    }

    public function validation(){
        return [
            'id_nama_surat' => 'required'
        ];
    }

    public function validation_message(){
        $messages = [];
        $messages['id_nama_surat.required'] = 'Nama surat harus di isi';
        return $messages;
    }
}
