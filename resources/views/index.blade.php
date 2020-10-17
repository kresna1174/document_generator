@extends('layout.main')
@section('title')
    <h4>Dashboard</h4>
@endsection

@section('content')

  
<div class="container mt-5 pb-5">
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="table-responsive">
            <table width="100%" id="table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <!-- <th>id</th> -->
                        <th>objek</th>
                        <th>koneksi</th>
                        <th class="text-left">objek tipe</th>
                        <th class="text-left">nama table</th>
                        <th class="text-left">nama kolom</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                    </tbody>
                </table>
            </div>
        </div>  
      </div>  
  </div>

@endsection
@section('js')
  <script>
      function datatable(){
        $('#table').DataTable({
            processing: true,
            searchDelay: 1000,
            serverSide: true,
            ajax: '<?= route('objek.get_data') ?>',
            columns:[
              {data: 'objek', name: 'objek'},
              {data: 'koneksi', name: 'koneksi'},
              {data: 'objek_tipe', name: 'objek_tipe'},
              {data: 'nama_table', name: 'nama_table'},
              {data: 'nama_kolom', name: 'nama_kolom'},
              {data: 'id',width: '150px', searchable: false, orderable: false, class: 'text-right nowrap',mRender: function(data){
                  return '<a href="javascript:void()" class="btn btn-info btn-sm" onclick="view('+data+')">view</a> \n\
                   <a href="javascript:void()" class="btn btn-warning btn-sm" onclick="edit('+data+')">edit</a>\n\
                  <a href="javascript:void()" class="btn btn-danger btn-sm" onclick="destroy('+data+')">delete</a>';
              }}
            ]
        });
      }
      $(function(){
        datatable();
      });
  </script>
@endsection