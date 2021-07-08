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
    <section id="hero" style="background-image: url({{ asset('img/background/back.jpg') }}); height:200px">
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
                <p><b>The students registered for the FIT programme will get access to a virtual learning environment (FITVLE) that will help them to learn online. All e-tests are conducted via an e-testing system. The students will get access to this system when they take the e-tests. The students can start the programme at any time during the year, and they can apply for the examinations at any time when they are ready.</b> </p>
                
                <p>Once your payment is confirmed for the registration, you will be notified with login details. It is mandatory to include a valid email address when you register for the FIT programme. If you have any problem, you can contact the e-Learning Centre of UCSC to get more information regarding your registration.
                    <br/><b>Tel: <a href="tel:+94112591080">011 2591080 </a></b>
                </p>
                <p>Within two weeks after your registration, we will enrol you on the FITVLE online courses. If you could not access the VLE after two weeks with the given username and password, please contact the VLE administrator.
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
                        <b>No</b> UCSC will not conduct any face-to-face classes. Private institutes conduct face-to-face classes based on the FIT syllabi. However, UCSC will not undertake any responsibility or comment on their performances. Therefore, we advise all the students to follow the online courses in the FITVLE and get updated by checking the announcements we made via the FITVLE and FIT information system.
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
                        You can follow online courses in the FITVLE.  Otherwise, you can select a private institute that conducts classes based on the FIT syllabi.
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
                        Online courses provide general guidance for a self-learning student. They are designed and developed based on the FIT curriculum. However, if you find it difficult to understand the subject matter given in the syllabus and online courses, it is better to consider attending classes conducted by a private institute.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 3 --}}

            {{-- QUESTION 4 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingFour">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>hould I go to Institute to complete FIT programme?</h4>
                    </button>
                </div>
            
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        There is no compulsory requirement. There are a lot of self-learning students who follow the FIT programme. However, if you find it difficult to understand the subject matter given in the syllabus and online courses, it is better to consider attending classes conducted by a private institute.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 4 --}}

            {{-- QUESTION 5 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingFive">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>How long will it take to get access to the virtual learning environment (FITVLE) after registration?</h4>
                    </button>
                </div>
            
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        It will take 3-4 working days( maximum 7days) after submitting your registration detail via FIT information system. If you have provided a valid email address, we will inform you as soon as we create an account in the online system. If it delays more than seven days, please contact the admin of the FITVLE <a href="mailto:admin@fit.bit.lk">(admin@fit.bit.lk)</a>.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 5 --}}

        </div>

    </section>
    {{-- //FAQ --}}

  </main>

@endsection
