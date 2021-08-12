<div class="form">
    @csrf
    <div class="form-group">
        <label>Username</label>
        {!! Form::text('username', null, ['class' => 'form-control', 'id' => 'username']) !!}
    </div>
    <div class="form-group">
        <label>Nama</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" value="" class="form-control" id="password">
    </div>
    <div class="form-group">
        <label>Konfirmasi Password</label>
        <input type="password" name="confirm" value="" class="form-control" id="confirm">
    </div>
    <div class="bungkus">
    </div>
</div>

