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
    <script src="{{URL::asset('js/confirmation.js')}}" ></script>

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
            <ul class="nav navbar-nav">
                <li class="active"><a href="#home" class="smothscroll">Home</a></li>
                <li><a href="#desc" class="smothScroll">Description</a></li>
                <li><a href="#showcase" class="smothScroll">Showcase</a></li>
                <li><a href="#contact" class="smothScroll">Contact</a></li>
                <li><a href="#tutorial" class="smothScroll">Tutorial</a></li>
            </ul>

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
                <li></li>
                <li style="font-size: 14px"><a href="{{url('/about')}}"></i>  About</a></li>


            </ul>
        </div>

        <!--/.nav-collapse -->
    </div>
</div>


<section id="home" name="home"></section>
<div id="headerwrap">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-12">
                <h1>Fincoda Survey System</h1>
                <br>
                <h3>A tool for Universities and other working life organizations for measuring individuals’ innovation competences</h3>
                <br><br>
            </div>

            <div class="col-lg-2">
                <h5>Amazing Results</h5>
                <p>Scaled bar charts with all data fit in provide visual presentation of categorical data.</p>
                <img class="hidden-xs hidden-sm hidden-md" src="{{'landing_page/img/arrow1.png'}}">
            </div>
            <div class="col-lg-8">
                <img class="img-responsive" src="{{'landing_page/img/column.png'}}" alt="">
                <br><br>
            </div>
            <div class="col-lg-2">
                <br>
                <img class="hidden-xs hidden-sm hidden-md" src="{{'landing_page/img/arrow2.png'}}">
                <h5>Awesome Design</h5>
                <p>Column chart in survey report displays grouped data as vertical bars and show comparisons among categories.</p>
            </div>
        </div>
    </div> <!--/ .container -->
</div><!--/ #headerwrap -->


<section id="desc" name="desc"></section>
<!-- INTRO WRAP -->
<div id="intro">
    <div class="container">
        <div class="row centered">
            <h1>FINCODA - Framework for innovation competencies <br>development and assessment</h1>
            <br>
            <br>
            <div class="col-lg-4">
                <img src="{{'landing_page/img/survey.png'}}" alt="">
                <h3>Features</h3>
                <p>Internal development activities and<br>training services for staff</p>
            </div>
            <div class="col-lg-4">
                <img src="{{'landing_page/img/employee.png'}}" alt="">
                <h3>Benefits</h3>
                <p>Improve the quality and efficiency of education and training</p>
            </div>
            <div class="col-lg-4">
                <img src="{{'landing_page/img/innovation.png'}}" alt="">
                <h3>Objectives</h3>
                <p>Innovation competence development and<br>assessment</p>
            </div>
        </div>
        <br>

    </div> <!--/ .container -->
</div><!--/ #introwrap -->

<!-- FEATURES WRAP -->
<div id="features">
    <div class="container">
        <div class="row centered">
            <h1>FINCODA - production of remarkable tangible outputs</h1>
            <br>
            <br>
            <div class="col-lg-7">
                <img class="centered" src="{{'landing_page/img/thumbs.jpg'}}" alt="">
            </div>
            <div class="col-lg-5 align-left">
                <h3>FINCODA produces several remarkable tangible outputs:</h3>
                    <p><br>
                    &#10003 &nbsp A Toolkit for Behaviour Assessment: <br>
                    Available as an electronic guide on the Internet<br>
                    Can be used as a self learning material guide for training purposes<br><br>
                    &#10003 &nbsp Software Application for Innovation Competencies Assessment<br><br>
                    &#10003 &nbsp Massive Open Online Courses related to Behaviour Assessment<br><br>
                    &#10003 &nbsp Rater Training Workshop<br><br>
                    &#10003 &nbsp Innovation Competencies Assessment Workshops</p>
            </div>
        </div>
    </div><!-- /accordion-group -->
</div><!-- Accordion -->



<section id="showcase" name="showcase"></section>
<div id="showcase">
    <div class="container">
        <div class="row centered">
            <h1>FINCODA - user friendly design</h1>
            <br><br>
            <div class="col-lg-8 col-lg-offset-2">
                <div id="carousel-example-generic" class="carousel slide">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="{{'landing_page/img/item-01.png'}}" alt="">
                        </div>
                        <div class="item">
                            <img src="{{'landing_page/img/item-01.png'}}" alt="">
                        </div>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div><!-- /container -->
</div>


<div id="contact">
    <div class="container">
        <div class="row centered">
            <h1>FINCODA - we need your opinion</h1>
            <br>
            <div class="col-lg-12 align-center">
                <h3>Contact</h3>
                <p>
                Mr. Balsam Almurrani<br/>
                FINCODA Software Application Manager<br/>
                Turku University of Applied Sciences<br/>
                Turku Finland<br>
                balsam.almurrani@turkuamk.fi<br>
                Tel +358-449074990
                </p>
            </div>
            <!-- <div class="col-lg-6 align-right">
                <h3>Drop any question or suggestion</h3>
                <br>
                <form role="form" action="#" method="post" enctype="plain">
                    <div class="form-group">
                        <label for="name1">Your Name</label>
                        <input type="name" name="Name" class="form-control" id="name1" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <label for="email1">Email address</label>
                        <input type="email" name="Mail" class="form-control" id="email1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="Message" id="message1" rows="3"></textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-large btn-success" id="submit-home-contact">SUBMIT</button>
                </form>
            </div> -->
        </div>
    </div>
</div>

<div id="tutorial">
    <div class="container">
        <div class="row centered">
            <h1>FINCODA - Tutorials</h1>
            <div class="col-lg-4">
                <h3>Organisation Registration</h3>
                <a href="https://www.youtube.com/watch?v=WB9UMq9MyYQ" target="_blank">Click here to watch tutorial</a>
            </div>
            <div class="col-lg-4">
                <h3>Basic User Registration</h3>
                <a href="https://www.youtube.com/watch?v=nB1fT9D0k1U" target="_blank">Click here to watch tutorial</a>
            </div>
            <div class="col-lg-4">
                <h3>View Survey Results</h3>
                <a href="https://www.youtube.com/watch?v=doC_OkgjrKY" target="_blank">Click here to watch tutorial</a>
            </div>
            <div class="col-lg-4">
                <h3>Create a Self Survey</h3>
                <a href="https://www.youtube.com/watch?v=Ernimd40rWQ" target="_blank">Click here to watch tutorial</a>
            </div>
            <div class="col-lg-4">
                <h3>Create a Peer Survey</h3>
                <a href="https://www.youtube.com/watch?v=NKFZbFxpr0k" target="_blank">Click here to watch tutorial</a>
            </div>
        </div>
    </div> <!--/ .container -->
</div><!--/ #tutorialwrap -->


<div class="container">
<div class="row row-logo">
    <style media="screen">
      img {
        width: 80%;
        height: 80%;
      }
    </style>
    <div class="logos-long col-sm-6" style="position: relative; float: left;">
        <a href="#" target="_blank"><img src="{{ url('landing_page/img/Logos/eu_flag_co_funded_pos_brgbd_right.jpg')}}"></a>
    </div>
    <div class="logos-long col-sm-3" style="position: relative; float: right;">
        <a href="http://www.tuas.fi/en/" target="_blank"><img src="{{ url('landing_page/img/Logos/TURKU.jpg')}}"></a>
    </div>
</div>
<div class="row row-logo">
    <div class="logos col-sm-3">
        <a href="http://www2.mmu.ac.uk/" target="_blank"><img src="{{ url('landing_page/img/Logos/MMU.gif')}}"></a>
    </div>
    <div class="logos col-sm-3">
        <a href="https://www.international.hu.nl/" target="_blank"><img src="{{ url('landing_page/img/Logos/HU_LOGO_1.jpg')}}"></a>
    </div>
    <div class="logos col-sm-3">
        <a href="https://www.upv.es/" target="_blank"><img src="{{ url('landing_page/img/Logos/UPV.png')}}"></a>
    </div>
    <div class="logos col-sm-3">
        <a href="https://www.haw-hamburg.de/english.html" target="_blank"><img src="{{ url('landing_page/img/Logos/Hamburg.jpg')}}"></a>
    </div>
  </div>
  <div class="row row-logo">
    <div class="logos col-sm-3">
        <a href="http://www.cartercorson.co.uk/" target="_blank"><img src="{{ url('landing_page/img/Logos/Carter Corson.png')}}"></a>
    </div>
    <div class="logos col-sm-3">
        <a href="https://www.celestica.com/home" target="_blank"><img src="{{ url('landing_page/img/Logos/Celestica.png')}}"></a>
    </div>
    <div class="logos col-sm-3">
        <a href="http://www.ecdl.nl/" target="_blank"><img src="{{ url('landing_page/img/Logos/ECDL.gif')}}"></a>
    </div>

    <div class="logos col-sm-3">
        <a href="http://www.enterprise-europe.co.uk/" target="_blank"><img src="{{ url('landing_page/img/Logos/EENNW.jpg')}}"></a>
    </div>
  </div>
  <div class="row row-logo">
    <div class="logos col-sm-2">
        <a href="https://www.elomatic.com/en/" target="_blank"><img src="{{ url('landing_page/img/Logos/Elomatic.jpg')}}"></a>
    </div>
    <div class="logos col-sm-2">
        <a href="http://www.johncaunt.com/" target="_blank"><img src="{{ url('landing_page/img/Logos/JCS logo.jpg')}}"></a>
    </div>
    <div class="logos col-sm-2">
        <a href="http://www.lactoprot.de/english/home.html" target="_blank"><img src="{{ url('landing_page/img/Logos/Lactoprot.jpg')}}"></a>
    </div>
    <div class="logos col-sm-2">
        <a href="http://www.meyerturku.fi/en/meyerturku_com/index.jsp" target="_blank"><img src="{{ url('landing_page/img/Logos/Meyer Turku.jpg')}}"></a>
    </div>
    <div class="logos col-sm-2">
        <a href="https://www.schneider-electric.es/es/" target="_blank"><img src="{{ url('landing_page/img/Logos/Schneider Electric.gif')}}"></a>
    </div>

</div>

</div><hr>

<div class="navbar copyright">
    <div class="pull-left col-sm-6">
        <h4>Copyright © 2015 FINCODA</h4>
    </div>
</div>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script>
    $('.carousel').carousel({
        interval: 3500
    })
</script>
</body>
</html>
