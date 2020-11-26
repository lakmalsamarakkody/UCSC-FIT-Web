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
    

        <!-- STYLES -->
            <!-- BOOTSTRAP -->      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <!-- FONT AWESOME -->   <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/all.css') }}">
            <!-- LINE AWESOME -->   <link rel="stylesheet" href="{{ asset('lib/line-awesome/css/line-awesome.css') }}">
            <!-- ANIMATE -->        <link rel="stylesheet" href="{{ asset('lib/animate/animate.min.css') }}">
            <!-- CUSTOM -->        <link rel="stylesheet" href="{{ asset('css/portal/core.css') }}">


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

        <script type="text/javascript"> 
          function display_c(){
            var refresh=999; // Refresh rate in milli seconds
            mytime=setTimeout('display_ct()',refresh)
          }
          
          function display_ct() {
            var dt = new Date()
            var timeString = dt.getFullYear() +  "/" + dt.getMonth() + "/" + dt.getDate() + "   " + dt.getHours() + ":" + dt.getMinutes() +":" + dt.getSeconds()
            document.getElementById('ct').innerHTML = timeString;
            display_c();
          }
        </script>

    
</head>

<body onload=display_ct();>

    <!-- Page container-fluid -->
    <div class="container-fluid">
      <div class="row">

        <!-- SIDE BAR -->
        <div class="col-lg-2 sidebar vh-100 shadow-lg">
          <div class="row">

            <div class="w-100">
              <div class="img mx-5 mt-4 px-4">
                <a class=" mr-3" href="/"><img class="mb-3" src="{{ url('img/logo/fit-nav.png') }}" alt="" title="" style="width: 50px;"/></a>
                <a class=" mt-0 ml-3" href="/"><img class="mb-3" src="{{ url('img/logo/invert-ucsc.png') }}" alt="" title="" style="width: 45px;"/></a>
              </div>

              
            </div>
            <hr width="90%"/> 
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
              <ul class="pl-5">
                <li class="side-item active"><a href="#">Dashboard</a></li>
                <li class="side-item"><a href="#">Students</a></li>
                <li class="side-item"><a href="#">Exams</a></li>
                <li class="side-item"><a href="#">Results</a></li>
                <li class="side-item"><a href="#">Users</a></li>
                <li class="side-item"><a href="#">System</a></li>
                <li class="logout" style="position:fixed; bottom: 0px;">
                  <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
              </ul>

            </div>
            <!-- /MENU SECTION -->

          </div>
        </div>
        <!-- /SIDE BAR -->

        <!-- PAGE AREA -->
        <div class="col-lg-10">
          <div class="row">

            <!-- NAV BAR -->
            <div class="col-lg-12 nav-bar shadow-sm">
              <div class="row ml-2">


                <div class="col-lg-3 p-2 my-2 ml-0">
                  <span id="ct" class="navbar-text text-white"></span>
                </div>


                <div class="col-lg-6 text-center p-2 mt-2"> 
                    <!-- <a class=" mr-3" href="/"><img class="mb-3" src="{{ url('img/logo/fit-nav.png') }}" alt="" title="" style="width: 50px;"/></a>
                  
           
                  <a class="navbar-brand p-0 m-0" href="{{ url('/') }}">
                    <p class="m-0">Foundation of Information Technology<br>
                    <small>University of Colombo School of Computing</small> </p>
                    
                  </a>
                  
                    <a class=" mt-0 ml-3" href="/"><img class="mb-3" src="{{ url('img/logo/invert-ucsc.png') }}" alt="" title="" style="width: 45px;"/></a>
                  -->
                </div>
                <div class="col-lg-3 p-2 my-2  text-right"> 
                  <button class="btn btn-link btn-lg  px-5 nav-item"><i class="fa fa-cog"></i></button>     
                </div>


              </div>
            </div>
            <!-- /NAV BAR -->

            <main class="col-lg-12 py-4 px-5">
              <div class="row">
                    @yield('content')
              </div>
            </main>
            
          </div>
        </div>
        <!-- PAGE AREA -->

      </div>
    </div>
    <!-- /Page container-fluid -->
</body>
</html>


