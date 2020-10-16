@extends('layout.main')
@section('title')
    <span>Master Koneksi</span>
    <a href="javascript:void()" onclick="create()" class="btn btn-success btn-sm rounded-circle"><i class="fa fa-plus-circle"></i></a>
@endsection
@section('content')

     <div class="col-xl-3 col-md-6 mb-4 mt-3">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
@endsection