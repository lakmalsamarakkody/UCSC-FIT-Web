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
        <div class="col-xl-2 col-lg-4 col-md-6 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-registration-application-view') && $applicationCount>0 )
          <a href="{{ route('student.application') }}">
          @endif
            <div class="card card-dash shadow green-none bg-primary h-100">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $applicationCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>New <br/> Applicants</h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-registration-application-view') && $applicationCount>0 ) View <i class="fa fa-arrow-alt-circle-right">@else <i>&nbsp;@endif</i></div>
            </div>
          </a>
        </div>
        
        <div class="col-xl-2 col-lg-4 col-md-6 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-registration-review-payment-view') && $paymentReviewCount>0 )
          <a href="{{ route('student.application.reviewRegPayment') }}">
          @endif
            <div class="card h-100 card-dash shadow red-none bg-main-warning">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $paymentReviewCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1> Review <br/> Payments</h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-registration-review-payment-view') && $paymentReviewCount>0 ) View <i class="fa fa-arrow-alt-circle-right">@else <i>&nbsp;@endif</i></div>
            </div>
          </a>
        </div>

        <div class="col-xl-2 col-lg-4 col-md-6 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-registration-pending-documents-view') && $documentPendingCount>0 )
          <a href="{{ route('student.application.reviewRegDocumentsPending') }}">
          @endif
            <div class="card h-100 card-dash shadow black-none bg-primary">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $documentPendingCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1> Pending <br/> Documents</h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-registration-pending-documents-view') && $documentPendingCount>0 ) View <i class="fa fa-arrow-alt-circle-right">@else <i>&nbsp;@endif</i></div>
            </div>
          </a>
        </div>

        <div class="col-xl-2 col-lg-4 col-md-6 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-registration-review-documents-view') && $documentReviewCount>0 )
          <a href="{{ route('student.application.reviewRegDocuments') }}">
          @endif
            <div class="card h-100 card-dash shadow yellow-none bg-main-warning">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $documentReviewCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1> Review <br/> Documents </h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-registration-review-documents-view') && $documentReviewCount>0 ) View <i class="fa fa-arrow-alt-circle-right">@else <i>&nbsp;@endif</i></div>
            </div>
          </a>
        </div>
        
        <div class="col-xl-2 col-lg-4 col-md-6 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-registration-pending-registrations-view') && $pendingRegistration>0 )
          <a href="{{ route('student.application.reviewRegistration') }}">
          @endif
            <div class="card h-100 card-dash shadow red-none bg-danger">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $pendingRegistration }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Pending <br/> Registrations</h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-registration-pending-registrations-view') && $pendingRegistration>0 ) View <i class="fa fa-arrow-alt-circle-right">@else <i>&nbsp;@endif</i></div>
            </div>
          </a>
        </div>

        <div class="col-xl-2 col-lg-4 col-md-6 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-registration-active-registrations-view') && $totalRegistered>0 )
          <a href="{{ route('students') }}">
          @endif
            <div class="card h-100 card-dash shadow black-none bg-success">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $totalRegistered }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Active <br/> Registrations</h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-registration-active-registrations-view') && $totalRegistered>0 ) View <i class="fa fa-arrow-alt-circle-right">@else <i>&nbsp;@endif</i></div>
            </div>
          </a>
        </div>
        <!-- /SUMMARY CARDS(REGISTRATION) -->
      </div>

      {{-- SUMMARY CARDS(EXAMS) --}}
      <div class="row">
        <h5 class="col-12 title font-weight-bold mt-5 px-0">EXAMS</h5>

        <div class="col-lg-2 col-md-6 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-exam-review-payments-view') && $examPaymentReviewCount>0 )
          <a href="{{ route('student.application.exams.payments') }}">
          @endif
            <div class="card h-100 card-dash shadow yellow-none bg-main-warning">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $examPaymentReviewCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Review <br/> Payments </h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-exam-review-payments-view') && $examPaymentReviewCount>0 ) View <i class="fa fa-arrow-alt-circle-right">@else <i>&nbsp;@endif</i></div>
            </div>
          </a>
        </div>

        <div class="col-lg-2 col-md-6 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-exam-assign-schedules-view') && $revieweExamsToScheduleCount>0 )
          <a href="{{ route('student.application.exams') }}">
          @endif
            <div class="card h-100 card-dash shadow red-none bg-danger">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $revieweExamsToScheduleCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Assign <br/> Exam Schedules </h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-exam-assign-schedules-view') && $revieweExamsToScheduleCount>0 ) View <i class="fa fa-arrow-alt-circle-right">@else <i>&nbsp;</i>@endif</div>
            </div>
          </a>
        </div>

        <div class="col-lg-2 col-md-6 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-exam-review-medicals-view') && $medicalReviewCount>0 )
          <a href="{{ route('student.exams.medical') }}">
          @endif
            <div class="card h-100 card-dash shadow yellow-none bg-main-warning">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $medicalReviewCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Review <br> Medicals </h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-exam-review-medicals-view') && $medicalReviewCount>0 ) View <i class="fa fa-arrow-alt-circle-right">@else <i>&nbsp;@endif</i></div>
            </div>
          </a>
        </div>

        <div class="col-lg-2 col-md-6 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-exam-review-reschedules-view') && $rescheduleReviewCount>0 )
          <a href="{{ route('student.exams.reschedule.requests') }}">
          @endif
            <div class="card h-100 card-dash shadow yellow-none bg-main-primary">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $rescheduleReviewCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Reschedule <br> Requests </h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-exam-review-reschedules-view') && $rescheduleReviewCount>0 ) View <i class="fa fa-arrow-alt-circle-right">@else <i>&nbsp;@endif</i></div>
            </div>
          </a>
        </div>

        <div class="col-lg-2 col-md-6 p-1">
          @if(Auth::user()->hasPermission('staff-dashboard-exam-reschedule-exams-view') && $examToRescheduleCount>0 )
          <a href="{{ route('student.exams.reschedule') }}">
          @endif
            <div class="card h-100 card-dash shadow red-none bg-danger">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">{{ $examToRescheduleCount }}</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Reschedule <br> Exams </h1></div>
              <div class="card-footer bg-transparent text-right">@if(Auth::user()->hasPermission('staff-dashboard-exam-reschedule-exams-view') && $examToRescheduleCount>0 ) View <i class="fa fa-arrow-alt-circle-right">@else <i>&nbsp;@endif</i></div>
            </div>
          </a>
        </div>
      </div>
      {{-- /SUMMARY CARDS(EXAMS) --}}
      

      {{-- EXAMS --}}
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
      {{-- EXAMS --}}

      {{-- LAST LOGINS --}}
      <div class="row mt-3">
        <div class="col-12 px-1">

          <div class="card">
            <div class="card-header">Recent logins</div>
            <div class="card-body px-0">
              <table class="table table-hover">
                <thead class="text-center">
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Recent Activity</th>
                      <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($lastLogins as $lastLogin)
                    <tr class="text-center">
                      {{-- <td>{{ $lastLogin->id }}</td> --}}
                      <td>{{ $lastLogin->name }}</td>
                      <td>{{ $lastLogin->email }}</td>
                      <td> {{ Carbon\Carbon::create($lastLogin->last_login)->isoFormat('YYYY-MM-DD HH:mm:ss')  }}</td>
                      <td class="text-right">
                        @if(Auth::user()->hasPermission("staff-student-profile") && Auth::user()->hasStudent($lastLogin->id))
                          <a onclick="view_student('{{ $lastLogin->student->id }}');" title="View Student Profile" data-tooltip="tooltip"  data-placement="bottom"  type="button" class="btn btn-outline-info"><i class="fas fa-user-graduate"></i></a>
                        @endif
                        @if(Auth::user()->hasPermission("staff-user-profile-view"))
                          <a onclick="view_profile({{ $lastLogin->id }});" title="View User Profile" data-tooltip="tooltip" data-placement="bottom" type="button" class="btn btn-outline-primary"><i class="fas fa-user"></i></a>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>        
          </div>

        </div>
      </div>
      {{-- /LAST LOGINS --}}

    </div>
    <!-- /CONTENT -->
    @include('portal.staff.home.scripts')
@endsection
