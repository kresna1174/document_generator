<div class="form-group">
    <label>nama database</label>
    {!! Form::text('nama_db', null, ['class' => 'form-control', 'id' => 'nama_db']) !!}
</div>
<div class="form-group">
    <label>username</label>
    {!! Form::text('username', null, ['class' => 'form-control', 'id' => 'username']) !!}
</div>
<div class="form-group">
    <label>password</label>
    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']); !!}
</div>
<div class="form-group">
    <label>port</label>
    {!! Form::number('port', null, ['class' => 'form-control', 'id' => 'port']) !!}
</div>
<div class="form-group">
    <label>host</label>
    {!! Form::number('host', null, ['class' => 'form-control', 'id' => 'host']) !!}
</div>