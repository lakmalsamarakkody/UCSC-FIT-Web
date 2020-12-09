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

  <title>FIT -Portal</title>
  
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- STYLES -->
    <!-- BOOTSTRAP -->      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- FONT AWESOME -->   <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/all.css') }}">
    <!-- LINE AWESOME -->   <link rel="stylesheet" href="{{ asset('lib/line-awesome/css/line-awesome.css') }}">
    <!-- ANIMATE -->        <link rel="stylesheet" href="{{ asset('lib/animate/animate.min.css') }}">

    <!-- DATATABLE  -->
    <link rel="stylesheet" href="{{ asset('lib/datatables/css/dataTables.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('lib/datatables/css/dataTables.bootstrap4.min.css') }}" >
    <!-- DATATABLE -->

    <!-- PAGES -->
    <link rel="stylesheet" href="{{ asset('css/portal/core.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portal/student/registration.css') }}">
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

    {{-- CUSTOM --}}
    <script type="text/javascript"> 
      function display_c(){
        var refresh=999; // Refresh rate in milli seconds
        mytime=setTimeout('display_ct()',refresh)
      }
      function display_ct() {
        var dt = new Date()
        var timeString = dt.getFullYear() +  "/" + dt.getMonth() + "/" + dt.getDate() + "&nbsp;&nbsp;&nbsp;" + dt.getHours() + ":" + dt.getMinutes() +":" + dt.getSeconds()
        document.getElementById('ct').innerHTML = timeString;
        display_c();
      }
    </script>
    {{-- /CUSTOM --}}
  <!-- /SCRIPTS -->
</head>

<body onload=display_ct();>

    <!-- Page container-fluid -->
    <div class="container-fluid">
      <div class="row">

        <!-- SIDE BAR -->
        <div class="col-lg-2 sidebar">
          <div class="row">

            <div class="w-100">
              <div class="img mt-3 px-4">
                <a class="float-left" href="/"><img class="mb-3" src="{{ url('img/logo/fit-nav.png') }}" alt="" title="" style="width: 50px;"/></a>
                <a class="float-right" href="/"><img class="mb-3" src="{{ url('img/logo/invert-ucsc.png') }}" alt="" title="" style="width: 45px;"/></a>
              </div>              
            </div>

            <!-- USER DETAILS SECTION -->
            <div class="user w-100 text-center">
              <div class="img mt-3 mb-2">
                <img src="{{ asset('img/portal/avatar') }}/{{ Auth::user()->id }}.png" alt="Avatar" class="avatar" width="50%">
              </div>
              <p class="mb-0 text-white">Hello! {{ Auth::user()->name }}</p>
              <p class="text-white"><small>{{ Auth::user()->role->name }}</small> </p>
            </div>
            <!-- /USER DETAILS SECTION -->

            <hr width="90%"/> 

            <!-- MENU SECTION -->
            <div class="nav-menu w-100">
              <ul>
                <li id="registration"><a href="{{ route('student.registration') }}">Registration</a></li>
                <li id="information"><a href="{{ route('student.home') }}">Informations</a></li>
                <li id="exams"><a href="{{ route('student.home') }}">Exams</a></li>
                <li id="results"><a href="{{ route('student.results') }}">Results</a></li>
              </ul>

                <div class="logout-menu w-100 text-center " style="display:flex; align-items:flex-end;">
                  <div class="py-3 justify-content-center align-content-center" style="position: absolute; bottom: 0; left: 0; width: 100%;">
                    
                    <a  title="Logout" data-tooltip="tooltip"  data-placement="bottom"  class="text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="logout fa fa-power-off"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                  </div>
                  
                </div>

            </div>
            <!-- /MENU SECTION -->

          </div>
        </div>
        <!-- /SIDE BAR -->

        <!-- PAGE AREA -->
        <div class="col-lg-10 page-area">
          <div class="row">

            <!-- NAV BAR -->
            <div class="col-lg-12 nav-bar shadow-sm">
              <div class="row  p-2">

                <div class="col-3">
                  <h4 class=" text-left p-0 m-0"><a href="">FIT | UCSC <br> <small>Student Portal</small></a> </h5>
                </div>

                <div class="col-6 text-center"> 
                  <span id="ct" class="navbar-text text-white"></span>
                    {{-- <a class=" mr-3" href="/"><img class="mb-3" src="{{ url('img/logo/fit-nav.png') }}" alt="" title="" style="width: 50px;"/></a>
                  
           
                  <a class="navbar-brand p-0 m-0" href="{{ url('/') }}">
                    <p class="m-0">Foundation of Information Technology<br>
                    <small>University of Colombo School of Computing</small> </p>
                    
                  </a>
                  
                    <a class=" mt-0 ml-3" href="/"><img class="mb-3" src="{{ url('img/logo/invert-ucsc.png') }}" alt="" title="" style="width: 45px;"/></a>
                  --}}
                </div>
                <div class="col-3 text-right"> 
                  <button class="btn btn-link btn-lg nav-item"><i class="fa fa-cog"></i></button>     
                </div>

              </div>
            </div>
            <!-- /NAV BAR -->

            <!-- MOBILE NAV BAR -->
            <div class="col-12 mobile-nav py-2">
              <div class="row">
                <div class="col-6"><a href="">FIT | UCSC <br> <small>Student Portal</small></a></div>
                <div class="col-6 text-right align-self-center"><i class="fa fa-bars fa-2x" data-toggle="collapse" data-target="#collapseMobileNav" aria-expanded="false"></i></div>
                <div class="col-12 mt-2 px-0 collapse border-top border-darken-1" id="collapseMobileNav">
                  <ul>
                    <li id="mobile_registration"><a href="{{ route('student.registration') }}">Registration</a></li>
                    <li id="mobile_information"><a href="{{ route('student.home') }}">Informations</a></li>
                    <li id="mobile_exams"><a href="{{ route('student.home') }}">Exams</a></li>
                    <li id="mobile_results"><a href="{{ route('student.results') }}">Results</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- /MOBILE NAV BAR -->

            <main class="col-lg-12 py-4 px-5">
              <div class="row">
                    @yield('content')
              </div>
            </main>


            
          </div>
        </div>
        <!-- PAGE AREA -->
            <!-- FOOTER -->
            <div class="col-12" style="bottom: 0;">
              <div class="row">
                
              <div class=" w-100 footer bg-dark text-right py-2 pr-3">
                Copyright &copy;  {{ now()->year }}<strong><a target="_blank" href="https://ucsc.cmb.ac.lk/" class="white"> UCSC</a> </strong>. All Rights Reserved |
                Powered by <strong><a target="_blank" href="http://www.e-learning.lk/" class="white">e-Learning Center - UCSC </a> </strong>
              </div>
              </div>
            </div>
            <!-- /FOOTER -->
      </div>
    </div>
    <!-- /Page container-fluid -->
</body>
@yield('script')
</html>


