@extends('layouts/web')
@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#home_nav').addClass("menu-active");
    });

</script>

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/UCSC-Banner-cropped.jpg') }});">
        <div class="hero-container col-lg-8 order-lg-1 order-1">
            <div class="row">
                <div class="col-lg-12"> <img src="{{ asset('img/logo/invert-ucsc.png') }}" width="15%" /> </div>
            </div>
            <!-- <h1 style="text-align: left;"><span style="color:#7e6fff">F</span>oundation in <br> <span style="color:#23159c">I</span>nformation <br><span style="color:#23159c">T</span>echnology</h1> -->
            <h1 style="text-align: left;">Foundation in <br> Information Technology</h1>
            <h3 style="color:#fff">University of Colombo School of Computing</h2>
            <a href="#about" class="btn-get-started" style="width=25%">About FIT</a>
        </div>
        <div class="hero-container col-lg-8 order-lg-2 order-2">
        </div>
    </section><!-- #hero -->

    <main id="main">

        <!--==========================
        About Us Section
        ============================-->
        <section id="about">
            <div class="row about-container">
                <div class="col-lg-8 content order-lg-1 order-2">
                    <h2 class="title">About FIT</h2>
                    <p>The Foundation in Information Technology (FIT) programme aims at enhancing the literacy and competency in using basic computer applications together with analytical thinking and communicational skills required for school leavers. Hence, Mathematics and English Language for Information Communication Technology (ICT) are considered as two other important supporting subject domains.</p>
                    <p>FIT is a pre-degree programme that prepares students who are willing to read for their first degree. It is designed for anyone irrespective of the study streams they have followed in Advanced Level (secondary education. Recent statistics show many students who register for degree programmes fail due to lack of ICT competency, language skills and mathematical background. This tendency is very high in external degree programmes. Hence, FIT was designed to address these issues of undergraduate studies.</p>
                    <p>At the same time, FIT is an alternative qualification for students who do not posse A/L qualifications to enroll into the Bachelor of Information Technology (BIT) programme. However, those who register for BIT should have completed studies up to Ordinary Level in school curriculum.</p>
                    <p>FIT is also a certification programme for employment seekers or school leavers to justify their knowledge and skills in ICT for their future endeavors. University of Colombo School of Computing (UCSC), which is the most reputed higher education institute in the field of computer science and Information Communication Technology in Sri Lanka, will issue these certificates once you successfully complete relevant assessment of the FIT programme.</p>
                    <p>The FIT, Foundation in Information Technology, programme consists of three courses, namely, ICT Applications (FIT 103), English for ICT (FIT 203) and Mathematics for ICT (FIT 303). e-Learning based online system will be available for all registered students to follow courses at any time during the day. e-Testing based system will be used for the evaluation once the student is ready to take the test at University of Colombo School of Computing (UCSC) etesting lab. Hence, students could start the programme at any time during the year and they can take exams at any month during the year at testing centres. At the same time, several private institutes conduct face to face classes based on the FIT syllabuses.</p>
                    
                    <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
                      <a href="programme"><div class="icon"><i class="fa fa-book"></i></div></a>
                      <h4 class="title"><a href="programme">Programme</a></h4>
                      <p class="description">Go to Programme Structure</p>
                    </div>

                </div>

                <div class="col-lg-4 background order-lg-2 order-1 wow fadeInRight" style="background-image: url({{ asset('img/logo/fit.png') }}); margin-top: 100px"></div>
            </div>
        </section><!-- #about -->

        {{-- FAQ --}}
        <section id="faq">
            
            <div class="row about-container">
                <div class="col-lg-8 content order-lg-1 order-2">
                    <h2 class="title">Frequently Asked Questions</h2>
                </div>
            </div>

            <div id="faq-accordion">

                {{-- QUESTION 1 --}}
                <div class="card border-0">
                    <div class="card-header bg-transparent border-bottom-0" id="headingOne">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Why should I follow FIT?</h4>
                        </button>
                    </div>
                
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body pt-0 pt-0 pl-md-5">
                            It is a pre-degree program for those who wish to follow the <a href="http://www.bit.lk"><b>Bachelor of Information Technology (BIT)</b></a> at UCSC. 
                            Moreover, it will be an added qualification for those who seek higher education in ICT or employment in the IT industry or BPO industry.
                        </div>
                    </div>
                </div>
                {{-- //QUESTION 1 --}}

                {{-- QUESTION 2 --}}
                <div class="card border-0">
                    <div class="card-header bg-transparent border-bottom-0" id="headingTwo">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>What are the certificates that I can collect by following FIT?</h4>
                        </button>
                    </div>
                
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body pt-0 pl-md-5">
                            There are two certificates. When you pass all three e-Tests of FIT courses, you can get a certificate certifying your scores.
                            <br/>When you complete all three e-Tests and two practical tests of FIT courses, you can get the final FIT certificate.
                        </div>
                    </div>
                </div>
                {{-- //QUESTION 2 --}}

                {{-- QUESTION 3 --}}
                <div class="card border-0">
                    <div class="card-header bg-transparent border-bottom-0" id="headingThree">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Why should I follow FIT before I register BIT?</h4>
                        </button>
                    </div>
                
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body pt-0 pl-md-5">
                            You can obtain ICT related certification to find an employment in ICT or related areas as a beginner. Since BIT is an external degree programme, you could do a full time or part time job while following the <a href="http://www.bit.lk"><b>BIT Programme</b></a>
                            <br/>If you do not have enough qualifications to register BIT programme, you can use FIT certification to obtain BIT registration.
                        </div>
                    </div>
                </div>
                {{-- //QUESTION 3 --}}

                {{-- QUESTION 4 --}}
                <div class="card border-0">
                    <div class="card-header bg-transparent border-bottom-0" id="headingFour">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                            <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Can I use FIT certificates to register other degree programmes?</h4>
                        </button>
                    </div>
                
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body pt-0 pl-md-5">
                            At the moment, FIT is considered as an alternative qualification to register BIT programme.However, it is difficult to say about other programmes since conditions of registration vary from one to another. However, if any other institute decides to consider FIT certification equivalent qualification for registration, we will announce them.
                        </div>
                    </div>
                </div>
                {{-- //QUESTION 4 --}}

                {{-- QUESTION 5 --}}
                <div class="card border-0">
                    <div class="card-header bg-transparent border-bottom-0" id="headingFive">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                            <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>When can I collect the certificates?</h4>
                        </button>
                    </div>
                
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                        <div class="card-body pt-0 pl-md-5">
                            When you have completed relevant e-Tests or practical tests successfully, you can apply to obtain a formal certificate by paying Rs. 500. All requests received before the first Monday of the last week of a month will be processed and the certificate will be issued during the first week of next month.
                        </div>
                    </div>
                </div>
                {{-- //QUESTION 5 --}}

                {{-- QUESTION 6 --}}
                <div class="card border-0">
                    <div class="card-header bg-transparent border-bottom-0" id="headingSix">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                            <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>How can I find more details about the FIT programme?</h4>
                        </button>
                    </div>
                
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                        <div class="card-body pt-0 pl-md-5">
                            <a href="{{ url('/programme') }}"><b>Programme Structure</b></a> page could be a good starting point.
                        </div>
                    </div>
                </div>
                {{-- //QUESTION 6 --}}

            </div>

        </section>
        {{-- //FAQ --}}

    </main>

@endsection