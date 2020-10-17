@extends('layout.main')
@section('title')
    <span>Master Koneksi</span>
    <a href="javascript:void()" onclick="create()" class="btn btn-success btn-sm rounded-circle"><i class="fa fa-plus-circle"></i></a>
@endsection
@section('content')
<!-- <div class="row"> -->
    <div class="isi">
        
    </div>

    
  <!-- </div> -->
            
@endsection
@section('js')
  <script>
      function create(){
        $.ajax({
            url: '<?= route('koneksi.create') ?>',
            success: function(response){
              bootbox.dialog({
                title: 'create',
                message: response
              });
            }
        });
      }

      $(function(){
        get();
      });

      function get(){
        $.ajax({
          url: '<?= route('koneksi.get') ?>',
          success: function(response){
            $('.isi').html(response);
          }
        });
      }

      function edit(id){
        $.ajax({
          url: '<?= route('koneksi.edit') ?>/'+id,
          success: function(response){
            bootbox.dialog({
                title: 'edit',
                message: response
              });
          }
        });
      }

      function update(id){
        $('#form_koneksi .alert').remove();
        $.ajax({
          url: '<?= route('koneksi.update') ?>/'+id,
          dataType: 'json',
          type: 'post',
          data: $('#form_koneksi').serialize(),
          success: function(response){
            if(response.success){
                    swal({
                    title: "Create",
                    text: response.message,
                    icon: "success",
                    button: "Oke",
                    });
                    bootbox.hideAll();
                    get();
            }else{
              swal({
                    title: "Create",
                    text: response.message,
                    icon: "warning",
                    button: "Oke",
                    });
            }
          },
          error: function(xhr, ajaxOptions, thrownError){
            var response = JSON.parse(xhr.responseText);
            $('#form_koneksi').prepend(validation(response));
          }
        });
      }

      function store(){
        $('#form_koneksi .alert').remove();
        $.ajax({
          url: '<?= route('koneksi.store'); ?>',
          dataType: 'json',
          type: 'post',
          data: $('#form_koneksi').serialize(),
          success: function(response){
            if(response.success){
              alert(response.message);
              bootbox.hideAll();
              get();
            }else{
              alert(response.message);
            }
          },
          error: function(xhr, ajaxOptions, thrownError){
            var response = JSON.parse(xhr.responseText);
            $('#form_koneksi').prepend(validation(response));
          }
        });
      }

      function destroy(id){
        $.ajax({
          url: '<?= route('koneksi.delete') ?>/'+id,
          dataType: 'json',
          success: function(response){
            if(response.success){
                swal({
                    title: "delete",
                    text: response.message,
                    icon: "success",
                    button: "Oke",
                    });
                    get();
                    bootbox.hideAll();
            }else{
              swal({
                    title: "delete",
                    text: response.message,
                    icon: "warning",
                    button: "Oke",
                    });
                    bootbox.hideAll();
            }
          }
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