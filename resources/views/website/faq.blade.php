@extends('layouts/web')
@section('content')

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/hero-back.png') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">Frequently Asked Questions</h1>
        </div>
    </section><!-- #hero -->

    <main id="main">

        {{-- FAQ --}}
        <section id="faq">

            <div id="accordion">

                {{-- ABOUT FIT --}}
                <div class="row about-container" style="padding-top: 80px;">
                    <div class="col-lg-8 content order-lg-1 order-2">
                        <h2 class="title">Questions about FIT</h2>
                    </div>
                </div>

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
                {{-- //ABOUT FIT --}}

                {{-- PROGRAMME STRUCTURE --}}
                <div class="row about-container" style="padding-top: 80px;">
                    <div class="col-lg-8 content order-lg-1 order-2">
                        <h2 class="title">Questions about Programme Structure</h2>
                    </div>
                </div>
                    {{-- QUESTION 7 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="headingSeven">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>How long will it take to complete FIT?</h4>
                            </button>
                        </div>
                    
                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                            <div class="card-body pt-0 pt-0 pl-md-5">
                                Generally, it takes 8-10 months to complete all courses if it is very beginner. However, it depends on the past experience and your knowledge in the area. Moreover, it will be an added qualification for those who seek higher education in ICT or employment in the IT industry or BPO industry.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 7 --}}

                    {{-- QUESTION 8 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="headingEight">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>How can I make a complain about FIT programme?</h4>
                            </button>
                        </div>
                    
                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                Please contact the relevant facilitator of the course, through a forum, message or email. Contact details are given in the <a href="{{ url('/contact') }}">contact us</a> page.
                                <br/>If you are not satisfied with the reply, contact the coordinator of VLE through ( <a href="mailto:kph@ucsc.cmb.ac.lk">kph@ucsc.cmb.ac.lk</a> ).
                                <br/>If you are still not satisfied with the reply, send your complain in writing to the Director, UCSC by using the e-mail (<a href="mailto:director@ucsc.cmb.ac.lk">director@ucsc.cmb.ac.lk</a>)
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 8 --}}

                    {{-- QUESTION 9 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="headingNine">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Is there any different between old and new syllabus?</h4>
                            </button>
                        </div>
                    
                        <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                Yes, there are some differences and those improvements are done to enhance the FIT programme. All students are supposed to follow the current syllabus.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 9 --}}
                {{-- //PROGRAMME STRUCTURE --}}

            </div>

        </section>
        {{-- //FAQ --}}

    </main>
@endsection