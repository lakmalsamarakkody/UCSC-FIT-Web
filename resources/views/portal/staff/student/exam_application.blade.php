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
              <li class="breadcrumb-item active" aria-current="page">Exam Applications</li>
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
            <div class="card-header">Exam Applicants</div>
            <div class="card-body">
              @if($exam_applicants->isEmpty())
                <div class="alert alert-info" role="alert">No results found!</div>
              @else
                <table class="table yajra-datatable">
                  <thead>
                    <tr>
                      <th>Registration No</th>
                      <th>Student Name</th>
                      <th>Date Applied</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($exam_applicants as $applicant)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ $applicant->created_at->isoFormat('YYYY-MM-DD') }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"><i class="fas fa-user"></i> View <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                            </div>
                          </td>
                          @endif
                        </tr>
                      @endforeach
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
