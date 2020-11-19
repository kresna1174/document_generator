@extends('layout.main')
@section('title')
<h4>Master Koneksi</h4>
<button type="button" onclick="create()" class="ml-1 mb-2 btn btn-success btn-sm rounded-circle"><i class="fa fa-plus-circle"></i></button>
@endsection
@section('content')
	<div id="connections"></div>            
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
            	$('#connections').html(response);
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
        		get();
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
                get();
            },
            error: function(xhr, ajaxOptions, thrownError){
            	var response = JSON.parse(xhr.responseText);
            	$('#form_koneksi').prepend(validation(response));
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
                  	url: '<?= route('koneksi.delete') ?>/'+id,
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