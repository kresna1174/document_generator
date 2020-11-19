{!! Form::model($model, ['id' => 'form_dashboard']) !!}
<table style="width: 100%">
    <tr>
        <th>Nama Surat</th>
        <th>:</th>
        <td>{!! $model->nama_surat !!}</td>
    </tr>
    <tr>
        <th>Koneksi</th>
        <th>:</th>
        <td>{!! $model->judul !!}</td>
    </tr>
    <tr>
        <th>Objek</th>
        <th>:</th>
        <td>{!! $model->objek !!}</td>
    </tr>
</table>
{!! Form::close() !!}