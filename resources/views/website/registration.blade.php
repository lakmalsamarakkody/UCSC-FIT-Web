@extends('layouts/web')
@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#registration_nav').addClass("menu-active");
    });

</script>

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/hero-back.png') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">Registration</h1>
        </div>
    </section><!-- #hero -->

  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
        <div class="row about-container">
            <div class="col-lg-8 content order-lg-1 order-1">
                <h2 class="title">How to Register for FIT?</h2>
                <br/>
                <h4>There are no conditions to register for the FIT programme such as age or qualifications.</h4>
                <p>Registration fees will be Rs. 2750. All registered students will receive a registration number and will be able to access all online courses. Students do not want to pay all registration, examination and other fees when they register for FIT programme. They can register FIT programme by paying only Rs. 2750 and when they are ready to take relevant exams they can pay examination fees.</p>
              
                <p>
                    To <b>Register</b>, Sign up your email here and we'll send you <b>login details and steps on how to Register for FIT</b>.
                </p>
                <div class="form">
                    <div id="error">

                    </div>
                    <form action="" method="post" role="form" class="contactForm">
                        <div class="form-group">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Type Your Email Here"  data-rule="email" data-msg="Please enter a valid email" />
                        <div class="validation"></div>
                        </div>
                        <div class="text-center"><button type="submit">Sign Up Here</button></div>
                    </form>
                </div>
            
            </div>
            <div class="col-lg-4 background order-lg-2 order-2 wow fadeInRight" style="margin-top: 100px; padding-left: 90px; margin-left:0px !important; padding-left: 50px !important;">
                <div class="icon-box wow " data-wow-delay="0.2s">
                    <a href="{{ url('login') }}"><div class="icon"><i class="la la-sign-in-alt"></i></div></a>
                    <h4 class="title"><a href="{{ url('login') }}">Already Registered?</a></h4>
                    <p class="description">Login to FIT Portal</p>
                </div>
            </div>
        </div>
        
    </section><!-- #about -->

  </main>

@endsection
