@extends('layouts/web')
@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#examination_nav').addClass("menu-active");
    });

</script>

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/back.jpg') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">How to Apply FIT Exams?</h1>
        </div>
    </section><!-- #hero -->

  <main id="main">

    <!--==========================
      Examination Section
    ============================-->
    <section id="examination" style="padding-top: 80px;">
        <!-- main header -->
        <div class="row about-container">
            <div class="col-lg-8 content order-lg-1 order-1">
                <h2 class="title">Examination Environment</h2>
                <br/>
                <p>Students, who are competent about the subject as given in the syllabus, <b>could sit for the examination at any time</b>. There is no requirement of following the online courses if a student feels competent in the relevant subjects.</p>
                <br/>
                <p>However, <b>students should register for FIT and pay the examination fee, in order to sit for the exam.</b> All students are advised to take the model online e-Test at <a href="http://fit.bit.lk/vle"><b>VLE</b></a> before they take real FIT exams.</p>   
                
                <table class="table table-responsive-sm table-hover">
                    <thead>
                        <tr>
                            <td>Course Code</td>
                            <td>Course Name</td>
                            <td>Examination</td>
                            <td>Description</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>FIT 103</td>
                            <td>ICT Applications</td>
                            <td>2 hr e-Test and 2hr Practical Test</td>
                            <td>Rs. 2250/= for e-Test and Rs. 3250/= for practical test will be charged. You are advised to take e-Test before the practical test.</td>
                        </tr>
                        <tr>
                            <td>FIT 203</td>
                            <td>English for ICT</td>
                            <td>2 hr e-Test and 2hr Practical Test</td>
                            <td>Rs. 2250/= for e-Test and Rs. 3250/= for practical test will be charged. You are advised to take e-Test before the practical test.</td>
                        </tr>
                        <tr>
                            <td>FIT 303</td>
                            <td>Mathematics for ICT</td>
                            <td>2 hr e-Test only</td>
                            <td>Rs. 2250/= will be charged for e-Test for this course.</td>
                        </tr>
                    </tbody>
                </table>

                <p>After registering, students could take examinations at any time. Generally, exams are conducted once in a month depending on the demand. Once the exam schedule is published in the VLE, you must come <b>with your national ID or any other acceptable proof of authentication</b> ( eg: passport, driving license, etc....) to prove your identity for the exam on the given date.</p>
            </div>
            
            <div class="myBox col-lg-4 background order-lg-2 order-2 wow fadeInRight" style="background-image: url({{ asset('img/logo/exam.png') }}); cursor: pointer;">
                <a target="_blank"  href="http://fit.bit.lk/vle"></a>

            </div>

        </div><!-- #main header -->

        <div class="row about-container pt-5">
            <div class="col-lg-8 content order-lg-1 order-2"> 
                <div class="icon-box wow fadeInLeft pb-0" data-wow-delay="0.2s">
                    <a target="_blank" href="{{ asset('documents/Payment_Voucher.pdf') }}"><div class="icon"><i class="fa fa-file-invoice-dollar"></i></div></a>
                    <h4 class="title"><a target="_blank" href="{{ asset('documents/Payment_Voucher.pdf') }}">Payment Voucher</a></h4>
                    <p class="description">Click Here to Download the Payment Voucher</p>
                </div>
            </div>
        </div>

        <!-- DETAILS -->
        <div class="row about-container mt-5" style="background-color:  rgba(255, 255, 255, 0) !important;" id="contact">
            <div class="col-lg-8 content order-lg-1 order-1">               
                <div class="wow fadeInUp" data-wow-delay="0.2s" style="padding-bottom: 0px;">
                    <h2 class="title">UCSC e-Testing Lab</h2>
                    <p class="description">If your question is related to examination matters of FIT programme, 
                        <br>for example <b>submitting applications for examination,</b> etc. please contact External Degrees Centre. 
                        <br>It is recommended to check the FIT website ( <a href="http://www.fit.bit.lk">www.fit.bit.lk</a> ) or FIT LMS ( <a href="http://fit.bit.lk/vle">http://fit.bit.lk/vle</a> ) before you contact the relevant details.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 content order-lg-2 order-2">               
                <div class="icon-box wow fadeInUp" data-wow-delay="0.2s" style="padding-bottom: 80px; margin-left:0px !important; padding-left: 0px !important;">
                    <h1 class="title">&nbsp;</h1>
                    <p class="description"  style="margin-left:0px !important; padding-left: 0px !important;">
                        <i class="fa fa-address-card"></i><tab1>University of Colombo School of Computing,
                        <br><tab2>No. 35, Reid Avenue, 
                        <br><tab2>Colombo 07,
                        <br><tab2>Sri Lanka.
                        <br><i class="fa fa-phone"></i><tab1><a href="tel:+94112591080">+94 11 2591080</a> (Working Hours Only)
                    </p>
                </div>
            </div>
        </div><!-- #DETAILS -->
        
        <!-- NEXT STEP -->
        <div class="row about-container">
            <div class="col-lg-8 content order-lg-1 order-2">               


                <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
                    <a href="{{ url('/registration') }}"><div class="icon"><i class="fa fa-hand-point-right"></i></div></a>
                    <h4 class="title"><a href="{{ url('/registration') }}">Registration</a></h4>
                    <p class="description">How to Register for FIT Programme</p>
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
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>How long does it take to know FIT results?</h4>
                    </button>
                </div>
            
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body pt-0 pt-0 pl-md-5">
                        The official results will be issued within <b> two weeks</b> after the end of exam. It will take 2-3 weeks to issue FIT practical tests.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 1 --}}

            {{-- QUESTION 2 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingTwo">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>When practical test will be held?</h4>
                    </button>
                </div>
            
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        If there is enough demand, the practical tests are also held once in a month. However, the time table could be varied depending on the demand and availability.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 2 --}}

            {{-- QUESTION 3 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingThree">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Do I have to pass to obtain the certificate?</h4>
                    </button>
                </div>
            
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        <b>Yes</b>, you have to pass relevant tests of FIT programme to obtain the certificates. The pass mark for any e-Test or practical test will be 50 marks.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 3 --}}

            {{-- QUESTION 4 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingFour">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Do I have to do online course quizzes?</h4>
                    </button>
                </div>
            
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        These online courses are self-learning optional resources for registered students. Your marks or performances in online courses will not be considered when deciding your final grade.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 4 --}}

            {{-- QUESTION 5 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingFive">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Does my practice quiz marks will be counted for final grade?</h4>
                    </button>
                </div>
            
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        <b>No</b>, they will not be counted for final grade in the course. Final grade of a course depends on the e-Tests and practical.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 5 --}}

            {{-- QUESTION 6 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingSix">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Where can I take FIT exams?</h4>
                    </button>
                </div>
            
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        You can take FIT exams at NODES Centres or at UCSC e-Testing Lab at the external degree centre.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 6 --}}

            {{-- QUESTION 7 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingSeven">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>If I am a repeat student (registered before {{ now()->year }}), do I have to follow the new syllabus when I take next exam?</h4>
                    </button>
                </div>
            
                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        You can select MS Office 2007 or 2003 when selecting the ICT Application course. There are no separate exams for students who registered before {{ now()->year }}.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 7 --}}

            {{-- QUESTION 8 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingEight">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Do I have to do all e-Tests at once?</h4>
                    </button>
                </div>
            
                <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        No, there is no such a requirement. You can decide in the way you like to do. However, if you register for all e-Tests, you can do all these three e-Tests on the same day.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 8 --}}

        </div>

    </section>
    {{-- //FAQ --}}

  </main>

@endsection
