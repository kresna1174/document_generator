@foreach($model as $row)
<button id="btn-str" class="col-xl-5 col-md-12 mb-4 mt-3 ml-5 border-0 bg-light" ondblclick="create('{!! $row->id !!}')">
        <div class="card border-left-primary shadow h-100 py-3">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-4">
                        <div class="col-auto float-left">
                            <i class="fas fa-file-alt fa-6x text-gray-300"></i>
                        </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800 float-left mt-2">{{ $row->nama_surat }}</div>
                </div>
            </div>
        </div>
    </div>
</button>
@endforeach