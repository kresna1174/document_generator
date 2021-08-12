{{ Form::open(['route'=>['users.changepassword',$model->id],'id' => 'form_reset']) }}
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" value="{{ $model->username }}" class="form-control" readonly>
    </div>
    <div class="form-group">
        <label>New Password</label>
        <input type="password" name="password" value="" class="form-control">
    </div>
    <div class="form-group">
        <label>Retype Password</label>
        <input type="password" name="confirmed" value="" class="form-control">
    </div>
    <button type="button" class="btn btn-success btn-sm" onclick="storePassword('<?= $model->id ?>')">Change Password</button>
{{ Form::close()}}