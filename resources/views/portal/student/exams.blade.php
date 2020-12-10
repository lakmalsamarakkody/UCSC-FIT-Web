@extends('layouts.student_portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#exams').addClass("active");
    });

</script>

    <!-- CONTENT -->
    <div class="col-lg-12 student-exams min-vh-100">
      <div class="row">

        <!-- EXAM SCHEDULE TABLE -->
        <div class="col-12 md-5 mt-4">
          <div class="card">
            <div class="card-header">Upcoming Schedules</div>
            <div class="card-body">
              <table class="table yajra-datatable">
                <thead class="text-center">
                  <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Exam Type</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($exams as $exam)
                  <tr class="text-center">
                    <td>FIT {{ $exam->subject->code }}</td>
                    <td>{{ $exam->subject->name }}</td>
                    <td>{{ $exam->type->exam_type }}</td>
                    <td>{{ $exam->date }}</td>
                    <td>10:30 AM</td>
                    <td>12:30 PM</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-outline-success" data-tooltip="tooltip" data-placement="bottom" title="Apply Exam" onclick="window.open('/portal/student/payment')"><i class="far fa-hand-point-right"></i></button>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>
        </div>
        <!-- /EXAM SCHEDULE TABLE-->

        <!-- APPLIED EXAMS TABLE -->
        <div class="col-12 md-5 mt-4">
          <div class="card">
            <div class="card-header">Applied Exams</div>
            <div class="card-body">
              <table class="table yajra-datatable">
                <thead class="text-center">
                  <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Exam Type</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($exams as $exam)
                  <tr class="text-center">
                    <td>FIT {{ $exam->subject->code }}</td>
                    <td>{{ $exam->subject->name }}</td>
                    <td>{{ $exam->type->exam_type }}</td>
                    <td>{{ $exam->date }}</td>
                    <td>10:30 AM</td>
                    <td>12:30 PM</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Cancel Exam"><i class="fas fa-times"></i></button>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>
        </div>
        <!-- /APPLIED EXAMS TABLE-->

        <!-- FACED EXAMS TABLE -->
        <div class="col-12 md-5 mt-4">
          <div class="card">
            <div class="card-header">Faced Exams</div>
            <div class="card-body">
              <table class="table yajra-datatable">
                <thead class="text-center">
                  <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Exam Type</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($exams as $exam)
                  <tr class="text-center">
                    <td>FIT {{ $exam->subject->code }}</td>
                    <td>{{ $exam->subject->name }}</td>
                    <td>{{ $exam->type->exam_type }}</td>
                    <td>{{ $exam->date }}</td>
                    <td>10:30 AM</td>
                    <td>12:30 PM</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Upload Medical"><i class="fas fa-file-medical"></i></button>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>
        </div>
        <!-- /FACED EXAMS TABLE-->

      </div>
    </div>
    <!-- /CONTENT -->
@endsection
