@extends('layout.main')
@section('title')
<h4>Master Objek</h4>
    <button type="button" onclick="create()" class="ml-1 mb-2 btn btn-success btn-sm rounded-circle"><i class="fa fa-plus-circle"></i></button>
@endsection
@section('content')
<div class="container mt-5 pb-5">
    <div class="panel panel-default">
        <div class="panel-body">
            <table width="100%" id="table" class="table table-bordered table-consoned table-striped">
                <thead>
                    <tr>
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
              {data: 'objek', name: 'objek'},
              {data: 'judul', name: 'judul'},
              {data: 'objek_tipe', name: 'objek_tipe'},
              {data: 'nama_table', name: 'nama_table'},
              {data: 'nama_kolom', name: 'nama_kolom'},
              {data: 'id', name:'objek.id', width: '150px', searchable: false, orderable: false, class: 'text-right nowrap',mRender: function(data){
                  return '<button type="button" class="btn btn-info btn-sm" onclick="view('+data+')">view</button> \n\
                   <button type="button" class="btn btn-warning btn-sm" onclick="edit('+data+')">edit</button>\n\
                  <button type="button" class="btn btn-danger btn-sm" onclick="destroy('+data+')">delete</button>';
              }}
          ]
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
                    Swal.fire({
                    title: 'Store',
                    text: response.message,
                    icon: 'success',
                    confirmButtonColor: '#2c91fb',
                    confirmButtonText: 'Oke'
                    });
                }else{
                    Swal.fire({
                    title: 'Error',
                    text: response.message,
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Oke'
                    });
                }
                bootbox.hideAll();
                dataTable.ajax.reload();
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
                    Swal.fire({
                    title: 'Update',
                    text: response.message,
                    icon: 'success',
                    confirmButtonColor: '#2c91fb',
                    confirmButtonText: 'Oke'
                    });
                }else{
                    Swal.fire({
                    title: 'Error',
                    text: response.message,
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Oke'
                    });
                }
                bootbox.hideAll();
                dataTable.ajax.reload();
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
            get_objek_tipe();
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

    function get_objek_tipe(){
        var value = $('#objek_tipe').val();
        var nama_table = $('#nama_table').val();
        var nama_kolom = $('#nama_kolom').val();
        if (value == 1 || value == 'table') {
            var bungkus = $('.bungkus').children();
            if(bungkus.length == 1){
                $('.bungkus').children().remove();
            }
            var html_row;
                html_row = '<div class="table">';
                html_row += '<div class="form-group">';
                html_row += '<label>Nama Table</label>';
                html_row += '<input type="text" name="nama_table" value="'+nama_table+'" class="form-control">';
                html_row += '</div>';
                html_row += '<div class="form-group">';
                html_row += '<label>Nama Kolom</label>';
                html_row += '<input type="text" name="nama_kolom" value="'+nama_kolom+'" class="form-control">';
                html_row += '</div>';
                html_row += '</div>';
                // console.log(html_row);

            $('.form .bungkus').append(html_row);
        } else if (value == 2 || value == 'query') {
            var query = $('#query').val();
            var bungkus = $('.bungkus').children();
            if(bungkus.length == 1){
                $('.bungkus').children().remove();
            }
            var html_row;
                html_row = '<div class="query">';
                html_row += '<div class="form-group">';
                html_row += '<label>Query</label>';
                html_row += '<textarea name="query" class="form-control">'+query+'</textarea>';
                html_row += '</div>';
                html_row += '</div>';
            $('.form .bungkus').append(html_row);
                }
            }

    function get_value(){
            var value = $('#objek_tipe').val();
            if (value == 1 || value == 'table') {
                var bungkus = $('.bungkus').children();
                if(bungkus.length == 1){
                    $('.bungkus').children().remove();
                }
                var html_row;
                    html_row = '<div class="table">';
                    html_row += '<div class="form-group">';
                    html_row += '<label>Nama Table</label>';
                    html_row += '<input type="text" name="nama_table" value="" class="form-control">';
                    html_row += '</div>';
                    html_row += '<div class="form-group">';
                    html_row += '<label>Nama Kolom</label>';
                    html_row += '<input type="text" name="nama_kolom" class="form-control">';
                    html_row += '</div>';
                    html_row += '</div>';

                $('.form .bungkus').append(html_row);
            } else if (value == 2 || value == 'query') {
                var bungkus = $('.bungkus').children();
                if(bungkus.length == 1){
                    $('.bungkus').children().remove();
                }
                var id_oke = $('#oke').val();
                var html_row;
                    html_row = '<div class="query">';
                    html_row += '<div class="form-group">';
                    html_row += '<label>Query</label>';
                    html_row += '<textarea id="query_create" name="query" class="form-control"></textarea>';
                    html_row += '</div>';
                    html_row += '</div>';
                $('.form .bungkus').append(html_row);
                    }
                }

    // function get_query(){
    //     var query_value = $('#query_create').val();
    //     if(query_value == 'SELECT * FROM'){
    //         var html_row = '<select class="form-control">';
    //             html_row += '<option value="penjualan" id="penjualan">Penjualan</option>';
    //             html_row += '</select>';
    //             html_row += '<br>';
    //             html_row += '<button type="button" class="btn btn-primary form-control input-sm" onclick="oke()">Ok</button>';
    //             bootbox.dialog({
    //                 title: 'Create',
    //                 message: html_row
    //             });
    //         }
    //     }

    //     function oke(){
    //         var selector = $('#penjualan').val();
    //             $('#query_create').val(selector);
    //     }

    function destroy(id){
        Swal.fire({
            title: 'Delete',
            text: 'Apakah anda yakin akan menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#929ba1',
            confirmButtonText: 'Oke'
            }).then((result) => {
            if (result.value) {
                
                $.ajax({
                    url: '<?= route('objek.delete') ?>/'+id,
                    success: function(response) {
                        dataTable.ajax.reload();
                    Swal.fire({
                        title : 'Terhapus!',
                        icon: 'success',
                            text: response.message,
                    })
                        },
                        error: function(){
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                type: 'error'
                            })
                        }
                    });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
            'Cancelled',
            'Data tidak jadi dihapus',
            'error'
            )
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