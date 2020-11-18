@extends('layouts/web')
@section('content')

    <!--==========================
    Header
    ============================-->
    <header id="header">

        <div id="logo" class="pull-left">
            <a href="/"><img src="img/logo/fit.png" alt="" title="" style="width: 60px; padding: 0px 0px 0px 0px;"/></a>

        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
            <li><a href="/">Home</a></li>
            <li class="menu-active"><a href="programme">Programme</a></li>
            <li><a href="registration">Registration</a></li>
            <li><a href="learning">Learning</a></li>
            <li><a href="examination">Examination</a></li>
            <li><a href="contact-us">Contact Us</a></li>

            </ul>
        </nav><!-- #nav-menu-container -->
        </div>
    </header><!-- #header -->

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
      About Us Section
    ============================-->
    <section id="about">
    <div class="container">
        <div class="row about-container">

            <div class="col-lg-8 content order-lg-1 order-2">
                <h2 class="title">About FIT</h2>
                

                <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
                    <div class="icon"><i class="fa fa-globe"></i></div>
                    <h4 class="title"><a href="programme">Registration</a></h4>
                    <p class="description">For Programme Structure</p>
                </div>
            </div>
            <div class="col-lg-4 background order-lg-2 order-1 wow fadeInRight" style="background-image: url({{ asset('img/logo/fit.png') }}); margin-top: 100px"></div>
        </div>
    </div>
    </section><!-- #about -->



  </main>






@endsection
