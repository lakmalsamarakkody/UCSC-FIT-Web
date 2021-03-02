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
        {{-- APPLY FOR EXAMS --}}
        <div class="col-12 mt-4 px-0">
          <div class="card">
            <div class="card-header">Apply for Exams</div>
            <div class="card-body">
              <div class="card w-100 shadow-none border border-secondary">
                <div class="card-body">
                  <small class="mb-4">*Please select the exams you want to apply(using checkboxes in left side) and select the prefered month for each exam you select.</small>
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
                          <tr>
                            <td><input type="checkbox" name="applyExamCheck[]" class="apply-exam-check" value="{{$exam_apply->id}}" /></td>
                            <td><input type="text" name="applySubject[]" value="{{ $exam_apply->id }}" class="apply-subject" hidden />FIT {{ $exam_apply->subject->code}} - {{ $exam_apply->subject->name }}</td>
                            <td><input type="text" name="applyExamType[]" value="{{ $exam_apply->exam_type_id }}" class="apply-exam-type form-control" hidden />{{ $exam_apply->examType->name }}</td>
                            <td>
                              <select name="requestedExam" class="requested-exam form-control">
                              <option value="" selected hidden disabled>Select Requested Exam</option>
                              @foreach ($exams as $exam)
                                  <option value="{{ $exam->id }}">{{ \Carbon\Carbon::createFromDate($exam->year, $exam->month)->monthName }} {{ $exam->year }}</option>
                              @endforeach
                              </select>
                              <span class="invalid-feedback" id="error-requestedExam" role="alert"></span>
                            </td>
                          </tr>
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
              </div>
            </div>
            <div class="card-footer">
              <div class="text-center">
                <button type="button" class="btn btn-outline-primary" id="btnApplyForExams" onclick="apply_for_exams({{$student->id}})">APPLY FOR SELECTED EXAMS<span id="spinnerBtnApplyForExams" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
              </div>
            </div>
          </div>
        </div>
        {{-- /APPLY FOR EXAMS --}}

        <!-- APPLIED EXAMS TABLE -->
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

        <div class="col-12 mt-4 px-0">
          <div class="card">
            <div class="card-header">Applied Exams</div>
            <div class="card-body">
              <div class="card w-100 shadow-none border border-secondary">
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
                            <div class="btn-group">
                              <button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Cancel Exam"><i class="fas fa-times"></i> Cancel</button>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /APPLIED EXAMS TABLE-->

        <!-- SCHEDULED EXAMS -->
        <div class="col-12 mt-4 px-0">
          <div class="card">
            <div class="card-header">Scheduled Exams</div>
            <div class="card-body">

              <div class="card w-100 shadow-none border border-secondary">
                <div class="card-header text-primary">2020 December</div>
                <div class="card-body">
                  {{-- <pre>
                    {{$exams}}
                  </pre> --}}
                  @foreach ($scheduled_exams as $exam)
                  <div class="accordion" id="accordion_{{$exam->id}}">
                    <div class="card mb-4 shadow-sm">
                      <div class="card-header text-secondary" id="heading_{{$exam->id}}">
                        FIT {{ $exam->subject->code }} - {{ $exam->subject->name }} ({{ $exam->type->name }})
                        <div class="btn-group float-right">
                          <button class="btn btn-outline-success" type="button" data-toggle="collapse" data-target="#collapse_{{$exam->id}}" aria-expanded="true" aria-controls="collapse_{{$exam->id}}"><i class="far fa-eye"></i> View</button>
                        </div>
                      </div>
                  
                      <div id="collapse_{{$exam->id}}" class="collapse" aria-labelledby="heading_{{$exam->id}}" data-parent="#accordion_{{$exam->id}}">
                        <div class="card-body text-md-center border-top border-secondary">
                          <div class="row">
                            <div class="col-12 col-md-4"> Date : {{ $exam->schedule->date }}</div>
                            <div class="col-12 col-md-4"> Start Time : {{ $exam->schedule->start_time }}</div>
                            <div class="col-12 col-md-4"> End Time : {{ $exam->schedule->end_time }}</div>
                            {{-- <div class="col-12 offset-md-4 col-md-4 my-3">
                              <button type="button" class="btn btn-outline-primary w-100" data-tooltip="tooltip" data-placement="bottom" title="Apply Exam" onclick="window.open('/portal/student/payment')"><i class="far fa-hand-point-right"></i> Apply</button>
                            </div> --}}
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
        </div>
        <!-- /SCHEDULED EXAMS-->

        <!-- ABSENT EXAMS TABLE -->
        <div class="col-12 mt-4 px-0">
          <div class="card">
            <div class="card-header">Absent Exams</div>
            <div class="card-body">
              <div class="card w-100 shadow-none border border-secondary">
                <div class="card-header text-primary">2020 December</div>
                <ul class="list-group list-group-flush">
                  @foreach ($absent_exams as $exam)
                  <li class="list-group-item">
                    <div class="row">
                      <div class="col-12 col-md-3">FIT {{ $exam->subject->code }}</div>
                      <div class="col-12 col-md-3">{{ $exam->subject->name }} ({{ $exam->type->name }})</div>
                      <div class="col-12 col-md-3">{{$exam->schedule->date}}</div>
                      <div class="col-12 col-md-3 text-md-right">
                        <button type="button" class="btn btn-outline-danger w-100" data-tooltip="tooltip" data-placement="bottom" title="Upload Medical"><i class="fas fa-file-medical"></i> Upload medical</button>
                      </div>
                    </div>
                    
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- /ABSENT EXAMS TABLE-->

      </div>
    </div>
    <!-- /CONTENT -->
    @include('portal.student.exams.scripts')
@endsection
