@extends('layouts.student_portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#home').addClass("active");
    });

</script>

    @if( $student != NULL )

    <!-- CONTENT -->
    <div class="col-lg-12 information">
        <div class="row">
            @if($student->reg_no == NULL)
            {{-- REGISTRATION  PENDING --}}
            <div class="col-12 px-0">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading"><i class="far fa-check-circle"></i> Complete Your Registration! </h4>
                    <p>Complete your registration to continue FIT. If your having any issues with the registration, please send an email to <a href="mailto:taw@ucsc.cmb.ac.lk">FIT Co-ordinator (taw@ucsc.cmb.ac.lk)</a></p>
                    <hr>
                    <a href="{{ route('student.registration') }}" class="px-0 btn btn-link ">Click here to Complete Registration</a>
                </div>
            </div>
            {{-- /REGISTRATION PENDING --}}
            @else
            <div class="col-12 px-0">
                <h4 class="alert-heading text-right">Registration Number: {{ $student->reg_no }}</h4>
                
                <hr>
            </div>
            @endif
        </div>
    </div>
    <!-- /CONTENT -->
    @endif

    @include('portal.student.home.scripts')

@endsection



