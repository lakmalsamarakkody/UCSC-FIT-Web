<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>FIT - UCSC</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('img/logo/fav.png') }}">

        <!-- FONTS -->
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
        <!-- /FONTS -->


        <!-- STYLES -->
            <!-- BOOTSTRAP -->      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <!-- FONT AWESOME -->   <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/all.css') }}">
            <!-- LINE AWESOME -->   <link rel="stylesheet" href="{{ asset('lib/line-awesome/css/line-awesome.css') }}">
            <!-- ANIMATE -->        <link rel="stylesheet" href="{{ asset('lib/animate/animate.min.css') }}">
            <!-- PAGE CUSTOM CSS -->
            <link rel="stylesheet" href="{{ asset('css/website/core.css') }}">
            <link rel="stylesheet" href="{{ asset('css/website/navigation.css') }}">
            <link rel="stylesheet" href="{{ asset('css/website/header.css') }}">
            <link rel="stylesheet" href="{{ asset('css/website/footer.css') }}">
            <link rel="stylesheet" href="{{ asset('css/website/web.css') }}">
            <link rel="stylesheet" href="{{ asset('css/website/about-us.css') }}">
            <link rel="stylesheet" href="{{ asset('css/website/programme.css') }}">
            <link rel="stylesheet" href="{{ asset('css/website/learning.css') }}">
            <link rel="stylesheet" href="{{ asset('css/website/examination.css') }}">
            <link rel="stylesheet" href="{{ asset('css/website/registration.css') }}">
            <link rel="stylesheet" href="{{ asset('css/website/contact-us.css') }}">
            <link rel="stylesheet" href="{{ asset('css/website/faq.css') }}">
        <!-- /STYLES -->

        <!-- JavaScript Libraries -->
        
        <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('lib/jquery/jquery-migrate.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
        <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
        <script src="{{ asset('lib/superfish/hoverIntent.js') }}"></script>
        <script src="{{ asset('lib/superfish/superfish.min.js') }}"></script>

        <!-- SCRIPTS -->
        <!-- /SCRIPTS -->
    
        <!-- Template Main Javascript File -->
        <script src="{{ asset('js/web.js') }}"></script>
    </head>

    <body>
    
    <!--==========================
    Header
    ============================-->
    <header id="header">  
        <div class="col-md-12">
        <div class="row">
            <div class="col-md-1">
                <div id="logo" class="pull-left">
                    <a href="/"><img src="{{ url('img/logo/fit-nav.png') }}" alt="" title="" style="width: 65px; padding: 0px 0px 0px 0px;"/></a>
                </div>
            </div>

            <div class="col-md-10">
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li id="home_nav"><a href="{{ url('/') }}">Home</a></li>
                        <li id="home_nav"><a href="{{ url('/#about') }}">About</a></li>
                        <li id="programme_nav"><a href="{{ url('/programme') }}">Programme</a></li>
                        <li id="learning_nav"><a href="{{ url('/learning') }}">Learning</a></li>
                        <li id="examination_nav"><a href="{{ url('/examination') }}">Examination</a></li>
                        <li id="registration_nav"><a href="{{ url('/registration') }}">Registration</a></li>
                        <li id="contact_nav"><a href="{{ url('/contact') }}">Contact Us</a></li>
                        <li id="login_nav"><a href="{{ url('/login') }}">Login</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col-md-1 text-right" id="ucsc_logo">
                <a href="/"><img src="{{ url('img/logo/invert-ucsc.png') }}" alt="" title="" style="width: 45px; padding: 0px 0px 0px 0px;"/></a>
            </div>
        </div>
        </div>

    </header><!-- #header -->

        @yield('content')

    <!--==========================
        Footer
    ============================-->
    <footer id="footer">
        <div class="footer-top">

            <!-- <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <h2>EXTERNAL DEGREES CENTRE</h2>
                                <p>
                                Co-ordinator,<br/>
                                External Degree Centre of UCSC,<br/>
                                University of Colombo School of Computing<br/>
                                UCSC Building Complex,<br/>
                                35, Reid Avenue,<br/>
                                Colombo 00700
                                </p>
                                <p>
                                Tel:  +94 -11- 2581245 / +94 -11- 2581247
                                Fax:  +94 -11-2587239
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <h2>STAY CONNECTED</h2>
                                <i class="fab fa-twitter"></i>
                                <i class="fab fa-facebook-f"></i>
                                <i class="fab fa-youtube"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </div> -->

            <div class="container">
                <div class="copyright justify-content-center ">
                    <h1> 
                        <a target="_blank" href="" class="white"><i class="fab fa-twitter-square"></i></a>
                        <a target="_blank" href="" class="white"><i class="fab fa-facebook-square"></i></a>
                        <a target="_blank" href="" class="white"><i class="fab fa-youtube-square"></i></a>
                    </h1> 
                    <h4><a href="" class="white">Site Map </a>|<a href="" class="white"> Pivacy Policy </a>|<a href="" class="white"> Terms</a></h5>
                    
                </div>
                <div class="copyright">
                    Copyright &copy;  {{ now()->year }}<strong><a target="_blank" href="https://ucsc.cmb.ac.lk/" class="white"> UCSC</a> </strong>. All Rights Reserved 
                </div>
                <div class="credits">
                    Designed by <strong><a target="_blank" href="http://www.e-learning.lk/" class="white">e-Learning Center- UCSC </a> </strong>
                </div>
            </div>
        </div>
    </footer><!-- #footer -->

    <a href="#top" class="back-to-top"><i class="fa fa-chevron-up"></i></a>



    </body>
</html>