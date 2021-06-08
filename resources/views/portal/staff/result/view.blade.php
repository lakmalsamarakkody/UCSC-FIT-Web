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

        <div class="col-lg-12">

        {{-- <div class="card">
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
        </div> --}}

        </div>
        <!-- <div class="col-lg-1"></div> -->
        <div class="col-lg-12">
          <div class="card shadow  mt-3">
            <div class="card-header">
              Results
            </div>
            <div class="card-body">
              <table class="table table-bordered yajra-datatable">
                <thead class="text-center">
                  <tr>
                    <th rowspan="2">Registration No</th>
                    <th rowspan="2">Name</th>
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
                      <td>{{ $student->student->reg_no }}</td>
                      <td>{{ $student->student->full_name }}</td>

                      {{-- FIT103 E-Test --}}
                      @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 1)->get('mark'))
                      <td>{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 1)->first('mark')['mark'] }}</td>
                       @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 1)->first()['result']>0)
                        @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 1)->first()['status'] == 'P')
                        <td><i class="fa fa-check"></i></td>
                        @elseif(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 1)->first()['status'] == 'F')
                        <td><i class="fa fa-times"></i></td>  
                        @else
                        <td>{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 1)->first()['status'] }}</td>
                        @endif
                       @else
                      <td></td> 
                       @endif
                      @else
                      <td></td>  
                      <td></td>  
                      @endif

                      {{-- FIT103 Practical --}}
                      @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 2)->get('mark'))
                      <td>{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 2)->first('mark')['mark'] }}</td>
                       @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 2)->first()['result']>0)
                        @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 2)->first()['status'] == 'P')
                        <td><i class="fa fa-check"></i></td>
                        @elseif(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 2)->first()['status'] == 'F')
                        <td><i class="fa fa-times"></i></td>  
                        @else
                        <td>{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 1)->where('exam_type_id', 2)->first()['status'] }}</td>
                        @endif
                       @else
                      <td></td> 
                       @endif
                      @else
                      <td></td>  
                      <td></td>  
                      @endif

                      {{-- FIT203 E-Test --}}
                      @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 1)->get('mark'))
                      <td>{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 1)->first('mark')['mark'] }}</td>
                       @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 1)->first()['result']>0)
                        @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 1)->first()['status'] == 'P')
                        <td><i class="fa fa-check"></i></td>
                        @elseif(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 1)->first()['status'] == 'F')
                        <td><i class="fa fa-times"></i></td>  
                        @else
                        <td>{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 1)->first()['status'] }}</td>
                        @endif
                       @else
                      <td></td> 
                       @endif
                      @else
                      <td></td>  
                      <td></td>  
                      @endif

                      {{-- FIT203 Practical --}}
                      @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 2)->get('mark'))
                      <td>{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 2)->first('mark')['mark'] }}</td>
                       @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 2)->first()['result']>0)
                        @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 2)->first()['status'] == 'P')
                        <td><i class="fa fa-check"></i></td>
                        @elseif(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 2)->first()['status'] == 'F')
                        <td><i class="fa fa-times"></i></td>  
                        @else
                        <td>{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 2)->where('exam_type_id', 2)->first()['status'] }}</td>
                        @endif
                       @else
                      <td></td> 
                       @endif
                      @else
                      <td></td>  
                      <td></td>  
                      @endif
                      

                      {{-- FIT303 E-Test --}}
                      @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 3)->where('exam_type_id', 1)->get('mark'))
                      <td>{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 3)->where('exam_type_id', 1)->first('mark')['mark'] }}</td>
                       @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 3)->where('exam_type_id', 1)->first()['result']>0)
                        @if(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 3)->where('exam_type_id', 1)->first()['status'] == 'P')
                        <td><i class="fa fa-check"></i></td>
                        @elseif(App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 3)->where('exam_type_id', 1)->first()['status'] == 'F')
                        <td><i class="fa fa-times"></i></td>  
                        @else
                        <td>{{ App\Models\Student\hasExam::where('student_id', $student->student_id)->whereIn('exam_schedule_id', $schedule_ids)->where('subject_id', 3)->where('exam_type_id', 2)->first()['status'] }}</td>
                        @endif
                       @else
                      <td></td> 
                       @endif
                      @else
                      <td></td>  
                      <td></td>  
                      @endif
                                            
                                            
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