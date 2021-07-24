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
            <div class="card-header">Exam Session</div>
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
            <div class="card-header">
              Selected Exam Session Details
              @if($selSechedule->status == 'Published')
              
                | <span class=" text-success">Session Published</span>
              
              @else
                @if(Auth::user()->hasPermission('staff-dashboard-exam-application-approveSchedules'))
                <div class="btn-group float-right">
                  <button class="btn btn-success" id="btnAssignSelected" onclick="publish_schedule({{ $selSechedule->id }})">
                    <i class="fas fa-bullhorn"></i> Publish To Students
                    <span id="assingSelectedSpinner" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span>
                  </button>
                @endif
                </div>
              @endif
                <div class="btn-group float-right">
                  <button class="btn btn-success" id="btnAssignSelected" onclick="publish_schedule({{ $selSechedule->id }})" style="background-color:rgb(14, 97, 25) !important">
                    <i class="fa fa-file-download"></i> Export List
                    <span id="assingSelectedSpinner" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span>
                  </button>
                </div>
            </div>
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
        <div class="col md-5 @if($selSechedule && $selSechedule->status == 'Published') d-none @endif" id="unassigned">
          <div class="card">
            <div class="card-header">
              Unassigned Exam Applicants
              @if($exam_applicants==null)
              @elseif($exam_applicants->isEmpty())
              @else
              <div class="btn-group float-right">
                <button class="btn btn-primary" id="btnAssignSelected" onclick="assign_selected()">
                  Assign Selected
                  <span id="assingSelectedSpinner" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span>
                </button>
              </div>
              | <span id="selectedCount">0</span> Selected
              @endif
            </div>
            <div class="card-body overflow-auto" style="max-height:400px">
              @if($exam_applicants==null)
                <div class="alert alert-info" role="alert">No schedule selected!</div>                
              @elseif($exam_applicants->isEmpty())
                <div class="alert alert-info" role="alert">No applicants found!</div>
              @else
              <form id="applyToExamForm">
                <table class="table">
                  <tbody>
                    <div class="card">
                      {{-- E-TEST LIST --}}
                      <tr><th colspan="5" class="card-header font-weight-bold text-white bg-dark">E-tests</th></tr>
                      {{-- APPLIED ALL --}}
                      <tr>
                        <th class="card-header font-weight-bold text-white bg-secondary"><div class="input-group"><input type="checkbox" class="selectAllEtestThree"/></div></th>
                        <th colspan="4" class="card-header font-weight-bold text-white bg-secondary">Applied All Subjects</th>
                      </tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',1)->where('payment_id',$applicant->payment_id)->count() >= 3)
                        <tr>
                          <td><div class="input-group"><input type="checkbox" class="etestThree assign" name="exmAssignCheck[]" value="{{ $applicant->id }}" /></div></td>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary assign-applicant" onclick="assign_applicant({{ $applicant->id }}, {{ $selSechedule->id ?? '' }})"><i class="fas fa-user"></i> Assign</button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ALL --}}
                      {{-- APPLIED ONLY 2 SUBJECTS --}}
                      <tr>
                        <th class="card-header font-weight-bold text-white bg-secondary"><div class="input-group"><input type="checkbox" class="selectAllEtestTwo"/></div></th>
                        <th colspan="4" class="card-header font-weight-bold text-white bg-secondary">Applied 02 Subjects</th>
                      </tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',1)->where('payment_id',$applicant->payment_id)->count() == 2)
                        <tr>
                          <td><div class="input-group"><input type="checkbox" class="etestTwo assign" name="exmAssignCheck[]" value="{{ $applicant->id }}" /></div></td>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary assign-applicant" onclick="assign_applicant({{ $applicant->id }}, {{ $selSechedule->id ?? '' }})"><i class="fas fa-user"></i> Assign</button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ONLY 2 SUBJECTS --}}
                      {{-- APPLIED ONLY 1 SUBJECT --}}
                      <tr>
                        <th class="card-header font-weight-bold text-white bg-secondary"><div class="input-group"><input type="checkbox" class="selectAllEtestOne"/></div></th>
                        <th colspan="4" class="card-header font-weight-bold text-white bg-secondary">Applied only 01 Subject</th>
                      </tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',1)->where('payment_id',$applicant->payment_id)->count() == 1)
                        <tr>
                          <td><div class="input-group"><input type="checkbox" class="etestOne assign" name="exmAssignCheck[]" value="{{ $applicant->id }}" /></div></td>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary assign-applicant" onclick="assign_applicant({{ $applicant->id }}, {{ $selSechedule->id ?? '' }})"><i class="fas fa-user"></i> Assign</button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ONLY 1 SUBJECT --}}
                      {{-- /E-TEST LIST --}}
                      {{-- PRACTICAL LIST --}}
                      <tr><th colspan="5"></th></tr>
                      <tr><th colspan="5"></th></tr>
                      <tr><th colspan="5" style="cell-padding:50px" class="card-header font-weight-bold text-white bg-dark">Practicals</th></tr>
                      {{-- APPLIED ALL --}}
                      <tr>
                        <th class="card-header font-weight-bold text-white bg-secondary"><div class="input-group"><input type="checkbox" class="selectAllPracTwo"/></div></th>
                        <th colspan="4" class="card-header font-weight-bold text-white bg-secondary">Applied All</th>
                      </tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',2)->where('payment_id',$applicant->payment_id)->count() >= 2)
                        <tr>
                          <td><div class="input-group"><input type="checkbox" class="pracTwo assign" name="exmAssignCheck[]" value="{{ $applicant->id }}" /></div></td>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary assign-applicant" onclick="assign_applicant({{ $applicant->id }}, {{ $selSechedule->id ?? '' }})"><i class="fas fa-user"></i> Assign</button>
                            </div>
                          </td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      {{-- /APPLIED ALL --}}
                      {{-- APPLIED ONLY 1 SUBJECT --}}
                      <tr>
                        <th class="card-header font-weight-bold text-white bg-secondary"><div class="input-group"><input type="checkbox" class="selectAllPracOne"/></div></th>
                        <th colspan="4" class="card-header font-weight-bold text-white bg-secondary">Applied only 01 Practical</th>
                      </tr>
                      @foreach ($exam_applicants as $applicant)
                        @if( App\Models\Student\hasExam::where('exam_type_id',2)->where('payment_id',$applicant->payment_id)->count() == 1)
                        <tr>
                          <td><div class="input-group"><input type="checkbox" class="pracOne assign" name="exmAssignCheck[]" value="{{ $applicant->id }}" /></div></td>
                          <td>{{ $applicant->student->reg_no }}</td>
                          <td>{{ $applicant->student->initials }} {{ $applicant->student->last_name}}</td>
                          <td>{{ \Carbon\Carbon::createFromDate($applicant->exam->year, $applicant->exam->month)->monthName}} {{ $applicant->exam->year }}</td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-application-view'))
                          <td class="text-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-primary assign-applicant" onclick="assign_applicant({{ $applicant->id }}, {{ $selSechedule->id ?? '' }})"><i class="fas fa-user"></i> Assign</button>
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
              </form>
              @endif

            </div>
          </div>
        </div>
        <!-- /APPLICATIONS LIST -->

                  
        <!-- ASSIGNED LIST -->
        <div class="col md-5" id="assigned">
          <div class="card">
            <div class="card-header">
              Assigned Exam Applicants
              <div class="btn-group float-right">
              @if($selSechedule)
                @if($lab_occupied < $selSechedule->lab_capacity)                  
                  <span class="text-success">Slots remain: {{ $selSechedule->lab_capacity - $lab_occupied }}</span>
                @else
                  <span class="text-danger">Slots remain: {{ $selSechedule->lab_capacity - $lab_occupied }}</span>
                @endif                
              @endif
              </div>
            </div>
            <div class="card-body overflow-auto" style="max-height:413px">
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
                              <button type="button" class="btn btn-outline-danger remove-applicant" onclick="remove_applicant({{ $applicant->id }}, {{ $selSechedule->id ?? '' }})"> Remove</button>
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
                              <button type="button" class="btn btn-outline-danger remove-applicant" onclick="remove_applicant({{ $applicant->id }}, {{ $selSechedule->id ?? '' }})"> Remove</button>
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
                              <button type="button" class="btn btn-outline-danger remove-applicant" onclick="remove_applicant({{ $applicant->id }}, {{ $selSechedule->id ?? '' }})"> Remove</button>
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
                              <button type="button" class="btn btn-outline-danger remove-applicant" onclick="remove_applicant({{ $applicant->id }}, {{ $selSechedule->id ?? '' }})"> Remove</button>
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
                              <button type="button" class="btn btn-outline-danger remove-applicant" onclick="remove_applicant({{ $applicant->id }}, {{ $selSechedule->id ?? '' }})"> Remove</button>
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
      {{-- @include('portal.staff.student.exam_application.modal') --}}
      @include('portal.staff.student.exam_application.scripts')
    </div>
    <!-- /CONTENT -->

@endsection
