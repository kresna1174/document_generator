{!! Form::model($model, ['id' => 'form_objek']) !!}
<table width="100%">
    <tr>
        <th>Objek</th>
        <th>:</th>
        <td>{!! $model->objek !!}</td>
    </tr>
    <tr>
        <th>Koneksi</th>
        <th>:</th>
        <td>{!! $model->koneksi !!}</td>
    </tr>
    <tr>
        <th>Objek_tipe</th>
        <th>:</th>
        <td>{!! $model->objek_tipe !!}</td>
    </tr>
    <tr>
        <th>Nama Table</th>
        <th>:</th>
        <td>{!! $model->nama_table !!}</td>
    </tr>
    <tr>
        <th>Nama Kolom</th>
        <th>:</th>
        <td>{!! $model->nama_kolom !!}</td>
    </tr>
</table>
{!! Form::close() !!}