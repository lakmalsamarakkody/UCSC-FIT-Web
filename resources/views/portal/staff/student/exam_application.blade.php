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

        <div class="col-12 mb-3">
          <div class="card">
            <div class="card-header">Schedule</div>
            <div class="card-body" >
              <form id="scheduleSelectFrm">
                <div class="form-row">
                  <div class="form-group col">
                  <p id="nameHelp" class="form-text text-muted">Select an exam session to assign students</p>
                    <select id="schedule" name="schedule" class="form-control ">
                      <option value="">Select an exam session</option>
                      @foreach($schedules as $schedule)
                       @if($selSechedule && $selSechedule->id == $schedule->id)
                        <option selected value="{{ $schedule->id }}">{{ \Carbon\Carbon::createFromDate($schedule->exam->year, $schedule->exam->month)->monthName}} {{ $schedule->exam->year }}    --------------------    {{ $schedule->subject_code }} - {{ $schedule->subject_name }}   --------------------   {{ $schedule->exam_type }}    --------------------    {{ $schedule->date }}   --------------------    {{ $schedule->start_time }}   --------------------    {{ App\Models\Student\hasExam::where('exam_schedule_id', $schedule->id)->count() }}/{{ $schedule->lab_capacity }}</option>
                       @else
                        <option value="{{ $schedule->id }}">{{ \Carbon\Carbon::createFromDate($schedule->exam->year, $schedule->exam->month)->monthName}} {{ $schedule->exam->year }}    --------------------    {{ $schedule->subject_code }} - {{ $schedule->subject_name }}   --------------------   {{ $schedule->exam_type }}    --------------------    {{ $schedule->date }}   --------------------    {{ $schedule->start_time }}   --------------------    {{ App\Models\Student\hasExam::where('exam_schedule_id', $schedule->id)->count() }}/{{ $schedule->lab_capacity }}</option>
                       @endif
                       @endforeach

                    </select>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        @if($selSechedule)
        <div class="col-12 mb-3">
          <div class="card">
            <div class="card-header">Selected Schedule Details</div>
            <div class="card-body" >
              <div class="row text-center">
                <div class="col">
                  Exam: <strong>{{ \Carbon\Carbon::createFromDate($selSechedule->exam->year, $selSechedule->exam->month)->monthName}} {{ $selSechedule->exam->year }}</strong>
                </div>
                <div class="col">
                  Subject: <strong>{{ $selSechedule->subject_code }} - {{ $selSechedule->subject_name }}</strong>
                </div>                
                <div class="col">
                  Type: <strong>{{ $selSechedule->exam_type }}</strong>
                </div>            
                <div class="col">
                  Date: <strong>{{ $selSechedule->date }}</strong>
                </div>
                <div class="col">
                  Time: <strong>{{ $selSechedule->start_time }}</strong>
                </div>
                <div class="col">
                  Status: <strong>{{ $lab_occupied }}/{{ $selSechedule->lab_capacity }}</strong>
                </div>
              </div>
            </div>
          </div>
        </div>          
        @endif

        <!-- APPLICATIONS LIST -->
        <div class="col-6 md-5">
          <div class="card">
            <div class="card-header">
              Unassigned Exam Applicants
              <div class="btn-group float-right">
                <button class="btn btn-primary" onclick="assign_selected()">Assign Selected</button>
              </div>
            </div>
            <div class="card-body overflow-auto" style="max-height:600px">
              @if($exam_applicants->isEmpty())
                <div class="alert alert-info" role="alert">No results found!</div>
              @else
                <table class="table yajra-datatable">
                  <tbody>
                    <div class="card">
                      {{-- E-TEST LIST --}}
                      <tr><th colspan="6" class="card-header font-weight-bold text-white bg-dark">E-tests</th></tr>
                      {{-- APPLIED ALL --}}
                      <tr>
                        <th class="card-header font-weight-bold text-white bg-secondary"><div class="input-group"><input type="checkbox" class="selected-schedules" name="requestReschduleCheck[]" value="" /></div></th>
                        <th colspan="5" class="card-header font-weight-bold text-white bg-secondary">Applied All Subjects</th>
                      </tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',1)->where('payment_id',$applicant->payment_id)->count() >= 3)
                        <tr>
                          <td><div class="input-group"><input type="checkbox" class="selected-schedules" name="requestReschduleCheck[]" value="{{ $applicant->id }}" /></div></td>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"><i class="fas fa-user"></i> Assign <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ALL --}}
                      {{-- APPLIED ONLY 2 SUBJECTS --}}
                      <tr>
                        <th class="card-header font-weight-bold text-white bg-secondary"><div class="input-group"><input type="checkbox" class="selected-schedules" name="requestReschduleCheck[]" value="" /></div></th>
                        <th colspan="5" class="card-header font-weight-bold text-white bg-secondary">Applied 02 Subjects</th>
                      </tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',1)->where('payment_id',$applicant->payment_id)->count() == 2)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"><i class="fas fa-user"></i> Assign <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ONLY 2 SUBJECTS --}}
                      {{-- APPLIED ONLY 1 SUBJECT --}}
                      <tr>
                        <th class="card-header font-weight-bold text-white bg-secondary"><div class="input-group"><input type="checkbox" class="selected-schedules" name="requestReschduleCheck[]" value="" /></div></th>
                        <th colspan="5" class="card-header font-weight-bold text-white bg-secondary">Applied only 01 Subject</th>
                      </tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',1)->where('payment_id',$applicant->payment_id)->count() == 1)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"><i class="fas fa-user"></i> Assign <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ONLY 1 SUBJECT --}}
                      {{-- /E-TEST LIST --}}
                      {{-- PRACTICAL LIST --}}
                      <tr><th colspan="6"></th></tr>
                      <tr><th colspan="6"></th></tr>
                      <tr><th colspan="6" style="cell-padding:50px" class="card-header font-weight-bold text-white bg-dark">Practicals</th></tr>
                      {{-- APPLIED ALL --}}
                      <tr>
                        <th class="card-header font-weight-bold text-white bg-secondary"><div class="input-group"><input type="checkbox" class="selected-schedules" name="requestReschduleCheck[]" value="" /></div></th>
                        <th colspan="5" class="card-header font-weight-bold text-white bg-secondary">Applied All</th>
                      </tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',2)->where('payment_id',$applicant->payment_id)->count() >= 2)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"><i class="fas fa-user"></i> Assign <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ALL --}}
                      {{-- APPLIED ONLY 1 SUBJECT --}}
                      <tr>
                        <th class="card-header font-weight-bold text-white bg-secondary"><div class="input-group"><input type="checkbox" class="selected-schedules" name="requestReschduleCheck[]" value="" /></div></th>
                        <th colspan="5" class="card-header font-weight-bold text-white bg-secondary">Applied only 01 Practical</th>
                      </tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',2)->where('payment_id',$applicant->payment_id)->count() == 1)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"><i class="fas fa-user"></i> Assign <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
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

                  
        <!-- ASSIGNED LIST -->
        <div class="col-6 md-5">
          <div class="card">
            <div class="card-header">
              Assigned Exam Applicants
              @if($sel_exam_applicants!=null)
              @elseif($sel_exam_applicants->isEmpty())
              @else
              <div class="btn-group float-right">
                <button class="btn btn-danger" type="button" onclick="remove_selected()">Remove Selected</button>
              </div>
              @endif
            </div>
            <div class="card-body overflow-auto" style="max-height:600px">
              @if($selSechedule==null)
                <div class="alert alert-info" role="alert">No schedule selected!</div>                
              @elseif($sel_exam_applicants->isEmpty())
                <div class="alert alert-info" role="alert">No assigned applicants found!</div>
              @else
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
                      @foreach ($sel_exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',1)->where('payment_id',$applicant->payment_id)->count() >= 3)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-danger" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"> Remove <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ALL --}}
                      {{-- APPLIED ONLY 2 SUBJECTS --}}
                      <tr><th colspan="4" class="card-header font-weight-bold text-white bg-secondary">Applied 02 Subjects</th></tr>
                      @foreach ($sel_exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',1)->where('payment_id',$applicant->payment_id)->count() == 2)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-danger" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"> Remove <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ONLY 2 SUBJECTS --}}
                      {{-- APPLIED ONLY 1 SUBJECT --}}
                      <tr><th colspan="4" class="card-header font-weight-bold text-white bg-secondary">Applied only 01 Subject</th></tr>
                      @foreach ($sel_exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',1)->where('payment_id',$applicant->payment_id)->count() == 1)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-danger" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"> Remove <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
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
                      @foreach ($sel_exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',2)->where('payment_id',$applicant->payment_id)->count() >= 2)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-danger" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"> Remove <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ALL --}}
                      {{-- APPLIED ONLY 1 SUBJECT --}}
                      <tr><th colspan="4" class="card-header font-weight-bold text-white bg-secondary">Applied only 01 Practical</th></tr>
                      @foreach ($sel_exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',2)->where('payment_id',$applicant->payment_id)->count() == 1)
                        <tr>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-danger" id="btnViewModalAppliedExams-{{ $applicant->payment_id }}" onclick="view_modal_applied_exams({{$applicant->payment_id}})"> Remove <span id="spinnerBtnViewModalAppliedExams-{{ $applicant->payment_id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
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
        <!-- /ASSIGNED LIST -->

      </div>
      @include('portal.staff.student.exam_application.modal')
      @include('portal.staff.student.exam_application.scripts')
    </div>
    <!-- /CONTENT -->

@endsection
