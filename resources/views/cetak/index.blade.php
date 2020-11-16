@extends('layout.main')
@section('title')
<span>Cetak</span>
<a href="javascript:void()" onclick="create()" class="btn btn-success btn-sm rounded-circle"><i class="fa fa-plus-circle"></i></a>
@endsection

@section('content')
<div class="container mt-5 pb-5">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="isi">
                
            </div>
        </div>
    </div>  
</div>
@endsection
@section('js')
    <script>
        $(function(){
            get();
        });

        function get(){
            $.ajax({
                url: '<?= route('cetak.get_data') ?>',
                success: function(response){
                    $('.isi').html(response);
                }
            });
        }
        function edit(id){
            $.ajax({
                url: '<?= route('cetak.edit') ?>/'+id,
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
                url: '<?= route('cetak.create') ?>',
                success: function(response){
                    bootbox.dialog({
                        title: 'create',
                        message: response
                    })
                }
            });
        }

        function store(){
            $('#form_cetak .alert').remove();
            $.ajax({
                url: '<?= route('cetak.store') ?>',
                dataType: 'json',
                type: 'post',
                data: $('#form_cetak').serialize(),
                success: function(response){
                    if(response.success){
                        Swal.fire({
                            title: 'store',
                            icon: 'success',
                            message: response
                        });
                        bootbox.hideAll();
                        get();
                    }else{
                        Swal.fire({
                            title: 'store',
                            icon: 'error',
                            message: response
                        });
                    }
                },
                error: function(xhr){
                    var response = JSON.parse(xhr.responseText);
                    $('#form_cetak').prepend(validation(response));
                }
            });
        }

        function update(id){
            $('#form_cetak .alert').remove();
            $.ajax({
                url: '<?= route('cetak.update') ?>/'+id,
                dataType: 'json',
                type: 'post',
                data: $('#form_cetak').serialize(),
                success: function(response){
                    if(response.success){
                        Swal.fire({
                            title: 'update',
                            icon: 'success',
                            message: response
                        });
                        bootbox.hideAll();
                        get();
                    }else{
                        Swal.fire({
                            title: 'update',
                            icon: 'error',
                            message: response
                        });
                    }
                },
                error: function(xhr){
                    var response = JSON.parse(xhr.responseText);
                    $('#form_cetak').prepend(validation(response));
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
                    url: '<?= route('cetak.delete') ?>/'+id,
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

        function validation(errors){
            var html_row = '<div class="alert alert-danger">';
                html_row += '<b><p>'+errors.message+'</p></b>';
                $.each(errors.errors, function(i, error){
                    html_row += error[0]+'<br>';
                });
                html_row += '</div>';
                return html_row;
        }
    </script>
@endsection