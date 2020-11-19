{!! Form::model($model, ['id' => 'form_dashboard']) !!}
@include('dashboard.form')
<button class="btn btn-primary btn-sm" onclick="update('{!! $model->id !!}')">Update</button>
<button class="btn btn-secondary btn-sm" onclick="bootbox.hideAll()">Cancel</button>
{!! Form::close() !!}