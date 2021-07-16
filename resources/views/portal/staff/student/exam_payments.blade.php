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
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Exam Paymentss</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->

    <!-- CONTENT -->
    
    <div class="col-12 exam-application min-vh-100">
      <div class="row">
          
        <!-- APPLICATIONS LIST -->
        <div class="col-12 md-5">
          <div class="card">
            <div class="card-header">Exam Payments</div>
            <div class="card-body">
              @if($exam_applicants->isEmpty())
                <div class="alert alert-info" role="alert">No results found!</div>
              @else
                @if(Auth::user()->hasPermission('staff-dashboard-exam-application-approveSchedules'))
                  <div class="row px-3 mb-3"><div class="ml-auto text-right"><button id="btnApproveAll" class="btn btn-danger" onclick="ApproveAll()"><i class="fas fa-exclamation-triangle"> </i> Approve All</button></div></div>
                @endif
                <table class="table yajra-datatable">
                  {{-- <thead>
                    <tr>
                      <th>Registration No</th>
                      <th>Student Name</th>
                      <th>Date Applied</th>
                      <th></th>
                    </tr>
                  </thead> --}}
                  <tbody>
                    <div class="card">
                      {{-- E-TEST LIST --}}
                      <tr><th colspan="4" class="card-header font-weight-bold text-white bg-dark">E-tests</th></tr>
                      {{-- APPLIED ALL --}}
                      <tr><th colspan="4" class="card-header font-weight-bold text-white bg-secondary">Applied All Subjects</th></tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',1)->where('payment_id',$applicant->payment_id)->count() >= 3)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ $applicant->created_at->isoFormat('YYYY-MM-DD') }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"><i class="fas fa-user"></i> View <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ALL --}}
                      {{-- APPLIED ONLY 2 SUBJECTS --}}
                      <tr><th colspan="4" class="card-header font-weight-bold text-white bg-secondary">Applied 02 Subjects</th></tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',1)->where('payment_id',$applicant->payment_id)->count() == 2)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ $applicant->created_at->isoFormat('YYYY-MM-DD') }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"><i class="fas fa-user"></i> View <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ONLY 2 SUBJECTS --}}
                      {{-- APPLIED ONLY 1 SUBJECT --}}
                      <tr><th colspan="4" class="card-header font-weight-bold text-white bg-secondary">Applied only 01 Subject</th></tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',1)->where('payment_id',$applicant->payment_id)->count() == 1)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ $applicant->created_at->isoFormat('YYYY-MM-DD') }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"><i class="fas fa-user"></i> View <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ONLY 1 SUBJECT --}}
                      {{-- /E-TEST LIST --}}
                      {{-- PRACTICAL LIST --}}
                      <tr><th colspan="4"></th></tr>
                      <tr><th colspan="4"></th></tr>
                      <tr><th colspan="4" style="cell-padding:50px" class="card-header font-weight-bold text-white bg-dark">Practicals</th></tr>
                      {{-- APPLIED ALL --}}
                      <tr><th colspan="4" class="card-header font-weight-bold text-white bg-secondary">Applied All</th></tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',2)->where('payment_id',$applicant->payment_id)->count() >= 2)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ $applicant->created_at->isoFormat('YYYY-MM-DD') }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"><i class="fas fa-user"></i> View <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ALL --}}
                      {{-- APPLIED ONLY 1 SUBJECT --}}
                      <tr><th colspan="4" class="card-header font-weight-bold text-white bg-secondary">Applied only 01 Practical</th></tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',2)->where('payment_id',$applicant->payment_id)->count() == 1)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ $applicant->created_at->isoFormat('YYYY-MM-DD') }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"><i class="fas fa-user"></i> View <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ONLY 1 SUBJECT --}}
                      {{-- /PRACTICAL LIST --}}
                    </div>
                  </tbody>
                </table>
              @endif

            </div>
          </div>
        </div>
        <!-- /APPLICATIONS LIST -->

      </div>
      @include('portal.staff.student.exam_application.modal')
      @include('portal.staff.student.exam_application.scripts')
    </div>
    <!-- /CONTENT -->

@endsection
