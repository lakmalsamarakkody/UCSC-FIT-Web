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
            <h1 style="padding-top:30px">Confirm Password</h1>
        </div>
    </section><!-- #hero -->

<main id="main">
    <section id="registration" style="padding-top: 80px;">
        <div class="row about-container mb-5 pb-5">
            <div class="col-lg-7 background order-lg-1 order-2 pb-5"  style="background-image: url({{ asset('img/logo/login.png') }});">


            </div>
            <div class="col-lg-5 content order-lg-2 order-1">
                <div class="p-5 form">
                    <h3 class="text-center">{{ __('Please confirm your password before continuing.') }}</h3>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-12 form-label">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                <button id="submit" type="submit" class="">
                                    {{ __('Confirm Password') }}
                                </button>
                            </div>
                                @if (Route::has('password.request'))
                                <div class="col-lg-12 text-center">
                                    <a class="btn btn-link form-label" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>

                                </div>
                                 @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

