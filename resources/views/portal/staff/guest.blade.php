
<!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('img/logo/fav.png') }}">

  <title>FIT -Portal</title>
  
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


  <!-- /SCRIPTS -->
</head>

<body style="background-color: rgb(0, 28, 70);">

    <!-- Page container-fluid -->
    <div class="container-fluid">
      <div class="row">

        <!-- PAGE AREA -->
        <div class="col-lg-12 page-area">
          <div class="row">



            <nav class="navbar py-3 pl-5 w-100" style="background-color: #211870; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 14px; color: var( --nav-text-color);">
                <h5 class=" text-left p-0 m-0">FIT | UCSC <br> <small>Staff Portal</small></h5>

                    <a href="{{ url('/') }}" title="Back to FIT Website" data-tooltip="tooltip"  data-placement="bottom"  class="pr-5 text-right" style="cursor: pointer;"><i class="far fa-lg fa-hand-point-left"></i></a>
              </nav>

            <!-- /NAVBAR -->

            <main class="col-lg-12 py-4 px-5">
              <div class="row">
                <!-- CONTENT -->
                <div class="col-lg-12 information">
                    <div class="row">

                        <div class="col-12">  
                            <div class="card">
                            </div>     
                            <div class="card mt-3" id="account">
                                <div class="card-header text-center">
                                    Update Account <br>
                                    <small class="">Please update the following information in your account to continue</small>
                                </div> 
                                <div class="card-body">                        
                                    <div class="col-12">
                                        <form action="" id="updateAccount">
                                            <div class="form-row">   
                                            <div class="form-group col-12 col-md-4">
                                                <label for="rePassword">User Name</label>
                                                <input type="text" class="form-control " id="name" name="name"/>
                                                <small id="nameHelp" class="form-text text-muted">Enter UserName</small>
                                                <span class="invalid-feedback" id="error-name" role="alert"></span>
                                            </div>  
                                            <div class="form-group col-12 col-md-4">
                                                <input type="text" class="" id="email" name="email" value="{{ $email }}" readonly hidden/>
                                                <input type="text" class="" id="role" name="role" value="{{ $role }}" readonly hidden/>
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control " id="password" name="password"/>
                                                <small id="InputPasswordHelp" class="form-text text-muted">Enter Password</small>
                                                <span class="invalid-feedback" id="error-password" role="alert"></span>
                                            </div> 
                                            <div class="form-group col-12 col-md-4">
                                                <label for="rePassword">Re-Type Password</label>
                                                <input type="password" class="form-control " id="rePassword" name="rePassword"/>
                                                <small id="InputRePasswordHelp" class="form-text text-muted">Enter Re-Type Password</small>
                                                <span class="invalid-feedback" id="error-rePassword" role="alert"></span>
                                            </div>
                                            </div>
                                        </form>
                                        <div class=" text-right w-100">
                                            <button class="btn btn-secondary">Discard</button>
                                            <button type="button" id="submit" onclick="update_account()" class="btn btn-outline-primary">
                                              Update Password
                                              <span id="spinner" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /CONTENT -->

              </div>
            </main>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
          </div>
        </div>
        <!-- PAGE AREA -->
            <!-- FOOTER -->
            <div class="col-12" style="bottom: 0; position: fixed;">
              <div class="row">
                
              <div class=" w-100 footer text-right py-2 pr-3" style="background-color: #516899 !important;">
                Copyright &copy;  {{ now()->year }}<strong><a target="_blank" href="https://ucsc.cmb.ac.lk/" > UCSC</a> </strong>. All Rights Reserved |
                Powered by <strong><a target="_blank" href="http://www.e-learning.lk/" >e-Learning Center - UCSC </a> </strong>
              </div>
              </div>
            </div>
            <!-- /FOOTER -->
      </div>
    </div>
    <!-- /Page container-fluid -->
</body>
<!-- DROPZONE JS--> <script src="{{ asset('lib/dropzone/drop-zone.js') }}"></script>


@include('portal.staff.guest.scripts')


</html>






