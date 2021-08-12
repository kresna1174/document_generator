{!! Form::model($model, ['id' => 'form_users']) !!}
<table width="100%">
    <tr>
        <th>Username</th>
        <th>:</th>
        <td>{!! $model->username !!}</td>
    </tr>
    <tr>
        <th>Name</th>
        <th>:</th>
        <td>{!! $model->name !!}</td>
    </tr>
</table>
{!! Form::close() !!}