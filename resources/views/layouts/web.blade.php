<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>FIT - UCSC</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="/img/favicon.png">

        <!-- FONTS -->
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
        <!-- /FONTS -->

        <!-- SCRIPTS -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- /SCRIPTS -->
    
        <!-- STYLES -->
            <!-- BOOTSTRAP -->      <link rel="stylesheet" href="{{ asset('css/app.css') }}" >
            <!-- CSS -->      <link rel="stylesheet" href="{{ asset('css/web.css') }}" >
            <!-- LINE AWESOME -->   <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}">
            <!-- ANIMATE -->        <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
        <!-- /STYLES -->



<body>
  <!--==========================
  Header
  ============================-->
  <header id="header">

      <div id="logo" class="pull-left">
        <a href="#hero"><img src="img/fit.png" alt="" title="" style="width: 60px; padding: 0px 0px 0px 0px;"/></img></a>

      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#hero">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#">Programme</a></li>
          <li><a href="#">Registration</a></li>
          <li><a href="#">Learning</a></li>
          <li><a href="#">Examination</a></li>
          <li><a href="#">Contact Us</a></li>

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
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Regna
        -->
        Designed by <a href="https://www.linkedin.com/in/dinusha-kulasooriya-599a68a6/a">e-Learning Center- UCSC</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="la la-chevron-up"></i></a>

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

</body>




</html>