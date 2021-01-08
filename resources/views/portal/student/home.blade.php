@extends('layouts.student_portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#information').addClass("active");
    });

</script>

    @if( $student != NULL )

    <!-- CONTENT -->
    <div class="col-lg-12 information">
        <div class="row">
            <h1>Home</h1>
        </div>
    </div>
    <!-- /CONTENT -->
    @endif

    @include('portal.student.home.scripts')

@endsection



