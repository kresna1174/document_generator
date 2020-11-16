<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Exception;
use App\Http\Controllers\ZipArchive;
use Illuminate\Support\Facades\Validator;
use App\jenis_dokumen_m;
use App\objek_m;

class Jenis_Dokumen_Controller extends Controller
{
    public function index(){
        $title = 'Master Jenis Dokumen';
        return view('master.jenis_dokumen.index', compact('title'));
    }

    public function get_data(){
        return Datatables::of(jenis_dokumen_m::_objek()->get())
        ->make(true);
        return view('master.jenis_dokumen.index');
    }

    public function create(){
        $objek = objek_m::pluck('objek', 'id');
        return view('master.jenis_dokumen.create', compact('objek'));
    }

    public function edit($id){
        $objek = objek_m::pluck('objek', 'id');
        $model = jenis_dokumen_m::_objek()->findOrFail($id);
        return view('master.jenis_dokumen.edit',compact('model', 'objek'));
    }

    public function store(Request $request){
        $request->validate([
            'nama_surat' => 'required',
            'id_objek' => 'required',
            'file_world' => 'required|mimes:docx|max:5000',
        ]);
        $file = $request->file('file_world');
        $file->move('dokumen', $file->getClientOriginalName());
        $data = [
            'nama_surat' => $request->nama_surat,
            'id_objek' => $request->id_objek,
            'file' => $request->file_world
        ];
        if(jenis_dokumen_m::create($data)){
            return [
                'success' => true,
                'message' => 'Data berhasil di tambah'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'Data gagal di tambah'
            ];
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama_surat' => 'required',
            'id_objek' => 'required',
            'file_world' => 'required|mimes:docx|max:5000',
        ]);
        $file = $request->file('file_world');
        $file->move('dokumen', $file->getClientOriginalName());
        $data = [
            'nama_surat' => $request->nama_surat,
            'id_objek' => $request->id_objek,
            'file' => $request->file_world
        ];
        $model = jenis_dokumen_m::findOrFail($id);
        if($model->update($data)){
            return [
                'success' => true,
                'message' => 'Data berhasil di update'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'Data gagal di update'
            ];
        }
    }

    public function delete($id){
        $model = jenis_dokumen_m::find($id);
        if($model){
            if($model->delete()){
                return [
                    'success' => true,
                    'message' => 'Data berhasil di hapus'
                ];
            }else{
                return [
                    'success' => false,
                    'message' => 'Data gagal di dihapus'
                ];
            }
        }else{
            return [
                'success' => false,
                'message' => 'Data tidak di temukan'
            ];
        }
    }
}
