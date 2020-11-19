@extends('layouts/web')
@section('content')
<script type="text/javascript">

    $(document).ready(function ($) {
        $('#programme_nav').addClass("menu-active");
    });

</script>
    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/hero-back.png') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">Programme</h1>
        </div>
    </section><!-- #hero -->

  <main id="main">

    <!--==========================
      Programme Section
    ============================-->
    <section id="programme" style="padding-top: 80px;">
        <div class="row about-container">
            <div class="col-lg-8 content order-lg-1 order-1">
                <h2 class="title">Programme Structure</h2>
                <br/>
                <h4>What are the available Courses?</h4>
                <p>Foundation in Information Technology (FIT) programme consists of <b>three courses</b> and all examinations are conducted <b>only in English medium.</b></p>

            </div>
        </section><!-- #about -->
        <section id="programme" style="padding-top: 40px;">
            <div class="row about-container">
                
            <div class="col-lg-8 content order-lg-1 order-1">
                <strong>FIT 103: ICT Applications</strong>
                <p>This course provides basic ICT (Information and Communication Technology) knowledge and skills required for the office environment. It ensures that the learner possesses required knowledge and skills to use office applications competently. It encompasses eight modules: (1) Computing for the Society, (2) Introduction to Computers, (3) Word Processing for Electronic Documents, (4) Spreadsheets for Calculation, (5) Multimedia and Electronic Presentation, (6) Data and Databases, (7) The Internet and Web Applications, and (8) Programming. Also, students could use Microsoft Office 365 as the office package when they sit for examination. There will be a two-hour Multiple-Choice Questions (MCQs) based e-Test and a two-hour practical test for Fundamentals of Computing course.
                    </p>

            </div>
            <div class="myBox col-lg-4 background order-lg-2 order-2 wow fadeInRight" style="background-image: url({{ asset('img/logo/fit103.png') }});  cursor: pointer;">
                <a target="_blank" class="" href="{{ asset('documents/FIT-103/FIT-103-Fundamentals_of_Computing.pdf') }}">
                
                </a>
            </div>
        </div>
    </section><!-- #about -->
    <section id="programme">
        <div class="row about-container">
            <div class="myBox col-lg-4 background order-lg-1 order-2 wow fadeInLeft" style="background-image: url({{ asset('img/logo/fit203.png') }});  cursor: pointer;">
                <a target="_blank" href="{{ asset('documents/FIT-203/FIT-203-English_for_Computing.pdf') }}"></a>
            
            </div>
            <div class="col-lg-8 content order-lg-2 order-1" style="text-align: right;">
                <strong>FIT 203: English for ICT</strong>
                <p>This course has been designed to provide language and communication skills in English from beginners to intermediate learners who want to pursue studies as well as careers in Information Communication Technology (ICT). All four areas of competency in English language, such as Reading, Listening, Speaking and Writing will be covered in this syllabus and the learning activities are designed considering ICT working environment. There will be a two-hour Multiple-Choice Questions (MCQs) based e-Test to evaluate reading, listening capabilities and a two-hour practical test to evaluate speaking and writing skills.
                </p>   
            </div>
            
        </div>
    </section><!-- #about -->
    <section id="programme">
        <div class="row about-container">
            <div class="col-lg-8 content order-lg-1 order-1">
                <strong>FIT 303: Mathematics for ICT</strong>
                <p>Mathematics plays an important role in Information Technology. The aim of this course is to provide basic mathematical and statistical concepts. After successful completion of this course, the learner will possess problem solving and analytical skills together with required mathematical & statistical knowledge to solve problems in computing. Hence, this will be very useful for anyone who is planning to pursue a carrier in ICT or related sector. There will be a two-hour Multiple-Choice Questions (MCQs) based e-Test.
                </p>
            </div>
            <div class="myBox col-lg-4 background order-lg-2 order-2 wow fadeInRight" style="background-image: url({{ asset('img/logo/fit303.png') }}); cursor: pointer;">
                <a target="_blank"  href="{{ asset('documents/FIT-303/FIT-303-Mathematics_for_Computing.pdf') }}"></a>
            </div>
            
        </div>
    </section><!-- #about -->
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
    </section><!-- #about -->

  </main>

@endsection
