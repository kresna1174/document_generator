@extends('layout.main')
@section('title')
    <h4>Dashboard</h4>
@endsection

@section('content')

  
<div class="container mt-5 pb-5">
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="table-responsive">
            <table width="100%" id="table" class="table table-bordered table-consoned table-striped">
                <thead>
                    <tr>
                        <th>Nama Surat</th>
                        <th>Koneksi</th>
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
  </div>

@endsection
@section('js')
<script>
    $(function(){
        datatable();
    });

    var dataTable;
    function datatable(){
        dataTable = $('#table').DataTable({
            processing: true,
            searchDelay: 1000,
            serverSide: true,
            ajax: '<?= route('dashboard.get_data') ?>',
            columns:[
              {data: 'nama_surat', name: 'nama_surat'},
              {data: 'judul', name: 'judul'},
              {data: 'objek', name: 'objek'},
              {data: 'id',width: '225px', searchable: false, orderable: false, class: 'text-right nowrap',mRender: function(data){
                  return '<button type="button" class="btn btn-info btn-sm" onclick="view('+data+')">view</button> \n\
                        <button type="button" class="btn btn-warning btn-sm" onclick="edit('+data+')">edit</button>\n\
                        <button type="button" class="btn btn-danger btn-sm" onclick="destroy('+data+')">delete</button>\n\
                        <a type="button" href="<?= route('dashboard.download') ?>/'+data+'" class="btn btn-primary btn-sm">download</a>';
              }},
            ]
        });
      }

    function view(id){
        $.ajax({
            url: '<?= route('dashboard.view') ?>/'+id,
            success: function(response){
                bootbox.dialog({
                    title: 'view',
                    message: response
                });
            }
          });
      }

    function edit(id){
          $.ajax({
            url: '<?= route('dashboard.edit') ?>/'+id,
            success: function(response){
                bootbox.dialog({
                    title: 'edit',
                    message: response
                });
            }
          });
      }

    function update(id){
          $.ajax({
            url: '<?= route('dashboard.update') ?>/'+id,
            dataType: 'json',
            type: 'post',
            data: $('#form_dashboard').serialize(),
            success: function(response){
                if(response.success){
                    Swal.fire({
                        title: 'update',
                        icon: 'success',
                        showConfirmButton: false,
                        message: response,
                        html: '<a href="<?= route('dashboard.view_doc') ?>" class="btn btn-primary mt-3">oke</a>'
                    });
                    bootbox.hideAll();
                    dataTable.ajax.reload();
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
                $('#form_dashboard').prepend(validation(response));
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
                    url: '<?= route('dashboard.delete') ?>/'+id,
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
                html_row += '<p><b>'+errors.message+'</b></p>';
                $.each(errors.errors, function(i, error){
                    html_row += error[0]+'<br>';
                });
                html_row += '</div>';
                return html_row;
      }
  </script>
@endsection