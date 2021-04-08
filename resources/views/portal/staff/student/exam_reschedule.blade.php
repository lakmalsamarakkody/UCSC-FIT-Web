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
              <li class="breadcrumb-item active" aria-current="page">Exam Reschedule</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->

    <!-- CONTENT -->
    
    <div class="col-12 exam-reschedule">
      <div class="row">
          
        <!-- APPLICATIONS LIST -->
        <div class="col-12 md-5">
          <div class="card">
            <div class="card-header">Exams to Reschedule</div>
            <div class="card-body">
              @if($exams_to_reschedule->isEmpty())
                <div class="alert alert-info" role="alert">No results found!</div>
              @else
                <table class="table yajra-datatable">
                  <thead>
                    <tr>
                      <th>Registration No</th>
                      <th>Student Name</th>
                      <th>Subject</th>
                      <th>Medical Approved Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($exams_to_reschedule as $exam)
                        <tr>
                          <td>{{ $exam->student_exam->student->reg_no }}</td>
                          <td>{{ $exam->student_exam->student->initials }} {{ $exam->student_exam->student->last_name}}</td>
                          <td>{{ $exam->student_exam->subject->name }} ({{ $exam->student_exam->type->name }})</td>
                          <td>{{ $exam->updated_at->isoFormat('YYYY-MM-DD') }}</td>
                          <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary" id="btnViewModalRescheduleExam-{{ $exam->student_exam->id }}" onclick="view_modal_reschedule_exam({{$exam->student_exam->id}})"><i class="fas fa-user"></i> View <span id="spinnerBtnViewModalRescheduleExam-{{ $exam->student_exam->id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                            </div>
                          </td>
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
      @include('portal.staff.student.exam_reschedule.modal')
      @include('portal.staff.student.exam_reschedule.scripts')
    </div>
    <!-- /CONTENT -->

@endsection
