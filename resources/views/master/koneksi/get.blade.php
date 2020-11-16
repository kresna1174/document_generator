@foreach($model as $row)
    <div class="col-xl-12 col-md-6 mb-4 mt-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-4">
                        <div class="h5 mb-0 font-weight-bold text-gray-800 pb-4">{!! $row->judul !!}</div>
                        <div class="h5 mb-0 text-gray-800 pb-3" style="font-size:15px;"><span class="font-weight-bold">Nama Database :</span>{!! $row->nama_db !!}</div>
                        <div class="h5 mb-0 text-gray-800 pb-3" style="font-size:15px;"><span class="font-weight-bold">Username :</span>{!! $row->username !!}</div>
                        <div class="h5 mb-0 text-gray-800 pb-3" style="font-size:15px;"><span class="font-weight-bold">Host :</span>{!! $row->host !!}</div>
                        <div class="h5 mb-0 text-gray-800 pb-3" style="font-size:15px;"><span class="font-weight-bold">Port :</span>{!! $row->port !!}</div>
                        <a href="javascript:void()" class="text-xs font-weight-bold btn btn-warning btn-sm mb-1" onclick="edit('{!! $row->id !!}')">Edit</a>
                        <a href="javascript:void()" class="text-xs font-weight-bold btn btn-danger btn-sm mb-1" onclick="destroy('{!! $row->id !!}')">Delete</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-database fa-8x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach