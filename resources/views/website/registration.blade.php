@extends('layouts/web')
@section('content')

    <!--==========================
    Header
    ============================-->
    <header id="header">

        <div id="logo" class="pull-left">
            <a href="/"><img src="img/logo/fit-nav.png" alt="" title="" style="width: 65px; padding: 0px 0px 0px 0px;"/></a>

        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
            <li><a href="/">Home</a></li>
            <li><a href="programme">Programme</a></li>
            <li><a href="learning">Learning</a></li>
            <li><a href="examination">Examination</a></li>
            <li class="menu-active"><a href="registration">Registration</a></li>
            <li><a href="contact-us">Contact Us</a></li>
            <li><a href="portal/login">Login</a></li>

            </ul>
        </nav><!-- #nav-menu-container -->
        </div>
    </header><!-- #header -->

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/hero-back.png') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">Registration</h1>
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
                <h2 class="title">How to Register for FIT?</h2>
                <br/>
                <h4>There are no conditions to register for the FIT programme such as age or qualifications.</h4>
                <p>Registration fees will be Rs. 2750. All registered students will receive a registration number and will be able to access all online courses. Students do not want to pay all registration, examination and other fees when they register for FIT programme. They can register FIT programme by paying only Rs. 2750 and when they are ready to take relevant exams they can pay examination fees.</p>

                <h3><a class="btn btn-primary" href="/portal/login">Sign Up here</a></h3>
                <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
                    <a href="/portal/login"><div class="icon"><i class="la la-sign-in-alt"></i></div></a>
                    <h4 class="title"><a href="/portal/login">Already Registered</a></h4>
                    <p class="description">Login to FIT Portal</p>
                </div>
            </div>
            <div class="col-lg-4 background order-lg-2 order-1 wow fadeInRight" style="background-image: url({{ asset('img/logo/fit.png') }}); margin-top: 100px"></div>
        </div>
    </div>
    </section><!-- #about -->

  </main>

@endsection
