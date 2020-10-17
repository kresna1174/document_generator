<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pos_m;

class KoneksiController extends Controller
{
    public function index(){
        $title = 'Master Koneksi';
        return view('master.koneksi.index', compact('title'));
    }

    public function get(){
        $model = pos_m::all();
        return view('master.koneksi.get', compact('model'));
    }

    public function create(){
        return view('master.koneksi.create');
    }

    public function edit($id){
        $model = pos_m::findOrFail($id);
        return view('master.koneksi.edit', compact('model'));
    }

    public function update(Request $request, $id){
        $request->validate(self::validasi());
        $model = pos_m::findOrFail($id);
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
        $request->validate(self::validasi());
        if(pos_m::create($request->all())){
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
        $model = pos_m::find($id);
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
            'password' => '',
            'host' => 'required|numeric',
            'port' => 'required|numeric',
        ];
    }
}
