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
		$.ajax({
			url: '<?= route('koneksi.create') ?>',
			success: function(response){
				bootbox.dialog({
					title: 'create koneksi',
					message: response
				});
			}
		})
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
                	title: 'edit koneksi',
                	message: response
              	});
          	}
        })
  	}
	
	function store(){
		$('#form_koneksi .alert').remove();
		$('#form_koneksi').blockUI();
        $.ajax({
          	url: '<?= route('koneksi.store') ?>',
          	dataType: 'json',
          	type: 'post',
          	data: $('#form_koneksi').serialize(),
          	success: function(response){
            	if(response.success){
                    $.growl.notice({message: 'Store berhasil'});
                }else{
                    $.growl.error({message: 'Store gagal'});
                }
                bootbox.hideAll();
                get();
            },
            error: function(xhr, ajaxOptions, thrownError){
            	var response = JSON.parse(xhr.responseText);
            	$('#form_koneksi').prepend(validation(response));
        	}
        })
		$('#form_koneksi').unblock();
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
                    $.growl.notice({message: 'Update berhasil'});
                }else{
                    $.growl.error({message: 'Update gagal'});
                }
                bootbox.hideAll();
        		get();
            },
            error: function(xhr, ajaxOptions, thrownError){
            	var response = JSON.parse(xhr.responseText);
            	$('#form_koneksi').prepend(validation(response));
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
					url: '<?= route('koneksi.delete') ?>/'+id,
					success: function(response){
						if(response.success){
							$.growl.notice({message: 'Data berhasil dihapus!'});
							get();
						}else{
							$.growl.error({message: 'Data gagal dihapus!'});
						}
					}
				});
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