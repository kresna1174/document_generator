{!! Form::open(['id' => 'form_cetak']) !!}
@include('cetak.form')
    <button id="btn-str" type="button" class="btn btn-primary btn-sm" onclick="store('{!! $model->id !!}')">Cetak</button>
    <button type="button" class="btn btn-secondary btn-sm" onclick="bootbox.hideAll()">Cancel</button>
{!! Form::close() !!}