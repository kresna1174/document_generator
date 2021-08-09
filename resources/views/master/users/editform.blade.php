<div class="form">
    <div class="form-group">
        {{ Form::open(['route'=>['users.name',$model->id]]) }}
        @csrf
        <div class="form-group">
            <label>Username</label>
            {{ Form::text('username', $model->username, ['class' => 'form-control', 'id' => 'username', ' readonly']) }}
        </div>
        <div class="form-group">
            <label>Name</label>
            {{ Form::text('name', $model->name, ['class' => 'form-control', 'id' => 'name']) }}
        </div>
        {{ Form::close()}}
    </div>
</div>

