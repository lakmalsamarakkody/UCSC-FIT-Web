@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#dashboard').addClass("active");
    });

</script>
    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->


    <!-- CONTENT -->
    <div class="col-lg-12 dashboard">
      <div class="row">

        <h5 class="col-12 title font-weight-bold px-0">REGISTRATIONS</h5>

        <!-- SUMMARY CARDS(REGISTRATION) -->
        <div class="col-xl-2 col-lg-4 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-registration-application-view'))
          <a href="{{ route('student.application') }}">
          @endif
            <div class="card card-dash shadow green-none bg-primary h-100" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $applicationCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>New <br/> Applicants</h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-registration-application-view')) View <i class="fa fa-arrow-alt-circle-right"></i>@endif</div>
            </div>
          </a>
        </div>
        
        <div class="col-xl-2 col-lg-4 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-registration-review-payment-view'))
          <a href="{{ route('student.application.reviewRegPayment') }}">
          @endif
            <div class="card h-100 card-dash shadow red-none bg-main-warning" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $paymentReviewCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1> Review <br/> Payments</h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-registration-review-payment-view')) View <i class="fa fa-arrow-alt-circle-right"></i>@endif</div>
            </div>
          </a>
        </div>

        <div class="col-xl-2 col-lg-4 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-registration-pending-documents-view'))
          <a href="{{ route('student.application.reviewRegDocumentsPending') }}">
          @endif
            <div class="card h-100 card-dash shadow black-none bg-primary" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $documentPendingCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1> Pending <br/> Documents</h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-registration-pending-documents-view')) View <i class="fa fa-arrow-alt-circle-right"></i>@endif</div>
            </div>
          </a>
        </div>

        <div class="col-xl-2 col-lg-4 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-registration-review-documents-view'))
          <a href="{{ route('student.application.reviewRegDocuments') }}">
          @endif
            <div class="card h-100 card-dash shadow yellow-none bg-main-warning" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $documentReviewCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1> Review <br/> Documents </h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-registration-review-documents-view')) View <i class="fa fa-arrow-alt-circle-right"></i>@endif</div>
            </div>
          </a>
        </div>
        
        <div class="col-xl-2 col-lg-4 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-registration-pending-registrations-view'))
          <a href="{{ route('student.application.reviewRegistration') }}">
          @endif
            <div class="card h-100 card-dash shadow red-none bg-danger" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $pendingRegistration }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Pending <br/> Registrations</h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-registration-pending-registrations-view')) View <i class="fa fa-arrow-alt-circle-right"></i>@endif</div>
            </div>
          </a>
        </div>

        <div class="col-xl-2 col-lg-4 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-registration-active-registrations-view'))
          <a href="{{ route('students') }}">
          @endif
            <div class="card h-100 card-dash shadow black-none bg-success" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $totalRegistered }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Active <br/> Registrations</h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-registration-active-registrations-view')) View <i class="fa fa-arrow-alt-circle-right"></i>@endif</div>
            </div>
          </a>
        </div>
        <!-- /SUMMARY CARDS(REGISTRATION) -->
      </div>

      {{-- SUMMARY CARDS(EXAMS) --}}
      <div class="row">
        <h5 class="col-12 title font-weight-bold mt-5 px-0">EXAMS</h5>

        <div class="col-xl-2 col-lg-4 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-exam-review-payments-view'))
          <a href="{{ route('student.application.exams.payments') }}">
          @endif
            <div class="card h-100 card-dash shadow yellow-none bg-main-warning" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $examPaymentReviewCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Review <br/> Payments </h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-exam-review-payments-view')) View <i class="fa fa-arrow-alt-circle-right"></i>@endif</div>
            </div>
          </a>
        </div>

        <div class="col-xl-2 col-lg-4 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-exam-assign-schedules-view'))
          <a href="{{ route('student.application.exams') }}">
          @endif
            <div class="card h-100 card-dash shadow red-none bg-danger" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $revieweExamsToScheduleCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Assign <br/> Exam Schedules </h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-exam-assign-schedules-view')) View <i class="fa fa-arrow-alt-circle-right"></i>@endif</div>
            </div>
          </a>
        </div>

        <div class="col-xl-2 col-lg-4 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-exam-review-medicals-view'))
          <a href="{{ route('student.exams.medical') }}">
          @endif
            <div class="card h-100 card-dash shadow yellow-none bg-main-warning" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $medicalReviewCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Review <br> Medicals </h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-exam-review-medicals-view')) View <i class="fa fa-arrow-alt-circle-right"></i>@endif</div>
            </div>
          </a>
        </div>

        <div class="col-xl-2 col-lg-4 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-exam-reschedule-exams-view'))
          <a href="{{ route('student.exams.reschedule') }}">
          @endif
            <div class="card h-100 card-dash shadow red-none bg-danger" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $examToRescheduleCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Reschedule <br> Exams </h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-exam-reschedule-exams-view')) View <i class="fa fa-arrow-alt-circle-right"></i>@endif</div>
            </div>
          </a>
        </div>
      </div>
      {{-- /SUMMARY CARDS(EXAMS) --}}
      
      <div class="row mt-3">        
        <div class="col-lg-6 col-md-12 px-1">
            <a href="{{ route('exams') }}" style="height: 30rem;">
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
            <a href="{{ route('exams') }}" style="height: 30rem;">
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
        </div>
      </div>




        <div class="col-lg-12">
          <span>
            &nbsp; <br>
            &nbsp; <br>
            &nbsp; <br>
          </span>
        </div>


      </div>
    </div>
    <!-- /CONTENT -->




@endsection
