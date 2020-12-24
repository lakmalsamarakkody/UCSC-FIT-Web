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
                <li><a href="{{ url('/') }}">Home</a>
                    <ul>
                        <li><a href="{{ url('/') }}">Announcements</a></li>
                       <li><a href="{{ url('/#about') }}">About Us</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/programme') }}">Programe</a>
                    <ul>
                        <li><a href="{{ url('/programme/#103') }}">About FIT 103: ICT Applications</a></li>
                        <li><a href="{{ url('/programme/#203') }}">About FIT 203: English for ICT</a></li>
                        <li><a href="{{ url('/programme/#303') }}">About FIT 303: Mathematics for ICT</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/learning') }}">Learning</a>
                    <ul>
                        <li><a href="{{ url('/learning') }}">Go to Virtual Learning Environment(VLE)</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/examination') }}">Examination</a>
                    <ul>
                        <li><a href="{{ url('/examination') }}">Examination details</a></li>
                        <li><a href="{{ url('/examination') }}">Apply for Exams</a></li>
                        <li><a href="{{ url('/examination/#contact') }}">Contact UCSC e-Testing Lab</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/registration') }}">Registration</a>
                    <ul>
                        <li><a href="{{ url('/registration') }}">Registration details</a></li>
                        <li><a href="{{ url('/registration') }}">Signup with Email</a></li>
                        <li><a href="{{ url('/registration') }}">If Registered, Login</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/contact') }}">Contact Us</a>
                    <ul>
                        <li><a href="{{ url('/contact') }}">Administration Matters</a></li>
                        <li><a href="{{ url('/contact') }}">e-Leaning Services</a></li>
                        <li><a href="{{ url('/contact') }}">Academic Matters</a></li>
                        <li><a href="{{ url('/contact') }}">Complaints</a></li>
                        <li><a href="{{ url('/contact') }}">Google Map Link to UCSC, Colombo, Sri Lanka</a></li>                        
                    </ul>
                </li>
                <li><a href="{{ url('/downloads') }}">Downloads</a></li>
                <li><a href="{{ url('/faq') }}">Frequently Asked Questions</a></li>
                <li><a href="{{ url('/announcements') }}">Announcements</a></li>
            </ul>
        </div>

    </main>
@endsection