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
            <h1 style="padding-top:30px">Login to FIT Student Information System</h1>
        </div>
    </section><!-- #hero -->

<main id="main">
    <section id="registration" style="padding-top: 80px;">
        <div class="row about-container mb-5 pb-5">
            <div class="col-lg-7 background order-lg-1 order-2 pb-5"  style="background-image: url({{ asset('img/logo/login.png') }});">


            </div>
            <div class="col-lg-5 content order-lg-2 order-1">
                <div class="p-5 form">
                    <form method="POST" action="{{ route('login') }}" class="contactForm">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 form-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 form-label">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                <span toggle="#password-field" class="fa fa-fw fa-eye toggle-password text-dark" style="float: right; margin-right: 10px; margin-left: -25px; margin-top: -21px; position: relative; z-index: 2; cursor: pointer;"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pt-4">
                            <div class="col-md-12 text-right">
                                <div class="form-check">
                                    <input class="form-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-label pl-4" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-12 text-center">
                                <button id="submit" type="submit" class="">
                                    {{ __('Login') }}
                                </button>

                            </div>
                        </div>
                    </form>

                    <div class="col-lg-12 text-center">
                        <a class="btn btn-link form-label" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>

                    </div>
                                                
                </div>

                <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
                    <a href="{{ url('/registration') }}"><div class="icon"><i class="fa fa-hand-point-right"></i></div></a>
                    <h4 class="title"><a href="{{ url('/registration') }}">Don't have an account yet?</a></h4>
                    <p class="description">How to Register for FIT Programme</p>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $('#password');
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
@endsection
