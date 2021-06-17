@extends('layouts.profile')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#students').addClass("active");
    });

</script>
    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row justify-content-lg-between">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="">Students</a></li>
              <li class="breadcrumb-item active" aria-current="page">Student Profile</li>
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
            
            {{-- REGISTRATION HOLD ALERT --}}
            @if($student->user->status == 0)
              <div class="alert alert-danger" role="alert">
                <h4 class="p-0 m-0">This account has been Deactivated</h4> 
              </div>            
            @endif
            {{-- /ACCOUNT HOLD ALERT --}}

            {{-- ACCOUNT DEACTIVATED ALERT --}}
            @if($student->flag->phase_id == 2)
              <div class="alert alert-danger" role="alert">
                <h4 class="p-0 m-0">This student has been blocked from future activities</h4> 
              </div>            
            @endif
            {{-- /ACCOUNT DEACTIVATED ALERT --}}

            <div class="card">
              <div class="card-header">
                Student Details
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-8">
                    <table class="table">
                        <tr>
                            <th>Registration Number:</th>
                            <td>{{ $student->reg_no ?? 'Not Registered Yet' }}</td>
                        </tr>
                        <tr>
                            <th>Registration Expire on:</th>
                            <td>{{ $registration->registration_expire_at ?? 'Not Registered Yet' }}</td>
                        </tr>
                        <tr>
                            <th>Title:</th>
                            <td>{{ $student->title }}.</td>
                        </tr>
                        <tr>
                            <th>First Name:</th>
                            <td>{{ $student->first_name }}</td>
                        </tr>
                        <tr>
                            <th>Middle Names:</th>
                            <td>{{ $student->middle_names ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>Full Name:</th>
                            <td>{{ $student->full_name }}</td>
                        </tr>
                        <tr>
                            <th>Name with Initials:</th>
                            <td>{{ $student->initials }} {{ $student->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Gender:</th>
                            <td>@if($student->gender == 'Male')<i class="fa fa-lg fa-male"></i>@elseif($student->gender == 'Female')<i class="fa fa-lg fa-female"></i>@endif</td>
                        </tr>
                        <tr>
                            <th>Date of Birth:</th>
                            <td>{{ $student->dob }}</td>
                        </tr>
                        <tr>
                            <th>Citizenship:</th>
                            <td>{{ $student->citizenship }}</td>
                        </tr>
                        @if($student->nic_old)                                        
                        <tr>
                            <th>NIC (old):</th>
                            <td>{{ $student->nic_old }}</td>
                        </tr>
                        @endif
                        @if($student->nic_new)                                     
                        <tr>
                            <th>NIC (new):</th>
                            <td>{{ $student->nic_new }}</td>
                        </tr>
                        @endif
                        @if($student->postal)                                     
                        <tr>
                            <th>Postal ID:</th>
                            <td>{{ $student->postal }}</td>
                        </tr>
                        @endif
                        @if($student->passport)                                     
                        <tr>
                            <th>Passport No:</th>
                            <td>{{ $student->passport }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Email:</th>
                            <td>{{ $student->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Telephone No:</th>
                            <td>+{{ $student->telephone_country_code ?? '' }}{{ $student->telephone ?? '' }}</td>
                        </tr>
                    </table>

                  </div>
                  <div class="col-md-4 align-middle">  
                      <div class="row  justify-content-center">                               
                          <div class="img mt-5 mb-2  position-relative">
                              <img src="{{ asset('storage/portal/avatar/'.$student->user_id.'/'.$student->user->profile_pic)}}" alt="Avatar" class="avatar" width="250px"  onError="this.onerror=null;this.src='{{ asset('img/portal/avatar/default.jpg') }}';">
                          </div>
                          <div class="text-center w-100 ">
                            @if(Auth::user()->hasPermission('staff-student-profile-email-reset'))
                              <button onclick="reset_email()" class="btn btn-lg btn-outline-warning" data-tooltip="tooltip" data-placement="bottom" title="Reset Email">
                                <i class="fa fa-envelope"></i>
                              </button>
                            @endif

                            {{-- REGISTRATION block/UNblock --}}
                            @if(!Auth::user()->hasPermission('staff-student-profile-block'))
                              @if($student->flag->phase_id != 2)
                              <button onclick="block_activities()" class="btn btn-lg btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Block User Activities">
                                <i class="fa fa-user-lock"></i>
                              </button>
                              @else
                              <button onclick="unblock_activities()" class="btn btn-lg btn-outline-success" data-tooltip="tooltip" data-placement="bottom" title="Unblock User Activities">
                                <i class="fa fa-unlock"></i>
                              </button>
                              @endif
                            @endif
                            {{-- /REGISTRATION block/UNblock --}}

                            {{-- ACCOUNT ACTIVATION/DEACTIVATION --}}
                            @if(Auth::user()->hasPermission('staff-student-profile-account'))
                              @if($student->user->status != 1)
                                <button onclick="activate_acc()" class="btn btn-lg btn-outline-success" data-tooltip="tooltip" data-placement="bottom" title="Activate Account">
                                  <i class="fa fa-user-check"></i>
                                </button> 
                              @else                     
                                <button onclick="deactivate_acc()" class="btn btn-lg btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Deactivate Account">
                                  <i class="fa fa-user-alt-slash"></i>
                                </button>                          
                              @endif
                            @endif
                            {{-- ACCOUNT ACTIVATION/DEACTIVATION --}}
                          </div>
                          
                            <table class="table mt-4">                        
                              <tr>
                                <th>BIT Eligibility:</th>
                                @if( $student->flag->bit_eligible == 1 )                                        
                                <td><h4><span class="badge badge-success">Eligible</span></h4></td>
                                @else
                                <td><h4><span class="badge badge-danger">Not Eligible</span></h4></td>
                                @endif
                                <th>FIT Certificate:</th>
                                @if($student->flag->fit_cert == 1)            
                                <td><h4><span class="badge badge-success">Eligible</span></h4></td>
                                @else
                                <td><h4><span class="badge badge-danger">Not Eligible</span></h4></td>                                        
                                @endif
                              </tr>
                            </table>
                      </div>   
                  </div>                                                            
                  <div class="col-12 col-md-6">
                      <h5>Permanent Address</h5>
                      <hr>
                      <div class="ml-lg-4">
                          <p>{{ $student->permanent_house }}</p>  
                          <p>{{ $student->permanent_address_line1 ?? '' }}</p>
                          <p>{{ $student->permanent_address_line2 ?? '' }}</p>  
                          <p>{{ $student->permanent_address_line3 ?? '' }}</p>  
                          <p>{{ $student->permanent_address_line4 ?? '' }}</p>
                          @if( $student->permanent_country_id == 67 )                                         
                          <p>{{ $student->permanent_city_sl->name ?? ''}}</p>                                       
                          <p>{{ $student->permanent_district_sl->name ?? ''}}</p>
                          <p>{{ $student->permanent_country->name ?? ''}}</p>
                          @else                                    
                          <p>{{ $student->permanent_city_world->name ?? ''}}</p>
                          <p>{{ $student->permanent_district_world->name ?? ''}}</p>
                          <p>{{ $student->permanent_country->name ?? ''}}</p>
                          @endif
                      </div>
                  </div>  
                  @if($student->current_house || $student->current_country_id)                  
                  <div class="col-12 col-md-6">
                      <h5>Current Address</h5>
                      <hr>
                      <div class="ml-lg-4">
                          <p>{{ $student->current_house }}</p>  
                          <p>{{ $student->current_address_line1 ?? '' }}</p>
                          <p>{{ $student->current_address_line2 ?? '' }}</p>  
                          <p>{{ $student->current_address_line3 ?? '' }}</p>  
                          <p>{{ $student->current_address_line4 ?? '' }}</p>
                          @if( $student->current_country_id == 67 )                                         
                          <p>{{ $student->current_city_sl->name ?? ''}}</p>                                       
                          <p>{{ $student->current_district_sl->name ?? ''}}</p>
                          <p>{{ $student->current_country->name ?? ''}}</p>
                          @else                                    
                          <p>{{ $student->current_city_world->name ?? ''}}</p>
                          <p>{{ $student->current_district_world->name ?? ''}}</p>
                          <p>{{ $student->current_country->name ?? ''}}</p>
                          @endif
                      </div>
                  </div>
                  @endif
                  <div class="col-lg-12">
                      @if(Auth::user()->hasPermission('staff-student-profile-result-view') || Auth::user()->hasPermission('staff-student-profile-medical-view'))
                      <hr>
                      @endif
                      <div class="row">                        
                          <div class="col-lg-12">
                            {{-- TAB LIST --}}
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                              @if(Auth::user()->hasPermission('staff-student-profile-result-view'))
                              <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="result-tab" data-toggle="tab" href="#result" role="tab" aria-controls="result" aria-selected="true">Results</a>
                              </li>
                              @endif
                              @if(Auth::user()->hasPermission('staff-student-profile-medical-view'))
                              <li class="nav-item" role="presentation">
                                <a class="nav-link" id="medicals-tab" data-toggle="tab" href="#medicals" role="tab" aria-controls="medicals" aria-selected="false">Medicals</a>
                              </li>
                              @endif
                            </ul>
                            {{-- /TAB LIST --}}

                            {{-- /RESULT TAB CONTENT --}}
                            {{-- @if(Auth::user()->hasPermission('staff-student-profile-result-view')) --}}
                            <div class="tab-content pt-3" id="myTabContent">
                              <div class="tab-pane fade show active" id="result" role="tabpanel" aria-labelledby="results-tab">
                                <table class="table table-bordered table-responsive-md">
                                  <thead class="text-center">
                                    <tr>
                                      <th rowspan="2">Exam</th>
                                      <th colspan="4">FIT 103</th>
                                      <th colspan="4">FIT 203</th>
                                      <th  colspan="2">FIT 303</th>
                                    </tr>
                                    <tr>
                                      <th colspan="2">E-Test</th>
                                      <th colspan="2">Practical</th>
                                      <th colspan="2">E-Test</th>
                                      <th colspan="2">Practical</th>
                                      <th  colspan="2">E-Test</th>
                                    </tr>
                                  </thead>
                                  <tbody class="text-center">

                                  {{-- @foreach($exams as $exam) --}}

                                    <tr>
                                      {{-- <td>{{ \Carbon\Carbon::createFromDate(App\Models\Exam::find($exam->exam_id)->year, App\Models\Exam::find($exam->exam_id)->month)->monthName}} {{ App\Models\Exam::find($exam->exam_id)->year }}</td> --}}
                                      
                                      {{-- FIT103 E-Test --}}
                                      {{-- @if(App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 1)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 1)->where('exam_type_id', 1)->get('mark'))
                                      <td>{{ App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 1)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 1)->where('exam_type_id', 1)->latest()->first('mark')['mark'] }}</td>
                                        @if(App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 1)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 1)->where('exam_type_id', 1)->latest()->first('result')['result']>0)
                                          @if( App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 1)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 1)->where('exam_type_id', 1)->latest()->first('status')['status'] == 'P' )
                                          <td><h4><span class="badge badge-success">P</span></h4></td>
                                          @elseif( App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 1)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 1)->where('exam_type_id', 1)->latest()->first('status')['status'] == 'F' )
                                          <td><h4><span class="badge badge-danger">F</span></h4></td>
                                          @else
                                          <td><h4><span class="badge badge-primary">{{ App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 1)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 1)->where('exam_type_id', 1)->latest()->first('status')['status'] }}</span></h4></td>
                                          @endif
                                        @else
                                          <td></td> 
                                        @endif
                                      @else
                                      <td></td>  
                                      <td></td>  
                                      @endif --}}
                                      
                                      {{-- FIT103 Practical --}}
                                      {{-- @if(App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 1)->where('exam_type_id', 2)->get('id')->toArray())->where('subject_id', 1)->where('exam_type_id', 2)->get('mark'))
                                      <td>{{ App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 1)->where('exam_type_id', 2)->get('id')->toArray())->where('subject_id', 1)->where('exam_type_id', 2)->latest()->first('mark')['mark'] }}</td>
                                        @if(App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 1)->where('exam_type_id', 2)->get('id')->toArray())->where('subject_id', 1)->where('exam_type_id', 2)->latest()->first('result')['result']>0)
                                          @if( App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 1)->where('exam_type_id', 2)->get('id')->toArray())->where('subject_id', 1)->where('exam_type_id', 2)->latest()->first('status')['status'] == 'P' )
                                          <td><h4><span class="badge badge-success">P</span></h4></td>
                                          @elseif( App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 1)->where('exam_type_id', 2)->get('id')->toArray())->where('subject_id', 1)->where('exam_type_id', 2)->latest()->first('status')['status'] == 'F' )
                                          <td><h4><span class="badge badge-danger">F</span></h4></td>
                                          @else
                                          <td><h4><span class="badge badge-primary">{{ App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 1)->where('exam_type_id', 2)->get('id')->toArray())->where('subject_id', 1)->where('exam_type_id', 2)->latest()->first('status')['status'] }}</span></h4></td>
                                          @endif
                                        @else
                                          <td></td> 
                                        @endif
                                      @else
                                      <td></td>  
                                      <td></td>  
                                      @endif --}}

                                      {{-- FIT203 E-Test --}}
                                      {{-- @if(App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 2)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 2)->where('exam_type_id', 1)->get('mark'))
                                      <td>{{ App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 2)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 2)->where('exam_type_id', 1)->latest()->first('mark')['mark'] }}</td>
                                        @if(App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 2)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 2)->where('exam_type_id', 1)->latest()->first('result')['result']>0)
                                          @if( App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 2)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 2)->where('exam_type_id', 1)->latest()->first('status')['status'] == 'P' )
                                          <td><h4><span class="badge badge-success">P</span></h4></td>
                                          @elseif( App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 2)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 2)->where('exam_type_id', 1)->latest()->first('status')['status'] == 'F' )
                                          <td><h4><span class="badge badge-danger">F</span></h4></td>
                                          @else
                                          <td><h4><span class="badge badge-primary">{{ App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 2)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 2)->where('exam_type_id', 1)->latest()->first('status')['status'] }}</span></h4></td>
                                          @endif
                                        @else
                                          <td></td> 
                                        @endif
                                      @else
                                      <td></td>  
                                      <td></td>  
                                      @endif --}}

                                      {{-- FIT203 Practical --}}
                                      {{-- @if(App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 2)->where('exam_type_id', 2)->get('id')->toArray())->where('subject_id', 2)->where('exam_type_id', 2)->get('mark'))
                                      <td>{{ App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 2)->where('exam_type_id', 2)->get('id')->toArray())->where('subject_id', 2)->where('exam_type_id', 2)->latest()->first('mark')['mark'] }}</td>
                                        @if(App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 2)->where('exam_type_id', 2)->get('id')->toArray())->where('subject_id', 2)->where('exam_type_id', 2)->latest()->first('result')['result']>0)
                                          @if( App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 2)->where('exam_type_id', 2)->get('id')->toArray())->where('subject_id', 2)->where('exam_type_id', 2)->latest()->first('status')['status'] == 'P' )
                                          <td><h4><span class="badge badge-success">P</span></h4></td>
                                          @elseif( App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 2)->where('exam_type_id', 2)->get('id')->toArray())->where('subject_id', 2)->where('exam_type_id', 2)->latest()->first('status')['status'] == 'F' )
                                          <td><h4><span class="badge badge-danger">F</span></h4></td>
                                          @else
                                          <td><h4><span class="badge badge-primary">{{ App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 2)->where('exam_type_id', 2)->get('id')->toArray())->where('subject_id', 2)->where('exam_type_id', 2)->latest()->first('status')['status'] }}</span></h4></td>
                                          @endif
                                        @else
                                          <td></td> 
                                        @endif
                                      @else
                                      <td></td>  
                                      <td></td>  
                                      @endif --}}

                                      {{-- FIT303 E-Test --}}
                                      {{-- @if(App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 3)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 3)->where('exam_type_id', 1)->get('mark'))
                                      <td>{{ App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 3)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 3)->where('exam_type_id', 1)->latest()->first('mark')['mark'] }}</td>
                                        @if(App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 3)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 3)->where('exam_type_id', 1)->latest()->first('result')['result']>0)
                                          @if( App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 3)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 3)->where('exam_type_id', 1)->latest()->first('status')['status'] == 'P' )
                                          <td><h4><span class="badge badge-success">P</span></h4></td>
                                          @elseif( App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 3)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 3)->where('exam_type_id', 1)->latest()->first('status')['status'] == 'F' )
                                          <td><h4><span class="badge badge-danger">F</span></h4></td>
                                          @else
                                          <td><h4><span class="badge badge-primary">{{ App\Models\Student\hasExam::where('student_id', $student->id)->whereIn('exam_schedule_id', App\Models\Exam\Schedule::where('exam_id', $exam->exam_id)->where('subject_id', 3)->where('exam_type_id', 1)->get('id')->toArray())->where('subject_id', 3)->where('exam_type_id', 1)->latest()->first('status')['status'] }}</span></h4></td>
                                          @endif
                                        @else
                                          <td></td> 
                                        @endif
                                      @else
                                      <td></td>  
                                      <td></td>  
                                      @endif --}}


                                    </tr>

                                  {{-- @endforeach --}}

                                  </tbody>
                                </table>
                              </div>
                              {{-- @endif --}}
                              {{-- /RESULT TAB CONTENT --}}

                              {{-- MEDICAL TAB CONTENT --}}
                              {{-- @if(Auth::user()->hasPermission('staff-student-profile-medical-view'))
                              <div class="tab-pane fade" id="medicals" role="tabpanel" aria-labelledby="medicals-tab">
                                <table class="table table-bordered table-responsive-md">
                                  <thead class="text-center">
                                    <tr>
                                      <th>Exam</th>
                                      <th>Held Date</th>
                                      <th>Subject</th>
                                      <th>Exam Type</th>
                                      <th>Medical</th>
                                    </tr>
                                  </thead>
                                  <tbody class="text-center">
                                    @foreach ($medicals as $medical)
                                      <tr>
                                        <td>{{ $medical->student_exam->schedule->exam->year }} {{ \Carbon\Carbon::createFromDate($medical->student_exam->schedule->exam->year, $medical->student_exam->schedule->exam->month)->monthName }}</td>
                                        <td>{{ $medical->student_exam->schedule->date }}</td>
                                        <td>FIT {{ $medical->student_exam->schedule->subject->code}} - {{ $medical->student_exam->schedule->subject->name }}</td>
                                        <td>{{ $medical->student_exam->schedule->type->name }}</td>
                                        <td>
                                          @if($medical->status == 'Pending')
                                            <span class="badge badge-warning">P</span>
                                          @elseif($medical->status == 'Approved')
                                            <span class="badge badge-success">A</span>
                                          @elseif($medical->status == 'Declined')
                                            <span class="badge badge-danger">D</span>
                                          @else
                                            <span class="badge badge-secondary">R</span>
                                          @endif
                                          @if(Auth::user()->hasPermission('staff-student-profile-medical-view'))
                                            <button class="btn btn-sm btn-warning px-32 text-center" id="modalProfileMedical-{{ $medical->id }}" onclick="view_medical({{ $medical->id }});"><i class="fa fa-eye p-0"></i></button>
                                          @endif
                                        </td>
                                      </tr>
                                      @endforeach
                                  </tbody>
                                </table>
                                <div class="input-group">
                                  <div class="col-lg-3 col-5">
                                    <span class="badge badge-warning">P</span> <b>Pending</b>
                                  </div>
                                  <div class="col-lg-3 col-7">
                                    <span class="badge badge-success">A</span> <b>Approved</b>
                                  </div>
                                  <div class="col-lg-3 col-5">
                                    <span class="badge badge-danger">D</span> <b>Declined</b>
                                  </div>
                                  <div class="col-lg-3 col-7">
                                    <span class="badge badge-secondary">R</span> <b>Declined to Resubmit</b>
                                  </div>
                                </div>
                              </div>
                              @endif --}}
                              {{-- /MEDICAL TAB CONTENT --}}
                            </div>
                          </div>

                      </div>

                  </div>
                </div>
              </div>
            </div>

        </div>
      </div>
    </div>
    <!-- /CONTENT -->
<div class="mb-5">&nbsp;</div>

 @include('portal.staff.student.profile.scripts')
 @include('portal.staff.student.profile.modal')

@endsection
