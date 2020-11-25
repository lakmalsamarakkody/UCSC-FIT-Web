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
    <section id="learning" style="padding-top: 80px;">
        <!-- smain header -->
        <div class="row about-container">
            <div class="col-lg-7 content order-lg-1 order-1">
                <h2 class="title">Virtual Learning Environment</h2>
                <br/>
                <p><b>All registered FIT students will receive a registration number and a password to access the online learning management system</b> </p>
                
                <p>Once your payment is confirmed for the registration, you will be notified with login details. It is mandatory to include a valid email address when you register for the FIT programme. Otherwise you have to contact External Degrees Centre of UCSC to find out the status of your registration.
                    <br/><b>Tel: <a href="tel:+94114720511">011 4720511 </a>/ <a href="tel:+94114720513">011 4720513</a> </b>
                </p>
                <p>Within 2 weeks of registration we will enroll you to the LMS online courses. If you could not access the LMS after 2 weeks with the given username and password, please contact the LMS administrator.
                    <b><br/>Email:<a href="mailto:admin@fit.bit.lk">admin@fit.bit.lk</a>  
                    <br/>Tel: <a href="tel:+94112591080">011 2591080</a> </b>
                </p>
                <p>There are three separate online courses for the FIT Programme. You can access online interactive e-learning content and discuss with other learners and online e-facilitators in the course.</p>
                <p>Several private teaching institutes in Sri Lanka conduct classes based on the FIT curriculum. Students are kindly advised to directly contact these institutes if they are interested to attend face to face classes based on the FIT programme.</p>
                <p>It is important to mention that all FIT exams will be conducted in English medium and all learning materials developed based on the curriculum are available in English.</p>   
                
                <a target="_blank" href="http://fit.bit.lk/vle"><button id="vle_link" class="btn btn-primary">Go to VLE</button></a>
            </div>

            <div class="myBox col-lg-5 background order-lg-2 order-2 wow fadeInRight" style="background-image: url({{ asset('img/logo/vle-logo.png') }}); cursor: pointer; margin-top:200px;">
                <a target="_blank"  href="http://fit.bit.lk/vle"></a>
            </div>
        </div><!-- #main header -->

        <!-- DETAILS -->
        <div class="row about-container">
            <div class="col-lg-8 content order-lg-2 order-1" style="text-align: left;">
                </div>
        </div><!-- #DETAILS -->
    
        <!-- NEXT STEP -->
        <div class="row about-container">
            <div class="col-lg-8 content order-lg-1 order-2">               
                <div class="icon-box wow fadeInUp" data-wow-delay="0.2s" style="padding-top: 80px;">
                    <a href="{{ url('/examination') }}"><div class="icon"><i class="fas fa-file-alt"></i></div></a>
                    <h4 class="title"><a href="{{ url('/examination') }}">Examination</a></h4>
                    <p class="description">How to sit for your FIT Examinations</p>
                </div>
            </div>
        </div><!-- #NEXT STEP -->
    </section>

    {{-- FAQ --}}
    <section id="faq">
            
        <div class="row about-container">
            <div class="col-lg-8 content order-lg-1 order-2">
                <h2 class="title">Frequently Asked Questions</h2>
            </div>
            <div class="col-lg-4 content order-lg-2 order-2 "> 
                <a class="float-right faq-sm wow fadeInRight" href="{{ url('/faq') }}"><i class="fa fa-question-circle"></i> More FAQ</a>
            </div>
        </div>

        <div id="accordion">

            {{-- QUESTION 1 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingOne">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Does UCSC conduct classes for FIT?</h4>
                    </button>
                </div>
            
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body pt-0 pt-0 pl-md-5">
                        <b>No</b> UCSC will not conduct any face-to-face classes. Private institutes conduct face-to-face classes based on the FIT programme. However, UCSC will not undertake any responsibility or comment on their performances.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 1 --}}

            {{-- QUESTION 2 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingTwo">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Where can I learn for FIT?</h4>
                    </button>
                </div>
            
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        You can follow online courses of FIT programme if you have some similar IT experience. Otherwise, you can select a private institute which conducts classes based on the FIT programme.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 2 --}}

            {{-- QUESTION 3 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingThree">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Are these online courses enough to complete FIT?</h4>
                    </button>
                </div>
            
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        Online courses provide general guidance for a self-learning student. They are designed and developed based on the FIT curriculum. However, if you find difficult to understand the subject matter given in the syllabus and online courses, it is better to consider attending classes conducted by a private institute.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 3 --}}

            {{-- QUESTION 4 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingFour">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Should I go to Institute to complete FIT programme?</h4>
                    </button>
                </div>
            
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        No there is no compulsory requirement. There are lot of self-learning students who follow FIT programme. However, if you find difficult to understand the subject matter given in the syllabus and online courses, it is better to consider attending classes conducted by a private institute.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 4 --}}

            {{-- QUESTION 5 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingFive">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>How long will it take to get access to online system (LMS) after registration?</h4>
                    </button>
                </div>
            
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                    It will take 3-4 working days (after receiving your registration detail from the EDC) to create your account. If you have provided an email address, we will inform as soon as we create an account in the online system. If it is delayed more than two days, please contact <a href="{{ url('/contact')}}">External Degree Centre or e-Learning Centre.</a>
                    </div>
                </div>
            </div>
            {{-- //QUESTION 5 --}}

        </div>

    </section>
    {{-- //FAQ --}}

  </main>

@endsection
