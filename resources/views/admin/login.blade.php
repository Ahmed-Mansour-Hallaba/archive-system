<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ trans('admin.login') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('design/adminPanel') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ url('design/adminPanel') }}/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ url('design/adminPanel') }}/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ url('design/adminPanel') }}/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="{{ url('design/adminPanel') }}/plugins/iCheck/square/blue.css">
  <link rel="icon" href="{{  url('/design/adminPanel/dist/img/icon.jpg') }}">
  <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
</head>
<body class="hold-transition login-page">
@if (session()->has('error'))
    <div class="container alert alert-danger text-center" style="margin-top: 15px;">
        <h3>{{ session('error') }}</h3>
    </div>
@endif
<div class="login-box">

  <div class="login-logo">
    <a href="#"><b>تسجيل الدخول</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><b>يُرجى تسجيل الدخول أولاً</b></p>

    <form method="post">
        {!! csrf_field() !!}
      <div class="form-group has-feedback ">
        <input type="email" class="form-control text-right" name="email" placeholder="البريد الإلكترونى" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control text-right" name="password" placeholder="الرقم السرى" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="">
          <button type="submit" class="btn btn-primary btn-block">تسجيل الدخول</button>
        </div>
    </form>

  </div>
</div>
<script src="{{ url('design/adminPanel') }}/bower_components/jquery/dist/jquery.min.js"></script>
<script src="{{ url('design/adminPanel') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{ url('design/adminPanel') }}/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script>
  $(document).ready(function() {
    $(".alert")
        .delay(2000)
        .fadeOut(3000);
  });
</script>
</body>
</html>
