@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#information').addClass("active");
    });

</script>

    <!-- CONTENT -->
    <div class="col-lg-12 information min-vh-100">
        <div class="row">
            <div class="col-12">        
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading"><i class="far fa-check-circle"></i> Succefully Changed Your E-mail! </h4>
                    <p>Please Wait, You will be redirected back to information Page soon!</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- /CONTENT -->
<script>
           setTimeout(function(){
            window.location.href = "{{ route('student.information') }}";
         }, 5000);  
</script>

@endsection



