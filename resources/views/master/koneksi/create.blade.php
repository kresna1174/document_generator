{!! Form::open(['id' => 'form_koneksi']) !!}
@include('master.koneksi.form')
    <button type="button" class="btn btn-primary btn-sm" onclick="store()">Store</button>
    <button type="button" class="btn btn-default btn-sm" onclick="bootbox.hideAll()">Cancel</button>
{!! Form::close() !!}