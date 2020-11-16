<div class="form-group">
    <label>Judul</label>
    {!! Form::text('judul', null, ['class' => 'form-control', 'id' => 'judul']) !!}
</div>
<div class="form-group">
    <label>Nama Database</label>
    {!! Form::text('nama_db', null, ['class' => 'form-control', 'id' => 'nama_db']) !!}
</div>
<div class="form-group">
    <label>Username</label>
    {!! Form::text('username', null, ['class' => 'form-control', 'id' => 'username']) !!}
</div>
<div class="form-group">
    <label>Password</label>
    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
</div>
<div class="form-group">
    <label>Host</label>
    {!! Form::text('host', null, ['class' => 'form-control', 'id' => 'host']) !!}
</div>
<div class="form-group">
    <label>Port</label>
    {!! Form::text('port', null, ['class' => 'form-control', 'id' => 'port', 'onkeypress' => 'return in_angka(event)']) !!}
</div>