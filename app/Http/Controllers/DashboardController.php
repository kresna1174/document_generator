<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\objek_m;
use App\koneksi_m;
use App\jenis_dokumen_m;

class DashboardController extends Controller
{
    public function index(){
        $title = 'Dashboard';
        return view('dashboard.index', compact('title'));
    }

    public function get_data(){
        return DataTables::of(jenis_dokumen_m::_dashboard()->get())
            ->make(true);
        return view('dashboard.index');
    }

    public function view($id){
        $model = jenis_dokumen_m::_dashboard()->findOrFail($id);
        return view('dashboard.view', compact('model'));
    }

    public function download($id){
        $model = jenis_dokumen_m::_dashboard()->findOrFail($id);
        if($model){
            return response()->download(Storage::path('public/cetak/'.$model->file));
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

    public function user(){
        return view('dashboard');
    }
}
