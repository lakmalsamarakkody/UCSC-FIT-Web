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
    <div class="col-lg-12 dashboard">
        <div class="row justify-content-center">
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
                
                <h5 class="alert-heading text-right">Registration expires on: {{ $registration->registration_expire_at }}</h5>                
                <hr>
            </div>
            @endif

        <!-- SUMMARY CARDS -->
        @if($registration->application_submit)        
        <div class="col-lg-4  p-1 w-100">        
                <div class="card card-dash shadow red-none @if($registration->application_status == null) yellow @elseif($registration->application_status == 'Approved') green @else red @endif" style="">
                
                    <div class="card-header bg-transparent text-white"><h1>Application <br> Status</h1></div>
                    <div class="card-body p-0 my-0 ">
                    <div class="card-title text-right ">
                        <span class="badge shadow badge-pill @if($registration->application_status == null) badge-warning @elseif($registration->application_status == 'Approved') badge-success @else 'badge-danger' @endif  mr-3">{{ $registration->application_status ?? 'Pending' }}</span></div>
                    </div>
                </div>
        </div>
        @else
        <div class="col-lg-4  p-1 w-100">        
            <a class="" href="{{ route('student.registration') }}">
                <div class="card card-dash shadow red-none bg-danger" style="">
                
                    <div class="card-header bg-transparent text-center text-white p-0 py-5"><h3>Submit Application</h1></div>
                    <div class="card-body p-0 my-0 ">
                    </div>
                </div>
            </a>
        </div>
        @endif

        @if($registration->payment_id )        
        <div class="col-lg-4  p-1 w-100">        
                <div class="card card-dash shadow red-none @if($registration->payment_status == null) yellow @elseif($registration->payment_status == 'Approved') green @else red @endif" style="">
                
                    <div class="card-header bg-transparent text-white"><h1>Payments <br> Status</h1></div>
                    <div class="card-body p-0 my-0 ">
                    <div class="card-title text-right ">
                        <span class="badge shadow badge-pill @if($registration->payment_status == null) badge-warning @elseif($registration->payment_status == 'Approved') badge-success @else 'badge-danger' @endif  mr-3">{{ $registration->payment_status ?? 'Pending' }}</span></div>
                    </div>
                </div>
        </div>
        @else
        <div class="col-lg-4  p-1 w-100">        
            <a class="" href="{{ route('payment.registration') }}">
                <div class="card card-dash shadow red-none bg-danger" style="">
                
                    <div class="card-header bg-transparent text-center text-white p-0 py-5"><h3>Complete  your Payment</h1></div>
                    <div class="card-body p-0 my-0 ">
                    </div>
                </div>
            </a>
        </div>
        @endif

        @if($registration->document_submit )        
        <div class="col-lg-4  p-1 w-100">        
                <div class="card card-dash shadow red-none @if($registration->document_status == null) yellow @elseif($registration->document_status == 'Approved') green @else red @endif" style="">
                
                    <div class="card-header bg-transparent text-white"><h1>Document <br> Status</h1></div>
                    <div class="card-body p-0 my-0 ">
                    <div class="card-title text-right ">
                        <span class="badge shadow badge-pill @if($registration->document_status == null) badge-warning @elseif($registration->document_status == 'Approved') badge-success @else 'badge-danger' @endif  mr-3">{{ $registration->document_status ?? 'Pending' }}</span></div>
                    </div>
                </div>
        </div>
        @else
        <div class="col-lg-4  p-1 w-100">        
            <a class="" href="{{ route('document.registration') }}">
                <div class="card card-dash shadow red-none bg-danger" style="">
                
                    <div class="card-header bg-transparent text-center text-white p-0 py-5"><h3>Submit Documents</h1></div>
                    <div class="card-body p-0 my-0 ">
                    </div>
                </div>
            </a>
        </div>
        @endif

        <!-- SUMMARY CARDS -->
        {{-- <h5 class="col-12 title font-weight-bold mt-5 px-0">EXAMS</h5>

        <div class="col-lg-6 col-md-12 px-1">
            <a class="" href="{{ route('exams') }}" style="height: 30rem;">
              <div class="card" style="height: 30rem;">
                <div class="card-header">Upcoming Exams</div>
                <div class="card-body px-0">
                  <table class="table yajra-datatable ">
                    <thead class="text-center">
                        <tr>
                          <th>Date</th>
                          <th>Subject</th>
                          <th>Exam Type</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($upcomingExams as $upcomingExam)
                        <tr class="text-center">
                          <td>{{ $upcomingExam->date }}</td>
                          <td>{{ $upcomingExam->subject->name }}</td>
                          <td>{{ $upcomingExam->type->name }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                
                <div class="card-footer text-right">
                  View <i class="fa fa-arrow-alt-circle-right"></i>
                </div>
            
              </div>
            </a>
        </div>

        <div class="col-lg-6 col-md-12 px-1">
            <a class="" href="{{ route('exams') }}" style="height: 30rem;">
              <div class="card overflow-auto" style="height: 30rem;">
                <div class="card-header">Exams Held</div>
                <div class="card-body px-0">
                  <table class="table yajra-datatable ">
                    <thead class="text-center">
                        <tr>
                          <th>Date</th>
                          <th>Subject</th>
                          <th>Subject</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($heldExams as $heldExam)
                        <tr class="text-center">
                          <td>{{ $heldExam->date }}</td>
                          <td>{{ $heldExam->subject->name }}</td>
                          <td>{{ $heldExam->type->name }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                
                <div class="card-footer text-right">
                  View <i class="fa fa-arrow-alt-circle-right"></i>
                </div>
            
              </div>
            </a>
        </div> --}}
        </div>
    </div>
    <!-- /CONTENT -->
    @endif

    @include('portal.student.home.scripts')

@endsection



