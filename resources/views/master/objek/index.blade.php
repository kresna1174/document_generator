@extends('layout.main')
@section('title')
    <span>Master Objek</span>
    <a href="javascript:void()" onclick="create()" class="btn btn-success btn-sm rounded-circle"><i class="fa fa-plus-circle"></i></a>
@endsection
@section('content')
<div class="container mt-5 pb-5">
    <div class="panel panel-default">
        <div class="panel-body">
        <!-- <div class="table-responsive"> -->
            <table width="100%" id="table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>id</th>
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
<!-- </div> -->
        @endsection
@section('js')
<script>

    $(function(){
        datatable();
    });

    var dataTable;
    function datatable(){
      dataTable =  $('#table').DataTable({
          reponsive:true,
          jQueryUI: true,
          processing: true,
          serverSide: true,
          ajax: '<?= route('objek.get_data') ?>',
          columns:[
              {data: 'id', name: 'id'},
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

    function get(){
        $.ajax({
            url: '<?= route('objek.get') ?>',
            success: function(response){
                $('#table tbody').html(response);
            }
        });
    }
    
    function create(){
        $.ajax({
            url: '<?= route('objek.create') ?>',
            success: function(response){
                bootbox.dialog({
                    title: 'create objek',
                    message: response
                });
            }
        });
    }

    function store(){
        $('#form_objek .alert').remove();
        $.ajax({
            url: '<?= route('objek.store') ?>',
            dataType: 'json',
            type: 'post',
            data: $('#form_objek').serialize(),
            success: function(response){
                if(response.success){
                    swal({
                    title: "Create",
                    text: response.message,
                    icon: "success",
                    button: "Oke",
                    });
                    bootbox.hideAll();
                    dataTable.ajax.reload();
                }else{
                    alert(response.message);
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                var response = JSON.parse(xhr.responseText);
                $('#form_objek').prepend(errormessage(response));
            }
        });
    }

    function update(id){
        $('#form_objek .alert').remove();
        $.ajax({
            url: '<?= route('objek.update') ?>/'+id,
            dataType: 'json',
            type: 'post',
            data: $('#form_objek').serialize(),
            success: function(response){
                if(response.success){
                    swal({
                    title: "Update",
                    text: response.message,
                    icon: "success",
                    button: "Oke",
                    });
                    bootbox.hideAll();
                    dataTable.ajax.reload();
                }else{
                    swal({
                    title: "Update",
                    text: response.message,
                    icon: "warning",
                    button: "Oke",
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                var response = JSON.parse(xhr.responseText);
                $('#form_objek').prepend(errormessage(response));
            }
        });
    }

    function edit(id){
        $.ajax({
            url: '<?= route('objek.edit') ?>/'+id,
            success: function(response){
                bootbox.dialog({
                    title: 'edit objek',
                    message: response
                });
            }
        });
    }

    function view(id){
        $.ajax({
            url: '<?= route('objek.view') ?>/'+id,
            success: function(response){
                bootbox.dialog({
                    title: 'view objek',
                    message: response
                });
            }
        })
    }

    function destroy(id){
        $.ajax({
            url: '<?= route('objek.delete') ?>/'+id,
            dataType: 'json',
            success: function(response){
                if(response.success){
                    swal({
                        title: "Delete Data Ini ?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        })
                        .then((willDelete) => {
                        if (willDelete) {
                            swal(response.message, {
                            icon: "success"
                            });
                        }
                        dataTable.ajax.reload();
                        });
                    }else{
                        swal(response.message);
                    }
                }
            });
        }

        function errormessage(errors){
            var validations = '<div class="alert alert-danger">';
                validations += '<p><b>'+errors.message+'</b></p>';
                $.each(errors.errors, function(i, error){
                    validations += error[0]+'<br>';
                });
                validations += '</div>';
                return validations;
        }
</script>
@endsection