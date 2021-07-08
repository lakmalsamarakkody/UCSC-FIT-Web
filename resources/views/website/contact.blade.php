@extends('layouts/web')
@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#contact_nav').addClass("menu-active");
    });

</script>
    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/back.jpg') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">Contact</h1>
        </div>
    </section><!-- #hero -->

  <main id="main">

    <!--==========================
      Contact Section
    ============================-->
    <section id="about" style="padding-bottom: 0px; !important">
        <div class="row  about-container ">
            <div class="col-lg-8 content order-lg-1 order-1"> 
                <p>If you have a problem with regard to the FIT programme or related services from UCSC, please read the following guidelines for assistance.</p>

                <p style="color: rgb(155, 5, 5);"> <b>Check Frequently Asked Questions (FAQs) to see whether you could find the answer for your problem.</b> </p>
            
            </div>
            <div class="col-lg-4 content order-lg-2 order-2 "> 
                <a class="float-right faq wow fadeInRight" href="{{ url('/faq') }}"><i class="fa fa-question-circle"></i> FAQ</a>

            </div>
        </div>
        <hr style="padding-bottom: 20px; !important">
        <div class="row  about-container ">
            <div class="col-lg-8 content order-lg-1 order-1 mb-5">               
                <h2 class="title"><a href="mailto:edc@ucsc.cmb.ac.lk" style="color:#000">Administration Matters</a></h2>
                <br/>
                <p>If your question is related to administration matters of FIT programme, 
                        <br>for example <b>registration, submitting applications for examination,</b> etc. please create an account in the online information system (FIT-SIS). You will be able to get all relevant information and support via our online system. However, if you have any doubts or questions, you can contact the e-Learning Centre. 
                        <br>It is recommended to check the FIT website ( <a href="www.fit.bit.lk">www.fit.bit.lk</a> ) or FIT LMS ( <a href="http://fit.bit.lk/vle">http://fit.bit.lk/vle</a> ) before you try to contact us over the phone.
                </p>
            </div>
            <div class="col-lg-4 content order-lg-2 order-2">               
                <div class="icon-box wow fadeInUp" data-wow-delay="0.2s" style="padding-bottom: 80px;">
                    <h1 class="title">&nbsp;</h1>
                    <p class="description"   style="margin-left:0px !important; padding-left: 0px !important;">
                        <b>&nbsp;</b><br>
                        <i class="fa fa-envelope"></i><tab1><a href="mailto:edc@ucsc.cmb.ac.lk">elc@ucsc.cmb.ac.lk</a> <br>
                        <i class="fa fa-phone"></i><tab1><a href="tel:+94112591080">+94 11 2591080</a> (Working Hours Only) <br>
                        {{-- <i class="fa fa-address-card"></i><tab1>Coordinator (e- Learning Centre),
                        <br><tab2>University of Colombo School of Computing,
                        <br><tab2>No. 35, Reid Avenue, 
                        <br><tab2>Colombo 07,
                        <br><tab2>Sri Lanka. --}}
                    </p>
                </div>
            </div>
        </div>
        <hr>

        <div class="row  about-container ">
            <div class="col-lg-8 content order-lg-1 order-1">               
                    <h2 class="title"><a href="mailto:admin@fit.bit.lk"  style="color:#000">e-Learning Services</a></h2>
                    <p class="description">If your question is related to e-learning services,
                        <br>for example,<b>login into the Learning Management System </b>( <a href="http://fit.bit.lk/vle">http://fit.bit.lk/vle</a> )  
                        <b>online assignments and accessing online courses related issues,</b> etc. contact e-Learning Centre. 
                        <br>If your question is about online course content, it is recommended to check the relevent discussion forum of the course and post your question before you contact relevant facilitator at e-Learning Centre. <a href="http://fit.bit.lk/vle">http://fit.bit.lk/vle</a> (Check the VLE site for announcements)
                    </p>
                
            </div>
            <div class="col-lg-4 content order-lg-2 order-2">               
                <div class="icon-box wow fadeInUp" data-wow-delay="0.2s" style="padding-bottom: 80px;">
                    <h1 class="title">&nbsp;</h1>
                    <p class="description"   style="margin-left:0px !important; padding-left: 0px !important;">
                        <i class="fa fa-envelope"></i><tab1><a href="mailto:admin@fit.bit.lk">admin@fit.bit.lk</a> <br>
                        <i class="fa fa-phone"></i><tab1><a href="tel:+94112591080">+94 11 2591080</a> (Working Hours Only) <br>
                        <i class="fa fa-address-card"></i><tab1>e-Learning Centre,
                        <br><tab2>University of Colombo School of Computing,
                        <br><tab2>No. 35, Reid Avenue, 
                        <br><tab2>Colombo 07,
                        <br><tab2>Sri Lanka.
                    </p>
                </div>
            </div>
        </div>
        <hr>
        
        <div class="row  about-container ">
            <div class="col-lg-8 content order-lg-1 order-1">               
                    <h2 class="title"><a href="mailto:taw@ucsc.cmb.ac.lk"  style="color:#000">Academic Matters</a></h2>
                    <p class="description">If your question is related to administration matters of FIT programme, 
                        <br>for example <b>registration, submitting applications for examination,</b> etc. please contact External Degrees Centre. 
                        <br>It is recommended to check the FIT website ( <a href="www.fit.bit.lk">www.fit.bit.lk</a> ) or FIT LMS ( <a href="http://fit.bit.lk/vle">http://fit.bit.lk/vle</a> ) before you contact the relevant details.
                    </p>
            </div>
            <div class="col-lg-4 content order-lg-2 order-2">               
                <div class="icon-box wow fadeInUp" data-wow-delay="0.2s" style="padding-bottom: 80px;">
                    <h1 class="title">&nbsp;</h1>
                    <p class="description"   style="margin-left:0px !important; padding-left: 0px !important;">
                        <b>Dr. T. A. Weerasinghe</b><br>
                        <i class="fa fa-envelope"></i><tab1><a href="mailto:taw@ucsc.cmb.ac.lk">taw@ucsc.cmb.ac.lk</a> <br>
                        <i class="fa fa-phone"></i><tab1><a href="tel:+94112591080">+94 11 2591080</a> (Working Hours Only) <br>
                        <i class="fa fa-address-card"></i><tab1>Coordinator (FIT) and Coordinator (e-LC),
                        <br><tab2>University of Colombo School of Computing,
                        <br><tab2>No. 35, Reid Avenue, 
                        <br><tab2>Colombo 07,
                        <br><tab2>Sri Lanka.
                    </p>
                </div>
            </div>
        </div>
        <hr>

        <div class="row  about-container ">
            <div class="col-lg-8 content order-lg-1 order-1">               
                    <h2 class="title"><a href="mailto:edc@ucsc.cmb.ac.lk"  style="color:#000">Complaints </a></h2>
                    <p class="description"> If you want to make a complain about any service related to the FIT Programme,<br>
                        you are requested to contact the following staff members depending on your issue.<br>
                        It is recommended to send your complain by email rather than contacting through phone, unless it is an urgent matter.
                    </p>
            </div>
            <div class="col-lg-4 content order-lg-2 order-2">               
                <div class="icon-box wow fadeInUp" data-wow-delay="0.2s" style="padding-bottom: 80px;">
                    <h1 class="title">&nbsp;</h1>
                    <p class="description"   style="margin-left:0px !important; padding-left: 0px !important;">
                        <b>Dr. T. A. Weerasinghe</b><br>
                        <i class="fa fa-envelope"></i><tab1><a href="mailto:taw@ucsc.cmb.ac.lk">taw@ucsc.cmb.ac.lk</a> <br>
                        <i class="fa fa-phone"></i><tab1><a href="tel:+94112591080">+94 11 2591080</a> (Working Hours Only) <br>
                        <i class="fa fa-address-card"></i><tab1>Coordinator (FIT) and Coordinator (e-LC),
                        <br><tab2>University of Colombo School of Computing,
                        <br><tab2>No. 35, Reid Avenue, 
                        <br><tab2>Colombo 07,
                        <br><tab2>Sri Lanka.
                    </p>
                    <p class="description"   style="margin-left:0px !important; padding-left: 0px !important;">
                        <b>Prof. K. P. Hewagamage</b><br>
                        <i class="fa fa-envelope"></i><tab1><a href="mailto:kph@ucsc.cmb.ac.lk">kph@ucsc.cmb.ac.lk</a> <br>
                        <i class="fa fa-phone"></i><tab1><a href="tel:+94112158950">+94 11 2158950</a> (Working Hours Only) <br>
                        <i class="fa fa-address-card"></i><tab1>Director,
                        <br><tab2>UCSC
                    </p>
                </div>
            </div>
        </div>
        
    </section><!-- #about -->       
    <section id="contact">
        <!-- map -->
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7921.805945256399!2d79.861153!3d6.902206!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2db2c18a68712863!2sUniversity%20of%20Colombo%20School%20of%20Computing!5e0!3m2!1sen!2slk!4v1605773846216!5m2!1sen!2slk" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>

    </section><!-- #contact -->


  </main>

@endsection
