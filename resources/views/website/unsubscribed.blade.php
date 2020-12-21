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

        <div class="col-12 min-vh-100">
            <h1 class="text-center py-5">{{ $email }} has ben Unsubscribed from the future FIT updates!</h1>
        </div>

    </main>
@endsection