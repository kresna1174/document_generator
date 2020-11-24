{!! Form::model($model, ['id' => 'form_jenis_barang']) !!}
    <table style="width:100%">
        <tr>
            <th>Nama Surat</th>
            <th>:</th>
            <td>{!! $model->nama_surat !!}</td>
        </tr>
        <tr>
            <th>Objek</th>
            <th>:</th>
            <td>{!! $model->objek !!}</td>
        </tr>
        <tr>
            <th>File</th>
            <th>:</th>
            <td>{!! $model->file !!}</td>
        </tr>
    </table>
{!! Form::close() !!}