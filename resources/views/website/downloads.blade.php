@extends('layouts/web')
@section('content')

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/back.jpg') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">Downloads</h1>
        </div>
    </section><!-- #hero -->

    <main id="main">

    <section id="programme" style="padding-top: 80px;">
        
        <div class="row about-container" style="padding-top: 30px;">
            <div class="myBox col-lg-3 background order-lg-2 order-2 wow fadeInup" style="background-image: url({{ asset('img/logo/fit103.png') }});  cursor: pointer;">
                <a target="_blank" class="" href="{{ asset('documents/FIT-103/FIT-103-Fundamentals_of_Computing.pdf') }}"></a>
            </div>
            <div class="myBox col-lg-3 background order-lg-1 order-2 wow fadeInup" style="background-image: url({{ asset('img/logo/fit203.png') }});  cursor: pointer;">
                <a target="_blank" href="{{ asset('documents/FIT-203/FIT-203-English_for_Computing.pdf') }}"></a>
            </div>
            <div class="myBox col-lg-3 background order-lg-2 order-2 wow fadeInRight" style="background-image: url({{ asset('img/logo/fit303.png') }}); cursor: pointer;">
                <a target="_blank"  href="{{ asset('documents/FIT-303/FIT-303-Mathematics_for_Computing.pdf') }}"></a>
            </div>
            <div class="myBox col-lg-3 background order-lg-2 order-2 wow fadeInRight" style="background-image: url({{ asset('img/logo/payment.png') }}); cursor: pointer;">
                <a target="_blank"  href="{{ asset('documents/Payment_Voucher.pdf') }}"></a>
            </div>
        </div>
        
    </section>

    </main>
@endsection