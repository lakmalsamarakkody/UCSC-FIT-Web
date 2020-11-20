@extends('layouts/web')
@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#registration_nav').addClass("menu-active");
    });

</script>

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/hero-back.png') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">How to Register for FIT?</h1>
        </div>
    </section><!-- #hero -->

  <main id="main">

    <!--==========================
      Registration Section
    ============================-->
    <section id="registration" style="padding-top: 80px;">
        <div class="row about-container mb-5">
            <div class="col-lg-8 content order-lg-1 order-1">
                <h2 class="title">There are no conditions to register for the FIT programme such as age or qualifications.</h2>
                <br/>
                <h4>Registration fees will be Rs. 2750. All registered students will receive a registration number and will be able to access all online courses. Students do not want to pay all registration, examination and other fees when they register for FIT programme. They can register FIT programme by paying only Rs. 2750 and when they are ready to take relevant exams they can pay examination fees.</h4>
                <br/>
                <p>
                    To <b>Register</b>, Sign up your email here and we'll send you an email with <b>login details and steps on how to Register for FIT</b>.
                </p>
                <div class="form">
                    <div id="error">

                    </div>
                    <form action="" method="post" role="form" class="contactForm">
                        <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Type Your Email Here"  data-rule="email" data-msg="Please enter a valid email" />
                        <div class="validation"></div>
                        </div>
                        <div class="mt-4 text-center"><button type="submit">Sign Up Here</button></div>
                    </form>
                </div>
            
            </div>
            <div class="col-lg-4 background order-lg-2 order-2 wow fadeInRight" style="margin-top: 100px; padding-left: 90px; margin-left:0px !important; padding-left: 50px !important;">
                <div class="icon-box wow " data-wow-delay="0.2s">
                    <a href="{{ url('login') }}"><div class="icon"><i class="la la-sign-in-alt"></i></div></a>
                    <h4 class="title"><a href="{{ url('login') }}">Already Registered?</a></h4>
                    <p class="description">Login to FIT Portal</p>
                </div>
            </div>
        </div>
        
    </section><!-- #registration -->

<!-- Accordion -->
<section id="acordion">
    <div class="row about-container">
        <div class="col-lg-8 content order-lg-1 order-2">
            <h2 class="title">Frequently Asked Questions</h2>
        </div>
    </div>
    <div class=""> 


            <h2 class="acc_trigger title"><a href="#toggle1"><i class="fa fa-question-circle pr-3"></i>Without doing FIT, can I register for BIT?</a></h2>
            <div class="acc_container">
                <div class="block">
                    <p class="">
                        <ul>
                            <li><b>Yes</b>, you can. If you pass all three subjects in Advanced Level exams, you can directly register BIT programme without following FIT.</li>
                        </ul>
                    </p>
                </div>
            </div>

            <h2 class="acc_trigger title"><a href="#toggle2"><i class="fa fa-question-circle pr-3"></i>I have done similar courses, can I get FIT certificate?</a></h2>
            <div class="acc_container">
                <div class="block">
                    <p class="">
                        <ul>
                            <li>You have to sit for FIT e-Tests and practical tests to obtain FIT certificate. However, you cannot obtain FIT certificate by submitting similar courses conducted at some other institutes.</li>
                        </ul>
                    </p>
                </div>
            </div>

            <h2 class="acc_trigger title"><a href="#toggle3"><i class="fa fa-question-circle pr-3"></i>I have done similar courses with respect to FIT programme, can I register for BIT?</a></h2>
            <div class="acc_container">
                <div class="block">
                    <p class="">
                        <ul>
                            <li>It is difficult to say since all similar courses are not acceptable. However, if you have done similar courses, we recommend you to take FIT e-Tests and apply BIT registration based on the results.</li>
                        </ul>
                    </p>
                </div>
            </div>

            <h2 class="acc_trigger title"><a href="#toggle4"><i class="fa fa-question-circle pr-3"></i>Other than FIT qualifications, are there conditions to register BIT?</a></h2>
            <div class="acc_container">
                <div class="block">
                    <p class="">
                        <ul>
                            <li><b>Yes</b> , you must have successfully completed, G.C.E.(O/L) exam.</li>
                        </ul>
                    </p>
                </div>
            </div>
            
            <h2 class="acc_trigger title"><a href="#toggle5"><i class="fa fa-question-circle pr-3"></i>How to apply/register FIT programme?</a></h2>
            <div class="acc_container">
                <div class="block">
                    <p class="">
                        <ul>
                            <li>You have to register FIT programme and it could be done online by following link <a href="http://fit.bit.lk/register">http://fit.bit.lk/register</a>  or by sending completed application form together with payment details. For details please click here <a href="http://fit.bit.lk">http://fit.bit.lk</a>  , exams For details click here <a href="http://fit.bit.lk/exams">http://fit.bit.lk/exams</a> </li>
                        </ul>
                    </p>
                </div>
            </div>            
            
            <h2 class="acc_trigger title"><a href="#toggle6"><i class="fa fa-question-circle pr-3"></i>When can I register for FIT ?</a></h2>
            <div class="acc_container">
                <div class="block">
                    <p class="">
                        <ul>
                            <li>Students can register for FIT at any time of the year; however the registration period will expire after365 calendar days depending on the registration date.</li>
                        </ul>
                    </p>
                </div>
            </div>
                        
            <h2 class="acc_trigger title"><a href="#toggle7"><i class="fa fa-question-circle pr-3"></i>Do I have to come to UCSC to register?</a></h2>
            <div class="acc_container">
                <div class="block">
                    <p class="">
                        <ul>
                            <li>No, you do not have to come to UCSC to register. However, it takes 2-3 working days to validate your actual payment through credit card or bank.</li>
                        </ul>
                    </p>
                </div>
            </div>

      
        
    </div>
</section>
<!-- .// Accordion -->


  </main>

@endsection
