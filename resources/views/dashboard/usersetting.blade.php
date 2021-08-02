@extends('layout.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Key Generator </h3>
        </div>
        <div class="card-body">
            @if(session('errors'))
                <div class="alert alert-danger">
                    {{ session('errors') }}
                </div>
            @endif
            {{ Form::open(['route'=>['dashboard.keygen']]) }}
                <div class="form-group">
                    <label>Key</label>
                    {{ Form::text('key', session('data') ?? null, ['class' => 'form-control', 'id' => 'key', 'readonly']) }}
                </div>
                <button type="submit" class="btn btn-success">Generate</button>
            {{ Form::close() }}
        </div>
    </div>
@endsection