@extends('layouts/web')
@section('content')

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/back.jpg') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">Frequently Asked Questions</h1>
        </div>
    </section><!-- #hero -->

    <main id="main">

        {{-- FAQ --}}
        <section id="faq">

            <div id="accordion">

                {{-- ABOUT FIT --}}
                <div class="row about-container" style="padding-top: 80px;">
                    <div class="col-lg-8 content order-lg-1 order-2">
                        <h2 class="title">Questions about FIT</h2>
                    </div>
                </div>

                    {{-- QUESTION 1 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="headingOne">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Why should I follow FIT?</h4>
                            </button>
                        </div>
                    
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body pt-0 pt-0 pl-md-5">
                                It is a pre-degree program for those who wish to follow the <a href="http://www.bit.lk"><b>Bachelor of Information Technology (BIT)</b></a> at UCSC. 
                                Moreover, it will be an added qualification for those who seek higher education in ICT or employments related to IT.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 1 --}}

                    {{-- QUESTION 2 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="headingTwo">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>What are the certificates that I can collect by following FIT?</h4>
                            </button>
                        </div>
                    
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                There is only one certificate in this programme. It will be offered to you after you pass all three e-Tests and the two Practical tests. But if required, you can get a programme status letter after passing all three eTests. Also, you can take a printout of your profile page in the FIT information system and use it as a proof of registration to this programme.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 2 --}}

                    {{-- QUESTION 3 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="headingThree">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Why should I follow FIT before I register BIT?</h4>
                            </button>
                        </div>
                    
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                You can obtain ICT related certification to find an employment in ICT or related areas as a beginner. Since BIT is an external degree programme, you could do a full time or part time job while following the  <a href="http://www.bit.lk"><b>BIT Programme</b></a>
                                <br/>If you do not have enough qualifications to register BIT programme, you can use FIT certification to obtain BIT registration.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 3 --}}

                    {{-- QUESTION 4 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="headingFour">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Can I use FIT certificates to register other degree programmes?</h4>
                            </button>
                        </div>
                    
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                               At the moment, FIT is considered as an alternative qualification to register BIT programme. However, it is difficult to say about other programs since conditions of registration vary from one to another. However, if any other institute decides to consider FIT certification equivalent qualification for registration, we will announce them.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 4 --}}

                    {{-- QUESTION 5 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="headingFive">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>When can I collect the certificates?</h4>
                            </button>
                        </div>
                    
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                When you have completed relevant e-Tests or practical tests successfully, you can apply to obtain a formal certificate by paying Rs. 500. All requests received before the first Monday of the last week of a month will be processed and the certificate will be issued during the first week of next month.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 5 --}}

                    {{-- QUESTION 6 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="headingSix">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>How can I find more details about the FIT programme?</h4>
                            </button>
                        </div>
                    
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                <a href="{{ url('/programme') }}"><b>Programme Structure</b></a> page could be a good starting point.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 6 --}}
                {{-- //ABOUT FIT --}}

                {{-- PROGRAMME STRUCTURE --}}
                <div class="row about-container" style="padding-top: 80px;">
                    <div class="col-lg-8 content order-lg-1 order-2">
                        <h2 class="title">Questions about Programme Structure</h2>
                    </div>
                </div>
                    {{-- QUESTION 7 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="headingSeven">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>How long will it take to complete FIT?</h4>
                            </button>
                        </div>
                    
                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                            <div class="card-body pt-0 pt-0 pl-md-5">
                               Generally, it takes 8-10 months to complete all courses if it is very beginner. However, it depends on your experience and your knowledge of IT. Moreover, it will be an added qualification for those who seek higher education in ICT or IT-related employment.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 7 --}}

                    {{-- QUESTION 8 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="headingEight">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>How can I make a complain about FIT programme?</h4>
                            </button>
                        </div>
                    
                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                Please contact the relevant facilitator of the course, through a forum, message or email. Contact details are given in the <a href="{{ url('/contact') }}">contact us</a> page.
                                <br/>If you are not satisfied with the reply, contact the coordinator of VLE through email  ( <a href="mailto:taw@ucsc.cmb.ac.lk">taw@ucsc.cmb.ac.lk</a> ).
                                <br/>If you are still not satisfied with the reply, send your complaint in writing to the Director, UCSC by using the email (<a href="mailto:director@ucsc.cmb.ac.lk">director@ucsc.cmb.ac.lk</a>)
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 8 --}}

                    {{-- QUESTION 9 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="headingNine">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Is there any different between old and new syllabus?</h4>
                            </button>
                        </div>
                    
                        <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                Yes, there are some differences, and those improvements are done to enhance the FIT programme. The students are supposed to follow the new syllabus as all the examinations are conducted based on the new syllabi.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 9 --}}
                {{-- //PROGRAMME STRUCTURE --}}


                {{-- LEARNING --}}
                    <div class="row about-container" style="padding-top: 80px;">
                        <div class="col-lg-8 content order-lg-1 order-2">
                            <h2 class="title">Questions about Learning FIT</h2>
                        </div>
                    </div>

                    {{-- QUESTION 10 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="headingTen">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Does UCSC conduct classes for FIT?</h4>
                            </button>
                        </div>
                    
                        <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion">
                            <div class="card-body pt-0 pt-0 pl-md-5">
                                <b>No</b> UCSC will not conduct any face-to-face classes. Private institutes conduct face-to-face classes based on the FIT syllabi. However, UCSC will not undertake any responsibility or comment on their performances. Therefore, we advise all the students to follow the online courses in the FITVLE and get updated by checking the announcements we made via the FITVLE and FIT information system.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 10 --}}

                    {{-- QUESTION 11 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading11">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse11" aria-expanded="true" aria-controls="collapse11">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Where can I learn for FIT?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse11" class="collapse" aria-labelledby="heading11" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                You can follow online courses in the FITVLE.  Otherwise, you can select a private institute that conducts classes based on the FIT syllabi.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 11 --}}

                    {{-- QUESTION 12 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading12">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse12" aria-expanded="true" aria-controls="collapse12">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Are these online courses enough to complete FIT?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse12" class="collapse" aria-labelledby="heading12" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                               Online courses provide general guidance for a self-learning student. They are designed and developed based on the FIT curriculum. However, if you find it difficult to understand the subject matter given in the syllabus and online courses, it is better to consider attending classes conducted by a private institute.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 12 --}}

                    {{-- QUESTION 13 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading13">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse13" aria-expanded="true" aria-controls="collapse13">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Should I go to Institute to complete FIT programme?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse13" class="collapse" aria-labelledby="heading13" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                There is no compulsory requirement. There are a lot of self-learning students who follow the FIT programme. However, if you find it difficult to understand the subject matter given in the syllabus and online courses, it is better to consider attending classes conducted by a private institute.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 13 --}}

                    {{-- QUESTION 14 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading14">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse14" aria-expanded="true" aria-controls="collapse14">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>How long will it take to get access to the virtual learning environment (FITVLE) after registration?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse14" class="collapse" aria-labelledby="heading14" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                            It will take 3-4 working days( maximum 7days) after submitting your registration detail via FIT information system. If you have provided a valid email address, we will inform you as soon as we create an account in the online system. If it delays more than seven days, please contact the admin of the FITVLE <a href="mailto:admin@fit.bit.lk">(admin@fit.bit.lk)</a>.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 14 --}}
                {{-- //LEARNING --}}

                {{-- EXAMINATION --}}  
                    <div class="row about-container" style="padding-top: 80px;">
                        <div class="col-lg-8 content order-lg-1 order-2">
                            <h2 class="title">Questions about FIT Examination</h2>
                        </div>
                    </div>

                    {{-- QUESTION 15 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading15">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse15" aria-expanded="true" aria-controls="collapse15">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>How long does it take to know FIT results?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse15" class="collapse" aria-labelledby="heading15" data-parent="#accordion">
                            <div class="card-body pt-0 pt-0 pl-md-5">
                                Usually, FIT e-test results are released <b> two weeks</b> after completing the examinations in the schedule. But, it takes 2-3 weeks to publish the FIT practical test results.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 15 --}}

                    {{-- QUESTION 16 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading16">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse16" aria-expanded="true" aria-controls="collapse16">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>When will the practical test be held?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse16" class="collapse" aria-labelledby="heading16" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                If there is enough demand, the practical tests can also be held once a month. However, the time plan could vary depending on the demand and availability.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 16 --}}

                    {{-- QUESTION 17 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading17">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse17" aria-expanded="true" aria-controls="collapse17">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Do I have to pass to obtain the certificate?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse17" class="collapse" aria-labelledby="heading17" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                <b>Yes</b>, you have to pass relevant tests of the FIT programme to obtain the certificates. The pass mark for any e-Test or practical test will be 50 marks.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 17 --}}

                    {{-- QUESTION 18 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading18">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse18" aria-expanded="true" aria-controls="collapse18">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Do I have to do online course quizzes?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse18" class="collapse" aria-labelledby="heading18" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                These online quizzes are optional self-learning resources for registered students. Your marks or performances in online courses will not be considered when deciding your final grade. However, assignment quizzes are mandatory, and the students should pass these assignment quizzes before applying for the e-Tests.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 18 --}}

                    {{-- QUESTION 19 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading19">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse19" aria-expanded="true" aria-controls="collapse19">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Does my practice quiz marks will be counted for the final grade?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse19" class="collapse" aria-labelledby="heading19" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                <b>No</b>, practice quizzes or Assignments marks are not counted for the final grade in the course. The final grade of a course depends on your performance in the e-Tests and practical tests. However, assignment quizzes are mandatory, and you should pass these assignment quizzes before applying for the e-Tests.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 19 --}}

                    {{-- QUESTION 20 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading20">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse20" aria-expanded="true" aria-controls="collapse20">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Where can I take the FIT exams?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse20" class="collapse" aria-labelledby="heading20" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                You can take the FIT exams at the UCSC or online from home (if we conduct online tests).
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 20 --}}

                    {{-- QUESTION 21 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading21">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse21" aria-expanded="true" aria-controls="collapse21">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>If I am a repeat student (registered before {{ now()->year }}), do I have to follow the new syllabus when I take the next exam?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse21" class="collapse" aria-labelledby="heading21" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                <b>Yes</b>, There are no separate exams for students who registered before {{ now()->year }}.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 21 --}}

                    {{-- QUESTION 22 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading22">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse22" aria-expanded="true" aria-controls="collapse22">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Do I have to do all e-Tests at once?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse22" class="collapse" aria-labelledby="heading22" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                No, there is no such requirement. You can decide and do it in the way you like. However, if you register for all e-Tests, you can do all these three e-Tests on the same day.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 22 --}}
                {{-- //EXAMINATION --}} 

                
                {{-- REGISTRATION --}}    

                    <div class="row about-container" style="padding-top: 80px;">
                        <div class="col-lg-8 content order-lg-1 order-2">
                            <h2 class="title">Questions about FIT Registration</h2>
                        </div>
                    </div>

                    {{-- QUESTION 23 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading23">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse23" aria-expanded="true" aria-controls="collapse23">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Without doing FIT, can I register for BIT?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse23" class="collapse" aria-labelledby="heading23" data-parent="#accordion">
                            <div class="card-body pt-0 pt-0 pl-md-5">
                                <b>Yes</b>, you can. If you pass all three subjects in the Advanced Level exams, you can directly register for BIT programme without following the FIT
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 23 --}}

                    {{-- QUESTION 24 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading24">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse24" aria-expanded="true" aria-controls="collapse24">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>I have done similar courses, can I get FIT certificate?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse24" class="collapse" aria-labelledby="heading24" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                You have to sit for FIT e-Tests and practical tests to obtain the FIT certificate. You cannot claim the FIT certificate by submitting certificates of any similar courses.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 24 --}}

                    {{-- QUESTION 25 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading25">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse25" aria-expanded="true" aria-controls="collapse25">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>I have done courses similar to the FIT programme. Can I register for BIT?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse25" class="collapse" aria-labelledby="heading25" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                It is difficult to say since all similar courses are not acceptable. However, if you have done similar courses/study programmes, we recommend you to take FIT e-Tests and apply for BIT registration based on the results.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 25 --}}

                    {{-- QUESTION 26 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading26">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse26" aria-expanded="true" aria-controls="collapse26">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Other than FIT qualifications, are there conditions to register BIT?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse26" class="collapse" aria-labelledby="heading26" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                <b>Yes</b>, You must have completed, GCE (O/L) examination with credit passes for maths and English.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 26 --}}

                    {{-- QUESTION 27 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading27">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse27" aria-expanded="true" aria-controls="collapse27">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>How to apply/register FIT programme?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse27" class="collapse" aria-labelledby="heading27" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                You have to register for the FIT programme via FIT information system  <a href="{{url('#registration')}}">https://reg.fit.bit.lk</a>. First, create an account by providing a valid email address. 
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 27 --}}

                    {{-- QUESTION 28 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading28">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse28" aria-expanded="true" aria-controls="collapse28">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>When can I register for the FIT?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse28" class="collapse" aria-labelledby="heading28" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                Students can register for the FIT programme at any time of the year. The registration period will expire after 365 calendar days from the registration date.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 28 --}}

                    {{-- QUESTION 29 --}}
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-bottom-0" id="heading29">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse29" aria-expanded="true" aria-controls="collapse29">
                                <h4 class="mb-0"><i class="fa fa-question-circle pr-3"></i>Do I have to come to the UCSC to register?</h4>
                            </button>
                        </div>
                    
                        <div id="collapse29" class="collapse" aria-labelledby="heading29" data-parent="#accordion">
                            <div class="card-body pt-0 pl-md-5">
                                <b>No</b>, you do not have to come to the UCSC to register. You can register online via FIT information system (reg.fit.bit.lk).  However, it takes 2-7 working days to validate your payments provide you access to the FITVLE.
                            </div>
                        </div>
                    </div>
                    {{-- //QUESTION 29 --}}


                {{-- //REGISTRATION --}}                  

            </div>
            {{-- //accordion --}}

        </section>
        {{-- //FAQ --}}

    </main>
@endsection