@extends('layouts/web')
@section('content')

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/back.jpg') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">All Announcements</h1>
        </div>
    </section><!-- #hero -->

    <main id="main">

        {{-- FAQ --}}
        <section id="faq">
            
            {{-- ABOUT FIT --}}
            <div class="row about-container" style="padding-top: 80px;">
                <div class="col-lg-8 content order-lg-1 order-2">
                    <h3 class="title"><a href="{{ url('/') }}">Back to Home</a></h3>
                </div>
            </div>

            <div class="row  about-container pt-5">
                <div class="col-lg-12 content order-lg-1 order-1">  
                    <ul>
                        @foreach($announcements as $anouncement)
                            <li>
                                <h3><a href="{{ $anouncement->link }}">{{ $anouncement->title }}</a></h3>          
                                <p class="description text-right">{{ \Carbon\Carbon::parse($anouncement->created_at)->format('M d Y') }}</p>
                            </li>  
                            <hr>                          
                        @endforeach 

                    </ul> 
                    <div class="icon-box wow fadeInUp" data-wow-delay="0.2s"  style="padding-top: 70px;">
                        <a href="{{ url('/') }}"><div class="icon"><i class="fa fa-home"></i></div></a>
                        <h4 class="title"><a href="{{ url('/') }}">Home</a></h4>
                        <p class="description">Back to Home</p>
                      </div>
                </div>
            </div>


        </section>
        {{-- //FAQ --}}

    </main>
@endsection