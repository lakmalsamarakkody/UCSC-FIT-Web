<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>FIT - UCSC</title>

        <!-- SCRIPTS -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- /SCRIPTS -->
    
        <!-- STYLES -->
            <!-- BOOTSTRAP -->      <link rel="stylesheet" href="{{ asset('css/app.css') }}" >
            <!-- LINE AWESOME -->   <link rel="stylesheet" href="{{ asset('css/line-awesome/css/line-awesome.css') }}">
        <!-- /STYLES -->

    </head>

    <body>

        <!-- NAVIGATION -->
        <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-right text-white bg-dark">Login</div>
            <div class="col-12 text-center"><h4>Foundation In Information Technology</h4></div>

            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="home">Home</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav ml-auto">
                            <!-- <a class="nav-link active" href="#">Home <span class="sr-only">(current)</span></a> -->
                            <a class="nav-link" href="test">Programme</a>
                            <a class="nav-link" href="#">Registration</a>
                            <a class="nav-link" href="#">Learning</a>
                            <a class="nav-link" href="#">Examination</a>
                            <a class="nav-link" href="#">Contact Us</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        </div>
        <!-- /NAVIGATION -->

        @yield('content')

    </body>
</html>