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
    {!! Form::file('file_world', ['class' => 'form-control-file card shadow pt-2 pl-2 pb-2' ,'id' => 'file_world']) !!}
</div>
<table id="table-list" class="table table-bordered table-consoned">
    <thead>
        <tr>
            <th>Nama Table</th>
            <th>Nama Kolom</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<script>
    $(function(){
        $('#table-list').DataTable({
            processing: true,
            searchDelay: 1000,
            serverSide: true,
            ajax: '<?= route('objek.get_data') ?>',
            columns:[
                {data: 'nama_table', name: 'nama_table'},
                {data: 'nama_kolom', name: 'nama_kolom'}
            ]
        });
    });
</script>


