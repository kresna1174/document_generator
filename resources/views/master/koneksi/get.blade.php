@foreach($model as $row)
    <div class="col-xl-12 col-md-6 mb-4 mt-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-4">
                        <div class="h5 mb-0 font-weight-bold text-gray-800 pb-5">{{ $row->nama_db }}</div>
                        <a href="javascript:void()" class="text-xs font-weight-bold btn btn-warning btn-sm mb-1" onclick="edit('{!! $row->id !!}')">Edit</a>
                        <a href="javascript:void()" class="text-xs font-weight-bold btn btn-danger btn-sm mb-1" onclick="destroy('{!! $row->id !!}')">Delete</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-database fa-5x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach