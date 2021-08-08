<?php date_default_timezone_set("Asia/Jakarta"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title ?? '' ?></title>
  <link rel="icon" href="{!! asset('template') !!}/img/logo.png">
  <link href="{!! asset('template') !!}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="{!! asset('template') !!}/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- <link href="{!! asset('sweetalert') !!}/dist/sweetalert.css" rel="stylesheet"> -->
  <link href="{!! asset('template') !!}/datatable/DataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="{!! asset('template') !!}/datatable/Button/css/buttons.bootstrap4.min.css" rel="stylesheet">
  <link href="{!! asset('jquery.growl') !!}/css/jquery.growl.css" rel="stylesheet">
  <link href="{!! asset('template') !!}/datatable/DataTables/css/dataTables.responsive.min.css" rel="stylesheet">
  <link href="{!! asset('template') !!}/css/style.css" rel="stylesheet">
</head>

<body>
   <div id="wrapper">
  @include('layout.sidebar')
<div id="content-wrapper" class="d-flex flex-column">
  <div id="content">
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown no-arrow content">
          <span class="mr-2 d-none d-lg-inline text-gray-600 medium"><i class="fas fa-calendar">&nbsp;</i><?= date('l, j-F-Y') ?></span>
        </li>
      </ul>
      {{-- <a href="javascript:void()" class="dropdown-toggle" data-toggle="dropdown">
        <span class="hidden-xs">name</span> <b class="caret"></b>
      </a> --}}
      <div class="dropdown">
        <a href="javascript:void()" class="nav-link text-dark mr-5 text-decoration-none mt-2 " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user fa-lg mr-2"></i><span>{{ auth()->user()->name }}</span><i class="fas fa-caret-down ml-1"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow " aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="{{ route('dashboard.user') }}"><i class="fas fa-cog fa-1x mr-3" onclick="document.location.href='<?= route('dashboard.user')?>'"></i> Setting</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{  route('logout') }}"><i class="fas fa-sign-out-alt fa-1x mr-3" onclick="document.location.href='<?= route('logout') ?>'"></i>Log Out</a>
        </div>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="d-sm-flex align-items-center mr-auto content">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
      </div>
      <div class="content">
        <div class="row card shadow">
        @yield('content')
      </div>
    </div>
    </div>
  </div>
  

</div>
<!-- End of Content Wrapper -->

</div>
<!-- Bootstrap core JavaScript-->
<script src="{!! asset('template') !!}/vendor/jquery/jquery.min.js"></script>
<script src="{!! asset('template') !!}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{!! asset('template') !!}/js/sha256.js"></script>
<script src="{!! asset('template') !!}/js/sb-admin-2.min.js"></script>
<script src="{!! asset('template') !!}/bootbox/bootbox.min.js"></script>
<script src="{!! asset('template') !!}/bootbox/bootbox.all.min.js"></script>
<script src="{!! asset('template') !!}/bootbox/bootbox.locales.min.js"></script>
<script src="{!! asset('template') !!}/js/datatable.js"></script>
<script src="{!! asset('template') !!}/js/jquery.js"></script>
<script src="{!! asset('template') !!}/js/sweet.js"></script>
<script src="{!! asset('template') !!}/datatable/DataTables/js/jquery.dataTables.min.js"></script>
<script src="{!! asset('template') !!}/datatable/DataTables/js/dataTables.bootstrap.min.js"></script> 
<script src="{!! asset('template') !!}/datatable/DataTables/js/dataTables.bootstrap4.min.js"></script>
<script src="{!! asset('sweetalert') !!}/sweet.min.js"></script>
<script src="{!! asset('blockui') !!}/blockui.js"></script>
<script src="{!! asset('jquery.growl') !!}/js/jquery.growl.js"></script>
<script src="{!! asset('template') !!}/datatable/JSZip/jszip.min.js"></script>
<script src="{!! asset('template') !!}/datatable/pdfmake/pdfmake.min.js"></script>
<script src="{!! asset('template') !!}/datatable/pdfmake/vfs_fonts.js"></script>
<script src="{!! asset('template') !!}/datatable/DataTables/js/dataTables.responsive.min.js"></script>
<script src="{!! asset('template') !!}/datatable/DataTables/js/dataTables.select.min.js"></script>
<script src="{!! asset('template') !!}/datatable/DataTables/js/dataTables.searchPanes.min.js"></script>
<script src="{!! asset('template') !!}/datatable/DataTables/js/dataTables.scroller.min.js"></script>
  @yield('js')
<script src="{!! asset('js') !!}/build.js"></script>
</body>

</html>
