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
            <!-- CSS -->      <link rel="stylesheet" href="{{ asset('css/home.css') }}" >
            <!-- LINE AWESOME -->   <link rel="stylesheet" href="{{ asset('css/line-awesome/css/line-awesome.css') }}">
            <!-- ANIMATE -->        <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
        <!-- /STYLES -->



<body>

  <!--==========================
  Header
  ============================-->
  <header id="header">

      <div id="logo" class="pull-left">
        <a href="#hero"><img src="img/fit.png" alt="" title="" style="width: 60px; padding: 0px 0px 0px 0px;"/></img></a>
        <!-- Uncomment below if you prefer to use a text logo -->
        <!--<h1><a href="#hero">Regna</a></h1>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#hero">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#about">Programme</a></li>
          <li><a href="#services">Registration</a></li>
          <li><a href="#services">Learning</a></li>
          <li><a href="#services">Examination</a></li>
          <li><a href="#services">Contact Us</a></li>

          <li><a href="../ncwms-back/index.php" target="_blank">Login</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Hero Section
  ============================-->
  <section id="hero" style="background-image: url({{ asset('img/hero-back.png') }});">
    <div class="hero-container">
      <h1 style="text-align: left;">Foundation in Information Technology</h1>
      <h2>University of Colombo School of Computing</h2>
      <a href="#about" class="btn-get-started" style="width=25px">About FIT</a>
    </div>
  </section><!-- #hero -->

  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">
        <div class="row about-container">

          <div class="col-lg-6 content order-lg-1 order-2">
            <h2 class="title">Few Words About Us</h2>
            <p>
              We are an organization which is passionate and dedicated in delivering high quality education and high quality software solutions to meet the industry requirements!
                                <br>
                                ISeeQ Pvt Ltd is an organization with a motive of serving the society, established in 2012. As the initial step it started catering education service then diversified its business to providing software solutions to various industries. These business activities become the main funding source for the ultimate motive of ISeeQ that is establishing a proper system to cater needy children and turning them to a productive and healthy citizen for the nation. 
            </p>
            <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-globe"></i></div>
              <h4 class="title"><a href="">For other information</a></h4>
              <p class="description">Please visit our education provider website from here</p>
            </div>

          </div>

          <div class="col-lg-6 background order-lg-2 order-1 wow fadeInRight"></div>
        </div>

      </div>
    </section><!-- #about -->



  </main>

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

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

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

  <!-- Contact Form JavaScript File -->
  <script src="{{ asset('contactform/contactform.j') }}s"></script>

  <!-- Template Main Javascript File -->
  <script src="{{ asset('js/main.js') }}"></script>

</body>




    </body>
</html>