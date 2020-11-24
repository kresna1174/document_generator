@extends('layout.main')
@section('title')
    <h4>Master Jenis Dokumen</h4>
    <button onclick="create()" class="ml-1 mb-2 btn btn-success btn-sm rounded-circle"><i class="fa fa-plus-circle"></i></button>
@endsection

@section('content')
<div class="container mt-5 pb-5">
    <div class="panel panel-default">
        <div class="panel-body">
            <table id="table" class="table table-bordered table-striped table-consoned">
                <thead>
                    <tr>
                        <th>Nama Surat</th>
                        <th>Objek</th>
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
            ajax: '<?= route('jenis_dokumen.get_data') ?>',
            columns:[
                {data: 'nama_surat', name: 'nama_surat'},
                {data: 'objek', name: 'objek'},
                {data: 'id', name:'objek.id', width: '100px', searchable: false, orderable: false, class: 'text-right nowrap',mRender: function(data){
                    return '<button class="btn btn-warning btn-sm" onclick="edit('+data+')">edit</button>\n\
                            <button class="btn btn-danger btn-sm" onclick="destroy('+data+')">delete</button>';
                    }}
                ]
            }); 
        }

        function edit(id){
            $.ajax({
                url: '<?= route('jenis_dokumen.edit') ?>/'+id,
                success: function(response){
                    bootbox.dialog({
                        title: 'edit',
                        message: response
                    });
                }
            });
        }


        function create(){
            $.ajax({
                url: '<?= route('jenis_dokumen.create') ?>',
                success: function(response){
                bootbox.dialog({
                    title: 'create',
                    message: response
                });
                }
            });
        }

        function store(){
            $('#form_jenis_dokumen .alert').remove();
            var form = $('#form_jenis_dokumen')[0];
            var formData = new FormData(form);
            $.ajax({
                url: '<?= route('jenis_dokumen.store') ?>',
                dataType:'json',
                type: 'post',
                enctype: 'multipart/form-data',
                processData: false,
                contentType:false,
                data: formData,
                success: function(response){
                    if(response.success){
                        Swal.fire({
                            title: 'Store',
                            message: response,
                            icon: 'success'
                        });
                    }else{
                        Swal.fire({
                            title: 'Store',
                            message: response,
                            icon: 'error'
                        });
                    }
                    bootbox.hideAll();
                    dataTable.ajax.reload();
                },
                error: function(xhr, ajaxOptions, thrownError){
                var response = JSON.parse(xhr.responseText);
                $('#form_jenis_dokumen').prepend(validation(response));
                }
            });
        }

        function update(id){
            $('#form_jenis_dokumen .alert').remove();
            var form = $('#form_jenis_dokumen')[0];
            var formData = new FormData(form);
            $.ajax({
                url: '<?= route('jenis_dokumen.update') ?>/'+id,
                dataType:'json',
                type: 'post',
                enctype: 'multipart/form-data',
                processData: false,
                contentType:false,
                data: formData,
                success: function(response){
                    if(response.success){
                        Swal.fire({
                            title: 'update',
                            message: response,
                            icon: 'success'
                        });
                    }else{
                        Swal.fire({
                            title: 'update',
                            message: response,
                            icon: 'error'
                        });
                    }
                    bootbox.hideAll();
                    dataTable.ajax.reload();
                },
                error: function(xhr, ajaxOptions, thrownError){
                var response = JSON.parse(xhr.responseText);
                $('#form_jenis_dokumen').prepend(validation(response));
                }
            });
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
                        url: '<?= route('jenis_dokumen.delete') ?>/'+id,
                        success: function(response) {
                        dataTable.ajax.reload();
                        Swal.fire({
                            title: 'Terhapus!',
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
                )}
            });
        }

        function validation(errors){
            var validation = '<div class="alert alert-danger">';
                validation += '<p><b>'+errors.message+'</b></p>';
                $.each(errors.errors, function(i, error){
                validation += error[0]+'<br>';
                });
                validation += '</div>';
                return validation;
        }
    </script>
@endsection