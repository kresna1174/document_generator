<?php date_default_timezone_set("Asia/Jakarta"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title ?? '' ?></title>

  <link href="{!! asset('template') !!}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="{!! asset('template') !!}/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
  <div id="wrapper">
  @include('layout.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <i class="fas fa-calendar-alt"></i> &nbsp; <?= date('D-F-Y') ?>
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>
</nav>

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    @yield('title')
  </div>
  <div class="row">
    @yield('content')
  </div>
  
  <a class="scroll-to-top rounded-circle" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<!-- Bootstrap core JavaScript-->
  <script src="{!! asset('template') !!}/vendor/jquery/jquery.min.js"></script>
  <script src="{!! asset('template') !!}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{!! asset('template') !!}/js/sb-admin-2.min.js"></script>
  <script src="{!! asset('template') !!}/bootbox/bootbox.min.js"></script>
  <script src="{!! asset('template') !!}/bootbox/bootbox.all.min.js"></script>
  <script src="{!! asset('template') !!}/js/datatable.js"></script>
  <script src="{!! asset('template') !!}/js/jquery.js"></script>
  <script src="{!! asset('template') !!}/js/sweet.js"></script>
  @yield('js')
</body>

</html>
