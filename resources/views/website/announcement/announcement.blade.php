@extends('layouts/web')
@section('content')

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/back.jpg') }}); height:200px">
        <div class="page-hero-container">
            <h1 class="pt-5" style="font-size: 36px;">announcement</h1>
        </div>
    </section><!-- #hero -->

    <main id="main" class="min-vh-100">

        {{-- ANNOUNCEMENT --}}
        <section id="announcement" class="px-3 px-md-5">
            
            {{-- ANNOUNCEMENT AREA --}}
              <div class="row justify-content-center about-container pt-md-5 pt-3">
                    <div class="col-lg-12 text-right">Announced on - {!! \Carbon\Carbon::parse($announcement->created_at)->isoFormat('MMMM Do YYYY, h:mm A') !!}</div>
                    <div class="col-lg-12 text-right">Last updated - {!! \Carbon\Carbon::parse($announcement->updated_at)->isoFormat('MMMM Do YYYY, h:mm A') !!}</div>
                    <div class="col-lg-12 title text-center pt-4"><h1 class="font-weight-bolder">{!! $announcement->title !!}</h1></div>
                <div class="col-lg-12 content order-lg-1 order-1">
                    {{-- ANNOUNCEMENT --}}
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-10 col-12" id="announcementDiscription">
                            {!! $announcement->description !!}
                        </div>
                        {{-- <a class="col-12 btn-link" href="@if($announcement->button_link!=Null){{ route($announcement->button_link) }}@endif"><h3 class="title text-center mt-5">{{ $announcement->button_text }}</h3></a>      --}}
                        {{-- <img class="col-lg-6" src="{{ asset('storage/announcements/'.$announcement->image) }}" width="100%" alt=""> --}}
                        {{-- <a class="col-12 btn-link" href="@if($announcement->button_link!=Null){{ route($announcement->button_link) }}@endif"><h3 class="title text-center mt-5">{{ $announcement->button_text }}</h3></a> --}}
                    </div>
                    {{-- ANNOUNCEMENT --}}
                    <div class="icon-box wow fadeInUp" data-wow-delay="0.2s"  style="padding-top: 70px;">
                        <a href="{{ url('/announcements') }}"><div class="icon"><i class="fas fa-bullhorn"></i></div></a>
                        <h4 class="title"><a href="{{ url('/announcements') }}">Announcements</a></h4>
                        <p class="description">Back to All Announcements</p>
                    </div>
                    <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
                        <a href="{{ url('/') }}"><div class="icon"><i class="fa fa-home"></i></div></a>
                        <h4 class="title"><a href="{{ url('/') }}">Home</a></h4>
                        <p class="description">Back to Home</p>
                    </div>
                </div>
            </div>
            {{-- ANNOUNCEMENT AREA --}}
        </section>
        {{-- //ANNOUNCEMENT --}}

    </main>
@endsection