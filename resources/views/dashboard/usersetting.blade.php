@extends('layout.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-cog"></i> User Settings</h3>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <h3><i class="fas fa-user mr-2"></i>Profile</h3>
                </div>
                <div class="col-md-8">
                    {{ Form::open(['route'=>['dashboard.name']]) }}
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                            {{ Form::text('name', auth()->user()->name, ['class' => 'form-control', 'id' => 'name']) }}
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">Save Profile</button>
                    {{ Form::close()}}
                    <hr>
                    {{ Form::open(['route'=>['dashboard.keygen']]) }}
                    @csrf
                        <div class="form-group">
                            <label>Key Generator</label>
                            {{ Form::text('key', session('data') ?? auth()->user()->key, ['class' => 'form-control', 'id' => 'key', 'readonly']) }}
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">Generate</button>
                    {{ Form::close()}}
                </div>
            </div>
            <br>
            <hr>
            <br>
            @if(session('errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal Mengganti Password :
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            @if (session('old'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal Mengganti Password :
                    {{ session('old') }}
                </div>
            @endif
            @if (session('new'))
                <div class="alert alert-success">
                    {{ session('new') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <h3><i class="fas fa-lock mr-2"></i>Security</h3>
                </div>
                <div class="col-md-8">
                    {{ Form::open(['route'=>['dashboard.changepassword']]) }}
                    @csrf
                    <div class="form-group">
                        <label>Old Password</label>
                        <input type="password" name="oldpassword" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="newpassword" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Retype Password</label>
                        <input type="password" name="confirmed" value="" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">Change Password</button>
                    {{ Form::close()}}
                </div>
            </div>
            <br>
        </div>
    </div>
@endsection