@extends('layouts.student_portal')

@section('content')

<script type="text/JavaScript">

    {{-- ACTIVE NAVIGATION ENTRY --}}
    $(document).ready(function ($) {
        $('#exams').addClass("active");
    });

</script>

    {{-- CONTENT --}}
    <div class="col-lg-12 student-exams min-vh-100">
      <div class="row">
        {{-- Please Use A Computer For The Best Viewing of exam details. --}}
        {{-- SCHEDULED EXAMS --}}
        @if(!$scheduled_exams->isEmpty())
        <div class="col-12 mt-4 px-0">
          <div class="card">
            <div class="card-header">
              Scheduled Exams
              <div class="btn-group float-right">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-exam-reschedule">Request Reschedule</button>
              </div>
            </div>
            
            <div class="card-body">

              <table class="table table-hover">

                <thead>
                  <tr>
                    <th class="text-center">Subject Code</th>
                    <th class="text-center">Subject</th>
                    <th class="text-center">Exam Type</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Time</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($scheduled_exams as $exam)
                    @if($exam->schedule->date > date('Y-m-d') && $exam->medical==null)
                    <tr>
                      <td class="text-center">FIT {{ $exam->subject->code }}</td>
                      <td class="text-center">{{ $exam->subject->name }}</td>
                      <td class="text-center">{{ $exam->type->name }}</td>
                      <td class="text-center">{{ $exam->schedule->date }}</td>
                      <td class="text-center">{{ $exam->schedule->start_time }} - {{ $exam->schedule->end_time }}</td>
                    </tr>
                    @endif
                  @endforeach
                </tbody>

              </table>                  

            </div>
            
          </div>
        </div>
        @endif
        {{-- /SCHEDULED EXAMS--}}

        {{-- SCHEDULED EXAMS --}}
        @if(!$scheduled_exams->isEmpty())
        <div class="col-12 mt-4 px-0">
          <div class="card">
            <div class="card-header">
              Reschedule requested exams
            </div>
            
            <div class="card-body">
              <p>Click on the status for more information</p>
              <table class="table table-hover">

                <thead>
                  <tr>
                    <th class="text-center">Subject Code</th>
                    <th class="text-center">Subject</th>
                    <th class="text-center">Exam Type</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Time</th>
                    <th class="text-center">Status</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($scheduled_exams as $exam)
                    @if($exam->schedule->date > date('Y-m-d') && $exam->medical!=null)
                    <tr>
                      <td class="text-center">FIT {{ $exam->subject->code }}</td>
                      <td class="text-center">{{ $exam->subject->name }}</td>
                      <td class="text-center">{{ $exam->type->name }}</td>
                      <td class="text-center">{{ $exam->schedule->date }}</td>
                      <td class="text-center">{{ $exam->schedule->start_time }} - {{ $exam->schedule->end_time }}</td>
                      @if($exam->medical->status == "Approved")
                      <td class="text-center text-success"><button data-toggle="popover"  data-placement="left" title="Request Approved" data-content="Wait until we reschedule your exam. If not rescheduled withing two weeks, please contact e-Learning Centre-UCSC" type="button" class="btn btn-success w-100">{{ $exam->medical->status }}</button></td>
                      @elseif($exam->medical->status == "Pending")
                      <td class="text-center text-default"><button data-toggle="popover"  data-placement="left" title="Request Pending" data-content="Your request is being processed. Please wait! If not rescheduled withing two weeks, please contact e-Learning Centre-UCSC" type="button" class="btn btn-warning w-100">{{ $exam->medical->status }}</button></td>
                      @elseif($exam->medical->status == "Declined")   
                      <td class="text-center text-danger"><button data-toggle="popover"  data-placement="left" title="Request Declined" data-content="Your request has been declined due to following reason(s): {{ $exam->medical->declined_message }}" type="button" class="btn btn-danger w-100">{{ $exam->medical->status }}</button></td>                   
                      @endif                      
                    </tr>
                    @endif
                  @endforeach
                </tbody>

              </table>                  

            </div>
            
          </div>
        </div>
        @endif
        {{-- /SCHEDULED EXAMS--}}
        
        {{-- APPLY FOR EXAMS --}}
        <div class="col-12 mt-4 px-0">
          <div class="card">
            <div class="card-header">Apply for Exams</div>
            <div class="card-body">
              <small class="mb-4">*Please select the exams you want to apply(using checkboxes in left side) and select the preferred month for each exam you select.</small>
              <form action="" id="formApplyExam">
                <div class="table-responsive-md mt-4">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Subject</th>
                        <th>Exam Type</th>
                        <th>Requested Exam Month</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($exams_to_apply as $exam_apply)
                      {{-- {{ App\Models\Student\hasExam::where('student_id', Auth::user()->student->id)->where('subject_id', $exam_apply->subject_id)->where('exam_type_id', $exam_apply->exam_type_id)->get() }} --}}
                      @if(App\Models\Student\hasExam::where('student_id', Auth::user()->student->id)->where('subject_id', $exam_apply->subject_id)->where('exam_type_id', $exam_apply->exam_type_id)->get() != NULL)
                      <tr>
                        <td><input type="checkbox" name="{{$exam_apply->id}}" class="apply-exam-check" value="1" /></td>
                        <td>FIT {{ $exam_apply->subject->code}} - {{ $exam_apply->subject->name }}</td>
                        <td>{{ $exam_apply->examType->name }}</td>
                        <td>
                          <select name="{{$exam_apply->id}}-requestedExam" class="requested-exam form-control">
                          <option value="" selected hidden disabled>Select Requested Exam</option>
                          @foreach ($exams as $exam)
                              <option value="{{ $exam->id }}">{{ \Carbon\Carbon::createFromDate($exam->year, $exam->month)->monthName }} {{ $exam->year }}</option>
                          @endforeach
                          </select>
                          <span class="invalid-feedback" id="error-requestedExam" role="alert"></span>
                        </td>
                      </tr>
                      @else
                        
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
                
                {{-- <div class="form-row align-items-center"> --}}
                  {{-- @foreach ($exams_to_apply as $exam_apply)
                  <div class="col-1">
                    <div class="form-check">
                      <input type="checkbox" id="applyExam" name="applyExam" class=" form-check-input" />
                      <label class="form-check-label" for="applyExam-{{$exam_apply->id}}">{{ $exam_apply->subject->name }} ({{ $exam_apply->examType->name}})</label>
                    </div>
                  </div> --}}
                  {{-- <div class="form-group col-xl-4 col-md-12">
                    <label for="applySubject"></label>
                    <span id="applySubject" class="form-control">ICT Application</span>
                  </div>
                  <div class="form-group col-xl-3 col-md-12">
                    <label for="applyExamType"></label>
                    <select name="applyExamType" id="applyExamType" class="form-control">
                      <option value="1">E-Test</option>
                    </select>
                  </div> --}}
                  {{-- <div class="form-group col-4">
                    <label for="applyMonth-{{$exam_apply->id}}"></label>
                    <select name="applyMonth" id="applyMonth-{{$exam_apply->id}}" class="form-control">
                      <option value="" selected hidden disabled>Select Requested Month</option>
                      @foreach ($exams as $exam)
                          <option value="{{ $exam->id }}">{{ \Carbon\Carbon::createFromDate($exam->year, $exam->month)->monthName }} {{ $exam->year }}</option>
                      @endforeach
                    </select>
                  </div>
                  <span class="border-bottom"></span>
                  @endforeach --}}
                {{-- </div> --}}
              </form>
            </div>
            @if(Auth::user()->hasPermission('student-exam-apply-exams') && !$isBlocked)
            <div class="card-footer mb-3">
              <div class="text-center">
                <button type="button" class="btn btn-outline-primary" id="btnApplyForExams" onclick="select_exams()">SELECT EXAMS<span id="spinnerBtnApplyForExams" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
              </div>
            </div>
            @endif
          </div>
        </div>
        {{-- /APPLY FOR EXAMS --}}

        {{-- APPLIED EXAMS TABLE --}}
        {{-- <div class="col-12 mt-4 px-0">
          <div class="card">
            <div class="card-header">Applied Exams</div>
            <div class="card-body">

              <div class="card w-100 shadow-none border border-secondary">
                <div class="card-header text-primary">2020 December</div>
                <div class="card-body"> --}}
                  {{-- <pre>
                    {{$exams}}
                  </pre> --}}
                  {{-- @foreach ($applied_exams as $applied_exam) --}}
                  {{-- Replace with relevant data after make the relationships --}}
                  {{-- <div class="accordion" id="accordion_{{$applied_exam->id}}">
                    <div class="card mb-4 shadow-sm">
                      <div class="card-header text-secondary" id="heading_{{$applied_exam->id}}">
                        FIT {{ $applied_exam->subject_id }} - {{ $applied_exam->subject_id }} ({{ $applied_exam->exam_type_id }})
                        <div class="btn-group float-right">
                          <button class="btn btn-outline-success" type="button" data-toggle="collapse" data-target="#collapse_{{$applied_exam->id}}" aria-expanded="true" aria-controls="collapse_{{$applied_exam->id}}"><i class="far fa-eye"></i> View</button>
                        </div>
                      </div>
                  
                      <div id="collapse_{{$applied_exam->id}}" class="collapse" aria-labelledby="heading_{{$applied_exam->id}}" data-parent="#accordion_{{$applied_exam->id}}">
                        <div class="card-body text-md-center border-top border-secondary">
                          <div class="row">
                            <div class="col-12 col-md-4"> Exam Requested In: {{ $applied_exam->requested_exam_id }}</div>
                            <div class="col-12 offset-md-4 col-md-4 my-3">
                              <button type="button" class="btn btn-outline-danger w-100" data-tooltip="tooltip" data-placement="bottom" title="Cancel Exam"><i class="fas fa-times"></i> Cancel</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>

            </div>
          </div>
        </div> --}}
                
        {{-- SELECTED EXAMS TABLE--}}
        @if(!$selected_exams->isEmpty())
        <div class="col-12 mt-4 px-0">
          <div class="card">
            <div class="card-header">Selected Exams</div>
            <div class="card-body">
                <div class="table-responsive-sm mt-4">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Exam Type</th>
                        <th>Requested Exam On</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($selected_exams as $selected_exam)
                      <tr>
                        <td>FIT {{$selected_exam->subject->code}}</td>
                        <td>{{$selected_exam->subject->name}}</td>
                        <td>{{$selected_exam->type->name}}</td>
                        <td>{{ \Carbon\Carbon::createFromDate($selected_exam->exam->year, $selected_exam->exam->month)->monthName}} {{ $selected_exam->exam->year }}</td>
                        {{-- <td>FIT 103</td>
                        <td>ICT Applications</td>
                        <td>Practical</td>
                        <td>April 2021</td> --}}
                        <td>
                          <div class="btn-group">
                            <button onclick="cancel_selection({{ $selected_exam->id }})" type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Cancel Exam"><i class="fas fa-times"></i> Delete</button>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
            @if(Auth::user()->hasPermission('student-exam-pay-exams') && !$isBlocked)
            <div class="card-footer mb-3">
              <div class="text-center">
                <button type="button" class="btn btn-outline-success" id="btnApplyForExams" onclick="apply_for_exams()"><i class="fa fa-dollar-sign"></i> PAY FOR SELECTED EXAMS<span id="spinnerBtnApplyForExams" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
              </div>
            </div>
            @endif
          </div>
        </div>
        @endif
        {{-- /SELECTED EXAMS TABLE--}}


        {{-- APPLIED EXAMS TABLE--}}
        @if(!$applied_exams->isEmpty())
        <div class="col-12 mt-4 px-0">
          <div class="card">
            <div class="card-header">Applied Exams</div>
            <div class="card-body">
              <div class="table-responsive-sm mt-4">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Subject Code</th>
                      <th>Subject Name</th>
                      <th>Exam Type</th>
                      <th>Requested Exam On</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($applied_exams as $applied_exam)
                    <tr>
                      <td>FIT {{$applied_exam->subject->code}}</td>
                      <td>{{$applied_exam->subject->name}}</td>
                      <td>{{$applied_exam->type->name}}</td>
                      <td>{{ \Carbon\Carbon::createFromDate($applied_exam->exam->year, $applied_exam->exam->month)->monthName}} {{ $applied_exam->exam->year }}</td>
                      {{-- <td>FIT 103</td>
                      <td>ICT Applications</td>
                      <td>Practical</td>
                      <td>April 2021</td> --}}
                      <td>
                        @if($applied_exam->payment_status == 'Approved')
                          <button type="button" class="btn btn-success" data-tooltip="tooltip" data-placement="bottom" title="Approved"><i class="fas fa-check-circle"></i></button>
                        @elseif ($applied_exam->payment_status == 'Declined')
                          <button type="button" class="btn btn-danger" data-tooltip="tooltip" data-placement="bottom" title="View Declined Message" id="btnViewDeclinedMessage-{{ $applied_exam->id }}" onclick="view_exam_declined_message({{ $applied_exam->id }});"><i class="fas fa-exclamation-circle"></i> <i class="fas fa-envelope"></i></button>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
        @endif
        {{-- /APPLIED EXAMS TABLE--}}

        {{-- HELD EXAMS TABLE --}}
        @if(true)
        <div class="col-12 mt-4 px-0">
          <div class="card">
            <div class="card-header">Held Exams</div>
            <div class="card-body">
              @foreach ($held_exams as $exam)
                @if($exam->schedule->date <= date('Y-m-d'))
                  <div class="accordion" id="accordionAbsent_{{$exam->id}}">
                    <div class="card mb-4 shadow-sm">
                      <div class="card-header text-secondary" id="heading_{{$exam->id}}">
                        <div class="row">
                          <div class="col-2 col-md-3 text-center pt-2">FIT {{ $exam->subject->code }}</div>
                          <div class="col-6 col-md-3 text-center pt-2">{{ $exam->subject->name }} ({{ $exam->type->name }})</div>
                          <div class="col-4 col-md-3 text-center pt-2">{{$exam->schedule->date}} ({{ \Carbon\Carbon::create($exam->schedule->start_time)->isoFormat('hh:mm A')}} - {{ \Carbon\Carbon::create($exam->schedule->end_time)->isoFormat('hh:mm A') }})</div>
                          @if(Auth::user()->hasPermission('student-exam-medical'))
                          <div class="col-12 col-md-3 text-center">
                            @if($exam->medical != null && $exam->medical->status=='Pending' && $exam->medical->type == 'reschedule')
                              Reschedule Requested <span class="text-default">(Pending)</span> 
                            @elseif($exam->medical != null && $exam->medical->status=='Approved' && $exam->medical->type == 'reschedule')
                              Reschedule Requested <span class="text-success">(Approved)</span> 
                            @elseif($exam->medical != null && $exam->medical->status=='Declined' && $exam->medical->type == 'reschedule')
                              Reschedule Requested <span class="text-danger">(Declined)</span> <button type="button" class="btn btn-outline-primary w-100" data-toggle="collapse" data-target="#collapseAbsent_{{$exam->id}}" aria-expanded="true" aria-controls="collapseAbsent_{{$exam->id}}"><i class="fas fa-file-medical"></i> Reason to decline</button>
                            @elseif($exam->medical != null && $exam->medical->status=='Pending' && $exam->medical->type == 'medical')
                              <button type="button" class="btn btn-outline-warning w-100" data-toggle="collapse" data-target="#collapseAbsent_{{$exam->id}}" aria-expanded="true" aria-controls="collapseAbsent_{{$exam->id}}">Issue Report Approval Pending</button>
                            @elseif($exam->medical != null &&  $exam->medical->status=='Approved'  && $exam->medical->type == 'medical' )
                              <button type="button" class="btn btn-outline-success w-100" data-toggle="collapse" data-target="#collapseAbsent_{{$exam->id}}" aria-expanded="true" aria-controls="collapseAbsent_{{$exam->id}}">Issue Report Approved</button>
                            @elseif($exam->medical != null &&  $exam->medical->status=='Declined'  && $exam->medical->type == 'medical' )
                              <button type="button" class="btn btn-outline-danger w-100" data-toggle="collapse" data-target="#collapseAbsent_{{$exam->id}}" aria-expanded="true" aria-controls="collapseAbsent_{{$exam->id}}">Issue Report Declined</button>
                              @elseif($exam->medical != null &&  $exam->medical->status=='Resubmit' && $exam->medical->type == 'medical')
                              <button type="button" class="btn btn-outline-secondary w-100" data-toggle="collapse" data-target="#collapseAbsent_{{$exam->id}}" aria-expanded="true" aria-controls="collapseAbsent_{{$exam->id}}">Resubmit Issue Report</button>
                            @elseif(\Carbon\Carbon::now() <= \Carbon\Carbon::create($exam->schedule->date)->addDays(15) )
                              <button type="button" class="btn btn-outline-primary w-100" data-toggle="collapse" data-target="#collapseAbsent_{{$exam->id}}" aria-expanded="true" aria-controls="collapseAbsent_{{$exam->id}}"><i class="fas fa-file-medical"></i> Report Issue</button>
                            @endif
                          </div>
                          @endif
                        </div>
                      </div>
                  
                      <div id="collapseAbsent_{{$exam->id}}" class="collapse" aria-labelledby="heading_{{$exam->id}}" data-parent="#accordionAbsent_{{$exam->id}}">
                        <div class="card-body text-md-center border-top border-secondary">
                          <div class="row">
                            {{-- <div class="col-12 col-md-4"> Date : {{ $exam->schedule->date }}</div>
                            <div class="col-12 col-md-4"> Start Time : {{ $exam->schedule->start_time }}</div>
                            <div class="col-12 col-md-4"> End Time : {{ $exam->schedule->end_time }}</div> --}}
                            @if($exam->medical != null && $exam->medical->status=='Pending'  && $exam->medical->type == 'medical' )

                              <div class="col-12">
                                <div class="alert alert-light" role="alert">
                                  {{ $exam->medical->reason }}
                                </div>
                                <div onclick="window.open('{{ asset('storage/medicals/'.$exam->student_id.'/'.$exam->medical->image)}}')" class="drop-zone" style="background: url({{ asset('storage/medicals/'.$exam->student_id.'/'.$exam->medical->image)}}) no-repeat center; background-size: cover; cursor: pointer;">
                                </div>
                              </div>


                            @elseif($exam->medical != null && $exam->medical->status=='Approved'  && $exam->medical->type == 'medical')

                              <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                  <h4 class="alert-heading">Issue Report Approved</h4>
                                  <p>Your exam will be re-scheduled and will be notified</p>
                                  <hr>
                                  <p class="mb-0">If not notified in two weeks, call e-Learning Center, UCSC for inquiries</p>
                                </div>
                              </div>


                            @elseif($exam->medical != null && $exam->medical->status=='Declined'  && $exam->medical->type == 'medical' )    
                            
                              <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                  <h4 class="alert-heading">Issue Report Decline</h4>
                                  <p>You may have to re-apply for the exams</p>
                                  <hr>
                                  <p class="mb-0">Call e-Learning Center, UCSC for inquiries</p>
                                </div>
                              </div>

                            @elseif($exam->medical != null && $exam->medical->status=='Resubmit'  && $exam->medical->type == 'medical' )
                              <div class="col-12">
                                <div class="alert alert-info" role="alert">
                                  {{-- <h4 class="alert-heading">Declined Reason</h4> --}}
                                  <p><b>Reason of Decline the Issue Report: </b>{{$exam->medical->declined_message}}</p>
                                </div>
                                {{-- <div class="col-12">
                                  <button type="button" class="btn btn-outline-primary w-100" data-toggle="collapse" data-target="#collapseMedical_{{$exam->id}}" aria-expanded="true" aria-controls="collapseMedical_{{$exam->id}}">Resubmit Medical</button>
                                </div> --}}
                              </div>

                              <div class="col-12 mt-4">
                                <form id="{{$exam->id}}-medicalUploadform">
                                  <div class="form-group ">
                                    <label for="inputPaidAmount" class="col-12 col-form-label">Reason</label>
                                    <div class="col-12">
                                      <input type="text" class="form-control" id="{{ $exam->id }}-reason" name="reason" placeholder="Please enter the reason to absent at exam.">
                                      <span class="invalid-feedback" id="{{ $exam->id }}-error-reason" role="alert"></span>
                                    </div>
                                  </div>
                                  <div class="form-group mx-2">
                                    <span id="InputMedicalHelp" class="form-text text-muted">Upload your scanned supporting document here in JPEG/ PNG file format. Maximum file size: 5mb</span>
                                    <div class="drop-zone">
                                      <span class="drop-zone__prompt">Scanned Supporting Document <br><small>Drop image File here or click to upload</small> </span>
                                      <input type="file" name="medical" id="{{ $exam->id }}-medical" class="drop-zone__input form-control"/>
                                    </div>
                                    <span class="invalid-feedback" id="{{ $exam->id }}-error-medical" role="alert"></span>
                                  </div>
                                </form>
                              </div>
                              <div class="col-12">
                                <button class="btn btn-outline-primary w-100" onclick="upload_medical({{ $exam->id }})">
                                  Upload
                                  <span id="{{$exam->id}}-spinnermedicalUpload" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span>
                                </button>
                              </div>
                            @else
                            @if($exam->medical != null && $exam->medical->status=='Declined' && $exam->medical->type == 'reschedule')
                            <div class="col-12">
                              <div class="alert alert-info" role="alert">
                                <p><b>Reason of Decline the Reschedule Request: </b>{{$exam->medical->declined_message}}</p>
                              </div>
                            </div>
                            @else
                              <div class="col-12">                                
                                <form id="{{$exam->id}}-medicalUploadform">
                                  <div class="form-group ">                                
                                    <label for="inputPaidAmount" class="col-12 col-form-label">Reason</label>
                                    <div class="col-12">
                                      <input type="text" class="form-control" id="{{ $exam->id }}-reason" name="reason">
                                      <span class="invalid-feedback" id="{{ $exam->id }}-error-reason" role="alert"></span>
                                    </div>
                                  </div>
                                  <div class="form-group mx-2">
                                    <span id="InputMedicalHelp" class="form-text text-muted">Upload your scanned supporting document here in JPEG/ PNG file format. Maximum file size: 5mb</span>
                                    <div class="drop-zone">
                                      <span class="drop-zone__prompt">Scanned Supporting Document <br><small>Drop image File here or click to upload</small> </span>
                                      <input type="file" name="medical" id="{{ $exam->id }}-medical" class="drop-zone__input form-control"/>
                                    </div>
                                    <span class="invalid-feedback" id="{{ $exam->id }}-error-medical" role="alert"></span>
                                  </div>
                                </form>
                              </div>
                              <div class="col-12">
                                <button class="btn btn-outline-primary w-100" onclick="upload_medical({{ $exam->id }})">
                                  Upload
                                  <span id="{{$exam->id}}-spinnermedicalUpload" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span>
                                </button>
                              </div> 
                              @endif                             
                            @endif
                            {{-- <div class="col-12 offset-md-4 col-md-4 my-3">
                              <button type="button" class="btn btn-outline-primary w-100" data-tooltip="tooltip" data-placement="bottom" title="Apply Exam" onclick="window.open('/portal/student/payment')"><i class="far fa-hand-point-right"></i> Apply</button>
                            </div> --}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                @endif
              @endforeach


                {{-- <ul class="list-group list-group-flush">
                  @foreach ($absent_exams as $exam)
                    @if($exam->schedule->date <= date('Y-m-d'))
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-12 col-md-3">FIT {{ $exam->subject->code }}</div>
                          <div class="col-12 col-md-3">{{ $exam->subject->name }} ({{ $exam->type->name }})</div>
                          <div class="col-12 col-md-3">{{$exam->schedule->date}}</div>
                          <div class="col-12 col-md-3 text-md-right">
                            <button type="button" class="btn btn-outline-danger w-100"><i class="fas fa-file-medical"></i> Upload medical</button>
                          </div>
                        </div>
                        
                      </li>
                    @endif
                  @endforeach
                </ul> --}}
            </div>
          </div>
        </div>
        @endif
        {{-- /HELD EXAMS TABLE--}}

      </div>
    </div>
    {{-- /CONTENT --}}
    @include('portal.student.exams.scripts')
    @include('portal.student.exams.modal')
@endsection
