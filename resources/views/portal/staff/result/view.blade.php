@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#results').addClass("active");
    });

</script>
    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Results</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->


    <!-- CONTENT -->
    <div class="col-lg-12 student">
      <div class="row">
        <!-- <div class="col-lg-2"></div> -->

        {{-- <div class="col-lg-12">

          <div class="card">
            <div class="card-header">Filters</div>
            <div class="card-body">
              <form>
                <div class="form-row">
                  <div class="form-group col-12">
                    <div class="input-group input-group-md">
                      <div class="input-group-prepend">
                        <button type="button" class="form-control btn btn-outline-secondary" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false"><i class="fa fa-filter"></i>&nbsp;Filter</button>
                      </div>
                      <input type="text" class="form-control" placeholder="Enter search details.."/>
                      <div class="input-group-append">
                        <button type="button" class="form-control btn btn-primary"><i class="fa fa-search"></i>&nbsp;Search</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="collapse" id="collapseExample">
                  <div class="card shadow-none">
                    <div class="card-body">
                      <div class="form-row">
                        <div class="form-group col">
                          <label for="InputStudentName">Name</label>
                          <input type="text" class="form-control form-control-sm" id="InputStudentName" aria-describedby="InputStudentNameHelp"/>
                          <small id="InputStudentNameHelp" class="form-text text-muted">Enter Name Here</small>
                        </div>
                        <div class="form-group col">
                          <label for="InputStudentNIC">Registration Number</label>
                          <input type="text" class="form-control form-control-sm" id="InputStudentNIC" aria-describedby="InputStudentNICHelp"/>
                          <small id="InputStudentNICHelp" class="form-text text-muted">Enter Registration Number Here</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>              
              </form>
            </div>
          </div> 

        </div> --}}
        <!-- <div class="col-lg-1"></div> -->

        {{-- EXAM TITLE --}}
        <div class="col-lg-12 text-center">
          <h1><span class="badge badge-secondary"> {{ App\Models\Exam::where('id',$exam_id)->first()->year }} - {{ Carbon\Carbon::createFromDate(2000,App\Models\Exam::where('id',$exam_id)->first()->month)->monthName }} </span></h1>
        </div>
        {{-- EXAM TITLE --}}

        {{-- PUSH UP RESULTS --}}
        @if(Auth::user()->hasPermission('staff-result-view-pushResults') && !$isReleased)
        <div class="col-lg-12">
          <div class="card shadow  mt-3">
            <div class="card-header">
              Push up Results
            </div>
            <div class="card-body">
              <form id="resultsPushForm">
                <div class="form-row">
                  <div class="form-group col">
                    {{-- <label for="subject">Subject</label> --}}
                    <select id="subject" name="subject" class="form-control">
                      <option value=null selected>Subject</option>
                      @foreach($subjects as $subject)                          
                      <option value="{{$subject->id}}">{{$subject->name}}</option>
                      @endforeach
                    </select>
                    <span id="errsubject" class="invalid-feedback" role="alert"></span>
                  </div>
                  <div class="form-group col">
                    {{-- <label for="examType">Exam Type</label> --}}
                    <select id="examType" name="examType" class="form-control">
                      <option value=null selected>Exam type</option>
                      @foreach($exam_types as $exam_type)                          
                      <option value="{{$exam_type->id}}">{{$exam_type->name}}</option>
                      @endforeach
                    </select>
                    <span id="errexamType" class="invalid-feedback" role="alert"></span>
                  </div>
                  <div class="form-group col">
                    <input type="number" id="txtPushMark" class="form-control" placeholder="Push-up mark (default : 48)" max="49" min="0"/>
                  </div>
                  <div class="form-group col">
                    <button type="button" id="btnPushResults" class="btn btn-outline-primary w-100" onclick="pushResults({{$exam_id}})">
                      Push
                      <span id="btnPushResultsSpinner" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        @endif
        {{-- /PUSH UP RESULTS --}}

        <div class="col-lg-12">
          <div class="card shadow  mt-3">
            <div class="card-header">
              Results
            </div>
            <div class="card-body">
              <table class="table table-bordered table-hover yajra-datatable">
                <thead class="text-center">
                  <tr>
                    <th class="font-weight-bold" rowspan="2">Registration No</th>
                    <th class="font-weight-bold" rowspan="2">Name</th>
                    <th colspan="4">FIT 103</th>
                    <th colspan="4">FIT 203</th>
                    <th rowspan="2" colspan="2">FIT 303</th>
                    <th rowspan="2">&nbsp;</th>
                  </tr>
                  <tr>
                    <th colspan="2">E Test</th>
                    <th colspan="2">Practical</th>
                    <th colspan="2">E Test</th>
                    <th colspan="2">Practical</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                @foreach($students as $student)                  
                    <tr>
                      <td class="font-weight-bold">{{ $student->student->reg_no ?? "" }}</td>
                      <td class="font-weight-bold">{{ $student->student->initials ?? "" }} {{ $student->student->last_name ?? "" }}</td>

                      {{-- FIT103 E-Test --}}
                      @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 1)->first('mark'))
                          
                        {{-- MARKS --}}
                        <td>
                          @if(Auth::user()->hasPermission('staff-result-view-marks'))
                            {{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 1)->first('round_mark')['round_mark'] }}
                            @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 1)->first('round_mark')['round_mark'] != App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 1)->first('mark')['mark'])  
                              <span class="text-success font-weight-bold">-></span>  {{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 1)->first('mark')['mark'] }}
                            @endif
                          @else
                            <i class="fa fa-ban text-secondary"></i>
                          @endif
                        </td>

                        {{-- STATUS --}}
                        @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 1)->first()['status'] == 'P')
                          <td><h5><span class="badge badge-success">P</span></h5></td>
                        @elseif(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 1)->first()['status'] == 'F')
                          <td><h5><span class="badge badge-danger">F</span></h5></td>
                        @else
                          <td><h5><span class="badge badge-secondary">{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 1)->first()['status'] }}</span></h5></td>
                        @endif

                      @else
                        <td colspan="2"></td>
                      @endif
                      {{-- /FIT103 E-Test --}}

                      {{-- FIT103 Practical --}}
                      @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 2)->first('mark'))
                          
                        {{-- MARKS --}}
                        <td>
                          @if(Auth::user()->hasPermission('staff-result-view-marks'))
                            {{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 2)->first('round_mark')['round_mark'] }}
                            @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 2)->first('round_mark')['round_mark'] != App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 2)->first('mark')['mark'])  
                              <span class="text-success font-weight-bold">-></span>  {{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 2)->first('mark')['mark'] }}
                            @endif
                          @else
                            <i class="fa fa-ban text-secondary"></i>
                          @endif
                        </td>

                        {{-- STATUS --}}
                        @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 2)->first()['status'] == 'P')
                          <td><h5><span class="badge badge-success">P</span></h5></td>
                        @elseif(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 2)->first()['status'] == 'F')
                          <td><h5><span class="badge badge-danger">F</span></h5></td>
                        @else
                          <td><h5><span class="badge badge-secondary">{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 2)->first()['status'] }}</span></h5></td>
                        @endif

                      @else
                        <td colspan="2"></td>
                      @endif
                      {{-- /FIT103 Practical --}}

                      {{-- FIT203 E-Test --}}
                      @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 1)->first('mark'))
                          
                        {{-- MARKS --}}
                        <td>
                          @if(Auth::user()->hasPermission('staff-result-view-marks'))
                            {{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 1)->first('round_mark')['round_mark'] }}
                            @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 1)->first('round_mark')['round_mark'] != App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 1)->first('mark')['mark'])  
                              <span class="text-success font-weight-bold">-></span>  {{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 1)->first('mark')['mark'] }}
                            @endif
                          @else
                            <i class="fa fa-ban text-secondary"></i>
                          @endif
                        </td>

                        {{-- STATUS --}}
                        @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 1)->first()['status'] == 'P')
                          <td><h5><span class="badge badge-success">P</span></h5></td>
                        @elseif(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 1)->first()['status'] == 'F')
                          <td><h5><span class="badge badge-danger">F</span></h5></td>
                        @else
                          <td><h5><span class="badge badge-secondary">{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 1)->first()['status'] }}</span></h5></td>
                        @endif

                      @else
                        <td colspan="2"></td>
                      @endif
                      {{-- /FIT203 E-Test --}}

                      {{-- FIT203 Practical --}}
                      @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 2)->first('mark'))
                          
                        {{-- MARKS --}}
                        <td>
                          @if(Auth::user()->hasPermission('staff-result-view-marks'))
                            {{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 2)->first('round_mark')['round_mark'] }}
                            @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 2)->first('round_mark')['round_mark'] != App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 2)->first('mark')['mark'])  
                              <span class="text-success font-weight-bold">-></span>  {{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 2)->first('mark')['mark'] }}
                            @endif
                          @else
                            <i class="fa fa-ban text-secondary"></i>
                          @endif
                        </td>

                        {{-- STATUS --}}
                        @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 2)->first()['status'] == 'P')
                          <td><h5><span class="badge badge-success">P</span></h5></td>
                        @elseif(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 2)->first()['status'] == 'F')
                          <td><h5><span class="badge badge-danger">F</span></h5></td>
                        @else
                          <td><h5><span class="badge badge-secondary">{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 2)->first()['status'] }}</span></h5></td>
                        @endif

                      @else
                        <td colspan="2"></td>
                      @endif
                      {{-- /FIT203 Practical --}}
                      

                      {{-- FIT303 E-Test --}}
                      @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 3)->where('exam_type_id', 1)->first('mark'))
                          
                        {{-- MARKS --}}
                        <td>
                          @if(Auth::user()->hasPermission('staff-result-view-marks'))
                            {{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 3)->where('exam_type_id', 1)->first('round_mark')['round_mark'] }}
                            @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 3)->where('exam_type_id', 1)->first('round_mark')['round_mark'] != App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 3)->where('exam_type_id', 1)->first('mark')['mark'])  
                              <span class="text-success font-weight-bold">-></span>  {{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 3)->where('exam_type_id', 1)->first('mark')['mark'] }}
                            @endif
                          @else
                            <i class="fa fa-ban text-secondary"></i>
                          @endif
                        </td>

                        {{-- STATUS --}}
                        @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 3)->where('exam_type_id', 1)->first()['status'] == 'P')
                          <td><h5><span class="badge badge-success">P</span></h5></td>
                        @elseif(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 3)->where('exam_type_id', 1)->first()['status'] == 'F')
                          <td><h5><span class="badge badge-danger">F</span></h5></td>
                        @else
                          <td><h5><span class="badge badge-secondary">{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 3)->where('exam_type_id', 1)->first()['status'] }}</span></h5></td>
                        @endif

                      @else
                        <td colspan="2"></td>
                      @endif
                      {{-- /FIT303 E-Test --}}
                                            
                                            
                      <td><button onclick="view_student('{{ $student->student_id }}');" data-toggle="modal" data-target="#exampleModal" title="View Profile" data-tooltip="tooltip" data-placement="bottom"  type="button" class="btn btn-outline-primary"><i class="fas fa-user"></i></button></td>
                    </tr>                                  
                @endforeach
                </tbody>
              </table>
            </div>
          </div>

        </div>

      </div>
    </div>
    <!-- /CONTENT -->




@endsection
@include('portal.staff.result.view.scripts')