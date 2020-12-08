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
            <div class="card-header">Create Exam Schedule</div>
            <div class="card-body">
              <form>
                <div class="form-row align-items-center px-4">
                  <div class="form-group col-xl-3 col-lg-6">
                    <label for="subject">Subejct</label>
                    <select name="subject" id="subject" class="form-control">
                      <option value="">ICT Applications</option>
                      <option value="">English for ICT</option>
                      <option value="">Mathematics for ICT</option>
                    </select>
                  </div>
                  <div class="form-group col-xl-3 col-lg-6">
                    <label for="examType">Exam Type</label>
                    <select name="examType" id="examType" class="form-control">
                      <option value="">e-Test</option>
                      <option value="">Practical</option>
                    </select>
                  </div>
                  <div class="form-group col-xl-3 col-lg-6">
                    <label for="examDate">Date</label>
                    <input type="date" name="examDate" class="form-control"/>
                  </div>
                  <div class="form-group col-xl-2 col-lg-6">
                    <label for="startTime">Start Time</label>
                    <input type="time" name="startTime" class="form-control"/>
                  </div>
                  {{-- <div class="form-group col-xl-1 col-lg-4">
                    <label for="endTime">End Time</label>
                    <input type="time" name="endTime" class="form-control"/>
                  </div> --}}
                  <div class="form-group col-xl-1 col-lg-12">
                    <label for="submitExam">&nbsp;</label>
                    <button type="button" class="btn btn-outline-primary form-control" onclick="create_schedule();" id="submitExam" name="submitExam"><i class="fas fa-plus"></i></button>
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
                    @foreach ($exams as $exam)
                    <tr>
                      <td>FIT {{ $exam->subject->code }}</td>
                      <td>{{ $exam->subject->name }}</td>
                      <td>e-Test</td>
                      <td>{{ $exam->date }}</td>
                      <td>2:30PM</td>
                      <td>4.30PM</td>
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
                  @foreach ($exams as $exam)
                  <tr class="text-center">
                    <td>FIT {{ $exam->subject->code }}</td>
                    <td>{{ $exam->subject->name }}</td>
                    <td>{{ $exam->type->exam_type }}</td>
                    <td>{{ $exam->date }}</td>
                    <td>10:30 AM</td>
                    <td>12:30 PM</td>
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
                    <label for="srchExamYear">Year</label>
                    <select name="srchExamYear" id="srchExamYear" class="form-control">
                      <option slected>2020</option>
                      <option>2019</option>
                      <option>2018</option>
                    </select>
                  </div>
                  <div class="form-group col-xl-2 col-lg-3">
                    <label for="srchExamDate">Date</label>
                    <input type="date" class="form-control" id="srchExamDate" name="srchExamDate" />
                  </div>
                  <div class="form-group col-xl-2 col-lg-3">
                    <label for="srchExamType">Exam Type</label>
                    <select name="srchExamType" id="srchExamType" class="form-control">
                      <option value="" selected>e-Test</option>
                      <option value="">Practical</option>
                    </select>
                  </div>
                  <div class="form-group col-xl-3 col-lg-3">
                    <label for="srchSubject">Subject</label>
                    <select name="srchSubject" id="srchSubject" class="form-control">
                      <option value="">ICT Applications</option>
                      <option value="">English for ICT</option>
                      <option value="">Mathematics for ICT</option>
                    </select>
                  </div>
                  <div class="form-group col-xl-3 col-lg-12">
                    <label for="btnSearch">&nbsp;</label>
                    <button type="button" class="btn btn-outline-primary form-control" onclick="" id="btnSearch" name="btnSearch"><i class="fa fa-search"></i> Search</button>
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
                  @foreach ($exams as $exam)
                  <tr class="text-center">
                    <td>FIT {{ $exam->subject->code }}</td>
                    <td>{{ $exam->subject->name }}</td>
                    <td>e-Test</td>
                    <td>{{ $exam->date }}</td>
                    <td>10:30 AM</td>
                    <td>12:30 PM</td>
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
