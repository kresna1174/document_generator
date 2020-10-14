@extends('layout.main')
@section('title')
    <h4>Master Objek <a href="javascript:void()" onclick="create()" class="btn btn-success btn-sm rounded-circle"><i class="fa fa-plus-circle"></i></a></h4>
@endsection

@section('content')
<table id="table" class="table table-striped table-bordered">
<thead>
    <tr>
        <th class="text-center">id</th>
        <th class="text-center">objek</th>
        <th class="text-center">koneksi</th>
        <th class="text-center">objek tipe</th>
        <th class="text-center">nama table</th>
        <th class="text-center">nama kolom</th>
        <th></th>
    </tr>
</thead>

<tbody>

</tbody>
</table>
@endsection
@section('js')
<script>

    $(function(){
        get();
    })

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
        $('#form_barang .alert').remove();
        $.ajax({
            url: '<?= route('objek.store') ?>',
            dataType: 'json',
            type: 'post',
            data: $('#form_objek').serialize(),
            success: function(response){
                if(response.success){
                    bootbox.hideAll();
                    alert(response.message);
                    get();
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
                    bootbox.hideAll();
                    swal({
                    title: "Update",
                    text: response.message,
                    icon: "success",
                    button: "Oke",
                    });
                    get();
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
                        get();
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