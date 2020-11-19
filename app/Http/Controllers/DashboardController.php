<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\objek_m;
use App\cetak_m;
use App\jenis_dokumen_m;

class DashboardController extends Controller
{
    public function index(){
        $title = 'Dashboard';
        return view('dashboard.index', compact('title'));
    }

    public function get_data(){
        return \DataTables::of(jenis_dokumen_m::_objek()->get())
            ->make(true);
        return view('dashboard.index');
    }

    public function edit($id){
        $model = objek_m::findOrFail($id);
        return view('dashboard.edit', compact('model'));
    }

    public function view($id){
        $model = objek_m::_koneksi()->findOrFail($id);
        return view('dashboard.view', compact('model'));
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
        $model = objek_m::findOrFail($id);
        $data = [
            'nama_kolom' => $request->key
        ];
        if($model::update($data)){
            return [
                'message' => 'update success',
                'seucces' => true
            ];
        }else{
            return [
                'message' => 'update fails',
                'seucces' => false
            ];
        }
    }

    public function download($id){
        $model = jenis_dokumen_m::findOrFail($id);
        if($model){
            return response()->download('storage/dokumen/'.$model->file);
        }
    }   

    public function delete($id){
        $model = objek_m::find($id);
        if($model){
            if($model->delete()){
                return [
                    'success' => true,
                    'message' => 'Data berhasil di hapus'
                ];
            }else{
                return [
                    'success' => false,
                    'message' => 'Data gagal di hapus'
                ];
            }
        }else{
            return [
                'success' => false,
                'message' => 'Data tidak di temukan'
            ];
        }
    }

    public function validation(){
        return [
            'key' => 'required'
        ];
    }

    public function validation_message($data){
        $message = [];
        $message['key.required'] = 'Key harus di isi';
        return $message;
    }
}
