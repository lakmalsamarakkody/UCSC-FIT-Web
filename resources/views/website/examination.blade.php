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
    <section id="hero" style="background-image: url({{ asset('img/background/hero-back.png') }}); height:200px">
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
            <div class="col-lg-12 content order-lg-1 order-1">
                <h2 class="title">Examination Environment</h2>
                <br/>
                <h4>Students, who are competent about the subject as given in the syllabus, <b>could sit for the examination at any time</b>. There is no requirement of following the online courses if a student feels competent in the relevant subjects.</h4>
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
        </div><!-- #main header -->

        <!-- PAYMENT DETAILS -->
        <div class="row about-container mt-5">
            
        </div><!-- #PAYMENT DETAILS -->

        <!-- DETAILS -->
        <div class="row about-container mt-5">
            <div class="col-lg-8 content order-lg-1 order-1">               
                <div class="icon-box wow fadeInUp" data-wow-delay="0.2s" style="padding-bottom: 80px;">
                    <h1 class="title">UCSC e-Testing Lab</h1>
                    <p class="description">If your question is related to examination matters of FIT programme, 
                        <br>for example <b>submitting applications for examination,</b> etc. please contact External Degrees Centre. 
                        <br>It is recommended to check the FIT website ( <a href="www.fit.bit.lk">www.fit.bit.lk</a> ) or FIT LMS ( <a href="http://fit.bit.lk/vle">http://fit.bit.lk/vle</a> ) before you contact the relevant details.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 content order-lg-2 order-2">               
                <div class="icon-box wow fadeInUp" data-wow-delay="0.2s" style="padding-bottom: 80px;">
                    <h1 class="title">&nbsp;</h1>
                    <p class="description">
                        <i class="fa fa-address-card"></i> University of Colombo School of Computing,
                        <br>No. 35, Reid Avenue, 
                        <br>Colombo 07,
                        <br>Sri Lanka.
                        <br><i class="fa fa-phone"></i> <a href="tel:+94112591080"></a>+94 11 2591080</a> (Working Hours Only)
                    </p>
                </div>
            </div>
        </div><!-- #DETAILS -->
        
        <!-- NEXT STEP -->
        <div class="row about-container">
            <div class="col-lg-8 content order-lg-1 order-2">               


                <div class="icon-box wow fadeInUp" data-wow-delay="0.2s" style="padding-top: 80px;">
                    <a href="registration"><div class="icon"><i class="fa fa-leanpub"></i></div></a>
                    <h4 class="title"><a href="registration">Registration</a></h4>
                    <p class="description">How to Register for FIT Programme</p>
                </div>
            </div>
            
        </div><!-- #NEXT STEP -->
    </section>

  </main>

@endsection
