<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\jenis_dokumen_m;
use App\User;
use App\cetak_m;
use App\koneksi_m;
use App\objek_m;

class CetakController extends Controller
{
    public function index(){
        $title = 'Cetak';
        return view('cetak.index', compact('title'));
    }

    public function get_data(){
        $model = jenis_dokumen_m::_dashboard()->get();
        return view('cetak.get', compact('model'));
    }

    public function create($id){
        $model = jenis_dokumen_m::_dashboard()->find($id);
        $nama_surat = jenis_dokumen_m::pluck('nama_surat', 'id');
        return view('cetak.create', compact('nama_surat', 'model'));
    }

    public function store(Request $request, $id){
        $rules = self::validation($request->all());
        $messages = self::validation_message($request->all());
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return response()->json([
                'message' => 'error input',
                'errors' => $validator->messages()
            ], 400);
        }
        $jenis_dokumen = jenis_dokumen_m::findOrFail($id);
        $objek = objek_m::findOrFail($jenis_dokumen->id_objek);
        $koneksi = koneksi_m::findOrFail($objek->id_koneksi);

        config(['database.connections.objek' => [
            'driver'  => 'mysql',
            'host' => $koneksi->host,
            'port' => $koneksi->port,
            'database' => $koneksi->nama_db,
            'username' => $koneksi->username,
            'password' => $koneksi->password
        ]]);

        $db_objek = DB::connection('objek');
        if ($objek->id_objek_tipe == 1) {
            $data = $db_objek->select('select * from '.$objek->nama_table. ' where '.$objek->nama_kolom.' = \''.$request->input('key').'\'');
        } else {
            $query = $objek->query;
            $query = str_replace('${key}', $request->input('key'), $query);
            $data = $db_objek->select($query);
        }
        if ($data) {
            $template = new \PhpOffice\PhpWord\TemplateProcessor(Storage::path('public/dokumen/'.$jenis_dokumen->file));
            $vars = $template->getVariables();
            foreach ($vars as $var) {
                $value = '';
                $parse = explode('.', $var);
                if (isset($parse[1])) {
                    if (isset($data[$parse[1]]->{$parse[0]})) {
                        $value = $data[$parse[1]]->{$parse[0]};
                    }
                } else {
                    if (isset($data[0]->{$parse[0]})) {
                        $value = $data[0]->{$parse[0]};
                    }
                }
                $template->setValues([$var => $value]);
            }
            if (isset($data[0])) {
                $template->setValues((array) $data[0]);
            }
            if (count($data)) {
                foreach ($data as $i => $row) {
                    foreach ($row as $key => $val) {
                        $template->setValues([$key.'.'.$i => $val]);
                    }
                }
            }
            $file_upload = $template->saveAs(Storage::path('public/cetak/'.$jenis_dokumen->file));
            $isi = [
                'file_cetak' => $jenis_dokumen->file,
                'input_key' => $request->key
            ];
                if (cetak_m::create($isi)){
                    return [
                        'success' => true,
                        'message' => 'Key benar'
                    ];
                    download();
                } else {
                    return [
                        'success' => false,
                        'message' => 'Key salah'
                    ];
                }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Key salah'
            ]);
        }
    }

    public function store_api(){
        $token = request('token');
        $key = request('key');
        $id_jenis_dokumen = request('id_jenis_dokumen');
        $response = [];
        $validator = Validator::make(request()->all(), 
        [
            'token' => 'required',
            'key' => 'required',
            'id_jenis_dokumen' => 'required',
        ], [
            'token.required' => 'Token Harus Di Isi', 
            'key.required' => 'Key Harus Di Isi',
            'id_jenis_dokumen.required' => 'Id Jenis Dokumen Harus Di Isi',
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
                'message' => 'errors Validation'
            ], 400);
        }

        $user = User::where('key', $token)->first();
        if(!$user) {
            return [
                'success' => false,
                'message' => 'Token Tidak Di Temukan'
            ];
        }
        $jenis_dokumen = jenis_dokumen_m::findOrFail($id_jenis_dokumen);
        $objek = objek_m::findOrFail($jenis_dokumen->id_objek);
        $koneksi = koneksi_m::findOrFail($objek->id_koneksi);

        config(['database.connections.objek' => [
            'driver'  => 'mysql',
            'host' => $koneksi->host,
            'port' => $koneksi->port,
            'database' => $koneksi->nama_db,
            'username' => $koneksi->username,
            'password' => $koneksi->password
        ]]);

        $db_objek = DB::connection('objek');
        if ($objek->id_objek_tipe == 1) {
            $data = $db_objek->select('select * from '.$objek->nama_table. ' where '.$objek->nama_kolom.' = \''.$key.'\'');
        } else {
            $query = $objek->query;
            $query = str_replace('${key}', $key, $query);
            $data = $db_objek->select($query);
        }
        if ($data) {
            $template = new \PhpOffice\PhpWord\TemplateProcessor(Storage::path('public/dokumen/'.$jenis_dokumen->file));
            $vars = $template->getVariables();
            foreach ($vars as $var) {
                $value = '';
                $parse = explode('.', $var);
                if (isset($parse[1])) {
                    if (isset($data[$parse[1]]->{$parse[0]})) {
                        $value = $data[$parse[1]]->{$parse[0]};
                    }
                } else {
                    if (isset($data[0]->{$parse[0]})) {
                        $value = $data[0]->{$parse[0]};
                    }
                }
                $template->setValues([$var => $value]);
            }
            if (isset($data[0])) {
                $template->setValues((array) $data[0]);
            }
            if (count($data)) {
                foreach ($data as $i => $row) {
                    foreach ($row as $key => $val) {
                        $template->setValues([$key.'.'.$i => $val]);
                    }
                }
            }
            $file_upload = $template->saveAs(Storage::path('public/cetak/'.$jenis_dokumen->file));
            $isi = [
                'file_cetak' => $jenis_dokumen->file,
                'input_key' => $key
            ];
                if (cetak_m::create($isi)){
                    $model = jenis_dokumen_m::findOrFail($id_jenis_dokumen);
                    if($model){
                        return response()->download(Storage::path('public/cetak/'.$model->file));
                    }
                } else {
                    return [
                        'success' => false,
                        'message' => 'Key salah'
                    ];
                }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Key salah'
            ]);
        }
    }

    public function download($id){
        $model = jenis_dokumen_m::findOrFail($id);
        if($model){
            return response()->download(Storage::path('public/cetak/'.$model->file));
        }
    }


    public function validation(){
        return [
            'key' => 'required'
        ];
    }

    public function validation_message(){
        $messages = [];
        $messages['key.required'] = 'Nama surat harus di isi';
        return $messages;
    }
}
