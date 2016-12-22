<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FINCODA | Registration</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{'../css/custom.css'}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{'../css/AdminLTE.min.css'}}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{'../iCheck/square/blue.css'}}">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    </head>
<body data-spy="scroll" data-offset="0" data-target="#navigation">
<div id="navigation" class="navbar navbar-default navbar-fixed-top">

    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../"><b>FINCODA</b></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav pull-right">
                <li><a href="../login" class="smothscroll">Login</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Register  <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li style="padding: 5px 8px;"><a href="../register/user">User</a></li>
                        <li style="padding: 5px 8px"><a href="company">Company</a></li>
                    </ul>
                </li>


            </ul>
        </div>

        <!--/.nav-collapse -->
    </div>
</div>
@yield('content')
</body>


</html>