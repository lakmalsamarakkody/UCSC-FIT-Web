<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>FIT - UCSC | {{ $title ?? '' }}</title>

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
            <link rel="stylesheet" href="{{ asset('css/website/announcements.css') }}">
            <link rel="stylesheet" href="{{ asset('css/website/faq.css') }}">
            <link rel="stylesheet" href="{{ asset('css/website/site-map.css') }}">
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
        <script src="{{ asset('lib/sweetalert2/sweetalert2.all.js') }}"></script>

        <!-- Template Main Javascript File -->
        <script src="{{ asset('js/web.js') }}"></script>
        <!-- SCRIPTS -->
        <script src="{{ asset('js/sweetalert.js') }}"></script>
        <!-- /SCRIPTS -->
    </head>

    <body>
    
    <!--==========================
    Header
    ============================-->
    <header id="header">  
        <div class="col-md-12 ">
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
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 text-center order-md-1 mb-3">
                        <div class="input-group">
                            <input type="email" name="subscriberEmail" id="subscriberEmail" class="form-control" placeholder="Enter your email.."/>
                            
                            <div class="input-group-append">
                                <button id="subscribe" class="btn btn-outline-primary btn-subscribe" onclick="onClickSubscribe()">
                                    SUBSCRIBE
                                    <span id="emailSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                </button>
                            
                            </div>
                        </div>
                        
                        <span id="errSubEmail" class="invalid-feedback text-left" role="alert"></span>
                    </div>
                    <div class="col-12 col-md-6 text-center order-md-3">
                        <h4>Subscribe to our Newsletter</h4>
                    </div>
                    <div class="col-12 col-md-6 text-center order-md-2">
                        <h1> 
                            {{-- <a target="_blank" href="" class="white"><i class="fab fa-twitter-square"></i></a> --}}
                            <a target="_blank" href="https://www.facebook.com/fit.ucsc.official" class="white"><i class="fab fa-facebook-square"></i></a>
                            <a target="_blank" href="https://www.m.me/fit.ucsc.official" class="white"><i class="fab fa-facebook-messenger"></i></a>
                            {{-- <a target="_blank" href="" class="white"><i class="fab fa-youtube-square"></i></a> --}}
                        </h1> 
                        
                    </div>
                    <div class="col-12 col-md-6 text-center order-md-4">
                        <h4><a href="{{ url('/downloads') }}" class="white">Downloads </a>|
                        <a href="{{ url('/siteMap') }}" class="white">Site Map </a>|
                        <a href="{{ url('/privacyPolicy') }}" class="white"> Pivacy Policy </a>|
                        <a href="{{ url('/terms') }}" class="white"> Terms</a></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12 copyright mt-4">
                        Copyright &copy;  {{ now()->year }}<strong><a target="_blank" href="https://ucsc.cmb.ac.lk/" class="white"> UCSC</a> </strong>. All Rights Reserved 
                    </div>
                    <div class="col-12 credits">
                        Powered by <strong><a target="_blank" href="http://www.e-learning.lk/" class="white">e-Learning Centre - UCSC </a> </strong>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- #footer -->

    <a href="#top" class="back-to-top"><i class="fa fa-chevron-up"></i></a>



    </body>
    @yield('script')

    <script type="text/javascript">
        // ONCLCIK SUBSCRIBE BUTTON
        onClickSubscribe = () => {
            // FORM PAYLOAD
            var formData = new FormData();
            // ADD DATA
            formData.append('subscriberEmail', $('#subscriberEmail').val())
            $('#subscriberEmail').removeClass('is-invalid');
            $('#errSubEmail').html('');
            $('#errSubEmail').hide();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/student/registration/subscribe') }}",
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    // Show loader
                    $("#emailSpinner").removeClass('d-none');
                    $('#subscribe').attr('disabled','disabled');
                },
                success: function(data){                    
                    $("#emailSpinner").addClass('d-none');
                    $('#subscribe').removeAttr('disabled');
                    if(data['errors']){
                        $.each(data['errors'], function(key, value){
                            $('#errSubEmail').show();
                            $('#subscriberEmail').addClass('is-invalid');
                            $('#errSubEmail').append('<strong>'+value+'</strong>')
                        });
                    }else if(data['status'] == 'success'){
                        console.log('success');
                        $('#subscriberEmail').val('');
                        SwalNotificationSuccess.fire({
                            title: 'Subscribed!',
                            text:'You will get future updates on FIT Programme'
                        });
                    }else if (data['error']){
                        console.log('error');
                        SwalSystemErrorDanger.fire();
                    }
                },
                error: function(err){
                    console.log('error');
                    SwalSystemErrorDanger.fire();
                }
            });
        }
    </script>
</html>