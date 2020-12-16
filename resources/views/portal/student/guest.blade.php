
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



            <nav class="navbar py-3  w-100">
                <h5 class=" text-left p-0 m-0">FIT | UCSC <br> <small>Staff Portal</small></h5>

                    <button title="Back to FIT Website" class="btn btn-link btn-lg  px-5 nav-item text-right"><i class="fa fa-cog"></i></button>
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
                                    <small class="">Please update the following information in your student account  to continue registration</small>
                                </div> 
                                <div class="card-header">
                                    Account Settings
                                </div>
                                <div class="card-body">                        
                                    <div class="col-12">
                                        <form action="">
                                            <div class="form-row">     
                                            <div class="form-group col-12 col-md-4">
                                                <label for="currentPassword">User Email</label>
                                                <input type="text" class="form-control form-control-sm" id="currentPassword" name="currentPassword" readonly/>
                                                <small id="InputCurrentPasswordHelp" class="form-text text-muted">You can change your email after registration</small>
                                            </div> 
                                            <div class="form-group col-12 col-md-4">
                                                <label for="newPassword">Password</label>
                                                <input type="password" class="form-control form-control-sm" id="newPassword" name="newPassword"/>
                                                <small id="InputNewPasswordHelp" class="form-text text-muted">Enter Password</small>
                                            </div> 
                                            <div class="form-group col-12 col-md-4">
                                                <label for="reNewPassword">Re-Type Password</label>
                                                <input type="password" class="form-control form-control-sm" id="reNewPassword" name="reNewPassword"/>
                                                <small id="InputReNewPasswordHelp" class="form-text text-muted">Re-Type Password</small>
                                            </div>
                                            </div>
                                            <div class=" text-right w-100">
                                                <button class="btn btn-secondary">Discard</button>
                                                <button class="btn btn-outline-primary">Update Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /CONTENT -->

              </div>
            </main>


            
          </div>
        </div>
        <!-- PAGE AREA -->
            <!-- FOOTER -->
            <div class="col-12" style="bottom: 0; position: fixed;">
              <div class="row">
                
              <div class=" w-100 footer text-right py-2 pr-3" style="background-color: #516899 !important;">
                Copyright &copy;  {{ now()->year }}<strong><a target="_blank" href="https://ucsc.cmb.ac.lk/" > UCSC</a> </strong>. All Rights Reserved |
                Powered by <strong><a style="color: rgb(255, 0, 0);" target="_blank" href="http://www.e-learning.lk/" >e-Learning Center - UCSC </a> </strong>
              </div>
              </div>
            </div>
            <!-- /FOOTER -->
      </div>
    </div>
    <!-- /Page container-fluid -->
</body>
<!-- DROPZONE JS--> <script src="{{ asset('lib/dropzone/drop-zone.js') }}"></script>


@include('portal.student.guest.scripts')


</html>






