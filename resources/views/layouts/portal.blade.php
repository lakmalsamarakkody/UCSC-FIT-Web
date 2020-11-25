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
            <!-- CUSTOM -->        <link rel="stylesheet" href="{{ asset('css/portal/portal.css') }}">


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



    
</head>

<body>

    <!-- Page Wrapper -->
    <div id="wrapper">

      
      <nav class="navbar navbar-expand-md shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}"><h3>Foundation of Information Technology<br>
           <small>University of Colombo School of Computing</small> </h3>
          </a>
          <span class="navbar-text text-white" style="padding-left:50%;">
            {{ Auth::user()->name }}
          </span>
              <span class="navbar-text text-white">
                {{ Auth::user()->name }}
              </span>
        </div>
      </nav>

      <!-- <nav class="navbar navbar-light bg-light shadow-sm">
        <a class="navbar-brand" href="{{ url('/') }}"><h3>Foundation of Information Technology<br>
          <small>University of Colombo School of Computing</small> </h3>
        </a>
        <span class="navbar-text">
          {{ Auth::user()->name }}
        </span>
      </nav> -->
      <!-- The sidebar -->
      <div class="sidebar">
        <ul class="sidebar" style="height: 100%;">
          <li>
            <a href="#home">Dashboard</a>
          </li>
          <li>            
            <a href="#news">Students</a>
          </li>
          <li>            
            <a href="#news">Exams</a>
          </li>
          <li>            
            <a href="#news">Results</a>
          </li>
          <li>            
            <a href="#news">Users</a>
          </li>
          <li>            
            <a href="#news">System</a>
          </li>
          <li style="position:fixed; bottom: 0; width:200px">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fa fa-power-off"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
          </li>
          
        </ul>
      </div>

      <main class="container pt-5">
        @yield('content')
      </main>
    </div>
</body>
</html>

