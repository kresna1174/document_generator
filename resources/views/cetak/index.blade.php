@extends('layout.main')
@section('title')
    <h4>Cetak</h4>
@endsection

@section('content')
<div class="container mt-5 pb-5">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="isi"></div>
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
        
    function create(id){
        $.ajax({
            url: '<?= route('cetak.create') ?>/'+id,
            success: function(response){
                bootbox.dialog({
                    title: 'Cetak',
                    message: response
                })
            }
        })
    }

    function store(id){
        $('#form_cetak .alert').remove();
        $('#form_cetak').blockUI();
        $.ajax({
            url: '<?= route('cetak.store') ?>/'+id,
            dataType: 'json',
            type: 'get',
            data: $('#form_cetak').serialize(),
            success: function(response){
                if(response.success){
                    Swal.fire({
                        title: 'Store sukses',
                        icon: 'success',
                        showConfirmButton: false,
                        html: '<a href="{!! route('cetak.download') !!}/'+id+'" class="btn btn-primary">Download</a>'
                    });
                    bootbox.hideAll();
                    get();
                }else{
                    Swal.fire({
                        title: response.message,
                        icon: 'error',
                    });
                }
            },
            error: function(xhr){
            var response = JSON.parse(xhr.responseText);
            $('#form_cetak').prepend(validation(response));
            }
        })
        $('#form_cetak').unblock();
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