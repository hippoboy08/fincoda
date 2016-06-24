<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{'css/AdminLTE.min.css'}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{'iCheck/square/blue.css'}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../public"><b>FINCODA</b></a>

    </div><!-- /.login-logo -->

    <div class="login-box-body">
        <p class="login-box-msg">Please provide your email address and password</p>



        {!! Form::open(['method'=>'POST']) !!}
        <div class="form-group has-feedback">
            <div class="form-group{!! $errors->has('email') ? ' has-error':'' !!}">
                @if($errors->has('email'))
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Email and/or password does not match.</label>
                    @endif

                {!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=>'Email','required'=>'required']) !!}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

        </div>
            </div>
        <div class="form-group has-feedback">
            {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password','required'=>'required']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox"> Remember Me
                    </label>
                </div>
            </div>
            </div><!-- /.col -->
            <div class="col-xs-12">
                {!! Form::submit('Login',['class'=>'btn btn-primary btn-block btn-flat']) !!}
                {!! Form::close() !!}
            </div><br><br><br>

        <a href="#">I forgot my password</a><br>
        <br>
        <a href="register.html" class="text-center">Register a new company</a><br>
        --OR--<br>
        <a href="register.html" class="text-center">Register as a company member</a>


    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<script src="{{'iCheck/icheck.min.js'}}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
