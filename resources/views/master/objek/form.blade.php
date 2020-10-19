<div class="form-group">
    <label>Objek</label>
    {!! Form::text('objek', null, ['class' => 'form-control', 'id' => 'objek']) !!}
</div>
<div class="form-group">
    <label>Koneksi</label>
    {!! Form::select('koneksi', ['model' => $model->koneksi]) !!}
</div>
<div class="form-group">
    <label>Objek Tipe</label>
    {!! Form::text('objek_tipe', null, ['class' => 'form-control', 'id' => 'objek_tipe']) !!}
</div>
<div class="form-group">
    <label>Nama Table</label>
    {!! Form::text('nama_table', null, ['class' => 'form-control', 'id' => 'nama_table']) !!}
</div>
<div class="form-group">
    <label>Nama Kolom</label>
    {!! Form::text('nama_kolom', null, ['class' => 'form-control', 'id' => 'nama_kolom']) !!}
</div>