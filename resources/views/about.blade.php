<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title>Fincoda - survey system</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="{{'landing_page/css/main.css'}}" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>


    <script src="{{'landing_page/js/smoothscroll.js'}}"></script>


</head>

<body data-spy="scroll" data-offset="0" data-target="#navigation">

<!-- Fixed navbar -->
<div id="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}"><img src="{{'landing_page/img/logo-white.png'}}" alt=""></a>
        </div>
        <div class="navbar-collapse collapse">


            <ul class="nav navbar-nav pull-right">
                <li><a href="login" class="smothscroll">Login</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Register  <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li style="padding: 5px 8px;"><a href="register/user">User</a></li>
                        <li style="padding: 5px 8px"><a href="register/company">Company</a></li>

                    </ul>
                </li>


            </ul>
        </div>

        <!--/.nav-collapse -->
    </div>
</div>


<section id="home" name="home"></section>
<div id="headerwrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <h3>Fincoda Survey System</h3>
                <br>
                <p style="font-size: 18px">"Fincoda is a tool for measuring intended learning outcomes in internal development activities for universities and working life organizations."
                 You can create and conduct surveys in your company and organisation and follow the progress. The survey figures and charts help in analysing the results of the survey.
                </p>

                <h4><strong>Registering a company and admin.</strong> </h4>
                <p>To start using the Fincoda Survey System, you need to register your company first. Registering enables you to access the platform
                to create and manage surveys for your company. As you register the company, you would be automatically assigned as the admin of the Fincoda system for your company.
                </p>

                <h4><strong>Company code.</strong> </h4>
                <p>
                    Company code is the unique and secret key assigned for a registered company. The code is sent via email to the admin as soon as the company is registered.
                    This can also be accessed from the company profile page in admin's window.<br><br>

                    This company code is required for a user to register to the company's Fincoda survey system. Therefore, the code has to be distributed to the users by the admin

                </p>

                <h4><strong>User Levels.</strong> </h4>

                <p>
                    Fincoda has three levels of users - admin, special user and basic user. Admin is the administrator level user.
                    In the beginning, each user who registers by providing company code is registered as a basic user for the system. Then the admin can change roles of the users.
                    <br><br>
                    Admin can create a group and assign basic users and a special user for the group. One basic user can be in multiple groups but a special user can be an administrator
                    of only one group at a time.
                </p>

                <h4><strong>Creating and answering surveys.</strong> </h4>

                <p>
                   Admin and special users can create surveys. Survey created by an admin is accessible to all special and basic users of the company.
                   But the survey created by a special user can be accessible only by the members of the group. <br><br>
                   Once the survey is created, members are notified about the new survey. The survey will be opened and closed to the users on the specified date. Once the survey is closed,
                   users can no longer answer the survey.
                </p>

                <h4><strong>Survey results and the analysis.</strong> </h4>

                <p>
                    Admin and special users can create surveys. Survey created by an admin is accessible to all special and basic users of the company.
                    But the survey created by a special user can be accessible only by the members of the group. <br><br>
                    Once the survey is created, members are notified about the new survey. The survey will be opened and closed to the users on the specified date. Once the survey is closed,
                    users can no longer answer the survey.
                </p>

                </div>
            </div>
        </div>
    </div>
</section>




</body>
</html>