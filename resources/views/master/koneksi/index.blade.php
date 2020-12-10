@extends('layout.main')
@section('title')
	<h4>Master Koneksi</h4>
	<button id="btn-create" type="button" onclick="create()" class="ml-1 mb-2 btn btn-success btn-sm rounded-circle"><i class="fa fa-plus-circle"></i></button>
@endsection
@section('content')
<div class="container mt-5 pb-5">
	<div class="panel panel-default">
      	<div class="panel-body">
        	<div id="connections"></div>
      	</div>
    </div>
</div>
@endsection
@section('js')
<script>
    function create(){
		$('#btn-create').prop('disabled', true);
		$.ajax({
			url: '<?= route('koneksi.create') ?>',
			success: function(response){
				bootbox.dialog({
					title: 'create koneksi',
					message: response
				});
			}
		}).done(function() {
            $('#btn-create').prop('disabled', false);
        });
  	}

    $(function(){
        get();
    });

    function get(){
        $.ajax({
        	url: '<?= route('koneksi.get') ?>',
        	success: function(response){
            	$('#connections').html(response);
        	}
    	});
    }

    function edit(id){
		$('#btn-edit').prop('disabled', true);
    	$.ajax({
        	url: '<?= route('koneksi.edit') ?>/'+id,
        	success: function(response){
            	bootbox.dialog({
                	title: 'edit koneksi',
                	message: response
              	});
          	}
        }).done(function() {
			$('#btn-edit').prop('disabled', false);
		});
  	}

    function update(id){
		$('#form_koneksi .alert').remove();
		$('#btn-update').prop('disabled', true);
    	$.ajax({
	      	url: '<?= route('koneksi.update') ?>/'+id,
          	dataType: 'json',
          	type: 'post',
          	data: $('#form_koneksi').serialize(),
          	success: function(response){
            	if(response.success){
                    Swal.fire({
                    title: 'Update berhasil',
                    text: response.message,
                    icon: 'success',
                    confirmButtonColor: '#2c91fb',
                    confirmButtonText: 'Oke'
                    });
                }else{
                    Swal.fire({
                    title: 'Update gagal',
                    text: response.message,
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Oke'
                    });
                }
            	bootbox.hideAll();
        		get();
            },
            error: function(xhr, ajaxOptions, thrownError){
            	var response = JSON.parse(xhr.responseText);
            	$('#form_koneksi').prepend(validation(response));
        	}
        }).done(function() {
			$('#btn-update').prop('disabled', false);
		});
    }

    function store(){
		$('#form_koneksi .alert').remove();
		$("#btn-store").attr("disabled", true);
        $.ajax({
          	url: '<?= route('koneksi.store') ?>',
          	dataType: 'json',
          	type: 'post',
          	data: $('#form_koneksi').serialize(),
          	success: function(response){
            	if(response.success){
                    Swal.fire({
                    title: 'Store berhasil',
                    text: response.message,
                    icon: 'success',
                    confirmButtonColor: '#2c91fb',
                    confirmButtonText: 'Oke'
					});
					$("#btn-str").attr("disabled", false);
                }else{
                    Swal.fire({
                    title: 'Store gagal',
                    text: response.message,
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Oke'
                    });
                }
                bootbox.hideAll();
                get();
            },
            error: function(xhr, ajaxOptions, thrownError){
            	var response = JSON.parse(xhr.responseText);
            	$('#form_koneksi').prepend(validation(response));
        	}
        }).done(function() {
            $('#btn-store').prop('disabled', false);
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
					url: '<?= route('koneksi.delete') ?>/'+id,
					success: function(response){
						if(response.success){
							Swal.fire({
								title : 'Data berhasil di hapus!',
								icon: 'success',
								text: response.message
							});
						}else{
							Swal.fire({
								title : 'Data gagal di hapus!',
								icon: 'error',
								text: response.message
							});
						}
					}
				});
				get();
            }else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
            	'Cancelled',
            	'Data tidak jadi dihapus',
            	'error'
          		)
        	}
        });
	}
		  
	function in_angka(evt){
		var charcode = (evt.which) ? evt.which : event.keyCode
			if(charcode > 31 && charcode < 48 || charcode > 57){
			return false;
		}
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