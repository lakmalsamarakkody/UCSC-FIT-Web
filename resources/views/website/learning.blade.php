@extends('layouts/web')
@section('content')

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/hero-back.png') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">Learning</h1>
        </div>
    </section><!-- #hero -->

  <main id="main">

    <!--==========================
      Learning Section
    ============================-->
    <!-- smain header -->
    <section id="programme" style="padding-top: 80px;">
        <div class="row about-container">
            <div class="col-lg-8 content order-lg-1 order-1">
                <h2 class="title">Learning for FIT</h2>
                <br/>
                <h4>Virtual Learning Environment</h4>
                <p>All registered FIT students will receive a registration number and a password to access the online learning management system.</p>
                <p>Once your payment is confirmed for the registration, you will be notified with login details. It is recommended to include a valid email address when you register for the FIT programme. Otherwise you have to contact External Degrees Centre of UCSC by phone (Tel: 011-4720511/3) to find out the status of your registration. Within 2 weeks of registration we will enroll you to the LMS online courses. If you could not access the LMS after 2 weeks with the given username and password, please contact the LMS administrator by email (admin@fit.bit.lk) or phone (Tel: 011-2591080).</p>
                <p>There are three separate online courses for the FIT Programme. You can access online interactive e-learning content and discuss with other learners and online e-facilitators in the course.</p>
                <p>Several private teaching institutes in Sri Lanka conduct classes based on the FIT curriculum. Students are kindly advised to directly contact these institutes if they are interested to attend face to face classes based on the FIT programme.</p>
                <p>It is important to mention that all FIT exams will be conducted in English medium and all learning materials developed based on the curriculum are available in English.</p>   
            </div>
            <div class="myBox col-lg-4 background order-lg-2 order-2 wow fadeInRight" style="background-image: url({{ asset('img/screenshot-fit-bit-lk-vle.png') }}); cursor: pointer;">
                <a target="_blank"  href="http://fit.bit.lk/vle"></a>
            </div>
        </div>
    </section><!-- #main header -->

    <!-- DETAILS -->
    <section id="programme">
        <div class="row about-container">
            <div class="col-lg-8 content order-lg-2 order-1" style="text-align: left;">
                </div>
        </div>
    </section><!-- #DETAILS -->
    
    <!-- NEXT STEP -->
    <section id="programme">
            <div class="row about-container">
                <div class="col-lg-8 content order-lg-1 order-2">               


                    <div class="icon-box wow fadeInUp" data-wow-delay="0.2s" style="padding-top: 80px;">
                        <a href="learning"><div class="icon"><i class="fa fa-leanpub"></i></div></a>
                        <h4 class="title"><a href="learning">Learning</a></h4>
                        <p class="description">How you learn FIT</p>
                    </div>
                </div>
                
            </div>
    </section><!-- #NEXT STEP -->

  </main>

@endsection
