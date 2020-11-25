<?php
namespace App\Http\Controllers;
date_default_timezone_set("Asia/Jakarta");

use Illuminate\Http\Request;
use DataTables;
use App\jenis_dokumen_m;
use App\objek_m;
use App\koneksi_m;

class Jenis_Dokumen_Controller extends Controller
{
    public function index(){
        $title = 'Master Jenis Dokumen';
        return view('master.jenis_dokumen.index', compact('title'));
    }

    public function get_data(){
        return Datatables::of(jenis_dokumen_m::_dashboard()->get())
        ->make(true);
        return view('master.jenis_dokumen.index');
    }

    public function create(){
        $objek = objek_m::_koneksi()->pluck('objek', 'id');
        return view('master.jenis_dokumen.create', compact('objek'));
    }

    public function edit($id){
        $objek = objek_m::pluck('objek', 'id');
        $model = jenis_dokumen_m::_dashboard()->findOrFail($id);
            return view('master.jenis_dokumen.edit',compact('model', 'objek'));
    }

    public function store(Request $request){
        $request->validate([
            'nama_surat' => 'required',
            'id_objek' => 'required',
            'file_world' => 'required|mimes:docx|max:5000',
        ]);
        $file = $request->file('file_world');
        $file_name = date('d_m_Y_H.i.s').'_'.$file->getClientOriginalName();
        $file->move('../storage/app/public/dokumen', $file_name);
        $objek = objek_m::findOrFail($request->id_objek);
        $data = [
            'nama_surat' => $request->nama_surat,
            'id_objek' => $request->id_objek,
            'id_koneksi' => $objek->id_koneksi,
            'file' => $file_name,
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
        $file_name = 'updates'.date('d_m_Y_H.i.s').'_'.$file->getClientOriginalName();
        $file->move('../storage/app/public/dokumen', $file_name);
        $objek = objek_m::findOrFail($request->id_objek);
        $data = [
            'nama_surat' => $request->nama_surat,
            'id_objek' => $request->id_objek,
            'id_koneksi' => $objek->id_koneksi,
            'file' => $file_name
        ];
        $model = jenis_dokumen_m::_dashboard()->findOrFail($id);
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
        $model = jenis_dokumen_m::_dashboard()->find($id);
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