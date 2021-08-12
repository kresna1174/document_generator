<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{!! asset('template') !!}/img/logo.png">
        <link href="{!! asset('template') !!}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="{!! asset('template') !!}/css/sb-admin-2.min.css" rel="stylesheet">
        <title>Document Generator</title>
    </head>
    <body>
        <style>
            .btn.btn-wf{
                background-color: #00acac;
                color: #fff;
            }
            .my-style{
                margin-top: 25vh !important;
            }
        </style>
        <img src="{!! asset('template') !!}/img/login-bg.jpeg" class="text-left" width="60%" height="100%">
        <div class="float-right mr-5" style="width: 30%;height: 100%;margin-top: 8%;">
            <div class="row margin-box">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center text-info">Document Generator</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" id="login-form" action="{{ route('login') }}" method="POST">
                                @csrf
                                @if(session('errors'))
                                        <div class="alert alert-danger">{{ session('errors') }}</div>
                                @endif
                                <div class="form-floating mb-3">
                                    <label for="Username">Username</label>
                                    <input type="text" class="form-control" id="Username" name="username" placeholder="Username">
                                </div>
                                <div class="form-floating mb-3">
                                    <label for="Password">Password</label>
                                    <input type="password" class="form-control" id="Password" name="password" placeholder="Password">
                                </div>
                                <div class="d-grid">
                                    <input type="submit" name="submit" class="btn btn-wf form-control" value="login">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>







        <script src="{!! asset('template') !!}/vendor/jquery/jquery.min.js"></script>
        <script src="{!! asset('template') !!}/img/login-bg.png"></script>
        <script src="{!! asset('template') !!}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{!! asset('template') !!}/js/sb-admin-2.min.js"></script>
        <script src="{!! asset('template') !!}/bootbox/bootbox.min.js"></script>
        <script src="{!! asset('template') !!}/bootbox/bootbox.all.min.js"></script>
        <script src="{!! asset('template') !!}/js/datatable.js"></script>
        <script src="{!! asset('template') !!}/js/jquery.js"></script>
        <script src="{!! asset('template') !!}/js/sweet.js"></script>
    </body>
</html>