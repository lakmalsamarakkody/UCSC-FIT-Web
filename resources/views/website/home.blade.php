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
        <div class="hero-container">
            <div class="row container-fluid">
                <div class="col-lg-8 order-lg-1 order-1"> 
                    <img src="{{ asset('img/logo/invert-ucsc.png') }}" width="15%" /> 
            
                    <!-- <h1 style="text-align: left;"><span style="color:#7e6fff">F</span>oundation in <br> <span style="color:#23159c">I</span>nformation <br><span style="color:#23159c">T</span>echnology</h1> -->
                    <h1 style="text-align: left;">Foundation in <br> Information Technology</h1>
                    <h3 class="text-white">University of Colombo School of Computing</h3>
                    <a href="{{ url('/#about') }}" class="btn-get-started" style="width=25%">About FIT</a>
                </div>                
                <div class="col-lg-4 order-lg-2 order-2 announce mt-5 pb-5">
                    <h1 class="title px-4 text-white">Announcements</h1>
                    <div class="announcement wow fadeIn" data-wow-delay="0.2s">
                        <ul class="pb-2">
                            @foreach($anouncements as $anouncement)
                                @if($anouncement->created_at >= \Carbon\Carbon::today()->subDays(30))  
                                    <li>
                                        <p class="pr-4">
                                            <a href="{{ route('web.announcement', $anouncement->id) }}"><strong>{{ $anouncement->title }}</strong></a><br>
                                            <span class="float-right pr-4"><small>{{ \Carbon\Carbon::parse($anouncement->created_at)->isoFormat('MMMM DD, Y') }}</small></span> 
                                        </p>
                                        <hr color="grey">
                                    </li>
                                @else
                                    <li>
                                        <p class="pr-4">
                                            <a href="{{ route('web.announcement', $anouncement->id) }}">{{ $anouncement->title }}</a><br>
                                            <span class="float-right pr-4"><small>{{ \Carbon\Carbon::parse($anouncement->created_at)->format('M d Y') }}</small></span> 
                                        </p>
                                        <hr color="grey">
                                    </li>
                                @endif 

                            @endforeach
                        </ul>
                        <div class="announce-footer pb-0">
                            <p><a href="{{ url('/announcements') }}">View All Announcements</a></p>   
                        </div>                     
                    </div>
                </div>
            </div>
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
                    <p>The Foundation in Information Technology (FIT) programme <b>aims at enhancing the literacy and competency in using basic computer applications together with analytical thinking and communicational skills</b> required for school leavers. Hence, Mathematics and English Language for Information Communication Technology (ICT) are considered as two other important supporting subject domains.</p>
                    <p>FIT is a <b>pre-degree programme</b> that prepares students who are willing to read for their first degree. It is designed for anyone irrespective of the study streams they have followed in Advanced Level (secondary education. Recent statistics show many students who register for degree programmes fail due to lack of ICT competency, language skills and mathematical background. This tendency is very high in external degree programmes. Hence, FIT was designed to address these issues of undergraduate studies.</p>
                    <p>At the same time, FIT is an alternative qualification for students who do not posse A/L qualifications to enroll into the Bachelor of Information Technology (BIT) programme. However, those who register for BIT should have completed studies up to Ordinary Level in school curriculum.</p>
                    <p>FIT is also a certification programme for employment seekers or school leavers to justify their knowledge and skills in ICT for their future endeavors. University of Colombo School of Computing (UCSC), which is the most reputed higher education institute in the field of computer science and Information Communication Technology in Sri Lanka, will issue these certificates once you successfully complete relevant assessment of the FIT programme.</p>
                    <p>The FIT, Foundation in Information Technology, programme consists of three courses, namely,
                        <ul>
                            <li><p>ICT Applications (FIT 103)</p></li>
                            <li><p>English for ICT (FIT 203)</p></li>
                            <li><p>Mathematics for ICT (FIT 303)</p></li>
                        </ul>
                    <p>The students registered for the FIT programme will get access to a virtual learning environment <a href="https://fitvle.bit.lk/">(FITVLE)</a> that will help them to learn online. All e-tests are conducted via an e-testing system. The students will get access to this system when they take the e-tests. The students can start the programme at any time during the year, and they can apply for the examinations at any time when they are ready.</p>
                    
                    <div class="icon-box wow fadeInUp" data-wow-delay="0.2s"  style="padding-top: 80px;">
                      <a href="{{ url('/programme') }}"><div class="icon"><i class="fa fa-book"></i></div></a>
                      <h4 class="title"><a href="{{ url('/programme') }}">Programme</a></h4>
                      <p class="description">Go to Programme Structure</p>
                    </div>

                </div>

                <div class="col-lg-4 background order-lg-2 order-1 wow fadeInRight" style="background-image: url({{ asset('img/logo/fit.png') }}); margin-top: 100px"></div>
            </div>
        </section><!-- #about -->

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
                            At the moment, FIT is considered an alternative qualification to A/L for registration in the BIT programme. However, it is difficult to say about other programmes since conditions of registration vary from one to another. If any other university decides to consider FIT certification as an equivalent qualification to A/L for registration, we will announce them
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
                            When you have completed relevant e-Tests and practical tests successfully, you can apply to obtain a formal certificate by paying Rs. 500. All requests received before the first Monday of the last week of a month will be processed and the certificate will be issued during the first week of next month.
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

            </div>

        </section>
        {{-- //FAQ --}}

    </main>

@endsection