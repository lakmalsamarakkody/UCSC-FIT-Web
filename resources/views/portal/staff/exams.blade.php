@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#exams').addClass("active");
    });

</script>
    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Exams</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->

    <!-- CONTENT -->
    <div class="col-12 staff-exams">
      <div class="row">

        {{-- EXAM LIST --}}
        <div class="col-lg-3 col-md-6 col-12">
          <a href="/portal/staff/exams/list" style="text-decoration: none">
            <div class="card">
              <div class="card-header bg-primary text-center py-4 text-white">Exam List</div>
            </div>
          </a>
        </div>
        {{-- /EXAM LIST --}}

        <!-- CREATE EXAM SCHEDULE -->
        <div class="col-12 mb-5 mt-4">
          <div class="card">
            <div class="card-header">Create Exam Schedule</div>
            <div class="card-body">
              <form action="" method="POST" id="formCreateSchedule">
                <div class="form-row align-items-center px-4">
                  <div class="form-group col-xl-2 col-lg-4">
                    <label for="scheduleExam">Exam</label>
                    <select name="scheduleExam" id="scheduleExam" class="form-control">
                      <option value="" selected>Select Exam</option>
                      @foreach ($schedule_exams as $exam)
                          <option value="{{$exam->id}}">{{$exam->year}}-{{$exam->month}}</option>
                      @endforeach
                    </select>
                    <span class="invalid-feedback" id="error-scheduleExam" role="alert"></span>
                  </div>
                  <div class="form-group col-xl-3 col-lg-4">
                    <label for="scheduleSubject">Subejct</label>
                    <select name="scheduleSubject" id="scheduleSubject" class="form-control">
                      <option value="" selected>Select Subject</option>
                      @foreach ($subjects as $subject)
                      <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                      @endforeach
                    </select>
                    <span class="invalid-feedback" id="error-scheduleSubject" role="alert"></span>
                  </div>
                  <div class="form-group col-xl-2 col-lg-4">
                    <label for="scheduleExamType">Exam Type</label>
                    <select name="scheduleExamType" id="scheduleExamType" class="form-control">
                      <option value="" selected>Select Exam Type</option>
                      @foreach ($exam_types as $type)
                          <option value="{{ $type->id }}">{{ $type->name }}</option>
                      @endforeach
                    </select>
                    <span class="invalid-feedback" id="error-scheduleExamType" role="alert"></span>
                  </div>
                  <div class="form-group col-xl-2 col-lg-6">
                    <label for="scheduleDate">Date</label>
                    <input type="date" id="scheduleDate" name="scheduleDate" class="form-control"/>
                    <span class="invalid-feedback" id="error-scheduleDate" role="alert"></span>
                  </div>
                  <div class="form-group col-xl-2 col-lg-6">
                    <label for="scheduleStartTime">Start Time</label>
                    <input type="time" id="scheduleStartTime" name="scheduleStartTime" class="form-control"/>
                    <span class="invalid-feedback" id="error-scheduleStartTime" role="alert"></span>
                  </div>
                  {{-- <div class="form-group col-xl-1 col-lg-4">
                    <label for="endTime">End Time</label>
                    <input type="time" name="endTime" class="form-control"/>
                  </div> --}}
                  <div class="form-group col-xl-1 col-lg-12 text-center">
                    <label for="btnCreateSchedule">&nbsp;</label>
                    <button type="button" class="btn btn-outline-primary form-control" onclick="create_schedule();" id="btnCreateSchedule" name="btnCreateSchedule"><i class="fas fa-plus"></i></button>
                  </div>
                  <div class="form-group col-xl-12 col-lg-12 text-center">
                    <input type="hidden" id="schedule" name="schedule" class="form-control">
                    <span class="invalid-feedback" id="error-schedule" role="alert"></span>
                  </div>
                </div>
              </form>

              <div class="col-12 mt-5">
                <table class="table schedules-before-release-yajradt">
                  <thead class="text-center">
                    <tr>
                      <th>Exam</th>
                      <th>Subject Code</th>
                      <th>Subject Name</th>
                      <th>Exam Type</th>
                      <th>Date</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody class="text-center" id="shedulesBeforeReleaseTblBody">
                    {{-- @foreach ($upcoming_schedules as $schedule)
                    <tr id="tbl-examSchedule-tr-{{$schedule->id}}">
                      <td>{{ $schedule->exam->year}}-{{$schedule->exam->month}}</td>
                      <td>FIT {{ $schedule->subject->code }}</td>
                      <td>{{ $schedule->subject->name }}</td>
                      <td>{{ $schedule->type->name }}</td>
                      <td>{{ $schedule->date }}</td>
                      <td>{{ $schedule->start_time }}</td>
                      <td>{{ $schedule->end_time }}</td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-outline-success" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Approve" onclick="approve_schedule()"><i class="fas fa-file-signature"></i></button>
                          <button type="button" class="btn btn-outline-info" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Request Approval" onclick="request_schedule_approval()"><i class="fas fa-share-square"></i></button>
                          <button type="button" class="btn btn-outline-primary" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Release" onclick="relase_individual_schedule()" ><i class="fas fa-hand-point-right"></i></button>
                          <button type="button" class="btn btn-outline-warning" data-tooltip="tooltip" data-placement="bottom" title="Edit" id="btnEditSchedule-{{$schedule->id}}" onclick="edit_schedule_modal_invoke({{$schedule->id}});"><i class="fas fa-edit"></i></button>
                          <button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Delete" id="btnDeleteExamSchedule-{{$schedule->id}}" onclick="delete_before_release({{$schedule->id}})"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </td>
                    </tr>
                    @endforeach --}}
                  </tbody>
                </table>
                {{-- <div class="pt-4 float-right">
                  {{ $upcoming_schedules->withQueryString()->appends(['upcoming' => $upcoming_schedules->currentPage()])->links("pagination::bootstrap-4") }}
                </div> --}}
                <div class="text-center">
                  <button type="submit" class="btn btn-outline-primary" onclick="release_schedules()">RELEASE EXAM SCHEDULE</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /CREATE EXAM SCHEDULE -->

        <!-- EXAM SCHEDULE TABLE -->
        <div class="col-12 md-5">
          <div class="card">
            <div class="card-header">Exam Schedules</div>
            <div class="card-body">
              <table class="table schedules-after-release-yajradt">
                <thead class="text-center">
                  <tr>
                    <th>Exam</th>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Exam Type</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody class="text-center" id="shedulesAfterReleaseTblBody">
                  {{-- @foreach ($upcoming_schedules as $schedule)
                  <tr class="text-center">
                    <td>{{ $schedule->exam->year}}-{{$schedule->exam->month}}</td>
                    <td>FIT {{ $schedule->subject->code }}</td>
                    <td>{{ $schedule->subject->name }}</td>
                    <td>{{ $schedule->type->name }}</td>
                    <td>{{ $schedule->date }}</td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-outline-warning" data-tooltip="tooltip" data-placement="bottom" title="Postpone Exam" data-toggle="modal" data-target="#postponeExam"><i class="fas fa-calendar-plus"></i></button>
                        <button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Delete" onclick="delete_after_release();"><i class="fas fa-trash-alt"></i></button>
                      </div>
                    </td>
                  </tr>
                  @endforeach --}}
                </tbody>
              </table>

            </div>
          </div>
        </div>
        <!-- /EXAM SCHEDULE TABLE-->

        <!-- EXAMS HELD -->
        <div class="col-12 mt-5">
          <div class="card">
            <div class="card-header">Exams Held</div>
            <div class="card-body">
              <!-- SEARCH -->
              <form>
                <div class="form-row mb-5">
                  <div class="form-group col-xl-2 col-lg-4">
                    <label for="searchExamYear">Year</label>
                    <select name="searchExamYear" id="searchExamYear" class="form-control">
                      <option value="" selected>Select Year</option>
                      @foreach ($years as $year)
                          <option value="{{$year->year}}">{{$year->year}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-xl-2 col-lg-4">
                    <label for="searchExam">Exam</label>
                    <select name="searchExam" id="searchExam" class="form-control">
                      <option value="" selected>Select Exam</option>
                      @foreach ($search_exams as $exam)   
                        <option value="{{$exam->id}}">{{$exam->year}}-{{$exam->month}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-xl-2 col-lg-4">
                    <label for="searchExamDate">Date</label>
                    <input type="date" class="form-control" id="searchExamDate" name="searchExamDate" />
                  </div>
                  <div class="form-group col-xl-2 col-lg-6">
                    <label for="searchSubject">Subject</label>
                    <select name="searchSubject" id="searchSubject" class="form-control">
                      <option value="" selected>Select Subject</option>
                      @foreach ($subjects as $subject)
                          <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-xl-2 col-lg-6">
                    <label for="searchExamType">Exam Type</label>
                    <select name="searchExamType" id="searchExamType" class="form-control">
                      <option value="" selected>Select Type</option>
                        @foreach ($exam_types as $type)
                          <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group col-xl-2 col-lg-12">
                    <label for="btnSearchExamSchedule">&nbsp;</label>
                    <button type="button" class="btn btn-outline-primary form-control" onclick="searchHeldExams();" id="btnSearchExamSchedule" name="btnSearchExamSchedule"><i class="fa fa-search"></i> Search</button>
                  </div>
                </div>
              </form>
              <!-- /SEARCH -->
              
              <!-- HELD EXAM TABLE -->
              <table class="table mb-4 held-exam-schedules-yajradt">
                <thead class="text-center">
                  <tr>
                    <th>Exam</th>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Exam Type</th>
                    <th>Date</th>
                    <th>Started Time</th>
                    <th>Ended Time</th>
                  </tr>
                </thead>
                <tbody class="text-center" id="heldScheduleTblBody">
                  {{-- @foreach ($exam_schedules as $schedule)
                  <tr>
                    <td>{{ $schedule->exam->year}}-{{$schedule->exam->month}}</td>
                    <td>FIT {{ $schedule->subject->code }}</td>
                    <td>{{ $schedule->subject->name }}</td>
                    <td>{{ $schedule->type->name }}</td>
                    <td>{{ $schedule->date }}</td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                  </tr>   
                  @endforeach --}}
                </tbody>
              </table>
              {{-- <div class="pt-4 float-right">
                {{ $exam_schedules->appends(['held' => $exam_schedules->currentPage()])->links("pagination::bootstrap-4") }}
                {{ $exam_schedules->withQueryString()->appends(['held' => $exam_schedules])->links("pagination::bootstrap-4") }}
              </div> --}}
              <!-- /HELD EXAM TABLE -->

          </div>

          </div>
          
        </div>
        <!-- /EXAMS HELD -->

        @include('portal.staff.exams.modal')

      </div>
    </div>

    <!-- /CONTENT -->

    @include('portal.staff.exams.scripts')

@endsection
