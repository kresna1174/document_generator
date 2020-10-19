<?php

namespace App\Http\Controllers;
use App\objek_m;
use App\pos_m;
use DataTables;
use Illuminate\Http\Request;

class ObjekController extends Controller
{
    public function index(){
        $title = 'Master Objek';
        return view('master.objek.index', compact('title'));
    }

    public function get_data(){
        return Datatables::of(Objek_m::all())
        ->make(true);
        return view('master.objek.index');
    }

    public function get(){
        $model = Objek_m::all();
        return view('master.objek.get', compact('model'));
    }

    public function create(){
        return view('master.objek.create');
    }

    public function edit($id){
        $model = Objek_m::findOrFail($id);
        return view('master.objek.edit', compact('model'));
    }

    public function view($id){
        $model = Objek_m::findOrFail($id);
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
            'koneksi' => 'required',
            'objek_tipe' => 'required',
            'nama_table' => 'required',
            'nama_kolom' => 'required',
        ];
    }
}
