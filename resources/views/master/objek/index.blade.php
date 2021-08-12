@extends('layout.main')
@section('title')
    <h4>Master Objek</h4>
    <button id="btn-create" type="button" onclick="create()" class="ml-1 mb-2 btn btn-success btn-sm rounded-circle"><i class="fa fa-plus-circle"></i></button>
@endsection
@section('content')
<div class="container mt-5 pb-5">
    <div class="panel panel-default">
        <div class="panel-body">
            <table width="100%" id="table" class="table table-bordered table-consoned table-striped">
                <thead>
                    <tr>
                        <th>Objek</th>
                        <th>Koneksi</th>
                        <th class="text-left">Objek Tipe</th>
                        <th class="text-left">Nama Table</th>
                        <th class="text-left">Nama Kolom</th>
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
                    return '<button id="btn-view" type="button" class="btn btn-info btn-sm" onclick="view('+data+')">view</button> \n\
                            <button id="btn-edit" type="button" class="btn btn-warning btn-sm" onclick="edit('+data+')">edit</button>\n\
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
        })
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
            get_koneksi();
            }
        })
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

    function store(){
        $('#form_objek .alert').remove();
        $('#form_objek').blockUI();
        $.ajax({
            url: '<?= route('objek.store') ?>',
            dataType: 'json',
            type: 'post',
            data: $('#form_objek').serialize(),
            success: function(response){
                if(response.success){
                    $.growl.notice({message: 'Store berhasil'});
                }else{
                    $.growl.error({message: 'Store gagal'});
                }
                bootbox.hideAll();
                dataTable.ajax.reload();
            },
            error: function(xhr, ajaxOptions, thrownError){
                var response = JSON.parse(xhr.responseText);
                $('#form_objek').prepend(errormessage(response));
            }
        })
        $('#form_objek').unblock();
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
                    $.growl.notice({message: 'Update berhasil'});
                }else{
                    $.growl.error({message: 'Update gagal'});
                }
                bootbox.hideAll();
                dataTable.ajax.reload();
            },
            error: function(xhr, ajaxOptions, thrownError){
            var response = JSON.parse(xhr.responseText);
            $('#form_objek').prepend(errormessage(response));
            }
        })
    }

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
                    success: function(response){
                        if(response.success){
							$.growl.notice({message: 'Data berhasil dihapus!'});
                            dataTable.ajax.reload();
						}else{
							$.growl.error({message: 'Data gagal dihapus!'});
						}
                    }
                });
            }
        });
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

    function get_koneksi(){
        var id = $('#id_koneksi').val();
        $.ajax({
            url: '<?= route('objek.get_koneksi') ?>/'+id,
            success: function(response){
                $('#form_objek #table-list tbody').html(response);
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