<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\wf_message;
use Illuminate\Support\Facades\Validator;

class KoneksiController extends Controller
{
    public function index(){
        $title = 'Master Koneksi';
        return view('master.koneksi.index', compact('title'));
    }

    public function get(){
        $model = koneksi_m::all();
        return view('master.koneksi.get', compact('model'));
    }

    public function create(){
        return view('master.koneksi.create');
    }

    public function edit($id){
        $model = koneksi_m::findOrFail($id);
        return view('master.koneksi.edit', compact('model'));
    }

    public function update(Request $request, $id){
        $rules = self::validasi($request->all());
        $messages = self::validasi_message($request->all());
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'message' => 'error input',
                'errors' => $validator->messages()
            ], 400);
        }
        // $request->validate(self::validasi());
        $model = wf_message::findOrFail($id);
        if($model->update($request->all())){
            return [
                'success' => true,
                'message' => 'Data Berhasil Di Update'
            ];
        }else{
                return [
                    'success' => false,
                    'message' => 'Data Gagal Di Update'
                ];
        }
    }

    public function store(Request $request){
        $rules = self::validasi($request->all());
        $messages = self::validasi_message($request->all());
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'message' => 'error input',
                'errors' => $validator->messages()
            ], 400);
        }
        if(wf_message::create($request->all())){
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

    public function delete($id){
        $model = koneksi_m::find($id);
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

    public function validasi(){
        return [
            'nama_db' => 'required',
            'username' => 'required',
            'host' => 'required',
            'port' => 'required|numeric',
        ];
    }

    public function validasi_message($data){
        $messages = [];
        if(isset($data['nama_db'])){
            $messages['nama_db.required'] = 'Nama database harus di isi';
            $messages['username.required'] = 'Username harus di isi';
            $messages['host.required'] = 'Hostname harus di isi';
            $messages['port.required'] = 'Port harus di isi';
        }
        return $messages;
    }
}
