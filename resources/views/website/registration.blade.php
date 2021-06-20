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
    <section id="hero" style="background-image: url({{ asset('img/background/back.jpg') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">Get Register for FIT</h1>
        </div>
    </section><!-- #hero -->

  <main id="main">

    <!--==========================
      Registration Section
    ============================-->
    <section id="registration" style="padding-top: 80px;">
        <div class="row about-container mb-5">
            <div class="col-lg-8 content order-lg-1 order-1">
                <h2 class="title">How to Register for FIT?</h2>

                <p>There are <b>no conditions</b>  to register for the FIT programme such as age or qualifications.</p>
                
                <p>Registration fees will be <b>Rs. 2750.00</b>. All registered students will receive a registration number and will be able to access all online courses. Students do not have to pay all registration, examination and other fees when they register for FIT programme. They can register FIT programme by paying only <b> Rs. 2750.00</b> and when they are ready to take relevant exams they can pay examination fees for relevant subjects.</p>
                
                <p>
                    To <b>Register</b>, Sign up your email here and we'll send you an email with <b>login details and steps on how to Register for FIT</b>.
                </p>

                <p>Only one account can be created using one email</p>
                <div class="form">
                    <div id="error">

                    </div>
                    <form class="contactForm" onsubmit="send_email()">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Type Your Email Here"  data-rule="email" data-msg="Please enter a valid email" />
                            <span id="erremail" class="invalid-feedback" role="alert"></span>
                        </div>
                        <div class="mt-4 text-center">
                            <button id="submit" type="button" onclick="send_email()">
                                Sign Up Here
                                <span id="emailSpinner" class="spinner-border spinner-border-sm mb-2 d-none" role="status" aria-hidden="true"></span>
                                
                            </button>
                        </div>
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
        <div class="row about-container pt-0">
            <div class="col-lg-8 content order-lg-1 order-2"> 
                <div class="icon-box wow fadeInLeft pb-5" data-wow-delay="0.2s">
                    <a target="_blank" href="{{ asset('documents/Payment_Voucher.pdf') }}"><div class="icon"><i class="fa fa-file-invoice-dollar"></i></div></a>
                    <h4 class="title"><a target="_blank" href="{{ asset('documents/Payment_Voucher.pdf') }}">Payment Voucher</a></h4>
                    <p class="description">Click Here to Download the Payment Voucher</p>
                </div>
            </div>
        </div>
    </section><!-- #registration -->

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
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Without doing FIT, can I register for BIT?</h4>
                    </button>
                </div>
            
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body pt-0 pt-0 pl-md-5">
                        <b>Yes</b>, you can. If you pass all three subjects in Advanced Level exams, you can directly register BIT programme without following FIT.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 1 --}}

            {{-- QUESTION 2 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingTwo">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>I have done similar courses, can I get FIT certificate?</h4>
                    </button>
                </div>
            
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        You have to sit for FIT e-Tests and practical tests to obtain FIT certificate. However, you cannot obtain FIT certificate by submitting similar courses conducted at some other institutes.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 2 --}}

            {{-- QUESTION 3 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingThree">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>I have done similar courses with respect to FIT programme, can I register for BIT?</h4>
                    </button>
                </div>
            
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        It is difficult to say since all similar courses are not acceptable. However, if you have done similar courses, we recommend you to take FIT e-Tests and apply BIT registration based on the results.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 3 --}}

            {{-- QUESTION 4 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingFour">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Other than FIT qualifications, are there conditions to register BIT?</h4>
                    </button>
                </div>
            
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        <b>Yes</b> , you must have successfully completed, G.C.E.(O/L) exam.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 4 --}}

            {{-- QUESTION 5 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingFive">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>How to apply/register FIT programme?</h4>
                    </button>
                </div>
            
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        You have to register FIT programme and it could be done online by submitting your email <a href="{{url('#registration')}}">here</a>. 
                    </div>
                </div>
            </div>
            {{-- //QUESTION 5 --}}

            {{-- QUESTION 6 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingSix">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>When can I register for FIT ?</h4>
                    </button>
                </div>
            
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        Students can register for FIT at any time of the year; however the registration period will expire after365 calendar days depending on the registration date.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 6 --}}

            {{-- QUESTION 7 --}}
            <div class="card border-0">
                <div class="card-header bg-transparent border-bottom-0" id="headingSeven">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                        <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Do I have to come to UCSC to register?</h4>
                    </button>
                </div>
            
                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                    <div class="card-body pt-0 pl-md-5">
                        <b>No</b>, you do not have to come to UCSC to register. However, it takes 2-3 working days to validate your actual payment through credit card or bank.
                    </div>
                </div>
            </div>
            {{-- //QUESTION 7 --}}

        </div>

    </section>
    {{-- //FAQ --}}

  </main>

@endsection
@include('website.registration.script')