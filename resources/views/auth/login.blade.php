<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login : Siimteq CMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset ("bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset ("bower_components/font-awesome/css/font-awesome.min.css") }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset("bower_components/Ionicons/css/ionicons.min.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset ("bower_components/admin-lte/dist/css/AdminLTE.min.css")}}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{ asset("bower_components/admin-lte/dist/css/skins/skin-blue.min.css")}}">
  <link rel="stylesheet" href="{{ asset("bower_components/admin-lte/plugins/iCheck/square/blue.css") }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Siimteq</b>CMS</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" value="{{ old('email') }}" required autofocus>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        <div class="row">
          <div class="col-xs-8">
          </div>
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Login') }}</button>
          </div>
        </div>
        <div class="row" style="margin-top:15px;">
          <a class="btn btn-link pull-right" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
          </a>
        </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


    <!-- jQuery 2.1.3 -->
    <script src="{{ asset ("bower_components/jquery/dist/jquery.min.js") }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ("bower_components/bootstrap/dist/js/bootstrap.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("bower_components/admin-lte/plugins/iCheck/icheck.min.js") }}"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' /* optional */
        });
      });
    </script>
  </body>
</html>
<!-- iCheck -->

</body>
</html>
