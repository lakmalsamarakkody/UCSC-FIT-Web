@extends('layouts/web')
@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#learning_nav').addClass("menu-active");
    });

</script>

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/hero-back.png') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">Learning for FIT</h1>
        </div>
    </section><!-- #hero -->

  <main id="main">

    <!--==========================
      Learning Section
    ============================-->
    <!-- smain header -->
    <section id="learning" style="padding-top: 80px;">
        <div class="row about-container">
            <div class="col-lg-7 content order-lg-1 order-1">
                <h2 class="title">Virtual Learning Environment</h2>
                <br/>
                <h4>All registered FIT students will receive a registration number and a password to access the online learning management system</h4>
                <br/>
                <p>Once your payment is confirmed for the registration, you will be notified with login details. It is mandatory to include a valid email address when you register for the FIT programme. Otherwise you have to contact External Degrees Centre of UCSC to find out the status of your registration.
                    <br/><b>Tel: 011 - 4720511 / 011 - 4720513</b>
                </p>
                <p>Within 2 weeks of registration we will enroll you to the LMS online courses. If you could not access the LMS after 2 weeks with the given username and password, please contact the LMS administrator.
                    <b><br/>Email: admin@fit.bit.lk
                    <br/>Tel: 011-2591080</b>
                </p>
                <p>There are three separate online courses for the FIT Programme. You can access online interactive e-learning content and discuss with other learners and online e-facilitators in the course.</p>
                <p>Several private teaching institutes in Sri Lanka conduct classes based on the FIT curriculum. Students are kindly advised to directly contact these institutes if they are interested to attend face to face classes based on the FIT programme.</p>
                <p>It is important to mention that all FIT exams will be conducted in English medium and all learning materials developed based on the curriculum are available in English.</p>   
                
                <a target="_blank" href="http://fit.bit.lk/vle" class="btn-get-started">Go to VLE</a>
            </div>

            <div class="myBox col-lg-5 background order-lg-2 order-2 wow fadeInRight mt-3" style="background-image: url({{ asset('img/fit-bit-lk-vle.png') }}); cursor: pointer; background-size: cover;">
                <a target="_blank"  href="http://fit.bit.lk/vle"></a>
            </div>
        </div>
    </section><!-- #main header -->

    <!-- DETAILS -->
    <section id="learning">
        <div class="row about-container">
            <div class="col-lg-8 content order-lg-2 order-1" style="text-align: left;">
                </div>
        </div>
    </section><!-- #DETAILS -->
    
    <!-- NEXT STEP -->
    <section id="learning">
            <div class="row about-container">
                <div class="col-lg-8 content order-lg-1 order-2">               


                    <div class="icon-box wow fadeInUp" data-wow-delay="0.2s" style="padding-top: 80px;">
                        <a href="examination"><div class="icon"><i class="fa fa-leanpub"></i></div></a>
                        <h4 class="title"><a href="examination">Examination</a></h4>
                        <p class="description">How to sit for your FIT Examinations</p>
                    </div>
                </div>
                
            </div>
    </section><!-- #NEXT STEP -->

  </main>

@endsection
