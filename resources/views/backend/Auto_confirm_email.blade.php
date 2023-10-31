<!DOCTYPE html>
<html>

<!-- Mirrored from adminlte.io/themes/AdminLTE/pages/examples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Apr 2023 17:29:53 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>IIN</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="{{asset('admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admin_assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('admin_assets/bower_components/Ionicons/css/ionicons.min.css')}}">
<link rel="stylesheet" href="{{asset('admin_assets/dist/css/AdminLTE.min.css')}}">
{{-- <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css"> --}}
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<body class="hold-transition login-page">
<div class="login-box">

<div class="login-box-body">
<p class="login-box-msg">Sign in to start your session</p>
<form>
<div class="form-group has-feedback">
<input type="email" class="form-control" placeholder="Email">
<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
<input type="password" class="form-control" placeholder="Password">
<span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>
<div class="row">
<div class="col-xs-4">
<button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
</div>
</div>
<?php
date_default_timezone_set('Asia/Kolkata'); // Set timezone to India Standard Time (IST)
echo date('l dS F Y h:i:s A T');
?>
</form>
</div>
</div>
<script src="{{asset('admin_assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('admin_assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
{{-- <script src="../../plugins/iCheck/icheck.min.js"></script> --}}
</body>
</html>