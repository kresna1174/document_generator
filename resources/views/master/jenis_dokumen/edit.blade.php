{!! Form::model($model, ['id' => 'form_jenis_dokumen']) !!}
@include('master.jenis_dokumen.form')
    <button id="btn-updt" type="button" class="btn btn-primary btn-sm" onclick="update('{!! $model->id !!}')">Update</button>
    <button type="button" class="btn btn-default btn-sm" onclick="bootbox.hideAll()">Cancel</button>
{!! Form::close() !!}