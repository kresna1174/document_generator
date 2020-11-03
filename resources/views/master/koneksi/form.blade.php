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
    {!! Form::password('password', null, ['class' => 'awesome', 'id' => 'password']); !!}
</div>
<div class="form-group">
    <label>Hostname</label>
    {!! Form::text('host', null, ['class' => 'form-control', 'id' => 'host']) !!}
</div>
<div class="form-group">
    <label>Port</label>
    {!! Form::text('port', null, ['class' => 'form-control', 'id' => 'port']) !!}
</div>