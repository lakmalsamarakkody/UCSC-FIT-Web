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

<!-- Accordion -->
<section id="about">
    <div class="row about-container">
        <div class="col-lg-8 content order-lg-1 order-2">
            <h2 class="title">Frequently Asked Questions</h2>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Section-1
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas et facilisis mi. Nunc vitae pretium est, aliquet sagittis enim. Duis fringilla ipsum at velit gravida, ac luctus lorem euismod. Vivamus placerat dolor mi, vel feugiat dui egestas a. Fusce congue. </p>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Section-2
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas et facilisis mi. Nunc vitae pretium est, aliquet sagittis enim. Duis fringilla ipsum at velit gravida, ac luctus lorem euismod. Vivamus placerat dolor mi, vel feugiat dui egestas a. Fusce congue. </p>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Section-3
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas et facilisis mi. Nunc vitae pretium est, aliquet sagittis enim. Duis fringilla ipsum at velit gravida, ac luctus lorem euismod. Vivamus placerat dolor mi, vel feugiat dui egestas a. Fusce congue. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- .// Accordion -->


    </main>

@endsection