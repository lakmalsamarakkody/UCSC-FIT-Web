@extends('layouts.student_portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#results').addClass("active");
    });

</script>

    <!-- CONTENT -->
    <div class="col-lg-12 student-results min-vh-100">
      <div class="row">

        <div class="card col-12 mt-4">
          <div class="card-header pt-3">
            Name : {{ Auth::user()->student->title." ".Auth::user()->student->initials." ".Auth::user()->student->last_name }} <br/>
            Registration No : {{ Auth::user()->student->reg_no }}
          </div>
          <div class="card-body">
            <div class="card-title">
                <b>BIT Eligibility : </b> @if( Auth::user()->student->flag->bit_eligible == 1 )<span class="badge badge-success">Eligible</span> @else <span class="badge badge-danger">Not Eligible</span> @endif <br/>
                <b>FIT Certificate : </b> @if( Auth::user()->student->flag->fit_cert == 1 )<span class="badge badge-success">Eligible</span> @else <span class="badge badge-danger">Not Eligible</span> @endif</div>
            <div class="card-text">
              <div class="w-100 text-right">N/A - Not Applied | CN - Cancelled | EO - Examination Offence | WH - With Hold | AB - Absent</div>
              {{-- <table class="table table-bordered table-responsive-md">
                <thead class="text-center">
                  <tr>
                    <th scope="col" rowspan="2"></th>
                    <th scope="col" colspan="2">FIT 103</th>
                    <th scope="col" colspan="2">FIT 203</th>
                    <th scope="col" colspan="2">FIT 303</th>
                  </tr>
                  <tr>
                    <th>E-Test</th>
                    <th>Practical</th>
                    <th>E-Test</th>
                    <th>Practical</th>
                    <th colspan="2">E-Test</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-left">2020 August</td>
                    <td><span class="badge badge-success">P</span></td>
                    <td><span class="badge badge-warning">N/A</span></td>
                    <td><span class="badge badge-success">P</span></td>
                    <td><span class="badge badge-danger">F</span></td>
                    <td><span class="badge badge-success">P</span></td>
                  </tr>
                  <tr>
                    <td class="text-left">2020 September</td>
                    <td><span class="badge badge-danger">F</span></td>
                    <td><span class="badge badge-success">P</span></td>
                    <td><span class="badge badge-success">P</span></td>
                    <td><span class="badge badge-success">P</span></td>
                    <td><span class="badge badge-warning">N/A</span></td>
                  </tr>
                  <tr>
                    <td class="text-left">2020 October</td>
                    <td><span class="badge badge-warning">N/A</span></td>
                    <td><span class="badge badge-success">P</span></td>
                    <td><span class="badge badge-danger">F</span></td>
                    <td><span class="badge badge-success">P</span></td>
                    <td><span class="badge badge-success">P</span></td>
                  </tr>
                </tbody>
              </table> --}}
            </div>

              @foreach($exams as $exam)
                <div class="col-lg-12 px-0 accordion" id="accordion_{{$exam->exam_id}}">
                  <div class="card mb-4 shadow-sm">
                    <div class="card-header shadow-sm" id="heading_{{$exam->exam_id}}">
                      <h5 class="mb-0">
                        <button class="btn w-100 text-left" data-toggle="collapse" data-target="#collapse_{{$exam->exam_id}}" aria-expanded="false" aria-controls="collapse_{{$exam->exam_id}}">
                          {{ \Carbon\Carbon::createFromDate(App\Models\Exam::find($exam->exam_id)->year, App\Models\Exam::find($exam->exam_id)->month)->monthName}} {{ App\Models\Exam::find($exam->exam_id)->year }}
                          <i class="fa fa-chevron-right float-right"></i>
                        </button>
                      </h5>
                    </div>            
                    <div id="collapse_{{$exam->exam_id}}" class="collapse" aria-labelledby="heading_{{$exam->exam_id}}" data-parent="#accordion_{{$exam->exam_id}}">
                      <div class="card-body">
                          <table class="table w-100 text-center">
                              <thead>
                                  <th>Subject</th>
                                  <th>Exam Type</th>
                                  <th>Result</th>
                                  <th>Medical</th>
                              </thead>
                              <tbody>
                              @foreach( App\Models\Student\hasExam::where('student_id', Auth::user()->student->id)->where('exam_schedule_id', '!=' , null)->join('exam_schedules', 'student_exams.exam_schedule_id', '=', 'exam_schedules.id')->where('exam_id', $exam->exam_id)->get() as $result)
                                  <tr>
                                      <td>FIT {{ $result->subject->code }}</td>
                                      <td>{{ $result->subject->name }}</td>
                                      <td>
                                        @if( $result->result <= 1 )                                        
                                        @else
                                          @if( $result->status == "P" )
                                            <h4><span class="badge badge-success">P</span></h4>
                                          @elseif( $result->status == "F" )
                                            <h4><span class="badge badge-danger">F</span></h4>
                                          @elseif( $result->status == "AB" )
                                            <h4><span class="badge badge-warning">AB</span></h4>
                                          @else
                                            <h4><span class="badge badge-primary">{{ $result->status }}</span></h4>
                                          @endif
                                        @endif                                        
                                      </td>
                                      <td>
                                        @if( $result->medical_status == 'Pending' )
                                          <button onclick="window.open('{{ asset('storage/medicals/'.$result->student_id.'/'.$result->medical_image)}}')" class="btn btn-sm btn-warning px-32 text-center"><i class="fa fa-eye p-0"></i></button>
                                        @elseif( $result->medical_status == 'Approved' )
                                          <button onclick="window.open('{{ asset('storage/medicals/'.$result->student_id.'/'.$result->medical_image)}}')" class="btn btn-sm btn-success px-32 text-center"><i class="fa fa-eye p-0"></i></button>
                                        @elseif( $result->medical_status == 'Declined' )
                                          <button onclick="window.open('{{ asset('storage/medicals/'.$result->student_id.'/'.$result->medical_image)}}')" class="btn btn-sm btn-danger px-32 text-center"><i class="fa fa-eye p-0"></i></button>                                           
                                        @endif
                                      </td>
                                  </tr>
                                
                              @endforeach
                                  {{-- <tr>
                                      <td>FIT103</td>
                                      <td>E Test</td>
                                      <td><h4><span class="badge badge-success">P</span></h4></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>FIT203</td>
                                      <td>E Test</td>
                                      <td><h4><span class="badge badge-danger">F</span></h4></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>FIT303</td>
                                      <td>E Test</td>
                                      <td><h4><span class="badge badge-light">N/A</span></h4></td>
                                      <td><button class="btn btn-sm btn-warning px-32 text-center"><i class="fa fa-eye p-0"></i></button></td>
                                  </tr> --}}
                              </tbody>
                          </table>                                
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach



          </div>
        </div>

      </div>
    </div>
    <!-- /CONTENT -->

@endsection
@include('portal.student.result.script')