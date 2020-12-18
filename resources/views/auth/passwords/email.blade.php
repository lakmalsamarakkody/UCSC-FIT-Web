@extends('layouts.web')

@section('content')


<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#login_nav').addClass("menu-active");
    });

</script>

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero" style="background-image: url({{ asset('img/background/back.jpg') }}); height:200px">
        <div class="page-hero-container">
            <h1 style="padding-top:30px">Forget Password</h1>
        </div>
    </section><!-- #hero -->

<main id="main">
    <section id="registration" style="padding-top: 80px;">
        <div class="row about-container mb-5 pb-5">
            <div class="col-lg-7 background order-lg-1 order-2 pb-5"  style="background-image: url({{ asset('img/logo/login.png') }});">


            </div>
            <div class="col-lg-5 content order-lg-2 order-1">
                <div class="p-5 form">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 form-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-12 text-center">
                                <button id="submit" type="submit" class="">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                                                
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
