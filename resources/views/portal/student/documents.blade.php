@extends('layouts.student_portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#registration').addClass("active");
    });

</script>

    <!-- CONTENT -->
    <div class="col-lg-12 student-exams min-vh-100">
      <div class="row">

    @if($student->flag->payment_approve==0)
    <div class="col-12">
      <div class="alert alert-success border-success">
          <h4 class="my-4">Application Submitted</h4>
          <p style="font-weight: bold;">Please wait for Administrator Approval</p>
      </div>
    </div>
    @else
      <!-- UPCOMING EXAM SCHEDULE -->
      <div class="col-12 mt-4 px-0">
        <div class="card">
          <div class="card-header">Birth Cettificate</div>
          <div class="card-body">



          </div>
        </div>
      </div>
      <!-- /UPCOMING EXAM SCHEDULE-->

      <!-- APPLIED EXAMS TABLE -->
      <div class="col-12 mt-4 px-0">
        <div class="card">
          <div class="card-header">NIC</div>
          <div class="card-body">


          </div>
        </div>
      </div>
      <!-- /APPLIED EXAMS TABLE-->
    @endif




      </div>
    </div>
    <!-- /CONTENT -->
@endsection
