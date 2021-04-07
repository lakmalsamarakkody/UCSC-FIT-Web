<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('img/logo/fav.png') }}">

  <title>FIT - Profile | {{ $title ?? '' }}</title>
  
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- STYLES -->
    <!-- BOOTSTRAP -->      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- FONT AWESOME -->   <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/all.css') }}">
    <!-- LINE AWESOME -->   <link rel="stylesheet" href="{{ asset('lib/line-awesome/css/line-awesome.css') }}">
    <!-- ANIMATE -->        <link rel="stylesheet" href="{{ asset('lib/animate/animate.min.css') }}">    
    <!-- DROPZONE -->       <link rel="stylesheet" href="{{ asset('lib/dropzone/drop-zone.css') }}">

    <!-- DATATABLE  -->
    <link rel="stylesheet" href="{{ asset('lib/datatables/css/dataTables.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('lib/datatables/css/dataTables.bootstrap4.min.css') }}" >
    <!-- DATATABLE -->

    <!-- PAGES -->
    <link rel="stylesheet" href="{{ asset('css/portal/core.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portal/staff/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portal/staff/exams.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portal/staff/system.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portal/staff/student.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portal/staff/student/application.css') }}">
    <!-- /PAGES --> 
  <!-- /STYLES -->

  <!-- SCRIPTS -->
    <script src="{{ asset('js/app.js') }}" differ></script>

    <!-- SWEET ALERT 2 -->
    <script src="{{ asset('lib/sweetalert2/sweetalert2.all.js') }}"></script>
    <!-- /SWEET ALERT 2 -->
    
    <!-- DATATABLE SCRIPTS -->
    <script src="{{ asset('lib/jquery/jquery.validate.js') }}"></script>
    <script src="{{ asset('lib/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lib/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- /DATATABLE SCRIPTS -->

    <script src="{{ asset('js/portal.js') }}"></script>
    <script src="{{ asset('js/sweetalert.js') }}"></script>

    {{-- AUTORUN --}}
    <script src="{{ asset('js/clock.js') }}"></script>
    <script src="{{ asset('js/auto-logout.js') }}"></script>
    {{-- /AUTORUN --}}

    {{-- CUSTOM --}}
    <script type="text/javascript"> 
    
    </script>
    {{-- /CUSTOM --}}

  <!-- /SCRIPTS -->
</head>

<body onload=display_ct();>

    <!-- Page container-fluid -->
    <div class="container-fluid">
      <div class="row">


        <!-- PAGE AREA -->
        <div class="col-lg-12 page-area">
          <div class="row">

            <!-- NAV BAR -->
            <div class="col-lg-12 nav-bar shadow-sm ">
              <div class="row justify-content-center ml-2">




                <div class="col-lg-6 text-center p-2 my-2"> 
                  <span id="ct" class="navbar-text text-white"></span>
                    {{-- <a class=" mr-3" href="/"><img class="mb-3" src="{{ url('img/logo/fit-nav.png') }}" alt="" title="" style="width: 50px;"/></a>
                  
           
                  <a class="navbar-brand p-0 m-0" href="{{ url('/') }}">
                    <p class="m-0">Foundation of Information Technology<br>
                    <small>University of Colombo School of Computing</small> </p>
                    
                  </a>
                  
                    <a class=" mt-0 ml-3" href="/"><img class="mb-3" src="{{ url('img/logo/invert-ucsc.png') }}" alt="" title="" style="width: 45px;"/></a>
                  --}}
                </div>


              </div>
            </div>
            <!-- /NAV BAR -->

            <main class="col-lg-12 py-4 px-5">
              <div class="row">
                    @yield('content')
              </div>
              <button title="Go to Top" data-tooltip="tooltip"  data-placement="bottom"  onclick="topFunction()" id="myBtn"><i class="fa fa-chevron-up"></i></button>
            </main>


            
          </div>
        </div>
        <!-- PAGE AREA -->
        
        <!-- FOOTER -->
        <div class="col-12 mt-5" style="bottom: 0;">
          <hr class="bg-primary" width="100%"/>
          <div class="row">
            
          <div class=" w-100 text-right pb-2 pr-3" >
            Copyright &copy;  {{ now()->year }}<strong><a target="_blank" href="https://ucsc.cmb.ac.lk/" > UCSC</a> </strong>. All Rights Reserved |
            Powered by <strong><a target="_blank" href="http://www.e-learning.lk/">e-Learning Center - UCSC </a> </strong>
          </div>
          </div>
        </div>
        <!-- /FOOTER -->
      </div>
    </div>
    <!-- /Page container-fluid -->
</body>
<!-- DROPZONE JS--> <script src="{{ asset('lib/dropzone/drop-zone.js') }}"></script>

@yield('script')
<script type="text/javascript">
//Get the button:
mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
</script>
</html>


