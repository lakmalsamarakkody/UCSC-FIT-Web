@extends('layouts/web')
@section('content')

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/back.jpg') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">Site Map</h1>
        </div>
    </section><!-- #hero -->

    <main id="main">

        <div class="col-12 p-5">
            <ul class="site-map-list">
                <li><a href="">Home</a>
                    <ul>
                        <li><a href="">Announcements</a></li>
                       <li><a href="">About Us</a></li>
                    </ul>
                </li>
                <li><a href="">Programe</a>
                    <ul>
                        <li><a href="">About FIT 103: ICT Applications</a></li>
                        <li><a href="">About FIT 203: English for ICT</a></li>
                        <li><a href="">About FIT 303: Mathematics for ICT</a></li>
                    </ul>
                </li>
                <li><a href="">Learning</a>
                    <ul>
                        <li><a href="">Go to Virtual Learning Environment(VLE)</a></li>
                    </ul>
                </li>
                <li><a href="">Examination</a>
                    <ul>
                        <li><a href="">Examination details</a></li>
                        <li><a href="">Apply for Exams</a></li>
                        <li><a href="">Contact UCSC e-Testing Lab</a></li>
                    </ul>
                </li>
                <li><a href="">Registration</a>
                    <ul>
                        <li><a href="">Registration details</a></li>
                        <li><a href="">Signup with Email</a></li>
                        <li><a href="">If Registered, Login</a></li>
                    </ul>
                </li>
                <li><a href="">Contact Us</a>
                    <ul>
                        <li><a href="">Administration Matters</a></li>
                        <li><a href="">e-Leaning Services</a></li>
                        <li><a href="">Academic Matters</a></li>
                        <li><a href="">Complaints</a></li>
                        <li><a href="">Google Map Link to UCSC, Colombo, Sri Lanka</a></li>                        
                    </ul>
                </li>
                <li><a href="">Frequently Asked Questions</a></li>
                <li><a href="">Announcements</a></li>
            </ul>
        </div>

    </main>
@endsection