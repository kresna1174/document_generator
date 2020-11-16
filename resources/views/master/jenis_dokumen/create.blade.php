{!! Form::open(['id' => 'form_jenis_dokumen']) !!}
@include('master.jenis_dokumen.form')
    <button type="button" class="btn btn-primary btn-sm" id="submit" onclick="store()">Store</button>
    <button type="button" class="btn btn-default btn-sm" onclick="bootbox.hideAll()">Cancel</button>
{!! Form::close() !!}