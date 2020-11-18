@extends('layouts/web')
@section('content')

<!--==========================
Hero Section
============================-->
<section id="hero" style="background-image: url({{ asset('img/hero-back.png') }}); height:200px">
<div class="page-hero-container">
    <h1 style="padding-top:30px">Programme</h1>
</div>
</section><!-- #hero -->

  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">
        <div class="row about-container">

          <div class="col-lg-8 content order-lg-1 order-2">
            <h2 class="title">About FIT</h2>
            <p>
              The Foundation in Information Technology (FIT) programme aims at enhancing the literacy and competency in using basic computer applications together with analytical thinking and communicational skills required for school leavers. Hence, Mathematics and English Language for Information Communication Technology (ICT) are considered as two other important supporting subject domains.

                FIT is a pre-degree programme that prepares students who are willing to read for their first degree. It is designed for anyone irrespective of the study streams they have followed in Advanced Level (secondary education. Recent statistics show many students who register for degree programmes fail due to lack of ICT competency, language skills and mathematical background. This tendency is very high in external degree programmes. Hence, FIT was designed to address these issues of undergraduate studies.

                At the same time, FIT is an alternative qualification for students who do not posse A/L qualifications to enroll into the Bachelor of Information Technology (BIT) programme. However, those who register for BIT should have completed studies up to Ordinary Level in school curriculum.

                FIT is also a certification programme for employment seekers or school leavers to justify their knowledge and skills in ICT for their future endeavors. University of Colombo School of Computing (UCSC), which is the most reputed higher education institute in the field of computer science and Information Communication Technology in Sri Lanka, will issue these certificates once you successfully complete relevant assessment of the FIT programme.

                The FIT, Foundation in Information Technology, programme consists of three courses, namely, ICT Applications (FIT 103), English for ICT (FIT 203) and Mathematics for ICT (FIT 303). e-Learning based online system will be available for all registered students to follow courses at any time during the day. e-Testing based system will be used for the evaluation once the student is ready to take the test at University of Colombo School of Computing (UCSC) etesting lab. Hence, students could start the programme at any time during the year and they can take exams at any month during the year at testing centres. At the same time, several private institutes conduct face to face classes based on the FIT syllabuses.
                </p>
            <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-globe"></i></div>
              <h4 class="title"><a href="">Programme</a></h4>
              <p class="description">For Programme Structure</p>
            </div>

          </div>

          <div class="col-lg-4 background order-lg-2 order-1 wow fadeInRight" style="background-image: url({{ asset('img/fit.png') }}); margin-top: 100px"></div>
        </div>

      </div>
    </section><!-- #about -->



  </main>






@endsection
