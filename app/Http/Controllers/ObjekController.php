<?php

namespace App\Http\Controllers;
use App\objek_m;
use App\koneksi_m;
use App\objek_tipe_m;
use DataTables;

use Illuminate\Http\Request;

class ObjekController extends Controller
{
    public function index(){
        $title = 'Master Objek';
        return view('master.objek.index', compact('title'));
    }
    
    public function get_data(){
        return Datatables::of(objek_m::_koneksi())
        ->make(true);
        return view('master.objek.index');
    }
    
    public function create(){
        $model = objek_m::_koneksi()->get();
        $nama_db = koneksi_m::pluck('nama_db', 'id');
        $nama_db2 = objek_m::_koneksi()->pluck('id', 'id_koneksi');
        $objek_tipe = objek_tipe_m::pluck('objek_tipe', 'id');
        $objek_tipe2 = objek_m::_koneksi()->pluck('objek_tipe', 'id');
        return view('master.objek.create', compact('model', 'objek_tipe', 'objek_tipe2', 'nama_db', 'nama_db2'));
    }

    public function edit($id){
        // $model = Objek_m::_koneksi()->findOrFail($id);
        $model = objek_m::_koneksi()->findOrFail($id);
        $nama_db = koneksi_m::pluck('nama_db', 'id');
        $objek_tipe = objek_tipe_m::pluck('objek_tipe', 'id');
        // $model->all = objek_m::_koneksi()->get();
        return view('master.objek.edit', compact('model', 'objek_tipe', 'nama_db'));
    }

    public function view($id){
        $model = Objek_m::_koneksi()->findOrFail($id);
        return view('master.objek.view', compact('model'));
    }

    public function store(Request $request){
        $request->validate(self::validasi());
        if(Objek_m::create($request->all())){
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

    public function update(Request $request, $id){
        $request->validate(self::validasi());
        $model = Objek_m::findOrFail($id);
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

    public function delete($id){
        $model = objek_m::find($id);
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
            'objek' => 'required',
            'id_koneksi' => 'required',
            'id_objek_tipe' => 'required',
            // 'objek_tipe' => 'required',
            'nama_table' => 'required',
            'nama_kolom' => 'required',
        ];
    }
}
