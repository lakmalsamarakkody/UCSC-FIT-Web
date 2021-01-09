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

        <!-- CREATE EXAM SCHEDULE -->
        <div class="col-12 mb-5">
          <div class="card">
            <div class="form-group col-12 mt-4 mb-2">
              <a href="/portal/staff/exams/list" target="_blank"><button type="button" class="btn btn-outline-primary form-control" id="btnExamList">Exam List</button></a>
            </div>
            <div class="card-header">Create Exam Schedule</div>
            <div class="card-body">
              <form action="" method="POST" id="formCreateSchedule">
                <div class="form-row align-items-center px-4">
                  <div class="form-group col-xl-2 col-lg-4">
                    <label for="scheduleExam">Exam</label>
                    <select name="scheduleExam" id="scheduleExam" class="form-control">
                      <option value="Default" disabled selected>Select Exam</option>
                      @foreach ($exams as $exam)
                          <option value="{{$exam->id}}">{{$exam->year}}-{{$exam->month}}</option>
                      @endforeach
                    </select>
                    <span class="invalid-feedback" id="error-scheduleExam" role="alert"></span>
                  </div>
                  <div class="form-group col-xl-3 col-lg-4">
                    <label for="scheduleSubject">Subejct</label>
                    <select name="scheduleSubject" id="scheduleSubject" class="form-control">
                      @foreach ($subjects as $subject)
                      <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                      @endforeach
                    </select>
                    <span class="invalid-feedback" id="error-scheduleSubject" role="alert"></span>
                  </div>
                  <div class="form-group col-xl-2 col-lg-4">
                    <label for="scheduleExamType">Exam Type</label>
                    <select name="scheduleExamType" id="scheduleExamType" class="form-control">
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
                  
                </div>
              </form>

              <div class="col-12 mt-5">
                <table class="table yajra-datatable">
                  <thead class="text-center">
                    <tr>
                      <th>Subject Code</th>
                      <th>Subject Name</th>
                      <th>Exam Type</th>
                      <th>Date</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    @foreach ($exam_schedules as $schedule)
                    <tr>
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
                          <button type="button" class="btn btn-outline-warning" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Edit" data-target="#editSchedule"><i class="fas fa-edit"></i></button>
                          <button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Delete" onclick="delete_before_release()"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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
              <table class="table yajra-datatable">
                <thead class="text-center">
                  <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Exam Type</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($exam_schedules as $schedule)
                  <tr class="text-center">
                    <td>FIT {{ $schedule->subject->code }}</td>
                    <td>{{ $schedule->subject->name }}</td>
                    <td>{{ $schedule->type->name }}</td>
                    <td>{{ $schedule->date }}</td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-outline-warning" data-tooltip="tooltip" data-placement="bottom" title="Postpone Exam" data-toggle="modal" data-target="#postponeExam"><i class="fas fa-calendar-plus"></i></button>
                        <button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Delete" onclick="delete_after_release()"><i class="fas fa-trash-alt"></i></button>
                      </div>
                    </td>
                  </tr>
                  @endforeach
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
                  <div class="form-group col-xl-2 col-lg-3">
                    <label for="selectSearchExamYear">Year</label>
                    <select name="selectSearchExamYear" id="selectSearchExamYear" class="form-control">
                      <option value="">2017</option>
                      <option value="">2018</option>
                      <option value="">2019</option>
                      <option value="">2020</option>
                    </select>
                  </div>
                  <div class="form-group col-xl-2 col-lg-3">
                    <label for="selectSearchExamDate">Date</label>
                    <input type="date" class="form-control" id="selectSearchExamDate" name="selectSearchExamDate" />
                  </div>
                  <div class="form-group col-xl-2 col-lg-3">
                    <label for="selectSearchExamType">Exam Type</label>
                    <select name="selectSearchExamType" id="selectSearchExamType" class="form-control">
                      @foreach ($exam_types as $type)
                          <option value="{{ $type->id }}">{{ $type->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-xl-3 col-lg-3">
                    <label for="selectSearchSubject">Subject</label>
                    <select name="selectSearchSubject" id="selectSearchSubject" class="form-control">
                      @foreach ($subjects as $subject)
                      <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                      @endforeach
                     
                    </select>
                  </div>
                  <div class="form-group col-xl-3 col-lg-12">
                    <label for="btnSearchExamSchedule">&nbsp;</label>
                    <button type="button" class="btn btn-outline-primary form-control" onclick="" id="btnSearchExamSchedule" name="btnSearchExamSchedule"><i class="fa fa-search"></i> Search</button>
                  </div>

                </div>
              </form>
              <!-- /SEARCH -->
              
              <!-- HELD EXAM TABLE -->
              <table class="table yajra-datatable mb-4">
                <thead class="text-center">
                  <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Exam Type</th>
                    <th>Date</th>
                    <th>Started Time</th>
                    <th>Ended Time</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($exam_schedules as $schedule)
                  <tr class="text-center">
                    <td>FIT {{ $schedule->subject->code }}</td>
                    <td>{{ $schedule->subject->name }}</td>
                    <td>{{ $schedule->type->name }}</td>
                    <td>{{ $schedule->date }}</td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                  </tr>
                      
                  @endforeach
                </tbody>
              </table>
              <!-- /HELD EXAM TABLE -->

          </div>

          </div>
          
        </div>
        <!-- /EXAMS HELD -->

        @include('portal.staff.exams.modal')

      </div>
    </div>

    <!-- /CONTENT -->



    <!-- HEADING -->

    <!--
    <div class="col-lg-12 mt-5">
        <div class="row">
          
          <div class="card w-100">
              <div class="card-header">{{ __('Dashboard') }}</div>

              <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  {{ __('You are logged in as Staff!') }}
              </div>
          </div>

      </div>
    </div> -->

    @include('portal.staff.exams.scripts')

@endsection
