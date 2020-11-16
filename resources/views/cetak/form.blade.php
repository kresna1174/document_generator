<div class="form-group">
    <label>Nama Surat</label>
    {!! Form::select('id_nama_surat', ['' => 'select'] + $nama_surat->toArray(), null, ['class' => 'form-control']) !!}
</div>