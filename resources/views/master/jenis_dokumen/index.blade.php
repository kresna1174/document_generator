@extends('layout.main')
@section('title')
<span>Master Jenis Dokumen</span>
    <a href="javascript:void()" onclick="create()" class="btn btn-success btn-sm rounded-circle"><i class="fa fa-plus-circle"></i></a>
@endsection

@section('content')
<div class="container mt-5 pb-5">
    <div class="panel panel-default">
        <div class="panel-body">
    <table id="table" class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Surat</th>
                <th>Object</th>
                <th>Format</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
        </div>
    </div>
</div>
@endsection
@section('js')
    <!-- <script>
    var datatable;
        $(function(){
            datatable = $('#table').DataTable({
                processing:true,
                searchDelay:1000,
                serverSide:true,
                ajax:'<?= route('jenis_dokumen.get_data') ?>',
                columns:[
                    {data: 'nama_db', name: 'nama_db'},
                    {data: 'username', name: 'username'},
                    {data: 'password', name: 'password'},
                    {data: 'id',width: '150px', searchable: false, orderable: false, class: 'text-right nowrap',mRender: function(data){
                      return '<a href="javascript:void()" class="btn btn-info btn-sm" onclick="view('+data+')">view</a> \n\
                            <a href="javascript:void()" class="btn btn-warning btn-sm" onclick="edit('+data+')">edit</a>\n\
                            <a href="javascript:void()" class="btn btn-danger btn-sm" onclick="destroy('+data+')">delete</a>';
              }}
                ]
            });
        })
    </script> -->
@endsection