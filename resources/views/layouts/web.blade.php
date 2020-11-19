<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>FIT - UCSC</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('img/fit-nav.png') }}">

        <!-- FONTS -->
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
        <!-- /FONTS -->

        <!-- SCRIPTS -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- /SCRIPTS -->
    
        <!-- STYLES -->
            <!-- BOOTSTRAP -->      <link rel="stylesheet" href="{{ asset('css/app.css') }}" >
            <!-- FONT AWESOME -->   <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/font-awesome.css') }}">
            <!-- LINE AWESOME -->   <link rel="stylesheet" href="{{ asset('lib/line-awesome/css/line-awesome.css') }}">
            <!-- WEB CSS -->      <link rel="stylesheet" href="{{ asset('css/web.css') }}" >
            <!-- ANIMATE -->        <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
        <!-- /STYLES -->

        <!-- JavaScript Libraries -->
        <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('lib/jquery/jquery-migrate.min.js') }}"></script>
        <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
        <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
        <script src="{{ asset('lib/superfish/hoverIntent.js') }}"></script>
        <script src="{{ asset('lib/superfish/superfish.min.js') }}"></script>


        <!-- Template Main Javascript File -->
        <script src="{{ asset('js/web.js') }}"></script>
    </head>

    <body>
    
    <!--==========================
    Header
    ============================-->
    <header id="header">

        <div id="logo" class="pull-left">
            <a href="/"><img src="img/logo/fit-nav.png" alt="" title="" style="width: 65px; padding: 0px 0px 0px 0px;"/></a>

        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
            <li id="home_nav"><a href="/">Home</a></li>
            <li id="programme_nav"><a href="programme">Programme</a></li>
            <li id="learning_nav"><a href="learning">Learning</a></li>
            <li id="examination_nav"><a href="examination">Examination</a></li>
            <li id="registration_nav"><a href="registration">Registration</a></li>
            <li id="contact_nav"><a href="contact-us">Contact Us</a></li>
            <li id="login_nav"><a href="login">Login</a></li>

            </ul>
        </nav><!-- #nav-menu-container -->
        </div>
    </header><!-- #header -->
        @yield('content')

    <!--==========================
        Footer
    ============================-->
    <footer id="footer">
        <div class="footer-top">
        <div class="container">

        </div>
        </div>

        <div class="container">
        <div class="copyright">
            &copy; Copyright <strong>UCSC</strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <strong>e-Learning Center- UCSC </strong>
        </div>
        </div>
    </footer><!-- #footer -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>



    </body>
</html>