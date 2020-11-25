<div class="form-group">
    <label>Nama Surat</label>
    {!! Form::text('nama_surat', null, ['class' => 'form-control', 'id' => 'nama_surat']) !!}
</div>
<div class="form-group">
    <label>Objek</label>
    {!! Form::select('id_objek', ['' => 'select'] + $objek->toArray(), null, ['class' => 'form-control', 'id' => 'id_objek']) !!}
</div>
<div class="form-group">
    <label>Upload</label>
    {!! Form::file('file_world', ['class' => 'form-control-file card shadow pt-5 pl-2 pb-2' ,'id' => 'file_world']) !!}
</div>


