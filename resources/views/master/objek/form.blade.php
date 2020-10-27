<div class="form-group">
    <label>Objek</label>
    {!! Form::text('objek', null, ['class' => 'form-control', 'id' => 'objek']) !!}
</div>
<div class="form-group">
    <label>Koneksi</label>
    {!! Form::select('id_koneksi', ['select', 'select koneksi' => $nama_db ], null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label>Objek Tipe</label>
        {!! Form::select('id_objek_tipe', ['select', 'select objek tipe' => $objek_tipe], null, ['class' => 'form-control']) !!}
</div>
        <div class="table">
            <div class="form-group">
                <label>Nama Table</label>
                {!! Form::text('nama_table', null, ['class' => 'form-control', 'id' => 'nama_table']) !!}
            </div>
            <div class="form-group">
                <label>Nama Kolom</label>
                {!! Form::text('nama_kolom', null, ['class' => 'form-control', 'id' => 'nama_kolom']) !!}
            </div>
        </div>
<div class="query">

    <div class="form-group">
        <label>Query</label>
        {!! Form::textarea('query', null, ['class' => 'form-control', 'id' => 'nama_table']) !!}
    </div>
</div>

