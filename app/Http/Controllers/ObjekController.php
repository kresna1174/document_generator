<?php

namespace App\Http\Controllers;
use App\objek_m;
use App\koneksi_m;
use App\objek_tipe_m;
use DataTables;
use Exception;
use App\Http\Controllers\ZipArchive;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ObjekController extends Controller
{
    public function index(){
        $title = 'Master Objek';
        return view('master.objek.index', compact('title'));
    }
    
    public function get_data(){
        return Datatables::of(objek_m::orderBy('id', 'DESC')->_koneksi()->get())
        ->make(true);
        return view('master.objek.index');
    }
    
    public function create(){
        $model = objek_m::_koneksi()->get();
        $objek = objek_m::get('id');
        $nama_db = koneksi_m::pluck('judul', 'id');
        $objek_tipe = objek_tipe_m::pluck('objek_tipe', 'id');
            return view('master.objek.create', compact('model', 'objek_tipe', 'nama_db'));
    }

    public function edit($id){
        $model = objek_m::_koneksi()->findOrFail($id);
        $nama_db = koneksi_m::pluck('judul', 'id');
        $objek_tipe = objek_tipe_m::pluck('objek_tipe', 'id');
        return view('master.objek.edit', compact('model', 'objek_tipe', 'nama_db'));
    }

    public function view($id){
        $model = Objek_m::_koneksi()->findOrFail($id);
        return view('master.objek.view', compact('model'));
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
        $rules = self::validasi($request->all());
        $messages = self::validasi_message($request->all());
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'message' => 'error input',
                'errors' => $validator->messages()
            ], 400);
        }
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

    public function validasi($data){
        if(isset($data['id_objek_tipe'])){
            if($data['id_objek_tipe'] == 'table' || $data['id_objek_tipe'] == 1){
                return [
                    'objek' => 'required',
                    'id_koneksi' => 'required',
                    'nama_table' => 'required',
                    'nama_kolom' => 'required'
                ];
            } else if($data['id_objek_tipe'] == 'query' || $data['id_objek_tipe'] == 2) {
                return [
                    'objek' => 'required',
                    'id_koneksi' => 'required',
                    'query' => 'required'
                ];
            }
        }
        return [
        'objek' => 'required',
        'id_koneksi' => 'required',
        'id_objek_tipe' => 'required'
    ];
    }
    public function validasi_message($data) {        
        $messages = [];      
        if(isset($data['id_objek_tipe'])){
            if($data['id_objek_tipe'] == 'table' || $data['id_objek_tipe'] == 1){
                    $messages['objek.required'] = 'objek harus di isi';
                    $messages['id_koneksi.required'] = 'koneksi harus di isi';
                    $messages['id_objek_tipe.required'] = 'objek tipe harus di isi';
                    $messages['nama_table.required'] = 'nama table harus di isi';
                    $messages['nama_kolom.required'] = 'nama kolom harus di isi';
            } else{
                $messages['objek.required'] = 'objek harus di isi';
                $messages['id_koneksi.required'] = 'koneksi harus di isi';
                $messages['id_objek_tipe.required'] = 'objek tipe harus di isi';
                $messages['query.required'] = 'query harus di isi';
            }
        } else {
            $messages['objek.required'] = 'objek harus di isi';
            $messages['id_koneksi.required'] = 'koneksi harus di isi';
            $messages['id_objek_tipe.required'] = 'objek tipe harus di isi';
        }
        return $messages;

    }    
}
