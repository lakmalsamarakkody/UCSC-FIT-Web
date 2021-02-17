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
                  <small class="mb-4">*Please check the exams you want to apply and select the requested month for each.</small>
                  <form action="" id="formApplyExam">
                    <div class="form-row align-items-center">
                      @foreach ($exams_to_apply as $exam_apply)
                      <div class="col-8">
                        <div class="form-check">
                          <input type="checkbox" id="applyExam-{{$exam_apply->id}}" class=" form-check-input" />
                          <label class="form-check-label" for="applyExam-{{$exam_apply->id}}">{{ $exam_apply->subject->name }} ({{ $exam_apply->examType->name}})</label>
                        </div>
                      </div>
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
                      <div class="form-group col-4">
                        <label for="applyExam-{{$exam_apply->id}}"></label>
                        <select name="applyExam-{{$exam_apply->id}}" id="applyExam-{{$exam_apply->id}}" class="form-control">
                          <option value="" selected hidden disabled>Select Requested Month</option>
                          @foreach ($exams as $exam)
                              <option value="{{ $exam->id }}">{{ \Carbon\Carbon::createFromDate($exam->year, $exam->month)->monthName }} {{ $exam->year }}</option>
                          @endforeach
                        </select>
                      </div>
                      <span class="border-bottom"></span>
                      @endforeach
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="text-center">
                <button type="button" class="btn btn-outline-primary" id="btnApplyExams" onclick="apply_for_exams()">APPLY FOR SELECTED EXAMS<span id="spinnerBtnApplyExams" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
              </div>
            </div>
          </div>
        </div>
        {{-- /APPLY FOR EXAMS --}}

        <!-- UPCOMING EXAM SCHEDULE -->
        <div class="col-12 mt-4 px-0">
          <div class="card">
            <div class="card-header">Upcoming Schedules</div>
            <div class="card-body">

              <div class="card w-100 shadow-none border border-secondary">
                <div class="card-header text-primary">2020 December</div>
                <div class="card-body">
                  {{-- <pre>
                    {{$exams}}
                  </pre> --}}
                  @foreach ($schedule as $exam)
                  <div class="accordion" id="accordion_{{$exam->exam_id}}">
                    <div class="card mb-4 shadow-sm">
                      <div class="card-header text-secondary" id="heading_{{$exam->exam_id}}">
                        FIT {{ $exam->subject->code }} - {{ $exam->subject->name }} ({{ $exam->type->exam_type }})
                        <div class="btn-group float-right">
                          <button class="btn btn-outline-success" type="button" data-toggle="collapse" data-target="#collapse_{{$exam->exam_id}}" aria-expanded="true" aria-controls="collapse_{{$exam->exam_id}}"><i class="far fa-eye"></i> View</button>
                        </div>
                      </div>
                  
                      <div id="collapse_{{$exam->exam_id}}" class="collapse" aria-labelledby="heading_{{$exam->exam_id}}" data-parent="#accordion_{{$exam->exam_id}}">
                        <div class="card-body text-md-center border-top border-secondary">
                          <div class="row">
                            <div class="col-12 col-md-4"> Date : {{ $exam->date }}</div>
                            <div class="col-12 col-md-4"> Start Time : {{ $exam->start_time }}</div>
                            <div class="col-12 col-md-4"> End Time : {{ $exam->end_time }}</div>
                            <div class="col-12 offset-md-4 col-md-4 my-3">
                              <button type="button" class="btn btn-outline-primary w-100" data-tooltip="tooltip" data-placement="bottom" title="Apply Exam" onclick="window.open('/portal/student/payment')"><i class="far fa-hand-point-right"></i> Apply</button>
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
        </div>
        <!-- /UPCOMING EXAM SCHEDULE-->

        <!-- APPLIED EXAMS TABLE -->
        <div class="col-12 mt-4 px-0">
          <div class="card">
            <div class="card-header">Applied Exams</div>
            <div class="card-body">

              <div class="card w-100 shadow-none border border-secondary">
                <div class="card-header text-primary">2020 December</div>
                <div class="card-body">
                  {{-- <pre>
                    {{$exams}}
                  </pre> --}}
                  @foreach ($schedule as $exam)
                  <div class="accordion" id="accordion_{{$exam->exam_id}}">
                    <div class="card mb-4 shadow-sm">
                      <div class="card-header text-secondary" id="heading_{{$exam->exam_id}}">
                        FIT {{ $exam->subject->code }} - {{ $exam->subject->name }} ({{ $exam->type->exam_type }})
                        <div class="btn-group float-right">
                          <button class="btn btn-outline-success" type="button" data-toggle="collapse" data-target="#collapse_{{$exam->exam_id}}" aria-expanded="true" aria-controls="collapse_{{$exam->exam_id}}"><i class="far fa-eye"></i> View</button>
                        </div>
                      </div>
                  
                      <div id="collapse_{{$exam->exam_id}}" class="collapse" aria-labelledby="heading_{{$exam->exam_id}}" data-parent="#accordion_{{$exam->exam_id}}">
                        <div class="card-body text-md-center border-top border-secondary">
                          <div class="row">
                            <div class="col-12 col-md-4"> Date : {{ $exam->date }}</div>
                            <div class="col-12 col-md-4"> Start Time : {{ $exam->start_time }}</div>
                            <div class="col-12 col-md-4"> End Time : {{ $exam->end_time }}</div>
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
        </div>
        <!-- /APPLIED EXAMS TABLE-->

        <!-- FACED EXAMS TABLE -->
        <div class="col-12 mt-4 px-0">
          <div class="card">
            <div class="card-header">Faced Exams</div>
            <div class="card-body">

              <h5>2020 November</h5>

              <ul class="list-group list-group-flush">
                @foreach ($schedule as $exam)
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-12 col-md-4">FIT {{ $exam->subject->code }}</div>
                    <div class="col-12 col-md-4">{{ $exam->subject->name }} ({{ $exam->type->exam_type }})</div>
                    <div class="col-12 col-md-4 text-md-right">
                      <button type="button" class="btn btn-outline-danger w-100" data-tooltip="tooltip" data-placement="bottom" title="Upload Medical"><i class="fas fa-file-medical"></i> Upload medical</button>
                    </div>
                  </div>
                  
                </li>
                @endforeach
              </ul>

            </div>
          </div>
        </div>
        <!-- /FACED EXAMS TABLE-->

      </div>
    </div>
    <!-- /CONTENT -->
@endsection
