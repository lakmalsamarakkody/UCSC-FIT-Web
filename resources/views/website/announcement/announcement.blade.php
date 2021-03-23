@extends('layouts/web')
@section('content')

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/back.jpg') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px; font-size: 36px;">{{ $announcement->title }}</h1>
        </div>
    </section><!-- #hero -->

    <main id="main">

        {{-- FAQ --}}
        <section id="faq">
            
            {{-- ABOUT FIT --}}
              <div class="row justify-content-center  about-container pt-5">
                <div class="col-lg-12 content order-lg-1 order-1">
                    <div class="row justify-content-center" id="announcementDiscription">
                        {{-- <a class="col-12 btn-link" href="@if($announcement->button_link!=Null){{ route($announcement->button_link) }}@endif"><h3 class="title text-center mt-5">{{ $announcement->button_text }}</h3></a>      --}}
                        <div class="col-lg-12 text-center">{!! $announcement->description !!} </div>               
                        {{-- <img class="col-lg-6" src="{{ asset('storage/announcements/'.$announcement->image) }}" width="100%" alt=""> --}}
                        {{-- <a class="col-12 btn-link" href="@if($announcement->button_link!=Null){{ route($announcement->button_link) }}@endif"><h3 class="title text-center mt-5">{{ $announcement->button_text }}</h3></a> --}}
                    </div>
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