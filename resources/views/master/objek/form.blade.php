<div class="form">
    <div class="form-group">
        <label>Objek</label>
        {!! Form::text('objek', null, ['class' => 'form-control', 'id' => 'objek']) !!}
    </div>
    <div class="form-group">
        <label>Koneksi</label>
        {!! Form::select('id_koneksi', [''=>'select'] + $nama_db->toArray(), null, ['class' => 'form-control', 'id' => 'id_koneksi', 'onchange' => 'get_koneksi()']) !!}
    </div>
    <div class="form-group">
        <label>Objek Tipe</label>
        <?php if(isset($model->id)) { ?>
            {!! Form::select('id_objek_tipe',[''=>'select'] + $objek_tipe->toArray(), null, ['class' => 'form-control', 'id' => 'objek_tipe', 'onchange' => 'get_objek_tipe()']) !!}
        <?php } else { ?>
            {!! Form::select('id_objek_tipe',[''=>'select'] + $objek_tipe->toArray(), null, ['class' => 'form-control', 'id' => 'objek_tipe', 'onchange' => 'get_value()']) !!}
        <?php } ?>
    </div>
        {!! Form::hidden('nama_table', null, ['class' => 'form-control', 'id' => 'nama_table']) !!}
        {!! Form::hidden('nama_kolom', null, ['class' => 'form-control', 'id' => 'nama_kolom']) !!}
        {!! Form::hidden('query', null, ['class' => 'form-control', 'id' => 'query']) !!}
    <div class="bungkus">
    </div>
</div>

<div class="table" style="overflow-y: scroll; height: 50vh">
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
