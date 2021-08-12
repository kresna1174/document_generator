<div class="form-group">
    <label>Nama Surat</label>
    {!! Form::text('nama_surat', null, ['class' => 'form-control', 'id' => 'nama_surat']) !!}
</div>
<div class="form-group">
    <label>Objek</label>
    {!! Form::select('id_objek', ['' => 'select'] + $objek->toArray(), null, ['class' => 'form-control', 'id' => 'id_objek', 'onchange' => 'get_koneksi()']) !!}
</div>
<div class="form-group">
    <label>Upload</label>
    {!! Form::file('file_world', ['class' => 'form-control-file card shadow pt-2 pl-2 pb-2' ,'id' => 'file_world']) !!}
</div>

<div class="table" style="overflow-y: scroll; height: 50vh" >
    <table id="table-list" class="table table-bordered table-consoned table-striped">
    <thead>
        <tr>
            <th>Nama Table</th>
            <th>Nama Kolom</th>
        </tr>
    </thead>
    <tbody>
    
    </tbody>
    </table>
</div>    
